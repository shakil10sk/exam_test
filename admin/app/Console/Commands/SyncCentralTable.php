<?php

namespace App\Console\Commands;

use App\Http\Controllers\Sync\SyncCentralController;
use Illuminate\Console\Command;
use App\Http\Controllers\SyncController;

class SyncCentralTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:central-regular';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync centeral table counts';

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
        (new SyncController)->syncCentralRegular();
        (new SyncCentralController())->syncCentral();
    }
}
