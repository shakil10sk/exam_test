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

        // ------------------ fiscale year ----------------------
        if (!Schema::hasColumn('fiscal_years', 'expire_date')) {
            echo "<h1>fiscal_years - add expire_date in column</h1> \n";

            Schema::table('fiscal_years', function (Blueprint $table) {
                $table->date('expire_date')->default(date('Y-06-30'))->after('is_active');
            });
        }
        
        // name unique key
        $column_def = DB::select(DB::raw('SHOW COLUMNS FROM fiscal_years WHERE FIELD = "name";'))[0];
        if(! $column_def->Key)
        {
            echo "<h1>fiscal_years - adding name as unique key</h1> \n";

            Schema::table('fiscal_years', function (Blueprint $table) {
                $table->unique('name');
            });
        }

        echo "<h1>All Done !!!</h1> \n";
    }
}
