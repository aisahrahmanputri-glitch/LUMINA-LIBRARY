<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\BukuRequest;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Buku::latest()->get();
        return view('petugas.books.index', compact('books'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('petugas.books.create', compact('kategoris'));
    }

    public function store(BukuRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $data['status'] = 'pending';

        Buku::create($data);

        return redirect()->route('petugas.books.index')
            ->with('success', 'Buku berhasil diajukan (menunggu validasi admin)');
    }

    public function edit($id)
    {
        $book = Buku::findOrFail($id);
        $kategoris = Kategori::all();

        return view('petugas.books.edit', compact('book','kategoris'));
    }

    public function update(BukuRequest $request, $id)
    {
        $book = Buku::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }

            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $data['status'] = 'pending';

        $book->update($data);

        return redirect()->route('petugas.books.index')
            ->with('success','Buku diupdate & menunggu validasi ulang');
    }

    public function destroy($id)
    {
        $book = Buku::findOrFail($id);

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('petugas.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    // 🔥 INI YANG PALING PENTING (VALIDASI PINJAM, BUKAN BUKU)
    public function validasi()
    {
        $data = Peminjaman::with(['buku','siswa'])
            ->where('status_pengembalian', 'menunggu')
            ->latest()
            ->get();

        return view('petugas.books.validasi', compact('data'));
    }
}