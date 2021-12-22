<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Global_model;
use App\Models\Management\BusinessType;
use App\Models\BillGenerate;
use Carbon\Carbon;
use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use stdClass;

class Tradelicense extends Model
{

    //get all business type
    public function get_business_type($union_id = null)
    {

        $query = DB::table('business_type')->select('id', 'name_bn', 'name_en')
            ->where('union_id', $union_id)
            ->where('type', 1) // 1 = trade
            ->get();

        return $query;
    }

    //====tradelicense application store====//
    public function data_store($receive)
    {
        $citizen_data = [];
        $owner_data = [];

        $present_district_id = [];
        $present_upazila_id = [];
        $present_postoffice_id = [];

        $permanent_district_id = [];
        $permanent_upazila_id = [];
        $permanent_postoffice_id = [];

        // dd($receive);

        for ($i = 0; $i < count($receive->name_bn); $i++) {

            // address adding
            // if address is new

            // present address
            if(empty($receive->present_district_id[$i])){
                $present_district_id[$i] = $this->findLocation($receive->present_district_txt[$i], null, 2);
            } else {
                $present_district_id[$i] = $receive->present_district_id[$i];
            }

            if(empty($receive->present_upazila_id[$i])){
                $present_upazila_id[$i] = $this->findLocation($receive->present_upazila_txt[$i], $present_district_id[$i], 3);
            } else {
                $present_upazila_id[$i] = $receive->present_upazila_id[$i];
            }

            if(empty($receive->present_postoffice_id[$i])){
                $present_postoffice_id[$i] = $this->findLocation($receive->present_postoffice_txt[$i], $present_upazila_id[$i], 6);
            } else {
                $present_postoffice_id[$i] = $receive->present_postoffice_id[$i];
            }

            // permanent address
            if(empty($receive->permanent_district_id[$i])){
                $permanent_district_id[$i] = $this->findLocation($receive->permanent_district_txt[$i], null, 2);
            } else {
                $permanent_district_id[$i] = $receive->permanent_district_id[$i];
            }

            if(empty($receive->permanent_upazila_id[$i])){
                $permanent_upazila_id[$i] = $this->findLocation($receive->permanent_upazila_txt[$i], $permanent_district_id[$i], 3);
            } else {
                $permanent_upazila_id[$i] = $receive->permanent_upazila_id[$i];
            }

            if(empty($receive->permanent_postoffice_id[$i])){
                $permanent_postoffice_id[$i] = $this->findLocation($receive->permanent_postoffice_txt[$i], $permanent_upazila_id[$i], 6);
            } else {
                $permanent_postoffice_id[$i] = $receive->permanent_postoffice_id[$i];
            }

            // trade address
            if(empty($receive->trade_district_id)){
                $receive->trade_district_id = $this->findLocation($receive->trade_district_txt, null, 2);
            }

            if(empty($receive->trade_upazila_id)){
                $receive->trade_upazila_id = $this->findLocation($receive->trade_upazila_txt, $receive->trade_district_id, 3);
            }

            if(empty($receive->trade_postoffice_id)){
                $receive->trade_postoffice_id = $this->findLocation($receive->trade_postoffice_txt, $receive->trade_upazila_id, 6);
            }

            //citizen information
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
                'gender' => isset($i, $receive->gender[$i]) ? $receive->gender[$i] : '',
                'occupation' => isset($i, $receive->occupation[$i]) ? $receive->occupation[$i] : '',

                'marital_status' => isset($i, $receive->marital_status[$i]) ? $receive->marital_status[$i] : null,

                'educational_qualification' => isset($i, $receive->educational_qualification[$i]) ?
                    $receive->educational_qualification[$i] : '',
                'union_id' => $receive->union_id,
                'permanent_village_bn' => isset($i, $receive->permanent_village_bn[$i]) ? $receive->permanent_village_bn[$i] : null,
                'permanent_village_en' => isset($i, $receive->permanent_village_en[$i]) ? $receive->permanent_village_en[$i] : '',
                'permanent_rbs_bn' => isset($i, $receive->permanent_rbs_bn[$i]) ? $receive->permanent_rbs_bn[$i] : null,
                'permanent_rbs_en' => isset($i, $receive->permanent_rbs_en[$i]) ? $receive->permanent_rbs_en[$i] : null,
                'permanent_ward_no' => isset($i, $receive->permanent_ward_no[$i]) ? $receive->permanent_ward_no[$i] : null,
                'permanent_holding_no' => isset($i, $receive->permanent_holding_no[$i]) ? $receive->permanent_holding_no[$i] : null,
                'permanent_district_id' => isset($i, $permanent_district_id[$i]) ? $permanent_district_id[$i] : null,
                'permanent_upazila_id' => isset($i, $permanent_upazila_id[$i]) ? $permanent_upazila_id[$i] : null,
                'permanent_postoffice_id' => isset($i, $permanent_postoffice_id[$i]) ? $permanent_postoffice_id[$i] : null,

                'created_by' => $receive->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $receive->ip()
            ];

            //owner information
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
                'present_district_id' => isset($i, $present_district_id[$i]) ? $present_district_id[$i] : null,
                'present_upazila_id' => isset($i, $present_upazila_id[$i]) ? $present_upazila_id[$i] : null,
                'present_postoffice_id' => isset($i, $present_postoffice_id[$i]) ? $present_postoffice_id[$i] : null,

                'created_by' => $receive->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $receive->ip(),
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
                $move = Image::make($image)->resize(400, 400)->save($location);

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
            'type' => 19,
            'comment_bn' => $receive->comment_bn,
            'comment_en' => $receive->comment_en,
            'fiscal_year_id' => $receive->fiscal_year_id,

            'created_by' => $receive->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $receive->ip(),
        ];

        //trade license optional info
        $trade_optional_info = [
            'pin' => null,
            'union_id' => $receive->union_id,
            'organization_name_bn' => $receive->name_Of_organization_bn,
            'organization_name_en' => !empty($receive->name_Of_organization_en) ? $receive->name_Of_organization_bn :
                translateToEnglish($receive->name_Of_organization_bn),
            'vat_id' => $receive->vat_id,
            'tax_id' => $receive->tax_id,
            'signboard_length' => $receive->signboard_length,
            'signboard_width' => $receive->signboard_width,
            'signboard_type' => $receive->signboard_type,
            'capital' => $receive->capital,
            'tracking' => $receive->tracking,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'owner_type' => $receive->type_of_organization,

            'mobile' => $receive->mobile,
            'email' => $receive->email,
            'phone' => $receive->tel,

            'trade_village_bn' => $receive->trade_village_bn,
            'trade_village_en' => !empty($receive->trade_village_en) ? $receive->trade_village_en :
                translateToEnglish($receive->trade_village_bn),
            'trade_rbs_bn' => $receive->trade_rbs_bn,
            'trade_rbs_en' => !empty($receive->trade_rbs_en) ? $receive->trade_rbs_en : translateToEnglish($receive->trade_rbs_bn),
            'trade_holding_no' => $receive->trade_holding_no,
            'trade_ward_no' => $receive->trade_ward_no,
            'trade_district_id' => $receive->trade_district_id,
            'trade_upazila_id' => $receive->trade_upazila_id,
            'trade_postoffice_id' => $receive->trade_postoffice_id,

            'created_by' => $receive->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $receive->ip(),
        ];


        // dd($citizen_data, $owner_data, $application_data, $trade_optional_info);


        DB::beginTransaction();

