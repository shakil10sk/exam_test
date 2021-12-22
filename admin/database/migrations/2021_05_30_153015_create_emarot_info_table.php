<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmarotInfoTable extends Migration
{

    public function up()
    {
        Schema::create('emarot_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->bigInteger('pin')->nullable();
            $table->bigInteger('tracking');
            $table->bigInteger('application_id')->nullable();
            $table->string('area_name',50);
            $table->tinyInteger('build_type');
            $table->string('dag_no_cs',50);
            $table->string('khotian_no_cs',50);
            $table->string('dag_no_sa',50);
            $table->string('khotian_no_sa',50);
            $table->string('dag_no_rs',50);
            $table->string('khotian_no_rs',50);
            $table->string('sit_no',50);
            $table->string('mojar_name',50);
            $table->string('land_amount',50);
            $table->string('emarot_word_no',20);
            $table->string('land_earn_description',50);
            $table->string('road_name',50);
            $table->string('north',50)->nullable();
            $table->string('south',50)->nullable();
            $table->string('east',50)->nullable();
            $table->string('west',50)->nullable();
            $table->string('fast_floor',50)->nullable();
            $table->string('other_floor',50)->nullable();
            $table->string('total_floor',50)->nullable();
            $table->string('site_name',50)->nullable();
            $table->string('distance',50)->nullable();
            $table->string('position',50)->nullable();
            $table->string('spread',50)->nullable();
            $table->string('near_way',50)->nullable();
            $table->string('to_north',50);
            $table->string('to_east',50);
            $table->string('to_south',50);
            $table->string('to_west',50);
            $table->string('road_present_condition',50)->nullable();
            $table->string('road_consider',50)->nullable();
            $table->string('emarot_land',50)->nullable();
            $table->string('previous_emarot_land',50)->nullable();
            $table->string('electricity_line',5)->nullable();
            $table->string('gass_line',5)->nullable();
            $table->string('water_line',5)->nullable();
            $table->string('drain_line',5)->nullable();
            $table->string('ceptic_tank',5)->nullable();
            $table->string('emarot_construction_start',100)->nullable();
            $table->string('emarot_construction_destroy_purpose',100)->nullable();
            $table->string('emarot_construction_notice_jari',100)->nullable();
            $table->string('road_distance',50)->nullable();
            $table->string('drain_distance',50)->nullable();
            $table->string('emarot_distance',50)->nullable();
            $table->string('electricity_distance',50)->nullable();
            $table->string('gass_distance',50)->nullable();


            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
            $table->integer('fiscal_year_id');
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->dateTime('created_time');
            $table->dateTime('updated_time')->nullable();
            $table->string('created_by_ip', 15);
            $table->string('updated_by_ip', 15)->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('emarot_info');
    }
}
