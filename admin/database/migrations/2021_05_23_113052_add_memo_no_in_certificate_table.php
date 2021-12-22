<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemoNoInCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate', function (Blueprint $table) {
            if (!Schema::hasColumn('certificate', 'memo_no')) {
               $table->string('memo_no',50)->nullable()->after('due_fiscal_year');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate', function (Blueprint $table) {
            //
        });
    }
}
