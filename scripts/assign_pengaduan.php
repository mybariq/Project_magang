<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$id = $argv[1] ?? 6;
$anggota_id = $argv[2] ?? 1;
$ketua_id = $argv[3] ?? 1;
$ketua = Illuminate\Support\Facades\DB::table('ketuas')->where('id',$ketua_id)->value('nama');
$anggota = Illuminate\Support\Facades\DB::table('anggotas')->where('id',$anggota_id)->value('nama');
$ok = Illuminate\Support\Facades\DB::table('pengaduans')->where('id',$id)->update([
    'anggota_id' => $anggota_id,
    'anggota' => $anggota,
    'ketua_id' => $ketua_id,
    'ketua' => $ketua,
    'updated_at' => date('Y-m-d H:i:s'),
]);
if ($ok) echo "Assigned pengaduan id=$id to anggota_id=$anggota_id (\"$anggota\") and ketua_id=$ketua_id (\"$ketua\")\n";
else echo "Update failed or no change\n";
