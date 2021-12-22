<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    protected $table = 'business_type';

    protected $fillable = ['id', 'union_id', 'name_bn', 'name_en', 'is_active', 'created_by', 'updated_by', 'created_time', 'updated_time', 'created_by_ip', 'updated_by_ip'];
}
