<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $fillable = [
        'sonod_type',
        'bank_name',
        'bank_branch',
        'account_num',
        'bank_branch_address'
    ];
}
