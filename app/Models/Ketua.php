<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Ketua extends Model
{
    protected $fillable = [
        'nama',
        'username',
        'password',
        'kategori',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'ketua_id');
    }
}
