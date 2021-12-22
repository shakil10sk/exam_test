<?php

namespace App\Console\Commands;

use App\Http\Controllers\Sync\WebSyncController;
use Illuminate\Console\Command;

class SyncWeb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:web';

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
        // WebSyncController::syncBdLocation();
        // WebSyncController::syncUnionInformation();
        // WebSyncController::syncEmployees();
        // WebSyncController::syncAllowance();

        // WebSyncController::syncBusinessType();
        // WebSyncController::syncFiscalYear();
        // WebSyncController::syncNotice();
        // WebSyncController::syncSlides();
        (new WebSyncController)->syncWeb();



    }
}
