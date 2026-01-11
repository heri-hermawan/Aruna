@extends('layouts.app')

@section('title', 'Kuliner Nusantara')

@section('content')
<!-- Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-pink-900/50 to-rose-900/50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            <span class="text-6xl mr-3">🍜</span>
            <span class="bg-gradient-to-r from-pink-400 to-rose-400 bg-clip-text text-transparent">
                Kuliner Nusantara
            </span>
        </h1>
        <p class="text-xl text-gray-300 mb-8">Cita rasa khas Nusantara yang menggugah selera</p>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('kuliner') }}" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}"
                placeholder="Cari kuliner..." 
                class="flex-1 px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500"
            >
            <select name="province" class="px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-pink-500">
                <option value="">Semua Provinsi</option>
                @foreach($provinces as $prov)
                    <option value="{{ $prov->id }}" {{ $provinceId == $prov->id ? 'selected' : '' }} class="bg-slate-900">
                        {{ $prov->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-pink-600 to-rose-600 rounded-xl hover:from-pink-500 hover:to-rose-500 transition-all font-medium whitespace-nowrap">
                🔍 Cari
            </button>
        </form>
    </div>
</section>

<!-- Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($kuliners->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">🍜</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada kuliner ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kata kunci pencarian yang berbeda atau pilih provinsi lain</p>
            <a href="{{ route('kuliner') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Kuliner
            </a>
        </div>
    @else
        <div class="mb-6 text-gray-400">
            Menampilkan {{ $kuliners->count() }} dari {{ $kuliners->total() }} kuliner
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($kuliners as $kuliner)
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-pink-500/20">
                @if($kuliner->image)
                    <div class="h-48 bg-gradient-to-br from-pink-500/20 to-rose-500/20 overflow-hidden">
                        <img src="{{ asset($kuliner->image) }}" alt="{{ $kuliner->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-pink-500/20 to-rose-500/20 flex items-center justify-center">
                        <span class="text-6xl">🍜</span>
                    </div>
                @endif
                <div class="p-6">
                    <a href="{{ route('province.detail', $kuliner->province) }}" class="inline-block px-3 py-1 bg-pink-500/20 text-pink-300 rounded-lg text-xs font-medium mb-3 hover:bg-pink-500/30 transition-colors">
                        {{ $kuliner->province->name }}
                    </a>
                    <h4 class="text-xl font-bold mb-3">{{ $kuliner->name }}</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $kuliner->description }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $kuliners->links() }}
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
