<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Employee;
use App\Models\GajiPokokPns;
use App\Models\Salary;
use App\Models\GajiPokokPppk;
use App\Models\TunjanganUmum;
use App\Models\TunjanganFungsionalDosen;
use App\Models\Absensi;
use App\Models\JabatanFungsional;
use App\Models\Ptkp;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Mockery;

class PayrollTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();


        // Membuat User untuk actingAs (pastikan users_id tidak null)
        User::factory()->create(['id' => 1]);

       $this->ptkp = Ptkp::factory()->create([
        'nilai_ptkp' => 54000000,
    ]);

    $this->jabfung1 = JabatanFungsional::factory()->create(['nama_jabatan_fungsional' => 'Lektor']);
    $this->jabfung2 = JabatanFungsional::factory()->create(['nama_jabatan_fungsional' => 'Guru Besar']);
    $this->jabfung3 = JabatanFungsional::factory()->create(['nama_jabatan_fungsional' => 'Asisten Ahli']);

    }

/** @test */
public function test_it_can_calculate_salary_for_pns_employee()
{
    $this->actingAs(User::first());

    $employee = Employee::factory()->create([
        'golongan' => 'IV/a',
        'jenisKepegawaian' => 'PNS',
        'tanggalMasuk' => '2020-01-01',
        'ptkp_id' => $this->ptkp->id,
        'jabatan_fungsional_id' => $this->jabfung1->id,
    ]);


    GajiPokokPns::factory()->create([
        'golongan' => 'PNS-IV/a',
        'mkg' => 3,
        'nominal' => 5000000,
    ]);

    $response = $this->postJson('/payroll/hitung-gaji', [
        'employee_id' => $employee->id,
        'periode_gaji' => '2023-04',
    ]);

    $response->assertStatus(200);

    // Perbaikan di sini:
    $response->assertJson([
        'data' => [
            'gaji_pokok' => 5000000,
        ],
    ]);

    // Atau
    $this->assertEquals(5000000, $response->json('data.gaji_pokok'));
}

    /** @test */
    public function it_can_calculate_salary_with_all_components()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Buat employee PNS
        $employee = Employee::factory()->create([
            'golongan' => 'I/a',
            'jenisKepegawaian' => 'PNS',
            'tanggalMasuk' => '2020-01-01',
            'ptkp_id' => $this->ptkp->id,
            'jabatan_fungsional_id' => $this->jabfung3->id,
            'statusPernikahan' => 'Menikah',
        ]);

        // Gaji pokok PNS
        GajiPokokPns::factory()->create([
            'golongan' => 'PNS-I/a',
            'mkg' => 3,
            'nominal' => 5000000,
        ]);

        // Tunjangan umum golongan utama 'IV'
        TunjanganUmum::factory()->create([
            'golongan' => 'I',
            'tunjangan' => 1000000,
        ]);

        TunjanganFungsionalDosen::factory()->create([
            'jabatan_fungsional_id' => $this->jabfung3->id,
            'nominal' => 1000000,
        ]);

        // Tambah anak yang memenuhi syarat (misal 2 anak belum kawin, umur < 21, tidak penghasilan, tanggungan)
        $employee->anak()->createMany([
            ['nama' => 'alex','sudah_kawin' => false, 'tanggal_lahir' => '2015-01-02', 'punya_penghasilan' => false, 'menjadi_tanggungan' => true],
            ['nama' => 'anton','sudah_kawin' => false, 'tanggal_lahir' => '2016-02-02', 'punya_penghasilan' => false, 'menjadi_tanggungan' => true],
        ]);

       $response = $this->postJson('/payroll/hitung-gaji', [
            'employee_id' => $employee->id,
            'periode_gaji' => '2023-04',
            'tunjangan_lain_lain' => 200000,
        ]);

        $response->assertStatus(200);

        $data = $response->json('data');

        // Cek gaji pokok (harus 5 juta)
        $this->assertEquals(5000000, $data['gaji_pokok']);

        // Cek tunjangan umum (harus sesuai input: 1 juta)
        $this->assertEquals(1000000, $data['tunjangan_umum']);

        // Cek tunjangan fungsional (harus 1 juta dari factory)
        $this->assertEquals(1000000, $data['tunjangan_fungsional']);

        // Cek tunjangan istri/suami (10% dari gaji pokok)
        $expectedTunjanganIstriSuami = ceil(0.10 * 5000000);
        $this->assertEquals($expectedTunjanganIstriSuami, $data['tunjangan_istri_suami']);

        // Cek tunjangan anak (2 anak x 2% x gaji pokok)
        $expectedTunjanganAnak = ceil(2 * 0.02 * 5000000);
        $this->assertEquals($expectedTunjanganAnak, $data['tunjangan_anak']);

        // Cek tunjangan beras
        $hargaBerasPerOrang = 72420;
        $jumlahOrangBeras = 1 + 1 + 2; // diri + istri + 2 anak (maks 2 anak)
        $expectedTunjanganBeras = ceil($hargaBerasPerOrang * $jumlahOrangBeras);
        $this->assertEquals($expectedTunjanganBeras, $data['tunjangan_beras']);

        // Cek tunjangan lain-lain (input manual)
        $this->assertEquals(200000, $data['tunjangan_lain_lain']);



        // Hitung gaji kotor manual
        $expectedGajiKotor = $data['gaji_pokok'] +
                           $data['tunjangan_umum'] +
                           $data['tunjangan_fungsional'] +
                           $data['tunjangan_lain_lain'] +
                           $data['tunjangan_beras'] +
                           $data['tunjangan_istri_suami'] +
                           $data['tunjangan_anak'];
        $this->assertEqualsWithDelta($expectedGajiKotor, $data['gaji_kotor'], 100);

        // Cek potongan IWP 8%
        $expectedPotonganIwp8 = round($data['gaji_kotor'] * 0.08);
    $this->assertEqualsWithDelta($expectedPotonganIwp8, $data['potongan_iwp_8'], 10);



        // Cek iuran BPJS Peserta 1%
        $expectedBpjsPeserta = round($data['gaji_pokok'] * 0.01);
    $this->assertEquals($expectedBpjsPeserta, $data['potongan_bpjs']);

        // Cek pph21 bulanan harus > 0 (hitung manual agak kompleks, cukup dicek tipe dan nilai positif)
        $this->assertIsInt($data['potongan_pph21']);
        $this->assertGreaterThanOrEqual(0, $data['potongan_pph21']);

        // Cek gaji bersih (kotor - potongan)
        $totalPotongan = $data['potongan_pph21'] + $data['potongan_bpjs'] + $data['potongan_iwp_8'];
        $expectedGajiBersih = $data['gaji_kotor'] - $totalPotongan;

        // Karena gaji bersih dibulatkan ke ratusan terdekat
        $expectedGajiBersihRounded = ceil($expectedGajiBersih / 100) * 100;
        $this->assertEquals($expectedGajiBersihRounded, $data['gaji_bersih']);

        // Pastikan tidak ada error pada response
        $response->assertJsonStructure([
            'data' => [
                'gaji_pokok',
                'tunjangan_umum',
                'tunjangan_fungsional',
                'tunjangan_istri_suami',
                'tunjangan_anak',
                'tunjangan_beras',
                'tunjangan_lain_lain',
                'gaji_kotor',
                'potongan_iwp_8',
                'potongan_bpjs',
                'potongan_pph21',
                'gaji_bersih',
            ],
        ]);
    }


    /** @test */
    public function it_can_calculate_salary_for_pppk_employee()
    {
        $this->actingAs(User::first());

        $employee = Employee::factory()->create([
            'golongan' => 'IV',
            'jenisKepegawaian' => 'PPPK',
            'tanggalMasuk' => now()->subYears(3)->format('Y-m-d'),
            'ptkp_id' => $this->ptkp->id,
            'statusPernikahan' => 'Belum Menikah',
            'jabatan_fungsional_id' => $this->jabfung2->id,
        ]);


        GajiPokokPppk::factory()->create([
            'golongan' => 'IV',
            'mkg' => 2,
            'nominal' => 6500000,
        ]);

        TunjanganUmum::factory()->create([
            'golongan' => 'IV',
            'tunjangan' => 400000,
        ]);

        TunjanganFungsionalDosen::factory()->create([
            'jabatan_fungsional_id' => $this->jabfung2->id,
            'nominal' => 600000,
        ]);

        Absensi::factory()->count(22)->create([
            'employee_id' => $employee->id,
            'statusKehadiran' => 'Hadir',
            'tanggalKehadiran' => now()->format('Y-m-d'),
        ]);

        $response = $this->postJson(route('payroll.hitung-gaji'), [
            'employee_id' => $employee->id,
            'periode_gaji' => now()->format('Y-m'),
            'tunjangan_lain_lain' => 50000,
        ]);

        // Debug response jika error
        if ($response->status() !== 200) {
            dump($response->getContent());
        }

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'periode_gaji',
                'gaji_pokok',
                'tunjangan_umum',
                'tunjangan_fungsional',
                'tunjangan_lain_lain',
                'tunjangan_pembulatan',
                'tunjangan_beras',
                'tunjangan_istri_suami',
                'tunjangan_anak',
                'gaji_kotor',
                'potongan_pph21',
                'potongan_bpjs',
                'potongan_iwp_8',
                'potongan_lain',
                'total_potongan',
                'gaji_bersih',
            ]
        ]);


        $this->assertEquals(6500000, $response->json('data.gaji_pokok'));

    }

    /** @test */
    public function it_returns_404_if_salary_not_found()
    {
        $this->actingAs(User::first());

        $employee = Employee::factory()->create([
            'golongan' => 'IX/Z',
            'jenisKepegawaian' => 'PNS',
            'tanggalMasuk' => now()->subYear()->format('Y-m-d'),
            'ptkp_id' => 1,
            'statusPernikahan' => 'Menikah',
            'jabatan_fungsional_id' => 1,
        ]);

        $response = $this->postJson(route('payroll.hitung-gaji'), [
            'employee_id' => $employee->id,
            'periode_gaji' => now()->format('Y-m'),
            'tunjangan_lain_lain' => 0,
        ]);

        // Debug jika error selain 404
        if ($response->status() !== 404) {
            dump($response->getContent());
        }

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Gaji pokok tidak ditemukan']);
    }

    /** @test */
    public function it_can_destroy_salary()
    {
        $this->actingAs(User::factory()->create());

        $salary = Salary::factory()->create();

        $response = $this->delete(route('payroll.destroy', $salary->id));

        $response->assertRedirect(); // Cek redirect back
        $response->assertSessionHas('success', 'Data gaji berhasil dihapus.');
        $this->assertDatabaseMissing('salary', ['id' => $salary->id]);
    }
