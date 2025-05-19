<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sharing;

class SharingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sharing::create([
            'pelanggan_id' => 1,
            'waktu_beli' => now(),
            'waktu_habis' => now()->addDays(30),
        ]);
    }
}
