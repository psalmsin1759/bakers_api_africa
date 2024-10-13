<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelatedProduct>
 */
class RelatedProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'product_id' => $this->faker->numberBetween(1, 200), 
            'related_product_id' => $this->faker->numberBetween(1, 50),  
        ];
    }
}
