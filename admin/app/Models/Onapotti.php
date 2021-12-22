<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use Image;

class Onapotti extends Model
{

    protected $table = 'onapotti';

    protected $fillable = ['union_id', 'tracking', 'pin', 'type', 'name_en', 'name_bn', 'father_name_en', 'father_name_bn', 'organization_name_en', 'organization_name_bn', 'organization_location_en', 'organization_location_bn', 'organization_type_en', 'organization_type_bn', 'trade_license_no', 'gender', 'resident', 'permanent_village_en', 'permanent_village_bn', 'permanent_rbs_en', 'permanent_rbs_bn', 'permanent_holding_no', 'permanent_ward_no', 'permanent_district_id', 'permanent_upazila_id', 'permanent_postoffice_id', 'office_village_en', 'office_village_bn', 'office_rbs_en', 'office_rbs_bn', 'office_holding_no', 'office_ward_no', 'office_district_id', 'office_upazila_id', 'office_postoffice_id', 'moja', 'khotian_no', 'thana', 'dag_no', 'district', 'land_type', 'land_amount', 'created_by_ip', 'updated_by_ip'];

    public function data_store($request)
    {
// if address is new
        if(empty($request->present_district_id)){
            $request->present_district_id = $this->findLocation($request->present_district_txt, null, 2);
        }

        if(empty($request->present_upazila_id)){
            $request->present_upazila_id = $this->findLocation($request->present_upazila_txt, $request->present_district_id, 3);
        }

        if(empty($request->present_postoffice_id)){
            $request->present_postoffice_id = $this->findLocation($request->present_postoffice_txt, $request->present_upazila_id, 6);
        }

        if(empty($request->permanent_district_id)){
            $request->permanent_district_id = $this->findLocation($request->permanent_district_txt, null, 2);
        }

        if(empty($request->permanent_upazila_id)){
            $request->permanent_upazila_id = $this->findLocation($request->permanent_upazila_txt, $request->permanent_district_id, 3);
        }

        if(empty($request->permanent_postoffice_id)){
            $request->permanent_postoffice_id = $this->findLocation($request->permanent_postoffice_txt, $request->permanent_upazila_id, 6);
        }
        // dd($request);
        // if ($request['old_ctz'] == false) {
            $onapotti_data = [

                'pin'                   => $request->pin,
                'union_id'              => $request->union_id,
                'tracking'              => $request->tracking,
                'type'                  => $request->type,
                'fiscal_year_id'        => $request->fiscal_year_id,

                'present_village_bn'    => $request->present_village_bn,
                'present_village_en'    => $request->present_village_en,
                'present_rbs_bn'        => $request->present_rbs_bn,
                'present_rbs_en'        => $request->present_rbs_en,
                'present_holding_no'    => $request->present_holding_no,
                'present_ward_no'       => $request->present_ward_no,
                'present_district_id'   => $request->present_district_id,
                'present_upazila_id'    => $request->present_upazila_id,
                'present_postoffice_id' => $request->present_postoffice_id,

                'created_by'            => $request->created_by,
                'created_by_ip'         => $request->created_by_ip,
            ];
        // }

        DB::transaction(function () use ($request, $onapotti_data) {

            Onapotti::create((array)$request);

            Application::create($onapotti_data);
        });

        return ["status" => "success", "message" => "আপনার পিন নং $request->pin এবং ট্র্যাকিং নং $request->tracking"];
    }

