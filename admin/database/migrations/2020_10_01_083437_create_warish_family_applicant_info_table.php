<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarishFamilyApplicantInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warish_family_applicant_info', function (Blueprint $table) {
            $table->bigIncrements('id');
		    $table->bigInteger('pin');
		    $table->bigInteger('tracking');
		    $table->integer('union_id')->unsigned();
		    $table->boolean('is_father_alive')->nullable();
		    $table->boolean('is_mother_alive')->nullable();
		    $table->string('name_bn', 50);
		    $table->string('name_en', 50)->nullable();
		    $table->string('father_name_bn', 50);
		    $table->string('father_name_en', 50)->nullable();
		    $table->string('investigator_name_en', 50)->nullable();
		    $table->boolean('type');
		    $table->string('mobile', 11);
		    $table->string('email', 20)->nullable();
		    $table->string('investigator_name_bn', 50)->nullable();
			$table->boolean('is_active')->default('1');
			$table->boolean('is_process')->default(0);
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
        Schema::dropIfExists('warish_family_applicant_info');
    }
}
