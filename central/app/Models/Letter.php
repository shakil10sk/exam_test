<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = ['id', 'union_id', 'accept_send_date', 'acc_send_no_date', 'office', 'description', 'repley_no_date', 'file', 'comment', 'type', 'is_active', 'created_by', 'created_time', 'updated_time', 'updated_by'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }
}
