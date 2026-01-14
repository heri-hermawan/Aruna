<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Wisata Terbaik - Aruna Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">🏝️ Rekomendasi Wisata Terbaik</h1>
            <p class="text-gray-600">Dihitung menggunakan metode SAW (Simple Additive Weighting)</p>
        </div>

        <!-- Filter Provinsi -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('recommendations.wisata') }}" class="flex gap-4 items-end">
                <div class="flex-1">
                    <label for="province_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Filter Berdasarkan Provinsi
                    </label>
                    <select name="province_id" id="province_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" 
                                    {{ $selectedProvince == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Filter
                </button>
                @if($selectedProvince)
                    <a href="{{ route('recommendations.wisata') }}" 
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Info Kriteria -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
            <h3 class="font-semibold text-blue-800 mb-2">Kriteria Penilaian:</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm text-blue-700">
                <div>✓ Daya Tarik (Bobot: 7)</div>
                <div>✓ Populer (Bobot: 7)</div>
                <div>✓ Harga (Bobot: 5)</div>
                <div>✓ Fasilitas (Bobot: 3)</div>
                <div>✓ Kebersihan (Bobot: 1)</div>
            </div>
        </div>

        <!-- Hasil Rekomendasi -->
        @if($wisatas->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 text-yellow-800">
                <p class="font-semibold">Tidak ada data wisata yang tersedia.</p>
                <p class="text-sm mt-1">Silakan tambahkan data wisata terlebih dahulu.</p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">Ranking</th>
                            <th class="px-6 py-4 text-left">Nama Wisata</th>
                            <th class="px-6 py-4 text-left">Provinsi</th>
                            <th class="px-6 py-4 text-center">Daya Tarik</th>
                            <th class="px-6 py-4 text-center">Populer</th>
                            <th class="px-6 py-4 text-center">Harga</th>
                            <th class="px-6 py-4 text-center">Fasilitas</th>
                            <th class="px-6 py-4 text-center">Kebersihan</th>
                            <th class="px-6 py-4 text-center">Score SAW</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($wisatas as $index => $wisata)
                            <tr class="hover:bg-gray-50 transition {{ $index < 3 ? 'bg-yellow-50' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($index === 0)
                                            <span class="text-2xl">🥇</span>
                                        @elseif($index === 1)
                                            <span class="text-2xl">🥈</span>
                                        @elseif($index === 2)
                                            <span class="text-2xl">🥉</span>
                                        @else
                                            <span class="font-semibold text-gray-600">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $wisata->name }}</div>
                                    @if($wisata->description)
                                        <div class="text-sm text-gray-500 mt-1">{{ Str::limit($wisata->description, 60) }}</div>
                                    @endif
                                    @if($wisata->address)
                                        <div class="text-xs text-gray-400 mt-1">📍 {{ Str::limit($wisata->address, 40) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $wisata->province->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $wisata->daya_tarik == 3 ? 'bg-green-100 text-green-800' : ($wisata->daya_tarik == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $wisata->daya_tarik == 3 ? 'Tinggi' : ($wisata->daya_tarik == 2 ? 'Sedang' : 'Rendah') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $wisata->populer == 3 ? 'bg-green-100 text-green-800' : ($wisata->populer == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $wisata->populer == 3 ? 'Tinggi' : ($wisata->populer == 2 ? 'Sedang' : 'Rendah') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $wisata->harga == 3 ? 'bg-green-100 text-green-800' : ($wisata->harga == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $wisata->harga == 3 ? 'Murah' : ($wisata->harga == 2 ? 'Sedang' : 'Mahal') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $wisata->fasilitas == 3 ? 'bg-green-100 text-green-800' : ($wisata->fasilitas == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $wisata->fasilitas == 3 ? 'Lengkap' : ($wisata->fasilitas == 2 ? 'Sedang' : 'Minim') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $wisata->kebersihan == 3 ? 'bg-green-100 text-green-800' : ($wisata->kebersihan == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $wisata->kebersihan == 3 ? 'Bersih' : ($wisata->kebersihan == 2 ? 'Sedang' : 'Kurang') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-lg font-bold text-blue-600">
                                        {{ number_format($wisata->score, 3) }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Informasi Total -->
            <div class="mt-4 text-sm text-gray-600">
                Total: <span class="font-semibold">{{ $wisatas->count() }}</span> wisata
                @if($selectedProvince)
                    di {{ $provinces->find($selectedProvince)->name }}
                @endif
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('recommendations.dashboard') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>