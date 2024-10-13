<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option' => 'Size', // You can change this if you have other options
            'value' => $this->faker->randomElement(['S', 'M', 'L', 'XL', '2XL']),
            'quantity' => $this->faker->numberBetween(0, 100), // Random quantity for each size
            'product_id' => function () {
                return \App\Models\Product::factory()->create()->id; // This line creates a product to associate with the variant
            },
        ];
    }


}