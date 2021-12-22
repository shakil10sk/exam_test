<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCapitalInTradeOptionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_optional_info', function (Blueprint $table) {
            $table->dropColumn('capital');
        });
        Schema::table('trade_optional_info', function (Blueprint $table) {
            $table->double('capital',10,2)->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_optional_info', function (Blueprint $table) {
            //
        });
    }
}
