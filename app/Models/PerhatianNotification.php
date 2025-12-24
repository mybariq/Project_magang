<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhatianNotification extends Model
{
    use HasFactory;

    protected $table = 'perhatian_notifications';

    protected $fillable = [
        'pengaduan_id',
        'ketua_id',
        'message',
        'is_read',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }
}
