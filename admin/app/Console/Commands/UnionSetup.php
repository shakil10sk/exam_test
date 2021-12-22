<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UnionSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'union:setup';

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
        if(env('UNION_SETUP'))
        {

            echo "Calling migrate fresh \n";
            Artisan::call('migrate:fresh');

            echo "calling sync:table \n";
            Artisan::call('sync:table');

            echo "calling db:seed \n";
            Artisan::call('db:seed -v');
            echo "Please import bd loacation manually\n";
            echo `echo \e[38;5;82mSetup \e[38;5;198mComplete \e[49m`;
            
        }
        else
        {
            echo `echo \e[41munion setup not found.\e[49m \n`;

        }
        

    }
}
