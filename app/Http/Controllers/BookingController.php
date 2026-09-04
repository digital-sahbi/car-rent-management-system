<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller

{
public function CreateBooking(Request $request)
{
    $validatedData = $request->validate([
        'pickupdate' => 'required|date',
        'dropoffdate' => 'required|date|after_or_equal:pickupdate',
        'daily_rate' => 'required|numeric',
        'vehicle_id' => 'required|exists:vehicles,vehicle_id',
        'customer_name' => 'required|string|max:255',
        'passport_number' => 'required|string|max:50',
        'phone_number' => 'required|string|max:20',
    ]);

    $startDate = Carbon::parse($validatedData['pickupdate'])->format('Y-m-d');
    $endDate = Carbon::parse($validatedData['dropoffdate'])->format('Y-m-d');

    // Check if the vehicle is already booked during the selected period
    $conflict = Reservation::where('vehicle_id', $validatedData['vehicle_id'])
        ->where('status', '=', 'confirmed') // optional if you want to allow reuse after cancellation
        //reuse pending

        ->where(function ($query) use ($startDate, $endDate) {
            $query->whereDate('start_date', '<=', $endDate)
                  ->whereDate('end_date', '>=', $startDate);
        })
        ->exists();

    if ($conflict) {
        return back()->withErrors(['error' => 'This vehicle is already booked for the selected date range.']);
    }

    // Calculate total cost
    $days = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
    $totalCost = $validatedData['daily_rate'] * $days;

    if (!Auth::check()) {
        return redirect()->back()->with('error2', 'You must be logged in to make a reservation.');
    }

    $customer = Customer::firstOrCreate(
        ['passport_number' => $validatedData['passport_number']],
        [
            'full_name' => $validatedData['customer_name'],
            'phone_number' => $validatedData['phone_number'],
        ]
    );

    $reservationData = [
        'user_id'     => Auth::user()->id,
        'customer_id' => $customer->id,
        'customer_name' => $validatedData['customer_name'],
        'passport_number' => $validatedData['passport_number'],
        'phone_number' => $validatedData['phone_number'],
        'vehicle_id'  => $validatedData['vehicle_id'],
        'start_date'  => $startDate,
        'end_date'    => $endDate,
        'total_cost'  => $totalCost,
        'status'      => 'pending',
    ];

    $result = Reservation::create($reservationData);

    return redirect()->route('payment.method', [
        'price' => $reservationData['total_cost'],
        'product' => $reservationData['vehicle_id'],
        'reservation_id' => $result->reservation_id,
    ]);
}
}
