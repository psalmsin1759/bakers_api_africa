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
        return [
            'name' => $this->faker->word,
            'sku' => $this->faker->unique()->bothify('SKU-#####'),
            'quantity' => $this->faker->numberBetween(1, 100),
            'in_stock' => $this->faker->numberBetween(0, 1),
            'featured' => $this->faker->numberBetween(0, 1),
            'new_arrival' => $this->faker->numberBetween(0, 1),
            'sort_order' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discounted_price' => $this->faker->randomFloat(2, 5, 900),
            'cost_price' => $this->faker->randomFloat(2, 5, 700),
            'status' => $this->faker->randomElement(['Selling']),
        ];
    }

    /**
     * Indicate that the product should have 3 images.
     */
    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Product $product) { // Use the correct App\Models\Product here
            \App\Models\ProductImage::factory()->count(3)->create([
                'product_id' => $product->id,
            ]);

            $sizes = ['S', 'M', 'L', 'XL', '2XL'];
            foreach ($sizes as $size) {
                \App\Models\ProductVariant::factory()->create([
                    'product_id' => $product->id,
                    'value' => $size, 
                ]);
            }
        });
    }
}
