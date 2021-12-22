<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\BillCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Global_model;
use App\Models\IdGenerate;
use PDF;
use Exception;

class BillCollectionController extends Controller
{
    public function index()
    {
        $data['market_list'] = DB::table('market_list')
            ->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')
            ->get();

        return view('shop_rent.bill_collection', $data);
    }

    public function list(Request $request)
    {
        $searchingItem = $request->search['value'] ?? null;

        $data = DB::table("acc_invoice AS INV")
            ->join("market_owner_list AS MOL", "MOL.id", "=", "INV.owner_id")
            ->join("market_shop_list AS MSL", "MSL.id", "=", "MOL.shop_id")
            ->join("market_list AS ML", "ML.id", "=", "MOL.market_id")
            ->select(DB::raw("SQL_CALC_FOUND_ROWS INV.id, INV.invoice_id, INV.year_id, INV.month_id, INV.amount, INV.is_paid, INV.is_sms_send, INV.last_payment_date, MOL.name, MOL.mobile_no, MSL.name AS shop_no, ML.name AS market_name"))
            ->where(["INV.union_id" => Auth()->user()->union_id])
            ->whereNull("INV.deleted_at")
            ->when($request->year_id > 0, function ($q) {
                $q->where("INV.year_id", request('year_id'));
            })
            ->when($request->month_id > 0, function ($q) {
                $q->where("INV.month_id", request('month_id'));
            })
            ->when($request->market_id > 0, function ($q) {
                $q->where("MOL.market_id", request('market_id'));
            })
            ->when(isset($searchingItem), function ($q) use ($searchingItem) {
                $q->where(function ($query) use ($searchingItem) {
                    $query->where('MSL.name', 'LIKE', '%' . $searchingItem . '%')
                        ->orWhere('MOL.name', 'LIKE', '%' . $searchingItem . '%')
                        ->orWhere('MOL.mobile_no', 'LIKE', '%' . $searchingItem . '%')
                        ->orWhere('ML.name', 'LIKE', '%' . $searchingItem . '%');

                });
            })
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy(DB::raw("INV.is_paid, INV.invoice_id"))
            ->get();

        $total = DB::select("SELECT FOUND_ROWS() AS total")[0]->total;

        return response()->json(['status' => 'success', 'message' => 'Data found.', 'data' => $data, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'draw' => $request->draw]);
    }

