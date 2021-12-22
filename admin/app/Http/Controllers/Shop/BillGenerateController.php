<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\BillGenerate;
use App\Models\Global_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\DataTables;

class BillGenerateController extends Controller
{

    private $month = [1 => 'জানুয়ারি', 2 => 'ফেব্রুয়ারী', 3 => 'মার্চ', 4 => 'এপ্রিল', 5 => 'মে', 6 => 'জুন', 7 => 'জুলাই',
        8 => 'আগষ্ট', 9 => 'সেপ্টেম্বর', 10 => 'অক্টোবর', 11 => 'নভেম্বর', 12 => 'ডিসেম্বর '];
    private $month_en = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 =>
        'July',
        8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December '];


    public function index()
    {

        $data['market_list'] = DB::table('market_list')->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')->get();

        return view('shop_rent.bill_generate', $data);
    }


    public function store(Request $request)
    {

        $owner_info = DB::table('market_owner_list')
            ->where([
                'union_id' => Auth::user()->union_id,
                'status' => 1
            ])
            ->when((int)$request->market_id > 0, function ($q) use ($request) {
                $q->where('market_id', $request->market_id);
            })
            ->whereNull('deleted_at')
            ->get();

        DB::beginTransaction();
        try {

            foreach ($owner_info as $item) {

                // owner exists
                $exists_data = DB::table('acc_invoice AS INV')->where([
                    'INV.union_id' => Auth::user()->union_id,
                    'INV.year_id' => $request->year_id,
                    'INV.month_id' => $request->month_id,
                    'INV.owner_id' => $item->id,])
                    ->whereNull('INV.deleted_at');

                // owner existing checking....
                if ($exists_data->count() > 0) {

                    $owner_invoice_data = $exists_data->first();

                    $invoice_update_data = [
                        'amount' => $item->rent_amount,
                        'last_payment_date' => $request->last_payment_date,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => Carbon::now(),
                        'updated_by_ip' => $request->ip()
                    ];
                    // invoice data update //
                    DB::table('acc_invoice')->where('id', $owner_invoice_data->id)->update($invoice_update_data);

                } else {
                    $invoice_data = [
                        'union_id' => Auth::user()->union_id,
                        'invoice_id' => BillGenerate::generateID(),
                        'owner_id' => $item->id,
                        'year_id' => $request->year_id,
                        'month_id' => $request->month_id,
                        'amount' => $item->rent_amount,
                        'last_payment_date' => $request->last_payment_date,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'created_by_ip' => $request->ip()
                    ];

                    DB::table('acc_invoice')->insert($invoice_data);
                }


            }

            // all good
            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "সফলভাবে আপনি " . \BanglaConverter::bn_number($request->year_id) . ' সালের '
                    . $this->month[$request->month_id] . ' মাসের বিল জেনারেট করেছেন'
            ]);
        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            return response()->json([
                "status" => "error",
                "message" => "কোন সমস্যা আছে"
            ]);


        }

    }


    public function invoice_list()
    {

        $data['market_list'] = DB::table('market_list')->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')->get();

        return view('shop_rent.invoice_list', $data);

    }


    public function invoice_list_data(Request $request)
    {
        $data = BillGenerate::list_data($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('month_name', function ($row) {
                return $this->month[$row->month_id];
            })
            ->addColumn('status', function ($row) {

                $html = $row->is_paid == 1 ? '<span class="badge bg-success text-white">Paid</span>' : '<span class="badge bg-danger text-white">Unpaid</span>';

                return $html;
            })
            ->rawColumns(['status'])
            ->make(true);
    }


    public function invoice_print($invoice_id)
    {

        //get union profile data
        $union = new Global_model();
        $union_profile = $union->union_profile(Auth::user()->union_id);

        //get invoice data
        $resposne = BillGenerate::invoice_data($invoice_id);

        $resposne->month_name = $this->month[$resposne->month_id];


        if (!empty($union_profile)) {

            $pdf = PDF::loadView('shop_rent..invoice_print', ["data" => $resposne, 'union' => $union_profile]);

//           return view('shop_rent.invoice_print', ["data" => $resposne, 'union' => $union_profile]);

            return $pdf->stream('invoice.pdf');
        } else {
            echo " < h1 style = 'color:red;text-align:center;' > দুঃখিত !ইনভয়েস টি পাওয়া যায়নি </h1 > ";
        }
        return view('shop_rent.invoice_print');
    }


    public function delete(Request $request)
    {
        $delete = DB::table("acc_invoice")
            ->where("id", $request->row_id)
            ->update([
                "deleted_at" => now(),
                "updated_at" => now(),
                "updated_by" => Auth()->user()->id,
                "updated_by_ip" => $request->ip()
            ]);

        if ($delete) {
            return response()->json(['status' => 'success', 'message' => 'সফলভাবে মুছে ফেলা হয়েছে', 'data' => []]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'ব্যর্থ হয়েছেন। দয়া করে আবার চেষ্টা করুন', 'data'
            => []]);
        }
    }

    public function BillGenerateSms()
    {
        $data['market_list'] = DB::table('market_list')->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')->get();
        return view('shop_rent.bill_generate_sms', $data);
    }


    public function BillGenerateSmsSend(Request $request)
    {


        $data = DB::table('acc_invoice AS INV')
            ->select(DB::raw("INV .*"), 'MOL.mobile_no')
            ->join('market_owner_list AS MOL', function ($join) use ($request) {
                $join->on('MOL.id', '=', 'INV.owner_id')
                    ->on('MOL.union_id', '=', 'INV.union_id')
                    ->when((int)$request->market_id > 0, function ($q) use ($request) {
                        $q->where('MOL.market_id', $request->market_id);
                    })
                    ->whereNull('MOL.deleted_at')
                    ->whereNull('INV.deleted_at');
            })
            ->where('INV.year_id', $request->year_id)
            ->where('INV.month_id', $request->month_id)
            ->where('INV.union_id', Auth::user()->union_id)
            ->where('INV.is_sms_send', 0)
            ->when((int)$request->market_id > 0, function ($q) use ($request) {
                $q->where('MOL.market_id', $request->market_id);
            })
            ->whereNull('INV.deleted_at')
            ->get();


        if (count($data) <= 0) {
            return response()->json([
                "status" => "error",
                "message" => "এই মাসে কোনও বিল পাওয়া যায় নি"
            ]);
        }


        $title = 'Bill for ' . $this->month_en[$request->month_id] . ',' . $request->year_id;

        $message = 'Your bill for ' . $this->month_en[$request->month_id] . ',' . $request->year_id . ' has been generated. Pay your due within ' . $data[0]->last_payment_date . ' . Municipality';


        DB::beginTransaction();

        try {

            $invoice_id = [];

            foreach ($data as $item) {

                $sms_data = [
                    'union_id' => Auth::user()->union_id,
                    'to_address' => $item->mobile_no,
                    'title' => $title,
                    'message' => $message,
                    'sending_time' => date("Y - m - d H:i:s"),
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'created_by_ip' => \request()->ip()
                ];

                $isSave = DB::table('sms')->insert($sms_data);

                if ($isSave) {
                    array_push($invoice_id, $item->id);
                }

            }


            DB::table('acc_invoice')->where('union_id', Auth::user()->union_id)
                ->whereIn('id', $invoice_id)->update([
                    'is_sms_send' => 1,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                    'updated_by_ip' => \request()->ip()
                ]);

            // all good
            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "এসএমএস সফলভাবে পাঠানো হয়েছে"
            ]);

        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            return response()->json([
                "status" => "error",
                "message" => "ব্যর্থ হয়েছেন।দয়া করে আবার চেষ্টা করুন"
            ]);

        }


    }


}