    public function onapotti_information($tracking, $union_id, $type)
    {
        // dd($tracking, $union_id, $type);
        $data = DB::table('application AS APP')

            ->select('APP.*', 'ONA.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name')

            ->join('onapotti AS ONA', function ($join) use ($union_id) {

                $join->on("ONA.pin", "=", "APP.pin")

                    ->on("ONA.union_id", "=", "APP.union_id")
                    ->where("ONA.union_id", "=", $union_id);
            })
            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'ONA.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'ONA.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'ONA.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current',1)->first()->id],
            ])
            ->first();



        return $data;
    }

        //===onapotti edit data=======//
        public function onapotti_data($tracking, $union_id = null)
        {

            DB::enableQueryLog();

            $data = DB::table('application AS APP')

                ->select('APP.*', 'APP.id as application_id', 'ONPT.*', 'ONPT.id as onapotti_id', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'BDL7.bn_name as office_district_name_bn', 'BDL7.en_name as office_district_name_en', 'BDL8.bn_name as office_upazila_name_bn', 'BDL8.en_name as office_upazila_name_en', 'BDL9.bn_name as office_postoffice_name_bn', 'BDL9.en_name as office_postoffice_name_en')

                ->join('onapotti AS ONPT', function ($join) {

                $join->on("ONPT.pin", "=", "APP.pin")

                    ->on("ONPT.union_id", "=", "APP.union_id");

                })



                //for permanent address
                ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'ONPT.permanent_district_id')
                ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'ONPT.permanent_upazila_id')
                ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'ONPT.permanent_postoffice_id')

                //for present address
                ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
                ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
                ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

                 //for office address
                 ->join('bd_locations AS BDL7', 'BDL7.id', '=', 'ONPT.office_district_id')
                 ->join('bd_locations AS BDL8', 'BDL8.id', '=', 'ONPT.office_upazila_id')
                 ->join('bd_locations AS BDL9', 'BDL9.id', '=', 'ONPT.office_postoffice_id')

                ->where([
                    ['APP.tracking', '=', $tracking],
                    ['APP.union_id', '=', $union_id],
                    ['ONPT.union_id', '=', $union_id],
                    ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current',1)->first()->id],

                ])
                ->first();


            return $data;

        }


        //===onapotti sonod generate=====//

        public function sonod_generate($receive)
        {

            //ready certificate data
            $sonod_data = [

                'pin'                   => $receive->pin,
                'sonod_no'              => $receive->sonod_no,
                'tracking'              => $receive->tracking,
                'type'                  => $receive->type,
                'status'                  => $receive->status,
                'fiscal_year_id'           => $receive->fiscal_year_id,
                'union_id'              => $receive->union_id,
                'district_id'   => $receive->district_id,
                'upazila_id'    => $receive->upazila_id,

                'created_by'            => Auth::user()->employee_id,
                'created_time'          => $receive->generate_date.' '.date('h:i:s'),
                'created_by_ip'         => Request::ip(),

            ];

            $invoice_id = BillGenerate::generateID();
            $voucher_no =  IdGenerate::voucher($receive->union_id, $receive->fiscal_year_id, 13);

            // ready invoice data //
            $invoice_data = [
                'union_id' => $receive->union_id,
                'invoice_id' => $invoice_id,
                'voucher_no' => $voucher_no,
                'sonod_no' => $receive->sonod_no,
                'fiscal_year_id' => $receive->fiscal_year_id,
                'amount' =>  $receive->fee,
                'is_paid' => 1,
                'payment_date' =>$receive->generate_date . ' ' . date('h:i:s'),
                'type' =>  13,
                'created_by' => Auth::user()->employee_id,
                'created_at' => Carbon::now(),
                'created_by_ip' => \request()->ip()
            ];


            //ready transection data
            $transaction_data = [

                'union_id' => $receive->union_id,
                'fiscal_year_id' => $receive->fiscal_year_id,
                'voucher' => $voucher_no,
                'sonod_no' => $receive->sonod_no,
                'amount' => $receive->fee,
                'debit' => null,
                'credit' => $receive->debit_id,
                'type' => $receive->type,
                'created_by'            => Auth::user()->employee_id,
                'created_time'          => $receive->generate_date.' '.date('h:i:s'),
                'created_by_ip'         => Request::ip(),

            ];


            DB::transaction(function () use ($receive, $sonod_data,$invoice_data, $transaction_data) {

                if ((int)$receive->application_id > 0) {

                    $onapotti_update = DB::table('application')
                    ->where('id', $receive->application_id)
                    ->update(['status' => 1]);

                }


                $sonod_insert = DB::table("certificate")->insert($sonod_data);

                $invoice_insert = DB::table('acc_invoice')->insert($invoice_data);

                $transection_insert = DB::table('acc_transaction')->insert($transaction_data);

            });

            return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে । সনদটি প্রিন্ট করুন.", 'sonod_no' => $receive['sonod_no']];

        }

        //====onapotti certificate data=====//

        public function onapotti_certificate_data($sonod_no = null, $union_id = null, $type = null)
        {

            $data = DB::table('certificate AS CRT')

                    ->join('application AS APP', function($join) use($union_id, $type){

                        $join->on('APP.pin', '=', 'CRT.pin')
                             ->on('APP.tracking', '=', 'CRT.tracking')
                             ->on('APP.type', '=', 'CRT.type')
                             ->on('APP.union_id', '=', 'CRT.union_id')
                             ->where('APP.union_id', '=', $union_id)
                             ->where('APP.type', '=', $type)
                             ->where('APP.is_active', '=', 1);
                    })

                    ->join('onapotti AS ONPT', function($join) use($union_id){

                        $join->on('ONPT.pin', '=', 'CRT.pin')
                             ->on('ONPT.pin', '=', 'APP.pin')
                             ->on('ONPT.union_id', '=', 'APP.union_id')
                             ->where('ONPT.union_id', '=', $union_id)
                             ->where('ONPT.is_active', '=', 1);
                    })



                    //for permanent address
                    ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'ONPT.permanent_district_id')
                    ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'ONPT.permanent_upazila_id')
                    ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'ONPT.permanent_postoffice_id')

                    //for present address
                    ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
                    ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
                    ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

                    ->select('ONPT.*', 'APP.created_time as onapotti_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id','APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'APP.type')


                    ->where([
                        ['CRT.sonod_no', '=', $sonod_no],
                        ['CRT.is_active', '=', '1'],
                        ['CRT.union_id', '=', $union_id],
                        ['CRT.type', '=', $type],
                        ['APP.type', '=', $type],
                        ['APP.union_id', '=', $union_id],
                    ])
                    ->orderBy('CRT.id', 'DESC')
                    ->first();



              return $data;


        }

        //======onapotti update====//

        public function update_onapotti($receive)
        {

            $application_data = [

                'present_village_bn'    => $receive->present_village_bn,
                'present_village_en'    => $receive->present_village_en,
                'present_rbs_bn'        => $receive->present_rbs_bn,
                'present_rbs_en'        => $receive->present_rbs_en,
                'present_holding_no'    => $receive->present_holding_no,
                'present_ward_no'       => $receive->present_ward_no,
                'present_district_id'   => $receive->present_district_id,
                'present_upazila_id'    => $receive->present_upazila_id,
                'present_postoffice_id' => $receive->present_postoffice_id,

                'updated_time'            => date('Y-m-d h:i:s'),
                'updated_by'            => Auth::user()->employee_id,
                'updated_by_ip'         => Request::ip(),
            ];

            $onapotti_data = [

                'name_en'    => $receive->name_en,
                'name_bn'    => $receive->name_bn,
                'father_name_en'    => $receive->father_name_en,
                'father_name_bn'    => $receive->father_name_bn,
                'organization_name_en'        => $receive->organization_name_en,
                'organization_name_bn'        => $receive->organization_name_bn,
                'organization_location_en'    => $receive->organization_location_en,
                'organization_location_bn'       => $receive->organization_location_bn,
                'organization_type_en'   => $receive->organization_type_en,
                'organization_type_bn'    => $receive->organization_type_bn,
                'trade_license_no' => $receive->trade_license_no,

                'gender' => $receive->gender,
                'resident' => $receive->resident,
                'permanent_village_en' => $receive->permanent_village_en,
                'permanent_village_bn' => $receive->permanent_village_bn,
                'permanent_rbs_en' => $receive->permanent_rbs_en,
                'permanent_rbs_bn' => $receive->permanent_rbs_bn,
                'permanent_holding_no' => $receive->permanent_holding_no,
                'permanent_ward_no' => $receive->permanent_ward_no,
                'permanent_district_id' => $receive->permanent_district_id,
                'permanent_upazila_id' => $receive->permanent_upazila_id,
                'permanent_postoffice_id' => $receive->permanent_postoffice_id,
                'office_village_en' => $receive->office_village_en,
                'office_village_bn' => $receive->office_village_bn,

                'office_rbs_en' => $receive->office_rbs_en,
                'office_rbs_bn' => $receive->office_rbs_bn,
                'office_holding_no' => $receive->office_holding_no,
                'office_ward_no' => $receive->office_ward_no,
                'office_district_id' => $receive->office_district_id,
                'office_upazila_id' => $receive->office_upazila_id,
                'office_postoffice_id' => $receive->office_postoffice_id,
                'moja' => $receive->moja,
                'khotian_no' => $receive->khotian_no,
                'thana' => $receive->thana,
                'dag_no' => $receive->dag_no,
                'district' => $receive->district,
                'land_type' => $receive->land_type,
                'land_amount' => $receive->land_amount,

                'updated_time'            => date('Y-m-d h:i:s'),
                'updated_by'            => Auth::user()->employee_id,
                'updated_by_ip'         => Request::ip(),
            ];


            DB::transaction(function () use ($receive, $onapotti_data, $application_data) {



                Onapotti::where('id',$receive->onapotti_id)->update($onapotti_data);

                $application_update = DB::table("application")
                ->where('id', $receive->application_id)
                ->update($application_data);


            });

            return true;

        }

        //===onapotti info delete===//
        public function onapotti_info_delete($request)
        {
            $delete = DB::table('onapotti')
            ->where('id',$request->deleteId)
            ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);
            if ($delete) {
                return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
            }else{
                return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
            }
        }

        //===onapotti applicant list data=====//

