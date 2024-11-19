<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('database.tables.DB_USER_UPLOADS'), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on(config('database.tables.DB_USERS'));
            $table->string('name');
            $table->text('file');
            $table->text('key');
            $table->text('iv');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(config('database.tables.DB_USER_FILES'), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on(config('database.tables.DB_USERS'));
            $table->uuid('user_upload_id');
            $table->foreign('user_upload_id')->references('id')->on(config('database.tables.DB_USER_UPLOADS'));
            $table->string('name');
            $table->text('file');
            $table->text('key');
            $table->text('iv');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(config('database.tables.DB_API_KEYS'), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('key');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
