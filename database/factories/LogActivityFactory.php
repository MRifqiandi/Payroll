<?php

namespace Database\Factories;

use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogActivityFactory extends Factory
{
    protected $model = LogActivity::class;

    public function definition(): array
    {
        return [
            'users_id'   => User::factory(), // otomatis buat user baru dan ambil UUID-nya
            'action'     => $this->faker->randomElement([
                'login', 'logout', 'create', 'update', 'delete'
            ]),
            'level'      => $this->faker->randomElement(['info', 'warning', 'error', 'critical']),
            'description'=> $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
