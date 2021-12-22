<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'application';

    protected $fillable = ['union_id', 'fiscal_year_id', 'pin', 'tracking', 'status', 'type', 'present_upazila_id', 'present_postoffice_id', 'present_district_id', 'present_village_bn', 'present_village_en', 'present_rbs_bn', 'present_rbs_en', 'present_holding_no', 'present_ward_no', 'comment_bn', 'comment_en', 'is_active', 'is_process', 'deleted_at', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip',];
    
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';
}
