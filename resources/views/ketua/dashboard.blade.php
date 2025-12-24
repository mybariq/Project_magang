@extends('layouts.app')

@php
    $statusList = [
        'semua' => 'Semua',
        'baru' => 'Baru',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
    ];
@endphp

@section('content')
    <div class="card" style="margin-bottom: 16px;">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Dashboard Ketua {{ $ketuaKategori }}</h2>
                <p class="muted" style="margin: 0;">Selamat datang, <strong>{{ session('ketua_nama') }}</strong></p>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                @if(isset($notificationsCount) && $notificationsCount > 0)
                    <a href="#notifications" class="chip" style="background:var(--accent); color:#fff;">Notifikasi: {{ $notificationsCount }}</a>
                @endif
            </div>
            <form action="{{ route('ketua.logout') }}" method="POST">
                @csrf
                <button class="btn ghost" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="card" style="margin-bottom: 16px;">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Ringkasan Status</h2>
                <p class="muted" style="margin: 0;">Pantau progres pengaduan kategori {{ $ketuaKategori }}.</p>
            </div>
            <div class="pill-nav">
                @foreach ($statusList as $key => $label)
                    <a href="{{ $key === 'semua' ? route('ketua.dashboard') : route('ketua.dashboard', ['status' => $key]) }}"
                       class="{{ ($status ?? 'semua') === $key ? 'active' : '' }}">
                        {{ $label }}
                        <span class="chip">{{ $counts[$key] ?? 0 }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card">
        <div class="space-between" style="margin-bottom: 12px; gap: 12px; flex-wrap: wrap;">
            <div>
                <h2 style="margin: 0 0 4px 0;">Daftar Pengaduan</h2>
                <p class="muted" style="margin: 0;">Pengaduan kategori {{ $ketuaKategori }} yang ditugaskan kepada Anda.</p>
            </div>
            <div style="min-width:220px; text-align:right;">
                @include('ketua._notifications')
            </div>
        </div>

        @if ($pengaduans->isEmpty())
            <p class="muted" style="margin: 10px 0;">Belum ada pengaduan untuk kategori {{ $ketuaKategori }}.</p>
        @else
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>Anggota</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>
                                    <a href="{{ route('ketua.show', $pengaduan) }}" style="font-weight: 600; color: var(--primary);">
                                        {{ $pengaduan->judul }}
                                    </a>
                                </td>
                                <td>
                                    <div style="font-weight: 600;">{{ $pengaduan->nama }}</div>
                                    <div class="muted" style="font-size: 12px;">{{ $pengaduan->email }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span>
                                </td>
                                <td>
                                    @if($pengaduan->anggota)
                                        <span style="font-weight: 600;">{{ $pengaduan->anggota }}</span>
                                    @else
                                        <span class="muted" style="font-size: 12px;">Belum ditugaskan</span>
                                    @endif
                                </td>
                                <td>{{ $pengaduan->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('ketua.show', $pengaduan) }}" class="btn-xs" style="background:#e0f2fe;color:#0369a1;border:1px solid #bae6fd;">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 12px;">
                {{ $pengaduans->links() }}
            </div>
        @endif
    </div>
@endsection

