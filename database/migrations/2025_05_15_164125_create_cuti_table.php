<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiTable extends Migration
{
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->enum('jenisCuti', ['tahunan', 'sakit', 'melahirkan', 'menikah', 'lainnya']);
            $table->text('alasanCuti')->nullable();
            $table->date('tanggalPengajuan');
            $table->date('tanggalMulai');
            $table->date('tanggalSelesai');
            $table->enum('statusPersetujuan', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuti');
    }
}
