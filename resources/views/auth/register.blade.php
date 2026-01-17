@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="relative min-h-[90vh] flex items-center justify-center py-20 px-4 overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div
            class="absolute bottom-40 -left-40 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse delay-1000">
        </div>
    </div>

    <!-- Register Card -->
    <div class="relative w-full max-w-lg animate-fade-in">
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 md:p-10 shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mb-6 shadow-xl shadow-indigo-500/20">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Buat Akun Baru</h1>
                <p class="text-gray-400">Bergabunglah dengan komunitas Jelajah Nusantara</p>
            </div>

            <!-- Form -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Full Name Field -->
                <div class="space-y-2">
                    <label for="name" class="text-sm font-medium text-gray-300 ml-1">Nama Lengkap</label>
                    <div class="relative group flex items-center">
                        <div class="absolute left-0 pl-4 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-400 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            style="padding-left: 3.25rem;"
                            class="block w-full pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                            placeholder="Nama Lengkap Anda">
                    </div>
                    @error('name')
                    <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Username Field -->
                    <div class="space-y-2">
                        <label for="username" class="text-sm font-medium text-gray-300 ml-1">Username</label>
                        <div class="relative group flex items-center">
                            <div class="absolute left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-400 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </div>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                style="padding-left: 3.25rem;"
                                class="block w-full pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                                placeholder="username">
                        </div>
                        @error('username')
                        <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-gray-300 ml-1">Email</label>
                        <div class="relative group flex items-center">
                            <div class="absolute left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-400 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                style="padding-left: 3.25rem;"
                                class="block w-full pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                        <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium text-gray-300 ml-1">Kata Sandi</label>
                        <div class="relative group flex items-center">
                            <div class="absolute left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-400 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required style="padding-left: 3.25rem;"
                                class="block w-full pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                        <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation"
                            class="text-sm font-medium text-gray-300 ml-1">Konfirmasi</label>
                        <div class="relative group flex items-center">
                            <div class="absolute left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-400 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                style="padding-left: 3.25rem;"
                                class="block w-full pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" required id="terms"
                            class="w-4 h-4 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-900 transition-all">
                    </div>
                    <label for="terms" class="ml-3 text-sm text-gray-400">Saya menyetujui <a href="#"
                            class="text-indigo-400 hover:text-indigo-300">Syarat dan Ketentuan</a> yang berlaku.</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 transform hover:scale-[1.02] transition-all duration-200 mt-4">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-8 text-center border-t border-white/5 pt-8">
                <p class="text-gray-400 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
</style>
@endsection