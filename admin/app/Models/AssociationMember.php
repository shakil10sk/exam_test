<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssociationMember extends Model
{


    public static function list_data()
    {
        $data = DB::table('association_member_list AS AML')
            ->Join('bd_locations AS BD1', 'AML.permanent_district_id', '=', 'BD1.id')
            ->Join('bd_locations AS BD2', 'AML.permanent_upazila_id', '=', 'BD2.id')
            ->Join('bd_locations AS BD3', 'AML.permanent_postoffice_id', '=', 'BD3.id')
            ->Join('acc_account AS ACC', 'AML.id', '=', 'ACC.account_code')
            ->leftJoin('association_member_list AS RF', 'RF.id', '=', 'AML.reference_id')
            ->select(DB::raw("AML.*"), 'BD1.en_name AS district_name', 'BD2.en_name as upozila_name', 'BD3.en_name as postoffice_name', 'RF.name as reference_name','ACC.id as account_id')
            ->where('AML.union_id', Auth::user()->union_id)
            ->whereNull('AML.deleted_at')
            ->get();

        return $data;
    }

    public static function edit_data($id)
    {
        $data = DB::table('association_member_list AS AML')
            ->Join('bd_locations AS BD1', 'AML.permanent_district_id', '=', 'BD1.id')
            ->Join('bd_locations AS BD2', 'AML.permanent_upazila_id', '=', 'BD2.id')
            ->Join('bd_locations AS BD3', 'AML.permanent_postoffice_id', '=', 'BD3.id')

            ->Join('bd_locations AS BD4', 'AML.present_district_id', '=', 'BD4.id')
            ->Join('bd_locations AS BD5', 'AML.present_upazila_id', '=', 'BD5.id')
            ->Join('bd_locations AS BD6', 'AML.present_postoffice_id', '=', 'BD6.id')
            ->Join('acc_account AS ACC', 'AML.id', '=', 'ACC.account_code')


            ->leftJoin('association_member_list AS RF', 'RF.id', '=', 'AML.reference_id')


            ->select(DB::raw("AML.*"), 'BD1.id AS permanent_district_id', 'BD1.en_name AS permanent_district_name','BD1.bn_name AS permanent_district_name_bn',
                'BD2.id as permanent_upazila_id', 'BD2.en_name as permanent_upozila_name','BD2.bn_name as permanent_upozila_name_bn', 'BD3.id as permanent_postoffice_id', 'BD3.en_name as permanent_postoffice_name','BD3.bn_name as permanent_postoffice_name_bn',
                'BD4.id AS present_district_id', 'BD4.en_name AS present_district_name', 'BD4.bn_name AS present_district_name_bn',  'BD5.id as present_upazila_id', 'BD5.en_name as present_upozila_name','BD5.bn_name as present_upozila_name_bn', 'BD6.id as present_postoffice_id', 'BD6.en_name as persent_postoffice_name','BD6.bn_name as persent_postoffice_name_bn', 'RF.name as reference_name','ACC.id as account_id')
            ->where('AML.union_id', Auth::user()->union_id)
            ->where('AML.id', $id)
            ->whereNull('AML.deleted_at')
            ->first();

        return $data;
    }
}
