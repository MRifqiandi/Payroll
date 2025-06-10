<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('employee_id')->nullable()->index(); // FK ke employees (nullable)
            $table->string('jenisLaporan', 100);
            $table->date('tanggalLaporan');
            $table->text('detailLaporan');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('originalBuktiPotong', 255)->nullable();
            $table->string('originalFileLaporan', 255)->nullable(); // diasumsikan varchar juga

            // Optional FK constraint
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}

