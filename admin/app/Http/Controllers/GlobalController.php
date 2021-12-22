<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Global_model;
use Illuminate\Support\Facades\DB;


class GlobalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    //get all account
    public function account_list(Request $request){

        $account_list = Global_model::account_list(Auth::user()->union_id);

        if (!empty($account_list)) {

            echo json_encode(['status' => 'success', "message" => "data found", 'data' => $account_list]);

        }else{

            echo json_encode(['status' => 'error', "message" => "data not found", 'data' => []]);
        }

    }

    //get location
    public function get_location(Request $request){

        $location = Global_model::get_all_location($request);

        if (!empty($location)) {

            echo json_encode(['status' => 'success', "message" => "data found", 'data' => $location]);

        }else{

            echo json_encode(['status' => 'error', "message" => "data not found", 'data' => []]);
        }

    }

    //get all union by upazila id
    public function all_union_list(Request $request){

        $data = DB::table('union_information')
            ->where('upazila_id', $request->upazila_id)
            ->get();

        if (!empty($data)) {

            echo json_encode(['status' => 'success', "message" => "data found", 'data' => $data]);

        }else{

            echo json_encode(['status' => 'error', "message" => "data not found", 'data' => []]);
        }
    }

}
