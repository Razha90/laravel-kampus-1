<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class userMahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
