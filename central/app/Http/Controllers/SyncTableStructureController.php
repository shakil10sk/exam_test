<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SyncTableStructureController extends Controller
{
    public function handle()
    {

        // ---------------------- Global / all -------------------------

        // changeing union_id medium int to int(11)

        $select_query = 
        'SELECT TABLE_NAME as tbl, COLUMN_NAME as col, data_type   
        FROM  INFORMATION_SCHEMA.COLUMNS 
        WHERE (COLUMN_name = "union_id" OR  COLUMN_name = "union_code") AND data_type="mediumint" AND table_schema = "'.env('DB_DATABASE').'";';

        $all_tables = DB::select(DB::raw($select_query));
        if(count($all_tables??[]))
        {
            echo "<h1>users - Drop email unique key</h1>\n";
        }
        foreach ($all_tables as $item) {

            DB::statement('ALTER TABLE '. $item->tbl .' MODIFY `'.$item->col.'` INT(11) NOT NULL;');
        }

        // ----------------- remove upazila and district ----------------

        // ----------------- employees --------------------
        if (Schema::hasColumn('employees', 'district_id')) {
            echo "\nemployees district upazila id drop\n";

            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('district_id');
            });
        }
        if (Schema::hasColumn('employees', 'upazila_id')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }
        if (Schema::hasColumn('employees', 'is_process')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('is_process');
            });
        }

        if (Schema::hasColumn('allowances', 'district_id')) {
            echo "\nAllownace district upazila id drop\n";

            Schema::table('allowances', function (Blueprint $table) {
                $table->dropColumn('district_id');
            });
        }
        if (Schema::hasColumn('allowances', 'upazila_id')) {
            Schema::table('allowances', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }

        if (Schema::hasColumn('attendance', 'upazila_id')) {
            echo "\nattendance district upazila id drop\n";

            Schema::table('attendance', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }
        
        if (Schema::hasColumn('public_services', 'district_id')) {
            echo "\npublic_services district upazila id drop\n";

            Schema::table('public_services', function (Blueprint $table) {
                $table->dropColumn('district_id');
            });
        }
        if (Schema::hasColumn('public_services', 'upazila_id')) {
            Schema::table('public_services', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }
        
        if (Schema::hasColumn('asset_register', 'district_id')) {
            echo "\nasset_register district upazila id drop\n";

            Schema::table('asset_register', function (Blueprint $table) {
                $table->dropColumn('district_id');
            });
        }
        if (Schema::hasColumn('asset_register', 'upazila_id')) {
            Schema::table('asset_register', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }
        
        if (Schema::hasColumn('letters', 'upazila_id')) {
            echo "\nletters district upazila id drop\n";

            Schema::table('letters', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }

        if (Schema::hasColumn('reports', 'upazila_id')) {
            echo "\nreports district upazila id drop\n";

            Schema::table('reports', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }

        if (Schema::hasColumn('projects', 'upazila_id')) {
            echo "\nprojects district upazila id drop\n";

            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('upazila_id');
            });
        }

        // ------------------ union information --------------------

        $keys = DB::select(DB::raw('SHOW KEYS from union_information'));
        $have_unique = 0;
        foreach ($keys as $item) {
            if ($item->Column_name == 'sub_domain') {
                $have_unique = 1;
            }
        }

        if(!$have_unique)
        {
            echo "<h1>union_information - add sub_domain as unique</h1> \n";
            Schema::table('union_information', function (Blueprint $table) {
                $table->unique('sub_domain');
            });
        }

        // village_bn column nullable
        $column_def = DB::select(DB::raw('SHOW COLUMNS FROM union_information WHERE FIELD = "village_bn";'))[0];
        if(strtoupper($column_def->Null) == "NO")
        {
            echo "<h1>union_information - modifed village_bn column nullable</h1> \n";
            DB::statement('ALTER TABLE union_information MODIFY `village_bn` VARCHAR(50) NULL;');
        }

        // renaming is_header_active to pre_select
        if (!Schema::hasColumn('union_information', 'pre_select'))
        {
            echo "<h1>union_information - adding pre_select coloumn</h1> \n";
            DB::statement('ALTER TABLE `union_information` ADD COLUMN `pre_select` TINYINT(1) NULL DEFAULT "0" AFTER `jolchap`;');
        }

        // ------------------- public_services ------------------
        // $table->integer('trade_app')->nullable()->default('0')->change();
        // $table->integer('trade_certi')->nullable()->default('0')->change();
        // $table->integer('warish_app')->nullable()->default('0')->change();
        // $table->integer('warish_certi')->nullable()->default('0')->change();
        // $table->integer('family_app')->nullable()->default('0')->change();
        // $table->integer('family_certi')->nullable()->default('0')->change();
        // $table->integer('death_app')->nullable()->default('0')->change();
        // $table->integer('death_certi')->nullable()->default('0')->change();
        // $table->integer('nagorik_app')->nullable()->default('0')->change();
        // $table->integer('nagorik_certi')->nullable()->default('0')->change();
        // $table->integer('unmarried_app')->nullable()->default('0')->change();
        // $table->integer('unmarried_certi')->nullable()->default('0')->change();
        // $table->integer('married_app')->nullable()->default('0')->change();
        // $table->integer('married_certi')->nullable()->default('0')->change();
        // $table->integer('character_app')->nullable()->default('0')->change();
        // $table->integer('character_certi')->nullable()->default('0')->change();
        // $table->integer('punobibaho_app')->nullable()->default('0')->change();
        // $table->integer('punobibaho_certi')->nullable()->default('0')->change();
        // $table->integer('same_name_app')->nullable()->default('0')->change();
        // $table->integer('same_name_certi')->nullable()->default('0')->change();
        // $table->integer('sonaton_app')->nullable()->default('0')->change();
        // $table->integer('sonaton_certi')->nullable()->default('0')->change();
        // $table->integer('prottyon_app')->nullable()->default('0')->change();
        // $table->integer('prottyon_certi')->nullable()->default('0')->change();
        // $table->integer('nodibanga_app')->nullable()->default('0')->change();
        // $table->integer('nodibanga_certi')->nullable()->default('0')->change();
        // $table->integer('yearly_income_app')->nullable()->default('0')->change();
        // $table->integer('yearly_income_certi')->nullable()->default('0')->change();
        // $table->integer('vumihin_app')->nullable()->default('0')->change();
        // $table->integer('vumihin_certi')->nullable()->default('0')->change();
        // $table->integer('protibondi_app')->nullable()->default('0')->change();
        // $table->integer('protibondi_certi')->nullable()->default('0')->change();
        // $table->integer('onumoti_app')->nullable()->default('0')->change();
        // $table->integer('onumoti_certi')->nullable()->default('0')->change();
        // $table->integer('voter_transper_app')->nullable()->default('0')->change();
        // $table->integer('voter_transper_certi')->nullable()->default('0')->change();
        // $table->integer('onapotti_app')->nullable()->default('0')->change();
        // $table->integer('onapotti_certi')->nullable()->default('0')->change();
        // $table->integer('road_cutting_app')->nullable()->default('0')->change();
        // $table->integer('road_cutting_certi')->nullable()->default('0')->change();
        echo "\n<h1>All Done !!!</h1>\n";


    }
}
