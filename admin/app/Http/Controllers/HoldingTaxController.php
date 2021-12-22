<?php

namespace App\Http\Controllers;

use App\Models\BillGenerate;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\Global_model;
use App\Models\IdGenerate;
use PDF;

class HoldingTaxController extends Controller
{
    public function assessment_list(Request $request)
    {
        if($request->ajax()){
            $ward_no = $request->ward_no;
            $property_type = $request->property_type;
            $owner_type = $request->owner_type;

            $data = DB::table("holding_assessment AS HA")
                        ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")
                        ->join("holding_settings AS HS2", "HS2.id", "=", "HA.property_id")
                        ->whereNull("HA.deleted_at")
                        
                        ->when($ward_no > 0, function($q) use($ward_no){
                            $q->where("HA.ward_id", $ward_no);
                        })
                        ->when($property_type > 0, function($q) use($property_type){
                            $q->where("HA.property_id", $property_type);
                        })
                        ->when($owner_type > 0, function($q) use($owner_type){
                            $q->where("HA.owner_type", $owner_type);
                        })

                        ->select("HA.*", "HS.name AS ward_name", "HS2.name AS property_name");

            return DataTables::of($data)
                                ->editColumn('owner_type', '{{$owner_type == 1 ? "ভাড়া" : "ব্যক্তি মালিকানা"}}')
                                ->addColumn('action', function($item){
                                    return '<a href="'.url('holding/tax/assessment/print/'.$item->id).'" target="_blank"><button class="btn btn-sm btn-secondary"><i class="fa fa-print"></i> Print</button></a> &nbsp;<a href="'.url('holding/tax/assessment/edit/'.$item->id).'"><button class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</button></a> &nbsp;<button class="btn btn-sm btn-danger" onclick="deleteAssessment('.$item->id.')"><i class="fa fa-trash"></i> Delete</button> &nbsp; <a href="'.url('holding/tax/assessment/bill/generate/'.$item->id).'"><button class="btn btn-sm btn-primary"> Generate</button></a>';
                                })
                                ->setRowId(function($item){
                                    return 'row'.$item->id;
                                })
                                ->make(true);
        }

        $ward_list = DB::table("holding_settings")->where("type", 1)->get();
        
        $property_list = DB::table("holding_settings AS HS")
                            ->leftJoin("holding_area_rate AS HAR", "HS.id", "=", "HAR.property_id")
                            ->where("HS.type", 4)
                            ->select("HS.id", "HS.name", "HAR.fee")
                            ->get();

        return view("holding_tax.assessment_list", compact("ward_list", "property_list"));
    }

    public function assessment()
    {
        $ward_list = DB::table("holding_settings")->where("type", 1)->get();
        $moholla_list = DB::table("holding_settings")->where("type", 2)->get();
        $block_list = DB::table("holding_settings")->where("type", 3)->get();
        
        $property_list = DB::table("holding_settings AS HS")
                            ->leftJoin("holding_area_rate AS HAR", "HS.id", "=", "HAR.property_id")
                            ->where("HS.type", 4)
                            ->select("HS.id", "HS.name", "HAR.fee")
                            ->get();

        return view("holding_tax.assessment", compact('ward_list', 'moholla_list', 'block_list', 'property_list'));
    }

    public function assessment_store(Request $request)
    {
        // dd($request->all());

        $data = [
            "union_id" => Auth::user()->union_id,
            "name" => $request->name_bn,
            "nid" => $request->nid,
            "birth_id" => $request->birth_id,
            "passport_no" => $request->passport_no,
            "birth_date" => $request->birth_date,
            "mobile_no" => $request->mobile,
            "father_name" => $request->father_name_bn,
            "mother_name" => $request->mother_name_bn,
            "occupation" => $request->occupation,
            "religion" => $request->religion,
            "holding_no" => $request->holding_no,
            "assessment_date" => $request->assessment_date,
            "ward_id" => $request->ward_no,
            "block_id" => $request->block_id,
            "moholla_id" => $request->moholla_id,
            "owner_type" => $request->owner_type,
            "road_width" => $request->road_width,
            "construction_type" => $request->construction_type,
            "property_id" => $request->property_type,
            "rent_area" => $request->rent_area,
            "owner_area" => $request->own_area,
            "depreciation" => $request->depreciation,
            "appreciation" => $request->appreciation,
            "arv" => $request->annual_rental_value,
            "farv" => $request->final_annual_rental_value,
            "yearly_tax" => $request->annual_tax,
            "monthly_tax" => $request->monthly_tax,
            "created_at" => now(),
            "created_by" => Auth::user()->id,
            "created_by_ip" => $request->ip()
        ];

        // dd($data);

        $insert = DB::table("holding_assessment")->insert($data);

        if($insert){
            // Alert::toast('New holding assessment successfully save.', 'success');
            $pid = DB::getPdo()->lastInsertId();

            Alert::alert()    
                ->html("<i>এসসেসমেন্টটি সম্পূর্ণ হয়েছে!</i>", "</p><a href='".url("/holding/tax/assessment/print/".$pid)."' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='".url('/holding/tax/assessment')."' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>তালিকা</a>", 'success')
                
                ->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')
                
                ->persistent(false, true);

            return redirect("/holding/tax/assessment");
        } else {
            Alert::toast('Fail to save new holding assessment.', 'error');

            return redirect()->back();
        }
    }

