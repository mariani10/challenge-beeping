<?php

namespace Database\Factories;

use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrdersLine>
 */
class OrderLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
	$products = Product::all();
        return [
            'qty' => fake()->numberBetween(1, 10),
            'product_id' => $products->random()->id, 
        ];
    }
}
