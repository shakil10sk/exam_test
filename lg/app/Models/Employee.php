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
        $data = Employee::where('union_id', $unionId)->where('status', 1)->orderBy('sequence', 'asc')->get();
        return $data;
    }

    //get employee
    public static function getEmployee($id, $unionId)
    {
        $data = DB::table('employees AS EMP')
          
            ->select('EMP.*')
            ->where([
                ['EMP.union_id', '=', $unionId],
                ['EMP.id', '=', $id],
            ])
            ->first();
        return $data;
    }

}
