<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeBpjsTable extends Migration
{
    public function up()
    {
        Schema::create('employee_bpjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->foreignId('bpjsId')->constrained('bpjs')->onDelete('cascade');
            $table->string('nomorBpjs', 50)->nullable();
            $table->date('tanggalMulai')->nullable();
            $table->date('tanggalBerakhir')->nullable();
            $table->enum('statusBpjs', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_bpjs');
    }
}
