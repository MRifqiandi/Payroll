<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryRaiseTable extends Migration
{
    public function up()
    {
        Schema::create('salary_raise', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->decimal('gajiLama', 15, 2)->nullable();
            $table->decimal('gajiBaru', 15, 2)->nullable();
            $table->decimal('persentaseKenaikan', 5, 2)->nullable();
            $table->string('alasan', 255)->nullable();
            $table->date('tanggalKenaikan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary_raise');
    }
}

