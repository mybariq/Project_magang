<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$has = Illuminate\Support\Facades\Schema::hasColumn('pengaduans','bukti_foto');
echo $has ? "bukti_foto column exists\n" : "bukti_foto column NOT found\n";
