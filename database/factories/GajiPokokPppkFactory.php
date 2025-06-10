<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GajiPokokPppkFactory extends Factory
{
    protected $model = \App\Models\GajiPokokPppk::class;

    public function definition()
    {
        return [
            'golongan' => 'IV',
            'mkg' => 3,
            'nominal' => 6500000,
        ];
    }
}