/** @test */
public function it_can_show_edit_salary_page()
{
    $this->actingAs(User::factory()->create());

    $employee = Employee::factory()->create();

    // Buat salary dengan relasi employee
    $salary = Salary::factory()->create([
        'employee_id' => $employee->id,
    ]);

    $response = $this->get(route('payroll.result', $salary->id));

    $response->assertStatus(200);
    $response->assertViewIs('pages.payroll.payroll-result');
   $response->assertViewHas('salaries', function ($viewSalaries) use ($salary) {
    return $viewSalaries->contains('id', $salary->id);
});

}


  /** @test */
public function it_can_update_tunjangan_lain_lain()
{
    $this->actingAs(User::factory()->create());

    $salary = Salary::factory()->create([
        'periode_gaji' => '2023-10-01',
        'tunjangan_lain_lain' => 500000,
        'gaji_kotor' => 5000000,
        'gaji_bersih' => 4500000,
    ]);

    $payload = [
        'tunjangan_lain_lain' => 700000,
        'periode_gaji' => '2023-10',
    ];

    $response = $this->put(route('payroll.updateTunjanganLainLain', $salary->id), $payload);



    $response->assertStatus(200);
    $response->assertJsonFragment([
        'message' => 'Tunjangan lain-lain berhasil diperbarui tanpa mengubah komponen lain',
        'tunjangan_lain_lain' => 700000,
    ]);

    $this->assertDatabaseHas('salary', [
        'id' => $salary->id,
        'tunjangan_lain_lain' => 700000,
        'gaji_kotor' => 5200000,
        'gaji_bersih' => 4700000,
    ]);
}


    /** @test */
    public function it_fails_update_tunjangan_lain_lain_with_wrong_periode()
    {
        $this->actingAs(User::factory()->create());

        $salary = Salary::factory()->create([
            'periode_gaji' => '2023-10-01',
            'tunjangan_lain_lain' => 500000,
        ]);

        $payload = [
            'tunjangan_lain_lain' => 700000,
            'periode_gaji' => '2023-11',
        ];

        $response = $this->put(route('payroll.updateTunjanganLainLain', $salary->id), $payload);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Periode gaji tidak sesuai dengan data yang ada',
        ]);
    }

    /** @test */
    public function it_can_export_custom_pdf_and_download_file()
    {
        // Buat data dummy Salary dan Employee
        $employee = Employee::factory()->create([
            'nama' => 'Budi Santoso',
        ]);

        $salary = Salary::factory()->create([
            'employee_id' => $employee->id,
        ]);
        // Mock Pdf facade
        Pdf::shouldReceive('loadView')
            ->once()
            ->with('pages.pdf.slip-gaji-kustom', Mockery::on(function ($data) use ($salary) {
                // Pastikan view menerima variabel salary yg benar
                return isset($data['salary']) && $data['salary']->id === $salary->id;
            }))
            ->andReturnSelf();

        Pdf::shouldReceive('setPaper')
            ->once()
            ->with('A4', 'portrait')
            ->andReturnSelf();

        // Mock method download, cek nama filenya benar
        Pdf::shouldReceive('download')
            ->once()
            ->with('Slip_Gaji_Budi_Santoso.pdf')
            ->andReturn(response('PDF Content', 200, [
                'Content-Disposition' => 'attachment; filename=Slip_Gaji_Budi_Santoso.pdf',
                'Content-Type' => 'application/pdf',
            ]));

        // Panggil method exportKustomPDF, misal route-nya: /payroll/export-pdf/{id}
        $response = $this->get(route('payroll.slip.pdf', $salary->id));


        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        $response->assertHeader('Content-Disposition', 'attachment; filename=Slip_Gaji_Budi_Santoso.pdf');
    }

    /** @test */
    public function it_validates_request_for_check_existing_salary()
    {
        $response = $this->postJson('/payroll/check-existing-salary', [
            'employee_id' => 1,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('periode_gaji');
    }

}




