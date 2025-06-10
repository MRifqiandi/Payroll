<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxTable extends Migration
{
    public function up()
    {
        Schema::create('tax', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->unsignedBigInteger('employee_id')->index(); // Foreign key reference to employees
            $table->unsignedInteger('ptkp_id')->nullable()->index(); // Optional reference to PTKP
            $table->decimal('pph21', 15, 2)->default(0.00);
            $table->string('buktiPotong', 255)->nullable();
            $table->date('tanggalLaporan')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->decimal('penghasilan_neto', 15, 2)->nullable()->default(0.00);
            $table->decimal('biaya_jabatan', 15, 2)->nullable()->default(0.00);
            $table->decimal('iuran_pensiun', 15, 2)->nullable()->default(0.00);
            $table->decimal('penghasilan_kena_pajak', 15, 2)->nullable()->default(0.00);
            $table->unsignedInteger('tahun')->nullable()->default(date('Y'));
            $table->unsignedTinyInteger('bulan')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax');
    }
}
