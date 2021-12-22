<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;

use function GuzzleHttp\json_encode;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //for project list show
    public function reports(Request $request)
    {

        $type = $request->type;
       
        if ($request->ajax()) {

            $data = DB::table('reports')->where(['is_active' => 1, 'type' => $type])->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('reports.reports')->with('type', $type);
    }

    //reports save
    public function report_save(Request $request){

        $union_id = Auth::user()->union_id;

        $data = [

            'union_id' => $union_id,
            'title' => $request->title,
            'type' => $request->type,
        ];

       
        //file upload
        if ($request->hasFile("file")) {

            //insert image
            $image = $request->file("file");

            $img = $union_id.'_'.uniqid().".".$image->getClientOriginalExtension();

            $location = public_path("assets/reports/file/".$img);

            $move = $request->file->move(($location), $img);

            if ($move) {
                $data['file'] = $img;
            }

        }

    

        try {

            if($request->row_id > 0){

                $data['updated_time'] = date('Y-m-d h:i:s');
                $data['updated_by'] = Auth::user()->id;
                $data['updated_by_ip'] = $request->ip();
                $data['is_process'] = 0;

                DB::table('reports')->where('id', $request->row_id)->update($data);

                return Response::json(['status' => 'success', 'message' => 'রিপোর্ট আপডেট সম্পন্ন হয়েছে']);

            }else{

                $data['created_time'] = date('Y-m-d h:i:s');
                $data['created_by'] = Auth::user()->id;
                $data['created_by_ip'] = $request->ip();

                DB::table('reports')->insert($data);

                return Response::json(['status' => 'success', 'message' => 'রিপোর্ট সম্পন্ন হয়েছে']);

            }

           

            //code...
        } catch (\Throwable $th) {
           
            return Response::json(['status' => 'error', 'message' => 'রিপোর্ট সম্পন্ন হয়নি।']);
        }

    }

    //for projcet delete
    public function report_delete(Request $request){

 

        $delete =  DB::table('reports')
                ->where([
                    'id' => $request->id,
                    'union_id' => Auth::user()->union_id,
                ])
                ->update([
                    'updated_by' => Auth::User()->id, 
                    'updated_by_ip' => $request->ip(), 
                    'updated_time' => Carbon::now(),  
                    'is_active' => 0,
                    'is_process' => 0
                ]);

        
        
        if($delete){
            return Response::json(['status' => 'success', 'message' => 'ডিলিট করা হয়েছে।']);
        }else{
            return Response::json(['status' => 'error', 'message' => 'ডিলিট করা হয়নি।']);
        }

        
    }

     //for letters list show
     public function letters(Request $request)
     {
 
         $type = $request->type;
        
         if ($request->ajax()) {
 
             $data = DB::table('letters')->where(['is_active' => 1, 'type' => $type])->get();
 
             return Datatables::of($data)
                     ->addIndexColumn()
                     ->rawColumns(['action'])
                     ->make(true);
         }
       
         return view('reports.letters')->with('type', $type);
     }
 
     //letters save
     public function letter_save(Request $request){
 
         $union_id = Auth::user()->union_id;
 
         $data = [
           
            'union_id' => $union_id,
            'accept_send_date' => $request->accept_send_date,
            'acc_send_no_date' => $request->acc_send_no_date,
            'office' => $request->office,
            'description' => $request->description,
            'repley_no_date' => $request->repley_no_date,
            'comment' => $request->comment,
            'type' => $request->type,
        ];
 
        
         //file upload
         if ($request->hasFile("file")) {
 
             //insert image
             $image = $request->file("file");
 
             $img = $union_id.'_'.uniqid().".".$image->getClientOriginalExtension();
 
             $location = public_path("assets/reports/file/".$img);
 
             $move = $request->file->move(($location), $img);
 
             if ($move) {
                 $data['file'] = $img;
             }
 
         }
 

         try {

            if ($request->row_id > 0) {

                $data['updated_time'] = date('Y-m-d h:i:s');
                $data['updated_by'] = Auth::user()->id;
                $data['updated_by_ip'] = $request->ip();
                $data['is_process'] = 0;

                DB::table('letters')->where('id', $request->row_id)->update($data);

                return Response::json(['status' => 'success', 'message' => 'পত্র আপডেট সম্পন্ন হয়েছে']);
            } else {

                $data['created_time'] = date('Y-m-d h:i:s');
                $data['created_by'] = Auth::user()->id;
                $data['created_by_ip'] = $request->ip();

                DB::table('letters')->insert($data);

                return Response::json(['status' => 'success', 'message' => 'পত্র সম্পন্ন হয়েছে']);
            }
 
            
 
             //code...
         } catch (\Throwable $th) {
            
             return Response::json(['status' => 'error', 'message' => 'পত্র সম্পন্ন হয়নি।']);
         }
 
     }
 
     //for letter delete
     public function letter_delete(Request $request){
 
         $delete =  DB::table('letters')
                 ->where([
                     'id' => $request->id,
                     'union_id' => Auth::user()->union_id,
                 ])
                 ->update([
                    'updated_by' => Auth::User()->id, 
                    'updated_by_ip' => $request->ip(), 
                    'updated_time' => Carbon::now(),  
                    'is_active' => 0,
                    'is_process' => 0
                ]);
 
         
         
         if($delete){
             return Response::json(['status' => 'success', 'message' => 'ডিলিট করা হয়েছে।']);
         }else{
             return Response::json(['status' => 'error', 'message' => 'ডিলিট করা হয়নি।']);
         }
 
         
     }

      //for assets register list show
    public function asset_register(Request $request)
    {
  
          $type = $request->type;
         
          if ($request->ajax()) {
  
              $data = DB::table('asset_register')->where(['is_active' => 1])->get();
  
              return Datatables::of($data)
                      ->addIndexColumn()
                      ->rawColumns(['action'])
                      ->make(true);
          }
        
          return view('reports.asset_register')->with('type', $type);
    }
  
    //asset register save
    public function asset_register_save(Request $request){
  
          $union_id = Auth::user()->union_id;
  
          $data = [
            
             'union_id' => $union_id,
             'asset_name_point' => $request->asset_name_point,
             'create_buy_date' => $request->create_buy_date,
             'rate' => $request->rate,
             'stock_source' => $request->stock_source,
             'last_care_date' => $request->last_care_date,
             'expence_amount' => $request->expence_amount,
             'care_expense_source' => $request->care_expense_source,
             'next_care_date' => $request->next_care_date,
             'comment' => $request->comment,
            
         ];

         
          //file upload
          if ($request->hasFile("file")) {
  
              //insert image
              $image = $request->file("file");
  
              $img = $union_id.'_'.uniqid().".".$image->getClientOriginalExtension();
  
              $location = public_path("assets/reports/file/".$img);
  
              $move = $request->file->move(($location), $img);
  
              if ($move) {
                  $data['file'] = $img;
              }
  
          }


        try {

            if ($request->row_id > 0) {

                $data['updated_time'] = date('Y-m-d h:i:s');
                $data['updated_by'] = Auth::user()->id;
                $data['updated_by_ip'] = $request->ip();
                $data['is_process'] = 0;

                DB::table('asset_register')->where('id', $request->row_id)->update($data);

                return Response::json(['status' => 'success', 'message' => 'স্থায়ী সম্পত্তি আপডেট সম্পন্ন হয়েছে']);
            } else {

                $data['created_time'] = date('Y-m-d h:i:s');
                $data['created_by'] = Auth::user()->id;
                $data['created_by_ip'] = $request->ip();

                DB::table('asset_register')->insert($data);

                return Response::json(['status' => 'success', 'message' => 'স্থায়ী সম্পত্তি সম্পন্ন হয়েছে']);
            }



            //code...
        } catch (\Throwable $th) {

            return Response::json(['status' => 'error', 'message' => 'স্থায়ী সম্পত্তি সম্পন্ন হয়নি।']);
        }
  
    }
  
    //for asset_register delete
    public function asset_register_delete(Request $request){
  
          $delete =  DB::table('asset_register')
                  ->where([
                      'id' => $request->id,
                      'union_id' => Auth::user()->union_id,
                  ])
                  ->update(['updated_by' => Auth::User()->id, 'updated_by_ip' => $request->ip(), 'updated_time' => Carbon::now(),  'is_active' =>0,  'is_process' => 0]);
  
          
          
          if($delete){
              return Response::json(['status' => 'success', 'message' => 'ডিলিট করা হয়েছে।']);
          }else{
              return Response::json(['status' => 'error', 'message' => 'ডিলিট করা হয়নি।']);
          }
  
          
    }

   
      //for project list show
    public function projects(Request $request)
    {

        if ($request->ajax()) {

            $data = DB::table('projects')->where('union_id',auth()->user()->union_id)->where(['is_active' => 1, 'deleted_at' => NULL])->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('reports.project');
    }

    //project save
    public function project_save(Request $request){

        $union_id = Auth::user()->union_id;

        $data = [

            'union_id' => $union_id,
            'title' => $request->title,
            'description' => $request->description,
        ];

        //upload pre photo
        if ($request->hasFile("pre_photo")) {
            //insert image
            $image = $request->file("pre_photo");

            $img =  $union_id.'_'.uniqid().".".$image->getClientOriginalExtension();

            $location = public_path("assets/reports/photo/".$img);

            //upload image in folder
            $move = Image::make($image)->resize(700, 600)->save($location);

            if ($move) {
                $data['pre_photo'] = $img;
            }

        }

        //upload final photo
        if ($request->hasFile("final_photo")) {

            //insert image
            $image = $request->file("final_photo");

            $img = $union_id.'_'.uniqid().".".$image->getClientOriginalExtension();

            $location = public_path("assets/reports/photo/".$img);

            //upload image in folder
            $move = Image::make($image)->resize(700, 600)->save($location);


            if ($move) {
                $data['final_photo'] = $img;
            }

        }

        //file upload
        if ($request->hasFile("file")) {

            //insert image
            $image = $request->file("file");

            $img = $union_id.'_'.uniqid().".".$image->getClientOriginalExtension();

            $move = $image->storeAs('reports/files' , $img);

            if ($move) {
                $data['file'] = $img;
            }

        }

    

        try {

            if($request->row_id > 0){

                $data['updated_time'] = date('Y-m-d h:i:s');
                $data['updated_by'] = Auth::user()->id;
                $data['updated_by_ip'] = $request->ip();
                $data['is_process'] = 0;

                DB::table('projects')->where('id', $request->row_id)->update($data);

                return Response::json(['status' => 'success', 'message' => 'প্রোজেক্ট সম্পন্ন হয়েছে']);

            }else{

                $data['created_time'] = date('Y-m-d h:i:s');
                $data['created_by'] = Auth::user()->id;
                $data['created_by_ip'] = $request->ip();

                DB::table('projects')->insert($data);

                return Response::json(['status' => 'success', 'message' => 'প্রোজেক্ট সম্পন্ন হয়েছে']);

            }

           

            //code...
        } catch (\Throwable $th) {
           
            return Response::json(['status' => 'error', 'message' => 'প্রোজেক্ট সম্পন্ন হয়নি।']);
        }

    }

    //for project update
    public function project_update_save(Request $request){

    }

    //for projcet delete
    public function project_delete(Request $request){

        $delete =  DB::table('projects')
                ->where([
                    'id' => $request->id,
                    'union_id' => Auth::user()->union_id,
                ])
                ->update(['updated_by' => Auth::User()->id, 'updated_by_ip' => $request->ip(), 'updated_time' => Carbon::now(), 'deleted_at' => Carbon::now(),  'is_active' =>0,  'is_process' => 0]);

        
        if($delete){
            return Response::json(['status' => 'success', 'message' => 'ডিলিট করা হয়েছে।']);
        }else{
            return Response::json(['status' => 'error', 'message' => 'ডিলিট করা হয়নি।']);
        }

        
    }


}
