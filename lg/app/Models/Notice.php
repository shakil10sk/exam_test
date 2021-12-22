<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    protected $fillable = ['id','title', 'union_id', 'details', 'document','deleted_at', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    //get notices
    public static function getNotices($unionId)
    {
        return Notice::where('union_id', $unionId)->whereNull('deleted_at')->latest()->simplePaginate(10);
    }
}