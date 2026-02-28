<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
   protected $table = 'peminjam';
    protected $fillable = [
        'jenis_laporan',
        'tanggal_awal',
        'tanggal_akhir',
        'user_id',
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
