<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizenInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_information', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pin');
		    $table->bigInteger('nid')->nullable();
		    $table->bigInteger('birth_id')->nullable();
		    $table->string('name_bn', 50);
		    $table->string('name_en', 50)->nullable();
		    $table->integer('union_id');
		    $table->integer('permanent_upazila_id')->nullable();
		    $table->integer('permanent_district_id')->nullable();
		    $table->integer('permanent_postoffice_id')->nullable();
		    $table->bigInteger('passport_no')->nullable();
		    $table->string('photo', 50)->nullable();
		    $table->date('birth_date')->nullable();
		    $table->string('father_name_bn', 50)->nullable();
		    $table->string('father_name_en', 50)->nullable();
		    $table->string('mother_name_bn', 50)->nullable();
		    $table->string('mother_name_en', 50)->nullable();
		    $table->string('husband_name_bn', 50)->nullable();
		    $table->string('husband_name_en', 50)->nullable();
		    $table->string('wife_name_bn', 50)->nullable();
		    $table->string('wife_name_en', 50)->nullable();
		    $table->string('occupation', 50)->nullable();
		    $table->string('resident', 10)->nullable();
		    $table->string('educational_qualification', 20)->nullable();
		    $table->boolean('gender');
		    $table->boolean('marital_status');
		    $table->string('permanent_village_bn', 50)->nullable();
		    $table->string('permanent_village_en', 50)->nullable();
		    $table->string('permanent_rbs_en', 50)->nullable();
		    $table->string('permanent_rbs_bn', 50)->nullable();
		    $table->boolean('permanent_holding_no')->nullable();
		    $table->boolean('permanent_ward_no')->nullable();
		    $table->string('mobile', 11)->nullable();
		    $table->string('email', 50)->nullable();
		    $table->boolean('religion')->nullable();
		    $table->boolean('status')->default('0');
			$table->boolean('is_active')->default('1');
			$table->boolean('is_process')->default(0);
		    $table->timestamp('deleted_at')->nullable();
		    $table->integer('created_by')->nullable();
		    $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('citizen_information');
    }
}
