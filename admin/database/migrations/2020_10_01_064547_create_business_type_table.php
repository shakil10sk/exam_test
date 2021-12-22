<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_type', function (Blueprint $table) {
            $table->bigIncrements('id');
		    $table->integer('union_id');
		    $table->string('name_bn', 50);
		    $table->string('name_en', 50)->nullable();
            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
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
        Schema::dropIfExists('business_type');
    }
}
