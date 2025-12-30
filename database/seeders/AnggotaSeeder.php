<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $data = config('ketua_anggota', []);

        foreach ($data as $kategori => $items) {
            foreach ($items['anggota'] ?? [] as $idx => $nama) {
                Anggota::create([
                    'nama' => $nama,
                    'username' => strtolower(str_replace(' ', '_', $nama)) . ($idx + 1),
                    'password' => Hash::make('password123'),
                    'kategori' => $kategori,
                ]);
            }
        }
    }
}
