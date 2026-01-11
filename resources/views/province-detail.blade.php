@extends('layouts.app')

@section('title', $province->name)

@section('content')
<!-- Province Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-900/50 to-purple-900/50 border-b border-white/10">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 right-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="absolute top-20 -left-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-6">
            <a href="{{ route('provinces') }}" class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Kembali ke Daftar Provinsi</span>
            </a>
        </div>
        
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        {{ $province->name }}
                    </span>
                </h1>
                <p class="text-xl text-gray-300">Jelajahi kekayaan budaya dan wisata</p>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
                <div class="flex items-center space-x-2 text-gray-400 mb-2">
                    <span class="text-2xl">🎭</span>
                    <span class="text-sm">Tradisi</span>
                </div>
                <div class="text-3xl font-bold text-indigo-400">{{ $province->tradisis->count() }}</div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
                <div class="flex items-center space-x-2 text-gray-400 mb-2">
                    <span class="text-2xl">🏖️</span>
                    <span class="text-sm">Wisata</span>
                </div>
                <div class="text-3xl font-bold text-purple-400">{{ $province->wisatas->count() }}</div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
                <div class="flex items-center space-x-2 text-gray-400 mb-2">
                    <span class="text-2xl">🍜</span>
                    <span class="text-sm">Kuliner</span>
                </div>
                <div class="text-3xl font-bold text-pink-400">{{ $province->kuliners->count() }}</div>
            </div>
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl p-4">
                <div class="flex items-center space-x-2 text-gray-400 mb-2">
                    <span class="text-2xl">📜</span>
                    <span class="text-sm">Peraturan</span>
                </div>
                <div class="text-3xl font-bold text-orange-400">{{ $province->peraturans->count() }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Tabs -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Tab Navigation -->
    <div class="flex overflow-x-auto space-x-2 mb-8 pb-2">
        <button onclick="changeTab('tradisi')" id="tab-tradisi" class="tab-button active px-6 py-3 rounded-xl font-medium whitespace-nowrap transition-all duration-300">
            🎭 Tradisi
        </button>
        <button onclick="changeTab('wisata')" id="tab-wisata" class="tab-button px-6 py-3 rounded-xl font-medium whitespace-nowrap transition-all duration-300">
            🏖️ Wisata
        </button>
        <button onclick="changeTab('kuliner')" id="tab-kuliner" class="tab-button px-6 py-3 rounded-xl font-medium whitespace-nowrap transition-all duration-300">
            🍜 Kuliner
        </button>
        <button onclick="changeTab('peraturan')" id="tab-peraturan" class="tab-button px-6 py-3 rounded-xl font-medium whitespace-nowrap transition-all duration-300">
            📜 Peraturan
        </button>
    </div>

    <!-- Tab Content -->
    
    <!-- Tradisi Tab -->
    <div id="content-tradisi" class="tab-content active">
        @if($province->tradisis->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="text-6xl mb-4">🎭</div>
                <h3 class="text-2xl font-bold mb-2">Belum ada data tradisi</h3>
                <p class="text-gray-400">Data tradisi untuk provinsi ini akan segera ditambahkan</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($province->tradisis as $tradisi)
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20">
                    @if($tradisi->image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset($tradisi->image) }}" alt="{{ $tradisi->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                            <span class="text-6xl">🎭</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-3">{{ $tradisi->name }}</h4>
                        <p class="text-gray-400 text-sm line-clamp-3">{{ $tradisi->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Wisata Tab -->
    <div id="content-wisata" class="tab-content hidden">
        @if($province->wisatas->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="text-6xl mb-4">🏖️</div>
                <h3 class="text-2xl font-bold mb-2">Belum ada data wisata</h3>
                <p class="text-gray-400">Data wisata untuk provinsi ini akan segera ditambahkan</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($province->wisatas as $wisata)
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
                                            <linearGradient id="half-detail-{{ $wisata->id }}">
                                                <stop offset="50%" stop-color="#FFD700"/>
                                                <stop offset="50%" stop-color="transparent"/>
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#half-detail-{{ $wisata->id }})" d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
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
        @endif
    </div>

    <!-- Kuliner Tab -->
    <div id="content-kuliner" class="tab-content hidden">
        @if($province->kuliners->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="text-6xl mb-4">🍜</div>
                <h3 class="text-2xl font-bold mb-2">Belum ada data kuliner</h3>
                <p class="text-gray-400">Data kuliner untuk provinsi ini akan segera ditambahkan</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($province->kuliners as $kuliner)
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
                        <h4 class="text-xl font-bold mb-3">{{ $kuliner->name }}</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">{{ $kuliner->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Peraturan Tab -->
    <div id="content-peraturan" class="tab-content hidden">
        @if($province->peraturans->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="text-6xl mb-4">📜</div>
                <h3 class="text-2xl font-bold mb-2">Belum ada data peraturan</h3>
                <p class="text-gray-400">Data peraturan untuk provinsi ini akan segera ditambahkan</p>
            </div>
        @else
            <!-- Peraturan Adat -->
            @php $adatPeraturans = $province->peraturans->where('type', 'adat'); @endphp
            @if($adatPeraturans->isNotEmpty())
                <div class="mb-8">
                    <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <span class="p-2 bg-emerald-500/20 rounded-lg text-xl">🤝</span>
                        <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Peraturan Adat</span>
                    </h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach($adatPeraturans as $peraturan)
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/20">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-lg flex items-center justify-center text-2xl">
                                    🤝
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold mb-2">{{ $peraturan->name }}</h4>
                                    <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $peraturan->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Peraturan Wilayah -->
            @php $wilayahPeraturans = $province->peraturans->where('type', 'wilayah'); @endphp
            @if($wilayahPeraturans->isNotEmpty())
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                    <span class="p-2 bg-cyan-500/20 rounded-lg text-xl">🗺️</span>
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">Peraturan Wilayah (Perda)</span>
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($wilayahPeraturans as $peraturan)
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-cyan-500/20">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center text-2xl">
                                🗺️
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold mb-2">{{ $peraturan->name }}</h4>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $peraturan->description }}</p>
                                @if($peraturan->document)
                                    <a href="{{ asset('storage/' . $peraturan->document) }}" target="_blank" class="inline-flex items-center space-x-2 text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span>Unduh Perda</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    function changeTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('active');
        });
        
        // Remove active class from all tab buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });
        
        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');
        document.getElementById('content-' + tabName).classList.add('active');
        
        // Add active class to selected tab button
        document.getElementById('tab-' + tabName).classList.add('active');
    }
</script>

<style>
    .tab-button {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.6);
    }
    
    .tab-button.active {
        background: linear-gradient(to right, rgb(99, 102, 241), rgb(168, 85, 247));
        border-color: transparent;
        color: white;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
    }
    
    .tab-button:hover:not(.active) {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.9);
    }
    
    .tab-content {
        animation: fadeIn 0.3s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
