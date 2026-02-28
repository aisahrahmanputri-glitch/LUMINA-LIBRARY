<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // AUTO OVERDUE
        Peminjaman::where('status_pengembalian', 'dipinjam')
            ->whereDate('tanggal_peminjaman', '<', Carbon::now()->subDays(7))
            ->update([
                'status_pengembalian' => 'terlambat'
            ]);

        $borrowed = Peminjaman::where('siswa_id', $userId)->count();

        $returned = Peminjaman::where('siswa_id', $userId)
            ->where('status_pengembalian', 'dikembalikan')
            ->count();

        $overdue = Peminjaman::where('siswa_id', $userId)
            ->where('status_pengembalian', 'terlambat')
            ->count();

        $bestSeller = Peminjaman::select('buku_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('buku_id')
            ->orderByDesc('total')
            ->with('buku')
            ->take(3)
            ->get();

        // ✅ FIX VIEW
        return view('user.dashboard', compact(
            'borrowed',
            'returned',
            'overdue',
            'bestSeller'
        ));
    }
}