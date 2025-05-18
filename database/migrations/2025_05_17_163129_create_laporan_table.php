<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(); // bisa null jika laporan umum
            $table->string('jenisLaporan'); // misal: 'pajak', 'absensi', dll
            $table->date('tanggalLaporan');
            $table->text('detailLaporan'); // bisa JSON atau teks
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
