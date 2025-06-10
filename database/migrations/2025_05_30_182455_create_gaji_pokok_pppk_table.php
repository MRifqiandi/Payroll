<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiPokokPppkTable extends Migration
{
    public function up()
    {
        Schema::create('gaji_pokok_pppk', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->string('golongan', 5);
            $table->integer('mkg'); // Masa kerja golongan (tahun)
            $table->decimal('nominal', 15, 2); // Besaran gaji
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gaji_pokok_pppk');
    }
}
