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
            $aiResponse = $this->generateResponse($message);
            
            // Response format yang compatible dengan Flutter app
            return response()->json([
                'success' => true,
                'message' => 'Chat response generated successfully',
                'data' => [
                    'user_message' => $message,
                    'ai_response' => $aiResponse,
                    'timestamp' => now()->toISOString()
                ]
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
                'message' => 'Gagal memproses pesan chat',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate response based on user message
     */
    private function generateResponse(string $message): string
    {
        $messageLower = strtolower($message);
        $messageClean = trim($messageLower);
        
        // Check for greeting
        if ($this->isGreeting($messageClean)) {
            return $this->getGreeting();
        }
        
        // Check for thanks
        if ($this->isThanks($messageClean)) {
            return "Sama-sama! Senang bisa membantu. Ada yang bisa saya bantu lagi? 😊";
        }
        
        // Check for inappropriate content first
        if ($this->isInappropriateContent($messageClean)) {
            return "Maaf, saya hanya bisa membantu dengan informasi tentang wisata, kuliner, tradisi, dan peraturan daerah di Indonesia. 🙏\n\n" .
                   "Silakan tanyakan hal-hal seperti:\n" .
                   "• Rekomendasi wisata atau kuliner\n" .
                   "• Informasi provinsi tertentu\n" .
                   "• Tradisi dan budaya daerah\n" .
                   "• Peraturan daerah";
        }
        
        // Check for recommendation queries
        if ($this->isRecommendationQuery($messageClean)) {
            return $this->getRecommendations($messageClean);
        }
        
        // Check for province-specific queries
        $provinces = Province::all();
        foreach ($provinces as $province) {
            $provinceLower = strtolower($province->name);
            if (str_contains($messageClean, $provinceLower)) {
                return $this->getProvinceInfo($province, $messageClean);
            }
        }
        
        // Check for category queries
        if (str_contains($messageClean, 'tradisi') || str_contains($messageClean, 'budaya') || str_contains($messageClean, 'adat')) {
            return $this->getCategoryInfo('tradisi', $messageClean);
        }
        
        if (str_contains($messageClean, 'wisata') || str_contains($messageClean, 'tempat') || str_contains($messageClean, 'destinasi') || str_contains($messageClean, 'liburan')) {
            return $this->getCategoryInfo('wisata', $messageClean);
        }
        
        if (str_contains($messageClean, 'kuliner') || str_contains($messageClean, 'makanan') || str_contains($messageClean, 'masakan') || str_contains($messageClean, 'makan')) {
            return $this->getCategoryInfo('kuliner', $messageClean);
        }
        
        if (str_contains($messageClean, 'peraturan') || str_contains($messageClean, 'hukum') || str_contains($messageClean, 'regulasi') || str_contains($messageClean, 'aturan')) {
            return $this->getCategoryInfo('peraturan', $messageClean);
        }
        
        // Check for help query
        if (str_contains($messageClean, 'bantuan') || str_contains($messageClean, 'help') || str_contains($messageClean, 'bisa apa') || str_contains($messageClean, 'fitur')) {
            return $this->getHelpInfo();
        }
        
        // Default response with suggestions
        return $this->getDefaultResponse();
    }

    /**
     * Check if message contains inappropriate content
     */
    private function isInappropriateContent(string $message): bool
    {
        $inappropriateWords = [
            'peler', 'kontol', 'memek', 'anjing', 'bangsat', 
            'tolol', 'bodoh', 'goblok', 'idiot', 'fuck'
        ];
        
        foreach ($inappropriateWords as $word) {
            if (str_contains($message, $word)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if message is a greeting
     */
    private function isGreeting(string $message): bool
    {
        $greetings = ['halo', 'hai', 'hello', 'hi', 'hey', 'selamat', 'pagi', 'siang', 'sore', 'malam', 'hola', 'hy'];
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
        $thanks = ['terima kasih', 'thanks', 'makasih', 'thank you', 'thx', 'tengkyu'];
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
        $keywords = ['rekomendasi', 'rekomendasikan', 'saran', 'usul', 'terbaik', 'populer', 'favorit', 'top', 'bagus', 'menarik', 'recommended'];
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
               "Silakan tanyakan apa saja! Misalnya:\n" .
               "• 'Rekomendasikan wisata di Bali'\n" .
               "• 'Kuliner khas Jawa Barat'\n" .
               "• 'Tradisi budaya Sumatra'";
    }

    /**
     * Get help information
     */
    private function getHelpInfo(): string
    {
        return "Berikut yang bisa saya bantu:\n\n" .
               "🎯 Rekomendasi:\n" .
               "   'Rekomendasikan wisata terbaik'\n" .
               "   'Kuliner populer di Jakarta'\n\n" .
               "🗺️ Info Provinsi:\n" .
               "   'Ceritakan tentang Bali'\n" .
               "   'Wisata di Yogyakarta'\n\n" .
               "🎭 Tradisi:\n" .
               "   'Tradisi di Sumatra Barat'\n" .
               "   'Budaya Jawa'\n\n" .
               "🍜 Kuliner:\n" .
               "   'Makanan khas Padang'\n" .
               "   'Kuliner Malang'\n\n" .
               "🏖️ Wisata:\n" .
               "   'Tempat wisata Lombok'\n" .
               "   'Destinasi di Sulawesi'\n\n" .
               "📜 Peraturan:\n" .
               "   'Peraturan daerah Jakarta'\n\n" .
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
        
        return "Hmm, saya kurang memahami pertanyaan Anda. 🤔\n\n" .
               "Saya dapat membantu Anda mencari informasi tentang:\n\n" .
               "📍 {$totalProvinces} provinsi di Indonesia\n" .
               "🏖️ {$totalWisata}+ destinasi wisata menarik\n" .
               "🍜 {$totalKuliner}+ kuliner khas nusantara\n" .
               "🎭 Berbagai tradisi dan budaya daerah\n" .
               "📜 Peraturan daerah di seluruh Indonesia\n\n" .
               "Contoh pertanyaan yang bisa Anda tanyakan:\n" .
               "• 'Rekomendasikan wisata terbaik'\n" .
               "• 'Kuliner khas Sumatra Utara'\n" .
               "• 'Tradisi budaya Bali'\n" .
               "• 'Ceritakan tentang Papua'\n\n" .
               "Silakan coba lagi dengan pertanyaan yang lebih spesifik! 😊";
    }

    /**
     * Get recommendations based on query
     */
    private function getRecommendations(string $message): string
    {
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat') || str_contains($message, 'destinasi')) {
            $wisatas = Wisata::with('province')->inRandomOrder()->take(5)->get();
            
            if ($wisatas->isEmpty()) {
                return "Maaf, saat ini belum ada data wisata yang tersedia.";
            }
            
            $response = "🏖️ Rekomendasi Wisata Terbaik:\n\n";
            foreach ($wisatas as $index => $wisata) {
                $number = $index + 1;
                $response .= "{$number}. {$wisata->name}\n";
                $response .= "   📍 {$wisata->province->name}\n";
                if ($wisata->description) {
                    $desc = substr($wisata->description, 0, 80);
                    $response .= "   {$desc}...\n";
                }
                $response .= "\n";
            }
            $response .= "💡 Kunjungi halaman Rekomendasi untuk melihat lebih banyak pilihan dengan rating terbaik!";
            
            return $response;
        }
        
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan') || str_contains($message, 'makan')) {
            $kuliners = Kuliner::with('province')->inRandomOrder()->take(5)->get();
            
            if ($kuliners->isEmpty()) {
                return "Maaf, saat ini belum ada data kuliner yang tersedia.";
            }
            
            $response = "🍜 Rekomendasi Kuliner Terbaik:\n\n";
            foreach ($kuliners as $index => $kuliner) {
                $number = $index + 1;
                $response .= "{$number}. {$kuliner->name}\n";
                $response .= "   📍 {$kuliner->province->name}\n";
                if ($kuliner->description) {
                    $desc = substr($kuliner->description, 0, 80);
                    $response .= "   {$desc}...\n";
                }
                if ($kuliner->price) {
                    $response .= "   💰 Rp " . number_format($kuliner->price, 0, ',', '.') . "\n";
                }
                $response .= "\n";
            }
            $response .= "💡 Lihat halaman Rekomendasi untuk kuliner dengan rating dan popularitas tertinggi!";
            
            return $response;
        }
        
        return "Saya bisa memberikan rekomendasi untuk:\n\n" .
               "🏖️ Wisata: Destinasi wisata terbaik di seluruh Indonesia\n" .
               "🍜 Kuliner: Makanan khas daerah dengan rating tinggi\n\n" .
               "Coba tanyakan:\n" .
               "• 'Rekomendasikan wisata terbaik'\n" .
               "• 'Rekomendasikan kuliner populer'";
    }

    /**
     * Get province-specific information
     */
    private function getProvinceInfo(Province $province, string $message): string
    {
        $province->load(['tradisis', 'wisatas', 'kuliners', 'peraturans']);
        
        if (str_contains($message, 'tradisi') || str_contains($message, 'budaya') || str_contains($message, 'adat')) {
            $count = $province->tradisis->count();
            $items = $province->tradisis->take(3);
            
            $response = "🎭 Tradisi & Budaya {$province->name}\n\n";
            $response .= "Terdapat {$count} tradisi yang terdaftar di {$province->name}";
            
            if ($items->isNotEmpty()) {
                $response .= ", antara lain:\n\n";
                foreach ($items as $item) {
                    $response .= "• {$item->name}\n";
                }
            }
            
            $response .= "\n💡 Kunjungi halaman provinsi {$province->name} untuk detail lengkap setiap tradisi!";
            return $response;
        }
        
        if (str_contains($message, 'wisata') || str_contains($message, 'tempat') || str_contains($message, 'destinasi')) {
            $count = $province->wisatas->count();
            $items = $province->wisatas->take(3);
            
            $response = "🏖️ Wisata di {$province->name}\n\n";
            $response .= "Terdapat {$count} destinasi wisata menarik";
            
            if ($items->isNotEmpty()) {
                $response .= ", seperti:\n\n";
                foreach ($items as $item) {
                    $response .= "• {$item->name}\n";
                }
            }
            
            $response .= "\n💡 Lihat halaman Rekomendasi untuk wisata {$province->name} dengan rating terbaik!";
            return $response;
        }
        
        if (str_contains($message, 'kuliner') || str_contains($message, 'makanan') || str_contains($message, 'makan')) {
            $count = $province->kuliners->count();
            $items = $province->kuliners->take(3);
            
            $response = "🍜 Kuliner Khas {$province->name}\n\n";
            $response .= "{$province->name} memiliki {$count} kuliner khas";
            
            if ($items->isNotEmpty()) {
                $response .= ", termasuk:\n\n";
                foreach ($items as $item) {
                    $response .= "• {$item->name}\n";
                }
            }
            
            $response .= "\n💡 Cek halaman provinsi untuk informasi detail harga dan lokasi!";
            return $response;
        }
        
        if (str_contains($message, 'peraturan') || str_contains($message, 'hukum') || str_contains($message, 'aturan')) {
            $count = $province->peraturans->count();
            
            return "📜 Peraturan Daerah {$province->name}\n\n" .
                   "Terdapat {$count} peraturan daerah yang tercatat di {$province->name}.\n\n" .
                   "💡 Kunjungi halaman Peraturan untuk melihat detail setiap regulasi!";
        }
        
        $tradisiCount = $province->tradisis->count();
        $wisataCount = $province->wisatas->count();
        $kulinerCount = $province->kuliners->count();
        $peraturanCount = $province->peraturans->count();
        
        return "📍 Informasi {$province->name}\n\n" .
               "{$province->name} memiliki:\n" .
               "🎭 {$tradisiCount} tradisi & budaya\n" .
               "🏖️ {$wisataCount} destinasi wisata\n" .
               "🍜 {$kulinerCount} kuliner khas\n" .
               "📜 {$peraturanCount} peraturan daerah\n\n" .
               "Apa yang ingin Anda ketahui lebih lanjut?\n" .
               "• Wisata di {$province->name}\n" .
               "• Kuliner khas {$province->name}\n" .
               "• Tradisi budaya {$province->name}";
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
                
                $response = "🎭 Tradisi & Budaya Nusantara\n\n";
                $response .= "Kami memiliki {$count} tradisi dari berbagai provinsi di Indonesia.\n\n";
                
                if ($recent->isNotEmpty()) {
                    $response .= "Beberapa tradisi yang baru ditambahkan:\n";
                    foreach ($recent as $item) {
                        $response .= "• {$item->name} ({$item->province->name})\n";
                    }
                }
                
                $response .= "\n💡 Kunjungi halaman Tradisi untuk melihat koleksi lengkap budaya Indonesia!";
                return $response;
                
            case 'wisata':
                $count = Wisata::count();
                $recent = Wisata::with('province')->latest()->take(3)->get();
                
                $response = "🏖️ Destinasi Wisata Indonesia\n\n";
                $response .= "Terdapat {$count} destinasi wisata menarik di seluruh Indonesia.\n\n";
                
                if ($recent->isNotEmpty()) {
                    $response .= "Wisata terbaru:\n";
                    foreach ($recent as $item) {
                        $response .= "• {$item->name} ({$item->province->name})\n";
                    }
                }
                
                $response .= "\n💡 Lihat halaman Rekomendasi untuk wisata dengan rating dan popularitas tertinggi!";
                return $response;
                
            case 'kuliner':
                $count = Kuliner::count();
                $recent = Kuliner::with('province')->latest()->take(3)->get();
                
                $response = "🍜 Kuliner Khas Indonesia\n\n";
                $response .= "Indonesia kaya akan kuliner! Kami mencatat {$count} makanan khas nusantara.\n\n";
                
                if ($recent->isNotEmpty()) {
                    $response .= "Kuliner yang baru ditambahkan:\n";
                    foreach ($recent as $item) {
                        $response .= "• {$item->name} ({$item->province->name})\n";
                    }
                }
                
                $response .= "\n💡 Cek halaman Rekomendasi untuk kuliner dengan rating rasa terbaik!";
                return $response;
                
            case 'peraturan':
                $count = Peraturan::count();
                $provinces = Province::has('peraturans')->count();
                
                return "📜 Peraturan Daerah Indonesia\n\n" .
                       "Terdapat {$count} peraturan daerah dari {$provinces} provinsi di Indonesia.\n\n" .
                       "💡 Kunjungi halaman Peraturan untuk melihat detail regulasi setiap daerah!";
                
            default:
                return $this->getDefaultResponse();
        }
    }
}