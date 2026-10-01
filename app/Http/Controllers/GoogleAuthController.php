<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        // Simpan redirect URL dan package_id ke session sebelum ke Google
        if (request()->has('redirect')) {
            session(['auth_redirect' => request()->query('redirect')]);
        }
        if (request()->has('package')) {
            session(['selected_package' => request()->query('package')]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find or create user
            $user = User::where('email', $googleUser->email)->first();

            if (! $user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(str()->random(16)),
                    'role' => 'customer',
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
            } else {
                if (! $user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                }
            }

            Auth::login($user, true);

            // Ambil redirect URL dan package_id dari session
            $redirect = session('auth_redirect');
            $packageId = session('selected_package');

            // Clear session setelah ambil
            session()->forget(['auth_redirect', 'selected_package']);

            // Redirect ke product page (tanpa auto-open modal)
            if ($redirect && $packageId) {
                return redirect($redirect)
                    ->with('success', 'Login berhasil! Silakan klik tombol "Beli Sekarang" untuk melanjutkan.');
            }

            if ($redirect) {
                return redirect($redirect)->with('success', 'Login berhasil!');
            }

            return redirect()->route('home')->with('success', 'Selamat datang, '.$user->name.'!');

        } catch (\Exception $e) {
            logger()->error('Google OAuth Error: '.$e->getMessage());

            return redirect()->route('home')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }
}
