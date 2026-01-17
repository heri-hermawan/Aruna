<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\TradisiController;
use App\Http\Controllers\Api\WisataController;
use App\Http\Controllers\Api\KulinerController;
use App\Http\Controllers\Api\PeraturanController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ============================================
// PUBLIC AUTH ROUTES
// ============================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ============================================
// PROTECTED AUTH ROUTES (Require Authentication)
// ============================================
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

// ============================================
// API RESOURCE ROUTES (Full CRUD)
// ============================================
Route::apiResource('provinces', ProvinceController::class);
Route::apiResource('tradisi', TradisiController::class);
Route::apiResource('wisata', WisataController::class);
Route::apiResource('kuliner', KulinerController::class);
Route::apiResource('peraturan', PeraturanController::class);

// ============================================
// CUSTOM PROVINCE CATEGORY ROUTES
// ============================================
Route::get('/provinces/{province}/tradisi', [ProvinceController::class, 'tradisi']);
Route::get('/provinces/{province}/peraturan', [ProvinceController::class, 'peraturan']);
Route::get('/provinces/{province}/wisata', [ProvinceController::class, 'wisata']);
Route::get('/provinces/{province}/kuliner', [ProvinceController::class, 'kuliner']);

// ============================================
// CATEGORY ENDPOINTS (All Items)
// ============================================
Route::get('/all-tradisi', [ProvinceController::class, 'allTradisi']);
Route::get('/all-peraturan', [ProvinceController::class, 'allPeraturan']);
Route::get('/all-wisata', [ProvinceController::class, 'allWisata']);
Route::get('/all-kuliner', [ProvinceController::class, 'allKuliner']);

// ============================================
// CHAT AI ENDPOINT (Support GET & POST)
// ============================================
Route::post('/chat', [ChatController::class, 'chat'])->name('api.chat');
Route::get('/chat', function() {
    return response()->json([
        'success' => false,
        'message' => 'Please use POST method to send chat messages',
        'error' => 'GET method is not supported for this endpoint. Use POST with "message" parameter.',
        'example' => [
            'method' => 'POST',
            'url' => url('/api/chat'),
            'body' => [
                'message' => 'Rekomendasikan wisata di Bali'
            ]
        ]
    ], 405);
});

// ============================================
// RECOMMENDATION ROUTES (SAW Method)
// ============================================
Route::prefix('recommendations')->name('api.recommendations.')->group(function () {
    
    // ==========================================
    // STATIC ROUTES (HARUS DI ATAS!)
    // ==========================================
    
    // Top Recommendations
    Route::get('top/kuliner', [RecommendationController::class, 'topKuliner'])->name('top.kuliner');
    Route::get('top/wisata', [RecommendationController::class, 'topWisata'])->name('top.wisata');
    
    // Random Recommendations  
    Route::get('random/wisata', [RecommendationController::class, 'randomWisata'])->name('random.wisata');
    Route::get('random/kuliner', [RecommendationController::class, 'randomKuliner'])->name('random.kuliner');
    
    // Recalculate
    Route::post('recalculate', [RecommendationController::class, 'recalculateAll'])->name('recalculate');
    
    // ==========================================
    // QUERY STRING FILTER ROUTES
    // ==========================================
    
    // Get recommendations with optional filter via query string
    Route::get('kuliner', [RecommendationController::class, 'kuliner'])->name('kuliner');
    Route::get('wisata', [RecommendationController::class, 'wisata'])->name('wisata');
    
    // ==========================================
    // DYNAMIC PROVINCE ID ROUTES (HARUS DI BAWAH!)
    // ==========================================
    
    // Get recommendations by specific province (with numeric constraint)
    Route::get('kuliner/{province_id}', [RecommendationController::class, 'kulinerByProvince'])
        ->where('province_id', '[0-9]+')
        ->name('kuliner.province');
        
    Route::get('wisata/{province_id}', [RecommendationController::class, 'wisataByProvince'])
        ->where('province_id', '[0-9]+')
        ->name('wisata.province');
});