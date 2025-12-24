<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$data = [
    'judul' => 'Pengaduan Tes Aplikasi',
    'isi' => 'Ini adalah pengaduan uji untuk kategori Aplikasi',
    'kategori' => 'Aplikasi',
    'nama' => 'Tester',
    'email' => 'tester@example.com',
    'no_hp' => '08123456789',
    'status' => 'baru',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
];
$id = Illuminate\Support\Facades\DB::table('pengaduans')->insertGetId($data);
echo "Inserted pengaduan id=$id\n";
