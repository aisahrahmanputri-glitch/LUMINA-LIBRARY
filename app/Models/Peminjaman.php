<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'siswa_id',
        'buku_id',
        'jumlah',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status_pengembalian'
    ];

    // ✅ FIX: cukup SATU casts
    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'tanggal_pengembalian' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER STATUS
    |--------------------------------------------------------------------------
    */

    public function isMenunggu()
    {
        return $this->status_pengembalian === 'menunggu';
    }

    public function isDipinjam()
    {
        return $this->status_pengembalian === 'dipinjam';
    }

    public function isDikembalikan()
    {
        return $this->status_pengembalian === 'dikembalikan';
    }

    public function isTerlambat()
    {
        return $this->status_pengembalian === 'terlambat';
    }

    public function isDitolak()
    {
        return $this->status_pengembalian === 'ditolak';
    }

    /*
    |--------------------------------------------------------------------------
    | LABEL (UI)
    |--------------------------------------------------------------------------
    */

    public function getStatusLabelAttribute()
    {
        return match($this->status_pengembalian) {
            'menunggu'     => '⏳ Menunggu Validasi',
            'dipinjam'     => '📖 Dipinjam',
            'dikembalikan' => '✅ Dikembalikan',
            'terlambat'    => '⚠ Terlambat',
            'ditolak'      => '❌ Ditolak',
            default        => 'Unknown'
        };
    }

    /*
    |--------------------------------------------------------------------------
    | WARNA BADGE
    |--------------------------------------------------------------------------
    */

    public function getStatusColorAttribute()
    {
        return match($this->status_pengembalian) {
            'menunggu'     => 'bg-yellow-100 text-yellow-700',
            'dipinjam'     => 'bg-blue-100 text-blue-700',
            'dikembalikan' => 'bg-green-100 text-green-700',
            'terlambat'    => 'bg-red-100 text-red-700',
            'ditolak'      => 'bg-gray-200 text-gray-600',
            default        => 'bg-gray-100 text-gray-500'
        };
    }
}
