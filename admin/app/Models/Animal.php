<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;

class Animal extends Model
{
    use SoftDeletes;

    //====voter application store====//
    public function data_store($request)
    {
// dd($request);
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
                'nid' => $request->nid,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'religion' => $request->religion,
                'resident' => $request->resident,

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

            $application_insert = DB::table("application")->insert($application_data);

            $application_id = DB::getPdo()->lastInsertId();

            $animal_extra_info = [
                'union_id' => $request->union_id,
                'type' => $request->type,
                'pin' => $request->pin,
                'tracking' => $request->tracking,
                'application_id' => $application_id,
                'animal_type' => $request->animal_type,
                'animal_name_en' => $request->animal_name_en,
                'animal_name_bn' => $request->animal_name_bn,
                'animal_type_en' => $request->animal_type_en,
                'animal_type_bn' => $request->animal_type_bn,
                'animal_color_en' => $request->animal_color_en,
                'animal_color_bn' => $request->animal_color_bn,
                'jolatongko_date' => $request->jolatongko_date,
                'jolatongko_next_date' => $request->jolatongko_next_date,
                'animal_keeping_date' => $request->animal_keeping_date,
                'animal_age' => $request->animal_age,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip()
            ];

            $animal_extra_info_insert = DB::table("animal_info")->insert($animal_extra_info);
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

            $animal_extra_info = [
                'union_id' => $request->union_id,
                'type' => $request->type,
                'pin' => $request->pin,
                'tracking' => $request->tracking,
                'application_id' => $application_id,
                'animal_type' => $request->animal_type,
                'animal_name_en' => $request->animal_name_en,
                'animal_name_bn' => $request->animal_name_bn,
                'animal_type_en' => $request->animal_type_en,
                'animal_type_bn' => $request->animal_type_bn,
                'animal_color_en' => $request->animal_color_en,
                'animal_color_bn' => $request->animal_color_bn,
                'jolatongko_date' => $request->jolatongko_date,
                'jolatongko_next_date' => $request->jolatongko_next_date,
                'animal_keeping_date' => $request->animal_keeping_date,
                'animal_age' => $request->animal_age,
                'created_by' => $request->created_by,
                'created_time' => Carbon::now(),
                'created_by_ip' => $request->ip()
            ];

            $res = DB::table("citizen_information")->where('pin', $request->pin)->where('union_id', $request->union_id)->update($citizenData);
            $res = DB::table("animal_info")->insert($animal_extra_info);
        });
        return true;
    }

    // animal preview data
    public function animal_information($tracking = null, $union_id = null, $type = null)
    {
        DB::enableQueryLog();

        $data = DB::table('application AS APP')
            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'ANL.*')
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("APP.union_id", "=", $union_id);
            })
            ->join('animal_info AS ANL', function ($join) use ($union_id) {
                $join->on("ANL.pin", "=", "APP.pin")
                    ->on("ANL.tracking", "=", "APP.tracking")
                    ->on("ANL.union_id", "=", "APP.union_id")
                    ->on("ANL.application_id", "=", "APP.id")
                    ->where("ANL.union_id", "=", $union_id);
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

    // === animal edit data === //
    public function animal_data($tracking, $union_id = null)
    {
        DB::enableQueryLog();

        $data = DB::table('application AS APP')
            ->select('APP.*', 'APP.id as application_id', 'CTZ.*', 'CTZ.id as citizen_id', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'ANL.*')
            ->join('citizen_information AS CTZ', function ($join) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id");
            })
            ->join('animal_info AS ANL', function ($join) {
                $join->on("ANL.pin", "=", "APP.pin")
                    ->on("ANL.tracking", "=", "APP.tracking")
                    ->on("ANL.union_id", "=", "APP.union_id")
                    ->on("ANL.application_id", "=", "APP.id");
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

    //===voter sonod generate=====//
    public function sonod_generate($receive)
    {
        //certificate data create
        $sonod_data = [
            'sonod_no' => $receive->sonod_no,
            'pin' => $receive->pin,
            'tracking' => $receive->tracking,
            'expire_date' => $receive->expire_date,
            'type' => $receive->type,
            'status' => $receive->status,
            'fiscal_year_id' => $receive->fiscal_year_id,
            'union_id' => $receive->union_id,
            'district_id' => $receive->district_id,
            'upazila_id' => $receive->upazila_id,

            'created_by' => Auth::user()->employee_id,
            'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
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
            'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
            'created_by_ip' => Request::ip()
        ];

        // if have due
        if ($receive->due > 0) {

            //get due account id
            $due_account_id = Global_model::get_account_id($receive->union_id, 23);

            if ($due_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->due,
                    'credit' => $due_account_id,
                    'debit' => NULL,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip()
                ];
            }
        }

        // if have discount
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
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip()
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
                    'voucher' => $receive->voucher,
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

        //if have source
        if ($receive->source_tax > 0) {

            //get sarcharge account id
            $source_tax_account_id = Global_model::get_account_id($receive->union_id, 97); // 97 = source_vat //

            if ($source_tax_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {

                $transaction_data[] = [
                    'union_id' => $receive->union_id,
                    'fiscal_year_id' => $receive->fiscal_year_id,
                    'voucher' => $receive->voucher,
                    'sonod_no' => $receive->sonod_no,
                    'amount' => $receive->source_tax,
                    'debit' => NULL,
                    'credit' => $source_tax_account_id,
                    'type' => $receive->type,

                    'created_by' => Auth::user()->employee_id,
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip()
                ];
            }
        }


        //if have sarcharge
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
                    'created_time' => $receive->payment_date . ' ' . date('h:i:s'),
                    'created_by_ip' => Request::ip(),

                ];
            }
        }

        // echo "<pre>";
        // print_r($sonod_data);

        // echo "<br/>";
        // print_r($transaction_data);

        // exit;

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

            return ["status" => "success", "message" => "আপনার সনদটি সফলভাবে তৈরি হয়েছে। সনদটি প্রিন্ট করুন।", 'sonod_no' => $receive['sonod_no'], 'voucher_no' => $receive['voucher']];
        } catch (\Exception $e) {

            DB::rollback();

            return ["status" => "error", "message" => "দুঃখিত ! আপনার সনদ টি জেনারেট করতে সমস্যা হচ্ছে।", 'sonod_no' => ''];
        }
    }

    //====== Animal update ====//
    public function update_animal($receive)
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
            'resident' => $receive->resident,
            'religion' => $receive->religion,
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

            $citizen_update = DB::table("citizen_information")
                ->where('id', $receive->citizen_id)
                ->update($citizen_update_data);

            $application_update = DB::table("application")
                ->where('id', $receive->application_id)
                ->update($application_update_data);

            $animal_extra_info = [
                // 'union_id'         => $receive->union_id,
                // 'type'             => $receive->type,
                // 'pin'              => $receive->pin,
                // 'tracking'         => $receive->tracking,
                // 'application_id'   => $receive->application_id,
                'animal_type' => $receive->animal_type,
                'animal_name_en' => $receive->animal_name_en,
                'animal_name_bn' => $receive->animal_name_bn,
                'animal_type_en' => $receive->animal_type_en,
                'animal_type_bn' => $receive->animal_type_bn,
                'animal_color_en' => $receive->animal_color_en,
                'animal_color_bn' => $receive->animal_color_bn,
                'jolatongko_date' => $receive->jolatongko_date,
                'jolatongko_next_date' => $receive->jolatongko_next_date,
                'animal_keeping_date' => $receive->animal_keeping_date,
                'animal_age' => $receive->animal_age,

                'updated_by' => Auth::User()->employee_id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $receive->ip()
            ];

            $animal_extra_info_update = DB::table("animal_info")
                ->where('application_id', $receive->application_id)
                ->update($animal_extra_info);
        });

        return true;

    }

    // === animal info delete === //
    public function animal_info_delete($request)
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

        $delete_animal = DB::table('animal_info')
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

    // === animal applicant list data ===== //
    public function animal_applicant_list_data($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('application AS APP')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS APP.id as application_id'), 'APP.type', 'APP.pin', 'APP.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'APP.created_time', 'ANL.animal_name_bn', 'ANL.animal_type')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "APP.pin")
                     ->on("CTZ.union_id", "=", "APP.union_id")
                     ->where("APP.type", $receive['type'])
                     ->where("APP.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('animal_info AS ANL', function ($join) {
                $join->on("ANL.pin", "=", "APP.pin")
                    ->on("ANL.union_id", "=", "APP.union_id")
                    ->on("ANL.tracking", "=", "APP.tracking")
                    ->on("ANL.application_id", "=", "APP.id");
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

    //====animal certificate list data====//
    public function animal_certificate_list($receive, $search_content)
    {
        DB::enableQueryLog();

        $query = DB::table('certificate AS CRT')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS CRT.id as certificate_id'), DB::raw('CONCAT(CRT.sonod_no) as sonod_no'), 'CRT.type', 'CRT.id', 'CRT.pin', 'CRT.tracking', 'CTZ.id as citizen_id', 'CTZ.name_bn', 'CTZ.photo', 'CTZ.father_name_bn', 'CTZ.mobile', 'CTZ.union_id', 'CTZ.permanent_district_id', 'CTZ.permanent_upazila_id', 'CTZ.permanent_postoffice_id', 'TRNS.created_time as generate_date', 'ANL.*', 'TRNS.voucher')

            ->join('citizen_information AS CTZ', function ($join) use($receive) {
                $join->on("CTZ.pin", "=", "CRT.pin")
                    ->on("CTZ.union_id", "=", "CRT.union_id")
                    ->where("CRT.type", $receive['type'])
                    ->where("CRT.fiscal_year_id", $receive['fiscal_year_id']);
            })

            ->join('animal_info AS ANL', function ($join) use ($receive) {
                $join->on("ANL.pin", "=", "CRT.pin")
                    ->on("ANL.tracking", "=", "CRT.tracking")
                    ->on("ANL.union_id", "=", "CRT.union_id")
                    ->on("ANL.type", "=", "CRT.type")
                    ->where("CRT.type", "=", $receive['type']);
            })

            ->join('acc_transaction AS TRNS', function ($join) use ($receive) {
                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1);
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
            ->groupBy("TRNS.voucher");

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

    //====animal certificate data=====//
    public function animal_certificate_data($sonod_no = null, $voucher_no, $union_id = null, $type = null)
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
            ->join('animal_info AS ANL', function ($join) use ($type) {
                $join->on("ANL.pin", "=", "APP.pin")
                    ->on("ANL.tracking", "=", "APP.tracking")
                    ->on("ANL.union_id", "=", "APP.union_id")
                    ->on("ANL.application_id", "=", "APP.id")
                    ->on("ANL.type", "=", "APP.type")
                    ->where("ANL.type", "=", $type);
            })

            // for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            // for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')
            ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.expire_date', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'ANL.*', 'APP.type')
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
            ])
            ->first();

        // get license fee
        $fee_data = DB::table('certificate AS CRT')
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount', 'TRNS.voucher')
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $voucher_no, $union_id, $type) {
                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.voucher', $voucher_no)
                    ->where('TRNS.union_id', $union_id);
            })
            ->join('acc_account AS ACCRDT', function ($join) use ($union_id) {
                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })

            // for vat and trade transection
            ->whereIn('ACCRDT.acc_type', [$type, 22, 23, 24, 25, 97])
            ->groupBy("TRNS.id")
            ->get();


        //ready fee array
        $fee_list = [];

        foreach ($fee_data as $fee) {
            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount,
            ];
        }

        $data->fee_list = $fee_list;

        return $data;
    }

    //money receipt data
    public function money_receipt_data($sonod_no = null, $voucher_no, $union_id = null, $type = null)
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
            ->join('animal_info AS ANL', function ($join) use ($type) {

                $join->on("ANL.pin", "=", "APP.pin")
                    ->on("ANL.tracking", "=", "APP.tracking")
                    ->on("ANL.union_id", "=", "APP.union_id")
                    ->on("ANL.application_id", "=", "APP.id")
                    ->on("ANL.type", "=", "APP.type")
                    ->where("ANL.type", "=", $type);
            })

            // for present address
            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')
            ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.expire_date', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'ANL.*', 'APP.type')
            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', $type],
            ])
            ->first();

        // get license fee
        $fee_data = DB::table('certificate AS CRT')
            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount', 'TRNS.voucher')
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $voucher_no, $union_id, $type) {
                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
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

            // for vat and trade transection
            ->whereIn('ACCRDT.acc_type', [$type, 22, 23, 24, 25, 97])
            ->where("TRNS.voucher", $voucher_no)
            ->groupBy("TRNS.id")
            ->get();

        // dd($fee_data);


        //ready fee array
        $fee_list = [];

        $voucher_id = 0;

        foreach ($fee_data as $fee) {
            $voucher_id = $fee->voucher;

            $fee_list[$fee->account_type] = [
                'account_name' => $fee->account_name,
                'amount' => $fee->amount,
            ];
        }

        $data->voucher = $voucher_id;
        $data->fee_list = $fee_list;

        return $data;

    }

    //get voter register data
    public function animal_register_data($union_id = null, $type = null, $from_date = null, $to_date = null)
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
            ->select('CTZ.name_bn', 'CRT.sonod_no', 'TRNS.voucher', 'TRNS.debit', 'TRNS.credit', 'TRNS.amount', 'TRNS.created_time as payment_date', 'ACCDBT.account_name as debit_account_name', 'ACCDBT.acc_type as debit_account_type', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type')
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

                if ($item->credit_account_type == 91) {
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



                if ($item->credit_account_type == 97) {
                    $data[$item->sonod_no]['source_vat'] = $item->amount;
                }

                if ($item->credit_account_type == 22) {
                    $data[$item->sonod_no]['sarcharge'] = $item->amount;
                }
            } else {

                $data[$item->sonod_no] = [
                    'name' =>  $item->name_bn,
                    'payment_date' => $item->payment_date,
                    'fee' => ($item->credit_account_type == 91) ? $item->amount : 0,
                    'due' => ($item->credit_account_type == 23) ? $item->amount : 0,
                    'vat' => ($item->credit_account_type == 25) ? $item->amount : 0,
                    'discount' => ($item->credit_account_type == 24) ? $item->amount : 0,
                    'source_vat' => ($item->credit_account_type == 97) ? $item->amount : 0,
                    'sarcharge' => ($item->credit_account_type == 22) ? $item->amount : 0,

                ];
            }
        }


        return $data;

    }

}
