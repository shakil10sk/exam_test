<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnionInformation extends Model
{
    protected $table = 'union_information';

    protected $fillable = ['district_id', 'upazila_id', 'postal_id', 'union_code', 'en_name', 'bn_name', 'postal_code', 'village_bn', 'village_en', 'email', 'mobile', 'telephone', 'sub_domain', 'main_logo', 'brand_logo', 'jolchap', 'is_header_active', 'status', 'about', 'google_map', 'deleted_at', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip',];
}
