<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\LogActivity;
use App\Helpers\ActivityLogger;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityLoggerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_activity_to_database_correctly()
    {
        // Simulasikan login user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Jalankan helper untuk mencatat log
        ActivityLogger::log('akses_halaman', 'User membuka halaman log', 'info');

        // Pastikan ada data di database log_activity
        $this->assertDatabaseHas('log_activity', [
            'users_id'   => $user->id,
            'action'     => 'akses_halaman',
            'description'=> 'User membuka halaman log',
            'level'      => 'info',
        ]);

        // Opsional: pastikan hanya ada satu log
        $this->assertEquals(1, LogActivity::count());
    }

    /** @test */
    public function it_defaults_to_info_level_if_none_given()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        ActivityLogger::log('login', 'User berhasil login');

        $this->assertDatabaseHas('log_activity', [
            'users_id' => $user->id,
            'action' => 'login',
            'level' => 'info', // default level
        ]);
    }

    /** @test */
    public function it_can_log_without_description()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        ActivityLogger::log('logout');

        $log = LogActivity::first();
        $this->assertNotNull($log);
        $this->assertEquals('logout', $log->action);
        $this->assertNull($log->description); // tidak ada deskripsi
    }
}
