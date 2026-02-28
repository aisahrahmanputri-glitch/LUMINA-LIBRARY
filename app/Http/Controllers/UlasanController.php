<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasans = Ulasan::with(['user','buku'])->latest()->get();
        return view('admin.ulasan.index', compact('ulasans'));
    }
}
