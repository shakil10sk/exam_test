<?php

namespace App\Console\Commands;

use App\Http\Controllers\Sync\SmsController;
use Illuminate\Console\Command;

class SmsSend extends Command
{

    protected $signature = 'Send:Sms';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        SmsController::SendSms();
    }
}
