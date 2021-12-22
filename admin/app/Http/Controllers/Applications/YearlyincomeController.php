<?php

namespace App\Http\Controllers\Applications;

use App\Http\Requests\Applications\FormRequestRule;
use App\Http\Requests\Applications\WebFormRequestRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\FormUpdateRequestRule;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Yearlyincome;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use stdClass;

class YearlyincomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $type;

    public function __construct()
    {
        //for application type
        $this->type = 11;
    }

    public function index()
    {
        return view('yearlyincome.application');
    }

    //this is for other application show
    public function other_application()
    {
        return view('application_show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('yearlyincome.application');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequestRule $request)
    {
        // if nid, birthid, passportno empty
        if ($request->nid == '' && $request->birth_id == '' && $request->passport_no == '') {

            if(isset($request->web)){
                return response()->json(['niderror'=> 'জাতীয় পরিচয় পত্র অথবা জন্মনিবন্ধন অথবা পাসপোর্ট নং প্রদান করুন!']);
            }else {
                Alert::toast('জাতীয় পরিচয় পত্র অথবা জন্মনিবন্ধন অথবা পাসপোর্ট নং প্রদান করুন!','error')->position('middle');
                return redirect()->back()->withInput();
            }
        }

        $generate = new IdGenerate();

        //define web or admin
        if(isset($request->web)){
            $union_id       = $request->union_id;
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);
            //get tracking number
            $tracking               = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by']  = $tracking;
        } else {
            $union_id       = Auth::user()->union_id;
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);
            $tracking       = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by']  = Auth::user()->employee_id;
        }

        //get pin number
        if($request->pin){
            $pin = $request->pin;
            $request['old_ctz'] = true;
        } else {
            $pin = $generate->pin($union_id);
            $request['old_ctz'] = false;
        }

        $request['union_id'] = $union_id;
        $request['pin'] = $pin;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['tracking'] = $tracking;
        $request['type'] = $this->type;

        // dd($request);

        $data = new Yearlyincome();

        $response = $data->data_store($request);


        if ($response['status'] == "success")
        {
            if(isset($request->web)){

                return response()->json(['success'=> 'আবেদনটি সম্পূর্ণ হয়েছে!', 'tracking' => $tracking, 'pin' => $pin, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'yearlyincome_application']);

            }else {
            Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>","<p>".$response['message']."</p><a href='".route('yearlyincome_preview', ['tracking' => $tracking])."' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>",'success')->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false,true);
            return redirect()->back();
            }

        }else{
            if(isset($request->web)){
                return response()->json(['error'=> 'আবেদন সম্পূর্ণ হয়নি!']);
            }else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!','error');
                return redirect()->back()->withInput();
            }
        }
    }

    //this is for web application
    public function webApplly(WebFormRequestRule $request)
    {
        $generate = new IdGenerate();
        $union_id       = $request->union_id;
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);
        //get tracking number
        $tracking               = $generate->tracking($union_id, $fiscal_year_id, $this->type);
        $request['created_by']  = $tracking;

        $request['union_id']    = $union_id;
        $request['pin']         = $request->pin;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['tracking']    = $tracking;
        $request['type']        = $this->type;

        $res = Yearlyincome::webApplication($request);

        if($res){
            if(isset($request->web)){
                return response()->json(['success'=> 'আবেদনটি সম্পূর্ণ হয়েছে!', 'tracking' => $tracking, 'pin' => $request->pin, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'yearlyincome_application']);
            }else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>","<p>আপনার পিন নং ".$request->pin." এবং ট্র্যাকিং নং ".$request->tracking."</p><a href='".route('yearlyincome_preview', ['tracking' => $tracking])."' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>",'success')->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false,true);
                return redirect()->back();
            }
        }else {
            if(isset($request->web)){
                return response()->json(['error'=> 'আবেদন সম্পূর্ণ হয়নি!']);
            }else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!','error');
                return redirect()->back();
            }
        }
    }

    //===yearlyincome application preview===//
    public function preview( $tracking = null)
    {
        $preview = new Yearlyincome();

        //get union id
        $union_id = Auth::user()->union_id;

        $response = $preview->yearlyincome_information($tracking, $union_id, $this->type);

        $union_profile = Global_model::union_profile($union_id);

        $data = ['yearlyincome' => $response, 'union' => $union_profile];

        $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $pdf = PDF::loadView('yearlyincome.ppreview', $data);

        return $pdf->stream('yearlyincome_preview.pdf');
    }

    //===show applicant list===//
    public function applicant_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('yearlyincome.applicant_list', compact("fiscal_year_list"));
    }

    //===applicant list data===//
    public function applicant_data(Request $request)
    {
        header("Content-Type: application/json");

        $union_id = Auth::user()->union_id;
        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;

        $from_date = (isset($request->from_date)) ? $request->from_date : date('Y-m-d');
        $to_date = (isset($request->to_date)) ? $request->to_date : date('Y-m-d');

        $request_data = [
            'fiscal_year_id' => $request->fiscal_year_id,
            'union_id' => $union_id,
            'start' => $start,
            'limit' => $limit,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'type' => $this->type,
        ];

        $applicant_list = new Yearlyincome();

        $response = $applicant_list->yearlyincome_applicant_list_data($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);

    }

    //===yearlyincome certificate generate===//
    public function sonod_generate(Request $request)
    {


        $union_id = Auth::user()->union_id;

        $generate = new IdGenerate();

        //create sonod no
        $sonod_no = $generate->sonod_no_generate($union_id, $this->type);

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        //create voucher no
        $voucher_no = $generate->voucher($union_id, $fiscal_year_id);

        //get sonod account id
        $debit_id = Global_model::get_account_id($union_id, $this->type);

        //push sonod no in request
        $request['sonod_no'] = $sonod_no;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['status'] = 1;
        $request['type'] = $this->type;
        $request['voucher'] = $voucher_no;
        $request['debit_id'] = $debit_id;

        $yearlyincome = new Yearlyincome();

        $response = $yearlyincome->sonod_generate($request);

        echo json_encode($response);

    }

    //sonod regenerate
    public function sonod_regenerate(Request $request)
    {

        $union_id = Auth::user()->union_id;

        $generate = new IdGenerate();


        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        //create voucher no
        $voucher_no = $generate->voucher($union_id, $fiscal_year_id);

        //get sonod account id
        $debit_id = Global_model::get_account_id($union_id, $this->type);

        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['status'] = 2;
        $request['type'] = $this->type;
        $request['voucher'] = $voucher_no;
        $request['debit_id'] = $debit_id;
        $request['regenerate'] = true;


        $yearlyincome = new Yearlyincome();

        $response = $yearlyincome->sonod_generate($request);

        echo json_encode($response);


    }

    //===yearlyincome bangla sonod print===//
    public function sonod_print_bn($sonod_no = null)
    {

        $yearlyincome = new Yearlyincome();

        //get union code
        $union_id = Auth::user()->union_id;

       //get yearlyincome certificate data
        $response = $yearlyincome->yearlyincome_certificate_data($sonod_no, $union_id, $this->type);

        // dd($response);

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);



        if (!empty($response)) {

            $data = ['yearlyincome' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id,'type' => $this->type,'application_type' => 1])->get(['pad_print','chairman','member','sochib','obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman +$data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok;
            //certificate pdf convert
            // $pdf = PDF::loadView('yearlyincome.bangla_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
                $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('yearlyincome.bangla_certificate', $data), $config);

            return $pdf->stream('yearlyincome_certificate.pdf');


        }else{

            echo "<h1 style='color:red; text-align:center;'>দুঃখিত ! সনদটি পাওয়া যায়নি</h1>";

        }

    }

    //===yearlyincome english sonod print====//
    public function sonod_print_en($sonod_no = null)
    {

        $yearlyincome = new Yearlyincome();

        //get union code
        $union_id = Auth::user()->union_id;

       //get yearlyincome certificate data
        $response = $yearlyincome->yearlyincome_certificate_data($sonod_no, $union_id, $this->type);

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);

        if (!empty($response)) {

            $data = ['yearlyincome' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id,'type' => $this->type,'application_type' => 1])->get(['pad_print','chairman','member','sochib','obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman +$data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok;
            //certificate pdf convert
            // $pdf = PDF::loadView('yearlyincome.english_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
                $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('yearlyincome.english_certificate', $data), $config);

            return $pdf->stream('yearlyincome_certificate.pdf');


        }else{

            echo "<h1 style='color:red; text-align:center;'>দুঃখিত ! সনদটি পাওয়া যায়নি</h1>";

        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tracking)
    {
        //get union id
        $union_id = Auth::user()->union_id;

        $preview = new Yearlyincome();

        $response = $preview->yearlyincome_data($tracking, $union_id);

        return view('yearlyincome.edit')->with('yearlyincome', $response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormUpdateRequestRule $request)
    {
        $yearlyincome = new Yearlyincome();

        $response = $yearlyincome->update_yearlyincome($request);

        if ($response) {
            Alert::toast('আপনার তথ্য সফল ভাবে আপডেট করা হয়েছে।','success');
            return redirect()->to(session('previous-url'));
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error')->position('middle');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $yearlyincome = new Yearlyincome();
        $response = $yearlyincome->yearlyincome_info_delete($request);

        return $response;
    }

    //=====for yearlyincome certificate list====//
    public function certificate_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('yearlyincome.certificate_list', compact("fiscal_year_list"));
    }

    //======for yearlyincome certificate list data====//
    public function certificate_list_data(Request $request)
    {
        header("Content-Type: application/json");

        //get union id
        $union_id = Auth::user()->union_id;
        //get current fiscal year id
        // $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;

        $from_date = (isset($request->from_date)) ? $request->from_date : date('Y-m-d');
        $to_date = (isset($request->to_date)) ? $request->to_date : date('Y-m-d');

        $request_data = [
            'union_id' => $union_id,
            'fiscal_year_id' => $request->fiscal_year_id,
            'start' => $start,
            'limit' => $limit,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'type' => $this->type,

        ];

        $yearlyincome = new Yearlyincome();

        $response = $yearlyincome->yearlyincome_certificate_list($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //yearlyincome money receipt
    public function money_receipt($sonod_no = null)
    {

        $yearlyincome = new Yearlyincome();

        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        //get money receipt data

        $response = $yearlyincome->money_receipt_data($sonod_no, $union_id, $this->type);

        $bank = DB::table('bank')->where('sonod_type','=',11)->first();

        if(empty($bank)){
            $bank = new stdClass;
            $bank->bank_name = '';
            $bank->bank_branch = '';
            $bank->account_num = '';
            $bank->bank_branch_address = '';

        }

        if (!empty($response)) {

            $pdf = PDF::loadView('yearlyincome.money_receipt', ['data' => $response, 'bank' => $bank, 'union' => $union_profile]);

            return $pdf->stream('yearlyincome_money_receipt.pdf');

        }else{

            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }


    }

    //for yearlyincome register
    public function register($from_date = null, $to_date = null){

        $yearlyincome = new Yearlyincome();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get register data

        $response = $yearlyincome->yearlyincome_register_data($union_id, $this->type, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('yearlyincome.register',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('yearlyincome.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("yearlyincome_register.pdf");

    }

    public function register_show(){
        return view('yearlyincome.register_list');
    }
}
