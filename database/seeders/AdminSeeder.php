<?php

namespace Database\Seeders;

Use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'admin',
            'email' => 'admin@yuhuu.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
