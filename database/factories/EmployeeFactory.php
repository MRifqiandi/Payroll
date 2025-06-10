<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Ptkp;
use App\Models\JabatanFungsional;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('###########'),
            'alamat' => $this->faker->address(),
            'tanggalLahir' => $this->faker->date(),
            'statusPernikahan' => $this->faker->randomElement(['Menikah', 'Belum Menikah']),
            'jabatan' => $this->faker->jobTitle(),
            'ptkp_id' => Ptkp::factory(), // atau factory(Ptkp::class) jika relasi tersedia
            'departemen' => $this->faker->randomElement(['IT', 'HRD', 'Finance', 'Umum']),
            'statusKepegawaian' => $this->faker->randomElement(['aktif', 'tidak aktif', 'tugas belajar']),
            'jenisKepegawaian' => $this->faker->randomElement(['PNS', 'PPPK']),
            'golongan' => $this->faker->randomElement(['I', 'II', 'III', 'IV']),
            'tanggal_naik_golongan_terakhir' => $this->faker->optional()->date(),
            'npwp' => $this->faker->optional()->numerify('##.###.###.#-###.###'),
            'email' => $this->faker->unique()->safeEmail(),
            'telepon' => $this->faker->optional()->phoneNumber(),
            'tanggalMasuk' => $this->faker->date(),
            'tanggalKeluar' => $this->faker->optional()->date(),
            'jabatan_fungsional_id' => JabatanFungsional::factory(), // atau factory(JabatanFungsional::class)
            'tanggal_kgb_terakhir' => $this->faker->optional()->date(),
            'prediksi_kgb_berikutnya' => $this->faker->optional()->date(),
        ];
    }
}
