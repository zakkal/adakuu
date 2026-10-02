<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <!-- Notifications Dropdown with Real-time Updates -->
                <div x-data="notificationDropdown()" @notification-updated.window="loadNotifications()" class="relative">
                    <button @click="toggle()" class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <!-- Badge Counter -->
                        <span x-show="unreadCount > 0" 
                              x-text="unreadCount > 99 ? '99+' : unreadCount"
                              class="absolute top-0 right-0 flex items-center justify-center min-w-[20px] h-5 px-1 text-xs font-bold text-white bg-red-500 rounded-full"
                              x-transition></span>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 mt-2 w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 z-50"
                         style="display: none;">
                        
                        <!-- Header -->
                        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-gray-900">Notifikasi</h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    <span x-text="unreadCount"></span> notifikasi belum dibaca
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button @click="markAllAsRead()" 
                                        x-show="unreadCount > 0"
                                        class="text-xs font-semibold text-red-600 hover:text-red-700 transition-colors">
                                    Tandai Semua
                                </button>
                                <button @click="deleteAll()" 
                                        x-show="notifications.length > 0"
                                        class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Notifications List (Scrollable) -->
                        <div class="max-h-[28rem] overflow-y-auto">
                            <template x-if="loading">
                                <div class="p-8 text-center">
                                    <div class="inline-block w-8 h-8 border-4 border-gray-200 border-t-red-600 rounded-full animate-spin"></div>
                                    <p class="text-sm text-gray-500 mt-3">Memuat notifikasi...</p>
                                </div>
                            </template>

                            <template x-if="!loading && notifications.length === 0">
                                <div class="p-8 text-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-3">
                                        🔔
                                    </div>
                                    <p class="text-sm text-gray-900 font-semibold">Tidak ada notifikasi</p>
                                    <p class="text-xs text-gray-500 mt-1">Semua aktivitas customer akan muncul di sini</p>
                                </div>
                            </template>

                            <template x-for="notif in notifications" :key="notif.id">
                                <div class="relative group border-b border-gray-100 last:border-0">
                                    <!-- Unread Indicator -->
                                    <div x-show="!notif.is_read" class="absolute left-0 top-0 bottom-0 w-1 bg-red-500"></div>
                                    
                                    <div class="p-4 hover:bg-gray-50 transition-colors" :class="!notif.is_read ? 'bg-red-50/30' : ''">
                                        <div class="flex items-start space-x-3">
                                            <!-- Icon -->
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl shrink-0"
                                                 :class="{
                                                     'bg-blue-100': notif.type === 'checkout',
                                                     'bg-emerald-100': notif.type === 'payment_success',
                                                     'bg-amber-100': notif.type === 'refund_request',
                                                     'bg-purple-100': notif.type === 'warranty_claim'
                                                 }">
                                                <span x-text="getIcon(notif.type)"></span>
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between gap-2">
                                                    <div class="flex-1">
                                                        <p class="font-semibold text-sm text-gray-900" x-text="notif.title"></p>
                                                        <p class="text-xs text-gray-600 mt-0.5" x-text="notif.message"></p>
                                                        
                                                        <!-- Additional Data -->
                                                        <template x-if="notif.data">
                                                            <div class="mt-2 p-2 bg-white rounded-lg border border-gray-200 text-xs space-y-1">
                                                                <div class="flex justify-between">
                                                                    <span class="text-gray-500">Order:</span>
                                                                    <span class="font-semibold text-gray-900" x-text="'#' + (notif.data.order_number || '')"></span>
                                                                </div>
                                                                <div class="flex justify-between">
                                                                    <span class="text-gray-500">Produk:</span>
                                                                    <span class="font-medium text-gray-900 truncate max-w-[180px]" x-text="notif.data.product_name || ''"></span>
                                                                </div>
                                                                <div class="flex justify-between">
                                                                    <span class="text-gray-500">Total:</span>
                                                                    <span class="font-bold text-red-600" x-text="'Rp' + (notif.data.total_amount ? parseInt(notif.data.total_amount).toLocaleString('id-ID') : '0')"></span>
                                                                </div>
                                                            </div>
                                                        </template>

                                                        <p class="text-xs text-gray-400 mt-2" x-text="formatDate(notif.created_at)"></p>
                                                    </div>

                                                    <!-- Actions -->
                                                    <div class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <button @click="markAsRead(notif.id)" 
                                                                x-show="!notif.is_read"
                                                                class="p-1.5 text-gray-400 hover:text-green-600 rounded-lg hover:bg-green-50 transition-all"
                                                                title="Tandai sudah dibaca">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                        </button>
                                                        <button @click="deleteNotification(notif.id)" 
                                                                class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-all"
                                                                title="Hapus notifikasi">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Footer -->
                        <div class="p-3 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                            <a href="{{ route('admin.orders.index') }}" class="block text-center text-sm font-semibold text-red-600 hover:text-red-700 transition-colors">
                                Lihat Semua Pesanan →
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

    <script>
        function notificationDropdown() {
            return {
                open: false,
                loading: false,
                notifications: [],
                unreadCount: 0,
                pollInterval: null,

                init() {
                    this.loadNotifications();
                    // Poll every 30 seconds for new notifications
                    this.pollInterval = setInterval(() => {
                        this.loadNotifications();
                    }, 30000);
                },

                toggle() {
                    this.open = !this.open;
                    if (this.open && this.notifications.length === 0) {
                        this.loadNotifications();
                    }
                },

                async loadNotifications() {
                    try {
                        const response = await fetch('{{ route("admin.notifications.index") }}');
                        const data = await response.json();
                        this.notifications = data.notifications;
                        this.unreadCount = data.unread_count;
                    } catch (error) {
                        console.error('Error loading notifications:', error);
                    }
                },

                async markAsRead(id) {
                    try {
                        const response = await fetch(`/admin/notifications/${id}/read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                            }
                        });
                        
                        if (response.ok) {
                            await this.loadNotifications();
                        }
                    } catch (error) {
                        console.error('Error marking notification as read:', error);
                    }
                },

                async markAllAsRead() {
                    try {
                        const response = await fetch('{{ route("admin.notifications.readAll") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                            }
                        });
                        
                        if (response.ok) {
                            await this.loadNotifications();
                        }
                    } catch (error) {
                        console.error('Error marking all as read:', error);
                    }
                },

                async deleteNotification(id) {
                    if (!confirm('Hapus notifikasi ini?')) return;
                    
                    try {
                        const response = await fetch(`/admin/notifications/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                            }
                        });
                        
                        if (response.ok) {
                            await this.loadNotifications();
                        }
                    } catch (error) {
                        console.error('Error deleting notification:', error);
                    }
                },

                async deleteAll() {
                    if (!confirm('Hapus semua notifikasi? Tindakan ini tidak dapat dibatalkan.')) return;
                    
                    try {
                        const response = await fetch('{{ route("admin.notifications.destroyAll") }}', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                            }
                        });
                        
                        if (response.ok) {
                            await this.loadNotifications();
                        }
                    } catch (error) {
                        console.error('Error deleting all notifications:', error);
                    }
                },

                getIcon(type) {
                    const icons = {
                        'checkout': '🛒',
                        'refund_request': '💸',
                        'payment_success': '✅',
                        'refund_approved': '✔️',
                        'refund_rejected': '❌',
                        'warranty_claim': '🛡️'
                    };
                    return icons[type] || '📢';
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diff = Math.floor((now - date) / 1000); // seconds

                    if (diff < 60) return 'Baru saja';
                    if (diff < 3600) return `${Math.floor(diff / 60)} menit yang lalu`;
                    if (diff < 86400) return `${Math.floor(diff / 3600)} jam yang lalu`;
                    if (diff < 604800) return `${Math.floor(diff / 86400)} hari yang lalu`;
                    
                    return date.toLocaleDateString('id-ID', { 
                        day: 'numeric', 
                        month: 'short', 
                        year: 'numeric' 
                    });
                }
            }
        }
    </script>
</body>
</html>

