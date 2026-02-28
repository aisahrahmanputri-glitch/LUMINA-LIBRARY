<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // =========================
    // 📊 SEMUA DATA (RECORD)
    // =========================
    public function index(Request $request)
    {
        $query = Peminjaman::with(['buku','siswa']);

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('buku', function($b) use ($request){
                    $b->where('judul', 'like', '%'.$request->search.'%');
                })
                ->orWhereHas('siswa', function($s) use ($request){
                    $s->where('nama', 'like', '%'.$request->search.'%');
                });
            });
        }

        // 🏷 FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status_pengembalian', $request->status);
        }

        $data = $query->latest()->get();

        // 📊 STAT
        $borrowed = $data->count();
        $returned = $data->where('status_pengembalian', 'dikembalikan')->count();
        $overdue  = $data->where('status_pengembalian', 'terlambat')->count();

        return view('petugas.borrowings.index', compact(
            'data',
            'borrowed',
            'returned',
            'overdue'
        ));
    }

    // =========================
    // 🔥 VALIDASI
    // =========================
    public function validasi()
    {
        $data = Peminjaman::with(['buku','siswa'])
            ->where('status_pengembalian', 'menunggu')
            ->latest()
            ->get();

        return view('petugas.borrowings.validasi', compact('data'));
    }

    // =========================
    // ✅ APPROVE
    // =========================
    public function approve($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_pengembalian != 'menunggu') {
            return back()->with('error', 'Sudah diproses');
        }

        $pinjam->update([
            'status_pengembalian' => 'dipinjam'
        ]);

        // 🔥 KURANGI STOCK
        $book = Buku::findOrFail($pinjam->buku_id);
        $book->decrement('stock_buku');

        return back()->with('success', 'Peminjaman disetujui');
    }

    // =========================
    // ❌ REJECT
    // =========================
    public function reject($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_pengembalian != 'menunggu') {
            return back()->with('error', 'Sudah diproses');
        }

        $pinjam->update([
            'status_pengembalian' => 'ditolak'
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    // =========================
    // 🔄 RETURN (FIX ERROR KAMU)
    // =========================
    public function return($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        // biar ga double return
        if ($pinjam->status_pengembalian != 'dipinjam') {
            return back()->with('error', 'Data tidak valid');
        }

        $pinjam->update([
            'status_pengembalian' => 'dikembalikan',
            'tanggal_pengembalian' => now()
        ]);

        // 🔥 BALIKIN STOCK
        $book = Buku::findOrFail($pinjam->buku_id);
        $book->increment('stock_buku');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }

    // =========================
    // 📄 EXPORT PDF
    // =========================
    public function exportPdf()
    {
        $data = Peminjaman::with(['buku','siswa'])->latest()->get();

        $borrowed = $data->count();
        $returned = $data->where('status_pengembalian','dikembalikan')->count();
        $overdue  = $data->where('status_pengembalian','terlambat')->count();

        $tanggal = Carbon::now()->format('d M Y');

        $pdf = Pdf::loadView('petugas.pdf_laporan', compact(
            'data',
            'borrowed',
            'returned',
            'overdue',
            'tanggal'
        ))->setPaper('A4','portrait');

        return $pdf->download('laporan_petugas.pdf');
    }
}