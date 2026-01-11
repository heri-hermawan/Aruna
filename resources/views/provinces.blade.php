@extends('layouts.app')

@section('title', 'Daftar Provinsi')

@section('content')
<!-- Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-900/50 to-purple-900/50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                Provinsi Indonesia
            </span>
        </h1>
        <p class="text-xl text-gray-300 mb-8">Jelajahi 38 provinsi di seluruh Nusantara</p>
        
        <!-- Search Bar -->
        <form method="GET" action="{{ route('provinces') }}" class="max-w-2xl">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}"
                    placeholder="Cari provinsi..." 
                    class="w-full px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-500 hover:to-purple-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Provinces Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($provinces->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada provinsi ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kata kunci pencarian yang berbeda</p>
            <a href="{{ route('provinces') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Provinsi
            </a>
        </div>
    @else
        <div class="mb-6 text-gray-400">
            Menampilkan {{ $provinces->count() }} provinsi
            @if($search)
                untuk pencarian "{{ $search }}"
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($provinces as $province)
            <a href="{{ route('province.detail', $province) }}" class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20">
                <!-- Province Header -->
                <div class="relative h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-purple-500/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    @if($province->image)
                        <img src="{{ asset($province->image) }}" alt="{{ $province->name }}" class="relative w-full h-full object-cover">
                    @else
                        <div class="relative text-6xl">{{ $province->icon }}</div>
                    @endif
                </div>
                
                <!-- Province Info -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-indigo-400 transition-colors">
                        {{ $province->name }}
                    </h3>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="bg-white/5 rounded-lg p-3 border border-white/10">
                            <div class="flex items-center space-x-2 text-sm text-gray-400 mb-1">
                                <span>🎭</span>
                                <span>Tradisi</span>
                            </div>
                            <div class="text-2xl font-bold text-indigo-400">{{ $province->tradisis_count }}</div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 border border-white/10">
                            <div class="flex items-center space-x-2 text-sm text-gray-400 mb-1">
                                <span>🏖️</span>
                                <span>Wisata</span>
                            </div>
                            <div class="text-2xl font-bold text-purple-400">{{ $province->wisatas_count }}</div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 border border-white/10">
                            <div class="flex items-center space-x-2 text-sm text-gray-400 mb-1">
                                <span>🍜</span>
                                <span>Kuliner</span>
                            </div>
                            <div class="text-2xl font-bold text-pink-400">{{ $province->kuliners_count }}</div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 border border-white/10">
                            <div class="flex items-center space-x-2 text-sm text-gray-400 mb-1">
                                <span>📜</span>
                                <span>Peraturan</span>
                            </div>
                            <div class="text-2xl font-bold text-orange-400">{{ $province->peraturans_count }}</div>
                        </div>
                    </div>
                    
                    <!-- View Details Button -->
                    <div class="flex items-center justify-center space-x-2 text-indigo-400 group-hover:text-indigo-300 transition-colors">
                        <span class="font-medium">Lihat Detail</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</section>
@endsection