        try {
            //get business type
            $query = DB::table('business_type')
                ->select('name_bn', 'id')
                ->where('name_bn', trim($receive->business_type))
                ->where('union_id', $receive->union_id)
                ->where('is_active', 1)
                ->first();

            if ($query) { //business type have
                $trade_optional_info['business_type'] = $query->id;
            } else { //business type hav'nt

                $business_type_data = [
                    'union_id' => $receive->union_id,
                    'name_bn' => $receive->business_type,
                    'name_en' => translateToEnglish($receive->business_type),
                    'is_active' => 1,
                    'created_by' => $receive->created_by,
                    'created_time' => Carbon::now(),
                    'created_by_ip' => $receive->ip(),
                ];

                DB::table('business_type')->insert($business_type_data);

                $business_type_id = DB::getPdo()->lastInsertId();

                $trade_optional_info['business_type'] = $business_type_id;
            }

            // if only personal and financial business type //
            if (in_array($receive->type_of_organization, [1, 4]) && (!is_array($receive->old_ctz) && $receive->old_ctz)) {
                //insert citizen information
                $citizen_data[0]['updated_by'] = $citizen_data[0]['created_by'];
                $citizen_data[0]['updated_time'] = $citizen_data[0]['created_time'];
                $citizen_data[0]['updated_by_ip'] = $citizen_data[0]['created_by_ip'];

                unset($citizen_data[0]['created_by'], $citizen_data[0]['created_time'], $citizen_data[0]['created_by_ip']);

                DB::table("citizen_information")->where("pin", $receive->pin)->update($citizen_data[0]);

            } elseif (in_array($receive->type_of_organization, [2, 3])) {

                for ($i = 0; $i < count($receive->name_bn); $i++) {
                    if ($receive->old_ctz[$i]) {
                        $citizen_data[$i]['updated_by'] = $citizen_data[$i]['created_by'];
                        $citizen_data[$i]['updated_time'] = $citizen_data[$i]['created_time'];
                        $citizen_data[$i]['updated_by_ip'] = $citizen_data[$i]['created_by_ip'];

                        unset($citizen_data[$i]['created_by'], $citizen_data[$i]['created_time'], $citizen_data[$i]['created_by_ip']);

                        DB::table("citizen_information")->where("pin", $citizen_data[$i]['pin'])->update
                        ($citizen_data[$i]);
                    } else {
                        DB::table("citizen_information")->insert($citizen_data[$i]);
                    }
                }

            } else {
                // insert citizen information
                DB::table("citizen_information")->insert($citizen_data);
            }

            //insert application info
            DB::table("application")->insert($application_data);

            //insert trade owner info
            DB::table("owner_info")->insert($owner_data);

            //insert trade optional info
            DB::table("trade_optional_info")->insert($trade_optional_info);

            DB::commit();

            //if have multiple pin
            $pin = implode(', ', $receive->pin);

            $text = (count($receive->pin) > 1) ? "আপনাদের" : "আপনার";

            return ["status" => "success", "message" => "$text পিন নং $pin এবং ট্র্যাকিং নং $receive->tracking"];
        } catch (Exception $e) {
            DB::rollBack();

            // dd($e->getMessage());

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
            ->where('type', 1) // 1 = trade
            ->first();

        if ($query) { //business type have

            $tradeOptionalInfo['business_type'] = $query->id;
        } else { //business type hav'nt

            $business_type_data = [

                'union_id' => $request->union_id,
                'name_bn' => $request->business_type,
                'type' => 1, // 1 = trade
                'is_active' => 1,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip(),
            ];

            DB::table('business_type')->insert($business_type_data);
            $business_type_id = DB::getPdo()->lastInsertId();

            $tradeOptionalInfo['business_type'] = $business_type_id;
        }

        $tradeOptionalInfo += [
            'pin' => null,
            'union_id' => $request->union_id,
            'tracking' => $request->tracking,
            'organization_name_bn' => $request->name_Of_organization_bn,
            'organization_name_en' => $request->name_Of_organization_en,
            'vat_id' => $request->vat_id,
            'tax_id' => $request->tax_id,
            'capital' => $request->capital,
            'fiscal_year_id' => $request->fiscal_year_id,
            'owner_type' => $request->type_of_organization,

            'mobile' => $request->mobile,
            'email' => $request->email,
            'phone' => $request->phone,

            'trade_village_bn' => $request->trade_village_bn,
            'trade_village_en' => $request->trade_village_en,
            'trade_rbs_bn' => $request->trade_rbs_bn,
            'trade_rbs_en' => $request->trade_rbs_en,
            'trade_holding_no' => $request->trade_holding_no,
            'trade_ward_no' => $request->trade_ward_no,
            'trade_district_id' => $request->trade_district_id,
            'trade_upazila_id' => $request->trade_upazila_id,
            'trade_postoffice_id' => $request->trade_postoffice_id,

            'created_by' => $request->created_by,
            'created_time' => Carbon::now(),
            'created_by_ip' => $request->ip(),
        ];

        //db transection start
        DB::transaction(function () use ($request, $ownerData, $applicationData, $citizenData, $tradeOptionalInfo) {
            $res = DB::table("application")->insert($applicationData);
            $citizn = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);
            $owner = DB::table("owner_info")->insert($ownerData);
            $tradeOptional = DB::table("trade_optional_info")->insert($tradeOptionalInfo);
        });
        return true;
    }

    //tradelicense preview and edit data
    public function trade_information($fiscal_year_id = null, $tracking = null, $union_id = null, $type = null)
    {
        // dd($tracking , $union_id , $type);
        $prev_data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'COMP1.bn_name as trade_district_name', 'COMP2.bn_name as trade_upazila_name', 'COMP3.bn_name as trade_postoffice_name', 'BSYTP.name_bn as business_type_bn')
            ->join('owner_info AS OWNLST', function ($join) use ($fiscal_year_id, $tracking, $union_id) {
                $join->on("OWNLST.tracking", "=", "APP.tracking")
                    ->on("OWNLST.union_id", "=", "APP.union_id")
                    ->on("OWNLST.fiscal_year_id", "=", "APP.fiscal_year_id")
                    ->where("APP.fiscal_year_id", "=", $fiscal_year_id)
                    ->where("APP.tracking", "=", $tracking)
                    ->where("OWNLST.tracking", "=", $tracking)
                    ->where("OWNLST.union_id", "=", $union_id);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($fiscal_year_id, $tracking, $union_id) {
                $join->on("TRDOPT.tracking", "=", "APP.tracking")
                    ->on("TRDOPT.union_id", "=", "APP.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "APP.fiscal_year_id")
                    ->where("TRDOPT.fiscal_year_id", "=", $fiscal_year_id)
                    ->where("TRDOPT.tracking", "=", $tracking)
                    ->where("APP.tracking", "=", $tracking)
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
                    ->where("BSYTP.is_active", "=", 1);
            })

            //            //for permanent address
            //            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            //            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            //            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')
            //
            //            //for present address
            //            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            //            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            //            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.trade_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.trade_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.trade_postoffice_id')
            ->where([
                ['APP.fiscal_year_id', '=', $fiscal_year_id],
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
            ])
            ->get();

        // dd($prev_data);


        //ready trade preview data

        $data = [];

        foreach ($prev_data as $item) {

            $permanent_district = $this->getLocationName($item->permanent_district_id);

            $permanent_upazila = $this->getLocationName($item->permanent_upazila_id);

            $permanent_post_office = $this->getLocationName($item->permanent_postoffice_id);


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
                    "permanent_postoffice_name" => $permanent_post_office->bn_name ?? '',
                    "permanent_upazila_name" => $permanent_upazila->bn_name ?? '',
                    "permanent_district_name" => $permanent_district->bn_name ?? '',
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
                    "permanent_postoffice_name" => $permanent_post_office->bn_name ?? '',
                    "permanent_upazila_name" => $permanent_upazila->bn_name ?? '',
                    "permanent_district_name" => $permanent_district->bn_name ?? '',

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
                    "trade_ward_no" => $item->trade_ward_no,
                    "trade_holding_no" => $item->trade_holding_no,
                    "trade_village_bn" => $item->trade_village_bn,
                    "trade_rbs_bn" => $item->trade_rbs_bn,
                    "trade_postoffice_name" => $item->trade_postoffice_name,
                    "trade_upazila_name" => $item->trade_upazila_name,
                    "trade_district_name" => $item->trade_district_name,
                    "created_time" => $item->created_time,

                    "owner_list" => $owner_list,
                ];
            }
        }

        // dd($data);

        return $data;
    }

    //===tradelicense edit data=======//
    public function trade_data($fiscal_year_id, $tracking, $union_id)
    {
        $prev_data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'COMP1.bn_name as trade_district_name_bn', 'COMP1.en_name as trade_district_name_en', 'COMP1.id as trade_district_id', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP2.en_name as trade_upazila_name_en', 'COMP2.id as trade_upazila_id', 'COMP3.bn_name as trade_postoffice_name_bn', 'COMP3.en_name as trade_postoffice_name_en', 'COMP3.id as trade_postoffice_id', 'APP.id as app_id', 'CTZ.id as citizen_id', 'TRDOPT.id as trade_optional_id', 'OWNLST.id as owner_id', 'STUP.name_bn as street_name_bn')
            ->join('owner_info AS OWNLST', function ($join) use ($fiscal_year_id, $tracking, $union_id) {
                $join->on("OWNLST.tracking", "=", "APP.tracking")
                    ->on("OWNLST.union_id", "=", "APP.union_id")
                    ->on("OWNLST.fiscal_year_id", "=", "APP.fiscal_year_id")
                    ->where("APP.fiscal_year_id", "=", $fiscal_year_id)
                    ->where("OWNLST.tracking", "=", $tracking)
                    ->where("OWNLST.union_id", "=", $union_id);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($fiscal_year_id, $tracking, $union_id) {
                $join->on("TRDOPT.tracking", "=", "APP.tracking")
                    ->on("TRDOPT.union_id", "=", "APP.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "APP.fiscal_year_id")
                    ->where("TRDOPT.fiscal_year_id", "=", $fiscal_year_id)
                    ->where("TRDOPT.tracking", "=", $tracking)
                    ->where("TRDOPT.union_id", "=", $union_id);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
                $join->on("CTZ.pin", "=", "OWNLST.pin")
                    ->on("CTZ.union_id", "=", "OWNLST.union_id")
                    ->where("CTZ.union_id", "=", $union_id);
            })

            //            //for permanent address
            //            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            //            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            //            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')
            //
            //            //for present address
            //            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            //            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            //            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.trade_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.trade_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.trade_postoffice_id')
            // street
            ->leftJoin('street_setup AS STUP', 'STUP.id', '=', 'TRDOPT.trade_rbs_en')
            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.fiscal_year_id', '=', $fiscal_year_id],
            ])->get();


        // dd($prev_data);

        //ready trade preview data

        $data = [];

        foreach ($prev_data as $item) {

            $permanent_district = $this->getLocationName($item->permanent_district_id);

            $permanent_upazila = $this->getLocationName($item->permanent_upazila_id);

            $permanent_post_office = $this->getLocationName($item->permanent_postoffice_id);

            $present_district = $this->getLocationName($item->present_district_id);
            $present_upazila = $this->getLocationName($item->present_upazila_id);
            $present_post_office = $this->getLocationName($item->present_postoffice_id);

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
                    "present_postoffice_name_en" => $present_post_office->en_name ?? '',
                    "present_postoffice_name_bn" => $present_post_office->bn_name ?? '',
                    "present_postoffice_id" => $present_post_office->id ?? '',
                    "present_upazila_name_en" => $present_upazila->en_name ?? '',
                    "present_upazila_name_bn" => $present_upazila->bn_name ?? '',
                    "present_upazila_id" => $present_upazila->id ?? '',
                    "present_district_name_en" => $present_district->en_name ?? '',
                    "present_district_name_bn" => $present_district->bn_name ?? '',
                    "present_district_id" => $present_district->id ?? '',

                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,
                    "permanent_postoffice_name_en" => $permanent_post_office->en_name ?? '',
                    "permanent_postoffice_name_bn" => $permanent_post_office->bn_name ?? '',
                    "permanent_postoffice_id" => $permanent_post_office->id ?? '',
                    "permanent_upazila_name_en" => $permanent_upazila->en_name ?? '',
                    "permanent_upazila_name_bn" => $permanent_upazila->bn_name ?? '',
                    "permanent_upazila_id" => $permanent_upazila->id ?? '',
                    "permanent_district_name_en" => $permanent_district->en_name ?? '',
                    "permanent_district_name_bn" => $permanent_district->bn_name ?? '',
                    "permanent_district_id" => $permanent_district->id ?? '',
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
                    "present_postoffice_name_en" => $present_post_office->en_name ?? '',
                    "present_postoffice_name_bn" => $present_post_office->bn_name ?? '',
                    "present_postoffice_id" => $present_post_office->id ?? '',
                    "present_upazila_name_en" => $present_upazila->en_name ?? '',
                    "present_upazila_name_bn" => $present_upazila->bn_name ?? '',
                    "present_upazila_id" => $present_upazila->id ?? '',
                    "present_district_name_en" => $present_district->en_name ?? '',
                    "present_district_name_bn" => $present_district->bn_name ?? '',
                    "present_district_id" => $present_district->id ?? '',

                    "permanent_village_en" => $item->permanent_village_en,
                    "permanent_village_bn" => $item->permanent_village_bn,
                    "permanent_rbs_en" => $item->permanent_rbs_en,
                    "permanent_rbs_bn" => $item->permanent_rbs_bn,
                    "permanent_ward_no" => $item->permanent_ward_no,
                    "permanent_holding_no" => $item->permanent_holding_no,
                    "permanent_postoffice_name_en" => $permanent_post_office->en_name ?? '',
                    "permanent_postoffice_name_bn" => $permanent_post_office->bn_name ?? '',
                    "permanent_postoffice_id" => $permanent_post_office->id ?? '',
                    "permanent_upazila_name_en" => $permanent_upazila->en_name ?? '',
                    "permanent_upazila_name_bn" => $permanent_upazila->bn_name ?? '',
                    "permanent_upazila_id" => $permanent_upazila->id ?? '',
                    "permanent_district_name_en" => $permanent_district->en_name ?? '',
                    "permanent_district_name_bn" => $permanent_district->bn_name ?? '',
                    "permanent_district_id" => $permanent_district->id ?? '',
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
                    "signboard_type" => $item->signboard_type,
                    "capital" => $item->capital,
                    "office_ward_no" => $item->trade_ward_no,
                    "office_holding_no" => $item->trade_holding_no,
                    "office_village_en" => $item->trade_village_en,
                    "office_village_bn" => $item->trade_village_bn,
                    "office_rbs_en" => $item->trade_rbs_en,
                    "office_rbs_bn" => $item->street_name_bn,
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

        // dd($data);
        return $data;
    }

    //===tradelicense applicant list====//
    public function trade_applicant_list($union_id = null)
    {

        $data = DB::table('application AS APP')
            ->join('citizen_information', function ($join) {

                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id");
            })
            ->where([
                ['APP.union_id', '=', $union_id],
                ['CTZ.union_id', '=', $union_id],
                ['APP.type', '=', 19],
                ['APP.status', '=', 0],
            ])
            ->select('APP.*', 'CTZ.*')
            ->get();

        return $data;
    }

    //===tradelicense sonod generate=====//
    public function sonod_generate($receive)
    {
        //certificate data create
        $sonod_data = [
            // 'pin'            => $receive->pin,
            'sonod_no' => $receive->sonod_no,
            'tracking' => $receive->tracking,
            'expire_date' => $receive->expire_date,
            // 'due_fiscal_year' => ($receive->due_fiscal_year) ? $receive->due_fiscal_year : NULL,
            'type' => $receive->type,
            'status' => $receive->status,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'union_id' => $receive->union_id,
            'district_id' => $receive->district_id,
            'upazila_id' => $receive->upazila_id,
            'created_by' => Auth::user()->employee_id,
            'created_time' => now(),
            'created_by_ip' => Request::ip()
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
            'created_time' => now(),
            'created_by_ip' => Request::ip()
        ];

        //if have signbord_vat (21)
        if ($receive->signbord_vat > 0) {

            //get signbord account id
            $signbord_vat_account_id = Global_model::get_account_id($receive->union_id, 21);

            if ($signbord_vat_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->signbord_vat,
                    'debit' => NULL,
                    'credit' => $signbord_vat_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => Request::ip()
                ];
            }
        }

        //if have sarcharge (22)
        if ($receive->sarcharge > 0) {

            //get sarcharge account id
            $sarcharge_account_id = Global_model::get_account_id($receive->union_id, 22);

            if ($sarcharge_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->sarcharge,
                    'debit' => NULL,
                    'credit' => $sarcharge_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }

        // if have due (23)
        // if ($receive->due > 0) {

        //     //get due account id
        //     $due_account_id = Global_model::get_account_id($receive->union_id, 23);

        //     if ($due_account_id < 0) {

        //         return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
        //     } else {

        //         $transaction_data[] = [
        //             'union_id' => $receive->union_id,
        //             'fiscal_year_id' => $receive->fiscal_year_id,
        //             'voucher' => $receive->voucher,
        //             'sonod_no' => $receive->sonod_no,
        //             'amount' => $receive->due,
        //             'credit' => $due_account_id,
        //             'debit' => NULL,
        //             'type' => $receive->type,

        //             'created_by' => Auth::user()->employee_id,
        //             'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
        //             'created_by_ip' => Request::ip()
        //         ];
        //     }
        // }

        //if have discount (24)
        if ($receive->discount > 0) {

            //get discount account id
            $discount_account_id = Global_model::get_account_id($receive->union_id, 24);

            if ($discount_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->discount,
                    'debit' => $receive->debit_id,
                    'credit' => $discount_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => Request::ip()
                ];
            }
        }

        //if have vat (25)
        if ($receive->vat > 0) {

            //get vat account id
            $vat_account_id = Global_model::get_account_id($receive->union_id, 25);

            if ($vat_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->vat,
                    'debit' => NULL,
                    'credit' => $vat_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => Request::ip(),
                ];
            }
        }

        //if have source_vat (97)
        if ($receive->source_vat > 0) {

            //get source_vat account id
            $source_vat_account_id = Global_model::get_account_id($receive->union_id, 97); // 97 = source_vat

            if ($source_vat_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->source_vat,
                    'debit' => NULL,
                    'credit' => $source_vat_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => Request::ip()
                ];
            }
        }

        //if have bibidh (39)
        if ($receive->bibidh > 0) {

            //get bibidh account id
            $bibidh_account_id = Global_model::get_account_id($receive->union_id, 39); // 39 = bibidh

            if ($bibidh_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->bibidh,
                    'debit' => NULL,
                    'credit' => $bibidh_account_id,
                    'type' => $receive->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => Request::ip()
                ];
            }
        }

        // dd($transaction_data);

        //  determine the certificate generate policy
        // 1 = Direct
        // 2 = Generate invoice + pending for payment
        $policy = DB::table("settings")
            ->where("options", "trade_generate")
            ->where("union_id", $receive->union_id)
            ->get()->first();

        // if no settings found then go through policy No.1
        if ($policy == NULL) {
            $policy = new stdClass();
            $policy->value = 1;
        }

        $voucher_data = [];

        if ($policy->value == 1) {
            $invoice_id = BillGenerate::generateID();

            $invoice_data = [
                "union_id" => $receive->union_id,
                "invoice_id" => $invoice_id,
                "voucher_no" => $receive->voucher,
                "sonod_no" => $receive->sonod_no,
                "fiscal_year_id" => $receive->fiscal_year_id,
                // here by array_sum sum all value including discount amount
                // so discount amount remove here
                "amount" => (array_sum(array_column($transaction_data, "amount")) - ($receive->discount * 2)),
                "type" => 3,
                "is_paid" => 1, // direct generate invoice is_paid default
                "payment_date" => date("Y-m-d"),
                "created_at" => now(),
                "created_by" => Auth()->user()->id,
                "created_by_ip" => Request::ip()
            ];
        } else if ($policy->value == 2) {    // invoice generate and pending for payment
            $invoice_id = BillGenerate::generateID();

            $invoice_data = [
                "union_id" => $receive->union_id,
                "invoice_id" => $invoice_id,
                "voucher_no" => $receive->voucher,
                "sonod_no" => $receive->sonod_no,
                "fiscal_year_id" => $receive->fiscal_year_id,
                // here by array_sum sum all value including discount amount
                // so discount amount remove here
                "amount" => (array_sum(array_column($transaction_data, "amount")) - ($receive->discount * 2)),
                "type" => 3,
                "is_paid" => 0,
                "created_at" => now(),
                "created_by" => Auth()->user()->id,
                "created_by_ip" => Request::ip()
            ];

            foreach ($transaction_data as $item) {
                $voucher_data[] = [
                    "union_id" => $item['union_id'],
                    "invoice_id" => $invoice_id,
                    "voucher_id" => $item['voucher'],
                    "sonod_no" => $item['sonod_no'],
                    "amount" => $item['amount'],
                    "acc_no" => $item['credit'],
                    "type" => $item['type'],
                    "created_at" => $item['created_time']
                ];
            }
        }

        // dd($sonod_data, $invoice_data, $transaction_data);

        //transection start
        DB::beginTransaction();

        try {
            //when certificate generate
            if ((int)$receive->application_id > 0) {

                DB::table('application')
                    ->where('id', $receive->application_id)
                    ->update([
                        'status' => 1,
                        'updated_time' => now(),
                        'updated_at' => now(),
                        'updated_by' => Auth()->user()->id,
                        'updated_by_ip' => Request::ip()
                    ]);
            }

            //when certificate re-generate
            if ((int)$receive->certificate_id > 0) {

                DB::table('certificate')
                    ->where('id', $receive->certificate_id)
                    ->update([
                        'status' => 2,
                        'updated_time' => now(),
                        'updated_at' => now(),
                        'updated_by' => Auth()->user()->id,
                        'updated_by_ip' => Request::ip()
                    ]);
            }

            //certificate create
            DB::table("certificate")->insert($sonod_data);

            // invoice system for all
            DB::table("acc_invoice")->insert($invoice_data);

            if ($policy->value == 1) {    // direct generate
                //transection data save
                DB::table("acc_transaction")->insert($transaction_data);
            } else {    // invoice generate and pending for payment
                // acc_voucher
                DB::table("acc_voucher")->insert($voucher_data);
            }

            //if all are good
            DB::commit();

            return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে। সনদটি প্রিন্ট করুন।", 'sonod_no' => $receive['sonod_no']];

        } catch (\Exception $e) {

            DB::rollback();

            // dd($e->getMessage());

            return ["status" => "error", "message" => "দুঃখিত ! আপনার সনদ টি জেনারেট করতে সমস্যা হচ্ছে।", 'voucher_no' => ''];
        }
    }

    //====tradelicense certificate data=====//
    public function trade_certificate_data($sonod_no = null, $union_id = null, $type = null)
    {

        $certificate_data = DB::table('certificate AS CRT')
            ->select('CRT.*', 'CRT.status as crt_status', 'CRT.sonod_no', 'CRT.created_time as generate_date', 'APP.*', 'TRDOPT.*', 'TRDOPT.email', 'CRT.fiscal_year_id', 'FSY.name as fiscal_year_name', 'BSYTP.name_bn as business_type_bn', 'BSYTP.name_en as business_type_en', 'CRT.type', 'COMP1.bn_name as trade_district_name_bn', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP3.bn_name as trade_postoffice_name_bn', 'COMP1.en_name as trade_district_name_en', 'COMP2.en_name as trade_upazila_name_en', 'COMP3.en_name as trade_postoffice_name_en')
            ->join('application AS APP', function ($join) use ($sonod_no, $union_id) {
                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->on("APP.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("APP.union_id", "=", $union_id)
                    ->where("CRT.union_id", "=", $union_id)
                    ->where("CRT.sonod_no", "=", $sonod_no)
                    ->where("APP.is_active", "=", 1);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($sonod_no, $union_id) {
                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("CRT.sonod_no", "=", $sonod_no)
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
                    // ->where("FSY.is_current", "=", '1')
                    ->where("FSY.is_active", "=", '1');
            })

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
            ->orderBy('CRT.id', 'DESC')
            ->get()
            ->first();

            $data = [];


        //organizatin data set
        $data["organization"] = [
            "union_id" => $certificate_data->union_id,
            "tracking" => $certificate_data->tracking,
            "sonod_no" => $certificate_data->sonod_no,
            "type" => $certificate_data->type,
            "status" => $certificate_data->crt_status,
            "organization_name_bn" => $certificate_data->organization_name_bn,
            "organization_name_en" => $certificate_data->organization_name_en,
            "fiscal_year_id" => $certificate_data->fiscal_year_id,
            "fiscal_year_name" => $certificate_data->fiscal_year_name,
            "owner_type" => $certificate_data->owner_type,
            "business_type_bn" => $certificate_data->business_type_bn,
            "business_type_en" => $certificate_data->business_type_en,
            "mobile" => $certificate_data->mobile,
            "email" => $certificate_data->email,
            "phone" => $certificate_data->phone,
            "vat_id" => $certificate_data->vat_id,
            "tax_id" => $certificate_data->tax_id,
            "capital" => $certificate_data->capital,
            "trade_ward_no" => $certificate_data->trade_ward_no,
            "trade_holding_no" => $certificate_data->trade_holding_no,
            "trade_village_bn" => $certificate_data->trade_village_bn,
            "trade_village_en" => $certificate_data->trade_village_en,
            "trade_rbs_bn" => $certificate_data->trade_rbs_bn,
            "trade_rbs_en" => $certificate_data->trade_rbs_en,

            "trade_postoffice_name_bn" => $certificate_data->trade_postoffice_name_bn,
            "trade_upazila_name_bn" => $certificate_data->trade_upazila_name_bn,
            "trade_district_name_bn" => $certificate_data->trade_district_name_bn,

            "trade_postoffice_name_en" => $certificate_data->trade_postoffice_name_en,
            "trade_upazila_name_en" => $certificate_data->trade_upazila_name_en,
            "trade_district_name_en" => $certificate_data->trade_district_name_en,

            "generate_date" => $certificate_data->generate_date,
            "expire_date" => $certificate_data->expire_date,

            "owner_list" => [],
        ];

        // dd($data);

        //  member data
        $member_data = DB::table("certificate AS CRT")
            ->select('OWNLST.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email')
            ->join('owner_info AS OWNLST', function ($join) use ($union_id, $sonod_no) {
                $join->on("OWNLST.tracking", "=", "CRT.tracking")
                    ->on("OWNLST.union_id", "=", "CRT.union_id")
                    ->on("OWNLST.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("OWNLST.union_id", "=", $union_id)
                    ->where("CRT.sonod_no", "=", $sonod_no)
                    ->where("OWNLST.is_active", "=", 1);
            })
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
                $join->on("CTZ.pin", "=", "OWNLST.pin")
                    ->on("CTZ.union_id", "=", "OWNLST.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("CTZ.is_active", "=", 1);
            })
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type]
            ])
            ->get();

        //  dd($member_data);

        $owner_list = [];

        foreach ($member_data as $item) {

            $permanent_district = $this->getLocationName($item->permanent_district_id);

            $permanent_upazila = $this->getLocationName($item->permanent_upazila_id);

            $permanent_post_office = $this->getLocationName($item->permanent_postoffice_id);

            $present_district = $this->getLocationName($item->present_district_id);
            $present_upazila = $this->getLocationName($item->present_upazila_id);
            $present_post_office = $this->getLocationName($item->present_postoffice_id);

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

                "permanent_postoffice_name_bn" => $permanent_post_office->bn_name ?? '',
                "permanent_upazila_name_bn" => $permanent_upazila->bn_name ?? '',
                "permanent_district_name_bn" => $permanent_district->bn_name ?? '',

                "permanent_postoffice_name_en" => $permanent_post_office->en_name ?? '',
                "permanent_upazila_name_en" => $permanent_upazila->en_name ?? '',
                "permanent_district_name_en" => $permanent_district->en_name ?? '',


                "present_village_bn" => $item->present_village_bn,
                "present_village_en" => $item->present_village_en,
                "present_rbs_bn" => $item->present_rbs_bn,
                "present_rbs_en" => $item->present_rbs_en,
                "present_ward_no" => $item->present_ward_no,
                "present_holding_no" => $item->present_holding_no,

                "present_postoffice_name_bn" => $present_post_office->bn_name ?? '',
                "present_upazila_name_bn" => $present_upazila->bn_name ?? '',
                "present_district_name_bn" => $present_district->bn_name ?? '',

                "present_postoffice_name_en" => $present_post_office->en_name ?? '',
                "present_upazila_name_en" => $present_upazila->en_name ?? '',
                "present_district_name_en" => $present_district->en_name ?? '',

            ];
        }

        $data['owner_list'] = $owner_list;

        // dd($owner_list);

        // foreach ($certificate_data as $item) {

        //     if (isset($data['organization'])) {

        //         //if set organization then set only owner data

        //         $data['organization']["owner_list"][] = [

        //             "photo" => $item->photo,
        //             "pin" => $item->pin,
        //             "name_bn" => $item->name_bn,
        //             "name_en" => $item->name_en,
        //             "father_name_bn" => $item->father_name_bn,
        //             "father_name_en" => $item->father_name_en,
        //             "mother_name_bn" => $item->mother_name_bn,
        //             "mother_name_en" => $item->mother_name_en,
        //             "husband_name_bn" => $item->husband_name_bn,
        //             "husband_name_en" => $item->husband_name_en,
        //             "wife_name_bn" => $item->wife_name_bn,
        //             "wife_name_en" => $item->wife_name_en,
        //             "gender" => $item->gender,
        //             "mobile" => $item->citizen_mobile,
        //             "nid" => $item->nid,
        //             "birth_id" => $item->birth_id,
        //             "marital_status" => $item->marital_status,
        //             "resident" => $item->resident,
        //             "religion" => $item->religion,
        //             "permanent_village_bn" => $item->permanent_village_bn,
        //             "permanent_village_en" => $item->permanent_village_en,
        //             "permanent_rbs_bn" => $item->permanent_rbs_bn,
        //             "permanent_rbs_en" => $item->permanent_rbs_en,
        //             "permanent_ward_no" => $item->permanent_ward_no,
        //             "permanent_holding_no" => $item->permanent_holding_no,

        //             "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
        //             "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
        //             "permanent_district_name_bn" => $item->permanent_district_name_bn,

        //             "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
        //             "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
        //             "permanent_district_name_en" => $item->permanent_district_name_en,
        //         ];
        //     } else {

        //         //first owner set in array

        //         $owner_list[] = [
        //             "photo" => $item->photo,
        //             "pin" => $item->pin,
        //             "name_bn" => $item->name_bn,
        //             "name_en" => $item->name_en,
        //             "father_name_bn" => $item->father_name_bn,
        //             "father_name_en" => $item->father_name_en,
        //             "mother_name_bn" => $item->mother_name_bn,
        //             "mother_name_en" => $item->mother_name_en,
        //             "husband_name_bn" => $item->husband_name_bn,
        //             "husband_name_en" => $item->husband_name_en,
        //             "wife_name_bn" => $item->wife_name_bn,
        //             "wife_name_en" => $item->wife_name_en,
        //             "gender" => $item->gender,
        //             "mobile" => $item->citizen_mobile,
        //             "nid" => $item->nid,
        //             "birth_id" => $item->birth_id,
        //             "marital_status" => $item->marital_status,
        //             "resident" => $item->resident,
        //             "religion" => $item->religion,
        //             "permanent_village_bn" => $item->permanent_village_bn,
        //             "permanent_village_en" => $item->permanent_village_en,
        //             "permanent_rbs_bn" => $item->permanent_rbs_bn,
        //             "permanent_rbs_en" => $item->permanent_rbs_en,
        //             "permanent_ward_no" => $item->permanent_ward_no,
        //             "permanent_holding_no" => $item->permanent_holding_no,

        //             "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
        //             "permanent_upazila_name_bn" => $item->permanent_upazila_name_bn,
        //             "permanent_district_name_bn" => $item->permanent_district_name_bn,

        //             "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
        //             "permanent_upazila_name_en" => $item->permanent_upazila_name_en,
        //             "permanent_district_name_en" => $item->permanent_district_name_en,

        //         ];

        //         //organizatin data set
        //         $data["organization"] = [
        //             "union_id" => $item->union_id,
        //             "tracking" => $item->tracking,
        //             "sonod_no" => $item->sonod_no,
        //             "type" => $item->type,
        //             "status" => $item->crt_status,
        //             "organization_name_bn" => $item->organization_name_bn,
        //             "organization_name_en" => $item->organization_name_bn,
        //             "fiscal_year_id" => $item->fiscal_year_id,
        //             "fiscal_year_name" => $item->fiscal_year_name,
        //             "owner_type" => $item->owner_type,
        //             "business_type_bn" => $item->business_type_bn,
        //             "business_type_en" => $item->business_type_en,
        //             "mobile" => $item->mobile,
        //             "email" => $item->email,
        //             "phone" => $item->phone,
        //             "vat_id" => $item->vat_id,
        //             "tax_id" => $item->tax_id,
        //             "capital" => $item->capital,
        //             "trade_ward_no" => $item->trade_ward_no,
        //             "trade_holding_no" => $item->trade_holding_no,
        //             "trade_village_bn" => $item->trade_village_bn,
        //             "trade_village_en" => $item->trade_village_en,
        //             "trade_rbs_bn" => $item->trade_rbs_bn,
        //             "trade_rbs_en" => $item->trade_rbs_en,

        //             "trade_postoffice_name_bn" => $item->trade_postoffice_name_bn,
        //             "trade_upazila_name_bn" => $item->trade_upazila_name_bn,
        //             "trade_district_name_bn" => $item->trade_district_name_bn,

        //             "trade_postoffice_name_en" => $item->trade_postoffice_name_en,
        //             "trade_upazila_name_en" => $item->trade_upazila_name_en,
        //             "trade_district_name_en" => $item->trade_district_name_en,

        //             "generate_date" => $item->generate_date,
        //             "expire_date" => $item->expire_date,

        //             "owner_list" => $owner_list,
        //         ];
        //     }
        // }

        //  dd($data);

        // get fees details
        $fiscal_year_id = $certificate_data->fiscal_year_id;

        $invoice_data = DB::table('acc_invoice')->where(['union_id' => $union_id, 'sonod_no' => $sonod_no, 'fiscal_year_id' => $fiscal_year_id, 'is_paid' => 1])->first();

        // dd($invoice_data);

        if (empty($invoice_data)) {
            return false;
        }

        $voucher_no = $invoice_data->voucher_no;
        $txn_no = $invoice_data->txn_no;

        // current fiscal year fees
        $fee_data = DB::table('acc_invoice AS INV')
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type')
            ->join('acc_transaction AS TRNS', function ($join) use ($voucher_no, $sonod_no, $union_id) {
                $join->on('TRNS.sonod_no', '=', 'INV.sonod_no')
                    ->on('TRNS.union_id', '=', 'INV.union_id')
                    ->on('TRNS.voucher', '=', 'INV.voucher_no')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.voucher', $voucher_no)
                    ->where('TRNS.union_id', $union_id);
            })
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id, $voucher_no) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('TRNS.voucher', $voucher_no)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', 28)
                    ->orWhere('TRNS.type', '=', $type);
            })
            ->selectRaw("TRNS.amount, TRNS.voucher")
            ->get();

        $fee_list = [];

        foreach ($fee_data as $fee) {
            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount
            ];
        }

        $data['fee_data'] = $fee_list;

        // due fiscal year fees
        $due_voucher_qry = DB::table("acc_invoice")
            ->where("sonod_no", $sonod_no)
            ->where("voucher_no", "!=", $voucher_no)
            ->where("txn_no", $txn_no)
            ->select("voucher_no","FIS.name")
            ->join('fiscal_years AS FIS',function($join){
                $join->on('FIS.id','=','acc_invoice.fiscal_year_id');
            })
            ->get()->toArray();

            // dd($due_voucher_qry[0]->name);

            $due_year_name = isset($due_voucher_qry[0]->name) ? $due_voucher_qry[0]->name : '';

            // dd($due_year_name);
            $data['due_year_name'] = $due_year_name;
            // dd($data);

        $due_voucher = array_values(array_column($due_voucher_qry, "voucher_no"));

        // dd($due_voucher);

        $due_qry = DB::table('acc_transaction AS TRNS')
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id, $due_voucher) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    // ->where('ACCRDT.is_active', 1)
                    ->whereIn('TRNS.voucher', $due_voucher)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->whereIn('TRNS.voucher', $due_voucher)
            ->where("TRNS.union_id", $union_id)
            ->where("TRNS.sonod_no", $sonod_no)
            ->where("TRNS.type", $type)
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount', 'TRNS.voucher')
            ->get();

        // dd($due_qry);

        $due_data = [];

        foreach ($due_qry as $fee) {
            $due_data[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount
            ];
        }

        $data['due_data'] = $due_data;

        // dd($data['fee_data'], $data['due_data']);

        // //get license fee
        // $fee_data = DB::table('certificate AS CRT')
        //     ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount', 'TRNS.voucher')

        //     ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id, $type) {
        //         $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
        //             ->on('TRNS.union_id', '=', 'CRT.union_id')
        //             ->where('TRNS.is_active', 1)
        //             ->where('TRNS.sonod_no', $sonod_no)
        //             ->where('TRNS.union_id', $union_id);
        //     })

        //     ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
        //         $join->on('ACCRDT.id', '=', 'TRNS.credit')
        //             ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
        //             ->where('ACCRDT.is_active', 1)
        //             ->where('ACCRDT.union_id', $union_id);
        //     })

        //     //for pehsa kor, vat and trade transection
        //     ->where(function ($query) use ($type) {
        //         $query->where('TRNS.type', '=', 28)
        //             ->orWhere('TRNS.type', '=', 25)
        //             ->orWhere('TRNS.type', '=', $type);
        //     })
        //     ->get();


        // //ready fee array
        // $fee_list = [];

        // foreach ($fee_data as $fee) {

        //     $fee_list[$fee->account_type] = [
        //         'account_name' => $fee->account_name,
        //         'amount' => $fee->amount,

        //     ];
        // }


        // $data['fee_data'] = $fee_list;

        // dd($data);

        //if not found array data
        if (empty($data['organization']) || empty($data['fee_data'])) {

            return false;
        } else {

            return $data;
        }
    }

    private function getLocationName($id)
    {
        return DB::table("bd_locations")
            ->where("id", $id)
            ->get()
            ->first();
    }

    //===previous trade certificate data====//
    public function previous_trade_certificate_data($sonod_no = null, $union_id = null, $type = null, $fiscal_year_id = null)
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
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id) {

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

    //======tradelicense update====//
    public function update_trade($receive)
    {
        $union_id = Auth::user()->union_id;
        $citizen_data = [];
        $owner_data = [];

        for ($i = 0; $i < count($receive->name_bn); $i++) {

            // address adding
            // if address is new

            // present address
            if(empty($receive->present_district_id[$i])){
                $present_district_id[$i] = $this->findLocation($receive->present_district_txt[$i], null, 2);
            } else {
                $present_district_id[$i] = $receive->present_district_id[$i];
            }

            if(empty($receive->present_upazila_id[$i])){
                $present_upazila_id[$i] = $this->findLocation($receive->present_upazila_txt[$i], $present_district_id[$i], 3);
            } else {
                $present_upazila_id[$i] = $receive->present_upazila_id[$i];
            }

            if(empty($receive->present_postoffice_id[$i])){
                $present_postoffice_id[$i] = $this->findLocation($receive->present_postoffice_txt[$i], $present_upazila_id[$i], 6);
            } else {
                $present_postoffice_id[$i] = $receive->present_postoffice_id[$i];
            }

            // permanent address
            if(empty($receive->permanent_district_id[$i])){
                $permanent_district_id[$i] = $this->findLocation($receive->permanent_district_txt[$i], null, 2);
            } else {
                $permanent_district_id[$i] = $receive->permanent_district_id[$i];
            }

            if(empty($receive->permanent_upazila_id[$i])){
                $permanent_upazila_id[$i] = $this->findLocation($receive->permanent_upazila_txt[$i], $permanent_district_id[$i], 3);
            } else {
                $permanent_upazila_id[$i] = $receive->permanent_upazila_id[$i];
            }

            if(empty($receive->permanent_postoffice_id[$i])){
                $permanent_postoffice_id[$i] = $this->findLocation($receive->permanent_postoffice_txt[$i], $permanent_upazila_id[$i], 6);
            } else {
                $permanent_postoffice_id[$i] = $receive->permanent_postoffice_id[$i];
            }

            // trade address
            if(empty($receive->trade_district_id)){
                $receive->trade_district_id = $this->findLocation($receive->trade_district_txt, null, 2);
            }

            if(empty($receive->trade_upazila_id)){
                $receive->trade_upazila_id = $this->findLocation($receive->trade_upazila_txt, $receive->trade_district_id, 3);
            }

            if(empty($receive->trade_postoffice_id)){
                $receive->trade_postoffice_id = $this->findLocation($receive->trade_postoffice_txt, $receive->trade_upazila_id, 6);
            }

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
                'gender' => isset($i, $receive->gender[$i]) ? $receive->gender[$i] : '',
                'occupation' => isset($i, $receive->occupation[$i]) ? $receive->occupation[$i] : '',

                'marital_status' => isset($i, $receive->marital_status[$i]) ? $receive->marital_status[$i] : null,

                'educational_qualification' => isset($i, $receive->educational_qualification[$i]) ?
                    $receive->educational_qualification[$i] : '',
                'permanent_village_bn' => isset($i, $receive->permanent_village_bn[$i]) ? $receive->permanent_village_bn[$i] : null,
                'permanent_village_en' => isset($i, $receive->permanent_village_en[$i]) ? $receive->permanent_village_en[$i] : '',
                'permanent_rbs_bn' => isset($i, $receive->permanent_rbs_bn[$i]) ? $receive->permanent_rbs_bn[$i] : null,
                'permanent_rbs_en' => isset($i, $receive->permanent_rbs_en[$i]) ? $receive->permanent_rbs_en[$i] : null,
                'permanent_ward_no' => isset($i, $receive->permanent_ward_no[$i]) ? $receive->permanent_ward_no[$i] : null,
                'permanent_holding_no' => isset($i, $receive->permanent_holding_no[$i]) ? $receive->permanent_holding_no[$i] : null,

                'permanent_district_id' => isset($i, $permanent_district_id[$i]) ? $permanent_district_id[$i] : null,
                'permanent_upazila_id' => isset($i, $permanent_upazila_id[$i]) ? $permanent_upazila_id[$i] : null,
                'permanent_postoffice_id' => isset($i, $permanent_postoffice_id[$i]) ? $permanent_postoffice_id[$i] : null,

                'updated_by' => Auth::user()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $receive->ip(),

            ];

            //owner information

            $owner_data[] = [
                "pin" => $citizen_data[$i]['pin'],
                'fiscal_year_id' => $receive->fiscal_year_id,
                'present_village_bn' => isset($i, $receive->present_village_bn[$i]) ? $receive->present_village_bn[$i] : null,
                'present_village_en' => isset($i, $receive->present_village_en[$i]) ? $receive->present_village_en[$i] : null,
                'present_rbs_bn' => isset($i, $receive->present_rbs_bn) ? $receive->present_rbs_bn[$i] : null,
                'present_rbs_en' => isset($i, $receive->present_rbs_en[$i]) ? $receive->present_rbs_en[$i] : null,
                'present_ward_no' => isset($i, $receive->present_ward_no[$i]) ? $receive->present_ward_no[$i] : null,
                'present_holding_no' => isset($i, $receive->present_holding_no[$i]) ? $receive->present_holding_no[$i] : null,

                'present_district_id' => isset($i, $present_district_id[$i]) ? $present_district_id[$i] : null,
                'present_upazila_id' => isset($i, $present_upazila_id[$i]) ? $present_upazila_id[$i] : null,
                'present_postoffice_id' => isset($i, $present_postoffice_id[$i]) ? $present_postoffice_id[$i] : null,

                'updated_by' => Auth::user()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $receive->ip(),

            ];
        }

        //application table data
        $application_data = [
            'pin' => null,
            'tracking' => $receive->tracking,
            'type' => 19,
            'comment_bn' => null,
            'comment_en' => null,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $receive->ip()
        ];

        //trade license optional info
        $trade_optional_info = [
            'pin' => null,
            'organization_name_bn' => $receive->organization_name_bn,
            'organization_name_en' => $receive->organization_name_en,
            'vat_id' => $receive->vat_id,
            'tax_id' => $receive->tax_id,
            'signboard_length' => $receive->signboard_length,
            'signboard_width' => $receive->signboard_width,
            'signboard_type' => $receive->signboard_type,
            'capital' => $receive->capital,
            'tracking' => $receive->tracking,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'owner_type' => $receive->owner_type,

            'mobile' => $receive->mobile,
            'email' => $receive->email,
            'phone' => $receive->tel,

            'trade_village_bn' => $receive->office_village_bn,
            'trade_village_en' => $receive->office_village_en,
            'trade_rbs_en' => $receive->trade_rbs_en,
            'trade_holding_no' => $receive->office_holding_no,
            'trade_ward_no' => $receive->office_ward_no,

            'trade_district_id' => $receive->trade_district_id,
            'trade_upazila_id' => $receive->trade_upazila_id,
            'trade_postoffice_id' => $receive->trade_postoffice_id,

            'updated_by' => Auth::user()->employee_id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => $receive->ip(),

        ];

        $b_type = BusinessType::where('name_bn', trim($receive->business_type))
            ->where('union_id', $union_id)
            ->where('is_active', 1)
            ->first();

        if ($b_type) { //business type have
            $trade_optional_info['business_type'] = $b_type->id;
        } else { //business type hav'nt

            $business_type_data = [
                'union_id' => $union_id,
                'name_bn' => $receive->business_type,
                'is_active' => 1,
                'created_by' => auth()->user()->employee_id,
                'created_time' => Carbon::now(),
                'created_by_ip' => Request::ip(),
            ];

            $trade_optional_info['business_type'] = BusinessType::create($business_type_data)->id;
        }

        // dd($citizen_data, $owner_data, $application_data, $trade_optional_info);

        DB::beginTransaction();

        try {
            foreach ($citizen_data as $key => $value) {

                //single and multiple photo upload
                if ($receive->hasfile('photo' . $key)) {

                    $photo = $citizen_data[$key]["pin"] . "." . $receive->file('photo' . $key)[0]->getClientOriginalExtension();

                    $location = public_path("assets/images/application/" . $photo);

                    //upload image in folder
                    $move = Image::make($receive->file('photo' . $key)[0])->resize(
                        300,
                        300
                    )->save($location);

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

            DB::table("trade_optional_info")
                ->where('id', $receive->trade_optional_id)
                ->where('tracking', $application_data['tracking'])
                ->where('union_id', $union_id)
                ->update($trade_optional_info);

            DB::commit();
            return ["status" => "success", "message" => "Your application Update successfully."];
        } catch (Exception $e) {
            DB::rollBack();
            return ["status" => "error", "message" => "তথ্য আপডেট হয়নি।"];
        }
    }

    //===tradelicense info delete===//
    public function trade_info_delete($request)
    {
        DB::beginTransaction();

        try {
            DB::table('application')
                ->where('tracking', $request->tracking)
                ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

            DB::table('owner_info')
                ->where('tracking', $request->tracking)
                ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

            DB::table('trade_optional_info')
                ->where('tracking', $request->tracking)
                ->update(['deleted_at' => Carbon::now(), 'is_active' => 0, 'updated_by' => Auth::user()->employee_id, 'updated_time' => Carbon::now(), 'updated_by_ip' => $request->ip()]);

            DB::commit();
            return ['status' => "success", 'message' => 'আবেদনটি ডিলিট করা হয়েছে.'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['status' => "error", 'message' => 'আবেদনটি ডিলিট করা যায়নি.'];
        }
    }

    //===tradelicense applicant list data=====//
    public function trade_applicant_list_data($receive)
    {
        $union_id = $receive['union_id'];

        $query = DB::table('application AS APP')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.fiscal_year_id', 'APP.tracking', 'APP.created_time', 'TRDOPT.organization_name_bn', 'TRDOPT.business_type', 'TRDOPT.signboard_type', 'TRDOPT.signboard_length', 'TRDOPT.signboard_width', 'TRDOPT.tracking', 'TRDOPT.mobile', 'TRDOPT.email', 'TRDOPT.owner_type', 'TRDOPT.trade_upazila_id', 'TRDOPT.trade_district_id', 'APP.union_id', 'BSYTP.name_bn as business_type_bn')
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($receive) {
                $join->on("TRDOPT.tracking", "=", "APP.tracking")
                    ->on("TRDOPT.union_id", "=", "APP.union_id")
                    ->where("TRDOPT.union_id", "=", $receive['union_id'])
                    ->where("APP.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("TRDOPT.fiscal_year_id", "=", $receive['fiscal_year_id'])
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
                ['APP.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['APP.union_id', '=', $receive['union_id']],
                ['APP.type', '=', 19],
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
    public function trade_certificate_list($receive)
    {
        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as app_id, APP.fiscal_year_id, CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no, SUM(IF(INV.is_paid = 0, INV.amount, 0)) AS total_due'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.owner_type', 'TRDOPT.business_type', 'BSYTP.name_bn as business_type_bn', 'TRDOPT.mobile', 'TRDOPT.email', 'INV.invoice_id', 'INV.voucher_no', 'INV.is_paid', 'INV.amount')
            ->join('application AS APP', function ($join) use ($receive) {
                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->on("APP.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("APP.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("CRT.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("APP.is_active", "=", 1);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($receive) {
                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("TRDOPT.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("CRT.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('business_type AS BSYTP', function ($join) use ($receive) {

                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type");
                    // ->where("APP.fiscal_year_id", "=", $receive['fiscal_year_id']);
                    // ->where("BSYTP.is_active", "=", 1);
            })
            ->join("acc_invoice AS INV", function ($join) {
                $join->on("INV.union_id", "=", "CRT.union_id")
                    ->on("INV.sonod_no", "=", "CRT.sonod_no")
                    ->where([
                        "INV.type" => 3,
                        "CRT.type" => 19
                    ]);
            })
            ->where([
                ['CRT.union_id', '=', $receive['union_id']],
                ['CRT.type', '=', 19],
                ['APP.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['CRT.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['CRT.is_active', '=', 1],
                ['APP.union_id', '=', $receive['union_id']],
                ['APP.type', '=', 19],
                ['APP.is_active', '=', 1],
            ])
            ->whereDate('CRT.created_time', '>=', $receive['from_date'])
            ->whereDate('CRT.created_time', '<=', $receive['to_date'])
            ->groupBy("CRT.sonod_no")
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
        
        // dd($data);

        return $data;
    }

    //====previous tradelicense certificate list data====//
    public function prev_trade_certificate_list($receive)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.owner_type', 'TRDOPT.business_type', 'TRDOPT.mobile', 'TRDOPT.email')
            ->join('application AS APP', function ($join) {
                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->where("APP.is_active", "=", 1);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) {
                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->where([
                ['CRT.union_id', '=', $receive['union_id']],
                ['CRT.type', '=', 19],
                ['CRT.fiscal_year_id', '=', $receive['fiscal_year_id']],
                ['CRT.is_active', '=', 1],
                ['APP.union_id', '=', $receive['union_id']],
                ['APP.type', '=', 19],
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

    //====expire tradelicense  list data====//
    public function expire_trade_certificate_list($union_id = null)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.pin', 'CRT.tracking', 'CRT.created_time as generate_date', 'CRT.expire_date', 'CRT.union_id', 'TRDOPT.organization_name_bn', 'TRDOPT.owner_type', 'BTYPE.name_bn as business_type', 'TRDOPT.mobile', 'TRDOPT.email', 'TRDOPT.trade_upazila_id', 'TRDOPT.trade_district_id')
            ->join('application AS APP', function ($join) {
                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->where("APP.is_active", "=", 1);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) {
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
                ['CRT.type', '=', 19],
                ['CRT.is_active', '=', 1],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', 19],
                ['APP.is_active', '=', 1],
            ])
            ->where('CRT.status', '=', 3)
            ->get();

        return $query;
    }

    //====get money data=======//
    public function money_receipt_data($voucher_no = null, $union_id = null, $type = null, $call_from = 'money_receipt')
    {
        $invoice_data = DB::table('acc_invoice')->where(['union_id' => $union_id, 'voucher_no' => $voucher_no, 'type'
        => 3 ])->first();

        // dd($invoice_data);

        if (empty($invoice_data)) {
            return false;
        }

        $sonod_no = $invoice_data->sonod_no;
        $invoice_id = $invoice_data->invoice_id;
        $txn_no = $invoice_data->txn_no;
        $is_paid = $invoice_data->is_paid;

        $data['organization'] = DB::table('certificate AS CRT')
            ->select('CRT.sonod_no', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.trade_village_bn', 'TRDOPT.trade_ward_no', 'BD.bn_name AS postoffice_name', 'FSY.name as fiscal_year_name', 'BSYTP.name_bn as business_type', 'INV.invoice_id', 'INV.voucher_no',DB::raw("DATE(INV.created_at) as payment_date") )
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id, $sonod_no) {
                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("CRT.sonod_no", "=", $sonod_no)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join("bd_locations AS BD", "BD.id", "=", "TRDOPT.trade_postoffice_id")
            ->join('business_type AS BSYTP', function ($join) use ($union_id, $sonod_no) {
                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("CRT.sonod_no", "=", $sonod_no)
                    ->where("BSYTP.is_active", "=", 1);
            })
            ->join('acc_invoice AS INV', function ($join) use ($union_id, $sonod_no, $voucher_no) {
                $join->on("INV.union_id", "=", "CRT.union_id")
                    ->on("INV.sonod_no", "=", "CRT.sonod_no")
                    // ->on("INV.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("INV.union_id", $union_id)
                    ->where("INV.sonod_no", $sonod_no)
                    ->where("INV.voucher_no", $voucher_no);
            })
            ->join('fiscal_years AS FSY', function ($join) use ($union_id) {
                $join->on("FSY.id", "=", 'INV.fiscal_year_id')
                    ->where("FSY.is_active", "=", '1');
            })
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
            ])
            ->first();

        // dd($data);

        // voucher no assign in organization
        // $data['organization']->voucher = $voucher_no;

        // if invoice paid then query with transaction tbl
        // else join with acc_voucher tbl

        // get current voucher fee amount
        $fee_data = DB::table('acc_invoice AS INV')
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type')

            // generate invoice + pending for payment
            ->when($is_paid == 0, function ($query) use ($voucher_no, $sonod_no, $union_id, $type) {
                $query->join('acc_voucher AS ACV', function ($join) use ($voucher_no, $sonod_no, $union_id) {
                    $join->on('ACV.sonod_no', '=', 'INV.sonod_no')
                        ->on('ACV.union_id', '=', 'INV.union_id')
                        ->on('ACV.invoice_id', '=', 'INV.invoice_id')
                        ->on('ACV.voucher_id', '=', 'INV.voucher_no')
                        ->where('ACV.union_id', $union_id)
                        ->where('ACV.sonod_no', $sonod_no)
                        ->where('ACV.voucher_id', $voucher_no);
                })
                    ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                        $join->on('ACCRDT.id', '=', 'ACV.acc_no')
                            ->on('ACCRDT.union_id', '=', 'ACV.union_id')
                            ->where('ACCRDT.is_active', 1)
                            ->where('ACCRDT.union_id', $union_id);
                    })
                    ->where(function ($query) use ($type) {
                        $query->where('ACV.type', '=', 28)
                            ->orWhere('ACV.type', '=', $type);
                    })
                    ->selectRaw("ACV.amount, ACV.voucher_id as voucher");

            })

            // Direct generate or paid
            ->when($is_paid == 1, function ($query) use ($voucher_no, $sonod_no, $union_id, $type) {
                $query->join('acc_transaction AS TRNS', function ($join) use ($voucher_no, $sonod_no, $union_id) {
                    $join->on('TRNS.sonod_no', '=', 'INV.sonod_no')
                        ->on('TRNS.union_id', '=', 'INV.union_id')
                        ->on('TRNS.voucher', '=', 'INV.voucher_no')
                        ->where('TRNS.is_active', 1)
                        ->where('TRNS.sonod_no', $sonod_no)
                        ->where('TRNS.voucher', $voucher_no)
                        ->where('TRNS.union_id', $union_id);
                })
                    ->join('acc_account AS ACCRDT', function ($join) use ($union_id, $voucher_no) {
                        $join->on('ACCRDT.id', '=', 'TRNS.credit')
                            ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                            ->where('ACCRDT.is_active', 1)
                            ->where('TRNS.voucher', $voucher_no)
                            ->where('ACCRDT.union_id', $union_id);
                    })
                    ->where(function ($query) use ($type) {
                        $query->where('TRNS.type', '=', 28)
                            ->orWhere('TRNS.type', '=', $type);
                    })
                    ->selectRaw("TRNS.amount, TRNS.voucher");
            })
            ->get();

        // dd($fee_data);

        //ready fee array
        $fee_list = [];

        foreach ($fee_data as $fee) {
            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount
            ];
        }

        $data['fee_data'] = $fee_list;

        // due fiscal year amount
        if ($is_paid) {   // paid voucher
            //            $data['due_list'] = DB::table("acc_invoice AS INV")
            //                        ->join("fiscal_years AS FY", "FY.id", "INV.fiscal_year_id")
            //                        ->where([
            //                            "INV.sonod_no" => $sonod_no,
            //                            "INV.txn_no" => $txn_no
            //                        ])
            //                            ->where("INV.voucher_no", "!=", $voucher_no)
            //                        ->select("INV.invoice_id", "INV.voucher_no", "INV.sonod_no", DB::raw("SUM(INV.amount) AS total_due"), "FY.name AS fiscal_year")
            //                        ->get()->first();
            $due_list_qry = DB::table("acc_invoice AS INV")
                ->join("fiscal_years AS FY", "FY.id", "INV.fiscal_year_id")
                ->join('acc_voucher AS AV', function ($join) {
                    $join->on('AV.invoice_id', '=', 'INV.invoice_id')
                        ->on('AV.voucher_id', '=', 'INV.voucher_no');
                })
                ->where([
                    "INV.sonod_no" => $sonod_no,
                    "INV.txn_no" => $txn_no,
                    "INV.type" => 3
                ])
                ->where("INV.voucher_no", "!=", $voucher_no)
                ->select("INV.invoice_id", "INV.voucher_no", "INV.sonod_no", "AV.amount", "AV.acc_no", "FY.name AS fiscal_year")
                ->get()->toArray();

            $data['due_list'] = array_column($due_list_qry, 'amount', 'acc_no');
            $data['total_due_amount'] = array_sum($data['due_list']);
            foreach ($data['due_list'] as $key => $value) {
                if ($key == 22) {
                    $data['due_list'][$key] = 'ট্রেড লাইসেন্স -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 23) {
                    $data['due_list'][$key] = 'সাইনবোর্ড কর -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 24) {
                    $data['due_list'][$key] = 'সার চার্জ -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 25) {
                    $data['due_list'][$key] = 'উৎসেকর -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 28) {
                    $data['due_list'][$key] = '১৫%ভ্যাট -' . \BanglaConverter::bn_others($value);
                }
            }

            $data['due_invoice_id'] = isset($due_list_qry[0]->invoice_id) ? $due_list_qry[0]->invoice_id : null;
            $data['due_fiscal_year'] = isset($due_list_qry[0]->fiscal_year) ? $due_list_qry[0]->fiscal_year : null;


        } else {    // unpaid voucher
            $due_list_qry = DB::table("acc_invoice AS INV")
                ->join("fiscal_years AS FY", "FY.id", "INV.fiscal_year_id")
                ->join('acc_voucher AS AV', function ($join) {
                    $join->on('AV.invoice_id', '=', 'INV.invoice_id')
                        ->on('AV.voucher_id', '=', 'INV.voucher_no');
                })
                ->where([
                    "INV.sonod_no" => $sonod_no,
                    "INV.is_paid" => 0
                ])
                ->where("INV.voucher_no", "!=", $voucher_no)
                ->select("INV.invoice_id", "INV.voucher_no", "INV.sonod_no", "AV.amount", "AV.acc_no", "FY.name AS fiscal_year")
                ->get()->toArray();

            $data['due_list'] = array_column($due_list_qry, 'amount', 'acc_no');
            $data['total_due_amount'] = array_sum($data['due_list']);
            foreach ($data['due_list'] as $key => $value) {
                if ($key == 22) {
                    $data['due_list'][$key] = 'ট্রেড লাইসেন্স -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 23) {
                    $data['due_list'][$key] = 'সাইনবোর্ড কর -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 24) {
                    $data['due_list'][$key] = 'সার চার্জ -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 25) {
                    $data['due_list'][$key] = 'উৎসেকর -' . \BanglaConverter::bn_others($value);
                }
                if ($key == 28) {
                    $data['due_list'][$key] = '১৫%ভ্যাট -' . \BanglaConverter::bn_others($value);
                }
            }

            $data['due_invoice_id'] = isset($due_list_qry[0]->invoice_id) ? $due_list_qry[0]->invoice_id : null;
            $data['due_fiscal_year'] = isset($due_list_qry[0]->fiscal_year) ? $due_list_qry[0]->fiscal_year : null;
        }


        // dd($data['due_list']);

        //if not found array data
        if (empty($data['organization']) || empty($data['fee_data'])) {
            return false;
        } else {
            return $data;
        }
    }

    //==========trade license register data==============//
    public function trade_register_data($union_id = null, $type = null, $from_date = null, $to_date = null, $fiscal_year_id = null)
    {

        $certificate_data = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'TRDOPT.organization_name_bn', 'INV.voucher_no', 'INV.txn_no', 'INV.payment_date')
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id, $fiscal_year_id, $from_date, $to_date) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("CRT.type", "=", 19)
                    ->where("TRDOPT.is_active", "=", 1)
                    // ->whereDate('CRT.created_time', '>=', $from_date)
                    // ->whereDate('CRT.created_time', '<=', $to_date)
                    ->when(!is_null($fiscal_year_id), function ($query) use ($fiscal_year_id) {
                        $query->where('TRDOPT.fiscal_year_id', $fiscal_year_id);
                    });
            })
            ->join('acc_invoice AS INV', function ($join) use ($union_id, $from_date, $to_date) {
                $join->on('CRT.fiscal_year_id', '=', 'INV.fiscal_year_id')
                    ->on('CRT.union_id', '=', 'INV.union_id')
                    ->on('CRT.sonod_no', '=', 'INV.sonod_no')
                    ->where('CRT.union_id', $union_id)
                    ->where('CRT.type', 19) // trade
                    ->where('INV.is_paid', 1)
                    ->where('INV.type', 3)  // trade
                    ->whereDate('INV.payment_date', '>=', $from_date)
                    ->whereDate('INV.payment_date', '<=', $to_date);
            })
            ->whereDate('INV.payment_date', '>=', $from_date)
            ->whereDate('INV.payment_date', '<=', $to_date)
            ->when(!is_null($fiscal_year_id), function ($query) use ($fiscal_year_id) {
                $query->where('CRT.fiscal_year_id', $fiscal_year_id);
            })
            ->get()->toArray();

        // dd($certificate_data);

        $sonod_voucher_list = array_column($certificate_data, "voucher_no");

        // dd($sonod_voucher_list);

        $transaction_data = DB::table("acc_transaction AS TRNS")
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('TRNS.type', 19)
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->whereIn("voucher", $sonod_voucher_list)
            ->select('TRNS.sonod_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
            ->get();

        // dd($transaction_data);


        //ready rigister data
        $data = [];

        foreach ($certificate_data as $citem) {
            $data[$citem->sonod_no] = [
                'organization_name' => $citem->organization_name_bn,
                'payment_date' => $citem->payment_date,
                'voucher_no' => $citem->voucher_no,
                'txn_no' => $citem->txn_no,
                'fee' => 0,
                'due' => 0,
                'vat' => 0,
                'discount' => 0,
                'signbord_vat' => 0,
                'pesha_vat' => 0,
                'source_vat' => 0,
                'sarcharge' => 0,
                'trade_due' => 0,
                'vat_due' => 0,
                'signbord_vat_due' => 0,
                'source_vat_due' => 0,
                'sarcharge_due' => 0,
            ];
        }

        // dd($data);

        foreach ($transaction_data as $item) {

            if (isset($data[$item->sonod_no])) {

                if ($item->credit_account_type == 19) {
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

                if ($item->credit_account_type == 28) {
                    $data[$item->sonod_no]['pesha_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 97) {
                    $data[$item->sonod_no]['source_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 22) {
                    $data[$item->sonod_no]['sarcharge'] = $item->amount;
                }
            } else {


            }
        }

        $voucher_list = array_column($data, 'voucher_no');

        $tnx_list = array_column($data, 'txn_no');

        $due_voucher_query = DB::table('acc_invoice')
            ->whereNotIn('voucher_no', $voucher_list)
            ->whereIn('txn_no', $tnx_list)
            ->select('voucher_no')
            ->get()
            ->toArray();

        $due_voucher_list = array_column($due_voucher_query, 'voucher_no');

        //  dd($due_voucher_list);

        $due_query = DB::table('acc_transaction AS TRNS')
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->whereIn('TRNS.voucher', $due_voucher_list)
            ->where("TRNS.union_id", $union_id)
            ->select('TRNS.amount', 'TRNS.sonod_no', 'TRNS.voucher', 'ACCRDT.acc_type')
            ->get()->toArray();

        //  dd($due_query);


        foreach ($due_query as $item) {

            if ($item->acc_type == 19) {
                $data[$item->sonod_no]['trade_due'] = $item->amount;
            }
            if ($item->acc_type == 25) {
                $data[$item->sonod_no]['vat_due'] = $item->amount;
            }
            if ($item->acc_type == 21) {
                $data[$item->sonod_no]['signbord_vat_due'] = $item->amount;
            }
            if ($item->acc_type == 97) {
                $data[$item->sonod_no]['source_vat_due'] = $item->amount;
            }
            if ($item->acc_type == 22) {
                $data[$item->sonod_no]['sarcharge_due'] = $item->amount;
            }
        }

        //  dd($data);

        return $data;
    }

    //=========pesha kor register data==========//
    public function peshakor_register_data($union_id = null, $type = null, $from_date = null, $to_date = null)
    {

        $data = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time as payment_date', 'TRDOPT.organization_name_bn')
            ->join("acc_transaction AS TRNS", function ($join) use ($union_id, $type) {

                $join->on('CRT.sonod_no', '=', 'TRNS.sonod_no')
                    ->on('CRT.union_id', '=', 'TRNS.union_id')
                    ->where('CRT.union_id', $union_id)
                    ->where('CRT.type', $type)
                    ->where('TRNS.type', 28);
                // ->where('TRNS.credit', 36);

            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->whereDate('CRT.created_time', '>=', $from_date)
            ->whereDate('CRT.created_time', '<=', $to_date)
            ->get();

        return $data;
    }

    //=======get dialy trade and pesha collection report======//
    public function daily_trade_pesha_vat_report_data($union_id = null, $type = null, $from_date = null, $to_date = null)
    {

        $trade_pesha_data = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'TRDOPT.organization_name_bn', 'ACCDBT.account_name as debit_account_name', 'ACCDBT.acc_type as debit_account_type', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
            ->join("acc_transaction AS TRNS", function ($join) use ($union_id, $type) {

                $join->on('CRT.sonod_no', '=', 'TRNS.sonod_no')
                    ->on('CRT.union_id', '=', 'TRNS.union_id')
                    ->where('CRT.union_id', $union_id)
                    ->where('CRT.is_active', 1);
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
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })

            //for pehsa kor and trade transection
            ->where(function ($query) use ($type) {
                $query->where('TRNS.type', '=', 28)
                    ->orWhere('TRNS.type', '=', $type);
            })
            ->whereDate('CRT.created_time', '>=', $from_date)
            ->whereDate('CRT.created_time', '<=', $to_date)
            ->get();


        //ready rigister data
        $data = [];

        foreach ($trade_pesha_data as $item) {

            if (isset($data[$item->sonod_no])) {

                if ($item->credit_account_type == 19) {
                    $data[$item->sonod_no]['fee'] = $item->amount;
                }

                if ($item->credit_account_type == 25) {
                    $data[$item->sonod_no]['vat'] = $item->amount;
                }

                if ($item->credit_account_type == 24) {
                    $data[$item->sonod_no]['discount'] = $item->amount;
                }


                if ($item->credit_account_type == 28) {
                    $data[$item->sonod_no]['pesha_vat'] = $item->amount;
                }
            } else {

                $data[$item->sonod_no] = [

                    'organization_name' => $item->organization_name_bn,
                    'payment_date' => $item->payment_date,

                    'fee' => ($item->credit_account_type == 19) ? $item->amount : 0,
                    'vat' => ($item->credit_account_type == 25) ? $item->amount : 0,
                    'discount' => ($item->credit_account_type == 24) ? $item->amount : 0,
                    'pesha_vat' => ($item->credit_account_type == 28) ? $item->amount : 0,
                ];
            }
        }


        return $data;
    }

    //========get daily vat collection report======/
    public function daily_vat_report_data($union_id = null, $type = null, $from_date = null, $to_date = null)
    {


        $trade_vat_data = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'TRDOPT.organization_name_bn', 'ACC.acc_type as account_type')
            ->join("acc_transaction AS TRNS", function ($join) use ($union_id, $type) {

                $join->on('CRT.sonod_no', '=', 'TRNS.sonod_no')
                    ->on('CRT.union_id', '=', 'TRNS.union_id')
                    ->on('CRT.type', '=', 'TRNS.type')
                    ->where('CRT.union_id', $union_id)
                    ->where('CRT.is_active', 1)
                    ->where('CRT.type', $type);
            })
            ->join("acc_account AS ACC", function ($join) use ($union_id, $type) {

                $join->on('ACC.id', '=', 'TRNS.credit')
                    ->on('ACC.union_id', '=', 'TRNS.union_id')
                    ->where('ACC.union_id', $union_id)
                    ->where('ACC.is_active', 1);
            })
            ->leftJoin('trade_optional_info AS TRDOPT', function ($join) use ($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->whereDate('CRT.created_time', '>=', $from_date)
            ->whereDate('CRT.created_time', '<=', $to_date)
            ->get();


        //ready rigister data
        $data = [];

        foreach ($trade_vat_data as $item) {

            if (isset($data[$item->sonod_no])) {

                if ($item->account_type == 19) {
                    $data[$item->sonod_no]['fee'] = $item->amount;
                }

                if ($item->account_type == 25) {
                    $data[$item->sonod_no]['vat'] = $item->amount;
                }

                if ($item->account_type == 24) {
                    $data[$item->sonod_no]['discount'] = $item->amount;
                }
            } else {

                $data[$item->sonod_no] = [

                    'organization_name' => $item->organization_name_bn,
                    'payment_date' => $item->payment_date,
                    'voucher' => $item->voucher,

                    'fee' => ($item->account_type == 19) ? $item->amount : 0,
                    'vat' => ($item->account_type == 25) ? $item->amount : 0,
                    'discount' => ($item->account_type == 24) ? $item->amount : 0,

                ];
            }
        }

        return $data;
    }

    //==========pesha kor list data============//
    public function pesha_kor_list_data($receive = null, $search_content = null)
    {

        $query = DB::table("certificate AS CRT")
            ->select(DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'TRDOPT.organization_name_bn', 'TRDOPT.tracking')
            ->join("acc_transaction AS TRNS", function ($join) use ($receive) {

                $join->on('CRT.sonod_no', '=', 'TRNS.sonod_no')
                    ->on('CRT.union_id', '=', 'TRNS.union_id')
                    ->on('CRT.fiscal_year_id', '=', 'TRNS.fiscal_year_id')
                    ->where('CRT.union_id', $receive['union_id'])
                    ->where('CRT.is_active', 1)
                    ->where('CRT.fiscal_year_id', $receive['fiscal_year_id'])
                    ->where('TRNS.fiscal_year_id', $receive['fiscal_year_id'])
                    ->where('TRNS.credit', $receive['credit']) //this pesha kor account id
                    ->where('TRNS.type', 28); //this pesha kor type

            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($receive) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("TRDOPT.union_id", "=", $receive['union_id'])
                    ->where("TRDOPT.fiscal_year_id", "=", $receive['fiscal_year_id'])
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->whereDate('TRNS.created_time', '>=', $receive['from_date'])
            ->whereDate('TRNS.created_time', '<=', $receive['to_date'])
            ->offset($receive['start'])
            ->limit($receive['limit'])
            ->orderBy("TRNS.created_time", "DESC");


        //for datatable on page searching
        if ($search_content != false) {

            $query->where("CRT.tracking", "LIKE", $search_content)
                ->orWhere("CRT.sonod_no", "LIKE", $search_content)
                ->orWhere("TRNS.voucher", "LIKE", $search_content)
                ->orWhere("TRDOPT.organization_name_bn", "LIKE", "%" . $search_content . "%");
        }

        $data['data'] = $query->get();

        return $data;
    }

    //========get pesha kor money receipt data========//
    public function peshakor_money_receipt_data($sonod_no = null, $union_id = null, $type = null, $fiscal_year_id = null)
    {

        DB::enableQueryLog();

        return DB::table('certificate AS CRT')
            ->select('CRT.sonod_no', 'CRT.created_time as generate_date', 'TRDOPT.organization_name_bn', 'TRDOPT.trade_village_bn', 'TRDOPT.trade_ward_no', 'FSY.name as fiscal_year_name', 'BSYTP.name_bn as business_type', 'TRNS.voucher', 'TRNS.amount', 'TRNS.created_time as payment_date')
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id, $fiscal_year_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where([
                        "TRDOPT.union_id" => $union_id,
                        "TRDOPT.fiscal_year_id" => $fiscal_year_id,
                        "TRDOPT.is_active" => 1,
                    ]);
            })
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id, $type, $fiscal_year_id) {

                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->on('TRNS.fiscal_year_id', '=', 'CRT.fiscal_year_id')
                    ->where([
                        ['TRNS.is_active', 1],
                        ['TRNS.fiscal_year_id', $fiscal_year_id],
                        // ['TRNS.credit', 36],//this pesha kor account id
                        ['TRNS.sonod_no', $sonod_no],
                        ['TRNS.union_id', $union_id],
                        ['TRNS.type', 28], //this pesha kor type
                    ]);
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
                ['CRT.fiscal_year_id', '=', $fiscal_year_id],
                ['CRT.is_active', '=', 1],
            ])
            ->first();
    }

    //==========get pesha kor data=============//
    public function get_pesha_kor_data($sonod_no = null, $union_id = null, $type = null, $fiscal_year_id = null)
    {


        DB::enableQueryLog();

        //this fiscal year pesha kor existing cheack
        $existing = DB::table('acc_transaction')
            ->where([
                'sonod_no' => $sonod_no,
                'union_id' => $union_id,
                'type' => 28,
                'fiscal_year_id' => $fiscal_year_id,
                // 'credit' => 36,
            ])
            ->count();

        if ($existing > 0) {

            return ['status' => "error", "message" => "আপনার পেশা কর পূর্বে নেওয়া হয়েছে", 'data' => []];

            exit;
        }


        $data = DB::table('certificate AS CRT')
            ->select(DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'TRDOPT.organization_name_bn', 'TRDOPT.tracking', 'TRNS.voucher')
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id, $fiscal_year_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where([
                        "TRDOPT.union_id" => $union_id,
                        "TRDOPT.fiscal_year_id" => $fiscal_year_id,
                        "TRDOPT.is_active" => 1,
                    ]);
            })
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id, $type, $fiscal_year_id) {

                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->on('TRNS.fiscal_year_id', '=', 'CRT.fiscal_year_id')
                    ->on('TRNS.type', '=', 'CRT.type')
                    ->where([
                        ['TRNS.is_active', 1],
                        ['TRNS.fiscal_year_id', $fiscal_year_id],
                        ['TRNS.sonod_no', $sonod_no],
                        ['TRNS.union_id', $union_id],
                        ['TRNS.type', $type],
                    ]);
            })
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
                ['CRT.fiscal_year_id', '=', $fiscal_year_id],
                ['CRT.is_active', '=', 1],
            ])
            ->first();

        return ['status' => "success", 'data' => $data];
    }

    //============pesha kor save===========//
    public function pesha_kor_save($receive = null)
    {

        $transaction_data = [

            'union_id' => $receive->union_id,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'voucher' => $receive->voucher,
            'sonod_no' => $receive->sonod_no,
            'debit' => NULL,
            'credit' => $receive->credit_id, //pesha kor account id
            'amount' => $receive->pesha_kor,
            'type' => 28, //pesha kor type

            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->payment_date . date(' H:i:s'),
            'created_by_ip' => Request::ip(),

        ];


        $insert_transection = DB::table("acc_transaction")->insert($transaction_data);


        if ($insert_transection) {

            return ['status' => 'success', 'sonod_no' => $receive->sonod_no, 'message' => "পেশা কর আদায় হয়েছে। রশিদ গ্রহণ করুন"];
        } else {

            return ['status' => 'error', 'message' => "দুঃখিত ! পেশা কর আদায় হয়নি"];
        }
    }



    //==========trade license register data==============//
    public function trade_dabi_aday_register_data($union_id = null, $type = null, $from_date = null, $to_date = null, $fiscal_year_id = null)
    {
        // dd($fiscal_year_id . "  done");

        $certificate_data_paid = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'TRDOPT.organization_name_bn', 'INV.voucher_no', 'INV.txn_no', 'INV.payment_date', 'INV.is_paid')
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id, $fiscal_year_id, $from_date, $to_date) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("CRT.type", "=", 19)
                    ->where("TRDOPT.is_active", "=", 1)
                    // ->whereDate('CRT.created_time', '>=', $from_date)
                    // ->whereDate('CRT.created_time', '<=', $to_date)
                    ->when(!is_null($fiscal_year_id), function ($query) use ($fiscal_year_id) {
                        $query->where('TRDOPT.fiscal_year_id', $fiscal_year_id);
                    });
            })
            ->join('acc_invoice AS INV', function ($join) use ($union_id, $from_date, $to_date) {
                $join->on('CRT.fiscal_year_id', '=', 'INV.fiscal_year_id')
                    ->on('CRT.union_id', '=', 'INV.union_id')
                    ->on('CRT.sonod_no', '=', 'INV.sonod_no')
                    ->where('CRT.union_id', $union_id)
                    ->where('CRT.type', 19) // trade
                    ->where('INV.is_paid', 1)
                    ->where('INV.type', 3);  // trade
                    // ->whereDate('INV.payment_date', '>=', $from_date)
                    // ->whereDate('INV.payment_date', '<=', $to_date);
            })
            // ->whereDate('INV.payment_date', '>=', $from_date)
            // ->whereDate('INV.payment_date', '<=', $to_date)
            ->when(!is_null($fiscal_year_id), function ($query) use ($fiscal_year_id) {
                $query->where('CRT.fiscal_year_id', $fiscal_year_id);
            })
            ->get()->toArray();

            $sonod_voucher_list_paid = array_column($certificate_data_paid, "voucher_no");

            $transaction_data_paid = DB::table("acc_transaction AS TRNS")
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('TRNS.type', 19)
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->whereIn("voucher", $sonod_voucher_list_paid)
            ->select('TRNS.sonod_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
            ->get();


            // not paid system

        // dd($certificate_data_paid);
        //  unpaid certifiacte data
        $certificate_data_not_paid = DB::table("certificate AS CRT")
            ->select('CRT.sonod_no', 'TRDOPT.organization_name_bn', 'INV.voucher_no', 'INV.txn_no', 'INV.payment_date', 'INV.is_paid')
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($union_id, $fiscal_year_id, $from_date, $to_date) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("CRT.type", "=", 19)
                    ->where("TRDOPT.is_active", "=", 1)
                    // ->whereDate('CRT.created_time', '>=', $from_date)
                    // ->whereDate('CRT.created_time', '<=', $to_date)
                    ->when(!is_null($fiscal_year_id), function ($query) use ($fiscal_year_id) {
                        $query->where('TRDOPT.fiscal_year_id', $fiscal_year_id);
                    });
            })
            ->join('acc_invoice AS INV', function ($join) use ($union_id, $from_date, $to_date) {
                $join->on('CRT.fiscal_year_id', '=', 'INV.fiscal_year_id')
                    ->on('CRT.union_id', '=', 'INV.union_id')
                    ->on('CRT.sonod_no', '=', 'INV.sonod_no')
                    ->where('CRT.union_id', $union_id)
                    ->where('CRT.type', 19) // trade
                    ->where('INV.is_paid', 0)
                    ->where('INV.type', 3);  // trade
                    // ->whereDate('INV.payment_date', '>=', $from_date)
                    // ->whereDate('INV.payment_date', '<=', $to_date);
            })
            // ->whereDate('INV.payment_date', '>=', $from_date)
            // ->whereDate('INV.payment_date', '<=', $to_date)
            ->when(!is_null($fiscal_year_id), function ($query) use ($fiscal_year_id) {
                $query->where('CRT.fiscal_year_id', $fiscal_year_id);
            })
            ->get()->toArray();


        $sonod_voucher_list_not_paid = array_column($certificate_data_not_paid, "voucher_no");


        $transaction_data_not_paid = DB::table("acc_transaction AS TRNS")
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('TRNS.type', 19)
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->whereIn("voucher", $sonod_voucher_list_not_paid)
            ->select('TRNS.sonod_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
            ->get();

    // dd($transaction_data_paid);
        //ready rigister paid data
        $data_paid = [];

        foreach ($certificate_data_paid as $citem) {
            $data_paid[$citem->sonod_no] = [
                'organization_name' => $citem->organization_name_bn,
                'payment_date' => $citem->payment_date,
                'voucher_no' => $citem->voucher_no,
                'txn_no' => $citem->txn_no,
                'sonod_no' => $citem->sonod_no,
                'is_paid' => $citem->is_paid,
                'total' => 0,
                'due' => 0,
                'fee' => 0,
                'discount' => 0,
                'signbord_vat' => 0,
                'pesha_vat' => 0,
                'source_vat' => 0,
                'sarcharge' => 0,
                'vat' => 0,
                'bibidh' => 0,
                'trade_due' => 0,
                'vat_due' => 0,
                'signbord_vat_due' => 0,
                'source_vat_due' => 0,
                'sarcharge_due' => 0,
            ];
        }

        //ready rigister not paid data
        $data_not_paid = [];

        foreach ($certificate_data_not_paid as $citem) {
            $data_not_paid[$citem->sonod_no] = [
                'organization_name' => $citem->organization_name_bn,
                'payment_date' => $citem->payment_date,
                'voucher_no' => $citem->voucher_no,
                'txn_no' => $citem->txn_no,
                'sonod_no' => $citem->sonod_no,
                'is_paid' => $citem->is_paid,
                'total' => 0,
                'due' => 0,
                'fee' => 0,
                'discount' => 0,
                'signbord_vat' => 0,
                'pesha_vat' => 0,
                'source_vat' => 0,
                'sarcharge' => 0,
                'vat' => 0,
                'bibidh' => 0,
                'trade_due' => 0,
                'vat_due' => 0,
                'signbord_vat_due' => 0,
                'source_vat_due' => 0,
                'sarcharge_due' => 0,
            ];
        }
        // dd($transaction_data_paid);

        foreach ($transaction_data_paid as $item) {

            if (isset($data_paid[$item->sonod_no])) {

                if ($item->credit_account_type == 19) {
                    $data_paid[$item->sonod_no]['fee'] = $item->amount;
                }

                if ($item->credit_account_type == 23) {
                    $data_paid[$item->sonod_no]['due'] += $item->amount;
                }

                if ($item->credit_account_type == 25) {
                    $data_paid[$item->sonod_no]['vat'] = $item->amount;
                }

                if ($item->credit_account_type == 24) {
                    $data_paid[$item->sonod_no]['discount'] = $item->amount;
                }

                if ($item->credit_account_type == 21) {
                    $data_paid[$item->sonod_no]['signbord_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 28) {
                    $data_paid[$item->sonod_no]['pesha_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 97) {
                    $data_paid[$item->sonod_no]['source_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 22) {
                    $data_paid[$item->sonod_no]['sarcharge'] = $item->amount;
                }
                if ($item->credit_account_type == 145) {
                    $data_paid[$item->sonod_no]['bibidh'] = $item->amount;
                }

            } else {


            }
        }

        foreach ($transaction_data_not_paid as $item) {

            if (isset($data_not_paid[$item->sonod_no])) {

                if ($item->credit_account_type == 19) {
                    $data_not_paid[$item->sonod_no]['fee'] = $item->amount;
                }

                if ($item->credit_account_type == 23) {
                    $data_not_paid[$item->sonod_no]['due'] += $item->amount;
                }

                if ($item->credit_account_type == 25) {
                    $data_not_paid[$item->sonod_no]['vat'] = $item->amount;
                }

                if ($item->credit_account_type == 24) {
                    $data_not_paid[$item->sonod_no]['discount'] = $item->amount;
                }

                if ($item->credit_account_type == 21) {
                    $data_not_paid[$item->sonod_no]['signbord_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 28) {
                    $data_not_paid[$item->sonod_no]['pesha_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 97) {
                    $data_not_paid[$item->sonod_no]['source_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 22) {
                    $data_not_paid[$item->sonod_no]['sarcharge'] = $item->amount;
                }

                if ($item->credit_account_type == 145) {
                    $data_paid[$item->sonod_no]['bibidh'] = $item->amount;
                }

                if($item->credit_account_type != 24){
                    $data_not_paid[$item->sonod_no]['total'] += $item->amount;
                }

            } else {


            }
        }


        $voucher_list_paid = array_column($data_paid, 'voucher_no');

        $voucher_list_not_paid = array_column($data_not_paid, 'voucher_no');

        $tnx_list_paid = array_column($data_paid, 'txn_no');

        $tnx_list_not_paid = array_column($data_not_paid, 'txn_no');

        $due_voucher_query_paid = DB::table('acc_invoice')
            ->whereNotIn('voucher_no', $voucher_list_paid)
            ->whereIn('txn_no', $tnx_list_paid)
            ->select('voucher_no')
            ->get()
            ->toArray();

        $due_voucher_list_paid = array_column($due_voucher_query_paid, 'voucher_no');

        // not paid
        $due_voucher_query_not_paid = DB::table('acc_invoice')
        ->whereNotIn('voucher_no', $voucher_list_not_paid)
        ->whereIn('txn_no', $tnx_list_not_paid)
        ->select('voucher_no')
        ->get()
        ->toArray();

    $due_voucher_list_not_paid = array_column($due_voucher_query_not_paid, 'voucher_no');

        //  dd($due_voucher_list);

        $due_query_paid = DB::table('acc_transaction AS TRNS')
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->whereIn('TRNS.voucher', $due_voucher_list_paid)
            ->where("TRNS.union_id", $union_id)
            ->select('TRNS.amount', 'TRNS.sonod_no', 'TRNS.voucher', 'ACCRDT.acc_type')
            ->get()->toArray();

        //  dd($due_query);

        // dd($due_query_paid);
// dd($data_paid[21008825019000001]['due'] += 10);

        foreach ($due_query_paid as $item) {

            if(isset($data_paid[$item->sonod_no]['due'])){
                // if($item->sonod_no > 0){
                    $data_paid[$item->sonod_no]['due'] += $item->amount;
                // }
            }

            // dd($data_paid[$item->sonod_no]['due']);

            if ($item->acc_type == 19) {
                $data_paid[$item->sonod_no]['trade_due'] = $item->amount;
            }
            if ($item->acc_type == 25) {
                $data_paid[$item->sonod_no]['vat_due'] = $item->amount;
            }
            if ($item->acc_type == 21) {
                $data_paid[$item->sonod_no]['signbord_vat_due'] = $item->amount;
            }
            if ($item->acc_type == 97) {
                $data_paid[$item->sonod_no]['source_vat_due'] = $item->amount;
            }
            if ($item->acc_type == 22) {
                $data_paid[$item->sonod_no]['sarcharge_due'] = $item->amount;
            }



        }

        // dd($data_paid);



        // not paid due query
        $due_query_not_paid = DB::table('acc_transaction AS TRNS')
        ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
            $join->on('ACCRDT.id', '=', 'TRNS.credit')
                ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                ->where('ACCRDT.union_id', $union_id);
        })
        ->whereIn('TRNS.voucher', $due_voucher_list_not_paid)
        ->where("TRNS.union_id", $union_id)
        ->select('TRNS.amount', 'TRNS.sonod_no', 'TRNS.voucher', 'ACCRDT.acc_type')
        ->get()->toArray();


        foreach ($due_query_not_paid as $item) {

            if($item->sonod_no > 0){
                $data_not_paid[$item->sonod_no]['due'] += $item->amount;
            }

            if ($item->acc_type == 19) {
                $data_not_paid[$item->sonod_no]['trade_due'] = $item->amount;
            }
            if ($item->acc_type == 25) {
                $data_not_paid[$item->sonod_no]['vat_due'] = $item->amount;
            }
            if ($item->acc_type == 21) {
                $data_not_paid[$item->sonod_no]['signbord_vat_due'] = $item->amount;
            }
            if ($item->acc_type == 97) {
                $data_not_paid[$item->sonod_no]['source_vat_due'] = $item->amount;
            }
            if ($item->acc_type == 22) {
                $data_not_paid[$item->sonod_no]['sarcharge_due'] = $item->amount;
            }
        }

        foreach($data_paid as $key => $ditem){
            $data_paid[$key]['total'] = $ditem['fee'] + $ditem['vat'] + $ditem['signbord_vat'] + $ditem['source_vat'] + $ditem['pesha_vat'] +
             +  $ditem['sarcharge'] + $ditem['bibidh'] + $ditem['trade_due'] + $ditem['vat_due'] + $ditem['signbord_vat_due'] + $ditem['source_vat_due'] + $ditem['sarcharge_due'] - $ditem['discount'];
        }

        foreach($data_not_paid as $key => $nitem){
            $data_not_paid[$key]['total'] = $nitem['fee'] + $nitem['vat'] + $nitem['signbord_vat'] + $nitem['source_vat'] + $nitem['pesha_vat'] +
             +  $nitem['sarcharge'] + $nitem['bibidh'] + $nitem['trade_due'] + $nitem['vat_due'] + $nitem['signbord_vat_due'] + $nitem['source_vat_due'] + $nitem['sarcharge_due'] - $nitem['discount'];
        }

        // $response = array_merge($data_paid, $data_not_paid);
        $response = $data_paid + $data_not_paid;

        ksort($response);

        // dd($response);
        // dd($data_paid[21008825019002012]);
        // dd($data_not_paid);

        //  $response = [
            //  'data_paid' => $response,
            //  'data_paid' => $data_paid,
            //  'data_not_paid' => $data_not_paid,
        //  ];
            // dd($response);
        return $response;
    }

    // dabi aday register end
}
