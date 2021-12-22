<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
		    $table->integer('union_id')->unsigned();
		    $table->integer('fiscal_year_id')->nullable();
		    $table->integer('voucher');
		    $table->bigInteger('sonod_no')->unsigned();
		    $table->decimal('amount', 10, 2);
		    $table->string('debit', 50)->nullable();
		    $table->string('credit', 50)->nullable();
		    $table->boolean('type');
		    $table->tinyInteger('balance_type')->nullable()->comment('1- opening 2- funded');
            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
		    $table->text('comment')->nullable();
		    $table->string('created_by', 50);
		    $table->string('updated_by', 50)->nullable();
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
        Schema::dropIfExists('acc_transaction');
    }
}