    public function assessment_edit($id)
    {
        $data = DB::table("holding_assessment")->where("id", $id)->get()->first();

        // dd($data);

        $ward_list = DB::table("holding_settings")->where("type", 1)->get();
        $moholla_list = DB::table("holding_settings")->where("type", 2)->get();
        $block_list = DB::table("holding_settings")->where("type", 3)->get();
        
        $property_list = DB::table("holding_settings AS HS")
                            ->leftJoin("holding_area_rate AS HAR", "HS.id", "=", "HAR.property_id")
                            ->where("HS.type", 4)
                            ->select("HS.id", "HS.name", "HAR.fee")
                            ->get();

        return view("holding_tax.assessment_edit", compact('data', 'ward_list', 'moholla_list', 'block_list', 'property_list'));
    }
    
    public function assessment_print($id)
    {
        $data = DB::table("holding_assessment AS HA")
                    ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")

                    ->join("holding_settings AS HS2", "HS2.id", "=", "HA.moholla_id")

                    ->join("holding_settings AS HS3", "HS3.id", "=", "HA.block_id")

                    ->join("holding_settings AS HS4", "HS4.id", "=", "HA.property_id")

                    ->where("HA.id", $id)
                    ->select("HA.*", "HS.name AS ward_name", "HS.ward_no", "HS2.name AS moholla_name", "HS3.name AS block_name", "HS4.name AS property_name")
                    ->get()
                    ->first();

        // dd($data);

        $union_id = Auth::user()->union_id;
        $union = Global_model::union_profile($union_id);

        // return view('holding_tax.assessment_print', compact("data", "union"));

        //pdf convert with data
        $pdf = PDF::loadView('holding_tax.assessment_print', compact('data', 'union'));

        return $pdf->stream('holding_tax_assessment.pdf');
    }

    public function assessment_update(Request $request)
    {
        // dd($request->all());

        $data = [
            "union_id" => Auth::user()->union_id,
            "name" => $request->name_bn,
            "nid" => $request->nid,
            "birth_id" => $request->birth_id,
            "passport_no" => $request->passport_no,
            "birth_date" => $request->birth_date,
            "mobile_no" => $request->mobile,
            "father_name" => $request->father_name_bn,
            "mother_name" => $request->mother_name_bn,
            "occupation" => $request->occupation,
            "religion" => $request->religion,
            "holding_no" => $request->holding_no,
            "assessment_date" => $request->assessment_date,
            "ward_id" => $request->ward_no,
            "block_id" => $request->block_id,
            "moholla_id" => $request->moholla_id,
            "owner_type" => $request->owner_type,
            "road_width" => $request->road_width,
            "construction_type" => $request->construction_type,
            "property_id" => $request->property_type,
            "rent_area" => $request->rent_area,
            "owner_area" => $request->own_area,
            "depreciation" => $request->depreciation,
            "appreciation" => $request->appreciation,
            "arv" => $request->annual_rental_value,
            "farv" => $request->final_annual_rental_value,
            "yearly_tax" => $request->annual_tax,
            "monthly_tax" => $request->monthly_tax,
            "updated_at" => now(),
            "updated_by" => Auth::user()->id,
            "updated_by_ip" => $request->ip()
        ];

        // dd($data);

        $insert = DB::table("holding_assessment")->where("id", $request->pid)->update($data);

        if($insert){
            Alert::toast('Holding assessment successfully updated.', 'success');

            return redirect("/holding/tax/assessment");
        } else {
            Alert::toast('Fail to update holding assessment.', 'error');

            return redirect()->back();
        }
    }

