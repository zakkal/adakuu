@extends('layouts.app')

@section('title', 'Pembayaran QRIS / Midtrans — ' . $order->order_number)

@section('content')
<div class="py-6 sm:py-12 px-3 sm:px-6 lg:px-8 max-w-xl mx-auto space-y-4 sm:space-y-6">

    <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-8 border border-gray-100 card-shadow text-center space-y-4 sm:space-y-6">
        <div class="inline-flex items-center space-x-2 bg-amber-50 text-amber-700 px-3 py-1.5 rounded-full text-[10px] sm:text-xs font-bold border border-amber-200">
            <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
            <span>Menunggu Pembayaran</span>
        </div>

        <div>
            <h1 class="text-lg sm:text-2xl font-black text-gray-900">Pembayaran Midtrans / QRIS</h1>
            <p class="text-[10px] sm:text-xs text-gray-500 mt-1">Selesaikan pembayaran kamu melalui Popup Midtrans Snap atau QRIS.</p>
        </div>

        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl sm:rounded-2xl border border-gray-100 space-y-2 sm:space-y-3 text-left text-[10px] sm:text-xs">
            <div class="flex justify-between items-start border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Order ID:</span>
                <span class="font-bold text-gray-900 text-right">#{{ $order->order_number }}</span>
            </div>
            <div class="flex justify-between items-start border-b border-gray-200/60 pb-2">
                <span class="text-gray-500">Produk:</span>
                <span class="font-bold text-gray-900 text-right max-w-[60%]">{{ $order->package->product->name }} ({{ $order->package->name }})</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-500">Total:</span>
                <span class="font-black text-red-600 text-xs sm:text-sm">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Midtrans Snap Pay Button -->
        @if($snapToken)
        <button id="pay-button" class="w-full py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs sm:text-sm shadow-lg shadow-red-200 transition-all flex items-center justify-center space-x-2">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="truncate">Bayar via Midtrans (QRIS / GoPay / Bank)</span>
        </button>

        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){
                        console.log('Payment success:', result);
                        window.location.href = "{{ route('orders.success', $order->order_number) }}";
                    },
                    onPending: function(result){
                        console.log('Payment pending:', result);
                        window.location.href = "{{ route('orders.show', $order->order_number) }}";
                    },
                    onError: function(result){
                        console.error('Payment error:', result);
                        alert("Pembayaran gagal! Silakan coba lagi.");
                    },
                    onClose: function(){
                        console.log('Payment popup closed');
                        alert('Kamu menutup popup pembayaran tanpa menyelesaikan transaksi.');
                    }
                });
            };
        </script>
        @else
        <p class="text-[10px] sm:text-xs text-amber-600 font-semibold bg-amber-50 p-3 rounded-xl">
            ⚠️ Midtrans tidak dikonfigurasi. Hubungi admin untuk menyelesaikan pembayaran.
        </p>
        @endif
    </div>

</div>
@endsection

