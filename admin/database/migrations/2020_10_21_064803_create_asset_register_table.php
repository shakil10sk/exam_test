<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAssetRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_register', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('union_id')->default(0);
            $table->string('asset_name_point', 250)->nullable();
            $table->string('create_buy_date', 100)->nullable();
            $table->string('rate', 50)->nullable();
            $table->string('stock_source', 200)->nullable();
            $table->string('last_care_date', 20)->nullable();
            $table->string('expence_amount', 100)->nullable();
            $table->string('care_expense_source', 250)->nullable();
            $table->string('next_care_date', 20)->nullable();
            $table->string('file', 100)->nullable();
            $table->string('comment', 250)->nullable();
            $table->boolean('type')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_process')->default(0);
            $table->string('created_by_ip', 13);
            $table->string('updated_by_ip', 13)->nullable();
            $table->timestamp('created_time')->default(DB::raw('current_timestamp()'));
            $table->string('created_by', 50)->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('updated_by', 50)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_register');
    }
}
