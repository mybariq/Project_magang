<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$has1 = Illuminate\Support\Facades\Schema::hasColumn('pengaduans','perlu_perhatian');
$has2 = Illuminate\Support\Facades\Schema::hasColumn('pengaduans','catatan_perhatian');
$hasTable = Illuminate\Support\Facades\Schema::hasTable('perhatian_notifications');
echo $has1 ? "perlu_perhatian exists\n" : "perlu_perhatian NOT found\n";
echo $has2 ? "catatan_perhatian exists\n" : "catatan_perhatian NOT found\n";
echo $hasTable ? "perhatian_notifications table exists\n" : "perhatian_notifications table NOT found\n";
