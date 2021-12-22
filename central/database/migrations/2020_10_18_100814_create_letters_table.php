<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->string('accept_send_date', 100)->nullable();
            $table->string('acc_send_no_date', 100)->nullable();
            $table->string('office', 200)->nullable();
            $table->string('description', 700)->nullable();
            $table->string('repley_no_date', 100)->nullable();
            $table->string('file', 250)->nullable();
            $table->string('comment', 200)->nullable();
            $table->boolean('type')->nullable()->comment('1 = send, 2 = accept');
            $table->boolean('is_active')->default('1');
            $table->string('created_by', 250);
            $table->timestamp('created_time');
            $table->timestamp('updated_time')->nullable();
            $table->string('updated_by', 250)->nullable();
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
        Schema::dropIfExists('letters');
    }
}
