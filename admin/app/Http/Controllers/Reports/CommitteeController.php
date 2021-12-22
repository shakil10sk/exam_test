<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Image;
use Response;
use Illuminate\Support\Carbon;

use function GuzzleHttp\json_encode;


class CommitteeController extends Controller
{
    
    //committee list
    public function committee(){

        $data = DB::table('committee_type')->get();

        return view('reports.committee')->with('data', $data);
    }


    //committee save
    public function committee_save(Request $request){

        $union_id = Auth::user()->union_id;

        DB::beginTransaction();

        try {

            $committee_data = [
                'union_id' => $union_id,
                'committee_name' => $request->committee_name,
                'committee_step' => $request->committee_step,
                'ward_no' => $request->ward_no,
                'created_time' => Carbon::now(),
                'created_by' => Auth::user()->id,
                'created_by_ip' => $request->ip(),
    
           ];

           DB::table('committee')->insert($committee_data);

           $committee_id = DB::getPdo()->lastInsertId();
    
           $member_data = [];
    
           for ($i=0; $i < count($request->member_name) ; $i++) { 
                
                $member_data[] = [

                    'union_id' => $union_id,
                    'committee_id' => $committee_id,
                    'name' => $request->member_name[$i],
                    'designation' => $request->designation[$i],
                    'address' => $request->address[$i],
                    'nid' => $request->national_id[$i],
                    'social_status' => $request->social_status[$i],
                    'mobile' => $request->mobile[$i],
                    'email' => $request->email[$i],
                    'created_time' => Carbon::now(),
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => $request->ip(),
                ];
           }

           DB::table('com_member')->insert($member_data);
           
           DB::commit();

           return back()->with('success','কমিটি সফলভাবে তৈরী হয়েছে।');
           
        } catch (\Throwable $th) {

            DB::rollback();
            return back()->with('error','কমিটি  তৈরী হয়নি।');
            
        }


    }

    //committee list show
    public function committee_list(Request $request){

        if ($request->ajax()) {

            $data = DB::table('committee AS CMT')
                ->select('CMT.id as comm_id', 'CMT.*', 'CMTYPE.*')
                ->join('committee_type AS CMTYPE', function($join){
                    $join->on('CMTYPE.id', '=', 'CMT.committee_name');
                })
                ->where(['CMT.is_active' => 1])
                ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('reports.committee_list');

    }

    //committee edit
    public function committee_edit($id){

        $data = DB::table('committee_type')->get();

        $committee_data = DB::table('committee')->where('id', $id)->first();

        $member_data = DB::table('com_member')->where('committee_id', $id)->get();

       return view('reports.committee_edit')->with(['committee_data' => $committee_data, 'member_data' => $member_data , 'data' => $data]);

    }

    //committe update save
    public function committee_update_save(Request $request){

        $union_id = Auth::user()->union_id;

        DB::beginTransaction();

        try {

            $committee_data = [
                'union_id' => $union_id,
                'committee_name' => $request->committee_name,
                'committee_step' => $request->committee_step,
                'ward_no' => $request->ward_no,
                'updated_time' => Carbon::now(),
                'updated_by' => Auth::user()->id,
                'updated_by_ip' => $request->ip(),
    
           ];

           DB::table('committee')->where('id', $request->committee_id)->update($committee_data);

           $member_data = [];
    
           for ($i=0; $i < count($request->member_name) ; $i++) { 
                
                if($request->member_id[$i] > 0){

                    $member_data= [
                        'name' => $request->member_name[$i],
                        'mobile' => $request->mobile[$i],
                        'email' => $request->email[$i],
                        'designation' => $request->designation[$i],
                        'nid' => $request->national_id[$i],
                        'address' => $request->address[$i],
                        'updated_time' => Carbon::now(),
                        'updated_by' => Auth::user()->id,
                        'updated_by_ip' => $request->ip()
                    ];

                    DB::table('com_member')->where('id', $request->member_id[$i])->update($member_data);

                }else{

                    $member_data= [
                        'union_id' => $union_id,
                        'committee_id' => $request->committee_id,
                        'name' => $request->member_name[$i],
                        'mobile' => $request->mobile[$i],
                        'email' => $request->email[$i],
                        'designation' => $request->designation[$i],
                        'nid' => $request->national_id[$i],
                        'address' => $request->address[$i],
                        'created_time' => Carbon::now(),
                        'created_by' => Auth::user()->id,
                        'created_by_ip' => $request->ip()
                    ];


                    DB::table('com_member')->insert($member_data);

                }

                
           }


           DB::commit();

           return back()->with('success','কমিটি আপডেট হয়েছে।');
           
        } catch (\Throwable $th) {

            DB::rollback();

            return back()->with('error','কমিটি আপডেট হয়নি।');

            // throw $th;
           
        }
        
    }

    //for committee delete
    public function committee_delete(Request $request){

        DB::beginTransaction();

        try {

            DB::table('committee')
                    ->where([
                        'id' => $request->id,
                        'union_id' => Auth::user()->union_id,
                    ])
                    ->update(['updated_by' => Auth::User()->id, 'updated_by_ip' => $request->ip(), 'updated_time' => Carbon::now(), 'is_active' => 0]);
            
            DB::table('com_member')
                ->where([
                    'committee_id' => $request->id,
                    'union_id' => Auth::user()->union_id,
                ])
                ->update(['updated_by' => Auth::User()->id, 'updated_by_ip' => $request->ip(), 'updated_time' => Carbon::now(), 'is_active' => 0]);


            DB::commit();

            return Response::json(['status' => 'success', 'message' => 'ডিলিট করা হয়েছে।']);
        
        } catch (\Throwable $th) {

             DB::rollback();

             return Response::json(['status' => 'error', 'message' => 'ডিলিট করা হয়নি।']);

        }

    }

}
