<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd_locations', function (Blueprint $table) {
            $table->mediumInteger('id')->unsigned()->primary();
		    $table->mediumInteger('parent_id')->unsigned()->nullable();
		    $table->string('en_name', 150)->nullable();
		    $table->string('bn_name', 255)->nullable();
		    $table->integer('post_code')->unsigned()->nullable();
		    $table->string('web', 200)->nullable();
            $table->boolean('type')->unsigned()->comment('1 = Division, 2 = District, 3 = Upzila, 4 = Union, 5 = Thana, 6 = Post Office');
		    
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
        Schema::dropIfExists('bd_locations');
    }
}
