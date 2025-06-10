<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunjanganFungsionalDosenTable extends Migration
{
    public function up()
    {
        Schema::create('tunjangan_fungsional_Dosen', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jabatan_fungsional_id')->index();
            $table->decimal('nominal', 15, 2)->default(0);
            $table->timestamps();

            // Jika ingin menambahkan foreign key constraint, aktifkan baris ini:
            $table->foreign('jabatan_fungsional_id')->references('id')->on('jabatan_fungsional')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tunjangan_fungsional_dosen');
    }
}
