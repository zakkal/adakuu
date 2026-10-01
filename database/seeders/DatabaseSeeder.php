<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Package;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'admin yukproin',
            'email' => 'admin@yuk.proin.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Admin WhatsApp setting
        Setting::set('admin_whatsapp_number', '081234567890');

        // Categories
        $catAi = Category::create([
            'name' => 'AI & Produktivitas',
            'slug' => 'ai-produktivitas',
            'icon' => 'bot',
            'description' => 'Tingkatkan efisiensi, hasilkan karya terbaik.',
        ]);

        $catStreaming = Category::create([
            'name' => 'Streaming & Hiburan',
            'slug' => 'streaming-hiburan',
            'icon' => 'play',
            'description' => 'Tonton film, mendengarkan musik favorit tanpa batas.',
        ]);

        $catDesign = Category::create([
            'name' => 'Desain & Kreativitas',
            'slug' => 'desain-kreativitas',
            'icon' => 'palette',
            'description' => 'Software dan tools desain visual profesional.',
        ]);

        // Products
        $chatgpt = Product::create([
            'category_id' => $catAi->id,
            'name' => 'CHATGPT',
            'slug' => 'chatgpt',
            'badge' => 'Populer',
            'description' => 'Asisten AI cerdas untuk membantu menulis, mencari informasi, dan banyak lagi.',
            'logo' => 'chatgpt',
            'theme_color' => 'green',
        ]);

        $gemini = Product::create([
            'category_id' => $catAi->id,
            'name' => 'GEMINI',
            'slug' => 'gemini',
            'badge' => 'Rekomendasi',
            'description' => 'Dari Google, untuk membantu Anda berpikir lebih cepat dan kreatif.',
            'logo' => 'gemini',
            'theme_color' => 'purple',
        ]);

        $google = Product::create([
            'category_id' => $catAi->id,
            'name' => 'GOOGLE',
            'slug' => 'google',
            'badge' => 'Terlaris',
            'description' => 'Solusi dari Google untuk produktivitas, kolaborasi, dan hiburan Anda.',
            'logo' => 'google',
            'theme_color' => 'yellow',
        ]);

        $adobe = Product::create([
            'category_id' => $catDesign->id,
            'name' => 'ADOBE',
            'slug' => 'adobe',
            'badge' => 'Populer',
            'description' => 'Desain & Kreativitas kelas dunia.',
            'logo' => 'adobe',
            'theme_color' => 'red',
        ]);

        $capcut = Product::create([
            'category_id' => $catDesign->id,
            'name' => 'CAPCUT',
            'slug' => 'capcut',
            'badge' => null,
            'description' => 'Edit Video dengan mudah dan cepat.',
            'logo' => 'capcut',
            'theme_color' => 'black',
        ]);

        $spotify = Product::create([
            'category_id' => $catStreaming->id,
            'name' => 'SPOTIFY',
            'slug' => 'spotify',
            'badge' => 'Populer',
            'description' => 'Musik & Podcast tanpa iklan.',
            'logo' => 'spotify',
            'theme_color' => 'green',
        ]);

        $netflix = Product::create([
            'category_id' => $catStreaming->id,
            'name' => 'NETFLIX',
            'slug' => 'netflix',
            'badge' => 'Terlaris',
            'description' => 'Streaming film & series favorit.',
            'logo' => 'netflix',
            'theme_color' => 'red',
        ]);

        $canva = Product::create([
            'category_id' => $catDesign->id,
            'name' => 'CANVA',
            'slug' => 'canva',
            'badge' => 'Rekomendasi',
            'description' => 'Desain Online instan dan menarik.',
            'logo' => 'canva',
            'theme_color' => 'blue',
        ]);

        // Packages for Gemini
        Package::create([
            'product_id' => $gemini->id,
            'name' => 'Gemini Pro 3 Bulan',
            'price' => 49000,
            'cost_price' => 25000,
            'badge' => 'PROMO',
            'is_available' => true,
            'description' => 'Akses Gemini Advanced dengan model 1.5 Pro, 2TB Cloud Storage Google One, serta integrasi di Gmail & Docs.',
            'terms' => 'Garansi full 3 bulan. Proses manual oleh admin via WhatsApp setelah pembayaran terverifikasi.',
        ]);

        Package::create([
            'product_id' => $gemini->id,
            'name' => 'Gemini Pro 18 Bulan',
            'price' => 199000,
            'cost_price' => 100000,
            'badge' => 'PROMO',
            'is_available' => true,
            'description' => 'Paket hemat Gemini Advanced 18 bulan full garansi dengan akses fitur AI terbaru.',
            'terms' => 'Garansi full 18 bulan. Pengiriman produk diproses manual oleh admin.',
        ]);

        Package::create([
            'product_id' => $gemini->id,
            'name' => 'Gemini Pro Private 140 Hari',
            'price' => 99000,
            'cost_price' => 50000,
            'badge' => 'SOLD OUT',
            'is_available' => false,
            'description' => 'Akun Private Gemini Pro khusus 140 Hari.',
            'terms' => 'Garansi sesuai masa aktif.',
        ]);

        // Packages for ChatGPT
        Package::create([
            'product_id' => $chatgpt->id,
            'name' => 'ChatGPT Plus 1 Bulan',
            'price' => 49000,
            'cost_price' => 25000,
            'badge' => 'PROMO',
            'is_available' => true,
            'description' => 'Akses GPT-4o, DALL-E 3, Voice Mode, dan priority access.',
            'terms' => 'Garansi 30 hari. Proses manual oleh admin.',
        ]);

        Package::create([
            'product_id' => $chatgpt->id,
            'name' => 'ChatGPT Plus 3 Bulan',
            'price' => 129000,
            'cost_price' => 65000,
            'badge' => 'PROMO',
            'is_available' => true,
            'description' => 'Akses 3 bulan ChatGPT Plus dengan performa maksimal.',
            'terms' => 'Garansi 90 hari. Diproses manual via WhatsApp.',
        ]);
    }
}
