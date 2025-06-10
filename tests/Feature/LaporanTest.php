<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Models\User;
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


    public function test_by_jenis_returns_json()
    {
        $laporan = Laporan::factory()->create([
            'jenisLaporan' => 'Gaji'
        ]);

        $response = $this->getJson('/laporan/jenis/Gaji');

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
}
