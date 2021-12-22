<?php

namespace App\Models\Committee;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $table = "committee";

    protected $fillable = ['id', 'union_id', 'committee_name', 'committee_step', 'ward_no', 'is_active', 'is_process', 'created_time', 'created_by', 'created_by_ip', 'updated_time', 'updated_by', 'updated_by_ip'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }
}
