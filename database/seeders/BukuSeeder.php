<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::create([
            'judul' => 'Belajar Laravel',
            'penulis' => 'Yenny',
            'tahun_terbit' => '2024-01-01',
            'isbn' => '9781234567890',
            'cover' => 'default.jpg',
            'stock_buku' => 10,
            'sinopsis' => 'Buku belajar Laravel untuk pemula.',
            'penerbit' => 'Informatika',
            'kategori_id' => null
        ]);
    }
}
