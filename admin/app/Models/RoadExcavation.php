<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;

class RoadExcavation extends Model
{
    use SoftDeletes;

    //====voter application store====//
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
                'father_name_en' => $request->father_name_en,
                'father_name_bn' => $request->father_name_bn,
                'mother_name_bn' => $request->mother_name_bn,
                'mother_name_en' => $request->mother_name_en,
                'religion' => $request->religion,
                'resident' => $request->resident,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,

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
                'created_by_ip' => $request->ip()
            ];


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
        }

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
            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

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

            DB::table("application")->insert($application_data);

            $application_id = DB::getPdo()->lastInsertId();

            $extra_info = [
                'union_id' => $request->union_id,
                'pin' => $request->pin,
                'tracking' => $request->tracking,
                'application_id' => $application_id,
                'holding_no' => $request->road_holding_no,
                'cutting_amount' => $request->road_cutting_amount,
                'moholla_en' => $request->road_moholla_en,
                'moholla_bn' => $request->road_moholla_bn,
                'road_name_en' => $request->road_name_en,
                'road_name_bn' => $request->road_name_bn,
                'road_type' => $request->road_type,
                'cutting_cause' => $request->road_cutting_cause,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip()
            ];

            // insert extra data
            DB::table("road_excavation_info")->insert($extra_info);
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

            $extra_info = [
                'union_id' => $request->union_id,
                'pin' => $request->pin,
                'tracking' => $request->tracking,
                'holding_no' => $request->road_holding_no,
                'cutting_amount' => $request->road_cutting_amount,
                'moholla_en' => $request->road_moholla_en,
                'moholla_bn' => $request->road_moholla_bn,
                'road_name_en' => $request->road_name_en,
                'road_name_bn' => $request->road_name_bn,
                'road_type' => $request->road_type,
                'cutting_cause' => $request->road_cutting_cause,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip()
            ];

            $application_id = DB::table("application")->insertGetId($applicationData);
            $extra_info['application_id'] = $application_id;

            $res = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);

            $res = DB::table("road_excavation_info")->insert($extra_info);
        });
        return true;
    }



    // road excavation preview data
    public function preview_data($tracking = null, $union_id = null, $type = null)
    {
        DB::enableQueryLog();

        $data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'REI.*')
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("APP.union_id", "=", $union_id);
            })
            ->join('road_excavation_info AS REI', function ($join) use ($union_id) {
                $join->on("REI.pin", "=", "APP.pin")
                    ->on("REI.tracking", "=", "APP.tracking")
                    ->on("REI.union_id", "=", "APP.union_id")
                    ->on("REI.application_id", "=", "APP.id")
                    ->where("REI.union_id", "=", $union_id);
            })

            // for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            // for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')
            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->first();

        return $data;
    }

    // === road excavation edit data === //
    public function edit_data($tracking, $union_id = null)
    {
        DB::enableQueryLog();

        $data = DB::table('application AS APP')
            ->select('APP.*', 'APP.id as application_id', 'CTZ.*', 'CTZ.id as citizen_id', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'REI.*')
            ->join('citizen_information AS CTZ', function ($join) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id");
            })
            ->join('road_excavation_info AS REI', function ($join) {
                $join->on("REI.pin", "=", "APP.pin")
                    ->on("REI.tracking", "=", "APP.tracking")
                    ->on("REI.union_id", "=", "APP.union_id")
                    ->on("REI.application_id", "=", "APP.id");
            })

            // for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            // for present address
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

    //====== Road Excavation update ====//
    public function update_data($receive)
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
            'gender' => $receive->gender,
            'marital_status' => $receive->marital_status,
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

            'updated_by' => Auth::User()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => Request::ip()
        ];


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

            'updated_by' => Auth::User()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => Request::ip()
        ];


        DB::transaction(function () use ($receive, $citizen_update_data, $application_update_data) {

            DB::table("citizen_information")
                ->where('id', $receive->citizen_id)
                ->update($citizen_update_data);

            DB::table("application")
                ->where('id', $receive->application_id)
                ->update($application_update_data);

            $extra_info = [
                'holding_no' => $receive->road_holding_no,
                'cutting_amount' => $receive->road_cutting_amount,
                'moholla_en' => $receive->road_moholla_en,
                'moholla_bn' => $receive->road_moholla_bn,
                'road_name_en' => $receive->road_name_en,
                'road_name_bn' => $receive->road_name_bn,
                'road_type' => $receive->road_type,
                'cutting_cause' => $receive->road_cutting_cause,

                'updated_by' => Auth::User()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $receive->ip()
            ];

            DB::table("road_excavation_info")
                ->where('application_id', $receive->application_id)
                ->update($extra_info);
        });

        return true;

    }

    // === Road Excavation info delete === //
    public function delete_data($request)
    {
        $delete = DB::table('application')
            ->where('id', $request->deleteId)
            ->update([
                'deleted_at' => Carbon::now(),
                'is_active' => 0,
                'updated_by' => Auth::user()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $request->ip()
            ]);

        DB::table('road_excavation_info')
            ->where('application_id', $request->deleteId)
            ->update([
                'is_active' => 0,
                'updated_by' => Auth::user()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $request->ip()
            ]);

        if ($delete) {
            return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
        } else {
            return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
        }
    }

    // === Road Excavation applicant list data ===== //
    public function applicant_list_data($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('application AS APP')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.pin', 'APP.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'APP.created_time', 'REI.*')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("APP.type", $receive['type'])
                    ->where("APP.fiscal_year_id", $receive['fiscal_year_id']);
            })
            ->join('road_excavation_info AS REI', function ($join) {
                $join->on("REI.pin", "=", "APP.pin")
                    ->on("REI.union_id", "=", "APP.union_id")
                    ->on("REI.tracking", "=", "APP.tracking")
                    ->on("REI.application_id", "=", "APP.id");
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


        // for searching on page
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

    //==== Road Excavation certificate list data====//
    public function certificate_list($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.id', 'CRT.pin', 'CRT.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'TRNS.created_time as generate_date', 'TRNS.voucher')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "CRT.pin")
                     ->on("CTZ.union_id", "=", "CRT.union_id")
                     ->where("CRT.type", $receive['type'])
                     ->where("CRT.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('acc_transaction AS TRNS', function ($join) use ($receive) {
                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.type', $receive['type'])
                    ->where('TRNS.union_id', $receive['union_id']);
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
            ->orderBy('CRT.created_time', 'DESC')
            ->groupBy("voucher");

        //for searching on page
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

    //==== Road Excavation certificate data=====//
    public function certificate_data($sonod_no = null, $union_id = null, $type = null)
    {
        $data = DB::table('certificate AS CRT')
            ->join('application AS APP', function ($join) use ($union_id, $type) {
                $join->on('APP.pin', '=', 'CRT.pin')
                    ->on('APP.tracking', '=', 'CRT.tracking')
                    ->on('APP.union_id', '=', 'CRT.union_id')
                    ->on('APP.type', '=', 'CRT.type')
                    ->where('APP.union_id', '=', $union_id)
                    ->where('APP.type', '=', $type)
                    ->where('APP.is_active', '=', 1);
            })
            ->join('citizen_information AS CTZ', function ($join) {
                $join->on('CTZ.pin', '=', 'CRT.pin')
                    ->on('CTZ.pin', '=', 'APP.pin')
                    ->where('CTZ.is_active', '=', 1);
            })
            ->join('road_excavation_info AS REI', function ($join) {

                $join->on("REI.pin", "=", "APP.pin")
                    ->on("REI.tracking", "=", "APP.tracking")
                    ->on("REI.union_id", "=", "APP.union_id")
                    ->on("REI.application_id", "=", "APP.id");
            })
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id, $type) {
                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.type', $type)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.union_id', $union_id);
            })

            // for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            // for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')
            ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.expire_date', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'REI.*', 'APP.type', 'TRNS.voucher', 'TRNS.amount')
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
            ])
            ->first();

        return $data;
    }

    //=== sonod generate=====//
    public function sonod_generate($receive)
    {
        // certificate data create
        $sonod_data = [
            'sonod_no' => $receive->sonod_no,
            'pin' => $receive->pin,
            'tracking' => $receive->tracking,
            'type' => $receive->type,
            'status' => $receive->status,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'union_id' => $receive->union_id,
            'district_id' => $receive->district_id,
            'upazila_id' => $receive->upazila_id,

            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->generate_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip()
        ];

        // ready trans section data
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
            'created_time' => $receive->generate_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip()
        ];

        //transection start
        DB::beginTransaction();

        try {
            // when certificate generate
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

            //certificate create
            DB::table("certificate")->insert($sonod_data);

            //transection data save
            DB::table("acc_transaction")->insert($transaction_data);

            //if all are good
            DB::commit();

            return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে। সনদটি প্রিন্ট করুন।", 'sonod_no' => $receive['sonod_no']];
        } catch (\Exception $e) {

            DB::rollback();

            return ["status" => "error", "message" => "দুঃখিত ! আপনার সনদ টি জেনারেট করতে সমস্যা হচ্ছে।", 'sonod_no' => ''];
        }

    }

    // money receipt data
    public function money_receipt_data($sonod_no = null, $voucher_no = null, $union_id = null, $type = null)
    {

        $data = DB::table('certificate AS CRT')
            ->join('application AS APP', function ($join) use ($union_id, $type) {
                $join->on('APP.pin', '=', 'CRT.pin')
                    ->on('APP.tracking', '=', 'CRT.tracking')
                    ->on('APP.union_id', '=', 'CRT.union_id')
                    ->on('APP.type', '=', 'CRT.type')
                    ->where('APP.union_id', '=', $union_id)
                    ->where('APP.type', '=', $type)
                    ->where('APP.is_active', '=', 1);
            })
            ->join('citizen_information AS CTZ', function ($join) {
                $join->on('CTZ.pin', '=', 'CRT.pin')
                    ->on('CTZ.pin', '=', 'APP.pin')
                    ->where('CTZ.is_active', '=', 1);
            })
            ->join('road_excavation_info AS REI', function ($join) {
                $join->on("REI.pin", "=", "APP.pin")
                    ->on("REI.tracking", "=", "APP.tracking")
                    ->on("REI.union_id", "=", "APP.union_id")
                    ->on("REI.application_id", "=", "APP.id");
            })
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $voucher_no, $union_id, $type) {
                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.union_id', $union_id)
                    ->where('TRNS.type', $type)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.voucher', $voucher_no);
            })

            // for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')
            ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.expire_date', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'REI.*', 'APP.type', 'TRNS.voucher', 'TRNS.amount')
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
            ])
            ->first();

        return $data;

    }



    // get register data
    public function register_data($union_id = null, $type = null, $from_date = null, $to_date = null)
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
