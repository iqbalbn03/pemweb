<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Ganti password
            ]
        );

        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
        }

        // Buat user biasa
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('password'), // Ganti password
            ]
        );

        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

        // Panggil seeder produk & transaksi
        $this->call([
            RoleSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
