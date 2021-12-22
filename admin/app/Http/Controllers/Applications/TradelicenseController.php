<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\TradelicenseInfoRequest;
use App\Http\Requests\Applications\TradelicenseInfoUpdateRequest;
use App\Http\Requests\Applications\WebTradelicenseInfoRequest;
use App\Models\FiscalYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Tradelicense;
use App\Models\Global_model;
use App\Models\IdGenerate;
use App\Models\BillGenerate;
use BanglaConverter;
use Converter;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\DataTables;
use Exception;
use stdClass;

class TradelicenseController extends Controller
{
    public $type;
    public $trade;

    public function __construct()
    {
        $this->type = 19;
        $this->trade = new Tradelicense();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('trade.application');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(session()->all());

        $data['business_type'] = DB::table('business_type')
            ->select('name_bn', 'id')
            ->where('union_id', auth()->user()->union_id)
            ->where('is_active', 1)
            ->get();

        $data['street_list'] = DB::table('street_setup')
            ->select('name_en', 'id')
            ->where('union_id', auth()->user()->union_id)
            ->where('is_active', 1)
            ->get();
        $data['total_ward'] = Global_model::union_profile(Auth::user()->union_id)->ward_no;

        return view('trade.application', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // TradelicenseInfoRequest
    public function store(TradelicenseInfoRequest $request)
    {
        // dd($request->all());

        //if nid, birthid, passportno empty
        if (count($request->nid) < 0 && count($request->birth_id) < 0) {
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
            $union_id = $request->union_id;
            $fiscal_year_id = $request->fiscal_id;
            //get tracking number
            $tracking = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by'] = $tracking;
        } else {
            $union_id = Auth::user()->union_id;
            $fiscal_year_id = Global_model::current_fiscal_year($union_id);
            $tracking = $generate->tracking($union_id, $fiscal_year_id, $this->type);
            $request['created_by'] = Auth::user()->employee_id;
        }

        $pins = [];

        // 2 = joint ownership // 3 = company
        if (in_array($request->type_of_organization, [2, 3])) {
            $pin = $generate->pin($union_id);

            $old_ctz = [];
            //generate multiple pin
            for ($i = 0; $i < count($request->name_bn); $i++) {
                if (is_null($request->pin[$i])) {
                    $pins[$i] = $pin++;
                    $old_ctz[$i] = false;
                } else {
                    $pins[$i] = $request->pin[$i];
                    $old_ctz[$i] = true;
                }

            }
            $request['old_ctz'] = $old_ctz;
        } else { //personal and financial business type

            //get pin number
            if ($request->pin) {
                $pin = $request->pin;
                $request['old_ctz'] = true;
            } else {
                $pin = $generate->pin($union_id);
                $request['old_ctz'] = false;
            }

            //generate multiple pin
            for ($i = 0; $i < count($request->name_bn); $i++) {
                $pins[] = $pin + $i;
            }
        }

        $request['union_id'] = $union_id;
        $request['pin'] = $pins;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['tracking'] = $tracking;
        $request['type'] = $this->type;


        $data = new Tradelicense();

        $response = $data->data_store($request);

        // dd($response);

        if ($response['status'] == "success") {
            if (isset($request->web)) {
                return response()->json(['success' => 'আবেদনটি সম্পূর্ণ হয়েছে!', 'message' => $response['message'], 'tracking' => $tracking, 'unionid' => $union_id, 'type' => $this->type, 'application' => 'trade_application']);
            } else {
                Alert::alert()->html("<i>আবেদনটি সম্পূর্ণ হয়েছে!</i>", "<p>" . $response['message'] . "</p><a href='" . route('trade_preview', ['fiscal_year_id' => $fiscal_year_id, 'tracking' => $tracking]) . "' class='btn btn-info' target='_blank'><i class='icon-copy fa fa-eye' aria-hidden='true'></i> প্রিন্ট করুন</a><a href='trade/applicant_list' class='btn btn-info ml-2'><i class='icon-copy fa fa-print' aria-hidden='true'></i>আবেদন তালিকা</a>", 'success')
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
    public function webApplly(WebTradelicenseInfoRequest $request)
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
        $union_id = $request->union_id;
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        //get tracking number
        $tracking = $generate->tracking($union_id, $fiscal_year_id, $this->type);

        $request['created_by'] = $tracking;
        $request['union_id'] = $union_id;
        $request['pin'] = $request->pin;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['tracking'] = $tracking;
        $request['type'] = $this->type;

        $res = Tradelicense::webApplication($request);

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    //===trade application preview===//
    public function preview($fiscal_year_id = null, $tracking = null)
    {
        //get union id
        $union_id = Auth::user()->union_id;

        //get trade application information
        $response = $this->trade->trade_information($fiscal_year_id, $tracking, $union_id, $this->type);

        // dd($response);

        //union profile data store in response
        $union_profile = Global_model::union_profile($union_id);

        $data = ['trade' => $response, 'union' => $union_profile];

        $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 2])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];

        $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member + $data['print_setting']->obibabok;

        // return view('trade.ppreview', $data);
        // dd($data);

        $pdf = PDF::loadView('trade.ppreview', $data);

        return $pdf->stream('trade_preview.pdf');
    }

    //===show applicant list===//
    public function applicant_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('trade.applicant_list', compact('fiscal_year_list'));
    }

    //===applicant list data===//
    public function applicant_data(Request $request)
    {
        header("Content-Type: application/json");

        $union_id = Auth::user()->union_id;
        $start = $request->start;
        $limit = $request->length;

        $search_content = ($request['search']['value'] != '') ? $request['search']['value'] : false;

        $fiscal_year_id = (int)$request->fiscal_year_id;
        $from_date = (isset($request->from_date)) ? $request->from_date : date('Y-m-d');

        $to_date = (isset($request->to_date)) ? $request->to_date : date('Y-m-d');

        $request_data = [
            'union_id' => $union_id,
            'start' => $start,
            'limit' => $limit,
            'fiscal_year_id' => $fiscal_year_id,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'search_content' => $search_content,
            'type' => $this->type,
        ];

        $applicant_list = new Tradelicense();

        $response = $applicant_list->trade_applicant_list_data($request_data);

        // echo "<pre>";
        // print_r($response);
        // exit;

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //===trade certificate generate===//
    public function sonod_generate(Request $request)
    {
        // dd($request->all());

        $union_id = Auth::user()->union_id;

        $generate = new IdGenerate();

        //create sonod no
        $sonod_no = $generate->sonod_no_generate($union_id, $this->type);

        // dd($sonod_no);

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

        // dd($request);

        $trade = new Tradelicense();

        $response = $trade->sonod_generate($request);

        echo json_encode($response);
    }

    //sonod regenerate
    public function sonod_regenerate(Request $request)
    {
        // dd($request);
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

        // dd($request);

        $trade = new Tradelicense();

        $response = $trade->sonod_generate($request);

        echo json_encode($response);
    }

    //===trade bangla sonod print===//
    public function sonod_print_bn($sonod_no = null)
    {
        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        // $start_time = microtime(true);

        $response = $trade->trade_certificate_data($sonod_no, $union_id, $this->type);

        // dd($response);

       $fiscal_year_name = Global_model::current_fiscal_year_name($union_id);
        // dd($fiscal_year_name);

        //get union information
        $union_profile = Global_model::union_profile($union_id);

        if ($response) {

            $data = ['trade' => $response, 'union' => $union_profile, 'fiscal_year_name' => $fiscal_year_name];

            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 1])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];

            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member + $data['print_setting']->obibabok;


            // $pdf = PDF::loadView('trade.bangla_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap),0.8);
                $mpdf->showWatermarkImage = true;
            }];

            // return view('trade.bangla_certificate', $data);

            // dd($data);

            $pdf = PDF::loadHtml(view('trade.bangla_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>দুঃখিত ! সনদটি পাওয়া যায়নি।</h2>";
        }
    }

    //===trade english sonod print====//
    public function sonod_print_en($sonod_no = null)
    {

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $response = $trade->trade_certificate_data($sonod_no, $union_id, $this->type);

        $fiscal_year_name = Global_model::current_fiscal_year_name($union_id);
        // dd($fiscal_year_name);
        //get union information
        $union_profile = Global_model::union_profile($union_id);


        if ($response == true) {

            $data = ['trade' => $response, 'union' => $union_profile,'fiscal_year_name'=>$fiscal_year_name ];

            $data['print_setting'] = DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $this->type, 'application_type' => 1])->get(['pad_print', 'chairman', 'sochib', 'member', 'obibabok'])[0];


            $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member + $data['print_setting']->obibabok;

            // $pdf = PDF::loadView('trade.english_certificate', $data);
            $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
                $mpdf->showWatermarkImage = true;
            }];

            //  dd($data);

            // return view('trade.english_certificate', $data);

            $pdf = PDF::loadHtml(view('trade.english_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>Sorry ! This certificate could not found.</h2>";
        }
    }

    //===previous trade bangla sonod print===//
    public function previous_sonod_print_bn($sonod_no = null, $fiscal_year_id = null)
    {

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        // dd($fiscal_year_id);

        $response = $trade->previous_trade_certificate_data($sonod_no, $union_id, $this->type, $fiscal_year_id);

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
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('trade.bangla_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
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
                $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
                $mpdf->showWatermarkImage = true;
            }];

            $pdf = PDF::loadHtml(view('trade.english_certificate', $data), $config);

            return $pdf->stream('tradelicense_certificate.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center'>Sorry ! This certificate could not found.</h2>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fiscal_year_id, $tracking)
    {

        $union_id = Auth::user()->union_id;

        $trade = new Tradelicense();

        $res = $trade->trade_data($fiscal_year_id, $tracking, $union_id);

        // dd($res);

        $business_type = DB::table('business_type')
            ->select('name_bn', 'id')
            ->where('union_id', auth()->user()->union_id)
            ->where('is_active', 1)
            ->get();

        $data['street_list'] = DB::table('street_setup')
            ->select('name_en', 'id')
            ->where('union_id', auth()->user()->union_id)
            ->where('is_active', 1)
            ->get();

        $data['total_ward'] = Global_model::union_profile(Auth::user()->union_id)->ward_no;

        $data['business_type'] = json_encode($business_type);


        $data['organization'] = (object)$res['organization'];
        $data['owners'] = (object)$res['ownerList'];

        // dd($data);

        return view('trade.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TradelicenseInfoUpdateRequest $request)
    {
        // dd($request->all());

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $request['fiscal_year_id'] = Global_model::current_fiscal_year($union_id);

        $response = $trade->update_trade($request);

        // dd($response);

        if ($response['status'] == "success") {
            Alert::toast('আপনার তথ্য সফলভাবে আপডেট হয়েছে!', 'success');
            return redirect()->to(session('previous-url'));
        } else {
            Alert::toast('আবেদন সম্পূর্ণ হয়নি!', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {

        $trade = new Tradelicense();

        $response = $trade->trade_info_delete($request);

        return $response;
    }

    //=====for trade certificate list====//
    public function certificate_list()
    {
        session(['previous-url' => request()->url()]);

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('trade.certificate_list', compact('fiscal_year_list'));
    }

    ///======for trade certificate list data====//
    public function certificate_list_data(Request $request)
    {
        // header("Content-Type: application/json");

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

        $trade = new Tradelicense();

        $response = $trade->trade_certificate_list($request_data);

        // dd($response);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;

        $response['draw'] = $request->draw;

        echo json_encode($response);
    }

    //=====for previous trade certificate list====//
    public function previous_certificate_list()
    {

        session(['previous-url' => request()->url()]);

        //get previous fiscal years list
        $fiscal_years = DB::table('fiscal_years')->select('id', 'name')
            ->where('is_current', 0)
            ->where('is_active', 1)
            ->get();

        return view('trade.previous_certificate_list')->with('fiscal_years', $fiscal_years);
    }

    ///======for previous_ trade certificate list data====//
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


        $trade = new Tradelicense();

        $response = $trade->prev_trade_certificate_list($request_data);


        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;


        $response['draw'] = $request->draw;


        echo json_encode($response);
    }

    // expire  certificate list
    public function expire_certificate_list(Request $request)
    {


        if ($request->ajax()) {

            $trade = new Tradelicense();

            $response = $trade->expire_trade_certificate_list(Auth::user()->union_id);

            return Datatables::of($response)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('trade.expire_certificate_list');
    }

    // money receipt
    public function money_receipt($voucher_no = null)
    {
        $trade = new Tradelicense();

        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        //get money receipt data
        $response = $trade->money_receipt_data($voucher_no, $union_id, $this->type);

        $bank = DB::table('bank')->where('sonod_type','=',19)->first();

        if(empty($bank)){
            $bank = new stdClass;
            $bank->bank_name = '';
            $bank->bank_branch = '';
            $bank->account_num = '';
            $bank->bank_branch_address = '';

        }



        if (!empty($response)) {
            // return view('trade.money_receipt', ['data' => $response, 'union' => $union_profile]);

            $pdf = PDF::loadView('trade.money_receipt', ['data' => $response,'bank' => $bank, 'union' => $union_profile]);

            return $pdf->stream('trade_money_receipt.pdf');
        } else {
            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }
    }

    // for register
    public function register_dialogue()
    {
        return view("reports.trade.register");
    }

    public function register_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        // get register data
        // $start_time = microtime(true);
        $response = $trade->trade_register_data($union_id, $this->type, $from_date, $to_date);
        // $end_time = microtime(true);

        //  dd($end_time - $start_time);
        //  dd((($end_time - $start_time) / 1000) / 1000 );

        // dd($response);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        },
            'orientation' => 'L'
        ];

        // return view('trade.register', ['data' => $response, 'union' => $union_profile]);

        $pdf = PDF::loadHtml(view('trade.register', ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("trade_register.pdf");
    }

    public function dabi_aday_register_dialogue()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_info = Global_model::fiscal_years($union_id);
        // $fiscal_year_id = $fiscal_year_info->id;
    // dd($fiscal_year_info);
        return view("reports.trade.dabi_aday_register",compact('fiscal_year_info'));
    }

    public function dabi_aday_print(Request $request)
    {

        // dd($request);

        // $union_id = Auth::user()->union_id;


        // $fiscal_year_id = $fiscal_year_info->id;

        $fiscal_year_id = $request->fiscal_year_id;

        $fiscal_year_info = Global_model::one_fiscal_year_info($fiscal_year_id);

        // dd($fiscal_year_info);

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        // get register data

        // $start_time = microtime(true);

        $response = $trade->trade_dabi_aday_register_data($union_id, $this->type, $from_date, $to_date,$fiscal_year_id);

        // dd($response);

        $nobayon_license = DB::table('certificate')
                            ->where('type','=',19)
                            ->where('status','=',2)
                            ->where('fiscal_year_id','=',$fiscal_year_id)
                            ->where('is_active','=',1)
                            ->get()->count();


        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->main_logo));
            $mpdf->showWatermarkImage = true;
        },
            'orientation' => 'L'
        ];
        // dd($response,$union_profile);
        return view('trade.dabi_aday_register', ['data' => $response,'fiscal_year_info'=> $fiscal_year_info,'nobayon_license'=>$nobayon_license, 'union' => $union_profile]);

        // $pdf = PDF::loadHtml(view('trade.dabi_aday_register', ['data' => $response, 'fiscal_year_info'=> $fiscal_year_info,'nobayon_license'=>$nobayon_license, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.register',  ['data' => $response, 'union' => $union_profile]);

        // return $pdf->stream("trade_dabi_aday_register.pdf");
    }


    public function register($from_date = null, $to_date = null)
    {
        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        // get register data
        // $start_time = microtime(true);
        $response = $trade->trade_register_data($union_id, $this->type, $from_date, $to_date);
        // $end_time = microtime(true);

        //  dd($end_time - $start_time);
        //  dd((($end_time - $start_time) / 1000) / 1000 );

        // dd($response);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        },
            'orientation' => 'L'
        ];

        // return view('trade.register', ['data' => $response, 'union' => $union_profile]);

        $pdf = PDF::loadHtml(view('trade.register', ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("trade_register.pdf");
    }

    // for vat register
    public function tax_register($from_date = null, $to_date = null)
    {

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get register data
        $response = $trade->trade_register_data($union_id, $this->type, $from_date, $to_date);

        $pdf = PDF::loadView('trade.tax_register', ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("tax_register.pdf");
    }

    // for pesha kor register
    public function peshakor_register($from_date = null, $to_date = null)
    {

        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get pesha kor register data

        $response = $trade->peshakor_register_data($union_id, $this->type, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('trade.peshakor_register', ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.peshakor_register',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("trade_peshakor_register.pdf");
    }

    // get trade and pesha vat report
    public function daily_trade_pesha_report($from_date = null, $to_date = null)
    {


        $trade = new Tradelicense();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get register data

        $response = $trade->daily_trade_pesha_vat_report_data($union_id, $this->type, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile) {
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('trade.daily_trade_pesha_report', ['data' => $response, 'union' => $union_profile]), $config);

        // $pdf = PDF::loadView('trade.daily_trade_pesha_report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("trade_pesha_report.pdf");
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
            $mpdf->SetWatermarkImage(asset('images/union_profile/' . $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('trade.daily_vat_report', ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('trade.daily_vat_report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("vat_report.pdf");
    }

    // collect pesha kor
    public function collect_pesha_kor()
    {

        return view('trade.collect_pesha_kor');
    }

    // peshsa kor list
    public function pesha_kor_list(Request $request)
    {

        header("Content-Type: application/json");

        //get union id
        $union_id = Auth::user()->union_id;

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

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
            'type' => $this->type,
            'credit' => Global_model::get_account_id($union_id, 28), //28 = pesha kor account type

        ];


        $trade = new Tradelicense();

        $response = $trade->pesha_kor_list_data($request_data, $search_content);

        // dd($response);
        // exit;


        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;


        $response['draw'] = $request->draw;


        echo json_encode($response);
    }

    // pesha kor money recipt
    public function peshakor_money_receipt($sonod_no = null)
    {

        $trade = new Tradelicense();

        //get union code
        $union_id = Auth::user()->union_id;

        $union = new Global_model();

        //get union profile data
        $union_profile = $union->union_profile($union_id);

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        //get peshakor money receipt data
        $response = $trade->peshakor_money_receipt_data($sonod_no, $union_id, $this->type, $fiscal_year_id);


        if (!empty($response)) {

            $pdf = PDF::loadView('trade.peshakor_money_receipt', ['data' => $response, 'union' => $union_profile]);

            return $pdf->stream('peshakor_money_receipt.pdf');
        } else {

            echo "<h1 style='color:red;text-align:center;'> দুঃখিত ! রশিদ টি পাওয়া যায়নি</h1>";
        }
    }

    // get pesha kor data
    public function get_pesha_kor_data(Request $request)
    {

        $trade = new Tradelicense();

        //get union code
        $union_id = Auth::user()->union_id;

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        //get peshakor data
        $response = $trade->get_pesha_kor_data($request->sonod_no, $union_id, $this->type, $fiscal_year_id);

        // dd($response);
        // exit;

        echo json_encode($response);
    }

    public function pesha_kor_save(Request $request)
    {

        $trade = new Tradelicense();

        //get union code
        $union_id = Auth::user()->union_id;

        //get current fiscal year id
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $request['union_id'] = $union_id;
        $request['fiscal_year_id'] = $fiscal_year_id;
        $request['type'] = $this->type;
        $request['credit_id'] = Global_model::get_account_id($union_id, 28); //28 = pesha kor account type

        $response = $trade->pesha_kor_save($request);

        echo json_encode($response);
    }

    public function bill_list(Request $request)
    {
        // dd($request->ajax());

        if ($request->ajax()) {
            $data = DB::table("acc_invoice AS INV")
                ->join("fiscal_years AS FY", "FY.id", "INV.fiscal_year_id")
                ->where([
                    "INV.union_id" => Auth()->user()->union_id,
                    "INV.type" => 3
                ])
                ->whereNull("INV.deleted_at")
                ->selectRaw("INV.invoice_id, INV.voucher_no, INV.txn_no, INV.sonod_no, INV.fiscal_year_id, FY.name AS fiscal_year, INV.amount, INV.is_paid, DATE(INV.created_at) AS created_at");

            return Datatables::of($data)
                ->addColumn('print_btn', function ($item) {
                    return '<a href="' . url('/trade/money_receipt/' . $item->voucher_no) . '" target="_blank"><span class="btn btn-sm custom_button_violet">রশিদ</span></a>';
                })
                ->addColumn('action', function ($item) {
                    return $item->is_paid == 0 ? '<span class="btn btn-sm btn-primary">Unpaid</span>' : '<span class="btn btn-sm btn-success">Paid</span>';
                })
                ->rawColumns(['print_btn', 'action'])
                ->make(true);
        }

        return view('trade.bill_list');
    }

    // bill collection
    public function bill_collection(Request $request)
    {
        $unPaidSonodLists = DB::table('acc_invoice as INV')
            ->join('certificate AS CT', 'INV.sonod_no', '=', 'CT.sonod_no')
            ->join('fiscal_years AS FS', 'FS.id', '=', 'INV.fiscal_year_id')
            ->join('trade_optional_info AS TOI', 'CT.tracking', '=', 'TOI.tracking')
            ->select('CT.sonod_no', 'TOI.organization_name_bn')
            ->where('INV.union_id', Auth::user()->union_id)
            ->where('INV.is_paid', 0)
            ->groupBy('INV.sonod_no')
            ->get();

        return view("trade.bill_collection", compact('unPaidSonodLists'));
    }

    public function invoice_data(Request $request)
    {
        $union_id = Auth()->user()->union_id;

        $invoice_info = DB::table("acc_invoice AS INV")
            ->join("fiscal_years AS FY", function ($join) use ($union_id) {
                $join->on("INV.fiscal_year_id", "=", "FY.id")
                    ->whereNull("INV.deleted_at")
                    ->where("INV.union_id", $union_id)
                    ->where("INV.is_paid", 0)   // unpaid
                    ->where(function ($query) {
                        $query->where("INV.invoice_id", request('search_id'))
                            ->orWhere("INV.voucher_no", request('search_id'))
                            ->orWhere("INV.sonod_no", request('search_id'));
                    });
            })
            ->where("INV.union_id", $union_id)
            ->where("INV.is_paid", 0)   // unpaid
            ->where(function ($query) {
                $query->where("INV.invoice_id", request('search_id'))
                    ->orWhere("INV.voucher_no", request('search_id'))
                    ->orWhere("INV.sonod_no", request('search_id'));
            })
            ->select("INV.id", "INV.union_id", "INV.invoice_id", "INV.voucher_no", "INV.sonod_no", "INV.is_paid", "INV.amount", "FY.name AS fiscal_year", "INV.fiscal_year_id")
            ->get()->toArray();

        // dd($invoice_info);

        if (empty($invoice_info)) {
            return response()->json(['status' => 'error', 'message' => 'No unpaid invoice found.', 'data' => ['invoice_info'
            => [], 'voucher_info' => []]]);
        }

        // if($invoice_info->is_paid == 1){
        //     return response()->json(['status' => 'error', 'message' => 'This invoice already paid. Try again with another one.', 'data' => []]);
        // }

        // voucher info
        foreach ($invoice_info as $key => $item) {

            $invoice_info[$key]->voucher_info = DB::table("acc_voucher AS ACV")
                ->join("acc_account AS ACC", "ACC.id", "=", "ACV.acc_no")
                ->where([
                    "ACV.union_id" => $union_id,
                    "ACV.invoice_id" => $item->invoice_id,
                    "ACV.type" => $this->type
                ])
                ->select("ACV.invoice_id", "ACV.voucher_id", "ACV.sonod_no", "ACV.amount", "ACC.account_name", "ACC.acc_type")
                ->get()->toArray();
        }

        // dd($invoice_info);

        return response()->json(['status' => 'success', 'message' => 'Data found.', 'data' => $invoice_info]);
    }

    public function bill_collection_save(Request $request)
    {
        // dd($request->all());

        $fiscal_year_id = Global_model::current_fiscal_year(Auth()->user()->union_id);

        // get unpaid invoice list by sonod no
        $invoice_list = DB::table("acc_invoice AS INV")
            ->where([
                "sonod_no" => $request->sonod_no,
                "is_paid" => 0,  // unpaid
            ])
            ->whereNull("deleted_at")
            ->get();

        // dd($invoice_list);

        // get voucher list
        $transaction_data = [];

        foreach ($invoice_list as $pitem) {

            $voucher_data = DB::table("acc_voucher")->where("invoice_id", $pitem->invoice_id)->get();

            foreach ($voucher_data as $item) {
                $transaction_data[] = [
                    'union_id' => $item->union_id,
                    'fiscal_year_id' => $fiscal_year_id,
                    'voucher' => $item->voucher_id,
                    'sonod_no' => $item->sonod_no,
                    'amount' => $item->amount,
                    'debit' => NULL,
                    'credit' => $item->acc_no,
                    'type' => $item->type,
                    'created_by' => Auth::user()->employee_id,
                    'created_time' => now(),
                    'created_by_ip' => $request->ip(),
                ];
            }
        }

        // dd($transaction_data);

        DB::beginTransaction();

        try {
            // update acc_invoice
            $txn_no = date("ymdhis");

            foreach ($invoice_list as $pitem) {
                DB::table("acc_invoice")
                    ->where("invoice_id", $pitem->invoice_id)
                    ->update([
                        "txn_no" => $txn_no,
                        "is_paid" => 1,
                        "payment_date" => Date("Y-m-d"),
                        "updated_at" => now(),
                        "updated_by" => Auth()->user()->id,
                        "updated_by_ip" => $request->ip()
                    ]);
            }

            DB::table("acc_transaction")->insert($transaction_data);

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Successfully trade invoice collection done.', 'data' => ['sonod_no' => $voucher_data[0]->sonod_no]]);

        } catch (Exception $e) {

            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => 'Fail to collection trade invoice data.', 'data' => []]);

        }
    }
    // end

    // due bill
    public function due_bill(Request $request)
    {
        // $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        // $current_fiscal_year = Global_model::current_fiscal_year(Auth()->user()->union_id);

        return view("trade.due_bill_entry");
    }

    public function sonod_data(Request $request)
    {
        $sonod_no = $request->search_id;
        $union_id = Auth()->user()->union_id;

        $certificate_data = DB::table('certificate AS CRT')
            ->select('CRT.tracking', 'TRDOPT.mobile AS mobile_no', 'TRDOPT.organization_name_bn AS business_name', 'BSYTP.name_bn as business_type_name', 'CRT.sonod_no')
            ->join('application AS APP', function ($join) use ($sonod_no, $union_id) {
                $join->on("APP.tracking", "=", "CRT.tracking")
                    ->on("APP.union_id", "=", "CRT.union_id")
                    ->on("APP.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("APP.union_id", "=", $union_id)
                    ->where("CRT.union_id", "=", $union_id)
                    ->where("CRT.sonod_no", "=", $sonod_no)
                    ->where("APP.is_active", "=", 1);
            })
            ->join('trade_optional_info AS TRDOPT', function ($join) use ($sonod_no, $union_id) {
                $join->on("TRDOPT.tracking", "=", "CRT.tracking")
                    ->on("TRDOPT.union_id", "=", "CRT.union_id")
                    ->on("TRDOPT.fiscal_year_id", "=", "CRT.fiscal_year_id")
                    ->where("CRT.sonod_no", "=", $sonod_no)
                    ->where("TRDOPT.union_id", "=", $union_id)
                    ->where("TRDOPT.is_active", "=", 1);
            })
            ->join('business_type AS BSYTP', function ($join) use ($union_id) {
                $join->on("BSYTP.union_id", "=", "CRT.union_id")
                    ->on("BSYTP.union_id", "=", "TRDOPT.union_id")
                    ->on("BSYTP.id", "=", "TRDOPT.business_type")
                    ->where("BSYTP.union_id", "=", $union_id)
                    ->where("BSYTP.is_active", "=", 1);
            })
            ->get()->first();

        if (empty($certificate_data)) {
            return ['status' => 'error', 'message' => 'No certificate found.', 'data' => []];
        }

        return ['status' => 'success', 'message' => 'Data found.', 'data' => $certificate_data];
    }

    public function due_bill_save(Request $request)
    {
        $sonod_no = $request->sonod_no;
        $fiscal_year = $request->fiscal_year_id;
        $union_id = Auth()->user()->union_id;

        // duplicate invoice in same fiscal year
        // $duplicate = DB::table("acc_invoice")
        //                 ->where("sonod_no", $sonod_no)
        //                 ->where("fiscal_year_id", $fiscal_year_id)
        //                 ->get()->toArray();

        // dd($duplicate);

        // if(count($duplicate)){
        //     return response()->json(['status' => 'error', 'message' => 'এই অর্থ বছরে এই সনদ এর ফি এন্ট্রি আছে।', 'data' => []]);
        // }

        // get fiscal year
        $fiscal_year_qry = DB::table("fiscal_years")
            ->where('name', $fiscal_year)
            ->where('is_current', 0)
            ->get()->first();

        if (empty($fiscal_year_qry)) {    // insert
            DB::table("fiscal_years")->insert([
                "name" => $fiscal_year,
                "is_current" => 0,
                "is_active" => 0,
                "is_process" => 0,
                "expire_date" => '1999-01-01',
                "created_time" => now(),
                "created_at" => now(),
                "created_by" => Auth::user()->employee_id,
                "created_by_ip" => $request->ip()
            ]);

            $fiscal_year_id = DB::getPdo()->lastInsertId();
        } else {
            $fiscal_year_id = $fiscal_year_qry->id;
        }

        // dd($fiscal_year_qry);

        //create voucher no
        $generate = new IdGenerate();
        $voucher_no = $generate->voucher($union_id, $fiscal_year_id);

        // dd($voucher_no);

        $invoice_id = BillGenerate::generateID();

        // license fee
        $license_fee_acc = Global_model::get_account_id($union_id, $this->type);

        $voucher_data[] = [
            'union_id' => $union_id,
            'invoice_id' => $invoice_id,
            'voucher_id' => $voucher_no,
            'sonod_no' => $sonod_no,
            'amount' => $request->license_fee,
            'acc_no' => $license_fee_acc,
            'type' => $this->type,
            'created_at' => now()
        ];

        //if have signbord_vat (21)
        if ($request->signboard_vat > 0) {

            //get signbord account id
            $signbord_vat_account_id = Global_model::get_account_id($union_id, 21);

            if ($signbord_vat_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $voucher_data[] = [
                    'union_id' => $union_id,
                    'invoice_id' => $invoice_id,
                    'voucher_id' => $voucher_no,
                    'sonod_no' => $sonod_no,
                    'amount' => $request->signboard_vat,
                    'acc_no' => $signbord_vat_account_id,
                    'type' => $this->type,
                    'created_at' => now()
                ];
            }
        }

        //if have vat (25)
        if ($request->vat > 0) {

            //get vat account id
            $vat_account_id = Global_model::get_account_id($union_id, 25);

            if ($vat_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $voucher_data[] = [
                    'union_id' => $union_id,
                    'invoice_id' => $invoice_id,
                    'voucher_id' => $voucher_no,
                    'sonod_no' => $sonod_no,
                    'amount' => $request->vat,
                    'acc_no' => $vat_account_id,
                    'type' => $this->type,
                    'created_at' => now()
                ];
            }
        }

        //if have sarcharge (22)
        if ($request->sar_charge > 0) {

            //get sarcharge account id
            $sarcharge_account_id = Global_model::get_account_id($union_id, 22);

            if ($sarcharge_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $voucher_data[] = [
                    'union_id' => $union_id,
                    'invoice_id' => $invoice_id,
                    'voucher_id' => $voucher_no,
                    'sonod_no' => $sonod_no,
                    'amount' => $request->sar_charge,
                    'acc_no' => $sarcharge_account_id,
                    'type' => $this->type,
                    'created_at' => now()
                ];
            }
        }

        //if have source_vat (97)
        if ($request->source_vat > 0) {

            //get source_vat account id
            $source_vat_account_id = Global_model::get_account_id($union_id, 97); // 97 = source_vat

            if ($source_vat_account_id < 0) {
                return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];
            } else {
                $voucher_data[] = [
                    'union_id' => $union_id,
                    'invoice_id' => $invoice_id,
                    'voucher_id' => $voucher_no,
                    'sonod_no' => $sonod_no,
                    'amount' => $request->source_vat,
                    'acc_no' => $source_vat_account_id,
                    'type' => $this->type,
                    'created_at' => now()
                ];
            }
        }

        $invoice_data = [
            "union_id" => $union_id,
            "invoice_id" => $invoice_id,
            "voucher_no" => $voucher_no,
            "sonod_no" => $sonod_no,
            "fiscal_year_id" => $fiscal_year_id,
            "amount" => array_sum(array_column($voucher_data, "amount")),
            "type" => 3,
            "is_paid" => 0,
            "created_at" => now(),
            "created_by" => Auth::user()->employee_id,
            "created_by_ip" => $request->ip()
        ];

        // dd($invoice_data, $voucher_data);

        DB::beginTransaction();

        try {
            DB::table("acc_invoice")->insert($invoice_data);

            DB::table("acc_voucher")->insert($voucher_data);

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Save successfully done.', 'data' => []]);
        } catch (Exception $e) {
            DB::rollBack();

            // dd($e);

            return response()->json(['status' => 'error', 'message' => 'Fail to save.', 'data' => []]);
        }

    }

    // end

    // === Settings === //

    public function settings($type = "trade")
    {

        $union_id = Auth()->user()->union_id;
        $current_fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $query = DB::table("settings")
            ->where("union_id", $union_id)
            ->where("fiscal_year_id", $current_fiscal_year_id)
            ->whereIn("options", [
                "max_source_tax",
                "vat",
                "running_sarcharge",
                "sarcharge_on_due",
                "nion",
                "lighting",
                "general"
            ])
            ->get()->toArray();

        $data = [];

        foreach ($query as $item) {
            $data[$item->options] = [
                "id" => $item->id,
                "value" => $item->value
            ];
        }

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

    // dd($data);
        if (!empty($type) && $type === "signboard") {
            return view("trade.signboard_settings", compact("data", "fiscal_year_list"));
        } elseif (!empty($type) && $type === "trade") {
            return view("trade.settings", compact("data", "fiscal_year_list"));
        }


    }

    public function getConfig($fiscal_year_id)
    {
        $union_id = Auth()->user()->union_id;

        $query = DB::table("settings")
            ->where("union_id", $union_id)
            ->where("fiscal_year_id", $fiscal_year_id)
            ->whereIn("options", [
                "max_source_tax",
                "vat",
                "running_sarcharge",
                "sarcharge_on_due",
                // signboard
                "nion",
                "lighting",
                "general"
            ])
            ->get()->toArray();

        $data = [];

        foreach ($query as $item) {
            $data[$item->options] = [
                "id" => $item->id,
                "value" => $item->value
            ];
        }

        return response()->json(["status" => "success", "message" => "Found", "data" => $data]);

    }

    public function settings_save(Request $request)
    {
                // dd($request->all());
        $union_id = Auth()->user()->union_id;

        $insert_data = [];
        $update_data = [];

        // max_source_tax
        if (!empty($request->max_source_tax)) {
            if (!empty($request->max_source_tax_id)) {   // update
                $update_data[] = [
                    "id" => $request->max_source_tax_id,
                    "options" => "max_source_tax",
                    "value" => $request->max_source_tax
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "max_source_tax",
                    "value" => $request->max_source_tax
                ];
            }
        }

        // dd($request->vat);

        // vat
        if (!empty($request->vat)) {
            if (!empty($request->vat_id)) {   // update
                $update_data[] = [
                    "id" => $request->vat_id,
                    "options" => "vat",
                    "value" => $request->vat
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "vat",
                    "value" => $request->vat
                ];
            }
        }
        // dd($update_data);
        // running_sarcharge
        if (!empty($request->running_sarcharge)) {
            if (!empty($request->running_sarcharge_id)) {   // update
                $update_data[] = [
                    "id" => $request->running_sarcharge_id,
                    "options" => "running_sarcharge",
                    "value" => $request->running_sarcharge
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "running_sarcharge",
                    "value" => $request->running_sarcharge
                ];
            }
        }

        // sarcharge_on_due
        if (!empty($request->sarcharge_on_due)) {
            if (!empty($request->sarcharge_on_due_id)) {   // update
                $update_data[] = [
                    "id" => $request->sarcharge_on_due_id,
                    "options" => "sarcharge_on_due",
                    "value" => $request->sarcharge_on_due
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "sarcharge_on_due",
                    "value" => $request->sarcharge_on_due
                ];
            }
        }


        // ============= signboard ============== //

        if (!empty($request->nion)) {
            if (!empty($request->nion_id)) {   // update
                $update_data[] = [
                    "id" => $request->nion_id,
                    "options" => "nion",
                    "value" => $request->nion
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "nion",
                    "value" => $request->nion
                ];
            }
        }


        if (!empty($request->lighting)) {
            if (!empty($request->lighting_id)) {   // update
                $update_data[] = [
                    "id" => $request->lighting_id,
                    "options" => "lighting",
                    "value" => $request->lighting
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "lighting",
                    "value" => $request->lighting
                ];
            }
        }

        if (!empty($request->general)) {
            if (!empty($request->general_id)) {   // update
                $update_data[] = [
                    "id" => $request->general_id,
                    "options" => "general",
                    "value" => $request->general
                ];
            } else {    // insert
                $insert_data[] = [
                    "union_id" => $union_id,
                    "fiscal_year_id" => $request->fiscal_year_id,
                    "options" => "general",
                    "value" => $request->general
                ];
            }
        }

        //dd($insert_data, $update_data);


        DB::beginTransaction();

        try {
            if (count($insert_data)) {
                DB::table("settings")->insert($insert_data);
            }

            foreach ($update_data as $item) {
                DB::table("settings")->where("id", $item['id'])->update($item);
            }

            DB::commit();

            $type = ($request->type === "signboard") ? "signboard" : "trade";

            Alert::toast('Successfully save the ' . $type . ' settings.', 'success');


        } catch (Exception $e) {
            DB::rollBack();

            Alert::toast('Fail to save the trade settings.', 'error');
        }

        return redirect()->back();

    }
    // END

    //====== business fee settings //
    public function businessFeeSettings(Request $request)
    {
        if($request->ajax()){

        $union_id = Auth()->user()->union_id;
        $current_fiscal_year_id = Global_model::current_fiscal_year($union_id);
        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        $data = DB::table('business_type AS BT')
            ->leftJoin('business_type_fees AS BTF', function ($join) use ($current_fiscal_year_id) {
                $join->on('BTF.business_type_id', '=', 'BT.id')
                    ->on('BTF.union_id', '=', 'BT.union_id')
                    ->where('BTF.fiscal_year_id', $current_fiscal_year_id);
            })
            ->where('BT.is_active', 1)
            ->where('BT.union_id', $union_id)
            ->select('BT.id', 'BT.name_bn', 'BT.name_en', 'BTF.id as business_id', 'BTF.fees')
            ->orderBy('BT.id', 'ASC')
            ->get()->toArray();
            

        $business_fee_data = [];

        foreach ($data as $key => $item) {
            $business_fee_data[$item->id] = [
                'name_bn' => $item->name_bn,
                'name_en' => $item->name_en,
                'fee' => $item->fees,
                'business_id' => $item->business_id,
            ];
        }
            //   dd($business_fee_data);
            $response = $business_fee_data;
            // dd($response);

            return DataTables::of($response)
            ->addIndexColumn()
            ->make(true);
    }

        // return view('trade.business_fees_ settings', compact('business_fee_data', 'fiscal_year_list'));
        return view('trade.business_fees_ settings');
    }


    public function businessFeeSettingsSave(Request $request)
    {
        // dd($request->all());

        $union_id = Auth()->user()->union_id;


        $up_data = DB::table('business_type_fees')
                        ->where([
                            'union_id' => $union_id,
                            'id' => $request->business_id,
                        ])
                            ->update(['fees' => $request->business_fee]);


        return response()->json([
            "status" => "success",
            "message" => "সফল ভাবে বাবসার ফি আপডেট করা হয়েছে",
        ]);
    }


    public function getBusinessFees($fiscal_year_id)
    {
        $union_id = Auth()->user()->union_id;

        $data = DB::table('business_type AS BT')
            ->leftJoin('business_type_fees AS BTF', function ($join) use ($fiscal_year_id) {
                $join->on('BTF.business_type_id', '=', 'BT.id')
                    ->on('BTF.union_id', '=', 'BT.union_id')
                    ->where('BTF.fiscal_year_id', $fiscal_year_id);
            })
            ->where('BT.is_active', 1)
            ->where('BT.union_id', $union_id)
            ->select('BT.id', 'BT.name_bn', 'BT.name_en', 'BTF.id as business_id', 'BTF.fees')
            ->orderBy('BT.id', 'ASC')
            ->get()->toArray();

        $business_fee_data = [];

        foreach ($data as $key => $item) {
            $business_fee_data[$item->id] = [
                'name_bn' => $item->name_bn,
                'name_en' => $item->name_bn,
                'fee' => $item->fees,
                'business_id' => $item->business_id,
            ];
        }


        return response()->json([
            "status" => count($business_fee_data) > 0 ? "success" : "error",
            "message" => count($business_fee_data) > 0 ? "Data found" : "Data not found",
            "data" => count($business_fee_data) > 0 ? $business_fee_data : [],
        ]);
    }

    //====== business fee settings ============== //


    //=============== reports ================ //

    public function fiscalYearWiseReport()
    {
        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);
        // $current_fiscal_year_id = Global_model::current_fiscal_year(Auth()->user()->union_id);

        // dd($fiscal_year_list);

        return view('reports.trade.fiscal_wise_report', compact('fiscal_year_list'));
    }

    public function businessTypeWiseReport()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        $data_list = DB::table("business_type")
                        ->where("union_id", $union_id)
                        ->where("is_active", 1)
                        ->select("id", "name_bn", "name_en", "type")
                        ->get();

        // dd($data_list);

        return view('reports.trade.business_type_wise_report', compact('fiscal_year_list', 'data_list'));
    }

    public function roadWiseReport()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        $data_list = DB::table("street_setup")
                        ->where("union_id", $union_id)
                        ->where("is_active", 1)
                        ->select("id", "name_bn", "name_en")
                        ->get();

        // dd($data_list);

        return view('reports.trade.road_wise_report', compact('fiscal_year_list', 'data_list'));
    }

    public function feeWiseReport()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('reports.trade.fee_wise_report', compact('fiscal_year_list'));
    }

    public function newLicenseReport()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('reports.trade.new_license_report', compact('fiscal_year_list'));
    }

    public function renewLicenseReport()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('reports.trade.renew_license_report', compact('fiscal_year_list'));
    }

    public function dueLicenseReport()
    {
        $union_id = Auth::user()->union_id;

        $fiscal_year_list = Global_model::fiscal_years(Auth()->user()->union_id);

        return view('reports.trade.due_license_report', compact('fiscal_year_list'));
    }

    public function certificateReportPrint(Request $request)
    {
        $union_id = Auth()->user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        // dd(is_null($request->is_paid));

        // get register data
        $response = [];

        $response_qry = DB::table("certificate AS CRT")
                        ->join("trade_optional_info AS TOI", function($join) use($union_id){
                            $join->on("TOI.union_id", "=", "CRT.union_id")
                                ->on("TOI.fiscal_year_id", "=", "CRT.fiscal_year_id")
                                ->on("TOI.tracking", "=", "CRT.tracking")
                                ->where("CRT.union_id", $union_id)
                                ->where("CRT.fiscal_year_id", request('fiscal_year_id'))
                                // ->where("CRT.status", 1)
                                ->where("CRT.is_active", 1)

                                ->when(request('business_type') > 0, function($q){
                                    $q->where("TOI.business_type", request('business_type'));
                                })

                                ->when(request('road_id') > 0, function($q){
                                    $q->where("TOI.trade_rbs_en", request('road_id'));
                                })

                                ->when(request('status') > 0, function($q){
                                    $q->where("CRT.status", request('status'));
                                });
                        })

                        // ->join("acc_invoice AS INV", function($join) use($union_id){
                        //     $join->on("INV.union_id", "=", "CRT.union_id")
                        //         ->on("INV.sonod_no", "=", "CRT.sonod_no")
                        //         ->on("INV.fiscal_year_id", "=", "CRT.fiscal_year_id")
                        //         ->where("CRT.status", 1)
                        //         ->where("CRT.is_active", 1)
                        //         ->where("INV.type", 3)  // 3 = trade
                        //         ->whereNull("INV.deleted_at")
                        //         ->where("INV.union_id", $union_id)
                        //         ->where("INV.fiscal_year_id", request('fiscal_year_id'))
                        //         ->where("CRT.union_id", $union_id)
                        //         ->where("CRT.fiscal_year_id", request('fiscal_year_id'))
                        //         ->when(request('fee_amount') > 0, function($q){
                        //             $q->where("INV.amount", "<=", request('fee_amount'));
                        //         });
                        // })

                        ->join("business_type AS BT", function($join) use($union_id){
                            $join->on("TOI.union_id", "=", "BT.union_id")
                                ->on("TOI.business_type", "=", "BT.id")
                                ->where("BT.union_id", $union_id);
                                // ->where("BT.type", 1);  // 1 = trade
                        })

                        ->leftJoin("street_setup AS RD", function($join) use($union_id){
                            $join->on("TOI.union_id", "=", "RD.union_id")
                                ->on("TOI.trade_rbs_en", "=", "RD.id")
                                ->where("RD.union_id", $union_id);
                                // ->where("BT.type", 1);  // 1 = trade
                        })

                        ->join("bd_locations AS BD1", "BD1.id", "=", "TOI.trade_district_id")

                        ->join("bd_locations AS BD2", "BD2.id", "=", "TOI.trade_upazila_id")

                        ->join("bd_locations AS BD3", "BD3.id", "=", "TOI.trade_postoffice_id")

                        ->where("CRT.union_id", $union_id)
                        ->where("CRT.fiscal_year_id", $request->fiscal_year_id)

                        ->when($request->business_type > 0, function($q){
                            $q->where("TOI.business_type", request('business_type'));
                        })

                        ->when(request('road_id') > 0, function($q){
                            $q->where("TOI.trade_rbs_en", request('road_id'));
                        })

                        ->when(request('status') > 0, function($q){
                            $q->where("CRT.status", request('status'));
                        })

                        ->select("CRT.id", "CRT.tracking", "CRT.sonod_no", "TOI.organization_name_bn", "TOI.mobile", "TOI.trade_village_bn", "TOI.business_type", "TOI.trade_rbs_en", "TOI.trade_rbs_bn", "RD.name_bn AS road_name", "BD1.bn_name AS district_name", "BD2.bn_name AS upazila_name", "BD3.bn_name AS post_office_name", "BT.name_bn AS business_name", DB::raw("DATE(CRT.created_time) AS generate_date"))
                        // , "INV.amount"

                        ->get();

        $sonod_no_list = array_column($response_qry->toArray(), "sonod_no");

        $inv_data = DB::table("acc_invoice")
                        ->where([
                            "union_id" => $union_id,
                            "fiscal_year_id" => request('fiscal_year_id'),
                            // "is_paid" => 1,
                            "type" => 3
                        ])
                        ->whereNull("deleted_at")
                        ->whereIn("sonod_no", $sonod_no_list)

                        ->when(request('fee_amount') > 0, function($q){
                            $q->where("amount", "<=", request('fee_amount'));
                        })

                        // due report list
                        ->when((!is_null(request('is_paid')) && request('is_paid') == 0), function($q){
                            $q->where("is_paid", "=", request('is_paid'));
                        })

                        ->when(empty(request('is_paid')), function($q){
                            $q->where("is_paid", "=", 1);
                        })

                        ->get()->toArray();

        $inv_amount_data = array_column($inv_data, "amount", "sonod_no");

        // dd($response_qry);

        foreach($response_qry as $item){

            if(isset($inv_amount_data[$item->sonod_no])){
                $item->amount = $inv_amount_data[$item->sonod_no];

                $index_id = $request->report_type == 3 ? $item->trade_rbs_en : ($request->report_type == 4 ? $item->amount : $item->business_type);

                if(isset($response[$index_id])){
                    $response[$index_id]["details"][$item->sonod_no] = $item;
                } else {
                    $response[$index_id] = [
                        "type" => $request->report_type == 3 ? $item->trade_rbs_en : ($request->report_type == 4 ? $item->amount : $item->business_type),
                        "name" => $request->report_type == 3 ? (empty($item->road_name) ? $item->trade_rbs_bn : $item->road_name) : ($request->report_type == 4 ? $item->amount : $item->business_name),
                        "details" => [
                                $item->sonod_no => $item
                            ]
                    ];
                }
            }
            // else {
            //     $item->amount = 0;
            // }
        }

        // dd($response);

        $union_profile->title = '';

        if($request->report_type == 1){
            $fiscal_year = FiscalYear::find($request->fiscal_year_id)->name;
            $union_profile->title .= "অর্থবছরঃ " . $fiscal_year;
        }

        if($request->report_type == 2){
            $union_profile->title .= "\nব্যবসায়ের ধরণ অনুযায়ী\n";

            if($request->business_type){
                $info = DB::table("business_type")->where("id", $request->business_type)->get()->first();

                $union_profile->title .= "\nব্যবসায়ের ধরণঃ " . $info->name_bn;
            }
        }

        if($request->report_type == 3){
            $union_profile->title .= "\nরাস্তার নাম অনুযায়ী";

            if($request->road_id){
                $info = DB::table("street_setup")->where("id", $request->road_id)->get()->first();

                $union_profile->title .= "\nরাস্তার নামঃ " . $info->name_bn;
            }
        }

        if($request->report_type == 4){
            $union_profile->title .= "\nফি অনুযায়ী ";

            $union_profile->title .= ($request->fee_amount) ? ("\nফিঃ " . $request->fee_amount . " বা তার কম") : '';
        }

        if($request->status){
            $union_profile->title .= $request->status == 1 ? "\n নতুন ট্রেড লাইসেন্স" : ($request->status == 2 ? "\n নবায়ন ট্রেড লাইসেন্স" : "\n মেয়াদ উর্ত্তিণ ট্রেড লাইসেন্স");
        }

        if(!is_null($request->is_paid) && $request->is_paid == 0){
            $union_profile->title .= "\n বকেয়া ট্রেড লাইসেন্স";
        }

        $pdf = PDF::loadHtml(view('reports.trade.certificate_report', ['data' => $response, 'union' => $union_profile]), ['orientation' => 'L']);

        // return view('reports.trade.certificate_report',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("trade_certificate_list_report.pdf");
    }

    public function fee_settings()
    {
        $union_id = Auth::user()->union_id;
        $fiscal_year_id = Global_model::current_fiscal_year($union_id);

        $general_settings_qry = DB::table("settings")
            ->where([
                "union_id" => $union_id,
                "fiscal_year_id" => $fiscal_year_id
            ])
            ->get()->toArray();

        $general_settings = array_column($general_settings_qry, "value", "options");

        $business_fee_qry = DB::table("business_type_fees")
            ->where([
                "union_id" => $union_id,
                "fiscal_year_id" => $fiscal_year_id
            ])
            ->get()->toArray();

        // $business_fee = array_column($business_fee_qry, "fees", "business_type_id");

        // dd($business_fee);

        return response()->json(['status' => 'success', 'message' => 'Data found.', 'data' => ['general_settings' => $general_settings, 'business_fee' => $business_fee_qry]]);
    }

    public function getUnPaidSonodList()
    {

        $unPaidSonodLists = DB::table('acc_invoice as INV')
            ->join('certificate AS CT', 'INV.sonod_no', '=', 'CT.sonod_no')
            ->join('fiscal_years AS FS', 'FS.id', '=', 'INV.fiscal_year_id')
            ->join('trade_optional_info AS TOI', 'CT.tracking', '=', 'TOI.tracking')
            ->select('CT.sonod_no', 'TOI.organization_name_bn')
            ->where('INV.union_id', Auth::user()->union_id)
            ->where('INV.is_paid', 0)
            ->groupBy('INV.sonod_no')
            ->get();


        return response()->json(["status" => "success", "message" => "Data found", "data" => $unPaidSonodLists]);
    }

    public function number_convert()
    {
        // echo Converter::en2bn(123456789123456789);

        // echo Converter::en_word(159753);

        // $converter = new BanglaConverter;

        // echo BanglaConverter::en_word(14785236);

        echo BanglaConverter::en_word(123456);

        // print_r(BanglaConverter::bn_number(123));
    }

    public function migrate_invoice_date()
    {
        $data = DB::table("acc_invoice AS INV")
                    ->join("certificate AS CRT", "CRT.sonod_no", "=", "INV.sonod_no")
                    ->where("INV.updated_by", 99)
                    ->limit(50)
                    ->select("INV.id", "INV.sonod_no", "INV.payment_date", "INV.created_at", "CRT.tracking", DB::raw("DATE(CRT.created_time) AS crt_payment_date"))
                    ->get();

        // dd($data);

        if(count($data) <= 0){
            die("No data remaining");
        }

        DB::beginTransaction();

        try{
            foreach($data as $item){
                DB::table("acc_invoice")->where("id", $item->id)
                    ->update([
                        "updated_by" =>  210001001,
                        "payment_date" =>  $item->crt_payment_date
                    ]);
            }

            DB::commit();

            die("Migrate successfully done");
        } catch(Exception $e){
            DB::rollBack();

            die("Fail to migrate");
        }

        // dd($data);
    }

}
