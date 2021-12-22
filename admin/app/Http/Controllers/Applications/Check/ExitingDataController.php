<?php

namespace App\Http\Controllers\Applications\Check;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ExitingDataController extends Controller
{
    public function CheckExitingData(Request $request)
    {
        // dd($request->all());

        $unionId            = $request->unionId;
        $searchData         = $request->searchData;
        $type               = $request->applicationType;

        // $applicationData    = $this->checkApplication($unionId, $type, $searchData);
        $citizen = $this->checkCitizen($unionId, $searchData);

        // dd($citizen);

        // $certificateData    = $this->checkCertificate($unionId, $type, $searchData);

        // // dd($certificateData);

        // $applicationType    = [1 => 'nagorik', 2 => 'death', 3 => 'obibahito', 4 => 'punobibaho', 5 => 'ekoinam', 6 => 'sonaton', 7 => 'prottyon', 8 => 'nodibanga', 9 => 'character', 10 => 'vumihin', 11 => 'yearlyincome', 12 => 'protibondi', 13 => 'onumoti', 14 => 'voter', 15 => 'onapotti', 16 => 'rastakhonon', 17 => 'warish', 18 => 'family', 19 => 'trade', 20 => 'bibahito'];


        // $mes = 'আপনার পিন নং ';
        //     if($type == 19 && (isset($applicationData->type) || isset($certificateData->sonod_no))){
        //         if(isset($applicationData->type)){
        //           $searchData =   $applicationData->tracking;
        //         }elseif (isset($certificateData->sonod_no)) {
        //             $searchData =   $certificateData->tracking;
        //         }
        //         $woners = $this->checkOwner($unionId, $searchData);
        //         $count = count($woners);
        //         if($count > 1){
        //             $mes = 'আপনাদের পিন নং ';
        //         }
        //         $pin = '';
        //         foreach($woners as $key => $item){
        //             $pin .= $item->pin;
        //             if($count != $key+1){
        //                 $pin .= ', ';
        //             }

        //         }
        //     }else {
        //         if(isset($applicationData->pin)){
        //             $pin = strval($applicationData->pin);
        //         }elseif(isset($certificateData->pin)) {
        //             $pin = strval($certificateData->pin);
        //         }
        //     }

        //     // dd($pin);

        // if(isset($applicationData->status) && $applicationData->status == 1 || isset($certificateData->type) && $certificateData->type == $type)
        // {
        //     $res = ['status' => 'এই সনদটি ইতিঃপূর্বে নেয়া হয়েছে!', 'message' => $mes, 'pin' => $pin, 'tracking' => strval($certificateData->tracking), 'sonodno' => strval($certificateData->sonod_no), 'unionid' => $certificateData->union_id, 'type' => $certificateData->type, 'application' => $applicationType[$type]];
        //     return response()->json($res);

        // }elseif(isset($applicationData->status) && $applicationData->status == 0)
        // {
        //     $res = ['status' => 'এই সনদ এর আবেদন ইতিঃপূর্বে করা হয়েছে!', 'message' => $mes, 'pin' => $pin, 'tracking' => strval($applicationData->tracking), 'unionid' => $applicationData->union_id, 'type' => $applicationData->type, 'application' => $applicationType[$type]];
        //     return response()->json($res);
        // }
        // else
        // {
        //     $appData = $this->checkAppByTracking($unionId, $searchData);
        //     $cerData = $this->checkCerByTracking($unionId, $searchData);

        //     if(isset($appData->pin)){
        //         $searchData = $appData->pin;
        //     }elseif(isset($cerData->pin)){
        //         $searchData = $cerData->pin;
        //     }

        //     $data = $this->checkCitizen($unionId, $searchData);
        //     $res = [];
        //     if(isset($data[0]->pin)){
        //         foreach($data[0] as $key => $item){
        //             if($key == 'permanent_district_id' || $key == 'permanent_district_name_bn' || $key == 'permanent_district_name_en' || $key == 'permanent_postoffice_id' || $key == 'permanent_postoffice_name_bn' || $key == 'permanent_postoffice_name_en' || $key == 'permanent_upazila_id' || $key == 'permanent_upazila_name_bn' || $key == 'permanent_upazila_name_en' || $key == 'present_district_id' || $key == 'present_district_name_bn' || $key == 'present_district_name_en' || $key == 'present_holding_no' || $key == 'present_holding_no' || $key == 'present_postoffice_id' || $key == 'present_postoffice_name_bn' || $key == 'present_postoffice_name_en' || $key == 'present_rbs_bn' || $key == 'present_rbs_en' || $key == 'present_upazila_id' || $key == 'present_upazila_name_bn' || $key == 'present_upazila_name_en' || $key == 'present_village_bn' || $key == 'present_village_en' || $key == 'present_ward_no' || $key == 'comment_bn' || $key == 'comment_en' || $key == 'gender' || $key == 'marital_status' || $key == 'photo' || $key == 'wife_name_bn' || $key == 'wife_name_en' || $key == 'husband_name_en' || $key == 'husband_name_bn'){
        //                 $res[1][$key] = $item;
        //             }else {
        //                 $res[0][$key] = $item;
        //             }
        //         }



        //     }else {
        //         $res = ['status404' => 'আপনার কোনো তথ্য পাওয়া যায়নি!'];
        //     }

            if(empty($citizen)){
                return response()->json(['status' => 'error', 'message' => 'No citizen found.', 'data' => []]);
            }

            return response()->json(['status' => 'success', 'message' => 'Citizen information found.', 'data' => $citizen]);



        // }
    }

