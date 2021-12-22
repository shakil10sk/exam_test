<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('union_id')->nullable();
            $table->integer('fiscal_year_id')->nullable();

            $table->bigInteger('pin')->nullable();
            $table->bigInteger('tracking')->nullable();

            $table->tinyInteger('type');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->boolean('is_process')->default(0);

            $table->integer('present_upazila_id')->nullable();
            $table->integer('present_postoffice_id')->nullable();
            $table->integer('present_district_id')->nullable();

            $table->string('present_village_bn',50)->nullable();
            $table->string('present_village_en',50)->nullable();
            $table->string('present_rbs_bn',20)->nullable();
            $table->string('present_rbs_en',20)->nullable();

            $table->integer('present_holding_no')->nullable();
            $table->integer('present_ward_no')->nullable();

            $table->string('comment_bn',20)->nullable();
            $table->string('comment_en',20)->nullable();

            $table->timestamp('deleted_at')->nullable();

            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();

            $table->string('created_by_ip',15);
            $table->string('updated_by_ip',15)->nullable();

            $table->dateTime('created_time');
            $table->dateTime('updated_time')->nullable();

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
        Schema::dropIfExists('application');
    }
}
