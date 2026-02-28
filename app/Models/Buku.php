<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Ulasan;
use App\Models\User; // ✅ tambah ini

class Buku extends Model
{
    protected $table = 'bukus';

    protected $fillable = [
        'judul',
        'penulis',
        'tahun_terbit',
        'isbn',
        'cover',
        'stock_buku',
        'sinopsis',
        'penerbit',
        'kategori_id',
        'user_id', // ✅ tambah ini
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'buku_id');
    }

    // ✅ tambah ini
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAverageRatingAttribute()
    {
        return round($this->ulasans()->avg('rating'), 1);
    }
}