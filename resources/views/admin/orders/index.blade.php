@extends('layouts.admin')

@section('title', 'Admin Dashboard — Pesanan Store')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

    <!-- Admin Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Manajemen Pesanan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola status pesanan dan pengaturan WhatsApp Admin</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" 
           class="inline-flex items-center space-x-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>Settings WhatsApp</span>
        </a>
    </div>

    <!-- Notification Cards Grid (Small Square Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @if($newPaidCount > 0)
        <a href="{{ route('admin.orders.paid') }}" 
           class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all group">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                    🔔
                </div>
                <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold">
                    {{ $newPaidCount }}
                </span>
            </div>
            <h3 class="font-bold text-lg mb-1">Pembayaran Baru</h3>
            <p class="text-sm text-red-50 mb-4">{{ $newPaidCount }} pesanan menunggu diproses</p>
            <div class="flex items-center text-sm font-semibold group-hover:translate-x-1 transition-transform">
                <span>Lihat Pesanan</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
        @endif

        @if($refundRequestCount > 0)
        <a href="{{ route('admin.orders.refunds') }}" 
           class="bg-gradient-to-br from-amber-500 to-amber-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all group">
            <div class="flex items-start justify-between mb-4">
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                    💰
                </div>
                <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold">
                    {{ $refundRequestCount }}
                </span>
            </div>
            <h3 class="font-bold text-lg mb-1">Refund Request</h3>
            <p class="text-sm text-amber-50 mb-4">{{ $refundRequestCount }} customer mengajukan refund</p>
            <div class="flex items-center text-sm font-semibold group-hover:translate-x-1 transition-transform">
                <span>Lihat Request</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
        @endif
    </div>

    <!-- Status Filters -->
    <div class="flex flex-wrap items-center gap-2 bg-white p-2 rounded-xl border border-gray-200 shadow-sm">
        <a href="{{ route('admin.orders.index') }}" 
           class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ !$status ? 'bg-red-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Semua
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'PAID']) }}" 
           class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $status == 'PAID' ? 'bg-red-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            PAID
            @if($newPaidCount > 0)
                <span class="ml-1 px-2 py-0.5 bg-red-100 text-red-600 rounded-full text-xs">{{ $newPaidCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'PROCESSING']) }}" 
           class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $status == 'PROCESSING' ? 'bg-red-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Processing
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'COMPLETED']) }}" 
           class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $status == 'COMPLETED' ? 'bg-red-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Completed
        </a>
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
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-xs uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">
                            <div class="font-bold text-gray-900">#{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-500">{{ $order->created_at->format('d M H:i') }}</div>
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $order->customer_name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $order->customer_whatsapp }}</td>
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-900">{{ $order->package->product->name }}</div>
                            <div class="text-xs text-gray-500">{{ $order->package->name }}</div>
                        </td>
                        <td class="py-3 px-4 font-bold text-red-600">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold inline-block
                                @if($order->order_status == 'COMPLETED') bg-emerald-100 text-emerald-700
                                @elseif($order->order_status == 'PROCESSING') bg-blue-100 text-blue-700
                                @elseif($order->order_status == 'PAID') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ $order->order_status }}
                            </span>
                            @if($order->refund_status === 'REQUESTED')
                                <span class="block mt-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700">
                                    💰 REFUND
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ $order->whatsapp_link }}" target="_blank"
                                   class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-xs transition-all">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/></svg>
                                    <span>Chat</span>
                                </a>
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="inline-flex px-3 py-1.5 rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium text-xs transition-all">
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <div class="flex flex-col items-center space-y-3">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-3xl">
                                    📦
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada order</p>
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


