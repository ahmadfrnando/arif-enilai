<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'password' => '$2y$10$/ul9c8SpcxMCI7ieBxKqTOuXqU1y6pYwSBP123rmkRyRUsfE.Aj1W', // 123
        ];
    }
}
