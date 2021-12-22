<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowances', function (Blueprint $table) {
			$table->bigIncrements('id')->unsigned();
			$table->integer('allowance_id');
		    $table->integer('union_id')->unsigned();
		    $table->string('name', 150);
		    $table->bigInteger('nid')->unsigned();
		    $table->string('photo', 150)->nullable()->default(null);
		    $table->string('father_name', 150);
		    $table->date('date_of_birth');
		    $table->string('mobile', 15)->nullable()->default(null);
		    $table->string('village', 200);
		    $table->integer('ward_no');
		    $table->longText('bio')->nullable();
		    $table->boolean('type');
			$table->boolean('is_active')->unsigned()->default('1');
		    $table->integer('amount_of_allowance')->default('0');
		    $table->boolean('sector_no')->nullable()->default(null);
		    $table->text('health_condition')->nullable();
		    $table->text('economical_condition')->nullable();
		    $table->text('educational_qualification')->nullable();
		    $table->bigInteger('created_by');
		    $table->bigInteger('updated_by')->nullable()->default(null);
		    $table->string('created_by_ip', 15);
		    $table->string('updated_by_ip', 15)->nullable()->default(null);
		    $table->timestamp('deleted_at')->nullable()->default(null);
		
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
        Schema::dropIfExists('allowances');
    }
}
