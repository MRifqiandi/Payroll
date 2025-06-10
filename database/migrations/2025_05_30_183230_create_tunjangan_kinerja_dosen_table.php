<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunjanganKinerjaDosenTable extends Migration
{
    public function up()
    {
        Schema::create('tunjangan_kinerja_dosen', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jabatan_fungsional_id')->index();
            $table->integer('kelas_jabatan');
            $table->decimal('nominal', 15, 2);
            $table->year('tahun_berlaku')->default('2025');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // Foreign key jika perlu
            // $table->foreign('jabatan_fungsional_id')->references('id')->on('jabatan_fungsional')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tunjangan_kinerja_dosen');
    }
}

