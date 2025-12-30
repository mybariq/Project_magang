<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengaduan | Diskominfo Padang Panjang</title>
    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #0b5c55;
            --text: #0f172a;
            --muted: #475569;
            --bg: #f8fafc;
            --white: #ffffff;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        a { color: inherit; text-decoration: none; }
        .container { max-width: 1100px; margin: 0 auto; padding: 24px 16px 40px; }
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            padding: 20px;
        }
        .card h2 { margin: 0 0 6px 0; font-size: 18px; }
        .card p.muted { margin: 0; color: var(--muted); }
        header {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
        }
        header .inner { display: flex; align-items: center; justify-content: space-between; padding: 16px; max-width: 1100px; margin: 0 auto; }
        .brand { display: flex; flex-direction: column; gap: 2px; line-height:1; }
        .brand strong { font-size: 17px; }
        .brand span { font-size: 12px; color: var(--muted); }
        .clock { font-size: 13px; color: var(--muted); display: inline-flex; gap: 6px; align-items: center; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, border-color 0.2s, transform 0.08s;
        }
        .btn.primary { background: var(--primary); color: #fff; padding: 10px 16px; border-radius: 10px; }
        .btn.primary:hover { background: var(--primary-dark); transform: translateY(-1px); }
        .btn.ghost { background: transparent; border-color: var(--border); color: var(--muted); }
        .btn.ghost:hover { border-color: var(--primary); color: var(--primary-dark); }
        .btn-xs {
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 6px;
            font-weight: 600;
            border: 1px solid transparent;
        }
        .btn-action-warning { background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;padding:6px 10px;border-radius:6px;font-weight:700; }
        .btn-action-success { background:#ecfdf3;color:#15803d;border:1px solid #bbf7d0;padding:6px 10px;border-radius:6px;font-weight:700; }
        .grid { display: grid; gap: 16px; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }
        .field { display: flex; flex-direction: column; gap: 8px; }
        .field label { font-weight: 600; color: var(--text); }
        .field small { color: var(--muted); }
        .input, textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #fff;
            font-size: 14px;
        }
        textarea { min-height: 140px; resize: vertical; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 10px; border-bottom: 1px solid var(--border); text-align: left; }
        .table th { background: #f1f5f9; font-size: 13px; color: var(--muted); }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }
        .badge.baru { background: #ecfeff; color: #0ea5e9; }
        .badge.diproses { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
        .badge.selesai { background: #ecfdf3; color: #15803d; border: 1px solid #bbf7d0; }
        .pill-nav { display: inline-flex; align-items: center; gap: 8px; background: #e2e8f0; padding: 6px; border-radius: 14px; }
        .pill-nav a { padding: 8px 12px; border-radius: 10px; color: var(--muted); font-weight: 600; }
        .pill-nav a.active { background: #fff; color: var(--primary); box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08); }
        .muted { color: var(--muted); }
        .flex { display: flex; align-items: center; gap: 12px; }
        .flex-between { justify-content: space-between; }
        .space-between { display: flex; justify-content: space-between; align-items: center; }
        .chip { padding: 6px 10px; border-radius: 10px; background: #f8fafc; border: 1px solid var(--border); color: var(--muted); font-size: 12px; }
        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            background: #ecfdf3;
            color: #166534;
            border: 1px solid #bbf7d0;
            margin-bottom: 16px;
        }

        /* Layout & spacing tweaks */
        .container { max-width: 1100px; margin: 0 auto; padding: 12px 16px 32px; }
        header .inner { padding: 12px 16px; }

        /* Table & row improvements */
        .table th, .table td { padding: 14px 12px; vertical-align: middle; }
        .table tbody tr { transition: background 0.12s, transform 0.08s; }
        .table tbody tr:hover { background: rgba(15,23,42,0.02); transform: translateY(-1px); }
        .table td { border-bottom: 1px solid var(--border); }
        .table .td-actions { text-align: right; white-space: nowrap; }

        /* Badges & thumbnails */
        .badge { min-width: 84px; text-align: center; display:inline-block; }
        .bukti-thumb { max-width: 340px; max-height: 220px; display:block; border:1px solid var(--border); padding:6px; border-radius:8px; }

        @media (max-width: 880px) {
            .container { padding-left: 12px; padding-right: 12px; }
        }

        @media (max-width: 640px) {
            header .inner { flex-direction: column; align-items: flex-start; gap: 10px; }
            .pill-nav { width: 100%; }

            /* Responsive table -> stacked cards */
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tr { margin-bottom: 12px; border-radius: 8px; overflow: hidden; padding: 0; }
            .table td { padding: 10px 12px; border-bottom: 1px solid transparent; display: flex; justify-content: space-between; align-items: center; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--muted); margin-right: 12px; flex: 0 0 auto; }
            .table td .value { flex: 1 1 auto; text-align: right; }
            .table td:last-child { border-bottom: none; }
        }
    </style>
</head>
<body>
    <header>
        <div class="inner">
            <a href="{{ route('home') }}" class="brand" aria-label="Beranda Sistem Pengaduan">
                <strong>Sistem Pengaduan Masyarakat</strong>
                <span>Diskominfo Padang Panjang</span>
                <span class="clock">Waktu: <span id="clock-text">--:--:--</span></span>
            </a>
            <div class="flex">
                @if(session('ketua_id'))
                    <a class="btn ghost" href="{{ route('ketua.dashboard') }}">Dashboard Ketua</a>
                    <form action="{{ route('ketua.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="btn ghost" type="submit">Logout</button>
                    </form>
                @elseif(session('anggota_id'))
                    <a class="btn ghost" href="{{ route('anggota.dashboard') }}">Dashboard Anggota</a>
                    <form action="{{ route('anggota.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="btn ghost" type="submit">Logout</button>
                    </form>
                @else
                    <a class="btn ghost" href="{{ route('pengaduan.index') }}">Daftar Pengaduan</a>
                    <a class="btn ghost" href="{{ route('pengaduan.ketua-anggota') }}">Ketua & Anggota</a>
                    <a class="btn ghost" href="{{ route('ketua.login') }}">Login Ketua</a>
                    <a class="btn ghost" href="{{ route('anggota.login') }}">Login Anggota</a>
                    <a class="btn primary" href="{{ route('pengaduan.create') }}">Buat Pengaduan</a>
                @endif
            </div>
        </div>
    </header>

    <div class="container">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
    <script>
        (function() {
            const el = document.getElementById('clock-text');
            if (!el) return;
            const fmt = new Intl.DateTimeFormat('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const tick = () => { el.textContent = fmt.format(new Date()); };
            tick();
            setInterval(tick, 1000);
        })();
    </script>
</body>
</html>

