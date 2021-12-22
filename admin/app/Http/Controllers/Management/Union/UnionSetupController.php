<?php

namespace App\Http\Controllers\Management\Union;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Union\UnionInfoRequest;
use App\Http\Requests\Management\Union\UnionInfoUpdateRequest;
use App\Models\Global_model;
use App\Models\Management\BusinessType;
use App\Models\Management\Union\UnionInformation;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use stdClass;
use Yajra\DataTables\DataTables;
use Exception;

class UnionSetupController extends Controller
{
    //show union status view page
    public function profile()
    {
        $data = UnionInformation::where('union_code', Auth::User()->union_id)
            ->join('bd_locations AS LOC1', 'union_information.district_id', '=', 'LOC1.id')
            ->join('bd_locations AS LOC2', 'union_information.upazila_id', '=', 'LOC2.id')
            ->join('bd_locations AS LOC3', 'union_information.postal_id', '=', 'LOC3.id')
            ->join('employees AS EMP', function ($join) {
                $join->on("EMP.union_id", "=", "union_information.union_code")
                    ->where("EMP.designation_id", "=", 2);
            })
            ->select('union_information.*', 'LOC1.bn_name AS district', 'LOC2.bn_name AS upazila', 'LOC3.bn_name AS post_office', 'EMP.name As secretaryName')
            ->first();

        $settings = DB::table("settings")
            ->where("options", "trade_generate")
            ->where("union_id", Auth::User()->union_id)
            ->get()->first();

        if (empty($settings)) {
            $settings = new stdClass;
            $settings->value = 1;
        }

        return view('management.union.union_setup', compact('data', 'settings'));

    }

    //store a new union
    public function store(UnionInfoRequest $request)
    {
        $request['created_by'] = Auth::user()->employee_id;
        $request['created_by_ip'] = $request->ip();
        $request['created_time'] = Carbon::now();

        if (isset($request->is_header_active)) {
            $request['is_header_active'] = 1;
        } else {
            $request['is_header_active'] = 0;
        }

        //store data into union_information
        $res = UnionInformation::store($request);

        // dd($res);

        if ($res) {
            Alert::toast('পৌরসভা সেটআপ সম্পন্ন হয়েছে!', 'success');
            return redirect()->back();
        } else {
            Alert::toast('কিছু ভুল হয়েছে!', 'error');
            return redirect()->back();
        }
    }

    //update union info
    public function update(UnionInfoUpdateRequest $request)
    {
        $request['updated_by'] = Auth::user()->employee_id;
        $request['updated_by_ip'] = $request->ip();
        $request['is_process'] = 0;
        $request['is_process_web'] = 0;

        if (isset($request->is_header_active)) {
            $request['is_header_active'] = 1;
        } else {
            $request['is_header_active'] = 0;
        }

        // dd($request);

        $data = UnionInformation::updateInfo($request);

        // dd($data);

        if ($data) {
            Alert::toast('পৌরসভা সফলভাবে আপডেট হয়েছে!', 'success');
            return redirect()->back();
        } else {
            Alert::toast('কিছু ভুল হয়েছে!', 'error');
            return redirect()->back();
        }
    }

    public function pdfSetup()
    {
        $data['type'] = [
            1 => "নাগরিক সনদ",
            2 => "মৃত্যু সনদ",
            3 => "অবিবাহিত সনদ",
            4 => "পুনঃবিবাহ না হওয়া সনদ",
            5 => "একই নামের প্রত্যয়ন",
            6 => "সনাতন ধর্ম অবলম্বি সনদ",
            7 => "প্রত্যয়ন",
            8 => "নদী ভাঙনের সনদ",
            9 => "চারিত্রিক সনদ",
            10 => "ভূমিহীন সনদ",
            11 => "বার্ষিক আয়ের সনদ",
            12 => "প্রকৃত বাক ও শ্রবণ প্রতিবন্ধি সনদ",
            13 => "অনুমতি সনদ",
            14 => "ভোটার আইডি স্থানান্তর সনদ",
            15 => "অনাপত্তি পত্র",
            16 => "রাস্তা খনন",
            17 => "ওয়ারিশ সনদ",
            18 => "পারিবারিক সনদ",
            19 => "ট্রেড লাইসেন্স",
            20 => "বিবাহিত সনদ",
            90 => "প্রিমিসেস সনদ",
            91 => "পোষা প্রাণীর সনদ",
            92 => "নতুন হোল্ডিং  সনদ",
            93 => "নতুন হোল্ডিং নামজারী  সনদ",
            94 => "রাস্তা খননের অনুমতি সনদ",
            95 => "ইমারত নির্মাণ অনুমতি সনদ",
            96 => "ভূমি ব্যবহার ছাড়পত্রের সনদ",
        ];

        return view('management.union.pdf_setup', $data);
    }

