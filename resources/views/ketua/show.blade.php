@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap; margin-bottom: 12px;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Detail Pengaduan</h2>
                <p class="muted" style="margin: 0;">ID #{{ $pengaduan->id }} | Dibuat {{ $pengaduan->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
            </div>
            <div class="flex" style="gap: 10px;">
                <a class="btn ghost" href="{{ route('ketua.dashboard') }}">Kembali</a>
                <form action="{{ route('ketua.logout') }}" method="POST">
                    @csrf
                    <button class="btn ghost" type="submit">Logout</button>
                </form>
            </div>
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
            @if($pengaduan->perlu_perhatian)
                <div class="chip" style="background:#fef3c7;color:#92400e;">Perlu Perhatian</div>
                @if($pengaduan->catatan_perhatian)
                    <div style="margin-top:8px;">
                        <strong>Catatan:</strong>
                        <p class="muted" style="margin:4px 0 0 0;">{{ $pengaduan->catatan_perhatian }}</p>
                    </div>
                @endif
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

        @if($pengaduan->bukti_foto)
            <div style="margin-top:12px;">
                <p class="muted" style="margin:0 0 6px 0;">Bukti foto:</p>
                <img src="{{ asset('storage/'.$pengaduan->bukti_foto) }}" alt="Bukti Foto" class="bukti-thumb">
                @if($pengaduan->status === 'selesai')
                    <div style="margin-top:6px;"><span class="badge selesai">Terselesaikan</span></div>
                @endif
            </div>
        @endif

        @if(!$pengaduan->anggota)
            <hr style="border: none; border-top: 1px solid var(--border); margin: 20px 0;">
            <div>
                <h3 style="margin: 0 0 8px 0;">Utus Anggota</h3>
                <p class="muted" style="margin: 0 0 8px 0; font-size: 0.9em;">
                    Pilih anggota untuk menangani pengaduan ini.
                </p>
                @if(!empty($anggotaList))
                    <form action="{{ route('ketua.assign-anggota', $pengaduan) }}" method="POST" class="flex" style="gap: 10px; flex-wrap: wrap;">
                        @csrf
                        @method('PATCH')
                        <select name="anggota_id" class="input" required style="max-width: 300px;">
                            <option value="">Pilih Anggota</option>
                            @foreach($anggotaList as $anggota)
                                <option value="{{ $anggota->id ?? $anggota->nama }}" @selected(old('anggota_id') == ($anggota->id ?? $anggota->nama))>{{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                        <button class="btn primary" type="submit">Utus Anggota</button>
                    </form>
                @else
                    <p class="muted" style="margin: 0; font-size: 0.9em; color: #dc2626;">Daftar anggota untuk kategori ini belum tersedia.</p>
                @endif
            </div>
        @endif
    </div>
@endsection

