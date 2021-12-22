<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizenOptionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_optional_info', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pin');
		    $table->bigInteger('tracking');
		    $table->bigInteger('application_id');
		    $table->integer('union_id');
		    $table->boolean('type')->comment('5 = ekoinam certificate');
            $table->date('death_date')->nullable();
		    $table->string('name_one', 50)->nullable();
		    $table->string('name_two', 50)->nullable();
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
        Schema::dropIfExists('citizen_optional_info');
    }
}
