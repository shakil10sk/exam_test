<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->string('to_address',50);
            $table->string('title',100)->nullable();
            $table->text('message')->nullable();
            $table->dateTime('sending_time');
            $table->tinyInteger('is_process')->default(0)->comment("0 = pending, 1 = sent, 2 = empty mobile no, 3 = wrong mobile no");
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
        Schema::dropIfExists('sms');
    }
}
