<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kuliner;
use App\Models\Wisata;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecommendationController extends Controller
{
    /**
     * Hitung SAW untuk Kuliner
     */
    private function calculateKulinerSAW($kuliners)
    {
        if ($kuliners->isEmpty()) {
            return collect([]);
        }

        // Bobot kriteria
        $weights = [
            'rasa' => 5,
            'populer' => 4,
            'gizi' => 3,
            'biaya' => 2,
            'porsi' => 1
        ];

        // Cari nilai max dan min
        $maxRasa = $kuliners->max('rasa');
        $maxPopuler = $kuliners->max('populer');
        $maxGizi = $kuliners->max('gizi');
        $minBiaya = $kuliners->min('biaya');
        $maxPorsi = $kuliners->max('porsi');

        // Normalisasi dan hitung score
        foreach ($kuliners as $kuliner) {
            $r1 = $maxRasa > 0 ? $kuliner->rasa / $maxRasa : 0;
            $r2 = $maxPopuler > 0 ? $kuliner->populer / $maxPopuler : 0;
            $r3 = $maxGizi > 0 ? $kuliner->gizi / $maxGizi : 0;
            $r4 = $kuliner->biaya > 0 ? $minBiaya / $kuliner->biaya : 0;
            $r5 = $maxPorsi > 0 ? $kuliner->porsi / $maxPorsi : 0;

            $score = ($r1 * $weights['rasa']) +
                     ($r2 * $weights['populer']) +
                     ($r3 * $weights['gizi']) +
                     ($r4 * $weights['biaya']) +
                     ($r5 * $weights['porsi']);

            $kuliner->saw_score = round($score, 3);
        }

        return $kuliners->sortByDesc('saw_score')->values();
    }

    /**
     * Hitung SAW untuk Wisata
     */
    private function calculateWisataSAW($wisatas)
    {
        if ($wisatas->isEmpty()) {
            return collect([]);
        }

        // Bobot kriteria
        $weights = [
            'daya_tarik' => 7,
            'populer' => 7,
            'harga' => 5,
            'fasilitas' => 3,
            'kebersihan' => 1
        ];

        // Cari nilai max dan min
        $maxDayaTarik = $wisatas->max('daya_tarik');
        $maxPopuler = $wisatas->max('populer');
        $minHarga = $wisatas->min('harga');
        $maxFasilitas = $wisatas->max('fasilitas');
        $maxKebersihan = $wisatas->max('kebersihan');

        // Normalisasi dan hitung score
        foreach ($wisatas as $wisata) {
            $r1 = $maxDayaTarik > 0 ? $wisata->daya_tarik / $maxDayaTarik : 0;
            $r2 = $maxPopuler > 0 ? $wisata->populer / $maxPopuler : 0;
            $r3 = $wisata->harga > 0 ? $minHarga / $wisata->harga : 0;
            $r4 = $maxFasilitas > 0 ? $wisata->fasilitas / $maxFasilitas : 0;
            $r5 = $maxKebersihan > 0 ? $wisata->kebersihan / $maxKebersihan : 0;

            $score = ($r1 * $weights['daya_tarik']) +
                     ($r2 * $weights['populer']) +
                     ($r3 * $weights['harga']) +
                     ($r4 * $weights['fasilitas']) +
                     ($r5 * $weights['kebersihan']);

            $wisata->saw_score = round($score, 3);
        }

        return $wisatas->sortByDesc('saw_score')->values();
    }

    /**
     * Get rekomendasi kuliner terbaik dengan SAW
     */
    public function kuliner(Request $request): JsonResponse
    {
        try {
            $provinceId = $request->query('province_id');
            $limit = $request->query('limit', 10);
            
            $kuliners = Kuliner::getAllKuliner($provinceId);
            $kuliners = $this->calculateKulinerSAW($kuliners);
            
            if ($limit) {
                $kuliners = $kuliners->take($limit);
            }
            
            $kuliners->load('province');
            
            return response()->json([
                'success' => true,
                'message' => 'Rekomendasi kuliner berhasil didapatkan',
                'data' => $kuliners,
                'total' => $kuliners->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan rekomendasi kuliner',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get rekomendasi kuliner berdasarkan provinsi spesifik
     */
    public function kulinerByProvince(Request $request, $provinceId): JsonResponse
    {
        try {
            $limit = $request->query('limit', 10);
            
            $kuliners = Kuliner::getAllKuliner($provinceId);
            $kuliners = $this->calculateKulinerSAW($kuliners);
            
            if ($limit) {
                $kuliners = $kuliners->take($limit);
            }
            
            $kuliners->load('province');
            
            return response()->json([
                'success' => true,
                'message' => "Rekomendasi kuliner provinsi ID {$provinceId} berhasil didapatkan",
                'data' => $kuliners,
                'total' => $kuliners->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan rekomendasi kuliner berdasarkan provinsi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get rekomendasi wisata terbaik dengan SAW
     */
    public function wisata(Request $request): JsonResponse
    {
        try {
            $provinceId = $request->query('province_id');
            $limit = $request->query('limit', 10);
            
            $wisatas = Wisata::getAllWisata($provinceId);
            $wisatas = $this->calculateWisataSAW($wisatas);
            
            if ($limit) {
                $wisatas = $wisatas->take($limit);
            }
            
            $wisatas->load('province');
            
            return response()->json([
                'success' => true,
                'message' => 'Rekomendasi wisata berhasil didapatkan',
                'data' => $wisatas,
                'total' => $wisatas->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan rekomendasi wisata',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get rekomendasi wisata berdasarkan provinsi spesifik
     */
    public function wisataByProvince(Request $request, $provinceId): JsonResponse
    {
        try {
            $limit = $request->query('limit', 10);
            
            $wisatas = Wisata::getAllWisata($provinceId);
            $wisatas = $this->calculateWisataSAW($wisatas);
            
            if ($limit) {
                $wisatas = $wisatas->take($limit);
            }
            
            $wisatas->load('province');
            
            return response()->json([
                'success' => true,
                'message' => "Rekomendasi wisata provinsi ID {$provinceId} berhasil didapatkan",
                'data' => $wisatas,
                'total' => $wisatas->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan rekomendasi wisata berdasarkan provinsi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top N kuliner terbaik dengan SAW
     */
    public function topKuliner(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 5);
            
            $kuliners = Kuliner::getAllKuliner();
            $kuliners = $this->calculateKulinerSAW($kuliners);
            $kuliners = $kuliners->take($limit);
            
            $kuliners->load('province');
            
            return response()->json([
                'success' => true,
                'message' => "Top {$limit} kuliner terbaik se-Indonesia",
                'data' => $kuliners,
                'total' => $kuliners->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan top kuliner',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top N wisata terbaik dengan SAW
     */
    public function topWisata(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 5);
            
            $wisatas = Wisata::getAllWisata();
            $wisatas = $this->calculateWisataSAW($wisatas);
            $wisatas = $wisatas->take($limit);
            
            $wisatas->load('province');
            
            return response()->json([
                'success' => true,
                'message' => "Top {$limit} wisata terbaik se-Indonesia",
                'data' => $wisatas,
                'total' => $wisatas->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan top wisata',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Recalculate SAW scores untuk semua kuliner dan wisata
     */
    public function recalculateAll(Request $request): JsonResponse
    {
        try {
            // Recalculate kuliner SAW
            $kuliners = Kuliner::getAllKuliner();
            $kuliners = $this->calculateKulinerSAW($kuliners);
            
            // Recalculate wisata SAW
            $wisatas = Wisata::getAllWisata();
            $wisatas = $this->calculateWisataSAW($wisatas);
            
            return response()->json([
                'success' => true,
                'message' => 'SAW scores berhasil dihitung ulang',
                'kuliner_count' => $kuliners->count(),
                'wisata_count' => $wisatas->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghitung ulang SAW scores',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get random 50 wisata dengan SAW scoring
     */
    public function randomWisata(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 50);
            
            // Get random wisata
            $wisatas = Wisata::with('province')->inRandomOrder()->limit($limit)->get();
            $wisatas = $this->calculateWisataSAW($wisatas);
            
            return response()->json([
                'success' => true,
                'message' => "Random {$limit} wisata berhasil didapatkan",
                'data' => $wisatas,
                'total' => $wisatas->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan random wisata',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get random 50 kuliner dengan SAW scoring
     */
    public function randomKuliner(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 50);
            
            // Get random kuliner
            $kuliners = Kuliner::with('province')->inRandomOrder()->limit($limit)->get();
            $kuliners = $this->calculateKulinerSAW($kuliners);
            
            return response()->json([
                'success' => true,
                'message' => "Random {$limit} kuliner berhasil didapatkan",
                'data' => $kuliners,
                'total' => $kuliners->count()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan random kuliner',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

