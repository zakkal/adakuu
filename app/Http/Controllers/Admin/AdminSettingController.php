<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $adminWhatsapp = Setting::get('admin_whatsapp_number', '081234567890');

        return view('admin.settings.index', compact('adminWhatsapp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'admin_whatsapp_number' => 'required|string|max:30',
        ]);

        Setting::set('admin_whatsapp_number', $request->admin_whatsapp_number);

        return back()->with('success', 'Nomor WhatsApp Admin berhasil diperbarui.');
    }
}
