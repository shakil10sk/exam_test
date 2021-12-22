<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BdLocation extends Model
{
    protected $fillable = ['id','parent_id', 'en_name', 'bn_name', 'post_code', 'web', 'type'];

    public $timestamps = false;
}
