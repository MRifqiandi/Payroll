<?php

namespace Database\Factories;

use App\Models\Tax;
use App\Models\Employee;
use App\Models\Ptkp;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    protected $model = Tax::class;

    public function definition()
    {
        // Pastikan ada employee dan ptkp dulu untuk relasi
        return [
            'employee_id' => Employee::factory(),
            'ptkp_id' => Ptkp::factory(),
            'pph21' => $this->faker->randomFloat(2, 100000, 1000000),
            'penghasilan_neto' => $this->faker->randomFloat(2, 5000000, 20000000),
            'penghasilan_kena_pajak' => $this->faker->randomFloat(2, 3000000, 15000000),
            'tahun' => $this->faker->year(),
            'bulan' => $this->faker->numberBetween(1, 12),
            'tanggalLaporan' => $this->faker->date(),
        ];
    }
}
