<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Routes
Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/provinces', [WebController::class, 'provinces'])->name('provinces');
Route::get('/provinces/{province}', [WebController::class, 'provinceDetail'])->name('province.detail');

Route::get('/tradisi', [WebController::class, 'tradisi'])->name('tradisi');
Route::get('/peraturan', [WebController::class, 'peraturan'])->name('peraturan');
Route::get('/wisata', [WebController::class, 'wisata'])->name('wisata');
Route::get('/kuliner', [WebController::class, 'kuliner'])->name('kuliner');
Route::get('/rekomendasi', [WebController::class, 'rekomendasi'])->name('rekomendasi');

Route::get('/chat', [WebController::class, 'chat'])->name('chat');

// Chatbot AI routes
Route::get('/chatbot', [ChatController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/send', [ChatController::class, 'sendMessage'])->name('chat.send');
