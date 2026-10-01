<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Adakuu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo & Header -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-red-600 rounded-3xl flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shadow-red-200">
                        PP
                    </div>
                </div>
                <h2 class="text-3xl font-black text-gray-900">Admin Panel</h2>
                <p class="mt-2 text-sm text-gray-600">Login untuk mengakses dashboard admin</p>
            </div>

            <!-- Messages -->
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl text-sm font-medium">
                {{ session('error') }}
            </div>
            @endif

            <!-- Admin Login Form -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 space-y-6">
                
                <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Admin</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                               placeholder="admin@yuk.proin.com">
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                               placeholder="••••••••">
                        @error('password')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-red-200">
                        Login Admin
                    </button>
                </form>

                <div class="border-t border-gray-200 pt-4">
                    <p class="text-xs text-center text-gray-500">
                        🔒 Halaman ini khusus untuk administrator.<br>
                        Customer tidak perlu login di sini, langsung klik produk untuk checkout.
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-sm font-medium text-red-600 hover:text-red-700">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
