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
        Schema::create('user_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->text('file');
            $table->text('key');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_uploads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->text('file');
            $table->text('key');
            $table->timestamps();
        });

        Schema::create('upload_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_file_id');
            $table->foreign('user_file_id')->references('id')->on('user_files');
            $table->uuid('user_upload_id');
            $table->foreign('user_upload_id')->references('id')->on('user_uploads');
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
