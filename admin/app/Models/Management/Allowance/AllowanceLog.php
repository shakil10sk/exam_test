<?php

namespace App\Models\Management\Allowance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use DB, Request;
use Carbon\Carbon;

class AllowanceLog extends Model
{
    protected $fillable = ['name', 'allowance_id', 'union_id', 'description', 'allowance_date', 'type', 'is_active', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    use SoftDeletes;

    //store allowance log
    public static function store($request)
    {
        $res = AllowanceLog::create($request->except('_token'));
        if($res){
            return true;
        }else{
            return false;
        }
    }

    //get allowance log
    public static function getAllowance($id, $type)
    {
        $res = AllowanceLog::where('allowance_id', $id)->where('union_id', auth()->user()->union_id)->where('type', $type)->where('is_active', 1)->whereNull('deleted_at')->get();
        return $res;
    }
}
