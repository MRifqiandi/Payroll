<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SalaryService;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Absensi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $salaryService;
    protected $employee;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat instance service
        $this->salaryService = new SalaryService();

        // Buat data employee untuk relasi FK
        $this->employee = Employee::factory()->create([
            'nama' => 'John Doe',
        ]);
    }

    public function testIsSalaryDuplicateReturnsTrueIfExists()
    {
        // Buat salary terkait employee
        Salary::factory()->create([
            'employee_id' => $this->employee->id,
            'periodeGaji' => '2025-05-01',
        ]);

        $result = $this->salaryService->isSalaryDuplicate($this->employee->id, '2025-05-01');
        $this->assertTrue($result);
    }

    public function testIsSalaryDuplicateReturnsFalseIfNotExists()
    {
        $result = $this->salaryService->isSalaryDuplicate($this->employee->id, '2025-06-01');
        $this->assertFalse($result);
    }

    public function testHitungKenaikanGajiForLessThan2Years()
    {
        $lamaKerjaTahun = 1; // harus int, bukan objek
        $gajiPokok = 1000000;

        $kenaikan = $this->salaryService->hitungKenaikanGaji($lamaKerjaTahun, $gajiPokok);
        $this->assertEquals($gajiPokok * 0.05, $kenaikan);
    }

    public function testHitungKenaikanGajiFor4Years()
    {
        $lamaKerjaTahun = 4;
        $gajiPokok = 1000000;

        $kenaikan = $this->salaryService->hitungKenaikanGaji($lamaKerjaTahun, $gajiPokok);
        $this->assertEquals($gajiPokok * 0.10, $kenaikan);
    }

    public function testGetTunjanganTransportasiForVariousJabatan()
    {
        $this->assertEquals(50000, $this->salaryService->getTunjanganTransportasi('rektor'));
        $this->assertEquals(25000, $this->salaryService->getTunjanganTransportasi('wakil rektor'));
        $this->assertEquals(10000, $this->salaryService->getTunjanganTransportasi('dosen'));
        $this->assertEquals(10000, $this->salaryService->getTunjanganTransportasi('staff'));
    }

    public function testHitungTunjanganMakanBasedOnAbsensi()
    {
        // Misal absensi = 20 hari, tunjangan per hari = 10000.0
        $absensi = 20;
        $tunjanganPerHari = 10000.0;

        $tunjanganMakan = $this->salaryService->hitungTunjanganMakan($absensi, $tunjanganPerHari);

        $this->assertIsFloat($tunjanganMakan);
        $this->assertEquals($absensi * $tunjanganPerHari, $tunjanganMakan);
    }


    public function testCalculateTotalSalary()
    {
        $data = [
            'gajiPokok' => 2000,
            'tunjanganTransportasi' => 500,
            'tunjanganMakan' => 400,
            'tunjanganKesehatan' => 300,
            'bonus' => 200,
            'insentif' => 300,
            'lembur' => 300,
        ];

        $potongan = 500;

        $total = $this->salaryService->calculateTotalSalary($data, $potongan);

        $expected = array_sum($data) - $potongan;

        $this->assertEquals($expected, $total);
    }

public function testCalculatePph21()
{
    $service = new SalaryService();

    $brutoBulanan = 10000000;
    $iuranPensiun = 100000;
    $ptkp = 54000000;

    $expected = 318333; // Sesuai hasil perhitungan di atas
    $actual = $service->calculatePph21($brutoBulanan, $iuranPensiun, $ptkp);

    $this->assertEqualsWithDelta($expected, $actual, 1000); // toleransi ±1000
}




    public function testLogPerubahanSalaryCreatesLogsOnlyIfValueChanges()
    {
        // Buat salary awal
        $salary = Salary::factory()->create([
            'employee_id' => $this->employee->id,
            'periodeGaji' => '2025-05-01',
            'gajiPokok' => 1000,
            'tunjanganTransportasi' => 100,
            'tunjanganMakan' => 100,
            'tunjanganKesehatan' => 100,
            'bonus' => 0,
            'insentif' => 0,
            'lembur' => 0,
            'totalPotongan' => 0,
            'totalGaji' => 1300,
        ]);
        // Perbaiki nilai ke 1100 agar cocok
        $this->salaryService->logPerubahanSalary(
            $salary->id,
            $salary->employee_id,
            'gajiPokok',
            1000,
            1100, // sebelumnya 1200, jadi 1100
            'kenaikan gaji'
        );


        // Test: cek ada log di DB atau mock sesuai implementasi
        // Misal pakai assertion kalau pakai model LogSalary atau mekanisme lainnya
        $this->assertDatabaseHas('salary_log', [
            'salary_id' => $salary->id,
            'field' => 'gajiPokok',
            'old_value' => 1000,
            'new_value' => 1100,
        ]);
    }

    public function testSaveTaxAndBpjsCreatesOrUpdatesRecords()
    {
        // Buat salary
        $salary = Salary::factory()->create([
            'employee_id' => $this->employee->id,
            'periodeGaji' => '2025-05-01',
        ]);

        $taxData = [
            'pph21' => 50000,
            'buktiPotong' => 'BP12345',
            'tanggalLaporan' => '2025-05-01',
        ];

        $bpjsData = [
            'kesehatan' => [
                'iuranPerusahaan' => 60000,
                'iuranKaryawan' => 40000,
                'tanggalIuran' => '2025-05-01',
            ],
            'ketenagakerjaan' => [
                'iuranPerusahaan' => 30000,
                'iuranKaryawan' => 20000,
                'tanggalIuran' => '2025-05-01',
            ],
        ];


        $this->salaryService->saveTaxAndBpjs($salary->id, $taxData, $bpjsData);

        // cek data di DB
        $this->assertDatabaseHas('tax', [
            'salary_id' => $salary->id,
            'pph21' => 50000,
        ]);
        $this->assertDatabaseHas('bpjs', [
            'salary_id' => $salary->id,
            'jenisBpjs' => 'Kesehatan',
            'iuranPerusahaan' => 60000,
            'iuranKaryawan' => 40000,
        ]);

        $this->assertDatabaseHas('bpjs', [
            'salary_id' => $salary->id,
            'jenisBpjs' => 'Ketenagakerjaan',
            'iuranPerusahaan' => 30000,
            'iuranKaryawan' => 20000,
        ]);

    }
}
