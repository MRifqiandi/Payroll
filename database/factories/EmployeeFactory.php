<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('##########'),
            'alamat' => $this->faker->address(),
            'tanggalLahir' => $this->faker->date('Y-m-d', '-25 years'),
            'statusPernikahan' => $this->faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai']),
            'jabatan' => $this->faker->randomElement(['Dosen', 'Rektor', 'Wakil Rektor', 'Staff']),
            'departemen' => $this->faker->randomElement(['Keuangan', 'HRD', 'Marketing', 'IT', 'Operasional', 'Pemasaran']),
            'statusKepegawaian' => $this->faker->randomElement(['aktif', 'tidak aktif', 'tugas belajar']),
            'masaKerja' => $this->faker->numberBetween(0, 30),
            'npwp' => $this->faker->optional()->numerify('##.###.###.#-###.###'),
            'email' => $this->faker->unique()->safeEmail(),
            'telepon' => $this->faker->phoneNumber(),
            'tanggalMasuk' => $this->faker->date('Y-m-d', '-10 years'),
            'tanggalKeluar' => null, // default null jika masih aktif
        ];
    }
}
