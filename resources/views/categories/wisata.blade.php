@extends('layouts.app')

@section('title', 'Wisata Nusantara')

@section('content')
<!-- Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-purple-900/50 to-pink-900/50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            <span class="text-6xl mr-3">🏖️</span>
            <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                Wisata Nusantara
            </span>
        </h1>
        <p class="text-xl text-gray-300 mb-8">Destinasi wisata menakjubkan di seluruh Indonesia</p>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('wisata') }}" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}"
                placeholder="Cari destinasi wisata..." 
                class="flex-1 px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500"
            >
            <select name="province" class="px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">Semua Provinsi</option>
                @foreach($provinces as $prov)
                    <option value="{{ $prov->id }}" {{ $provinceId == $prov->id ? 'selected' : '' }} class="bg-slate-900">
                        {{ $prov->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl hover:from-purple-500 hover:to-pink-500 transition-all font-medium whitespace-nowrap">
                🔍 Cari
            </button>
        </form>
    </div>
</section>

<!-- Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($wisatas->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">🏖️</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada wisata ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kata kunci pencarian yang berbeda atau pilih provinsi lain</p>
            <a href="{{ route('wisata') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Wisata
            </a>
        </div>
    @else
        <div class="mb-6 text-gray-400">
            Menampilkan {{ $wisatas->count() }} dari {{ $wisatas->total() }} destinasi wisata
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($wisatas as $wisata)
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/20">
                @if($wisata->image)
                    <div class="h-48 bg-gradient-to-br from-purple-500/20 to-pink-500/20 overflow-hidden">
                        <img src="{{ asset($wisata->image) }}" alt="{{ $wisata->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-purple-500/20 to-pink-500/20 flex items-center justify-center">
                        <span class="text-6xl">🏖️</span>
                    </div>
                @endif
                <div class="p-6">
                    <a href="{{ route('province.detail', $wisata->province) }}" class="inline-block px-3 py-1 bg-purple-500/20 text-purple-300 rounded-lg text-xs font-medium mb-3 hover:bg-purple-500/30 transition-colors">
                        {{ $wisata->province->name }}
                    </a>
                    <h4 class="text-xl font-bold mb-2">{{ $wisata->name }}</h4>
                    @if($wisata->address)
                        <p class="text-sm text-gray-500 mb-2 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $wisata->address }}</span>
                        </p>
                    @endif
                    {{-- Star Rating --}}
                    <div class="flex items-center gap-1 mb-3">
                        @php
                            // Generate random rating between 4.0 and 5.0 for now
                            $rating = round(rand(40, 50) / 10, 1);
                            $fullStars = floor($rating);
                            $hasHalfStar = ($rating - $fullStars) >= 0.5;
                        @endphp
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $fullStars)
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="#FFD700">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @elseif($i == $fullStars && $hasHalfStar)
                                <svg class="w-5 h-5" viewBox="0 0 20 20">
                                    <defs>
                                        <linearGradient id="half-{{ $wisata->id }}">
                                            <stop offset="50%" stop-color="#FFD700"/>
                                            <stop offset="50%" stop-color="transparent"/>
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#half-{{ $wisata->id }})" d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    <path fill="none" stroke="#FFD700" stroke-width="1.5" d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="#4B5563" stroke-width="1.5">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-sm text-gray-400 ml-2">{{ $rating }}</span>
                    </div>
                    <p class="text-gray-400 text-sm line-clamp-3">{{ $wisata->description }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $wisatas->links() }}
        </div>
    @endif
</section>
@endsection

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
