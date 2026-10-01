<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Adakuu')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f7f9fc; color: #1e293b; }
        .card-shadow { box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.08); }
    </style>
</head>
<body class="min-h-screen flex" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-white border-r border-gray-200 transition-all duration-300 flex flex-col h-screen sticky top-0">
        <!-- Logo -->
        <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100">
            <div class="flex items-center space-x-3" x-show="sidebarOpen">
                <div class="w-10 h-10 bg-transparent rounded-xl flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('image/image copy.png') }}" alt="Adakuu" class="w-10 h-10 object-contain">
                </div>
                <div>
                    <div class="font-black text-sm text-gray-900">Adakuu</div>
                    <div class="text-xs text-gray-500 font-medium">Admin Panel</div>
                </div>
            </div>
            <div x-show="!sidebarOpen" class="w-10 h-10 bg-transparent rounded-xl flex items-center justify-center overflow-hidden">
                <img src="{{ asset('image/image copy.png') }}" alt="Adakuu" class="w-10 h-10 object-contain">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-red-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-50 text-red-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span x-show="sidebarOpen">Kelola Pesanan</span>
            </a>

            <a href="{{ route('admin.products.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.products.*') ? 'bg-indigo-50 text-red-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span x-show="sidebarOpen">Kelola Produk</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-50 text-red-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span x-show="sidebarOpen">Pengaturan</span>
            </a>

            <div class="border-t border-gray-100 my-4"></div>

            <a href="{{ route('home') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-gray-600 hover:bg-gray-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span x-show="sidebarOpen">Lihat Website</span>
            </a>
        </nav>

        <!-- User Info & Logout -->
        <div class="p-4 border-t border-gray-100">
            <div x-show="sidebarOpen" class="mb-3 px-4 py-3 bg-indigo-50 rounded-xl">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-500">Administrator</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span x-show="sidebarOpen" class="font-medium">Logout</span>
                </button>
            </form>

            <button @click="sidebarOpen = !sidebarOpen" class="w-full mt-2 flex items-center justify-center px-4 py-2 rounded-xl text-gray-500 hover:bg-gray-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Bar -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div>
                <h1 class="text-2xl font-black text-gray-900">@yield('page-title', 'Dashboard')</h1>
                <p class="text-sm text-gray-500 mt-0.5">@yield('page-description', 'Selamat datang di Admin Panel')</p>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Notifications Dropdown -->
                <div x-data="{ 
                    open: false, 
                    hasViewed: sessionStorage.getItem('notifViewed') === 'true',
                    toggleNotif() {
                        this.open = !this.open;
                        if (this.open && !this.hasViewed) {
                            this.hasViewed = true;
                            sessionStorage.setItem('notifViewed', 'true');
                        }
                    }
                }" class="relative">
                    <button @click="toggleNotif()" class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @php
                            $totalNotif = \App\Models\Order::where('order_status', 'PAID')->count() + 
                                         \App\Models\Order::where('refund_status', 'REQUESTED')->count();
                        @endphp
                        <span x-show="!hasViewed && {{ $totalNotif }} > 0" class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                            {{ $totalNotif > 9 ? '9+' : $totalNotif }}
                        </span>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-200 z-50"
                         style="display: none;">
                        
                        <div class="p-4 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900">Notifikasi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $totalNotif }} notifikasi baru</p>
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            @php
                                $paidCount = \App\Models\Order::where('order_status', 'PAID')->count();
                                $refundCount = \App\Models\Order::where('refund_status', 'REQUESTED')->count();
                            @endphp

                            @if($paidCount > 0)
                            <a href="{{ route('admin.orders.paid') }}" class="block p-4 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center text-xl shrink-0">
                                        🔔
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-sm text-gray-900">Pembayaran Baru</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $paidCount }} pesanan menunggu diproses</p>
                                        <p class="text-xs text-red-600 font-medium mt-1">Klik untuk lihat →</p>
                                    </div>
                                </div>
                            </a>
                            @endif

                            @if($refundCount > 0)
                            <a href="{{ route('admin.orders.refunds') }}" class="block p-4 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center text-xl shrink-0">
                                        💰
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-sm text-gray-900">Refund Request</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $refundCount }} customer mengajukan refund</p>
                                        <p class="text-xs text-amber-600 font-medium mt-1">Klik untuk lihat →</p>
                                    </div>
                                </div>
                            </a>
                            @endif

                            @if($totalNotif === 0)
                            <div class="p-8 text-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-2xl mx-auto mb-3">
                                    ✅
                                </div>
                                <p class="text-sm text-gray-500 font-medium">Tidak ada notifikasi baru</p>
                            </div>
                            @endif
                        </div>

                        <div class="p-3 border-t border-gray-100">
                            <a href="{{ route('admin.orders.index') }}" class="block text-center text-sm font-semibold text-red-600 hover:text-red-700">
                                Lihat Semua Pesanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl flex items-center space-x-3">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl flex items-center space-x-3">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>