public function onapotti_applicant_list_data($receive, $search_content)
{
    DB::enableQueryLog();

    $query = DB::table('application AS APP')

        ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.pin', 'APP.tracking', 'ONPT.id as citizen_id', 'ONPT.name_bn',   'ONPT.father_name_bn',   'ONPT.union_id', 'ONPT.permanent_district_id', 'ONPT.permanent_upazila_id', 'ONPT.permanent_postoffice_id', 'APP.created_time')

        ->join('onapotti AS ONPT', function ($join) use($receive) {
            $join->on("ONPT.pin", "=", "APP.pin")
                 ->on("ONPT.union_id", "=", "APP.union_id")
                 ->where("APP.type", $receive['type'])
                 ->where("APP.fiscal_year_id", $receive['fiscal_year_id']);
        })

        ->where([
            ['APP.union_id', '=', $receive['union_id']],
            ['ONPT.union_id', '=', $receive['union_id']],
            ['APP.type', '=', $receive['type']],
            ['APP.status', '=', 0],
            ['ONPT.is_active', '=', 1],
            ['APP.is_active', '=', 1],
            ['APP.fiscal_year_id', '=', $receive['fiscal_year_id']],
        ])

        ->whereDate('APP.created_time', '>=', $receive['from_date'])
        ->whereDate('APP.created_time', '<=', $receive['to_date'])

        ->offset($receive['start'])
        ->limit($receive['limit'])
        ->orderBy('APP.id', 'DESC');


    //for searching on page
    if($search_content != false){
        $query->where(function ($query) use ($search_content) {
            return $query->Where("APP.tracking", "LIKE", $search_content)
                ->orWhere("ONPT.mobile", "LIKE", $search_content)
                ->orWhere("APP.pin", "LIKE", $search_content)
                ->orWhere("ONPT.name_bn", "LIKE", "%".$search_content."%");
        });
    }

    $data['data'] = $query->get();

    return $data;
}


