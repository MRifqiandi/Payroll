<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasJabatanTable extends Migration
{
    public function up()
    {
        Schema::create('kelas_jabatan', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->string('nama_jabatan', 255);
            $table->string('kelas_jabatan')->nullable(); // Sesuaikan tipe dan nullable sesuai kebutuhan
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas_jabatan');
    }
}
