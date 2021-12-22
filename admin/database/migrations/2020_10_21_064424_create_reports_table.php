<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('upazila_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->string('title', 250)->nullable();
            $table->string('file', 100)->nullable();
            $table->boolean('type')->comment('1 = tax_rate, 2 = gram adalot, 3 = birth report, 4 = sonmasik, 5 = S O E, 6 = yearly report, 7 = yearly budget, 8 = yearly plan 9 = three year plan 10 = five year plan');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_process')->default(0);
            $table->timestamp('created_time')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->string('created_by_ip', 15);
            $table->timestamp('updated_time')->nullable();
            $table->string('updated_by', 100)->nullable();
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
        Schema::dropIfExists('reports');
    }
}
