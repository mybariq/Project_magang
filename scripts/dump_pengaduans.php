<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = Illuminate\Support\Facades\DB::table('pengaduans')->get();
if ($rows->isEmpty()) {
    echo "No pengaduans\n";
    exit;
}
foreach ($rows as $r) {
    echo sprintf("%d | judul=%s | kategori=%s | ketua_id=%s | ketua=%s | anggota_id=%s | anggota=%s | status=%s\n",
        $r->id,
        $r->judul,
        $r->kategori ?? 'NULL',
        is_null($r->ketua_id)?'NULL':$r->ketua_id,
        $r->ketua ?? 'NULL',
        is_null($r->anggota_id)?'NULL':$r->anggota_id,
        $r->anggota ?? 'NULL',
        $r->status
    );
}
