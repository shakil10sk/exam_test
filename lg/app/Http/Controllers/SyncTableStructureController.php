<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncTableStructureController extends Controller
{
    public function handle()
    {
        // ------------------ fiscale year ----------------------
        echo "fiscal_years - add expire_date column \n";
        if (!Schema::hasColumn('fiscal_years', 'expire_date')) {
            Schema::table('fiscal_years', function (Blueprint $table) {
                $table->date('expire_date')->default(date('Y-06-30'))->after('is_active');
            });
        }
    }
}
