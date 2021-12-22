<?php
namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\PremiseslicenseInfoRequest;
use App\Http\Requests\Applications\PremiseslicenseInfoUpdateRequest;
use App\Http\Requests\Applications\WebPremiseslicensInfoRequest;
use App\Http\Requests\Applications\WebTradelicenseInfoRequest;
use App\Models\Global_model;
use App\Models\IdGenerate;
use App\Models\Premiseslicense;
use App\Models\Tradelicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use stdClass;

class PremiseslicenseController extends Controller
{
    public $type;
    public $premises;

    public function __construct()
    {
        $this->type = 90;
        $this->premises = new Premiseslicense();
    }

    public function index()
    {
        return view('premises.application');
    }

    public function create()
    {
        $data['business_type'] = DB::table('business_type')
            ->select('name_bn', 'id')
            ->where('union_id', auth()->user()->union_id)
            // ->where('type',2) // 2 = premises
            ->get();

        return view('premises.application', $data);
    }

    // PremiseslicenseInfoRequest
    public function store(PremiseslicenseInfoRequest $request)
    {
        // if nid, birthid, passportno empty
        if (count($request->nid) < 0  && count($request->birth_id) < 0) {
            if (isset($request->web)) {
                return response()->json(['niderror' => 'জাতীয় পরিচয় পত্র অথবা জন্মনিবন্ধন অথবা পাসপোর্ট নং প্রদান করুন!']);
            } else {
                Alert::toast('জাতীয় পরিচয় পত্র অথবা জন্মনিবন্ধন অথবা পাসপোর্ট নং প্রদান করুন!', 'error')->position('middle');
                return redirect()->back()->withInput();
            }
        }

        $generate = new IdGenerate();

        //define web or admin
        if (isset($request->web)) {
            $union_id               = $request->union_id;
            $fiscal_year_id         = $request->fiscal_id;
            //get tracking number
            $tracking               = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by']  = $tracking;
        } else {
            $union_id               = Auth::user()->union_id;
            $fiscal_year_id         = Global_model::current_fiscal_year($union_id);
            $tracking               = $generate->tracking($union_id, $fiscal_year_id, $this->type);
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

        $pins = [];

        //generate multiple pin
        for ($i = 0; $i < count($request->name_bn); $i++) {
            $pins[] = $pin + $i;
        }

        $request['union_id']        = $union_id;
        $request['pin']             = $pins;
        $request['fiscal_year_id']  = $fiscal_year_id;
        $request['tracking']        = $tracking;
        $request['type']            = $this->type;

        // dd($request);

        $data = new Premiseslicense();

        $response = $data->data_store($request);

        if ($response['status'] == "success") {
            if (isset($request->web)) {

                return response()->json(['success' => 'আবেদনটি সম্পূর্ণ হয়েছে!', 'message' => $response['message'], 'tracking' => $tracking, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'premises_application']);
            } else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>", "<p>" . $response['message'] . "</p><a href='" . route('premises_preview', ['tracking' => $tracking]) . "' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='premises/applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>", 'success')

                ->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')

                ->persistent(false, true);

                return redirect()->back();
            }
        } else {
            if (isset($request->web)) {
                return response()->json(['error' => 'আবেদন সম্পূর্ণ হয়নি!']);
            } else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');
                return redirect()->back()->withInput();
            }
        }
    }

    //this is for web application
    public function webApplly(WebPremiseslicensInfoRequest $request)
    {



        if ($request->type_of_organization >= 2) {
            if (isset($request->web)) {
                return response()->json(['error' => 'আবেদন সম্পূর্ণ হয়নি!']);
            } else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');
                return redirect()->back();
            }
        }


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

        $res = Premiseslicense::webApplication($request);

        if ($res) {
            if (isset($request->web)) {
                return response()->json(['success' => 'আবেদনটি সম্পূর্ণ হয়েছে!', 'message' => 'আপনার পিন নং ' . $request->pin . ' এবং ট্র্যাকিং নং ' . $tracking, 'tracking' => $tracking, 'pin' => $request->pin, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'trade_application']);
            } else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>", "<p>আপনার পিন নং " . $request->pin . " এবং ট্র্যাকিং নং " . $request->tracking . "</p><a href='" . route('trade_preview', ['tracking' => $tracking]) . "' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>", 'success')->showConfirmButton($btnText = 'ঠিক আছে', $btnColor = '#3085d6')->persistent(false, true);
                return redirect()->back();
            }
        } else {
            if (isset($request->web)) {
                return response()->json(['error' => 'আবেদন সম্পূর্ণ হয়নি!']);
            } else {
                Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');
                return redirect()->back();
            }
        }
    }

    //===premises application preview===//
    public function preview($tracking = null)
    {
        //get union id
        $union_id = Auth::user()->union_id;


        //get premises application information
        $response = $this->premises->premises_information($tracking, $union_id, $this->type);


        //union profile data store in response
        $union_profile = Global_model::union_profile($union_id);

        $data = ['trade' => $response, 'union' => $union_profile];



        $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 2])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];

        $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;

        $pdf = PDF::loadView('premises.ppreview', $data);

        return $pdf->stream('premises_preview.pdf');
    }

    //===show applicant list===//
    public function applicant_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('premises.applicant_list', compact('fiscal_year_list'));
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
            'fiscal_year_id' => (int)$request->fiscal_year_id,
            'union_id' => $union_id,
            'start' => $start,
            'limit' => $limit,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'search_content' => $search_content,
            'type' => $this->type,
        ];


        $applicant_list = new Premiseslicense();

        $response = $applicant_list->premises_applicant_list_data($request_data);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //===premises certificate generate===//
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

        $premises = new Premiseslicense();

        $response = $premises->sonod_generate($request);

        echo json_encode($response);
    }

    //sonod regenerate
    public function sonod_regenerate(Request $request)
    {

        $union_id = Auth::user()->union_id;

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $generate = new IdGenerate();

        //create voucher no
        $voucher_no = $generate->voucher($union_id, $fiscal_year_id);

        //get sonod account id
        $debit_id = Global_model::get_account_id($union_id, $this->type);

        $request['voucher'] = $voucher_no;
        $request['debit_id'] = $debit_id;
        $request['union_id'] = $union_id;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['status'] = 2;
        $request['type'] = $this->type;

        $premises = new Premiseslicense();

        $response = $premises->sonod_generate($request);

        echo json_encode($response);
    }

    //===premises bangla sonod print===//
    public function sonod_print_bn($sonod_no = null)
    {

        $premises = new Premiseslicense();

        $union_id = Auth::user()->union_id;

        $response = $premises->premises_certificate_data($sonod_no, $union_id, $this->type);

        // dd($response);

        //get union information
        $union_profile = Global_model::union_profile($union_id);

        if ($response) {

            $data = ['trade' => $response, 'union' => $union_profile];

            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 1])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;

            // $pdf = PDF::loadView('trade.bangla_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('premises.bangla_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>দুঃখিত ! সনদটি পাওয়া যায়নি।</h2>";
        }
    }

    //===premises english sonod print====//
    public function sonod_print_en($sonod_no = null)
    {

        $premises = new Premiseslicense();

        $union_id = Auth::user()->union_id;

        $response = $premises->premises_certificate_data($sonod_no, $union_id, $this->type);

        //get union information
        $union_profile = Global_model::union_profile($union_id);





        if ($response == true) {

            $data = ['trade' => $response, 'union' => $union_profile];

            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 1])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok;

            // $pdf = PDF::loadView('trade.english_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('premises.english_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>Sorry ! This certificate could not found.</h2>";
        }
    }

    //===previous trade bangla sonod print===//
    public function previous_sonod_print_bn($sonod_no = null, $fiscal_year_id = null)
    {

        $trade = new Premiseslicense();

        $union_id = Auth::user()->union_id;

        // dd($fiscal_year_id);

        $response = $trade->previous_premises_certificate_data($sonod_no, $union_id, $this->type, $fiscal_year_id);

        // echo "<pre>";
        // print_r($response);
        // exit;

        //get union information
        $union_profile = Global_model::union_profile($union_id);


        if ($response == true) {

            $data = ['trade' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 1])->get(['pad_print', 'chairman', 'member', 'sochib', 'obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok;

            //  $pdf = PDF::loadView('trade.bangla_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('premises.bangla_certificate', $data), $config);

            return $pdf->stream('premiseslicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>দুঃখিত ! সনদটি পাওয়া যায়নি।</h2>";
        }
    }

    //===previous trade english sonod print====//
    public function previous_sonod_print_en($sonod_no = null, $fiscal_year_id = null)
    {

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $response = $trade->previous_trade_certificate_data($sonod_no, $union_id, $this->type, $fiscal_year_id);

        //get union information
        $union_profile = Global_model::union_profile($union_id);


        if ($response == true) {

            $data = ['trade' => $response, 'union' => $union_profile];
            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 1])->get(['pad_print', 'chairman', 'member', 'sochib', 'obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->member + $data['print_setting']->sochib + $data['print_setting']->obibabok;

            //  $pdf = PDF::loadView('trade.english_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('trade.english_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>Sorry ! This certificate could not found.</h2>";
        }
    }

    public function edit($tracking)
    {

        $union_id = Auth::user()->union_id;

        $trade = new Premiseslicense();

        $res = $trade->premises_data($tracking, $union_id);

        $business_type = DB::table('business_type')
            ->select('name_bn', 'id')
            ->where('union_id', auth()->user()->union_id)
            // ->where('type',2)
            ->get();

        $data['business_type'] = json_encode($business_type);

        $data['organization']   = (object) $res['organization'];
        $data['owners']         = (object) $res['ownerList'];



        return view('premises.edit', $data);
    }

    public function update(PremiseslicenseInfoUpdateRequest $request)
    {


        $premises = new Premiseslicense();

        $union_id = Auth::user()->union_id;

        $request['fiscal_year_id'] = Global_model::current_fiscal_year($union_id);
        $response = $premises->update_premises($request);


        if ($response['status'] == "success") {
            Alert::toast('আপনার তথ্য সফলভাবে আপডেট হয়েছে!', 'success');
            return redirect()->to(session('previous-url'));
        } else {
            Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {

        $trade = new Tradelicense();

        $response = $trade->premises_info_delete($request);

        return $response;
    }

    //=====for premises certificate list====//
    public function certificate_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('premises.certificate_list', compact('fiscal_year_list'));
    }

    ///======for premises certificate list data====//
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
            'fiscal_year_id' => (int)$request->fiscal_year_id,
            'start' => $start,
            'limit' => $limit,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'search_content' => $search_content,
            'type' => $this->type,
        ];

        $premises = new Premiseslicense();

        $response = $premises->premises_certificate_list($request_data);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;
        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //=====for previous premises certificate list====//
    public function previous_certificate_list()
    {

        session(['previous-url' => request()->url()]);

        //get previous fiscal years list
        $fiscal_years = DB::table('fiscal_years')->select('id', 'name')
            ->where('is_current',  0)
            ->where('is_active', 1)
            ->get();

        return view('premises.previous_certificate_list')->with('fiscal_years', $fiscal_years);
    }

    ///======for previous_ premises certificate list data====//
    public function previous_certificate_list_data(Request $request)
    {

        header("Content-Type: application/json");

        //get union id
        $union_id = Auth::user()->union_id;

        //previous fiscal year added
        $fiscal_year_id = $request->fiscal_year;

        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $from_date = (isset($request->from_date)) ? $request->from_date : date('Y-m-d');

        $to_date = (isset($request->to_date)) ? $request->to_date : date('Y-m-d');

        $request_data = [

            'union_id' => $union_id,
            'fiscal_year_id' => $fiscal_year_id,
            'start' => $start,
            'limit' => $limit,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'search_content' => $search_content,
            'type' => $this->type,

        ];


        $trade = new Premiseslicense();

        $response = $trade->prev_premises_certificate_list($request_data);


        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal']    = $count;
        $response['recordsFiltered'] = $count;


        $response['draw'] = $request->draw;


        echo json_encode($response);
    }

    // expire  certificate list
    public function expire_certificate_list(Request $request)
    {

        if ($request->ajax()) {

            $premises = new Premiseslicense();

            $response = $premises->expire_premises_certificate_list(Auth::user()->union_id);

            return Datatables::of($response)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
            dd($response);
        }


        return view('premises.expire_certificate_list');
    }

    // money receipt
    public function money_receipt($sonod_no = null)
    {

        $premises = new Premiseslicense();

        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        //get money receipt data
        $response = $premises->money_receipt_data($sonod_no, $union_id, $this->type);

        $bank = DB::table('bank')->where('sonod_type','=',90)->first();

        if(empty($bank)){
            $bank = new stdClass;
            $bank->bank_name = '';
            $bank->bank_branch = '';
            $bank->account_num = '';
            $bank->bank_branch_address = '';

        }


        if (!empty($response)) {

            $pdf = PDF::loadView('premises.money_receipt', ['data' => $response, 'bank' => $bank, 'union' => $union_profile]);

            return $pdf->stream('trade_money_receipt.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }
    }

    // for register
    public function register($from_date = null, $to_date = null)
    {

        $premises = new Premiseslicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;


        //get register data

        $response = $premises->premises_register_data($union_id, $this->type, $from_date, $to_date);


        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('premises.register',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("trade_register.pdf");
    }

    // for vat register
    public function tax_register($from_date = null, $to_date = null)
    {

        $premises = new Premiseslicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get register data
        $response = $premises->trade_register_data($union_id, $this->type, $from_date, $to_date);

        $pdf = PDF::loadView('premises.tax_register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("tax_register.pdf");
    }

    // get dialy vat report
    public function daily_vat_report($from_date = null, $to_date = null)
    {

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get vat report data

        $response = $trade->daily_vat_report_data($union_id, $this->type, $from_date, $to_date);

        // dd($response);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('trade.daily_vat_report',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.daily_vat_report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("vat_report.pdf");
    }

    public function register_show(){
        return view('premises.register_list');
    }


}
