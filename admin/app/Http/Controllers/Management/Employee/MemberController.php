<?php

namespace App\Http\Controllers\Management\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Employee\UpdateInfoRequest;
use App\Http\Requests\Management\Employee\MemberInfoRequest;
use App\Models\Management\Employee\Employee;
use Illuminate\Validation\Rule;
use App\Models\Management\Union\UnionInformation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    //get all members info and return view
    public function members()
    {
        $employees = Employee::getEmployees();
        return view('management.employee.all_members', ['employers' => $employees]);
    }

    //Show Create members info form
    public function addMembers()
    {
        $data['designation_list'] = DB::table('designation')->where('is_active',1)->get();
        return view('management.employee.add_members',$data);
    }

    //Create members info
    public function store(MemberInfoRequest $request)
    {



        $request['employee_id'] = $this->genId(Auth::User()->union_id);


        if (isset($request->sequence)){
            Employee::putSequence($request->designation, $request->sequence);
            if ($request->sequence == 'first'){
                $request['sequence'] = "1";
            }else{
                $request['sequence'] = $request->sequence + 1;
            }
        }
        else{
            $request['sequence'] = "1";
        }

        $data = Employee::store($request);

        if ($data){
            Alert::toast('আপনার প্রোফাইলটি সফলভাবে রেজিস্টার হয়েছে!','success');
            return redirect('/management/members');
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }

    //get Employee Sequence
    public function getEmployeeSequence(Request $request)
    {
        $stringToSend = '<option value="">--কর্মকর্তার ক্রম নির্বাচন করুন--</option>'
                        .'<option value="first">--সর্বপ্রথম অবস্থান হবে--</option>';
        $employeeSequence = Employee::getSequence($request);
        foreach($employeeSequence as $sequence){
            $stringToSend = $stringToSend.'<option value="'.$sequence->sequence.'">'.$sequence->name.' -এর পর</option>';
        }
        return $stringToSend;
    }

    //get Employee name
    public function getEmployeeName(Request $request)
    {

        $stringToSend = '<option value="">--কর্মকর্তার নাম নির্বাচন করুন--</option>';
        //$userExist = DB::table('model_has_roles')->get();
        $employeeSequence = Employee::getSequence($request);
        foreach($employeeSequence as $sequence){
            if($sequence->designation_id != 2 && !isset($sequence->model_id)){
                $stringToSend .= '<option value="'.$sequence->userid.'">'.$sequence->name.'</option>';
            }
        }
        return $stringToSend;
    }

    //Get employee name by designation
    public function getNameByDesignation(Request $request)
    {
        $data = '';
        $employeeName = Employee::getSequence($request);
        foreach ($employeeName as $item)
        {
            if($item->gender == 1){
                $icon = '<i class="icon-copy fi-torso"></i> ';
            }else{
                $icon = '<i class="icon-copy fi-torso-female"></i> ';
            }

            $data .= '<li id="employee'.$item->employee_id.'" value="'.$item->employee_id.'">
                          <div> <span class = "up"></span><span class = "down"></span> </div>
                          '.$icon.$item->name.'
                      </li>';
        }
        return $data;
    }

    //update employee sequence
    public function updateSequence(Request $request)
    {
        $res = Employee::updateSequence($request);
        if ($res){
            return ['success' => 'yes'];
        }
    }

    //Show view member info form
    public function profile($id)
    {
        // dd($id);
        $employee = Employee::getEmployee($id);

    //    dd($employee);

        return view('management.employee.view_profile', ['employee' => $employee]);
    }

    //edit view member info form
    public function editEmployeeInfo($id)
    {


        $employee = Employee::getEmployee($id);
        $designation_list = DB::table('designation')->where('is_active',1)->get();

        return view('management.employee.edit_member', ['employee' => $employee,'designation_list' => $designation_list ]);
    }

    //change username, name, nid, email
    public function changeUserInfo(Request $request)
    {

        $request->validate([
            'name'      => ['required', 'string', 'max:100'],
            // 'username'  => ['required','string', 'max:100', Rule::unique('users')->ignore(Auth::id())],
            'nid'       => ['numeric', 'max:99999999999999999','nullable'],
            'email'     => ['email','nullable']
        ],
            [
                'name.required'     => 'নাম দিন বাংলায়....',
                'name.string'       => 'নাম দিন বাংলায়....',
                'name.max'          => 'নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
                'name.regex'        => 'নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

                'username.required' => 'ইউজারনেম দিন....',
                'username.string'   => 'ইউজারনেম দিন....',
                'username.max'      => 'ইউজারনেম ১০ শব্দের মধ্যে হবে....',
                'username.unique'   => 'ইউজারনেম ইতিমধ্যে নেওয়া হয়েছে....',

                // 'nid.required'      => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
                'nid.numeric'       => 'ন্যাশনাল আইডি নং নম্বর হবে....',
                'nid.max'           => '১৭ ডিজিটের ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
                'nid.unique'        => 'এই ন্যাশনাল আই ডি নং ইতিমধ্যে নেওয়া হয়েছে....',

                'email.required'    => 'অনুগ্রহ করে ই-মেইল দিন....',
                'email.email'       => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',
                'email.unique'      => 'এই ইমেল ঠিকানা ইতিমধ্যে নেওয়া হয়েছে....',
            ]);

        if($request->nid != Employee::where('employee_id',$request->id)->first()->nid)
        {
            $request->validate([
                'nid'       => ['nullable', 'numeric', 'max:99999999999999999', 'unique:employees']
            ],[
                'nid.unique'        => 'এই ন্যাশনাল আই ডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            ]);
        }
        $data = Employee::updateUser($request);
        if($data)
        {
            Alert::toast('আপনার প্রোফাইলটি সফলভাবে আপডেট হয়েছে!','success');
            return redirect()->back()->with('status');
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back()->with('status');
        }
    }

    //change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_pass'      => 'required|string|min:8',
            'new_pass'          => 'required|string|min:8',
            'confirm_pass'      => 'required|string|same:new_pass|min:8'
        ], [
            'current_pass.required'     => 'অনুগ্রহ করে কারেন্ট পাসওয়ার্ড দিন....',
            'current_pass.string'       => 'ভ্যালিড কারেন্ট পাসওয়ার্ড দিন....',
            'current_pass.min'          => 'মিনিমাম ৮ ডিজিটের কারেন্ট পাসওয়ার্ড দিন....',

            'new_pass.required'         => 'অনুগ্রহ করে নিউ পাসওয়ার্ড দিন....',
            'new_pass.string'           => 'নিউ পাসওয়ার্ড এর ক্ষেত্রে আপনি যে কোন ওয়ার্ড, লেটার, সিম্বল ব্যবহার করতে পারেন।',
            'new_pass.min'              => 'মিনিমাম ৮ ডিজিটের নিউ পাসওয়ার্ড দিন....',

            'confirm_pass.required'     => 'অনুগ্রহ করে কনফার্ম পাসওয়ার্ড দিন....',
            'confirm_pass.string'       => 'নিউ পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড একই হবে।',
            'confirm_pass.same'         => 'নিউ পাসওয়ার্ড এর সাথে কনফার্ম পাসওয়ার্ড ম্যাচ হয়নি!',
            'confirm_pass.min'          => 'মিনিমাম ৮ ডিজিটের কনফার্ম পাসওয়ার্ড দিন....',
        ]);
        if (Hash::check($request->current_pass, User::where('employee_id', $request->id)->first()->password)){
            User::where('employee_id', $request->id)->update([
                'password' => bcrypt($request->new_pass),
            ]);
            Alert::toast('আপনার প্রোফাইলের পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে!','success');
            return back()->with('status');
        }else{
            Alert::toast('দুঃখিত! আপনার কারেন্ট পাসওয়ার্ড মিল হয়নি!','error');
            return back()->with('status');
        }
    }

    //Delete member info form
    public function changeStatus($id)
    {
        Employee::changeStatus($id);
        return back();
    }

    //Update employee profile pic
    public function updateEmployeePic(Request $request)
    {
        $data = Employee::picUpdate($request);
        return back();
    }

    //Update employee info
    public function updateEmployeeInfo(Request $request)
    {

//        dd($request->all());

        $fileds = [
            'name'                      => ['required'],
            'device_id'                 => ['nullable','numeric',Rule::unique('employees')->whereNull('deleted_at')->ignore($request->id)],
//            'username'                  => ['required'],
            'designation_id'            => ['required'],
            'gender'                    => ['required'],
            'marital_status'            => ['required'],
            'mobile'                    => ['required','min:11','max:11'],
            'district_id'               => ['required'],
            'upazila_id'                => ['required'],
            'postal_id'                 => ['required'],
        ];



        if($request->password)
        {
            $fileds += [
                'password' => ['min:8']
            ];
        }

        $validator = Validator::make($request->all(), $fileds ,
        [

            'name.required'     => 'নাম দিন বাংলায়....',
            'device_id.required'            => 'অনুগ্রহ করে ডিভাইস আই. ডি. নং দিন....',
            'device_id.numeric'             => 'ডিভাইস আই. ডি. নং নম্বর হবে....',
            'device_id.unique'              => 'এই ডিভাইস আই. ডি. নং ইতিমধ্যে নেওয়া হয়েছে....',

            'designation_id.required'=> 'অনুগ্রহ করে নির্বাচন করুন....',

            'gender.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.required'   => 'অনুগ্রহ করে নির্বাচন করুন....',

            'mobile.required'       => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'            => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'            => '১১ ডিজিটের মোবাইল নম্বর দিন....',

            'district_id.required'           => 'জেলা প্রদান করূন....',
            'upazila_id.required'            => 'উপজেলা/থানা প্রদান করূন....',
            'postal_id.required'             => 'পোস্ট অফিস প্রদান করূন....',

            'address.required'               => 'আপনার ঠিকানা দিন....'

        ]);

        $request['updated_by'] = Auth::user()->employee_id;
        $request['updated_by_ip'] = $request->ip();

        if($validator->fails()) {

            Alert::toast('আপনার প্রোফাইলের তথ্য ভুল হয়েছে!','error');
            return redirect()->back()->withErrors($validator);

        }else{

            $response = Employee::infoUpdate($request);

            if ($response){
                Alert::toast('আপনার প্রোফাইলের তথ্য সফলভাবে আপডেট হয়েছে!','success');
                return back();
            }

        }


    }

    //Delete member info form
    public function deleteMembers(Request $request)
    {



        if($request->employee_id == Auth::user()->employee_id)
        {
            Alert::toast('দুঃখিত! আপনি আপনার আইডি ডিলিট করতে পারবেন না!','error');
            return back();
        }else{
            Employee::where('employee_id', $request->employee_id)->update([
                'is_active'     => false,
                'updated_by'    => Auth::user()->id,
                'updated_by_ip' => $request->ip(),
                'deleted_at'    => Carbon::now(),
                'is_process' => 0,
                'is_process_web' => 0
            ]);
            User::where('employee_id', $request->employee_id)->update([
                'status'        => false,
                'updated_by'    => Auth::user()->id,
                'updated_by_ip' => $request->ip(),
                'deleted_at'    => Carbon::now()
            ]);
            return back();
        }
    }

    //Generate Employee Id
    private function genId($unionId)
    {
        $employee = count(Employee::where('union_id', $unionId)->whereNull('deleted_at')->get());
        $unionId = UnionInformation::where('union_code', $unionId)->whereNull('deleted_at')->first()->id;
        $uidLen = strlen($unionId);

        if ($employee < 1){
            $id = '001';
            $idLen = strlen($id);
            $id = $this->unionCOdeGen($id, $idLen, $unionId, $uidLen);
        }else{
            $id = $employee+1;
            $idLen = strlen($id);
            $id = $this->unionCOdeGen($id, $idLen, $unionId, $uidLen);
        }

        return $id;
    }

    //union codeGen
    private function unionCOdeGen($id, $idLen, $unionId, $uidLen)
    {
        if ($uidLen == 1){
            $uid = '000'.$unionId;
        }elseif($uidLen == 2){
            $uid = '00'.$unionId;
        }elseif($uidLen == 3){
            $uid = '0'.$unionId;
        }
        if ($idLen == 1){
            $id = '00'.$id;
        }elseif($idLen == 2){
            $id = '0'.$id;
        }

        $id = date("y").$uid.$id;
        return $id;
    }
}
