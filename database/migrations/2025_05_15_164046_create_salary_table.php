<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id(); // id as primary key
            $table->unsignedBigInteger('employee_id')->index();
            $table->date('periode_gaji');
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('tunjangan_umum')->nullable()->default(0);
            $table->bigInteger('tunjangan_fungsional')->nullable()->default(0);
            $table->bigInteger('tunjangan_kinerja')->nullable()->default(0);
            $table->decimal('tunjangan_lain_lain', 15, 2)->nullable()->default(0.00);
            $table->decimal('tunjangan_pembulatan', 15, 2)->nullable()->default(0.00);
            $table->decimal('tunjangan_beras', 15, 2)->nullable()->default(0.00);
            $table->bigInteger('tunjangan_istri_suami')->nullable()->default(0);
            $table->bigInteger('tunjangan_anak')->nullable()->default(0);
            $table->bigInteger('uang_makan')->nullable()->default(0);
            $table->bigInteger('uang_lembur')->nullable()->default(0);
            $table->bigInteger('gaji_kotor');
            $table->bigInteger('potongan_pph21')->nullable()->default(0);
            $table->bigInteger('potongan_bpjs')->nullable()->default(0);
            $table->decimal('potongan_iwp_8', 15, 2)->nullable()->default(0.00);
            $table->decimal('potongan_iwp_1', 15, 2)->nullable()->default(0.00);
            $table->bigInteger('potongan_lain')->nullable()->default(0);
            $table->bigInteger('total_potongan');
            $table->bigInteger('gaji_bersih');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            // Optional: Foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary');
    }
}


