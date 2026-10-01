@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number . ' — Adakuu')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto space-y-8">

    <!-- Header Card -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 card-shadow space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-100 pb-6 gap-4">
            <div>
                <span class="text-xs font-bold text-gray-400 block uppercase tracking-wider">Detail Pesanan</span>
                <h1 class="text-2xl font-black text-gray-900">#{{ $order->order_number }}</h1>
                <p class="text-xs text-gray-500 mt-1">Dibuat tanggal {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                
                <!-- Refund Eligible Badge -->
                @if($order->canRequestRefund())
                    <div class="mt-3 inline-flex items-center space-x-2 bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs font-bold text-blue-700">✅ Bisa Refund ({{ $order->refund_eligible_hours }} jam lagi)</span>
                    </div>
                @endif
            </div>

            <a href="{{ $order->whatsapp_link }}" target="_blank"
               class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-6 py-3 rounded-full shadow-lg shadow-emerald-200 flex items-center justify-center space-x-2 transition-all">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.149 4.192 4.192-1.149z"/></svg>
                <span>Chat Admin via WhatsApp</span>
            </a>
        </div>

        <!-- Order Timeline (As Specified in Prompt Requirements) -->
        <div class="space-y-4 pt-2">
            <h3 class="text-sm font-bold text-gray-900">Timeline Pesanan</h3>

            <div class="space-y-3 relative before:absolute before:left-3.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-200">
                <!-- Step 1: Pesanan Dibuat -->
                <div class="flex items-start space-x-4 relative">
                    <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shrink-0 z-10">
                        ✓
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Pesanan Dibuat</h4>
                        <p class="text-[10px] text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Step 2: Pembayaran Berhasil -->
                <div class="flex items-start space-x-4 relative">
                    <div class="w-7 h-7 rounded-full {{ $order->payment_status == 'PAID' ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-400' }} flex items-center justify-center font-bold text-xs shrink-0 z-10">
                        {{ $order->payment_status == 'PAID' ? '✓' : '○' }}
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Pembayaran Berhasil</h4>
                        <p class="text-[10px] text-gray-500">{{ $order->paid_at ? $order->paid_at->format('d M Y, H:i') : 'Menunggu verifikasi' }}</p>
                    </div>
                </div>

                <!-- Step 3: Admin Memproses / Menunggu Admin -->
                <div class="flex items-start space-x-4 relative">
                    <div class="w-7 h-7 rounded-full 
                        @if(in_array($order->order_status, ['PROCESSING', 'COMPLETED'])) bg-emerald-500 text-white
                        @elseif($order->order_status == 'PAID') bg-red-600 text-white animate-pulse
                        @else bg-gray-200 text-gray-400 @endif flex items-center justify-center font-bold text-xs shrink-0 z-10">
                        @if(in_array($order->order_status, ['PROCESSING', 'COMPLETED'])) ✓
                        @elseif($order->order_status == 'PAID') ●
                        @else ○ @endif
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">
                            @if(in_array($order->order_status, ['PROCESSING', 'COMPLETED'])) Admin Memproses
                            @elseif($order->order_status == 'PAID') Menunggu Admin
                            @else Sedang Diproses @endif
                        </h4>
                        <p class="text-[10px] text-gray-500">{{ $order->processed_at ? $order->processed_at->format('d M Y, H:i') : 'Admin akan segera memproses' }}</p>
                    </div>
                </div>

                <!-- Step 4: Selesai -->
                <div class="flex items-start space-x-4 relative">
                    <div class="w-7 h-7 rounded-full {{ $order->order_status == 'COMPLETED' ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-400' }} flex items-center justify-center font-bold text-xs shrink-0 z-10">
                        {{ $order->order_status == 'COMPLETED' ? '✓' : '○' }}
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Pesanan Selesai</h4>
                        <p class="text-[10px] text-gray-500">{{ $order->completed_at ? $order->completed_at->format('d M Y, H:i') : 'Menunggu penyelesaian' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Note Box -->
        @if($order->admin_note)
        <div class="bg-indigo-50 border border-red-100 p-5 rounded-2xl space-y-1">
            <span class="text-xs font-bold text-red-900 block">Pesan dari Admin:</span>
            <p class="text-xs text-red-800 leading-relaxed whitespace-pre-line">{{ $order->admin_note }}</p>
        </div>
        @endif

        <!-- Order Information Table -->
        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 space-y-3 text-xs">
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Nama Customer:</span>
                <span class="font-bold text-gray-900">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">WhatsApp Customer:</span>
                <span class="font-bold text-gray-900">{{ $order->customer_whatsapp }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Produk & Paket:</span>
                <span class="font-bold text-gray-900">{{ $order->package->product->name }} — {{ $order->package->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Pembayaran:</span>
                <span class="font-black text-red-600 text-sm">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Refund Section -->
        @if($order->refund_status === 'REQUESTED')
        <div class="bg-amber-50 border border-amber-200 p-5 rounded-2xl space-y-2">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-bold text-amber-900">Permintaan Refund Sedang Diproses</span>
            </div>
            <p class="text-xs text-amber-800">Refund Anda sedang ditinjau oleh admin. Estimasi proses 1x24 jam.</p>
            <div class="text-xs text-amber-700 bg-amber-100 p-3 rounded-xl mt-2">
                <strong>Alasan Refund:</strong><br>
                {{ $order->refund_reason }}
            </div>
        </div>
        @elseif($order->refund_status === 'APPROVED')
        <div class="bg-emerald-50 border border-emerald-200 p-5 rounded-2xl space-y-2">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-bold text-emerald-900">Refund Berhasil Diproses</span>
            </div>
            <p class="text-xs text-emerald-800">Dana sebesar <strong>Rp{{ number_format($order->refund_amount, 0, ',', '.') }}</strong> telah dikembalikan.</p>
        </div>
        @elseif($order->canRequestRefund())
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-300 p-6 rounded-2xl space-y-4">
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-base font-bold text-blue-900">💰 Refund 100% Tersedia!</h3>
                    </div>
                    <p class="text-sm text-blue-700">Tidak puas dengan pesanan? Ajukan refund dalam <strong class="font-black">{{ $order->refund_eligible_hours }} jam lagi</strong></p>
                    <div class="mt-2 bg-white/60 border border-blue-200 p-3 rounded-xl">
                        <ul class="text-xs text-blue-800 space-y-1">
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Refund 100% tanpa potongan</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Proses maksimal 1x24 jam</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Transfer langsung ke rekening Anda</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('orders.refund.request', $order->order_number) }}" method="POST" class="space-y-3" x-data="{ showForm: false }">
                @csrf
                <button type="button" @click="showForm = !showForm" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition-all text-sm shadow-lg shadow-blue-200">
                    <span x-show="!showForm">📝 Ajukan Refund Sekarang</span>
                    <span x-show="showForm">❌ Tutup Form</span>
                </button>

                <div x-show="showForm" x-cloak class="space-y-3 pt-2">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nama Bank</label>
                        <select name="refund_bank_name" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Pilih Bank</option>
                            <option value="BCA">BCA</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                            <option value="Permata">Permata</option>
                            <option value="Danamon">Danamon</option>
                            <option value="BSI">BSI (Bank Syariah Indonesia)</option>
                            <option value="BTPN">BTPN</option>
                            <option value="Jenius">Jenius</option>
                            <option value="GoPay">GoPay</option>
                            <option value="OVO">OVO</option>
                            <option value="Dana">Dana</option>
                            <option value="ShopeePay">ShopeePay</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nama Pemilik Rekening</label>
                        <input type="text" name="refund_account_name" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                               placeholder="Contoh: Muhammad Zaki">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nomor Rekening / E-Wallet</label>
                        <input type="text" name="refund_account_number" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                               placeholder="Contoh: 1234567890">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Alasan Refund</label>
                        <textarea name="refund_reason" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                  placeholder="Jelaskan alasan Anda mengajukan refund..."></textarea>
                    </div>

                    <div class="bg-amber-50 border border-amber-200 p-3 rounded-xl">
                        <p class="text-[10px] text-amber-800">
                            ⚠️ <strong>Penting:</strong> Pastikan data rekening Anda benar. Dana akan ditransfer ke rekening yang Anda masukkan.
                        </p>
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" 
                                class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl transition-all text-xs">
                            Kirim Refund Request
                        </button>
                        <button type="button" @click="showForm = false"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2.5 rounded-xl transition-all text-xs">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endif

    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection

