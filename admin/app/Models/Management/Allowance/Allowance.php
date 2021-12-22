<?php

namespace App\Models\Management\Allowance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Image; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class Allowance extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'allowance_id', 'union_id', 'nid', 'photo', 'type', 'father_name', 'date_of_birth', 'mobile', 'village', 'ward_no', 'bio', 'amount_of_allowance', 'sector_no', 'health_condition', 'economical_condition', 'educational_qualification', 'is_active', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    //store allowance
    public static function store($request)
    {
        $id = Allowance::create($request->except('_token', '_wysihtml5_mode', 'photo'))->id;

        if($request->hasFile('photo')){
            $photo = $request->photo;
            $fileExtension = $photo->getClientOriginalExtension();
            $fileName = $request->union_id.$request->type.$id.'.'.$fileExtension;
            Image::make($photo)->resize(300, 300)->save(base_path('public/assets/images/allowance/'.$fileName), 100);
            Allowance::find($id)->update([
                    'photo'      => $fileName
                ]);
        }

        return true;

    }

    //get allowance by type for data-table
    public static function getAllowance($request, $searchContent)
    {
        // DB::enableQueryLog();
        $query = Allowance::where('union_id', Auth::user()->union_id)
        ->where('type', $request->type)
        ->where('is_active', 1)
        ->whereDate('created_at', '>=', $request->fromDate)
        ->whereDate('created_at', '<=', $request->toDate)
        ->latest()       
        ->limit($request->limit);       

           //for searching on page
           if($searchContent != false)
           {
            $query->where(function ($query) use ($searchContent) {
                return $query->where("name", "LIKE", "%".$searchContent."%")
                ->orWhere("nid", "=", $searchContent)
                ->orWhere("father_name", "LIKE", "%".$searchContent."%")
                ->orWhere("mobile", "=", $searchContent)
                ->orWhere("ward_no", "=", $searchContent);
            });
               
        }

        $data['data'] = $query->get();
        
        return $data;
    }

    //get allowance by id for edit
    public static function getAllowanceById($id)
    {
        $data = Allowance::find($id);
        return $data;
    }

    //update allowance by id
    public static function updateAllowance($request)
    {
        $res = Allowance::find($request->id)->update($request->except('_token', 'photo', '_wysihtml5_mode'));
        if($request->hasFile('photo')){
            $photo = $request->photo;
            $fileExtension = $photo->getClientOriginalExtension();
            $fileName = auth()->user()->union_id.$request->type.$request->id.'.'.$fileExtension;
            Image::make($photo)->resize(300, 300)->save(base_path('public/assets/images/allowance/'.$fileName), 100);
            Allowance::find($request->id)->update([
                    'photo'      => $fileName
                ]);
        }
        return $res;
    }

    //get allowance profile
    public static function getAllowanceWithUnionInfo($type, $id)
    {
        $res = DB::table('allowances AS VATA')
                ->join('union_information AS UI','VATA.union_id', '=','UI.union_code')
                ->join('bd_locations AS LOC1','UI.district_id', '=','LOC1.id')
                ->join('bd_locations AS LOC2','UI.upazila_id', '=','LOC2.id')
                ->join('bd_locations AS LOC3','UI.postal_id', '=', 'LOC3.id')
                ->select('VATA.*','UI.bn_name AS union_name_bn', 'UI.main_logo AS union_logo', 'LOC1.bn_name AS union_district','LOC2.bn_name AS union_upazila', 'LOC3.bn_name AS union_post_office')
                ->where([
                    ['VATA.union_id', '=', Auth::user()->union_id],
                    ['VATA.id', '=', $id],
                    ['VATA.type', '=', $type],
                    ['VATA.is_active', '=', 1],
                    ['UI.union_code', '=', Auth::user()->union_id],
                    ['UI.is_active', '=', 1],
                ])
                ->get();

        return $res;
    }

    //get allowance profile
    public static function getAllAllowanceWithUnionInfo($type)
    {
        $res = DB::table('allowances AS VATA')
                ->join('union_information AS UI','VATA.union_id', '=','UI.union_code')
                ->join('bd_locations AS LOC1','UI.district_id', '=','LOC1.id')
                ->join('bd_locations AS LOC2','UI.upazila_id', '=','LOC2.id')
                ->join('bd_locations AS LOC3','UI.postal_id', '=', 'LOC3.id')
                ->select('VATA.*','UI.bn_name AS union_name_bn', 'UI.main_logo AS union_logo', 'LOC1.bn_name AS union_district','LOC2.bn_name AS union_upazila', 'LOC3.bn_name AS union_post_office')
                ->where([
                    ['VATA.union_id', '=', Auth::user()->union_id],
                    ['VATA.type', '=', $type],
                    ['VATA.is_active', '=', 1],
                    ['UI.union_code', '=', Auth::user()->union_id],
                    ['UI.is_active', '=', 1],
                ])
                ->get();

        return $res;
    }

    //delete allowance
    public static function deleteAllowance($id)
    {
        $res = Allowance::find($id)->update(['is_active' => 0 , 'deleted_at' => Carbon::now(), 'updated_by_ip' => Request::ip()]);
        return $res;
    }
}
