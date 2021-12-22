<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_info', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pin');
            $table->integer('union_id');
            $table->integer('fiscal_year_id')->default(0);

            $table->tinyinteger('total_male');
            $table->tinyinteger('total_female');
            
            $table->tinyinteger('ripe_house')->nullable();
            $table->tinyinteger('semi_ripe_house')->nullable();
            $table->tinyinteger('raw_house')->nullable();

            $table->decimal('probable_rate')->nullable();
            $table->decimal('halson_tax')->nullable();

            $table->tinyInteger('is_active')->default(1);
            $table->boolean('is_process')->default(0);
            $table->tinyInteger('is_paid')->default(0);

            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();

            $table->string('created_by_ip',15);
            $table->string('updated_by_ip',15)->nullable();

            $table->dateTime('created_time');
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
        Schema::dropIfExists('assesment_info');
    }
}
