<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLogTable extends Migration
{
    public function up()
    {
        Schema::create('salary_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained('salary')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->string('field'); // nama field yang berubah, contoh: gajiPokok, bonus, dsb
            $table->decimal('old_value', 15, 2)->nullable(); // nilai sebelum diubah
            $table->decimal('new_value', 15, 2)->nullable(); // nilai setelah diubah
            $table->text('alasan')->nullable(); // opsional, alasan perubahan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary_log');
    }
}
