<?php



use Illuminate\Http\Request;




use App\Models\User;
use App\Models\Reservation;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\MailController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\Admin\DashboardController;



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
//Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
// Testimonials
//Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');


// Public Vehicle & Info Routes
Route::get('/vehicles/{vehicle_id}', [VehicleController::class, 'vehicleDetails'])->name('vehicle.details');

Route::get('/vehicl', [VehicleController::class, 'vehicles'])->name('showVehicles');

Route::get('/support', [HomeController::class, 'showSupport'])->name('showSupport');
Route::get('/contact', [HomeController::class, 'showContact'])->name('showContact');
Route::get('/about', [HomeController::class, 'showAbout'])->name('showAbout');

// Booking
Route::get('/reservation', [BookingController::class, 'CreateBooking'])->name('booking.create');

// Google OAuth

Route::middleware(['guest'])->group(function () {
    Route::get('auth/google', [SocialController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('google.callback');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
});

// Verified User Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
});

// Public Vehicle & Info Routes
Route::get('/vehicles/{vehicle_id}', [VehicleController::class, 'vehicleDetails'])->name('vehicle.details');
Route::get('/vehicl', [VehicleController::class, 'vehicles'])->name('showVehicles');
Route::get('/support', [HomeController::class, 'showSupport'])->name('showSupport');
Route::get('/contact', [HomeController::class, 'showContact'])->name('showContact');
Route::get('/about', [HomeController::class, 'showAbout'])->name('showAbout');

// Booking
Route::get('/reservation', [BookingController::class, 'CreateBooking'])->name('booking.create');


// Stripe Payment Routes
Route::get('/stripe-payment', [StripePaymentController::class, 'showForm'])->name('stripe.form');
Route::post('/stripe-payment/{id}', [StripePaymentController::class, 'processPayment'])->name('stripe.payment');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/payment/method', function (Request $request) {
    $price = (float) $request->query('price', 0);
    $product = $request->query('product', 'Vehicle');
    $reservationId = $request->query('reservation_id');

    return view('payment-method', [
        'price' => $price,
        'product' => $product,
        'reservation_id' => $reservationId,
    ]);
})->name('payment.method');

Route::get('/payment/confirm', function (Request $request) {
    $price = (float) $request->query('price', 0);
    $product = $request->query('product', 'Vehicle');
    $reservationId = $request->query('reservation_id');
    $method = $request->query('payment_method', 'cash');

    if ($method === 'card') {
        return redirect()->route('stripe.checkout', [
            'price' => $price,
            'product' => $product,
            'reservation_id' => $reservationId,
        ]);
    }

    return redirect()->route('home')->with('success', 'Reservation saved successfully. Payment will be collected on delivery.');
})->name('payment.confirm');

Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe')->name('stripe.index');
    Route::get('stripe/checkout', 'stripeCheckout')->name('stripe.checkout');
    Route::get('stripe/checkout/success', 'stripeCheckoutSuccess')->name('stripe.checkout.success');
});



Route::get('/revenue-report', function (Request $request) {
    $groupBy = $request->input('group_by', 'day');
    $selectedMonth = $request->input('month');
    $selectedYear = $request->input('year');
    
    // Debug: Log the request parameters
    \Log::info('Revenue Report Request:', [
        'group_by' => $groupBy,
        'month' => $selectedMonth,
        'year' => $selectedYear,
        'all_params' => $request->all()
    ]);
    
    $query = Reservation::where('status', 'confirmed');
    
    switch ($groupBy) {
        case 'year':
            $query->selectRaw('YEAR(created_at) as period, SUM(total_cost) as revenue')
                ->groupBy('period')->orderBy('period', 'desc');
            $title = 'Yearly Revenue Report';
            break;
            
        case 'month':
            $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period,
                SUM(total_cost) as revenue,
                YEAR(created_at) as year,
                MONTH(created_at) as month')
                ->groupBy('period', 'year', 'month')
                ->orderBy('period', 'desc');
            $title = 'Monthly Revenue Report';
            break;
            
        default: // day
            // Apply month filter if provided
            if ($selectedMonth) {
                $query->whereMonth('created_at', $selectedMonth);
                \Log::info('Applied month filter: ' . $selectedMonth);
            }
            
            // Apply year filter if provided
            if ($selectedYear) {
                $query->whereYear('created_at', $selectedYear);
                \Log::info('Applied year filter: ' . $selectedYear);
            }
            
            $query->selectRaw('DATE(created_at) as period, SUM(total_cost) as revenue')
                ->groupBy('period')
                ->orderBy('period', 'desc');
            $title = 'Daily Revenue Report';
            
            // Add month/year to title if filtered
            if ($selectedMonth || $selectedYear) {
                $titleParts = [];
                if ($selectedMonth) {
                    $titleParts[] = date('F', mktime(0, 0, 0, $selectedMonth, 1));
                }
                if ($selectedYear) {
                    $titleParts[] = $selectedYear;
                }
                $title .= ' - ' . implode(' ', $titleParts);
            }
            break;
    }
    
    // Debug: Log the final query
    \Log::info('Final Query SQL: ' . $query->toSql());
    \Log::info('Query Bindings: ', $query->getBindings());
    
    $records = $query->paginate(15);
    
    // Debug: Log the results
    \Log::info('Records found: ' . $records->count());
    \Log::info('Total records: ' . $records->total());
    
    return view('reports.daily-revenue', [
        'records' => $records,
        'groupBy' => $groupBy,
        'selectedMonth' => $selectedMonth,
        'selectedYear' => $selectedYear,
        'title' => $title
    ]);
})->name('print.daily.revenue');


Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe')->name('stripe.index');
    Route::get('stripe/checkout', 'stripeCheckout')->name('stripe.checkout');
    Route::get('stripe/checkout/success', 'stripeCheckoutSuccess')->name('stripe.checkout.success');
});
