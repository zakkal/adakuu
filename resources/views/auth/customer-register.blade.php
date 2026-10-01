@extends('layouts.app')

@section('title', 'Daftar Akun - Adakuu')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-red-50 via-white to-red-50">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo & Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-red-600 rounded-3xl flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shadow-red-200">
                    AK
                </div>
            </div>
            <h2 class="text-3xl font-black text-gray-900">Buat Akun Baru</h2>
            <p class="mt-2 text-sm text-gray-600">Daftar untuk mulai berbelanja produk premium</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-8 space-y-6">
            
            <!-- Register Form -->
            <form method="POST" action="{{ route('customer.register.post') }}" class="space-y-4">
                @csrf

                @if(request()->has('redirect'))
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                @endif
                
                @if(request()->has('package'))
                    <input type="hidden" name="package" value="{{ request('package') }}">
                @endif

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                           placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                           placeholder="email@example.com">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                           placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                           placeholder="Ketik ulang password">
                </div>

                <button type="submit" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-red-200">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-3 bg-white text-gray-500 font-medium">Atau daftar dengan</span>
                </div>
            </div>

            <!-- Google Sign Up Button -->
            <a href="{{ route('auth.google') }}{{ request()->has('redirect') ? '?redirect=' . urlencode(request('redirect')) : '' }}{{ request()->has('package') ? '&package=' . request('package') : '' }}" 
               class="w-full flex items-center justify-center space-x-3 px-6 py-3.5 border-2 border-gray-200 rounded-2xl text-gray-700 font-semibold hover:border-red-500 hover:bg-red-50 hover:text-red-700 transition-all shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span class="text-sm font-bold">Google</span>
            </a>

            <!-- Login Link -->
            <div class="text-center pt-2">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('customer.login') }}{{ request()->has('redirect') ? '?redirect=' . urlencode(request('redirect')) : '' }}{{ request()->has('package') ? '&package=' . request('package') : '' }}" class="text-red-600 hover:text-red-700 font-bold">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="text-sm font-medium text-red-600 hover:text-red-700 inline-flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</div>
@endsection
