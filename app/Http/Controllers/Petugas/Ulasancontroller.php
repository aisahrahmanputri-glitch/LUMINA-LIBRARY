<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
    {
     $ulasans = Ulasan::with(['user','buku'])->latest()->get();

    return view('petugas.review.index', compact('ulasans'));
}
    }

