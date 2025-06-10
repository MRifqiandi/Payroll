<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TunjanganUmumFactory extends Factory
{
    protected $model = \App\Models\TunjanganUmum::class;

    public function definition()
    {
        return [
            // Golongan contoh: I/a, II/b, III/c, dst
            'golongan' => $this->faker->randomElement([
                'I', 'II', 'III', 'IV'
            ]),
            // Tunjangan nominal dengan 2 desimal
            'tunjangan' => $this->faker->randomFloat(2, 100000, 5000000), // minimal 100k, maksimal 5 juta
        ];
    }
}
