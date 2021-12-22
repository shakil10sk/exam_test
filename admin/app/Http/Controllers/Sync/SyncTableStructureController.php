<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use Exception;
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
            echo "<h1>users - Changeing union_id medium int to int(11)</h1>\n";
            foreach ($all_tables as $item) {

                DB::statement('ALTER TABLE '. $item->tbl .' MODIFY `'.$item->col.'` INT(11) NOT NULL;');
            }
        }
        


        // ------------------ citizen_information  ----------------------
        
        $column_def = DB::select(DB::raw('SHOW COLUMNS FROM citizen_information WHERE FIELD = "passport_no";'))[0];
        if (strpos($column_def->Type, 'varchar') === false) {
            echo "<h1>citizen_information - modifed to passport_no column varchar</h1> \n";

            DB::statement('ALTER TABLE citizen_information MODIFY `passport_no` varchar(100) NULL ;');
        }

        // ------------------ citizen_optional_info  ----------------------

        if (!Schema::hasColumn('citizen_optional_info', 'death_date')) {

            echo "<h1>citizen_optional_info - adding death_date coloumn</h1> \n";

            Schema::table('citizen_optional_info', function (Blueprint $table) {

                $table->date('death_date')->nullable()->after('type');
            });
            
        }
        

        // ---------------------- users ------------------------
        
        $keys = DB::select(DB::raw('SHOW KEYS from users'));

        $have_unique = 0;
        foreach($keys as $item)
        {
            if($item->Column_name == 'email')
            {
                Schema::table('users', function (Blueprint $table) use($item) {
                    $table->dropUnique($item->Key_name);
                });

                echo "<h1>users - Drop email unique key</h1>\n";
                break;
            }

            if ($item->Column_name == 'username') {
                $have_unique = 1;
            }
        }

        if (!$have_unique) {
            echo "<h1>users - Add username as unique key</h1>\n";
            
            Schema::table('users', function (Blueprint $table) {
                $table->unique('username');
            });
        }

        // ------------------- emoployee -----------------------
        
        // Add employee_id as unique key
        $column_def = DB::select(DB::raw('SHOW COLUMNS FROM employees WHERE FIELD = "employee_id";'))[0];
        if(!$column_def->Key)
        {
            echo "<h1>employees - Add employee_id as unique key</h1>\n";
            Schema::table('employees', function (Blueprint $table) {
                $table->unique('employee_id');
            });
        }

        // ------------------ fiscale year ----------------------
        if (!Schema::hasColumn('fiscal_years', 'expire_date')) {
            echo "<h1>fiscal_years - add expire_date column</h1> \n";

            Schema::table('fiscal_years', function (Blueprint $table) {
                $table->date('expire_date')->default(date('Y-06-30'))->after('is_process');
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

        // ------------------ acc transaction ----------------------

        $column_def = DB::select(DB::raw('SHOW COLUMNS FROM acc_transaction WHERE FIELD = "type";'))[0];
        if (strpos($column_def->Type, 'mediumint') === false) {
            echo "<h1>acc_transaction - modifed to type column mid int</h1> \n";

            DB::statement('ALTER TABLE acc_transaction MODIFY `type` MEDIUMINT NOT NULL DEFAULT 0;');
        }


        // ------------------ comment update ----------------------
        echo "<h1>application - modifed comment column</h1> \n";
        DB::statement(
            'ALTER TABLE application 
            MODIFY `comment_bn` TEXT NULL,
            MODIFY `comment_en` TEXT NULL;'
        );
        
        

        // ------------------ allowance_log -----------------------------
        if (!Schema::hasTable('allowance_logs')) {
            echo "<h1>Creating allowance_logs table</h1> \n";

            Schema::create('allowance_logs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('allowance_id');
                $table->integer('union_id');
                $table->string('name',200);
                $table->date('allowance_date');
                $table->tinyInteger('type');
                $table->tinyInteger('is_active');
                $table->text('description')->nullable();
                
                $table->dateTime('deleted_at')->nullable();

                $table->string('created_by',50);
                $table->string('created_by_ip',15);
                
                $table->string('updated_by',50)->nullable();
                $table->string('updated_by_ip',15)->nullable();
                
                $table->timestamps();
            });
        }

        // ------------------ roles ----------------------
        if (!Schema::hasColumn('roles', 'created_by')) {
            echo "<h1>roles - add created_by column</h1> \n";

            Schema::table('roles', function (Blueprint $table) {
                $table->integer('created_by');
            });
        }

        echo "<h1>All Done !!!</h1> \n";
    }
}
