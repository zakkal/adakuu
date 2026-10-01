@extends('layouts.admin')

@section('title', 'Refund Requests - Admin Panel')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Permintaan Refund</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar customer yang mengajukan refund dan menunggu persetujuan</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" 
           class="inline-flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Alert Box -->
    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-lg">
        <div class="flex items-center space-x-3">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium text-amber-800">
                <strong>{{ $orders->total() }} refund request</strong> menunggu persetujuan. Pastikan transfer dana sebelum approve.
            </p>
        </div>
    </div>

    <!-- Orders Grid -->
    <div class="grid gap-6">
        @forelse($orders as $order)
        <div class="bg-white rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="p-6 space-y-4">
                <!-- Order Header -->
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">#{{ $order->order_number }}</h3>
                        <p class="text-sm text-gray-500 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                    <span class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold">
                        💰 REFUND REQUEST
                    </span>
                </div>

                <!-- Customer & Product Info -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-xs text-gray-500">Customer</p>
                        <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">WhatsApp</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_whatsapp }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Produk</p>
                        <p class="font-semibold text-gray-900">{{ $order->package->product->name }}</p>
                        <p class="text-xs text-gray-500">{{ $order->package->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Refund Amount</p>
                        <p class="font-bold text-red-600 text-lg">Rp{{ number_format($order->refund_amount, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Bank Account Info (Highlighted) -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 space-y-3">
                    <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <span>Informasi Rekening Transfer</span>
                    </h4>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs text-gray-600">Bank / E-Wallet</p>
                            <p class="font-bold text-gray-900">{{ $order->refund_bank_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Nama Pemilik</p>
                            <p class="font-bold text-gray-900">{{ $order->refund_account_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Nomor Rekening</p>
                            <p class="font-black text-red-600 text-xl">{{ $order->refund_account_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Refund Reason -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <h4 class="text-xs font-bold text-gray-700 mb-2">Alasan Refund:</h4>
                    <p class="text-sm text-gray-800 leading-relaxed">{{ $order->refund_reason }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ $order->whatsapp_link }}" target="_blank"
                       class="inline-flex items-center space-x-2 px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition-all">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/></svg>
                        <span>Chat Customer</span>
                    </a>
                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                       class="flex-1 text-center px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm transition-all">
                        Proses Refund
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl border border-gray-200 p-12">
            <div class="flex flex-col items-center space-y-3">
                <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center text-4xl">
                    ✅
                </div>
                <p class="text-gray-900 font-bold text-lg">Tidak ada refund request!</p>
                <p class="text-sm text-gray-500">Semua refund sudah diproses</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($orders->hasPages())
    <div class="bg-white rounded-xl border border-gray-200 p-4">
        {{ $orders->links() }}
    </div>
    @endif

</div>
@endsection
