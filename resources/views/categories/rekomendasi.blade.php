@extends('layouts.app')

@section('title', 'Rekomendasi Terbaik')

@section('content')
<!-- Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-900/50 to-purple-900/50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">
                    <span class="text-6xl mr-3">⭐</span>
                    <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        Rekomendasi Terbaik
                    </span>
                </h1>
                <p class="text-xl text-gray-300 mb-8">50 Wisata dan 50 Kuliner terbaik pilihan kami berdasarkan rating dan popularitas</p>
            </div>
        </div>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('rekomendasi') }}" id="filterForm" class="flex flex-col md:flex-row gap-4 mt-6">
            <select name="type" id="typeSelect" class="px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="wisata" {{ $type == 'wisata' ? 'selected' : '' }} class="bg-slate-900">🏖️ Rekomendasi Wisata</option>
                <option value="kuliner" {{ $type == 'kuliner' ? 'selected' : '' }} class="bg-slate-900">🍜 Rekomendasi Kuliner</option>
                <option value="all" {{ $type == 'all' ? 'selected' : '' }} class="bg-slate-900">✨ Wisata & Kuliner</option>
            </select>
            <button type="submit" id="refreshBtn" class="px-8 py-4 bg-gradient-to-r from-pink-600 to-rose-600 rounded-xl hover:from-pink-500 hover:to-rose-500 transition-all font-medium whitespace-nowrap flex items-center gap-2">
                <span id="refreshIcon">🔄</span>
                <span>Refresh</span>
            </button>
        </form>
    </div>
</section>

