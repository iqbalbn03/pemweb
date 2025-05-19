<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat permission untuk role user (pelanggan)
        $pelangganPermissions = Permission::whereIn('name', [
            'view_pelanggan',
            'view_any_pelanggan', 'create_pelanggan',
        ])->get();

        // Ambil role 'user' (pelanggan)
        $userRole = Role::where('name', 'user')->first();

        if ($userRole) {
            $userRole->syncPermissions($pelangganPermissions);
        }
    }
}
