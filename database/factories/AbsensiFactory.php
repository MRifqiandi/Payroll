<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbsensiFactory extends Factory
{
    protected $model = \App\Models\Absensi::class;

    public function definition()
    {
        return [
            'employee_id' => null, // isi manual saat membuat data di test
            'tanggalKehadiran' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'statusKehadiran' => $this->faker->randomElement(['Hadir', 'Izin', 'Sakit', 'Alpha']),
            'waktuMasuk' => $this->faker->optional()->time('H:i:s'),
            'waktuKeluar' => $this->faker->optional()->time('H:i:s'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
