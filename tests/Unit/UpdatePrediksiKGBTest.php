<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePrediksiKGBTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_automatically_updates_kgb_prediction_for_active_employee()
    {
        // Simulasikan 1 karyawan aktif dengan tanggal masuk 6 tahun yang lalu
        $employee = Employee::factory()->create([
            'statusKepegawaian' => 'aktif',
            'tanggalMasuk' => now()->subYears(6)->toDateString(),
        ]);

        // Jalankan command
        Artisan::call('kgb:update-prediksi');

        // Refresh instance untuk ambil data terbaru dari database
        $employee->refresh();

        // Prediksi: 6 tahun = 3 siklus → prediksi selanjutnya = masuk + 8 tahun
        $expectedPrediksi = now()->subYears(6)->addYears(8)->toDateString();
        $expectedTerakhir = now()->subYears(6)->addYears(6)->toDateString();

        $this->assertEquals($expectedPrediksi, $employee->prediksi_kgb_berikutnya);
        $this->assertEquals($expectedTerakhir, $employee->tanggal_kgb_terakhir);
    }

    /** @test */
    public function it_does_not_automatically_update_kgb_for_non_active_employees()
    {
        $tanggalMasuk = now()->subYears(4)->toDateString();

        $inactiveEmployee = Employee::factory()->create([
            'statusKepegawaian' => 'tidak aktif',
            'tanggalMasuk' => $tanggalMasuk,
            'tanggal_kgb_terakhir' => null,
            'prediksi_kgb_berikutnya' => null,
        ]);

        $this->assertEquals('tidak aktif', $inactiveEmployee->statusKepegawaian);

        Artisan::call('kgb:update-prediksi');
        $inactiveEmployee->refresh();

        $this->assertNull($inactiveEmployee->prediksi_kgb_berikutnya);
        $this->assertNull($inactiveEmployee->tanggal_kgb_terakhir);
    }
}
