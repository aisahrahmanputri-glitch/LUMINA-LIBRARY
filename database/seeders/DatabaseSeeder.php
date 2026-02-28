<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PetugasSeeder;
use Database\Seeders\BukuSeeder;
use Database\Seeders\PeminjamanSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PetugasSeeder::class,
            BukuSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
