<?php

namespace App\Models\Accounts;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;



class Settings extends Model
{
    use SoftDeletes;

    //====account save====//
    public function account_save($request)
    {



        if($request->head_type > 0){

            //get account code
            $query = DB::table('acc_account')
                ->select('account_code')
                ->where('id', $request->head_type)
                ->first();


            //get last acc_type
            $acc_query = DB::table('acc_account')
                ->where('acc_type', '!=', NULL)
                ->where('union_id', Auth::user()->union_id)
                ->orderBy('acc_type', 'DESC')
                ->first();

            $head_code = $query->account_code;


            $acc_type = ( (int) $acc_query->acc_type > 107)  ?  $acc_query->acc_type + 1 : 108 ;

        }else{
            $head_code = NULL;
            $acc_type = NULL;
        }





        //accounts data
        $account_data = [

            'parent_id'         => ($request->head_type > 0) ? $request->head_type : 'NULL',
            'account_name'      => $request->account_name,
            'account_code'      => $request->account_code,
            'head_type'         => $head_code,
            'acc_type'          => $acc_type,
            'union_id'          => $request->union_id,
            'created_by'        => Auth::user()->employee_id,
            'created_time'      => Carbon::now(),
            'created_by_ip'     => Request::ip(),

        ];

        //ready transection data
        $transaction_data = [

            'union_id'          => $request->union_id,
            'fiscal_year_id'    => $request->fiscal_year_id,
            'voucher'           => $request->voucher,
            'amount'            => $request->opening_balance,
            'comment'           => 'Openning Balance',
            'type'              => $acc_type,
            'balance_type'      => 1,
            'created_by'        => Auth::user()->employee_id,
            'created_time'      => date('Y-m-y h:i:s'),
            'created_by_ip'     => Request::ip(),

        ];



        DB::beginTransaction();

        try {

            //account table data insert
            DB::table("acc_account")->insert($account_data);

            //get account last insert id or primary id
            $account_id = DB::getPdo()->lastInsertId();

            //if set opening balance
            if($request->opening_balance > 0){

                //push account id in credit
                $transaction_data['credit'] = $account_id;

                //insert transectin data
                DB::table("acc_transaction")->insert($transaction_data);
            }

            DB::commit();


            return ["status" => "success", "message" => "একাউন্ট টি সফলভাবে যুক্ত হয়েছে"];

        } catch (\Exception $e) {

            DB::rollback();

            return ["status" => "error", "message" => "একাউন্ট টি যুক্ত হয়নি"];

        }

    }

    //======account update====//

    public function update_account($receive)
    {


        //existing where
        $where = [

            'account_name' => $receive->account_name,
            'account_code' => $receive->account_code,
            'union_id' => $receive->union_id,
            'is_active' => 1,
        ];

        // existing check query
        $query = DB::table('acc_account')
            ->where($where)
            ->where('id', '!=', $receive->row_id)
            ->count();

        //existing check and return
        if ($query > 0) {

            return ['status' => 'error', 'message' => 'আপনার একাউন্ট আগে তৈরী করা আছে।'];

            exit;
        }

        if($receive->head_type > 0){

            //get account code
            $query = DB::table('acc_account')
                ->select('account_code')
                ->where('id', $receive->head_type)
                ->first();

            $head_code = $query->account_code;

        }else{
            $head_code = NULL;
        }





        //accounts data
        $account_data = [

            'parent_id'         => ($receive->head_type > 0) ? $receive->head_type : 'NULL',
            'account_name'      => $receive->account_name,
            'account_code'      => $receive->account_code,
            'head_type'         => $head_code,
            'updated_by'        => Auth::user()->employee_id,
            'updated_time'      => Carbon::now(),
            'updated_by_ip'     => Request::ip(),

        ];

        //ready transection data
        $transaction_data = [

            'amount'            => $receive->opening_balance,
            'comment'           => 'Openning Balance',
            'balance_type'      => 1,
        ];


        DB::beginTransaction();

        try {

            //update query
            DB::table('acc_account')
                ->where('id', '=', $receive->row_id)
                ->update($account_data);

            if($receive->transection_id > 0 && $receive->opening_balance > 0){

                $transaction_data['updated_by'] = Auth::user()->employee_id;
                $transaction_data['updated_time'] = date('Y-m-y h:i:s');
                $transaction_data['updated_by_ip'] = Request::ip();

                DB::table('acc_transaction')
                    ->where('id', '=', $receive->transection_id)
                    ->update($transaction_data);

            }

            if($receive->opening_balance > 0 && $receive->transection_id < 0){

                $transaction_data['created_by'] = Auth::user()->employee_id;
                $transaction_data['created_time'] = date('Y-m-y h:i:s');
                $transaction_data['created_by_ip'] = Request::ip();
                //push account id in credit
                $transaction_data['credit'] = $receive->row_id;

                //insert transection data
                DB::table("acc_transaction")->insert($transaction_data);

            }

            DB::commit();


            return ["status" => "success", "message" => "সফলভাবে আপডেট করা হয়েছে"];

        } catch (\Exception $e) {

            DB::rollback();

            return ["status" => "error", "message" => "একাউন্ট টি আপডেট হয়নি"];

        }



    }


