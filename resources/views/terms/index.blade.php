@extends('layouts.app')

@section('title', 'Ketentuan & Garansi — Adakuu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-red-50 py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        
        {{-- Header --}}
        <div class="text-center mb-8 sm:mb-12">
            <a href="{{ route('home') }}" class="inline-flex items-center text-xs sm:text-sm font-semibold text-gray-600 hover:text-red-600 mb-4 sm:mb-6 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
            
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-3 sm:mb-4 brand-name">Ketentuan & Garansi</h1>
            <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto px-4">Kebijakan penting yang perlu Anda ketahui sebelum menggunakan layanan premium kami</p>
            
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-4 mt-4 sm:mt-6 px-4">
                <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-emerald-50 text-emerald-700 text-xs sm:text-sm font-bold border border-emerald-200">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Garansi Transparan
                </span>
                <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-blue-50 text-blue-700 text-xs sm:text-sm font-bold border border-blue-200">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                    Ketentuan per Produk
                </span>
                <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-red-50 text-red-700 text-xs sm:text-sm font-bold border border-red-200">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    Bantuan Klaim
                </span>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="space-y-4 sm:space-y-6">
            
            {{-- Introduction --}}
            <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 border border-gray-100 shadow-lg">
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed text-sm sm:text-base">
                        Terima kasih telah memilih <strong class="text-red-600 brand-name">Adakuu</strong>! Harga super hemat yang Anda dapatkan adalah hasil dari pemanfaatan sistem berlangganan trial dan promo resmi secara legal dari platform penyedia layanan. 
                        Kami berkomitmen memberikan pengalaman terbaik dengan transparansi penuh. Mohon baca dengan teliti kebijakan garansi di bawah demi kenyamanan bersama dan memastikan Anda memahami hak serta kewajiban dalam menggunakan layanan kami.
                    </p>
                </div>
            </div>

            {{-- Warranty Coverage --}}
            <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 border border-gray-100 shadow-lg">
                <h2 class="text-xl sm:text-2xl font-black text-gray-900 mb-4 sm:mb-6 flex items-center">
                    <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </span>
                    Cakupan Garansi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div class="bg-emerald-50 border-2 border-emerald-200 rounded-xl sm:rounded-2xl p-4 sm:p-6">
                        <h3 class="font-black text-emerald-700 text-base sm:text-lg mb-2 sm:mb-3 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Tercover Garansi
                        </h3>
                        <ul class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-emerald-900">
                            <li class="flex items-start">
                                <span class="text-emerald-600 mr-2 flex-shrink-0">✓</span>
                                <span>Akun expired lebih cepat dari waktu yang dijanjikan akibat sistem trial berakhir</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-emerald-600 mr-2 flex-shrink-0">✓</span>
                                <span>Akun tidak bisa login karena password berubah otomatis oleh sistem</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-emerald-600 mr-2 flex-shrink-0">✓</span>
                                <span>Layanan downgrade ke paket gratis dalam masa garansi yang tertera</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-emerald-600 mr-2 flex-shrink-0">✓</span>
                                <span>Error teknis dari pihak kami yang mengakibatkan akun tidak dapat digunakan</span>
                            </li>
                        </ul>
                        <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-emerald-200">
                            <p class="text-[10px] sm:text-xs font-bold text-emerald-700">Penggantian: Akun baru dengan masa aktif sama atau alternatif setara</p>
                        </div>
                    </div>

                    <div class="bg-red-50 border-2 border-red-200 rounded-xl sm:rounded-2xl p-4 sm:p-6">
                        <h3 class="font-black text-red-700 text-base sm:text-lg mb-2 sm:mb-3 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Tidak Tercover
                        </h3>
                        <ul class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-red-900">
                            <li class="flex items-start">
                                <span class="text-red-600 mr-2 flex-shrink-0">✗</span>
                                <span>Akun di-banned atau diblokir oleh sistem deteksi platform resmi (kebijakan sepihak platform)</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-red-600 mr-2 flex-shrink-0">✗</span>
                                <span>Pelanggaran Terms of Service (ToS) platform oleh pengguna</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-red-600 mr-2 flex-shrink-0">✗</span>
                                <span>Akses dari negara/wilayah yang dibatasi atau tidak didukung platform</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-red-600 mr-2 flex-shrink-0">✗</span>
                                <span>Metode pengadaan akun dengan harga terjangkau sudah tidak tersedia atau diblokir permanen</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-red-600 mr-2 flex-shrink-0">✗</span>
                                <span>Force majeure: perubahan kebijakan platform yang tidak dapat diantisipasi</span>
                            </li>
                        </ul>
                        <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-red-200">
                            <p class="text-[10px] sm:text-xs font-bold text-red-700">Tidak ada refund, penggantian, atau kompensasi apapun</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Service Continuity with Timeline Format --}}
            <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 border border-gray-100 shadow-lg">
                <h2 class="text-xl sm:text-2xl font-black text-gray-900 mb-3 sm:mb-4 flex items-center">
                    <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    </span>
                    Kelangsungan Layanan
                </h2>
                
                <div class="space-y-4 sm:space-y-5">
                    {{-- Intro Card --}}
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl sm:rounded-2xl p-4 sm:p-5 border border-blue-100">
                        <h3 class="font-bold text-blue-900 text-sm sm:text-base mb-2 sm:mb-3 flex items-center">
                            <span class="text-lg sm:text-xl mr-2">💡</span>
                            Bagaimana Kami Bekerja
                        </h3>
                        <p class="text-xs sm:text-sm text-blue-800 leading-relaxed">
                            Layanan kami memanfaatkan program trial dan promo resmi dari platform penyedia. Metode ini legal dan telah terbukti memberikan nilai terbaik untuk pelanggan. Namun, penting untuk memahami batasan dan ekspektasi yang realistis.
                        </p>
                    </div>

                    {{-- Timeline Style --}}
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm sm:text-base flex-shrink-0">
                                    1
                                </div>
                                <div class="w-0.5 flex-1 bg-gradient-to-b from-emerald-200 to-amber-200 mt-2"></div>
                            </div>
                            <div class="flex-1 pb-4">
                                <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1 sm:mb-2">Periode Aktif Trial/Promo</h4>
                                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                    Selama masa trial atau promo resmi berlangsung, akun Anda akan berfungsi normal dengan seluruh fitur premium tersedia. Ini adalah periode dimana layanan dijamin stabil sesuai durasi paket yang Anda beli.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm sm:text-base flex-shrink-0">
                                    2
                                </div>
                                <div class="w-0.5 flex-1 bg-gradient-to-b from-amber-200 to-red-200 mt-2"></div>
                            </div>
                            <div class="flex-1 pb-4">
                                <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1 sm:mb-2">Setelah Promo Berakhir</h4>
                                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-2">
                                    Ketika program promo resmi dari platform berakhir, ada kemungkinan akun tidak dapat dilanjutkan karena:
                                </p>
                                <ul class="space-y-1.5 text-xs sm:text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <span class="text-amber-500 mr-2 flex-shrink-0">▸</span>
                                        <span>Platform mengubah kebijakan keamanan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-amber-500 mr-2 flex-shrink-0">▸</span>
                                        <span>Sistem deteksi yang lebih ketat diterapkan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-amber-500 mr-2 flex-shrink-0">▸</span>
                                        <span>Metode pengadaan tidak lagi tersedia</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex gap-3 sm:gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm sm:text-base flex-shrink-0">
                                    3
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1 sm:mb-2">Solusi Kami untuk Anda</h4>
                                <div class="bg-emerald-50 border border-emerald-200 rounded-lg sm:rounded-xl p-3 sm:p-4">
                                    <p class="text-xs sm:text-sm text-emerald-900 leading-relaxed mb-2 font-semibold flex items-start">
                                        <span class="mr-1.5 flex-shrink-0">✅</span>
                                        <span>Jika layanan terganggu (di luar banned/suspend)</span>
                                    </p>
                                    <p class="text-xs sm:text-sm text-emerald-800 leading-relaxed">
                                        Tim kami akan membantu Anda migrasi ke platform alternatif sejenis dengan fitur setara atau lebih baik, tanpa biaya tambahan dalam masa garansi. Misalnya: ChatGPT → Gemini Advanced, atau Spotify → Platform musik lainnya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Important Notice Box --}}
                    <div class="bg-amber-50 border-l-4 border-amber-400 p-3 sm:p-4 rounded-lg">
                        <div class="flex items-start gap-2 sm:gap-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            <div class="flex-1">
                                <h4 class="font-bold text-amber-900 text-xs sm:text-sm mb-1">Kebijakan Non-Refundable</h4>
                                <p class="text-xs sm:text-sm text-amber-800 leading-relaxed">
                                    Semua pembelian bersifat final. Dengan melakukan pembayaran, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh ketentuan yang tercantum di halaman ini, termasuk risiko dan batasan layanan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Specific Warranty Terms --}}
            @if($warrantyProducts->count() > 0)
            <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 border border-gray-100 shadow-lg">
                <h2 class="text-xl sm:text-2xl font-black text-gray-900 mb-3 sm:mb-6 flex items-center">
                    <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                    </span>
                    <span class="text-base sm:text-2xl">Ketentuan Garansi Produk</span>
                </h2>
                <p class="text-gray-600 mb-4 sm:mb-6 text-xs sm:text-sm">Produk-produk berikut memiliki garansi resmi dari kami. Pelajari ketentuan masing-masing produk:</p>
                
                <div class="space-y-4 sm:space-y-6">
                    @foreach($warrantyProducts as $product)
                    <div class="border border-gray-200 rounded-xl sm:rounded-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-{{ $product->theme_color }}-500 to-{{ $product->theme_color }}-600 p-3 sm:p-4 text-white font-bold flex items-center justify-between">
                            <span class="flex items-center text-sm sm:text-base">
                                <x-product-logo :product="$product" class="w-5 h-5 sm:w-6 sm:h-6 mr-2 flex-shrink-0" />
                                {{ strtoupper($product->name) }} 
                                @if($product->badge)
                                <span class="ml-2 px-2 py-0.5 rounded-full text-[9px] sm:text-[10px] font-bold bg-white/20">{{ $product->badge }}</span>
                                @endif
                            </span>
                            <span class="text-[10px] sm:text-xs bg-white/20 px-2 sm:px-3 py-1 rounded-full">Garansi {{ $product->warranty_days }} Hari</span>
                        </div>
                        <div class="p-4 sm:p-6 bg-gray-50">
                            <p class="text-xs sm:text-sm font-bold text-gray-700 mb-2 sm:mb-3">📋 Ketentuan Garansi {{ $product->name }}</p>
                            <div class="prose prose-sm max-w-none text-xs sm:text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $product->warranty_terms ?? 'Garansi berlaku sesuai ketentuan umum di atas.' }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Claim Process --}}
            <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 border-2 border-red-200">
                <h2 class="text-xl sm:text-2xl font-black text-gray-900 mb-3 sm:mb-4 flex items-center">
                    <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-red-600 text-white flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    </span>
                    <span class="text-base sm:text-2xl">Cara Klaim Garansi</span>
                </h2>
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 mb-3 sm:mb-4 text-xs sm:text-sm">Jika Anda mengalami masalah yang tercover garansi, ikuti langkah berikut:</p>
                    <ol class="list-decimal list-inside space-y-1.5 sm:space-y-2 text-gray-700 text-xs sm:text-sm">
                        <li><strong>Hubungi admin</strong> melalui WhatsApp dengan nomor yang tertera di invoice/email konfirmasi</li>
                        <li><strong>Sertakan bukti</strong> berupa Order ID, screenshot masalah, dan penjelasan singkat</li>
                        <li><strong>Tunggu verifikasi</strong> dari tim kami (maksimal 1x24 jam)</li>
                        <li><strong>Terima akun pengganti</strong> atau solusi alternatif yang diberikan</li>
                    </ol>
                    <div class="mt-3 sm:mt-4 flex flex-col sm:flex-row gap-2 sm:gap-3">
                        <a href="{{ route('catalogue') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs sm:text-sm font-bold shadow-lg shadow-red-200 transition-all">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Lihat Katalog Produk
                        </a>
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl bg-white hover:bg-gray-50 text-gray-700 text-xs sm:text-sm font-bold border-2 border-gray-200 transition-all">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Cek Pesanan Saya
                        </a>
                    </div>
                </div>
            </div>

            {{-- Footer Note --}}
            <div class="text-center text-xs sm:text-sm text-gray-500 mt-6 sm:mt-8 px-4">
                <p class="mb-2">Punya pertanyaan lain? Tim CS kami siap membantu Anda.</p>
                <p class="font-semibold text-gray-700">Salam hangat, <span class="brand-name text-red-600">Tim Adakuu</span></p>
                <p class="mt-3 sm:mt-4 text-[10px] sm:text-xs">Halaman ini terakhir diperbarui: <strong>Oktober 2026</strong></p>
            </div>

        </div>
    </div>
</div>
@endsection
