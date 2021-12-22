<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsProcessWebInUnionInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('union_information', function (Blueprint $table) {
            if (!Schema::hasColumn('union_information', 'is_process_web')) {
                $table->tinyInteger('is_process_web')->default('0')->after('is_process');
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
        Schema::table('union_information', function (Blueprint $table) {
            //
        });
    }
}
