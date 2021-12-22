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
            $table->integer('union_id')->unsigned();
            $table->integer('allowance_id')->unsigned();
            $table->string('name', 150);
            $table->bigInteger('nid')->unsigned();
            $table->string('photo', 150)->nullable();
            $table->string('father_name', 150);
            $table->date('date_of_birth');
            $table->string('mobile', 15)->nullable();
            $table->string('village', 200);
            $table->integer('ward_no');
            $table->longText('bio')->nullable();
            $table->boolean('type')->comment('1 = freedom fighter, 2 = poor allowence, 3= old, 4 = motherhood, 5 = bidoba, 6 = protibondi, 7 = VGD');
            $table->boolean('is_active')->unsigned()->default('1');
            $table->integer('amount_of_allowance')->default('0');
            $table->boolean('sector_no')->nullable();
            $table->text('health_condition')->nullable();
            $table->text('economical_condition')->nullable();
            $table->text('educational_qualification')->nullable();
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
        Schema::dropIfExists('allowances');
    }
}
