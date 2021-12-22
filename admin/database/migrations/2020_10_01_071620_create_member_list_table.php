<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_list', function (Blueprint $table) {
            $table->bigIncrements('id');
		    $table->bigInteger('pin');
		    $table->bigInteger('tracking');
		    $table->bigInteger('sonod_no')->nullable();
		    $table->integer('union_id');
		    $table->string('name_bn', 50);
		    $table->string('name_en', 50)->nullable();
		    $table->string('relation_bn', 20);
		    $table->string('relation_en', 20)->nullable();
		    $table->string('age', 15)->nullable();
		    $table->boolean('type');
            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
		    $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('member_list');
    }
}
