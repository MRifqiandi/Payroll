<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('employee_id')->index(); // Foreign key ke tabel employees
            $table->date('tanggalKehadiran');
            $table->enum('statusKehadiran', ['Hadir', 'Izin', 'Sakit', 'Alpha']);
            $table->time('waktuMasuk')->nullable();
            $table->time('waktuKeluar')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->time('updated_at')->nullable(); // Mengikuti struktur yang kamu berikan

            // Optional: tambahkan foreign key jika perlu
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
