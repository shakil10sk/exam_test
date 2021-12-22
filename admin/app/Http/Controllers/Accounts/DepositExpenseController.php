<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Accounts\Settings;
use App\Models\Accounts\Accounts;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDF;

use Illuminate\Support\Facades\Response;

use function GuzzleHttp\json_encode;

class DepositExpenseController extends Controller
{
    public function acc_subcategory(Request $request){

        return DB::table('acc_account')
        ->where(['parent_id' => $request->id, 'union_id' => Auth::user()->union_id])
        ->get();

    }

    //get account total balance 
    public function account_balance(Request $r){

        $credit = DB::table('acc_transaction')->select(DB::raw('SUM(amount) as credit'))
                    ->where([
                        'credit'=>$r->id,
                        'union_id'=>auth()->user()->union_id
                    ])->first()->credit;

        $debit = DB::table('acc_transaction')->select(DB::raw('SUM(amount) as debit'))
                    ->where([
                        'debit'=>$r->id,
                        'union_id'=>auth()->user()->union_id
                    ])->first()->debit;

        $amount =(int) $credit - (int) $debit;

        return $amount;
    }
    
    //daily deposit
    public function daily_deposit(){
 
        $data = DB::table('acc_account')
            ->where(['parent_id' =>  NULL, 'union_id' => Auth::user()->union_id])
            ->orderby('id', 'DESC')
            ->get();

        return view('accounts.deposit_expense.daily_deposit')->with('data', $data);

    }

    //daily expense
    public function daily_expense(){
 
        $data = DB::table('acc_account')->where('parent_id', '=', NULL)->where('union_id', Auth::user()->union_id)->orderby('id', 'DESC')->get();

        return view('accounts.deposit_expense.daily_expense')->with('data', $data);

    }

    //daily deposit save
    public function daily_deposit_save(Request $request){


        $validator = Validator::make($request->all(), [
            'from_category' => ['required'],
            'to_category' => ['required'],
            'amount' => ['required'],
            'transfer_date' => ['required'],
        ],

        [
            "from_category.required" => "প্রধান খাত দিতে হবে",
            "to_category.required" => "প্রধান জমা খাত দিতে হবে",
            "amount.required" => "টাকার পরিমান দিন",
            "transfer_date.required" => "তারিখ দিন",
        ]
        );


        // dd($validator->errors());
        if ($validator->passes()) {

            $text = ($request->type == 1) ? 'জমা' : 'খরচ';

            //get union id
            $union_id = Auth::user()->union_id;

            //get current fiscal year id
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);


            $generate = new IdGenerate();

            //create voucher no
            $voucher_no = $generate->voucher($union_id, $fiscal_year_id);

            $credit = ($request->to_subcategory > 0) ? $request->to_subcategory : $request->to_category;
            
            $debit = ($request->from_subcategory > 0) ? $request->from_subcategory : $request->from_category;


            $data = [
                'union_id' => $union_id,
                'fiscal_year_id' => $fiscal_year_id,
                'voucher' => $voucher_no,
                'amount' => $request->amount,
                'credit' => $credit,
                'debit' => $debit,
                'comment' => $request->comment,
                // 'type' => $receive->type,
                'type' => 999,
                'balance_type' => 3,//for fund transfer

                'created_by'            => Auth::user()->employee_id,
                'created_time'          => Carbon::now(),
                'created_by_ip'         => $request->ip(),

            ];

            $insert = DB::table('acc_transaction')->insert($data);

            if($insert){
                $response = ['status' => 'success', 'message' => 'দৈনিক '.$text .' সম্পন্ন হয়েছে।'];


            }else{
                $response = ['status' => 'error', 'message' => 'দৈনিক '.$text.' সম্পন্ন হয়নি'];
            }
           

            return Response::json($response);
          

        }
        
        return Response::json(['errors' => $validator->errors()]);
    }
}
