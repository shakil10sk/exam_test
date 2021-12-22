<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnapottiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onapotti', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('union_id');
            $table->integer('tracking');
            $table->bigInteger('pin')->default('0');
            $table->integer('type');
            $table->string('name_en', 100)->nullable();
            $table->string('name_bn', 100);
            $table->string('father_name_en', 100)->nullable();
            $table->string('father_name_bn', 100);
            $table->string('organization_name_en', 100)->nullable();
            $table->string('organization_name_bn', 100);
            $table->string('organization_location_en', 100)->nullable();
            $table->string('organization_location_bn', 100);
            $table->string('organization_type_en', 50)->nullable()->default('');
            $table->string('organization_type_bn', 50)->nullable()->default('');
            $table->string('trade_license_no', 50)->nullable();
            $table->integer('gender')->nullable();
            $table->integer('resident');
            $table->string('permanent_village_en', 100)->nullable();
            $table->string('permanent_village_bn', 100)->default('');
            $table->string('permanent_rbs_en', 100)->nullable();
            $table->string('permanent_rbs_bn', 50)->nullable();
            $table->string('permanent_holding_no', 50)->nullable();
            $table->integer('permanent_ward_no');
            $table->integer('permanent_district_id');
            $table->integer('permanent_upazila_id');
            $table->integer('permanent_postoffice_id');
            $table->string('office_village_en', 50)->nullable();
            $table->string('office_village_bn', 50)->default('');
            $table->string('office_rbs_en', 50)->nullable();
            $table->string('office_rbs_bn', 50)->nullable();
            $table->string('office_holding_no', 50)->nullable();
            $table->integer('office_ward_no');
            $table->integer('office_district_id');
            $table->integer('office_upazila_id');
            $table->integer('office_postoffice_id');
            $table->string('moja', 50)->nullable();
            $table->string('khotian_no', 50)->nullable();
            $table->string('thana', 50)->nullable();
            $table->string('dag_no', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('land_type', 50)->nullable();
            $table->string('land_amount', 50)->nullable();
            $table->string('created_by_ip', 50)->nullable();
            $table->string('updated_by_ip', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onapotti');
    }
}
