<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Employee;
use App\Models\Laporan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;
        protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();
    }


    public function test_index_shows_laporan_list_for_admin()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Laporan::factory()->count(2)->create();

        $response = $this->get('/laporan');
        $response->assertStatus(200);
        $response->assertViewIs('pages.laporan.list');
        $response->assertViewHas('laporan');
    }

    public function test_index_filters_by_jenis_laporan()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    Laporan::factory()->create(['jenisLaporan' => 'Gaji']);
    Laporan::factory()->create(['jenisLaporan' => 'Pajak']);

    $response = $this->get('/laporan?jenisLaporan=Gaji');

    $response->assertStatus(200);
    $response->assertViewHas('laporan', function ($viewData) {
        return $viewData->every(fn ($item) => $item->jenisLaporan === 'Gaji');
    });
}

public function test_create_view_for_admin_shows_all_employees()
{
    $this->withoutExceptionHandling();

    $user = User::factory()->create();
    Role::findOrCreate('admin');
    $user->assignRole('admin');

    $this->actingAs($user);

    $employee = Employee::factory()->create();

    $response = $this->get(route('laporan.create'));

    $response->assertStatus(200);
    $response->assertViewHas('employees');
    $response->assertSee($employee->nama);
}

public function test_destroy_still_deletes_laporan_if_files_missing()
{
    $laporan = Laporan::factory()->create([
        'detailLaporan' => [
            'fileLaporan' => 'not_exists1.pdf',
            'buktiPotong' => 'not_exists2.pdf',
        ]
    ]);

    $response = $this->delete("/laporan/{$laporan->id}");

    $response->assertRedirect();
    $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
}

public function test_create_view_for_staff_shows_only_their_employee()
{
    $employee = Employee::factory()->create();
    $user = User::factory()->create(['employee_id' => $employee->id]);

    Role::findOrCreate('staff');
    $user->assignRole('staff');

    $user->load('employee');

    $this->actingAs($user);

    $response = $this->get(route('laporan.create'));

    $response->assertStatus(200);
    $response->assertViewHas('employees', function ($employees) use ($employee) {
        return $employees->pluck('id')->contains($employee->id);
    });
}

public function test_store_validation_fails()
{
    $user = User::factory()->create();
    Role::findOrCreate('admin');
    $user->assignRole('admin');

    $this->actingAs($user);

    $response = $this->post('/laporan', [
    ]);

    $response->assertSessionHasErrors(['jenisLaporan', 'tanggalLaporan', 'fileLaporan']);
}

public function test_download_with_invalid_type_returns_404()
{
    $laporan = Laporan::factory()->create([
        'detailLaporan' => [],
    ]);

    $response = $this->get("/laporan/laporan/download/{$laporan->id}?type=invalidKey");

    $response->assertStatus(404);
}


public function test_download_with_missing_file_path_returns_404()
{
    $laporan = Laporan::factory()->create([
        'detailLaporan' => ['fileLaporan' => 'missing/file.pdf'],
        'originalFileLaporan' => 'file.pdf'
    ]);

    $response = $this->get("/laporan/laporan/download/{$laporan->id}?type=fileLaporan");
    $response->assertStatus(404);
}


public function test_by_jenis_returns_json()
{
    $laporan = Laporan::factory()->create(['jenisLaporan' => 'Gaji']);

    $response = $this->getJson(route('laporan.byJenis', ['jenis' => 'Gaji'])); // pastikan route() dipakai

    $response->assertStatus(200);
    $response->assertJsonFragment(['jenisLaporan' => 'Gaji']);
}


    public function test_show_returns_laporan_json()
    {
        $laporan = Laporan::factory()->create();

        $response = $this->getJson("/laporan/{$laporan->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $laporan->id,
        ]);
    }

