<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_info', function (Blueprint $table) {
            $table->bigIncrements('id');
		    $table->bigInteger('pin');
		    $table->bigInteger('tracking');
		    $table->integer('certificate_id')->nullable();
		    $table->mediumInteger('union_id')->unsigned();
		    $table->integer('fiscal_year_id')->unsigned();
		    $table->integer('present_upazila_id')->unsigned()->nullable();
		    $table->integer('present_postoffice_id')->unsigned()->nullable();
		    $table->integer('present_district_id')->unsigned()->nullable();
		    $table->string('present_village_bn', 50)->nullable();
		    $table->string('present_village_en', 50)->nullable();
		    $table->string('present_rbs_bn', 50)->nullable();
		    $table->string('present_rbs_en', 50)->nullable();
		    $table->string('present_holding_no', 20)->nullable();
		    $table->string('present_ward_no', 20)->nullable();
			$table->boolean('is_active')->default('1');
			$table->boolean('is_process')->default(0);
		    $table->timestamp('deleted_at')->nullable();
		    $table->bigInteger('created_by');
		    $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('owner_info');
    }
}
