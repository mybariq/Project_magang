@extends('layouts.app')

@section('content')
    <div class="card" style="max-width: 400px; margin: 40px auto;">
        <div style="margin-bottom: 20px;">
            <h2 style="margin: 0 0 6px 0;">Login Ketua</h2>
            <p class="muted" style="margin: 0;">Masuk ke akun ketua untuk mengelola pengaduan kategori Anda.</p>
        </div>

        @if ($errors->any())
            <div class="alert" style="background:#fef2f2; color:#b91c1c; border-color:#fecaca; margin-bottom: 16px;">
                <div style="font-weight:700; margin-bottom:6px;">Terjadi kesalahan:</div>
                <ul style="margin:0; padding-left:16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ketua.login.post') }}" method="POST">
            @csrf
            <div class="field">
                <label for="username">Username</label>
                <input class="input" type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input class="input" type="password" id="password" name="password" required>
            </div>
            <div style="margin-top: 20px;">
                <button class="btn primary" type="submit" style="width: 100%;">Masuk</button>
            </div>
        </form>

        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--border); text-align: center;">
            <a href="{{ route('pengaduan.index') }}" class="muted" style="font-size: 13px;">Kembali ke halaman utama</a>
        </div>
    </div>
@endsection

