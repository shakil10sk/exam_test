<?php

namespace App\Models;

use App\Models\Management\BusinessType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;

class Premiseslicense extends Model
{
    //get all business type
    public function get_business_type($union_id = null)
    {

        $query = DB::table('business_type')->select('id', 'name_bn', 'name_en')
            ->where('union_id', $union_id)
            // ->where('type', 2) // 2 = premises
            ->get();

        return $query;

    }

    //====premiseslicense application store====//
    public function data_store($receive)
    {
        $citizen_data = [];
        $owner_data = [];

        for ($i = 0; $i < count($receive->name_bn); $i++) {

            //citizen information
            // if address is new
        if(empty($request->present_district_id[$i])){
            $request->present_district_id[$i] = $this->findLocation($request->present_district_txt[$i], null, 2);
        }

        if(empty($request->present_upazila_id)){
            $request->present_upazila_id[$i] = $this->findLocation($request->present_upazila_txt[$i], $request->present_district_id[$i], 3);
        }

        if(empty($request->present_postoffice_id[$i])){
            $request->present_postoffice_id[$i] = $this->findLocation($request->present_postoffice_txt[$i], $request->present_upazila_id[$i], 6);
        }

        if(empty($request->permanent_district_id[$i])){
            $request->permanent_district_id[$i] = $this->findLocation($request->permanent_district_txt[$i], null, 2);
        }

        if(empty($request->permanent_upazila_id[$i])){
            $request->permanent_upazila_id[$i] = $this->findLocation($request->permanent_upazila_txt[$i], $request->permanent_district_id[$i], 3);
        }

        if(empty($request->permanent_postoffice_id[$i])){
            $request->permanent_postoffice_id[$i] = $this->findLocation($request->permanent_postoffice_txt[$i], $request->permanent_upazila_id[$i], 6);
        }

        // dd($request);

        if ($request['old_ctz'] == false) {
            $citizen_data[] = [
                "pin" => $receive->pin[$i],
                "nid" => isset($receive->nid[$i]) ? $receive->nid[$i] : null,
                "birth_id" => isset($receive->birth_id[$i]) ? $receive->birth_id[$i] : null,

                'name_en' => isset($i, $receive->name_en[$i]) ? $receive->name_en[$i] : null,
                'name_bn' => $receive->name_bn[$i],
                'father_name_bn' => isset($i, $receive->father_name_bn[$i]) ? $receive->father_name_bn[$i] : null,
                'father_name_en' => isset($i, $receive->father_name_en[$i]) ? $receive->father_name_en[$i] : null,
                'mother_name_bn' => isset($i, $receive->mother_name_bn[$i]) ? $receive->mother_name_bn[$i] : null,
                'mother_name_en' => isset($i, $receive->mother_name_en[$i]) ? $receive->mother_name_en[$i] : null,
                'husband_name_bn' => isset($i, $receive->husband_name_bn[$i]) ? $receive->husband_name_bn[$i] : NULL,
                'husband_name_en' => isset($i, $receive->husband_name_en[$i]) ? $receive->husband_name_en[$i] : NULL,

                'religion' => isset($i, $receive->religion[$i]) ? $receive->religion[$i] : '',
                'resident' => isset($i, $receive->resident[$i]) ? $receive->resident[$i] : '',
                'gender' => $receive->gender[$i],
                'occupation' => $receive->occupation[$i],

                'marital_status' => isset($i, $receive->marital_status[$i]) ? $receive->marital_status[$i] : null,

                'educational_qualification' => $receive->educational_qualification[$i],
                'union_id' => $receive->union_id,
                'permanent_village_bn' => isset($i, $receive->permanent_village_bn[$i]) ? $receive->permanent_village_bn[$i] : null,
                'permanent_village_en' => isset($i, $receive->permanent_village_en[$i]) ? $receive->permanent_village_en[$i] : '',
                'permanent_rbs_bn' => isset($i, $receive->permanent_rbs_bn[$i]) ? $receive->permanent_rbs_bn[$i] : null,
                'permanent_rbs_en' => isset($i, $receive->permanent_rbs_en[$i]) ? $receive->permanent_rbs_en[$i] : null,
                'permanent_ward_no' => isset($i, $receive->permanent_ward_no[$i]) ? $receive->permanent_ward_no[$i] : null,
                'permanent_holding_no' => isset($i, $receive->permanent_holding_no[$i]) ? $receive->permanent_holding_no[$i] : null,
                'permanent_district_id' => isset($i, $receive->permanent_district_id[$i]) ? $receive->permanent_district_id[$i] : null,
                'permanent_upazila_id' => isset($i, $receive->permanent_upazila_id[$i]) ? $receive->permanent_upazila_id[$i] : null,
                'permanent_postoffice_id' => isset($i, $receive->permanent_postoffice_id[$i]) ? $receive->permanent_postoffice_id[$i] : null,

                'created_by' => $receive->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $receive->ip()
            ];

            // owner information
            $owner_data[] = [
                "pin" => $receive->pin[$i],
                "tracking" => $receive->tracking,
                'union_id' => $receive->union_id,
                'fiscal_year_id' => $receive->fiscal_year_id,
                'present_village_bn' => isset($i, $receive->present_village_bn[$i]) ? $receive->present_village_bn[$i] : null,
                'present_village_en' => isset($i, $receive->present_village_en[$i]) ? $receive->present_village_en[$i] : null,
                'present_rbs_bn' => isset($i, $receive->present_rbs_bn) ? $receive->present_rbs_bn[$i] : null,
                'present_rbs_en' => isset($i, $receive->present_rbs_en[$i]) ? $receive->present_rbs_en[$i] : null,
                'present_ward_no' => isset($i, $receive->present_ward_no[$i]) ? $receive->present_ward_no[$i] : null,
                'present_holding_no' => isset($i, $receive->present_holding_no[$i]) ? $receive->present_holding_no[$i] : null,
                'present_district_id' => isset($i, $receive->present_district_id[$i]) ? $receive->present_district_id[$i] : null,
                'present_upazila_id' => isset($i, $receive->present_upazila_id[$i]) ? $receive->present_upazila_id[$i] : null,
                'present_postoffice_id' => isset($i, $receive->present_postoffice_id[$i]) ? $receive->present_postoffice_id[$i] : null,

                'created_by' => $receive->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $receive->ip()
            ];
        }

        //single and multiple photo upload
        if ($receive->hasfile('photo')) {

            $i = 0;

            foreach ($receive->file('photo') as $image) {

                //rename photo
                $photo = $receive->pin[$i] . "." . $image->getClientOriginalExtension();

                $location = public_path("assets/images/application/" . $photo);

                //upload image in folder
                $move = Image::make($image)->resize(300, 300)->save($location);

                //store photo in citizen array
                $citizen_data[$i]['photo'] = $photo;

                $i++;
            }
        }

        //application table data
        $application_data = [
            'pin' => null,
            'union_id' => $receive->union_id,
            'tracking' => $receive->tracking,
            'type' => 90,
            'comment_bn' => $receive->comment_bn,
            'comment_en' => $receive->comment_en,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'created_by' => $receive->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $receive->ip()
        ];


        //premises license optional info
        $premises_optional_info = [
            'pin' => null,
            'union_id' => $receive->union_id,
            'organization_name_bn' => $receive->name_Of_organization_bn,
            'organization_name_en' => $receive->name_Of_organization_en,
            'vat_id' => $receive->vat_id,
            'tax_id' => $receive->tax_id,

            'signboard_length' => $receive->signboard_length,
            'signboard_width' => $receive->signboard_width,
            'normal_signboard' => $receive->normal_signboard,
            'lighted_signboard' => $receive->lighted_signboard,
            'agent_name_en' => $receive->agent_name_en,
            'agent_name_bn' => $receive->agent_name_bn,
            'business_start_date' => $receive->business_start_date,
            'previous_license_data' => $receive->previous_license_data,
            'building_size' => $receive->building_size,

            'capital' => $receive->capital,
            'tracking' => $receive->tracking,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'owner_type' => $receive->type_of_organization,

            'mobile' => $receive->mobile,
            'email' => $receive->email,
            'phone' => $receive->tel,

            'premises_village_bn' => $receive->trade_village_bn,
            'premises_village_en' => $receive->trade_village_en,
            'premises_rbs_bn' => $receive->trade_rbs_bn,
            'premises_rbs_en' => $receive->trade_rbs_en,
            'premises_holding_no' => $receive->trade_holding_no,
            'premises_ward_no' => $receive->trade_ward_no,
            'premises_district_id' => $receive->trade_district_id,
            'premises_upazila_id' => $receive->trade_upazila_id,
            'premises_postoffice_id' => $receive->trade_postoffice_id,

            'created_by' => $receive->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $receive->ip()
        ];


        DB::beginTransaction();

        try {

            //get business type
            $query = DB::table('business_type')
                ->select('name_bn', 'id')
                ->where('name_bn', trim($receive->business_type))
                ->where('union_id', $receive->union_id)
                // ->where('type', 2) // 2 = premises
                ->first();


            if ($query) { //business type have

                $premises_optional_info['business_type'] = $query->id;
            } else { //business type hav'nt
                $business_type_data = [
                    'union_id' => $receive->union_id,
                    'name_bn' => $receive->business_type,
                    // 'type' => 2, // 2 = premises
                    'is_active' => 1,
                    'created_by' => $receive->created_by,
                    'created_time' => Carbon::now(),
                    'created_by_ip' => $receive->ip(),
                ];

                DB::table('business_type')->insert($business_type_data);

                $business_type_id = DB::getPdo()->lastInsertId();

                $premises_optional_info['business_type'] = $business_type_id;
            }

            // if only personal
            if($receive->type_of_organization == 1 && $receive->old_ctz){
                //insert citizen information
                $citizen_data[0]['updated_by'] = $citizen_data[0]['created_by'];
                $citizen_data[0]['updated_time'] = $citizen_data[0]['created_time'];
                $citizen_data[0]['updated_by_ip'] = $citizen_data[0]['created_by_ip'];

                unset($citizen_data[0]['created_by'], $citizen_data[0]['created_time'], $citizen_data[0]['created_by_ip']);

                DB::table("citizen_information")->where("pin", $receive->pin)->update($citizen_data[0]);
            } else {
                // insert citizen information
                DB::table("citizen_information")->insert($citizen_data);
            }

            //insert application info
            DB::table("application")->insert($application_data);

            //insert premises owner info
            DB::table("owner_info")->insert($owner_data);

            //insert premises optional info
            DB::table("premises_optional_info")->insert($premises_optional_info);

            DB::commit();

            //if have multiple pin
            $pin = implode(', ', $receive->pin);

            $text = (count($receive->pin) > 1) ? "আপনাদের" : "আপনার";

            return ["status" => "success", "message" => "$text পিন নং $pin এবং ট্র্যাকিং নং $receive->tracking"];

        } catch (Exception $e) {
            DB::rollBack();

            return ["status" => "error", "message" => "আবেদনটি গৃহীত হয়নি।"];
        }
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

            'comment_bn' => null,
            'comment_en' => null,

            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

        $citizenData = [
            'marital_status' => $request->marital_status[0],

            'updated_by' => $request->created_by,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $request->ip(),
        ];

        if ($request->gender[0] == 2 && $request->marital_status[0] == 2) {
            $citizenData['husband_name_en'] = $request->husband_name_en[0];
            $citizenData['husband_name_bn'] = $request->husband_name_bn[0];
        }

        if ($request->hasFile("photo")) {
            $image = $request->file("photo");
            $img = $request->pin . "." . $image->getClientOriginalExtension();
            $move = Image::make($image)->resize(300, 300)->save(public_path("assets/images/application/" . $img), 100);
            if ($move) {
                $citizenData['photo'] = $img;
            }
        }

        $ownerData = [
            "pin" => $request->pin,
            "tracking" => $request->tracking,
            'union_id' => $request->union_id,
            'fiscal_year_id' => $request->fiscal_year_id,

            'present_village_bn' => $request->present_village_bn[0],
            'present_village_en' => $request->present_village_en[0],
            'present_rbs_bn' => $request->present_rbs_bn[0],
            'present_rbs_en' => $request->present_rbs_en[0],
            'present_holding_no' => $request->present_holding_no[0],
            'present_ward_no' => $request->present_ward_no[0],
            'present_district_id' => $request->present_district_id[0],
            'present_upazila_id' => $request->present_upazila_id[0],
            'present_postoffice_id' => $request->present_postoffice_id[0],

            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

        //get business type
        $query = DB::table('business_type')
            ->select('name_bn', 'id')
            ->where('name_bn', trim($request->business_type))
            ->where('union_id', $request->union_id)
            // ->where('type', 2) // 2 = premises
            ->first();

        if ($query) { //business type have

            $premisesOptionalInfo['business_type'] = $query->id;
        } else { //business type hav'nt

            $business_type_data = [
                'union_id' => $request->union_id,
                'name_bn' => $request->business_type,
                // 'type' => 2, // 2 = premises
                'is_active' => 1,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip(),
            ];

            DB::table('business_type')->insert($business_type_data);
            $business_type_id = DB::getPdo()->lastInsertId();

            $premisesOptionalInfo['business_type'] = $business_type_id;
        }

        $premisesOptionalInfo += [
            'pin' => null,
            'union_id' => $request->union_id,
            'tracking' => $request->tracking,
            'organization_name_bn' => $request->name_Of_organization_bn,
            'organization_name_en' => $request->name_Of_organization_en,
            'vat_id' => $request->vat_id,
            'tax_id' => $request->tax_id,
            'signboard_length' => $request->signboard_length,
            'signboard_width' => $request->signboard_width,
            'normal_signboard' => $request->normal_signboard,
            'lighted_signboard' => $request->lighted_signboard,
            'agent_name_en' => $request->agent_name_en,
            'agent_name_bn' => $request->agent_name_bn,
            'business_start_date' => $request->business_start_date,
            'previous_license_data' => $request->previous_license_data,
            'building_size' => $request->previous_license_data,

            'capital' => $request->capital,
            'fiscal_year_id' => $request->fiscal_year_id,
            'owner_type' => $request->type_of_organization,

            'mobile' => $request->mobile,
            'email' => $request->email,
            'phone' => $request->phone,

            'premises_village_bn' => $request->trade_village_bn,
            'premises_village_en' => $request->trade_village_en,
            'premises_rbs_bn' => $request->trade_rbs_bn,
            'premises_rbs_en' => $request->trade_rbs_en,
            'premises_holding_no' => $request->trade_holding_no,
            'premises_ward_no' => $request->trade_ward_no,
            'premises_district_id' => $request->trade_district_id,
            'premises_upazila_id' => $request->trade_upazila_id,
            'premises_postoffice_id' => $request->trade_postoffice_id,

            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

        //db transection start
        DB::transaction(function () use ($request, $ownerData, $applicationData, $citizenData, $premisesOptionalInfo) {
            $res = DB::table("application")->insert($applicationData);
            $citizn = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);

            $owner = DB::table("owner_info")->insert($ownerData);


            $premisesOptional = DB::table("premises_optional_info")->insert($premisesOptionalInfo);
        });
        return true;
    }

    //premises preview and edit data
    public function premises_information($tracking = null, $union_id = null, $type = null)
    {
        // dd($tracking , $union_id , $type);
        $prev_data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'COMP1.bn_name as trade_district_name', 'COMP2.bn_name as trade_upazila_name', 'COMP3.bn_name as trade_postoffice_name', 'BSYTP.name_bn as business_type_bn')
            ->join('owner_info AS OWNLST', function ($join) use ($tracking, $union_id) {

                $join->on("OWNLST.tracking", "=", "APP.tracking")
                    ->on("OWNLST.union_id", "=", "APP.union_id")
                    ->where("OWNLST.tracking", "=", $tracking)
                    ->where("OWNLST.union_id", "=", $union_id);
            })
            ->join('premises_optional_info AS TRDOPT', function ($join) use ($tracking, $union_id) {

                $join->on("TRDOPT.tracking", "=", "APP.tracking")
                    ->on("TRDOPT.union_id", "=", "APP.union_id")
                    ->where("TRDOPT.tracking", "=", $tracking)
                    ->where("TRDOPT.union_id", "=", $union_id);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on("CTZ.pin", "=", "OWNLST.pin")
                    ->on("CTZ.union_id", "=", "OWNLST.union_id")
                    ->where("CTZ.union_id", "=", $union_id);
            })
            ->join('business_type AS BSYTP', function ($join) use ($union_id) {

                $join->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    // ->where("BSYTP.type", "=", 2)
                    ->where("BSYTP.is_active", "=", 1);
            })

            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.premises_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.premises_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.premises_postoffice_id')
            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
            ])
            ->get();

