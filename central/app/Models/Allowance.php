<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnionInformation;


class Allowance extends Model
{
    protected $fillable = ['union_id', 'allowance_id', 'name', 'nid', 'photo', 'father_name', 'date_of_birth', 'mobile', 'village', 'ward_no', 'bio', 'type', 'is_active', 'amount_of_allowance', 'sector_no', 'health_condition', 'economical_condition', 'educational_qualification', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip', 'deleted_at', 'created_at',];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_at = $query->freshTimestamp();
        });
    }
}
