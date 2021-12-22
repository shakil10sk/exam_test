<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ShopOwnerController extends Controller
{
    public function index()
    {
        $data['market_list'] = DB::table('market_list')->where('union_id', Auth::user()->union_id)
            ->whereNull('deleted_at')->get();

        return view('shop_rent.shop_owner_list', $data);
    }

    public function list_data(Request $request)
    {
        $data = DB::table('market_owner_list AS MOL')
            ->select(DB::raw("SQL_CALC_FOUND_ROWS MOL.*"), 'ML.name AS market_name', 'MSL.name AS shop_name')
            ->Join('market_list AS ML', function ($join) {
                $join->on('ML.id', '=', 'MOL.market_id')
                    ->on('MOL.union_id', '=', 'ML.union_id');
            })
            ->Join('market_shop_list AS MSL', function ($join) {
                $join->on('MSL.id', '=', 'MOL.shop_id')
                    ->on('MOL.union_id', '=', 'MSL.union_id');
            })
            ->where('MOL.union_id', auth()->user()->union_id)
            ->whereNull('MOL.deleted_at')
            ->orderBy("MOL.status")
            ->get();

        $total = DB::select("SELECT FOUND_ROWS() AS total")[0]->total;

        return response()->json(['status' => 'success', 'message' => 'Data found.', 'data' => $data, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'draw' => $request->draw]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'market_id' => ['required'],
            'shop_id' => ['required'],
            'name' => ['required', 'max:255'],
            'father_name' => ['required', 'max:150'],
            'mother_name' => ['required', 'max:150'],
            'address' => ['required', 'max:255'],
            'nid' => ['nullable', 'max:17'],
            'mobile_no' => ['required', 'max:11', 'min:11'],
            'selami_amount' => ['required', 'max:10'],
            'rent_amount' => ['required', 'max:10'],
            'starting_date' => ['required'],
        ], [
            'market_id.required' => 'মার্কেটের নাম অনুগ্রহ করে নির্বাচন করুন',
            'shop_id.required' => 'দোকানের নাম অনুগ্রহ করে নির্বাচন করুন',
            'name.required' => 'মালিকের নাম প্রদান করুন',
            'father_name.required' => 'পিতার নাম প্রদান করুন',
            'mother_name.required' => 'মাতার নাম প্রদান করুন',
            'address.required' => 'ঠিকানা প্রদান করুন',
            'nid.max' => 'ন্যাশনাল আইডি প্রদান করুন ১৭ ডিজিটের মধ্যে',
            'mobile_no.required' => 'সঠিক মো্বাইল নং প্রদান করুন',
            'mobile_no.max' => 'সঠিক মো্বাইল নং প্রদান করুন',
            'mobile_no.min' => 'সঠিক মো্বাইল নং প্রদান করুন',
            'rent_amount.required' => 'সালামীর টাকা প্রদান করুন',
            'rent_amount.max' => 'সালামীর টাকা প্রদান করুন',
            'selami_amount.required' => 'ভাড়ার  টাকা প্রদান করুন',
            'selami_amount.max' => 'ভাড়ার  টাকা প্রদান করুন',
            'starting_date.required' => 'শুরুর তারিখ প্রদান করুন',
        ]);

        // check if exist current owner
        $exist = DB::table("market_owner_list")
            ->where(["status" => 1, "shop_id" => $request->shop_id])
            ->whereNull("deleted_at")
            ->count();

        if ($exist > 0) {
            return response()->json(['status' => 'error', 'message' => 'ইতিমধ্যে অন্য মালিককে এই দোকান ভাড়া দেওয়া হয়েছে।', 'data' =>
                []]);
        }

        $owner_data = [
            'union_id' => Auth::user()->union_id,
            'market_id' => $request->market_id,
            'shop_id' => $request->shop_id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'nid' => $request->nid,
            'mobile_no' => $request->mobile_no,
            'selami_amount' => $request->selami_amount,
            'rent_amount' => $request->rent_amount,
            'starting_date' => $request->starting_date,
            'created_at' => now(),
            'created_by' => Auth()->user()->id,
            'created_by_ip' => $request->ip()
        ];

        // accounts transaction
        $union_id = Auth()->user()->union_id;

        $fiscal_year_id = Global_model::current_fiscal_year($union_id);
        $voucher_id = IdGenerate::voucher($union_id, $fiscal_year_id);

        $selami_acc_id = Global_model::get_account_id($union_id, 101);

        $transaction_data = [
            "union_id" => $union_id,
            "fiscal_year_id" => $fiscal_year_id,
            "voucher" => $voucher_id,
            "sonod_no" => NULL,
            "amount" => $request->selami_amount,
            "credit" => $selami_acc_id,
            "type" => 101,
            "comment" => 'New shop owner selami amount added',
            "created_at" => now(),
            "created_by" => Auth()->user()->id,
            "created_by_ip" => $request->ip()
        ];

        DB::beginTransaction();

        try {
            // owner add
            DB::table("market_owner_list")->insert($owner_data);

            $owner_id = DB::getPdo()->lastInsertId();
            $transaction_data['sonod_no'] = $owner_id;

            // accounts
            DB::table("acc_transaction")->insert($transaction_data);

            DB::commit();

            return response()->json(["status" => "success", "message" => "সফলভাবে যোগ হয়েছে", "data" => []]);
        } catch (Exception $e) {
            DB::rollBack();

            // response error
            return response()->json(["status" => "error", "message" => "ব্যর্থ হয়েছেন।দয়া করে আবার চেষ্টা করুন", "data" => []]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'market_id' => ['required'],
            'shop_id' => ['required'],
            'name' => ['required', 'max:255'],
            'father_name' => ['required', 'max:150'],
            'mother_name' => ['required', 'max:150'],
            'address' => ['required', 'max:255'],
            'nid' => ['nullable', 'max:30'],
            'mobile_no' => ['required', 'max:11', 'min:11'],
            'selami_amount' => ['required', 'max:10'],
            'rent_amount' => ['required', 'max:10'],
            'starting_date' => ['required'],
        ], [
            'market_id.required' => 'মার্কেটের নাম অনুগ্রহ করে নির্বাচন করুন',
            'shop_id.required' => 'দোকানের নাম অনুগ্রহ করে নির্বাচন করুন',
            'name.required' => 'মালিকের নাম প্রদান করুন',
            'father_name.required' => 'পিতার নাম প্রদান করুন',
            'mother_name.required' => 'মাতার নাম প্রদান করুন',
            'address.required' => 'ঠিকানা প্রদান করুন',
            'nid.max' => 'ন্যাশনাল আইডি প্রদান করুন ১৭ ডিজিটের মধ্যে',
            'mobile_no.required' => 'সঠিক মো্বাইল নং প্রদান করুন',
            'mobile_no.max' => 'সঠিক মো্বাইল নং প্রদান করুন',
            'mobile_no.min' => 'সঠিক মো্বাইল নং প্রদান করুন',
            'rent_amount.required' => 'সালামীর টাকা প্রদান করুন',
            'rent_amount.max' => 'সালামীর টাকা প্রদান করুন',
            'selami_amount.required' => 'ভাড়ার  টাকা প্রদান করুন',
            'selami_amount.max' => 'ভাড়ার  টাকা প্রদান করুন',
            'starting_date.required' => 'শুরুর তারিখ প্রদান করুন',
        ]);

        $owner_data = [
            'market_id' => $request->market_id,
            'shop_id' => $request->shop_id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'nid' => $request->nid,
            'mobile_no' => $request->mobile_no,
            'selami_amount' => $request->selami_amount,
            'rent_amount' => $request->rent_amount,
            'starting_date' => $request->starting_date,
            'updated_at' => now(),
            'updated_by' => Auth()->user()->id,
            'updated_by_ip' => $request->ip()
        ];

        // accounts transaction
        $union_id = Auth()->user()->union_id;

        $selami_acc_id = Global_model::get_account_id($union_id, 101);

        $transaction_data = [
            "amount" => $request->selami_amount,
            "credit" => $selami_acc_id,
            "comment" => 'New shop owner selami amount added',
            "updated_at" => now(),
            "updated_by" => Auth()->user()->id,
            "updated_by_ip" => $request->ip()
        ];

        DB::beginTransaction();

        try {
            // owner data update
            DB::table("market_owner_list")
                ->where('id', $request->row_id)
                ->update($owner_data);

            DB::table("acc_transaction")
                ->where([
                    "union_id" => $union_id,
                    "sonod_no" => $request->row_id,
                    "type" => 101
                ])
                ->update($transaction_data);

            DB::commit();

            return response()->json(["status" => "success", "message" => "তথ্য আপডেট করা হয়েছে", "data" => []]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(["status" => "error", "message" => "ব্যর্থ হয়েছেন।দয়া করে আবার চেষ্টা করুন", "data" => []]);
        }

    }

    public function delete(Request $request)
    {
        $delete = DB::table("market_owner_list")
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
            return response()->json(['status' => 'error', 'message' => 'ব্যর্থ হয়েছেন।দয়া করে আবার চেষ্টা করুন', 'data' => []]);
        }

    }

    public function getShopByMarketId($market_id)
    {

        $data = DB::table('market_shop_list')->where('union_id', Auth::user()->union_id)
            ->where('market_id', $market_id)
            ->whereNull('deleted_at')->get();

        return response()->json([
            "status" => "success",
            "data" => $data
        ]);

        return $market_id;
    }

    public function cancelContract(Request $request)
    {
        // check if multiple owner try to renew
        if ($request->contractType == 1) {
            $exist = DB::table("market_owner_list")
                ->where(["status" => 1, "shop_id" => $request->shop_id])
                ->whereNull("deleted_at")
                ->count();

            if ($exist > 0) {
                return response()->json(['status' => 'error', 'message' => 'ইতিমধ্যে অন্য মালিককে এই দোকান ভাড়া দেওয়া হয়েছে।', 'data' => []]);
            }
        }

        $update = DB::table("market_owner_list")
            ->where("id", $request->row_id)
            ->update([
                "status" => $request->contractType,
                "updated_at" => now(),
                "updated_by" => Auth()->user()->id,
                "updated_by_ip" => $request->ip()
            ]);

        if ($update) {
            $msg = $request->contractType == 1 ? 'Successfully contract renew.' : 'Successfully contract cancel.';

            return response()->json(['status' => 'success', 'message' => $msg, 'data' => []]);
        } else {
            $msg = $request->contractType == 1 ? 'Fail to renew the contract. Try again.' : 'Fail to cancel the contract. Try again.';

            return response()->json(['status' => 'error', 'message' => $msg, 'data' => []]);
        }
    }

    public function shop_owner_list_report()
    {
        $market_data = DB::table("market_list")
            ->whereNull("deleted_at")
            ->where("union_id", Auth()->user()->union_id)
            ->get();

        // dd($market_data);

        return view('shop_rent.shop_owner_list_report', compact('market_data'));
    }

    public function shop_owner_list_report_action(Request $request)
    {

        $market_id = \request('market_id', 0);

        $data = DB::table("market_owner_list AS MOL")
            ->join("market_shop_list AS MSL", function ($join) use ($market_id) {
                $join->on("MSL.id", "=", "MOL.shop_id")
                    ->on("MOL.union_id", "=", "MSL.union_id")
                    ->on("MOL.market_id", "=", "MSL.market_id")
                    ->when($market_id > 0, function ($q) use ($market_id) {
                        $q->where("MOL.market_id", $market_id);
                    });

            })
            ->join("market_list AS ML", function ($join) {
                $join->on("ML.id", "=", "MOL.market_id")
                    ->on("ML.union_id", "=", "MOL.union_id");
            })
            ->where([
                'MOL.union_id' => Auth()->user()->union_id,
                'MOL.status' => 1
            ])
            ->when($market_id > 0, function ($q) use ($market_id) {
                $q->where("MOL.market_id", $market_id);
            })
            ->whereNull("MOL.deleted_at")
            ->select("MOL.name", "MOL.father_name", "MOL.mother_name", "MOL.address", "MOL.mobile_no", "MOL.selami_amount", "MOL.rent_amount", "MSL.name AS shop_name","ML.name as market_name")
            ->get();

//        dd($data);

        $union_id = Auth::user()->union_id;
        $union = Global_model::union_profile($union_id);

        $market_info = DB::table("market_list")
            ->where("id", $request->market_id)
            ->get()
            ->first();

        // dd($market_info);

        $pdf = PDF::loadView('shop_rent.shop_owner_list_report_print', compact('data', 'union','market_id', 'market_info'));

        return $pdf->stream('shop_list.pdf');

        // return view("shop_rent.shop_list_report_print", compact('data', 'union'));
    }

    public function shop_ownership_change()
    {
        $market_list = DB::table("market_list")
            ->whereNull("deleted_at")
            ->where("union_id", Auth()->user()->union_id)
            ->get();

        return view("shop_rent.shop_ownership_change", compact('market_list'));
    }

    public function shop_ownership_change_confirm(Request $request)
    {
        $data = [
            "market_id" => $request->market_id,
            "shop_id" => $request->shop_id,
            "name" => $request->name,
            "father_name" => $request->father_name,
            "mother_name" => $request->mother_name,
            "address" => $request->address,
            "nid" => $request->nid,
            "mobile_no" => $request->mobile_no,
            "selami_amount" => $request->selami_amount,
            "rent_amount" => $request->rent_amount,
            "fee_amount" => $request->fee_amount
        ];

        $market_info = DB::table("market_list")->find($request->market_id);
        $shop_info = DB::table("market_shop_list")->find($request->shop_id);
        $owner_info = DB::table("market_owner_list")
            ->where([
                "market_id" => $request->market_id,
                "shop_id" => $request->shop_id,
                "status" => 1
            ])
            ->whereNull("deleted_at")
            ->get()
            ->first();

        // dd($owner_info);

        return view("shop_rent.shop_ownership_confirm", compact('data', 'market_info', 'shop_info', 'owner_info'));
    }

    public function shop_ownership_change_store(Request $request)
    {
        $owner_data = [
            'union_id' => Auth::user()->union_id,
            'market_id' => $request->market_id,
            'shop_id' => $request->shop_id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'nid' => $request->nid,
            'mobile_no' => $request->mobile_no,
            'selami_amount' => $request->selami_amount,
            'rent_amount' => $request->rent_amount,
            'owner_change_fee' => $request->fee_amount,
            'created_at' => now(),
            'created_by' => Auth()->user()->id,
            'created_by_ip' => $request->ip()
        ];

        // accounts transaction
        $union_id = Auth()->user()->union_id;

        $fiscal_year_id = Global_model::current_fiscal_year($union_id);
        $voucher_id = IdGenerate::voucher($union_id, $fiscal_year_id);

        $selami_acc_id = Global_model::get_account_id($union_id, 101);
        $change_fee_acc_id = Global_model::get_account_id($union_id, 104);

        $transaction_data = [];

        // start transaction
        DB::beginTransaction();

        try {
            DB::table("market_owner_list")
                ->where([
                    "market_id" => $request->market_id,
                    "shop_id" => $request->shop_id,
                    "status" => 1
                ])
                ->update([
                    "status" => 2,  // make old
                    "updated_at" => now(),
                    "updated_by" => Auth()->user()->id,
                    "updated_by_ip" => $request->ip()
                ]);

            DB::table("market_owner_list")->insert($owner_data);

            $owner_id = DB::getPdo()->lastInsertId();

            $transaction_data[] = [
                "union_id" => $union_id,
                "fiscal_year_id" => $fiscal_year_id,
                "voucher" => $voucher_id,
                "sonod_no" => $owner_id,
                "amount" => $request->selami_amount,
                "credit" => $selami_acc_id,
                "type" => 101,  // ownership change selami
                "comment" => 'Shop ownership change selami amount added',
                "created_at" => now(),
                "created_by" => Auth()->user()->id,
                "created_by_ip" => $request->ip()
            ];

            $transaction_data[] = [
                "union_id" => $union_id,
                "fiscal_year_id" => $fiscal_year_id,
                "voucher" => $voucher_id,
                "sonod_no" => $owner_id,
                "amount" => $request->fee_amount,
                "credit" => $change_fee_acc_id,
                "type" => 104,  // ownership change fee
                "comment" => 'Shop ownership change fee amount added',
                "created_at" => now(),
                "created_by" => Auth()->user()->id,
                "created_by_ip" => $request->ip()
            ];

            // dd($transaction_data);

            DB::table("acc_transaction")->insert($transaction_data);

            DB::commit();

            Alert::toast('সফলভাবে মালিকানা পরির্বতন করা হয়েছে', 'success');

        } catch (Exception $e) {
            DB::rollBack();

            Alert::toast('ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'error');
        }

        return redirect()->route("shop.owner.change");

    }

    //========== Ownership expire =============//
    public function expire_owner_list()
    {
        return view('shop_rent.expire_owner_list');
    }

    public function expire_owner_list_data()
    {
        $expire_owner_list = [];

        $data = DB::table('market_owner_list AS MOL')
            ->select(DB::raw("MOL.*"), 'ML.name AS market_name', 'MSL.name AS shop_name')
            ->Join('market_list AS ML', function ($join) {
                $join->on('ML.id', '=', 'MOL.market_id')
                    ->on('MOL.union_id', '=', 'ML.union_id');
            })
            ->Join('market_shop_list AS MSL', function ($join) {
                $join->on('MSL.id', '=', 'MOL.shop_id')
                    ->on('MOL.union_id', '=', 'MSL.union_id');
            })
            ->where('MOL.union_id', auth()->user()->union_id)
            ->whereNull('MOL.deleted_at')
            ->where("MOL.status", 1)
            ->get();

        foreach ($data as $item) {

            $business_start_date = new \DateTime(date('Y-m-d', strtotime($item->starting_date)));
            $current_date = new \DateTime(date('Y-m-d'));
            $different = $business_start_date->diff($current_date);
            $year = $different->format('%y');

            // after 3 year ownership expire //
            if ($year >= 3) {
                array_push($expire_owner_list, $item);
            }

        }

        return DataTables::of($expire_owner_list)
            ->addIndexColumn()
            ->make(true);
    }

    public function ownership_renew_store(Request $request)
    {
        $update_data = [
            "selami_amount" => $request->salami,
            "rent_amount" => $request->rent,
            "starting_date" => $request->staring_date,
            "updated_at" => Carbon::now(),
            "updated_by" => Auth::user()->id,
            "updated_by_ip" => \request()->ip()
        ];

        $isUpdate = DB::table('market_owner_list')->where(['union_id' => Auth::user()->union_id, 'id'
        => $request->owner_id])->update($update_data);

        return response()->json([
            "status" => $isUpdate ? "success" : "error",
            "message" => $isUpdate ? "সফলভাবে দোকানটি নবায়ন করা হয়েছে" : "কোন সমস্যা আছে",
        ]);
    }

    public function ownership_cancel_store(Request $request)
    {
        $isUpdate = DB::table("market_owner_list")
            ->where("id", $request->owner_id)
            ->update([
                "status" => 2, // 2  = cancel contract
                "updated_at" => now(),
                "updated_by" => Auth()->user()->id,
                "updated_by_ip" => $request->ip()
            ]);
        return response()->json([
            "status" => $isUpdate ? "success" : "error",
            "message" => $isUpdate ? "সফলভাবে দোকানের মালিকের সাথে চুক্তি বাতিল করা হয়েছে" : "কোন সমস্যা আছে",
        ]);
    }
    //========== Ownership expire =============//

}
