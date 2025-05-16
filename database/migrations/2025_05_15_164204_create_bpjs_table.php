<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBpjsTable extends Migration
{
    public function up()
    {
        Schema::create('bpjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->enum('jenisBpjs', ['Kesehatan', 'Ketenagakerjaan']);
            $table->decimal('iuranPerusahaan', 15, 2)->default(0);
            $table->decimal('iuranKaryawan', 15, 2)->default(0);
            $table->decimal('totalIuran', 15, 2)->storedAs('iuranPerusahaan + iuranKaryawan');
            $table->date('tanggalIuran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bpjs');
    }
}

