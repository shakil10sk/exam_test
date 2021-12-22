<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\FormRequestRule;
use App\Models\Global_model;
use App\Models\IdGenerate;
use App\Models\Onapotti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use stdClass;

class OnapottiController extends Controller
{
    public $type;

    function __construct()
    {
        $this->type = 15;
    }

    public function create()
    {
        return view('onapotti.application');
    }

    public function store(Request $r)
    {
        // dd($r);

        $r->validate([
            'name_en'                   => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'name_bn'                   => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'father_name_en'            => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'father_name_bn'            => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'organization_name_en'      => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'organization_name_bn'      => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'organization_location_en'  => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'organization_location_bn'  => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'organization_type_en'      => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'organization_type_bn'      => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'resident'                  => ['required'],
            'gender'                    => ['required'],

            'present_village_en'        => ['string', 'max:255', 'nullable'],
            'present_village_bn'        => ['required', 'string', 'max:255'],
            'present_rbs_en'            => ['string', 'max:255', 'nullable'],
            'present_rbs_bn'            => ['nullable', 'string', 'max:255'],
            'present_holding_no'        => ['string', 'nullable'],
            'present_ward_no'           => ['required'],

            'present_district_id'        => ['required_if:present_district_txt,==,\'\''],
            'present_upazila_id'        => ['required_if:present_upazila_txt,==,\'\''],
            'present_postoffice_id'        => ['required_if:present_postoffice_txt,==,\'\''],

            'permanent_district_id'        => ['required_if:permanent_district_txt,==,\'\''],
            'permanent_upazila_id'        => ['required_if:permanent_upazila_txt,==,\'\''],
            'permanent_postoffice_id'        => ['required_if:permanent_postoffice_txt,==,\'\''],

            'permanent_village_en'         => ['string', 'max:255', 'nullable'],
            'permanent_village_bn'         => ['required', 'string', 'max:255'],
            'permanent_rbs_en'             => ['string', 'max:255', 'nullable'],
            'permanent_rbs_bn'             => ['nullable', 'string', 'max:255'],
            'permanent_holding_no'         => ['string', 'nullable'],
            'permanent_ward_no'            => ['required'],

            // 'permanent_district_id'        => ['required'],
            // 'permanent_upazila_id'         => ['required'],
            // 'permanent_postoffice_id'      => ['required'],

            'office_village_en'         => ['string', 'max:255', 'nullable'],
            'office_village_bn'         => ['required', 'string', 'max:255'],
            'office_rbs_en'             => ['string', 'max:255', 'nullable'],
            'office_rbs_bn'             => ['nullable', 'string', 'max:255'],
            'office_holding_no'         => ['string', 'nullable'],
            'office_ward_no'            => ['required'],

            'office_district_id'        => ['required'],
            'office_upazila_id'         => ['required'],
            'office_postoffice_id'      => ['required'],
        ]);

        // return $r->all();
        // dd($r->all());

        $request = $r->except(['_token']);

        $generate = new IdGenerate();   //define web or admin

        if (isset($r->web)) {
            $request['union_id']       = $r->union_id;
            $request['fiscal_year_id'] = $r->fiscal_id;

            //get tracking number
            $request['created_by'] =
            $request['tracking'] = $generate->tracking($r->union_id, $r->fiscal_id, $this->type);
        } else {
            $request['union_id']       = auth()->user()->union_id;
            $request['fiscal_year_id'] = Global_model::current_fiscal_year($request['union_id']);

            $request['tracking'] = $generate->tracking($request['union_id'], $request['fiscal_year_id'], $this->type);
            $request['created_by']  = auth()->user()->employee_id;
        }

        //get pin number
        if($r->pin){
            $pin = $r->pin;
            $request['old_ctz'] = true;
        } else {
            $request['old_ctz'] = false;

            $onapotti_id = DB::table('onapotti')
                            ->where('union_id', $request['union_id'])
                            ->whereYear('created_at', date('Y'))
                            ->count() + 1;

            $onapotti_id = ($onapotti_id > 0) ? $onapotti_id : 1;

            if (strlen($onapotti_id) < 6) {
                $onapotti_id = str_repeat(0, (6 - strlen($onapotti_id))) . $onapotti_id;
            }

            if (strlen($request['union_id']) < 7) {
                $request['union_id'] = str_repeat(0, (7 - strlen($request['union_id']))) . $request['union_id'];
            }

            $pin = date("y") . $request['union_id'] . $onapotti_id;
        }


        $request['pin'] = $pin;
        $request['type'] = $this->type;
        $request['created_by_ip'] = $r->ip();

        // dd($request);

        $data = new Onapotti();

        $response = $data->data_store((object) $request);

        if ($response['status'] == "success") {
            if (isset($r->web)) {

                return response()->json(['success' => 'আবেদনটি সম্পূর্ণ হয়েছে!', 'tracking' => $request['tracking'], 'pin' => $request['pin'], 'unionid' => $request['union_id'] , 'type' => $this->type, 'application' => 'onapotti_application']);
            } else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>", "<p>" . $response['message'] . "</p><a href='" . route('onapotti.preview', ['tracking' => $request['tracking'] ]) . "' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>", 'success')->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false, true);
                return redirect()->back();
            }
        } else {
            if (isset($r->web)) {
                return response()->json(['error' => 'আবেদন সম্পূর্ণ হয়নি!']);
            } else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');
                return redirect()->back()->withInput();
            }
        }
    }

    //===onapotti application preview===//
    public function preview($tracking)
    {
        // dd($tracking);
        $preview = new Onapotti();

        //get union id
        $union_id = auth()->user()->union_id;

        $response = $preview->onapotti_information($tracking, $union_id, $this->type);

        $union_profile = Global_model::union_profile($union_id);

        $data = ['onapotti' => $response, 'union' => $union_profile];

        $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 2])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];

        $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;


        $pdf = Pdf::loadView('onapotti.ppreview', $data);

        return $pdf->stream('onapotti_preview.pdf');
    }

    //===show applicant list===//
    public function applicant_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('onapotti.applicant_list', compact("fiscal_year_list"));
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

        $applicant_list = new onapotti();

        $response = $applicant_list->onapotti_applicant_list_data($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);

    }

    //===onapotti certificate generate===//
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


        $onapotti = new onapotti();

        $response = $onapotti->sonod_generate($request);

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


        $onapotti = new onapotti();

        $response = $onapotti->sonod_generate($request);

        echo json_encode($response);


    }

    //===onapotti bangla sonod print===//
    public function sonod_print_bn($sonod_no = null)
    {

        $onapotti = new onapotti();

        //get union code
        $union_id = Auth::user()->union_id;

       //get onapotti certificate data
        $response = $onapotti->onapotti_certificate_data($sonod_no, $union_id, $this->type);

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);

        if (!empty($response)) {

            $data = ['onapotti' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id,'type' => $this->type,'application_type' => 1])->get(['pad_print','chairman','member','sochib','obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman +$data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok;
            //certificate pdf convert
            // $pdf = PDF::loadView('onapotti.bangla_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
                $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('onapotti.bangla_certificate', $data), $config);

            return $pdf->stream('onapotti_certificate.pdf');

        }else{

            echo "<h1 style='color:red; text-align:center;'>দুঃখিত ! সনদটি পাওয়া যায়নি</h1>";

        }



    }

    //===onapotti english sonod print====//
    public function sonod_print_en($sonod_no = null)
    {

        $onapotti = new onapotti();

        //get union code
        $union_id = Auth::user()->union_id;

       //get onapotti certificate data
        $response = $onapotti->onapotti_certificate_data($sonod_no, $union_id, $this->type);

        //get union profile data
        $union_profile = Global_model::union_profile($union_id);


        if (!empty($response)) {

            $data = ['onapotti' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id,'type' => $this->type,'application_type' => 1])->get(['pad_print','chairman','member','sochib','obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman +$data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok;
            //certificate pdf convert
            // $pdf = PDF::loadView('onapotti.english_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
                $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('onapotti.english_certificate', $data), $config);

            return $pdf->stream('onapotti_certificate.pdf');

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

        $preview = new Onapotti();

        $response = $preview->onapotti_data($tracking, $union_id);

        return view('onapotti.edit')->with('onapotti', $response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $onapotti = new Onapotti();

        $response = $onapotti->update_onapotti((object) $request);

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
        $onapotti = new Onapotti();
        $response = $onapotti->onapotti_info_delete($request);

        return $response;
    }

    //=====for onapotti certificate list====//
    public function certificate_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('onapotti.certificate_list', compact("fiscal_year_list"));
    }

    //======for onapotti certificate list data====//
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

        $onapotti = new Onapotti();

        $response = $onapotti->onapotti_certificate_list($request_data, $search_content);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //onapotti money receipt
    public function money_receipt($sonod_no = null)
    {

        $onapotti = new Onapotti();

        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        //get money receipt data

        $response = $onapotti->money_receipt_data($sonod_no, $union_id, $this->type);

        $bank = DB::table('bank')->where('sonod_type','=',15)->first();

        if(empty($bank)){
            $bank = new stdClass;
            $bank->bank_name = '';
            $bank->bank_branch = '';
            $bank->account_num = '';
            $bank->bank_branch_address = '';

        }


        if (!empty($response)) {

            $pdf = PDF::loadView('onapotti.money_receipt', ['data' => $response,'bank' => $bank, 'union' => $union_profile]);

            return $pdf->stream('onapotti_money_receipt.pdf');

        }else{

            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }


    }

    //for onapotti register
    public function register($from_date = null, $to_date = null){

        $onapotti = new Onapotti();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get register data

        $response = $onapotti->onapotti_register_data($union_id, $this->type, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('onapotti.register',  ['data' => $response, 'union' => $union_profile]), $config);

        // $pdf = PDF::loadView('onapotti.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("onapotti_register.pdf");

    }

    public function register_show(){
        return view('onapotti.register_list');
    }

}