    //check application
    private function checkApplication($unionId, $type, $searchData)
    {
        // dd($unionId,$searchData);
        $data = $this->checkCitizen($unionId, $searchData);
        if(isset($data[0]->pin)){
            $searchData = $data[0]->pin;
        }

        // if($type == 19){
        //     $woners = $this->checkOwner($unionId, $searchData);
        //     if(isset($woners[0]->tracking)){
        //         $searchData = $woners[0]->tracking;
        //     }
        // }
        return $query = DB::table('citizen_information As CTI')->where('union_id', '=', $unionId)->where('is_active', '=', 1)
                ->join('application AS APP','CTI.pin', '=','APP.pin')
                ->where(function ($query) use ($searchData) {
                    return $query->where("CTI.pin", "=", $searchData)
                        ->orWhere("CTI.nid", "=", $searchData)
                        ->orWhere("CTI.birth_id", "=", $searchData)
                        ->orWhere("CTI.mobile", "=", $searchData)
                        ->orWhere("APP.tracking", "=", $searchData);
                })->first();

        // return $query = DB::table('application')->where('union_id', '=', $unionId)->where('is_active', '=', 1)
        //     ->where(function ($query) use ($searchData) {
        //         return $query->where("application.pin", "=", $searchData)
        //             ->orWhere("application.tracking", "=", $searchData);
        //         })->first();
    }

    private function checkAppByTracking($unionId, $searchData)
    {
        return $query = DB::table('application')->where('union_id', '=', $unionId)->where('is_active', '=', 1)
            ->where(function ($query) use ($searchData) {
                return $query->where("application.pin", "=", $searchData)
                    ->orWhere("application.tracking", "=", $searchData);
                })->first();
    }

    //check certificate
    private function checkCertificate($unionId, $type, $searchData)
    {
        $data = $this->checkCitizen($unionId, $searchData);
        if(isset($data[0]->pin)){
            $searchData = $data[0]->pin;
        }

        if($type == 19){
            $woners = $this->checkOwner($unionId, $searchData);
            if(isset($woners[0]->tracking)){
                $searchData = $woners[0]->tracking;
            }
        }

        return $query = DB::table('certificate')->where('union_id', '=', $unionId)->where('type', '=', $type)->where('is_active', '=', 1)
        ->where(function ($query) use ($searchData) {
            return $query->where("certificate.pin", "=", $searchData)
                ->orWhere("certificate.tracking", "=", $searchData)
                ->orWhere("certificate.sonod_no", "=", $searchData);
        })->first();
    }

    //check certificate
    private function checkCerByTracking($unionId, $searchData)
    {
        return $query = DB::table('certificate')->where('union_id', '=', $unionId)->where('is_active', '=', 1)
        ->where(function ($query) use ($searchData) {
            return $query->where("certificate.pin", "=", $searchData)
                ->orWhere("certificate.tracking", "=", $searchData)
                ->orWhere("certificate.sonod_no", "=", $searchData);
        })->first();
    }

