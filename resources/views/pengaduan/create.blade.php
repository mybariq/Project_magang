@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="space-between" style="margin-bottom: 12px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Buat Pengaduan</h2>
                <p class="muted" style="margin: 0;">Isi data berikut untuk mengirim pengaduan Anda.</p>
            </div>
            <a class="btn ghost" href="{{ route('pengaduan.index') }}">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert" style="background:#fef2f2; color:#b91c1c; border-color:#fecaca;">
                <div style="font-weight:700; margin-bottom:6px;">Terjadi kesalahan:</div>
                <ul style="margin:0; padding-left:16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-2" style="gap: 18px;">
            @csrf

            <div class="field">
                <label for="nama">Nama Lengkap *</label>
                <input class="input" type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
            <div class="field">
                <label for="email">Email *</label>
                <input class="input" type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="no_hp">Nomor HP / WA</label>
                <input class="input" type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                <small>Opsional, memudahkan petugas menghubungi Anda.</small>
            </div>
            <div class="field">
                <label for="kategori">Kategori *</label>
                <select class="input" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Aplikasi" @selected(old('kategori') === 'Aplikasi')>Aplikasi</option>
                    <option value="Jaringan" @selected(old('kategori') === 'Jaringan')>Jaringan</option>
                    <option value="Persandian" @selected(old('kategori') === 'Persandian')>Persandian</option>
                </select>
            </div>
            <div class="field" style="grid-column: 1 / -1;">
                <label for="judul">Judul Pengaduan *</label>
                <input class="input" type="text" id="judul" name="judul" value="{{ old('judul') }}" required>
            </div>
            <div class="field" style="grid-column: 1 / -1;">
                <label for="isi">Uraian Pengaduan *</label>
                <textarea id="isi" name="isi" required>{{ old('isi') }}</textarea>
                <small>Berikan detail kronologi, lokasi, waktu, dan bukti jika ada.</small>
            </div>

            <div class="field" style="grid-column: 1 / -1;">
                <label for="bukti_foto">Bukti Foto (opsional)</label>
                <input class="input" type="file" id="bukti_foto" name="bukti_foto" accept="image/*">
                <small>Format JPG/PNG, ukuran maksimum 5MB.</small>
            </div>

            <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 4px;">
                <a class="btn ghost" href="{{ route('pengaduan.index') }}">Batal</a>
                <button class="btn primary" type="submit">Kirim Pengaduan</button>
            </div>
        </form>
    </div>
@endsection

