<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TunjanganFungsionalDosen;
use App\Models\JabatanFungsional;

class TunjanganFungsionalDosenFactory extends Factory
{
    protected $model = TunjanganFungsionalDosen::class;

    public function definition()
    {
        return [
            'jabatan_fungsional_id' => JabatanFungsional::factory(),
            'nominal' => $this->faker->randomFloat(2, 500000, 5000000), // nominal antara 500 ribu sampai 5 juta
        ];
    }
}
