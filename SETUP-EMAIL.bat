@echo off
chcp 65001 >nul
color 0A
cls

echo ====================================
echo   SETUP EMAIL GMAIL - ADAKUU
echo ====================================
echo.
echo Pastikan kamu sudah:
echo 1. Generate App Password di Google
echo 2. Paste password di: input-app-password.txt
echo 3. Save file tersebut
echo.
echo ====================================
echo.
pause
echo.
echo Memulai setup...
echo.

php apply-app-password.php

echo.
echo ====================================
echo.
pause
