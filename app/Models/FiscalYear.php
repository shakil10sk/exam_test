<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable = [
        'id', 'union_id', 'name', 'is_current', 'is_active','expire_date', 'created_by', 'updated_by', 'created_time', 'updated_time', 'created_by_ip', 'updated_by_ip'
    ];
}
