@extends('layouts.app')

@section('title', 'Sistem Rekomendasi SAW')

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-20">
    <!-- Header -->
    <header class="relative py-16 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-600/20 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tight">
                <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Smart Recommendation
                </span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Metode Simple Additive Weighting (SAW) untuk membantu Anda menentukan pilihan terbaik secara objektif.
            </p>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4">
        <!-- Stepper -->
        <div class="flex justify-between items-center mb-12 relative">
            <div class="absolute inset-x-0 top-1/2 h-0.5 bg-white/10 -translate-y-1/2"></div>
            @foreach(['Lokasi', 'Alternatif & Bobot', 'Hasil'] as $i => $step)
            <div class="relative z-10 flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-500 {{ $showStage >= $i ? 'bg-indigo-600 shadow-lg shadow-indigo-500/50 scale-110' : 'bg-slate-800 text-gray-500' }}">
                    {{ $i + 1 }}
                </div>
                <span class="mt-2 text-xs font-semibold {{ $showStage >= $i ? 'text-indigo-400' : 'text-gray-500' }}">{{
                    $step }}</span>
            </div>
            @endforeach
        </div>

        <!-- Forms -->
        <div
            class="bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/5 rounded-full blur-3xl -mr-32 -mt-32"></div>

            @if($showStage == 0)
            <!-- STAGE 0: Select Type & Province -->
            <form action="{{ route('rekomendasi') }}" method="GET" class="space-y-10 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="block text-xl font-bold text-indigo-300">1. Mau cari apa?</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" name="type" value="wisata" class="hidden peer" {{ $type=='wisata'
                                    ? 'checked' : '' }}>
                                <div
                                    class="p-6 rounded-2xl border-2 border-white/5 bg-white/5 peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 hover:bg-white/10 hover:border-white/20 active:scale-95 transition-all text-center">
                                    <span
                                        class="text-4xl block mb-2 group-hover:scale-110 transition-transform">🏖️</span>
                                    <span class="font-bold">Wisata</span>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="type" value="kuliner" class="hidden peer" {{ $type=='kuliner'
                                    ? 'checked' : '' }}>
                                <div
                                    class="p-6 rounded-2xl border-2 border-white/5 bg-white/5 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 hover:bg-white/10 hover:border-white/20 active:scale-95 transition-all text-center">
                                    <span
                                        class="text-4xl block mb-2 group-hover:scale-110 transition-transform">🍜</span>
                                    <span class="font-bold">Kuliner</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xl font-bold text-indigo-300">2. Di Provinsi mana?</label>
                        <div class="relative">
                            <select name="province" required id="provinceSelect"
                                class="w-full bg-slate-900 border-2 border-white/10 rounded-2xl p-4 text-white focus:outline-none focus:border-indigo-500 transition-all appearance-none cursor-pointer hover:bg-white/5">
                                <option value="" disabled selected class="text-gray-500">Pilih Provinsi...</option>
                                @foreach($provinces as $p)
                                <option value="{{ $p->id }}" class="text-white bg-slate-900">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-6">
                    <button type="submit"
                        class="px-12 py-4 bg-indigo-600 hover:bg-indigo-500 active:scale-95 rounded-2xl font-bold text-lg transition-all shadow-xl shadow-indigo-500/25 flex items-center gap-3 group">
                        Lanjutkan <span class="text-xl group-hover:translate-x-1 transition-transform">➔</span>
                    </button>
                </div>
            </form>

            @elseif($showStage == 1)
            <!-- STAGE 1: Item Selection & Weights -->
            <form action="{{ route('rekomendasi') }}" method="GET" class="space-y-12 relative z-10">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="province" value="{{ $provinceId }}">

                <!-- Item Selection -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <label class="text-2xl font-black text-indigo-400">Pilih Alternatif</label>
                            <p class="text-gray-500 text-sm italic">Saran: Pilih 2-5 item utama Anda.</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="itemsGrid">
                        @foreach($availableItems as $item)
                        <label class="relative cursor-pointer group">
                            <input type="checkbox" name="items[]" value="{{ $item->id }}"
                                class="hidden peer item-checkbox">
                            <div
                                class="h-full border-2 border-white/10 rounded-2xl bg-white/5 overflow-hidden peer-checked:border-indigo-500 peer-checked:bg-indigo-500/20 group-hover:border-white/30 group-hover:scale-105 active:scale-100 transition-all duration-300 shadow-lg group-hover:shadow-indigo-500/20">
                                @if($item->image)
                                <img src="{{ asset($item->image) }}"
                                    class="w-full h-24 object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700">
                                @else
                                <div
                                    class="w-full h-24 bg-slate-800 flex items-center justify-center text-4xl opacity-20 group-hover:opacity-40 transition-opacity">
                                    {{ $type == 'wisata' ? '🏖️' : '🍜' }}
                                </div>
                                @endif
                                <div class="p-4 bg-slate-900/80 backdrop-blur-sm relative z-10">
                                    <span class="text-sm font-bold block truncate">{{ $item->name }}</span>
                                </div>
                            </div>
                            <!-- Selected Badge -->
                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-indigo-600 items-center justify-center hidden peer-checked:flex shadow-xl z-20 border-2 border-slate-950 animate-in zoom-in duration-300">
                                <span class="text-xs text-white">✓</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Weight Inputs -->
                <div class="space-y-8 pt-8 border-t border-white/10">
                    <div class="flex flex-col">
                        <label class="text-2xl font-black text-indigo-400">Tentukan Bobot Kepentingan</label>
                        <p class="text-gray-500 text-sm">Skala 1 (Rendah) sampai 3 (Tinggi)</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        @if($type == 'wisata')
                        @php
                        $wFields = [
                        'w_daya_tarik' => ['Daya Tarik', 3],
                        'w_populer' => ['Popularitas', 3],
                        'w_harga' => ['Harga (Rendah lebih baik)', 2],
                        'w_fasilitas' => ['Fasilitas', 2],
                        'w_kebersihan' => ['Kebersihan', 1]
                        ];
                        @endphp
                        @foreach($wFields as $key => $f)
                        <div
                            class="space-y-3 group/slider bg-white/5 p-4 rounded-2xl border border-transparent hover:border-white/10 transition-all">
                            <div class="flex justify-between">
                                <label
                                    class="text-sm font-bold text-gray-400 group-hover/slider:text-gray-300 transition-colors">{{
                                    $f[0] }}</label>
                                <span id="{{ $key }}_val"
                                    class="font-black text-indigo-400 text-lg group-hover/slider:scale-125 transition-transform inline-block">{{
                                    $f[1] }}</span>
                            </div>
                            <input type="range" name="{{ $key }}" min="1" max="3" step="1" value="{{ $f[1] }}"
                                oninput="document.getElementById('{{ $key }}_val').innerText = this.value"
                                class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-indigo-500 hover:accent-indigo-400 transition-all">
                        </div>
                        @endforeach
                        @else
                        @php
                        $kFields = [
                        'w_rasa' => ['Rasa', 3],
                        'w_populer' => ['Popularitas', 3],
                        'w_gizi' => ['Kandungan Gizi', 2],
                        'w_biaya' => ['Biaya (Rendah lebih baik)', 2],
                        'w_porsi' => ['Porsi', 1]
                        ];
                        @endphp
                        @foreach($kFields as $key => $f)
                        <div
                            class="space-y-3 group/slider bg-white/5 p-4 rounded-2xl border border-transparent hover:border-white/10 transition-all">
                            <div class="flex justify-between">
                                <label
                                    class="text-sm font-bold text-gray-400 group-hover/slider:text-gray-300 transition-colors">{{
                                    $f[0] }}</label>
                                <span id="{{ $key }}_val"
                                    class="font-black text-orange-400 text-lg group-hover/slider:scale-125 transition-transform inline-block">{{
                                    $f[1] }}</span>
                            </div>
                            <input type="range" name="{{ $key }}" min="1" max="3" step="1" value="{{ $f[1] }}"
                                oninput="document.getElementById('{{ $key }}_val').innerText = this.value"
                                class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-orange-500 hover:accent-orange-400 transition-all">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="flex justify-between items-center pt-10 border-t border-white/5">
                    <a href="{{ route('rekomendasi') }}"
                        class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group/back">
                        <span class="group-hover:-translate-x-1 transition-transform">⇠</span> Kembali
                    </a>
                    <button type="submit"
                        class="px-12 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 active:scale-95 rounded-2xl font-black text-xl hover:scale-105 transition-all shadow-2xl shadow-indigo-500/40 group">
                        Hitung SAW <span class="group-hover:translate-x-1 transition-transform inline-block">🚀</span>
                    </button>
                </div>
            </form>

            @elseif($showStage == 2)
            <!-- STAGE 2: Results -->
            <div class="space-y-12 relative z-10">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-white">Ranking Hasil SAW</h2>
                        <p class="text-gray-400">Peringkat ini menggunakan bobot:
                            @foreach($inputWeights as $k => $v)
                            <span
                                class="inline-block px-2 py-0.5 bg-white/10 rounded text-[10px] text-indigo-300 lowercase mr-1">{{
                                str_replace('w_', '', $k) }}:{{ $v }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('rekomendasi', ['province' => $provinceId, 'type' => $type]) }}"
                            class="px-6 py-3 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 active:scale-95 transition-all font-bold">
                            Ubah Parameter
                        </a>
                        <button onclick="window.print()"
                            class="px-6 py-3 bg-indigo-600 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:bg-indigo-500 active:scale-95 transition-all">
                            Cetak Laporan
                        </button>
                    </div>
                </div>

                <!-- CALCULATION TABLE (Excel Style) -->
                <div class="bg-slate-950/80 border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
                    <div class="p-6 bg-white/5 border-b border-white/10">
                        <h3 class="font-black text-indigo-400 flex items-center gap-2">
                            <span>📊</span> Perhitungan Nilai Vektor V (Hasil SAW)
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-white/10 bg-white/5">
                                    <th class="p-4 text-xs font-black text-gray-500 uppercase">Label</th>
                                    <th class="p-4 text-xs font-black text-gray-500 uppercase">Alternatif</th>
                                    <th class="p-4 text-xs font-black text-gray-500 uppercase text-right">Nilai Vektor V
                                        (Skor Akhir)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recommendations as $item)
                                <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                                    <td class="p-4">
                                        <span class="px-3 py-1 bg-indigo-600 rounded font-black text-xs">{{
                                            $item->vector_label }}</span>
                                    </td>
                                    <td class="p-4 font-bold text-gray-300">{{ $item->name }}</td>
                                    <td class="p-4 text-right">
                                        <span class="text-xl font-black text-indigo-400">{{
                                            number_format($item->saw_score, 3) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- CARDS DISPLAY -->
                <div class="grid grid-cols-1 gap-6">
                    @foreach($recommendations as $index => $item)
                    <div
                        class="relative group bg-white/5 rounded-3xl border border-white/10 overflow-hidden hover:border-indigo-500/50 hover:bg-white/[0.07] hover:scale-[1.01] transition-all duration-500">
                        <div
                            class="absolute top-0 left-0 w-2 h-full {{ $index == 0 ? 'bg-yellow-400 shadow-[2px_0_15px_rgba(250,204,21,0.5)]' : ($index == 1 ? 'bg-slate-300' : ($index == 2 ? 'bg-orange-400' : 'bg-indigo-600')) }}">
                        </div>

                        <div class="flex flex-col md:flex-row items-center p-6 gap-8">
                            <!-- Rank & Label -->
                            <div
                                class="flex flex-col items-center group-hover:scale-110 transition-transform duration-500">
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">{{
                                    $item->vector_label }}</span>
                                <span
                                    class="text-5xl font-black {{ $index == 0 ? 'text-yellow-400 drop-shadow-lg' : 'text-white' }}">#{{
                                    $index + 1 }}</span>
                            </div>

                            <!-- Image -->
                            <div
                                class="w-32 h-32 rounded-2xl overflow-hidden border-2 border-white/10 flex-shrink-0 group-hover:rotate-3 transition-transform duration-500 shadow-xl group-hover:shadow-indigo-500/20">
                                @if($item->image)
                                <img src="{{ asset($item->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                <div class="w-full h-full bg-slate-800 flex items-center justify-center text-4xl">
                                    {{ $type == 'wisata' ? '🏖️' : '🍜' }}
                                </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="flex-grow space-y-2">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-2xl font-black group-hover:text-indigo-300 transition-colors">{{
                                        $item->name }}</h3>
                                    @if($index == 0)
                                    <span
                                        class="px-3 py-1 bg-yellow-400/20 text-yellow-400 text-[10px] font-black rounded-full border border-yellow-400/30 uppercase tracking-wider animate-pulse">Pilihan
                                        Terbaik</span>
                                    @endif
                                </div>
                                <p class="text-gray-400 text-sm line-clamp-2 md:line-clamp-none">{{ $item->description
                                    ?? 'Deskripsi belum tersedia.' }}</p>

                                <div class="flex flex-wrap gap-4 pt-4">
                                    @foreach($item->criteria_values as $key => $val)
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-gray-500 uppercase font-black">{{ $key }}</span>
                                        <div class="flex gap-0.5 mt-0.5">
                                            @for($i=1; $i<=3; $i++) <div
                                                class="w-3 h-1 rounded-full {{ $i <= $val ? ($type == 'wisata' ? 'bg-indigo-500' : 'bg-orange-500') : 'bg-white/10' }}">
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Score -->
                        <div
                            class="text-center md:text-right md:border-l md:border-white/10 md:pl-8 group-hover:border-indigo-500/30 transition-colors">
                            <span class="text-xs font-bold text-gray-500 uppercase block mb-1">Vector V (Skor)</span>
                            <span
                                class="text-4xl font-black text-indigo-400 group-hover:text-indigo-300 transition-colors">{{
                                number_format($item->saw_score, 3) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
</div>

<script>
    @if ($showStage == 1)
        window.scrollTo({ top: 300, behavior: 'smooth' });
    @endif
</script>

<style>
    /* Styling range inputs */
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: currentColor;
        cursor: pointer;
        border: 4px solid #0f172a;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    #provinceSelect option {
        background-color: #0f172a;
        color: white;
    }

    /* Print styles */
    @media print {
        .bg-slate-950 {
            background: white !important;
        }

        .text-white {
            color: black !important;
        }

        .bg-slate-900\/50,
        .bg-slate-950\/80 {
            background: white !important;
            border: 1px solid #ddd !important;
        }

        .bg-white\/5 {
            display: none !important;
        }

        header,
        .absolute,
        .transition-all,
        button,
        a {
            display: none !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    }
</style>
@endsection