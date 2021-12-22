<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Accounts\Settings;
use App\Models\Global_model;
use App\Models\IdGenerate;
use App\Models\Accounts\Cashbook;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

use Response;

class CashbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cashbooks()
    {
        return view('accounts.cashbook.cashbooks');
    }

    //for generel cashbook data
    public function generel_cashbook($from_date = null, $to_date = null){

        $cashbook = new Cashbook();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        $discount_id = Global_model::get_account_id($union_id, 24);

        //get cashbook data
        $response = $cashbook->generel_cashbook_data($union_id, $from_date, $to_date, $discount_id);

        // dd($response);

        // $pdf = PDF::loadView('accounts.cashbook.generel_cashbook',  ['income' => $response['income'], 'expense' => $response['expense'], 'union' => $union_profile]);
        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.cashbook.generel_cashbook',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.cashbook.generel_cashbook',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("generel_cashbook.pdf");

    }

    //for lgsp cashbook data
    public function lgsp_cashbook($from_date = null, $to_date = null){

        $cashbook = new Cashbook();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get cashbook data
        $response = $cashbook->lgsp_cashbook_data($union_id, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.cashbook.lgsp_cashbook',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.cashbook.lgsp_cashbook',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("lgsp_cashbook.pdf");

    }

    //for sthabor cashbook data
    public function sthabor_cashbook($from_date = null, $to_date = null){

        $cashbook = new Cashbook();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get cashbook data
        $response = $cashbook->sthabor_cashbook_data($union_id, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.cashbook.sthabor_cashbook',  ['data' => $response, 'union' => $union_profile]), $config);
        // $pdf = PDF::loadView('accounts.cashbook.sthabor_cashbook',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("sthabor_cashbook.pdf");

    }

    //for birth die cashbook data
    public function birth_die_cashbook($from_date = null, $to_date = null){

        $cashbook = new Cashbook();

        $union_id = Auth::user()->union_id;

        $union_profile = Global_model::union_profile($union_id);

        $union_profile->from_date = $from_date;
        $union_profile->to_date = $to_date;

        //get cashbook data
        $response = $cashbook->birth_die_cashbook_data($union_id, $from_date, $to_date);

        $config = ['instanceConfigurator' => function ($mpdf) use ($union_profile){
            $mpdf->SetWatermarkImage(asset('images/union_profile/'. $union_profile->jolchap));
            $mpdf->showWatermarkImage = true;
        }];

        $pdf = PDF::loadHtml(view('accounts.cashbook.birth_die_cashbook',  ['data' => $response, 'union' => $union_profile]), $config);

        // $pdf = PDF::loadView('accounts.cashbook.birth_die_cashbook',  ['data' => $response, 'union' => $union_profile]);

        return $pdf->stream("birth_die_cashbook.pdf");

    }




}
