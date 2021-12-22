<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Requests\Applications\FormRequestRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\FormUpdateRequestRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Accounts\Settings;
use App\Models\Accounts\Accounts;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

use Response;
use Yajra\DataTables\Facades\DataTables;

class AccountsController extends Controller
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
    public function registers(Request $r)
    {
        return view('accounts.registers')->withSelect(key($r->all()));
    }


    //daily trade, pesha, vat collection report
    public function daily_reports(Request $r){

        return view('accounts.reports.all_report')->withSelect(key($r->all()));
    }

    //daily all collection report

    public function daily_all_collection($from_date = null, $to_date = null){

        $accounts = new Accounts();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;


        //get diaily all collection data

        $response = $accounts->daily_all_collection_report_data($union_id, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];


        // return view('accounts.reports.daily_all_collection_report',  ['data' => $response, 'union' =>$union_profile]);

        $pdf = PDF::loadHtml(view('accounts.reports.daily_all_collection_report',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.reports.daily_all_collection_report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("daily_all_collection_report.pdf");
    }


    public function daily_deposit_expense_report($from_date = null, $to_date = null){

        $accounts = new Accounts();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;


        //get daily all collection data

        $response = $accounts->daily_deposit_expense_report_data($union_id, $from_date, $to_date);


        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.reports.daily_deposit_expense_report',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.reports.daily_all_collection_report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("daily_deposit_expense_report.pdf");
    }

    //this function work when citizen only apply for assesment
     public function check_assesment(Request $request)
    {

        $accounts = new Accounts();

        $response = $accounts->get_assesment_exist_data($request->search_data);

        if(!empty($response)){//if have citizen data

            if (is_null($response->assesment_pin)) {//if assesment not apply before

               echo json_encode($response);

            }else {//if assesment apply before

                echo json_encode(['status' => 'success', 'msg' => 'আপনার এসেসমেন্ট  করা আছে। আপনার পিন ' .$response->pin .' এবং তারিখ '. date('d-m-Y', strtotime($response->created_time))]);
            }

        }else{

            echo json_encode(['status' => 'error', 'msg' => 'এসেসমেন্ট  আবেদন পাওয়া যায়নি']);

        }

    }

    //assesment application
    public function assesment_application(){

        return view('accounts.assesment.application');
    }

    //assesment store
    public function assesment_store(Request $request){

        $generate = new IdGenerate();
        $union_id       = Auth::user()->union_id;
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);


        if (empty($request->pin)) {

            echo "pin empty";

           //get pin number
            $pin = $generate->pin($union_id);

        }else{

            echo "pin not empty";

            $pin = $request->pin;

            $request['citizen_exist'] =  true;

        }


        $request['union_id'] = $union_id;
        $request['pin'] = $pin;
        $request['fiscal_year_id'] = $fiscal_year_id;

        if ($request->due_tax > 0) {


            //get home tax account id
            $debit_id = Global_model::get_account_id($union_id, 29);
            //get due account id
            $credit_id = Global_model::get_account_id($union_id, 23);

            $request['debit_id'] = $debit_id;
            $request['credit_id'] = $credit_id;
            $request['voucher'] = 00;

        }


        $data = new Accounts();

        $response = $data->assesment_store($request);

        Alert::toast($response['message'], $response['status']);

        if ($response['status'] == 'success') {

            return redirect('/accounts/assesment_list');
        }else{

            return redirect()->back()->withInput();
        }


    }


    //asesesment edit

    public function assesment_edit($pin = null)
    {
        //get union id
        $union_id = Auth::user()->union_id;

        $accounts = new Accounts();

        $response = $accounts->assesment_data($pin, $union_id);

        // dd($response);
        // exit;

        return view('accounts.assesment.edit')->with('assesment', $response);
    }


    public function assesment_update(Request $request)
    {
        $accounts = new Accounts();

        $response = $accounts->update_assesment($request);

        if ($response) {
            Alert::toast('আপনার তথ্য সফল ভাবে আপডেট করা হয়েছে।','success');
            return redirect('accounts/assesment_list');
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error')->position('middle');
            return redirect()->back();
        }

    }

    //assesment list

    public function assesment_list(){

        //get fiscal years
        $fiscal_years = Global_model::fiscal_years();

        return view('accounts.assesment.assesment_list', ['fiscal_years' => $fiscal_years]);
    }

    public function assesment_list_data(Request $request){

        header("Content-Type: application/json");

        $union_id = Auth::user()->union_id;

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $fiscal_year_id = (isset($request->fiscal_year_id)) ? $request->fiscal_year_id : 0;

        $ward_no = (isset($request->ward_no)) ? $request->ward_no : 0;
        $holding_no = (isset($request->holding_no)) ? $request->holding_no : 0;

        $request_data = [

            'union_id' => $union_id,
            'fiscal_year_id' => $fiscal_year_id,
            'ward_no' => $ward_no,
            'holding_no' => $holding_no,
            'start' => $start,
            'limit' => $limit,

        ];

        $assesment_list = new Accounts();

        $response = $assesment_list->assesment_list_data($request_data, $search_content);

        // echo '<pre>';
        // print_r($response);
        // exit;

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

        echo json_encode($response);

    }

    //home tax save
    public function home_tax_save(Request $request){

        $generate = new IdGenerate();

        $union_id       = Auth::user()->union_id;
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $request['union_id'] = $union_id;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['voucher'] = $generate->voucher($union_id, $fiscal_year_id);

        $data = new Accounts();

        $response = $data->home_tax_save($request);

        echo json_encode($response);


    }

    //get home tax money receipt

    public function home_tax_money_receipt($pin = null){

        $accounts = new Accounts();

        //get union code
        $union_id = Auth::user()->union_id;

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);

        //get money receipt data

        $response = $accounts->money_receipt_data($pin, $union_id, 29);

        if (!empty($response)) {

            $pdf = PDF::loadView('accounts.assesment.money_receipt', ['data' => $response, 'union' => $union_profile]);

            return $pdf->stream('home_tax_money_receipt.pdf');

        }else{

            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }
    }

    //get home tax register data

    public function home_tax_register($from_date = null, $to_date = null){

        $accounts = new Accounts();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;


        $response = $accounts->home_tax_register_data($union_id, 29, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.assesment.register',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.assesment.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("home_tax_register.pdf");

    }


    //get home tax collection report

    public function home_tax_collection_report($from_date = null, $to_date = null){

        $accounts = new Accounts();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;


        $response = $accounts->home_tax_register_data($union_id, 29, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.assesment.report',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.assesment.report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("home_tax_report.pdf");
    }

    public function rosidList(Request $r)
    {

        if($r->ajax())
        {
            $query = DB::table('certificate as CRT')

            ->select('CRT.type','CRT.sonod_no',     'TRA.voucher','TRA.amount','TRA.created_time'        )

            ->join('acc_transaction as TRA',function($join){
                $join
                ->on('TRA.sonod_no','=','CRT.sonod_no')
                ->where('TRA.union_id',auth()->user()->union_id);
            })

            // ->join('citizen_information as CI',function($join){
            //     $join
            //     ->on('CI.pin','=','CRT.pin')
            //     ->where('CI.union_id',auth()->user()->union_id);
            // })
            ;

            if($r->from_date)
            {
                $query->whereDate('TRA.created_time','>=',$r->from_date);
            }
            if($r->to_date)
            {
                $query->whereDate('TRA.created_time','<=',$r->to_date);
            }
            if($r->type)
            {
                $query->where('CRT.type',$r->type);
            }


            $query->where('CRT.union_id',auth()->user()->union_id)
            ->distinct('CRT')
            ;

            $data = $query->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }

        return view('accounts.rosid_list');
    }

}
