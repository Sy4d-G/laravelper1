<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin Awal sesuai Modul Word
        User::firstOrCreate(
            ['email' => 'admin@pos.com'],
            [
                'name' => 'Admin POS',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Membuat Akun Kasir Awal sesuai Modul Word
        User::firstOrCreate(
            ['email' => 'kasir@pos.com'],
            [
                'name' => 'Kasir Rina',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ]
        );
    }
}