    public function collectMoney(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table("acc_invoice")
                ->where('id', $request->pid)
                ->update([
                    'is_paid' => 1,
                    'payment_date' => now(),
                    'updated_at' => now(),
                    'updated_by' => Auth()->user()->id,
                    'updated_by_ip' => $request->ip()
                ]);

            // accounts transaction
            $union_id = Auth()->user()->union_id;

            $fiscal_year_id = Global_model::current_fiscal_year($union_id);
            $voucher_id = IdGenerate::voucher($union_id, $fiscal_year_id);

            $rent_acc_id = Global_model::get_account_id($union_id, 102);

            $invoice_info = DB::table("acc_invoice")->where("id", $request->pid)->get()->first();

            $transaction_data = [
                "union_id" => $union_id,
                "fiscal_year_id" => $fiscal_year_id,
                "voucher" => $voucher_id,
                "sonod_no" => $invoice_info->owner_id,
                "amount" => $invoice_info->amount,
                "credit" => $rent_acc_id,
                "type" => 102,
                "comment" => 'New shop owner selami amount added',
                "created_at" => now(),
                "created_by" => Auth()->user()->id,
                "created_by_ip" => $request->ip()
            ];

            DB::table("acc_transaction")->insert($transaction_data);

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'সফলভাবে টাকা কালেক্ট করা হয়েছে', 'data' =>
                [], 'invoice_id' => $invoice_info->invoice_id]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => 'ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'data'
            => []]);
        }
    }

    public function bill_collection_report()
    {
        $market_list = DB::table("market_list")
            ->whereNull("deleted_at")
            ->where("union_id", Auth()->user()->union_id)
            ->get();

        // dd($market_list);

        return view('shop_rent.monthly_bill_collection_report', compact('market_list'));
    }

    public function bill_collection_report_action(Request $request)
    {
        $month_en = [
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

        $year_id = $request->year_id;
        $month_id = $request->month_id;
        $market_id = \request('market_id', 0);



        $union_id = Auth::user()->union_id;
        $union = Global_model::union_profile($union_id);

//        $market_info = DB::table("market_list")
//            ->where("id", $request->market_id)
//            ->get()
//            ->first();

        $data = DB::table("acc_invoice AS INV")
            ->join("market_owner_list AS MOL", function ($join) use ($market_id) {
                $join->on("MOL.id", "=", "INV.owner_id")
                    ->on("MOL.union_id", "=", "INV.union_id")
                    ->where([
                        "INV.year_id" => request('year_id'),
                        "INV.month_id" => request('month_id'),
                        "INV.is_paid" => 1
                    ])
                    ->when((int)$market_id > 0, function ($q) use ($market_id) {
                        $q->where("MOL.market_id", $market_id);
                    })
                    ->whereNull("INV.deleted_at");
            })
            ->join("market_shop_list AS MSL", function ($join) use ($market_id) {
                $join->on("MOL.union_id", "=", "MSL.union_id")
                    ->on("MOL.market_id", "=", "MSL.market_id")
                    ->on("MOL.shop_id", "=", "MSL.id")
                    ->when((int)$market_id > 0, function ($q) use ($market_id) {
                        $q->where([
                            "MOL.market_id" => $market_id,
                            "MSL.market_id" => $market_id,
                        ]);
                    });

            })
            ->join("market_list AS ML", function ($join) use ($market_id) {
                $join->on("ML.union_id", "=", "MSL.union_id")
                    ->on("ML.id", "=", "MSL.market_id")
                    ->when((int)$market_id > 0, function ($q) use ($market_id) {
                        $q->where([
                            "ML.id" => $market_id,
                        ]);
                    });
            })
            ->where([
                "INV.year_id" => $request->year_id,
                "INV.month_id" => $request->month_id,
                "INV.is_paid" => 1
            ])
            ->whereNull("INV.deleted_at")
            ->select( "ML.name as market_name", "INV.invoice_id", "INV.amount", DB::raw("DATE(INV.payment_date) AS payment_date"), "MOL.name",
                "MOL.mobile_no", "MSL.name AS shop_name")
            ->get();



         if (count($data) == 0 ){
             return "<h3 style='color: red;text-align: center' >কোন ডাটা পাওয়া যায় নাই</h3>";
         }


        $pdf = PDF::loadView("shop_rent.monthly_bill_collection_report_print", compact('data', 'union', 'year_id', 'month_id', 'month_en'));

        return $pdf->stream("monthly_bill_collection_report.pdf");
    }


    public function dueMonthSms()
    {
        return view('shop_rent.three_month_due_sms');
    }

    public function dueMonthSmsSend(Request $request)
    {

        $due_owner_info = BillCollection::getThreeMonthDueOwnerInfo();


        $sms_data = [];

        foreach ($due_owner_info as $item) {

            $sms_data[] = [
                'union_id' => Auth::user()->union_id,
                'to_address' => $item['mobile_no'],
                'title' => $request->title,
                'message' => $request->message,
                'sending_time' => $request->sending_time . " " . date("H:i:s"),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'created_by_ip' => \request()->ip()
            ];
        }

        $isSave = DB::table('sms')->insert($sms_data);

        return response()->json([
            "status" => $isSave ? "success" : "error",
            "message" => $isSave ? "Sms sent Successfully" : "Fail to send.Please try again"
        ]);
    }

    public function register($from_date = null, $to_date = null)
    {
        // dd($from_date, $to_date);

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        // get register data
        $response = DB::table("acc_transaction AS ACCT")
            ->join("market_owner_list AS MOL", function ($join) use ($from_date, $to_date) {
                $join->on("MOL.id", "=", "ACCT.sonod_no")
                    ->on("MOL.union_id", "=", "ACCT.union_id")
                    ->whereIn("ACCT.type", [100, 101, 102, 103, 104])
                    ->whereDate("ACCT.created_at", ">=", $from_date)
                    ->whereDate("ACCT.created_at", "<=", $to_date);
            })
            ->join("market_list AS ML", "ML.id", "=", "MOL.market_id")
            ->join("market_shop_list AS MSL", "MSL.id", "=", "MOL.shop_id")
            ->join("acc_account AS ACC", "ACC.id", "=", "ACCT.credit")
            ->where("ACCT.union_id", $union_id)
            ->whereIn("ACCT.type", [100, 101, 102, 103, 104])
            ->whereDate("ACCT.created_at", ">=", $from_date)
            ->whereDate("ACCT.created_at", "<=", $to_date)
            ->select("MOL.name", "MOL.mobile_no", "ACCT.amount", "ML.name AS market_name", "MSL.name AS shop_name", "ACC.account_name", DB::raw("DATE(ACCT.created_at) AS date"))
            ->get();

        // dd($response);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('shop_rent.register', ['data' => $response, 'union' => $union_profile]), $config);

        return $pdf->stream("market_register.pdf");
    }

}
