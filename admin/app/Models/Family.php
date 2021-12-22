<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Request;

class Family extends Model
{

    //====family application store====//
    public function data_store($receive)
    {
        // if address is new
        if(empty($receive->present_district_id)){
            $receive->present_district_id = $this->findLocation($receive->present_district_txt, null, 2);
        }

        if(empty($receive->present_upazila_id)){
            $receive->present_upazila_id = $this->findLocation($receive->present_upazila_txt, $receive->present_district_id, 3);
        }

        if(empty($receive->present_postoffice_id)){
            $receive->present_postoffice_id = $this->findLocation($receive->present_postoffice_txt, $receive->present_upazila_id, 6);
        }

        if(empty($receive->permanent_district_id)){
            $receive->permanent_district_id = $this->findLocation($receive->permanent_district_txt, null, 2);
        }

        if(empty($receive->permanent_upazila_id)){
            $receive->permanent_upazila_id = $this->findLocation($receive->permanent_upazila_txt, $receive->permanent_district_id, 3);
        }

        if(empty($receive->permanent_postoffice_id)){
            $receive->permanent_postoffice_id = $this->findLocation($receive->permanent_postoffice_txt, $receive->permanent_upazila_id, 6);
        }

        //family common data
        if ($receive['old_ctz'] == false) {
            $citizen_data = [
                "pin"                       => $receive->pin,
                "nid"                       => $receive->nid,
                "birth_id"                  => $receive->birth_id,
                "passport_no"               => $receive->passport_no,
                'name_en'                   => $receive->name_en,
                'name_bn'                   => $receive->name_bn,
                'birth_date'                => $receive->birth_date,
                'father_name_bn'            => $receive->father_name_bn,
                'father_name_en'            => $receive->father_name_en,
                'mother_name_bn'            => $receive->mother_name_bn,
                'mother_name_en'            => $receive->mother_name_en,
                'nid'                       => $receive->nid,
                'resident'                  => $receive->resident,
                'occupation'                => $receive->occupation,
                'religion'                  => $receive->religion,
                'gender'                    => $receive->gender,

                'marital_status'            => $receive->marital_status,

                'educational_qualification' => $receive->educational_qualification,
                'union_id'                  => $receive->union_id,
                'permanent_village_bn'      => $receive->permanent_village_bn,
                'permanent_village_en'      => $receive->permanent_village_en,
                'permanent_rbs_bn'          => $receive->permanent_rbs_bn,
                'permanent_rbs_en'          => $receive->permanent_rbs_en,
                'permanent_ward_no'         => $receive->permanent_ward_no,
                'permanent_holding_no'      => $receive->permanent_holding_no,
                'permanent_district_id'     => $receive->permanent_district_id,
                'permanent_upazila_id'      => $receive->permanent_upazila_id,
                'permanent_postoffice_id'   => $receive->permanent_postoffice_id,
                'mobile'                    => null,
                'email'                     => null,

                'created_by'                => $receive->created_by,
                'created_time'              => Carbon::now(),
                'created_by_ip'             => $receive->ip()
            ];

            //wife name push in array
            if ($receive->gender == 1 && $receive->marital_status == 2) {
                $citizen_data['wife_name_en'] = $receive->wife_name_en;
                $citizen_data['wife_name_bn'] = $receive->wife_name_bn;
            } //husband name push in array
            elseif ($receive->gender == 2 && $receive->marital_status == 2) {
                $citizen_data['husband_name_en'] = $receive->husband_name_en;
                $citizen_data['husband_name_bn'] = $receive->husband_name_bn;
            }
        }

        //family application data
        $application_data = [
            'pin'                   => $receive->pin,
            'union_id'              => $receive->union_id,
            'tracking'              => $receive->tracking,
            'type'                  => $receive->type,
            'fiscal_year_id'        => $receive->fiscal_year_id,
            'present_village_bn'    => $receive->present_village_bn,
            'present_village_en'    => $receive->present_village_en,
            'present_rbs_bn'        => $receive->present_rbs_bn,
            'present_rbs_en'        => $receive->present_rbs_en,
            'present_holding_no'    => $receive->present_holding_no,
            'present_ward_no'       => $receive->present_ward_no,
            'present_district_id'   => $receive->present_district_id,
            'present_upazila_id'    => $receive->present_upazila_id,
            'present_postoffice_id' => $receive->present_postoffice_id,
            'comment_bn'            => null,
            'comment_en'            => null,

            'created_by'                => $receive->created_by,
            'created_time'              => Carbon::now(),
            'created_by_ip'             => $receive->ip()
        ];

        //family applicant data
        $applicant_data = Family::applicantData($receive);

        //family list data
        $family_list = Family::familyList($receive);

        // dd($family_list);

        DB::transaction(function () use ($receive, $citizen_data, $application_data, $applicant_data, $family_list) {

            if($receive->old_ctz){
                //insert citizen information
                $citizen_data['updated_by'] = $citizen_data['created_by'];
                $citizen_data['updated_time'] = $citizen_data['created_time'];
                $citizen_data['updated_by_ip'] = $citizen_data['created_by_ip'];

                unset($citizen_data['created_by'], $citizen_data['created_time'], $citizen_data['created_by_ip']);

                DB::table("citizen_information")->where("pin", $receive->pin)->update($citizen_data);
            } else {
                // insert citizen information
                DB::table("citizen_information")->insert($citizen_data);
            }

            $application_insert = DB::table("application")->insert($application_data);

            $applicant_insert = DB::table("warish_family_applicant_info")->insert($applicant_data);

            $family_insert = DB::table("member_list")->insert($family_list);
        });

        return ["status" => "success", "message" => "আপনার আবেদনটি গৃহীত হয়েছে। আপনার পিন নং $receive->pin এবং ট্র্যাকিং নং $receive->tracking"];
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

            'comment_bn'            => null,
            'comment_en'            => null,

            'created_by'            => $request->created_by,
            'created_time'          => Carbon::now(),
            'created_by_ip'         => $request->ip(),
        ];

