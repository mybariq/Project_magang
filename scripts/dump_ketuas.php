<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = Illuminate\Support\Facades\DB::table('ketuas')->get();
if ($rows->isEmpty()) {
    echo "No ketuas\n";
    exit;
}
foreach ($rows as $r) {
    echo sprintf("%d | nama=%s | kategori=%s | username=%s\n", $r->id, $r->nama, $r->kategori, $r->username);
}
