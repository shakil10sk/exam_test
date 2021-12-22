<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->nullable();
            $table->integer('union_id');
            $table->integer('role_id')->nullable();;

            $table->tinyInteger('type')->comment('1 = chairman, 2 = secretery, 3 = udc, 4 = computer operator, 5 = ward member, 6 = village police');
            $table->tinyInteger('status')->default(1);

            $table->string('name',255);
            $table->string('username',100)->unique();
            $table->string('password',255);

            $table->string('email',100)->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();;

            $table->string('created_by_ip',15);
            $table->string('updated_by_ip',15)->nullable();;
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
