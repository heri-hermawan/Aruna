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

// API Resource Routes (Full CRUD)
Route::apiResource('provinces', ProvinceController::class);
Route::apiResource('tradisi', TradisiController::class);
Route::apiResource('wisata', WisataController::class);
Route::apiResource('kuliner', KulinerController::class);
Route::apiResource('peraturan', PeraturanController::class);

// Custom Province Category Routes
Route::get('/provinces/{province}/tradisi', [ProvinceController::class, 'tradisi']);
Route::get('/provinces/{province}/peraturan', [ProvinceController::class, 'peraturan']);
Route::get('/provinces/{province}/wisata', [ProvinceController::class, 'wisata']);
Route::get('/provinces/{province}/kuliner', [ProvinceController::class, 'kuliner']);

// Category endpoints (all items)
Route::get('/all-tradisi', [ProvinceController::class, 'allTradisi']);
Route::get('/all-peraturan', [ProvinceController::class, 'allPeraturan']);
Route::get('/all-wisata', [ProvinceController::class, 'allWisata']);
Route::get('/all-kuliner', [ProvinceController::class, 'allKuliner']);

// Recommendation endpoints (SAW Algorithm)
Route::prefix('/recommendations')->group(function () {
    Route::get('/kuliner', [RecommendationController::class, 'kuliner']);
    Route::get('/kuliner/{provinceId}', [RecommendationController::class, 'kulinerByProvince']);
    Route::get('/wisata', [RecommendationController::class, 'wisata']);
    Route::get('/wisata/{provinceId}', [RecommendationController::class, 'wisataByProvince']);
    Route::get('/top-kuliner', [RecommendationController::class, 'topKuliner']);
    Route::get('/top-wisata', [RecommendationController::class, 'topWisata']);
    Route::get('/random-kuliner', [RecommendationController::class, 'randomKuliner']);
    Route::get('/random-wisata', [RecommendationController::class, 'randomWisata']);
    Route::post('/recalculate', [RecommendationController::class, 'recalculateAll']);
});

// Chat AI endpoint
Route::post('/chat', [ChatController::class, 'chat']);
