<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryRaiseTable extends Migration
{
    public function up()
    {
        Schema::create('salary_raise', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('employee_id')->nullable()->index();
            $table->decimal('gajiLama', 15, 2)->nullable();
            $table->decimal('gajiBaru', 15, 2)->nullable();
            $table->decimal('persentaseKenaikan', 5, 2)->nullable();
            $table->string('alasan', 255)->nullable();
            $table->date('tanggalKenaikan')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            // Optional: Foreign key constraint
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary_raise');
    }
}
