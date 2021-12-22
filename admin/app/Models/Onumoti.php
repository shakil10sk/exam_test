<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use Image;
class Onumoti extends Model
{
    use SoftDeletes;

    //====onumoti application store====//
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

        if ($request['old_ctz'] == false) {
            $citizen_data = [
                "pin"                     => $request->pin,
                "nid"                     => $request->nid,
                "birth_id"                => $request->birth_id,
                "passport_no"             => $request->passport_no,
                'name_en'                 => $request->name_en,
                'name_bn'                 => $request->name_bn,
                'birth_date'              => $request->birth_date,
                'father_name_bn'          => $request->father_name_bn,
                'father_name_en'          => $request->father_name_en,
                'mother_name_bn'          => $request->mother_name_bn,
                'mother_name_en'          => $request->mother_name_en,
                'resident'                => $request->resident,
                'occupation'              => $request->occupation,
                'religion'                => $request->religion,
                'gender'                  => $request->gender,

                'marital_status'          => $request->marital_status,

                'educational_qualification' => $request->educational_qualification,
                'union_id'                => $request->union_id,
                'permanent_village_bn'    => $request->permanent_village_bn,
                'permanent_village_en'    => $request->permanent_village_en,
                'permanent_rbs_bn'        => $request->permanent_rbs_bn,
                'permanent_rbs_en'        => $request->permanent_rbs_en,
                'permanent_ward_no'       => $request->permanent_ward_no,
                'permanent_holding_no'    => $request->permanent_holding_no,
                'permanent_district_id'   => $request->permanent_district_id,
                'permanent_upazila_id'    => $request->permanent_upazila_id,
                'permanent_postoffice_id' => $request->permanent_postoffice_id,
                'mobile'                  => $request->mobile,
                'email'                   => $request->email,

                'created_by'              => $request->created_by,
                'created_time'            => Carbon::now(),
                'created_by_ip'           => $request->ip()
            ];

            //wife name push in array
            if ($request->gender == 1 && $request->marital_status == 2 )
            {
                $citizen_data['wife_name_en'] = $request->wife_name_en;
                $citizen_data['wife_name_bn'] = $request->wife_name_bn;
            }//husband name push in array
            elseif ($request->gender == 2 && $request->marital_status == 2)
            {
                $citizen_data['husband_name_en'] = $request->husband_name_en;
                $citizen_data['husband_name_bn'] = $request->husband_name_bn;
            }

            if ($request->hasFile("photo")) {
                //insert image
                $image = $request->file("photo");

                $img = $request->pin.".".$image->getClientOriginalExtension();

                $location = public_path("assets/images/application/".$img);

                //upload image in folder
                $move = Image::make($image)->resize(300, 300)->save($location);

                if ($move) {
                    $citizen_data['photo'] = $img;
                }

            }
        }

        //application data create
        $application_data = [
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

            'comment_bn'            => $request->comment_bn,
            'comment_en'            => $request->comment_en,

            'created_by'              => $request->created_by,
            'created_time'            => Carbon::now(),
            'created_by_ip'           => $request->ip()
        ];


        //db transection start
       DB::transaction(function () use ($request, $citizen_data, $application_data) {

            if($request->old_ctz){
                //insert citizen information
                $citizen_data['updated_by'] = $citizen_data['created_by'];
                $citizen_data['updated_time'] = $citizen_data['created_time'];
                $citizen_data['updated_by_ip'] = $citizen_data['created_by_ip'];

                unset($citizen_data['created_by'], $citizen_data['created_time'], $citizen_data['created_by_ip']);

                DB::table("citizen_information")->where("pin", $request->pin)->update($citizen_data);
            } else {
                // insert citizen information
                DB::table("citizen_information")->insert($citizen_data);
            }

            //application table data insert
            $application_insert = DB::table("application")->insert($application_data);

            $application_id = DB::getPdo()->lastInsertId();

            $citizen_extra_info = [
                'pin'              => $request->pin,
                'tracking'         => $request->tracking,
                'application_id'   => $application_id,
                'union_id'         => $request->union_id,
                'name_one'         => $request->job_sector_en,
                'name_two'         => $request->job_sector_bn,
                'type'             => $request->type,
                'created_by'       => $request->created_by,
                'created_time'     => Carbon::now(),
                'created_by_ip'    => $request->ip()
            ];

            $citizen_optional_info_insert = DB::table("citizen_optional_info")->insert($citizen_extra_info);

        });

        return ["status" => "success", "message" => "আপনার পিন নং $request->pin এবং ট্র্যাকিং নং $request->tracking"];

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

