<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $key = 'login:' . Str::lower($request->email) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ])->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda belum diaktifkan. Silakan tunggu konfirmasi dari admin perpustakaan.',
                ])->withInput();
            }

            if ($user->isPetugas()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        RateLimiter::hit($key, 60);
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'city'     => 'required|string|max:100',
        ]);

        $allowedCities = ['jakarta', 'bogor', 'depok', 'tangerang', 'bekasi', 'bandung', 'surabaya', 'yogyakarta'];
        $userCity = strtolower($request->city);
        $isAllowed = collect($allowedCities)->contains(fn($c) => str_contains($userCity, $c));

        if (!$isAllowed) {
            return back()->withErrors([
                'city' => '⚠️ Maaf, layanan perpustakaan belum tersedia di kota Anda. Perpustakaan hanya melayani area Jabodetabek, Bandung, Surabaya, dan Yogyakarta.',
            ])->withInput();
        }

        /**
         * FIX: is_active = false — akun baru menunggu konfirmasi admin.
         * User tidak bisa login atau meminjam sampai admin mengaktifkan akunnya.
         * Tidak ada auto-login setelah register.
         */
        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'city'      => $request->city,
            'role'      => 'user',
            'is_active' => false,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu aktivasi oleh admin. Kami akan memberitahu Anda setelah akun aktif.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
