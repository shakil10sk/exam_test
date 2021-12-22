<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncTableStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:table-structure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
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
