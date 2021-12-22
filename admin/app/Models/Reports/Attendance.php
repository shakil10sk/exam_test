<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';

}
