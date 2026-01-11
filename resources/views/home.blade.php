@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-60 -left-40 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute bottom-40 right-1/3 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl animate-pulse delay-2000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
        <div class="text-center">
            <!-- Main Title -->
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Jelajahi Keindahan
                </span>
                <br>
                <span class="text-white">Nusantara</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed animate-fade-in-delay-1">
                Temukan kekayaan budaya, tradisi, wisata, dan kuliner dari 38 provinsi di Indonesia dalam satu platform modern.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16 animate-fade-in-delay-2">
                <a href="{{ route('provinces') }}" class="group px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all duration-300 font-semibold shadow-2xl shadow-indigo-500/50 hover:shadow-indigo-500/70 hover:scale-105 flex items-center space-x-2">
                    <span>Jelajahi Provinsi</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('chat') }}" class="px-8 py-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-300 font-semibold hover:scale-105">
                    💬 Chat dengan AI
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl font-bold bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent mb-2">38</div>
                    <div class="text-gray-400 text-sm">Provinsi</div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent mb-2" id="tradisi-count">0</div>
                    <div class="text-gray-400 text-sm">Tradisi</div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl font-bold bg-gradient-to-r from-pink-400 to-rose-400 bg-clip-text text-transparent mb-2" id="wisata-count">0</div>
                    <div class="text-gray-400 text-sm">Wisata</div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl font-bold bg-gradient-to-r from-rose-400 to-orange-400 bg-clip-text text-transparent mb-2" id="kuliner-count">0</div>
                    <div class="text-gray-400 text-sm">Kuliner</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Highlights -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-4">
            <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                Jelajahi Kategori
            </span>
        </h2>
        <p class="text-gray-400 text-lg">Temukan berbagai aspek kebudayaan Indonesia</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Tradisi Card -->
        <a href="{{ route('tradisi') }}" class="group relative bg-gradient-to-br from-indigo-500/10 to-purple-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:scale-105 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="text-5xl mb-4">🎭</div>
                <h3 class="text-2xl font-bold mb-2">Tradisi</h3>
                <p class="text-gray-400 text-sm">Warisan budaya dan adat istiadat dari seluruh Indonesia</p>
            </div>
        </a>

        <!-- Wisata Card -->
        <a href="{{ route('wisata') }}" class="group relative bg-gradient-to-br from-purple-500/10 to-pink-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:scale-105 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="text-5xl mb-4">🏖️</div>
                <h3 class="text-2xl font-bold mb-2">Wisata</h3>
                <p class="text-gray-400 text-sm">Destinasi wisata menakjubkan di setiap provinsi</p>
            </div>
        </a>

        <!-- Kuliner Card -->
        <a href="{{ route('kuliner') }}" class="group relative bg-gradient-to-br from-pink-500/10 to-rose-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:scale-105 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-rose-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="text-5xl mb-4">🍜</div>
                <h3 class="text-2xl font-bold mb-2">Kuliner</h3>
                <p class="text-gray-400 text-sm">Cita rasa khas Nusantara yang menggugah selera</p>
            </div>
        </a>

        <!-- Peraturan Card -->
        <a href="{{ route('peraturan') }}" class="group relative bg-gradient-to-br from-rose-500/10 to-orange-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:scale-105 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-500/20 to-orange-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="text-5xl mb-4">📜</div>
                <h3 class="text-2xl font-bold mb-2">Peraturan</h3>
                <p class="text-gray-400 text-sm">Regulasi dan kebijakan daerah di Indonesia</p>
            </div>
        </a>
    </div>
</section>

<!-- Featured Provinces -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex items-center justify-between mb-12">
        <div>
            <h2 class="text-4xl font-bold mb-2">
                <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                    Provinsi Unggulan
                </span>
            </h2>
            <p class="text-gray-400 text-lg">Jelajahi provinsi-provinsi menarik</p>
        </div>
        <a href="{{ route('provinces') }}" class="hidden md:flex items-center space-x-2 px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-300 group">
            <span>Lihat Semua</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($featuredProvinces as $province)
        <a href="{{ route('province.detail', $province) }}" class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20">
            <div class="relative h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-purple-500/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                @if($province->image)
                    <img src="{{ asset($province->image) }}" alt="{{ $province->name }}" class="relative w-full h-full object-cover">
                @else
                    <div class="relative text-6xl">{{ $province->icon }}</div>
                @endif
            </div>
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-3 group-hover:text-indigo-400 transition-colors">{{ $province->name }}</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="flex items-center space-x-2 text-gray-400">
                        <span>🎭</span>
                        <span>{{ $province->tradisis_count }} Tradisi</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <span>🏖️</span>
                        <span>{{ $province->wisatas_count }} Wisata</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <span>🍜</span>
                        <span>{{ $province->kuliners_count }} Kuliner</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <span>📜</span>
                        <span>{{ $province->peraturans_count }} Peraturan</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="md:hidden mt-8 text-center">
        <a href="{{ route('provinces') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all duration-300">
            <span>Lihat Semua Provinsi</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </a>
    </div>
</section>

<!-- CTA Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="relative bg-gradient-to-r from-indigo-600/20 to-purple-600/20 backdrop-blur-xl border border-white/10 rounded-3xl p-12 md:p-16 text-center overflow-hidden">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-500/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-purple-500/30 rounded-full blur-3xl"></div>
        
        <div class="relative">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Ada pertanyaan tentang Indonesia?
            </h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Tanyakan apa saja kepada AI Assistant kami tentang provinsi, budaya, wisata, dan kuliner Indonesia
            </p>
            <a href="{{ route('chat') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-white text-indigo-600 rounded-xl hover:bg-gray-100 transition-all duration-300 font-semibold shadow-2xl hover:scale-105">
                <span>💬 Mulai Chat Sekarang</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Fetch stats and animate numbers
    async function fetchStats() {
        try {
            const response = await fetch('/api/provinces');
            const provinces = await response.json();
            
            let tradisiTotal = 0;
            let wisataTotal = 0;
            let kulinerTotal = 0;
            
            provinces.forEach(province => {
                tradisiTotal += province.tradisis_count || 0;
                wisataTotal += province.wisatas_count || 0;
                kulinerTotal += province.kuliners_count || 0;
            });
            
            animateNumber('tradisi-count', tradisiTotal);
            animateNumber('wisata-count', wisataTotal);
            animateNumber('kuliner-count', kulinerTotal);
        } catch (error) {
            console.error('Error fetching stats:', error);
        }
    }
    
    function animateNumber(id, target) {
        const element = document.getElementById(id);
        const duration = 2000;
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }
    
    // Load stats on page load
    document.addEventListener('DOMContentLoaded', fetchStats);
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }
    
    .animate-fade-in-delay-1 {
        animation: fade-in 0.8s ease-out 0.2s both;
    }
    
    .animate-fade-in-delay-2 {
        animation: fade-in 0.8s ease-out 0.4s both;
    }
    
    .delay-1000 {
        animation-delay: 1s;
    }
    
    .delay-2000 {
        animation-delay: 2s;
    }
</style>
@endpush
