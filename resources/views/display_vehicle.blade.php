@extends('layouts.app')
@section('title', 'Smart Manager Car - vehicle_overview')
@section('content')
<style>
    .vehicle-gallery {
        position: relative;
    }
    
    .main-image {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: contain;
        margin-bottom: 1rem;
        transition: opacity 0.3s ease;
    }
    
    .thumbnail-container {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        scrollbar-width: thin;
    }
    
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 2px solid #e5e7eb;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .thumbnail:hover {
        border-color: #4f46e5;
    }
    
    .thumbnail.active {
        border-color: #4f46e5;
    }
    
    /* Hide scrollbar but keep functionality */
    .thumbnail-container::-webkit-scrollbar {
        height: 4px;
    }
    
    .thumbnail-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .thumbnail-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 2px;
    }
    
    .thumbnail-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    @media (min-width: 1024px) {
        .vehicle-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .vehicle-info {
            order: -1;
        }
        
        .thumbnail-container {
            justify-content: center;
        }
    }
    
    /* Quantity selector styles */
    .quantity-selector {
        display: flex;
        align-items: center;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f4f6;
        border: 1px solid #d1d5db;
        cursor: pointer;
        font-size: 1.2rem;
    }
    
    .quantity-btn:first-child {
        border-radius: 8px 0 0 8px;
    }
    
    .quantity-btn:last-child {
        border-radius: 0 8px 8px 0;
    }
    
    .quantity-input {
        width: 60px;
        height: 40px;
        text-align: center;
        border-top: 1px solid #d1d5db;
        border-bottom: 1px solid #d1d5db;
        border-left: none;
        border-right: none;
        -moz-appearance: textfield;
    }
    
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    /* Color selector styles */
    .color-option {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid transparent;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }
    
    .color-option.active {
        border-color: #4f46e5;
    }
    
    /* Size selector styles */
    .size-option {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 9999px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .size-option:hover, .size-option.active {
        border-color: #4f46e5;
        background-color: #eef2ff;
    }

    /* New rental form styles */
    .rental-form {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .rental-form h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1.25rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-group label {
        display: block;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: border-color 0.2s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .form-row {
        display: flex;
        gap: 1rem;
    }
    
    .form-row .form-group {
        flex: 1;
    }
    
    .section-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 1.5rem 0;
    }
    
    /* Date picker styling */
    .flatpickr-input {
        background-color: white;
        cursor: pointer;
    }
    
    /* Time select styling */
    .time-select {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .time-select select {
        flex: 1;
    }
    
    .time-select span {
        color: #6b7280;
    }
</style>

<section class="py-10 lg:py-16 mt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="vehicle-container">
            <!-- Vehicle Gallery -->
            <div class="vehicle-gallery">
                @php
                    $mainImage = $vehicle->images->first()?->url ?? 'images/default-vehicle.jpg';
                @endphp
                <img id="main-image" src="{{ asset('storage/' . ltrim($mainImage, '/')) }}" alt="" class="main-image">

                <div class="thumbnail-container">
                    @forelse($vehicle->images as $image)
                        <img src="{{ asset('storage/' . ltrim($image->url, '/')) }}" alt=""
                             class="thumbnail active"
                             onclick="changeImage('{{ asset('storage/' . ltrim($image->url, '/')) }}', this)">
                    @empty
                        <img src="{{ asset('images/default-vehicle.jpg') }}" alt="" class="thumbnail active" onclick="changeImage('{{ asset('images/default-vehicle.jpg') }}', this)">
                    @endforelse
                </div>

            </div>
            <!-- vehicle Info -->
            <div class="vehicle-info">
                <p class="font-medium text-indigo-600 mb-3">{{$vehicle->type}}</p>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{$vehicle->brand}} {{$vehicle->model}}</h1>
                
                <div class="flex items-center mb-6">
                    <span class="text-2xl font-semibold text-gray-900 mr-4">{{ number_format((float) $vehicle->daily_rate, 2, ',', ' ') }} MAD / Day</span>
                </div>
                
                <p class="text-gray-600 mb-3">
                    Engine Type: {{ $vehicle->engine }}
                </p>
                <p class="text-gray-600 mb-3">
                    Fuel Efficiency: Approximately {{$vehicle->fuel_efficiency}} km/l
                </p>
                <p class="text-gray-600 mb-3">
                    Continuously Variable Transmission (CVT)
                </p>
                <p class="text-gray-600 mb-3">
                    Seating Capacity: {{$vehicle->seats}} passengers
                </p>
                <p class="text-gray-600 mb-8">
                    Fuel Type: {{ $vehicle->fuel }}
                </p>
                
                <!-- Quantity and Add to Cart -->
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row gap-4">  
                    </div>
                </div>

                <!-- Rental Form Section -->
                <form action="{{ route('booking.create') }}" method="get">
                <div class="rental-form">
                    <h3>Rental Information</h3>

                    <div class="form-row mb-4">
                        <div class="form-group w-full">
                            <label for="customer_name">Client Name</label>
                            <input type="text" id="customer_name" class="form-control" placeholder="Enter client full name" name="customer_name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="passport_number">Passport Number</label>
                            <input type="text" id="passport_number" class="form-control" placeholder="Enter passport number" name="passport_number" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" id="phone_number" class="form-control" placeholder="Enter phone number" name="phone_number" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pickup-date">Pick-Up Date</label>
                            <input type="date" id="pickup-date" class="form-control flatpickr-input" placeholder="Select date" name="pickupdate" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="pickup-time">Pick-Up Time</label>
                            <div class="time-select">
                                <select id="pickup-time" class="form-control">
                                    <option value="08:00">08:00 AM</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="18:00">07:00 PM</option>
                                    <option value="18:00">08:00 PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-divider"></div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dropoff-date">Drop-Off Date</label>
                            <input type="date" id="dropoff-date" class="form-control flatpickr-input" placeholder="Select date" name="dropoffdate" min="{{ date('Y-m-d') }}">
                            <input type="hidden" name="vehicle_id" value="{{$vehicle->vehicle_id}}">
                            <input type="hidden" name="daily_rate" value="{{$vehicle->daily_rate}}">
                        </div>
                        <div class="form-group">
                            <label for="dropoff-time">Drop-Off Time</label>
                            <div class="time-select">
                                <select id="dropoff-time" class="form-control">
                                    <option value="08:00">08:00 AM</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="19:00">07:00 PM</option>
                                    <option value="20:00">08:00 PM</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 mr-4 mb-10 mt-5">Total Price: {{ number_format((float) $vehicle->daily_rate, 2, ',', ' ') }} MAD</h2>
                </div>
                <!-- Rent Now Button -->
                <div class="flex gap-3">
                    {{-- <button class="p-3 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button> --}}
                        <input type="submit" value="Make Payment"class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-lg font-medium transition">
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                </form>
            </div>
        </div>
    </div>
</section>

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pickupDate = document.getElementById('pickup-date');
    const dropoffDate = document.getElementById('dropoff-date');
    const totalPriceElem = document.querySelector('h2.text-2xl');
    const dailyRate = parseFloat("{{$vehicle->daily_rate}}");

    function calculateTotal() {
        const start = pickupDate.value;
        const end = dropoffDate.value;
        if (start && end) {
            const startDate = new Date(start);
            const endDate = new Date(end);
            let days = (endDate - startDate) / (1000 * 60 * 60 * 24)+1;
            days = Math.ceil(days);
            if (days > 0) {
                const total = days * dailyRate;
                totalPriceElem.textContent = `Total Price: MAD ${total}`;
            } else {
                totalPriceElem.textContent = `Total Price: MAD ${dailyRate}`;
            }
        } else {
            totalPriceElem.textContent = `Total Price: MAD ${dailyRate}`;
        }
    }

    pickupDate.addEventListener('change', calculateTotal);
    dropoffDate.addEventListener('change', calculateTotal);
});
</script>
<script>
     // Initialize date pickers
     flatpickr("#pickup-date", {
        minDate: "today",
        dateFormat: "Y-m-d",
    });
    
    flatpickr("#dropoff-date", {
        minDate: "today",
        dateFormat: "Y-m-d",
    });
    // Change main image when thumbnail is clicked
    function changeImage(src, element) {
        document.getElementById('main-image').src = src;
        
        // Remove active class from all thumbnails
        const thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumb => thumb.classList.remove('active'));
        
        // Add active class to clicked thumbnail
        element.classList.add('active');
    }  
 
</script>  
@endsection