        // dd($prev_data);


        //ready trade preview data

        $data = [];

        foreach ($prev_data as $item) {

            if (isset($data['organization'])) {

                $data['organization']["owner_list"][] = [

                    "photo" => $item->photo,
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "father_name_bn" => $item->father_name_bn,
                    "mother_name_bn" => $item->mother_name_bn,
                    "husband_name_bn" => $item->husband_name_bn,
                    "wife_name_bn" => $item->wife_name_bn,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,
                    "permanent_postoffice_name" => $item->permanent_postoffice_name,
                    "permanent_upazila_name" => $item->permanent_upazila_name,
                    "permanent_district_name" => $item->permanent_district_name,
                ];
            } else {

                $owner_list[] = [

                    "photo" => $item->photo,
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "father_name_bn" => $item->father_name_bn,
                    "mother_name_bn" => $item->mother_name_bn,
                    "husband_name_bn" => $item->husband_name_bn,
                    "wife_name_bn" => $item->wife_name_bn,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,
                    "permanent_postoffice_name" => $item->permanent_postoffice_name,
                    "permanent_upazila_name" => $item->permanent_upazila_name,
                    "permanent_district_name" => $item->permanent_district_name,

                ];

                $data["organization"] = [

                    "type" => $item->type,
                    "union_id" => $item->union_id,
                    "tracking" => $item->tracking,
                    "organization_name_bn" => $item->organization_name_bn,
                    "owner_type" => $item->owner_type,
                    "business_type" => $item->business_type_bn,
                    "mobile" => $item->mobile,
                    "email" => $item->email,
                    "phone" => $item->phone,
                    "vat_id" => $item->vat_id,
                    "tax_id" => $item->tax_id,
                    "capital" => $item->capital,
                    "trade_ward_no" => $item->premises_ward_no,
                    "trade_holding_no" => $item->premises_holding_no,
                    "trade_village_bn" => $item->premises_village_bn,
                    "trade_rbs_bn" => $item->premises_rbs_bn,
                    "trade_postoffice_name" => $item->trade_postoffice_name,
                    "trade_upazila_name" => $item->trade_upazila_name,
                    "trade_district_name" => $item->trade_district_name,
                    "created_time" => $item->created_time,

                    "owner_list" => $owner_list,
                ];
            }
        }


