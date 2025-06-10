<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunjanganFungsionalTable extends Migration
{
    public function up()
    {
        Schema::create('tunjangan_fungsional', function (Blueprint $table) {
            $table->increments('id'); // int(11), primary key, auto increment
            $table->string('jabatan_fungsional', 100); // varchar(100), not null
            $table->decimal('tunjangan', 15, 2)->default(0); // tipe decimal sesuai kebutuhan, default 0
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tunjangan_fungsional');
    }
}
