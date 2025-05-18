<?php

namespace Database\Factories;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    protected $model = Salary::class;

    public function definition()
    {
        return [
            'employee_id'             => $this->faker->numberBetween(1, 50), // sesuaikan dengan data employee kamu
            'periodeGaji'             => $this->faker->date('Y-m-d'), // contoh tanggal periode gaji
            'gajiPokok'               => $this->faker->randomFloat(2, 3000000, 15000000), // gaji pokok antara 3 juta - 15 juta
            'tunjanganTransportasi'   => $this->faker->randomFloat(2, 500000, 2000000),
            'tunjanganMakan'          => $this->faker->randomFloat(2, 300000, 1500000),
            'tunjanganKesehatan'      => $this->faker->randomFloat(2, 200000, 1000000),
            'bonus'                   => $this->faker->randomFloat(2, 0, 5000000),
            'insentif'                => $this->faker->randomFloat(2, 0, 3000000),
            'lembur'                  => $this->faker->randomFloat(2, 0, 2000000),
            'totalPotongan'           => $this->faker->randomFloat(2, 0, 1000000),
            'totalGaji'               => $this->faker->randomFloat(2, 3000000, 25000000),
            'created_at'              => now(),
            'updated_at'              => now(),
        ];
    }
}
