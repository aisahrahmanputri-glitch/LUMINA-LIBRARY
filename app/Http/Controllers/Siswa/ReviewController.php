<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ulasan; // tetap pakai model Ulasan
use App\Models\Buku;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Ulasan::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.reviews', compact('reviews'));
    }

    public function store(Request $request, $buku_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required'
        ]);

        Ulasan::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return back()->with('success', 'Review berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Ulasan::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with('success', 'Review berhasil dihapus');
    }
}