@extends('layouts.admin')

@section('title', 'Katalog Produk — Admin Adakuu')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

    {{-- Admin Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-900 text-white p-8 rounded-3xl shadow-xl">
        <div>
            <div class="inline-flex items-center space-x-2 bg-red-500/20 text-red-300 border border-red-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                <span>🛍️ Katalog Produk</span>
            </div>
            <h1 class="text-3xl font-black">Manajemen Katalog</h1>
            <p class="text-xs text-gray-400 mt-1">Kelola produk dan paket yang tersedia di toko.</p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-5 py-3 rounded-full border border-gray-700 transition-all">
                ← Dashboard
            </a>
            <a href="{{ route('admin.products.create') }}" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-5 py-3 rounded-full shadow-md transition-all">
                + Tambah Produk
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Search --}}
    <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari produk..."
            class="flex-1 max-w-sm px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-5 py-3 rounded-xl transition-all">
            Cari
        </button>
        @if($search)
        <a href="{{ route('admin.products.index') }}" class="text-xs text-gray-500 hover:text-red-600 font-bold">Reset</a>
        @endif
    </form>

    {{-- Products Table --}}
    <div class="bg-white rounded-3xl border border-gray-100 card-shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-400 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Produk</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Badge</th>
                        <th class="py-4 px-6">Jumlah Paket</th>
                        <th class="py-4 px-6">Harga Termurah</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-700 font-black text-sm shrink-0">
                                    {{ strtoupper(substr($product->name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="font-black text-gray-900 block">{{ $product->name }}</span>
                                    <span class="text-[11px] text-gray-400">{{ Str::limit($product->description, 50) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-gray-100 text-gray-700">{{ $product->category->name ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-6">
                            @if($product->badge)
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700">{{ $product->badge }}</span>
                            @else
                            <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 font-bold">{{ $product->packages->count() }} paket</td>
                        <td class="py-4 px-6 font-black text-red-600">
                            @if($product->packages->count() > 0)
                            Rp{{ number_format($product->packages->min('price'), 0, ',', '.') }}
                            @else
                            —
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="inline-flex px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-100 text-gray-700 font-bold text-[11px]">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Yakin hapus produk {{ $product->name }} beserta semua paketnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex px-3 py-1.5 rounded-full border border-red-200 hover:bg-red-50 text-red-600 font-bold text-[11px]">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-red-600 font-bold hover:underline">Tambah sekarang</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection


