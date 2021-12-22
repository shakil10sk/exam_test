<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['id', 'union_id', 'title', 'file', 'type', 'is_active', 'created_time', 'created_by', 'created_by_ip', 'updated_time', 'updated_by', 'updated_by_ip', 'created_at'];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }
}
