<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = ['id', 'union_id', 'record_id', 'attendance_date', 'login_time', 'logout_time', 'created_by', 'updated_by', 'created_time', 'updated_time', 'created_by_ip', 'updated_by_ip',];

    public $timestamps = false;
    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }

    public function employee()
    {
        return $this->hasOne(\App\Models\Employee::class, 'device_id', 'record_id');
    }
}
