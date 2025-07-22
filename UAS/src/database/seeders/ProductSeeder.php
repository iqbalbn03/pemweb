<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::firstOrCreate([
            'name' => 'John Doe',
            'service_used' => 'Netflix',
            'price' => 55000.00,
        ]);

        Product::firstOrCreate([
            'name' => 'Jane Smith',
            'service_used' => 'Spotify',
            'price' => 45000.00,
        ]);
    }
}