    public function postPdfSetup(Request $r)
    {
        // dd($r);
        $data = [];

        $data['updated_by'] = auth()->user()->id;
        $data['updated_by_ip'] = $r->ip();
        $data['updated_at'] = date('Y-m-d H:i:s');

        $setting = $r->all();
        unset($setting['_token']);

        // dd($setting);

        foreach ((object)$setting as $key => $value) {

            $check = [
                'union_id' => auth()->user()->union_id,
                'type' => $key,
            ];

            $data['type'] = $key;
            $data['pad_print'] = $value['pad_print'] ?? 0;

            // ---------------- sonod data init
            $data['application_type'] = 1;
            $data['chairman'] = 1;
            $data['sochib'] = $value['sonod']['sochib'] ?? 0;
            $data['member'] = $value['sonod']['member'] ?? 0;
            // $data['obibabok'] = $value['sonod']['obibabok'] ?? 0;

            $check['application_type'] = $data['application_type'];
            if (!DB::table('print_settings')->where($check)->count()) {
                $data['created_by'] = auth()->user()->id;
                $data['created_by_ip'] = $r->ip();
            }

            // echo '<pre>' . print_r($data) . '</pre>';
            DB::table('print_settings')->updateOrInsert($check, $data);


            //-------------------- abedon data init
            $data['application_type'] = 2;
            $data['chairman'] = $value['abedon']['chairman'] ?? 0;
            $data['sochib'] = $value['abedon']['sochib'] ?? 0;
            $data['member'] = $value['abedon']['member'] ?? 0;
            // $data['obibabok'] = $value['abedon']['obibabok'] ?? 0;

            $check['application_type'] = $data['application_type'];
            if (!DB::table('print_settings')->where($check)->count()) {
                $data['created_by'] = auth()->user()->id;
                $data['created_by_ip'] = $r->ip();
            }

            // echo '<pre>'. print_r($data) .'</pre>';
            DB::table('print_settings')->updateOrInsert($check, $data);
        }

        // dd($data);

        Alert::toast('প্রিন্ট সেটিং সফলভাবে আপডেট হয়েছে!', 'success');
        return redirect()->route('pdf_setup');
    }


    // -----------------  business type ------------------- //
    public function businessTypeList()
    {
        // $busi_type = BusinessType::where('union_id', auth()->user()->union_id)->where('is_active', 1)->get();

        $busi_type = DB::table('business_type AS BT')
                            ->select('BT.id','BT.name_bn','BT.name_en','BTF.id AS Business_fee_id','BTF.fees')
                            ->join('business_type_fees AS BTF',function($join){
                                $join->on('BTF.business_type_id', '=' , 'BT.id');
                            })
                            ->where('BT.union_id', auth()->user()->union_id)
                            ->where('BT.is_active',1)
                            ->get();



        return view('management.business_type.business_type_list', compact('busi_type'));
    }

    public function businessTypeStore(Request $r)
    {
        // dd(auth()->user()->union_id);
        // dd($r);

        $fiscal_year_id= Global_model::current_fiscal_year(Auth()->user()->union_id);

        //get business type
        $query = DB::table('business_type')
            ->where('name_bn', trim($r->name_bn))
            ->where('union_id', auth()->user()->union_id)
            ->first();

        if ($query) {
            Alert::toast('আগে অ্যাড করা হয়েছে !', 'error');
            return redirect()->route('business_type.list');
        } else {

            $data = [
                'union_id' => auth()->user()->union_id,
                'name_bn' => $r->name_bn,
                'name_en' => translateToEnglish($r->name_bn),
                'is_active' => 1,
                'created_by' => auth()->user()->id,
                'created_time' => Carbon::now(),
                'created_by_ip' => $r->ip(),
            ];



            DB::beginTransaction();

        try {

            $business_type_id =  DB::table("business_type")->insertGetId($data);

            $business_fee = [
                'union_id' => auth()->user()->union_id,

                'business_type_id' => $business_type_id,

                'fees' => $r->fee,

                'fiscal_year_id' => $fiscal_year_id,

                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'updated_by' => $r->ip(),
            ];

            DB::table("business_type_fees")->insert($business_fee);

            DB::commit();


            Alert::toast('অ্যাড করা হয়েছে ।', 'success');
            return redirect()->route('business_type.list');

        } catch (Exception $e) {
            DB::rollBack();

            // return ["status" => "error", "message" => "আবেদনটি গৃহীত হয়নি।"];
            return redirect()->route('business_type.list');
        }



        }


    }

