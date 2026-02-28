<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Hash;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        // buat siswa
        $siswa = User::firstOrCreate(
            ['email' => 'siswa@yuhuu.com'],
            [
                'nama' => 'siswa',
                'password' => Hash::make('password'),
                'role' => 'siswa'
            ]
        );

        $buku = Buku::first();

        if (!$buku) return;

        Peminjaman::create([
            'siswa_id' => $siswa->id,
            'buku_id' => $buku->id,
            'jumlah' => 1,
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => null,
            'status_pengembalian' => 'dipinjam'
        ]);
    }
}
