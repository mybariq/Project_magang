@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap; margin-bottom: 12px;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Detail Pengaduan</h2>
                <p class="muted" style="margin: 0;">ID #{{ $pengaduan->id }} | Dibuat {{ $pengaduan->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
            </div>
            <a class="btn ghost" href="{{ route('pengaduan.index') }}">Kembali</a>
        </div>

        <div class="grid grid-2" style="gap: 12px; margin-bottom: 12px;">
            <div class="chip">Status: <span class="badge {{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span></div>
            <div class="chip">Kategori: {{ $pengaduan->kategori ?: 'Tidak ditentukan' }}</div>
            <div class="chip">Pelapor: {{ $pengaduan->nama }}</div>
            <div class="chip">Kontak: {{ $pengaduan->email }} {{ $pengaduan->no_hp ? ' | ' . $pengaduan->no_hp : '' }}</div>
            @if($pengaduan->ketua)
                <div class="chip">Ketua: <strong>{{ $pengaduan->ketua }}</strong></div>
            @endif
            @if($pengaduan->anggota)
                <div class="chip">Anggota: <strong>{{ $pengaduan->anggota }}</strong></div>
            @endif
        </div>

        <div style="margin-bottom: 16px;">
            <h3 style="margin: 0 0 6px 0;">Judul</h3>
            <p style="margin: 0; font-weight: 600;">{{ $pengaduan->judul }}</p>
        </div>

        <div>
            <h3 style="margin: 0 0 6px 0;">Isi Pengaduan</h3>
            <p style="margin: 0; white-space: pre-line; line-height: 1.6;">{{ $pengaduan->isi }}</p>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border); margin: 20px 0;">

        @if($pengaduan->bukti_foto)
            <div style="margin-bottom: 16px;">
                <h3 style="margin: 0 0 6px 0;">Bukti Foto</h3>
                <img src="{{ asset('storage/'.$pengaduan->bukti_foto) }}" class="bukti-thumb" alt="Bukti Foto">
                @if($pengaduan->status === 'selesai')
                    <div style="margin-top:8px;"><span class="badge selesai">Terselesaikan</span></div>
                @endif
            </div>
        @endif

        <div>
            <h3 style="margin: 0 0 8px 0;">Perbarui Status</h3>
            @if($pengaduan->status === 'selesai')
                <p class="muted" style="margin:0 0 8px 0;">Pengaduan sudah <strong>Selesai</strong>. Status tidak dapat diubah melalui publikasi UI.</p>
            @else
                <form action="{{ route('pengaduan.update-status', $pengaduan) }}" method="POST" class="flex" style="gap: 10px; flex-wrap: wrap;">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="input" style="max-width: 200px;">
                        @foreach (['baru' => 'Baru', 'diproses' => 'Diproses', 'selesai' => 'Selesai'] as $value => $label)
                            <option value="{{ $value }}" @selected($pengaduan->status === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button class="btn primary" type="submit">Simpan</button>
                </form>
            @endif
        </div>

        @if($pengaduan->ketua && !$pengaduan->anggota)
            <hr style="border: none; border-top: 1px solid var(--border); margin: 20px 0;">
            <div>
                <p class="muted" style="margin: 0 0 8px 0; font-size: 0.9em;">
                    Pengaduan ini telah ditetapkan ke <strong>{{ $pengaduan->ketua }}</strong>.
                    Ketua dapat login untuk mengutus anggota melalui dashboard ketua.
                </p>
                <div class="flex" style="gap:8px;">
                    <a href="{{ route('ketua.login') }}" class="btn ghost">Login sebagai Ketua</a>
                    <a href="{{ route('anggota.login') }}" class="btn ghost">Login sebagai Anggota</a>
                </div>
            </div>
        @endif

        <hr style="border: none; border-top: 1px solid var(--border); margin: 20px 0;">

        <div>
            <h3 style="margin: 0 0 8px 0;">Hapus Pengaduan (Petugas)</h3>
            <form action="{{ route('pengaduan.destroy', $pengaduan) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini? Tindakan tidak bisa dibatalkan.');">
                @csrf
                @method('DELETE')
                <button class="btn ghost" type="submit" style="color:#b91c1c; border-color:#fecdd3; background:#fff1f2;">
                    Hapus Pengaduan
                </button>
            </form>
        </div>
    </div>
@endsection

