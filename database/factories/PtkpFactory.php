<?php

namespace Database\Factories;

use App\Models\Ptkp;
use Illuminate\Database\Eloquent\Factories\Factory;

class PtkpFactory extends Factory
{
    protected $model = Ptkp::class;

    public function definition()
    {
        return [
            'kode_ptkp' => strtoupper($this->faker->bothify('PTKP###')), // contoh: PTKP123
            'nilai_ptkp' => $this->faker->numberBetween(1000000, 100000000), // angka acak besar
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
