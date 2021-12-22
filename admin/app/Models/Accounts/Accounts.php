<?php

namespace App\Models\Accounts;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use App\Models\Global_model;



class Accounts extends Model
{

	//daily all collection report data

	public function daily_all_collection_report_data($union_id = null, $from_date =null, $to_date = null){


        $collection_data = DB::table('acc_transaction AS TRNS')

            ->select('ACC.account_name', 'ACC.acc_type as account_type', 'TRNS.amount', 'TRNS.sonod_no', 'TRNS.voucher', 'TRNS.created_time as payment_date')


            ->join('acc_account AS ACC', function ($join) use($union_id){

                $join->on('ACC.id', '=', 'TRNS.credit')
                    ->on('ACC.union_id', '=', 'TRNS.union_id')
                    ->where('ACC.is_active', 1)
                    ->where('TRNS.credit', '!=', 28)
                    ->where('ACC.union_id', $union_id);
            })

            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)

            ->groupBy('TRNS.voucher')
            ->orderBy('TRNS.created_time', 'ASC')

            ->get();


        return $collection_data;


    }
    
    public function daily_deposit_expense_report_data($union_id = null, $from_date =null, $to_date = null){

        $fund_transfer_data = DB::table('acc_transaction AS TRNS')

            ->select('ACCRDT.account_name as credit_account_name', 'ACDEBT.account_name as debit_account_name', 'ACCRDT.acc_type as credit_account_type', 'ACDEBT.acc_type as debit_account_type', 'TRNS.amount', 'TRNS.sonod_no', 'TRNS.voucher', 'TRNS.created_time as payment_date')


            ->join('acc_account AS ACCRDT', function ($join) use($union_id){

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('TRNS.credit', '!=', 28)
                    ->where('ACCRDT.union_id', $union_id);
            })

            ->join('acc_account AS ACDEBT', function ($join) use($union_id){

                $join->on('ACDEBT.id', '=', 'TRNS.debit')
                    ->on('ACDEBT.union_id', '=', 'TRNS.union_id')
                    ->where('ACDEBT.is_active', 1)
                    ->where('TRNS.debit', '!=', 28)
                    ->where('ACDEBT.union_id', $union_id);
            })

            ->where('TRNS.balance_type', 3)
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)

            ->groupBy('TRNS.voucher')
            ->orderBy('TRNS.created_time', 'ASC')

            ->get();

        // dd($collection_data);


        return $fund_transfer_data;


	}

    //get assesment existing data
    public function get_assesment_exist_data($receive){

        $query = DB::table('citizen_information As CTZ')

            ->leftjoin('assesment_info as ASES', function($join){
                $join->on('ASES.union_id', '=', 'CTZ.union_id')
                    ->on('ASES.pin', '=', 'CTZ.pin');
            })

            ->join('bd_locations AS LOC1','CTZ.permanent_district_id', '=','LOC1.id')
            ->join('bd_locations AS LOC2','CTZ.permanent_upazila_id', '=','LOC2.id')
            ->join('bd_locations AS LOC3','CTZ.permanent_postoffice_id', '=', 'LOC3.id')

            ->select('CTZ.*', 'ASES.pin as assesment_pin',

            'LOC1.id AS permanent_district_id',
            'LOC2.id AS permanent_upazila_id',
            'LOC3.id AS permanent_postoffice_id',

            'LOC1.en_name AS permanent_district_name_en',
            'LOC2.en_name AS permanent_upazila_name_en',
            'LOC3.en_name AS permanent_postoffice_name_en',

            'LOC1.bn_name AS permanent_district_name_bn',
            'LOC2.bn_name AS permanent_upazila_name_bn',
            'LOC3.bn_name AS permanent_postoffice_name_bn'
            )
            ->where([
                ['CTZ.union_id', '=', Auth::user()->union_id],
                ['CTZ.is_active', '=', 1],

            ]);

            $query->where(function ($query) use ($receive) {
                return $query->where("CTZ.nid", "=", $receive)
                    ->orWhere("CTZ.passport_no", "=", $receive)
                    ->orWhere("CTZ.birth_id", "=", $receive)
                    ->orWhere("CTZ.pin", "=", $receive);
            });

            return $query->first();
    }

    //assesment store

    public function assesment_store($receive){


        
            $citizen_data = [

                "pin"                     => $receive->pin,
                "nid"                     => $receive->nid,
                "birth_id"                => $receive->birth_id,
                "passport_no"             => $receive->passport_no,
                'name_bn'                 => $receive->name_bn,
                'birth_date'              => $receive->birth_date,
                'father_name_bn'          => $receive->father_name_bn,
                'mother_name_bn'          => $receive->mother_name_bn,
                'resident'                => $receive->resident,
                'occupation'              => $receive->occupation,
                'religion'                => $receive->religion,
                'gender'                  => $receive->gender,
                'marital_status'          => $receive->marital_status,
                'educational_qualification' => $receive->educational_qualification,
                'union_id'                => $receive->union_id,
                'permanent_village_bn'    => $receive->permanent_village_bn,
                'permanent_rbs_bn'        => $receive->permanent_rbs_bn,
                'permanent_ward_no'       => $receive->permanent_ward_no,
                'permanent_holding_no'    => $receive->permanent_holding_no,
                'permanent_district_id'   => $receive->permanent_district_id,
                'permanent_upazila_id'    => $receive->permanent_upazila_id,
                'permanent_postoffice_id' => $receive->permanent_postoffice_id,
                'mobile'                  => $receive->mobile,

                'created_by'              => Auth::user()->employee_id,
                'created_time'            => Carbon::now(),
                'created_by_ip'           => Request::ip(),

            ];

            //wife name push in array
            if ($receive->gender == 1 && $receive->marital_status == 2 )
            {
                $citizen_data['wife_name_en'] = $receive->wife_name_en;
                $citizen_data['wife_name_bn'] = $receive->wife_name_bn;
            }//husband name push in array
            elseif ($receive->gender == 2 && $receive->marital_status == 2)
            {
                $citizen_data['husband_name_en'] = $receive->husband_name_en;
                $citizen_data['husband_name_bn'] = $receive->husband_name_bn;
            }
        
        


        //assesment data ready

        $assesment_data = [

            'pin' => $receive->pin,
            'union_id' => $receive->union_id,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'total_male' => $receive->male,
            'total_female' => $receive->female,
            'ripe_house' => $receive->ripe_house,
            'semi_ripe_house' => $receive->semi_ripe_house,
            'raw_house' => $receive->raw_house,
            'probable_rate' => $receive->probable_rate,
            'halson_tax' => $receive->halson_tax,

            'created_by'              => Auth::user()->employee_id,
            'created_time'            => Carbon::now(),
            'created_by_ip'           => Request::ip(),
        ];


        DB::transaction(function () use ($receive, $citizen_data, $assesment_data) {

            if (!isset($receive->citizen_exist )) {

                $citizen_insert = DB::table("citizen_information")->insert($citizen_data);
            }

            $assesment_insert = DB::table('assesment_info')->insert($assesment_data);


        });

        return ["status" => "success", "message" => "আপনার এসেসমেন্ট টি গৃহিত হয়েছে ।"];        

    }

    //get assesment edit data

    public function assesment_data($pin = null, $union_id = null){

        $query = DB::table('citizen_information as CTZ')
                
                ->join('assesment_info AS ASES', function($join) use($union_id, $pin){

                    $join->on('ASES.pin', '=', 'CTZ.pin')
                        ->on('ASES.union_id', '=', 'CTZ.union_id')
                        ->where('ASES.union_id', $union_id)
                        ->where('ASES.pin', $pin);
                })

                 //for permanent address
                ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
                ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
                ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

                ->where('CTZ.pin', $pin)
                ->where('CTZ.union_id', $union_id)
                
                ->select('CTZ.*', 'CTZ.id as citizen_id', 'BDL1.en_name as permanent_district_name_en', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.en_name as permanent_postoffice_name_en', 'ASES.*')
                ->first();

        return $query;
    }

    //assesment update
    public function update_assesment($receive){

         $citizen_data = [

            "nid"                     => $receive->nid,
            "birth_id"                => $receive->birth_id,
            "passport_no"             => $receive->passport_no,
            'name_bn'                 => $receive->name_bn,
            'birth_date'              => $receive->birth_date,
            'father_name_bn'          => $receive->father_name_bn,
            'mother_name_bn'          => $receive->mother_name_bn,
            'resident'                => $receive->resident,
            'occupation'              => $receive->occupation,
            'religion'                => $receive->religion,
            'gender'                  => $receive->gender,
            'marital_status'          => $receive->marital_status,
            'educational_qualification' => $receive->educational_qualification,
            'permanent_village_bn'    => $receive->permanent_village_bn,
            'permanent_rbs_bn'        => $receive->permanent_rbs_bn,
            'permanent_ward_no'       => $receive->permanent_ward_no,
            'permanent_holding_no'    => $receive->permanent_holding_no,
            'permanent_district_id'   => $receive->permanent_district_id,
            'permanent_upazila_id'    => $receive->permanent_upazila_id,
            'permanent_postoffice_id' => $receive->permanent_postoffice_id,
            'mobile'                  => $receive->mobile,

            'updated_by'              => Auth::user()->employee_id,
            'updated_time'            => Carbon::now(),
            'updated_by_ip'           => Request::ip(),

        ];

        //wife name push in array
        if ($receive->gender == 1 && $receive->marital_status == 2 )
        {
            $citizen_data['wife_name_en'] = $receive->wife_name_en;
            $citizen_data['wife_name_bn'] = $receive->wife_name_bn;
        }//husband name push in array
        elseif ($receive->gender == 2 && $receive->marital_status == 2)
        {
            $citizen_data['husband_name_en'] = $receive->husband_name_en;
            $citizen_data['husband_name_bn'] = $receive->husband_name_bn;
        }


        //assesment data ready

        $assesment_data = [

            'total_male' => $receive->male,
            'total_female' => $receive->female,
            'ripe_house' => $receive->ripe_house,
            'semi_ripe_house' => $receive->semi_ripe_house,
            'raw_house' => $receive->raw_house,
            'probable_rate' => $receive->probable_rate,
            'halson_tax' => $receive->halson_tax,

            'updated_by'              => Auth::user()->employee_id,
            'updated_time'            => Carbon::now(),
            'updated_by_ip'           => Request::ip(),
        ];


        DB::transaction(function () use ($receive, $citizen_data, $assesment_data) {


            $citizen_insert = DB::table("citizen_information")->where('pin', $receive->pin)->update($citizen_data);

            $assesment_insert = DB::table('assesment_info')->where('pin', $receive->pin)->update($assesment_data);

        });

        return true;        

    }


    //get assesment list data
    public function assesment_list_data($receive = null, $search_content){

        $union_id = $receive['union_id'];
        $fiscal_year_id = $receive['fiscal_year_id'];
        $ward_no = $receive['ward_no'];
        $holding_no = $receive['holding_no'];

        DB::enableQueryLog();

        $query = DB::table('assesment_info AS ASES')
                
                ->select('CTZ.id', 'CTZ.pin', 'CTZ.name_bn as name', 'CTZ.permanent_holding_no as holding_no', 'CTZ.permanent_ward_no as ward_no', 'ASES.halson_tax', 'ASES.is_paid')
                
                ->join('citizen_information AS CTZ', function($join) use($union_id){
                    $join->on('CTZ.union_id', '=', 'ASES.union_id')
                        ->on('CTZ.pin', '=', 'ASES.pin')
                        ->where('CTZ.union_id', $union_id)
                        ->where('ASES.union_id', $union_id);
                })

               

                ->where(function ($query) use ($fiscal_year_id, $ward_no, $holding_no) {

                    if($fiscal_year_id > 0){
                        $query->Where("ASES.fiscal_year_id", $fiscal_year_id);
                    }
                    if($ward_no > 0){
                        $query->Where("CTZ.permanent_ward_no", '=', $ward_no);
                     }
                    if($holding_no > 0){
                        $query->Where("CTZ.permanent_holding_no", $holding_no);
                    }
                })

                ->offset($receive['start'])
                ->limit($receive['limit'])
                ->orderBy('ASES.id', 'DESC');

                 //for searching on page
                if($search_content != false){

                    $query->where(function ($query) use ($search_content) {

                        return $query->Where("CTZ.permanent_holding_no", "LIKE", $search_content)
                            ->orWhere("CTZ.permanent_ward_no", "LIKE", $search_content)
                            ->orWhere("CTZ.pin", "LIKE", $search_content)
                            ->orWhere("CTZ.name_bn", "LIKE", "%".$search_content."%");
                    });
                }


              $data['data'] = $query->get();

            // dd($data);

            return $data;    
                 
    }

    //home tax save
    public function home_tax_save($receive){

        //this is cash account id
        $cash_account_id = Global_model::get_account_id($receive['union_id'], 26);
        //this is tax account id
        $tax_account_id = Global_model::get_account_id($receive['union_id'], 29);

        $transection_data[] = [

            'sonod_no' => $receive->pin,
            'union_id' => $receive->union_id,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'voucher' => $receive->voucher,
            'debit' => NULL,
            'credit' => $tax_account_id,
            'amount' => $receive->halson_tax,
            'type' => 29,
            'created_by'              => Auth::user()->employee_id,
            'created_time'            => Carbon::now(),
            'created_by_ip'           => Request::ip(),
        ];


        if ($receive->due_tax > 0) {
            
            $transection_data[] = [

                'sonod_no' => $receive->pin,
                'union_id' => $receive->union_id,
                'fiscal_year_id' => $receive->fiscal_year_id,
                'voucher' => $receive->voucher,
                'debit' => NULL,
                'credit' => Global_model::get_account_id($receive['union_id'], 23),
                'amount' => $receive->due_tax,
                'type' => 29,
                'created_by'              => Auth::user()->employee_id,
                'created_time'            => Carbon::now(),
                'created_by_ip'           => Request::ip(),
            ];

        }



        if ($receive->discount > 0) {
            
            $transection_data[] = [

                'sonod_no' => $receive->pin,
                'union_id' => $receive->union_id,
                'fiscal_year_id' => $receive->fiscal_year_id,
                'voucher' => $receive->voucher,
                'debit' => $tax_account_id,
                'credit' => Global_model::get_account_id($receive['union_id'], 24),
                'amount' => $receive->discount,
                'type' => 29,
                'created_by'              => Auth::user()->employee_id,
                'created_time'            => Carbon::now(),
                'created_by_ip'           => Request::ip(),
            ];

        }

        // dd($transection_data);
        // exit;

         DB::transaction(function () use ($receive, $transection_data) {

            $assesment_update = DB::table('assesment_info')->where('pin', $receive['pin'])->update(['is_paid' => 1]);

            $transection_insert = DB::table('acc_transaction')->insert($transection_data);

        });

        return ["status" => "success", "message" => "আপনার বসতভিটার কর সঠিকভাবে আদায় হয়েছে। আপনি রশিদ গ্রহণ করুন", 'pin' => $receive->pin];

    }

    //money receipt data
    public function money_receipt_data($pin = null, $union_id = null, $type = null){


        $query = DB::table('citizen_information AS CTZ')

            ->join('acc_transaction AS TRNS', function($join) use($pin, $union_id){
                $join->on('TRNS.union_id', '=', 'CTZ.union_id')
                        ->on('TRNS.sonod_no', '=', 'CTZ.pin')
                        ->where('TRNS.sonod_no', '=', $pin)
                        ->where('TRNS.union_id', '=', $union_id);
            })

            ->join('acc_account AS ACC', function($join) use($union_id){
                $join->on('ACC.union_id', '=', 'CTZ.union_id')
                        ->on('ACC.id', '=', 'TRNS.credit')
                        ->where('ACC.union_id', '=', $union_id);
            })

            ->select( 'CTZ.name_bn', 'CTZ.father_name_bn', 'CTZ.mother_name_bn', 'CTZ.pin', 'CTZ.permanent_village_bn', 'CTZ.permanent_ward_no', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time', 'ACC.account_name', 'ACC.acc_type')

            ->where([
                'CTZ.union_id' => $union_id, 
                'TRNS.sonod_no' => $pin,
                'TRNS.union_id' => $union_id,
                'TRNS.type' => $type,
            ])
            ->orderBy('TRNS.id', 'ASC')
            ->get();

        // dd($query);

        $data = [];

        foreach($query as $item){

            if(isset($data['pin'])){

                $data["payment_data"][] = [
                    "account_name" => $item->account_name,
                    "amount" => $item->amount,
                    "acc_type" => $item->acc_type,
                ];

            }else{

                $payment_data[] = [
                    "account_name" => $item->account_name,
                    "amount" => $item->amount,
                    "acc_type" => $item->acc_type,
                ];

                $data = [
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "father_name_bn" => $item->father_name_bn,
                    "mother_name_bn" => $item->mother_name_bn,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "voucher" => $item->voucher,
                    "amount" => $item->amount,
                    "created_time" => $item->created_time,
                    "payment_data" => $payment_data
                ];
            }


        }

        // dd($data);

        return $data;

    }

    //get home tax register data
    public function home_tax_register_data($union_id = null, $type = null, $from_date = null, $to_date = null){

        // echo $union_id;exit;

        $register_data = DB::table("acc_transaction AS TRNS")

            ->select('CTZ.name_bn', 'CTZ.father_name_bn', 'CTZ.pin', 'CTZ.permanent_village_bn', 'CTZ.permanent_ward_no', 'CTZ.permanent_holding_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time',  'ACCDBT.account_name as debit_account_name', 'ACCDBT.acc_type as debit_account_type', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')

            ->join('citizen_information AS CTZ', function($join) use($union_id, $type){

                $join->on('TRNS.union_id', '=', 'CTZ.union_id')
                      ->on('TRNS.sonod_no', '=', 'CTZ.pin')
                      ->where('TRNS.is_active', '=', 1)
                      ->where('TRNS.union_id', '=', $union_id);
                      
            })

            ->leftjoin('acc_account AS ACCDBT', function ($join) use($union_id){

                $join->on('ACCDBT.id', '=', 'TRNS.debit')
                    ->on('ACCDBT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCDBT.is_active', 1);
            })

            ->leftJoin('acc_account AS ACCRDT', function ($join) use($union_id){

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1);  
            })

            ->where('TRNS.type', $type)
            ->where('TRNS.union_id', $union_id)

            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();

        // dd($register_data);


        //ready rigister data
        $data = [];

        foreach ($register_data as $item) {

            if(isset($data[$item->voucher])){

                if($item->credit_account_type == 29){
                    $data[$item->voucher]['kor'] = $item->amount;
                }

                if($item->credit_account_type == 23){
                    $data[$item->voucher]['due'] = $item->amount;
                }

                if($item->credit_account_type == 24){
                    $data[$item->voucher]['discount'] = $item->amount;
                }

                

            }else{

                $data[$item->voucher] = [

                    'name_bn' => $item->name_bn,
                    'father_name_bn' => $item->father_name_bn,
                    'permanent_village_bn' => $item->permanent_village_bn,
                    'permanent_ward_no' => $item->permanent_ward_no,
                    'permanent_holding_no' => $item->permanent_holding_no,
                    'voucher' => $item->voucher,
                    'created_time' => $item->created_time,
                    'kor' => ($item->credit_account_type == 29 ) ? $item->amount : 0,
                    'due' => ($item->credit_account_type == 23 ) ? $item->amount : 0,
                    'discount' => ($item->credit_account_type == 24 ) ? $item->amount : 0,
                    
                ];


            }

        }


        return $data;

    }
    

}
