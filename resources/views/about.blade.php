@extends('layouts.app')
@section('title', 'Smart Manager Car - about')
@section('content')
<section class="py-16 xl:mr-0 lg:mr-5 mr-0">
  <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto mt-20">
      <div class="w-full justify-start items-center xl:gap-12 gap-10 grid lg:grid-cols-2 grid-cols-1">
          <div class="w-full flex-col justify-center lg:items-start items-center gap-8 inline-flex">
              <div class="w-full flex-col justify-center items-start gap-8 flex">
                  <div class="flex-col justify-start lg:items-start items-center gap-4 flex">
                      {{-- <h6 class="text-indigo-600 text-base font-medium uppercase tracking-wider">Our Journey</h6> --}}
                      <div class="w-full flex-col justify-start lg:items-start items-center gap-3 flex">
                          <h2 class="text-gray-900 text-4xl font-bold font-manrope leading-tight lg:text-start text-center">
                              Wenujaya Rent a Car - Your Trusted Travel Partner
                          </h2>
                          <p class="text-gray-600 text-lg font-normal leading-relaxed lg:text-start text-center">
                              Since our founding, Wenujaya Rent a Car has been committed to providing exceptional vehicle rental services. 
                              Our story is one of reliability, customer satisfaction, and continuous growth in the travel industry.
                          </p>
                      </div>
                  </div>
                  <div class="w-full flex-col justify-center items-start gap-6 flex">
                      <div class="w-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                          <div class="w-full h-full p-5 rounded-xl border border-gray-200 hover:border-indigo-300 bg-white transition-all duration-300 flex-col justify-start items-start gap-2.5 inline-flex">
                              <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">10+ Years</h4>
                              <p class="text-gray-500 text-base font-normal leading-relaxed">Of Trusted Vehicle Rental Experience</p>
                          </div>
                          <div class="w-full h-full p-5 rounded-xl border border-gray-200 hover:border-indigo-300 bg-white transition-all duration-300 flex-col justify-start items-start gap-2.5 inline-flex">
                              <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">15+ Vehicles</h4>
                              <p class="text-gray-500 text-base font-normal leading-relaxed">Modern Fleet to Meet Every Need</p>
                          </div>
                      </div>
                      <div class="w-full h-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                          <div class="w-full p-5 rounded-xl border border-gray-200 hover:border-indigo-300 bg-white transition-all duration-300 flex-col justify-start items-start gap-2.5 inline-flex">
                              <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">24/7 Support</h4>
                              <p class="text-gray-500 text-base font-normal leading-relaxed">Always Available for Our Customers</p>
                          </div>
                          <div class="w-full h-full p-5 rounded-xl border border-gray-200 hover:border-indigo-300 bg-white transition-all duration-300 flex-col justify-start items-start gap-2.5 inline-flex">
                              <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">98% Satisfaction</h4>
                              <p class="text-gray-500 text-base font-normal leading-relaxed">Proven Customer Happiness Rate</p>
                          </div>
                      </div>
                  </div>
              </div>
              {{-- <button class="sm:w-fit w-full group px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow transition-all duration-300 justify-center items-center flex">
                  <span class="px-1.5 text-white text-base font-medium leading-6">Explore Our Fleet</span>
                  <svg class="ml-2 group-hover:translate-x-1 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M6.6665 5L13.3332 10L6.6665 15" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </button> --}}
          </div>
          <div class="w-full lg:justify-start justify-center items-start flex">
              <div class="sm:w-[564px] w-full sm:h-[600px] h-full rounded-2xl overflow-hidden shadow-lg relative">
                  <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Wenujaya Rent a Car fleet" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                  <div class="absolute bottom-6 left-6 text-white">
                      <h3 class="text-xl font-bold">Our Premium Fleet</h3>
                      <p class="text-sm">Always ready for your journey</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
  