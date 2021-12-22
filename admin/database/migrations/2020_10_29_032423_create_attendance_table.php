<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->string('record_id', 20);
            $table->date('attendance_date');
            $table->dateTime('login_time');
            $table->dateTime('logout_time')->nullable();
            $table->boolean('is_process')->default('0');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->dateTime('created_time');
            $table->timestamp('updated_time')->nullable();
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
        Schema::dropIfExists('attendance');
    }
}