    private function checkCitizen($unionId, $searchData)
    {
        $query = DB::table('citizen_information As CTI')
            ->join('application AS APP','CTI.pin', '=','APP.pin')

            ->join('bd_locations AS LOC1','APP.present_district_id', '=','LOC1.id')
            ->join('bd_locations AS LOC2','APP.present_upazila_id', '=','LOC2.id')
            ->join('bd_locations AS LOC3','APP.present_postoffice_id', '=', 'LOC3.id')

            ->join('bd_locations AS LOC4','CTI.permanent_district_id', '=','LOC4.id')
            ->join('bd_locations AS LOC5','CTI.permanent_upazila_id', '=','LOC5.id')
            ->join('bd_locations AS LOC6','CTI.permanent_postoffice_id', '=', 'LOC6.id')

            ->select('CTI.*', 'APP.*',
            'LOC1.id AS present_district_id',
            'LOC2.id AS present_upazila_id',
            'LOC3.id AS present_postoffice_id',

            'LOC1.en_name AS present_district_name_en',
            'LOC2.en_name AS present_upazila_name_en',
            'LOC3.en_name AS present_postoffice_name_en',

            'LOC1.bn_name AS present_district_name_bn',
            'LOC2.bn_name AS present_upazila_name_bn',
            'LOC3.bn_name AS present_postoffice_name_bn',

            'LOC4.id AS permanent_district_id',
            'LOC5.id AS permanent_upazila_id',
            'LOC6.id AS permanent_postoffice_id',

            'LOC4.en_name AS permanent_district_name_en',
            'LOC5.en_name AS permanent_upazila_name_en',
            'LOC6.en_name AS permanent_postoffice_name_en',

            'LOC4.bn_name AS permanent_district_name_bn',
            'LOC5.bn_name AS permanent_upazila_name_bn',
            'LOC6.bn_name AS permanent_postoffice_name_bn'
            )
            ->where([
                ['CTI.union_id', '=', $unionId],
                ['CTI.is_active', '=', 1],
                ['APP.is_active', '=', 1],
                ['APP.union_id', '=', $unionId]
            ]);

            $query->where(function ($query) use ($searchData) {
                return $query->where("CTI.nid", "=", $searchData)
                    ->orWhere("CTI.passport_no", "=", $searchData)
                    ->orWhere("CTI.birth_id", "=", $searchData)
                    ->orWhere("CTI.pin", "=", $searchData)
                    ->orWhere("CTI.mobile", "=", $searchData);
            });

            return $query->get()->first();
    }

    private function checkOwner($unionId, $searchData)
    {
        return $query = DB::table('owner_info')->where('union_id', '=', $unionId)->where('is_active', '=', 1)
            ->where(function ($query) use ($searchData) {
                return $query->where("owner_info.pin", "=", $searchData)
                    ->orWhere("owner_info.tracking", "=", $searchData);
                })->get()->first();
    }


    // new system finding citizen
    public function findCitizenInformation(Request $request)
    {
        // dd($request->all());
        $search_data = $request->searchData;
        $union_id = $request->unionId;
        $applicationType = $request->applicationType;
        $type = $request->appType; // 1 = abedon, 2 = certificate
        // that is only for trade citizen information
        $tradeOwnerType = $request->owerType;


// dd($type);
        // application & certificate checking from web //
        if (!empty($type) && $type == 1) {
            $data = $this->checkApplication($union_id, $applicationType, $search_data);
        } elseif (!empty($type) && $type == 2) {
            $data = $this->checkCertificate($union_id, $applicationType, $search_data);
        }

        // dd($data);

        // general application data finding
        if (empty($data)) {
            $data = $this->findGeneralApplicationInfo($search_data, $union_id);
        }

        //dd($request->all());


        // check in trade
        if (empty($data)) {
            $data = $this->findTradeApplicationInfo($search_data, $union_id, $tradeOwnerType);
        }

        // check in warish
        if (empty($data)) {
            $data = $this->findWarishApplicationInfo($search_data, $union_id);
        }

        // dd($data);

        return response()->json($data);

    }


