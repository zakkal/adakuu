@extends('layouts.admin')

@section('title', 'Pesanan PAID - Admin Panel')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Pesanan Menunggu Proses</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar pesanan dengan status PAID yang menunggu diproses admin</p>
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
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <div class="flex items-center space-x-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium text-red-800">
                <strong>{{ $orders->total() }} pesanan</strong> menunggu untuk diproses. Hubungi customer via WhatsApp dan proses pesanan mereka.
            </p>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">Order ID</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">Customer</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">WhatsApp</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">Produk</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">Total</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">Dibuat</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">
                            <div class="font-bold text-gray-900">#{{ $order->order_number }}</div>
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $order->customer_name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $order->customer_whatsapp }}</td>
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-900">{{ $order->package->product->name }}</div>
                            <div class="text-xs text-gray-500">{{ $order->package->name }}</div>
                        </td>
                        <td class="py-3 px-4 font-bold text-red-600">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-gray-600 text-xs">{{ $order->created_at->diffForHumans() }}</td>
                        <td class="py-3 px-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ $order->whatsapp_link }}" target="_blank"
                                   class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-xs transition-all">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/></svg>
                                    <span>Chat</span>
                                </a>
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="inline-flex px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium text-xs transition-all">
                                    Proses
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <div class="flex flex-col items-center space-y-3">
                                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center text-3xl">
                                    ✅
                                </div>
                                <p class="text-gray-500 font-medium">Tidak ada pesanan yang menunggu!</p>
                                <p class="text-sm text-gray-400">Semua pesanan sudah diproses</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="p-4 border-t border-gray-200 bg-gray-50">
            {{ $orders->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
