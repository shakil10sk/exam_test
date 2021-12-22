<?php

namespace App\Http\Controllers\Management\bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        return view('bank.bank');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_view()
    {

        $data = DB::table('bank')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // dd($request);

            $bank_data = [
                'sonod_type' => $request->sonod_type,
                'bank_name' => $request->bank_name,
                'account_num' => $request->account_num,
                'bank_branch' => $request->bank_branch,
                'bank_branch_address' => $request->bank_branch_address,
            ];

            $isSave = DB::table('bank')->insert($bank_data);

            if($isSave){

                Alert::toast('bank add Successfully .', 'success');

                return back()->with("message","done");


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
    public function edit($id)
    {
        //
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
        $up_data =[
            'sonod_type' => $request->sonod_type,
            'bank_name' => $request->bank_name,
            'account_num' => $request->account_num,
            'bank_branch' => $request->bank_branch,
            'bank_branch_address' => $request->bank_branch_address,
        ];

        $update_data = DB::table('bank')->where('id', $request->id)->update($up_data);

        if($update_data){

            Alert::toast('bank Update Successfully .', 'success');

            return back();


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
        // $isSave = DB::table('bank')->insert($id);
      $delet =   DB::table('bank')->where('id', '=', $id)->delete();
        return response()->json([
            "status" => "success",
            "data" => $delet,
        ]);
    }
}
