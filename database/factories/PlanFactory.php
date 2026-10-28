<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price' => fake()->randomFloat(2, 0, 20),
            'description' => fake()->sentence(),
            'features' => ['Temporizador de ciclos'],
            'excluded_features' => null,
            'period' => 'mes',
            'featured' => false,
        ];
    }
}
