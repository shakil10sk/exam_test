<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function index()
    {
        return view('shop_rent.market_list');
    }

    public function list_data(Request $request)
    {
        $data = DB::table("market_list")
                        ->select(DB::raw("SQL_CALC_FOUND_ROWS *"))
                        ->where([
                            'union_id' => auth()->user()->union_id
                            ])
                        ->whereNull("deleted_at")
                        ->get();

        $total = DB::select("SELECT FOUND_ROWS() AS total")[0]->total;

        // dd($total);

        return response()->json(['status' => 'success', 'message' => 'Data found.', 'data' => $data, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'draw' => $request->draw]);
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $created_at = now();
        $created_by = Auth()->user()->id;
        $created_by_ip = $request->ip();

        $insert = DB::table("market_list")->insert([
            'union_id' => Auth()->user()->union_id,
            'name' => $name,
            'address' => $address,
            'created_at' => $created_at,
            'created_by' => $created_by,
            'created_by_ip' => $created_by_ip
        ]);

        // dd($insert);

        if($insert){
            Alert::toast('সফলভাবে যোগ হয়েছে', 'success');
        } else {
            Alert::toast('ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'error');
        }

        return redirect()->route("market.list");
    }

    public function update(Request $request)
    {
        $id = $request->pid;
        $name = $request->name;
        $address = $request->address;
        $updated_at = now();
        $updated_by = Auth()->user()->id;
        $updated_by_ip = $request->ip();

        $update = DB::table("market_list")
                    ->where("id", $id)
                    ->update([
                        'name' => $name,
                        'address' => $address,
                        'updated_at' => $updated_at,
                        'updated_by' => $updated_by,
                        'updated_by_ip' => $updated_by_ip
                    ]);

        if($update){
            Alert::toast('সফলভাবে আপডেট হয়েছে.', 'success');
        } else {
            Alert::toast('ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'error');
        }

        return redirect()->route("market.list");
    }

    public function delete(Request $request)
    {
        $delete = DB::table("market_list")
                    ->where("id", $request->pid)
                    ->update([
                        "deleted_at" => now(),
                        "updated_at" => now(),
                        "updated_by" => Auth()->user()->id,
                        "updated_by_ip" => $request->ip()
                    ]);

        if($delete){
            return response()->json(['status' => 'success', 'message' => 'সফলভাবে মুছে ফেলা হয়েছে', 'data' => []]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'data' => []]);
        }

    }

}