        $citizenData = [
            'marital_status'    => $request->marital_status,
            'updated_by'        => $request->created_by,
            'updated_time'      => Carbon::now(),
            'updated_by_ip'     => $request->ip()
        ];

        //family applicant data
        $applicantData = Family::applicantData($request);

        //family list data
        $familyList = Family::familyList($request);

        //wife name push in array
        if ($request->gender == 1 && $request->marital_status == 2) {
            $citizenData['wife_name_en'] = $request->wife_name_en;
            $citizenData['wife_name_bn'] = $request->wife_name_bn;
        } //husband name push in array
        elseif ($request->gender == 2 && $request->marital_status == 2) {
            $citizenData['husband_name_en'] = $request->husband_name_en;
            $citizenData['husband_name_bn'] = $request->husband_name_bn;
        }

        //db transection start
        DB::transaction(function () use ($request, $applicationData, $citizenData, $applicantData, $familyList) {
            $res             = DB::table("application")->insert($applicationData);
            $citizn          = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);
            $applicantInsert = DB::table("warish_family_applicant_info")->insert($applicantData);
            $warishInsert    = DB::table("member_list")->insert($familyList);
        });
        return true;
    }

    //family applicant data
    public static function applicantData($request)
    {
        return [
            'pin'            => $request->pin,
            'union_id'       => $request->union_id,
            'tracking'       => $request->tracking,
            'type'           => $request->type,
            'is_father_alive'   => $request->is_father_alive,
            'is_mother_alive'   => $request->is_mother_alive,

            'name_bn'        => $request->applicant_name_bn,
            'name_en'        => $request->applicant_name_en,
            'father_name_bn' => $request->applicant_father_name_bn,
            'father_name_en' => $request->applicant_father_name_en,
            'mobile'         => $request->applicant_mobile,
            'email'          => $request->applicant_email,

            'created_by'                => $request->created_by,
            'created_time'              => Carbon::now(),
            'created_by_ip'             => $request->ip(),

        ];
    }

    //family list data
    public static function familyList($request)
    {
        $warishList = [];

        for ($i = 0; $i < count($request->warish_name_bn); $i++) {

            if(!empty($request->warish_name_bn[$i])){
                $warishList[] = [
                    'pin'           => $request->pin,
                    'union_id'      => $request->union_id,
                    'tracking'      => $request->tracking,
                    'name_bn'       => $request->warish_name_bn[$i],
                    'name_en'       => $request->warish_name_en[$i],
                    'relation_bn'   => $request->relation_bn[$i],
                    'relation_en'   => $request->relation_en[$i],
                    // 'age'           => $request->relation_age[$i],
                    'nid'           => $request->member_nid[$i],
                    'type'          => $request->type,
                    'created_by'    => $request->created_by,
                    'created_time'  => Carbon::now(),
                    'created_by_ip' => $request->ip(),
                ];
            }
        }

        return $warishList;
    }


    //family preview data
    public function family_information($tracking = null, $union_id = null, $type = null)
    {

        //get family data
        $data['family_data'] = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'APPINFO.name_bn as applicant_name_bn', 'APPINFO.name_en as applicant_name_en', 'APPINFO.father_name_bn as applicant_father_name_bn', 'APPINFO.father_name_en as applicant_father_name_en', 'APPINFO.mobile as applicant_mobile', 'APPINFO.email as applicant_email', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name')

            ->join('citizen_information AS CTZ', function ($join) {

                $join->on("CTZ.pin", "=", "APP.pin")

                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.is_active", "=", 1);
            })

            ->join('warish_family_applicant_info AS APPINFO', function ($join) use ($type) {

                $join->on("APPINFO.pin", "=", "APP.pin")

                    ->on("APPINFO.pin", "=", "CTZ.pin")
                    ->on("APPINFO.union_id", "=", "APP.union_id")
                    ->on("APPINFO.tracking", "=", "APP.tracking")
                    ->on("APPINFO.type", "=", "APP.type")
                    ->where("APPINFO.type", "=", $type)
                    ->where("APPINFO.is_active", "=", 1);
            })

            ->join('union_information AS UI', function ($join) {

                $join->on("UI.union_code", "=", "APP.union_id");
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
                ['APP.is_active', '=', 1],
                ['APP.type', '=', $type],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->first();

        // dd($data);

        //get family list
        $family_list = DB::table('application AS APP')

            ->select('MLST.*')

            ->join('member_list AS MLST', function ($join) use ($type) {

                $join->on("MLST.pin", "=", "APP.pin")
                    ->on("MLST.union_id", "=", "APP.union_id")
                    ->on("MLST.tracking", "=", "APP.tracking")
                    ->on("MLST.type", "=", "APP.type")
                    ->where("MLST.type", "=", $type)
                    ->where("MLST.is_active", "=", 1);
            })

            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.is_active', '=', 1],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->get();

        $data['family_list'] = $family_list;

// dd($data);
        return $data;
    }

    //====family edit data=======//
    public function family_data($tracking, $union_id = null, $type = null)
    {

        DB::enableQueryLog();

        //get family data
        $data['family_data'] = DB::table('application AS APP')

            ->select('APP.*', 'APP.id as application_id', 'CTZ.*', 'CTZ.id as citizen_id', 'APPINFO.id as applicant_id',  'APPINFO.name_bn as applicant_name_bn', 'APPINFO.name_en as applicant_name_en', 'APPINFO.father_name_bn as applicant_father_name_bn', 'APPINFO.father_name_en as applicant_father_name_en', 'APPINFO.mobile as applicant_mobile', 'APPINFO.email as applicant_email', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en')

            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on("CTZ.pin", "=", "APP.pin")

                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.is_active", "=", 1)
                    ->where("CTZ.union_id", "=", $union_id);
            })

            ->join('warish_family_applicant_info AS APPINFO', function ($join) use ($union_id, $type) {

                $join->on("APPINFO.pin", "=", "APP.pin")

                    ->on("APPINFO.pin", "=", "CTZ.pin")
                    ->on("APPINFO.union_id", "=", "APP.union_id")
                    ->on("APPINFO.tracking", "=", "APP.tracking")
                    ->on("APPINFO.type", "=", "APP.type")
                    ->where([
                        ["APPINFO.type", "=", $type],
                        ["APPINFO.is_active", "=", 1],
                        ["APPINFO.union_id", "=", $union_id],
                    ]);
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
                ['APP.is_active', '=', 1],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->first();

        //get family list
        $family_list = DB::table('application AS APP')

            ->select('MLST.*')

            ->join('member_list AS MLST', function ($join) use ($union_id, $type) {

                $join->on("MLST.pin", "=", "APP.pin")
                    ->on("MLST.union_id", "=", "APP.union_id")
                    ->on("MLST.tracking", "=", "APP.tracking")
                    ->on("MLST.type", "=", "APP.type")
                    ->where([
                        ["MLST.type", "=", $type],
                        ["MLST.union_id", "=", $union_id],
                        ["MLST.is_active", "=", 1],
                    ])
                    ->whereNull('MLST.deleted_at');
            })

            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.is_active', '=', 1],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->get();



        $data['family_list'] = $family_list;

        return $data;
    }

    //===family sonod generate=====//

    public function sonod_generate($receive)
    {
        // dd($receive);

        $sonod_data = [

            'pin'            => $receive->pin,
            'sonod_no'       => $receive->sonod_no,
            'tracking'       => $receive->tracking,
            'type'           => $receive->type,
            'status'         => $receive->status,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'union_id'       => $receive->union_id,
            'district_id'    => $receive->district_id,
            'upazila_id'     => $receive->upazila_id,

            'created_by'     => Auth::user()->id,
            'created_time'   => Carbon::now(),
            'created_by_ip'  => Request::ip(),

        ];

        $invoice_id = BillGenerate::generateID();
        $voucher_no =  IdGenerate::voucher($receive->union_id, $receive->fiscal_year_id, 6);

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
            'type' =>  6, // 6 = Family
            'created_by' => Auth::user()->employee_id,
            'created_at' => Carbon::now(),
            'created_by_ip' => \request()->ip()
        ];

        //ready transection data
        $transaction_data = [

            'union_id' => $receive->union_id,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'voucher' => $receive->voucher,
            'sonod_no' => $receive->sonod_no,
            'amount' => $receive->fee,
            'debit' => null,
            'credit' => $receive->debit_id,
            'type' => $receive->type,

            'created_by'            => Auth::user()->employee_id,
            'created_time'          => Carbon::now(),
            'created_by_ip'         => Request::ip(),

        ];

        // $test = [
        //     "investigator_name_bn" => $receive->investigator_name_bn,
        //     "investigator_name_en" => $receive->investigator_name_en,
        // ];

        // dd($receive->tracking, $test);

        DB::transaction(function () use ($receive, $sonod_data, $invoice_data, $transaction_data) {

            if ((int) $receive->application_id > 0) {

                DB::table('application')
                    ->where('id', $receive->application_id)
                    ->update(['status' => 1]);

                $where = [
                    'pin'      => $receive->pin,
                    'tracking' => $receive->tracking,
                    'union_id' => $receive->union_id,
                    'type'     => $receive->type,
                ];

                DB::table('member_list')
                    ->where($where)
                    ->update(['sonod_no' => $receive->sonod_no]);
            }

            DB::table("certificate")->insert($sonod_data);

            DB::table('acc_invoice')->insert($invoice_data);

            DB::table('acc_transaction')->insert($transaction_data);

            DB::table('warish_family_applicant_info')
                ->where('tracking',$receive->tracking)
                ->update([
                    "investigator_name_bn" => $receive->investigator_name_bn,
                    "investigator_name_en" => $receive->investigator_name_en,
                ]);
        });

        return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে । সনদটি প্রিন্ট করুন.", 'sonod_no' => $receive['sonod_no']];
    }

    //====family certificate data=====//

    public function family_certificate_data($sonod_no = null, $union_id = null, $type = null)
    {

        $data['family_data'] = DB::table('certificate AS CRT')

            ->join('application AS APP', function ($join) use ($type, $union_id) {

                $join->on('APP.pin', '=', 'CRT.pin')
                    ->on('APP.tracking', '=', 'CRT.tracking')
                    ->on('APP.type', '=', 'CRT.type')
                    ->on('APP.union_id', '=', 'CRT.union_id')
                    ->where('APP.is_active', '=', 1)
                    ->where('APP.union_id', '=', $union_id)
                    ->where('APP.type', '=', $type);
            })

            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on('CTZ.pin', '=', 'CRT.pin')
                    ->on('CTZ.pin', '=', 'APP.pin')
                    ->on('CTZ.union_id', '=', 'APP.union_id')
                    ->where('CTZ.union_id', '=', $union_id)
                    ->where('CTZ.is_active', '=', 1);
            })

            ->join('warish_family_applicant_info AS APPINFO', function ($join) use ($type, $union_id) {

                $join->on("APPINFO.pin", "=", "APP.pin")

                    ->on("APPINFO.pin", "=", "CTZ.pin")
                    ->on("APPINFO.union_id", "=", "APP.union_id")
                    ->on("APPINFO.tracking", "=", "APP.tracking")
                    ->on("APPINFO.type", "=", "APP.type")
                    ->on("APPINFO.union_id", "=", "APP.union_id")
                    ->where("APPINFO.type", "=", $type)
                    ->where("APPINFO.union_id", "=", $union_id)
                    ->where("APPINFO.is_active", "=", 1);
            })

            ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'APPINFO.is_father_alive', 'APPINFO.is_mother_alive', 'APPINFO.name_bn as applicant_name_bn', 'APPINFO.name_en as applicant_name_en', 'APPINFO.father_name_bn as applicant_father_name_bn', 'APPINFO.father_name_en as applicant_father_name_en',  'APPINFO.mobile as applicant_mobile', 'APPINFO.email as applicant_email', 'APPINFO.investigator_name_bn', 'APPINFO.investigator_name_en', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'APP.type')




            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')


            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.type', '=', $type],
                ['CRT.union_id', '=', $union_id],
            ])
            ->first();

        //get family list
        $family_list = DB::table('certificate AS CRT')

            ->select('MLST.name_bn', 'MLST.name_en', 'MLST.relation_bn', 'MLST.relation_en', 'MLST.age','MLST.member_birth_date AS birth_date','MLST.nid as nid')

            //if certificate re generated then it join only last generated certificate
            ->join(DB::raw("(SELECT MAX(id) as id FROM certificate where type = '$type' GROUP BY sonod_no) last_updates"), function ($join) {

                $join->on("last_updates.id", "=", "CRT.id");
            })

            ->leftJoin('member_list AS MLST', function ($join) use ($sonod_no, $type, $union_id) {

                $join->on("MLST.pin", "=", "CRT.pin")
                    ->on("MLST.union_id", "=", "CRT.union_id")
                    ->on("MLST.tracking", "=", "CRT.tracking")
                    ->on("MLST.sonod_no", "=", "CRT.sonod_no")
                    ->on("MLST.type", "=", "CRT.type")
                    ->where("MLST.type", "=", $type)
                    ->where("MLST.sonod_no", "=", $sonod_no)
                    ->where("MLST.union_id", "=", $union_id)
                    ->where("MLST.is_active", "=", 1)
                    ->whereNull("MLST.deleted_at");
            })


            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.type', '=', $type],
                ['CRT.union_id', '=', $union_id],
            ])

            ->get();



        $data['family_list'] = $family_list;

        return $data;
    }

    //======family update====//

    public function update_family($receive)
    {
        DB::enableQueryLog();

        // if address is new
        if(empty($receive->present_district_id)){
            $receive->present_district_id = $this->findLocation($receive->present_district_txt, null, 2);
        }

        if(empty($receive->present_upazila_id)){
            $receive->present_upazila_id = $this->findLocation($receive->present_upazila_txt, $receive->present_district_id, 3);
        }

        if(empty($receive->present_postoffice_id)){
            $receive->present_postoffice_id = $this->findLocation($receive->present_postoffice_txt, $receive->present_upazila_id, 6);
        }

        if(empty($receive->permanent_district_id)){
            $receive->permanent_district_id = $this->findLocation($receive->permanent_district_txt, null, 2);
        }

        if(empty($receive->permanent_upazila_id)){
            $receive->permanent_upazila_id = $this->findLocation($receive->permanent_upazila_txt, $receive->permanent_district_id, 3);
        }

        if(empty($receive->permanent_postoffice_id)){
            $receive->permanent_postoffice_id = $this->findLocation($receive->permanent_postoffice_txt, $receive->permanent_upazila_id, 6);
        }

        //family common data
        $citizen_data = [
            "nid"                       => $receive->nid,
            "birth_id"                  => $receive->birth_id,
            "passport_no"               => $receive->passport_no,
            'name_en'                   => $receive->name_en,
            'name_bn'                   => $receive->name_bn,
            'birth_date'                => $receive->birth_date,
            'father_name_en'            => $receive->father_name_en,
            'father_name_bn'            => $receive->father_name_bn,
            'mother_name_en'            => $receive->mother_name_en,
            'mother_name_bn'            => $receive->mother_name_bn,
            'nid'                       => $receive->nid,
            'resident'                  => $receive->resident,
            'occupation'                => $receive->occupation,
            'religion'                  => $receive->religion,
            'gender'                    => $receive->gender,

            'marital_status'            => $receive->marital_status,

            'educational_qualification' => $receive->educational_qualification,
            'permanent_village_bn'      => $receive->permanent_village_bn,
            'permanent_village_en'      => $receive->permanent_village_en,
            'permanent_rbs_bn'          => $receive->permanent_rbs_bn,
            'permanent_rbs_en'          => $receive->permanent_rbs_en,
            'permanent_ward_no'         => $receive->permanent_ward_no,
            'permanent_holding_no'      => $receive->permanent_holding_no,
            'permanent_district_id'     => $receive->permanent_district_id,
            'permanent_upazila_id'      => $receive->permanent_upazila_id,
            'permanent_postoffice_id'   => $receive->permanent_postoffice_id,
            'mobile'                    => $receive->mobile,
            'email'                     => $receive->email,

            'updated_by'                => Auth::user()->employee_id,
            'updated_time'              => Carbon::now(),
            'updated_by_ip'             => Request::ip(),
        ];

        //wife name push in array
        if ($receive->gender == 1 && $receive->marital_status == 2) {
            $citizen_data['wife_name_en'] = $receive->wife_name_en;
            $citizen_data['wife_name_bn'] = $receive->wife_name_bn;
        } //husband name push in array
        elseif ($receive->gender == 2 && $receive->marital_status == 2) {
            $citizen_data['husband_name_en'] = $receive->husband_name_en;
            $citizen_data['husband_name_bn'] = $receive->husband_name_bn;
        }

        //family application data
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
            'comment_bn'            => $receive->comment_bn,
            'comment_en'            => $receive->comment_en,

            'updated_by'            => Auth::user()->employee_id,
            'updated_time'          => Carbon::now(),
            'updated_by_ip'         => Request::ip()
        ];

        //family applicant data
        $applicant_data = [
            'is_father_alive'   => $receive->is_father_alive,
            'is_mother_alive'   => $receive->is_mother_alive,

            'name_bn'        => $receive->applicant_name_bn,
            'name_en'        => $receive->applicant_name_en,
            'father_name_bn' => $receive->applicant_father_name_bn,
            'father_name_en' => $receive->applicant_father_name_en,
            'mobile'         => $receive->applicant_mobile,
            'email'          => $receive->applicant_email,

            'updated_by'     => Auth::user()->employee_id,
            'updated_time'   => Carbon::now(),
            'updated_by_ip'  => Request::ip()
        ];

        //family list data

        $family_list = [];

        for ($i = 0; $i < count($receive->warish_name_bn); $i++) {

            // if name or relation name not defined
            if (!trim($receive->warish_name_bn[$i]) || !trim($receive->relation_bn[$i]))
                continue;

            if (array_key_exists($i, $receive->member_id ?? [])) {

                $family_list[] = [
                    'id'            => $receive->member_id[$i],
                    'pin'           => $receive->pin,
                    'union_id'      => $receive->union_id,
                    'tracking'      => $receive->tracking,
                    'name_bn'       => $receive->warish_name_bn[$i],
                    'name_en'       => $receive->warish_name_en[$i],
                    'relation_bn'   => $receive->relation_bn[$i],
                    'relation_en'   => $receive->relation_en[$i],
                    // 'age'           => $receive->relation_age[$i],
                    'nid'           => $receive->member_nid[$i],
                    'type'          => $receive->type,

                    'updated_by'    => Auth::user()->employee_id,
                    'updated_time'  => Carbon::now(),
                    'updated_by_ip' => Request::ip()
                ];
            } else {

                $family_list[] = [
                    'id'            => 0,
                    'pin'           => $receive->pin,
                    'sonod_no'      => ($receive->sonod_no > 0) ? $receive->sonod_no : NULL,
                    'union_id'      => $receive->union_id,
                    'tracking'      => $receive->tracking,
                    'name_bn'       => $receive->warish_name_bn[$i],
                    'name_en'       => $receive->warish_name_en[$i],
                    'relation_bn'   => $receive->relation_bn[$i],
                    'relation_en'   => $receive->relation_en[$i],
                    // 'age'           => $receive->relation_age[$i],
                    'nid'           => $receive->member_nid[$i],
                    'type'          => $receive->type,

                    'created_by'    => Auth::user()->employee_id,
                    'created_time'  => Carbon::now(),
                    'created_by_ip' => Request::ip()
                ];
            }
        }

        $status = DB::transaction(function () use ($receive, $citizen_data, $application_data, $applicant_data, $family_list) {

            //citizen information update
            $citizen_update = DB::table("citizen_information")
                ->where(["id" => $receive->citizen_id])
                ->update($citizen_data);

            //applicatin update
            $application_update = DB::table("application")
                ->where(['id' => $receive->application_id])
                ->update($application_data);

            //applicant data update
            $applicant_update = DB::table("warish_family_applicant_info")
                ->where(['id' => $receive->applicant_id])
                ->update($applicant_data);

            //family list update or insert
            foreach ($family_list as $list) {

                if ($list['id'] > 0) {

                    $family_update = DB::table("member_list")
                        ->where(['id' => $list['id']])
                        ->update($list);
                } else {

                    $family_insert = DB::table("member_list")
                        ->insert($list);
                }
            }
        });

        return true;
    }

    //===family info delete===//
    public function family_info_delete($request)
    {
        $delete = DB::table('application')
            ->where('id', $request->appId)
            ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

        $delete = DB::table('member_list')
            ->where('tracking', $request->tracking)
            ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

        $delete = DB::table('warish_family_applicant_info')
            ->where('tracking', $request->tracking)
            ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

        if ($delete) {
            return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
        } else {
            return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
        }
    }

    //===family applicant list data=====//

    public function family_applicant_list_data($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('application AS APP')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.pin', 'APP.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'APPINFO.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'APP.created_time')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("APP.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('warish_family_applicant_info AS APPINFO', function ($join) use ($receive) {
                $join->on("APPINFO.pin", "=", "APP.pin")
                    ->on("APPINFO.pin", "=", "CTZ.pin")
                    ->on("APPINFO.union_id", "=", "APP.union_id")
                    ->on("APPINFO.tracking", "=", "APP.tracking")
                    ->on("APPINFO.type", "=", "APP.type")
                    ->where([
                        ["APPINFO.type", "=", $receive['type']],
                        ["APPINFO.is_active", "=", 1],
                        ["APP.fiscal_year_id", "=", $receive['fiscal_year_id']],
                        ["APPINFO.union_id", "=", $receive['union_id']],
                    ]);
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

        //for datatable on page searching
        if ($search_content != false) {

            $query->where(function ($query) use ($search_content) {

                return $query->Where("APP.tracking", "LIKE", $search_content)
                    ->orWhere("CTZ.mobile", "LIKE", $search_content)
                    ->orWhere("APP.pin", "LIKE", $search_content)
                    ->orWhere("CTZ.name_bn", "LIKE", "%" . $search_content . "%");
            });
        }

        $data['data'] = $query->get();

        return $data;
    }

    //====family certificate list data====//
    public function family_certificate_list($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'APPINFO.mobile', 'APPINFO.investigator_name_en', 'APPINFO.investigator_name_bn', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'CRT.created_time as generate_date', DB::raw('count(MLST.id) as member_count'))

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "CRT.pin")
                    ->on("CTZ.union_id", "=", "CRT.union_id")
                    ->where("CRT.type", $receive['type'])
                    ->where("CRT.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('warish_family_applicant_info AS APPINFO', function ($join) use ($receive) {
                $join->on("APPINFO.pin", "=", "CRT.pin")
                    ->on("APPINFO.pin", "=", "CTZ.pin")
                    ->on("APPINFO.union_id", "=", "CRT.union_id")
                    ->on("APPINFO.tracking", "=", "CRT.tracking")
                    ->on("APPINFO.type", "=", "CRT.type")
                    ->where([
                        ["APPINFO.type", "=", $receive['type']],
                        ["APPINFO.is_active", "=", 1],
                        ["APPINFO.union_id", "=", $receive['union_id']],
                        ["CRT.fiscal_year_id", "=", $receive['fiscal_year_id']],
                    ]);
            })

            ->join('member_list as MLST', function ($join) use($receive) {
                $join->on('CRT.union_id', '=', 'MLST.union_id')
                    ->on('CRT.tracking', '=', 'MLST.tracking')
                    ->on('CRT.type', '=', 'MLST.type')
                    ->where("CRT.type", $receive['type'])
                    ->where("CRT.fiscal_year_id", $receive['fiscal_year_id'])
                    ->whereNull('MLST.deleted_at');
            })

            // ->join(DB::raw("(SELECT MAX(id) as id FROM certificate where type = '$receive[type]' GROUP BY sonod_no) last_updates"), function ($join) {
            //     $join->on("last_updates.id", "=", "CRT.id");
            // })

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

            ->groupBy('MLST.tracking')
            ->offset($receive['start'])
            ->limit($receive['limit']);

        //for datatable on page searching
        if ($search_content != false) {

            $query->where(function ($query) use ($search_content) {

                return $query->Where("CRT.tracking", "LIKE", $search_content)
                    ->orWhere("CRT.sonod_no", "LIKE", $search_content)
                    ->orWhere("CTZ.pin", "LIKE", $search_content)
                    ->orWhere("CTZ.mobile", "LIKE", $search_content)
                    ->orWhere("CTZ.name_bn", "LIKE", "%" . $search_content . "%");
            });
        }

        $data['data'] = $query->get();

        return $data;
    }


    //money receipt data

    public function money_receipt_data($sonod_no = null, $union_id = null, $type = null)
    {


        $query = DB::table('citizen_information AS CTZ')

            ->join('certificate AS CRT', function ($join) use ($sonod_no, $union_id, $type) {

                $join->on('CTZ.pin', '=', 'CRT.pin')
                    ->on('CTZ.union_id', '=', 'CRT.union_id')
                    ->where('CTZ.union_id', '=', $union_id)
                    ->where('CRT.union_id', '=', $union_id)
                    ->where('CRT.type', '=', $type);
            })

            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id) {
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


    //get register data

    public function family_register_data($union_id = null, $type = null, $from_date = null, $to_date = null)
    {

        $query = DB::table('certificate AS CRT')

            ->join('acc_transaction AS TRNS', function ($join) use ($union_id, $type) {

                $join->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.type', '=', 'CRT.type')
                    ->where('TRNS.is_active', '=', 1)
                    ->where('TRNS.union_id', '=', $union_id)
                    ->where('CRT.type', '=', $type)
                    ->where('TRNS.type', '=', $type);
            })

            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
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
