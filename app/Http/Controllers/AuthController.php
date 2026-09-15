<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 1. Cari user di DB secara manual
        $user = User::where('username', $request->username)->first();

        // Jika username tidak ketemu
        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan di database!']);
        }

        // 2. Cek password manual
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Password salah!']);
        }

        // 3. Login-kan user ke sistem
        Auth::login($user);
        $request->session()->regenerate();

        // LOG: Catat aktivitas Login berhasil
        LogAktivitas::catat("Pengguna {$user->username} berhasil login ke dalam sistem", "AUTH");

        // 4. Redirect sesuai role
        $role = strtolower(trim($user->role));

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } elseif ($role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors(['username' => 'Role pengguna belum dikonfigurasi. Hubungi administrator.']);
    }

    public function logout(Request $request)
    {
        // LOG: Catat aktivitas Logout (sebelum Auth::logout)
        if (Auth::check()) {
            LogAktivitas::catat("Pengguna " . Auth::user()->username . " telah logout dari sistem", "AUTH");
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}