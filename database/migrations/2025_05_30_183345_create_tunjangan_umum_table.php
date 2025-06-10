<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunjanganUmumTable extends Migration
{
    public function up()
    {
        Schema::create('tunjangan_umum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('golongan', 10);
            $table->decimal('tunjangan', 15, 2);
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tunjangan_umum');
    }
}
