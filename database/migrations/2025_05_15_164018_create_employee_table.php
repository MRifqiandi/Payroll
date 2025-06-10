<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 255);
            $table->string('nik', 50)->index();
            $table->text('alamat')->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->string('statusPernikahan', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->unsignedInteger('ptkp_id')->nullable()->index();
            $table->string('departemen', 100)->nullable();
            $table->enum('statusKepegawaian', ['aktif', 'tidak aktif', 'tugas belajar'])->default('aktif');
            $table->string('jenisKepegawaian', 50)->default('PNS');
            $table->string('golongan', 20)->nullable();
            $table->date('tanggal_naik_golongan_terakhir')->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('email', 100)->nullable()->index();
            $table->string('telepon', 20)->nullable();
            $table->date('tanggalMasuk')->nullable();
            $table->date('tanggalKeluar')->nullable();
            $table->timestamps();
            $table->unsignedInteger('jabatan_fungsional_id')->nullable()->index();
            $table->date('tanggal_kgb_terakhir')->nullable();
            $table->date('prediksi_kgb_berikutnya')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
