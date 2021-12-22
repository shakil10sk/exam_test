<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IdGenerate extends Model
{
    //this is for all citizen pin generate by there union id
    public function pin($union_id)
    {
        $citizen_id = DB::table('citizen_information')
            ->where('union_id', $union_id)
            ->whereYear('created_time', date('Y'))
            ->count() + 1;

        $citizen_id = ($citizen_id > 0) ? $citizen_id : 1;

        if (strlen($citizen_id) < 6) {
            $citizen_id = str_repeat(0, (6 - strlen($citizen_id))) . $citizen_id;
        }

        if (strlen($union_id) < 7) {
            $union_id = str_repeat(0, (7 - strlen($union_id))) . $union_id;
        }

        $pin = date("y") . $union_id . $citizen_id;

        return $pin;
    }

    //this is for tracking id generate for all application

    public  function tracking($union_id = null, $fiscal_year_id = null, $type = null)
    {

        $application_id = DB::table('application')
            ->where(['union_id' => $union_id, 'fiscal_year_id' => $fiscal_year_id, 'type' => $type])
            // ->whereYear('created_time', date('Y'))
            ->count() + 1;

        if (strlen($application_id) < 6) {

            $tracking = str_repeat(0, (6 - strlen($application_id))) . $application_id;
        }

        if (strlen($type) < 2) {

            $type_glue = str_repeat(0, (2 - strlen($type))) . $type;
        } else {

            $type_glue = $type;
        }

        $tracking = date('y') . $type_glue . $tracking;

        return $tracking;
    }

    //===this for all sonod no generate===//

    public function sonod_no_generate($union_id = null, $type = null)
    {
        $sonod_serial = DB::table('certificate')
            ->where(['union_id' => $union_id, 'type' => $type])
            ->count() + 1;

        if (strlen($sonod_serial) < 6) {

            $sonod_glue = str_repeat(0, (6 - strlen($sonod_serial))) . $sonod_serial;
        }



        if (strlen($type) < 2) {
            $type_glue = str_repeat(0, (2 - strlen($type))) . $type;
        } else {
            $type_glue = $type;
        }

        $sonod_no = date('Y') . $union_id . $type_glue . $sonod_glue;

        return $sonod_no;
    }


    //for all voucher number genereate

    public static function voucher($union_id = null, $fiscal_year_id = null,$type = 3)
    {
        //  determine the certificate generate policy
        // 1 = Direct
        // 2 = Generate invoice + pending for payment
        // $policy = DB::table("settings")->where("options", "trade_generate")->get()->first();

        // // if no settings found then go through policy No.1
        // if ($policy == NULL) {
        //     $policy = new stdClass();
        //     $policy->value = 1;
        // }

        $voucher_no = 0;

        // if($policy->value == 1){
        //     $query = DB::table('acc_transaction')
        //         ->select('voucher')
        //         ->where([
        //             ['union_id', $union_id],
        //             ['fiscal_year_id', $fiscal_year_id],
        //         ])
        //         ->orderBy('id', 'DESC')
        //         ->limit(1)
        //         ->first();

        //     if (!empty($query)) {
        //         $voucher =  (int)substr($query->voucher, 2);
        //     }
        // }

        // else if ($policy->value == 2) {    // invoice generate and pending for payment
        //     $query = DB::table('acc_voucher')
        //         ->select('voucher_id')
        //         ->where([
        //             ['union_id', $union_id],
        //             ['fiscal_year_id', $fiscal_year_id],
        //         ])
        //         ->orderBy('id', 'DESC')
        //         ->limit(1)
        //         ->first();

        //     if (!empty($query)) {
        //         $voucher =  (int)substr($query->voucher_id, 2);
        //     }
        // }

        $fiscal_year = DB::table("fiscal_years")
            ->where("id", $fiscal_year_id)
            ->select("name")
            ->get()
            ->first();

        // dd($fiscal_year);

        $year = date("y");

        if(!empty($fiscal_year)){
            $year = substr($fiscal_year->name, 2, 2);
        }

        $query = DB::table('acc_invoice')
            ->select('voucher_no')
            ->where([
                'union_id' => $union_id,
                // 'fiscal_year_id' => $fiscal_year_id,
                'type' => $type
            ])
            ->where("voucher_no", "LIKE", "$year%")
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->first();

        // dd($query);

        if (!empty($query)) {
            $voucher_no =  (int)substr($query->voucher_no, 2);
        }

        $voucher_no++;

        $voucher = $year . (string)str_repeat(0, (6 - strlen($voucher_no))) . $voucher_no;

        return $voucher;
    }


    //generate union employee id
    public static function employee_id($union_id = NULL, $union_last_id = NULL)
    {

        //get employee serial
        $emplyee_serial = DB::table('users')
            ->where(['union_id' => $union_id])
            ->count() + 1;

        if (strlen($emplyee_serial) < 3) {

            //create employee serial 3 digit
            $employee_glue = str_repeat(0, (3 - strlen($emplyee_serial))) . $emplyee_serial;
        }

        if (strlen($union_last_id) < 4) {

            //create union primary id 4 digit
            $union_last_id = str_repeat(0, (4 - strlen($union_last_id))) . $union_last_id;
        }

        //create complete employee id
        $employee_id = date('y') . $union_last_id . $employee_glue;

        return $employee_id;
    }
}
