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
use function GuzzleHttp\Psr7\str;

class HoldingNamjari extends Model
{
    use SoftDeletes;

    //====Namjari application store====//
    public function data_store($request)
    {
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

                "pin" => $request->pin,
                "nid" => $request->nid,
                "birth_id" => $request->birth_id,
                "passport_no" => $request->passport_no,
                'name_en' => $request->name_en,
                'name_bn' => $request->name_bn,
                'birth_date' => $request->birth_date,
                'father_name_bn' => $request->father_name_bn,
                'father_name_en' => $request->father_name_en,
                'mother_name_bn' => $request->mother_name_bn,
                'mother_name_en' => $request->mother_name_en,
                'resident' => $request->resident,
                'occupation' => null,
                'religion' =>  $request->religion,
                'gender' => $request->gender,

                'marital_status' => $request->marital_status,

                'educational_qualification' => null,
                'union_id' => $request->union_id,
                'permanent_village_bn' => $request->permanent_village_bn,
                'permanent_village_en' => $request->permanent_village_en,
                'permanent_rbs_bn' => $request->permanent_rbs_bn,
                'permanent_rbs_en' => $request->permanent_rbs_en,
                'permanent_ward_no' => $request->permanent_ward_no,
                'permanent_holding_no' => $request->permanent_holding_no,
                'permanent_district_id' => $request->permanent_district_id,
                'permanent_upazila_id' => $request->permanent_upazila_id,
                'permanent_postoffice_id' => $request->permanent_postoffice_id,
                'mobile' => $request->mobile,
                'email' => $request->email,

                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip(),

            ];

            //wife name push in array
            if ($request->gender == 1 && $request->marital_status == 2) {
                $citizen_data['wife_name_en'] = $request->wife_name_en;
                $citizen_data['wife_name_bn'] = $request->wife_name_bn;
            }//husband name push in array
            elseif ($request->gender == 2 && $request->marital_status == 2) {
                $citizen_data['husband_name_en'] = $request->husband_name_en;
                $citizen_data['husband_name_bn'] = $request->husband_name_bn;
            }


            if ($request->hasFile("photo")) {
                //insert image
                $image = $request->file("photo");

                $img = $request->pin . "." . $image->getClientOriginalExtension();

                $location = public_path("assets/images/application/" . $img);

                //upload image in folder
                $move = Image::make($image)->resize(300, 300)->save($location);


                if ($move) {
                    $citizen_data['photo'] = $img;
                }

            }
        // }

