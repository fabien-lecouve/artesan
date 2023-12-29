<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LocationOfWork>
 */
class LocationOfWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estimate_id' => fake()->numberBetween(1, 50),
            'room_id' => fake()->numberBetween(1, 10),
            'warranty' => fake()->numberBetween(1, 5),
            'supplies' => fake()->numberBetween(100, 500),
            'subtotal' => fake()->numberBetween(1, 50),
        ];
    }
}
