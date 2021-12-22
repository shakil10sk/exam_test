<?php

namespace App\Http\Controllers\Shop\Association;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomeExpenseController extends Controller
{

    public function khat(Request $request)
    {

        if ($request->ajax()) {

        }

        return view('shop_rent.association.income_expense_khat');
    }

    public function khat_store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);


        // account create //
        $association_acc = [
            'parent_id' => NULL,
            'union_id' => Auth::user()->union_id,
            'account_code' => date('YMDHS'),
            'account_name' => $request->name,
            'acc_type' => $request->type,
            'created_by' => Auth::user()->id,
            'created_by_ip' => Request::ip(),
            'created_time' => Carbon::now()
        ];

        $isSave = DB::table('acc_account')->insert($association_acc);

        return

    }
}
