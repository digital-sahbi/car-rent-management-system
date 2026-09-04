@component('mail::message')
# 🎉 Payment Successful!

Hi {{ $reservation->user->name }},
Your reservation has been **successfully confirmed**. Below are your booking details:

---

### 🚗 Vehicle Details
- **Brand:** {{ $reservation->vehicle->brand }}
- **Model:** {{ $reservation->vehicle->model }}
- **Color:** {{ $reservation->vehicle->color }}
- **Fuel Type:** {{ $reservation->vehicle->fuel_type }}
- **Seats:** {{ $reservation->vehicle->seats }}
- **Engine:** {{ $reservation->vehicle->engine }}

---

### 📅 Reservation Info
- **Pickup Date:** {{ $reservation->start_date->format('d M Y') }}
- **Drop-off Date:** {{ $reservation->end_date->format('d M Y') }}
- **Total Days:** {{ $reservation->start_date->diffInDays($reservation->end_date) + 1 }}
- **Total Cost:** {{ number_format((float) $reservation->total_cost, 2, ',', ' ') }} MAD

---

If you have any questions, feel free to contact our support team.

Thanks for choosing us!
**Team Smart Manager Car**

@component('mail::button', ['url' => route('home')])
Go to Homepage
@endcomponent

@endcomponent
