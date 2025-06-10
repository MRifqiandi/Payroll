<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtkpTable extends Migration
{
    public function up()
    {
        Schema::create('ptkp', function (Blueprint $table) {
            $table->increments('id'); // int(11), primary key, auto increment
            $table->string('kode_ptkp', 10)->index(); // varchar(10), indexed, not null
            $table->bigInteger('nilai_ptkp'); // bigint(20), not null
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ptkp');
    }
}
