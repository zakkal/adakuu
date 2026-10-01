@extends('layouts.admin')

@section('title', 'Admin Settings WhatsApp — Adakuu')

@section('content')
<div class="py-10 px-4 sm:px-6 lg:px-8 max-w-xl mx-auto space-y-8">

    <div class="bg-white p-8 rounded-3xl border border-gray-100 card-shadow space-y-6">
        <div>
            <span class="text-xs font-bold text-gray-400 block uppercase tracking-wider">Pengaturan Admin</span>
            <h1 class="text-2xl font-black text-gray-900">WhatsApp Admin Configuration</h1>
            <p class="text-xs text-gray-500 mt-1">Atur nomor WhatsApp admin utama yang akan menerima pesan dari customer.</p>
        </div>

        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Nomor WhatsApp Admin (admin_whatsapp_number)</label>
                <input type="text" name="admin_whatsapp_number" value="{{ old('admin_whatsapp_number', $adminWhatsapp) }}" required
                       class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-600 outline-none">
                <p class="text-[10px] text-gray-400 mt-1">Bisa format 08xxxxxxxxxx atau 628xxxxxxxxxx. Sistem akan otomatis memformat pesan WhatsApp.</p>
            </div>

            <button type="submit" class="w-full py-4 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-md transition-all">
                Simpan Pengaturan
            </button>
        </form>
    </div>

</div>
@endsection


