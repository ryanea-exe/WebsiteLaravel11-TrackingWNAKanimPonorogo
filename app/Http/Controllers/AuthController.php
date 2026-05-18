<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ================= LOGIN VIEW =================
    public function showLogin()
    {
        return view('auth.login');
    }

    // ================= PROSES LOGIN =================
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Ambil credentials
        $credentials = $request->only('username', 'password');

        // Hanya user dengan status aktif yang bisa login
        $credentials['status'] = 'aktif';

        // Coba login
        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            // 🔥 Langsung arahkan ke dashboard universal
            return redirect('/dashboard');
        }

        // Cek apakah user ada tapi nonaktif
        $user = User::where('username', $request->username)->first();

        if ($user && $user->status == 'nonaktif') {
            return back()->with('error', 'Akun anda nonaktif, hubungi admin!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}