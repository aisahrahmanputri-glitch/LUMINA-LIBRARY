<?php

namespace App\Http\Controllers\Admin;

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
        $books = Buku::with(['kategori'])->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function validasi()
    {
        $data = Peminjaman::with(['buku', 'siswa'])
            ->where('status_pengembalian', 'menunggu')
            ->latest()
            ->get();

        return view('admin.books.validasi', compact('data'));
    }

    public function approve($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_pengembalian != 'menunggu') {
            return back()->with('error', 'Sudah diproses');
        }

        $pinjam->update(['status_pengembalian' => 'dipinjam']);
        Buku::findOrFail($pinjam->buku_id)->decrement('stock_buku');

        return back()->with('success', 'Peminjaman disetujui');
    }

    public function reject($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_pengembalian != 'menunggu') {
            return back()->with('error', 'Sudah diproses');
        }

        $pinjam->update(['status_pengembalian' => 'ditolak']);

        return back()->with('success', 'Peminjaman ditolak');
    }

    public function store(BukuRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $data['status'] = 'approved';
        $data['user_id'] = auth()->id();

        Buku::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
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

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $book = Buku::findOrFail($id);

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}