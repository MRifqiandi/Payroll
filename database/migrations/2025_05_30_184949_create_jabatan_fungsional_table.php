<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatanFungsionalTable extends Migration
{
    public function up()
    {
        Schema::create('jabatan_fungsional', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jabatan_fungsional', 100);
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jabatan_fungsional');
    }
}

