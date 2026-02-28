<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->kategori) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $books = $query->get();
        $kategoris = Kategori::all();

        $borrowedBooks = Peminjaman::where('siswa_id', Auth::id())
            ->where('status_pengembalian', 'dipinjam')
            ->pluck('buku_id')
            ->toArray();

        return view('user.catalog', compact('books', 'borrowedBooks', 'kategoris'));
    }

    public function store($buku_id)
    {
        $book = Buku::findOrFail($buku_id);

        if ($book->stock_buku <= 0) {
            return back()->with('error', 'Stok habis');
        }

        $cek = Peminjaman::where('siswa_id', Auth::id())
            ->where('buku_id', $buku_id)
            ->whereIn('status_pengembalian', ['dipinjam', 'menunggu'])
            ->exists();

        if ($cek) {
            return back()->with('error', 'Masih dalam proses / sudah dipinjam');
        }

        // ⏳ MENUNGGU VALIDASI
        Peminjaman::create([
            'siswa_id' => Auth::id(),
            'buku_id' => $buku_id,
            'jumlah' => 1,
            'tanggal_peminjaman' => now(),
            'status_pengembalian' => 'menunggu'
        ]);

        return back()->with('success', 'Menunggu validasi admin');
    }

    public function detail($id)
    {
        $book = Buku::with('kategori', 'ulasans.user')->findOrFail($id);
        return view('user.detail', compact('book'));
    }

    public function return($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'status_pengembalian' => 'dikembalikan',
            'tanggal_pengembalian' => now()
        ]);

        Buku::find($pinjam->buku_id)->increment('stock_buku');

        return back()->with('success', 'Buku dikembalikan');
    }

    public function review(Request $request, $buku_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:255'
        ]);

        Ulasan::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'buku_id' => $buku_id
            ],
            [
                'rating' => $request->rating,
                'ulasan' => $request->ulasan
            ]
        );

        return back()->with('success', 'Review berhasil');
    }

    public function history(Request $request)
    {
        $query = Peminjaman::where('siswa_id', Auth::id())
            ->with('buku');

        if ($request->search) {
            $query->whereHas('buku', function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status_pengembalian', $request->status);
        }

        $data = $query->latest()->get();

        return view('user.history', compact('data'));
    }
}