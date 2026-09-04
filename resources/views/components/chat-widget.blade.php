<!-- Message Icon (Initially Hidden) -->
<div id="message-icon"
    class="fixed bottom-5 right-5 w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg opacity-0 transform translate-y-10 transition-all duration-500"
    onclick="toggleChatTray()">
    <i class="fas fa-comment-alt text-3xl"></i>
</div>

<!-- Chat Tray (Initially Hidden) -->
<div id="chat-tray" class="fixed bottom-20 right-5 w-80 bg-white shadow-lg rounded-lg hidden">
    <!-- Header -->
    <div class="bg-indigo-600 text-white p-3 rounded-t-lg flex items-center">
        <img src="{{ asset('images/VLogo.png') }}" alt="Profile" class="w-10 h-10 rounded-full border border-white mr-2">
        <div>
            <h3 class="text-lg font-semibold">Smart Manager Car Service</h3>
            <p class="text-sm text-green-300">Typically replies in a few minites</p>
        </div>
    </div>

    <!-- Chat Messages -->
    <div class="p-3">
        <div class="flex items-start space-x-2">
            <img src="{{ asset('images/VLogo.png') }}" class="w-8 h-8 rounded-full" alt="Profile">
            <div class="bg-gray-200 p-3 rounded-lg text-gray-700">
                <p>Hi there 👋</p>
                <p>How can I help you?</p>
            </div>
        </div>
    </div>

    <!-- Chat Buttons -->
    <div class="p-3 text-center border-t">
        <p class="text-sm text-gray-500 mb-2">Start Chat with:</p>
        <div class="flex justify-center space-x-2">
            <!-- WhatsApp Link -->
            <a href="javascript:void(0);" onclick="openWhatsApp()"
                class="bg-green-500 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
            </a>
            <!-- Telegram Link -->
            <a href="javascript:void(0);" onclick="openTelegram()"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fab fa-telegram mr-2"></i> Telegram
            </a>
        </div>
    </div>

</div>