//====onapotti certificate list data====//
public function onapotti_certificate_list($receive, $search_content)
{
    DB::enableQueryLog();

    $query = DB::table('certificate AS CRT')

        ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no') , 'CRT.type','CRT.id', 'CRT.pin', 'CRT.tracking', 'ONPT.id as citizen_id', 'ONPT.name_bn',   'ONPT.father_name_bn',   'ONPT.union_id', 'ONPT.permanent_district_id', 'ONPT.permanent_upazila_id', 'ONPT.permanent_postoffice_id', 'CRT.created_time as generate_date')

        // ->join(DB::raw("(SELECT MAX(id) as id FROM certificate where type = '$receive[type]' GROUP BY sonod_no) last_updates"), function ($join) {
        //     $join->on("last_updates.id", "=", "CRT.id");
        // })

        ->join('onapotti AS ONPT', function ($join) use($receive) {
            $join->on("ONPT.pin", "=", "CRT.pin")
                 ->on("ONPT.union_id", "=", "CRT.union_id")
                 ->where("CRT.type", $receive['type'])
                 ->where("CRT.fiscal_year_id", $receive['fiscal_year_id']);
        })

        ->where([
            ['CRT.union_id', '=', $receive['union_id']],
            ['ONPT.union_id', '=', $receive['union_id']],
            ['CRT.type', '=', $receive['type']],
            ['ONPT.is_active', '=', 1],
            ['CRT.is_active', '=', 1],
            ['CRT.fiscal_year_id', '=', $receive['fiscal_year_id']],
        ])

        ->whereDate('CRT.created_time', '>=', $receive['from_date'])
        ->whereDate('CRT.created_time', '<=', $receive['to_date'])

        ->offset($receive['start'])
        ->limit($receive['limit'])
        ->orderBy('CRT.created_time', 'DESC');

    //for searching on page
    if($search_content != false){

        $query->where(function ($query) use ($search_content) {

            return $query->Where("CRT.tracking", "LIKE", $search_content)
                ->orWhere("CRT.sonod_no", "LIKE", $search_content)
                ->orWhere("ONPT.pin", "LIKE", $search_content)
                ->orWhere("ONPT.mobile", "LIKE", $search_content)
                ->orWhere("ONPT.name_bn", "LIKE", "%".$search_content."%");
        });

    }

    $data['data'] = $query->get();

    // Log::info($data);

    return $data;

}


        //money receipt data

        public function money_receipt_data($sonod_no = null, $union_id = null, $type = null){


            $query = DB::table('onapotti AS ONPT')

                ->join('certificate AS CRT', function($join) use($sonod_no, $union_id, $type ){

                    $join->on('ONPT.pin', '=', 'CRT.pin')
                          ->on('ONPT.union_id', '=', 'CRT.union_id')
                          ->where('ONPT.union_id', '=', $union_id)
                          ->where('CRT.union_id', '=', $union_id)
                          ->where('CRT.type', '=', $type);
                })

                ->join('acc_transaction AS TRNS', function($join) use($sonod_no, $union_id){
                    $join->on('TRNS.union_id', '=', 'CRT.union_id')
                            ->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                            ->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                            ->on('TRNS.type', '=', 'CRT.type')
                            ->where('TRNS.sonod_no', '=', $sonod_no)
                            ->where('TRNS.union_id', '=', $union_id);
                })

                ->select('ONPT.name_bn', 'ONPT.father_name_bn', 'ONPT.pin', 'ONPT.permanent_village_bn', 'ONPT.permanent_ward_no', 'CRT.sonod_no', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time')

                ->where([
                    'ONPT.union_id' => $union_id,
                    'TRNS.sonod_no' => $sonod_no,
                    'TRNS.union_id' => $union_id,
                    'TRNS.type' => $type,
                    'CRT.sonod_no' => $sonod_no,
                    'CRT.union_id' => $union_id,
                    'CRT.type' => $type,
                ])
                ->orderBy('TRNS.id', 'DESC')
                ->first();

            return $query;

        }


        //get onapotti register data

        public function onapotti_register_data($union_id = null, $type = null, $from_date = null, $to_date = null){

            $query = DB::table('certificate AS CRT')

                ->join('acc_transaction AS TRNS', function($join) use($union_id, $type){

                    $join->on('TRNS.union_id', '=', 'CRT.union_id')
                          ->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                          ->on('TRNS.type', '=', 'CRT.type')
                          ->where('TRNS.is_active', '=', 1)
                          ->where('TRNS.union_id', '=', $union_id)
                          ->where('CRT.type', '=', $type)
                          ->where('TRNS.type', '=', $type);
                })

                ->join('onapotti AS ONPT', function($join) use($union_id){
                    $join->on('ONPT.union_id', '=', 'CRT.union_id')
                         ->on('ONPT.pin', '=', 'CRT.pin')
                         ->where('ONPT.union_id', '=', $union_id);
                })

                ->select('ONPT.name_bn', 'ONPT.father_name_bn', 'ONPT.pin', 'ONPT.permanent_ward_no', 'ONPT.permanent_village_bn', 'CRT.sonod_no', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time')

                ->whereDate('CRT.created_time', '>=', $from_date)
                ->whereDate('CRT.created_time', '<=', $to_date)

                ->where([
                    'ONPT.union_id' => $union_id,
                    'TRNS.union_id' => $union_id,
                    'TRNS.type' => $type,
                    'CRT.union_id' => $union_id,
                    'CRT.type' => $type,
                    'CRT.is_active' => 1,

                ])
                ->groupBy('TRNS.voucher')
                ->get();


            return $query;

        }

        public function findLocation($name, $parent_id, $type)
    {
        $data = DB::table("bd_locations")
                    ->where(function($q) use($name){
                        $q->where("en_name", "like", "%{$name}%")
                            ->orWhere("bn_name", "like", "%{$name}%");
                    })
                    ->where("type", $type)
                    ->where("parent_id", $parent_id)
                    ->get();

        $count = $data->count();

        // if found, then return id
        if($count){
            return $data->first()->id;
        }

        // if not found, then save new one
        return $this->saveLocation($name, $parent_id, $type);
    }

    public function saveLocation($name, $parent_id, $type)
    {
        $id = DB::table("bd_locations")->insertGetId([
            "parent_id" => $parent_id,
            "en_name" => $name,
            "bn_name" => $name,
            "type" => $type
        ]);

        return $id;
    }

}
