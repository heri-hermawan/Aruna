<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/provinces', [WebController::class, 'provinces'])->name('provinces');
Route::get('/provinces/{province}', [WebController::class, 'provinceDetail'])->name('province.detail');

Route::get('/tradisi', [WebController::class, 'tradisi'])->name('tradisi');
Route::get('/peraturan', [WebController::class, 'peraturan'])->name('peraturan');
Route::get('/wisata', [WebController::class, 'wisata'])->name('wisata');
Route::get('/kuliner', [WebController::class, 'kuliner'])->name('kuliner');

Route::get('/chat', [WebController::class, 'chat'])->name('chat');
