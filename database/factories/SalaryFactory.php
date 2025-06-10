<?php

namespace Database\Factories;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\TunjanganFungsionalDosen;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    protected $model = Salary::class;

    public function definition(): array
    {
        $gajiPokok = $this->faker->numberBetween(3000000, 7000000);
        $tunjanganLainLain = $this->faker->randomFloat(2, 0, 1000000);
        $gajiKotor = $gajiPokok + $tunjanganLainLain;
        $totalPotongan = $this->faker->numberBetween(100000, 1000000);
        $gajiBersih = $gajiKotor - $totalPotongan;

        return [
            'employee_id' => Employee::factory(), // pastikan EmployeeFactory tersedia
            'periode_gaji' => $this->faker->date('Y-m-d'),
            'gaji_pokok' => $gajiPokok,
            'tunjangan_umum' => $this->faker->numberBetween(0, 500000),
            'tunjangan_fungsional' => TunjanganFungsionalDosen::factory(),
            // 'tunjangan_kinerja' => $this->faker->numberBetween(0, 1000000),
            'tunjangan_lain_lain' => $tunjanganLainLain,
            'tunjangan_pembulatan' => $this->faker->randomFloat(2, 0, 10000),
            'tunjangan_beras' => $this->faker->randomFloat(2, 0, 100000),
            'tunjangan_istri_suami' => $this->faker->numberBetween(0, 500000),
            'tunjangan_anak' => $this->faker->numberBetween(0, 500000),
            'uang_makan' => $this->faker->numberBetween(0, 500000),
            'uang_lembur' => $this->faker->numberBetween(0, 500000),
            'gaji_kotor' => $gajiKotor,
            'potongan_pph21' => $this->faker->numberBetween(0, 500000),
            'potongan_bpjs' => $this->faker->numberBetween(0, 500000),
            'potongan_iwp_8' => $this->faker->randomFloat(2, 0, 500000),
            'potongan_iwp_1' => $this->faker->randomFloat(2, 0, 100000),
            'potongan_lain' => $this->faker->numberBetween(0, 500000),
            'total_potongan' => $totalPotongan,
            'gaji_bersih' => $gajiBersih,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
