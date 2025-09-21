<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role' => fake()->randomElement(['user', 'assistant', 'tool']),
            'content' => fake()->sentences(3, true),
        ];
    }
}
