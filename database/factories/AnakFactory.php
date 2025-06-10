<?php

namespace Database\Factories;

use App\Models\Anak;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnakFactory extends Factory
{
    protected $model = Anak::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(), // atau bisa langsung isi ID jika manual
            'nama' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'tanggal_lahir' => $this->faker->date('Y-m-d', now()->subYears(5)),
            'sudah_kawin' => $this->faker->boolean(10), // 10% kemungkinan sudah kawin
            'punya_penghasilan' => $this->faker->boolean(20), // 20% kemungkinan punya penghasilan
            'menjadi_tanggungan' => $this->faker->boolean(80), // 80% kemungkinan jadi tanggungan
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