public function test_store_saves_laporan_and_files()
{
    $this->withoutExceptionHandling();

    Storage::fake('local');

    // Buat user dan assign role via spatie/permission
    $user = User::factory()->create();
    Role::findOrCreate('admin');
    $user->assignRole('admin');

    $this->actingAs($user);

    // Buat file palsu
    $fileLaporan = UploadedFile::fake()->create('laporan.pdf', 100);
    $buktiPotong = UploadedFile::fake()->create('bukti.pdf', 100);

    $response = $this->post('/laporan', [
        'jenisLaporan' => 'gaji',
        'tanggalLaporan' => now()->toDateString(),
        'fileLaporan' => $fileLaporan,
        'buktiPotong' => $buktiPotong,
    ]);

    $response->assertRedirect(route('laporan.index'));

    $laporan = Laporan::latest()->first();

    $this->assertNotNull($laporan, 'Laporan tidak ditemukan');
    $this->assertIsArray($laporan->detailLaporan);
    $this->assertArrayHasKey('fileLaporan', $laporan->detailLaporan);
    $this->assertArrayHasKey('buktiPotong', $laporan->detailLaporan);

    Storage::disk('local')->assertExists($laporan->detailLaporan['fileLaporan']);
    Storage::disk('local')->assertExists($laporan->detailLaporan['buktiPotong']);
}

    public function test_download_returns_file()
    {
        Storage::fake('local');

        $filePath = 'laporan_files/test.pdf';
        Storage::put($filePath, 'dummy content');

        $laporan = Laporan::factory()->create([
            'detailLaporan' => ['fileLaporan' => $filePath],
            'originalFileLaporan' => 'test.pdf',
        ]);

        $response = $this->get("/laporan/laporan/download/{$laporan->id}?type=fileLaporan");

        $response->assertStatus(200);
        $response->assertHeader('content-disposition');
    }

    public function test_destroy_deletes_laporan_and_files()
    {
        Storage::fake('local');

        $filePath = 'laporan_files/file.pdf';
        $buktiPath = 'bukti_potong/file.jpg';
        Storage::put($filePath, 'content');
        Storage::put($buktiPath, 'content');

        $laporan = Laporan::factory()->create([
            'detailLaporan' => [
                'fileLaporan' => $filePath,
                'buktiPotong' => $buktiPath,
            ]
        ]);

        $response = $this->delete("/laporan/{$laporan->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
        Storage::disk('local')->assertMissing($filePath);
        Storage::disk('local')->assertMissing($buktiPath);
    }

    public function test_destroy_returns_json_response_if_requested()
{
    Storage::fake('local');

    $laporan = Laporan::factory()->create([
        'detailLaporan' => [
            'fileLaporan' => 'laporan_files/x.pdf',
        ]
    ]);

    Storage::put('laporan_files/x.pdf', 'content');

    $response = $this->deleteJson("/laporan/{$laporan->id}");

    $response->assertStatus(200)
             ->assertJson(['message' => 'Laporan berhasil dihapus.']);
}

public function test_destroy_skips_file_delete_if_file_missing(): void
{
    Storage::fake('local');

    $laporan = Laporan::factory()->create([
        'detailLaporan' => [
            'buktiPotong' => 'bukti_potong/fake.pdf',
            'fileLaporan' => 'laporan_files/fake.xlsx',
        ],
    ]);

    $response = $this->delete(route('laporan.destroy', $laporan->id));

    $response->assertRedirect();
    $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
}


public function test_destroy_deletes_and_redirects()
{
    Storage::fake('local');

    $filePath = 'laporan_files/file.pdf';
    Storage::put($filePath, 'content');

    $laporan = Laporan::factory()->create([
        'detailLaporan' => ['fileLaporan' => $filePath]
    ]);

    $response = $this->delete("/laporan/{$laporan->id}");

    $response->assertRedirect(); // Non-JSON response
    $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
    Storage::disk('local')->assertMissing($filePath);
}

public function test_download_bukti_potong_returns_file()
{
    Storage::fake('local');

    $path = 'bukti_potong/bukti.pdf';
    Storage::put($path, 'bukti content');

    $laporan = Laporan::factory()->create([
        'detailLaporan' => ['buktiPotong' => $path],
        'originalBuktiPotong' => 'bukti.pdf',
    ]);

    $response = $this->get("/laporan/laporan/download/{$laporan->id}?type=buktiPotong");

    $response->assertStatus(200);
    $response->assertHeader('content-disposition');
}

public function test_controller_can_be_instantiated(): void
{
    $controller = new \App\Http\Controllers\LaporanController(new Laporan);
    $this->assertInstanceOf(\App\Http\Controllers\LaporanController::class, $controller);
}


}
