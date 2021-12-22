<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    protected $table = 'asset_register';

    protected $fillable = ['id', 'union_id', 'asset_name_point', 'create_buy_date', 'rate', 'stock_source', 'last_care_date', 'expence_amount', 'care_expense_source', 'next_care_date', 'file', 'comment', 'type', 'is_active', 'created_by_ip', 'updated_by_ip', 'created_time', 'created_by', 'updated_time', 'updated_by'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::updating(function ($query) {
            $query->updated_time = $query->freshTimestamp();
        });
    }
}
