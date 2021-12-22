<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOnapottiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onapotti', function (Blueprint $table) {

            if (!Schema::hasColumn('onapotti','status')) {
                $table->tinyInteger('status')->default('0')->after('type');
            }

            if (!Schema::hasColumn('onapotti','is_active')) {
                $table->boolean('is_active')->default('1')->after('status');
            }

            if (!Schema::hasColumn('onapotti','is_process')) {
                $table->boolean('is_process')->default('0')->after('is_active');
            }

            if (!Schema::hasColumn('onapotti','created_by')) {
                $table->string('created_by')->nullable()->after('land_amount');
            }
            
            if (!Schema::hasColumn('onapotti','updated_by')) {
                $table->string('updated_by')->nullable()->after('created_by');
            }
            
            if (!Schema::hasColumn('onapotti','created_time')) {
                $table->dateTime('created_time')->default(DB::raw('current_timestamp()'));
            }
            
            if (!Schema::hasColumn('onapotti', 'updated_time')) {
                $table->timestamp('updated_time')->nullable()->after('created_time');
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
        Schema::table('onapotti', function (Blueprint $table) {
            //
        });
    }
}
