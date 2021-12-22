<?php

namespace App\Http\Controllers\Applications;

use App\Http\Requests\Applications\FormRequestRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\FormUpdateRequestRule;
use App\Http\Requests\Applications\WebFormRequestRule;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Bibahito;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use stdClass;

class BibahitoController extends Controller
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
        $this->type = 20;
    }

    public function index()
    {
        return view('bibahito.application');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bibahito.application');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequestRule $request)
    {
        //if nid, birthid, passportno empty
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
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);;
            //get tracking number
            $tracking               = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by']  = $tracking;
        }else {
            $union_id       = Auth::user()->union_id;
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);
            $tracking       = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by']  = Auth::user()->employee_id;
        }

        //get pin number
        if($request->pin){
            $pin = $request->pin;
            $request['old_citizen'] = true;
        } else {
            $pin = $generate->pin($union_id);
            $request['old_citizen'] = false;
        }

        $request['union_id'] = $union_id;
        $request['pin'] = $pin;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['tracking'] = $tracking;
        $request['type'] = $this->type;

        // dd($request);

        $data = new Bibahito();

        $response = $data->data_store($request);

        if ($response['status'] == "success")
        {
            if(isset($request->web)){

                return response()->json(['success'=> 'আবেদনটি সম্পূর্ণ হয়েছে!', 'tracking' => $tracking, 'pin' => $pin, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'bibahito_application']);

            } else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>","<p>".$response['message']."</p><a href='".route('bibahito_preview', ['tracking' => $tracking])."' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>",'success')->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false,true);

                return redirect()->back();
            }

        } else {
            if(isset($request->web)){
                return response()->json(['error'=> 'আবেদন সম্পূর্ণ হয়নি!']);
            } else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!','error');
                return redirect()->back()->withInput();
            }
        }
    }

    //this is for web application
    public function webApplly(WebFormRequestRule $request)
    {
        // if($request->marital_status == 1)
        // {
        //     if(isset($request->web)){
        //         return response()->json(['error'=> 'দুৎখিত! আপনি এই সনদের আবেদন করতে পৌরসভা পরিষদে যোগাযোগ করুন']);
        //     }else {
        //         Alert::toast('দুৎখিত! আপনি এই সনদের আবেদন করতে পৌরসভা পরিষদে যোগাযোগ করুন','error');
        //         return redirect()->back();
        //     }
        // }
        $generate = new IdGenerate();
        $union_id       = $request->union_id;
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);;
        //get tracking number
        $tracking               = $generate->tracking($union_id, $fiscal_year_id, $this->type);
        $request['created_by']  = $tracking;

        $request['union_id']    = $union_id;
        $request['pin']         = $request->pin;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['tracking']    = $tracking;
        $request['type']        = $this->type;

        $res = Bibahito::webApplication($request);

        if($res){
            if(isset($request->web)){
                return response()->json(['success'=> 'আবেদনটি সম্পূর্ণ হয়েছে!', 'tracking' => $tracking, 'pin' => $request->pin, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'bibahito_application']);
            }else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>","<p>আপনার পিন নং ".$request->pin." এবং ট্র্যাকিং নং ".$request->tracking."</p><a href='".route('bibahito_preview', ['tracking' => $tracking])."' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>",'success')->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false,true);
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

    //===bibahito application preview===//
    public function preview( $tracking = null)
    {
        $preview = new Bibahito();

        //get union id
        $union_id = Auth::user()->union_id;

        $response = $preview->bibahito_information($tracking, $union_id, $this->type);

        $union_profile = Global_model::union_profile($union_id);

        $data = ['bibahito' => $response, 'union' => $union_profile];

        $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $pdf = PDF::loadView('bibahito.ppreview', $data);

        return $pdf->stream('bibahito_preview.pdf');
    }

    //===show applicant list===//
    public function applicant_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('bibahito.applicant_list', compact("fiscal_year_list"));
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
            'union_id' => $union_id,
            'fiscal_year_id' => $request->fiscal_year_id,
            'start' => $start,
            'limit' => $limit,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'type' => $this->type,
        ];
        // print_r($request_data);

        $applicant_list = new Bibahito();

        $response = $applicant_list->bibahito_applicant_list_data($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);

    }

    //===bibahito certificate generate===//
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

        $bibahito = new Bibahito();

        $response = $bibahito->sonod_generate($request);

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


        $bibahito = new Bibahito();

        $response = $bibahito->sonod_generate($request);

        echo json_encode($response);


    }

    //===bibahito bangla sonod print===//
    public function sonod_print_bn($sonod_no = null)
    {

        $bibahito = new Bibahito();

        //get union code
        $union_id = Auth::user()->union_id;

       //get bibahito certificate data
        $response = $bibahito->bibahito_certificate_data($sonod_no, $union_id, $this->type);

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);

        if (!empty($response)) {

            $data = ['bibahito' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id,'type' => $this->type,'application_type' => 1])->get(['pad_print','chairman','member','sochib','obibabok'])[0];

            $data['colspan'] = $data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok+1;

            //certificate pdf convert
            // $pdf = PDF::loadView('bibahito.bangla_certificate', $data);

            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
                $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('bibahito.bangla_certificate', $data), $config);

            return $pdf->stream('bibahito_certificate.pdf');

        }else{

            echo "<h1 style='color:red; text-align:center;'>দুঃখিত ! সনদটি পাওয়া যায়নি</h1>";

        }



    }

    //===bibahito english sonod print====//
    public function sonod_print_en($sonod_no = null)
    {

        $bibahito = new Bibahito();

        //get union code
        $union_id = Auth::user()->union_id;

       //get bibahito certificate data
        $response = $bibahito->bibahito_certificate_data($sonod_no, $union_id, $this->type);

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);


        if (!empty($response)) {

            $data = ['bibahito' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id,'type' => $this->type,'application_type' => 1])->get(['pad_print','chairman','member','sochib','obibabok'])[0];

            $data['colspan'] = $data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok+1;

            //certificate pdf convert
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
                $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('bibahito.english_certificate', $data), $config);
            // $pdf = PDF::loadView('bibahito.english_certificate', $data);

            return $pdf->stream('bibahito_certificate.pdf');

        }else{

            echo "<h1 style='color:red; text-align:center;'>Error ! This certificate could not found.</h1>";

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

        $preview = new Bibahito();

        $response = $preview->bibahito_data($tracking, $union_id);

        return view('bibahito.edit')->with('bibahito', $response);
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
        $bibahito = new Bibahito();

        $response = $bibahito->update_bibahito($request);

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
        $bibahito = new Bibahito();
        $response = $bibahito->bibahito_info_delete($request);

        return $response;
    }

    //=====for bibahito certificate list====//
    public function certificate_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('bibahito.certificate_list', compact("fiscal_year_list"));
    }

    //======for bibahito certificate list data====//
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

        $bibahito = new Bibahito();

        $response = $bibahito->bibahito_certificate_list($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //bibahito money receipt
    public function money_receipt($sonod_no = null)
    {

        $bibahito = new Bibahito();

        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        //get money receipt data

        $response = $bibahito->money_receipt_data($sonod_no, $union_id, $this->type);

        $bank = DB::table('bank')->where('sonod_type','=',20)->first();

        if(empty($bank)){
            $bank = new stdClass;
            $bank->bank_name = '';
            $bank->bank_branch = '';
            $bank->account_num = '';
            $bank->bank_branch_address = '';

        }


        if (!empty($response)) {

            $pdf = PDF::loadView('bibahito.money_receipt', ['data' => $response,'bank' => $bank,'union' => $union_profile]);

            return $pdf->stream('bibahito_money_receipt.pdf');

        }else{

            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }


    }

    //for bibahito register
    public function register($from_date = null, $to_date = null){

        $bibahito = new Bibahito();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get register data

        $response = $bibahito->bibahito_register_data($union_id, $this->type, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('bibahito.register',  ['data' => $response, 'union' => $union_profile]), $config);

        // $pdf = PDF::loadView('bibahito.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("bibahito_register.pdf");

    }

    public function register_show(){
        return view('bibahito.register_list');
    }

}
