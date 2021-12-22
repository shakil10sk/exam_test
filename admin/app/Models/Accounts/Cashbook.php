<?php

namespace App\Models\Accounts;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use App\Models\Global_model;



class Cashbook extends Model
{

    //get generel cashbook data
    public function generel_cashbook_data($union_id = null, $from_date = null, $to_date = null, $discount_id = NULL){


        $trade_discount_query = DB::table('acc_account AS ACT')
        ->select(DB::raw('sum(TRNS.amount) as total_discount'), 'TRNS.created_time', 'ACT.account_name', 'TRNS.debit', 'TRNS.credit', 'TRNS.type')
        ->join('acc_transaction AS TRNS', function($join) use($union_id) {

            $join->on('TRNS.union_id', '=', 'ACT.union_id')
                    ->on('TRNS.credit', '=', 'ACT.id')
                    ->where('TRNS.is_active', '=', 1);
        })
        ->where('TRNS.union_id', '=', $union_id)
        ->where('TRNS.type', '=', 19)
        ->where('TRNS.credit', '=', $discount_id)
        ->whereDate('TRNS.created_time', '>=', $from_date)
        ->whereDate('TRNS.created_time', '<=', $to_date)
        ->groupBy('TRNS.credit')
        ->first();

        $bosotbita_discount_query = DB::table('acc_account AS ACT')
        ->select(DB::raw('sum(TRNS.amount) as total_discount'), 'TRNS.created_time', 'ACT.account_name', 'TRNS.debit', 'TRNS.credit', 'TRNS.type')
        ->join('acc_transaction AS TRNS', function($join) use($union_id) {

            $join->on('TRNS.union_id', '=', 'ACT.union_id')
                    ->on('TRNS.credit', '=', 'ACT.id')
                    ->where('TRNS.is_active', '=', 1);
        })
        ->where('TRNS.union_id', '=', $union_id)
        ->where('TRNS.type', '=', 29)
        ->where('TRNS.credit', '=', $discount_id)
        ->whereDate('TRNS.created_time', '>=', $from_date)
        ->whereDate('TRNS.created_time', '<=', $to_date)
        ->groupBy('TRNS.credit')
        ->first();

        // dd($bosotbita_discount_query);

        if(empty($bosotbita_discount_query)){
            $bosotbita_discount = 0;
        }else{
            $bosotbita_discount = $bosotbita_discount_query->total_discount;
        }

        if(empty($trade_discount_query)){
            $trade_discount = 0;
        }else{
            $trade_discount = $trade_discount_query->total_discount;
        }

        //get income data
        $income_query = DB::table('acc_account AS ACT')

            ->select(DB::raw('sum(TRNS.amount) as total_income'), 'TRNS.created_time', 'ACT.account_name', 'TRNS.debit', 'TRNS.credit', 'TRNS.type')

            ->join('acc_transaction AS TRNS', function($join) use($union_id, $discount_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.credit', '=', 'ACT.id')
                        ->where('TRNS.credit', '!=', $discount_id)
                        ->where('TRNS.is_active', '=', 1);
            })
            ->where('TRNS.union_id', '=', $union_id)
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->groupBy('TRNS.credit')
            ->groupBy('TRNS.type')
            ->get();
        

        $income = [];

        foreach($income_query as $item){

            if($trade_discount > 0 && $item->type == 19){
                $amount = $item->total_income - $trade_discount;
            }else{
                $amount = $item->total_income;
            }

            if($bosotbita_discount > 0 && $item->type == 29){
                $amount = $item->total_income - $bosotbita_discount;
            }else{
                $amount = $item->total_income;
            }

            $income[] = [
                "account_name" => $item->account_name,
                "total_income" => $amount,
                "debit" => $item->debit,
                "credit" => $item->credit,
            ];
            
        }

        $data['income'] = $income;
        

        // dd($data);
          

        //get expense data
        $expense_query = DB::table('acc_account AS ACT')

            ->select(DB::raw('sum(TRNS.amount) as total_expense'), 'TRNS.created_time', 'ACT.account_name', 'TRNS.type', 'TRNS.credit', 'TRNS.debit', 'ACT.acc_type')

            ->join('acc_transaction AS TRNS', function($join) use($union_id, $discount_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.debit', '=', 'ACT.id')
                        ->where('TRNS.credit', '!=', $discount_id)
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            // ->where('ACT.head_type', '!=', 101)
            // ->groupBy('TRNS.debit')
            ->groupBy('TRNS.type')
            ->get()->toArray();


        $expense = [];

        foreach($expense_query as $item){

            $expense[] = [
                "account_name" => $item->account_name,
                "total_expense" => $item->total_expense,
                "debit" => $item->debit,
                "credit" => $item->credit,
            ];
            
        }
    
        $data['expense'] = $expense;

        // dd($data);
    
        return $data;

    }

    //lgsp cashbook data
    
    public function lgsp_cashbook_data($union_id = null, $from_date = null, $to_date = null){

        //get income data
        $data['income'] = DB::table('acc_account AS ACT')

            ->select( 'TRNS.amount', 'TRNS.comment', 'TRNS.created_time', 'TRNS.comment', 'ACT.account_name') //DB::raw('sum(TRNS.amount) as total_income'),
            
            ->join('acc_transaction AS TRNS', function($join) use($union_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.credit', '=', 'ACT.id')
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->where(['ACT.is_active' => 1, 'ACT.acc_type' => 33]) //cause lgsp acc_type = 83 
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();
        
        // dd(DB::getQueryLog());

        //get expense data
        $data['expense'] = DB::table('acc_account AS ACT')

            ->select('TRNS.amount', 'TRNS.comment', 'TRNS.created_time', 'TRNS.comment', 'ACT.account_name') //DB::raw('sum(TRNS.amount) as total_expense'),

            ->join('acc_transaction AS TRNS', function($join) use($union_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.debit', '=', 'ACT.id')
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->where(['ACT.is_active' => 1, 'ACT.acc_type' => 33]) //cause lgsp acc_type = 83 
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();

    
        return $data;

    }


    //sthabor asset 1%
    public function sthabor_cashbook_data($union_id = null, $from_date = null, $to_date = null){

        DB::enableQueryLog();

        //get income data
        $data['income'] = DB::table('acc_account AS ACT')

            ->select( 'TRNS.amount', 'TRNS.comment', 'TRNS.created_time', 'TRNS.comment', 'ACT.account_name') //DB::raw('sum(TRNS.amount) as total_income'),
            
            ->join('acc_transaction AS TRNS', function($join) use($union_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.credit', '=', 'ACT.id')
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->where(['ACT.is_active' => 1, 'ACT.acc_type' => 83]) //cause sthabor 1% acc_type = 83 
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();
        
        // dd(DB::getQueryLog());

        //get expense data
        $data['expense'] = DB::table('acc_account AS ACT')

            ->select('TRNS.amount', 'TRNS.comment', 'TRNS.created_time', 'TRNS.comment', 'ACT.account_name') //DB::raw('sum(TRNS.amount) as total_expense'),

            ->join('acc_transaction AS TRNS', function($join) use($union_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.debit', '=', 'ACT.id')
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->where(['ACT.is_active' => 1, 'ACT.acc_type' => 83]) //cause sthabor 1% acc_type = 83 
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();

    
        return $data;

    }


    //birth die cashbook data
    public function birth_die_cashbook_data($union_id = null, $from_date = null, $to_date = null){

        DB::enableQueryLog();

        //get income data
        $data['income'] = DB::table('acc_account AS ACT')

            ->select( 'TRNS.amount', 'TRNS.comment', 'TRNS.created_time', 'TRNS.comment', 'ACT.account_name') //DB::raw('sum(TRNS.amount) as total_income'),
            
            ->join('acc_transaction AS TRNS', function($join) use($union_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.credit', '=', 'ACT.id')
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->where(['ACT.is_active' => 1, 'ACT.acc_type' => 30, 'ACT.acc_type' => 87]) //cause birth account acc_type = 30 and die account acc_type = 87 
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();
        
        // dd(DB::getQueryLog());

        //get expense data
        $data['expense'] = DB::table('acc_account AS ACT')

            ->select('TRNS.amount', 'TRNS.comment', 'TRNS.created_time', 'TRNS.comment', 'ACT.account_name') //DB::raw('sum(TRNS.amount) as total_expense'),

            ->join('acc_transaction AS TRNS', function($join) use($union_id) {

                $join->on('TRNS.union_id', '=', 'ACT.union_id')
                        ->on('TRNS.debit', '=', 'ACT.id')
                        ->where('TRNS.is_active', '=', 1);
            })

            ->where('TRNS.union_id', '=', $union_id)
            ->where(['ACT.is_active' => 1, 'ACT.acc_type' => 30, 'ACT.acc_type' => 87]) //cause birth account acc_type = 30 and die account acc_type = 87 
            ->whereDate('TRNS.created_time', '>=', $from_date)
            ->whereDate('TRNS.created_time', '<=', $to_date)
            ->get();

    
        return $data;

    }
    
    

}
