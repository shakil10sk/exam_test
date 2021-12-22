<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationMemberListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_member_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->string('name',100);
            $table->string('father_name',100);
            $table->string('mother_name',100);
            $table->string('nid',30)->nullable();
            $table->string('birth_id',30)->nullable();
            $table->string('passport_no',50)->nullable();
            $table->date('birth_date');
            $table->string('mobile',15);
            $table->string('email',100)->nullable();
            $table->string('occupation',100)->nullable();
            $table->string('educational_qualification',100)->nullable();
            $table->tinyInteger('religion');
            $table->tinyInteger('gender');
            $table->string('present_village_en',50)->nullable();
            $table->string('present_rbs_en',50)->nullable();
            $table->string('present_holding_no',50)->nullable();
            $table->string('present_ward_no',50)->nullable();
            $table->integer('present_district_id')->nullable();
            $table->integer('present_upazila_id')->nullable();
            $table->integer('present_postoffice_id')->nullable();
            $table->string('permanent_village_en',50)->nullable();
            $table->string('permanent_rbs_en',50)->nullable();
            $table->string('permanent_holding_no',50)->nullable();
            $table->tinyInteger('permanent_ward_no')->nullable();
            $table->integer('permanent_district_id')->nullable();
            $table->integer('permanent_upazila_id')->nullable();
            $table->integer('permanent_postoffice_id')->nullable();
            $table->integer('chanda_amount');
            $table->integer('reference_id')->nullable();
            $table->string('photo',50)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
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
        Schema::dropIfExists('association_memeber_list');
    }
}
