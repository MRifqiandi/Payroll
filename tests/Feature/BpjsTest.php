<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Bpjs;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class BpjsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Simulasi role middleware
        $this->withoutMiddleware(); // Untuk test ini bisa disable middleware agar fokus ke fitur
    }

    public function test_index_admin_bpjs_page_can_be_accessed()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Bpjs::factory()->count(2)->create();

        $response = $this->get(route('admin.bpjs.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.employee.bpjs-history-admin');
        $response->assertViewHas('bpjsData');
    }

    public function test_my_bpjs_requires_employee_relation()
    {
        $employee = Employee::factory()->create();
        $user = User::factory()->create([
            'employee_id' => $employee->id
        ]);

        $bpjs = Bpjs::factory()->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($user)->get(route('my.bpjs'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.employee.bpjs-history');
        $response->assertViewHas('bpjsData');
    }

public function test_my_bpjs_for_user_without_employee_should_fail()
{
    // Pastikan tidak ada employee dengan ID 9999
    $this->assertDatabaseMissing('employee', ['id' => 9999]);

    $user = User::factory()->create([
        'employee_id' => 9999,
    ]);

    $this->assertNull($user->employee); // karena relasi employee tidak ditemukan

    $response = $this->actingAs($user)->get(route('my.bpjs'));

    $response->assertStatus(403);
    $response->assertSeeText('Tidak memiliki data pegawai.');
}


    public function test_export_pdf_returns_download()
    {
        Storage::fake('local'); // agar tidak benar-benar membuat file

        $employee = Employee::factory()->create();
        $bpjs = Bpjs::factory()->create([
            'employee_id' => $employee->id
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.bpjs.exportPDF', $bpjs->id));

        $response->assertStatus(200);
        $response->assertHeader('content-disposition'); // mengecek apakah ada header download
    }

    public function test_destroy_bpjs_deletes_record()
    {
        $user = User::factory()->create();
        $bpjs = Bpjs::factory()->create();

        $this->actingAs($user)
             ->delete(route('bpjs.destroy', $bpjs->id))
             ->assertRedirect();

        $this->assertDatabaseMissing('bpjs', ['id' => $bpjs->id]);
    }
}
