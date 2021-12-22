<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Global_model;

class ShopController extends Controller
{
    public function index()
    {
        $market_data = DB::table("market_list")
            ->whereNull("deleted_at")
            ->where("union_id", Auth()->user()->union_id)
            ->get();

        // dd($market_data);

        return view('shop_rent.shop_list', compact('market_data'));
    }

    public function list_data(Request $request)
    {
        $offset = $request->start;
        $limit = $request->length;

        $data = DB::table("market_shop_list AS MSL")
            ->select(DB::raw("SQL_CALC_FOUND_ROWS MSL.*, ML.name AS market_name"))
            ->join("market_list AS ML", function ($join) {
                $join->on("ML.union_id", "=", "MSL.union_id")
                    ->on("ML.id", "=", "MSL.market_id")
                    ->whereNull("MSL.deleted_at");
            })
            ->where([
                'MSL.union_id' => auth()->user()->union_id
            ])
            ->whereNull("MSL.deleted_at")
            ->offset($offset)
            ->limit($limit)
            ->get();

        $total = DB::select("SELECT FOUND_ROWS() AS total")[0]->total;

        // dd($total);

        return response()->json(['status' => 'success', 'message' => 'Data found.', 'data' => $data, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'draw' => $request->draw]);
    }

    public function store(Request $request)
    {

        // dd($request);

        $created_at = now();
        $created_by = Auth()->user()->id;
        $created_by_ip = $request->ip();

        $data = [];

        foreach ($request->shop_no as $key => $item) {
            if (!empty($item)) {
                $data[] = [
                    'union_id' => Auth()->user()->union_id,
                    'market_id' => $request->market_id,
                    'name' => $item,
                    'selami' => $request->selami[$key],
                    'rent' => $request->rent[$key],
                    'created_at' => $created_at,
                    'created_by' => $created_by,
                    'created_by_ip' => $created_by_ip
                ];
            }
        }

        // dd($data);

        $insert = DB::table("market_shop_list")->insert($data);

        // dd($insert);

        if ($insert) {
            Alert::toast('Successfully saved.', 'success');
        } else {
            Alert::toast('Fail to save. Try again.', 'error');
        }

        return redirect()->route("shop.list");
    }

    public function update(Request $request)
    {
        $updated_at = now();
        $updated_by = Auth()->user()->id;
        $updated_by_ip = $request->ip();

        $update = DB::table("market_shop_list")
            ->where("id", $request->pid)
            ->update([
                'union_id' => Auth()->user()->union_id,
                'market_id' => $request->market_id,
                'name' => $request->shop_no,
                'selami' => $request->selami,
                'rent' => $request->rent,
                'updated_at' => $updated_at,
                'updated_by' => $updated_by,
                'updated_by_ip' => $updated_by_ip
            ]);

        if ($update) {
            Alert::toast('Successfully updated.', 'success');
        } else {
            Alert::toast('Fail to update. Try again.', 'error');
        }

        return redirect()->route("shop.list");
    }

    public function delete(Request $request)
    {
        $delete = DB::table("market_shop_list")
            ->where("id", $request->pid)
            ->update([
                "deleted_at" => now(),
                "updated_at" => now(),
                "updated_by" => Auth()->user()->id,
                "updated_by_ip" => $request->ip()
            ]);

        if ($delete) {
            return response()->json(['status' => 'success', 'message' => 'Successfully deleted.', 'data' => []]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Fail to delete.', 'data' => []]);
        }

    }

    public function shop_list_report()
    {
        $market_data = DB::table("market_list")
            ->whereNull("deleted_at")
            ->where("union_id", Auth()->user()->union_id)
            ->get();

        // dd($market_data);

        return view('shop_rent.shop_list_report', compact('market_data'));
    }

    public function shop_list_report_action(Request $request)
    {
        $market_id = \request('market_id', 0);

        $data = DB::table("market_shop_list as MSL")
            ->join("market_list AS ML", function ($join) {
                $join->on("ML.id", "=", "MSL.market_id")
                    ->on("ML.union_id", "=", "MSL.union_id");
            })
            ->where([
                'MSL.union_id' => Auth()->user()->union_id
            ])
            ->when($market_id > 0, function ($q) use ($market_id) {
                $q->where('MSL.market_id', $market_id);
            })
            ->whereNull("MSL.deleted_at")
            ->select(DB::raw("MSL.*"),"ML.name as market_name")
            ->get();

        $union_id = Auth::user()->union_id;
        $union = Global_model::union_profile($union_id);

        $market_info = DB::table("market_list")
            ->where("id", $request->market_id)
            ->get()
            ->first();

        // dd($market_info);

        $pdf = PDF::loadView('shop_rent.shop_list_report_print', compact('data', 'union', 'market_id', 'market_info'));

        return $pdf->stream('shop_list.pdf');

        // return view("shop_rent.shop_list_report_print", compact('data', 'union'));
    }

    function getShopInfo($shop_id)
    {
        $data = DB::table('market_shop_list')
            ->where('union_id', Auth::user()->union_id)
            ->where('id', $shop_id)->first();
        return response()->json([
            "status" => $data ? "success" : "error",
            "message" => $data ? "shop data found " : "shop data not found",
            "data" => $data ? $data : [],
        ]);
    }

}
