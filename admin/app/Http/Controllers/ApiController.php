<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Global_model;
use Exception;

class ApiController extends Controller
{
    public function getPdfData($tacking, $union_id, $type, $appType, $appDb)
    {

        // dd($tacking,$union_id,$type,$appType);

        // config(['database.connections.mysql.database' => $appDb ??'union_apps']);
        // return response()->json(config());

        // connecting to apps database
        DB::disconnect('mysql');
        Config::set('database.connections.mysql.database', $appDb);
        DB::reconnect();

        // try {
        //     $data =  DB::table('print_settings')->first();
        //     return response()->json($data);
        // } catch (Exception $e) {
        //     return response()->json($e->getMessage());
        // }




        switch ($type) {
            // nagoric

            case 1:
                // mittu

            case 2:
            case 3:
            case 4:
                nagorik :
                if($appType == 1)
                {
                    $data['pdf_data'] = $this->nagorik_certificate_verify_data($tacking, $union_id, $type);
                }
                else if($appType == 2)
                {
                    $data['pdf_data'] = $this->nagorik_application_verify_data($tacking, $union_id, $type);
                }
            break;

            // ekoi nam
            case 5:
                if($appType == 1)
                {
                    $data['pdf_data'] = $this->ekoinam_certificate_verify_data($tacking, $union_id, $type);
                }
                else if($appType == 2)
                {
                    $data['pdf_data'] = $this->ekoinam_application_verify_data($tacking, $union_id, $type);
                }
            break;

            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
                goto nagorik;
            break;
            case 11:
                if($appType == 1)
                {
                    $data['pdf_data'] = $this->yearlyincome_certificate_verify_data($tacking, $union_id, $type);
                }
                else if($appType == 2)
                {
                    $data['pdf_data'] = $this->yearlyincome_application_verify_data($tacking, $union_id, $type);
                }
            break;

            case 12:
                goto nagorik;
            break;

            case 13:
                if($appType == 1)
                {
                    $data['pdf_data'] = $this->onumoti_certificate_verify_data($tacking, $union_id, $type);
                }
                else if($appType == 2)
                {
                    $data['pdf_data'] = $this->onumoti_application_verify_data($tacking, $union_id, $type);
                }
            break;

            case 14:
                if($appType == 1)
                {
                    $data['pdf_data'] = $this->voter_certificate_verify_data($tacking, $union_id, $type);
                }
                else if($appType == 2)
                {
                    $data['pdf_data'] = $this->voter_application_verify_data($tacking, $union_id, $type);
                }
            break;
            case 15:
                if ($appType == 1) {
                    $data['pdf_data'] = $this->onapotti_certificate_verify_data($tacking, $union_id, $type);
                } else if ($appType == 2) {

                    $data['pdf_data'] = $this->onapotti_application_verify_data($tacking, $union_id, $type);
                    // dd($data);
                }
                break;
            case 17:
            case 18:
                if($appType == 1)
                {
                    $data['pdf_data'] = $this->warish_certificate_verify_data($tacking, $union_id, $type);
                }
                else if($appType == 2)
                {
                    $data['pdf_data'] = $this->warish_application_verify_data($tacking, $union_id, $type);
                }
            break;
            case 19:
                // trade apptype 1 for sonod is separate
                if($appType == 2)
                {
                    $data['pdf_data'] = $this->trade_application_verify_data($tacking, $union_id, $type);
                }

                // echo "<pre>";
                // print_r($data);
                // exit;

            break;
            case 20:
                goto nagorik;

            case 90 :
                $data['pdf_data'] = $this->premises_application_verify_data($tacking, $union_id, $type);
            break;

            case 91:
                $data['pdf_data'] = $this->animal_application_verify_data($tacking, $union_id, $type);
            break;

            case 92:
                $data['pdf_data'] = $this->newholding_application_verify_data($tacking, $union_id, $type);
            break;

            case 94:
                if($appType == 1){

                    $data['pdf_data'] = $this->road_certifiacte_verify_data($tacking, $union_id, $type);

                }elseif($appType == 2){

                $data['pdf_data'] = $this->road_application_verify_data($tacking, $union_id, $type);

                }
            break;

            case 96:
                if($appType == 2)
                {
                    $data['pdf_data'] = $this->land_application_verify_data($tacking, $union_id, $type);

                }elseif($appType == 1){

                    $data['pdf_data'] = $this->land_certifiacte_verify_data($tacking, $union_id, $type);

                }
            break;


        }

        $print_setting = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => $appType])->get(['pad_print','chairman','sochib','member','obibabok']);

        if(count($print_setting))
        {
            $data['print_setting'] = $print_setting[0];
            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;
        }
        else
        {
            $data['print_setting'] = ['pad_print'=> 0,'chairman'=> 0,'sochib'=> 0,'member'=> 0,'obibabok' => 0];
            $data['colspan'] = 0;
        }



        return response()->json($data);
    }

    // -----> trade app type 1 certificate data
    public function getTradeCertificateData($sonod_no,$union_id,$fiscal_year,$appDb)
    {
        // return [$sonod_no,$union_id,$fiscal_year,$appDb];

        // connecting to apps database
        DB::disconnect('mysql');
        Config::set('database.connections.mysql.database', $appDb);
        DB::reconnect();

        $appType = 1; //sonod apptype 1

        $fiscal_year = Global_model::current_fiscal_year();

        // dd($fiscal_year);

        $data['pdf_data'] = $this->trade_certificate_verify_data($sonod_no, $union_id, $fiscal_year);

        $print_setting = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => 19, 'application_type' => $appType])->get(['pad_print','chairman','sochib','member','obibabok']);

        if(count($print_setting))
        {
            $data['print_setting'] = $print_setting[0];
            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;
        }
        else
        {
            $data['print_setting'] = ['pad_print'=> 0,'chairman'=> 0,'sochib'=> 0,'member'=> 0,'obibabok' => 0];
            $data['colspan'] = 0;
        }

        return response()->json($data);
    }


    public function getPremisesCertificateData($sonod_no,$union_id,$fiscal_year,$appDb)
    {


        // connecting to apps database
        DB::disconnect('mysql');
        Config::set('database.connections.mysql.database', $appDb);
        DB::reconnect();

        $appType = 1; //sonod apptype 1

        $fiscal_year = Global_model::current_fiscal_year();

        $data['pdf_data'] = $this->premises_certificate_verify_data($sonod_no, $union_id, $fiscal_year);


        $print_setting = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => 90, 'application_type' => $appType])->get(['pad_print','chairman','sochib','member','obibabok']);

        if(count($print_setting))
        {
            $data['print_setting'] = $print_setting[0];
            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;
        }
        else
        {
            $data['print_setting'] = ['pad_print'=> 0,'chairman'=> 0,'sochib'=> 0,'member'=> 0,'obibabok' => 0];
            $data['colspan'] = 0;
        }


        return response()->json($data);
    }



    //for tradelicense application verify
    public function trade_application_verify_data($tracking = null, $union_id = null, $type = null)
    {

        $prev_data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'COMP1.bn_name as trade_district_name', 'COMP2.bn_name as trade_upazila_name', 'COMP3.bn_name as trade_postoffice_name', 'BSYTP.name_bn as business_type_bn')

            ->join('owner_info AS OWNLST', function ($join) use ($tracking, $union_id) {

                $join->on("OWNLST.tracking", "=", "APP.tracking")

                    ->on("OWNLST.union_id", "=", "APP.union_id")
                    ->where("OWNLST.tracking", "=", $tracking)
                    ->where("OWNLST.union_id", "=", $union_id);
            })

            ->join('trade_optional_info AS TRDOPT', function ($join) use ($tracking, $union_id) {

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

            ->join('business_type AS BSYTP', function ($join) use($union_id) {

                $join->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id);
                    // ->where("BSYTP.is_active", "=", 1);
            })

            //for permanent address
            ->leftJoin('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->leftJoin('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->leftJoin('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

            //for present address
            ->leftJoin('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
            ->leftJoin('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
            ->leftJoin('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->leftJoin('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.trade_district_id')
            ->leftJoin('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.trade_upazila_id')
            ->leftJoin('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.trade_postoffice_id')

            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
            ])
            ->get();


        //ready trade preview data

        $data = [];

        foreach ($prev_data as $item) {

            if (isset($data['organization'])) {

                $data['organization']["owner_list"][] = [

                    "photo"                     => $item->photo,
                    "pin"                     => $item->pin,
                    "name_bn"                 => $item->name_bn,
                    "father_name_bn"          => $item->father_name_bn,
                    "mother_name_bn"          => $item->mother_name_bn,
                    "husband_name_bn"         => $item->husband_name_bn,
                    "wife_name_bn"            => $item->wife_name_bn,
                    "gender"                  => $item->gender,
                    "mobile"                  => $item->citizen_mobile,
                    "nid"                     => $item->nid,
                    "birth_id"                => $item->birth_id,
                    "marital_status"          => $item->marital_status,
                    "resident"                => $item->resident,
                    "religion"                => $item->religion,
                    "permanent_village_bn"    => $item->permanent_village_bn,
                    "permanent_rbs_bn"        => $item->permanent_rbs_bn,
                    "permanent_ward_no"       => $item->permanent_ward_no,
                    "permanent_holding_no"    => $item->permanent_holding_no,
                    "permanent_postoffice_name" => $item->permanent_postoffice_name,
                    "permanent_upazila_name"    => $item->permanent_upazila_name,
                    "permanent_district_name"   => $item->permanent_district_name,
                ];

            } else {

                $owner_list[] = [

                    "photo"                     => $item->photo,
                    "pin"                     => $item->pin,
                    "name_bn"                 => $item->name_bn,
                    "father_name_bn"          => $item->father_name_bn,
                    "mother_name_bn"          => $item->mother_name_bn,
                    "husband_name_bn"         => $item->husband_name_bn,
                    "wife_name_bn"            => $item->wife_name_bn,
                    "gender"                  => $item->gender,
                    "mobile"                  => $item->citizen_mobile,
                    "nid"                     => $item->nid,
                    "birth_id"                => $item->birth_id,
                    "marital_status"          => $item->marital_status,
                    "resident"                => $item->resident,
                    "religion"                => $item->religion,
                    "permanent_village_bn"    => $item->permanent_village_bn,
                    "permanent_rbs_bn"        => $item->permanent_rbs_bn,
                    "permanent_ward_no"       => $item->permanent_ward_no,
                    "permanent_holding_no"    => $item->permanent_holding_no,
                    "permanent_postoffice_name" => $item->permanent_postoffice_name,
                    "permanent_upazila_name"    => $item->permanent_upazila_name,
                    "permanent_district_name"   => $item->permanent_district_name,

                ];

                $data["organization"] = [

                    "union_id"             => $item->union_id,
                    "tracking"             => $item->tracking,
                    "organization_name_bn" => $item->organization_name_bn,
                    "owner_type"           => $item->owner_type,
                    "business_type"        => $item->business_type_bn,
                    "mobile"               => $item->mobile,
                    "email"                => $item->email,
                    "phone"                => $item->phone,
                    "vat_id"               => $item->vat_id,
                    "tax_id"               => $item->tax_id,
                    "capital"              => $item->capital,
                    "trade_ward_no"        => $item->trade_ward_no,
                    "trade_holding_no"     => $item->trade_holding_no,
                    "trade_village_bn"     => $item->trade_village_bn,
                    "trade_rbs_bn"         => $item->trade_rbs_bn,
                    "trade_postoffice_name"  => $item->trade_postoffice_name,
                    "trade_upazila_name"     => $item->trade_upazila_name,
                    "trade_district_name"    => $item->trade_district_name,
                    "created_time"    => $item->created_time,

                    "owner_list"           => $owner_list,
                ];

            }

        }


        return $data;

    }
    // ---> trade
	//this is for tradelicense verify
	public function trade_certificate_verify_data($sonod_no = null, $union_id = null, $fiscal_year = null){

		$certificate_data = DB::table('certificate AS CRT')

            ->select('CRT.*', 'CRT.sonod_no', 'CRT.created_time as generate_date' , 'APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'BDL1.bn_name as permanent_district_name_bn', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL4.bn_name as present_district_name_bn', 'BDL5.bn_name as present_upazila_name_bn', 'BDL6.bn_name as present_postoffice_name_bn', 'COMP1.bn_name as trade_district_name_bn', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP3.bn_name as trade_postoffice_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.en_name as present_district_name_en', 'BDL5.en_name as present_upazila_name_en', 'BDL6.en_name as present_postoffice_name_en', 'COMP1.en_name as trade_district_name_en', 'COMP2.en_name as trade_upazila_name_en', 'COMP3.en_name as trade_postoffice_name_en', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'FSY.name as fiscal_year_name', 'BSYTP.name_bn as business_type_bn','BSYTP.name_en as business_type_en')

            ->join('application AS APP', function ($join) use($union_id) {

                $join->on("APP.tracking", "=", "CRT.tracking")
                     ->on("APP.union_id", "=", "CRT.union_id")
                     ->where("APP.union_id", "=", $union_id)
                     ->where("CRT.union_id", "=", $union_id)
                     ->where("APP.is_active", "=", 1);
            })

            ->join('trade_optional_info AS TRDOPT', function ($join) use($union_id) {

                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                     ->on("TRDOPT.union_id", "=", "CRT.union_id")
                     ->where("TRDOPT.union_id", "=", $union_id)
                     ->where("TRDOPT.is_active", "=", 1);
            })


            ->join('owner_info AS OWNLST', function ($join) use($union_id) {

                $join->on("OWNLST.tracking", "=", "CRT.tracking")
                     ->on("OWNLST.union_id", "=", "CRT.union_id")
                     ->where("OWNLST.union_id", "=", $union_id)
                     ->where("OWNLST.is_active", "=", 1);
            })


            ->join('citizen_information AS CTZ', function ($join) use($union_id) {

                $join->on("CTZ.pin", "=", "OWNLST.pin")
                     ->on("CTZ.union_id", "=", "OWNLST.union_id")
                     ->where("CTZ.union_id", "=", $union_id)
                     ->where("CTZ.is_active", "=", 1);
            })

            ->join('business_type AS BSYTP', function ($join) use($union_id) {

                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id);
                    // ->where("BSYTP.is_active", "=", 1);
            })

            ->join('fiscal_years AS FSY', function ($join) use($fiscal_year) {

                $join->on("FSY.id", "=", 'CRT.fiscal_year_id')
                     ->where("FSY.id", "=", $fiscal_year)
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
                ['CRT.type', '=', 19],
                ['APP.type', '=', 19],
            ])
            ->get();

            // dd($certificate_data);

        //ready trade certificate  data

        $data = [];

        foreach ($certificate_data as $item) {

            if (isset($data['organization'])) {

                //if set organization then set only owner data

                $data['organization']["owner_list"][] = [

                    "photo"                     => $item->photo,
                    "pin"                     => $item->pin,
                    "name_bn"                 => $item->name_bn,
                    "name_en"                 => $item->name_en,
                    "father_name_bn"          => $item->father_name_bn,
                    "father_name_en"          => $item->father_name_en,
                    "mother_name_bn"          => $item->mother_name_bn,
                    "mother_name_en"          => $item->mother_name_en,
                    "husband_name_bn"         => $item->husband_name_bn,
                    "husband_name_en"         => $item->husband_name_en,
                    "wife_name_bn"            => $item->wife_name_bn,
                    "wife_name_en"            => $item->wife_name_en,
                    "gender"                  => $item->gender,
                    "mobile"                  => $item->citizen_mobile,
                    "nid"                     => $item->nid,
                    "birth_id"                => $item->birth_id,
                    "marital_status"          => $item->marital_status,
                    "resident"                => $item->resident,
                    "religion"                => $item->religion,
                    "permanent_village_bn"    => $item->permanent_village_bn,
                    "permanent_village_en"    => $item->permanent_village_en,
                    "permanent_rbs_bn"        => $item->permanent_rbs_bn,
                    "permanent_rbs_en"        => $item->permanent_rbs_en,
                    "permanent_ward_no"       => $item->permanent_ward_no,
                    "permanent_holding_no"    => $item->permanent_holding_no,

                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_upazila_name_bn"    => $item->permanent_upazila_name_bn,
                    "permanent_district_name_bn"   => $item->permanent_district_name_bn,

                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_upazila_name_en"    => $item->permanent_upazila_name_en,
                    "permanent_district_name_en"   => $item->permanent_district_name_en,
                ];

            } else {

                //first owner set in array

                $owner_list[] = [
                    "photo"                   => $item->photo,
                    "pin"                     => $item->pin,
                    "name_bn"                 => $item->name_bn,
                    "name_en"                 => $item->name_en,
                    "father_name_bn"          => $item->father_name_bn,
                    "father_name_en"          => $item->father_name_en,
                    "mother_name_bn"          => $item->mother_name_bn,
                    "mother_name_en"          => $item->mother_name_en,
                    "husband_name_bn"         => $item->husband_name_bn,
                    "husband_name_en"         => $item->husband_name_en,
                    "wife_name_bn"            => $item->wife_name_bn,
                    "wife_name_en"            => $item->wife_name_en,
                    "gender"                  => $item->gender,
                    "mobile"                  => $item->citizen_mobile,
                    "nid"                     => $item->nid,
                    "birth_id"                => $item->birth_id,
                    "marital_status"          => $item->marital_status,
                    "resident"                => $item->resident,
                    "religion"                => $item->religion,
                    "permanent_village_bn"    => $item->permanent_village_bn,
                    "permanent_village_en"    => $item->permanent_village_en,
                    "permanent_rbs_bn"        => $item->permanent_rbs_bn,
                    "permanent_rbs_en"        => $item->permanent_rbs_en,
                    "permanent_ward_no"       => $item->permanent_ward_no,
                    "permanent_holding_no"    => $item->permanent_holding_no,

                    "permanent_postoffice_name_bn" => $item->permanent_postoffice_name_bn,
                    "permanent_upazila_name_bn"    => $item->permanent_upazila_name_bn,
                    "permanent_district_name_bn"   => $item->permanent_district_name_bn,

                    "permanent_postoffice_name_en" => $item->permanent_postoffice_name_en,
                    "permanent_upazila_name_en"    => $item->permanent_upazila_name_en,
                    "permanent_district_name_en"   => $item->permanent_district_name_en,

                ];

                //organizatin data set
                $data["organization"] = [
                    "union_id"             => $item->union_id,
                    "tracking"             => $item->tracking,
                    "sonod_no"             => $item->sonod_no,
                    "organization_name_bn" => $item->organization_name_bn,
                    "organization_name_en" => $item->organization_name_bn,
                    "fiscal_year_name"           => $item->fiscal_year_name,
                    "owner_type"           => $item->owner_type,
                    "business_type_bn"        => $item->business_type_bn,
                    "business_type_en"        => $item->business_type_en,
                    "mobile"               => $item->mobile,
                    "email"                => $item->email,
                    "phone"                => $item->phone,
                    "vat_id"               => $item->vat_id,
                    "tax_id"               => $item->tax_id,
                    "capital"              => $item->capital,
                    "trade_ward_no"        => $item->trade_ward_no,
                    "trade_holding_no"     => $item->trade_holding_no,
                    "trade_village_bn"     => $item->trade_village_bn,
                    "trade_village_en"     => $item->trade_village_en,
                    "trade_rbs_bn"         => $item->trade_rbs_bn,
                    "trade_rbs_en"         => $item->trade_rbs_en,

                    "trade_postoffice_name_bn"  => $item->trade_postoffice_name_bn,
                    "trade_upazila_name_bn"     => $item->trade_upazila_name_bn,
                    "trade_district_name_bn"    => $item->trade_district_name_bn,

                    "trade_postoffice_name_en"  => $item->trade_postoffice_name_en,
                    "trade_upazila_name_en"     => $item->trade_upazila_name_en,
                    "trade_district_name_en"    => $item->trade_district_name_en,

                    "generate_date"    => $item->generate_date,
                    "expire_date"    => $item->expire_date,

                    "owner_list"           => $owner_list,
                ];

            }

        }

        //get license fee
        $data['fee_data'] = DB::table('certificate AS CRT')

            ->select('ACCRDT.account_name', 'ACCRDT.acc_type as account_type', 'TRNS.amount')

            ->join('acc_transaction AS TRNS', function ($join) use($sonod_no, $union_id){

                $join->on('TRNS.sonod_no', '=', 'CRT.sonod_no')
                    ->on('TRNS.union_id', '=', 'CRT.union_id')
                    ->where('TRNS.is_active', 1)
                    ->where('TRNS.sonod_no', $sonod_no)
                    ->where('TRNS.union_id', $union_id);
            })

            ->join('acc_account AS ACCRDT', function ($join) use($union_id){

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })

            //for pehsa kor and trade transection
            ->where(function ($query) {
                 $query->where('TRNS.type', '=' , 28)
                        ->orWhere('TRNS.type', '=', 19);
             })

            ->get();

        return $data;

	}


    //warish application verify data

    public function warish_application_verify_data($tracking = null, $union_id = null, $type = null)
    {
        //get warish data
        $data['warish_data'] = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'COI.death_date', 'APPINFO.name_bn as applicant_name_bn', 'APPINFO.name_en as applicant_name_en', 'APPINFO.father_name_bn as applicant_father_name_bn', 'APPINFO.father_name_en as applicant_father_name_en', 'APPINFO.mobile as applicant_mobile', 'APPINFO.email as applicant_email', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name')

            ->join('citizen_information AS CTZ', function ($join) {

                $join->on("CTZ.pin", "=", "APP.pin")

                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.is_active", "=", 1);
            })
            ->leftJoin('citizen_optional_info AS COI', function ($join) {

                $join->on("COI.pin", "=", "APP.pin")

                    ->on("COI.union_id", "=", "APP.union_id")
                    ->where("COI.is_active", "=", 1);
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

        //get warish list
        $warish_list = DB::table('application AS APP')

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

        $data['warish_list'] = $warish_list;


        return $data;
    }

    //warish certificate verification data
    public function warish_certificate_verify_data($sonod_no = null, $union_id = null, $type = null)
    {


        $data['warish_data'] = DB::table('certificate AS CRT')

            ->join('application AS APP', function ($join) use ($type, $union_id) {

                $join->on('APP.pin', '=', 'CRT.pin')
                    ->on('APP.tracking', '=', 'CRT.tracking')
                    ->on('APP.type', '=', 'CRT.type')
                    ->on('APP.union_id', '=', 'CRT.union_id')
                    ->where('APP.is_active', '=', 1)
                    ->where('APP.union_id', '=', $union_id)
                    ->where('APP.type', '=', $type);
            })

            ->join('citizen_information AS CTZ', function ($join) use($union_id){

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

            ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'APPINFO.is_father_alive', 'APPINFO.is_mother_alive', 'APPINFO.name_bn as applicant_name_bn', 'APPINFO.name_en as applicant_name_en', 'APPINFO.father_name_bn as applicant_father_name_bn', 'APPINFO.father_name_en as applicant_father_name_en', 'APPINFO.mobile as applicant_mobile', 'APPINFO.email as applicant_email', 'APPINFO.investigator_name_bn', 'APPINFO.investigator_name_en', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'APP.type')


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

            //for union address
            ->join('bd_locations AS UADD1', 'UADD1.id', '=', 'UI.district_id')
            ->join('bd_locations AS UADD2', 'UADD2.id', '=', 'UI.upazila_id')
            ->join('bd_locations AS UADD3', 'UADD3.id', '=', 'UI.postal_id')

            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.type', '=', $type],
                ['CRT.union_id', '=', $union_id],
            ])
            ->first();

        //get warish list
        $warish_list = DB::table('certificate AS CRT')

            ->select('MLST.name_bn', 'MLST.name_en', 'MLST.relation_bn', 'MLST.relation_en', 'MLST.age','MLST.nid')

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
                    ->where("MLST.is_active", "=", 1);

            })


            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.is_active', '=', '1'],
                ['CRT.type', '=', $type],
                ['CRT.union_id', '=', $union_id],
            ])

            ->get();



        $data['warish_list'] = $warish_list;

        return $data;

    }


    //for nagorik application verify data

    public function nagorik_application_verify_data($tracking = null, $union_id = null, $type = null)
    {

        DB::enableQueryLog();

        $data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name')

            ->join('citizen_information AS CTZ', function ($join) use($union_id) {

                $join->on("CTZ.pin", "=", "APP.pin")

                ->on("CTZ.union_id", "=", "APP.union_id")
                ->where("CTZ.union_id", "=", $union_id)
                ->where("APP.union_id", "=", $union_id);
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
            ])
            ->first();


        return $data;

    }

    //for nagorik certificate verify data
    public function nagorik_certificate_verify_data($sonod_no = null, $union_id = null, $type = null)
    {
        DB::enableQueryLog();
         $data = DB::table('certificate AS CRT')

                ->join('application AS APP', function($join) use($union_id){

                    $join->on('APP.pin', '=', 'CRT.pin')
                         ->on('APP.tracking', '=', 'CRT.tracking')
                         ->on('APP.type', '=', 'CRT.type')
                         ->on('APP.union_id', '=', 'CRT.union_id')
                         ->where('APP.union_id', '=', $union_id)
                         ->where('APP.is_active', '=', 1);
                })

                ->join('citizen_information AS CTZ', function($join) use($union_id){

                    $join->on('CTZ.pin', '=', 'CRT.pin')
                         ->on('CTZ.pin', '=', 'APP.pin')
                         ->on('CTZ.union_id', '=', 'APP.union_id')
                         ->where('CTZ.union_id', '=', $union_id)
                         ->where('CTZ.is_active', '=', 1);
                })

                //for permanent address
                ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
                ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
                ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

                //for present address
                ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
                ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
                ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

                ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id','APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'APP.type')


                ->where([
                    ['CRT.sonod_no', '=', $sonod_no],
                    ['CRT.is_active', '=', '1'],
                    ['CRT.union_id', '=', $union_id],
                    ['CRT.type', '=', $type],
                    ['APP.type', '=', $type],
                    ['APP.union_id', '=', $union_id],
                ])
                ->first();

          return $data;

    }

    //for ekoinam application verify data
    public function ekoinam_application_verify_data($tracking = null, $union_id = null, $type = null){




        $data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*','BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'OPTINF.name_one as nickname_en', 'OPTINF.name_two as nickname_bn')

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
            ])
            ->first();


        return $data;
    }

    //ekoinam certificate verificatin data

    public function ekoinam_certificate_verify_data($sonod_no = null, $union_id = null, $type = null)
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

                ->join('citizen_information AS CTZ', function($join){

                    $join->on('CTZ.pin', '=', 'CRT.pin')
                         ->on('CTZ.pin', '=', 'APP.pin')
                         ->where('CTZ.is_active', '=', 1);
                })

                ->join('citizen_optional_info AS OPTINF', function ($join) use($union_id) {

                    $join->on("OPTINF.pin", "=", "APP.pin")

                    ->on("OPTINF.tracking", "=", "APP.tracking")
                    ->on("OPTINF.union_id", "=", "APP.union_id")
                    ->on("OPTINF.application_id", "=", "APP.id")
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

                ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id','APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'OPTINF.name_one as nickname_en', 'OPTINF.name_two as nickname_bn', 'APP.type')


                ->where([
                    ['CRT.sonod_no', '=', $sonod_no],
                    ['CRT.is_active', '=', '1'],
                    ['CRT.type', '=', $type],
                    ['CRT.union_id', '=', $union_id],
                    ['APP.union_id', '=', $union_id],
                    ['APP.type', '=', $type],
                ])
                ->first();



          return $data;


    }



    //yearlyincome application verify data
    public function yearlyincome_application_verify_data($tracking = null, $union_id = null, $type = null)
    {

        DB::enableQueryLog();

        $data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'OPTINF.name_one as earn_type', 'OPTINF.name_two as amount')

            ->join('citizen_information AS CTZ', function ($join) use($union_id) {

                $join->on("CTZ.pin", "=", "APP.pin")

                ->on("CTZ.union_id", "=", "APP.union_id")
                ->where("CTZ.union_id", "=", $union_id)
                ->where("APP.union_id", "=", $union_id);
            })

            ->join('citizen_optional_info AS OPTINF', function ($join) use($union_id) {

                $join->on("OPTINF.pin", "=", "APP.pin")

                ->on("OPTINF.tracking", "=", "APP.tracking")
                ->on("OPTINF.union_id", "=", "APP.union_id")
                ->on("OPTINF.application_id", "=", "APP.id")
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

            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
            ])
            ->first();


        return $data;

    }


    //yearly income certificate verify data

    public function yearlyincome_certificate_verify_data($sonod_no = null, $union_id = null, $type = null)
    {

        $data = DB::table('certificate AS CRT')

                ->join('application AS APP', function($join) use($union_id, $type){

                    $join->on('APP.pin', '=', 'CRT.pin')
                         ->on('APP.tracking', '=', 'CRT.tracking')
                         ->on('APP.union_id', '=', 'CRT.union_id')
                         ->on('APP.type', '=', 'CRT.type')
                         ->where('APP.type', '=', $type)
                         ->where('APP.union_id', '=', $union_id)
                         ->where('APP.is_active', '=', 1);
                })

                ->join('citizen_information AS CTZ', function($join){

                    $join->on('CTZ.pin', '=', 'CRT.pin')
                         ->on('CTZ.pin', '=', 'APP.pin')
                         ->where('CTZ.is_active', '=', 1);
                })

                ->join('citizen_optional_info AS OPTINF', function ($join) use($union_id, $type) {

                    $join->on("OPTINF.pin", "=", "APP.pin")

                    ->on("OPTINF.tracking", "=", "APP.tracking")
                    ->on("OPTINF.union_id", "=", "APP.union_id")
                    ->on("OPTINF.application_id", "=", "APP.id")
                    ->on("OPTINF.type", "=", "APP.type")
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

                ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id','APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'OPTINF.name_one as earn_type', 'OPTINF.name_two as amount', 'APP.type')


                ->where([
                    ['CRT.sonod_no', '=', $sonod_no],
                    ['CRT.is_active', '=', '1'],
                    ['CRT.union_id', '=', $union_id],
                    ['CRT.type', '=', $type],
                ])
                ->first();



          return $data;


    }


    //onumoti application verify data
    public function onumoti_application_verify_data($tracking = null, $union_id = null, $type = null)
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
            ])
            ->first();


        return $data;

    }

    //onumoti certificate verify data

    public function onumoti_certificate_verify_data($sonod_no = null, $union_id = null, $type = null)
    {

        $data = DB::table('certificate AS CRT')

                ->join('application AS APP', function($join) use($union_id, $type){

                    $join->on('APP.pin', '=', 'CRT.pin')
                         ->on('APP.tracking', '=', 'CRT.tracking')
                         ->on('APP.union_id', '=', 'CRT.union_id')
                         ->on('APP.type', '=', 'CRT.type')
                         ->where('APP.type', '=', $type)
                         ->where('APP.union_id', '=', $union_id)
                         ->where('APP.is_active', '=', 1);
                })

                ->join('citizen_information AS CTZ', function($join){

                    $join->on('CTZ.pin', '=', 'CRT.pin')
                         ->on('CTZ.pin', '=', 'APP.pin')
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
                ])
                ->first();



          return $data;


    }

    //onapotti application verify data
    public function onapotti_application_verify_data($tracking = null, $union_id = null, $type = null)
    {

        DB::enableQueryLog();
        // dd($tracking , $union_id , $type );

        $data = DB::table('application AS APP')

            ->select('APP.*', 'ONA.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name')

            ->join('onapotti AS ONA', function ($join) use($union_id) {

                $join
                ->on("ONA.pin", "=", "APP.pin")
                ->on("ONA.tracking", "=", "APP.tracking")
                ->on("ONA.union_id", "=", "APP.union_id")
                // ->where("ONA.union_id", "=", $union_id)
                ;
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
            ])
            ->first();

            // dd($data);
        return $data;

    }

    public function onapotti_certificate_verify_data($sonod_no = null, $union_id = null, $type = 15)
    {

        DB::enableQueryLog();
        // dd($sonod_no , $union_id , $type );

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



            // dd($data);
        return $data;



    }


    //voter application verify data
    public function voter_application_verify_data($tracking = null, $union_id = null, $type = null)
    {

        DB::enableQueryLog();

        $data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'OPTINF.name_one as union_name_en', 'OPTINF.name_two as union_name_bn')

            ->join('citizen_information AS CTZ', function ($join) use($union_id) {

                $join->on("CTZ.pin", "=", "APP.pin")

                ->on("CTZ.union_id", "=", "APP.union_id")
                ->where("CTZ.union_id", "=", $union_id)
                ->where("APP.union_id", "=", $union_id);
            })

            ->join('citizen_optional_info AS OPTINF', function ($join) use($union_id) {

                $join->on("OPTINF.pin", "=", "APP.pin")

                ->on("OPTINF.tracking", "=", "APP.tracking")
                ->on("OPTINF.union_id", "=", "APP.union_id")
                ->on("OPTINF.application_id", "=", "APP.id")
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



            ->where([
                ['APP.tracking', '=', $tracking],
                ['APP.union_id', '=', $union_id],
                ['APP.type', '=', $type],
            ])
            ->first();


        return $data;

    }

    //voter certificate verify data
    public function voter_certificate_verify_data($sonod_no = null, $union_id = null, $type = null)
    {

        $data = DB::table('certificate AS CRT')

                ->join('application AS APP', function($join) use($union_id, $type){

                    $join->on('APP.pin', '=', 'CRT.pin')
                         ->on('APP.tracking', '=', 'CRT.tracking')
                         ->on('APP.union_id', '=', 'CRT.union_id')
                         ->on('APP.type', '=', 'CRT.type')
                         ->where('APP.union_id', '=', $union_id)
                         ->where('APP.type', '=', $type)
                         ->where('APP.is_active', '=', 1);
                })

                ->join('citizen_information AS CTZ', function($join){

                    $join->on('CTZ.pin', '=', 'CRT.pin')
                         ->on('CTZ.pin', '=', 'APP.pin')
                         ->where('CTZ.is_active', '=', 1);
                })

                ->join('citizen_optional_info AS OPTINF', function ($join) use($type) {

                    $join->on("OPTINF.pin", "=", "APP.pin")

                    ->on("OPTINF.tracking", "=", "APP.tracking")
                    ->on("OPTINF.union_id", "=", "APP.union_id")
                    ->on("OPTINF.application_id", "=", "APP.id")
                    ->on("OPTINF.type", "=", "APP.type")
                    ->where("OPTINF.type", "=", $type);
                })

                //for permanent address
                ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
                ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
                ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

                //for present address
                ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'APP.present_district_id')
                ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'APP.present_upazila_id')
                ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'APP.present_postoffice_id')

                ->select('CTZ.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id','APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'OPTINF.name_one as union_name_en', 'OPTINF.name_two as union_name_bn', 'APP.type')


                ->where([
                    ['CRT.sonod_no', '=', $sonod_no],
                    ['CRT.is_active', '=', '1'],
                    ['CRT.union_id', '=', $union_id],
                    ['CRT.type', '=', $type],
                ])
                ->first();

        // dd($data);

          return $data;


    }

    public function trade_renew(Request $request){

        //get current fiscal year
        $current_fiscal_year = Global_model::current_fiscal_year($request->union_id);

        //get certificate data
        $query = DB::table('certificate')
                ->where(['sonod_no' => $request->sonod_no, 'union_id' => $request->union_id])
                ->orderBy('id', 'DESC')
                ->first();

        //if data not found
        if(empty($query)){

            return (['status' => 'error', 'message' => 'দুঃখিত ! এই সনদটি পাওয়া যায়নি। পরিষদে যোগাযোগ করুন।']);

        }

        //current fiscal year sonod existing check
        if($current_fiscal_year == $query->fiscal_year_id){

            return (['status' => 'error', 'message' => 'দুঃখিত ! এই সনদটি বর্তমান অর্থবছরে চলমান।']);
        }

        //if status already 3
        if($query->status == 3){

            return (['status' => 'error', 'message' => 'সনদটি ইতিপূর্বে নবায়নের জন্য আবেদন করা হয়েছে। পরিষদে যোগাযোগ করুন']);
        }

        $where = [
            'id' => $query->id,
            'union_id' => $request->union_id,
            'sonod_no' => $request->sonod_no
        ];

        $update = DB::table('certificate')->where($where)->update(['status' => 3]);

        if($update){

            return (['status' => 'success', 'message' => 'নবায়ন আবেদনটি গৃহীত হয়েছে। পরিষদে যোগাযোগ করুন']);
        }else{
            return (['status' => 'success', 'message' => 'দুঃখিত ! নবায়ন আবেদনটি গৃহীত হয়নি। পরিষদে যোগাযোগ করুন']);
        }

    }


    public function premises_application_verify_data($tracking = null, $union_id = null, $type = null)
    {


        $prev_data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email', 'TRDOPT.*', 'OWNLST.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name','COMP1.bn_name as trade_district_name', 'COMP2.bn_name as trade_upazila_name', 'COMP3.bn_name as trade_postoffice_name', 'BSYTP.name_bn as business_type_bn')

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

            ->join('business_type AS BSYTP', function ($join) use($union_id) {

                $join->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id);
                    // ->where("BSYTP.is_active", "=", 1);
            })

            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')


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

                    "photo"                     => $item->photo,
                    "pin"                     => $item->pin,
                    "name_bn"                 => $item->name_bn,
                    "father_name_bn"          => $item->father_name_bn,
                    "mother_name_bn"          => $item->mother_name_bn,
                    "husband_name_bn"         => $item->husband_name_bn,
                    "wife_name_bn"            => $item->wife_name_bn,
                    "gender"                  => $item->gender,
                    "mobile"                  => $item->citizen_mobile,
                    "nid"                     => $item->nid,
                    "birth_id"                => $item->birth_id,
                    "marital_status"          => $item->marital_status,
                    "resident"                => $item->resident,
                    "religion"                => $item->religion,
                    "permanent_village_bn"    => $item->permanent_village_bn,
                    "permanent_rbs_bn"        => $item->permanent_rbs_bn,
                    "permanent_ward_no"       => $item->permanent_ward_no,
                    "permanent_holding_no"    => $item->permanent_holding_no,
                    "permanent_postoffice_name" => $item->permanent_postoffice_name,
                    "permanent_upazila_name"    => $item->permanent_upazila_name,
                    "permanent_district_name"   => $item->permanent_district_name,
                ];

            } else {

                $owner_list[] = [

                    "photo"                     => $item->photo,
                    "pin"                     => $item->pin,
                    "name_bn"                 => $item->name_bn,
                    "father_name_bn"          => $item->father_name_bn,
                    "mother_name_bn"          => $item->mother_name_bn,
                    "husband_name_bn"         => $item->husband_name_bn,
                    "wife_name_bn"            => $item->wife_name_bn,
                    "gender"                  => $item->gender,
                    "mobile"                  => $item->citizen_mobile,
                    "nid"                     => $item->nid,
                    "birth_id"                => $item->birth_id,
                    "marital_status"          => $item->marital_status,
                    "resident"                => $item->resident,
                    "religion"                => $item->religion,
                    "permanent_village_bn"    => $item->permanent_village_bn,
                    "permanent_rbs_bn"        => $item->permanent_rbs_bn,
                    "permanent_ward_no"       => $item->permanent_ward_no,
                    "permanent_holding_no"    => $item->permanent_holding_no,
                    "permanent_postoffice_name" => $item->permanent_postoffice_name,
                    "permanent_upazila_name"    => $item->permanent_upazila_name,
                    "permanent_district_name"   => $item->permanent_district_name,

                ];

                $data["organization"] = [

                    "union_id"             => $item->union_id,
                    "tracking"             => $item->tracking,
                    "organization_name_bn" => $item->organization_name_bn,
                    "owner_type"           => $item->owner_type,
                    "business_type"        => $item->business_type_bn,
                    "mobile"               => $item->mobile,
                    "email"                => $item->email,
                    "phone"                => $item->phone,
                    "vat_id"               => $item->vat_id,
                    "tax_id"               => $item->tax_id,
                    "capital"              => $item->capital,
                    "trade_ward_no"        => $item->premises_ward_no,
                    "trade_holding_no"     => $item->premises_holding_no,
                    "trade_village_bn"     => $item->premises_village_bn,
                    "trade_rbs_bn"         => $item->premises_rbs_bn,
                    "trade_postoffice_name"  => $item->trade_postoffice_name,
                    "trade_upazila_name"     => $item->trade_upazila_name,
                    "trade_district_name"    => $item->trade_district_name,
                    "created_time"    => $item->created_time,
                    "owner_list"           => $owner_list,
                ];

            }

        }


        return $data;

    }




    public function premises_certificate_verify_data($sonod_no = null, $union_id = null, $fiscal_year = null)
    {



        $certificate_data = DB::table('certificate AS CRT')
            ->select('CRT.*','CTZ.*', 'CRT.status as crt_status', 'CRT.sonod_no', 'CRT.created_time as generate_date',
        'CTZ.mobile as citizen_mobile', 'CTZ.email as citizen_email','TRDOPT.capital','TRDOPT.premises_ward_no','TRDOPT.premises_holding_no','TRDOPT.premises_village_bn','TRDOPT.premises_village_en', 'TRDOPT.phone','TRDOPT.vat_id','TRDOPT.tax_id',
                'TRDOPT.email', 'OWNLST.*', 'FSY.name as fiscal_year_name', 'BDL1.bn_name as permanent_district_name_bn', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL3.bn_name as permanent_postoffice_name_bn','BDL1.en_name as permanent_district_name_en', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.en_name as permanent_postoffice_name_en', 'BSYTP.name_bn as business_type_bn', 'BSYTP.name_en as business_type_en', 'CRT.type', 'TRDOPT.signboard_length', 'TRDOPT.signboard_width', 'TRDOPT.normal_signboard', 'TRDOPT.lighted_signboard', 'TRDOPT.agent_name_en', 'TRDOPT.agent_name_bn', 'TRDOPT.business_start_date', 'TRDOPT.previous_license_data','TRDOPT.organization_name_bn','TRDOPT.owner_type','COMP1.bn_name as trade_district_name_bn', 'COMP2.bn_name as trade_upazila_name_bn', 'COMP3.bn_name as trade_postoffice_name_bn','COMP1.en_name as trade_district_name_en','COMP2.en_name as trade_upazila_name_en','COMP3.en_name as trade_postoffice_name_en','TRDOPT.premises_district_id','TRDOPT.premises_upazila_id','TRDOPT.premises_postoffice_id')
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
            ->join('fiscal_years AS FSY', function ($join) use ($union_id,$fiscal_year) {

                $join->on("FSY.id", "=", 'CRT.fiscal_year_id')
                    ->where("FSY.id", "=",$fiscal_year)
                    ->where("FSY.is_current", "=", '1')
                    ->where("FSY.is_active", "=", '1');
            })


            //for permanent address
            ->join('bd_locations AS BDL1', 'BDL1.id', '=', 'CTZ.permanent_district_id')
            ->join('bd_locations AS BDL2', 'BDL2.id', '=', 'CTZ.permanent_upazila_id')
            ->join('bd_locations AS BDL3', 'BDL3.id', '=', 'CTZ.permanent_postoffice_id')

        //            //for present address
        //            ->join('bd_locations AS BDL4', 'BDL4.id', '=', 'OWNLST.present_district_id')
        //            ->join('bd_locations AS BDL5', 'BDL5.id', '=', 'OWNLST.present_upazila_id')
        //            ->join('bd_locations AS BDL6', 'BDL6.id', '=', 'OWNLST.present_postoffice_id')

            //for company address
            ->join('bd_locations AS COMP1', 'COMP1.id', '=', 'TRDOPT.premises_district_id')
            ->join('bd_locations AS COMP2', 'COMP2.id', '=', 'TRDOPT.premises_upazila_id')
            ->join('bd_locations AS COMP3', 'COMP3.id', '=', 'TRDOPT.premises_postoffice_id')

            ->where([
                ['CRT.sonod_no', '=', $sonod_no],
                ['CRT.union_id', '=', $union_id],
                ['CRT.type', '=', 90],
                ['APP.type', '=', 90],
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
            ->join('acc_transaction AS TRNS', function ($join) use ($sonod_no, $union_id) {

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
            ->where(function ($query) {
                $query->where('TRNS.type', '=', 28)
                    ->orWhere('TRNS.type', '=', 25)
                    ->orWhere('TRNS.type', '=', 97)
                    ->orWhere('TRNS.type', '=', 90);
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


    public function animal_application_verify_data($tracking = null, $union_id = null, $type = null)
    {

        // DB::enableQueryLog();

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


    public function road_application_verify_data($tracking = null, $union_id = null, $type = null){
        // DB::enableQueryLog();

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

    public function road_certifiacte_verify_data($sonod_no = null, $union_id = null, $type = null){

        // dd($sonod_no);
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

    public function newholding_application_verify_data($tracking = null, $union_id = null, $type = null){

        DB::enableQueryLog();

        $data = DB::table('application AS APP')

            ->select('APP.*', 'CTZ.*', 'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name','NHOI.nearby_holding_no','NHOI.holding_construction_date','NHOI.holding','NHOI.description_of_house')

            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {

                $join->on("CTZ.pin", "=", "APP.pin")

                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("APP.union_id", "=", $union_id);
            })

            ->join('newholding_optional_info AS NHOI', function ($join)  use ($union_id) {
                $join->on("NHOI.tracking", "=", "APP.tracking")
                    ->on("NHOI.pin", "=", "APP.pin")
                    ->on("NHOI.union_id", "=", "APP.union_id")
                    ->where("NHOI.union_id", "=", $union_id)
                    ->where("APP.union_id", "=", $union_id)
                    ->where('NHOI.is_active',1);
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
                ['APP.fiscal_year_id', '=', DB::table('fiscal_years')->where('is_current', 1)->first()->id],
            ])
            ->first();


        return $data;

    }

    public function land_application_verify_data($tracking = null, $union_id = null, $type = null){

        $data = DB::table('application AS APP')
            ->select( 'APP.present_village_bn','APP.present_rbs_bn','APP.present_ward_no','APP.type', 'CTZ.name_en','CTZ.name_bn','CTZ.photo','CTZ.father_name_bn','CTZ.mother_name_bn','CTZ.mobile','CTZ.email','CTZ.permanent_village_bn','CTZ.permanent_rbs_bn','CTZ.permanent_ward_no',
                'BDL1.bn_name as permanent_district_name', 'BDL2.bn_name as permanent_upazila_name', 'BDL3.bn_name as permanent_postoffice_name', 'BDL4.bn_name as present_district_name', 'BDL5.bn_name as present_upazila_name', 'BDL6.bn_name as present_postoffice_name', 'LSINFO.*')
            ->join('citizen_information AS CTZ', function ($join) use ($union_id) {
                $join->on("CTZ.pin", "=", "APP.pin")
                    ->on("CTZ.union_id", "=", "APP.union_id")
                    ->where("CTZ.union_id", "=", $union_id)
                    ->where("APP.union_id", "=", $union_id);
            })
            ->join('land_use_info AS LSINFO', function ($join) use ($union_id) {
                $join->on("LSINFO.pin", "=", "APP.pin")
                    ->on("LSINFO.tracking", "=", "APP.tracking")
                    ->on("LSINFO.union_id", "=", "APP.union_id")
                    ->on("LSINFO.application_id", "=", "APP.id")
                    ->where("LSINFO.union_id", "=", $union_id);
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

    public function land_certifiacte_verify_data($sonod_no = null, $union_id = null, $type = null){

        // dd($sonod_no,$union_id,$type);
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
            ->join('land_use_info AS LSINFO', function ($join) {
                $join->on("LSINFO.pin", "=", "CRT.pin")
                    ->on("LSINFO.tracking", "=", "CRT.tracking")
                    ->on("LSINFO.union_id", "=", "CRT.union_id")
                    ->where('LSINFO.is_active', 1);

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

            ->select('CTZ.*','LSINFO.*', 'APP.created_time as application_date', 'APP.present_village_bn', 'APP.present_village_en', 'APP.present_rbs_bn', 'APP.present_rbs_en', 'APP.present_ward_no', 'APP.present_holding_no', 'APP.present_postoffice_id', 'APP.present_upazila_id', 'APP.present_district_id', 'APP.tracking', 'APP.comment_bn', 'APP.comment_en', 'CRT.sonod_no', 'CRT.pin', 'CRT.fiscal_year_id', 'CRT.status', 'CRT.created_time as generate_date', 'BDL1.bn_name as permanent_district_name_bn', 'BDL1.en_name as permanent_district_name_en', 'BDL2.bn_name as permanent_upazila_name_bn', 'BDL2.en_name as permanent_upazila_name_en', 'BDL3.bn_name as permanent_postoffice_name_bn', 'BDL3.en_name as permanent_postoffice_name_en', 'BDL4.bn_name as present_district_name_bn', 'BDL4.en_name as present_district_name_en', 'BDL5.bn_name as present_upazila_name_bn', 'BDL5.en_name as present_upazila_name_en', 'BDL6.bn_name as present_postoffice_name_bn', 'BDL6.en_name as present_postoffice_name_en', 'APP.type','FSY.name as fiscal_year_name','CRT.memo_no')


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

}
