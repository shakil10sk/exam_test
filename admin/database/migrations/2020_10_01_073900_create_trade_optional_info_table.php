<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeOptionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_optional_info', function (Blueprint $table) {
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
		    $table->string('signboard_type',30)->nullable();
            $table->float('capital');
            $table->integer('business_type');
			$table->boolean('is_active')->default('1');
			$table->boolean('is_process')->default(0);
		    $table->integer('fiscal_year_id');
		    $table->integer('trade_upazila_id')->unsigned()->nullable();
		    $table->integer('trade_postoffice_id')->unsigned()->nullable();
		    $table->integer('trade_district_id')->unsigned()->nullable();
		    $table->string('trade_village_bn', 50)->nullable();
		    $table->string('trade_village_en', 50)->nullable();
		    $table->string('trade_rbs_bn', 20)->nullable();
		    $table->string('trade_rbs_en', 20)->nullable();
		    $table->string('trade_holding_no', 20)->nullable();
		    $table->string('trade_ward_no', 20)->nullable();
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
        Schema::dropIfExists('trade_optional_info');
    }
}
