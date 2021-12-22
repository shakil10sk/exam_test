<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    protected $table = 'business_type';

    protected $fillable = ['union_id', 'name_bn', 'name_en', 'is_active', 'is_process', 'created_by', 'updated_by', 'created_time', 'updated_time', 'created_by_ip', 'updated_by_ip'];

    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->is_process = 0;
        });
    }
}