    public static function webApplication($request)
    {
        $applicationData = [
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

            'comment_bn'            => $request->comment_bn,
            'comment_en'            => $request->comment_en,

            'created_by'            => $request->created_by,
            'created_time'          => Carbon::now(),
            'created_by_ip'         => $request->ip(),
        ];

        $citizenData = [
            'marital_status' => $request->marital_status,
            'updated_by' => $request->created_by,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $request->ip()
        ];

        //wife name push in array
        if ($request->gender == 1 && $request->marital_status == 2 )
        {
            $citizenData['wife_name_en'] = $request->wife_name_en;
            $citizenData['wife_name_bn'] = $request->wife_name_bn;
        }//husband name push in array
        elseif ($request->gender == 2 && $request->marital_status == 2)
        {
            $citizenData['husband_name_en'] = $request->husband_name_en;
            $citizenData['husband_name_bn'] = $request->husband_name_bn;
        }

        if ($request->hasFile("photo")) {
            $image  = $request->file("photo");
            $img    = $request->pin.".".$image->getClientOriginalExtension();
            $move   = Image::make($image)->resize(300, 300)->save(public_path("assets/images/application/".$img), 100);
            if ($move) {
                $citizenData['photo'] = $img;
            }

        }

        //db transection start
       DB::transaction(function () use ($request, $applicationData, $citizenData) {
        $citizenExtraInfo = [
            'pin'              => $request->pin,
            'tracking'         => $request->tracking,
            'union_id'         => $request->union_id,
            'name_one'    	   => $request->job_sector_en,
            'name_two'    	   => $request->job_sector_bn,
            'type'        	   => $request->type,
            'created_by'       => $request->created_by,
            'created_time'     => Carbon::now(),
            'created_by_ip'    => $request->ip(),

        ];
            $res = DB::table("application")->insertGetId($applicationData);
            $citizenExtraInfo['application_id'] = $res;
            $res = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);
            $res = DB::table("citizen_optional_info")->insert($citizenExtraInfo);
        });
        return true;
    }


    //onumoti preview data
    public function onumoti_information($tracking = null, $union_id = null, $type = null)
    {

        DB::enableQueryLog();

        $data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'OPTINF.name_one as job_sector_en', 'OPTINF.name_two as job_sector_bn')

            ->join('citizen_information AS CTZ', function ($join) use($union_id) {

                $join->on("CTZ.pin", "=", "APP.pin")

                ->on("CTZ.union_id", "=", "APP.union_id")
                ->where("CTZ.union_id", "=", $union_id)
                ->where("APP.union_id", "=", $union_id);
            })

             ->join('citizen_optional_info AS OPTINF', function ($join) {

                $join->on("OPTINF.pin", "=", "APP.pin")

                ->on("OPTINF.tracking", "=", "APP.tracking")
                ->on("OPTINF.union_id", "=", "APP.union_id")
                ->on("OPTINF.application_id", "=", "APP.id");
            })


            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

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

    //===onumoti edit data=======//
    public function onumoti_data($tracking, $union_id = null)
    {

        DB::enableQueryLog();

        $data = DB::table('application AS APP')

            ->select('APP.*', 'APP.id as application_id', 'CTZ.*', 'CTZ.id as citizen_id', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'OPTINF.name_one as job_sector_en', 'OPTINF.name_two as job_sector_bn')

            ->join('citizen_information AS CTZ', function ($join) {

            $join->on("CTZ.pin", "=", "APP.pin")

                ->on("CTZ.union_id", "=", "APP.union_id");

            })

             ->join('citizen_optional_info AS OPTINF', function ($join) {

                $join->on("OPTINF.pin", "=", "APP.pin")

                ->on("OPTINF.tracking", "=", "APP.tracking")
                ->on("OPTINF.union_id", "=", "APP.union_id")
                ->on("OPTINF.application_id", "=", "APP.id");
            })

            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['CTZ.union_id', '=', $union_id],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current',1)->first()->id],

            ])
            ->first();


        return $data;

    }


    //===onumoti sonod generate=====//

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
        $voucher_no =  IdGenerate::voucher($receive->union_id, $receive->fiscal_year_id, 27);

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
            'type' =>  27,
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

                $application_update = DB::table('application')
                ->where('id', $receive->application_id)
                ->update(['status' => 1]);

            }


            $sonod_insert = DB::table("certificate")->insert($sonod_data);

            $invoice_insert = DB::table('acc_invoice')->insert($invoice_data);

            $transection_insert = DB::table('acc_transaction')->insert($transaction_data);

        });

        return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে । সনদটি প্রিন্ট করুন.", 'sonod_no' => $receive['sonod_no']];

    }

    //====onumoti certificate data=====//

    public function onumoti_certificate_data($sonod_no = null, $union_id = null, $type = null)
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

                ->join('citizen_information AS CTZ', function($join) use($union_id){

                    $join->on('CTZ.pin', '=', 'CRT.pin')
                         ->on('CTZ.pin', '=', 'APP.pin')
                         ->on('CTZ.union_id', '=', 'APP.union_id')
                         ->where('CTZ.union_id', '=', $union_id)
                         ->where('CTZ.is_active', '=', 1);
                })


                ->join('citizen_optional_info AS OPTINF', function ($join) use($union_id, $type) {

                    $join->on("OPTINF.pin", "=", "APP.pin")

                    ->on("OPTINF.tracking", "=", "APP.tracking")
                    ->on("OPTINF.union_id", "=", "APP.union_id")
                    ->on("OPTINF.application_id", "=", "APP.id")
                    ->on("OPTINF.application_id", "=", "APP.id")
                    ->where("OPTINF.type", "=", $type)
                    ->where("OPTINF.union_id", "=", $union_id);
                })

                //for permanent address
                ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
                ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
                ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

                //for present address
                ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
                ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
                ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

                ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id','APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'OPTINF.name_one as job_sector_en', 'OPTINF.name_two as job_sector_bn', 'APP.type')


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

    //======onumoti update====//

    public function update_onumoti($receive)
    {

        $citizen_update_data = [

            "nid"                     => $receive->nid,
            "birth_id"                => $receive->birth_id,
            "passport_no"             => $receive->passport_no,
            'name_en'                 => $receive->name_en,
            'name_bn'                 => $receive->name_bn,
            'birth_date'              => $receive->birth_date,
            'father_name_bn'          => $receive->father_name_bn,
            'father_name_en'          => $receive->father_name_en,
            'mother_name_bn'          => $receive->mother_name_bn,
            'mother_name_en'          => $receive->mother_name_en,
            'resident'                => $receive->resident,
            'occupation'              => $receive->occupation,
            'religion'                => $receive->religion,
            'gender'                  => $receive->gender,

            'marital_status'          => $receive->marital_status,

            'educational_qualification' => $receive->educational_qualification,
            'permanent_village_bn'    => $receive->permanent_village_bn,
            'permanent_village_en'    => $receive->permanent_village_en,
            'permanent_rbs_bn'        => $receive->permanent_rbs_bn,
            'permanent_rbs_en'        => $receive->permanent_rbs_en,
            'permanent_ward_no'       => $receive->permanent_ward_no,
            'permanent_holding_no'    => $receive->permanent_holding_no,
            'permanent_district_id'   => $receive->permanent_district_id,
            'permanent_upazila_id'    => $receive->permanent_upazila_id,
            'permanent_postoffice_id' => $receive->permanent_postoffice_id,
            'mobile'                  => $receive->mobile,
            'email'                   => $receive->email,


            'updated_by'              => Auth::user()->employee_id,
            'updated_time'            => Carbon::now(),
            'updated_by_ip'           => Request::ip(),

        ];

        if ($receive->gender == 1 && $receive->marital_status == 2 )
        {
            $citizen_update_data['wife_name_en'] = $receive->wife_name_en;
            $citizen_update_data['wife_name_bn'] = $receive->wife_name_bn;
        }
        elseif ($receive->gender == 2 && $receive->marital_status == 2)
        {
            $citizen_update_data['husband_name_en'] = $receive->husband_name_en;
            $citizen_update_data['husband_name_bn'] = $receive->husband_name_bn;
        }


        if ($receive->hasFile("photo")) {
            //insert image
            $image = $receive->file("photo");

            $img = $receive->pin.".".$image->getClientOriginalExtension();

            //upload image in folder
            $move = Image::make($image)->resize(300, 300)->save(public_path("assets/images/application/".$img));

            if ($move) {
                $citizen_update_data['photo'] = $img;
            }
        }


        $application_update_data = [


            'present_village_bn'    => $receive->present_village_bn,
            'present_village_en'    => $receive->present_village_en,
            'present_rbs_bn'        => $receive->present_rbs_bn,
            'present_rbs_en'        => $receive->present_rbs_en,
            'present_holding_no'    => $receive->present_holding_no,
            'present_ward_no'       => $receive->present_ward_no,
            'present_district_id'   => $receive->present_district_id,
            'present_upazila_id'    => $receive->present_upazila_id,
            'present_postoffice_id' => $receive->present_postoffice_id,

            'comment_bn'                  => $receive->comment_bn,
            'comment_en'                  => $receive->comment_en,

            'updated_by'            => Auth::user()->employee_id,
            'updated_time'          => Carbon::now(),
            'updated_by_ip'         => Request::ip(),

        ];


        DB::transaction(function () use ($receive, $citizen_update_data, $application_update_data) {

            $citizen_update = DB::table("citizen_information")
            ->where('id', $receive->citizen_id)
            ->update($citizen_update_data);

            $application_update = DB::table("application")
            ->where('id', $receive->application_id)
            ->update($application_update_data);


            $citizen_extra_info_update = [

                'name_one'      => $receive->job_sector_en,
                'name_two'      => $receive->job_sector_bn,
                'updated_by'            => Auth::User()->id,
                'updated_time'          => Carbon::now(),
                'updated_by_ip'         => Request::ip(),

            ];


            $citizen_optional_info_update = DB::table("citizen_optional_info")
            ->where('application_id', $receive->application_id)
            ->update($citizen_extra_info_update);

        });

        return true;

    }

    //===onumoti info delete===//
    public function onumoti_info_delete($request)
    {
        $delete = DB::table('application')
        ->where('id',$request->deleteId)
        ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);
        if ($delete) {
            return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
        }else{
            return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
        }
    }

    //===onumoti applicant list data=====//

    public function onumoti_applicant_list_data($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('application AS APP')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.pin', 'APP.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'APP.created_time')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "APP.pin")
                     ->on("CTZ.union_id", "=", "APP.union_id")
                     ->where("APP.type", $receive['type'])
                     ->where("APP.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->where([
                ['APP.union_id', '=', $receive['union_id']],
                ['CTZ.union_id', '=', $receive['union_id']],
                ['APP.type', '=', $receive['type']],
                ['APP.status', '=', 0],
                ['CTZ.is_active', '=', 1],
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
                    ->orWhere("CTZ.mobile", "LIKE", $search_content)
                    ->orWhere("APP.pin", "LIKE", $search_content)
                    ->orWhere("CTZ.name_bn", "LIKE", "%".$search_content."%");
            });
        }

        $data['data'] = $query->get();

        return $data;
    }


    //====onumoti certificate list data====//
    public function onumoti_certificate_list($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no') , 'CRT.type','CRT.id', 'CRT.pin', 'CRT.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'CRT.created_time as generate_date')

            // ->join(DB::raw("(SELECT MAX(id) as id FROM certificate where type = '$receive[type]' GROUP BY sonod_no) last_updates"), function ($join) {
            //     $join->on("last_updates.id", "=", "CRT.id");
            // })

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "CRT.pin")
                     ->on("CTZ.union_id", "=", "CRT.union_id")
                     ->where("CRT.type", $receive['type'])
                     ->where("CRT.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->where([
                ['CRT.union_id', '=', $receive['union_id']],
                ['CTZ.union_id', '=', $receive['union_id']],
                ['CRT.type', '=', $receive['type']],
                ['CTZ.is_active', '=', 1],
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
                    ->orWhere("CTZ.pin", "LIKE", $search_content)
                    ->orWhere("CTZ.mobile", "LIKE", $search_content)
                    ->orWhere("CTZ.name_bn", "LIKE", "%".$search_content."%");
            });

        }

        $data['data'] = $query->get();

        // Log::info($data);

        return $data;

    }


    //money receipt data

    public function money_receipt_data($sonod_no = null, $union_id = null, $type = null){


        $query = DB::table('citizen_information AS CTZ')

            ->join('certificate AS CRT', function($join) use($sonod_no, $union_id, $type ){

                $join->on('CTZ.pin', '=', 'CRT.pin')
                      ->on('CTZ.union_id', '=', 'CRT.union_id')
                      ->where('CTZ.union_id', '=', $union_id)
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

            ->select('CTZ.name_bn', 'CTZ.father_name_bn', 'CTZ.pin', 'CTZ.permanent_village_bn', 'CTZ.permanent_ward_no', 'CRT.sonod_no', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time')

            ->where([
                'CTZ.union_id' => $union_id,
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


    //get onumoti register data

    public function onumoti_register_data($union_id = null, $type = null, $from_date = null, $to_date = null){

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

            ->join('citizen_information AS CTZ', function($join) use($union_id){
                $join->on('CTZ.union_id', '=', 'CRT.union_id')
                     ->on('CTZ.pin', '=', 'CRT.pin')
                     ->where('CTZ.union_id', '=', $union_id);
            })

            ->select('CTZ.name_bn', 'CTZ.father_name_bn', 'CTZ.pin', 'CTZ.permanent_ward_no', 'CTZ.permanent_village_bn', 'CRT.sonod_no', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time')

            ->whereDate('CRT.created_time', '>=', $from_date)
            ->whereDate('CRT.created_time', '<=', $to_date)

            ->where([
                'CTZ.union_id' => $union_id,
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

}
