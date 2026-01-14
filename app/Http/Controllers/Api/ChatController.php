<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Province;
use App\Models\Tradisi;
use App\Models\Peraturan;
use App\Models\Wisata;
use App\Models\Kuliner;

class ChatController extends Controller
{
    /**
     * Handle chat message from user
     */
    public function chat(Request $request): JsonResponse
    {
        try {
            // Validate request
            $request->validate([
                'message' => 'required|string|max:2000'
            ]);

            $message = $request->input('message');
            
            // Generate AI-like response based on keywords
            $response = $this->generateResponse($message);
            
            return response()->json([
                'success' => true,
                'message' => $response,
                'user_message' => $message,
                'timestamp' => now()->toISOString()
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'error' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, saya tidak bisa memproses pertanyaan Anda saat ini.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate response based on user message
     */
    private function generateResponse(string $message): string
    {
        $message = strtolower($message);
        
        // Check for greeting
        if ($this->isGreeting($message)) {
            return $this->getGreeting();
        }
        
        // Check for thanks
        if ($this->isThanks($message)) {
            return "Sama-sama! Senang bisa membantu. Ada yang bisa saya bantu lagi? 😊";
        }
        
        // Check for recommendation queries
        if ($this->isRecommendationQuery($message)) {
            return $this->getRecommendations($message);
        }
        
        // Check for province-specific queries
        $provinces = Province::all();
        foreach ($provinces as $province) {
            if (str_contains($message, strtolower($province->name))) {
                return $this->getProvinceInfo($province, $message);
            }
        }
        
        // Check for category queries
        if (str_contains($message, 'tradisi') || str_contains($message, 'budaya') || str_contains($message, 'adat')) {
            return $this->getCategoryInfo('tradisi', $message);
        }
        
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat') || str_contains($message, 'destinasi') || str_contains($message, 'liburan')) {
            return $this->getCategoryInfo('wisata', $message);
        }
        
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan') || str_contains($message, 'masakan') || str_contains($message, 'makan')) {
            return $this->getCategoryInfo('kuliner', $message);
        }
        
        if (str_contains($message, 'peraturan') || str_contains($message, 'hukum') || str_contains($message, 'regulasi') || str_contains($message, 'aturan')) {
            return $this->getCategoryInfo('peraturan', $message);
        }
        
        // Check for help query
        if (str_contains($message, 'bantuan') || str_contains($message, 'help') || str_contains($message, 'bisa apa') || str_contains($message, 'fitur')) {
            return $this->getHelpInfo();
        }
        
        // Default response with suggestions
        return $this->getDefaultResponse();
    }

    /**
     * Check if message is a greeting
     */
    private function isGreeting(string $message): bool
    {
        $greetings = ['halo', 'hai', 'hello', 'hi', 'hey', 'selamat', 'pagi', 'siang', 'sore', 'malam'];
        foreach ($greetings as $greeting) {
            if (str_contains($message, $greeting)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if message is thanks
     */
    private function isThanks(string $message): bool
    {
        $thanks = ['terima kasih', 'thanks', 'makasih', 'thank you', 'thx'];
        foreach ($thanks as $thank) {
            if (str_contains($message, $thank)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if message is asking for recommendations
     */
    private function isRecommendationQuery(string $message): bool
    {
        $keywords = ['rekomendasi', 'rekomendasikan', 'saran', 'usul', 'terbaik', 'populer', 'favorit', 'top', 'bagus', 'menarik'];
        foreach ($keywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get greeting response
     */
    private function getGreeting(): string
    {
        return "Halo! 👋 Saya adalah Aruna AI Assistant, asisten virtual untuk informasi lengkap tentang Indonesia!\n\n" .
               "Saya bisa membantu Anda:\n" .
               "✨ Mencari rekomendasi wisata & kuliner terbaik\n" .
               "🏛️ Informasi tradisi dan budaya daerah\n" .
               "📜 Peraturan daerah di berbagai provinsi\n" .
               "🗺️ Eksplorasi 38 provinsi di Indonesia\n\n" .
               "Silakan tanyakan apa saja! Misalnya: 'Rekomendasikan wisata di Bali' atau 'Kuliner khas Jawa Barat'";
    }

    /**
     * Get help information
     */
    private function getHelpInfo(): string
    {
        return "Berikut yang bisa saya bantu:\n\n" .
               "🎯 **Rekomendasi**: 'Rekomendasikan wisata terbaik' atau 'Kuliner populer di Jakarta'\n" .
               "🗺️ **Info Provinsi**: 'Ceritakan tentang Bali' atau 'Wisata di Yogyakarta'\n" .
               "🎭 **Tradisi**: 'Tradisi di Sumatra Barat' atau 'Budaya Jawa'\n" .
               "🍜 **Kuliner**: 'Makanan khas Padang' atau 'Kuliner Malang'\n" .
               "🏖️ **Wisata**: 'Tempat wisata Lombok' atau 'Destinasi di Sulawesi'\n" .
               "📜 **Peraturan**: 'Peraturan daerah Jakarta'\n\n" .
               "Coba tanyakan sekarang! 😊";
    }

    /**
     * Get default response with suggestions
     */
    private function getDefaultResponse(): string
    {
        $totalProvinces = Province::count();
        $totalWisata = Wisata::count();
        $totalKuliner = Kuliner::count();
        
        return "Saya dapat membantu Anda mencari informasi tentang:\n\n" .
               "📍 {$totalProvinces} provinsi di Indonesia\n" .
               "🏖️ {$totalWisata}+ destinasi wisata menarik\n" .
               "🍜 {$totalKuliner}+ kuliner khas nusantara\n" .
               "🎭 Berbagai tradisi dan budaya daerah\n" .
               "📜 Peraturan daerah di seluruh Indonesia\n\n" .
               "**Contoh pertanyaan:**\n" .
               "• 'Rekomendasikan wisata terbaik di Indonesia'\n" .
               "• 'Kuliner khas Sumatra Utara'\n" .
               "• 'Tradisi budaya Bali'\n" .
               "• 'Ceritakan tentang Papua'\n\n" .
               "Silakan tanyakan apa yang ingin Anda ketahui! 😊";
    }

    /**
     * Get recommendations based on query
     */
    private function getRecommendations(string $message): string
    {
        // Check if asking for wisata recommendations
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat') || str_contains($message, 'destinasi')) {
            $wisatas = Wisata::with('province')->inRandomOrder()->take(5)->get();
            
            if ($wisatas->isEmpty()) {
                return "Maaf, saat ini belum ada data wisata yang tersedia.";
            }
            
            $response = "🏖️ **Rekomendasi Wisata Terbaik:**\n\n";
            foreach ($wisatas as $index => $wisata) {
                $number = $index + 1;
                $response .= "{$number}. **{$wisata->name}** ({$wisata->province->name})\n";
                if ($wisata->description) {
                    $desc = substr($wisata->description, 0, 100);
                    $response .= "   {$desc}...\n";
                }
                $response .= "\n";
            }
            $response .= "💡 Kunjungi halaman Rekomendasi untuk melihat lebih banyak pilihan dengan rating terbaik!";
            
            return $response;
        }
        
        // Check if asking for kuliner recommendations
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan') || str_contains($message, 'makan')) {
            $kuliners = Kuliner::with('province')->inRandomOrder()->take(5)->get();
            
            if ($kuliners->isEmpty()) {
                return "Maaf, saat ini belum ada data kuliner yang tersedia.";
            }
            
            $response = "🍜 **Rekomendasi Kuliner Terbaik:**\n\n";
            foreach ($kuliners as $index => $kuliner) {
                $number = $index + 1;
                $response .= "{$number}. **{$kuliner->name}** ({$kuliner->province->name})\n";
                if ($kuliner->description) {
                    $desc = substr($kuliner->description, 0, 100);
                    $response .= "   {$desc}...\n";
                }
                if ($kuliner->price) {
                    $response .= "   💰 Harga: Rp " . number_format($kuliner->price, 0, ',', '.') . "\n";
                }
                $response .= "\n";
            }
            $response .= "💡 Lihat halaman Rekomendasi untuk kuliner dengan rating dan popularitas tertinggi!";
            
            return $response;
        }
        
        // General recommendations
        return "Saya bisa memberikan rekomendasi untuk:\n\n" .
               "🏖️ **Wisata**: Destinasi wisata terbaik di seluruh Indonesia\n" .
               "🍜 **Kuliner**: Makanan khas daerah dengan rating tinggi\n\n" .
               "Coba tanyakan: 'Rekomendasikan wisata terbaik' atau 'Rekomendasikan kuliner populer'";
    }

    /**
     * Get province-specific information
     */
    private function getProvinceInfo(Province $province, string $message): string
    {
        $province->load(['tradisis', 'wisatas', 'kuliners', 'peraturans']);
        
        // Check for specific category in province query
        if (str_contains($message, 'tradisi') || str_contains($message, 'budaya') || str_contains($message, 'adat')) {
            $count = $province->tradisis->count();
            $items = $province->tradisis->take(3);
            $names = $items->pluck('name')->join(', ');
            
            return "🎭 **Tradisi & Budaya {$province->name}**\n\n" .
                   "Terdapat **{$count} tradisi** yang terdaftar di {$province->name}" .
                   ($names ? ", antara lain:\n• " . str_replace(', ', "\n• ", $names) : "") .
                   "\n\n💡 Kunjungi halaman provinsi {$province->name} untuk detail lengkap setiap tradisi!";
        }
        
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat') || str_contains($message, 'destinasi')) {
            $count = $province->wisatas->count();
            $items = $province->wisatas->take(3);
            $names = $items->pluck('name')->join(', ');
            
            return "🏖️ **Wisata di {$province->name}**\n\n" .
                   "Terdapat **{$count} destinasi wisata** menarik di {$province->name}" .
                   ($names ? ", seperti:\n• " . str_replace(', ', "\n• ", $names) : "") .
                   "\n\n💡 Lihat halaman Rekomendasi untuk wisata {$province->name} dengan rating terbaik!";
        }
        
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan') || str_contains($message, 'makan')) {
            $count = $province->kuliners->count();
            $items = $province->kuliners->take(3);
            $names = $items->pluck('name')->join(', ');
            
            return "🍜 **Kuliner Khas {$province->name}**\n\n" .
                   "{$province->name} memiliki **{$count} kuliner khas**" .
                   ($names ? ", termasuk:\n• " . str_replace(', ', "\n• ", $names) : "") .
                   "\n\n💡 Cek halaman provinsi untuk informasi detail harga dan lokasi!";
        }
        
        if (str_contains($message, 'peraturan') || str_contains($message, 'hukum') || str_contains($message, 'aturan')) {
            $count = $province->peraturans->count();
            
            return "📜 **Peraturan Daerah {$province->name}**\n\n" .
                   "Terdapat **{$count} peraturan daerah** yang tercatat di {$province->name}.\n\n" .
                   "💡 Kunjungi halaman Peraturan untuk melihat detail setiap regulasi!";
        }
        
        // General province info
        $tradisiCount = $province->tradisis->count();
        $wisataCount = $province->wisatas->count();
        $kulinerCount = $province->kuliners->count();
        $peraturanCount = $province->peraturans->count();
        
        return "📍 **Informasi {$province->name}**\n\n" .
               "{$province->name} memiliki:\n" .
               "🎭 {$tradisiCount} tradisi & budaya\n" .
               "🏖️ {$wisataCount} destinasi wisata\n" .
               "🍜 {$kulinerCount} kuliner khas\n" .
               "📜 {$peraturanCount} peraturan daerah\n\n" .
               "**Apa yang ingin Anda ketahui lebih lanjut?**\n" .
               "• Wisata di {$province->name}\n" .
               "• Kuliner khas {$province->name}\n" .
               "• Tradisi budaya {$province->name}\n" .
               "• Peraturan daerah {$province->name}";
    }

    /**
     * Get category information
     */
    private function getCategoryInfo(string $category, string $message): string
    {
        switch ($category) {
            case 'tradisi':
                $count = Tradisi::count();
                $recent = Tradisi::with('province')->latest()->take(3)->get();
                $items = $recent->map(fn($t) => "• {$t->name} ({$t->province->name})")->join("\n");
                
                return "🎭 **Tradisi & Budaya Nusantara**\n\n" .
                       "Kami memiliki **{$count} tradisi** dari berbagai provinsi di Indonesia.\n\n" .
                       "**Beberapa tradisi yang baru ditambahkan:**\n{$items}\n\n" .
                       "💡 Kunjungi halaman Tradisi untuk melihat koleksi lengkap budaya Indonesia!";
                
            case 'wisata':
                $count = Wisata::count();
                $recent = Wisata::with('province')->latest()->take(3)->get();
                $items = $recent->map(fn($w) => "• {$w->name} ({$w->province->name})")->join("\n");
                
                return "🏖️ **Destinasi Wisata Indonesia**\n\n" .
                       "Terdapat **{$count} destinasi wisata** menarik di seluruh Indonesia.\n\n" .
                       "**Wisata terbaru:**\n{$items}\n\n" .
                       "💡 Lihat halaman Rekomendasi untuk wisata dengan rating dan popularitas tertinggi!";
                
            case 'kuliner':
                $count = Kuliner::count();
                $recent = Kuliner::with('province')->latest()->take(3)->get();
                $items = $recent->map(fn($k) => "• {$k->name} ({$k->province->name})")->join("\n");
                
                return "🍜 **Kuliner Khas Indonesia**\n\n" .
                       "Indonesia kaya akan kuliner! Kami mencatat **{$count} makanan khas** nusantara.\n\n" .
                       "**Kuliner yang baru ditambahkan:**\n{$items}\n\n" .
                       "💡 Cek halaman Rekomendasi untuk kuliner dengan rating rasa terbaik!";
                
            case 'peraturan':
                $count = Peraturan::count();
                $provinces = Province::has('peraturans')->count();
                
                return "📜 **Peraturan Daerah Indonesia**\n\n" .
                       "Terdapat **{$count} peraturan daerah** dari **{$provinces} provinsi** di Indonesia.\n\n" .
                       "💡 Kunjungi halaman Peraturan untuk melihat detail regulasi setiap daerah!";
                
            default:
                return $this->getDefaultResponse();
        }
    }
}

//kkkk