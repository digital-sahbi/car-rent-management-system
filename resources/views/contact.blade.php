@extends('layouts.app')
@section('title', 'Smart Manager Car - contact')
@section('content')
<section class="dark:bg-gray-900 pt-16">
    <div class="lg:py-16 px-4 mx-auto max-w-screen-md mt-20">
        <div class="text-center mb-12">
            <h2 class="mb-4 text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white">Contact Us</h2>
            <p class="max-w-2xl mx-auto font-light text-gray-500 dark:text-gray-400 text-base md:text-lg">
                Got a technical issue? Want to send feedback about a beta feature? Need details about our Business? Let us know.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="md:col-span-1">
                {{-- <form action="#" class="space-y-6">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                        <input type="email" id="email" class="block p-3 w-full text-sm rounded-lg border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="name@example.com" required>
                    </div>
                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                        <input type="text" id="subject" class="block p-3 w-full text-sm rounded-lg border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="How can we help?" required>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                        <textarea id="message" rows="5" class="block p-2.5 w-full text-sm rounded-lg shadow-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Your message..."></textarea>
                    </div>
                    <button type="submit" class="w-full md:w-auto px-5 py-3 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        Send message
                    </button>
                </form> --}}
                
                <form action="https://api.web3forms.com/submit" method="POST">
                    <!-- Replace with your Access Key -->
                    <input type="hidden" name="access_key" value="6fb88fad-db06-4b08-9f3e-d45e53be2396">

                    <!-- Form Inputs. Each input must have a name="" attribute -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                        <input type="text" name="name" class="block mb-2 p-3 w-full text-sm rounded-lg border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ashen botheju" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                        <input type="email" name="email" class="block mb-2 p-3 w-full text-sm rounded-lg border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="ashen@example.com" required>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Message</label>
                        <textarea name="message" rows="5" class="block mb-5 p-2.5 w-full text-sm rounded-lg shadow-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Your message....." required></textarea>
                    </div>
                    <!-- Honeypot Spam Protection -->
                    <input type="checkbox" name="botcheck" class="hidden" style="display: none;">
                    <input type="hidden" name="from_name" value="Client Notification">
                    <input type="hidden" name="subject" value="New Submission from client">

                    <!-- Custom Confirmation / Success Page -->
                    <input type="hidden" name="redirect" value="{{ route('showContact') }}">
                    <!-- <input type="hidden" name="redirect" value="https://mywebsite.com/thanks.html"> -->

                    <button type="submit" class="w-full md:w-auto px-5 py-3 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        Submit Form
                    </button>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div class="md:col-span-1">
                <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <h3 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Get in Touch</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-gray-900 dark:text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-500 dark:text-gray-400">Near the Railway Gate, Hiripitiya Rd, Wellawa, Kurunegala.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-gray-900 dark:text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-500 dark:text-gray-400">+94 76 250 7409</p>
                                <p class="text-gray-500 dark:text-gray-400">+94 76 250 7409</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-gray-900 dark:text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-500 dark:text-gray-400">contact@wenujayarentacar.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="mt-8 p-6 bg-indigo-50 dark:bg-gray-800 rounded-lg border border-indigo-100 dark:border-gray-700">
                    <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Hire a vehicle now!</h3>
                    <a href="tel:+94762507409" class="text-3xl md:text-4xl font-bold text-indigo-600 dark:text-indigo-400 hover:underline">+94 76 250 7409</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection