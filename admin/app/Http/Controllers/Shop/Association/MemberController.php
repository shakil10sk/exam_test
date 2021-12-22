<?php

namespace App\Http\Controllers\Shop\Association;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\AssociationMemberInfoRequest;
use App\Models\AssociationMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index()
    {
        $data['reference'] = DB::table('association_member_list')->where('union_id', Auth::user()->union_id)->get();

        return view('shop_rent.association.add_member', $data);
    }

    public function store(AssociationMemberInfoRequest $request)
    {

        // if nid, birth_id, passport_no empty
        if ($request->nid == '' && $request->birth_id == '' && $request->passport_no == '') {

            Alert::toast('জাতীয় পরিচয় পত্র অথবা জন্মনিবন্ধন অথবা পাসপোর্ট নং প্রদান করুন!', 'error')->position('middle');
            return redirect()->back()->withInput();

        }


        // member information
        $member_info = [
            'union_id' => $request->union_id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'nid' => $request->nid,
            'birth_id' => $request->birth_id,
            'passport_no' => $request->passport_no,
            'birth_date' => $request->birth_date,
            'mother_name' => $request->mother_name,
            'occupation' => $request->occupation,
            'educational_qualification' => $request->educational_qualification,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'present_village_en' => $request->present_village_en,
            'present_rbs_en' => $request->present_rbs_en,
            'present_holding_no' => $request->present_holding_no,
            'present_ward_no' => $request->present_ward_no,
            'present_district_id' => $request->present_district_id,
            'present_upazila_id' => $request->present_upazila_id,
            'present_postoffice_id' => $request->present_postoffice_id,
            'permanent_village_en' => $request->permanent_village_en,
            'permanent_rbs_en' => $request->permanent_rbs_en,
            'permanent_holding_no' => $request->permanent_holding_no,
            'permanent_ward_no' => $request->permanent_ward_no,
            'permanent_district_id' => $request->permanent_district_id,
            'permanent_upazila_id' => $request->permanent_upazila_id,
            'permanent_postoffice_id' => $request->permanent_postoffice_id,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'chanda_amount' => $request->chanda_amount,
            'reference_id' => $request->reference_id,
            'created_by' => Auth::user()->id,
            'created_by_ip' => \request()->ip(),
            'created_at' => Carbon::now(),
        ];


        // member account information //
        $member_acc_info = [
            'union_id' => Auth::user()->union_id,
            'account_name' => $request->name,
            'acc_type' => 106, // 106 = association account type
            'created_by' => Auth::user()->id,
            'created_by_ip' => \request()->ip(),
            'created_time' => Carbon::now(),
        ];

        if ($request->has('photo')) {

            $member_img = $request->file('photo');
            $img_name = time() . '.' . $member_img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/association_member');
            $member_img->move($destinationPath, $img_name);

            $member_info['photo'] = $img_name;
        }

        DB::beginTransaction();
        try {
            DB::table('association_member_list')->insert($member_info);

            $member_acc_info['account_code'] = DB::getPdo()->lastInsertId();

            DB::table('acc_account')->insert($member_acc_info);


            // all are good
            DB::commit();
            Alert::toast('সফলভাবে সদস্য যোগ হয়েছে', 'success');

            return redirect()->route('association_member_list');


        } catch (Exception $exception) {
            DB::rollBack();
            Alert::toast(' ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'error');
            return redirect()->back()->withInput();
        }


    }

    public function list()
    {
        return view('shop_rent.association.member_list');
    }

    public function list_data(Request $request)
    {
        $data = AssociationMember::list_data();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function edit($id)
    {
        $data['reference'] = DB::table('association_member_list')->where('union_id', Auth::user()->union_id)->get();

        $data['member'] = AssociationMember::edit_data($id);


        return view('shop_rent.association.edit_member', $data);
    }


    public function update(AssociationMemberInfoRequest $request)
    {
        // if nid, birthid, passportno empty
        if ($request->nid == '' && $request->birth_id == '' && $request->passport_no == '') {

            Alert::toast('জাতীয় পরিচয় পত্র অথবা জন্মনিবন্ধন অথবা পাসপোর্ট নং প্রদান করুন!', 'error')->position('middle');
            return redirect()->back()->withInput();

        }


        // member information update
        $member_update_info = [
            'name' => $request->name,
            'father_name' => $request->father_name,
            'nid' => $request->nid,
            'birth_id' => $request->birth_id,
            'passport_no' => $request->passport_no,
            'birth_date' => $request->birth_date,
            'mother_name' => $request->mother_name,
            'occupation' => $request->occupation,
            'educational_qualification' => $request->educational_qualification,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'present_village_en' => $request->present_village_en,
            'present_rbs_en' => $request->present_rbs_en,
            'present_holding_no' => $request->present_holding_no,
            'present_ward_no' => $request->present_ward_no,
            'present_district_id' => $request->present_district_id,
            'present_upazila_id' => $request->present_upazila_id,
            'present_postoffice_id' => $request->present_postoffice_id,
            'permanent_village_en' => $request->permanent_village_en,
            'permanent_rbs_en' => $request->permanent_rbs_en,
            'permanent_holding_no' => $request->permanent_holding_no,
            'permanent_ward_no' => $request->permanent_ward_no,
            'permanent_district_id' => $request->permanent_district_id,
            'permanent_upazila_id' => $request->permanent_upazila_id,
            'permanent_postoffice_id' => $request->permanent_postoffice_id,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'chanda_amount' => $request->chanda_amount,
            'reference_id' => $request->reference_id,
            'updated_by' => Auth::user()->id,
            'updated_by_ip' => \request()->ip(),
            'updated_at' => Carbon::now(),
        ];

//        dd($member_update_info);


        // member account information //
        $member_acc_update_info = [
            'account_name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_by_ip' => \request()->ip(),
            'updated_time' => Carbon::now(),
        ];

        if ($request->has('photo')) {

            if (!empty($request->image_preview)) {
                // preview image delete //
                @unlink(public_path('/assets/images/association_member/' . $request->image_preview));
            }

            $member_img = $request->file('photo');
            $img_name = time() . '.' . $member_img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/association_member');
            $member_img->move($destinationPath, $img_name);

            $member_update_info['photo'] = $img_name;
        }

        DB::beginTransaction();
        try {
            DB::table('association_member_list')->where('id', $request->row_id)->update($member_update_info);


            DB::table('acc_account')->where('id', $request->account_id)->update($member_acc_update_info);


            // all are good
            DB::commit();
            Alert::toast('সফলভাবে সদস্য এর তথ্য আপডেট হয়েছে', 'success');

            return redirect()->route('association_member_list');


        } catch (Exception $exception) {
            DB::rollBack();
            Alert::toast(' ব্যর্থ হয়েছেন। দয়াকরে আবার চেষ্টা করুন', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request)
    {
        $isDeleteMember = DB::table('association_member_list')->where('id', $request->row_id)->update([
            "deleted_at" => Carbon::now(),
            "updated_by" => Auth::user()->id,
            "updated_at" => Carbon::now(),
            "updated_by_ip" => $request->ip(),
        ]);

        $isMemberAccountDelete = DB::table('acc_account')->where('id', $request->account_id)->update([
            "is_active" => 0,
            "updated_by" => Auth::user()->id,
            "updated_time" => Carbon::now(),
            "updated_by_ip" => $request->ip(),
        ]);

        if ($isDeleteMember && $isMemberAccountDelete) {
            return response()->json([
                "status" => "success",
                "message" => "সফলভাবে সদস্য এর তথ্য মুছে ফেলা হয়েছে"
            ]);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "কোন সমস্যা আছে। দয়াকরে আবার চেষ্টা করুন"
            ]);
        }


    }


}
