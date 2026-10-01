@extends('layouts.app')

@section('title', 'Login — Adakuu Admin')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl border border-gray-100 card-shadow p-8 space-y-6">
            {{-- Header --}}
            <div class="text-center space-y-2">
                <div class="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl mx-auto shadow-md shadow-red-200">
                    PP
                </div>
                <h1 class="text-2xl font-black text-gray-900">Login Admin</h1>
                <p class="text-sm text-gray-500">Masuk ke panel administrasi Adakuu</p>
            </div>

            {{-- Error Messages --}}
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="text-sm font-bold text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all @error('email') border-red-400 @enderror"
                        placeholder="admin@pasti-premium.com">
                    @error('email')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="text-sm font-bold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all @error('password') border-red-400 @enderror"
                        placeholder="••••••••">
                    @error('password')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <span class="text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-xl shadow-md shadow-red-200 transition-all text-sm">
                    Masuk
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-red-600 transition-colors">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

