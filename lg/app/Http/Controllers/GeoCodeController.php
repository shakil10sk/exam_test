<?php

namespace App\Http\Controllers;

use App\Models\Geocode\BdLocation;
use App\Models\UnionInformation;
use Illuminate\Http\Request;
use DB;

class GeoCodeController extends Controller
{
    //Get district from bd_locations
    public function getDistrict()
    {
        $district_list = '';
        $district = BdLocation::where('type', 2)->get();
        foreach ($district as $item){
            $district_list .= "<option value='".$item->id."'>$item->en_name</option>";
        }
        return $district_list;
    }

    //Get GeoCode Location
    public function getLocation(Request $r)
    {
        // return $r;
        $data['upzilla'] = BdLocation::where('parent_id', $r->id)->where('type', $r->type)->get();
        $data['name'] = BdLocation::find($r->id)->bn_name;
        return response()->json($data);
    }

    //Get union by upazila id
    public function get_union(Request $request)
    {
        // return $r;
        $data['union'] = DB::table('union_information')->where('upazila_id', $request->id)->get();
        return response()->json($data);
    }

    public function business_type(Request $request)
    {

       
        // return $r;
        $data = DB::table('business_type')
        ->where('union_id', $request->union_id)
        ->get();
        return response()->json($data);
    }
}
