@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="space-between" style="gap: 12px; flex-wrap: wrap; margin-bottom: 12px;">
            <div>
                <h2 style="margin: 0 0 6px 0;">Dashboard Anggota</h2>
                <p class="muted" style="margin: 0;">Selamat datang, {{ session('anggota_nama') }}</p>
            </div>
            <div class="flex" style="gap: 10px;">
                <form action="{{ route('anggota.logout') }}" method="POST">
                    @csrf
                    <button class="btn ghost" type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="grid grid-2" style="gap: 12px; margin-bottom: 12px;">
            <div class="chip">Status: filter</div>
            <div class="chip">Jumlah tugas: {{ $counts['semua'] }}</div>
        </div>

        <div>
            @foreach($pengaduans as $p)
                <div class="card" style="margin-bottom: 8px;">
                    <div class="space-between">
                        <div>
                            <strong>#{{ $p->id }} - {{ $p->judul }}</strong>
                            <div class="muted">{{ $p->kategori }} • {{ $p->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</div>
                        </div>
                        <div>
                            <a href="{{ route('anggota.show', $p) }}" class="btn-xs">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div style="margin-top: 12px;">
                {{ $pengaduans->links() }}
            </div>
        </div>
    </div>
@endsection
