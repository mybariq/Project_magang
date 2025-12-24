<?php

namespace App\Http\Controllers;

use App\Models\Ketua;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class KetuaAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('ketua.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $ketua = Ketua::where('username', $request->username)->first();

        if (!$ketua || !Hash::check($request->password, $ketua->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        session(['ketua_id' => $ketua->id, 'ketua_nama' => $ketua->nama, 'ketua_kategori' => $ketua->kategori]);

        return redirect()->route('ketua.dashboard')->with('success', 'Selamat datang, ' . $ketua->nama . '!');
    }

    public function logout(): RedirectResponse
    {
        session()->forget(['ketua_id', 'ketua_nama', 'ketua_kategori']);
        // Fully invalidate session and regenerate CSRF token
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('pengaduan.index')->with('success', 'Anda telah logout.');
    }
}
