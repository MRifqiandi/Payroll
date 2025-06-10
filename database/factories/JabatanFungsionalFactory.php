<?php

namespace Database\Factories;

use App\Models\JabatanFungsional;
use Illuminate\Database\Eloquent\Factories\Factory;

class JabatanFungsionalFactory extends Factory
{
    protected $model = JabatanFungsional::class;

    public function definition()
    {
        return [
            'nama_jabatan_fungsional' => $this->faker->jobTitle(),
            'keterangan' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
