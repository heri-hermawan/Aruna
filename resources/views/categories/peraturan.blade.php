@extends('layouts.app')

@section('title', 'Peraturan Daerah')

@section('content')
<!-- Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-rose-900/50 to-orange-900/50 border-b border-white/10">
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            <span class="text-6xl mr-3">📜</span>
            <span class="bg-gradient-to-r from-rose-400 to-orange-400 bg-clip-text text-transparent">
                Peraturan Daerah
            </span>
        </h1>
        <p class="text-xl text-gray-300 mb-8">Regulasi dan kebijakan daerah di Indonesia</p>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('peraturan') }}" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}"
                placeholder="Cari peraturan..." 
                class="flex-1 px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
            <select name="province" class="px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                <option value="">Semua Provinsi</option>
                @foreach($provinces as $prov)
                    <option value="{{ $prov->id }}" {{ $provinceId == $prov->id ? 'selected' : '' }} class="bg-slate-900">
                        {{ $prov->name }}
                    </option>
                @endforeach
            </select>
            <select name="type" class="px-6 py-4 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                <option value="">Semua Kategori</option>
                <option value="adat" {{ $type == 'adat' ? 'selected' : '' }} class="bg-slate-900">🤝 Hukum Adat</option>
                <option value="wilayah" {{ $type == 'wilayah' ? 'selected' : '' }} class="bg-slate-900">🗺️ Peraturan Wilayah</option>
            </select>
            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-rose-600 to-orange-600 rounded-xl hover:from-rose-500 hover:to-orange-500 transition-all font-medium whitespace-nowrap">
                🔍 Cari
            </button>
        </form>

        <!-- Guidance Section -->
        <div class="mt-20 mb-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-rose-500/10 border border-rose-500/20 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center space-x-3 mb-3">
                    <span class="text-3xl">🏛️</span>
                    <h3 class="text-rose-300 font-bold">Pemerintah</h3>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Regulasi resmi yang dikeluarkan oleh Pemerintah Daerah (Perda) atau Pusat untuk mengatur tatanan sipil dan birokrasi.
                </p>
            </div>
            <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center space-x-3 mb-3">
                    <span class="text-3xl">🤝</span>
                    <h3 class="text-emerald-300 font-bold">Hukum Adat</h3>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Aturan tidak tertulis maupun tertulis yang diwariskan secara turun-temurun oleh masyarakat adat untuk menjaga harmoni sosial.
                </p>
            </div>
            <div class="p-6 bg-cyan-500/10 border border-cyan-500/20 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center space-x-3 mb-3">
                    <span class="text-3xl">🗺️</span>
                    <h3 class="text-cyan-300 font-bold">Wilayah</h3>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Ketentuan teknis mengenai tata ruang, zonasi laut, perbatasan, dan pemanfaatan sumber daya alam di area tertentu.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($provincesWithPeraturans->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">📜</div>
            <h3 class="text-2xl font-bold mb-2">Tidak ada peraturan ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kata kunci pencarian yang berbeda atau pilih provinsi lain</p>
            <a href="{{ route('peraturan') }}" class="inline-block px-6 py-3 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-all">
                Lihat Semua Peraturan
            </a>
        </div>
    @else
        <div class="mb-6 text-gray-400">
            Menampilkan peraturan dalam {{ $provincesWithPeraturans->count() }} provinsi
        </div>

        <div class="space-y-6 mb-8 px-2">
            @foreach($provincesWithPeraturans as $province)
            <div class="accordion-item bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition-all duration-500 shadow-[0_8px_30px_rgb(0,0,0,0.5)] hover:shadow-[0_20px_50px_rgba(225,29,72,0.15)] hover:-translate-y-1">
                <!-- Accordion Header -->
                <button onclick="toggleAccordion('prov-{{ $province->id }}')" class="w-full px-10 py-8 flex items-center justify-between hover:bg-white/5 transition-colors group">
                    <div class="flex items-center space-x-8">
                        <div class="w-16 h-16 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center justify-center text-4xl group-hover:scale-110 transition-transform shadow-inner">
                            <span class="text-emerald-400 group-hover:drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">⚖️</span>
                        </div>
                        <h3 class="text-3xl font-bold text-white group-hover:text-emerald-400 transition-colors tracking-tight">{{ $province->name }}</h3>
                    </div>
                    <svg id="icon-prov-{{ $province->id }}" class="w-6 h-6 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Accordion Content -->
                <div id="content-prov-{{ $province->id }}" class="hidden overflow-hidden bg-black/20 border-t border-white/5">
                    <div class="p-6">
                        @php 
                            $adatList = $province->peraturans->where('type', 'adat');
                            $wilayahList = $province->peraturans->where('type', 'wilayah');
                        @endphp

                        @if($adatList->isNotEmpty())
                            <div class="mb-8">
                                <h4 class="text-sm font-bold text-emerald-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                    Peraturan Adat
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($adatList as $p)
                                    <div class="p-5 bg-white/5 border border-white/10 rounded-xl hover:border-emerald-500/30 transition-colors">
                                        <h5 class="font-bold text-white mb-2">{{ $p->name }}</h5>
                                        <p class="text-sm text-gray-400 leading-relaxed">{{ $p->description }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($wilayahList->isNotEmpty())
                            <div>
                                <h4 class="text-sm font-bold text-cyan-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-cyan-500 rounded-full animate-pulse"></span>
                                    Peraturan Wilayah (Perda)
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($wilayahList as $p)
                                    <div class="p-5 bg-white/5 border border-white/10 rounded-xl hover:border-cyan-500/30 transition-colors">
                                        <h5 class="font-bold text-white mb-2">{{ $p->name }}</h5>
                                        <p class="text-sm text-gray-400 leading-relaxed mb-4">{{ $p->description }}</p>
                                        @if($p->document)
                                            <a href="{{ asset('storage/' . $p->document) }}" target="_blank" class="inline-flex items-center space-x-2 text-xs text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <span>Unduh Perda</span>
                                            </a>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

<script>
    function toggleAccordion(id) {
        const content = document.getElementById('content-' + id);
        const icon = document.getElementById('icon-' + id);
        
        // Close others
        document.querySelectorAll('[id^="content-prov-"]').forEach(el => {
            if (el.id !== 'content-' + id) {
                el.classList.add('hidden');
                const otherId = el.id.replace('content-', '');
                document.getElementById('icon-' + otherId).classList.remove('rotate-180');
            }
        });

        // Toggle current
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
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
