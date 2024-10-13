<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryMethod>
 */
class DeliveryMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word, // Generates a unique name
            'description' => $this->faker->sentence, // Generates a random description
            'amount' => $this->faker->randomFloat(2, 0, 10000), // Generates a random amount
            'sort_order' => $this->faker->numberBetween(0, 10),
            'status' => 1, // Status is active
            'default_method' => 0, // Not default by default
        ];
    }
}
