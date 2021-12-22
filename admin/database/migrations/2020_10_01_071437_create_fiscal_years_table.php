<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiscalYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiscal_years', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
		    $table->string('name', 50)->unique();
		    $table->boolean('is_current')->default('0');
            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
		    $table->date('expire_date')->default(date('Y-06-30'));
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
        Schema::dropIfExists('fiscal_years');
    }
}
