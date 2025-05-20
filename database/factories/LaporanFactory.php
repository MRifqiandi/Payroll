<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    protected $model = \App\Models\Laporan::class;

    public function definition()
    {
        return [
            'jenisLaporan' => 'Gaji',
            'tanggalLaporan' => now(),
            'detailLaporan' => [],
            'originalBuktiPotong' => 'dummy.pdf',
            'originalFileLaporan' => 'laporan.pdf',
        ];
    }
}
