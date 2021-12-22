<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillCollection extends Model
{
    public static function getThreeMonthDueOwnerInfo()
    {

        $owner_info = DB::table('acc_invoice AS INV')
            ->Join('market_owner_list AS MOL', function ($join) {
                $join->on('INV.owner_id', '=', 'MOL.id')
                    ->on('MOL.union_id', 'INV.union_id');
            })
            ->where('INV.union_id', Auth::user()->union_id)
            ->where('INV.is_paid', 0) // 0 = unpaid
            ->whereNull('INV.deleted_at')
            ->select('MOL.id', 'MOL.name', 'MOL.mobile_no', DB::raw('COUNT(is_paid) AS unpaid'))
            ->groupBy('owner_id')
            ->get();



        $due_owner_info = [];


        foreach ($owner_info as $item) {

            if ( (int) $item->unpaid >= 3)
            {
                $due_owner_info[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'mobile_no' => $item->mobile_no,
                    'due_month' =>$item->unpaid
                ];
            }

        }

        return $due_owner_info;
    }
}
