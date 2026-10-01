@echo off
chcp 65001 >nul
color 0A
cls

echo ╔════════════════════════════════════════════════════════╗
echo ║                                                        ║
echo ║        SETUP GMAIL SMTP - ADAKUU (SIMPLE!)            ║
echo ║                                                        ║
echo ╚════════════════════════════════════════════════════════╝
echo.
echo.
echo [STEP 1] Generate App Password di Google
echo ─────────────────────────────────────────────────────────
echo 1. Buka: https://myaccount.google.com/apppasswords
echo 2. Login: shoppinghere@shoppinghere.biz.id
echo 3. Klik "Buat" - Nama: "Adakuu"
echo 4. Copy password 16 karakter
echo.
echo ─────────────────────────────────────────────────────────
echo.
echo [STEP 2] Paste Password Di Sini
echo ─────────────────────────────────────────────────────────
echo.
set /p APP_PASSWORD="Paste App Password: "
echo.

if "%APP_PASSWORD%"=="" (
    echo.
    echo ❌ Password kosong! Jalankan lagi script ini.
    echo.
    pause
    exit
)

echo.
echo ✓ Password diterima!
echo.
echo Membuat file temporary...

echo APP_PASSWORD: %APP_PASSWORD% > input-app-password.txt

echo ✓ File dibuat!
echo.
echo Menjalankan setup...
echo ─────────────────────────────────────────────────────────
echo.

php apply-app-password.php

echo.
echo ─────────────────────────────────────────────────────────
echo Setup selesai!
echo.
echo Cek email di: zaki.alghifari0306@gmail.com
echo (Juga cek folder SPAM jika tidak ada di Inbox)
echo.
pause
