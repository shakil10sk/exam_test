<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillGenerate extends Model
{

    public static function generateID()
    {
        $invoice_id = date('ym');

        $invoice_id .= Auth::user()->union_id;

        $total = DB::table('acc_invoice')->where('union_id', Auth::user()->union_id)->count() ?? 0;

        $total += 1; // 1


        if (strlen($total) < 5) {
            $invoice_id .= str_repeat('0', (5 - strlen($total))) . $total;
        } else {
            $invoice_id .= $total;
        }


        return $invoice_id;


    }

    public static function list_data($recieve)
    {
        $searchingItem = $recieve->search['value'] ?? null;

        $data = DB::table('acc_invoice AS INV')
            ->select(DB::raw("INV.*"), 'MOL.name AS owner_name', 'MOL.mobile_no', 'MSL.name AS shop_name')
            ->Join('market_owner_list AS MOL', function ($join) use ($recieve) {
                $join->on('MOL.id', '=', 'INV.owner_id')
                    ->when($recieve['market_id'] > 0, function ($q) use ($recieve) {
                        $q->where('MOL.market_id',$recieve['market_id']);
                    })
                    ->whereNull('MOL.deleted_at')
                    ->whereNull('INV.deleted_at');
            })
            ->Join('market_shop_list AS MSL', function ($join) {
                $join->on('MSL.id', '=', 'MOL.shop_id')
                    ->on('MSL.union_id', '=', 'MOL.union_id');
            })
            ->when($recieve['year_id'] > 0, function ($q) use ($recieve) {
                $q->where('INV.year_id',$recieve['year_id']);
            })
            ->when($recieve['month_id'] > 0, function ($q) use ($recieve) {
                $q->where('INV.month_id',$recieve['month_id']);
            })
            ->when($recieve['market_id'] > 0, function ($q) use ($recieve) {
                $q->where('MOL.market_id',$recieve['market_id']);
            })
            ->when(isset($searchingItem), function ($q) use ($searchingItem) {
                $q->where(function ($query) use ($searchingItem){
                    $query->where('MSL.name','LIKE','%'.$searchingItem.'%')
                        ->orWhere('INV.invoice_id','LIKE','%'.$searchingItem.'%')
                        ->orWhere('MOL.mobile_no','LIKE','%'.$searchingItem.'%')
                        ->orWhere('MOL.name','LIKE','%'.$searchingItem.'%');
                });
            })
            ->where('INV.union_id',Auth::user()->union_id)
            ->whereNull('INV.deleted_at')
            ->orderBy('INV.invoice_id','ASC')
            ->get();
        return $data;
    }


    public static function invoice_data($invoice_id){
       $data = DB::table('acc_invoice AS INV')
           ->select(DB::raw("INV.*"), 'MOL.name AS owner_name', 'MOL.address', 'MSL.name AS shop_name')
            ->Join('market_owner_list AS MOL',function($join) {
                $join->on('MOL.id','=','INV.owner_id')
                    ->on('MOL.union_id','=','INV.union_id')
                    ->whereNull('MOL.deleted_at')
                    ->whereNull('INV.deleted_at');
            })
            ->Join('market_shop_list AS MSL',function($join) {
                $join->on('MSL.id','=','MOL.shop_id')
                    ->on('MSL.union_id','=','MOL.union_id')
                    ->whereNull('MSL.deleted_at')
                    ->whereNull('MOL.deleted_at');
            })
            ->where('INV.invoice_id',$invoice_id)
            ->whereNull('INV.deleted_at')
            ->first();
       return $data;
    }

}
