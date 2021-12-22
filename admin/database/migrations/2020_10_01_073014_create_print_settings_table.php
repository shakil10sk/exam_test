<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
		    $table->tinyInteger('type');
		    $table->integer('union_id');
		    $table->boolean('application_type');
		    $table->boolean('chairman')->unsigned()->default('1');
		    $table->boolean('member')->unsigned()->default('0');
		    $table->boolean('sochib')->unsigned()->default('0');
		    $table->boolean('obibabok')->unsigned()->default('0');
		    $table->boolean('pad_print')->unsigned()->default('0');
		    $table->bigInteger('created_by')->nullable();
		    $table->bigInteger('updated_by')->nullable();
		    $table->string('created_by_ip', 15)->nullable();
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
        Schema::dropIfExists('print_settings');
    }
}
