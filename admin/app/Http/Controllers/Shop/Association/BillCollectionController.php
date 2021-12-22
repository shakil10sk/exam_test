<?php

namespace App\Http\Controllers\Shop\Association;

use App\Http\Controllers\Controller;
use App\Models\BillGenerate;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\DataTables;

class BillCollectionController extends Controller
{
    public $month_en = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    private $month_bn = [1 => 'জানুয়ারি', 2 => 'ফেব্রুয়ারী', 3 => 'মার্চ', 4 => 'এপ্রিল', 5 => 'মে', 6 => 'জুন', 7 =>
        'জুলাই',
        8 => 'আগষ্ট', 9 => 'সেপ্টেম্বর', 10 => 'অক্টোবর', 11 => 'নভেম্বর', 12 => 'ডিসেম্বর'];

    public function index()
    {
        $data['member_list'] = DB::table('association_member_list')->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')->get();
        $data['month'] = $this->month_en;
        return view('shop_rent.association.bill_collection', $data);
    }

    public function getMemberInvoiceInfo(Request $request)
    {
        $member_info = DB::table('association_member_list')
            ->select('name', 'mobile', 'chanda_amount')
            ->where("union_id", Auth::user()->union_id)
            ->where("id", $request->member_id)
            ->whereNull('deleted_at')->first();

        $paid_months = DB::table('association_member_list as AML')
            ->leftJoin('acc_invoice as INV', function ($join) {
                $join->on("INV.owner_id", "=", "AML.id")
                    ->on("INV.union_id", "=", "AML.union_id")
                    ->where("INV.year_id", \request('year_id'))
                    ->where("INV.type", 2) // 2 = association member
                    ->where("INV.is_paid", 1);
            })
            ->leftJoin('acc_transaction AS TNS', function ($join) {
                $join->on('TNS.voucher', '=', 'INV.voucher_no')
                    ->on('TNS.union_id', '=', 'INV.union_id')
                    ->where('TNS.type', 106)
                    ->where('TNS.is_active', 1);
            })
            ->select('INV.month_id')
            ->where("AML.union_id", Auth::user()->union_id)
            ->where("AML.id", $request->member_id)
            ->whereNull('AML.deleted_at')
            ->get()->pluck('month_id')->toArray();


        $invoice_info = [];


        for ($i = 1; $i <= count($this->month_en); $i++) {
            $invoice_info[$i] = [
                'month_id' => $i,
                'month_name' => $this->month_en[$i],
                'is_paid' => (in_array($i, $paid_months)) ? 1 : 0
            ];
        }

        return response()->json([
            "status" => count($invoice_info) > 0 ? "success" : "error",
            "message" => count($invoice_info) > 0 ? "Invoice Data found " : "Invoice Data not found ",
            "member_info" => count($invoice_info) > 0 ? $member_info : [],
            "invoice_info" => count($invoice_info) > 0 ? $invoice_info : [],
        ]);

    }

