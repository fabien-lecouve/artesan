<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EstimateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 2),
            'customer_id' => fake()->numberBetween(1, 10),
            'mode_of_work_id' => fake()->numberBetween(1, 2),
            'status_id' => fake()->numberBetween(1, 4),
            'titled' => fake()->sentence(),
            'big_construction' => fake()->numberBetween(0, 1),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'advance' => fake()->numberBetween(1, 1000),
            'total' => fake()->numberBetween(1, 1000),
        ];
    }
}
