@extends('layouts.app')

@section('title', $product->name . ' — Adakuu')

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ Str::limit(strip_tags($product->description), 200) }}",
    "image": "{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('image/image copy.png') }}",
    @if($product->platform)
    "brand": {
        "@@type": "Brand",
        "name": "{{ $product->platform->name }}"
    },
    @endif
    "offers": {
        "@@type": "AggregateOffer",
        "priceCurrency": "IDR",
        "lowPrice": "{{ $product->packages->min('price') }}",
        "highPrice": "{{ $product->packages->max('price') }}",
        "offerCount": "{{ $product->packages->count() }}",
        "availability": "https://schema.org/InStock",
        "seller": {
            "@@type": "Organization",
            "name": "Adakuu"
        }
    }
}
</script>
@endpush

@section('content')
<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8" x-data="{
    openCheckoutModal: false,
    selectedPackage: null
}">

    <!-- Top Feature Bar (Matching Reference Image 3 Header) -->
    <div class="bg-white rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 border border-gray-100 shadow-sm grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-4">
        <!-- Item 1 -->
        <div class="flex items-center space-x-2 sm:space-x-3 p-1 sm:p-2">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 font-bold text-sm sm:text-base">
                ⚡
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="font-bold text-[10px] sm:text-xs text-gray-900 truncate">Proses cepat</h4>
                <p class="text-[8px] sm:text-[10px] text-gray-500 truncate">Pesanan dipantau otomatis</p>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="flex items-center space-x-2 sm:space-x-3 p-1 sm:p-2">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 font-bold text-sm sm:text-base">
                💳
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="font-bold text-[10px] sm:text-xs text-gray-900 truncate">Bayar via QRIS</h4>
                <p class="text-[8px] sm:text-[10px] text-gray-500 truncate">Praktis dari aplikasi favoritmu</p>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="flex items-center space-x-2 sm:space-x-3 p-1 sm:p-2">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0 font-bold text-sm sm:text-base">
                🛡️
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="font-bold text-[10px] sm:text-xs text-gray-900 truncate">Ada garansi</h4>
                <p class="text-[8px] sm:text-[10px] text-gray-500 truncate">Sesuai ketentuan produk</p>
            </div>
        </div>

        <!-- Item 4 -->
        <div class="flex items-center space-x-2 sm:space-x-3 p-1 sm:p-2">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 font-bold text-sm sm:text-base">
                🎧
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="font-bold text-[10px] sm:text-xs text-gray-900 truncate">Bantuan langsung</h4>
                <p class="text-[8px] sm:text-[10px] text-gray-500 truncate">Admin siap membantu</p>
            </div>
        </div>
    </div>

    <!-- Product Title & Back Navigation Header -->
    <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ route('catalogue') }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-white border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-50 transition-all shadow-sm flex-shrink-0">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div class="flex items-center space-x-2 sm:space-x-4 flex-1 min-w-0">
            <x-product-logo :product="$product" size="w-10 h-10 sm:w-12 sm:h-12" class="flex-shrink-0" />
            <div class="min-w-0 flex-1">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 uppercase tracking-wide truncate">{{ $product->name }}</h1>
                <p class="text-[10px] sm:text-xs text-gray-500 font-medium truncate">Pilih paket yang sesuai dengan kebutuhan Anda</p>
            </div>
        </div>
    </div>

    <!-- Package Cards Grid (Reference Image 3 Card Layout) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($product->packages as $package)
        <div class="bg-white rounded-3xl p-6 border border-gray-100 card-shadow flex flex-col justify-between space-y-6 relative overflow-hidden transition-all hover:border-red-200
            @if(!$package->hasStock()) opacity-50 @endif">
            
            <!-- Top Tag -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    @if(!$package->hasStock())
                    <span class="inline-block text-[10px] font-black tracking-wider uppercase px-3 py-1 rounded-full bg-gray-200 text-gray-500">
                        SOLD OUT
                    </span>
                    @elseif($package->badge)
                    <span class="inline-block text-[10px] font-black tracking-wider uppercase px-3 py-1 rounded-full
                        @if($package->badge == 'PROMO') bg-emerald-500 text-white
                        @else bg-gray-700 text-white @endif">
                        {{ $package->badge }}
                    </span>
                    @endif
                    
                    @if($package->hasStock() && $package->remaining_stock <= 5 && $package->remaining_stock > 0)
                    <span class="inline-block text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">
                        Sisa {{ $package->remaining_stock }}
                    </span>
                    @endif
                </div>

                <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 text-xl font-bold">
                    ✨
                </div>
            </div>

            <!-- Content -->
            <div class="space-y-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">{{ $product->name }}</span>
                <h3 class="text-2xl font-black text-gray-900 leading-tight">{{ $package->name }}</h3>
                <p class="text-xs text-gray-500">Kenali produk dan ketentuannya sebelum membeli.</p>

                <div class="pt-2">
                    <span class="text-2xl font-black text-red-600">Rp{{ number_format($package->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Accordion Details (Reference Image 3 Accordions) -->
            <div class="space-y-2 pt-2 border-t border-gray-100" x-data="{ tab: null }">
                <!-- Accordion 1: Deskripsi produk -->
                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="tab = tab === 1 ? null : 1" class="w-full px-4 py-3 bg-gray-50/70 hover:bg-gray-100/70 flex items-center justify-between text-xs font-bold text-gray-700">
                        <span class="flex items-center space-x-2">
                            <span>📄</span>
                            <span>Deskripsi produk</span>
                        </span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{'rotate-180': tab === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="tab === 1" class="p-4 bg-white text-xs text-gray-600 leading-relaxed border-t border-gray-100">
                        {{ $package->description ?? 'Tidak ada deskripsi tambahan.' }}
                    </div>
                </div>

                <!-- Accordion 2: Ketentuan & garansi -->
                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="tab = tab === 2 ? null : 2" class="w-full px-4 py-3 bg-gray-50/70 hover:bg-gray-100/70 flex items-center justify-between text-xs font-bold text-gray-700">
                        <span class="flex items-center space-x-2">
                            <span>🛡️</span>
                            <span>Ketentuan & garansi produk</span>
                        </span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{'rotate-180': tab === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="tab === 2" class="p-4 bg-white text-xs text-gray-600 leading-relaxed border-t border-gray-100">
                        {{ $package->terms ?? 'Garansi sesuai masa aktif paket.' }}
                    </div>
                </div>
            </div>

            <!-- Buy Action Button -->
            <div class="pt-2">
                @if($package->is_available && $package->hasStock())
                    @auth
                        <button @click="selectedPackage = {{ json_encode($package) }}; openCheckoutModal = true;"
                                class="w-full py-3.5 px-6 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-md shadow-red-200 transition-all flex items-center justify-center space-x-2">
                            <span>Beli Sekarang</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    @else
                        <a href="{{ route('customer.login', ['redirect' => route('products.show', $product->slug), 'package' => $package->id]) }}"
                           class="w-full py-3.5 px-6 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-md shadow-red-200 transition-all flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Login untuk Beli</span>
                        </a>
                    @endauth
                @else
                <button disabled class="w-full py-3.5 px-6 rounded-2xl bg-gray-300 text-gray-500 font-bold text-sm cursor-not-allowed flex items-center justify-center space-x-2">
                    <span>❌</span>
                    <span>Sold Out</span>
                </button>
                @endif
            </div>

        </div>
        @endforeach
    </div>

    <!-- Checkout Modal with Solid Dark Backdrop -->
    <div x-show="openCheckoutModal" 
         @keydown.escape.window="openCheckoutModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9999] bg-gray-900/95 overflow-y-auto" 
         x-cloak>
        
        <!-- Modal Content Container -->
        <div class="flex items-center justify-center min-h-screen p-3 sm:p-4">
            <div @click.away="openCheckoutModal = false" 
                 x-transition:enter="transition ease-out duration-300 delay-75"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-90"
                 class="bg-white rounded-2xl w-full max-w-sm sm:max-w-md p-4 sm:p-5 shadow-2xl border border-gray-100 space-y-3 sm:space-y-4 max-h-[90vh] overflow-y-auto">
                
                <!-- Header -->
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <h3 class="text-base sm:text-lg font-black text-gray-900">Form Pemesanan</h3>
                    <button @click="openCheckoutModal = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Product Info -->
                <div class="bg-gradient-to-br from-red-50 to-pink-50 p-3 rounded-xl border border-red-200">
                    <p class="text-[10px] sm:text-xs text-red-700 font-semibold">Produk yang dipilih:</p>
                    <h4 class="text-sm sm:text-base font-black text-red-900" x-text="selectedPackage ? selectedPackage.name : ''"></h4>
                    <p class="text-xs sm:text-sm font-bold text-red-600 mt-1" x-text="selectedPackage ? 'Rp' + new Intl.NumberFormat('id-ID').format(selectedPackage.price) : ''"></p>
                </div>

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-3" x-data="{ quantity: 1, packagePrice: 0 }">
                @csrf
                <input type="hidden" name="package_id" :value="selectedPackage ? selectedPackage.id : ''">

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="customer_name" required placeholder="Contoh: Muhammad Zaki"
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-xs sm:text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor WhatsApp (Aktif)</label>
                    <input type="text" name="customer_whatsapp" required placeholder="Contoh: 081234567890"
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-xs sm:text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-600 outline-none">
                    <p class="text-[9px] sm:text-[10px] text-gray-500 mt-1">Admin akan menghubungi kamu melalui nomor ini.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Jumlah Akun</label>
                    <div class="flex items-center space-x-2">
                        <button type="button" @click="if(quantity > 1) quantity--" 
                                class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center font-bold text-gray-700 transition-all">
                            −
                        </button>
                        <input type="number" name="quantity" x-model="quantity" min="1" max="10" required
                               class="w-16 text-center px-2 py-2.5 rounded-lg border border-gray-200 text-xs font-bold focus:ring-2 focus:ring-red-500/20 focus:border-red-600 outline-none">
                        <button type="button" @click="if(quantity < 10) quantity++" 
                                class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center font-bold text-gray-700 transition-all">
                            +
                        </button>
                        <div class="flex-1 text-right">
                            <p class="text-[9px] text-gray-500">Total:</p>
                            <p class="text-sm font-black text-red-600" x-text="'Rp' + ((selectedPackage ? selectedPackage.price : 0) * quantity).toLocaleString('id-ID')"></p>
                        </div>
                    </div>
                    <p class="text-[9px] text-gray-500 mt-1">Maksimal 10 akun per pesanan</p>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs sm:text-sm shadow-lg shadow-red-200 transition-all">
                        Lanjut ke Pembayaran QRIS
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

</div>
@endsection

