<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\User;
use App\Models\Absensi;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_salary_correctly()
    {
        // 1. Buat role admin jika belum ada
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        // 2. Buat user dan assign role admin
        $user = User::factory()->create();
        $user->assignRole($role);

        // 3. Buat dummy karyawan
        $employee = Employee::factory()->create([
            'jabatan' => 'Rektor',
            'tanggalMasuk' => now()->subYears(4),
            'masaKerja' => 4,
        ]);

        Absensi::factory()->create([
            'employee_id' => $employee->id,
            'statusKehadiran' => 'Hadir',
            'tanggalKehadiran' => '2025-04-15',
            'waktuMasuk' => '08:00:00',
            'waktuKeluar' => '17:00:00',
        ]);

        // 4. Jalankan request sebagai user yang sudah login & punya role admin
        $response = $this->actingAs($user)->post(route('salary.store'), [
            'employee_id' => $employee->id,
            'gajiPokok' => 1000000,
            'tunjanganMakan' => 10000,
            'tunjanganKesehatan' => 5000,
            'bonus' => 5000,
            'insentif' => 5000,
            'lembur' => 5000,
            'pph21' => 10000,
            'iuranKaryawan' => 10000,
            'iuranPerusahaan' => 10000,
            'tunjanganTransportasi' => 0,
        ]);

        // 5. Ambil data salary yang disimpan
        $salary = Salary::first();

        // 6. Hitung ekspektasi kenaikan gaji (4 tahun = 20%)
        $expectedGajiPokok = 1000000 * 1.2;

        // 7. Hitung tunjangan transportasi sesuai jabatan Rektor (50.000)
        $expectedTransportasi = 50000;

        // 8. Hitung total potongan dan tunjangan sesuai data input dan logika
        $totalPotongan = 10000 + 10000 + 10000;
        $totalTunjangan = $expectedTransportasi + 10000 + 5000 + 5000 + 5000 + 5000;

        $expectedTotalGaji = $expectedGajiPokok + $totalTunjangan - $totalPotongan;

        // 9. Assertion
        $response->assertRedirect(route('salary.index'));
        $this->assertNotNull($salary);
        $this->assertEquals(round($expectedGajiPokok), round($salary->gajiPokok));
        $this->assertEquals($expectedTransportasi, $salary->tunjanganTransportasi);
        $this->assertEquals(round($expectedTotalGaji), round($salary->totalGaji));

        // 10. Cek tabel Tax dan BPJS sesuai relasi dan data
        $this->assertDatabaseHas('tax', [
            'employee_id' => $employee->id,
            'pph21' => 10000
        ]);

        $this->assertDatabaseHas('bpjs', [
            'employee_id' => $employee->id,
            'iuranKaryawan' => 10000,
            'iuranPerusahaan' => 10000
        ]);
    }
}
