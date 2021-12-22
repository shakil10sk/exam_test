<?php

namespace App\Http\Controllers;

use App\Http\Requests\Applications\FormRequestRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\FormUpdateRequestRule;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Global_model;
use App\Models\IdGenerate;
use App\Models\Geocode\BdLocation;
use App\Models\Management\Union\UnionInformation;
use App\Models\SuperAdmin;
use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PDF;

use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

// use function GuzzleHttp\json_encode;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    //union add form
    public function union_add()
    {

        return view('super_admin.union_setup');
    }

    //union store
    public function union_store(Request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            'union_code' => ['required', 'min:6', 'max:8', 'unique:union_information,union_code'],
            'sub_domain' => ['required', 'min:3', 'unique:union_information,sub_domain']
        ], [
            'unique' => 'পৌরসভা কোড আগে নেওয়া হয়েছে।',
        ]);

        $super_admin = new SuperAdmin();

        // dd($request->all());
        $response = $super_admin->union_information_save($request);
        // dd($response);


        if ($response['status'] == 'success') {

            Alert::alert()->html("<i>পৌরসভা টি সফলভাবে রেজিষ্ট্রেশন করা হয়েছে</i>")->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false, true);

            return redirect('super_admin/union_list');

        } else {

            Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');

            return redirect()->back()->withInput();
        }


    }

    //union edit
    public function union_edit($id = NULL)
    {

        $super_admin = new SuperAdmin();

        $response = $super_admin->union_information($id);
        // dd($response);

        return view('super_admin.union_edit')->with('data', $response);

    }

    //union update
    public function union_updates(Request $request)
    {

        $super_admin = new SuperAdmin();

        $response = $super_admin->union_update_save($request);

        if ($response['status'] == 'success') {

            Alert::alert()->html("<i>পৌরসভা টি সফলভাবে আপডেট করা হয়েছে</i>")->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false, true);

            return redirect('super_admin/union_list');

        } else {
            Alert::toast($response['message'] ?? 'আবেদন সম্পূর্ণ হয়নি!', 'error');

            return redirect()->back()->withInput();
        }

    }

    // union_delete
    public function union_delete($id)
    {

        DB::transaction(function () use ($id) {
            UnionInformation::whereId($id)->update([
                'is_active' => 0,
                'is_process' => 0,
                'is_process_web' => 0,

                'deleted_at' => date('Y-m-d h:i:s')
            ]);

            // User::where('union_id', UnionInformation::find($id)->union_code)->update([
            //     'status' => 0,
            //     'deleted_at' => date('Y-m-d h:i:s')
            // ]);

        });


        return redirect()->route('home');

    }

    // union status
    public function status_change($id)
    {

        UnionInformation::whereId($id)->update([

            'is_active' => !UnionInformation::find($id)->is_active, // toggle status
            'is_process' => 0,
            'is_process_web' => 0,

            'updated_by' => Auth::user()->id,
            'updated_by_ip' => FacadesRequest::ip(),
        ]);
        return redirect()->route('union_list');
    }

    //union list
    public function union_list()
    {

        // get all district
        $district = Global_model::get_all_location();

        return view('super_admin.union_list')->with(['data' => $district]);

    }

    //union list data
    public function union_list_data(Request $request)
    {

        // header("Content-Type: application/json");

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $district_id = (isset($request->district_id)) ? $request->district_id : 0;
        $upazila_id = (isset($request->upazila_id)) ? $request->upazila_id : 0;
        $union_code = (isset($request->union_code)) ? $request->union_code : 0;


        $super_admin = new SuperAdmin();

        $response = $super_admin->union_list_data($district_id, $upazila_id, $union_code, $search_content, $start, $limit);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

        echo json_encode($response);

    }

    //bd location list
    public function bd_location_list()
    {
        // get all district
        $district = Global_model::get_all_location();

        return view('super_admin.bd_location_list')->with(['data' => $district]);

    }

    //bdlocation list data
    public function bd_location_list_data(Request $request)
    {

        // header("Content-Type: application/json");

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;

        $district_id = (isset($request->district_id)) ? $request->district_id : 0;
        $upazila_id = (isset($request->upazila_id)) ? $request->upazila_id : 0;
        $postoffice_id = (isset($request->postoffice_id)) ? $request->postoffice_id : 0;

        $super_admin = new SuperAdmin();

        $response = $super_admin->bd_location_list_data($district_id, $upazila_id, $postoffice_id, $search_content, $start, $limit);
        // dd($response);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

        echo json_encode($response);

    }

    //===save bd location=====//
    public function bd_location_save(Request $request)
    {

        $district_id = isset($request->district_id) ? $request->district_id : 0;
        $upazila_id = isset($request->upazila_id) ? $request->upazila_id : 0;
        $en_name = isset($request->en_name) ? $request->en_name : translateToEnglish($request->bn_name) ;
        $bn_name = isset($request->bn_name) ? $request->bn_name : 0;
        $post_code = isset($request->post_code) ? $request->post_code : 0;


        $data_id = [

            "district_id" => $district_id,
            "upazila_id" => $upazila_id,
            "post_code" => $post_code,
            "en_name" => $en_name,
            "bn_name" => $bn_name,
        ];

        // dd($data_id);
        // exit;

        $data = [

            "en_name" => $en_name,
            "bn_name" => $bn_name,
        ];

        if ($upazila_id > 0) {

            $data['parent_id'] = $upazila_id;

            //for post office
            $data['type'] = 6;
            $data['post_code'] = $post_code;

        } else if ($district_id > 0) {

            //for upazila
            $data['parent_id'] = $district_id;
            $data['type'] = 3;
            $data['post_code'] = 0;

        } else {

            //default District set
            $data['parent_id'] = NULL;
            $data['type'] = 2;
            $data['post_code'] = 0;
        }

        $super_admin = new SuperAdmin();

        $response = $super_admin->bd_location_save($data);

        echo json_encode($response);

    }

    //===bd location update save===//
    public function bd_location_update_save(Request $request)
    {

        $district_id = isset($request->district_id) ? $request->district_id : 0;
        $upazila_id = isset($request->upazila_id) ? $request->upazila_id : 0;
        $en_name = isset($request->en_name) ? $request->en_name : 0;
        $bn_name = isset($request->bn_name) ? $request->bn_name : 0;
        $post_code = isset($request->post_code) ? $request->post_code : 0;
        $row_id = isset($request->row_id) ? $request->row_id : 0;


        $data = [

            "en_name" => $en_name,
            "bn_name" => $bn_name,
        ];

        if ($upazila_id > 0) {

            $data['parent_id'] = $upazila_id;

            //for post office
            $data['type'] = 6;
            $data['post_code'] = $post_code;

        } else if ($district_id > 0) {

            //for upazila
            $data['parent_id'] = $district_id;
            $data['type'] = 3;
            $data['post_code'] = 0;

        } else {

            //default District set
            $data['parent_id'] = NULL;
            $data['type'] = 2;
            $data['post_code'] = 0;
        }

        $super_admin = new SuperAdmin();

        $response = $super_admin->bd_location_update_save($data, $row_id);

        echo json_encode($response);

    }

    //=====bd location delete===//
    public function bd_location_delete(Request $request)
    {

        $super_admin = new SuperAdmin();


        $response = $super_admin->bd_location_delete($request->id);

        echo json_encode($response);
    }

    //this is for support
    public function other_support()
    {

        // get all district
        $district = Global_model::get_all_location();

        return view('super_admin.other_support')->with(['data' => $district]);

    }

    //get fee info
    public function get_fee_info(Request $request)
    {

        // DB::enableQueryLog();

        $query = DB::table('acc_transaction AS TRNS')
            ->select('ACC1.account_name as credit_account', 'ACC2.account_name as debit_account', 'TRNS.*')
            ->join('acc_account AS ACC1', function ($join) {
                $join->on('ACC1.id', '=', 'TRNS.credit');
            })
            ->join('acc_account AS ACC2', function ($join) {
                $join->on('ACC2.id', '=', 'TRNS.debit');
            })
            ->where('TRNS.union_id', $request->union_id)
            ->where('TRNS.voucher', (int)$request->voucher)
            ->where('TRNS.is_active', 1)
            ->where('TRNS.type', '!=', 19)
            ->where('TRNS.type', '!=', 28)
            ->first();

        // if(strlen($request->voucher) < 17){

        //     $query->where('TRNS.voucher', (int)$request->voucher);

        // }else{
        //     $query->where('TRNS.sonod_no', (int)$request->voucher);
        // }

        // $data = $query->first();


        if (!empty($query)) {
            echo json_encode(['status' => 'success', 'data' => $query]);
        } else {
            echo json_encode(['status' => 'error', 'data' => []]);
        }


    }

    //fee update save
    public function fee_update(Request $request)
    {

        $data = [
            'amount' => $request->amount,
            'updated_time' => date('Y-m-d h:i:s'),
            'updated_by_ip' => $request->ip(),
            'updated_by' => Auth::user()->id
        ];

        $update = DB::table('acc_transaction')
            ->where(['id' => $request->id, 'union_id' => $request->union_id])
            ->update($data);

        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'ফি সংশোধন করা হয়েছে']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ফি সংশোধন হয়নি।']);
        }

    }

    //fee delete
    public function fee_delete(Request $request)
    {

        $data = [

            'is_active' => 0,
            'updated_time' => Carbon::now(),
            'updated_by' => Auth::user()->id,
            'updated_by_ip' => $request->ip(),
        ];

        $delete = DB::table('acc_transaction')
            ->where(['id' => $request->id, 'union_id' => $request->union_id])
            ->update($data);

        if ($delete) {
            return Response::json(["status" => "success", "message" => "Fee successfully delete"]);
        } else {
            return Response::json(["status" => "error", "message" => "Fee delete failed"]);
        }

    }

    //this is for trade license support
    public function trade_support()
    {
        // get all district
        $district = Global_model::get_all_location();

        return view('super_admin.trade_support')->with(['data' => $district]);

    }

    //get_trade_fee_info
    public function get_trade_fee_info(Request $request)
    {


        $union_id = $request->union_id;

        $fee_data = DB::table('acc_transaction AS TRNS')
            ->select('ACCDBT.account_name as debit_account_name', 'ACCDBT.acc_type as debit_account_type', 'ACCRDT.account_name as credit_account_name', 'ACCRDT.acc_type as credit_account_type', 'TRNS.amount', 'TRNS.id as transection_id', 'TRNS.created_time', 'TRNS.sonod_no', 'TRNS.voucher', 'CRT.due_fiscal_year')
            ->leftJoin('acc_account AS ACCDBT', function ($join) use ($union_id) {

                $join->on('ACCDBT.id', '=', 'TRNS.debit')
                    ->on('ACCDBT.union_id', '=', 'TRNS.union_id')
                    ->where('ACCDBT.is_active', 1)
                    ->where('ACCDBT.union_id', $union_id);
            })
            ->Join('acc_account AS ACCRDT', function ($join) use ($union_id) {

                $join->on('ACCRDT.id', '=', 'TRNS.credit')
                    ->on('ACCRDT.union_id', '=', 'TRNS.union_id')
                    // ->where('ACCRDT.acc_type', 24)
                    ->where('ACCRDT.is_active', 1)
                    ->where('ACCRDT.union_id', $union_id);
            })
            ->leftJoin('certificate AS CRT', function ($join) use ($union_id) {

                $join->on('CRT.sonod_no', '=', 'TRNS.sonod_no')
                    ->on('CRT.union_id', '=', 'TRNS.union_id')
                    ->on('CRT.fiscal_year_id', '=', 'TRNS.fiscal_year_id')
                    ->where('CRT.is_active', 1)
                    ->where('CRT.union_id', $union_id);
            })

            //for pehsa kor and trade transection
            ->where(function ($query) {
                $query->where('TRNS.type', '=', 28)
                    ->orWhere('TRNS.type', '=', 19);
            })
            ->where('TRNS.voucher', $request->voucher)
            ->where('TRNS.is_active', 1)
            ->get();

        // dd($fee_data);

        $fee_list = [];
        $total = 0;
        $other_data = [];

        foreach ($fee_data as $fee) {

            if ($fee->credit_account_name != '') {

                $fee_list[$fee->credit_account_type] = [
                    'account_name' => $fee->credit_account_name,
                    'amount' => $fee->amount,
                    'transection_id' => $fee->transection_id,
                    'created_time' => $fee->created_time,

                ];


            } else {

                $fee_list[$fee->debit_account_type] = [
                    'account_name' => $fee->debit_account_name,
                    'amount' => $fee->amount,
                    'transection_id' => $fee->transection_id,
                    'created_time' => $fee->created_time,
                ];


            }

            $total += $fee->amount;

            $other_data = [
                'created_time' => $fee->created_time,
                'total' => $total,
                'union_id' => $union_id,
                'voucher' => $fee->voucher,
                'sonod_no' => $fee->sonod_no,
                'due_fiscal_year' => $fee->due_fiscal_year,
            ];


        }


        return view('super_admin.trade_fee_edit')->with(['data' => $fee_list, 'other_data' => $other_data]);


    }

    //trade license fee update save
    public function trade_fee_update_save(Request $request)
    {

        $super_admin = new SuperAdmin();

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($request->union_id);

        $request['fiscal_year_id'] = $fiscal_year_id;

        $response = $super_admin->trade_fee_update_save($request);

        // return redirect()->with->input();
        return redirect()->route('trade_support')->with($response['status'], $response['message']);


    }

    //trade fee delete
    public function trade_fee_delete(Request $request)
    {


        $data = [

            'is_active' => 0,
            'updated_time' => Carbon::now(),
            'updated_by' => Auth::user()->id,
            'updated_by_ip' => $request->ip(),
        ];

        $where = [
            'voucher' => $request->voucher,
            'sonod_no' => $request->sonod_no,
            'union_id' => $request->union_id,
        ];


        $delete = DB::table('acc_transaction')
            ->where($where)
            ->update($data);


        if ($delete) {

            return Response::json(["status" => "success", "message" => "Fee successfully delete"]);

        } else {

            return Response::json(["status" => "error", "message" => "Fee delete failed"]);
        }

    }

    // impersonation
    public function impersonate($username)
    {
        $user = User::where('username', $username)->first();
        // dd($user);
        if ($user) {
            session()->put('impersonate', $user->id);
        }
        return redirect()->route('home');
    }

    public function distroyImpersonate()
    {
        session()->forget('impersonate');
        return redirect()->route('union_list');
    }

    //for fiscal year list
    public function fiscal_year_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('fiscal_years')->where('is_active', 1)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('super_admin.fiscal_year_list');
    }

    //fiscal year save
    public function fiscal_year_save(Request $request)
    {


        $data = [

            'name' => $request->name,
            'expire_date' => $request->expire_date,
            'is_current' => (isset($request->is_current)) ? 1 : 0,
        ];

        try {

            if ($request->row_id > 0) {

                if ($data['is_current'] && !FiscalYear::find($request->row_id)->is_current) {
                    DB::table('fiscal_years')->update(['is_current' => 0, 'is_process' => 0]);
                }

                $data['updated_time'] = date('Y-m-d h:i:s');
                $data['updated_by'] = Auth::user()->id;
                $data['updated_by_ip'] = $request->ip();
                $data['is_process'] = 0;

                DB::table('fiscal_years')->where('id', $request->row_id)->update($data);

                return Response::json(['status' => 'success', 'message' => 'অর্থবছর আপডেট সম্পন্ন হয়েছে']);

            } else {

                $name_exist = FiscalYear::where('name', trim($data['name']))->first();

                if ($name_exist) {
                    return Response::json(['status' => 'error', 'message' => 'অর্থবছর পূর্বে দেওয়া হয়েছে।']);
                }

                $data['created_time'] = date('Y-m-d h:i:s');
                $data['created_by'] = Auth::user()->id;
                $data['created_by_ip'] = $request->ip();

                DB::table('fiscal_years')->insert($data);

                return Response::json(['status' => 'success', 'message' => 'অর্থবছর সম্পন্ন হয়েছে']);

            }


            //code...
        } catch (\Throwable $th) {

            return Response::json(['status' => 'error', 'message' => 'রিপোর্ট সম্পন্ন হয়নি।']);
        }

    }


    // ====== Designation =========== //

    public function designation(Request $request)
    {


        if ($request->ajax()) {

            $data = DB::table('designation')->where('is_active',1)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);

        } else {
           return view('super_admin.designation');
        }

    }


    public function designationStore(Request $request){

        $existsDesignation = DB::table('designation')->where('name',trim($request->name))->count();


        if ($existsDesignation > 0 ){
            Alert::toast('এই পদবী আগে যোগ করা হয়েছে', 'error');
            return redirect()->back();
        }

        $designationData = [
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now() ,
            'created_by_ip' => \request()->ip() ,
        ];

        $isSave = DB::table('designation')->insert($designationData);

        if ($isSave){
            Alert::toast('সফলভাবে যোগ হয়েছে', 'success');
        }else{
            Alert::toast('কোন সমস্যা আছে।দয়াকরে আবার চেষ্টা করুন', 'error');
        }

        return redirect()->back();


    }



    public function designationUpdate(Request $request){

        $existsDesignation = DB::table('designation')->where('name',trim($request->name))->where('id','!=',
            $request->row_id )
            ->count();


        if ($existsDesignation > 0 ){
            Alert::toast('এই পদবী আগে যোগ করা হয়েছে', 'error');
            return redirect()->back();
        }

        $designationData = [
            'name' => $request->name,
            'is_process' => 0,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now() ,
            'updated_by_ip' => \request()->ip() ,
        ];

        $isUpdate = DB::table('designation')->where('id',$request->row_id)->update($designationData);

        if ($isUpdate){
            Alert::toast('সফলভাবে আপডেট হয়েছে', 'success');
        }else{
            Alert::toast('কোন সমস্যা আছে।দয়াকরে আবার চেষ্টা করুন', 'error');
        }

        return redirect()->back();


    }


    public function designationDelete($row_id){

        $existsDesignation = DB::table('employees')->where('designation_id',$row_id)->where('is_active',1)->whereNull('deleted_at')->count();


        if ($existsDesignation > 0 ){

            return \response()->json([
                "status" => "error",
                "message" => "এই পদবী আপনি কর্মকর্তার ক্ষেত্রে ব্যবহার করেছেন।"
            ]);
        }

        $designationData = [
            'is_active' => 0,
            'is_process' => 0,
        ];

        $isDelete = DB::table('designation')->where('id',$row_id)->update($designationData);

        return \response()->json([
            "status" =>$isDelete ? "success":"error",
            "message" =>$isDelete ? "সফলভাবে মুছে ফেলা হয়েছে":"কোন সমস্যা আছে। দয়াকরে আবার চেষ্টা করুন",
        ]);




    }

}