        return $data;
    }

    //===premises edit data=======//
    public function premises_data($tracking, $union_id)
    {

        $prev_data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL1.id as permanent_district_id', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL2.id as permanent_upazila_id', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL3.id as permanent_postoffice_id', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL4.id as present_district_id', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL5.id as present_upazila_id', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'BDL6.id as present_postoffice_id', 'COMP1.bn_name as trade_district_name_bn', 'COMP1.en_name as trade_district_name_en', 'COMP1.id as trade_district_id', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP2.en_name as trade_upazila_name_en', 'COMP2.id as trade_upazila_id', 'COMP3.bn_name as trade_postoffice_name_bn', 'COMP3.en_name as trade_postoffice_name_en', 'COMP3.id as trade_postoffice_id', 'APP.id as app_id', 'CTZ.id as citizen_id', 'TRDOPT.id as trade_optional_id', 'OWNLST.id as owner_id', 'TRDOPT.signboard_length', 'TRDOPT.signboard_width', 'TRDOPT.normal_signboard', 'TRDOPT.lighted_signboard', 'TRDOPT.agent_name_en', 'TRDOPT.agent_name_bn', 'TRDOPT.business_start_date', 'TRDOPT.previous_license_data', 'TRDOPT.building_size')
            ->join('owner_info AS OWNLST', function ($join) use ($tracking, $union_id) {

                $join->on("OWNLST.tracking", "=", "APP.tracking")
                    ->on("OWNLST.union_id", "=", "APP.union_id")
                    ->where("OWNLST.tracking", "=", $tracking)
                    ->where("OWNLST.union_id", "=", $union_id);
            })
            ->join('premises_optional_info AS TRDOPT', function ($join) use ($tracking, $union_id) {

                $join->on("TRDOPT.tracking", "=", "APP.tracking")
                    ->on("TRDOPT.union_id", "=", "APP.union_id")
                    ->where("TRDOPT.tracking", "=", $tracking)
                    ->where("TRDOPT.union_id", "=", $union_id);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on("CTZ.pin", "=", "OWNLST.pin")
                    ->on("CTZ.union_id", "=", "OWNLST.union_id")
                    ->where("CTZ.union_id", "=", $union_id);
            })

            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.premises_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.premises_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.premises_postoffice_id')
            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
            ])->get();


        //ready trade preview data

        $data = [];

        foreach ($prev_data as $item) {

            if (isset($data['organization'])) {

                $data["ownerList"][] = [

                    "pin" => $item->pin,
                    "name_en" => $item->name_en,
                    "name_bn" => $item->name_bn,
                    "father_name_en" => $item->father_name_en,
                    "father_name_bn" => $item->father_name_bn,
                    "mother_name_en" => $item->mother_name_en,
                    "mother_name_bn" => $item->mother_name_bn,
                    "husband_name_en" => $item->husband_name_en,
                    "husband_name_bn" => $item->husband_name_bn,
                    "wife_name_en" => $item->wife_name_en,
                    "wife_name_bn" => $item->wife_name_bn,
                    "educational_qualification" => $item->educational_qualification,
                    "photo" => $item->photo,
                    "gender" => $item->gender,
                    "occupation" => $item->occupation,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,

                    "present_village_en" => $item->present_village_en,
                    "present_village_bn" => $item->present_village_bn,
                    "present_rbs_en" => $item->present_rbs_en,
                    "present_rbs_bn" => $item->present_rbs_bn,
                    "present_ward_no" => $item->present_ward_no,
                    "present_holding_no" => $item->present_holding_no,
                    "present_postoffice_name_en" => $item->present_postoffice_name_en,
                    "present_postoffice_name_bn" => $item->present_postoffice_name_bn,
                    "present_postoffice_id" => $item->present_postoffice_id,
                    "present_upazila_name_en" => $item->present_upazila_name_en,
                    "present_upazila_name_bn" => $item->present_upazila_name_bn,
                    "present_upazila_id" => $item->present_upazila_id,
                    "present_district_name_en" => $item->present_district_name_en,
                    "present_district_name_bn" => $item->present_district_name_bn,
                    "present_district_id" => $item->present_district_id,

                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,
                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_postoffice_id" => $item->permanent_postoffice_id,
                    "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
                    "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
                    "permanent_upazila_id" => $item->permanent_upazila_id,
                    "permanent_district_name_en" => $item->permanent_district_name_en,
                    "permanent_district_name_bn" => $item->permanent_district_name_bn,
                    "permanent_district_id" => $item->permanent_district_id,
                    "citizen_id" => $item->citizen_id,
                    "owner_id" => $item->owner_id,
                    "pin" => $item->pin,
                ];
            } else {

                $data['ownerList'][] = [
                    "pin" => $item->pin,
                    "name_en" => $item->name_en,
                    "name_bn" => $item->name_bn,
                    "father_name_en" => $item->father_name_en,
                    "father_name_bn" => $item->father_name_bn,
                    "mother_name_en" => $item->mother_name_en,
                    "mother_name_bn" => $item->mother_name_bn,
                    "husband_name_en" => $item->husband_name_en,
                    "husband_name_bn" => $item->husband_name_bn,
                    "wife_name_en" => $item->wife_name_en,
                    "wife_name_bn" => $item->wife_name_bn,
                    "educational_qualification" => $item->educational_qualification,
                    "occupation" => $item->occupation,
                    "photo" => $item->photo,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,

                    "present_village_en" => $item->present_village_en,
                    "present_village_bn" => $item->present_village_bn,
                    "present_rbs_en" => $item->present_rbs_en,
                    "present_rbs_bn" => $item->present_rbs_bn,
                    "present_ward_no" => $item->present_ward_no,
                    "present_holding_no" => $item->present_holding_no,
                    "present_postoffice_name_en" => $item->present_postoffice_name_en,
                    "present_postoffice_name_bn" => $item->present_postoffice_name_bn,
                    "present_postoffice_id" => $item->present_postoffice_id,
                    "present_upazila_name_en" => $item->present_upazila_name_en,
                    "present_upazila_name_bn" => $item->present_upazila_name_bn,
                    "present_upazila_id" => $item->present_upazila_id,
                    "present_district_name_en" => $item->present_district_name_en,
                    "present_district_name_bn" => $item->present_district_name_bn,
                    "present_district_id" => $item->present_district_id,

                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,
                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_postoffice_id" => $item->permanent_postoffice_id,
                    "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
                    "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
                    "permanent_upazila_id" => $item->permanent_upazila_id,
                    "permanent_district_name_en" => $item->permanent_district_name_en,
                    "permanent_district_name_bn" => $item->permanent_district_name_bn,
                    "permanent_district_id" => $item->permanent_district_id,
                    "citizen_id" => $item->citizen_id,
                    "owner_id" => $item->owner_id,
                    "pin" => $item->pin,

                ];

                $data["organization"] = [
                    'application_id' => $item->app_id,
                    'trade_optional_id' => $item->trade_optional_id,
                    "tracking" => $item->tracking,
                    "organization_name_en" => $item->organization_name_en,
                    "organization_name_bn" => $item->organization_name_bn,
                    "owner_type" => $item->owner_type,
                    "business_type" => $item->business_type,
                    "mobile" => $item->mobile,
                    "email" => $item->email,
                    "phone" => $item->phone,
                    "vat_id" => $item->vat_id,
                    "tax_id" => $item->tax_id,
                    "signboard_length" => $item->signboard_length,
                    "signboard_width" => $item->signboard_width,
                    "normal_signboard" => $item->normal_signboard,
                    "lighted_signboard" => $item->lighted_signboard,
                    "agent_name_en" => $item->agent_name_en,
                    "agent_name_bn" => $item->agent_name_bn,
                    "business_start_date" => $item->business_start_date,
                    "previous_license_data" => $item->previous_license_data,
                    "building_size" => $item->building_size,
                    "building_size" => $item->building_size,
                    "capital" => $item->capital,
                    "office_ward_no" => $item->premises_ward_no,
                    "office_holding_no" => $item->premises_holding_no,
                    "office_village_en" => $item->premises_village_en,
                    "office_village_bn" => $item->premises_village_bn,
                    "office_rbs_en" => $item->premises_rbs_en,
                    "office_rbs_bn" => $item->premises_rbs_bn,
                    "trade_postoffice_name_en" => $item->trade_postoffice_name_en,
                    "trade_postoffice_name_bn" => $item->trade_postoffice_name_bn,
                    "trade_postoffice_id" => $item->trade_postoffice_id,
                    "trade_upazila_name_en" => $item->trade_upazila_name_en,
                    "trade_upazila_name_bn" => $item->trade_upazila_name_bn,
                    "trade_upazila_id" => $item->trade_upazila_id,
                    "trade_district_name_en" => $item->trade_district_name_en,
                    "trade_district_name_bn" => $item->trade_district_name_bn,
                    "trade_district_id" => $item->trade_district_id,
                    "tracking" => $item->tracking,
                ];
            }
        }


        return $data;
    }


    //===premises sonod generate=====//

    public function sonod_generate($receive)
    {


        //certificate data create
        $sonod_data = [

            // 'pin'            => $receive->pin,
            'sonod_no' => $receive->sonod_no,
            'tracking' => $receive->tracking,
            'expire_date' => $receive->expire_date,
            'due_fiscal_year' => ($receive->due_fiscal_year) ? $receive->due_fiscal_year : NULL,
            'type' => $receive->type,
            'status' => $receive->status,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'union_id' => $receive->union_id,
            'district_id' => $receive->district_id,
            'upazila_id' => $receive->upazila_id,
            'memo_no' => $receive->memo,
            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip(),

        ];


        $invoice_id = BillGenerate::generateID();
        $voucher_no =  IdGenerate::voucher($receive->union_id, $receive->fiscal_year_id, 7);

        //ready trans section data
        $transaction_data[] = [

            'union_id' => $receive->union_id,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'voucher' => $voucher_no,
            'sonod_no' => $receive->sonod_no,
            'amount' => $receive->fee,
            'debit' => NULL,
            'credit' => $receive->debit_id,
            'type' => $receive->type,

            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip(),

        ];


        //if have due
        if ($receive->due > 0) {

            //get due account id
            $due_account_id = Global_model::get_account_id($receive->union_id, 23);

            if ($due_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' =>  $voucher_no,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->due,
                    'credit' => $due_account_id,
                    'debit' => NULL,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }


        //if have discount
        if ($receive->discount > 0) {

            //get discount account id
            $discount_account_id = Global_model::get_account_id($receive->union_id, 24);

            if ($discount_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' =>  $voucher_no,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->discount,
                    'debit' => $receive->debit_id,
                    'credit' => $discount_account_id,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }


        //if have vat
        if ($receive->vat > 0) {

            //get vat account id
            $vat_account_id = Global_model::get_account_id($receive->union_id, 25);

            if ($vat_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' =>  $voucher_no,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->vat,
                    'debit' => NULL,
                    'credit' => $vat_account_id,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }


        //if have signbord_vat
        if ($receive->signbord_vat > 0) {

            //get signbord account id
            $signbord_vat_account_id = Global_model::get_account_id($receive->union_id, 21, 201);

            if ($signbord_vat_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' =>  $voucher_no,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->signbord_vat,
                    'debit' => NULL,
                    'credit' => $signbord_vat_account_id,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }


        //if have source vat
        if ($receive->source_vat > 0) {

            //get sarcharge account id
            $source_vat_account_id = Global_model::get_account_id($receive->union_id, 97, 201); // 97 = source_vat //
            // 201 = premises lience

            if ($source_vat_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' =>  $voucher_no,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->source_vat,
                    'debit' => NULL,
                    'credit' => $source_vat_account_id,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }


        //if have sarcharge
        if ($receive->sarcharge > 0) {

            //get sarcharge account id
            $sarcharge_account_id = Global_model::get_account_id($receive->union_id, 22, 201);

            if ($sarcharge_account_id < 0) {

                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [

                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' =>  $voucher_no,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->sarcharge,
                    'debit' => NULL,
                    'credit' => $sarcharge_account_id,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }

        // ready invoice data //
        $invoice_data = [
            'union_id' => $receive->union_id,
            'invoice_id' => $invoice_id,
            'voucher_no' => $voucher_no,
            'sonod_no' => $receive->sonod_no,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'amount' =>  array_sum(array_column($transaction_data,'amount')),
            'is_paid' => 1,
            'payment_date' =>$receive->generate_date . ' ' . date('h:i:s'),
            'type' =>  7, // 5 = warish
            'created_by' => Auth::user()->employee_id,
            'created_at' => Carbon::now(),
            'created_by_ip' => \request()->ip()
        ];


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

            //certificate create
            DB::table("certificate")->insert($sonod_data);

            //invoice data save
            DB::table("acc_invoice")->insert($invoice_data);

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

    //====premiseslicense certificate data=====//

    public function premises_certificate_data($sonod_no = null, $union_id = null, $type = null)
    {

        $certificate_data = DB::table('certificate AS CRT')
            ->select('CRT.*', 'CRT.status as crt_status', 'CRT.sonod_no', 'CRT.created_time as generate_date', 'APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'TRDOPT.email', 'OWNLST.*', 'FSY.name as fiscal_year_name', 'BDL1.bn_name as permanent_district_name_bn', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL4.bn_name as present_district_name_bn', 'BDL5.bn_name as present_upazila_name_bn', 'BDL6.bn_name as present_postoffice_name_bn', 'COMP1.bn_name as trade_district_name_bn', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP3.bn_name as trade_postoffice_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.en_name as present_district_name_en', 'BDL5.en_name as present_upazila_name_en', 'BDL6.en_name as present_postoffice_name_en', 'COMP1.en_name as trade_district_name_en', 'COMP2.en_name as trade_upazila_name_en', 'COMP3.en_name as trade_postoffice_name_en', 'BSYTP.name_bn as business_type_bn', 'BSYTP.name_en as business_type_en', 'CRT.type', 'TRDOPT.signboard_length', 'TRDOPT.signboard_width', 'TRDOPT.normal_signboard', 'TRDOPT.lighted_signboard', 'TRDOPT.agent_name_en', 'TRDOPT.agent_name_bn', 'TRDOPT.business_start_date', 'TRDOPT.previous_license_data')
            ->join('application AS APP', function ($join) use ($union_id) {

                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->where("APP.union_id", "=", $union_id)
                    ->where("CRT.union_id", "=", $union_id)
                    ->where("APP.is_active", "=", 1);
            })
            ->join('premises_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('owner_info AS OWNLST', function ($join) use ($union_id) {

                $join->on("OWNLST.tracking", "=", "CRT.tracking")
                    ->on("OWNLST.union_id", "=", "CRT.union_id")
                    ->where("OWNLST.union_id", "=", $union_id)
                    ->where("OWNLST.is_active", "=", 1);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on("CTZ.pin", "=", "OWNLST.pin")
                    ->on("CTZ.union_id", "=", "OWNLST.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("CTZ.is_active", "=", 1);
            })
            ->join('business_type AS BSYTP', function ($join) use ($union_id) {

                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("BSYTP.is_active", "=", 1);
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
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.premises_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.premises_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.premises_postoffice_id')
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
                ['APP.type', '=', $type],
            ])
            ->orderBy('CRT.id', 'DESC')
            ->get();


        //ready trade certificate  data

        $data = [];

        foreach ($certificate_data as $item) {

            if (isset($data['organization'])) {

                //if set organization then set only owner data

                $data['organization']["owner_list"][] = [

                    "photo" => $item->photo,
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "name_en" => $item->name_en,
                    "father_name_bn" => $item->father_name_bn,
                    "father_name_en" => $item->father_name_en,
                    "mother_name_bn" => $item->mother_name_bn,
                    "mother_name_en" => $item->mother_name_en,
                    "husband_name_bn" => $item->husband_name_bn,
                    "husband_name_en" => $item->husband_name_en,
                    "wife_name_bn" => $item->wife_name_bn,
                    "wife_name_en" => $item->wife_name_en,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,

                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
                    "permanent_district_name_bn" => $item->permanent_district_name_bn,

                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
                    "permanent_district_name_en" => $item->permanent_district_name_en,
                ];
            } else {

                //first owner set in array

                $owner_list[] = [
                    "photo" => $item->photo,
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "name_en" => $item->name_en,
                    "father_name_bn" => $item->father_name_bn,
                    "father_name_en" => $item->father_name_en,
                    "mother_name_bn" => $item->mother_name_bn,
                    "mother_name_en" => $item->mother_name_en,
                    "husband_name_bn" => $item->husband_name_bn,
                    "husband_name_en" => $item->husband_name_en,
                    "wife_name_bn" => $item->wife_name_bn,
                    "wife_name_en" => $item->wife_name_en,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,

                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
                    "permanent_district_name_bn" => $item->permanent_district_name_bn,

                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
                    "permanent_district_name_en" => $item->permanent_district_name_en,

                ];

                //organizatin data set
                $data["organization"] = [
                    "union_id" => $item->union_id,
                    "tracking" => $item->tracking,
                    "sonod_no" => $item->sonod_no,
                    "type" => $item->type,
                    "status" => $item->crt_status,
                    "organization_name_bn" => $item->organization_name_bn,
                    "organization_name_en" => $item->organization_name_bn,
                    "fiscal_year_id" => $item->fiscal_year_id,
                    "fiscal_year_name" => $item->fiscal_year_name,
                    "owner_type" => $item->owner_type,
                    "business_type_bn" => $item->business_type_bn,
                    "business_type_en" => $item->business_type_en,
                    "mobile" => $item->mobile,
                    "email" => $item->email,
                    "phone" => $item->phone,
                    "vat_id" => $item->vat_id,
                    "tax_id" => $item->tax_id,
                    "signboard_length" => $item->signboard_length,
                    "signboard_width" => $item->signboard_width,
                    "normal_signboard" => $item->normal_signboard,
                    "lighted_signboard" => $item->lighted_signboard,
                    "agent_name_en" => $item->agent_name_en,
                    "agent_name_bn" => $item->agent_name_bn,
                    "business_start_date" => $item->business_start_date,
                    "previous_license_data" => $item->previous_license_data,
                    "capital" => $item->capital,
                    "trade_ward_no" => $item->premises_ward_no,
                    "trade_holding_no" => $item->premises_holding_no,
                    "trade_village_bn" => $item->premises_village_bn,
                    "trade_village_en" => $item->premises_village_en,
                    "trade_rbs_bn" => $item->premises_rbs_bn,
                    "trade_rbs_en" => $item->premises_rbs_en,

                    "trade_postoffice_name_bn" => $item->trade_postoffice_name_bn,
                    "trade_upazila_name_bn" => $item->trade_upazila_name_bn,
                    "trade_district_name_bn" => $item->trade_district_name_bn,

                    "trade_postoffice_name_en" => $item->trade_postoffice_name_en,
                    "trade_upazila_name_en" => $item->trade_upazila_name_en,
                    "trade_district_name_en" => $item->trade_district_name_en,

                    "generate_date" => $item->generate_date,
                    "expire_date" => $item->expire_date,

                    "owner_list" => $owner_list,
                ];
            }
        }


        //get license fee
        $fee_data = DB::table('certificate AS CRT')
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



            //for pehsa kor, vat and trade transection
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', 28)
                    ->orWhere('TRNS.type', '=', 25)
                    ->orWhere('TRNS.type', '=', 97)
                    ->orWhere('TRNS.type', '=', $type);
            })
            ->get();


        //ready fee array
        $fee_list = [];

        foreach ($fee_data as $fee) {

            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount,

            ];
        }


        $data['fee_data'] = $fee_list;


        //if not found array data
        if (empty($data['organization']) || empty($data['fee_data'])) {

            return false;
        } else {

            return $data;
        }
    }

    //===previous trade certificate data====//
    public function previous_premises_certificate_data($sonod_no = null, $union_id = null, $type = null,
                                                       $fiscal_year_id = null)
    {

        $certificate_data = DB::table('certificate AS CRT')
            ->select('CRT.*', 'CRT.sonod_no', 'CRT.created_time as generate_date', 'APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'TRDOPT.email', 'OWNLST.*', 'FSY.name as fiscal_year_name', 'FSY.id as fiscal_year_id', 'BDL1.bn_name as permanent_district_name_bn', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL4.bn_name as present_district_name_bn', 'BDL5.bn_name as present_upazila_name_bn', 'BDL6.bn_name as present_postoffice_name_bn', 'COMP1.bn_name as trade_district_name_bn', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP3.bn_name as trade_postoffice_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.en_name as present_district_name_en', 'BDL5.en_name as present_upazila_name_en', 'BDL6.en_name as present_postoffice_name_en', 'COMP1.en_name as trade_district_name_en', 'COMP2.en_name as trade_upazila_name_en', 'COMP3.en_name as trade_postoffice_name_en', 'BSYTP.name_bn as business_type_bn', 'BSYTP.name_en as business_type_en', 'CRT.type')
            ->join('application AS APP', function ($join) use ($union_id) {

                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->where("APP.union_id", "=", $union_id)
                    ->where("CRT.union_id", "=", $union_id)
                    ->where("APP.is_active", "=", 1);
            })
            ->join('premises_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('owner_info AS OWNLST', function ($join) use ($union_id) {

                $join->on("OWNLST.tracking", "=", "CRT.tracking")
                    ->on("OWNLST.union_id", "=", "CRT.union_id")
                    ->where("OWNLST.union_id", "=", $union_id)
                    ->where("OWNLST.is_active", "=", 1);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on("CTZ.pin", "=", "OWNLST.pin")
                    ->on("CTZ.union_id", "=", "OWNLST.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("CTZ.is_active", "=", 1);
            })
            ->join('business_type AS BSYTP', function ($join) use ($union_id) {

                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("BSYTP.is_active", "=", 1);
            })
            ->join('fiscal_years AS FSY', function ($join) use ($union_id, $fiscal_year_id) {

                $join->on("FSY.id", "=", 'CRT.fiscal_year_id')
                    // ->where("FSY.is_current", "=", '1')
                    ->where("FSY.is_active", "=", '1');
            })


            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.trade_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.trade_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.trade_postoffice_id')
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
                ['APP.type', '=', $type],
            ])
            ->get();

// dd($certificate_data);
        //ready trade certificate  data

        $data = [];

        foreach ($certificate_data as $item) {

            if (isset($data['organization'])) {

                //if set organization then set only owner data

                $data['organization']["owner_list"][] = [

                    "photo" => $item->photo,
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "name_en" => $item->name_en,
                    "father_name_bn" => $item->father_name_bn,
                    "father_name_en" => $item->father_name_en,
                    "mother_name_bn" => $item->mother_name_bn,
                    "mother_name_en" => $item->mother_name_en,
                    "husband_name_bn" => $item->husband_name_bn,
                    "husband_name_en" => $item->husband_name_en,
                    "wife_name_bn" => $item->wife_name_bn,
                    "wife_name_en" => $item->wife_name_en,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,

                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
                    "permanent_district_name_bn" => $item->permanent_district_name_bn,

                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
                    "permanent_district_name_en" => $item->permanent_district_name_en,
                ];
            } else {

                //first owner set in array

                $owner_list[] = [
                    "photo" => $item->photo,
                    "pin" => $item->pin,
                    "name_bn" => $item->name_bn,
                    "name_en" => $item->name_en,
                    "father_name_bn" => $item->father_name_bn,
                    "father_name_en" => $item->father_name_en,
                    "mother_name_bn" => $item->mother_name_bn,
                    "mother_name_en" => $item->mother_name_en,
                    "husband_name_bn" => $item->husband_name_bn,
                    "husband_name_en" => $item->husband_name_en,
                    "wife_name_bn" => $item->wife_name_bn,
                    "wife_name_en" => $item->wife_name_en,
                    "gender" => $item->gender,
                    "mobile" => $item->citizen_mobile,
                    "nid" => $item->nid,
                    "birth_id" => $item->birth_id,
                    "marital_status" => $item->marital_status,
                    "resident" => $item->resident,
                    "religion" => $item->religion,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,

                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
                    "permanent_district_name_bn" => $item->permanent_district_name_bn,

                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
                    "permanent_district_name_en" => $item->permanent_district_name_en,

                ];

                //organizatin data set
                $data["organization"] = [
                    "union_id" => $item->union_id,
                    "tracking" => $item->tracking,
                    "sonod_no" => $item->sonod_no,
                    "type" => $item->type,
                    "organization_name_bn" => $item->organization_name_bn,
                    "organization_name_en" => $item->organization_name_bn,
                    "fiscal_year_id" => $item->fiscal_year_id,
                    "fiscal_year_name" => $item->fiscal_year_name,
                    "owner_type" => $item->owner_type,
                    "business_type_bn" => $item->business_type_bn,
                    "business_type_en" => $item->business_type_en,
                    "mobile" => $item->mobile,
                    "email" => $item->email,
                    "phone" => $item->phone,
                    "vat_id" => $item->vat_id,
                    "tax_id" => $item->tax_id,
                    "capital" => $item->capital,
                    "trade_ward_no" => $item->trade_ward_no,
                    "trade_holding_no" => $item->trade_holding_no,
                    "trade_village_bn" => $item->trade_village_bn,
                    "trade_village_en" => $item->trade_village_en,
                    "trade_rbs_bn" => $item->trade_rbs_bn,
                    "trade_rbs_en" => $item->trade_rbs_en,

                    "trade_postoffice_name_bn" => $item->trade_postoffice_name_bn,
                    "trade_upazila_name_bn" => $item->trade_upazila_name_bn,
                    "trade_district_name_bn" => $item->trade_district_name_bn,

                    "trade_postoffice_name_en" => $item->trade_postoffice_name_en,
                    "trade_upazila_name_en" => $item->trade_upazila_name_en,
                    "trade_district_name_en" => $item->trade_district_name_en,

                    "generate_date" => $item->generate_date,
                    "expire_date" => $item->expire_date,

                    "owner_list" => $owner_list,
                ];
            }
        }
// dd($data);

        //get license fee
        $fee_data = DB::table('certificate AS CRT')
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



            //for pehsa kor, vat and trade transection
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', 28)
                    ->orWhere('TRNS.type', '=', 25)
                    ->orWhere('TRNS.type', '=', $type);
            })
            ->get();

        //ready fee array
        $fee_list = [];

        foreach ($fee_data as $fee) {
            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount,

            ];
        }

        $data['fee_data'] = $fee_list;


        //if not found array data
        if (empty($data['organization']) || empty($data['fee_data'])) {

            return false;
        } else {

            return $data;
        }
    }


    //======premises update====//

    public function update_premises($receive)
    {
//        dd($receive->all());

        $union_id = Auth::user()->union_id;
        $citizen_data = [];
        $owner_data = [];

        for ($i = 0; $i < count($receive->name_bn); $i++) {

            //citizen information
            $citizen_data[] = [
                "id" => isset($receive->citizen_id[$i]) ? $receive->citizen_id[$i] : null,
                "pin" => isset($receive->pin[$i]) ? $receive->pin[$i] : null,
                "nid" => isset($receive->nid[$i]) ? $receive->nid[$i] : null,
                "birth_id" => isset($receive->birth_id[$i]) ? $receive->birth_id[$i] : null,

                'name_en' => isset($i, $receive->name_en[$i]) ? $receive->name_en[$i] : null,
                'name_bn' => $receive->name_bn[$i],
                'father_name_bn' => isset($i, $receive->father_name_bn[$i]) ? $receive->father_name_bn[$i] : null,
                'father_name_en' => isset($i, $receive->father_name_en[$i]) ? $receive->father_name_en[$i] : null,
                'mother_name_bn' => isset($i, $receive->mother_name_bn[$i]) ? $receive->mother_name_bn[$i] : null,
                'mother_name_en' => isset($i, $receive->mother_name_en[$i]) ? $receive->mother_name_en[$i] : null,
                'husband_name_bn' => isset($i, $receive->husband_name_bn[$i]) ? $receive->husband_name_bn[$i] : NULL,
                'husband_name_en' => isset($i, $receive->husband_name_en[$i]) ? $receive->husband_name_en[$i] : NULL,

                'religion' => isset($i, $receive->religion[$i]) ? $receive->religion[$i] : '',
                'resident' => isset($i, $receive->resident[$i]) ? $receive->resident[$i] : '',
                'gender' => $receive->gender[$i],
                'occupation' => $receive->occupation[$i],

                'marital_status' => isset($i, $receive->marital_status[$i]) ? $receive->marital_status[$i] : null,

                'educational_qualification' => $receive->educational_qualification[$i],
                'permanent_village_bn' => isset($i, $receive->permanent_village_bn[$i]) ? $receive->permanent_village_bn[$i] : null,
                'permanent_village_en' => isset($i, $receive->permanent_village_en[$i]) ? $receive->permanent_village_en[$i] : '',
                'permanent_rbs_bn' => isset($i, $receive->permanent_rbs_bn[$i]) ? $receive->permanent_rbs_bn[$i] : null,
                'permanent_rbs_en' => isset($i, $receive->permanent_rbs_en[$i]) ? $receive->permanent_rbs_en[$i] : null,
                'permanent_ward_no' => isset($i, $receive->permanent_ward_no[$i]) ? $receive->permanent_ward_no[$i] : null,
                'permanent_holding_no' => isset($i, $receive->permanent_holding_no[$i]) ? $receive->permanent_holding_no[$i] : null,
                'permanent_district_id' => isset($i, $receive->permanent_district_id[$i]) ? $receive->permanent_district_id[$i] : null,
                'permanent_upazila_id' => isset($i, $receive->permanent_upazila_id[$i]) ? $receive->permanent_upazila_id[$i] : null,
                'permanent_postoffice_id' => isset($i, $receive->permanent_postoffice_id[$i]) ? $receive->permanent_postoffice_id[$i] : null,


                'updated_by' => Auth::user()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $receive->ip(),

            ];

            //owner information

            $owner_data[] = [
                "pin" => $citizen_data[$i]['pin'],
                "tracking" => $receive->tracking,
                'fiscal_year_id' => $receive->fiscal_year_id,
                'present_village_bn' => isset($i, $receive->present_village_bn[$i]) ? $receive->present_village_bn[$i] : null,
                'present_village_en' => isset($i, $receive->present_village_en[$i]) ? $receive->present_village_en[$i] : null,
                'present_rbs_bn' => isset($i, $receive->present_rbs_bn) ? $receive->present_rbs_bn[$i] : null,
                'present_rbs_en' => isset($i, $receive->present_rbs_en[$i]) ? $receive->present_rbs_en[$i] : null,
                'present_ward_no' => isset($i, $receive->present_ward_no[$i]) ? $receive->present_ward_no[$i] : null,
                'present_holding_no' => isset($i, $receive->present_holding_no[$i]) ? $receive->present_holding_no[$i] : null,
                'present_district_id' => isset($i, $receive->present_district_id[$i]) ? $receive->present_district_id[$i] : null,
                'present_upazila_id' => isset($i, $receive->present_upazila_id[$i]) ? $receive->present_upazila_id[$i] : null,
                'present_postoffice_id' => isset($i, $receive->present_postoffice_id[$i]) ? $receive->present_postoffice_id[$i] : null,

                'updated_by' => Auth::user()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $receive->ip(),

            ];
        }

        //application table data
        $application_data = [

            'pin' => null,
            'tracking' => $receive->tracking,
            'type' => 90,
            'comment_bn' => null,
            'comment_en' => null,
            'fiscal_year_id' => $receive->fiscal_year_id,

            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $receive->ip(),

        ];

        //premises license optional info

        $premises_optional_info = [

            'pin' => null,
            'organization_name_bn' => $receive->organization_name_bn,
            'organization_name_en' => $receive->organization_name_en,
            'vat_id' => $receive->vat_id,
            'tax_id' => $receive->tax_id,
            'signboard_length' => $receive->signboard_length,
            'signboard_width' => $receive->signboard_width,
            'normal_signboard' => $receive->normal_signboard,
            'lighted_signboard' => $receive->lighted_signboard,
            'agent_name_en' => $receive->agent_name_en,
            'agent_name_bn' => $receive->agent_name_bn,
            'business_start_date' => $receive->business_start_date,
            'previous_license_data' => $receive->previous_license_data,
            'building_size' => $receive->building_size,
            'capital' => $receive->capital,
            'tracking' => $receive->tracking,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'owner_type' => $receive->owner_type,

            'mobile' => $receive->mobile,
            'email' => $receive->email,
            'phone' => $receive->tel,

            'premises_village_bn' => $receive->office_village_bn,
            'premises_village_en' => $receive->office_village_en,
            'premises_rbs_bn' => $receive->office_rbs_bn,
            'premises_rbs_en' => $receive->office_rbs_en,
            'premises_holding_no' => $receive->office_holding_no,
            'premises_ward_no' => $receive->office_ward_no,
            'premises_district_id' => $receive->trade_district_id,
            'premises_upazila_id' => $receive->trade_upazila_id,
            'premises_postoffice_id' => $receive->trade_postoffice_id,

            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $receive->ip(),

        ];

        $b_type = BusinessType::where('name_bn', trim($receive->business_type))
            ->where('union_id', $union_id)
            // ->where('type', 2)
            ->first();

        if ($b_type) { //business type have
            $premises_optional_info['business_type'] = $b_type->id;
        } else { //business type hav'nt

            $business_type_data = [
                'union_id' => $union_id,
                'name_bn' => $receive->business_type,
                'is_active' => 1,
                // 'type' => 2, // 2 = premises
                'created_by' => auth()->user()->employee_id,
                'created_time' => Carbon::now(),
                'created_by_ip' => Request::ip(),
            ];

            $premises_optional_info['business_type'] = BusinessType::create($business_type_data)->id;
        }

        // dd($trade_optional_info['business_type']);
        DB::beginTransaction();



        try {
            foreach ($citizen_data as $key => $value) {



                //single and multiple photo upload
                if ($receive->hasfile('photo' . $key)) {

                    $photo = $citizen_data[$key]["pin"] . "." . $receive->file('photo' . $key)[0]->getClientOriginalExtension();



                    $location = public_path("assets/images/application/" . $photo);



                    //upload image in folder
                    $move = Image::make($receive->file('photo' . $key)[0])->resize(300,300)->save($location);

                    //store photo in citizen array
                    $citizen_data[$key]['photo'] = $photo;
                }

                // if extra owner added
                if (!isset($receive->citizen_id[$key])) {

                    unset($citizen_data[$key]["id"]);

                    $citizen_data[$key]["pin"] = (new IdGenerate())->pin($union_id);
                    $citizen_data[$key] += [
                        'union_id' => $union_id,
                        'created_by' => Auth::user()->employee_id,
                        'created_time' => Carbon::now(),
                        'created_by_ip' => $receive->ip(),
                    ];

                    DB::table("citizen_information")->insert($citizen_data[$key]);

                    $owner_data[$key]["pin"] = $citizen_data[$key]["pin"];
                    $owner_data[$key] += [
                        'union_id' => $union_id,
                        'created_by' => Auth::user()->employee_id,
                        'created_time' => Carbon::now(),
                        'created_by_ip' => $receive->ip(),
                    ];

                    DB::table("owner_info")->insert($owner_data[$key]);
                } else {
                    DB::table("citizen_information")
                        ->where('id', $value['id'])
                        ->where('union_id', $union_id)
                        ->update($citizen_data[$key]);

                    DB::table("owner_info")
                        ->where('pin', $value['pin'])
                        ->where('union_id', $union_id)
                        ->update($owner_data[$key]);
                }
            }
            DB::table("application")
                ->where('tracking', $application_data['tracking'])
                ->where('id', $receive->application_id)
                ->where('union_id', $union_id)
                ->update($application_data);

            DB::table("premises_optional_info")
                ->where('id', $receive->trade_optional_id)
                ->where('tracking', $application_data['tracking'])
                ->where('union_id', $union_id)
                ->update($premises_optional_info);

            DB::commit();
            return ["status" => "success", "message" => "Your application Update successfully."];
        } catch (Exception $e) {
            DB::rollBack();
            return ["status" => "error", "message" => "তথ্য আপডেট হয়নি।"];
        }
    }

    //===tradelicense info delete===//
    public function premises_info_delete($request)
    {

        DB::beginTransaction();

        try {
            DB::table('application')
                ->where('tracking', $request->tracking)
                ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

            DB::table('owner_info')
                ->where('tracking', $request->tracking)
                ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

            DB::table('premises_optional_info')
                ->where('tracking', $request->tracking)
                ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

            DB::commit();
            return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
        }
    }

    //===premiseslicense applicant list data=====//

    public function premises_applicant_list_data($receive)
    {

        $union_id = $receive['union_id'];

        DB::enableQueryLog();

        $query = DB::table('application AS APP')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.tracking', 'APP.created_time', 'TRDOPT.organization_name_bn', 'TRDOPT.business_type', 'TRDOPT.tracking', 'TRDOPT.mobile', 'TRDOPT.email', 'TRDOPT.owner_type', 'TRDOPT.premises_upazila_id', 'TRDOPT.premises_district_id', 'APP.union_id', 'BSYTP.name_bn as business_type_bn')

            ->join('premises_optional_info AS TRDOPT', function ($join) use ($receive) {
                $join->on("TRDOPT.tracking", "=", "APP.tracking")
                    ->on("TRDOPT.union_id", "=", "APP.union_id")
                    ->where("TRDOPT.union_id", "=", $receive['union_id'])
                    ->where("APP.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("TRDOPT.is_active", "=", 1);
            })

            ->join('business_type AS BSYTP', function ($join) use ($union_id, $receive) {
                $join->on("BSYTP.union_id", "=", "APP.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("APP.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("BSYTP.is_active", "=", 1);
            })

            ->where([
                ['APP.union_id', '=', $receive['union_id']],
                ['APP.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['APP.type', '=', 90], // 90 = premises
                ['APP.status', '=', 0],
                ['APP.is_active', '=', 1],
            ])

            ->whereDate('APP.created_time', '>=', $receive['from_date'])
            ->whereDate('APP.created_time', '<=', $receive['to_date'])
            ->offset($receive['start'])
            ->limit($receive['limit'])
            ->orderBy('APP.id', 'DESC');


        //for datatable on page searching
        if ($receive['search_content'] != false) {

            $query->where("APP.tracking", "LIKE", $receive['search_content'])
                ->orWhere("TRDOPT.mobile", "LIKE", $receive['search_content'])
                ->orWhere("TRDOPT.organization_name_bn", "LIKE", "%" . $receive['search_content'] . "%");
        }

        $data['data'] = $query->get();

        return $data;
    }

    //====tradelicense certificate list data====//
    public function premises_certificate_list($receive)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.owner_type', 'TRDOPT.business_type', 'TRDOPT.mobile', 'TRDOPT.email')

            ->join('application AS APP', function ($join) use($receive) {
                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->on("APP.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("APP.fiscal_year_id", $receive['fiscal_year_id'])
                    ->where("APP.fiscal_year_id", $receive['fiscal_year_id'])
                    ->where("APP.is_active", "=", 1);
            })

            ->join('premises_optional_info AS TRDOPT', function ($join) use($receive) {
                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("CRT.fiscal_year_id", $receive['fiscal_year_id'])
                    ->where("TRDOPT.is_active", "=", 1);
            })

            ->where([
                ['CRT.union_id', '=', $receive['union_id']],
                ['CRT.type', '=', 90],
                ['CRT.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['CRT.is_active', '=', 1],
                ['APP.union_id', '=', $receive['union_id']],
                ['APP.type', '=', 90],
                ['APP.is_active', '=', 1],
            ])

            ->whereDate('CRT.created_time', '>=', $receive['from_date'])
            ->whereDate('CRT.created_time', '<=', $receive['to_date'])
            ->offset($receive['start'])
            ->limit($receive['limit']);

        //for datatable on page searching
        if ($receive['search_content'] != false) {
            $query->where("CRT.tracking", "LIKE", $receive['search_content'])
                ->orWhere("CRT.sonod_no", "LIKE", $receive['search_content'])
                ->orWhere("TRDOPT.mobile", "LIKE", $receive['search_content'])
                ->orWhere("TRDOPT.organization_name_bn", "LIKE", "%" . $receive['search_content'] . "%");
        }

        $data['data'] = $query->get();

        return $data;
    }


    //====previous premiseslicense certificate list data====//
    public function prev_premises_certificate_list($receive)
    {

        DB::enableQueryLog();


        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.owner_type', 'TRDOPT.business_type', 'TRDOPT.mobile', 'TRDOPT.email')
            ->join('application AS APP', function ($join) {

                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->where("APP.is_active", "=", 1);
            })
            ->join('premises_optional_info AS TRDOPT', function ($join) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->where([
                ['CRT.union_id', '=', $receive['union_id']],
                ['CRT.type', '=', 90],
                ['CRT.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['CRT.is_active', '=', 1],
                ['APP.union_id', '=', $receive['union_id']],
                ['APP.type', '=', 90],
                ['APP.is_active', '=', 1],
            ])
            ->whereDate('CRT.created_time', '>=', $receive['from_date'])
            ->whereDate('CRT.created_time', '<=', $receive['to_date'])
            ->offset($receive['start'])
            ->limit($receive['limit']);


        //for datatable on page searching
        if ($receive['search_content'] != false) {

            $query->where("CRT.tracking", "LIKE", $receive['search_content'])
                ->orWhere("CRT.sonod_no", "LIKE", $receive['search_content'])
                ->orWhere("TRDOPT.mobile", "LIKE", $receive['search_content'])
                ->orWhere("TRDOPT.organization_name_bn", "LIKE", "%" . $receive['search_content'] . "%");
        }

        $data['data'] = $query->get();

        return $data;
    }

    //====expire premiseslicense  list data====//
    public function expire_premises_certificate_list($union_id = null)
    {

        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CRT.created_time as generate_date', 'CRT.expire_date', 'CRT.union_id', 'TRDOPT.organization_name_bn', 'TRDOPT.owner_type', 'BTYPE.name_bn as business_type', 'TRDOPT.mobile', 'TRDOPT.email', 'TRDOPT.premises_upazila_id', 'TRDOPT.premises_district_id')
            ->join('application AS APP', function ($join) {

                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->where("APP.is_active", "=", 1);
            })
            ->join('premises_optional_info AS TRDOPT', function ($join) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('business_type AS BTYPE', function ($join) {

                $join->on("BTYPE.id", "=", "TRDOPT.business_type")
                    ->on("BTYPE.union_id", "=", "CRT.union_id")
                    ->where("BTYPE.is_active", "=", 1);
            })
            ->where([
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', 90],
                ['CRT.is_active', '=', 1],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', 90],
                ['APP.is_active', '=', 1],
            ])
            ->where('CRT.status', '=', 3)
            ->get();

        return $query;
    }


    //====get money data=======//
    public function money_receipt_data($sonod_no = null, $union_id = null, $type = null)
    {


        DB::enableQueryLog();


        $data['organization'] = DB::table('certificate AS CRT')
            ->select('CRT.sonod_no', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.premises_village_bn', 'TRDOPT.premises_ward_no', 'FSY.name as fiscal_year_name', 'BSYTP.name_bn as business_type')
            ->join('premises_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('business_type AS BSYTP', function ($join) use ($union_id) {

                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("BSYTP.is_active", "=", 1);
            })
            ->join('fiscal_years AS FSY', function ($join) use ($union_id) {

                $join->on("FSY.id", "=", 'CRT.fiscal_year_id')
                    ->where("FSY.is_current", "=", '1')
                    ->where("FSY.is_active", "=", '1');
            })
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
            ])
            ->first();


        //get license fee
        $fee_data = DB::table('certificate AS CRT')
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
                    // ->where('ACCDBT.acc_type', '!=', 26)
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })

            // ->leftJoin('acc_account AS ACCRDT', function ($join) use($union_id){

            //     $join->on('ACCRDT.id', '=', 'TRNS.credit')
            //         ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
            //         ->where('ACCRDT.acc_type', 24)
            //         ->where('ACCRDT.is_active', 1)
            //         ->where('ACCRDT.union_id', $union_id);
            // })

            //for pehsa kor and trade transection
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', $type);
            })
            ->get();

        //ready fee array
        $fee_list = [];
        foreach ($fee_data as $fee) {

            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount,

            ];

            //voucher no assign in organization
            $data['organization']->voucher = $fee->voucher;
        }

        $data['fee_data'] = $fee_list;

        // dd($data);
        //if not found array data
        if (empty($data['organization']) || empty($data['fee_data'])) {

            return false;
        } else {

            return $data;
        }
    }

    //==========premises license register data==============//
    public function premises_register_data($union_id = null, $type = null, $from_date = null, $to_date = null)
    {

        $register_data = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'CRT.memo_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'TRDOPT.organization_name_bn', 'BSYTP.name_bn as business_type', 'ACCDBT.account_name as debit_account_name', 'ACCDBT.acc_type as debit_account_type', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
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
            ->join('premises_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('business_type AS BSYTP', function ($join) use ($union_id) {

                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("BSYTP.is_active", "=", 1);
            })

            //for  premises transection
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', $type);
            })
            ->whereDate('CRT.created_time', '>=', $from_date)
            ->whereDate('CRT.created_time', '<=', $to_date)
            ->get();


        //ready register data
        $data = [];


        foreach ($register_data as $item) {

            if (isset($data[$item->sonod_no])) {

                if ($item->credit_account_type == 90) {
                    $data[$item->sonod_no]['fee'] = $item->amount;
                }

                if ($item->credit_account_type == 23) {
                    $data[$item->sonod_no]['due'] = $item->amount;
                }

                if ($item->credit_account_type == 25) {
                    $data[$item->sonod_no]['vat'] = $item->amount;
                }

                if ($item->credit_account_type == 24) {
                    $data[$item->sonod_no]['discount'] = $item->amount;
                }

                if ($item->credit_account_type == 21) {
                    $data[$item->sonod_no]['signbord_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 97) {
                    $data[$item->sonod_no]['source_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 22) {
                    $data[$item->sonod_no]['sarcharge'] = $item->amount;
                }
            } else {

                $data[$item->sonod_no] = [

                    'organization_name' => $item->organization_name_bn,
                    'payment_date' => $item->payment_date,
                    'business_type' => $item->business_type,
                    'memo_no' => $item->memo_no,
                    'fee' => ($item->credit_account_type == 90) ? $item->amount : 0,
                    'due' => ($item->credit_account_type == 23) ? $item->amount : 0,
                    'vat' => ($item->credit_account_type == 25) ? $item->amount : 0,
                    'discount' => ($item->credit_account_type == 24) ? $item->amount : 0,
                    'signbord_vat' => ($item->credit_account_type == 21) ? $item->amount : 0,
                    'pesha_vat' => ($item->credit_account_type == 28) ? $item->amount : 0,
                    'source_vat' => ($item->credit_account_type == 97) ? $item->amount : 0,
                    'sarcharge' => ($item->credit_account_type == 22) ? $item->amount : 0,

                ];
            }
        }


        return $data;
    }


}
