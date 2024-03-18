<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // for sake of testing, hard code the factory instead of using faker.
        return [
            'type' => 'Smartphone',
            'brand' => 'Apple',
            'model' => 'Iphone SE',
            'capacity' => '2GB/16GB',
            'quantity' => 10
        ];
    }
}
