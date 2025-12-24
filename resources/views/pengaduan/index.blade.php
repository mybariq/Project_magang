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
                <h2 style="margin: 0 0 6px 0;">Ringkasan Status</h2>
                <p class="muted" style="margin: 0;">Pantau progres pengaduan masyarakat.</p>
            </div>
            <div class="pill-nav">
                @foreach ($statusList as $key => $label)
                    <a href="{{ $key === 'semua' ? route('pengaduan.index') : route('pengaduan.index', ['status' => $key]) }}"
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
                <p class="muted" style="margin: 0;">Pengaduan terbaru akan muncul di urutan atas.</p>
            </div>
            <a class="btn primary" href="{{ route('pengaduan.create') }}">+ Pengaduan Baru</a>
        </div>

        @if ($pengaduans->isEmpty())
            <p class="muted" style="margin: 10px 0;">Belum ada pengaduan.</p>
        @else
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td data-label="Judul">
                                    <a href="{{ route('pengaduan.show', $pengaduan) }}" class="title-link" style="font-weight: 600; color: var(--primary);">
                                        {{ $pengaduan->judul }}
                                    </a>
                                </td>
                                <td data-label="Pelapor">
                                    <div style="font-weight: 600;">{{ $pengaduan->nama }}</div>
                                    <div class="muted" style="font-size: 12px;">{{ $pengaduan->email }}</div>
                                </td>
                                <td data-label="Kategori">
                                    @if($pengaduan->kategori)
                                        <span style="font-weight: 600;">{{ $pengaduan->kategori }}</span>
                                        @if($pengaduan->ketua)
                                            <div class="muted" style="font-size: 11px; margin-top: 2px;">Ketua: {{ $pengaduan->ketua }}</div>
                                        @endif
                                        @if($pengaduan->anggota)
                                            <div class="muted" style="font-size: 11px;">Anggota: {{ $pengaduan->anggota }}</div>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td data-label="Status">
                                    <span class="badge {{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span>
                                </td>
                                <td data-label="Dibuat">{{ $pengaduan->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                                <td data-label="Aksi" class="td-actions">
                                    @if ($pengaduan->status === 'baru')
                                        <form action="{{ route('pengaduan.update-status', $pengaduan) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="diproses">
                                            <button class="btn-xs btn-action-warning" type="submit">Proses</button>
                                        </form>
                                    @elseif ($pengaduan->status === 'diproses')
                                        <form action="{{ route('pengaduan.update-status', $pengaduan) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="selesai">
                                            <button class="btn-xs btn-action-success" type="submit">✓ Selesai</button>
                                        </form>
                                    @else
                                        <span class="muted" style="font-size:12px;">—</span>
                                    @endif
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

