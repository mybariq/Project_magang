@if(isset($notifications) && $notifications->isNotEmpty())
    <div id="notifications" style="margin-top:12px;">
        <h3 style="margin:0 0 8px 0;">Notifikasi Perhatian</h3>
        <ul style="list-style:none; padding:0; margin:0;">
            @foreach($notifications as $n)
                <li style="border:1px solid var(--border); padding:8px; margin-bottom:8px;">
                    <div style="font-weight:600;">{{ $n->judul }} <span class="muted" style="font-weight:400; font-size:12px;">({{ $n->kategori }})</span></div>
                    <div class="muted" style="font-size:13px; margin-top:6px;">{{ $n->message }}</div>
                    <div style="margin-top:6px; font-size:12px;">
                        <a class="btn-xs" href="{{ route('ketua.show', $n->pengaduan_id) }}">Lihat</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif