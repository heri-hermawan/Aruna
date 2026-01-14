@extends('layouts.app')

@section('title', 'Chatbot AI')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-900/50 to-purple-900/50 border-b border-white/10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold mb-4">
                    <span class="text-6xl mr-3">🤖</span>
                    <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        Chatbot AI
                    </span>
                </h1>
                <p class="text-xl text-gray-300">Tanya apapun kepada AI - Powered by DeepSeek-R1</p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white/5 backdrop-blur-xl border border-white/20 rounded-2xl p-6 md:p-8">
        <!-- Chat Messages Container -->
        <div id="messagesContainer" class="h-96 overflow-y-auto mb-6 rounded-xl bg-white/5 p-4 border border-white/10">
            <div class="text-center text-gray-400 mt-40">
                <div class="text-4xl mb-4">💬</div>
                <p>Mulai percakapan dengan AI...</p>
            </div>
        </div>

        <!-- Input Form -->
        <form id="chatForm" class="flex flex-col gap-4">
            <div class="flex gap-3">
                <textarea
                    id="messageInput"
                    placeholder="Ketik pertanyaan Anda di sini..."
                    class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                    rows="3"
                ></textarea>
                <button
                    type="submit"
                    id="sendBtn"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all font-medium h-fit"
                >
                    <span id="sendIcon">📤</span>
                </button>
            </div>
            <small class="text-gray-400">Jangan share informasi sensitif atau rahasia</small>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const messagesContainer = document.getElementById('messagesContainer');

    function addMessage(text, isUser = true) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `mb-4 flex ${isUser ? 'justify-end' : 'justify-start'}`;

        const messageContent = document.createElement('div');
        messageContent.className = `px-4 py-3 rounded-lg max-w-xs md:max-w-md lg:max-w-2xl ${
            isUser
                ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white'
                : 'bg-white/10 text-gray-200 border border-white/20 whitespace-pre-wrap break-words text-sm'
        }`;
        
        // Escape HTML and preserve line breaks
        const div = document.createElement('div');
        div.textContent = text;
        messageContent.innerHTML = div.innerHTML.replace(/\n/g, '<br>');

        messageDiv.appendChild(messageContent);
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function clearMessages() {
        messagesContainer.innerHTML = '';
    }

    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const message = messageInput.value.trim();
        if (!message) return;

        // Clear initial message if exists
        if (messagesContainer.querySelector('.text-center')) {
            clearMessages();
        }

        // Add user message
        addMessage(message, true);
        messageInput.value = '';

        // Show loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'mb-4 flex justify-start';
        loadingDiv.id = 'loadingIndicator';
        const loadingContent = document.createElement('div');
        loadingContent.className = 'px-4 py-3 rounded-lg bg-white/10 text-gray-200 border border-white/20';
        loadingContent.innerHTML = '<span class="inline-block animate-spin">⏳</span> Sedang berpikir...';
        loadingDiv.appendChild(loadingContent);
        messagesContainer.appendChild(loadingDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Disable button
        sendBtn.disabled = true;
        messageInput.disabled = true;

        try {
            const response = await fetch('{{ route('chat.send') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ message: message }),
            });

            const data = await response.json();

            // Remove loading indicator
            const loadingIndicator = document.getElementById('loadingIndicator');
            if (loadingIndicator) {
                loadingIndicator.remove();
            }

            if (data.success) {
                addMessage(data.response, false);
            } else {
                addMessage('Terjadi kesalahan: ' + data.error, false);
            }
        } catch (error) {
            const loadingIndicator = document.getElementById('loadingIndicator');
            if (loadingIndicator) {
                loadingIndicator.remove();
            }
            addMessage('Terjadi kesalahan: ' + error.message, false);
        } finally {
            sendBtn.disabled = false;
            messageInput.disabled = false;
            messageInput.focus();
        }
    });

    // Focus input on load
    messageInput.focus();
});
</script>

<style>
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection
