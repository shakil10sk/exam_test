<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $fillable = ['union_id', 'allowance_id', 'name', 'nid', 'photo', 'father_name', 'date_of_birth', 'mobile', 'village', 'ward_no', 'bio', 'type', 'is_active', 'amount_of_allowance', 'sector_no', 'health_condition', 'economical_condition', 'educational_qualification', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip', 'deleted_at'];

    //get allowance by type
    public static function getAllowanceByType($type, $unionId)
    {
        $data = Allowance::where('union_id', $unionId)->where('type', $type)->whereNull('deleted_at')->orderBy('created_at', 'asc')->get();
        return $data;
    }
}
