<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    protected $fillable = ['id','title', 'caption', 'photo', 'sequence', 'union_id', 'status', 'deleted_at', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    //get slides
    public static function getSlider($unionId)
    {
        $data = Slide::where('union_id', $unionId)->where('status', 1)->whereNull('deleted_at')->orderBy('sequence', 'asc')->get();
        return $data;
    }
}
