<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePublicServiceTableColumnsDefaultZero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public_services', function (Blueprint $table) {
            $table->integer('trade_app')->nullable()->default('0')->change();
            $table->integer('trade_certi')->nullable()->default('0')->change();
            $table->integer('warish_app')->nullable()->default('0')->change();
            $table->integer('warish_certi')->nullable()->default('0')->change();
            $table->integer('family_app')->nullable()->default('0')->change();
            $table->integer('family_certi')->nullable()->default('0')->change();
            $table->integer('death_app')->nullable()->default('0')->change();
            $table->integer('death_certi')->nullable()->default('0')->change();
            $table->integer('nagorik_app')->nullable()->default('0')->change();
            $table->integer('nagorik_certi')->nullable()->default('0')->change();
            $table->integer('unmarried_app')->nullable()->default('0')->change();
            $table->integer('unmarried_certi')->nullable()->default('0')->change();
            $table->integer('married_app')->nullable()->default('0')->change();
            $table->integer('married_certi')->nullable()->default('0')->change();
            $table->integer('character_app')->nullable()->default('0')->change();
            $table->integer('character_certi')->nullable()->default('0')->change();
            $table->integer('punobibaho_app')->nullable()->default('0')->change();
            $table->integer('punobibaho_certi')->nullable()->default('0')->change();
            $table->integer('same_name_app')->nullable()->default('0')->change();
            $table->integer('same_name_certi')->nullable()->default('0')->change();
            $table->integer('sonaton_app')->nullable()->default('0')->change();
            $table->integer('sonaton_certi')->nullable()->default('0')->change();
            $table->integer('prottyon_app')->nullable()->default('0')->change();
            $table->integer('prottyon_certi')->nullable()->default('0')->change();
            $table->integer('nodibanga_app')->nullable()->default('0')->change();
            $table->integer('nodibanga_certi')->nullable()->default('0')->change();
            $table->integer('yearly_income_app')->nullable()->default('0')->change();
            $table->integer('yearly_income_certi')->nullable()->default('0')->change();
            $table->integer('vumihin_app')->nullable()->default('0')->change();
            $table->integer('vumihin_certi')->nullable()->default('0')->change();
            $table->integer('protibondi_app')->nullable()->default('0')->change();
            $table->integer('protibondi_certi')->nullable()->default('0')->change();
            $table->integer('onumoti_app')->nullable()->default('0')->change();
            $table->integer('onumoti_certi')->nullable()->default('0')->change();
            $table->integer('voter_transper_app')->nullable()->default('0')->change();
            $table->integer('voter_transper_certi')->nullable()->default('0')->change();
            $table->integer('onapotti_app')->nullable()->default('0')->change();
            $table->integer('onapotti_certi')->nullable()->default('0')->change();
            $table->integer('road_cutting_app')->nullable()->default('0')->change();
            $table->integer('road_cutting_certi')->nullable()->default('0')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
