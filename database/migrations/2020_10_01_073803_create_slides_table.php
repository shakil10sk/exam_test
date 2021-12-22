<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
		    $table->string('title', 150);
		    $table->integer('union_id');
		    $table->text('caption')->nullable();
		    $table->string('photo', 100)->nullable();
		    $table->boolean('status')->default('1');
		    $table->boolean('sequence');
		    $table->bigInteger('created_by');
		    $table->bigInteger('updated_by')->nullable();
		    $table->string('created_by_ip', 15);
		    $table->string('updated_by_ip', 15)->nullable();
		    $table->timestamp('deleted_at')->nullable();

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
        Schema::dropIfExists('slides');
    }
}