    private function findGeneralApplicationInfo($search_data, $union_id)
    {
        $query = DB::table('citizen_information As CTI')
            ->join('application AS APP', function ($join) {
                $join->on('CTI.pin', '=', 'APP.pin')
                    ->on('CTI.union_id', '=', 'APP.union_id');
            })
            ->join("certificate AS CRT", function ($join) {
                $join->on("CRT.union_id", "=", "APP.union_id")
                    ->on("CRT.fiscal_year_id", "=", "APP.fiscal_year_id")
                    ->on("CRT.tracking", "=", "APP.tracking");
            })
            ->join('bd_locations AS LOC1', 'APP.present_district_id', '=', 'LOC1.id')
            ->join('bd_locations AS LOC2', 'APP.present_upazila_id', '=', 'LOC2.id')
            ->join('bd_locations AS LOC3', 'APP.present_postoffice_id', '=', 'LOC3.id')
            ->join('bd_locations AS LOC4', 'CTI.permanent_district_id', '=', 'LOC4.id')
            ->join('bd_locations AS LOC5', 'CTI.permanent_upazila_id', '=', 'LOC5.id')
            ->join('bd_locations AS LOC6', 'CTI.permanent_postoffice_id', '=', 'LOC6.id')
            ->select(
                'CTI.*',
                'APP.*',
                'LOC1.id AS present_district_id',
                'LOC2.id AS present_upazila_id',
                'LOC3.id AS present_postoffice_id',

                'LOC1.en_name AS present_district_name_en',
                'LOC2.en_name AS present_upazila_name_en',
                'LOC3.en_name AS present_postoffice_name_en',

                'LOC1.bn_name AS present_district_name_bn',
                'LOC2.bn_name AS present_upazila_name_bn',
                'LOC3.bn_name AS present_postoffice_name_bn',

                'LOC4.id AS permanent_district_id',
                'LOC5.id AS permanent_upazila_id',
                'LOC6.id AS permanent_postoffice_id',

                'LOC4.en_name AS permanent_district_name_en',
                'LOC5.en_name AS permanent_upazila_name_en',
                'LOC6.en_name AS permanent_postoffice_name_en',

                'LOC4.bn_name AS permanent_district_name_bn',
                'LOC5.bn_name AS permanent_upazila_name_bn',
                'LOC6.bn_name AS permanent_postoffice_name_bn'
            )
            ->where([
                ['CTI.union_id', '=', $union_id],
                ['CTI.is_active', '=', 1],
                ['APP.is_active', '=', 1],
                ['APP.union_id', '=', $union_id]
            ]);

        $query->where(function ($query) use ($search_data) {
            return $query->where("CTI.nid", "=", $search_data)
                ->orWhere("CTI.mobile", "=", $search_data)
                ->orWhere("CTI.passport_no", "=", $search_data)
                ->orWhere("CTI.birth_id", "=", $search_data)
                ->orWhere("APP.tracking", "=", $search_data)
                ->orWhere("CRT.sonod_no", "=", $search_data)
                ->orWhere("CTI.pin", "=", $search_data);
        });

        return $query->get()->first();
    }