    //===account applicant list data=====//

    public function account_list_data($receive, $search_content)
    {

        DB::enableQueryLog();

        $query = DB::table('acc_account AS ACC')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS ACC.id'), 'ACC.id', 'ACC.account_name', 'ACC.account_code', 'ACC.acc_type', 'ACC.head_type', 'ACC.parent_id', 'TRNS.amount', 'TRNS.id as transection_id')

            ->leftJoin('acc_transaction AS TRNS', function ($join) {

                $join->on("TRNS.credit", "=", "ACC.id")

                    ->where("TRNS.balance_type", "=", 1);

                })

            ->where([

                ['ACC.is_active', '=', 1],
                ['ACC.union_id', '=', Auth::user()->union_id],
            ])

            ->offset($receive['start'])
            ->limit($receive['limit'])
            ->orderBy('ACC.id', 'DESC');


        //for searching on page
        if($search_content != false){

            $query->Where("ACC.union_id", "LIKE", $search_content)
                    ->orWhere("ACC.account_name", "LIKE", $search_content);
        }

        $data['data'] = $query->get();

        return $data;
    }

     //===account info delete===//
    public function account_delete($receive)
    {

        $delete =  DB::table('acc_account')
            ->where([
                ['id',$receive->id],
                ['union_id',$receive->union_id],
            ])
            ->update(['created_by' => Auth::User()->id, 'updated_by' => Request::ip(), 'updated_time' => Carbon::now(), 'is_active' => 0]);

         return ['status' => 'ডিলিট করা হয়েছে।'];
    }

    //for fund list data
    public function fund_list_data($receive, $search_content)
    {

        DB::enableQueryLog();

        $query = DB::table('acc_account AS ACC')

            ->select(DB::raw('SQL_CALC_FOUND_ROWS ACC.id'), 'ACC.id', 'ACC.account_name', 'ACC.account_code', 'ACC.acc_type', 'ACC.head_type', 'ACC.parent_id', 'TRNS.amount', 'TRNS.id as transection_id', 'TRNS.created_time', 'TRNS.comment')

            ->Join('acc_transaction AS TRNS', function ($join) {

                $join->on("TRNS.credit", "=", "ACC.id")

                    ->where("TRNS.balance_type", "=", 2);

                })

            ->where([

                ['ACC.union_id', '=', auth()->user()->union_id],
                ['ACC.is_active', '=', 1],
            ])

            ->offset($receive['start'])
            ->limit($receive['limit'])
            ->orderBy('ACC.id', 'DESC');


        //for searching on page
        if($search_content != false){

            $query->Where("ACC.union_id", "LIKE", $search_content)
                    ->orWhere("ACC.account_name", "LIKE", $search_content);
        }

        $data['data'] = $query->get();

        return $data;
    }





}
