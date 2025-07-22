<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role Super Admin
        Role::firstOrCreate(['name' => 'super_admin']);

        // Buat role User Biasa
        Role::firstOrCreate(['name' => 'user']);
    }
}
