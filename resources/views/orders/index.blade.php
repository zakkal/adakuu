@extends('layouts.app')

@section('title', 'Cek Pesanan Saya — Adakuu')

@section('content')
<div class="py-6 sm:py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6 sm:space-y-8">

    <!-- Header & Search Box -->
    <div class="bg-white p-5 sm:p-8 rounded-2xl sm:rounded-3xl border border-gray-100 card-shadow space-y-4 sm:space-y-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900">Pesanan Saya</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Masukkan Order ID atau Nomor WhatsApp untuk melacak status pesanan Anda.</p>
        </div>

        <form action="{{ route('orders.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            <input type="text" name="search" placeholder="Contoh: YP-20260928-XXX" value="{{ request('search') }}"
                   class="flex-1 px-4 sm:px-5 py-3 sm:py-3.5 bg-gray-50 border border-gray-200 rounded-xl sm:rounded-2xl text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-600 outline-none">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl shadow-md transition-all">
                Cari Pesanan
            </button>
        </form>
    </div>

    <!-- Results List -->
    @if(request()->filled('search'))
    <div class="space-y-3 sm:space-y-4">
        <h2 class="text-base sm:text-lg font-bold text-gray-900">Hasil Pencarian:</h2>

        @forelse($orders as $order)
        <div class="bg-white p-4 sm:p-6 rounded-2xl sm:rounded-3xl border border-gray-100 card-shadow space-y-3 sm:space-y-4">
            <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row sm:items-center justify-between border-b border-gray-100 pb-3 sm:pb-4">
                <div>
                    <span class="text-xs text-gray-400 block font-semibold">Order ID</span>
                    <h3 class="text-base sm:text-lg font-black text-gray-900">#{{ $order->order_number }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-2.5 sm:px-3 py-1 rounded-full text-xs font-bold
                        @if($order->payment_status == 'PAID') bg-emerald-50 text-emerald-700 border border-emerald-200
                        @else bg-amber-50 text-amber-700 border border-amber-200 @endif">
                        Pembayaran: {{ $order->payment_status == 'PAID' ? '✓ Berhasil' : 'Menunggu' }}
                    </span>

                    <span class="px-2.5 sm:px-3 py-1 rounded-full text-xs font-bold
                        @if($order->order_status == 'COMPLETED') bg-emerald-100 text-emerald-800
                        @elseif($order->order_status == 'PROCESSING') bg-blue-100 text-blue-800
                        @elseif($order->order_status == 'PAID') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-700 @endif">
                        Pesanan: 
                        @if($order->order_status == 'COMPLETED') ✓ Selesai
                        @elseif($order->order_status == 'PROCESSING') ● Diproses
                        @elseif($order->order_status == 'PAID') ● Menunggu
                        @else Pending
                        @endif
                    </span>
                </div>
            </div>

            <!-- Product details -->
            <div class="flex items-start sm:items-center justify-between gap-3">
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 text-sm sm:text-base">{{ $order->package->product->name }}</h4>
                    <p class="text-xs text-gray-500 font-medium">{{ $order->package->name }}</p>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-400 block">Total</span>
                    <span class="font-black text-red-600 text-sm sm:text-base whitespace-nowrap">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Admin Note Message -->
            @if($order->admin_note)
            <div class="bg-indigo-50/70 p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-red-100 text-xs space-y-1">
                <span class="font-bold text-red-900 block">Pesan dari Admin:</span>
                <p class="text-red-700 whitespace-pre-line">{{ $order->admin_note }}</p>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2 sm:gap-3 pt-2">
                <a href="{{ route('orders.show', $order->order_number) }}" class="px-4 sm:px-5 py-2.5 rounded-full border border-gray-200 hover:bg-gray-50 text-xs font-bold text-gray-700 text-center">
                    Lihat Detail
                </a>

                <a href="{{ $order->whatsapp_link }}" target="_blank" class="px-4 sm:px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-100 flex items-center justify-center space-x-1.5">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/></svg>
                    <span>Chat Admin</span>
                </a>
            </div>
        </div>
        @empty
        <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl text-center border border-gray-100 text-gray-500 text-sm">
            Tidak ditemukan pesanan dengan kata kunci tersebut.
        </div>
        @endforelse
    </div>
    @endif

</div>
@endsection

