<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    protected $table = "asset_register";

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';
}
