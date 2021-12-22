<?php

namespace App\Models\Management\Union;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\DB;

class UnionInformation extends Model
{
    protected $fillable = ['district_id', 'upazila_id', 'postal_id', 'union_code', 'main_logo','jolchap', 'about', 'is_header_active', 'brand_logo', 'en_name', 'bn_name', 'postal_code', 'village_bn','village_en', 'google_map', 'email', 'mobile', 'telephone', 'email', 'sub_domain', 'status', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->is_process = 0;
            $query->is_process_web = 0;
        });
    }

    public static function store($request)
    {
        $id = UnionInformation::create($request->except('_token', 'main_logo', 'brand_logo', 'jolchap', '_wysihtml5_mode', 'trade_generate'))->id;

        if ($request->hasFile('main_logo')){
            $photo = $request->main_logo;

            $fileExtension = $photo->getClientOriginalExtension();

            $fileName = 'main_logo_'.$request->union_code.'.'.$fileExtension;
            Image::make($photo)->resize(500, 500)->save(base_path('public/assets/images/union_profile/'.$fileName), 100);

            UnionInformation::find($id)->update([
                'main_logo'      => $fileName
            ]);
        } else {
            UnionInformation::find($id)->update([
                'main_logo'      => 'default_main_logo.png'
            ]);
        }

        if ($request->hasFile('brand_logo')){
            $photo = $request->brand_logo;

            $fileExtension = $photo->getClientOriginalExtension();

            $fileName = 'brand_logo_'.$request->union_code.'.'.$fileExtension;
            Image::make($photo)->resize(100, 100)->save(base_path('public/assets/images/union_profile/'.$fileName), 100);

            UnionInformation::find($id)->update([
                'brand_logo'      => $fileName
            ]);
        } else {
            UnionInformation::find($id)->update([
                'brand_logo'      => 'default_brand_logo.png'
            ]);
        }

        if ($request->hasFile('jolchap')){
            $photo = $request->jolchap;

            $fileExtension = $photo->getClientOriginalExtension();

            $fileName = 'jolchap_'.$request->union_code.'.'.$fileExtension;
            Image::make($photo)->resize(900, 900)->opacity(22)->save(base_path('public/assets/images/union_profile/'.$fileName), 100);

            UnionInformation::find($id)->update([
                'jolchap'      => $fileName
            ]);
        } else {
            UnionInformation::find($id)->update([
                'jolchap'      => 'default_jolchap.png'
            ]);
        }

        return $id;
    }

    //update union info
    public static function updateInfo($request)
    {
        $data = UnionInformation::where('union_code', Auth::user()->union_id)->update($request->except('_token', '_wysihtml5_mode','main_logo', 'brand_logo', 'jolchap', 'google_map', 'trade_generate'));
     
        $union = UnionInformation::where('union_code', Auth::user()->union_id)->first();

        // preselect update
        UnionInformation::whereId($union->id)->update([
            'pre_select'      => (($request->pre_select??0) === "on") ? 1 : 0
        ]);

        if ($request->google_map != null){
            $gmap = strval($request->google_map);

            UnionInformation::find($union->id)->update([
                'google_map'      => $gmap
            ]);
        }

        if ($request->hasFile('main_logo')){
            $photo = $request->main_logo;

            $fileExtension = $photo->getClientOriginalExtension();

            $fileName = 'main_logo_'.$union->union_code.'.'.$fileExtension;
            Image::make($photo)->resize(500, 500)->save(base_path('public/assets/images/union_profile/'.$fileName), 100);

            UnionInformation::find($union->id)->update([
                'main_logo'      => $fileName
            ]);
        } else {
            if ($union->main_logo == null){
                UnionInformation::find($union->id)->update([
                    'main_logo'      => 'default_main_logo.png'
                ]);
            }
        }

        if ($request->hasFile('brand_logo')){
            $photo = $request->brand_logo;

            $fileExtension = $photo->getClientOriginalExtension();

            $fileName = 'brand_logo_'.$union->union_code.'.'.$fileExtension;
            Image::make($photo)->resize(100, 100)->save(base_path('public/assets/images/union_profile/'.$fileName), 100);

            UnionInformation::find($union->id)->update([
                'brand_logo'      => $fileName
            ]);
        } else {
            if ($union->brand_logo == null){
                UnionInformation::find($union->id)->update([
                    'brand_logo'      => 'default_brand_logo.png'
                ]);
            }
        }

        if ($request->hasFile('jolchap')){
            $photo = $request->jolchap;

            $fileExtension = $photo->getClientOriginalExtension();

            $fileName = 'jolchap_'.$union->union_code.'.'.$fileExtension;
            Image::make($photo)->resize(900, 900)->opacity(22)->save(base_path('public/assets/images/union_profile/'.$fileName), 100);

            UnionInformation::find($union->id)->update([
                'jolchap'      => $fileName
            ]);
        } else {
            if ($union->jolchap == null){
                UnionInformation::find($union->id)->update([
                    'jolchap'      => 'default_jolchap.png'
                ]);
            }
        }

        // trade certificate generate settings option
        $settings = DB::table("settings")
                        ->where("options", "trade_generate")
                        ->where("union_id", Auth::User()->union_id)
                        ->get()->first();

        if(empty($settings)){   // insert
            DB::table("settings")->insert([
                "union_id" => Auth::User()->union_id,
                "options" => "trade_generate",
                "value" => $request->input('trade_generate', 1)
            ]);
        } else {    // update
            DB::table("settings")
                ->where("id", $settings->id)
                ->update([
                    "options" => "trade_generate",
                    "value" => $request->input('trade_generate', 1)
                ]);
        }

        // dd($settings);

        return $data;
    }

    // relationBetweenEmployee
    function relationBetweenEmployee()
    {
        return $this->hasOne('App\Models\Management\Employee\Employee','union_id','union_code');
    }
}
