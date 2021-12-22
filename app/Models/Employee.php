<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $fillable = ['employee_id', 'union_id', 'device_id', 'nid', 'email', 'name', 'designation_id', 'gender', 'marital_status', 'date_of_birth', 'qualification', 'join_date', 'photo', 'election_area', 'mobile', 'address', 'district_id', 'upazila_id', 'postal_id', 'sequence', 'messages', 'is_active', 'status', 'deleted_at', 'created_by', 'updated_by', 'created_at', 'updated_at', 'created_by_ip', 'updated_by_ip'];

    use SoftDeletes; /* where not null will be cehceked auto */

    //get employees
    public static function getEmployees($unionId)
    {
//        $data = Employee::where('union_id', $unionId)->where('status', 1)->orderBy('sequence', 'asc')->get();

        $data = Employee::where('union_id', $unionId)
            ->Join('designation AS DS', 'employees.designation_id','=','DS.id' )
            ->where('status', 1)
            ->whereNull('deleted_at')->orderBy('designation_id', 'asc')->orderBy('sequence', 'asc')
            ->select('employees.*','DS.name as designation_name')
            ->get();
        return $data;
    }

    //get employee
    public static function getEmployee($id, $unionId)
    {
        $data = DB::table('employees AS EMP')
            ->join('bd_locations AS LOC1','EMP.district_id', '=','LOC1.id')
            ->join('bd_locations AS LOC2','EMP.upazila_id', '=','LOC2.id')
            ->join('bd_locations AS LOC3','EMP.postal_id', '=', 'LOC3.id')
            ->join('designation AS DES','EMP.designation_id', '=', 'DES.id')
            // ->join('users AS US','EMP.employee_id', '=', 'US.employee_id')
            ->select('EMP.*',/* 'US.name AS username', */ 'LOC1.bn_name AS district','LOC2.bn_name AS upazila', 'LOC3.bn_name AS post_office','DES.name as designation_name')
            ->where([
                ['EMP.union_id', '=', $unionId],
                ['EMP.employee_id', '=', $id],
            ])
            ->first();
        return $data;
    }

}
