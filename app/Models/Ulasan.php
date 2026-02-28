<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = [
        'user_id',
        'buku_id',
        'rating',
        'ulasan'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function buku()
    {
        return $this->belongsTo(\App\Models\Buku::class);
    }
}