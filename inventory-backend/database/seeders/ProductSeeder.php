<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => 4450,
            'type' => 'Smartphone',
            'brand' => 'Apple',
            'model' => 'Iphone SE',
            'capacity' => '2GB/16GB',
            'quantity' => 13,
        ]);

        Product::create([
            'id' => 4768,
            'type' => 'Smartphone',
            'brand' => 'Apple',
            'model' => 'Iphone SE',
            'capacity' => '2GB/32GB',
            'quantity' => 30,
        ]);

        Product::create([
            'id' => 4451,
            'type' => 'Smartphone',
            'brand' => 'Apple',
            'model' => 'Iphone SE',
            'capacity' => '2GB/64GB',
            'quantity' => 20,
        ]);

        Product::create([
            'id' => 4474,
            'type' => 'Smartphone',
            'brand' => 'Apple',
            'model' => 'Iphone SE',
            'capacity' => '2GB/128GB',
            'quantity' => 16,
        ]);

        Product::create([
            'id' => 6039,
            'type' => 'Smartphone',
            'brand' => 'Apple',
            'model' => 'Iphone SE(2020)',
            'capacity' => '3GB/64GB',
            'quantity' => 18,
        ]);
    }
}
