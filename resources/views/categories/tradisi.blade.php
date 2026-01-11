@extends('layouts.app')

@section('title', 'Tradisi Nusantara')

@section('content')
<!-- Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-900/50 to-purple-900/50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            <span class="text-6xl mr-3">🎭</span>
            <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                Tradisi Nusantara
            </span>
        </h1>
        <p class="text-xl text-gray-300 mb-8">Warisan budaya dan adat istiadat dari seluruh Indonesia</p>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('tradisi') }}" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}"
                placeholder="Cari tradisi..." 
                class="flex-1 px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            <select name="province" class="px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Provinsi</option>
                @foreach($provinces as $prov)
                    <option value="{{ $prov->id }}" {{ $provinceId == $prov->id ? 'selected' : '' }} class="bg-slate-900">
                        {{ $prov->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all font-medium whitespace-nowrap">
                🔍 Cari
            </button>
        </form>
    </div>
</section>

<!-- Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($tradisis->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">🎭</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada tradisi ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kata kunci pencarian yang berbeda atau pilih provinsi lain</p>
            <a href="{{ route('tradisi') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Tradisi
            </a>
        </div>
    @else
        <div class="mb-6 text-gray-400">
            Menampilkan {{ $tradisis->count() }} dari {{ $tradisis->total() }} tradisi
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($tradisis as $tradisi)
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20">
                @if($tradisi->image)
                    <div class="h-48 relative">
                        <img src="{{ asset($tradisi->image) }}" alt="{{ $tradisi->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                        <span class="text-6xl">🎭</span>
                    </div>
                @endif
                <div class="p-6">
                    <a href="{{ route('province.detail', $tradisi->province) }}" class="inline-block px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-lg text-xs font-medium mb-3 hover:bg-indigo-500/30 transition-colors">
                        {{ $tradisi->province->name }}
                    </a>
                    <h4 class="text-xl font-bold mb-3">{{ $tradisi->name }}</h4>
                    <p class="text-gray-400 text-sm line-clamp-3">{{ $tradisi->description }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $tradisis->links() }}
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
