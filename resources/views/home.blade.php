@extends('layouts.app')

@section('title', 'Adakuu — Tingkatkan Produktivitas. Nikmati Hiburan.')

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebSite",
    "name": "Adakuu",
    "url": "{{ url('/') }}",
    "potentialAction": {
        "@@type": "SearchAction",
        "target": "{{ route('catalogue') }}?search={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Store",
    "name": "Adakuu",
    "description": "Solusi akun premium murah, aman, dan instan",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('image/image copy.png') }}",
    "priceRange": "Rp 10.000 - Rp 500.000"
}
</script>
@endpush

@section('content')
<div class="gradient-hero min-h-[85vh] sm:min-h-[90vh] py-8 sm:py-12 px-4 sm:px-6 lg:px-8 flex flex-col justify-center">
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-12 items-center">
        
        <!-- Left Hero Text & CTA -->
        <div class="lg:col-span-6 space-y-4 sm:space-y-6">
            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-red-50 border border-red-200 text-red-700 px-3 py-1 rounded-full text-[11px] font-bold uppercase">
                💎 Premium Digital, Tanpa Ribet
            </div>

            <!-- Title -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 tracking-tight leading-tight">
                Tingkatkan <br>
                <span class="text-red-600">Produktivitas.</span><br>
                <span class="text-red-600">Nikmati Hiburan.</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-sm sm:text-base text-gray-600 leading-relaxed max-w-lg">
                Solusi akun premium murah, aman, dan instan.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <a href="{{ route('catalogue') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-red-200 flex items-center justify-center space-x-2 transition-all text-sm">
                    <span>Lihat Katalog</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>

                <a href="{{ route('orders.index') }}" class="bg-white hover:bg-gray-50 text-gray-800 font-bold px-6 py-3 rounded-xl border border-gray-200 shadow-sm flex items-center justify-center space-x-2 transition-all text-sm">
                    <span>Cek Pesanan</span>
                </a>
            </div>

            <!-- Features Highlights - Clean & Professional -->
            <div class="grid grid-cols-3 gap-2 sm:gap-3 pt-4 sm:pt-6">
                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-white border border-gray-200 flex items-center justify-center mb-1.5 sm:mb-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <span class="text-[10px] sm:text-xs font-semibold text-gray-700">Aman</span>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-white border border-gray-200 flex items-center justify-center mb-1.5 sm:mb-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <span class="text-[10px] sm:text-xs font-semibold text-gray-700">Premium</span>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-white border border-gray-200 flex items-center justify-center mb-1.5 sm:mb-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-[10px] sm:text-xs font-semibold text-gray-700">24/7</span>
                </div>
            </div>
        </div>

        <!-- Right Side Card Grid Showcase -->
        <div class="lg:col-span-6 bg-white p-4 sm:p-6 rounded-2xl border border-gray-200">
            <!-- Card Header -->
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900">Pilihan Premium</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Semua kebutuhan digitalmu</p>
                </div>
                <div class="flex items-center space-x-1.5 bg-emerald-50 text-emerald-700 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg text-[10px] font-semibold border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Tersedia</span>
                </div>
            </div>

            <!-- Apps Grid - Responsive: 2 cols mobile, 3 cols tablet, 4 cols desktop -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($featuredProducts as $product)
                <a href="{{ route('products.show', $product->slug) }}" 
                   class="group bg-gray-50 hover:bg-gray-100 p-3 sm:p-3 rounded-xl border border-gray-200 hover:border-gray-300 transition-all flex flex-col items-center text-center">
                    <!-- Icon Box -->
                    <x-product-logo :product="$product" size="w-14 h-14 sm:w-12 sm:h-12 mb-2" />

                    <h4 class="font-bold text-xs sm:text-[11px] text-gray-900 uppercase">{{ $product->name }}</h4>
                    <p class="text-[10px] sm:text-[9px] text-gray-500 mt-0.5 line-clamp-1">{{ $product->category->name ?? 'Produktivitas' }}</p>
                    
                    <span class="inline-flex items-center text-xs sm:text-[10px] font-semibold text-red-600 mt-2 group-hover:translate-x-0.5 transition-transform">
                        Lihat
                        <svg class="w-3 h-3 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>
                @endforeach
            </div>

            <div class="mt-4 sm:mt-5 pt-4 sm:pt-5 border-t border-gray-100 text-center">
                <a href="{{ route('catalogue') }}" class="inline-flex items-center space-x-1.5 text-sm font-semibold text-red-600 hover:text-red-700">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection