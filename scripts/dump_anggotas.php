<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rows = Illuminate\Support\Facades\DB::table('anggotas')->get();
if ($rows->isEmpty()) {
    echo "No anggotas found\n";
    exit;
}
foreach ($rows as $r) {
    echo sprintf("%d | %s | %s | pw_len=%d | pw_start=%s\n", $r->id, $r->username, $r->nama, strlen($r->password), substr($r->password,0,10));
}
