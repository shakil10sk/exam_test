<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designation';

    protected $fillable = [
        'id','name', 'is_system', 'is_active','created_by','created_at','created_by_ip','updated_by','updated_at','updated_by_ip'
    ];
}
