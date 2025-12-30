@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display:flex;gap:18px;align-items:center;">
            <div style="flex:1;">
                <h1 style="margin:0 0 8px 0;">Buat Pengaduan</h1>
                <p class="muted">Sampaikan masalah atau laporan Anda kepada Diskominfo Padang Panjang. Isi formulir pengaduan dengan lengkap agar proses tindak lanjut berjalan cepat.</p>
                <div style="margin-top:16px;display:flex;gap:10px;align-items:center;">
                    <form action="{{ route('pengaduan.index') }}" method="GET" style="display:flex;gap:8px;flex:1;min-width:0;">
                        <input class="input" type="search" name="q" placeholder="Cari pengaduan berdasarkan judul atau isi..." value="{{ request('q') ?? '' }}" style="padding:10px;border-radius:8px;flex:1;" />
                        <button class="btn primary btn-xs" type="submit">Cari</button>
                    </form>
                    <a class="btn ghost" href="{{ route('pengaduan.ketua-anggota') }}">Lihat Ketua & Anggota</a>
                    <a class="btn primary" href="{{ route('pengaduan.create') }}">Buat Pengaduan</a>
                </div>
            </div>
            <div style="width:320px;">
                <div style="width:100%;border-radius:12px;border:1px solid #e6eef0;padding:18px;background:#fff;display:flex;align-items:center;justify-content:center;">
                    <!-- Simple SVG illustration -->
                    <svg width="180" height="120" viewBox="0 0 180 120" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden>
                        <rect x="0" y="0" width="180" height="120" rx="8" fill="#f8fafc" stroke="#e6eef0" />
                        <path d="M20 35 H160" stroke="#c6f6d5" stroke-width="8" stroke-linecap="round" />
                        <rect x="20" y="50" width="120" height="12" rx="4" fill="#e6f5ff" />
                        <rect x="20" y="70" width="90" height="12" rx="4" fill="#f1f5f9" />
                        <circle cx="150" cy="65" r="18" fill="#e0f2fe" />
                        <path d="M146 60 L154 68 M154 60 L146 68" stroke="#0369a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div style="height:16px;"></div>

    <div class="grid grid-2">
        <div class="card">
            <h2>Langkah Pengaduan</h2>
            <ol style="margin-top:8px;padding-left:18px;color:var(--muted)">
                <li>Isi formulir pengaduan dengan lengkap (judul, isi, kategori).</li>
                <li>Unggah bukti foto jika ada (opsional).</li>
                <li>Pengaduan akan langsung diteruskan ke Ketua terkait (berdasarkan kategori).</li>
                <li>Anda dapat memantau status melalui nomor pengaduan yang diberikan.</li>
            </ol>
        </div>

        <div class="card">
            <h2>Informasi Penting</h2>
            <p class="muted">Pastikan kontak yang Anda masukkan valid agar petugas dapat menghubungi jika diperlukan. Pengaduan yang tidak jelas atau menyalahi aturan akan ditolak.</p>
            <hr style="margin:12px 0;border:none;border-top:1px solid var(--border)">
            <h3 style="margin:0 0 6px 0;">Kontak</h3>
            <p class="muted">Diskominfo Padang Panjang — Telp: (0752) 000000 — Email: info@padangpanjang.go.id</p>
        </div>
    </div>

    <div style="height:16px;"></div>

    <div class="card">
        <h2>FAQ singkat</h2>
        <div style="margin-top:8px;color:var(--muted)">
            <p><strong>Apakah pengaduan bisa anonim?</strong> Tidak. Mohon isi identitas kontak untuk tindak lanjut.</p>
            <p><strong>Berapa lama tindak lanjutnya?</strong> Tergantung kategori dan kompleksitas, maksimal 7 hari kerja untuk respon awal.</p>
        </div>
    </div>
@endsection
