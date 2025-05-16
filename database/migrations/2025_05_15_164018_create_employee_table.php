<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 50)->unique();
            $table->text('alamat')->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->string('statusPernikahan', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('departemen', 100)->nullable();
            $table->enum('statusKepegawaian', ['aktif', 'tidak aktif', 'tugas belajar'])->default('aktif');
            $table->integer('masaKerja')->nullable()->comment('Masa kerja dalam tahun');
            $table->string('npwp', 20)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('telepon', 20)->nullable();
            $table->date('tanggalMasuk')->nullable();
            $table->date('tanggalKeluar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
