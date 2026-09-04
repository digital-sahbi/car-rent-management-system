@extends('layouts.app')
@section('title', 'Wenujaya Rent a Car - Fleet')
@section('content')
    <div class="container py-25 mt-40 mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Page Heading Section -->
        <div class="text-center mb-20">
            {{-- <h6 class="text-indigo-600 text-base font-medium uppercase tracking-wider mb-2">Our Fleet</h6> --}}
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl font-manrope">
                Explore Our Premium Vehicle Collection
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                Choose from our wide selection of well-maintained vehicles for every travel need. 
                Whether you're looking for economy, comfort, or luxury, we have the perfect vehicle for your journey.
            </p>
        </div>

        <!-- Vehicle Grid Section -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
            @foreach($vehicles as $vehicle)
                {{-- <x-car-card /> --}}
                <div class="w-full max-w-sm px-4 py-3 bg-white rounded-md shadow-md dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div class="">
                            <h1 class="text-lg font-bold text-gray-800 dark:text-gray-400">{{ $vehicle->brand }} {{ $vehicle->model }}</h1>
                            <p class="text-sm font-light text-gray-800 dark:text-gray-400">{{ $vehicle->type }}</p>
                        </div>
                      
                    </div>
                    @if($vehicle->images->isNotEmpty())
                        <img class="object-cover w-full h-50 w-auto mt-2" src="{{ asset('storage/' . $vehicle->images->first()->url) }}" alt="vehicle image">
                    @endif
                    <div>
                        <p class="text-lg"><strong>Available</strong></p>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mt-2 text-gray-700 dark:text-gray-200">
                            <div>
                                <span class="text-2xl font-bold">{{ number_format((float) $vehicle->daily_rate, 2, ',', ' ') }}</span>
                                <span class="text-2xl font-bold"> MAD</span>
                                <span class="text-2xl font-bold">/</span>
                                <span class="">day</span>
                            </div>
                            <div>
                                <a class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" href="{{ route('vehicle.details', $vehicle->vehicle_id)}}">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            {{ $vehicles->links() }}
        </div>

        <!-- Call to Action -->
        {{-- <div class="mt-12 text-center">
            <button class="group px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow transition-all duration-300 inline-flex items-center">
                <span class="text-white text-base font-medium leading-6">View All Vehicles</span>
                <svg class="ml-2 group-hover:translate-x-1 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M6.6665 5L13.3332 10L6.6665 15" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div> --}}
    </div>
@endsection