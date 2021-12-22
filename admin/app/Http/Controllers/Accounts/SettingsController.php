<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Accounts\Settings;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

use Response;
use DataTables;

use function GuzzleHttp\json_encode;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account_list()
    {

        $type = range(100,106);

        //get bank and cash account info
        $data = DB::table('acc_account')
            ->select('id', 'account_name', 'account_code')
            ->where('union_id', Auth::user()->union_id)
            ->whereNotIn('acc_type',$type)
            ->where('parent_id', NULL)
            ->where('head_type', NULL)
            ->orWhereNull('acc_type')
            ->where('is_active', 1)
            ->get();


        return view('accounts.settings.account_list')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function account_save(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'account_code' => 'required',

        ],

        [
            "account_name.required" => "একাউন্ট নাম দিতে হবে",
            "account_code.required" => "একাউন্ট কোড দিতে হবে",
        ]
        );


        if ($validator->passes()) {

            //get union id
            $union_id = Auth::user()->union_id;


            $generate = new IdGenerate();

            //get current fiscal year id
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);

            //create voucher no
            $voucher_no = $generate->voucher($union_id, $fiscal_year_id);


            $request['fiscal_year_id'] = $fiscal_year_id;
            $request['voucher'] = $voucher_no;
            $request['union_id'] = $union_id;


            $data = new Settings();

            $response = $data->account_save($request);

            // dd($response);



            return Response::json($response);

        }

        return Response::json(['errors' => $validator->errors()]);



    }

    //==account update ===

    public function account_update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'account_code' => 'required',

        ],

        [
            "account_name.required" => "একাউন্ট নাম দিতে হবে",
            "account_code.required" => "একাউন্ট কোড দিতে হবে",

        ]
        );


        if ($validator->passes()) {

            //get union id
            $union_id = Auth::user()->union_id;

            $request['union_id'] = $union_id;

            $data = new Settings();

            $response = $data->update_account($request);


            return Response::json($response);

        }

        return Response::json(['errors' => $validator->errors()]);


    }



    //===account list data===//
    public function account_list_data(Request $request){


        header("Content-Type: application/json");

        $union_id = Auth::user()->union_id;

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $from_date = (isset($request->from_date)) ? $request->from_date : date('Y-m-d');

        $to_date = (isset($request->to_date)) ? $request->to_date : date('Y-m-d');

        $request_data = [

            'union_id' => $union_id,
            'start' => $start,
            'limit' => $limit,

        ];


        $account_list = new Settings();

        $response = $account_list->account_list_data($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

       return Response::json($response);


    }

    //account delete

    public function account_delete(Request $request){

        $request['union_id'] = Auth::user()->union_id;

        $data = new Settings();

        $response = $data->account_delete($request);

        echo json_encode($response);
    }

    //this if for fund add
    public function fund(Request $request){



        $data = DB::table('acc_account')
        ->select('id', 'account_name', 'account_code')
        ->where('union_id', Auth::user()->union_id)
        ->where('parent_id', NULL)
        ->where('head_type', NULL)
        ->where('is_active', 1)
        ->get();


        return view('accounts.settings.fund')->with('data',$data);
    }

    //fund list data
    public function fund_list_data(Request $request){

        header("Content-Type: application/json");

        $union_id = Auth::user()->union_id;

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $request_data = [

            'union_id' => $union_id,
            'start' => $start,
            'limit' => $limit,

        ];


        $fund_list = new Settings();

        $response = $fund_list->fund_list_data($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

       return Response::json($response);
    }

    //for fund store
    public function fund_store(Request $request){


        //get union id
        $union_id = Auth::user()->union_id;

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);


        $generate = new IdGenerate();

        //create voucher no
        $voucher_no = $generate->voucher($union_id, $fiscal_year_id);

        $account_id = ($request->sub_head > 0) ? $request->sub_head : $request->head;

        //get acc type
        $acc_type_data = DB::table('acc_account')->where(['id' => $account_id, 'union_id' => $union_id])->first();

        // dd();

       $data = [

            'union_id' => $union_id,
            'fiscal_year_id' => $fiscal_year_id,
            'voucher' => $voucher_no,
            'credit' => ($request->sub_head > 0) ? $request->sub_head : $request->head,
            'debit' => NULL,
            'type' => $acc_type_data->acc_type,
            'amount' => $request->amount,
            'comment' => $request->comment,
            'balance_type' => 2,
            'created_by' => Auth::user()->id,
            'created_time' => date('Y-m-d h:i:s'),
            'created_by_ip' => $request->ip(),

       ];

       $insert = DB::table('acc_transaction')->insert($data);

       if($insert){

            return Response::json(['status' => 'success', 'message' => 'ফান্ড যুক্ত হয়েছে।']);
       }else{
            return Response::json(['status' => 'error', 'message' => 'ফান্ড যুক্ত হয়নি।']);
       }


    }

    //fund update save
    public function fund_update_save(Request $request){

        //get union id
        $union_id = Auth::user()->union_id;

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $account_id = ($request->sub_head > 0) ? $request->sub_head : $request->head;

        //get acc type
        $acc_type_data = DB::table('acc_account')->where(['id' => $account_id, 'union_id' => $union_id])->first();

       $data = [

            'credit' => ($request->sub_head > 0) ? $request->sub_head : $request->head,
            'debit' => NULL ,
            'amount' => $request->amount,
            'comment' => $request->comment,
            'type' => $acc_type_data->acc_type,
            'updated_by' => Auth::user()->id,
            'updated_time' => date('Y-m-d h:i:s'),
            'updated_by_ip' => $request->ip(),

       ];

       $update = DB::table('acc_transaction')
            ->where(['id' => $request->transection_id, 'union_id' => $union_id])
            ->update($data);

       if($update){

            return Response::json(['status' => 'success', 'message' => 'ফান্ড টাকা আপডেট হয়েছে।']);
       }else{
            return Response::json(['status' => 'error', 'message' => 'ফান্ড টাকা আপডেট হয়নি।']);
       }


    }

}
