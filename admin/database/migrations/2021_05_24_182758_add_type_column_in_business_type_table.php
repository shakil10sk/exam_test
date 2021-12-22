<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnInBusinessTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_type', function (Blueprint $table) {
            if (!Schema::hasColumn('business_type','type')){
                $table->tinyInteger('type')->comment('1 = trade, 2 = premises')->after('name_en');
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
        Schema::table('business_type', function (Blueprint $table) {
            //
        });
    }
}
