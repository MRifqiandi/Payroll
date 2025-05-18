<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalaryIdToTaxTable extends Migration
{
    public function up()
    {
        Schema::table('tax', function (Blueprint $table) {
            $table->foreignId('salary_id')->nullable()->constrained('salary')->onDelete('cascade')->after('employee_id');
        });
    }

    public function down()
    {
        Schema::table('tax', function (Blueprint $table) {
            $table->dropForeign(['salary_id']);
            $table->dropColumn('salary_id');
        });
    }
}
