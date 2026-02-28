<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    protected $table = 'koleksi';
    protected $fillable = [
        'user_id',
        'buku_id',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    
    }
    
    public function buku()
    
    {
        return $this->belongsTo(Buku::class);
    }
}