@extends('layouts.app')

@section('title', 'Pembayaran Berhasil — Adakuu')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto space-y-8">

    <!-- Success Header Card -->
    <div class="bg-white rounded-3xl p-8 border border-gray-100 card-shadow text-center space-y-6">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-4xl shadow-inner">
            🎉
        </div>

        <div class="space-y-2">
            <h1 class="text-3xl font-black text-gray-900">Pembayaran Berhasil 🎉</h1>
            <p class="text-base font-bold text-gray-700">Pesanan kamu sudah kami terima.</p>
            <p class="text-sm text-gray-500 max-w-md mx-auto">
                Admin akan segera menghubungi kamu melalui WhatsApp untuk proses pesanan.
            </p>
        </div>

        <!-- Order Summary Details -->
        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 space-y-3 text-left text-sm">
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Order ID:</span>
                <span class="font-black text-gray-900">#{{ $order->order_number }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Produk:</span>
                <span class="font-bold text-gray-900">{{ $order->package->product->name }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Paket:</span>
                <span class="font-bold text-gray-900">{{ $order->package->name }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Total Pembayaran:</span>
                <span class="font-black text-red-600 text-base">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Metode Pembayaran:</span>
                <span class="font-bold text-gray-900">{{ $order->payment_method }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Status Pembayaran:</span>
                <span class="inline-flex items-center space-x-1 text-emerald-600 font-bold">
                    <span>✓</span>
                    <span>Pembayaran Berhasil</span>
                </span>
            </div>
        </div>

        <!-- Status Indicators -->
        <div class="bg-indigo-50/70 border border-red-100 p-4 rounded-2xl text-left space-y-2 text-xs font-bold">
            <div class="flex items-center space-x-2 text-emerald-600">
                <span>✓</span>
                <span>Pembayaran Berhasil</span>
            </div>
            <div class="flex items-center space-x-2 text-red-700">
                <span class="w-2 h-2 rounded-full bg-red-600 animate-ping"></span>
                <span>● Menunggu Diproses Admin</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
            <a href="{{ route('orders.show', $order->order_number) }}" 
               class="w-full sm:w-1/2 py-4 rounded-2xl bg-white border border-gray-200 hover:bg-gray-50 text-gray-800 font-bold text-sm shadow-sm transition-all text-center">
                Lihat Pesanan
            </a>

            <a href="{{ $order->whatsapp_link }}" target="_blank"
               class="w-full sm:w-1/2 py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-200 transition-all flex items-center justify-center space-x-2">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/>
                </svg>
                <span>Hubungi Admin via WhatsApp</span>
            </a>
        </div>

    </div>

</div>
@endsection

