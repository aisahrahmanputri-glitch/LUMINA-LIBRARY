<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // =========================
    // 📊 LIST DATA
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

        // 📊 STATISTIK
        $borrowed = $data->count();
        $returned = $data->where('status_pengembalian', 'dikembalikan')->count();
        $overdue  = $data->where('status_pengembalian', 'terlambat')->count();

        return view('admin.borrowings.index', compact(
            'data',
            'borrowed',
            'returned',
            'overdue'
        ));
    }

    // =========================
    // 🗑 DELETE
    // =========================
    public function destroy($id)
    {
        $data = Peminjaman::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    // =========================
    // ✅ APPROVE
    // =========================
    public function approve($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        // ❗ CEGAH DOUBLE APPROVE
        if ($pinjam->status_pengembalian !== 'menunggu') {
            return back()->with('error', 'Sudah diproses sebelumnya');
        }

        // UPDATE STATUS
        $pinjam->update([
            'status_pengembalian' => 'dipinjam'
        ]);

        // 🔥 KURANGI STOCK
        $book = Buku::findOrFail($pinjam->buku_id);

        if ($book->stock_buku > 0) {
            $book->decrement('stock_buku');
        }

        return back()->with('success', 'Peminjaman disetujui');
    }

    // =========================
    // ❌ REJECT
    // =========================
    public function reject($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        // ❗ CEGAH DOUBLE PROSES
        if ($pinjam->status_pengembalian !== 'menunggu') {
            return back()->with('error', 'Sudah diproses sebelumnya');
        }

        $pinjam->update([
            'status_pengembalian' => 'ditolak'
        ]);

        return back()->with('success', 'Peminjaman ditolak');
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

        $pdf = Pdf::loadView('admin.pdf_laporan', compact(
            'data',
            'borrowed',
            'returned',
            'overdue',
            'tanggal'
        ))->setPaper('A4','portrait');

        return $pdf->download('laporan_admin.pdf');
    }
}