<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitizenInformation extends Model
{
    //get citizen by union id
    public static function getCitizenInNid($unionId)
    {
        $data = CitizenInformation::select('name_bn', 'name_en', 'father_name_bn', 'father_name_en', 'permanent_ward_no', 'gender')->where('union_id', $unionId)->where('is_active', 1)->whereNull('deleted_at')->orderBy('permanent_ward_no', 'asc')->get();
        return $data;
    }
}
