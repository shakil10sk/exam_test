<?php

namespace App\Models\Committee;

use Illuminate\Database\Eloquent\Model;

class ComMember extends Model
{
    protected $table = "com_member";

    protected $fillable = ['id', 'union_id', 'committee_id', 'name', 'designation', 'mobile', 'email', 'nid', 'social_status', 'address', 'is_active', 'created_time', 'created_by', 'created_by_ip', 'updated_time', 'updated_by', 'updated_by_ip'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }

}
