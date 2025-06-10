<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUangLemburTable extends Migration
{
    public function up()
    {
        Schema::create('uang_lembur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('golongan', 10);
            $table->integer('nominal');
            $table->string('satuan', 50); // asumsikan varchar(50), bisa kamu sesuaikan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('uang_lembur');
    }
}