        //application data create
        $application_data = [

            'pin' => $request->pin,
            'union_id' => $request->union_id,
            'tracking' => $request->tracking,
            'type' => $request->type,
            'fiscal_year_id' => $request->fiscal_year_id,
            'present_village_bn' => $request->present_village_bn,
            'present_village_en' => $request->present_village_en,
            'present_rbs_bn' => $request->present_rbs_bn,
            'present_rbs_en' => $request->present_rbs_en,
            'present_holding_no' => $request->present_holding_no,
            'present_ward_no' => $request->present_ward_no,
            'present_district_id' => $request->present_district_id,
            'present_upazila_id' => $request->present_upazila_id,
            'present_postoffice_id' => $request->present_postoffice_id,

            'comment_bn' => $request->comment_bn,
            'comment_en' => $request->comment_en,

            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),

        ];

        // holding namjari info
        $holdingnamjari_info = [
            'union_id' => $request->union_id,
            'pin' => $request->pin,
            'tracking' => $request->tracking,
            'former_owner_bn' => $request->former_owner_bn,
            'former_owner_en' => $request->former_owner_en,
            'former_owner_father_name_en' => $request->former_owner_father_name_en,
            'former_owner_father_name_bn' => $request->former_owner_father_name_bn,
            'former_owner_mother_name_en' => $request->former_owner_mother_name_en,
            'former_owner_mother_name_bn' => $request->former_owner_mother_name_bn,
            'trimasik_tax' => $request->trimasik_tax,
            'yearly_rate' => $request->yearly_rate,
            'yealry_tax_amount' => $request->yealry_tax_amount,
            'last_assesment_date' => $request->last_assesment_date,
            'holding_no' => $request->holding_no,
            'bhumi_moja_no' => $request->bhumi_moja_no,
            'khotian_no' => $request->khotian_no,
            'dag_no' => $request->dag_no,
            'land_amount' => $request->land_amount,
            'dolil_datar_name' => $request->dolil_datar_name,
            'dolil_no' => $request->dolil_no,
            'reg_office_name' => $request->reg_office_name,
            'reg_date' => $request->reg_date,
            'dolil_hold_no' => $request->dolil_hold_no,
            'bohuthola_dalan' => $request->bohuthola_dalan,
            'ekthola_dalan' => $request->ekthola_dalan,
            'ada_faka_ghor' => $request->ada_faka_ghor,
            'kaca_ghor' => $request->kaca_ghor,
            'latrin_no' => $request->latrin_no,
            'jhol_tap_no' => $request->jhol_tap_no,
            'tubewel_no' => $request->tubewel_no,
            'dokan_no' => $request->dokan_no,
            'family_no' => $request->family_no,
            'conditions' => $request->conditions,
            'monthly_rant_rate' => $request->monthly_rant_rate,
            'rant_last_date' => $request->rant_last_date,
            'applicant_other_info' => $request->applicant_other_info,
            'govt_rent_no' => $request->govt_rent_no,
            'fiscal_year_id' => $request->fiscal_year_id,
            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

//        dd($holdingnamjari_info);


        //db transection start
        DB::transaction(function () use ($request, $citizen_data, $application_data, $holdingnamjari_info) {

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


            $holdingnamjari_info['application_id'] = $application_id;

            // holding namjari data insert
            $holdingnamjari_insert = DB::table("holding_namjari_info")->insert($holdingnamjari_info);

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
            'pin' => $request->pin,
            'union_id' => $request->union_id,
            'tracking' => $request->tracking,
            'type' => $request->type,
            'fiscal_year_id' => $request->fiscal_year_id,
            'present_village_bn' => $request->present_village_bn,
            'present_village_en' => $request->present_village_en,
            'present_rbs_bn' => $request->present_rbs_bn,
            'present_rbs_en' => $request->present_rbs_en,
            'present_holding_no' => $request->present_holding_no,
            'present_ward_no' => $request->present_ward_no,
            'present_district_id' => $request->present_district_id,
            'present_upazila_id' => $request->present_upazila_id,
            'present_postoffice_id' => $request->present_postoffice_id,

            'comment_bn' => $request->comment_bn,
            'comment_en' => $request->comment_en,

            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

        $citizenData = [
            'marital_status' => $request->marital_status,
            'updated_by' => $request->created_by,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $request->ip()
        ];

        //wife name push in array
        if ($request->gender == 1 && $request->marital_status == 2) {
            $citizenData['wife_name_en'] = $request->wife_name_en;
            $citizenData['wife_name_bn'] = $request->wife_name_bn;
        }//husband name push in array
        elseif ($request->gender == 2 && $request->marital_status == 2) {
            $citizenData['husband_name_en'] = $request->husband_name_en;
            $citizenData['husband_name_bn'] = $request->husband_name_bn;
        }

        if ($request->hasFile("photo")) {
            $image = $request->file("photo");
            $img = $request->pin . "." . $image->getClientOriginalExtension();
            $move = Image::make($image)->resize(300, 300)->save(public_path("assets/images/application/" . $img), 100);
            if ($move) {
                $citizenData['photo'] = $img;
            }

        }

        //db transection start
        DB::transaction(function () use ($request, $applicationData, $citizenData) {
            $application_id = DB::table("application")->insertGetId($applicationData);

            $holdingnamjari_info = [
                'union_id' => $request->union_id,
                'pin' => $request->pin,
                'tracking' => $request->tracking,
                'application_id' => $application_id,
                'former_owner_bn' => $request->former_owner_bn,
                'former_owner_en' => $request->former_owner_en,
                'former_owner_father_name_en' => $request->former_owner_father_name_en,
                'former_owner_father_name_bn' => $request->former_owner_father_name_bn,
                'former_owner_mother_name_en' => $request->former_owner_mother_name_en,
                'former_owner_mother_name_bn' => $request->former_owner_mother_name_bn,
                'trimasik_tax' => $request->trimasik_tax,
                'yearly_rate' => $request->yearly_rate,
                'yealry_tax_amount' => $request->yealry_tax_amount,
                'last_assesment_date' => $request->last_assesment_date,
                'holding_no' => $request->holding_no,
                'bhumi_moja_no' => $request->bhumi_moja_no,
                'khotian_no' => $request->khotian_no,
                'dag_no' => $request->dag_no,
                'land_amount' => $request->land_amount,
                'dolil_datar_name' => $request->dolil_datar_name,
                'dolil_no' => $request->dolil_no,
                'reg_office_name' => $request->reg_office_name,
                'reg_date' => $request->reg_date,
                'dolil_hold_no' => $request->dolil_hold_no,
                'bohuthola_dalan' => $request->bohuthola_dalan,
                'ekthola_dalan' => $request->ekthola_dalan,
                'ada_faka_ghor' => $request->ada_faka_ghor,
                'kaca_ghor' => $request->kaca_ghor,
                'latrin_no' => $request->latrin_no,
                'jhol_tap_no' => $request->jhol_tap_no,
                'tubewel_no' => $request->tubewel_no,
                'dokan_no' => $request->dokan_no,
                'family_no' => $request->family_no,
                'conditions' => $request->conditions,
                'monthly_rant_rate' => $request->monthly_rant_rate,
                'rant_last_date' => $request->rant_last_date,
                'applicant_other_info' => $request->applicant_other_info,
                'govt_rent_no' => $request->govt_rent_no,
                'fiscal_year_id' => $request->fiscal_year_id,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip(),
            ];


            $citizn = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);

            DB::table('holding_namjari_info')->insert($holdingnamjari_info);
        });
        return true;
    }


    public function namjari_applicant_list_data($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('application AS APP')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.pin', 'APP.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'APP.created_time', 'HNIF.id as namjari_id', 'HNIF.former_owner_bn', 'HNIF.holding_no')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "APP.pin")
                     ->on("CTZ.union_id", "=", "APP.union_id")
                     ->where("APP.type", $receive['type'])
                     ->where("APP.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('holding_namjari_info AS HNIF', function ($join) {
                $join->on("HNIF.pin", "=", "APP.pin")
                    ->on("HNIF.tracking", "=", "APP.tracking")
                    ->on("HNIF.application_id", "=", "APP.id")
                    ->on("HNIF.union_id", "=", "APP.union_id")
                    ->where('HNIF.is_active', 1);
            })

            ->where([
                ['APP.union_id', '=', $receive['union_id']],
                ['CTZ.union_id', '=', $receive['union_id']],
                ['APP.type', '=', $receive['type']],
                ['APP.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['APP.status', '=', 0],
                ['CTZ.is_active', '=', 1],
                ['APP.is_active', '=', 1],
            ])

            ->whereDate('APP.created_time', '>=', $receive['from_date'])
            ->whereDate('APP.created_time', '<=', $receive['to_date'])

            ->offset($receive['start'])
            ->limit($receive['limit'])
            ->orderBy('APP.id', 'DESC');


        //for searching on page
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


    public function namjari_information($tracking = null, $union_id = null, $type = null)
    {

        //get family data
        $data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'HMINFO.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name')
            ->join('citizen_information AS CTZ', function ($join) {

                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.is_active", "=", 1);
            })
            ->join('holding_namjari_info AS HMINFO', function ($join) use ($type) {

                $join->on("HMINFO.pin", "=", "APP.pin")
                    ->on("HMINFO.tracking", "=", "APP.tracking")
                    ->on("HMINFO.application_id", "=", "APP.id")
                    ->on("HMINFO.union_id", "=", "APP.union_id")
                    ->where('HMINFO.is_active', 1);
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

        return $data;
    }

    public function namjari_data($tracking, $union_id = null)
    {

        DB::enableQueryLog();

        $data = DB::table('application AS APP')
            ->select('APP.*', 'APP.id as application_id', 'CTZ.*', 'HNIF.*', 'HNIF.id as namjari_id', 'CTZ.id as citizen_id', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en')
            ->join('citizen_information AS CTZ', function ($join) {

                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id");

            })
            ->join('holding_namjari_info AS HNIF', function ($join) {

                $join->on("HNIF.pin", "=", "APP.pin")
                    ->on("HNIF.tracking", "=", "APP.tracking")
                    ->on("HNIF.application_id", "=", "APP.id")
                    ->on("HNIF.union_id", "=", "APP.union_id")
                    ->where('HNIF.is_active', 1);

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
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->first();


        return $data;

    }


    public function update_namjari($receive)
    {

        $citizen_update_data = [

            "nid" => $receive->nid,
            "birth_id" => $receive->birth_id,
            "passport_no" => $receive->passport_no,
            'name_en' => $receive->name_en,
            'name_bn' => $receive->name_bn,
            'birth_date' => $receive->birth_date,
            'father_name_bn' => $receive->father_name_bn,
            'father_name_en' => $receive->father_name_en,
            'mother_name_bn' => $receive->mother_name_bn,
            'mother_name_en' => $receive->mother_name_en,
            'resident' => $receive->resident,
            'occupation' => null,
            'religion' => $receive->religion,
            'gender' => $receive->gender,

            'marital_status' => $receive->marital_status,

            'educational_qualification' => null,
            'permanent_village_bn' => $receive->permanent_village_bn,
            'permanent_village_en' => $receive->permanent_village_en,
            'permanent_rbs_bn' => $receive->permanent_rbs_bn,
            'permanent_rbs_en' => $receive->permanent_rbs_en,
            'permanent_ward_no' => $receive->permanent_ward_no,
            'permanent_holding_no' => $receive->permanent_holding_no,
            'permanent_district_id' => $receive->permanent_district_id,
            'permanent_upazila_id' => $receive->permanent_upazila_id,
            'permanent_postoffice_id' => $receive->permanent_postoffice_id,
            'mobile' => $receive->mobile,
            'email' => $receive->email,


            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => Request::ip(),

        ];

        if ($receive->gender == 1 && $receive->marital_status == 2) {
            $citizen_update_data['wife_name_en'] = $receive->wife_name_en;
            $citizen_update_data['wife_name_bn'] = $receive->wife_name_bn;
        } elseif ($receive->gender == 2 && $receive->marital_status == 2) {
            $citizen_update_data['husband_name_en'] = $receive->husband_name_en;
            $citizen_update_data['husband_name_bn'] = $receive->husband_name_bn;
        }


        if ($receive->hasFile("photo")) {
            //insert image
            $image = $receive->file("photo");

            $img = $receive->pin . "." . $image->getClientOriginalExtension();

            //upload image in folder
            $move = Image::make($image)->resize(300, 300)->save(public_path("assets/images/application/" . $img));

            if ($move) {
                $citizen_update_data['photo'] = $img;
            }
        }


        $application_update_data = [


            'present_village_bn' => $receive->present_village_bn,
            'present_village_en' => $receive->present_village_en,
            'present_rbs_bn' => $receive->present_rbs_bn,
            'present_rbs_en' => $receive->present_rbs_en,
            'present_holding_no' => $receive->present_holding_no,
            'present_ward_no' => $receive->present_ward_no,
            'present_district_id' => $receive->present_district_id,
            'present_upazila_id' => $receive->present_upazila_id,
            'present_postoffice_id' => $receive->present_postoffice_id,

            'comment_bn' => $receive->comment_bn,
            'comment_en' => $receive->comment_en,

            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => Request::ip(),

        ];

        $holdingnamjari_info = [
            'former_owner_bn' => $receive->former_owner_bn,
            'former_owner_en' => $receive->former_owner_en,
            'former_owner_father_name_en' => $receive->former_owner_father_name_en,
            'former_owner_father_name_bn' => $receive->former_owner_father_name_bn,
            'former_owner_mother_name_en' => $receive->former_owner_mother_name_en,
            'former_owner_mother_name_bn' => $receive->former_owner_mother_name_bn,
            'trimasik_tax' => $receive->trimasik_tax,
            'yearly_rate' => $receive->yearly_rate,
            'yealry_tax_amount' => $receive->yealry_tax_amount,
            'last_assesment_date' => $receive->last_assesment_date,
            'holding_no' => $receive->holding_no,
            'bhumi_moja_no' => $receive->bhumi_moja_no,
            'khotian_no' => $receive->khotian_no,
            'dag_no' => $receive->dag_no,
            'land_amount' => $receive->land_amount,
            'dolil_datar_name' => $receive->dolil_datar_name,
            'dolil_no' => $receive->dolil_no,
            'reg_office_name' => $receive->reg_office_name,
            'reg_date' => $receive->reg_date,
            'dolil_hold_no' => $receive->dolil_hold_no,
            'bohuthola_dalan' => $receive->bohuthola_dalan,
            'ekthola_dalan' => $receive->ekthola_dalan,
            'ada_faka_ghor' => $receive->ada_faka_ghor,
            'kaca_ghor' => $receive->kaca_ghor,
            'latrin_no' => $receive->latrin_no,
            'jhol_tap_no' => $receive->jhol_tap_no,
            'tubewel_no' => $receive->tubewel_no,
            'dokan_no' => $receive->dokan_no,
            'family_no' => $receive->family_no,
            'conditions' => $receive->conditions,
            'monthly_rant_rate' => $receive->monthly_rant_rate,
            'rant_last_date' => $receive->rant_last_date,
            'applicant_other_info' => $receive->applicant_other_info,
            'govt_rent_no' => $receive->govt_rent_no,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => Request::ip(),
        ];


//        dd($holdingnamjari_info);


        DB::transaction(function () use ($receive, $citizen_update_data, $application_update_data, $holdingnamjari_info) {

            $citizen_update = DB::table("citizen_information")
                ->where('id', $receive->citizen_id)
                ->update($citizen_update_data);

            $application_update = DB::table("application")
                ->where('id', $receive->application_id)
                ->update($application_update_data);

            $namjari_info_update = DB::table("holding_namjari_info")
                ->where('id', $receive->namjari_id)
                ->update($holdingnamjari_info);

        });

        return true;

    }


    public function namjari_info_delete($request)
    {
        $delete = DB::table('application')
            ->where('id', $request->deleteId)
            ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

        $namjari_delete = DB::table('holding_namjari_info')
            ->where('id', $request->namjariId)
            ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

        if ($delete && $namjari_delete) {
            return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
        } else {
            return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
        }
    }


    public function sonod_generate($receive)
    {
        //certificate data create
        $sonod_data = [

            'pin' => $receive->pin,
            'sonod_no' => $receive->sonod_no,
            'tracking' => $receive->tracking,
            'expire_date' => $receive->expire_date,
            'type' => $receive->type,
            'status' => $receive->status,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'union_id' => $receive->union_id,
            'district_id' => $receive->district_id,
            'upazila_id' => $receive->upazila_id,
            'memo_no' => $receive->memo_no,
            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->generate_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip(),

        ];



        //ready trans section data
        $transaction_data[] = [

            'union_id' => $receive->union_id,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'voucher' => $receive->voucher,
            'sonod_no' => $receive->sonod_no,
            'amount' => $receive->fee,
            'debit' => NULL,
            'credit' => $receive->debit_id,
            'type' => $receive->type,
            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip(),

        ];


        // update namjari_info data //
        $namjari_update_info = [
            'current_holding_no' => $receive->current_holding_no,
            'malikana' => $receive->maikana
        ];


        //if have prev holding tax
        if ($receive->prev_holding_tax > 0) {

            //get prev holding tax account id
            $prev_holding_tax_account_id = Global_model::get_account_id($receive->union_id, 98, 212);

            if ($prev_holding_tax_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->prev_holding_tax,
                    'credit' => $prev_holding_tax_account_id,
                    'debit' => NULL,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }


        //if have vat
        if ($receive->holding_tax > 0) {

            //get vat account id
            $holding_tax_account_id = Global_model::get_account_id($receive->union_id, 99, 212);

            if ($holding_tax_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->holding_tax,
                    'debit' => NULL,
                    'credit' => $holding_tax_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }

        //transection start
        DB::beginTransaction();

        try {

            //when certificate generate
            if ((int)$receive->application_id > 0) {

                DB::table('application')
                    ->where('id', $receive->application_id)
                    ->update(['status' => 1]);
            }

            //when certificate re-generate
            if ((int)$receive->certificate_id > 0) {

                DB::table('certificate')
                    ->where('id', $receive->certificate_id)
                    ->update(['status' => 2]);
            }

            // when namjari info update
            if ($receive->namjari_id > 0){
                DB::table('holding_namjari_info')
                    ->where('id', $receive->namjari_id)
                    ->update($namjari_update_info);
            }

            //certificate create
            DB::table("certificate")->insert($sonod_data);

            //transection data save
            DB::table("acc_transaction")->insert($transaction_data);

            //if all are good
            DB::commit();


            return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে। সনদটি প্রিন্ট করুন।", 'sonod_no' => $receive['sonod_no']];
        } catch (\Exception $e) {

            DB::rollback();

            return ["status" => "error", "message" => "দুঃখিত ! আপনার সনদ টি জেনারেট করতে সমস্যা হচ্ছে।", 'sonod_no'
            => '' , 'errors' => $e->getMessage() ];
        }
    }

    //====namjari certificate list data====//
    public function namjari_certificate_list($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no') , 'CRT.type','CRT.id', 'CRT.pin', 'CRT.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'CRT.created_time as generate_date','HMINFO.id as namjari_id','HMINFO.*')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "CRT.pin")
                    ->on("CTZ.union_id", "=", "CRT.union_id")
                    ->where("CRT.type", $receive['type'])
                    ->where("CRT.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('holding_namjari_info AS HMINFO', function ($join)  {
                $join->on("HMINFO.pin", "=", "CRT.pin")
                    ->on("HMINFO.tracking", "=", "CRT.tracking")
                    ->on("HMINFO.union_id", "=", "CRT.union_id")
                    ->where('HMINFO.is_active', 1);
            })

            ->where([
                ['CRT.union_id', '=', $receive['union_id']],
                ['CTZ.union_id', '=', $receive['union_id']],
                ['CRT.type', '=', $receive['type']],
                ['CRT.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['CTZ.is_active', '=', 1],
                ['CRT.is_active', '=', 1],
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

        return $data;

    }

    public function money_receipt_data($sonod_no = null, $union_id = null, $type = null){


        $data['organization'] = DB::table('citizen_information AS CTZ')

            ->join('certificate AS CRT', function($join) use($sonod_no, $union_id, $type ){

                $join->on('CTZ.pin', '=', 'CRT.pin')
                    ->on('CTZ.union_id', '=', 'CRT.union_id')
                    ->where('CTZ.union_id', '=', $union_id)
                    ->where('CRT.union_id', '=', $union_id)
                    ->where('CRT.type', '=', $type);
            })
            ->join('holding_namjari_info AS HNIF', function ($join) {

                $join->on("HNIF.pin", "=", "CTZ.pin")
                    ->on("HNIF.pin", "=", "CRT.pin")
                    ->on("HNIF.tracking", "=", "CRT.tracking")
                    ->on("HNIF.union_id", "=", "CRT.union_id")
                    ->where('HNIF.is_active', 1);

            })
            ->join('fiscal_years AS FSY', function ($join) use ($union_id) {

                $join->on("FSY.id", "=", 'CRT.fiscal_year_id')
                    ->where("FSY.is_current", "=", '1')
                    ->where("FSY.is_active", "=", '1');
            })

            ->select('HNIF.former_owner_bn','HNIF.former_owner_father_name_bn', 'CTZ.pin', 'CTZ.permanent_village_bn', 'CTZ.permanent_ward_no', 'CRT.sonod_no','FSY.name as fiscal_year_name')

            ->where([
                'CTZ.union_id' => $union_id,
                'CRT.sonod_no' => $sonod_no,
                'CRT.union_id' => $union_id,
                'CRT.type' => $type,
            ])
            ->first();

        $fee_info =  DB::table('certificate AS CRT')
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount', 'TRNS.voucher')
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id, $type) {

                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.union_id', $union_id);
            })
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })

            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', $type);
            })
            ->get();


        $fee_data = [];

        foreach ($fee_info as $item){
            $fee_data[$item->account_type] = [
               "account_name" =>  $item->account_name,
               "amount" =>  $item->amount
            ];

            $data['organization']->voucher_no = $item->voucher;
        }

        $data['fee_data'] = $fee_data;


        return $data;

    }

    // namjari critificate data //
    public function namjari_certificate_data($sonod_no = null, $union_id = null, $type = null)
    {

        $data['certificate_data'] = DB::table('certificate AS CRT')

            ->join('application AS APP', function ($join) use ($union_id, $type) {

                $join->on('APP.pin', '=', 'CRT.pin')
                    ->on('APP.tracking', '=', 'CRT.tracking')
                    ->on('APP.type', '=', 'CRT.type')
                    ->on('APP.union_id', '=', 'CRT.union_id')
                    ->where('APP.union_id', '=', $union_id)
                    ->where('APP.type', '=', $type)
                    ->where('APP.is_active', '=', 1);
            })

            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on('CTZ.pin', '=', 'CRT.pin')
                    ->on('CTZ.pin', '=', 'APP.pin')
                    ->on('CTZ.union_id', '=', 'APP.union_id')
                    ->where('CTZ.union_id', '=', $union_id)
                    ->where('CTZ.is_active', '=', 1);
            })
            ->join('holding_namjari_info AS HNIF', function ($join) {
                $join->on("HNIF.pin", "=", "CRT.pin")
                    ->on("HNIF.tracking", "=", "CRT.tracking")
                    ->on("HNIF.union_id", "=", "CRT.union_id")
                    ->where('HNIF.is_active', 1);

            })
            ->join('fiscal_years AS FSY', function ($join) use ($union_id) {

                $join->on("FSY.id", "=", 'CRT.fiscal_year_id')
                    ->where("FSY.is_current", "=", '1')
                    ->where("FSY.is_active", "=", '1');
            })

            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

            ->select('CTZ.*','HNIF.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'APP.type','FSY.name as fiscal_year_name')


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

        $fee_info =  DB::table('certificate AS CRT')
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount')


            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id, $type) {

                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.union_id', $union_id);
            })
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', $type);
            })
            ->get();

        $fee_data = [];

        foreach ($fee_info as $item){
            $fee_data[$item->account_type] = [
                "account_name" =>  $item->account_name,
                "amount" =>  $item->amount
            ];
        }

        $data['fee_data'] = $fee_data;



        return $data;
    }


    public function namjari_register_data($union_id = null, $type = null, $from_date = null, $to_date = null)
    {

        $register_data = DB::table('certificate AS CRT')
            ->leftjoin("acc_transaction AS TRNS", function ($join) use ($union_id) {

                $join->on('CRT.sonod_no', '=', 'TRNS.sonod_no')
                    ->on('CRT.union_id', '=', 'TRNS.union_id')
                    ->where('CRT.union_id', $union_id);
            })
            ->leftjoin('acc_account AS ACCDBT', function ($join) use ($union_id) {

                $join->on('ACCDBT.id', '=', 'TRNS.debit')
                    ->on('ACCDBT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCDBT.is_active', 1)
                    ->where('ACCDBT.union_id', $union_id);
            })
            ->leftJoin('acc_account AS ACCRDT', function ($join) use ($union_id) {

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
                $join->on('CTZ.union_id', '=', 'CRT.union_id')
                    ->on('CTZ.pin', '=', 'CRT.pin')
                    ->where('CTZ.union_id', '=', $union_id);
            })
            ->select('CTZ.name_bn', 'CRT.sonod_no','CRT.memo_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'ACCDBT.account_name as debit_account_name', 'ACCDBT.acc_type as debit_account_type', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
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

            ->get();

//        dd($register_data);
        //ready rigister data
        $data = [];

        foreach ($register_data as $item) {

            if (isset($data[$item->sonod_no])) {

                if ($item->credit_account_type == 93) {
                    $data[$item->sonod_no]['fee'] = $item->amount;
                }

                if ($item->credit_account_type == 98) {
                    $data[$item->sonod_no]['prev_tax'] = $item->amount;
                }

                if ($item->credit_account_type == 99) {
                    $data[$item->sonod_no]['holding_tax'] = $item->amount;
                }
            } else {

                $data[$item->sonod_no] = [
                    'name' =>  $item->name_bn,
                    'memo_no' =>  $item->memo_no,
                    'payment_date' => $item->payment_date,
                    'fee' => ($item->credit_account_type == 93) ? $item->amount : 0,
                    'prev_tax' => ($item->credit_account_type == 98) ? $item->amount : 0,
                    'holding_tax' => ($item->credit_account_type == 99) ? $item->amount : 0,
                ];
            }
        }


        return $data;

    }

}
