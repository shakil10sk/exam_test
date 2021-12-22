<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable = [
        'union_id', 'name', 'is_current', 'expire_date', 'is_active', 'created_by', 'updated_by', 'created_by_ip',
        'updated_by_ip', 'created_time', 'updated_time'
    ];

    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->is_process = 0;
        });
    }
}
