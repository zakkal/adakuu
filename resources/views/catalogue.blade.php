@extends('layouts.app')

@section('title', 'Pilih Platform — Adakuu')

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "CollectionPage",
    "name": "Katalog Platform Premium",
    "description": "Pilihan lengkap akun premium untuk berbagai platform",
    "url": "{{ route('catalogue') }}"
}
</script>
@endpush

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-10">

    <!-- Top Banner (Matching Reference Image 2) -->
    <div class="relative bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-3xl p-8 sm:p-12 overflow-hidden border border-red-100">
        <div class="max-w-xl space-y-4 relative z-10">
            <span class="inline-flex items-center space-x-1.5 bg-red-100 text-red-700 text-xs font-bold px-3.5 py-1.5 rounded-full">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 002-2h2a2 2 0 002 2v2a2 2 0 00-2 2h-2a2 2 0 00-2-2V5zM11 13a2 2 0 002-2h2a2 2 0 002 2v2a2 2 0 00-2 2h-2a2 2 0 00-2-2v-2z"/></svg>
                <span>Koleksi Pilihan</span>
            </span>
            <h1 class="text-4xl sm:text-5xl font-black text-gray-900 tracking-tight">
                Pilih <span class="text-red-600">Platform.</span>
            </h1>
            <p class="text-base text-gray-600">
                Tersedia 12 kategori eksklusif dengan berbagai pilihan aplikasi terbaik.
            </p>
        </div>

        <!-- Akunku Logo dengan Animasi Flip -->
        <div class="absolute right-6 top-1/2 -translate-y-1/2 hidden md:block">
            <div class="w-48 h-48 bg-gradient-to-br from-red-500 to-red-600 rounded-3xl opacity-20 blur-2xl"></div>
            <div class="absolute inset-0 flex items-center justify-center" style="animation: flip 3s ease-in-out infinite;">
                <img src="{{ asset('image/image copy.png') }}" alt="Adakuu Logo" class="w-40 h-40 object-contain drop-shadow-2xl rounded-2xl" loading="lazy">
            </div>
        </div>

        <style>
            @keyframes flip {
                0%, 100% { transform: perspective(400px) rotateY(0deg); }
                50% { transform: perspective(400px) rotateY(180deg); }
            }
        </style>
    </div>

    <!-- Category Section & Filter Header -->
    @foreach($categories as $category)
    @php
        $categoryProducts = $products->where('category_id', $category->id);
    @endphp

    @if($categoryProducts->count() > 0)
    <div class="space-y-6">
        <!-- Section Header -->
        <div class="flex items-center justify-between border-b border-gray-200/80 pb-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-700 flex items-center justify-center font-bold text-lg">
                    🤖
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900">{{ $category->name }}</h2>
                    <p class="text-xs text-gray-500">{{ $category->description }}</p>
                </div>
            </div>
            <span class="bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full">
                {{ $categoryProducts->count() }} Aplikasi →
            </span>
        </div>

        <!-- Product Cards (Reference Image 2 style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            @foreach($categoryProducts as $product)
            <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 border border-gray-100 card-shadow hover:shadow-xl transition-all flex flex-col justify-between space-y-4 sm:space-y-6 relative overflow-hidden group">
                
                <!-- Badge Tag -->
                @if($product->badge)
                <div class="absolute top-4 sm:top-6 right-4 sm:right-6">
                    <span class="inline-flex items-center space-x-1 text-[10px] sm:text-xs font-bold px-2 sm:px-3 py-1 rounded-full
                        @if($product->badge == 'Populer') bg-emerald-50 text-emerald-700 border border-emerald-200
                        @elseif($product->badge == 'Rekomendasi') bg-purple-50 text-red-700 border border-red-200
                        @else bg-amber-50 text-amber-700 border border-amber-200
                        @endif">
                        <span>★</span>
                        <span>{{ $product->badge }}</span>
                    </span>
                </div>
                @endif

                <div class="space-y-3 sm:space-y-4">
                    <!-- Icon -->
                    <x-product-logo :product="$product" size="w-12 h-12 sm:w-16 sm:h-16" />

                    <!-- Title & Varian -->
                    <div>
                        <h3 class="text-base sm:text-xl font-black text-gray-900 tracking-tight">{{ $product->name }}</h3>
                        <p class="text-[10px] sm:text-xs font-bold text-gray-500 mt-1">{{ $product->packages->count() }} varian tersedia</p>
                    </div>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed line-clamp-2">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- CTA Button -->
                <div class="pt-2">
                    <a href="{{ route('products.show', $product->slug) }}" 
                       class="w-fit inline-flex items-center space-x-2 border border-gray-200 hover:border-red-600 text-gray-800 hover:text-red-600 bg-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-full text-[10px] sm:text-xs font-bold transition-all group-hover:bg-indigo-50">
                        <span>Lihat paket</span>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach

</div>
@endsection

