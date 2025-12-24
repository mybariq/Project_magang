@extends('layouts.app')

@section('content')
    <div class="card" style="max-width: 420px; margin: 32px auto;">
        <h2 style="margin-bottom:4px;">Login Anggota</h2>
        <p class="muted" style="margin:0 0 12px 0;">Masuk untuk melihat tugas dan menandai pengaduan sebagai selesai.</p>

        @if($errors->any())
            <div class="alert" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;margin-bottom:12px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('anggota.login.post') }}" autocomplete="on">
            @csrf

            <div class="field">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" class="input" value="{{ old('username') }}" required autocomplete="username" autofocus>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="input" required autocomplete="current-password">
            </div>

            <div class="flex" style="gap:10px; margin-top:8px; justify-content:space-between; align-items:center;">
                <a class="btn ghost" href="{{ route('pengaduan.index') }}">Kembali</a>
                <button class="btn primary" type="submit">Login</button>
            </div>

            <div style="margin-top:10px; font-size:13px; color:var(--muted);">
                <a href="{{ route('anggota.login') }}" style="color:var(--muted);">Lupa kata sandi?</a>
            </div>
        </form>
    </div>
@endsection
