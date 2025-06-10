<?php

namespace Database\Factories;

use App\Models\Bpjs;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class BpjsFactory extends Factory
{
    protected $model = Bpjs::class;

    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),
            'periode' => $this->faker->date('Y-m'), // contoh: 2025-06
            'iuran_total' => $total = $this->faker->randomFloat(2, 100000, 1000000),
            'iuran_perusahaan' => $perusahaan = $total * 0.6,
            'iuran_peserta' => $total * 0.4,
        ];
    }
}