<!-- Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($recommendations->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">⭐</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada rekomendasi ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kategori atau provinsi yang berbeda</p>
            <a href="{{ route('rekomendasi') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Rekomendasi
            </a>
        </div>
    @else
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="text-gray-400">
                    Menampilkan {{ $recommendations->count() }} rekomendasi terbaik 
                    @if($type == 'all')
                    untuk Wisata & Kuliner
                    @elseif($type == 'kuliner')
                    untuk Kuliner
                    @else
                    untuk Wisata
                    @endif
                </div>
                <div class="text-sm text-gray-500">
                    Diurutkan berdasarkan skor SAW (Simple Additive Weighting)
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8" id="recommendationsGrid">
            @foreach($recommendations as $index => $item)
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20 group">
                <!-- Ranking Badge -->
                <div class="absolute top-3 left-3 z-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full w-10 h-10 flex items-center justify-center font-bold text-lg">
                    #{{ $index + 1 }}
                </div>

                <!-- SAW Score Badge -->
                <div class="absolute top-3 right-3 z-10 bg-black/50 backdrop-blur-xl rounded-full px-3 py-1 flex items-center gap-1">
                    <span class="text-yellow-400">⭐</span>
                    <span class="font-bold">{{ isset($item['saw_score']) ? number_format($item['saw_score'], 1) : '0.0' }}</span>
                </div>

                @if($item['image'])
                    <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 overflow-hidden relative">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                        <span class="text-6xl">{{ isset($item['type']) && $item['type'] == 'kuliner' || isset($item['rasa']) ? '🍜' : '🏖️' }}</span>
                    </div>
                @endif
                
                <div class="p-6">
                    @if(isset($item['province']))
                        <a href="{{ route('province.detail', $item['province']['id']) }}" class="inline-block px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-lg text-xs font-medium mb-3 hover:bg-indigo-500/30 transition-colors">
                            {{ $item['province']['name'] }}
                        </a>
                    @endif
                    
                    <h4 class="text-lg font-bold mb-2 line-clamp-2">{{ $item['name'] }}</h4>
                    
                    <p class="text-xs text-gray-400 mb-4 line-clamp-2">{{ $item['description'] ?? 'Tidak ada deskripsi' }}</p>

                    <!-- Criteria Display -->
                    <div class="bg-white/5 rounded-lg p-3 mb-4 text-xs space-y-1">
                        @if(isset($item['rasa']))
                            {{-- Kuliner --}}
                            <div class="flex justify-between">
                                <span class="text-gray-400">Rasa:</span>
                                <span class="font-semibold">{{ $item['rasa'] ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Populer:</span>
                                <span class="font-semibold">{{ $item['populer'] ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Gizi:</span>
                                <span class="font-semibold">{{ $item['gizi'] ?? '-' }}/10</span>
                            </div>
                        @else
                            {{-- Wisata --}}
                            <div class="flex justify-between">
                                <span class="text-gray-400">Daya Tarik:</span>
                                <span class="font-semibold">{{ $item['daya_tarik'] ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Populer:</span>
                                <span class="font-semibold">{{ $item['populer'] ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Fasilitas:</span>
                                <span class="font-semibold">{{ $item['fasilitas'] ?? '-' }}/10</span>
                            </div>
                        @endif
                        @if($item['price'])
                            <div class="flex justify-between pt-1 border-t border-white/10">
                                <span class="text-gray-400">Harga:</span>
                                <span class="font-semibold text-green-400">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('province.detail', $item['province']['id'] ?? '#') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-500 hover:to-purple-500 transition-all text-center font-medium text-xs">
                        Lihat Provinsi
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

<script>
document.getElementById('refreshBtn').addEventListener('click', async function() {
    const refreshIcon = document.getElementById('refreshIcon');
    refreshIcon.style.animation = 'spin 1s linear infinite';
    
    const type = document.querySelector('select[name="type"]').value;
    let endpoint = '/api/recommendations/random-wisata';

<!-- Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($recommendations->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">⭐</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada rekomendasi ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kategori atau provinsi yang berbeda</p>
            <a href="{{ route('rekomendasi') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Rekomendasi
            </a>
        </div>
    @else
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="text-gray-400">
                    Menampilkan {{ $recommendations->count() }} rekomendasi terbaik 
                    @if($type == 'all')
                    untuk Wisata & Kuliner
                    @elseif($type == 'kuliner')
                    untuk Kuliner
                    @else
                    untuk Wisata
                    @endif
                </div>
                <div class="text-sm text-gray-500">
                    Diurutkan berdasarkan skor SAW (Simple Additive Weighting)
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8" id="recommendationsGrid">
            @foreach($recommendations as $index => $item)
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20 group">
                <!-- Ranking Badge -->
                <div class="absolute top-3 left-3 z-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full w-10 h-10 flex items-center justify-center font-bold text-lg">
                    #{{ $index + 1 }}
                </div>

                <!-- SAW Score Badge -->
                <div class="absolute top-3 right-3 z-10 bg-black/50 backdrop-blur-xl rounded-full px-3 py-1 flex items-center gap-1">
                    <span class="text-yellow-400">⭐</span>
                    <span class="font-bold">{{ isset($item->saw_score) ? number_format($item->saw_score, 1) : '0.0' }}</span>
                </div>

                @if($item->image)
                    <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 overflow-hidden relative">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                        <span class="text-6xl">{{ isset($item->rasa) ? '🍜' : '🏖️' }}</span>
                    </div>
                @endif
                
                <div class="p-6">
                    @if($item->province)
                        <a href="{{ route('province.detail', $item->province->id) }}" class="inline-block px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-lg text-xs font-medium mb-3 hover:bg-indigo-500/30 transition-colors">
                            {{ $item->province->name }}
                        </a>
                    @endif
                    
                    <h4 class="text-lg font-bold mb-2 line-clamp-2">{{ $item->name }}</h4>
                    
                    <p class="text-xs text-gray-400 mb-4 line-clamp-2">{{ $item->description ?? 'Tidak ada deskripsi' }}</p>

                    <!-- Criteria Display -->
                    <div class="bg-white/5 rounded-lg p-3 mb-4 text-xs space-y-1">
                        @if(isset($item->rasa))
                            {{-- Kuliner --}}
                            <div class="flex justify-between">
                                <span class="text-gray-400">Rasa:</span>
                                <span class="font-semibold">{{ $item->rasa ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Populer:</span>
                                <span class="font-semibold">{{ $item->populer ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Gizi:</span>
                                <span class="font-semibold">{{ $item->gizi ?? '-' }}/10</span>
                            </div>
                        @else
                            {{-- Wisata --}}
                            <div class="flex justify-between">
                                <span class="text-gray-400">Daya Tarik:</span>
                                <span class="font-semibold">{{ $item->daya_tarik ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Populer:</span>
                                <span class="font-semibold">{{ $item->populer ?? '-' }}/10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Fasilitas:</span>
                                <span class="font-semibold">{{ $item->fasilitas ?? '-' }}/10</span>
                            </div>
                        @endif
                        @if($item->price)
                            <div class="flex justify-between pt-1 border-t border-white/10">
                                <span class="text-gray-400">Harga:</span>
                                <span class="font-semibold text-green-400">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('province.detail', $item->province->id ?? '#') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-500 hover:to-purple-500 transition-all text-center font-medium text-xs">
                        Lihat Provinsi
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const refreshBtn = document.getElementById('refreshBtn');
    if (!refreshBtn) {
        console.error('Refresh button not found');
        return;
    }
    
    refreshBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const refreshIcon = document.getElementById('refreshIcon');
        if (refreshIcon) {
            refreshIcon.style.animation = 'spin 0.6s linear infinite';
        }
        
        const typeSelect = document.querySelector('select[name="type"]');
        const type = typeSelect ? typeSelect.value : 'wisata';
        
        // Navigate to refresh page dengan type filter
        window.location.href = `{{ route('rekomendasi') }}?type=${type}&_=${Date.now()}`;
    });
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
