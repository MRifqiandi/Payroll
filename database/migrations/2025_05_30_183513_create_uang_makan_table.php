<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUangMakanTable extends Migration
{
    public function up()
    {
        Schema::create('uang_makan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('golongan', 10);
            $table->integer('nominal');
            $table->string('satuan', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('uang_makan');
    }
}
