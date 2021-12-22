<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('upazila_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('description', 700)->nullable();
            $table->string('pre_photo', 100)->nullable();
            $table->string('final_photo', 100)->nullable();
            $table->string('file', 100)->nullable();
            $table->string('descrip', 500)->default('0');
            $table->integer('status')->default(1);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_process')->default(0);
            $table->timestamp('entry_date')->default(DB::raw('current_timestamp()'));
            $table->timestamp('deleted_at')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->string('created_by_ip', 100)->nullable();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('updated_by_ip', 100)->nullable();
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
        Schema::dropIfExists('projects');
    }
}
