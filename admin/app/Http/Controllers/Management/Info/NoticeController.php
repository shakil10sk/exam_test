<?php

namespace App\Http\Controllers\Management\Info;

use App\Http\Controllers\Controller;
use App\Models\Management\Info\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class NoticeController extends Controller
{
    //view history and all notices
    public function index()
    {
        return view('management.info.history_all_notice');
    }

    //get notice
    public function getNotice(Request $request)
    {
        $searchContent = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $fromDate = (isset($request->fromDate)) ? $request->fromDate : date('Y-m-d');

        $toDate = (isset($request->toDate)) ? $request->toDate : date('Y-m-d');

        $response = Notice::getNotice($request, $searchContent);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;


        $response['draw'] = $request->draw;

        return json_encode($response);
    }

    //view history and all notices
    public function add()
    {
        return view('management.info.add_history_all_notice');
    }

    //store notice
    public function store(Request $request)
    {
        $rules = [
            'type' => 'required',
            'details' => 'required|string|max:1000',
            'document' => 'file|mimes:jpg,png,jpeg,pdf|nullable'
        ];
        if ($request->type == 1 ){
            $rules += ['title'     => 'required|string|max:150'];
        }


        $request->validate($rules, [
            'type.required' => 'নোটিশ টাইপ সিলেক্ট করুন....',
            'title.required' => 'নোটিশ টাইটেল দিন....',
            'title.string' => 'নোটিশ টাইটেল দিন....',
            'title.max' => 'নোটিশ টাইটেল ১৫০ অক্ষরের মধ্যে দিন....',

            'details.required' => 'পৌরসভা নোটিশ এর বিবরণ দিন....',
            'details.string' => 'পৌরসভা নোটিশ এর বিবরণ দিন....',
            'details.max' => 'পৌরসভা নোটিশ এর বিবরণ ১০০০ অক্ষরের মধ্যে দিন....',
            'document.file' => 'ফাইল দিতে হবে....',
            'document.mimes' => 'ফাইল অবশ্যই (jpg,jpeg,png)* অথবা (pdf)* ফরম্যাট দিতে হবে....'
        ]);

        $request['union_id'] = Auth::user()->union_id;
        $request['created_by'] = Auth::user()->employee_id;
        $request['created_by_ip'] = $request->ip();

        $data = Notice::store($request);
        if ($data) {
            Alert::toast('নোটিশটি সফলভাবে অ্যাড হয়েছে!', 'success');
            return redirect(route('all_up_notice'));
        } else {
            Alert::toast('কোথাও ভুল হয়েছে!', 'error');
            return redirect(route('all_up_notice'));
        }
    }

    //edit notice
    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('management.info.edit_notice', ['notice' => $notice]);
    }

    //update notice
    public function update(Request $request)
    {

        $rules = [
            'type' => 'required',
            'details' => 'required|string|max:1000',
            'document' => 'file|mimes:jpg,png,jpeg,pdf|nullable'
        ];

        if ($request->type == 1 ){
            $rules += ['title'     =>  'required|string|max:150'];
        }

        $request->validate($rules, [
            'type.required' => 'নোটিশ টাইপ সিলেক্ট করুন....',
            'title.required' => 'নোটিশ টাইটেল দিন....',
            'title.string' => 'নোটিশ টাইটেল দিন....',
            'title.max' => 'নোটিশ টাইটেল ১৫০ অক্ষরের মধ্যে দিন....',

            'details.required' => 'পৌরসভা নোটিশ এর বিবরণ দিন....',
            'details.string' => 'পৌরসভা নোটিশ এর বিবরণ দিন....',
            'details.max' => 'পৌরসভা নোটিশ এর বিবরণ ১০০০ অক্ষরের মধ্যে দিন....',
            'document.file' => 'ফাইল দিতে হবে....',
            'document.mimes' => 'ফাইল অবশ্যই (jpg,jpeg,png)* অথবা (pdf)* ফরম্যাট দিতে হবে....'
        ]);

        $request['updated_by'] = Auth::user()->employee_id;
        $request['updated_by_ip'] = $request->ip();
        $request['is_process'] = 0;

        $data = Notice::updated($request);
        if ($data) {
            Alert::toast('নোটিশটি সফলভাবে আপডেট হয়েছে!', 'success');
            return redirect(route('all_up_notice'));
        } else {
            Alert::toast('কোথাও ভুল হয়েছে!', 'error');
            return redirect(route('all_up_notice'));
        }
    }

    //delete notice
    public function delete(Request $request)
    {
        $isDelete = Notice::where('union_id', Auth::user()->union_id)->where('id', $request->id)->update([
            'deleted_at' => date('Y-m-d 00:00:00')
        ]);

        return response()->json([
            "status" => $isDelete ? "success": "error",
            "title" => $isDelete ? "মোছা হয়েছে!": "মোছা হয় নি",
            "message" =>  $isDelete ? "আপনার ফাইলটি মুছে ফেলা হয়েছে।":"কোন সমস্যা আছে"
        ]);

    }
}
