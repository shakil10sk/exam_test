<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pin')->nullable();
		    $table->bigInteger('tracking');
		    $table->bigInteger('sonod_no')->unsigned();
		    $table->integer('union_id')->unsigned();
		    $table->integer('upazila_id')->nullable();
		    $table->integer('district_id')->nullable();
		    $table->boolean('type');
		    $table->integer('fiscal_year_id');
		    $table->date('expire_date')->nullable();
		    $table->string('due_fiscal_year', 50)->nullable();
		    $table->boolean('status');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_process')->default(0);
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
        Schema::dropIfExists('certificate');
    }
}
