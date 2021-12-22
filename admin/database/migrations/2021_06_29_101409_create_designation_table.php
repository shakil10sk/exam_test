<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name',100);
            $table->tinyInteger('is_system')->default(0);
            $table->tinyInteger('is_process')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->string('created_by_ip', 15);
            $table->string('updated_by_ip', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designation');
    }
}
