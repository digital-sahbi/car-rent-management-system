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
</style>

<section class="py-10 lg:py-16 mt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="vehicle-container">
            <!-- Vehicle Gallery -->
            <div class="vehicle-gallery">
                <img id="main-image" src="{{ asset('../images/car/toyota aqua.jpg')}}" alt="Yellow Travel Bag" class="main-image">
                
                <div class="thumbnail-container">
                    <img src="{{ asset('../images/aqua/1_img.jpg')}}" alt="Travel Bag thumbnail" 
                         class="thumbnail active" 
                         onclick="changeImage('{{ asset('../images/aqua/1_img.jpg')}}', this)">
                    
                    <img src="{{ asset('../images/aqua/2_img.jpg')}}" alt="Travel Bag thumbnail" 
                         class="thumbnail" 
                         onclick="changeImage('{{ asset('../images/aqua/2_img.jpg')}}', this)">
                    
                    <img src="{{ asset('../images/aqua/3_img.jpg')}}" alt="Travel Bag thumbnail" 
                         class="thumbnail" 
                         onclick="changeImage('{{ asset('../images/aqua/3_img.jpg')}}', this)">
                    
                    <img src="{{ asset('../images/aqua/4_img.jpg')}}" alt="Travel Bag thumbnail" 
                         class="thumbnail" 
                         onclick="changeImage('{{ asset('../images/aqua/4_img.jpg')}}', this)">
                </div>
            </div>
            
            <!-- vehicle Info -->
            <div class="vehicle-info">
                <p class="font-medium text-indigo-600 mb-3">Car</p>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Toyota Aqua</h1>
                
                <div class="flex items-center mb-6">
                    <span class="text-2xl font-semibold text-gray-900 mr-4">MAD 15000</span>
                </div>
                
                <p class="text-gray-600 mb-3">
                    Engine Type: Hybrid (Petrol-Electric)
                </p>
                <p class="text-gray-600 mb-3">
                    Fuel Efficiency: Approximately 35-40 km/l
                </p>
                <p class="text-gray-600 mb-3">
                    Continuously Variable Transmission (CVT)
                </p>
                <p class="text-gray-600 mb-3">
                    Seating Capacity: 5 passengers
                </p>
                <p class="text-gray-600 mb-8">
                    Fuel Type: Hybrid (Regular Petrol)
                </p>
                
                <!-- Quantity and Add to Cart -->
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row gap-4">
                        {{-- <div class="quantity-selector">
                            <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                            <input type="number" id="quantity" value="1" min="1" class="quantity-input">
                            <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                        </div> --}}
                        {{-- <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-lg font-medium transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                            Add to Cart
                        </button> --}}
                    </div>
                </div>
                
                <!-- Buy Now Button -->
                <div class="flex gap-3">
                    {{-- <button class="p-3 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button> --}}
                    <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-lg font-medium transition">
                        Rent Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Change main image when thumbnail is clicked
    function changeImage(src, element) {
        document.getElementById('main-image').src = src;
        
        // Remove active class from all thumbnails
        const thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumb => thumb.classList.remove('active'));
        
        // Add active class to clicked thumbnail
        element.classList.add('active');
    }
    
    // Select color option
    function selectColor(element) {
        const colors = document.querySelectorAll('.color-option');
        colors.forEach(color => color.classList.remove('active'));
        element.classList.add('active');
    }
    
    // Select size option
    function selectSize(element) {
        const sizes = document.querySelectorAll('.size-option');
        sizes.forEach(size => size.classList.remove('active'));
        element.classList.add('active');
    }
    
    // Quantity control
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    }
    
    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>