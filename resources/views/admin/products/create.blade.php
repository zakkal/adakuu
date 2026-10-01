@extends('layouts.admin')

@section('title', 'Tambah Produk — Admin Adakuu')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Tambah Produk Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Isi detail produk yang akan ditambahkan ke katalog.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-gray-500 hover:text-red-600">
            ← Kembali
        </a>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-3 rounded-xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Create Form --}}
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-100 card-shadow p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div class="space-y-1.5">
                <label for="name" class="text-sm font-bold text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    placeholder="Contoh: CHATGPT">
            </div>

            {{-- Category --}}
            <div class="space-y-1.5">
                <label for="category_id" class="text-sm font-bold text-gray-700">Kategori <span class="text-red-500">*</span></label>
                <select id="category_id" name="category_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Badge --}}
            <div class="space-y-1.5">
                <label for="badge" class="text-sm font-bold text-gray-700">Badge</label>
                <input type="text" id="badge" name="badge" value="{{ old('badge') }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    placeholder="Contoh: Populer, Terlaris, Rekomendasi">
            </div>

            {{-- Logo --}}
            <div class="space-y-1.5">
                <label for="logo" class="text-sm font-bold text-gray-700">Logo Identifier</label>
                <input type="text" id="logo" name="logo" value="{{ old('logo') }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all"
                    placeholder="Contoh: chatgpt, gemini, spotify">
                <p class="text-xs text-gray-500 mt-1">Identifier untuk icon bawaan sistem</p>
            </div>

            {{-- Logo Upload --}}
            <div class="space-y-1.5">
                <label for="logo_image" class="text-sm font-bold text-gray-700">Upload Logo Custom</label>
                <input type="file" id="logo_image" name="logo_image" accept="image/*"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100">
                <p class="text-xs text-gray-500 mt-1">Ukuran max: 2MB, format: JPG, PNG, SVG</p>
            </div>

            {{-- Theme Color --}}
            <div class="space-y-1.5">
                <label for="theme_color" class="text-sm font-bold text-gray-700">Warna Tema</label>
                <select id="theme_color" name="theme_color"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    <option value="blue" {{ old('theme_color') == 'blue' ? 'selected' : '' }}>🔵 Blue</option>
                    <option value="green" {{ old('theme_color') == 'green' ? 'selected' : '' }}>🟢 Green</option>
                    <option value="red" {{ old('theme_color') == 'red' ? 'selected' : '' }}>🔴 Red</option>
                    <option value="purple" {{ old('theme_color') == 'purple' ? 'selected' : '' }}>🟣 Purple</option>
                    <option value="yellow" {{ old('theme_color') == 'yellow' ? 'selected' : '' }}>🟡 Yellow</option>
                    <option value="black" {{ old('theme_color') == 'black' ? 'selected' : '' }}>⚫ Black</option>
                </select>
            </div>
        </div>

        {{-- Description --}}
        <div class="space-y-1.5">
            <label for="description" class="text-sm font-bold text-gray-700">Deskripsi</label>
            <textarea id="description" name="description" rows="3"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all resize-none"
                placeholder="Deskripsi singkat tentang produk...">{{ old('description') }}</textarea>
        </div>

        {{-- Warranty Section --}}
        <div class="border-t border-gray-200 pt-6 space-y-4">
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="has_warranty" name="has_warranty" value="1" {{ old('has_warranty') ? 'checked' : '' }}
                    class="w-5 h-5 text-red-600 rounded border-gray-300 focus:ring-red-500"
                    x-data="{ checked: {{ old('has_warranty') ? 'true' : 'false' }} }"
                    x-model="checked"
                    @change="$dispatch('warranty-toggle', { enabled: checked })">
                <label for="has_warranty" class="text-sm font-bold text-gray-700">Produk ini memiliki garansi</label>
            </div>

            <div x-data="{ showWarranty: {{ old('has_warranty') ? 'true' : 'false' }} }" 
                 @warranty-toggle.window="showWarranty = $event.detail.enabled"
                 x-show="showWarranty"
                 x-transition
                 class="bg-blue-50 border border-blue-200 rounded-xl p-4 space-y-4">
                
                <div class="space-y-1.5">
                    <label for="warranty_days" class="text-sm font-bold text-gray-700">Masa Garansi (Hari)</label>
                    <input type="number" id="warranty_days" name="warranty_days" value="{{ old('warranty_days') }}" min="1"
                        class="w-full px-4 py-3 bg-white border border-blue-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                        placeholder="Contoh: 7, 14, 20, 30">
                    <p class="text-xs text-blue-600">Garansi berlaku selama berapa hari setelah pembelian</p>
                </div>

                <div class="space-y-1.5">
                    <label for="warranty_terms" class="text-sm font-bold text-gray-700">Ketentuan Garansi</label>
                    <textarea id="warranty_terms" name="warranty_terms" rows="4"
                        class="w-full px-4 py-3 bg-white border border-blue-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none"
                        placeholder="Contoh: Garansi berlaku jika akun downgrade ke paket gratis. Tidak berlaku jika akun di-banned oleh platform.">{{ old('warranty_terms') }}</textarea>
                    <p class="text-xs text-blue-600">Jelaskan apa saja yang tercover dan tidak tercover oleh garansi</p>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-3 rounded-xl border border-gray-200 text-gray-700 text-sm font-bold hover:bg-gray-50 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-md shadow-red-200 transition-all">
                Simpan Produk
            </button>
        </div>
    </form>

</div>
@endsection


