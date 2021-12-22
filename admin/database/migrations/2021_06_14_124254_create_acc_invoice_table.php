<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->bigInteger('invoice_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->integer('year_id');
            $table->integer('month_id');
            $table->decimal('amount', 8, 2);
            $table->tinyInteger('is_paid')->default(0);
            $table->tinyInteger('is_sms_send')->default(0);
            $table->date('payment_date')->nullable();
            $table->date('last_payment_date');
            $table->tinyInteger('type')->default(1);
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
        Schema::dropIfExists('acc_invoice');
    }
}
