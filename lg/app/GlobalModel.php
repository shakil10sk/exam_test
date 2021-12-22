<?php

namespace App;

use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GlobalModel extends Model
{

    //this is for union profile
    public static function union_profile($union_id = NULL)
    {

        $data = DB::table('union_information AS UI')

            ->join('bd_locations AS UADD1', 'UADD1.id', '=', 'UI.district_id')
            ->join('bd_locations AS UADD2', 'UADD2.id', '=', 'UI.upazila_id')
            ->join('bd_locations AS UADD3', 'UADD3.id', '=', 'UI.postal_id')
            // ->join('fiscal_years AS FY', 'FY.union_id', '=', 'UI.union_code')

            ->select('UI.main_logo', 'UI.brand_logo', 'UI.jolchap', 'UI.is_header_active', 'UADD1.bn_name as union_district_name_bn', 'UADD1.en_name as union_district_name_en', 'UADD2.bn_name as union_upazila_name_bn', 'UADD2.en_name as union_upazila_name_en', 'UADD3.bn_name as union_postoffice_name_bn', 'UADD3.en_name as union_postoffice_name_en', 'UI.bn_name', 'UI.en_name', 'UI.mobile', 'UI.telephone', 'UI.email', 'UI.sub_domain', 'UI.postal_code', 'UI.village_bn', 'UI.village_en', 'UI.union_code as union_id', 'UI.about', 'UI.google_map')

            ->where([
                ['UI.union_code', '=', $union_id],
                ['UI.status', '=', 1],
            ])
            ->first();

        if (empty($data)) {
            return [];
        }

        $fiscal_year = FiscalYear::where(['is_active' => 1, 'is_current' => 1])->first();

        if (empty($fiscal_year)) {
            $data->fiscal_id = 0;
        } else {
            $data->fiscal_id = $fiscal_year->id;
        }

        return $data;
    }


    public static function lg_profile($sub_domain)
    {

        $data = DB::table('union_information AS UI')

           
            ->select('UI.main_logo', 'UI.brand_logo', 'UI.jolchap', 'UI.is_header_active',  'UI.bn_name', 'UI.en_name', 'UI.mobile', 'UI.telephone', 'UI.email', 'UI.sub_domain', 'UI.postal_code', 'UI.village_bn', 'UI.village_en', 'UI.union_code as union_id', 'UI.about', 'UI.google_map', 'UI.district_id')

            ->where([
                ['UI.sub_domain', '=', $sub_domain],
                ['UI.status', '=', 1],
            ])
            ->first();

        if (empty($data)) {
            return [];
        }

        $fiscal_year = FiscalYear::where(['is_active' => 1, 'is_current' => 1])->first();

        if (empty($fiscal_year)) {
            $data->fiscal_id = 0;
        } else {
            $data->fiscal_id = $fiscal_year->id;
        }

        return $data;
    }
}
