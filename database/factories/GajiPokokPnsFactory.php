<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GajiPokokPnsFactory extends Factory
{
    protected $model = \App\Models\GajiPokokPns::class;

    public function definition()
    {
        return [
            'golongan' => 'PNS-IV/A',
            'mkg' => 5,
            'nominal' => 7000000,
        ];
    }
}
