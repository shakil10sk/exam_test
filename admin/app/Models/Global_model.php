<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Request;
use Image;
use union_information;

class Global_model extends Model
{
    //this is for union profile
    public static function union_profile($union_code = null)
    {
        return DB::table('union_information AS UI')
            ->join('bd_locations AS UADD1', 'UADD1.id', '=', 'UI.district_id')
            ->join('bd_locations AS UADD2', 'UADD2.id', '=', 'UI.upazila_id')
            ->join('bd_locations AS UADD3', 'UADD3.id', '=', 'UI.postal_id')
            ->select('UI.main_logo','UI.union_code', 'UI.brand_logo', 'UI.jolchap', 'UI.is_header_active', 'UADD1.bn_name as union_district_name_bn', 'UADD1.en_name as union_district_name_en', 'UADD2.bn_name as union_upazila_name_bn', 'UADD2.en_name as union_upazila_name_en', 'UADD3.bn_name as union_postoffice_name_bn', 'UADD3.en_name as union_postoffice_name_en', 'UI.bn_name', 'UI.en_name', 'UI.mobile', 'UI.telephone','UI.ward_no', 'UI.email', 'UI.sub_domain', 'UI.postal_code', 'UI.village_bn', 'UI.village_en')
            ->where([
                ['UI.union_code', '=', $union_code],
                ['UI.status', '=', 1],
            ])
            ->first();
    }


    //this for number convert
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

    public static function bn2en($number)
    {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number)
    {
        return str_replace(self::$en, self::$bn, $number);
    }

    //get all account
    public static function account_list($union_id)
    {
        return DB::table("acc_account")
            ->select('id', 'account_name', 'account_code', 'parent_id', 'acc_type')
            ->where([
                ['acc_type', 26],
                ['is_active', 1],
                ['union_id', $union_id],
            ])
            // bank account //
            ->orWhere([
                ['acc_type', 27],
                ['is_active', 1],
                ['union_id', $union_id],
            ])
            ->orWhere([
                ['parent_id', 29],
                ['is_active', 1],
                ['union_id', $union_id],
            ])
            // bank account //
            ->orWhere([
                ['parent_id', 30],
                ['is_active', 1],
                ['acc_type','>',105],
                ['head_type', 129],
                ['union_id', $union_id],
            ])
            ->orWhere('acc_type','>',105)
            ->get();
    }

    // get debit account id
    public static function get_account_id($union_id = null, $type = null, $head_type = null, $account_code = null)
    {
        return DB::table('acc_account')
            ->where(['union_id' => $union_id, 'acc_type' => $type])
            ->when(!is_null($head_type), function ($q) use ($head_type) {
                $q->where('head_type', $head_type);
            })
            ->when(!is_null($account_code), function ($q) use ($account_code) {
                $q->where('account_code', $account_code);
            })
            ->first()->id;
    }

    // get fiscal years
    public static function fiscal_years($union_id = null)
    {
        return DB::table('fiscal_years')
            ->select('id', 'name', 'is_current')
            ->where('is_active', 1)
            ->get();
    }

    //get current fiscal year id
    public static function current_fiscal_year($union_id = NULL)
    {
        return DB::table('fiscal_years')
            // ->where('union_id', $union_id)
            ->where('is_current', 1)
            ->where('is_active', 1)
            ->first()->id;
    }

    public static function one_fiscal_year_info($fiscal_year_id = NULL)
    {
        // dd($fiscal_year_id);
        return DB::table('fiscal_years')
            ->select('*')
            ->where('id','=', $fiscal_year_id)
            // ->where('is_current', 1)
            // ->where('is_active', 1)
            ->first();
    }


    //get current fiscal year id
    public static function current_fiscal_year_name($union_id = NULL)
    {
        return DB::table('fiscal_years')
            // ->where('union_id', $union_id)
            ->where('is_current', 1)
            ->where('is_active', 1)
            ->first()->name;
    }

    //get all location by  there type
    public static function get_all_location($receive = null)
    {
        $parent_id = isset($receive['parent_id']) ? $receive['parent_id'] : 0;
        $type = isset($receive['type']) ? $receive['type'] : 0;

        return DB::table('bd_locations')
            ->where(function ($query) use ($parent_id, $type) {
                if ($parent_id > 0) {
                    $query->where(['parent_id' => $parent_id, 'type' => $type]);
                } else {
                    $query->where('type', 2);
                }
            })
            ->get();
    }
}
