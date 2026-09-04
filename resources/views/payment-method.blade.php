<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Payment Method</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Choose payment method</h1>
        <p class="text-slate-600 mb-6">Total: <span class="font-semibold text-slate-900">{{ number_format((float) $price, 2, ',', ' ') }} MAD</span></p>

        @if (session('error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" class="space-y-6">
            <input type="hidden" name="price" value="{{ $price }}">
            <input type="hidden" name="product" value="{{ $product }}">
            @if($reservation_id)
                <input type="hidden" name="reservation_id" value="{{ $reservation_id }}">
            @endif

            <div class="space-y-4">
                <label class="flex items-start gap-4 rounded-xl border border-slate-200 p-4 cursor-pointer hover:border-indigo-300 transition">
                    <input type="radio" name="payment_method" value="cash" class="mt-1 h-5 w-5 text-indigo-600" checked>
                    <span>
                        <span class="block text-lg font-semibold text-slate-800">Cash on delivery</span>
                        <span class="block text-sm text-slate-500">Pay when the vehicle is delivered.</span>
                    </span>
                </label>

                <label class="flex items-start gap-4 rounded-xl border border-slate-200 p-4 cursor-pointer hover:border-indigo-300 transition">
                    <input type="radio" name="payment_method" value="card" class="mt-1 h-5 w-5 text-indigo-600">
                    <span>
                        <span class="block text-lg font-semibold text-slate-800">Bank card</span>
                        <span class="block text-sm text-slate-500">Pay securely online with your card.</span>
                    </span>
                </label>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="submit" formaction="{{ route('payment.confirm') }}" class="flex-1 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-500">
                    Continue
                </button>
                <a href="{{ route('home') }}" class="flex-1 rounded-xl border border-slate-300 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Back home
                </a>
            </div>
        </form>
    </div>
</body>
</html>
