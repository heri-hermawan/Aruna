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
     * Get rekomendasi kuliner terbaik
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * Query parameters:
     * - province_id (optional): Filter by province
     * - limit (optional, default=10): Number of results
     */
    public function kuliner(Request $request): JsonResponse
    {
        try {
            $provinceId = $request->query('province_id');
            $limit = $request->query('limit', 10);
            
            // Hitung SAW dan ambil hasil
            $kuliners = Kuliner::calculateSAW($provinceId);
            
            // Limit hasil
            if ($limit) {
                $kuliners = $kuliners->take($limit);
            }
            
            // Load relasi province
            $kuliners->load('province');
            
            return response()->json([
                'success' => true,
                'message' => 'Rekomendasi kuliner berhasil didapatkan',
                'data' => $kuliners,
                'total' => $kuliners->count(),
                'filter' => [
                    'province_id' => $provinceId,
                    'limit' => $limit
                ]
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
     * Get rekomendasi wisata terbaik
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * Query parameters:
     * - province_id (optional): Filter by province
     * - limit (optional, default=10): Number of results
     */
    public function wisata(Request $request): JsonResponse
    {
        try {
            $provinceId = $request->query('province_id');
            $limit = $request->query('limit', 10);
            
            // Hitung SAW dan ambil hasil
            $wisatas = Wisata::calculateSAW($provinceId);
            
            // Limit hasil
            if ($limit) {
                $wisatas = $wisatas->take($limit);
            }
            
            // Load relasi province
            $wisatas->load('province');
            
            return response()->json([
                'success' => true,
                'message' => 'Rekomendasi wisata berhasil didapatkan',
                'data' => $wisatas,
                'total' => $wisatas->count(),
                'filter' => [
                    'province_id' => $provinceId,
                    'limit' => $limit
                ]
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
     * Get rekomendasi kuliner berdasarkan provinsi
     * 
     * @param int $province_id
     * @param Request $request
     * @return JsonResponse
     */
    public function kulinerByProvince(int $province_id, Request $request): JsonResponse
    {
        try {
            // Cek provinsi ada atau tidak
            $province = Province::find($province_id);
            if (!$province) {
                return response()->json([
                    'success' => false,
                    'message' => 'Provinsi tidak ditemukan'
                ], 404);
            }
            
            $limit = $request->query('limit', 10);
            
            // Hitung SAW untuk provinsi tertentu
            $kuliners = Kuliner::calculateSAW($province_id);
            
            // Limit hasil
            if ($limit) {
                $kuliners = $kuliners->take($limit);
            }
            
            $kuliners->load('province');
            
            return response()->json([
                'success' => true,
                'message' => "Rekomendasi kuliner terbaik di {$province->name}",
                'province' => [
                    'id' => $province->id,
                    'name' => $province->name
                ],
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
     * Get rekomendasi wisata berdasarkan provinsi
     * 
     * @param int $province_id
     * @param Request $request
     * @return JsonResponse
     */
    public function wisataByProvince(int $province_id, Request $request): JsonResponse
    {
        try {
            // Cek provinsi ada atau tidak
            $province = Province::find($province_id);
            if (!$province) {
                return response()->json([
                    'success' => false,
                    'message' => 'Provinsi tidak ditemukan'
                ], 404);
            }
            
            $limit = $request->query('limit', 10);
            
            // Hitung SAW untuk provinsi tertentu
            $wisatas = Wisata::calculateSAW($province_id);
            
            // Limit hasil
            if ($limit) {
                $wisatas = $wisatas->take($limit);
            }
            
            $wisatas->load('province');
            
            return response()->json([
                'success' => true,
                'message' => "Rekomendasi wisata terbaik di {$province->name}",
                'province' => [
                    'id' => $province->id,
                    'name' => $province->name
                ],
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
     * Get top N kuliner terbaik
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * Query parameters:
     * - limit (optional, default=5): Number of top results
     */
    public function topKuliner(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 5);
            
            $kuliners = Kuliner::getTopRecommendations($limit);
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
     * Get top N wisata terbaik
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * Query parameters:
     * - limit (optional, default=5): Number of top results
     */
    public function topWisata(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 5);
            
            $wisatas = Wisata::getTopRecommendations($limit);
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
     * Recalculate semua score SAW
     * Digunakan untuk maintenance atau setelah update banyak data
     * 
     * @return JsonResponse
     */
    public function recalculateAll(): JsonResponse
    {
        try {
            // Recalculate kuliner
            Kuliner::calculateSAW();
            $kulinerCount = Kuliner::count();
            
            // Recalculate wisata
            Wisata::calculateSAW();
            $wisataCount = Wisata::count();
            
            return response()->json([
                'success' => true,
                'message' => 'Semua score SAW berhasil dihitung ulang',
                'data' => [
                    'kuliner_updated' => $kulinerCount,
                    'wisata_updated' => $wisataCount
                ]
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghitung ulang score SAW',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}