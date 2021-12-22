<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldingNamjariInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holding_namjari_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('union_id');
            $table->bigInteger('pin')->nullable();
            $table->bigInteger('tracking');
            $table->string('former_owner_bn', 50);
            $table->string('former_owner_en', 50)->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->string('former_owner_father_name_en', 50)->nullable();
            $table->string('former_owner_father_name_bn', 50);
            $table->string('former_owner_mother_name_en', 50)->nullable();
            $table->string('former_owner_mother_name_bn', 50);
            $table->string('trimasik_tax', 20);
            $table->string('yearly_rate', 20);
            $table->string('yealry_tax_amount', 20)->nullable();
            $table->string('last_assesment_date', 10);
            $table->string('holding_no', 30);
            $table->string('current_holding_no', 50)->nullable();
            $table->string('bhumi_moja_no', 50);
            $table->string('khotian_no', 30);
            $table->string('dag_no', 30);
            $table->string('land_amount', 50);
            $table->string('dolil_datar_name', 50)->nullable();
            $table->string('dolil_no', 50)->nullable();
            $table->string('reg_office_name', 50)->nullable();
            $table->date('reg_date')->nullable();
            $table->string('dolil_hold_no', 50)->nullable();
            $table->string('bohuthola_dalan', 50)->nullable();
            $table->string('ekthola_dalan', 50)->nullable();
            $table->string('ada_faka_ghor', 50)->nullable();
            $table->string('kaca_ghor', 50)->nullable();
            $table->string('latrin_no', 50)->nullable();
            $table->string('jhol_tap_no', 50)->nullable();
            $table->string('tubewel_no', 50)->nullable();
            $table->string('dokan_no', 50)->nullable();
            $table->string('family_no', 50)->nullable();
            $table->string('conditions', 100)->nullable();
            $table->string('monthly_rant_rate', 50)->nullable();
            $table->date('rant_last_date')->nullable();
            $table->string('applicant_other_info',100)->nullable();
            $table->string('govt_rent_no',50)->nullable();
            $table->string('malikana',20)->nullable();
            $table->boolean('is_active')->default('1');
            $table->boolean('is_process')->default(0);
            $table->integer('fiscal_year_id');
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('holding_namjari_info');
    }
}
