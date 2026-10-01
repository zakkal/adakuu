<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect back ke product page dengan auto-open modal jika ada package
            if ($request->has('redirect') && $request->has('package')) {
                return redirect($request->redirect.'#package-'.$request->package)
                    ->with('success', 'Login berhasil! Silakan lanjutkan pembelian.')
                    ->with('auto_open_checkout', $request->package);
            }

            if ($request->has('redirect')) {
                return redirect($request->redirect)->with('success', 'Login berhasil!');
            }

            return redirect()->route('home')->with('success', 'Selamat datang kembali, '.auth()->user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('auth.customer-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Auth::login($user);

        // Redirect back ke product page dengan auto-open modal jika ada package
        if ($request->has('redirect') && $request->has('package')) {
            return redirect($request->redirect.'#package-'.$request->package)
                ->with('success', 'Registrasi berhasil! Silakan lanjutkan pembelian.')
                ->with('auto_open_checkout', $request->package);
        }

        if ($request->has('redirect')) {
            return redirect($request->redirect)->with('success', 'Registrasi berhasil!');
        }

        return redirect()->route('home')->with('success', 'Selamat datang, '.$user->name.'!');
    }
}
