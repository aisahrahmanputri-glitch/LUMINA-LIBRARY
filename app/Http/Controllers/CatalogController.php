<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

class CatalogController extends Controller
{
    // ✅ LANDING PAGE
    public function landing()
    {
        $bestSellers = Buku::with('kategori')
            ->withCount('ulasans')
            ->where('status', 'approved')
            ->orderByDesc('ulasans_count')
            ->take(6)
            ->get();

        return view('welcome', compact('bestSellers'));
    }

    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%")
                  ->orWhere('isbn', 'like', "%$search%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $books = $query->latest()->get();
        $kategoris = Kategori::all();

        $borrowedBooks = [];
        if (auth()->check() && auth()->user()->role == 'siswa') {
            $borrowedBooks = Peminjaman::where('siswa_id', auth()->id())
                ->whereIn('status_pengembalian', ['dipinjam', 'menunggu'])
                ->pluck('buku_id')
                ->toArray();
        }

        if (auth()->user()->role == 'admin') {
            return view('admin.catalog.index', compact('books', 'kategoris'));
        } elseif (auth()->user()->role == 'petugas') {
            return view('petugas.catalog.index', compact('books', 'kategoris'));
        } else {
            return view('user.catalog', compact('books', 'kategoris', 'borrowedBooks'));
        }
    }

    public function show(Buku $book)
    {
        $book->load('ulasans.user');

        if (auth()->user()->role == 'admin') {
            return view('admin.catalog.show', compact('book'));
        } elseif (auth()->user()->role == 'petugas') {
            return view('petugas.catalog.show', compact('book'));
        } else {
            return view('user.detail', compact('book'));
        }
    }
}