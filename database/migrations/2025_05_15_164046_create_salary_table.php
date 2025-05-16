<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->date('periodeGaji')->nullable();
            $table->decimal('gajiPokok', 15, 2)->nullable();
            $table->decimal('tunjanganTransportasi', 15, 2)->nullable();
            $table->decimal('tunjanganMakan', 15, 2)->nullable();
            $table->decimal('tunjanganKesehatan', 15, 2)->nullable();
            $table->decimal('bonus', 15, 2)->nullable();
            $table->decimal('insentif', 15, 2)->nullable();
            $table->decimal('lembur', 15, 2)->nullable();
            $table->decimal('totalPotongan', 15, 2)->nullable();
            $table->decimal('totalGaji', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary');
    }
}

