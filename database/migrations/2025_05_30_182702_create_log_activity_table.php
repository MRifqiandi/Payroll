<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActivityTable extends Migration
{
    public function up()
    {
        Schema::create('log_activity', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto increment primary key
            $table->char('users_id', 36); // char(36) utf8mb4_unicode_ci, not null
            $table->string('action', 50); // varchar(50), not null
            $table->enum('level', ['info', 'warning', 'error', 'critical'])->default('info')->nullable(); // enum with default info, nullable
            $table->text('description')->nullable(); // nullable text
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->index('users_id'); // index on users_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_activity');
    }
}

