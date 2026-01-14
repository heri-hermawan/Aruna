<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Rekomendasi - Aruna Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">🇮🇩 ARUNA NUSANTARA</h1>
            <p class="text-xl text-gray-600">Sistem Rekomendasi Wisata & Kuliner Terbaik Indonesia</p>
            <p class="text-sm text-gray-500 mt-2">Menggunakan Metode SAW (Simple Additive Weighting)</p>
        </div>

        <!-- Menu Cards -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Kuliner Card -->
            <a href="{{ route('recommendations.kuliner') }}" 
               class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all transform hover:-translate-y-2 border-t-4 border-orange-500">
                <div class="text-6xl mb-4 text-center">🍜</div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Kuliner Terbaik</h2>
                <p class="text-gray-600 text-center mb-6">
                    Temukan kuliner terbaik dari 38 provinsi di Indonesia berdasarkan rasa, popularitas, gizi, biaya, dan porsi
                </p>
                <div class="flex justify-center">
                    <span class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                        Lihat Rekomendasi →
                    </span>
                </div>
            </a>

            <!-- Wisata Card -->
            <a href="{{ route('recommendations.wisata') }}" 
               class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all transform hover:-translate-y-2 border-t-4 border-blue-500">
                <div class="text-6xl mb-4 text-center">🏝️</div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Wisata Terbaik</h2>
                <p class="text-gray-600 text-center mb-6">
                    Jelajahi destinasi wisata terbaik berdasarkan daya tarik, popularitas, harga, fasilitas, dan kebersihan
                </p>
                <div class="flex justify-center">
                    <span class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                        Lihat Rekomendasi →
                    </span>
                </div>
            </a>
        </div>

        <!-- Top 5 Preview Section -->
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <!-- Top 5 Kuliner -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">🏆 Top 5 Kuliner</h3>
                    <a href="{{ route('recommendations.kuliner') }}" 
                       class="text-orange-500 hover:text-orange-600 text-sm font-semibold">
                        Lihat Semua →
                    </a>
                </div>
                @if($topKuliners->isEmpty())
                    <p class="text-gray-500 text-center py-8">Belum ada data kuliner</p>
                @else
                    <div class="space-y-3">
                        @foreach($topKuliners as $index => $kuliner)
                            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
                                <div class="text-2xl">
                                    @if($index === 0) 🥇
                                    @elseif($index === 1) 🥈
                                    @elseif($index === 2) 🥉
                                    @else {{ $index + 1 }}
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">{{ $kuliner->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $kuliner->province->name ?? '-' }}</div>
                                </div>
                                <div class="text-lg font-bold text-orange-600">
                                    {{ number_format($kuliner->score, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Top 5 Wisata -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">🏆 Top 5 Wisata</h3>
                    <a href="{{ route('recommendations.wisata') }}" 
                       class="text-blue-500 hover:text-blue-600 text-sm font-semibold">
                        Lihat Semua →
                    </a>
                </div>
                @if($topWisatas->isEmpty())
                    <p class="text-gray-500 text-center py-8">Belum ada data wisata</p>
                @else
                    <div class="space-y-3">
                        @foreach($topWisatas as $index => $wisata)
                            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
                                <div class="text-2xl">
                                    @if($index === 0) 🥇
                                    @elseif($index === 1) 🥈
                                    @elseif($index === 2) 🥉
                                    @else {{ $index + 1 }}
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">{{ $wisata->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $wisata->province->name ?? '-' }}</div>
                                </div>
                                <div class="text-lg font-bold text-blue-600">
                                    {{ number_format($wisata->score, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Info SAW Method -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">ℹ️ Tentang Metode SAW</h3>
            <div class="space-y-3 text-gray-700">
                <p>
                    <strong>SAW (Simple Additive Weighting)</strong> adalah metode penjumlahan terbobot yang digunakan 
                    untuk menentukan alternatif terbaik dari sejumlah alternatif berdasarkan kriteria tertentu.
                </p>
                <p class="text-sm">
                    <strong>Langkah-langkah:</strong>
                </p>
                <ol class="list-decimal list-inside text-sm space-y-1 ml-4">
                    <li>Menentukan kriteria dan bobot masing-masing kriteria</li>
                    <li>Memberikan nilai rating kecocokan untuk setiap alternatif</li>
                    <li>Normalisasi matriks keputusan (benefit & cost)</li>
                    <li>Menghitung nilai preferensi untuk setiap alternatif</li>
                    <li>Meranking alternatif berdasarkan nilai preferensi tertinggi</li>
                </ol>
            </div>
        </div>

        <!-- 38 Provinsi Info -->
        <div class="bg-gradient-to-r from-green-500 to-blue-500 rounded-2xl shadow-lg p-8 text-white text-center">
            <h3 class="text-3xl font-bold mb-4">🗺️ Cakupan Seluruh Indonesia</h3>
            <p class="text-xl mb-2">Data dari <span class="font-bold text-4xl">38 Provinsi</span></p>
            <p class="text-sm opacity-90">Menjelajahi kekayaan kuliner dan wisata Nusantara</p>
        </div>
    </div>
</body>
</html>