@extends('layouts.app')
@section('title', 'Smart Manager Car - Home')
@section('content')
<style>
    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .faq-item {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .faq-item.active {
        border-color: #4f46e5;
        box-shadow: 0 1px 3px rgba(79, 70, 229, 0.1);
    }
    
    .faq-question {
        width: 100%;
        padding: 1.25rem;
        text-align: left;
        
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
        transition: all 0.2s ease;
    }
    
    .faq-question:hover {
        color: #4f46e5;
    }
    
    .faq-question.active {
        color: #4f46e5;
        font-weight: 600;
    }
    
    .faq-icon {
        transition: transform 0.3s ease;
    }
    
    .faq-question.active .faq-icon {
        transform: rotate(180deg);
    }
    
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        padding: 0 1.25rem;
        transition: max-height 0.3s ease, padding 0.3s ease;
        color: #4b5563;
    }
    
    .faq-answer.active {
        max-height: 300px;
        padding-bottom: 1.25rem;
    }
</style>

<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-20">
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                Frequently Asked Questions
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Find answers to common questions about our car rental services.
            </p>
        </div>
        
        <div class="faq-container">
            <!-- FAQ Item 1 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-1">
                    What's the minimum age to rent a car in Sri Lanka?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-1" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        To rent a car in Sri Lanka you need to be at least 19 years old with a valid license. Some car categories have a higher minimum rental age, and an underage driver fee may apply.
                    </p>
                </div>
            </div>
            <!-- FAQ Item 1 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-2">
                    What documents do I need to rent a car in Sri Lanka?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-2" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        You will need a full, valid driver's license along with a passport or identity card when picking up your car. More detailed information can be found in our rental information.
                    </p>
                </div>
            </div>
            <!-- FAQ Item 1 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-3">
                    How can I reset my password?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-3" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        To reset your password, go to the login page and click on "Forgot Password". 
                        Enter your email address and we'll send you a link to reset your password. 
                        The link will expire in 24 hours for security reasons.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-4">
                    How do I update my billing information?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-4" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        You can update your billing information by logging into your account and navigating to 
                        the "Billing" section in your profile settings. Here you can add, remove, or update 
                        your payment methods and billing address.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-5">
                    How can I contact customer support?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-5" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        Our customer support team is available 24/7. You can reach us by phone at 
                        1-800-RENT-CAR, via email at support@carrental.com, or through the live chat 
                        feature on our website and mobile app.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 4 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-6">
                    How do I delete my account?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-6" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        To delete your account, go to your account settings and select "Delete Account". 
                        Please note that this action is permanent and will erase all your rental history 
                        and personal information from our system.
                    </p>
                </div>
            </div>
            
            <!-- FAQ Item 5 -->
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-7">
                    What is your cancellation policy?
                    <svg class="faq-icon w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="faq-answer-7" class="faq-answer" aria-hidden="true">
                    <p class="mt-2 text-gray-600">
                        You can cancel your reservation free of charge up to 24 hours before your scheduled 
                        pickup time. Cancellations made within 24 hours may incur a fee. Please check your 
                        rental agreement for specific details.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                // Close all other FAQ items
                faqQuestions.forEach(q => {
                    if (q !== question) {
                        q.classList.remove('active');
                        q.setAttribute('aria-expanded', 'false');
                        const answerId = q.getAttribute('aria-controls');
                        document.getElementById(answerId).classList.remove('active');
                        q.parentElement.classList.remove('active');
                    }
                });
                
                // Toggle current FAQ item
                const isExpanded = question.getAttribute('aria-expanded') === 'true';
                question.classList.toggle('active', !isExpanded);
                question.setAttribute('aria-expanded', !isExpanded);
                
                const answerId = question.getAttribute('aria-controls');
                document.getElementById(answerId).classList.toggle('active', !isExpanded);
                question.parentElement.classList.toggle('active', !isExpanded);
            });
        });
    });
</script>
@endsection