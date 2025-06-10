<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tax;
use App\Models\Employee;
use App\Models\Ptkp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Barryvdh\DomPDF\Facade\Pdf;
use Mockery;

class TaxTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ptkp = Ptkp::factory()->create();

        $this->employee = Employee::factory()->create([
            'nama' => 'Budi',
        ]);

        $this->user = User::factory()->create();
        $this->user->employee()->associate($this->employee);
        $this->user->save();

        $this->tax = Tax::factory()->create([
            'employee_id' => $this->employee->id,
            'ptkp_id' => $this->ptkp->id,
            'tanggalLaporan' => now(),
        ]);
    }

    public function test_myTax_displays_user_tax_records()
    {
        $response = $this->actingAs($this->user)->get(route('tax.myTax'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.tax.tax-detail-user');
        $response->assertViewHas('taxes');
    }

public function test_myTax_abort_if_user_has_no_employee()
{
    // Buat user dengan employee_id asal (tapi tidak ada data employee dengan ID tsb)
    $userNoEmployee = User::factory()->create([
        'email' => 'noemployee@example.com',
        'employee_id' => 99999,
    ]);

    // Pastikan relasi tidak ditemukan
    $this->assertNull($userNoEmployee->employee);

    // Lakukan request
    $response = $this->actingAs($userNoEmployee)->get(route('tax.myTax'));

    // Cek hasil
    $response->assertStatus(403);
    $response->assertSeeText('Tidak memiliki data pegawai.');
}

public function test_index_displays_tax_list()
{
    $response = $this->actingAs($this->user)->get(route('tax.index'));

    $response->assertStatus(200);
    $response->assertViewIs('pages.tax.tax-detail');
    $response->assertViewHas('taxes');
}





    public function test_exportBuktiPotongpdf_downloads_pdf()
    {
        // Mock Pdf facade
        $pdfMock = Mockery::mock('alias:' . Pdf::class);
        $pdfInstance = Mockery::mock();
        $pdfMock->shouldReceive('loadView')
            ->once()
            ->with('pages.tax.pdf', \Mockery::on(fn($arg) => isset($arg['tax'])))
            ->andReturn($pdfInstance);

        $pdfInstance->shouldReceive('setPaper')->once()->with('A4', 'portrait')->andReturnSelf();
        $pdfInstance->shouldReceive('download')->once()->with('Bukti_Potong_PPh21_Budi.pdf')->andReturn('file content');

        $response = $this->actingAs($this->user)->get(route('tax.exportBuktiPotongPDF', $this->tax->id));

        $this->assertEquals('file content', $response->getContent());
    }

    public function test_exportBuktiPotongPDF_handles_exception()
    {
        $this->mock(\App\Models\Tax::class, function ($mock) {
            $mock->shouldReceive('with->findOrFail')->andThrow(new \Exception('Not found'));
        });

        $response = $this->actingAs($this->user)->get(route('tax.exportBuktiPotongPDF', 999));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Gagal mengunduh bukti potong.');
    }

    public function test_destroy_deletes_tax()
    {
        $response = $this->actingAs($this->user)->delete(route('tax.destroy', $this->tax->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Data bukti potong berhasil dihapus.');
        $this->assertDatabaseMissing('tax', ['id' => $this->tax->id]);
    }

    public function test_destroy_handles_exception()
    {
        $this->mock(\App\Models\Tax::class, function ($mock) {
            $mock->shouldReceive('findOrFail')->andThrow(new \Exception('Delete error'));
        });

        $response = $this->actingAs($this->user)->delete(route('tax.destroy', 999));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Gagal menghapus data bukti potong.');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
