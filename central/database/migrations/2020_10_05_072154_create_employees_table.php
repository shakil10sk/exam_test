<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function (Blueprint $table) {
			$table->bigIncrements('id')->unsigned();
			$table->integer('employee_id')->unsigned();
			$table->integer('union_id')->unsigned();
			$table->integer('device_id')->unsigned()->nullable();
			$table->bigInteger('nid')->unsigned()->nullable();
			$table->string('email', 50)->nullable();
			$table->string('name', 50);
			$table->boolean('designation_id')->unsigned()->nullable();
			$table->boolean('gender')->unsigned()->nullable();
			$table->boolean('marital_status')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('qualification', 100)->nullable();
			$table->date('join_date')->nullable();
			$table->string('photo', 50)->nullable();
			$table->string('election_area', 100)->nullable();
			$table->string('mobile', 11)->nullable();
			$table->string('address', 100)->nullable();
			$table->integer('district_id');
			$table->integer('upazila_id')->unsigned();
			$table->integer('postal_id')->unsigned();
			$table->integer('sequence')->nullable();
			$table->text('messages')->nullable();
			$table->boolean('is_active')->default('1');
			$table->boolean('is_process')->default(0);
			$table->boolean('status')->default('1');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			$table->bigInteger('created_by')->unsigned();
			$table->bigInteger('updated_by')->unsigned()->nullable();

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
		Schema::dropIfExists('employees');
	}
}
