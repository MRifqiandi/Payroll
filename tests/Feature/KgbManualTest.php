<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KgbManualTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function kgb_update_prediction_command_manually()
    {
        $response = $this->postJson('/kgb/update-prediksi');

        $response->assertStatus(200)
            ->assertJson([
                 'message' => 'Prediksi KGB semua karyawan telah diperbarui.'
            ]);
    }
}
