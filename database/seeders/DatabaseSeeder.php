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
        // Admin Account
        User::create([
            'name' => 'Putra Admin',
            'email' => 'putraadmin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Tamu/Customer Account
        User::create([
            'name' => 'Dody Tamu',
            'email' => 'dodytamu@gmail.com',
            'password' => Hash::make('tamu1234'),
            'role' => 'customer',
        ]);
    }
}
