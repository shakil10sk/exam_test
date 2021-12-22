<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['employee_id', 'union_id', 'device_id', 'nid', 'email', 'name', 'designation_id', 'gender', 'marital_status', 'date_of_birth', 'qualification', 'join_date', 'photo', 'election_area', 'mobile', 'address', 'postal_id', 'sequence', 'messages', 'is_active', 'status', 'deleted_at', 'created_by', 'updated_by', 'created_at', 'updated_at', 'created_by_ip', 'updated_by_ip'];

    public function union()
    {
        return $this->hasOne(\App\Models\UnionInformation::class, 'union_code', 'union_id');
    }

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_at = $query->freshTimestamp();
        });
    }
}
