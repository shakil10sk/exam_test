<?php

namespace App\Models\Management\Info;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Notice extends Model
{
    protected $fillable = ['title', 'union_id', 'details', 'document','type', 'created_by', 'updated_by', 'created_by_ip',
        'updated_by_ip'];

    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->is_process = 0;
        });

        static::deleting(function ($query) {
            $query->is_process = 0;
            $query->deleted_at = $query->freshTimestamp();

        });
    }

    //create notice
    public static function store($request)
    {



        $id = Notice::create($request->except('_token', '_wysihtml5_mode', 'document'))->id;

        if($request->hasFile('document')){
            $file = $request->document;
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = Auth::user()->union_id.$id.'.'.$fileExtension;
            $res = move_uploaded_file($request->document, base_path('public/assets/files/notice/'.$fileName));
            if ($res){
                Notice::find($id)->update([
                    'document'      => $fileName
                ]);
            }
        }
        return $id;
    }

    //get notices
    public static function getNotice($request, $searchContent)
    {
        DB::enableQueryLog();

        $query = DB::table('notices As NT')
            ->join('users As USER1','NT.created_by', '=','USER1.employee_id')
            ->leftjoin('users As USER2','NT.updated_by', '=','USER2.employee_id')
            ->select('NT.*','USER1.name AS post_by', 'USER2.name AS update_by')
            ->where('NT.union_id', '=', Auth::user()->union_id)
            ->whereDate('NT.created_at', '>=', $request->fromDate)
            ->whereDate('NT.created_at', '<=', $request->toDate)
            ->limit($request->limit)
            ->whereNull('NT.deleted_at')
            ->latest();


        //for searching on page
        if($searchContent != false){

            $query->where(function ($query) use ($searchContent) {
                return $query->where("NT.title", "LIKE", "%".$searchContent."%")
                    ->orWhere("NT.created_at", "LIKE", $searchContent)
                    ->orWhere("NT.details", "LIKE", "%".$searchContent."%");
            });
        }

        $data['data'] = $query->get();

        return $data;
    }

    //update notice
    public static function updated($request)
    {
        $id = Notice::find($request->id)->update($request->except('_token', '_wysihtml5_mode', 'document'));

        if($request->hasFile('document')){
            $file = $request->document;
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = Auth::user()->union_id.$request->id.'.'.$fileExtension;
            $res = move_uploaded_file($request->document, base_path('public/assets/files/notice/'.$fileName));
            if ($res){
                Notice::find($request->id)->update([
                    'document'      => $fileName
                ]);
            }
        }
        return $id;
    }
}
