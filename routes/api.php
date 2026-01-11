<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\TradisiController;
use App\Http\Controllers\Api\WisataController;
use App\Http\Controllers\Api\KulinerController;
use App\Http\Controllers\Api\PeraturanController;
use App\Http\Controllers\Api\ChatController;

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

// Chat AI endpoint
Route::post('/chat', [ChatController::class, 'chat']);
