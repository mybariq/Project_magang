<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$db = Illuminate\Support\Facades\DB::connection();
$rows = $db->table('pengaduans')->whereNotNull('anggota')->whereNull('anggota_id')->get();
if ($rows->isEmpty()) {
    echo "No pengaduans need backfill\n";
    exit;
}
$updated = 0;
foreach ($rows as $r) {
    $name = trim($r->anggota);
    // try exact match first
    $anggota = $db->table('anggotas')->whereRaw('lower(nama) = ?', [strtolower($name)])->first();
    if (!$anggota) {
        // try matching by username too
        $anggota = $db->table('anggotas')->whereRaw('lower(username) = ?', [strtolower($name)])->first();
    }
    if ($anggota) {
        $ok = $db->table('pengaduans')->where('id', $r->id)->update(['anggota_id' => $anggota->id, 'updated_at' => date('Y-m-d H:i:s')]);
        if ($ok) {
            echo "Backfilled pengaduan id={$r->id} -> anggota_id={$anggota->id} ({$anggota->nama})\n";
            $updated++;
        }
    } else {
        echo "No match for pengaduan id={$r->id} anggota_name=\"{$name}\"\n";
    }
}
echo "Done. Updated: $updated\n";
