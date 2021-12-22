<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_member', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('union_id');
            $table->integer('committee_id');
            $table->string('name', 100);
            $table->string('designation', 50)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nid', 18)->nullable();
            $table->string('social_status', 20)->nullable();
            $table->string('address', 150)->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_process')->default(0);
            $table->timestamp('created_time');
            $table->string('created_by', 20);
            $table->string('created_by_ip', 13);
            $table->timestamp('updated_time')->nullable();
            $table->string('updated_by', 20)->nullable();
            $table->string('updated_by_ip', 13)->nullable();
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
        Schema::dropIfExists('com_member');
    }
}
