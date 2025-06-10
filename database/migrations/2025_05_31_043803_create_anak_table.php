<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnakTable extends Migration
{
    public function up()
    {
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->index();
            $table->string('nama', 100);
            $table->date('tanggal_lahir');
            $table->boolean('sudah_kawin')->nullable()->default(0);
            $table->boolean('punya_penghasilan')->nullable()->default(0);
            $table->boolean('menjadi_tanggungan')->nullable()->default(1);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anak');
    }
}
