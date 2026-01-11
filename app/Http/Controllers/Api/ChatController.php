<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Tradisi;
use App\Models\Peraturan;
use App\Models\Wisata;
use App\Models\Kuliner;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        
        // Simple AI-like response based on keywords
        $response = $this->generateResponse($message);
        
        return response()->json([
            'message' => $response,
            'timestamp' => now()->toISOString()
        ]);
    }

    private function generateResponse($message)
    {
        $message = strtolower($message);
        
        // Check for province-specific queries
        $provinces = Province::all();
        foreach ($provinces as $province) {
            if (str_contains($message, strtolower($province->name))) {
                return $this->getProvinceInfo($province, $message);
            }
        }
        
        // Check for category queries
        if (str_contains($message, 'tradisi') || str_contains($message, 'budaya') || str_contains($message, 'adat')) {
            return $this->getCategoryInfo('tradisi');
        }
        
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat') || str_contains($message, 'destinasi')) {
            return $this->getCategoryInfo('wisata');
        }
        
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan') || str_contains($message, 'masakan')) {
            return $this->getCategoryInfo('kuliner');
        }
        
        if (str_contains($message, 'peraturan') || str_contains($message, 'hukum') || str_contains($message, 'regulasi')) {
            return $this->getCategoryInfo('peraturan');
        }
        
        // Default greeting responses
        if (str_contains($message, 'halo') || str_contains($message, 'hai') || str_contains($message, 'hello')) {
            return "Halo! Saya adalah asisten virtual untuk informasi tentang provinsi-provinsi di Indonesia. Saya bisa membantu Anda mencari informasi tentang tradisi, wisata, kuliner, dan peraturan daerah. Silakan tanyakan apa saja!";
        }
        
        if (str_contains($message, 'terima kasih') || str_contains($message, 'thanks')) {
            return "Sama-sama! Senang bisa membantu. Ada yang bisa saya bantu lagi?";
        }
        
        // Default response
        return "Saya dapat membantu Anda mencari informasi tentang provinsi-provinsi di Indonesia, termasuk tradisi, wisata, kuliner, dan peraturan daerah. Coba tanyakan tentang provinsi tertentu atau kategori yang Anda minati!";
    }

    private function getProvinceInfo($province, $message)
    {
        $province->load(['tradisis', 'wisatas', 'kuliners', 'peraturans']);
        
        if (str_contains($message, 'tradisi') || str_contains($message, 'budaya')) {
            $count = $province->tradisis->count();
            $names = $province->tradisis->take(3)->pluck('name')->join(', ');
            return "Di {$province->name}, terdapat {$count} tradisi yang terdaftar" . ($names ? ", antara lain: {$names}" : "") . ". Anda bisa melihat detail lengkapnya di halaman provinsi.";
        }
        
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat')) {
            $count = $province->wisatas->count();
            $names = $province->wisatas->take(3)->pluck('name')->join(', ');
            return "Di {$province->name}, terdapat {$count} destinasi wisata" . ($names ? ", seperti: {$names}" : "") . ". Kunjungi halaman provinsi untuk informasi lebih lengkap.";
        }
        
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan')) {
            $count = $province->kuliners->count();
            $names = $province->kuliners->take(3)->pluck('name')->join(', ');
            return "{$province->name} memiliki {$count} kuliner khas" . ($names ? ", termasuk: {$names}" : "") . ". Lihat halaman provinsi untuk detail lebih lanjut.";
        }
        
        // General province info
        return "{$province->name} memiliki berbagai informasi menarik. Terdapat {$province->tradisis->count()} tradisi, {$province->wisatas->count()} destinasi wisata, {$province->kuliners->count()} kuliner khas, dan {$province->peraturans->count()} peraturan daerah. Apa yang ingin Anda ketahui lebih lanjut?";
    }

    private function getCategoryInfo($category)
    {
        switch ($category) {
            case 'tradisi':
                $count = Tradisi::count();
                $recent = Tradisi::with('province')->latest()->take(3)->get();
                $names = $recent->map(fn($t) => "{$t->name} ({$t->province->name})")->join(', ');
                return "Kami memiliki {$count} tradisi dari berbagai provinsi di Indonesia" . ($names ? ", beberapa di antaranya: {$names}" : "") . ". Kunjungi halaman Tradisi untuk melihat semua koleksi kami!";
                
            case 'wisata':
                $count = Wisata::count();
                $recent = Wisata::with('province')->latest()->take(3)->get();
                $names = $recent->map(fn($w) => "{$w->name} ({$w->province->name})")->join(', ');
                return "Terdapat {$count} destinasi wisata menarik di seluruh Indonesia" . ($names ? ", seperti: {$names}" : "") . ". Lihat halaman Wisata untuk eksplorasi lebih lanjut!";
                
            case 'kuliner':
                $count = Kuliner::count();
                $recent = Kuliner::with('province')->latest()->take(3)->get();
                $names = $recent->map(fn($k) => "{$k->name} ({$k->province->name})")->join(', ');
                return "Indonesia kaya akan kuliner! Kami mencatat {$count} makanan khas" . ($names ? ", termasuk: {$names}" : "") . ". Cek halaman Kuliner untuk lebih banyak pilihan!";
                
            case 'peraturan':
                $count = Peraturan::count();
                return "Terdapat {$count} peraturan daerah dari berbagai provinsi di Indonesia. Kunjungi halaman Peraturan untuk melihat detailnya.";
                
            default:
                return "Silakan tanyakan tentang provinsi tertentu atau kategori yang Anda minati.";
        }
    }
}