    public function businessTypeUpdate(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        try{

            BusinessType::where('id', $r->id)->update([
                'name_bn' => $r->name_bn,
                'name_en' => $r->name_en,
                'updated_by' => auth()->user()->id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $r->ip(),
            ]);

            $fiscal_year_id= Global_model::current_fiscal_year(Auth()->user()->union_id);

            DB::table('business_type_fees')
                        ->where('id', '=', $r->business_fee_id)
                        ->update([
                            'fees' => $r->fee,
                            'fiscal_year_id' => $fiscal_year_id,
                            'updated_by' => auth()->user()->id,
                            'updated_at' => Carbon::now(),
                            'updated_by_ip' => $r->ip(),
                        ]);

                DB::commit();

            Alert::toast('আপডেট করা হয়েছে ।', 'success');
            return redirect()->route('business_type.list');

        }catch(Exception $e){
            DB::rollBack();

            Alert::toast('দুঃখিত আপনার কোথাও ভুল হচ্ছে ।', 'error');
            return redirect()->route('business_type.list');
        }

    }

    public function businessTypeDelete($id)
    {
        BusinessType::where('id', $id)->update([
            'is_active' => 0,
            'updated_by' => auth()->user()->id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => FacadesRequest::ip(),
        ]);

        Alert::toast('ডিলিট করা হয়েছে ।', 'success');
        return redirect()->route('business_type.list');

    }

    // -----------------  street setup ------------------- //
    public function streetList(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('street_setup')->where('union_id', Auth::user()->union_id)->where('is_active', 1)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('management.union.street_setup');


    }

    public function streetStore(Request $r)
    {


        $query = DB::table('street_setup')
            ->where('name_bn', trim($r->name_bn))
            ->where('name_en', trim($r->name_en))
            ->where('union_id', auth()->user()->union_id)
            ->where('is_active', 1)
            ->first();

        if ($query) {
            return \response()->json([
                "status" => "error",
                "message" => "আগে যোগ করা হয়েছে ",
            ]);
        } else {

            $isSave = DB::table('street_setup')->insert([
                'union_id' => auth()->user()->union_id,
                'name_bn' => $r->name_bn,
                'name_en' => $r->name_en,
                'is_active' => 1,
                'created_by' => auth()->user()->id,
                'created_time' => Carbon::now(),
                'created_by_ip' => $r->ip(),
            ]);

            return \response()->json([
                "status" => $isSave ? "success" : "error",
                "message" => $isSave ? "সফলভাবে যোগ হয়েছে" : "ব্যর্থ হযেছেন। আবার চেষ্টা করুন",
            ]);

        }

    }

    public function streetUpdate(Request $r)
    {

        $query = DB::table('street_setup')
            ->where('name_bn', trim($r->name_bn))
            ->where('name_en', trim($r->name_en))
            ->where('union_id', auth()->user()->union_id)
            ->where('id', '!=', $r->id)
            ->where('is_active', 1)
            ->first();

        if ($query) {
            return \response()->json([
                "status" => "error",
                "message" => "আগে যোগ করা হয়েছে",
            ]);

        } else {
            $isUpdate = DB::table('street_setup')->where('id', $r->id)->update([
                'name_bn' => $r->name_bn,
                'name_en' => $r->name_en,
                'updated_by' => auth()->user()->id,
                'updated_time' => Carbon::now(),
                'updated_by_ip' => $r->ip(),
            ]);

            return \response()->json([
                "status" => $isUpdate ? "success" : "error",
                "message" => $isUpdate ? "সফলভাবে আপডেট হয়েছে" : "ব্যর্থ হযেছেন। আবার চেষ্টা করুন",
            ]);
        }


    }

    public function streetDelete($id)
    {
        $isDelete = DB::table('street_setup')->where('id', $id)->update([
            'is_active' => 0,
            'updated_by' => auth()->user()->id,
            'updated_time' => Carbon::now(),
            'updated_by_ip' => FacadesRequest::ip(),
        ]);

        return \response()->json([
            "status" => $isDelete ? "success" : "error",
            "message" => $isDelete ? "সফলভাবে মুছে ফেলা হয়েছে" : "ব্যর্থ হযেছেন। আবার চেষ্টা করুন",
        ]);

    }

    function getStreetNameBn(Request $request)
    {
        $name_bn = DB::table('street_setup')->where('id', $request->id)->first()->name_bn;

        return \response()->json(["name_bn" => $name_bn]);
    }

}
