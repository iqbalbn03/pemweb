<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat role 'super_admin' dan 'user' jika belum ada
        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Buat user admin jika belum ada
        if (User::count() == 0) {
            $admin = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'), // password untuk admin
            ]);
            $admin->assignRole('super_admin');

            // Buat user dummy pelanggan
            $pelanggan = User::factory()->create([
                'name' => 'Pelanggan',
                'email' => 'pelanggan@dummy.com',
                'password' => bcrypt('password'), // password untuk pelanggan
            ]);
            $pelanggan->assignRole('user');
        }

        // Panggil seeder lain
        $this->call([
            PelangganSeeder::class,
            SharingSeeder::class,
            PrivasiSeeder::class,
            RolePermissionSeeder::class,
        ]);
    }
}
