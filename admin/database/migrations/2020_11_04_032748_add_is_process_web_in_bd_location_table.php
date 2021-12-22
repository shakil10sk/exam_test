<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsProcessWebInBdLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bd_locations', function (Blueprint $table) {
            if (!Schema::hasColumn('bd_locations', 'is_process_web')) {
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
        Schema::table('bd_location', function (Blueprint $table) {
            //
        });
    }
}
