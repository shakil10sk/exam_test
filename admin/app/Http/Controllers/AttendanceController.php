<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Yajra\DataTables\Contracts\DataTable;
use DataTables;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendance_data(Request $request)
    {

    
        $union_id = Auth::user()->union_id;
        
        $empolyee_data = DB::table('employees')
            ->where(['is_active' => 1, 'union_id' => $union_id])
            ->get();

    
       
        if ($request->ajax()) {

            $query = DB::table('employees AS EMP')

                    ->leftjoin('attendance AS ATT', function($join) {
                        
                        $join->on('ATT.record_id', '=', 'EMP.employee_id')
                            ->on('ATT.union_id', '=', 'EMP.union_id')
                            ->whereDate('ATT.created_time', '>=', request('from_date'))
                            ->whereDate('ATT.created_time', '<=', request('to_date'));
                    })

                    ->select('EMP.name', 'EMP.employee_id', 'EMP.device_id', 'EMP.designation_id', 'ATT.is_process as status', 'ATT.login_time', 'ATT.logout_time', DB::raw('date(ATT.login_time) as att_date'))

                    // ->whereDate('ATT.created_time', '>=', $request->from_date)
                    // ->whereDate('ATT.created_time', '<=', $request->to_date)
                    ->where(['EMP.union_id' => $union_id, 'EMP.is_active' => 1]);

                    if($request->employee_id > 0){

                        $query->where('EMP.employee_id', $request->employee_id);
                    }

                    $attendance = $query->get();

                return Datatables::of($attendance)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('attendance.attendance')->with('data', $empolyee_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