    public function assessment_delete(Request $request)
    {
        $delete = DB::table("holding_assessment")->where("id", $request->pid)->update(['deleted_at' => now()]);

        if($delete){
            return response()->json(['status' => 'success', 'message' => 'Holding assessment delete successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to delete assessment.', 'data' => []]);
    }

    public function bill_generate($id = null)
    {
        $payer_info = [];

        if($id){
            $payer_info = DB::table("holding_assessment AS HA")
                            ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")

                            ->join("holding_settings AS HS2", "HS2.id", "=", "HA.moholla_id")
                            ->where("HA.id", $id)
                            ->select("HA.id", "HA.name", "HA.mobile_no", "HA.father_name", "HA.mother_name", "HA.holding_no", "HS.name AS ward_name", "HS2.name AS moholla_name")
                            ->get()->first();

            // dd($payer_info);
        }

        $ward_list = DB::table("holding_settings")->where("type", 1)->get();
        $fiscal_year_list = Global_model::fiscal_years();

        // dd($fiscal_year_list);

        return view("holding_tax.bill_generate", compact("ward_list", "fiscal_year_list", "payer_info"));
    }

    public function bill_generate_action(Request $request)
    {
        $payer_id = array_key_exists("payer_id", $request->all()) ? $request->payer_id : 0;

        // dd($payer_id);

        $data_qry = DB::table("holding_assessment AS HA")
                    ->leftJoin("acc_invoice AS INV", function($join) use($payer_id){
                        $join->on("INV.union_id", "=", "HA.union_id")
                            ->on("HA.id", "=", "INV.owner_id")
                            ->where("INV.fiscal_year_id", request('fiscal_year_id'))
                            
                            ->when($payer_id > 0, function($q) use($payer_id){
                                $q->where("HA.id", $payer_id);
                            })
                            
                            ->when($payer_id <= 0, function($q){
                                $q->where("HA.ward_id", request('ward_no'));
                            })
                            
                            ->where("INV.type", 25)
                            ->where("INV.union_id", Auth::user()->union_id)
                            ->where("HA.union_id", Auth::user()->union_id)
                            
                            ->whereNull("HA.deleted_at")
                            ->whereNull("INV.deleted_at");
                    })
                    ->leftJoin("acc_voucher AS ACV", function($join) use($payer_id){
                        $join->on("INV.union_id", "=", "ACV.union_id")
                                ->on("INV.invoice_id", "=", "ACV.invoice_id")
                                ->where("INV.type", 25)
                                ->where("ACV.type", 25)
                                ->when($payer_id > 0, function($q) use($payer_id){
                                    $q->where("INV.owner_id", $payer_id);
                                })
                                ->whereNull("INV.deleted_at")
                                ->where("INV.union_id", Auth::user()->union_id)
                                ->where("ACV.union_id", Auth::user()->union_id);
                    })
                    
                    ->whereNull("HA.deleted_at")

                    ->when($payer_id > 0, function($q) use($payer_id){
                        $q->where("HA.id", $payer_id);
                    })
                    
                    ->when($payer_id <= 0, function($q){
                        $q->where("HA.ward_id", request('ward_no'));
                    })

                    ->select("HA.id AS owner_id", "HA.name", "HA.mobile_no", "HA.holding_no", "HA.ward_id", "HA.monthly_tax", "INV.invoice_id", "INV.voucher_no", "INV.fiscal_year_id", "INV.is_paid", "ACV.amount", "ACV.acc_no AS month_id")
                    ->get();

        // dd($data_qry);

        $data = [];

        foreach($data_qry as $item){
            if(isset($data[$item->owner_id])){
                $data[$item->owner_id]['month_id'][] = $item->month_id;
            } else {
                $data[$item->owner_id] = [
                    "owner_id" => $item->owner_id,
                    "name" => $item->name,
                    "mobile_no" => $item->mobile_no,
                    "holding_no" => $item->holding_no,
                    "ward_id" => $item->ward_id,
                    "monthly_tax" => $item->monthly_tax,
                    "month_id" => []
                ];

                if($item->month_id){
                    $data[$item->owner_id]['month_id'][] = $item->month_id;
                }
            }
        }

        // dd($request->all());

        $inv_data = [];
        $voucher_data = [];

        $invoice_id = BillGenerate::generateID();
        $voucher_no = IdGenerate::voucher(Auth::user()->union_id, $request->fiscal_year_id, 25);

        foreach($data as $item){

            $month_ids = array_diff($request->month_id, $item['month_id']);

            // dd($month_ids);

            if(count($month_ids)){
                $inv_data[] = [
                    "union_id" => Auth::user()->union_id,
                    "invoice_id" => $invoice_id,
                    "voucher_no" => $voucher_no,
                    "owner_id" => $item['owner_id'],
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "amount" => (count($month_ids) * $item['monthly_tax']),
                    "type" => 25,   // 25 = holding tax bill
                    "created_at" => now(),
                    "created_by" => Auth::user()->id,
                    "created_by_ip" => $request->ip()
                ];
    
                foreach($month_ids as $list){
                    $voucher_data[] = [
                        "union_id" => Auth::user()->union_id,
                        "invoice_id" => $invoice_id,
                        "voucher_id" => $voucher_no,
                        "amount" => $item['monthly_tax'],
                        "acc_no" => $list,
                        "type" => 25,   // 25 = holding tax
                        "created_at" => now()
                    ];
                }
    
                $invoice_id++;
                $voucher_no++;
            }
            
        }

        // dd($inv_data, $voucher_data);

        DB::beginTransaction();

        try{
            DB::table("acc_invoice")->insert($inv_data);

            DB::table("acc_voucher")->insert($voucher_data);

            DB::commit();

            Alert::toast('Successfully generated holding tax bill.', 'success');

            if($payer_id){
                $invoice_id--;
                return redirect("/holding/tax/bill/collection/".$invoice_id);
            } else {
                return redirect()->back();
            }

        } catch(Exception $e){
            DB::rollBack();

            // dd($e);

            Alert::toast('Fail to generate holding tax bill. Try again.', 'error');
            return redirect()->back();
        }

        // dd($inv_data, $voucher_data);

    }

    public function bill_list(Request $request)
    {
        if($request->ajax()){
            $data = DB::table("holding_assessment AS HA")
                        ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")
                        ->join("acc_invoice AS INV", function($join){
                            $join->on("INV.union_id", "=", "HA.union_id")
                                ->on("HA.id", "=", "INV.owner_id")
                                ->where("INV.type", 25)
                                ->where("INV.union_id", Auth::user()->union_id)
                                ->where("HA.union_id", Auth::user()->union_id)
                                ->whereNull("HA.deleted_at")
                                ->whereNull("INV.deleted_at");
                        })
                        ->whereNull("HA.deleted_at")
                        ->select("HA.name", "HA.mobile_no", "HA.holding_no", "HS.name AS ward_name", "INV.invoice_id", "INV.voucher_no", "INV.amount", "INV.is_paid", DB::raw("DATE_FORMAT(INV.created_at, '%Y-%m-%d') AS created_at"), "INV.id");

            return DataTables::of($data)
                                ->addColumn('action', function($item){
                                    $btn = '<a href="'.url('holding/tax/bill/print/'.$item->invoice_id).'" target="_blank"><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</button></a> ';

                                    if($item->is_paid == 0){
                                        $btn .= '&nbsp;<button class="btn btn-sm btn-danger" onclick="deleteHoldingBill('.$item->invoice_id.')"><i class="fa fa-trash"></i> Delete</button>&nbsp;<a href="'.url('holding/tax/bill/collection/'.$item->invoice_id).'"<button class="btn btn-sm btn-primary"><i class="fa fa-usd"></i> Collection</button></a>';
                                    }

                                    return $btn;
                                })
                                ->setRowId(function($item){
                                    return 'row'.$item->id;
                                })
                                ->make(true);
        }

        return view("holding_tax.bill_list");
    }

    public function bill_print($invoice_id)
    {
        // dd($invoice_id);
        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);
        
        $data_qry = DB::table("acc_invoice AS INV")
                        ->join("acc_voucher AS ACV", function($join) use($invoice_id, $union_id){
                            $join->on("INV.union_id", "=", "ACV.union_id")
                                    ->on("INV.invoice_id", "=", "ACV.invoice_id")
                                    ->on("INV.voucher_no", "=", "ACV.voucher_id")
                                    ->where("INV.union_id", $union_id)
                                    ->where("ACV.union_id", $union_id)
                                    ->where("INV.invoice_id", $invoice_id)
                                    ->where("ACV.invoice_id", $invoice_id)
                                    ->where("INV.type", 25)
                                    ->where("ACV.type", 25);    // 25 = holding
                        })
                        ->join("holding_assessment AS HA", function($join) use($union_id){
                            $join->on("HA.id", "=", "INV.owner_id")
                                    ->on("HA.union_id", "=", "INV.union_id")
                                    ->where("HA.union_id", $union_id)
                                    ->where("INV.union_id", $union_id);
                        })
                        ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")

                        ->join("holding_settings AS HS2", "HS2.id", "=", "HA.moholla_id")

                        ->join("fiscal_years AS FY", "FY.id", "=", "INV.fiscal_year_id")

                        ->selectRaw("HA.name, HA.holding_no, HS.ward_no, HS.name AS ward_name, HS2.name AS moholla_name, INV.invoice_id, INV.voucher_no, FY.name AS fiscal_year_name, INV.amount AS total_amount, INV.is_paid, ACV.amount, ACV.acc_no AS month_id, ACV.fiscal_name, ACV.fee_name")
                        ->get();

        // dd($data_qry);

        $data = [];

        $data = [
            "name" => $data_qry[0]->name,
            "holding_no" => $data_qry[0]->holding_no,
            "ward_no" => $data_qry[0]->ward_no,
            "ward_name" => $data_qry[0]->ward_name,
            "moholla_name" => $data_qry[0]->moholla_name,
            "invoice_id" => $data_qry[0]->invoice_id,
            "voucher_no" => $data_qry[0]->voucher_no,
            "fiscal_year_name" => $data_qry[0]->fiscal_year_name,
            "total_amount" => $data_qry[0]->total_amount,
            "is_paid" => $data_qry[0]->is_paid,
            "details" => [],
            "due" => []
        ];

        foreach($data_qry as $item){
            if($item->month_id == 13){
                $data['due'] = [
                    "fiscal_name" => $item->fiscal_name,
                    "fee_name" => $item->fee_name,
                    "amount" => $item->amount,
                ];
            } else {
                $data['details'][$item->month_id] = $item->amount;
            }
        }

        // dd(($data));

        $pdf = PDF::loadView('holding_tax.bill_print', ['data' => $data,'union' => $union_profile]);

        return $pdf->stream('Holding_tax_invoice.pdf');

        return view('holding_tax.bill_print', ['union' => $union_profile, 'data' => $data]);
    }

