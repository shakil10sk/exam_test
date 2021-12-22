<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
{
    public static function SendSms()
    {
        // unsend sms data //
        $sms_data = DB::table('sms')->where('is_process',0)->limit(10)->get();

        // total Sms
        $total_sms = count($sms_data);
        $total_sent = 0;

        $mobile_pattern = "/^(?:\+88|88)?(01[3-9]\d{8})$/";

        foreach ($sms_data as $item ){

            if (empty($item->to_address)){
                DB::table('sms')->where('id',$item->id)->update(['is_process' => 2 ]);
                continue;
            }

            if (!preg_match($mobile_pattern,$item->to_address)){
                DB::table('sms')->where('id',$item->id)->update(['is_process' => 3 ]);
                continue;
            }

            $destination = env('SMS_API')."?key=".env('SMS_KEY')."&username=".env('SMS_USERNAME')."&mobile=$item->to_address&msg=" . urlencode($item->message);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $destination);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            // Sms send successfully //
            if($response == 1){
                $total_sent++;
                DB::table('sms')->where('id',$item->id)->update(['is_process' => 1 ]);

            }





        }

        // output
        echo  "Total SMS data : $total_sms, Total sent SMS : $total_sent";

    }
}
