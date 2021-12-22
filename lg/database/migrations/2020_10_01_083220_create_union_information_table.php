<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_information', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
		    $table->integer('district_id');
		    $table->integer('upazila_id');
		    $table->integer('postal_id');
		    $table->mediumInteger('union_code');
		    $table->string('en_name', 150);
		    $table->string('bn_name', 250);
		    $table->integer('postal_code')->nullable();
		    $table->string('village_bn', 50);
		    $table->string('village_en', 50)->nullable();
		    $table->string('email', 50)->nullable();
		    $table->string('mobile', 30)->nullable();
		    $table->string('telephone', 15)->nullable();
		    $table->string('sub_domain', 100)->nullable();
		    $table->string('main_logo', 50)->nullable();
		    $table->string('brand_logo', 50)->nullable();
		    $table->string('jolchap', 50)->nullable();
			$table->boolean('is_header_active')->default('1');
		    $table->boolean('status')->default('1');
		    $table->text('about')->nullable();
		    $table->text('google_map')->nullable();
		    $table->timestamp('deleted_at')->nullable();
		    $table->bigInteger('created_by');
		    $table->bigInteger('updated_by')->nullable();
		    $table->string('created_by_ip', 15);
		    $table->string('updated_by_ip', 15)->nullable();

		    $table->boolean('is_active')->unsigned()->default('1');
		
		    $table->unique('union_code','union_information_union_code_unique');
		
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
        Schema::dropIfExists('union_information');
    }
}
