<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::create([
            'nama' => 'Budi Santoso',
            'no_wa' => '081234567890',
            'langganan' => 'sharing',
            'image' => '',
            'status' => 'Disetujui',
            'created_at' => now(),
        ]);

        Pelanggan::create([
            'nama' => 'Siti Aminah',
            'no_wa' => '081298765432',
            'langganan' => 'Privasi',
            'image' => '',
            'status' => 'Menunggu',
            'created_at' => now(),
        ]);
    }
}
