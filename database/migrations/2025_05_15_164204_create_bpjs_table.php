<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBpjsTable extends Migration
{
    public function up()
    {
        Schema::create('bpjs', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('employee_id')->index(); // Foreign key ke tabel employees
            $table->string('periode', 7); // Format YYYY-MM
            $table->decimal('iuran_total', 15, 2);
            $table->decimal('iuran_perusahaan', 15, 2);
            $table->decimal('iuran_peserta', 15, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            // Optional: foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bpjs');
    }
}

