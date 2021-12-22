<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandUseInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_use_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->bigInteger('pin')->nullable();
            $table->bigInteger('tracking');
            $table->bigInteger('application_id')->nullable();
            $table->string('dag_no_cs',50);
            $table->string('khotian_no_cs',50);
            $table->string('dag_no_sa',50);
            $table->string('khotian_no_sa',50);
            $table->string('dag_no_rs',50);
            $table->string('khotian_no_rs',50);
            $table->string('mojar_name',50);
            $table->string('mojar_no',50);
            $table->string('land_amount',50);
            $table->string('land_type',50);
            $table->string('plot_proposed_use',70);
            $table->string('plot_owner_details',70);
            $table->string('owner_cue',70);
            $table->string('registration_date',50);
            $table->string('current_land_use',50);
            $table->string('radius_land_current_use',50);
            $table->string('ploat_near_road',70);
            $table->string('join_ploat_road',50);
            $table->string('main_road',10)->nullable();
            $table->string('river_port',10)->nullable();
            $table->string('hat_bazaar',10)->nullable();
            $table->string('airport',10)->nullable();
            $table->string('railway_station',10)->nullable();
            $table->string('pond',10)->nullable();
            $table->string('flood_control_reservoirs',10)->nullable();
            $table->string('wetlands',10)->nullable();
            $table->string('forest',10)->nullable();
            $table->string('natural_waterways',10)->nullable();
            $table->string('park',10)->nullable();
            $table->string('hill',10)->nullable();
            $table->string('dal',10)->nullable();
            $table->string('historical_site',10)->nullable();
            $table->string('key_point',10)->nullable();
            $table->string('samorik',10)->nullable();
            $table->string('special_area',10)->nullable();

            $table->string('north',50)->nullable();
            $table->string('east',50)->nullable();
            $table->string('south',50)->nullable();
            $table->string('west',50)->nullable();
            $table->string('road_consider',150)->nullable();

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_use_info');
    }
}
