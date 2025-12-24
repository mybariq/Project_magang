<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KetuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ketua::create([
            'nama' => 'Ketua Aplikasi',
            'username' => 'ketua_aplikasi',
            'password' => 'password123',
            'kategori' => 'Aplikasi',
        ]);

        \App\Models\Ketua::create([
            'nama' => 'Ketua Jaringan',
            'username' => 'ketua_jaringan',
            'password' => 'password123',
            'kategori' => 'Jaringan',
        ]);

        \App\Models\Ketua::create([
            'nama' => 'Ketua Persandian',
            'username' => 'ketua_persandian',
            'password' => 'password123',
            'kategori' => 'Persandian',
        ]);
    }
}
