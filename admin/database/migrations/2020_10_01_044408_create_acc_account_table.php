<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable();
            $table->integer('union_id');
            $table->string('account_code');
            $table->string('account_name')->nullable();
            $table->tinyInteger('acc_type')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->smallInteger('head_type')->nullable();

            $table->string('created_by',50);
            $table->string('created_by_ip',15);
            $table->dateTime('created_time');

            $table->string('updated_by',50)->nullable();
            $table->string('updated_by_ip',15)->nullable();
            $table->dateTime('updated_time')->nullable();

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
        Schema::dropIfExists('acc_account');
    }
}
