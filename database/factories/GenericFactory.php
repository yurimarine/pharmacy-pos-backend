<?php

namespace Database\Factories;

use App\Models\Generic;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenericFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => fake()->unique()->words(3, asText: true),
            'description' => fake()->paragraph(),
        ];
    }
}