@extends('layouts.admin')

@section('title', 'Edit ' . $product->name . ' — Admin Adakuu')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Edit Produk: {{ $product->name }}</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui detail produk dan kelola paket.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-gray-500 hover:text-red-600">
            ← Kembali
        </a>
    </div>

    {{-- Success / Error Messages --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-3 rounded-xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Edit Product Form --}}
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-100 card-shadow p-8 space-y-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-black text-gray-900 border-b border-gray-100 pb-4">Detail Produk</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1.5">
                <label for="name" class="text-sm font-bold text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
            </div>

            <div class="space-y-1.5">
                <label for="category_id" class="text-sm font-bold text-gray-700">Kategori <span class="text-red-500">*</span></label>
                <select id="category_id" name="category_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1.5">
                <label for="badge" class="text-sm font-bold text-gray-700">Badge</label>
                <input type="text" id="badge" name="badge" value="{{ old('badge', $product->badge) }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    placeholder="Populer, Terlaris, Rekomendasi">
            </div>

            <div class="space-y-1.5">
                <label for="logo" class="text-sm font-bold text-gray-700">Logo Identifier</label>
                <input type="text" id="logo" name="logo" value="{{ old('logo', $product->logo) }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                <p class="text-xs text-gray-500 mt-1">Identifier untuk icon bawaan sistem</p>
            </div>

            <div class="space-y-1.5">
                <label for="theme_color" class="text-sm font-bold text-gray-700">Warna Tema</label>
                <select id="theme_color" name="theme_color"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    @foreach(['blue' => '🔵 Blue', 'green' => '🟢 Green', 'red' => '🔴 Red', 'purple' => '🟣 Purple', 'yellow' => '🟡 Yellow', 'black' => '⚫ Black'] as $value => $label)
                    <option value="{{ $value }}" {{ old('theme_color', $product->theme_color) == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1.5 md:col-span-2">
                <label for="logo_image" class="text-sm font-bold text-gray-700">Upload Logo Custom</label>
                @if($product->logo_image)
                    <div class="mb-2 flex items-center space-x-3">
                        <img src="{{ asset('storage/' . $product->logo_image) }}" alt="Current logo" class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                        <span class="text-xs text-gray-600">Logo saat ini</span>
                    </div>
                @endif
                <input type="file" id="logo_image" name="logo_image" accept="image/*"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100">
                <p class="text-xs text-gray-500 mt-1">Upload baru untuk ganti logo (Max: 2MB, JPG/PNG/SVG)</p>
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="description" class="text-sm font-bold text-gray-700">Deskripsi</label>
            <textarea id="description" name="description" rows="3"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all resize-none">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Warranty Section --}}
        <div class="border-t border-gray-200 pt-6 space-y-4">
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="has_warranty" name="has_warranty" value="1" {{ old('has_warranty', $product->has_warranty) ? 'checked' : '' }}
                    class="w-5 h-5 text-red-600 rounded border-gray-300 focus:ring-red-500"
                    x-data="{ checked: {{ old('has_warranty', $product->has_warranty) ? 'true' : 'false' }} }"
                    x-model="checked"
                    @change="$dispatch('warranty-toggle', { enabled: checked })">
                <label for="has_warranty" class="text-sm font-bold text-gray-700">Produk ini memiliki garansi</label>
            </div>

            <div x-data="{ showWarranty: {{ old('has_warranty', $product->has_warranty) ? 'true' : 'false' }} }" 
                 @warranty-toggle.window="showWarranty = $event.detail.enabled"
                 x-show="showWarranty"
                 x-transition
                 class="bg-blue-50 border border-blue-200 rounded-xl p-4 space-y-4">
                
                <div class="space-y-1.5">
                    <label for="warranty_days" class="text-sm font-bold text-gray-700">Masa Garansi (Hari)</label>
                    <input type="number" id="warranty_days" name="warranty_days" value="{{ old('warranty_days', $product->warranty_days) }}" min="1"
                        class="w-full px-4 py-3 bg-white border border-blue-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                        placeholder="Contoh: 7, 14, 20, 30">
                    <p class="text-xs text-blue-600">Garansi berlaku selama berapa hari setelah pembelian</p>
                </div>

                <div class="space-y-1.5">
                    <label for="warranty_terms" class="text-sm font-bold text-gray-700">Ketentuan Garansi</label>
                    <textarea id="warranty_terms" name="warranty_terms" rows="4"
                        class="w-full px-4 py-3 bg-white border border-blue-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none"
                        placeholder="Contoh: Garansi berlaku jika akun downgrade ke paket gratis. Tidak berlaku jika akun di-banned oleh platform.">{{ old('warranty_terms', $product->warranty_terms) }}</textarea>
                    <p class="text-xs text-blue-600">Jelaskan apa saja yang tercover dan tidak tercover oleh garansi</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-md shadow-red-200 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Package Management --}}
    <div class="bg-white rounded-3xl border border-gray-100 card-shadow p-8 space-y-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <h2 class="text-lg font-black text-gray-900">Paket Produk ({{ $product->packages->count() }})</h2>
        </div>

        {{-- Existing Packages --}}
        @foreach($product->packages as $package)
        <div class="border border-gray-100 rounded-2xl p-6 space-y-4 bg-gray-50/50" x-data="{ editing: false }">
            <div class="flex items-center justify-between">
                <div>
                    <span class="font-black text-gray-900">{{ $package->name }}</span>
                    @if($package->badge)
                    <span class="ml-2 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700">{{ $package->badge }}</span>
                    @endif
                    <span class="ml-2 px-2 py-0.5 rounded-full text-[10px] font-bold {{ $package->is_available ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                        {{ $package->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="font-black text-red-600 text-sm">Rp{{ number_format($package->price, 0, ',', '.') }}</span>
                    <span class="text-gray-400 text-xs">(Modal: Rp{{ number_format($package->cost_price, 0, ',', '.') }})</span>
                    <button @click="editing = !editing" type="button" class="px-3 py-1 rounded-full border border-gray-200 hover:bg-white text-[11px] font-bold text-gray-600">
                        <span x-text="editing ? 'Tutup' : '✏️ Edit'"></span>
                    </button>
                    <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin hapus paket ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 rounded-full border border-red-200 hover:bg-red-50 text-[11px] font-bold text-red-600">
                            🗑️
                        </button>
                    </form>
                </div>
            </div>

            {{-- Edit Package Form --}}
            <form x-show="editing" x-cloak action="{{ route('admin.packages.update', $package->id) }}" method="POST" class="space-y-4 pt-4 border-t border-gray-200">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Nama Paket</label>
                        <input type="text" name="name" value="{{ $package->name }}" required
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Harga Jual (Rp)</label>
                        <input type="number" name="price" value="{{ $package->price }}" required min="0"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Harga Modal (Rp)</label>
                        <input type="number" name="cost_price" value="{{ $package->cost_price }}" required min="0"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Stock Tersedia</label>
                        <input type="number" name="stock" value="{{ $package->stock }}" required min="0"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500">
                        <p class="text-[10px] text-gray-500 mt-1">
                            Terjual: <strong class="text-red-600">{{ $package->sold_count }}</strong> | 
                            Sisa: <strong class="text-emerald-600">{{ $package->remaining_stock }}</strong>
                        </p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Badge</label>
                        <input type="text" name="badge" value="{{ $package->badge }}"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                            placeholder="PROMO, SOLD OUT">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Tersedia?</label>
                        <select name="is_available"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500">
                            <option value="1" {{ $package->is_available ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ !$package->is_available ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-600">Deskripsi</label>
                    <textarea name="description" rows="2"
                        class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 resize-none">{{ $package->description }}</textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-600">Syarat & Ketentuan</label>
                    <textarea name="terms" rows="2"
                        class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 resize-none">{{ $package->terms }}</textarea>
                </div>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-md transition-all">
                    Update Paket
                </button>
            </form>
        </div>
        @endforeach

        {{-- Add New Package Form --}}
        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 space-y-4" x-data="{ open: false }">
            <button @click="open = !open" type="button" class="w-full text-center text-sm font-bold text-red-600 hover:text-red-700 py-2">
                <span x-text="open ? '— Tutup Form' : '+ Tambah Paket Baru'"></span>
            </button>

            <form x-show="open" x-cloak action="{{ route('admin.packages.store', $product->id) }}" method="POST" class="space-y-4 pt-4 border-t border-gray-200">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Nama Paket <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                            placeholder="Contoh: ChatGPT Plus 1 Bulan">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Harga Jual (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" required min="0"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                            placeholder="49000">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Harga Modal (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="cost_price" required min="0"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                            placeholder="25000">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Stock Tersedia <span class="text-red-500">*</span></label>
                        <input type="number" name="stock" required min="0"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                            placeholder="10">
                        <p class="text-[10px] text-gray-500 mt-1">Jumlah stock yang tersedia untuk dijual</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Badge</label>
                        <input type="text" name="badge"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                            placeholder="PROMO">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-600">Tersedia?</label>
                        <select name="is_available"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500">
                            <option value="1" selected>Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-600">Deskripsi</label>
                    <textarea name="description" rows="2"
                        class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 resize-none"
                        placeholder="Deskripsi singkat paket..."></textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-600">Syarat & Ketentuan</label>
                    <textarea name="terms" rows="2"
                        class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 resize-none"
                        placeholder="Garansi, proses pengiriman, dll."></textarea>
                </div>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-md transition-all">
                    Simpan Paket Baru
                </button>
            </form>
        </div>
    </div>

</div>
@endsection


