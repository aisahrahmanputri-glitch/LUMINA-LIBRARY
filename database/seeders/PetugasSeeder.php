<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            {
        User::create([
            'nama' => 'petugas',
            'email' => 'petugas@yuhuu.com',
            'password' => Hash::make('password'),
            'role' => 'petugas'
        ]);
    }
    }
}
