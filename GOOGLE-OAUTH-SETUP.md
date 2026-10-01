# Setup Google OAuth untuk Login

## Langkah 1: Buat Project di Google Cloud Console

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Klik "Select a project" → "New Project"
3. Nama project: **PastiPremium**
4. Klik "Create"

## Langkah 2: Enable Google+ API

1. Di sidebar, pilih **APIs & Services** → **Library**
2. Cari "Google+ API"
3. Klik **Enable**

## Langkah 3: Create OAuth Credentials

1. Di sidebar, pilih **APIs & Services** → **Credentials**
2. Klik **+ CREATE CREDENTIALS** → **OAuth client ID**
3. Jika muncul "Configure Consent Screen", klik itu terlebih dahulu:
   - User Type: **External**
   - App name: **PastiPremium**
   - User support email: email Anda
   - Developer contact: email Anda
   - Klik **Save and Continue** sampai selesai

4. Kembali ke create credentials:
   - Application type: **Web application**
   - Name: **PastiPremium Web**
   
5. **Authorized JavaScript origins**:
   ```
   http://localhost:8000
   http://127.0.0.1:8000
   ```

6. **Authorized redirect URIs**:
   ```
   http://localhost:8000/auth/google/callback
   http://127.0.0.1:8000/auth/google/callback
   ```

7. Klik **Create**

## Langkah 4: Copy Credentials ke .env

Setelah credentials dibuat, akan muncul popup dengan:
- **Client ID**: `xxxxx.apps.googleusercontent.com`
- **Client Secret**: `GOCSPX-xxxxx`

Copy dan paste ke file `.env`:

```env
GOOGLE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-your-client-secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

## Langkah 5: Clear Config Cache

```bash
php artisan config:clear
```

## Langkah 6: Test Login

1. Buka: http://127.0.0.1:8000
2. Pilih produk dan klik checkout
3. Akan redirect ke halaman login
4. Klik "Lanjutkan dengan Google"
5. Pilih akun Google
6. Setelah berhasil, akan redirect kembali ke website

## Testing

### Test Google Login:
```
1. Browse produk tanpa login ✓
2. Klik checkout → redirect ke login
3. Klik "Lanjutkan dengan Google"
4. Login berhasil → redirect ke home dengan nama user
5. User terlihat di header (nama + avatar)
6. Bisa logout
```

### Test Admin Login:
```
1. Akses /login
2. Login dengan:
   Email: admin@yuk.proin.com
   Password: password123
3. Redirect ke /admin dashboard
```

## Troubleshooting

### Error: redirect_uri_mismatch
- Pastikan URL di Google Console sama persis dengan yang di .env
- Format: `http://127.0.0.1:8000/auth/google/callback` (tanpa trailing slash)

### Error: Access blocked
- Pastikan sudah add test users di Consent Screen (jika app masih testing mode)
- Atau publish app ke production

### Error: Invalid client
- Pastikan GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET sudah benar di .env
- Run `php artisan config:clear`

## Production Setup

Untuk production:
1. Update Authorized origins dan redirect URIs dengan domain production
2. Update .env production:
   ```env
   GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
   ```
3. Publish OAuth consent screen di Google Console
