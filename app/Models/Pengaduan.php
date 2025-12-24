<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'kategori',
        'ketua_id',
        'ketua',
        'anggota_id',
        'anggota',
        'judul',
        'isi',
        'status',
        'bukti_foto',
        'perlu_perhatian',
        'catatan_perhatian',
    ];

    public function ketuaModel()
    {
        return $this->belongsTo(\App\Models\Ketua::class, 'ketua_id');
    }

    public function anggotaModel()
    {
        return $this->belongsTo(\App\Models\Anggota::class, 'anggota_id');
    }
}

