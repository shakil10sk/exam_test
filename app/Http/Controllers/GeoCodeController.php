<?php

namespace App\Http\Controllers;

use App\Models\Geocode\BdLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function searchLocation(Request $request)
    {
        $term = $request->term;
        $type = $request->type;
        $parent_id = $request->parent_id;

        $data = DB::table("bd_locations")
            ->where(function($q) use($term){
                $q->where("en_name", "like", "%{$term}%")
                    ->orWhere("bn_name", "like", "%{$term}%");
            })
            ->where("type", $type)
            ->when(!empty($parent_id), function($q){
                $q->where("parent_id", request('parent_id'));
            })
            // ->select("bn_name AS label", "id AS value")
            ->get();

        return response()->json($data);
    }
}
