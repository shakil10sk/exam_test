<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['id', 'union_id', 'title', 'description', 'pre_photo', 'final_photo', 'file', 'descrip', 'status', 'is_active', 'is_process', 'entry_date', 'deleted_at', 'created_by', 'created_by_ip', 'created_time', 'updated_time', 'updated_by', 'updated_by_ip'];


    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }
}
