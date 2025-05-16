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
        public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'number' => fake()->unique()->numerify('########'), // 8 digit unik
            'rank' => fake()->randomElement(['Junior', 'Senior', 'Manager', 'Director']),
            'join_date' => fake()->date('Y-m-d'),
            'position' => fake()->jobTitle(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password default
            '2fa_secret' => null, // nullable
            'public_key' => 'public_key_placeholder', // contoh string
            'private_key' => 'private_key_placeholder', // contoh string
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