    private function findTradeApplicationInfo($search_data, $union_id, $tradeOwnerType)
    {

        $query = DB::table('citizen_information As CTI')
            ->join('owner_info AS OWI', function ($join) {
                $join->on('CTI.pin', '=', 'OWI.pin')
                    ->on('CTI.union_id', '=', 'OWI.union_id');
            })
            ->join("certificate AS CRT", function ($join) {
                $join->on("CRT.union_id", "=", "OWI.union_id")
                    ->on("CRT.fiscal_year_id", "=", "OWI.fiscal_year_id")
                    ->on("CRT.tracking", "=", "OWI.tracking");
            })
            ->selectRaw("CTI.*,OWI.*")
            ->where([
                ['CTI.union_id', '=', $union_id],
                ['CTI.is_active', '=', 1],
                ['OWI.is_active', '=', 1],
                ['OWI.union_id', '=', $union_id]
            ]);

        $query->when(empty($tradeOwnerType) && (int)$tradeOwnerType != 4, function ($q) {
            $q->join('bd_locations AS LOC1', 'OWI.present_district_id', '=', 'LOC1.id')
                ->join('bd_locations AS LOC2', 'OWI.present_upazila_id', '=', 'LOC2.id')
                ->join('bd_locations AS LOC3', 'OWI.present_postoffice_id', '=', 'LOC3.id')
                ->join('bd_locations AS LOC4', 'CTI.permanent_district_id', '=', 'LOC4.id')
                ->join('bd_locations AS LOC5', 'CTI.permanent_upazila_id', '=', 'LOC5.id')
                ->join('bd_locations AS LOC6', 'CTI.permanent_postoffice_id', '=', 'LOC6.id')
                ->select('LOC1.id AS present_district_id',
                    'LOC2.id AS present_upazila_id',
                    'LOC3.id AS present_postoffice_id',

                    'LOC1.en_name AS present_district_name_en',
                    'LOC2.en_name AS present_upazila_name_en',
                    'LOC3.en_name AS present_postoffice_name_en',

                    'LOC1.bn_name AS present_district_name_bn',
                    'LOC2.bn_name AS present_upazila_name_bn',
                    'LOC3.bn_name AS present_postoffice_name_bn',

                    'LOC4.id AS permanent_district_id',
                    'LOC5.id AS permanent_upazila_id',
                    'LOC6.id AS permanent_postoffice_id',

                    'LOC4.en_name AS permanent_district_name_en',
                    'LOC5.en_name AS permanent_upazila_name_en',
                    'LOC6.en_name AS permanent_postoffice_name_en',

                    'LOC4.bn_name AS permanent_district_name_bn',
                    'LOC5.bn_name AS permanent_upazila_name_bn',
                    'LOC6.bn_name AS permanent_postoffice_name_bn',
                    'CTI.*', 'OWI.*'
                );
        });

        $query->where(function ($query) use ($search_data) {
            return $query->where("CTI.nid", "=", $search_data)
                ->orWhere("CRT.sonod_no", "=", $search_data)
                ->orWhere("CTI.mobile", "=", $search_data)
                ->orWhere("CTI.passport_no", "=", $search_data)
                ->orWhere("CTI.birth_id", "=", $search_data)
                ->orWhere("OWI.tracking", "=", $search_data)
                ->orWhere("CTI.pin", "=", $search_data);
        });

        return $query->get()->first();
    }

    private function findWarishApplicationInfo($search_data, $union_id)
    {
        $query = DB::table('citizen_information As CTI')
            ->join('warish_family_applicant_info AS WFAI', function ($join) {
                $join->on('CTI.pin', '=', 'WFAI.pin')
                    ->on('CTI.union_id', '=', 'WFAI.union_id');
            })
            ->join("certificate AS CRT", function ($join) {
                $join->on("CRT.union_id", "=", "WFAI.union_id")
                    ->on("CRT.tracking", "=", "WFAI.tracking");
            })
            ->join('bd_locations AS LOC4', 'CTI.permanent_district_id', '=', 'LOC4.id')
            ->join('bd_locations AS LOC5', 'CTI.permanent_upazila_id', '=', 'LOC5.id')
            ->join('bd_locations AS LOC6', 'CTI.permanent_postoffice_id', '=', 'LOC6.id')
            ->select(
                'CTI.*',
                'WFAI.*',

                'LOC4.id AS permanent_district_id',
                'LOC5.id AS permanent_upazila_id',
                'LOC6.id AS permanent_postoffice_id',

                'LOC4.en_name AS permanent_district_name_en',
                'LOC5.en_name AS permanent_upazila_name_en',
                'LOC6.en_name AS permanent_postoffice_name_en',

                'LOC4.bn_name AS permanent_district_name_bn',
                'LOC5.bn_name AS permanent_upazila_name_bn',
                'LOC6.bn_name AS permanent_postoffice_name_bn'
            )
            ->where([
                ['CTI.union_id', '=', $union_id],
                ['CTI.is_active', '=', 1],
                ['WFAI.is_active', '=', 1],
                ['WFAI.union_id', '=', $union_id]
            ]);

        $query->where(function ($query) use ($search_data) {
            return $query->where("CTI.nid", "=", $search_data)
                ->orWhere("CTI.mobile", "=", $search_data)
                ->orWhere("WFAI.mobile", "=", $search_data)
                ->orWhere("CTI.passport_no", "=", $search_data)
                ->orWhere("CTI.birth_id", "=", $search_data)
                ->orWhere("WFAI.tracking", "=", $search_data)
                ->orWhere("CRT.sonod_no", "=", $search_data)
                ->orWhere("CTI.pin", "=", $search_data);
        });

        return $query->get()->first();
    }

}
