<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $borrowings = Peminjaman::where('user_id', $user->id)
            ->with('buku')
            ->get();

        foreach ($borrowings as $b) {
            if ($b->status_pengembalian == 'belum' &&
                Carbon::parse($b->tanggal_pinjam)->addDays(7)->isPast()) {
                $b->status_pengembalian = 'terlambat';
                $b->save();
            }
        }

        $lateCount = $borrowings->where('status_pengembalian','terlambat')->count();

        return view('siswa.dashboard', compact('borrowings','lateCount'));
    }
}
