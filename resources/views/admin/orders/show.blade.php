@extends('layouts.admin')

@section('title', 'Proses Pesanan #' . $order->order_number . ' — Admin Panel')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto space-y-8">

    <div class="bg-white p-8 rounded-3xl border border-gray-100 card-shadow space-y-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <div>
                <span class="text-xs font-bold text-gray-400 block uppercase tracking-wider">Admin Order Management</span>
                <h1 class="text-2xl font-black text-gray-900">#{{ $order->order_number }}</h1>
            </div>

            <a href="{{ $order->whatsapp_link }}" target="_blank"
               class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-5 py-2.5 rounded-full shadow-md flex items-center space-x-2">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/></svg>
                <span>[ Chat WhatsApp ]</span>
            </a>
        </div>

        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <!-- Details Grid -->
        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 grid grid-cols-2 gap-4 text-xs">
            <div>
                <span class="text-gray-400 block">Customer Name:</span>
                <span class="font-bold text-gray-900 text-sm">{{ $order->customer_name }}</span>
            </div>
            <div>
                <span class="text-gray-400 block">WhatsApp:</span>
                <span class="font-bold text-gray-900 text-sm">{{ $order->customer_whatsapp }}</span>
            </div>
            <div>
                <span class="text-gray-400 block">Produk:</span>
                <span class="font-bold text-gray-900 text-sm">{{ $order->package->product->name }}</span>
            </div>
            <div>
                <span class="text-gray-400 block">Paket:</span>
                <span class="font-bold text-gray-900 text-sm">{{ $order->package->name }}</span>
            </div>
            <div>
                <span class="text-gray-400 block">Total:</span>
                <span class="font-black text-red-600 text-base">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="text-gray-400 block">Current Status:</span>
                <span class="font-bold text-gray-900 text-sm uppercase">{{ $order->order_status }}</span>
            </div>
        </div>

        <!-- Actions & Forms for Admin -->
        <div class="space-y-6 border-t border-gray-100 pt-6">
            
            <!-- 1. Process Order Form (PAID -> PROCESSING) -->
            @if(in_array($order->order_status, ['PAID', 'PENDING']))
            <form action="{{ route('admin.orders.process', $order->id) }}" method="POST" class="bg-blue-50/60 p-6 rounded-3xl border border-blue-100 space-y-4">
                @csrf
                <div>
                    <h3 class="font-bold text-blue-900 text-sm">1. Ubah Status ke PROCESSING</h3>
                    <p class="text-xs text-blue-700 mt-1">Admin mulai memproses produk untuk customer.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-blue-900 mb-1">Catatan untuk Customer:</label>
                    <textarea name="admin_note" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-blue-200 text-xs focus:ring-2 focus:ring-blue-500/20 outline-none">Pesanan sedang kami proses. Silakan tunggu admin menghubungi melalui WhatsApp.</textarea>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-md">
                    [ Proses Pesanan ]
                </button>
            </form>
            @endif

            <!-- 2. Complete Order Form (PROCESSING -> COMPLETED) -->
            @if(in_array($order->order_status, ['PROCESSING', 'PAID']))
            <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST" class="bg-emerald-50/60 p-6 rounded-3xl border border-emerald-100 space-y-4">
                @csrf
                <div>
                    <h3 class="font-bold text-emerald-900 text-sm">2. Selesaikan Pesanan (COMPLETED)</h3>
                    <p class="text-xs text-emerald-700 mt-1">Gunakan ini setelah admin selesai memberikan akun/produk secara manual via WhatsApp.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-emerald-900 mb-1">Catatan Penyelesaian:</label>
                    <textarea name="admin_note" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-emerald-200 text-xs focus:ring-2 focus:ring-emerald-500/20 outline-none">Pesanan sudah selesai. Terima kasih telah berbelanja di YUK PRO IN.</textarea>
                </div>

                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-md">
                    [ Selesaikan Pesanan ]
                </button>
            </form>
            @endif

            <!-- 3. Refund Request Section -->
            @if($order->refund_status === 'REQUESTED')
            <div class="bg-amber-50/60 p-6 rounded-3xl border-2 border-amber-300 space-y-4">
                <div>
                    <h3 class="font-bold text-amber-900 text-base flex items-center space-x-2">
                        <span>💰</span>
                        <span>Customer Mengajukan Refund</span>
                    </h3>
                    <p class="text-xs text-amber-700 mt-1">Refund Amount: <strong class="font-black text-base">Rp{{ number_format($order->refund_amount, 0, ',', '.') }}</strong></p>
                </div>

                <!-- Bank Account Info -->
                <div class="bg-white p-5 rounded-2xl border border-amber-200 space-y-3">
                    <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider">📋 Informasi Rekening Customer</h4>
                    
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-gray-500 block">Nama Bank / E-Wallet:</span>
                            <span class="font-bold text-gray-900 text-sm">{{ $order->refund_bank_name ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Nama Pemilik Rekening:</span>
                            <span class="font-bold text-gray-900 text-sm">{{ $order->refund_account_name ?? '-' }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500 block">Nomor Rekening:</span>
                            <span class="font-black text-red-600 text-lg">{{ $order->refund_account_number ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="bg-amber-50 p-3 rounded-xl border border-amber-200">
                        <p class="text-[10px] text-amber-800">
                            ⚠️ <strong>Penting:</strong> Transfer dana refund ke rekening di atas sebelum approve. Pastikan data rekening benar!
                        </p>
                    </div>
                </div>

                <!-- Refund Reason -->
                <div class="bg-white p-4 rounded-2xl border border-amber-200">
                    <span class="text-xs font-bold text-amber-900 block mb-2">Alasan Refund dari Customer:</span>
                    <p class="text-xs text-gray-700 leading-relaxed whitespace-pre-line">{{ $order->refund_reason }}</p>
                </div>

                <!-- Refund Actions -->
                <div class="flex space-x-3">
                    <!-- Approve Button -->
                    <form action="{{ route('admin.orders.refund.approve', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" onclick="return confirm('Apakah Anda sudah transfer dana ke rekening customer? Klik OK jika sudah.')"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-md">
                            ✅ Approve Refund (Sudah Transfer)
                        </button>
                    </form>

                    <!-- Reject Button -->
                    <form action="{{ route('admin.orders.refund.reject', $order->id) }}" method="POST" class="flex-1" x-data="{ showReject: false }">
                        @csrf
                        <button type="button" @click="showReject = !showReject"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-md">
                            ❌ Reject Refund
                        </button>

                        <div x-show="showReject" x-cloak class="mt-3 space-y-2">
                            <textarea name="reject_reason" rows="2" placeholder="Alasan penolakan refund..." required
                                      class="w-full px-4 py-2.5 rounded-xl border border-red-200 text-xs focus:ring-2 focus:ring-red-500/20 outline-none"></textarea>
                            <button type="submit" onclick="return confirm('Yakin reject refund ini?')"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-xl text-xs">
                                Kirim Penolakan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection


