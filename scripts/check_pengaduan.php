<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = Illuminate\Support\Facades\DB::table('pengaduans')->where('kategori','Aplikasi')->get();
if ($rows->isEmpty()) {
    echo "No pengaduans in Aplikasi\n";
    exit;
}
foreach ($rows as $r) {
    echo sprintf("%d | ketua_id=%s | anggota_id=%s | status=%s\n", $r->id, is_null($r->ketua_id)?'NULL':$r->ketua_id, is_null($r->anggota_id)?'NULL':$r->anggota_id, $r->status);
}
