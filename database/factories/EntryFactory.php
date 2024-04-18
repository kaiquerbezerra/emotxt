<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry>
 */
class EntryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'text' => $this->faker->name(),
            'user_id' => $this->faker->unique()->randomElement(User::pluck('id')),
        ];
    }
}
