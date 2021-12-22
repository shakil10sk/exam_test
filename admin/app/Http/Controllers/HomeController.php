<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Application;
use App\Models\Certificate;
use App\Models\Global_model;
use App\Models\Management\Employee\Employee;
use App\Models\Management\Union\UnionInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get all district
        $district = Global_model::get_all_location();

        // dd(Auth::user());

        if (auth()->user()->hasRole('super-admin')) {

            $union_count = UnionInformation::from('union_information as UI')

                ->join('users AS UGS', function ($join) {

                    $join->on('UGS.union_id', '=', 'UI.union_code')
                        ->where('UGS.type', 2)
                        ->where('UGS.status', 1);
                })
                ->where('UI.deleted_at', null)
                ->count();

            $employee_counts = Employee::select(
                DB::raw('SUM(if(designation_id=1, 1, 0)) AS chairman'),
                DB::raw('SUM(if(designation_id=2, 1, 0)) AS sachib'),
                DB::raw('SUM(if(designation_id=3, 1, 0)) AS udc'),
                DB::raw('SUM(if(designation_id=4, 1, 0)) AS computer_operator'),
                DB::raw('SUM(if(designation_id=5, 1, 0)) AS ward_member'),
                DB::raw('SUM(if(designation_id=5, 1, 0)) AS ward_member'),
                DB::raw('SUM(if(designation_id=6, 1, 0)) AS village_police'),
                DB::raw('count(id) AS total')
            )
                ->where('deleted_at', null)
                ->first();

            return view('index')->with(['union_count' => $union_count, 'emp_count' => $employee_counts]);
        }

        $data = [
            'nagorik_application_total' => Application::where(['union_id' => auth()->user()->union_id, 'status' => 0, 'is_active' => 1])->where(['type' => 1])->whereNull('deleted_at')->count(),

            'nagorik_certificate_total' => Application::where(['union_id' => auth()->user()->union_id, 'status' => 1, 'is_active' => 1])->where(['type' => 1])->whereNull('deleted_at')->count(),

            'trade_application_total' => Application::where(['union_id' => auth()->user()->union_id, 'status' => 0, 'is_active' => 1])->where(['type' => 19])->whereNull('deleted_at')->count(),

            'trade_certificate_total' => Certificate::where(['union_id' => auth()->user()->union_id, 'status' => 1, 'is_active' => 1])->where(['type' => 19])->count(),

            'trade_expire_total' => Certificate::where(['union_id' => auth()->user()->union_id, 'status' => 3, 'is_active' => 1])->where(['type' => 19])->count(),

            'trade_renew_total' => Certificate::where(['union_id' => auth()->user()->union_id, 'status' => 2, 'is_active' => 1])->where(['type' => 19])->count(),

            'oaris_application_total' => Application::where(['union_id' => auth()->user()->union_id, 'status' => 0, 'is_active' => 1])->where(['type' => 17])->whereNull('deleted_at')->count(),
            
            'oaris_expired_total' => Certificate::where(['union_id' => auth()->user()->union_id, 'status' => 3, 'is_active' => 1])->where(['type' => 17])->count(),

            'oaris_certificate_total' => Certificate::where(['union_id' => auth()->user()->union_id, 'status' => 1, 'is_active' => 1])->where(['type' => 17])->count(),
        ];

        // dashboard  একাউন্ট সমুহ  section
        $accounts = [
            'nagorik'  => [
                'account_code' => 128,
                'amount' => 0
            ],
            // trade accounts
            'trade_licence'  => [
                'account_code' => 122,
                'amount' => 0
            ],
            'trade_signboard'  => [
                'account_code' => 123,
                'amount' => 0
            ],
            'trade_sub_charge'  => [
                'account_code' => 124,
                'amount' => 0
            ],
            'trade_vat'  => [
                'account_code' => 171,
                'amount' => 0
            ],
            // end trade
            'cash_account' => [
                'account_code' => 128,
                'amount' => 0
            ],
            'jonmo' => [
                'account_code' => 130,
                'amount' => 0
            ],
            'mittu' => [
                'account_code' => 199,
                'amount' => 0
            ],
            'tohobil' => [
                'account_code' => 131,
                'amount' => 0
            ],
            'unnoun_tohobil' => [
                'account_code' => 132,
                'amount' => 0
            ],
        ];

        // converting array to object 
        $accounts_obj = json_decode(json_encode($accounts));

        foreach ($accounts_obj as $key => $value) {
            $acc_info = DB::table('acc_account')->where(['account_code' => $value->account_code, 'union_id' => auth()->user()->union_id])->first();

            // dd($acc_info);

            if(empty($acc_info)){
                $credit = 0;
                $debit = 0;
            } else {
                $credit = DB::table('acc_transaction')
                    ->select(DB::raw('sum(amount) as amount'))
                    ->where('credit', $acc_info->id)
                    ->groupBy('credit')
                    ->first()->amount ?? 0;

                $debit = DB::table('acc_transaction')
                    ->select(DB::raw('sum(amount) as amount'))
                    ->where('debit', $acc_info->id)
                    ->groupBy('debit')
                    ->first()->amount ?? 0;
            }
            

            $value->amount = (int) $credit - (int) $debit;
        }

        // dd($accounts_obj);
        // adding nagorik and trade amount to cash account visually
        $accounts_obj->cash_account->amount +=
            (+$accounts_obj->nagorik->amount
                + $accounts_obj->trade_licence->amount
                + $accounts_obj->trade_signboard->amount
                + $accounts_obj->trade_sub_charge->amount
                + $accounts_obj->trade_vat->amount);

        $data += ['accounts' => $accounts_obj];
        // dd($data);
        return view('index', $data);
    }

    public function support()
    {
        return view('support');
    }
}
