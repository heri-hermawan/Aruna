@extends('layouts.app')

@section('title', 'Chat AI')

@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 h-[calc(100vh-80px)] flex flex-col">
    <!-- Chat Header -->
    <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-6">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-3xl">
                🤖
            </div>
            <div>
                <h1 class="text-3xl font-bold mb-1">
                    <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        Chat AI Assistant
                    </span>
                </h1>
                <p class="text-gray-400">Tanyakan apa saja tentang provinsi, budaya, wisata, dan kuliner Indonesia</p>
            </div>
        </div>
    </div>

    <!-- Chat Messages Container -->
    <div class="flex-1 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-6 overflow-y-auto" id="chat-messages">
        <!-- Welcome Message -->
        <div class="flex items-start space-x-3 mb-6 animate-fade-in">
            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                🤖
            </div>
            <div class="flex-1 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-white/10 rounded-2xl rounded-tl-none p-4">
                <p class="text-gray-200">
                    Halo! Saya adalah AI Assistant untuk Jelajah Nusantara. Saya siap membantu Anda mencari informasi tentang:
                </p>
                <ul class="mt-3 space-y-2 text-gray-300">
                    <li class="flex items-center space-x-2">
                        <span>🏝️</span>
                        <span>Provinsi-provinsi di Indonesia</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span>🎭</span>
                        <span>Tradisi dan budaya lokal</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span>🏖️</span>
                        <span>Destinasi wisata menarik</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span>🍜</span>
                        <span>Kuliner khas daerah</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span>📜</span>
                        <span>Peraturan daerah</span>
                    </li>
                </ul>
                <p class="mt-3 text-gray-400 text-sm">Silakan tanyakan apa saja!</p>
            </div>
        </div>

        <!-- Suggested Questions -->
        <div class="mb-6" id="suggested-questions">
            <p class="text-gray-400 text-sm mb-3">Pertanyaan yang sering diajukan:</p>
            <div class="flex flex-wrap gap-2">
                <button onclick="askQuestion('Ceritakan tentang Bali')" class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-all text-sm">
                    Ceritakan tentang Bali
                </button>
                <button onclick="askQuestion('Wisata apa yang ada di Jawa Barat?')" class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-all text-sm">
                    Wisata di Jawa Barat
                </button>
                <button onclick="askQuestion('Kuliner khas Sumatera Utara')" class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-all text-sm">
                    Kuliner Sumatera Utara
                </button>
                <button onclick="askQuestion('Tradisi unik di Indonesia')" class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-all text-sm">
                    Tradisi unik
                </button>
            </div>
        </div>
    </div>

    <!-- Chat Input -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
        <form id="chat-form" class="flex items-center space-x-3">
            <input 
                type="text" 
                id="chat-input" 
                placeholder="Ketik pesan Anda di sini..." 
                class="flex-1 px-6 py-4 bg-white/10 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                autocomplete="off"
            >
            <button 
                type="submit" 
                id="send-button"
                class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all font-medium shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>
        </form>
        <p class="text-gray-500 text-xs mt-3 text-center">
            AI dapat membuat kesalahan. Verifikasi informasi penting.
        </p>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const suggestedQuestions = document.getElementById('suggested-questions');

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (!message) return;

        // Hide suggested questions after first message
        if (suggestedQuestions) {
            suggestedQuestions.style.display = 'none';
        }

        // Display user message
        addMessage(message, 'user');
        chatInput.value = '';
        
        // Disable input while processing
        chatInput.disabled = true;
        sendButton.disabled = true;
        
        // Show typing indicator
        const typingId = addTypingIndicator();
        
        try {
            // Send to API
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message })
            });
            
            const data = await response.json();
            
            // Remove typing indicator
            removeTypingIndicator(typingId);
            
            // Display AI response
            addMessage(data.message, 'ai');
            
        } catch (error) {
            console.error('Error:', error);
            removeTypingIndicator(typingId);
            addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'ai');
        } finally {
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus();
        }
    });

    function askQuestion(question) {
        chatInput.value = question;
        chatForm.dispatchEvent(new Event('submit'));
    }

    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex items-start space-x-3 mb-6 animate-fade-in ${sender === 'user' ? 'flex-row-reverse space-x-reverse' : ''}`;
        
        const avatar = document.createElement('div');
        avatar.className = `flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center ${
            sender === 'user' 
                ? 'bg-gradient-to-br from-purple-500 to-pink-500' 
                : 'bg-gradient-to-br from-indigo-500 to-purple-600'
        }`;
        avatar.textContent = sender === 'user' ? '👤' : '🤖';
        
        const bubble = document.createElement('div');
        bubble.className = `flex-1 max-w-2xl rounded-2xl p-4 ${
            sender === 'user'
                ? 'bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-purple-500/30 rounded-tr-none'
                : 'bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-white/10 rounded-tl-none'
        }`;
        bubble.innerHTML = `<p class="text-gray-200 whitespace-pre-wrap">${escapeHtml(text)}</p>`;
        
        messageDiv.appendChild(avatar);
        messageDiv.appendChild(bubble);
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    function addTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'flex items-start space-x-3 mb-6 typing-indicator';
        typingDiv.id = 'typing-' + Date.now();
        
        const avatar = document.createElement('div');
        avatar.className = 'flex-shrink-0 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center';
        avatar.textContent = '🤖';
        
        const bubble = document.createElement('div');
        bubble.className = 'bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border border-white/10 rounded-2xl rounded-tl-none p-4';
        bubble.innerHTML = `
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                <div class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                <div class="w-2 h-2 bg-pink-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
            </div>
        `;
        
        typingDiv.appendChild(avatar);
        typingDiv.appendChild(bubble);
        
        chatMessages.appendChild(typingDiv);
        scrollToBottom();
        
        return typingDiv.id;
    }

    function removeTypingIndicator(id) {
        const indicator = document.getElementById(id);
        if (indicator) {
            indicator.remove();
        }
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    /* Custom scrollbar */
    #chat-messages::-webkit-scrollbar {
        width: 8px;
    }

    #chat-messages::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    #chat-messages::-webkit-scrollbar-thumb {
        background: rgba(99, 102, 241, 0.5);
        border-radius: 10px;
    }

    #chat-messages::-webkit-scrollbar-thumb:hover {
        background: rgba(99, 102, 241, 0.7);
    }
</style>
@endpush
