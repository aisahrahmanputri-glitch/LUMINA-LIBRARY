<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Buku::count();
        $users = User::count();

        // 🔥 GANTI INI (STATUS VALIDASI SISWA)
        $validasi = Peminjaman::where('status_pengembalian', 'menunggu')
            ->count();

        $today = Peminjaman::whereDate('tanggal_peminjaman', today())
            ->count();

        $recentBorrowings = Peminjaman::with(['siswa', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        $popularBooks = Buku::withCount('ulasans')
            ->orderByDesc('ulasans_count')
            ->take(4)
            ->get();

        return view('petugas.dashboard', compact(
            'books',
            'users',
            'validasi', // 🔥 ganti loans → validasi
            'today',
            'recentBorrowings',
            'popularBooks'
        ));
    }
}