<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificate';

    protected $fillable = ['pin', 'tracking', 'sonod_no', 'union_id', 'upazila_id', 'district_id', 'type', 'fiscal_year_id', 'expire_date', 'due_fiscal_year', 'status', 'is_active', 'is_process', 'created_by', 'updated_by', 'created_time', 'updated_time', 'created_by_ip', 'updated_by_ip'];

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';
}
