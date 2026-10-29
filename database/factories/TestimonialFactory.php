<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->name();
        $parts = preg_split('/\s+/', trim($name));
        $initials = mb_strtoupper(
            mb_substr($parts[0] ?? '', 0, 1).mb_substr($parts[1] ?? '', 0, 1)
        );
        if ($initials === '') {
            $initials = mb_strtoupper(mb_substr($name, 0, 2));
        }

        return [
            'name' => $name,
            'role' => fake()->jobTitle(),
            'text' => fake()->sentence(),
            'initials' => $initials,
            'variant' => 'normal',
        ];
    }
}
