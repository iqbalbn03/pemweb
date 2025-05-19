<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Privasi;

class PrivasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Privasi::create([
            'pelanggan_id' => 2,
            'waktu_beli' => now(),
            'waktu_habis' => now()->addDays(30),
        ]);
    }
}
