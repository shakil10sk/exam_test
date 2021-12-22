<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremisesOptionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premises_optional_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->bigInteger('pin')->nullable();
            $table->bigInteger('tracking');
            $table->string('organization_name_bn', 50);
            $table->string('organization_name_en', 50)->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 12)->nullable();
            $table->boolean('owner_type');
            $table->string('vat_id', 20)->nullable();
            $table->string('tax_id', 20)->nullable();
            $table->string('signboard_length',20)->nullable();
            $table->string('signboard_width',20)->nullable();
            $table->string('normal_signboard',50)->nullable();
            $table->string('lighted_signboard',50)->nullable();
            $table->string('agent_name_en', 50)->nullable();
            $table->string('agent_name_bn', 50)->nullable();
            $table->date('business_start_date')->nullable();
            $table->date('previous_license_data')->nullable();
            $table->string('building_size',50)->nullable();
            $table->double('capital',10,2)->nullable()->default(0.00);
            $table->integer('business_type');
            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
            $table->integer('fiscal_year_id');
            $table->integer('premises_upazila_id')->unsigned()->nullable();
            $table->integer('premises_postoffice_id')->unsigned()->nullable();
            $table->integer('premises_district_id')->unsigned()->nullable();
            $table->string('premises_village_bn', 50)->nullable();
            $table->string('premises_village_en', 50)->nullable();
            $table->string('premises_rbs_bn', 20)->nullable();
            $table->string('premises_rbs_en', 20)->nullable();
            $table->string('premises_holding_no', 20)->nullable();
            $table->string('premises_ward_no', 20)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->dateTime('created_time');
            $table->dateTime('updated_time')->nullable();
            $table->string('created_by_ip', 15);
            $table->string('updated_by_ip', 15)->nullable();

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
        Schema::dropIfExists('premises_optional_info');
    }
}
