<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaAuthController extends Controller
{
    public function showLogin()
    {
        return view('anggota.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $inputUsername = trim(strtolower($request->username));

        // Try exact match first
        $anggota = Anggota::whereRaw('lower(username) = ?', [$inputUsername])->first();

        // If not found, attempt normalized candidates (handles seeder pattern e.g. anggota_aplikasi1 -> anggota_aplikasi_11)
        if (!$anggota) {
            $candidates = [];

            if (preg_match('/^(.*?)(\d+)$/', $inputUsername, $m)) {
                $base = $m[1];
                $digits = $m[2];
                $candidates[] = $base . '_' . $digits . $digits; // duplicate digits (matches seeder behavior)
                $candidates[] = $base . '_' . $digits; // underscore only
            }

            // Also try replacing missing underscores: insert underscores before digits if none
            $candidates[] = str_replace('_', '', $inputUsername); // fallback: no underscore
            $candidates = array_filter(array_unique($candidates));

            foreach ($candidates as $cand) {
                $found = Anggota::whereRaw('lower(username) = ?', [strtolower($cand)])->first();
                if ($found) {
                    $anggota = $found;
                    \Log::info('Anggota login: matched alternate username candidate', ['input' => $inputUsername, 'candidate' => $cand, 'found_id' => $found->id]);
                    break;
                }
            }
        }

        if (!$anggota) {
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        // Accept hashed password or plaintext stored (rehash on first successful login)
        $valid = Hash::check($request->password, $anggota->password) || $anggota->password === $request->password;

        if (!$valid) {
            // Log failed attempt for diagnosis
            \Log::warning('Failed anggota login attempt for ' . $request->username . ' (matched id: ' . ($anggota->id ?? 'none') . ')');
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        // If password stored as plaintext, rehash it for security
        if ($anggota->password === $request->password) {
            $anggota->password = $request->password;
            $anggota->save();
        }

        session(['anggota_id' => $anggota->id, 'anggota_nama' => $anggota->nama, 'anggota_kategori' => $anggota->kategori]);

        return redirect()->route('anggota.dashboard')->with('success', 'Selamat datang, ' . $anggota->nama . '!');
    }

    public function logout()
    {
        session()->forget(['anggota_id', 'anggota_nama', 'anggota_kategori']);
        // Fully invalidate session and regenerate CSRF token to avoid stale session data
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('pengaduan.index')->with('success', 'Anda telah logout.');
    }
}
