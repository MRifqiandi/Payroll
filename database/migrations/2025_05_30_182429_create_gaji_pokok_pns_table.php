<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiPokokPnsTable extends Migration
{
    public function up()
    {
        Schema::create('gaji_pokok_pns', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->string('golongan', 20);
            $table->integer('mkg'); // Masa kerja golongan
            $table->bigInteger('nominal');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gaji_pokok_pns');
    }
}
