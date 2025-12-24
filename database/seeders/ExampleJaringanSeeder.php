<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Anggota;
use App\Models\Pengaduan;

class ExampleJaringanSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure an Anggota for 'Jaringan' exists
        $anggota = Anggota::firstOrCreate(
            ['username' => 'jaringan1'],
            [
                'nama' => 'Anggota Jaringan 1',
                'password' => 'password123',
                'kategori' => 'Jaringan',
            ]
        );

        // Create a small placeholder PNG in storage/public/bukti
        $pngBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJ
bWFnZVJlYWR5ccllPAAAAZJJREFUeNrs1jENwzAMBuCN/6yvY4KZ1ga3o4i6m2i91w3JkUOeJg6m
IOiY6Dg4ODg4ODs6D+gq9wB6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6oX3rQxXwB6gX6gH6
gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6g
H6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX
6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gIEe0EwA
wqzKX6oQ0NwAAAABJRU5ErkJggg==';
        $image = base64_decode($pngBase64);
        Storage::disk('public')->put('bukti/sample_jaringan.png', $image);

        // Create a sample pengaduan assigned to this anggota and marked selesai
        Pengaduan::create([
            'nama' => 'Pengguna Contoh',
            'email' => 'user@example.com',
            'no_hp' => '081234567890',
            'kategori' => 'Jaringan',
            'ketua_id' => null,
            'ketua' => null,
            'anggota_id' => $anggota->id,
            'anggota' => $anggota->nama,
            'judul' => 'Pengecekan jaringan',
            'isi' => 'Contoh pengaduan: gangguan jaringan, mohon dicek.',
            'status' => 'selesai',
            'bukti_foto' => 'bukti/sample_jaringan.png',
            'perlu_perhatian' => false,
            'catatan_perhatian' => null,
        ]);

        // Create sample anggota & pengaduan for Aplikasi
        $aplikasiAnggota = Anggota::firstOrCreate(
            ['username' => 'aplikasi1'],
            [
                'nama' => 'Anggota Aplikasi 1',
                'password' => 'password123',
                'kategori' => 'Aplikasi',
            ]
        );
        $pngBase64B = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJ
bWFnZVJlYWR5ccllPAAAAZJJREFUeNrs1jENwzAMBuCN/6yvY4KZ1ga3o4i6m2i91w3JkUOeJg6m
IOiY6Dg4ODg4ODs6D+gq9wB6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6oX3rQxXwB6gX6gH6
gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gH6g
H6gX6gH6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH
6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gIEe0EwA
wqzKX6oQ0NwAAAABJRU5ErkJggg==';
        $imageB = base64_decode($pngBase64B);
        Storage::disk('public')->put('bukti/sample_aplikasi.png', $imageB);

        Pengaduan::create([
            'nama' => 'Pelapor Aplikasi',
            'email' => 'aplikasi@example.com',
            'no_hp' => '081234000001',
            'kategori' => 'Aplikasi',
            'ketua_id' => null,
            'ketua' => null,
            'anggota_id' => $aplikasiAnggota->id,
            'anggota' => $aplikasiAnggota->nama,
            'judul' => 'Permintaan fitur baru',
            'isi' => 'Contoh pengaduan untuk Aplikasi.',
            'status' => 'selesai',
            'bukti_foto' => 'bukti/sample_aplikasi.png',
            'perlu_perhatian' => false,
            'catatan_perhatian' => null,
        ]);

        // Create sample anggota & pengaduan for Persandian
        $persandianAnggota = Anggota::firstOrCreate(
            ['username' => 'persandian1'],
            [
                'nama' => 'Anggota Persandian 1',
                'password' => 'password123',
                'kategori' => 'Persandian',
            ]
        );
        $pngBase64C = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJ
bWFnZVJlYWR5ccllPAAAAZJJREFUeNrs1jENwzAMBuCN/6yvY4KZ1ga3o4i6m2i91w3JkUOeJg6m
IOiY6Dg4ODg4ODs6D+gq9wB6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6oX3rQxXwB6gX6gH6
gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gX6gH6gX6gH6g
H6gX6gH6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH
6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gX6gH6gIEe0EwA
wqzKX6oQ0NwAAAABJRU5ErkJggg==';
        $imageC = base64_decode($pngBase64C);
        Storage::disk('public')->put('bukti/sample_persandian.png', $imageC);

        Pengaduan::create([
            'nama' => 'Pelapor Persandian',
            'email' => 'persandian@example.com',
            'no_hp' => '081234000002',
            'kategori' => 'Persandian',
            'ketua_id' => null,
            'ketua' => null,
            'anggota_id' => $persandianAnggota->id,
            'anggota' => $persandianAnggota->nama,
            'judul' => 'Permintaan pemeriksaan persandian',
            'isi' => 'Contoh pengaduan untuk Persandian.',
            'status' => 'selesai',
            'bukti_foto' => 'bukti/sample_persandian.png',
            'perlu_perhatian' => false,
            'catatan_perhatian' => null,
        ]);
    }
}
