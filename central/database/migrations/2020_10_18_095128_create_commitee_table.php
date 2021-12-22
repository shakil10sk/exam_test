<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommiteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee', function (Blueprint $table) {
            $table->integer('id');
            $table->mediumInteger('union_id')->unsigned();
            $table->string('committee_name', 255);
            $table->string('committee_step', 50)->nullable();
            $table->integer('ward_no')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_process')->default(0);
            $table->timestamp('created_time');
            $table->string('created_by', 20);
            $table->string('created_by_ip', 13);
            $table->timestamp('updated_time')->nullable();
            $table->string('updated_by', 20)->nullable();
            $table->string('updated_by_ip', 13)->nullable();

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
        Schema::dropIfExists('commitee');
    }
}
