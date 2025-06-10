<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

use App\Models\Employee;
use App\Models\GajiPokokPns;
use App\Models\TunjanganUmum;
use App\Models\TunjanganFungsionalDosen;
use App\Models\JabatanFungsional;
use App\Models\User;
use App\Models\Absensi;
use Spatie\Permission\Models\Role;
use App\Models\Bpjs;
use App\Models\Ptkp;
use App\Models\Tax;
use App\Http\Controllers\YourController; // ganti sesuai nama controller Anda
use Illuminate\Http\Request;

class GenerateAllSalariesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();


        User::factory()->create(['id' => 1]);

        JabatanFungsional::factory()->create(['id' => 1, 'nama_jabatan_fungsional' => 'Lektor']);
        Ptkp::factory()->create([
        // isi sesuai kebutuhan, contoh:
        'kode_ptkp' => 'K/0',
        'nilai_ptkp' => 54000000,
    ]);
    }

    /** @test */
    public function it_requires_periode_gaji_in_correct_format()
    {
        $this->actingAs(User::first());
        $response = $this->postJson('/payroll/hitung-gaji-semua', [
            // 'periode_gaji' => '2024-05', // sengaja dihilangkan
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('periode_gaji');

        $response = $this->postJson('/payroll/hitung-gaji-semua', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('periode_gaji');
    }

    /** @test */
public function it_generates_salary_for_all_employees_successfully()
{
    $this->actingAs(User::factory()->create());

    $employee = Employee::factory()->create([
        'golongan' => 'IV/a',
        'jenisKepegawaian' => 'PNS',
        'tanggalMasuk' => '2020-01-01',
        'ptkp_id' => 1,
        'jabatan_fungsional_id' => 1,
    ]);

    GajiPokokPns::factory()->create([
        'golongan' => 'PNS-IV/a',
        'mkg' => 3,
        'nominal' => 5000000,
    ]);

    TunjanganUmum::factory()->create([
        'golongan' => 'IV',
        'tunjangan' => 500000,
    ]);

    TunjanganFungsionalDosen::factory()->create([
        'jabatan_fungsional_id' => 1,
        'nominal' => 300000,
    ]);

    $response = $this->postJson('/payroll/hitung-gaji-semua', [
        'periode_gaji' => '2023-04', // harus cocok dengan format validasi di controller
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'data' => [
            'gaji_pokok' => 5000000,
        ],
    ]);
}

}
