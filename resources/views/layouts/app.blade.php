<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Adakuu - Akun Premium Murah & Instant')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Solusi akun premium murah, aman, dan instan. Tingkatkan produktivitas dan nikmati hiburan dengan Adakuu.')">
    <meta name="keywords" content="@yield('meta_keywords', 'akun premium, netflix murah, spotify premium, youtube premium, canva pro, disney+ hotstar, vidio premier')">
    <meta name="author" content="Adakuu">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/image copy.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/image copy.png') }}">
    
    <!-- Open Graph Meta Tags for Social Sharing -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Adakuu">
    <meta property="og:title" content="@yield('og_title', 'Adakuu - Akun Premium Murah & Instant')">
    <meta property="og:description" content="@yield('og_description', 'Solusi akun premium murah, aman, dan instan. Tingkatkan produktivitas dan nikmati hiburan dengan Adakuu.')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('image/image copy.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Adakuu - Akun Premium Murah & Instant')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Solusi akun premium murah, aman, dan instan.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('image/image copy.png'))">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "Adakuu",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('image/image copy.png') }}",
        "description": "Solusi akun premium murah, aman, dan instan",
        "sameAs": []
    }
    </script>
    
    @stack('structured-data')
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Fonts with display=swap for better performance -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fc; color: #1e293b; }
        .brand-name { 
            font-family: 'Poppins', sans-serif; 
            font-weight: 700; 
            letter-spacing: -0.5px;
        }
        .gradient-hero { background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 50%, #faf5ff 100%); }
        .card-shadow { box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.08); }
        .card-shadow-hover:hover { box-shadow: 0 15px 35px -10px rgba(99, 102, 241, 0.15); }
        
        /* Loading Screen Styles */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(254, 242, 242, 0.98) 100%);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        #loading-screen.fade-out {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }
        
        .logo-container {
            position: relative;
            width: 160px;
            height: 160px;
            margin-bottom: 50px;
        }
        
        .logo-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-shadow: 0 25px 80px rgba(220, 38, 38, 0.3),
                        0 10px 40px rgba(220, 38, 38, 0.2),
                        inset 0 2px 10px rgba(255, 255, 255, 0.8);
            animation: logoFloat 3s ease-in-out infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .logo-wrapper::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dc2626, #ef4444, #f87171);
            animation: rotate 3s linear infinite;
            z-index: -1;
            opacity: 0.15;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .logo-image {
            width: 85px;
            height: 85px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(220, 38, 38, 0.2));
            animation: logoGlow 2s ease-in-out infinite;
        }
        
        @keyframes logoGlow {
            0%, 100% {
                filter: drop-shadow(0 4px 12px rgba(220, 38, 38, 0.2));
                transform: scale(1);
            }
            50% {
                filter: drop-shadow(0 8px 24px rgba(220, 38, 38, 0.4));
                transform: scale(1.05);
            }
        }
        
        .loader-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 140px;
            height: 140px;
            border: 4px solid transparent;
            border-top-color: #dc2626;
            border-right-color: #ef4444;
            border-radius: 50%;
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
            filter: drop-shadow(0 0 10px rgba(220, 38, 38, 0.3));
        }
        
        .loader-ring-2 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 160px;
            height: 160px;
            border: 3px solid transparent;
            border-bottom-color: rgba(239, 68, 68, 0.4);
            border-left-color: rgba(220, 38, 38, 0.2);
            border-radius: 50%;
            animation: spin 1.5s linear infinite reverse;
        }
        
        .loader-ring-3 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 180px;
            border: 2px solid transparent;
            border-top-color: rgba(248, 113, 113, 0.3);
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }
        
        @keyframes logoFloat {
            0%, 100% { 
                transform: translate(-50%, -50%) translateY(0px) scale(1);
            }
            50% { 
                transform: translate(-50%, -50%) translateY(-12px) scale(1.03);
            }
        }
        
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        .loading-text {
            color: #1f2937;
            font-size: 44px;
            font-weight: 700;
            letter-spacing: -1px;
            animation: textPulse 2s ease-in-out infinite;
            font-family: 'Poppins', sans-serif;
        }
        
        @keyframes textPulse {
            0%, 100% { 
                opacity: 1;
                transform: scale(1);
            }
            50% { 
                opacity: 0.7;
                transform: scale(0.97);
            }
        }
        
        .loading-dots {
            display: inline-block;
            margin-left: 6px;
        }
        
        .loading-dots span {
            animation: dotPulse 1.4s infinite;
            display: inline-block;
            font-weight: 900;
        }
        
        .loading-dots span:nth-child(1) { animation-delay: 0s; }
        .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loading-dots span:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes dotPulse {
            0%, 60%, 100% { 
                opacity: 1;
                transform: translateY(0);
            }
            30% { 
                opacity: 0.2;
                transform: translateY(-10px);
            }
        }
        
        .loading-bar {
            width: 240px;
            height: 4px;
            background: rgba(220, 38, 38, 0.08);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 25px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .loading-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #dc2626 0%, #ef4444 50%, #f87171 100%);
            background-size: 200% 100%;
            animation: loadingBar 1.8s ease-in-out infinite;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(220, 38, 38, 0.4);
        }
        
        @keyframes loadingBar {
            0% {
                width: 0%;
                background-position: 0% 50%;
            }
            50% {
                width: 80%;
                background-position: 100% 50%;
            }
            100% {
                width: 100%;
                background-position: 200% 50%;
            }
        }
        
        .loading-subtitle {
            margin-top: 15px;
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            letter-spacing: 0.5px;
            animation: fadeInOut 2s ease-in-out infinite;
        }
        
        @keyframes fadeInOut {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between antialiased">

    <!-- Loading Screen -->
    <div id="loading-screen" style="display: none;">
        <div class="logo-container">
            <div class="loader-ring-3"></div>
            <div class="loader-ring-2"></div>
            <div class="loader-ring"></div>
            <div class="logo-wrapper">
                <img src="{{ asset('image/image copy.png') }}" alt="Adakuu" class="logo-image">
            </div>
        </div>
        <div class="loading-text">
            <span>Adakuu</span>
            <span class="loading-dots">
                <span>.</span><span>.</span><span>.</span>
            </span>
        </div>
        <div class="loading-bar">
            <div class="loading-bar-fill"></div>
        </div>
        <div class="loading-subtitle">Menyiapkan pengalaman terbaik untuk Anda</div>
    </div>

    <script>
        // Show loading screen only on first visit in session
        (function() {
            const hasShownLoading = sessionStorage.getItem('loadingShown');
            const loadingScreen = document.getElementById('loading-screen');
            
            if (!hasShownLoading) {
                // First time - show loading
                loadingScreen.style.display = 'flex';
                
                window.addEventListener('load', function() {
                    setTimeout(function() {
                        loadingScreen.classList.add('fade-out');
                        setTimeout(function() {
                            loadingScreen.style.display = 'none';
                            sessionStorage.setItem('loadingShown', 'true');
                        }, 600);
                    }, 1500); // Show loading for 1.5 seconds after page load
                });
            }
        })();
    </script>

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 bg-transparent rounded-2xl flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('image/image copy.png') }}" alt="Adakuu" class="w-10 h-10 sm:w-11 sm:h-11 object-contain">
                        </div>
                        <span class="text-2xl sm:text-3xl brand-name">Adakuu</span>
                    </a>
                </div>

                <!-- Center Navigation - Desktop Only -->
                <nav class="hidden md:flex items-center space-x-1 bg-gray-50/80 p-1.5 rounded-full border border-gray-100 text-sm font-medium">
                    <a href="{{ route('home') }}" class="px-5 py-2 rounded-full {{ request()->routeIs('home') ? 'bg-red-600 text-white shadow-sm font-semibold' : 'text-gray-600 hover:text-red-600' }}">Beranda</a>
                    <a href="{{ route('catalogue') }}" class="px-5 py-2 rounded-full {{ request()->routeIs('catalogue') ? 'bg-red-600 text-white shadow-sm font-semibold' : 'text-gray-600 hover:text-red-600' }}">Katalog</a>
                    <a href="{{ route('terms.index') }}" class="px-5 py-2 rounded-full {{ request()->routeIs('terms.index') ? 'bg-red-600 text-white shadow-sm font-semibold' : 'text-gray-600 hover:text-red-600' }}">Ketentuan</a>
                    @auth
                        <a href="{{ route('orders.history') }}" class="px-5 py-2 rounded-full {{ request()->routeIs('orders.history*') ? 'bg-red-600 text-white shadow-sm font-semibold' : 'text-gray-600 hover:text-red-600' }}">Pesanan Saya</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="px-5 py-2 rounded-full {{ request()->routeIs('orders.index') ? 'bg-red-600 text-white shadow-sm font-semibold' : 'text-gray-600 hover:text-red-600' }}">Cek Pesanan</a>
                    @endauth
                </nav>

                <!-- Right Actions - Desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2.5 bg-gray-50 border border-gray-200 px-3 py-2 rounded-full">
                                @php
                                    $avatarUrl = auth()->user()->avatar_url;
                                    $fallbackUrl = auth()->user()->getColoredAvatarUrl();
                                    \Log::info('Avatar URL for desktop: ' . $avatarUrl);
                                @endphp
                                <img src="{{ $avatarUrl }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     onerror="this.onerror=null; this.src='{{ $fallbackUrl }}';"
                                     class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm ring-2 ring-gray-100">
                                <span class="text-sm font-semibold text-gray-700 max-w-[150px] truncate">{{ auth()->user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-full transition-all">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('customer.login') }}" class="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 text-sm font-semibold px-5 py-2 rounded-full transition-all flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Login</span>
                        </a>
                    @endauth
                    
                    <a href="{{ route('catalogue') }}" class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-5 py-2 rounded-full shadow-md shadow-red-200 transition-all">
                        Lihat Katalog
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden items-center space-x-2">
                    <a href="{{ route('catalogue') }}" class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-md shadow-red-200 transition-all">
                        Katalog
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-xl hover:bg-gray-100 transition-all">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="md:hidden py-4 border-t border-gray-100 bg-white/80 backdrop-blur-md"
                 x-cloak>
                <nav class="flex flex-col space-y-1">
                    <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-lg {{ request()->routeIs('home') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('catalogue') }}" class="px-4 py-2.5 rounded-lg {{ request()->routeIs('catalogue') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                        Katalog
                    </a>
                    <a href="{{ route('terms.index') }}" class="px-4 py-2.5 rounded-lg {{ request()->routeIs('terms.index') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                        Ketentuan
                    </a>
                    @auth
                        <a href="{{ route('orders.history') }}" class="px-4 py-2.5 rounded-lg {{ request()->routeIs('orders.history*') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                            Pesanan Saya
                        </a>
                        <div class="px-4 py-2.5 border-t border-gray-100 mt-2 pt-3">
                            <div class="flex items-center space-x-3 mb-3">
                                @php
                                    $avatarUrl = auth()->user()->avatar_url;
                                    $fallbackUrl = auth()->user()->getColoredAvatarUrl();
                                @endphp
                                <img src="{{ $avatarUrl }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     onerror="this.onerror=null; this.src='{{ $fallbackUrl }}';"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-300 shadow-sm">
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-red-600 hover:bg-red-50 font-semibold">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('orders.index') }}" class="px-4 py-2.5 rounded-lg {{ request()->routeIs('orders.index') ? 'bg-red-50 text-red-600 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                            Cek Pesanan
                        </a>
                        <a href="{{ route('customer.login') }}" class="mx-4 mt-2 flex items-center justify-center space-x-2 px-4 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Login</span>
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- FAQ Section -->
            <div class="mb-12" x-data="{ openFaq: null }">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-8">Pertanyaan Umum (FAQ)</h3>
                <div class="max-w-3xl mx-auto space-y-3">
                    <!-- FAQ 1 -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="openFaq = openFaq === 1 ? null : 1" 
                                class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 transition-all">
                            <span class="font-semibold text-gray-900">Bagaimana cara memesan produk?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openFaq === 1" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="px-5 pb-4 text-sm text-gray-600 leading-relaxed"
                             style="display: none;">
                            Pilih produk yang diinginkan, klik "Beli Sekarang", <strong>login dengan akun Google terlebih dahulu</strong> (wajib untuk melanjutkan pembayaran), isi form pemesanan, pilih metode pembayaran, dan selesaikan pembayaran melalui Midtrans. Akun akan dikirim via WhatsApp setelah pembayaran terverifikasi.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="openFaq = openFaq === 2 ? null : 2" 
                                class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 transition-all">
                            <span class="font-semibold text-gray-900">Metode pembayaran apa saja yang tersedia?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openFaq === 2" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="px-5 pb-4 text-sm text-gray-600 leading-relaxed"
                             style="display: none;">
                            Kami menerima berbagai metode pembayaran melalui Midtrans: QRIS, GoPay, ShopeePay, Virtual Account (BCA, BNI, BRI, Mandiri, Permata), dan Kartu Kredit/Debit. Semua transaksi aman dan terenkripsi.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="openFaq = openFaq === 4 ? null : 4" 
                                class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 transition-all">
                            <span class="font-semibold text-gray-900">Berapa lama proses pengiriman akun?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openFaq === 4" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="px-5 pb-4 text-sm text-gray-600 leading-relaxed"
                             style="display: none;">
                            Setelah pembayaran terverifikasi, akun akan langsung dikirim ke WhatsApp Anda. Admin kami siap memproses pesanan Anda dengan cepat dan responsif.
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="openFaq = openFaq === 5 ? null : 5" 
                                class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 transition-all">
                            <span class="font-semibold text-gray-900">Bagaimana cara mengajukan refund?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openFaq === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openFaq === 5" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="px-5 pb-4 text-sm text-gray-600 leading-relaxed"
                             style="display: none;">
                            <p class="mb-3"><strong>Langkah-langkah refund:</strong></p>
                            <ol class="list-decimal list-inside space-y-2 ml-2">
                                <li>Buka menu <strong>"Pesanan Saya"</strong> di navbar</li>
                                <li>Cari pesanan yang ingin di-refund</li>
                                <li>Klik tombol <strong>"Salin Kode"</strong> pada pesanan tersebut</li>
                                <li>Buka halaman <strong>"Cek Pesanan"</strong></li>
                                <li>Masukkan kode pesanan yang sudah disalin</li>
                                <li>Klik tombol <strong>"Ajukan Refund"</strong></li>
                                <li>Isi alasan refund dan kirim</li>
                                <li>Admin akan memproses dalam <strong>1x24 jam</strong></li>
                            </ol>
                            <p class="mt-3 text-xs text-gray-500">💡 Refund 100% tersedia dalam 24 jam pertama setelah pembayaran.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-100 pt-8">
                <div class="flex flex-col items-center justify-center gap-4 text-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-transparent rounded-xl flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('image/image copy.png') }}" alt="Adakuu" class="w-10 h-10 object-contain">
                        </div>
                        <span class="font-bold text-lg text-gray-900 brand-name">Adakuu — YUK PRO IN</span>
                    </div>
                    <p class="text-sm text-gray-500 max-w-md">
                        Solusi Akun Digital & Produk Premium Terpercaya
                    </p>
                    <p class="text-xs text-gray-400">© 2026 Adakuu. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    @php
        $adminWhatsapp = \App\Models\Setting::get('admin_whatsapp_number', '081234567890');
        $cleanWa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $adminWhatsapp));
    @endphp

    <!-- Floating Help Button with Menu -->
    <div x-data="{ helpMenuOpen: false }" class="fixed bottom-6 right-6 z-50">
        <!-- Help Options Menu -->
        <div x-show="helpMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="absolute bottom-20 right-0 bg-white rounded-2xl shadow-2xl border border-gray-200 p-3 space-y-2 min-w-[200px]"
             @click.away="helpMenuOpen = false"
             x-cloak>
            
            <!-- AI Assistant Option -->
            <button @click="helpMenuOpen = false; $dispatch('open-ai-chat')" 
                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-red-50 text-gray-700 hover:text-red-600 transition-all group">
                <div class="w-10 h-10 bg-red-100 group-hover:bg-red-200 rounded-full flex items-center justify-center transition-all">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <p class="font-bold text-sm">AI Assistant</p>
                    <p class="text-xs text-gray-500">Chat otomatis 24/7</p>
                </div>
            </button>

            <!-- WhatsApp Option -->
            <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Admin YUK PRO IN, saya butuh bantuan mengenai pesanan/produk.') }}" 
               target="_blank"
               @click="helpMenuOpen = false"
               class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-emerald-50 text-gray-700 hover:text-emerald-600 transition-all group">
                <div class="w-10 h-10 bg-emerald-100 group-hover:bg-emerald-200 rounded-full flex items-center justify-center transition-all">
                    <svg class="w-5 h-5 text-emerald-600 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <p class="font-bold text-sm">WhatsApp</p>
                    <p class="text-xs text-gray-500">Chat dengan admin</p>
                </div>
            </a>
        </div>

        <!-- Main Help Button -->
        <button @click="helpMenuOpen = !helpMenuOpen" 
                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold px-6 py-4 rounded-full shadow-2xl flex items-center space-x-2 transition-all hover:scale-105">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="text-sm font-bold">Bantuan</span>
            <span class="w-2.5 h-2.5 bg-red-300 rounded-full animate-pulse"></span>
        </button>
    </div>

    <!-- AI Shop Assistant Chatbot (Simple & Minimal) -->
    <div x-data="aiChatbot()" class="fixed bottom-24 right-4 sm:right-6 top-20 z-40 pointer-events-none flex items-end" @open-ai-chat.window="isOpen = true">
        <!-- Chat Window - Smaller & Simpler -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="pointer-events-auto w-72 sm:w-80 max-h-full bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 flex flex-col"
             style="height: min(450px, calc(100vh - 10rem)); display: none;">
            
            <!-- Simple Header -->
            <div class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between flex-shrink-0">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                    <h3 class="font-semibold text-sm text-gray-900">Chat Assistant</h3>
                </div>
                <button @click="toggleChat()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Chat Messages with Scroll -->
            <div class="flex-1 overflow-y-auto p-3 space-y-3 bg-transparent min-h-0" x-ref="chatMessages">
                <!-- Welcome Message -->
                <div class="flex items-start space-x-2">
                    <div class="text-lg shrink-0">🤖</div>
                    <div class="bg-gray-100 rounded-lg rounded-tl-sm px-3 py-2 max-w-[85%]">
                        <p class="text-xs text-gray-700">Halo! Ada yang bisa saya bantu?</p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-1.5">
                    <button @click="sendQuickMessage('Bagaimana cara order?')" 
                            class="w-full text-left bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg px-3 py-2 text-xs text-gray-700 transition-all">
                        Bagaimana cara order?
                    </button>
                    <button @click="sendQuickMessage('Apakah produk asli?')" 
                            class="w-full text-left bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg px-3 py-2 text-xs text-gray-700 transition-all">
                        Apakah produk asli?
                    </button>
                    <button @click="sendQuickMessage('Metode pembayaran?')" 
                            class="w-full text-left bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg px-3 py-2 text-xs text-gray-700 transition-all">
                        Metode pembayaran?
                    </button>
                </div>

                <!-- Chat Messages Loop -->
                <template x-for="(msg, index) in messages" :key="index">
                    <div class="flex items-start space-x-2" :class="msg.sender === 'user' ? 'flex-row-reverse space-x-reverse' : ''">
                        <div class="text-lg shrink-0" x-text="msg.sender === 'user' ? '👤' : '🤖'"></div>
                        <div class="rounded-lg px-3 py-2 max-w-[85%]"
                             :class="msg.sender === 'user' ? 'bg-red-600 text-white rounded-tr-sm' : 'bg-gray-100 rounded-tl-sm'">
                            <p class="text-xs" :class="msg.sender === 'user' ? 'text-white' : 'text-gray-700'" x-html="msg.text"></p>
                        </div>
                    </div>
                </template>

                <!-- Loading Indicator -->
                <div x-show="isLoading" class="flex items-start space-x-2">
                    <div class="text-lg">🤖</div>
                    <div class="bg-gray-100 rounded-lg rounded-tl-sm px-3 py-2">
                        <div class="flex space-x-1">
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Input -->
            <div class="p-3 bg-white border-t border-gray-200 flex-shrink-0">
                <form @submit.prevent="sendMessage()" class="flex space-x-2">
                    <input type="text" x-model="currentMessage" 
                           placeholder="Tulis pesan..." 
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500">
                    <button type="submit" 
                            :disabled="!currentMessage.trim() || isLoading"
                            class="bg-red-600 hover:bg-red-700 disabled:bg-gray-300 text-white px-3 py-2 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function aiChatbot() {
            return {
                isOpen: false,
                isLoading: false,
                currentMessage: '',
                messages: [],
                
                toggleChat() {
                    this.isOpen = !this.isOpen;
                },
                
                async sendMessage() {
                    if (!this.currentMessage.trim() || this.isLoading) return;
                    
                    const userMessage = this.currentMessage;
                    this.messages.push({ sender: 'user', text: userMessage });
                    this.currentMessage = '';
                    this.scrollToBottom();
                    
                    this.isLoading = true;
                    
                    // Simulate AI response
                    setTimeout(() => {
                        const response = this.getAIResponse(userMessage);
                        this.messages.push({ sender: 'ai', text: response });
                        this.isLoading = false;
                        this.scrollToBottom();
                    }, 1000);
                },
                
                sendQuickMessage(message) {
                    this.currentMessage = message;
                    this.sendMessage();
                },
                
                getAIResponse(message) {
                    const lowerMsg = message.toLowerCase();
                    
                    if (lowerMsg.includes('order') || lowerMsg.includes('beli') || lowerMsg.includes('cara')) {
                        return '<strong>Cara Order:</strong><br>1. Pilih produk<br>2. Klik "Beli Sekarang"<br>3. <strong>Login dengan Google terlebih dahulu</strong> (wajib untuk lanjutkan pembayaran)<br>4. Isi form & bayar via Midtrans<br>5. Admin kirim akun via WhatsApp';
                    }
                    
                    if (lowerMsg.includes('login') || lowerMsg.includes('masuk') || lowerMsg.includes('akun')) {
                        return '<strong>Login Diperlukan!</strong><br>Anda harus login dengan akun Google terlebih dahulu sebelum melakukan pembayaran. Klik tombol "Beli Sekarang" pada produk, maka akan muncul halaman login Google. Setelah login, Anda bisa lanjutkan pembayaran.';
                    }
                    
                    if (lowerMsg.includes('refund') || lowerMsg.includes('pengembalian') || lowerMsg.includes('kembalikan')) {
                        return '<strong>Cara Refund:</strong><br>1. Buka menu "Pesanan Saya"<br>2. Klik tombol "Salin Kode" pada pesanan<br>3. Buka halaman "Cek Pesanan"<br>4. Masukkan kode pesanan<br>5. Klik "Ajukan Refund"<br>6. Admin proses 1x24 jam';
                    }
                    
                    if (lowerMsg.includes('garansi')) {
                        return '<strong>Tentang Garansi</strong><br>Kami memberikan garansi transparan sesuai ketentuan per produk. Silakan cek halaman <a href="/ketentuan" class="text-red-600 font-bold underline">Ketentuan & Garansi</a> untuk informasi lengkap.';
                    }
                    
                    if (lowerMsg.includes('pembayaran') || lowerMsg.includes('bayar') || lowerMsg.includes('metode')) {
                        return '<strong>Metode Pembayaran:</strong><br>• QRIS<br>• GoPay & ShopeePay<br>• Virtual Account<br>• Kartu Kredit/Debit<br><br>Via Midtrans (Aman)';
                    }
                    
                    if (lowerMsg.includes('berapa lama') || lowerMsg.includes('proses') || lowerMsg.includes('kirim')) {
                        return '<strong>Waktu Pengiriman:</strong><br>Setelah pembayaran terverifikasi, akun langsung dikirim ke WhatsApp Anda. Admin kami siap memproses pesanan dengan cepat!';
                    }
                    
                    if (lowerMsg.includes('harga') || lowerMsg.includes('diskon') || lowerMsg.includes('promo')) {
                        return '<strong>Harga & Promo</strong><br>Harga paling kompetitif! Cek katalog untuk promo terkini.';
                    }
                    
                    return 'Terima kasih! Untuk info lebih detail hubungi admin via WhatsApp.';
                },
                
                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.chatMessages;
                        container.scrollTop = container.scrollHeight;
                    });
                }
            }
        }
    </script>

</body>
</html>

