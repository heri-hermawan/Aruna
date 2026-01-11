@extends('layouts.app')

@section('title', 'Generate Province Images')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold mb-8">
        <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
            Generate Province Images
        </span>
    </h1>

    <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
        <p class="text-gray-300 mb-6">
            Klik tombol di bawah untuk generate gambar untuk provinsi yang belum memiliki gambar.
            Proses ini akan memakan waktu beberapa menit.
        </p>

        <button onclick="generateImages()" id="generateBtn" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-500 hover:to-purple-500 transition-all">
            Generate Missing Images
        </button>

        <div id="progress" class="mt-6 hidden">
            <div class="bg-white/10 rounded-full h-4 overflow-hidden">
                <div id="progressBar" class="bg-gradient-to-r from-indigo-500 to-purple-500 h-full transition-all duration-300" style="width: 0%"></div>
            </div>
            <p id="status" class="text-gray-400 mt-2"></p>
        </div>

        <div id="results" class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
    </div>
</div>

<script>
const provinceIcons = {
    'Aceh': '🕌',
    'Bali': '🏯',
    'Banten': '🏰',
    'Bengk ulu': '🌺',
    'DI Yogyakarta': '⛩️',
    'DKI Jakarta': '🗼',
    'Gorontalo': '🏝️',
    'Jambi': '🛕',
    'Jawa Barat': '🏛️',
    'Jawa Tengah': '⛰️',
    'Jawa Timur': '🌋',
    'Kalimantan Barat': '🌍',
    'Kalimantan Selatan': '🛶',
    'Kalimantan Tengah': '🌴',
    'Kalimantan Timur': '🦧',
    'Kalimantan Utara': '🌲',
    'Kepulauan Bangka Belitung': '🏖️',
    'Kepulauan Riau': '⚓',
    'Lampung': '🐘',
    'Maluku': '🏝️',
    'Maluku Utara': '🦜',
    'Nusa Tenggara Barat': '🏔️',
    'Nusa Tenggara Timur': '🦎',
    'Papua': '🦅',
    'Papua Barat': '🐠',
    'Papua Barat Daya': '🌊',
    'Papua Pegunungan': '⛰️',
    'Papua Selatan': '🌿',
    'Papua Tengah': '🏞️',
    'Riau': '🛢️',
    'Sulawesi Barat': '☕',
    'Sulawesi Selatan': '⛵',
    'Sulawesi Tengah': '🦀',
    'Sulawesi Tenggara': '🏝️',
    'Sulawesi Utara': '🤿',
    'Sumatera Barat': '🕰️',
    'Sumatera Selatan': '🌉',
    'Sumatera Utara': '🏞️'
};

async function generateImages() {
    const btn = document.getElementById('generateBtn');
    const progress = document.getElementById('progress');
    const results = document.getElementById('results');
    
    btn.disabled = true;
    btn.textContent = 'Generating...';
    progress.classList.remove('hidden');
    
    try {
        const response = await fetch('/api/provinces');
        const provinces = await response.json();
        
        let completed = 0;
        const total = provinces.length;
        
        for (const province of provinces) {
            if (!province.image) {
                // Create placeholder card
                const card = document.createElement('div');
                card.className = 'bg-white/5 border border-white/10 rounded-lg p-4 text-center';
                card.innerHTML = `
                    <div class="text-4xl mb-2">${provinceIcons[province.name] || '🏝️'}</div>
                    <div class="text-sm text-gray-300">${province.name}</div>
                    <div class="text-xs text-gray-500 mt-1">No image yet</div>
                `;
                results.appendChild(card);
            }
            
            completed++;
            const percent = (completed / total) * 100;
            document.getElementById('progressBar').style.width = percent + '%';
            document.getElementById('status').textContent = `Processing ${completed}/${total} provinces...`;
        }
        
        btn.textContent = 'Completed!';
        document.getElementById('status').textContent = 'Done! Some provinces still need images to be uploaded manually.';
        
    } catch (error) {
        console.error('Error:', error);
        btn.textContent = 'Error occurred';
    }
}
</script>
@endsection
