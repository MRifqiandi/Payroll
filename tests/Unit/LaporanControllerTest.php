<?php

namespace Tests\Unit;

use App\Http\Controllers\LaporanController;
use App\Models\Laporan;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\LengthAwarePaginator;

use Tests\TestCase;
use Mockery;

class LaporanControllerTest extends TestCase
{

    public function setUp(): void
{
    parent::setUp();
    $this->laporanMock = $this->createMock(Laporan::class);
}

    public function test_by_jenis_returns_json()
    {
        $mock = Mockery::mock(Laporan::class);
        $mock->shouldReceive('where')->with('jenisLaporan', 'Gaji')->andReturnSelf();
        $mock->shouldReceive('latest')->andReturnSelf();
        $mock->shouldReceive('get')->andReturn(collect([
            (object)['id' => 1, 'jenisLaporan' => 'Gaji'],
        ]));

        $controller = new LaporanController($mock);
        $response = $controller->byJenis('Gaji');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('Gaji', $response->getData()[0]->jenisLaporan);
    }

        public function test_show_returns_laporan_json()
    {
        $laporan = Laporan::factory()->create();
        $controller = new LaporanController(new Laporan());
        $response = $controller->show($laporan->id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($laporan->id, $response->getData()->id);
    }

    public function test_store_saves_laporan_and_files()
    {
        $this->withoutMiddleware();
        Storage::fake('local');

        $fileLaporan = UploadedFile::fake()->create('laporan.pdf', 100);
        $buktiPotong = UploadedFile::fake()->create('bukti.pdf', 100);

        $response = $this->postJson(route('laporan.store'), [
            'jenisLaporan' => 'gaji',
            'tanggalLaporan' => now()->toDateString(),
            'fileLaporan' => $fileLaporan,
            'buktiPotong' => $buktiPotong,
        ]);

        $response->assertRedirect(route('laporan.list'));

        $laporan = Laporan::latest()->first();

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

        $controller = new LaporanController(new Laporan());
        $request = Request::create("/laporan/{$laporan->id}/download", 'GET', ['type' => 'fileLaporan']);
        $response = $controller->download($laporan->id, $request);

        $this->assertEquals(200, $response->getStatusCode());
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

        $controller = new LaporanController(new Laporan());
        $response = $controller->destroy($laporan->id);


        $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
        Storage::assertMissing($filePath);
        Storage::assertMissing($buktiPath);
    }
}