    public function bill_collection_save(Request $request)
    {
        $month_ids = array_filter($request->month_id);

//        dd($request->all());

        DB::beginTransaction();

        $union_id = Auth::user()->union_id;

        $fiscal_year_id = Global_model::current_fiscal_year($union_id);
        $voucher_id = IdGenerate::voucher($union_id, $fiscal_year_id, 2);
        $invoice_id = BillGenerate::generateID();


        try {
            $invoice_data = [];

            // invoice data //
            foreach ($month_ids as $month_id) {
                $invoice_data[] = [
                    'union_id' => Auth::user()->union_id,
                    'invoice_id' => $invoice_id,
                    'voucher_no' => $voucher_id,
                    'owner_id' => $request->member_id,
                    'fiscal_year_id' => $fiscal_year_id,
                    'year_id' => $request->year_id,
                    'month_id' => $month_id,
                    'amount' => $request->monthly_chada,
                    'is_paid' => 1,
                    'payment_date' => date('Y-m-d'),
                    'last_payment_date' => date('Y-m-d'),
                    'type' => 2,
                    'created_at' => Carbon::now(),
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => \request()->ip()
                ];

            }


            // account transaction //


            // member acc
            $member_account_id = Global_model::get_account_id($union_id, 106, null, $request->member_id);

            // association acc
            $association_account_id = DB::table('acc_account')
                ->where([
                    'union_id' => $union_id,
                    'acc_type'      => 105,
                    'account_code'  => 105,
                    'is_active' => 1
                ])->whereNull(['head_type','parent_id'])
                ->first()->id;


            $transaction_data = [
                'union_id' => $union_id,
                'fiscal_year_id' => $fiscal_year_id,
                'voucher' => $voucher_id,
                'sonod_no' => $request->member_id,
                'amount' => $request->total_chada,
                'debit' => $member_account_id,
                'credit' => $association_account_id,
                'type' => 106,
                'comment' => 'chada amount added',
                "created_time" => now(),
                "created_by" => Auth()->user()->id,
                "created_by_ip" => $request->ip()
            ];


            DB::table('acc_invoice')->insert($invoice_data);
            DB::table('acc_transaction')->insert($transaction_data);

            // all are good
            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "সফলভাবে চাঁদা কালেকশান হয়েছে"
            ]);

        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([
                "status" => "error",
                "message" => "ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন"
            ]);
        }


    }


    public function invoice_list()
    {

        $data['member_list'] = DB::table('association_member_list')->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')->get();

        return view('shop_rent.association.invoice_list', $data);

    }


    public function invoice_list_data(Request $request)
    {
        $searchingItems = $request->search['value'] ?? null;


        $data = DB::table('acc_invoice AS INV')
            ->Join('association_member_list AS AML', function ($join) {
                $join->on('INV.owner_id', '=', 'AML.id')
                    ->on('AML.union_id', '=', 'INV.union_id')
                    ->where('INV.type', 2);
            })
            ->where('INV.union_id', Auth::user()->union_id)
            ->whereNull('INV.deleted_at')
            ->when((int)$request->year_id > 0, function ($q) {
                $q->where('INV.year_id', \request('year_id'));
            })
            ->when((int)$request->member_id > 0, function ($q) {
                $q->where('AML.id', \request('member_id'));
            })
            ->when(!is_null($searchingItems), function ($q) use ($searchingItems) {
                $q->where(function ($query) use ($searchingItems) {
                    $query->where('AML.name', 'like', '%' . $searchingItems . '%')
                        ->Orwhere('AML.mobile', 'like', '%' . $searchingItems . '%')
                        ->Orwhere('AML.id', 'like', '%' . $searchingItems . '%');
                });
            })
            ->where('INV.is_paid', 1)
            ->select(DB::raw('SQL_CALC_FOUND_ROWS INV.invoice_id, INV.year_id,INV.created_at,AML.id,AML.name,AML.mobile,SUM(INV.amount) AS total_amount,INV.is_paid'))
            ->groupBy('INV.invoice_id')
            ->orderBy('INV.invoice_id', 'ASC')
            ->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $html = $row->is_paid == 1 ? '<span class="badge bg-success text-white">Paid</span>' : '<span class="badge bg-danger text-white">Unpaid</span>';
                return $html;
            })
            ->addColumn('payment_date', function ($row) {
                $html = date('d-m-Y', strtotime($row->created_at));
                return $html;
            })
            ->rawColumns(['status', 'payment_date'])
            ->make(true);
    }


    public function invoice_information($invoice_id)
    {

        //get union profile data
        $union = new Global_model();
        $union_profile = $union->union_profile(Auth::user()->union_id);

        $invoice_information = DB::table('acc_invoice AS INV')
            ->Join('association_member_list AS AML', function ($join) {
                $join->on('INV.owner_id', '=', 'AML.id')
                    ->on('AML.union_id', '=', 'INV.union_id')
                    ->where('INV.type', 2);
            })
            ->Join('acc_transaction AS TNS', function ($join) {
                $join->on('TNS.voucher', '=', 'INV.voucher_no')
                    ->on('TNS.union_id', '=', 'INV.union_id')
                    ->on('TNS.sonod_no', '=', 'AML.id')
                    ->where('INV.type', 2);
            })
            ->where('INV.union_id', Auth::user()->union_id)
            ->whereNull('INV.deleted_at')
            ->where('INV.is_paid', 1)
            ->where('INV.type', 2)
            ->where('INV.invoice_id', $invoice_id)
            ->select('INV.invoice_id', 'INV.year_id', 'AML.id as member_id', 'AML.name', 'AML.permanent_village_en', 'AML.mobile', 'AML.chanda_amount', 'TNS.amount as total_amount', DB::raw('GROUP_CONCAT(INV.month_id) as month_ids '), 'INV.is_paid', DB::raw('CAST(INV.created_at AS date) as payment_date'))
            ->groupBy('INV.invoice_id')
            ->first();


        $month_ids_array = explode(",", $invoice_information->month_ids);

        $invoice_information->month_name = '';


        if (count($month_ids_array) == 1) {
            $invoice_information->month_name = $this->month_bn[$month_ids_array[0]];
        } else {
            $initials_month = [];
            for ($i = $month_ids_array[0]; $i <= (int)end($month_ids_array); $i++) {
                $initials_month[$i] = $this->month_en[$i];
            }
            $month_diff = array_diff(array_keys($initials_month), $month_ids_array);

            if (count($month_diff) > 0) {
                for ($i = 0; $i < count($month_ids_array); $i++) {

                    if ($i == (count($month_ids_array) - 1)) {
                        $invoice_information->month_name .= 'এবং ' . $this->month_bn[$month_ids_array[$i]];
                    } else {
                        $invoice_information->month_name .= $this->month_bn[$month_ids_array[$i]] . ",";
                    }

                }
            } else {
                $invoice_information->month_name = $this->month_bn[$month_ids_array[0]] . ' থেকে ' . $this->month_bn[end
                    ($month_ids_array)];
            }
        }
//        dd($invoice_information);

        $pdf = PDF::loadView('shop_rent.association.invoice_print', ["data" => $invoice_information, 'union' =>
            $union_profile]);


        return $pdf->stream('invoice.pdf');


    }


    public function getPaymentInfoByMemberId($member_id)
    {
        //dd($member_id);

        //get union profile data
        $union = new Global_model();
        $union_profile = $union->union_profile(Auth::user()->union_id);

        // get member data //
        $member_info = DB::table('association_member_list')->where('id', $member_id)->select('name', 'id', 'mobile', 'father_name', 'permanent_village_en')->first();

        $data = DB::table('acc_invoice AS INV')
            ->Join('acc_transaction AS TNS', function ($join) {
                $join->on('TNS.voucher', '=', 'INV.voucher_no')
                    ->on('TNS.union_id', '=', 'INV.union_id')
                    ->where('TNS.type', 106)
                    ->where('INV.type', 2)
                    ->where('TNS.is_active', 1);
            })
            ->where('INV.union_id', Auth::user()->union_id)
            ->where('INV.owner_id', $member_id)
            ->where('INV.type', 2)
            ->where('INV.is_paid', 1)
            ->select('INV.*')
            ->get()->each(function ($row) {
                $row->month_name = $this->month_bn[$row->month_id];
            });

        $pdf = PDF::loadView('shop_rent.association.member_payment_info_report', ['data' => $data, 'union' =>
            $union_profile, 'member_info' => $member_info]);


        return $pdf->stream('member_payment_report.pdf');


    }


    public function getPaymentInformation()
    {
        //get union profile data
        $union = new Global_model();
        $union_profile = $union->union_profile(Auth::user()->union_id);

        $data = DB::table('association_member_list AS AML')
            ->join('acc_account AS ACC', function ($join) {
                $join->on('AML.id', '=', 'ACC.account_code')
                    ->on('AML.union_id', '=', 'ACC.union_id')
                    ->where('ACC.acc_type', 106)
                    ->where('ACC.is_active', 1)
                    ->whereNull('ACC.parent_id');
            })
            ->leftJoin('acc_transaction AS TNS', function ($join) {
                $join->on('TNS.sonod_no', '=', 'AML.id')
                    ->on('TNS.debit', '=', 'ACC.id')
                    ->on('TNS.union_id', '=', 'ACC.union_id')
                    ->where('TNS.type', 106)
                    ->where('TNS.is_active', 1);

            })
            ->select('AML.name','AML.mobile', DB::raw("COALESCE(SUM(TNS.amount),0) AS total_amount"))
            ->where('AML.union_id', Auth::user()->union_id)
            ->whereNull('AML.deleted_at')
            ->groupBy('TNS.sonod_no')
            ->get();

         $pdf = PDF::loadView('shop_rent.association.all_member_payment_info_report', ['data' => $data, 'union' =>
             $union_profile]);


        return $pdf->stream('member_payment_report.pdf');
    }
}
