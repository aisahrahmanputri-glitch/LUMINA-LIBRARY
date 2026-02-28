<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['buku','siswa'])->latest()->get();

        return view('petugas.borrowings', compact('data'));
    }

    public function return($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'status_pengembalian' => 'dikembalikan',
            'tanggal_pengembalian' => now()
        ]);

        // ✅ BALIKIN STOCK
        Buku::find($pinjam->buku_id)->increment('stock_buku');

        return back()->with('success','Buku dikembalikan');
    }
}