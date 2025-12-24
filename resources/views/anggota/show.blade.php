@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap; margin-bottom: 12px;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Detail Pengaduan</h2>
                <p class="muted" style="margin: 0;">ID #{{ $pengaduan->id }} | Dibuat {{ $pengaduan->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
            </div>
            <div class="flex" style="gap: 10px;">
                <a class="btn ghost" href="{{ route('anggota.dashboard') }}">Kembali</a>
                <form action="{{ route('anggota.logout') }}" method="POST">
                    @csrf
                    <button class="btn ghost" type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="grid grid-2" style="gap: 12px; margin-bottom: 12px;">
            <div class="chip">Status: <span class="badge {{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span></div>
            <div class="chip">Kategori: {{ $pengaduan->kategori ?: 'Tidak ditentukan' }}</div>
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
        <div>
            <h3 style="margin: 0 0 8px 0;">Perbarui Status</h3>

            @if ($errors->any())
                <div class="alert" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;margin-bottom:12px;">
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert" style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;margin-bottom:12px;">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('info'))
                <div class="alert" style="background:#f8fafc;color:#475569;border:1px solid var(--border);margin-bottom:12px;">
                    {{ session('info') }}
                </div>
            @endif

            @if($pengaduan->status === 'selesai')
                <div style="padding:10px; border:1px dashed var(--border); margin-bottom:12px;">
                    <p class="muted" style="margin:0 0 8px 0;">Pengaduan ini sudah <strong>Selesai</strong>. Status dan bukti foto tidak dapat diubah.</p>
                </div>
            @else
                <form action="{{ route('anggota.update-status', $pengaduan) }}" method="POST" enctype="multipart/form-data" class="flex" style="gap: 10px; flex-wrap: wrap; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="input" required style="max-width: 200px;">
                        <option value="">Pilih Status</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <input type="file" name="bukti_foto" accept="image/*" class="input" style="max-width: 300px;">
                    <button class="btn primary" type="submit">Perbarui</button>
                </form>
            @endif

            @if($pengaduan->bukti_foto)
                <div style="margin-top:8px;">
                    <p class="muted" style="margin:0 0 6px 0;">Bukti foto:</p>
                    <img src="{{ asset('storage/'.$pengaduan->bukti_foto) }}" alt="Bukti Foto" style="max-width:300px; max-height:200px; display:block; border:1px solid var(--border); padding:4px;">
                    @if($pengaduan->status === 'selesai')
                        <div style="margin-top:6px;"><span class="badge selesai">Terselesaikan</span></div>
                    @endif
                </div>
            @endif
        </div> 

    </div>
@endsection
