# User Flow - PastiPremium

## Flow untuk Customer (Pembeli)

### 1. Browse Produk (Tanpa Login)
```
✓ User bisa akses homepage
✓ User bisa lihat semua kategori
✓ User bisa lihat detail produk
✓ User bisa lihat harga & paket
✓ TIDAK ADA tombol login di header
```

### 2. Checkout (Butuh Login)
```
User pilih paket → Klik "Beli Sekarang"
↓
Redirect ke /login
↓
Klik "Lanjutkan dengan Google"
↓
Login dengan akun Google
↓
Redirect kembali ke form checkout
↓
Isi nama & WhatsApp
↓
Submit → Generate order
↓
Halaman pembayaran Midtrans
```

### 3. Setelah Login
```
✓ Nama user muncul di header (dengan avatar Google)
✓ Tombol "Logout" tersedia
✓ User bisa langsung checkout tanpa login lagi
✓ User bisa track pesanan
```

## Flow untuk Admin

### 1. Login Admin
```
Akses /login langsung
↓
Isi email & password (form admin)
↓
Login sebagai admin
↓
Redirect ke /admin dashboard
```

### 2. Admin Panel
```
✓ Dashboard dengan statistik
✓ Kelola Pesanan
✓ Kelola Produk & Paket
✓ Pengaturan WhatsApp
✓ Link "Lihat Website" untuk kembali ke public site
```

## Header Navigation

### Customer (Belum Login)
```
Logo | Beranda | Kategori | Cek Pesanan | [Search] | Lihat Katalog
```

### Customer (Sudah Login)
```
Logo | Beranda | Kategori | Cek Pesanan | [Search] | Lihat Katalog | [Avatar + Nama] | Logout
```

### Admin (Di Admin Panel)
```
Sidebar:
- Dashboard
- Kelola Pesanan
- Kelola Produk
- Pengaturan
- Lihat Website
- [User Info]
- Logout
```

## Important Notes

1. **Tombol Login dihapus** dari header customer - login hanya muncul saat checkout
2. **Google OAuth** sebagai primary login method untuk customer
3. **Admin login** terpisah dengan form email/password tradisional
4. **No registration** - auto create user dari Google saat pertama kali login
5. **Role automatic** - user dari Google dapat role 'customer', admin di-seed manual
