<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jelajah Nusantara') - Portal Provinsi Indonesia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-900 min-h-screen text-white">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-white/5 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        Jelajah Nusantara
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('home') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        Beranda
                    </a>
                    <a href="{{ route('provinces') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('provinces') || request()->routeIs('province.detail') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        Provinsi
                    </a>
                    <a href="{{ route('tradisi') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('tradisi') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        Tradisi
                    </a>
                    <a href="{{ route('wisata') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('wisata') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        Wisata
                    </a>
                    <a href="{{ route('kuliner') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('kuliner') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        Kuliner
                    </a>
                    <a href="{{ route('rekomendasi') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('rekomendasi') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        ⭐ Rekomendasi
                    </a>
                    <a href="{{ route('peraturan') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('peraturan') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                        Peraturan
                    </a>
                    <a href="{{ route('chat') }}" class="ml-2 px-5 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-500 hover:to-purple-500 transition-all duration-200 font-medium shadow-lg shadow-indigo-500/30">
                        💬 Chat AI
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10 bg-slate-950/95 backdrop-blur-xl">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('home') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    Beranda
                </a>
                <a href="{{ route('provinces') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('provinces') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    Provinsi
                </a>
                <a href="{{ route('tradisi') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('tradisi') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    Tradisi
                </a>
                <a href="{{ route('wisata') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('wisata') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    Wisata
                </a>
                <a href="{{ route('kuliner') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('kuliner') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    Kuliner
                </a>
                <a href="{{ route('rekomendasi') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('rekomendasi') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    ⭐ Rekomendasi
                </a>
                <a href="{{ route('peraturan') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('peraturan') ? 'bg-white/10 text-indigo-300' : 'text-gray-300' }}">
                    Peraturan
                </a>
                <a href="{{ route('chat') }}" class="block px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg text-center font-medium">
                    💬 Chat AI
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 border-t border-white/10 bg-slate-950/50 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        Jelajah Nusantara
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Portal informasi lengkap tentang provinsi-provinsi di Indonesia. Temukan tradisi, wisata, kuliner, dan peraturan daerah dari seluruh Nusantara.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('provinces') }}" class="text-gray-400 hover:text-indigo-400 transition-colors">Semua Provinsi</a></li>
                        <li><a href="{{ route('tradisi') }}" class="text-gray-400 hover:text-indigo-400 transition-colors">Tradisi</a></li>
                        <li><a href="{{ route('wisata') }}" class="text-gray-400 hover:text-indigo-400 transition-colors">Wisata</a></li>
                        <li><a href="{{ route('kuliner') }}" class="text-gray-400 hover:text-indigo-400 transition-colors">Kuliner</a></li>
                        <li><a href="{{ route('chat') }}" class="text-gray-400 hover:text-indigo-400 transition-colors">Chat AI</a></li>
                    </ul>
                </div>

            </div>

            <div class="mt-8 pt-8 border-t border-white/10 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Jelajah Nusantara. Dibuat dengan ❤️ untuk Indonesia.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        let lastScroll = 0;
        const nav = document.querySelector('nav');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                nav.classList.add('shadow-xl', 'shadow-indigo-500/10');
            } else {
                nav.classList.remove('shadow-xl', 'shadow-indigo-500/10');
            }
            
            lastScroll = currentScroll;
        });
    </script>

    @stack('scripts')
</body>
</html>