    public function bill_delete(Request $request)
    {
        $invoice_id = $request->invoice_id;

        DB::beginTransaction();

        try{
            DB::table("acc_invoice")->where("invoice_id", $invoice_id)->update(["deleted_at" => now()]);

            DB::table("acc_voucher")->where("invoice_id", $invoice_id)->delete();

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Holding bill deleted successfully.', 'data' => []]);
        } catch (Exception $e){
            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => 'Fail to  delete holding bill.', 'data' => []]);
        }
    }

    public function bill_collection($invoice_id = NULL)
    {
        return view("holding_tax.bill_collection", compact('invoice_id'));
    }

    public function invoice_data(Request $request)
    {
        // dd($request->all());
        $search_id = $request->search_id;
        $union_id = Auth::user()->union_id;

        // $union = new Global_model();

        //get union profile data
        // $union_profile = $union->union_profile($union_id);
        
        $data_qry = DB::table("acc_invoice AS INV")
                        ->join("acc_voucher AS ACV", function($join) use($search_id, $union_id){
                            $join->on("INV.union_id", "=", "ACV.union_id")
                                    ->on("INV.invoice_id", "=", "ACV.invoice_id")
                                    ->on("INV.voucher_no", "=", "ACV.voucher_id")
                                    ->where("INV.union_id", $union_id)
                                    ->where("ACV.union_id", $union_id)

                                    // ->where(function($q) use($search_id){
                                    //     $q->where("INV.invoice_id", $search_id)
                                    //     ->orWhere("ACV.invoice_id", $search_id);
                                    // })
                                    
                                    ->where("INV.is_paid", 0)
                                    ->where("INV.type", 25)
                                    ->where("ACV.type", 25);    // 25 = holding
                        })
                        ->join("holding_assessment AS HA", function($join) use($union_id){
                            $join->on("HA.id", "=", "INV.owner_id")
                                    ->on("HA.union_id", "=", "INV.union_id")
                                    ->where("HA.union_id", $union_id)
                                    ->where("INV.union_id", $union_id);
                        })
                        ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")

                        ->join("holding_settings AS HS2", "HS2.id", "=", "HA.moholla_id")

                        ->join("fiscal_years AS FY", "FY.id", "=", "INV.fiscal_year_id")

                        ->where("INV.is_paid", 0)

                        ->where(function($q) use($search_id){
                            $q->where("INV.invoice_id", $search_id)
                                ->orWhere("ACV.invoice_id", $search_id)
                                ->orWhere("HA.holding_no", $search_id);
                        })

                        ->selectRaw("HA.name, HA.holding_no, HS.ward_no, HS.name AS ward_name, HS2.name AS moholla_name, INV.invoice_id, INV.voucher_no, FY.name AS fiscal_year_name, INV.amount AS total_amount, INV.is_paid, ACV.amount, ACV.acc_no AS month_id")
                        ->get();

// dd($data_qry);

        if($data_qry->isEmpty()){
            return response()->json(['status' => 'error', 'message' => 'No unpaid invoice found.', 'data' => []]);
        }

        $data = [];

        $data = [
            "name" => $data_qry[0]->name,
            "holding_no" => $data_qry[0]->holding_no,
            "ward_no" => $data_qry[0]->ward_no,
            "ward_name" => $data_qry[0]->ward_name,
            "moholla_name" => $data_qry[0]->moholla_name,
            "invoice_id" => $data_qry[0]->invoice_id,
            "voucher_no" => $data_qry[0]->voucher_no,
            "fiscal_year_name" => $data_qry[0]->fiscal_year_name,
            "total_amount" => $data_qry[0]->total_amount,
            "is_paid" => $data_qry[0]->is_paid,
            "details" => []
        ];

        foreach($data_qry as $item){
            $data['details'][$item->month_id] = $item->amount;
        }

        if(empty($data)){
            return response()->json(['status' => 'error', 'message' => 'No unpaid invoice found.', 'data' => []]);
        }

        return response()->json(['status' => 'success', 'message' => 'Invoice data found.', 'data' => $data]);
    }

    public function collection_save(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $voucher_no = $request->voucher_no;
        $txn_no = date("ymdhis");
        $voucher_data = [];

        $inv_data = [
            "txn_no" => $txn_no,
            "is_paid" => 1,
            "payment_date" => $request->payment_date,
            "payment_type" => $request->payment_type,
            "updated_at" => now(),
            "updated_by" => Auth::user()->id,
            "updated_by_ip" => $request->ip()
        ];

        // if due amount added
        if(!empty($request->due_amount)){
            $voucher_data = [
                "union_id" => Auth::user()->union_id,
                "invoice_id" => $invoice_id,
                "voucher_id" => $voucher_no,
                "amount" => $request->due_amount,
                "acc_no" => 13, // 13 due amount
                "fiscal_name" => $request->due_fiscal_year,
                "fee_name" => $request->due_months,
                "type" => 25,   // 25 = holding tax
                "created_at" => now()
            ];
        }

        DB::beginTransaction();

        try{
            DB::table("acc_invoice")->where("invoice_id", $invoice_id)->update($inv_data);

            if(!empty($voucher_data)){
                DB::table("acc_voucher")->insert($voucher_data);
            }

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Bill collection successfully done.', 'data' => []]);
        } catch(Exception $e){
            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => 'Fail to collect bill. Please try again.', 'data' => []]);
        }
        
    }

    // report
    public function report_cash()
    {
        return view("holding_tax.cash_report");
    }
    
    public function report_action(Request $request)
    {
        // dd($request->all());

        $fiscal_year_id = $request->fiscal_year_id;
        $ward_no = $request->ward_no;
        $property_type = $request->property_type;
        $owner_type = $request->owner_type;

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $payment_type = $request->payment_type;
        
        $union_id = Auth::user()->union_id;

        $data = DB::table("acc_invoice AS INV")
                    ->join("holding_assessment AS HA", function($join) use($union_id, $from_date, $to_date){
                        $join->on("HA.id", "=", "INV.owner_id")
                                ->on("HA.union_id", "=", "INV.union_id")
                                ->where("HA.union_id", $union_id)
                                ->where("INV.union_id", $union_id)
                                ->whereDate("INV.payment_date", ">=", $from_date)
                                ->whereDate("INV.payment_date", "<=", $to_date);
                    })
                    ->join("holding_settings AS HS", "HS.id", "=", "HA.ward_id")

                    ->join("holding_settings AS HS2", "HS2.id", "=", "HA.moholla_id")
                    ->where("INV.is_paid", 1)   // 1 = paid
                    ->where("INV.type", 25) // holding type invoice
                    ->whereDate("INV.payment_date", ">=", $from_date)
                    ->whereDate("INV.payment_date", "<=", $to_date)
                    ->whereNull("INV.deleted_at")
                    
                    ->when($fiscal_year_id > 0, function($q) use($fiscal_year_id){
                        $q->where("INV.fiscal_year_id", $fiscal_year_id);
                    })
                    ->when($ward_no > 0, function($q) use($ward_no){
                        $q->where("HA.ward_id", $ward_no);
                    })
                    ->when($property_type > 0, function($q) use($property_type){
                        $q->where("HA.property_id", $property_type);
                    })
                    ->when($owner_type > 0, function($q) use($owner_type){
                        $q->where("HA.owner_type", $owner_type);
                    })
                    ->when($payment_type > 0, function($q) use($payment_type){
                        $q->where("INV.payment_type", $payment_type);
                    })

                    ->select("HA.name", "HA.mobile_no", "HA.holding_no", "INV.voucher_no", "INV.amount", "INV.payment_date", "INV.payment_type", "INV.type", "HS.name AS ward_name", "HS.ward_no", "HS2.name AS moholla_name")

                    ->get();

        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;
        $union_profile->payment_type = $payment_type;
        
        $union_profile->ward_no = $ward_no;
        $union_profile->property_type = $property_type;
        $union_profile->owner_type = $owner_type;

        if($ward_no){
            $ward_info = DB::table("holding_settings")->where("id", $ward_no)->get()->first();

            // dd($ward_info);

            $union_profile->ward_name = $ward_info->ward_no . '-' . $ward_info->name;
        }
        
        if($property_type){
            $union_profile->property_name = DB::table("holding_settings")->where("id", $property_type)->get()->first()->name;
        }
        
        if($owner_type){
            $union_profile->owner_name = $owner_type == 1 ? 'ভাড়া' : 'ব্যক্তি মালিকানা';
        }

        // dd($union_profile);

        $pdf = PDF::loadView('holding_tax.report_print', ['data' => $data,'union' => $union_profile]);

        $file_name = $payment_type == 1 ? "Holding_tax_cash_report.pdf" : "Holding_tax_bank_report.pdf";

        return $pdf->stream($file_name);

        dd($data);
    }

    public function report_bank()
    {
        return view("holding_tax.bank_report");
    }
    
    public function report_others()
    {
        $fiscal_year_list = Global_model::fiscal_years();
        $ward_list = DB::table("holding_settings")->where("type", 1)->get();
        
        $property_list = DB::table("holding_settings AS HS")
                            ->leftJoin("holding_area_rate AS HAR", "HS.id", "=", "HAR.property_id")
                            ->where("HS.type", 4)
                            ->select("HS.id", "HS.name", "HAR.fee")
                            ->get();

        return view("holding_tax.others_report", compact('fiscal_year_list', 'ward_list', 'property_list'));
    }

    // settings
    public function ward_settings(Request $request)
    {
        if($request->ajax()){
            $data = DB::table("holding_settings")
                        ->where("type", 1)  // 1 = ward
                        ->whereNull("deleted_at");

            return DataTables::of($data)
                                ->addColumn('action', function($item){
                                    return '<button class="btn btn-sm btn-danger" onclick="deleteWard('.$item->id.')"><i class="fa fa-trash"></i> Delete</button>';
                                })
                                ->setRowId(function($item){
                                    return 'row'.$item->id;
                                })
                                ->make(true);
        }

        return view("holding_tax.settings_ward");
    }

    public function store_ward_settings(Request $request)
    {
        $insert = DB::table("holding_settings")
                        ->insert([
                            "ward_no" => $request->ward_no,
                            "name" => $request->ward_name,
                            "type" => 1 // 1 = holding
                        ]);

        if($insert){
            return response()->json(['status' => 'success', 'message' => 'Ward save successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to save Ward. Try again.', 'data' => []]);
    }
    
    public function update_ward_settings(Request $request)
    {
        $update = DB::table("holding_settings")
                        ->where("id", $request->pid)
                        ->update([
                            "ward_no" => $request->ward_no,
                            "name" => $request->ward_name,
                            "type" => 1 // 1 = holding
                        ]);

        if($update){
            return response()->json(['status' => 'success', 'message' => 'Ward update successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to update Ward. Try again.', 'data' => []]);
    }

    public function delete_ward_settings(Request $request)
    {
        $delete = DB::table("holding_settings")->where("id", $request->pid)->update(['deleted_at' => now()]);

        if($delete){
            return response()->json(['status' => 'success', 'message' => 'Ward delete successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to delete Ward.', 'data' => []]);
    }
    
    // moholla
    public function moholla_settings(Request $request)
    {
        if($request->ajax()){
            $data = DB::table("holding_settings")
                        ->where("type", 2)  // 2 = moholla
                        ->whereNull("deleted_at");

            return DataTables::of($data)
                                ->addColumn('action', function($item){
                                    return '<button class="btn btn-sm btn-danger" onclick="deleteMoholla('.$item->id.')"><i class="fa fa-trash"></i> Delete</button>';
                                })
                                ->setRowId(function($item){
                                    return 'row'.$item->id;
                                })
                                ->make(true);
        }

        return view("holding_tax.settings_moholla");
    }

    public function store_moholla_settings(Request $request)
    {
        $insert = DB::table("holding_settings")
                        ->insert([
                            "name" => $request->name,
                            "type" => 2 // 2 = moholla
                        ]);

        if($insert){
            return response()->json(['status' => 'success', 'message' => 'Moholla save successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to save moholla. Try again.', 'data' => []]);
    }
    
    public function update_moholla_settings(Request $request)
    {
        $update = DB::table("holding_settings")
                        ->where("id", $request->pid)
                        ->update([
                            "name" => $request->name,
                            "type" => 2 // 2 = moholla
                        ]);

        if($update){
            return response()->json(['status' => 'success', 'message' => 'Moholla update successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to update Moholla. Try again.', 'data' => []]);
    }

    public function delete_moholla_settings(Request $request)
    {
        $delete = DB::table("holding_settings")->where("id", $request->pid)->update(['deleted_at' => now()]);

        if($delete){
            return response()->json(['status' => 'success', 'message' => 'Moholla delete successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to delete Moholla.', 'data' => []]);
    }
    
    // block
    public function block_settings(Request $request)
    {
        if($request->ajax()){
            $data = DB::table("holding_settings")
                        ->where("type", 3)  // 3 = block
                        ->whereNull("deleted_at");

            return DataTables::of($data)
                                ->addColumn('action', function($item){
                                    return '<button class="btn btn-sm btn-danger" onclick="deleteBlock('.$item->id.')"><i class="fa fa-trash"></i> Delete</button>';
                                })
                                ->setRowId(function($item){
                                    return 'row'.$item->id;
                                })
                                ->make(true);
        }

        return view("holding_tax.settings_block");
    }

    public function store_block_settings(Request $request)
    {
        $insert = DB::table("holding_settings")
                        ->insert([
                            "name" => $request->name,
                            "type" => 3 // 3 = block
                        ]);

        if($insert){
            return response()->json(['status' => 'success', 'message' => 'Block save successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to save block. Try again.', 'data' => []]);
    }
    
    public function update_block_settings(Request $request)
    {
        $update = DB::table("holding_settings")
                        ->where("id", $request->pid)
                        ->update([
                            "name" => $request->name,
                            "type" => 3 // 3 = block
                        ]);

        if($update){
            return response()->json(['status' => 'success', 'message' => 'Block update successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to update Block. Try again.', 'data' => []]);
    }

    public function delete_block_settings(Request $request)
    {
        $delete = DB::table("holding_settings")->where("id", $request->pid)->update(['deleted_at' => now()]);

        if($delete){
            return response()->json(['status' => 'success', 'message' => 'Block delete successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to delete Block.', 'data' => []]);
    }
    
    // property type
    public function property_type_settings(Request $request)
    {
        if($request->ajax()){
            $data = DB::table("holding_settings")
                        ->where("type", 4)  // 4 = property type
                        ->whereNull("deleted_at");

            return DataTables::of($data)
                                ->addColumn('action', function($item){
                                    return '<button class="btn btn-sm btn-danger" onclick="deletePropertyType('.$item->id.')"><i class="fa fa-trash"></i> Delete</button>';
                                })
                                ->setRowId(function($item){
                                    return 'row'.$item->id;
                                })
                                ->make(true);
        }

        return view("holding_tax.settings_property_type");
    }

    public function store_property_type_settings(Request $request)
    {
        $insert = DB::table("holding_settings")
                        ->insert([
                            "name" => $request->name,
                            "type" => 4 // 4 = property type
                        ]);

        if($insert){
            return response()->json(['status' => 'success', 'message' => 'Property type save successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to save property type. Try again.', 'data' => []]);
    }
    
    public function update_property_type_settings(Request $request)
    {
        $update = DB::table("holding_settings")
                        ->where("id", $request->pid)
                        ->update([
                            "name" => $request->name,
                            "type" => 4 // 4 = property type
                        ]);

        if($update){
            return response()->json(['status' => 'success', 'message' => 'Property type update successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to update property type. Try again.', 'data' => []]);
    }

    public function delete_property_type_settings(Request $request)
    {
        $delete = DB::table("holding_settings")->where("id", $request->pid)->update(['deleted_at' => now()]);

        if($delete){
            return response()->json(['status' => 'success', 'message' => 'Property type delete successful.', 'data' => []]);
        }

        return response()->json(['status' => 'error', 'message' => 'Fail to delete Property type.', 'data' => []]);
    }

    public function area_tax()
    {
        $data = DB::table("holding_settings AS HS")
                    ->leftJoin("holding_area_rate AS HAR", "HAR.property_id", "=", "HS.id")
                    ->whereNull("HS.deleted_at")
                    ->where("HS.type", 4)
                    ->select("HS.name", "HS.id AS property_id", "HAR.id", "HAR.fee")
                    ->get();

        // dd($data);

        return view('holding_tax.area_tax_rate', compact("data"));
    }

    public function area_tax_action(Request $request)
    {
        $fee_list = array_filter($request->fee);

        DB::beginTransaction();

        try{
            foreach($fee_list as $key => $item){
                if(empty($request->id[$key])){  // insert
                    DB::table("holding_area_rate")->insert([
                        "property_id" => $request->property_id[$key],
                        "fee" => $item
                    ]);
                } else {    // update
                    DB::table("holding_area_rate")
                        ->where("id", $request->id[$key])
                        ->update([
                            "property_id" => $request->property_id[$key],
                            "fee" => $item
                        ]);
                }
            }

            DB::commit();
            
            Alert::toast('Successfully save the business fee settings.', 'success');
        } catch(Exception $e){
            DB::rollBack();

            Alert::toast('Successfully save the business fee settings.', 'success');
        }

        return redirect()->back();

    }

}
