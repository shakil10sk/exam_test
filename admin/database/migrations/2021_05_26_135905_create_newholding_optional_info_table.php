<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewholdingOptionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newholding_optional_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->bigInteger('pin')->nullable();
            $table->bigInteger('tracking');
            $table->string('nearby_holding_no', 50);
            $table->date('holding_construction_date');
            $table->string('holding', 50);
            $table->string('description_of_house', 100)->nullable();
            $table->string('submitted_papers', 70)->nullable();
            $table->string('loan_papers', 70)->nullable();
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
        Schema::dropIfExists('newholding_optional_info');
    }
}
