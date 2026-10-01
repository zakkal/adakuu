@extends('layouts.app')

@section('title', 'Riwayat Pesanan — Adakuu')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-3xl p-6 sm:p-8 border border-red-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900">📦 Riwayat Pesanan</h1>
                <p class="text-xs sm:text-sm text-gray-600 mt-2">Semua pesanan Anda tersimpan di sini</p>
            </div>
            <div class="flex items-center space-x-2 sm:space-x-3">
                <a href="{{ route('home') }}" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-700 text-xs sm:text-sm font-bold hover:bg-gray-50 transition-all text-center">
                    ← Beranda
                </a>
                <a href="{{ route('catalogue') }}" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 rounded-xl bg-red-600 text-white text-xs sm:text-sm font-bold hover:bg-red-700 transition-all text-center">
                    Belanja Lagi
                </a>
            </div>
        </div>
    </div>

    {{-- User Info --}}
    <div class="bg-white rounded-2xl p-6 border border-gray-100 card-shadow">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-black text-xl">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h3 class="font-black text-gray-900">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>

    {{-- Orders List --}}
    @if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="bg-white rounded-2xl border border-gray-100 card-shadow overflow-hidden hover:border-red-200 transition-all">
            <div class="p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-4 gap-3">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase">Order ID</span>
                            <span class="font-black text-sm sm:text-base text-gray-900">#{{ $order->order_number }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <x-product-logo :product="$order->package->product" size="w-7 h-7 sm:w-8 sm:h-8" />
                            <div>
                                <h3 class="font-black text-sm sm:text-base text-gray-900">{{ $order->package->product->name }}</h3>
                                <p class="text-[10px] sm:text-xs text-gray-500">{{ $order->package->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-left sm:text-right">
                        <p class="text-lg sm:text-xl font-black text-red-600">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        <span class="inline-block mt-2 px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full text-[9px] sm:text-[10px] font-bold
                            @if($order->order_status == 'COMPLETED') bg-emerald-100 text-emerald-800
                            @elseif($order->order_status == 'PROCESSING') bg-blue-100 text-blue-800
                            @elseif($order->order_status == 'PAID') bg-red-100 text-red-800
                            @elseif($order->order_status == 'PENDING') bg-amber-100 text-amber-800
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $order->order_status }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-3 sm:pt-4 border-t border-gray-100 gap-2">
                    <div class="text-[10px] sm:text-xs text-gray-500">
                        <span class="font-semibold">Tanggal:</span> {{ $order->created_at->format('d M Y, H:i') }}
                    </div>
                    <button 
                        x-data="{ copied: false }"
                        @click="
                            const text = '{{ $order->order_number }}';
                            if (navigator.clipboard && navigator.clipboard.writeText) {
                                navigator.clipboard.writeText(text).then(() => {
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                }).catch(() => {
                                    const textarea = document.createElement('textarea');
                                    textarea.value = text;
                                    textarea.style.position = 'fixed';
                                    textarea.style.opacity = '0';
                                    document.body.appendChild(textarea);
                                    textarea.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(textarea);
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                });
                            } else {
                                const textarea = document.createElement('textarea');
                                textarea.value = text;
                                textarea.style.position = 'fixed';
                                textarea.style.opacity = '0';
                                document.body.appendChild(textarea);
                                textarea.select();
                                document.execCommand('copy');
                                document.body.removeChild(textarea);
                                copied = true;
                                setTimeout(() => copied = false, 2000);
                            }
                        "
                        class="inline-flex items-center justify-center space-x-2 px-3 sm:px-4 py-2 rounded-xl bg-gray-50 hover:bg-red-50 border border-gray-200 hover:border-red-200 text-gray-700 hover:text-red-600 text-xs font-bold transition-all">
                        <svg x-show="!copied" class="w-3 sm:w-3.5 h-3 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <svg x-show="copied" class="w-3 sm:w-3.5 h-3 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Kode'">Salin Kode</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @else
    {{-- Empty State --}}
    <div class="bg-white rounded-3xl p-12 text-center border border-gray-100">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2">Belum Ada Pesanan</h3>
        <p class="text-sm text-gray-500 mb-6">Anda belum melakukan pembelian apapun</p>
        <a href="{{ route('catalogue') }}" class="inline-flex items-center space-x-2 px-6 py-3 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition-all">
            <span>Mulai Belanja</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>
    @endif

</div>
@endsection
