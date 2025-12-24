@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap; margin-bottom: 12px;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Daftar Ketua dan Anggota</h2>
                <p class="muted" style="margin: 0;">Daftar ketua dan anggota untuk setiap kategori pengaduan.</p>
            </div>
            <a class="btn ghost" href="{{ route('pengaduan.index') }}">Kembali</a>
        </div>

        @foreach($data as $kategori => $items)
            <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--border);">
                <h3 style="margin: 0 0 12px 0; color: var(--primary);">{{ $kategori }}</h3>
                
                <div class="grid grid-2" style="gap: 16px;">
                    <div>
                        <h4 style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #0369a1;">Ketua</h4>
                        <ul style="margin: 0; padding-left: 20px; list-style: disc;">
                            @foreach($items['ketua'] ?? [] as $ketua)
                                <li style="margin-bottom: 4px;">{{ $ketua }}</li>
                            @endforeach
                            @if(empty($items['ketua']))
                                <li class="muted">Belum ada ketua</li>
                            @endif
                        </ul>
                    </div>
                    
                    <div>
                        <h4 style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #15803d;">Anggota</h4>
                        <ul style="margin: 0; padding-left: 20px; list-style: disc;">
                            @foreach($items['anggota'] ?? [] as $anggota)
                                <li style="margin-bottom: 4px;">{{ $anggota }}</li>
                            @endforeach
                            @if(empty($items['anggota']))
                                <li class="muted">Belum ada anggota</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

        @if(empty($data))
            <p class="muted" style="margin: 10px 0;">Belum ada data ketua dan anggota.</p>
        @endif
    </div>
@endsection

