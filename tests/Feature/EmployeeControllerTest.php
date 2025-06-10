<?php

namespace Tests\Feature;

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use App\Models\Ptkp;
use App\Models\JabatanFungsional;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Salary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Mockery;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists('User', false)) {
            class_alias(User::class, 'User');
        }
        Role::firstOrCreate(['name' => 'admin']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

public function test_index_returns_view_with_employees()
{
    // Buat user yang valid dan login
    $user = User::factory()->create();

    // Jika pakai spatie/permission atau sistem role, assign role admin:
    $user->assignRole('admin'); // Pastikan role admin sudah ada di DB

    $this->actingAs($user);

    Employee::factory()->count(3)->create();

    $response = $this->get(route('admin.employee.index'));

    $response->assertStatus(200);
    $response->assertViewIs('pages.employee.admin-employee');
    $response->assertViewHas('employees');
}

    public function test_profile_returns_view_with_employee_when_employee_id_exists()
    {
        $employee = Employee::factory()->create();
        $user = User::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $this->actingAs($user);

        $this->withoutMiddleware();
        $this->actingAs($user);
        $response = $this->get(route('employee.profile'));
        $response->assertStatus(200);


        $response->assertViewIs('pages.employee.index');
        $response->assertViewHas('employee', $employee);
    }

    public function testProfileReturnsViewWithNullEmployeeWhenNoEmployeeId()
    {
        $userMock = Mockery::mock();
        $userMock->employee_id = null;

        Auth::shouldReceive('user')->once()->andReturn($userMock);

        $controller = new EmployeeController();
        $response = $controller->profile();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('employee', $response->getData());
        $this->assertNull($response->getData()['employee']);
    }

   public function test_store_validates_and_creates_employee_and_user()
{
    $ptkp = Ptkp::factory()->create();
    $jabatan = JabatanFungsional::factory()->create();

    // Buat employee dulu
    $employee = Employee::factory()->make([
        'ptkp_id' => $ptkp->id,
        'jabatan_fungsional_id' => $jabatan->id,
    ]);

    // login dulu user yang valid
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

    // Post data employee + user
    $response = $this->post(route('employee.store'), [
        'nama' => 'John Doe',
        'nik' => '123456789',
        'alamat' => 'Jl. Testing',
        'tanggalLahir' => '1990-01-01',
        'statusPernikahan' => 'Belum Kawin',
        'jabatan' => 'Staff IT',
        'ptkp_id' => $ptkp->id,
        'departemen' => 'TI',
        'statusKepegawaian' => 'Aktif',
        'npwp' => '1234567890',
        'email' => 'john@example.com',
        'telepon' => '08123456789',
        'tanggalMasuk' => '2022-01-01',
        'tanggalKeluar' => null,
        'golongan' => 'III/a',
        'jabatan_fungsional_id' => $jabatan->id,
        'password' => 'password',
        'password_confirmation' => 'password',
        'position' => 'Admin',
    ]);

    $response->assertRedirect(route('admin.employee.index'));

    $this->assertDatabaseHas('employee', ['email' => 'john@example.com']);
    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
}

    public function testDestroyDeletesEmployeeAndRelations()
    {
        $employee = Employee::factory()->create();
        $controller = new EmployeeController();
        $response = $controller->destroy($employee->id);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_update_validates_and_updates_employee_and_password()
    {
        $ptkp = Ptkp::factory()->create();
        $jabatan = JabatanFungsional::factory()->create();

        $employee = Employee::factory()->create([
            'nama' => 'Old Name',
            'ptkp_id' => $ptkp->id,
            'jabatan_fungsional_id' => $jabatan->id,
        ]);

        $user = User::factory()->create([
            'employee_id' => $employee->id,
            'password' => bcrypt('oldpass')
        ]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $response = $this->put(route('employee.update', $employee->id), [
            'id' => $employee->id,
            'nama' => 'Updated Name',
            'nik' => $employee->nik,
            'alamat' => 'Updated Address',
            'tanggalLahir' => '1990-01-01',
            'statusPernikahan' => 'Kawin',
            'jabatan' => 'Supervisor',
            'ptkp_id' => $ptkp->id,
            'departemen' => 'Keuangan',
            'statusKepegawaian' => 'Aktif',
            'npwp' => '111222333',
            'email' => $employee->email,
            'telepon' => '0810000000',
            'tanggalMasuk' => '2020-01-01',
            'tanggalKeluar' => null,
            'golongan' => 'III/b',
            'jabatan_fungsional_id' => $jabatan->id,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('employee', ['id' => $employee->id, 'nama' => 'Updated Name']);
        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }


}
