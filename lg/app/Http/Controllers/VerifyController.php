<?php

namespace App\Http\Controllers;

use App\Verify;
use App\GlobalModel;
use App\Models\Geocode\BdLocation;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use DB;

class VerifyController extends Controller
{

	public $subDomain;
    public $lgProfile;
    // public $lgProfile;
    public $unionId;
    public $verify;
    public $path;

    public function __construct(){

        $this->lgProfile = GlobalModel::lg_profile(env("WEB_SUB_DOMAIN"));

        $this->unionId = $this->lgProfile->union_id;

        $this->verify = new Verify();

        if(env("APP_ENV") == 'local'){
            //This is for local run project
            //Note: create thid path for run admin first time than run web
            $this->path = env('ADMIN_URL');
        }elseif(env("APP_ENV") == 'development'){
            //This is for local-server run project
            // $this->path = str_replace('web', 'admin/public', URL('/'));

            $this->path = env("ADMIN_URL");
        }else {
            //This is for production run project
            $this->path = env("ADMIN_URL");
        }

       

    }



    //for application verify
    public function application(){

        $district = BdLocation::where('type',2)->get();

         return view('verify.application')->with(['unionProfile' => $this->lgProfile, 'path' => $this->path, 'district' => $district]);
    }

    //for certificate verify
    public function certificate(){

    	 return view('verify.certificate')->with(['lgProfile' => $this->lgProfile, 'path' => $this->path]);
    }

    public function getPdfData($tracking, $union_id, $type, $appType)
    {
        if($tracking == NULL || $union_id == NULL || $type == NULL || $appType == NULL)
        {
            return null;
        }

        $appDb = env('DB_APP_DATABASE');

        // dd($appDb);
        // dd($tracking, $union_id, $type, $appType);
        $url = env('ADMIN_URL') . 'api/get/pdf-data/' . $tracking . '/' . $union_id . '/' . $type . '/' . $appType . '/' . $appDb;

        // dd($url);

        $client = new \GuzzleHttp\Client();
        try {
            $req = $client->request(
                'GET',
                $url
            );
            $res = json_decode($req->getBody()->getContents());
            // dd($res);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            dd($e->getMessage());
        }

        return $res;
        
    }

    //for trade application verify
    public function trade_application($tracking = NULL, $union_id = NULL, $type = NULL)
    {

        // $response = $this->verify->trade_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = json_decode(json_encode($res->pdf_data), true);

        $data = ['trade' => $response, 'union' => GlobalModel::union_profile($union_id)];
        $data['type'] = $type;

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;
        // dd($data);

        $pdf = PDF::loadView('verify.trade.application_verify', $data);

        return $pdf->stream('trade_application_verify.pdf');
    }


	//for trade license bangla verify
	public function trade_bn($sonod_no= NULL, $union_id = NULL, $type = null){

        // $response = $this->verify->trade_certificate_verify_data($sonod_no, $union_id, $type);
        
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = json_decode(json_encode($res->pdf_data), true);

        $pdf = PDF::loadView('verify.trade.bangla_verify', ['trade' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('trade_bangla_verify.pdf');
		
		
	}

	//for trade license english verify
	public function trade_en($sonod_no= NULL, $union_id = NULL, $type = null){

        // $response = $this->verify->trade_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = json_decode(json_encode($res->pdf_data), true);

        $pdf = PDF::loadView('verify.trade.english_verify', ['trade' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('trade_bangla_verify.pdf');

	}



    //for warish  application verification
    public function warish_application($tracking = null, $union_id = null, $type)
    {
        // $response = $this->verify->warish_application_verify_data($tracking, $union_id, $type);

        $res = $this->getPdfData($tracking, $union_id, $type,2);
        
        $response =(array) $res->pdf_data;
        
        $data = ['data' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;
        // dd($data);

        $pdf = PDF::loadView('verify.warish.application_verify',$data);
            
        return $pdf->stream('warish_application_verify.pdf');
    }


    public function warish_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->warish_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response =(array) $res->pdf_data;
        $pdf = PDF::loadView('verify.warish.bangla_verify', ['data' => $response, 'union' => GlobalModel::union_profile($union_id)]);

        return $pdf->stream('warish_bangla_verify.pdf');        
    }

    //for warish english verify
    public function warish_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->warish_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response =(array) $res->pdf_data;

        $pdf = PDF::loadView('verify.warish.english_verify', ['data' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('warish_english_verify.pdf');

    }


    //for family  application verification
    public function family_application($tracking = null, $union_id = null, $type)
    {
        // $response = $this->verify->warish_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response =(array) $res->pdf_data;

        $data = ['data' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.family.application_verify', $data);
            
        return $pdf->stream('family_application_verify.pdf');
    }

    //family bangla certificate
    public function family_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->warish_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response =(array) $res->pdf_data;

        $pdf = PDF::loadView('verify.family.bangla_verify', ['data' => $response, 'union' => GlobalModel::union_profile($union_id)]); 
            
        return $pdf->stream('family_bangla_verify.pdf');
        
        
    }

    //for family english verify
    public function family_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->warish_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = (array)$res->pdf_data;

        $pdf = PDF::loadView('verify.family.english_verify', ['data' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('family_english_verify.pdf');

    }


    //for nagorik application verify
    public function nagorik_application($tracking = null, $union_id = null, $type = null)
    {

        $res = $this->getPdfData($tracking, $union_id, $type,2);

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        $response = $res->pdf_data;

        $data = ['nagorik' => $response, 'union' => GlobalModel::union_profile($response->union_id)];
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.nagorik.application_verify', $data);

        return $pdf->stream('nagorik_application_verify.pdf');
    }

    //for nagorik bangla verify
    public function nagorik_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $response = $res->pdf_data;
        
        $data = ['nagorik' => $response, 'union' => GlobalModel::union_profile($union_id)];
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.nagorik.bangla_verify', $data);
            
        return $pdf->stream('nagorik_bangla_verify.pdf');
        
        
    }

    //for nagorik english verify
    public function nagorik_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $data = ['nagorik' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.nagorik.english_verify', $data);
            
        return $pdf->stream('nagorik_english_verify.pdf');

    }


    //for death application verify
    public function death_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);

        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['death' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.death.application_verify', $data);
            
        return $pdf->stream('death_application_verify.pdf');
        
    }


    //for death bangla verify
    public function death_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $data = ['death' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $pdf = PDF::loadView('verify.death.bangla_verify', $data);
            
        return $pdf->stream('death_bangla_verify.pdf');
        
        
    }

    //for death english verify
    public function death_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $data = ['death' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $pdf = PDF::loadView('verify.death.english_verify', $data);
            
        return $pdf->stream('death_english_verify.pdf');

    }

    //for obibahito application verify
    public function obibahito_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);

        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['obibahito' => $response, 'union' => GlobalModel::union_profile($union_id)];


        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.obibahito.application_verify',$data );
            
        return $pdf->stream('obibahito_application_verify.pdf');
        
    }

    //for obibahito bangla verify
    public function obibahito_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $data = ['obibahito' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $pdf = PDF::loadView('verify.obibahito.bangla_verify', $data);
            
        return $pdf->stream('obibahito_bangla_verify.pdf');
        
        
    }

    //for obibahito english verify
    public function obibahito_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $data = ['obibahito' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $pdf = PDF::loadView('verify.obibahito.english_verify', $data);
            
        return $pdf->stream('obibahito_english_verify.pdf');

    }


    //for punobibaho application verify
    public function punobibaho_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);

        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['punobibaho' => $response, 'union' => GlobalModel::union_profile($union_id)];

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $pdf = PDF::loadView('verify.punobibaho.application_verify', $data);
            
        return $pdf->stream('punobibaho_application_verify.pdf');
        
    }


    //for punobibaho bangla verify
    public function punobibaho_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.punobibaho.bangla_verify', ['punobibaho' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('punobibaho_bangla_verify.pdf');
        
        
    }

    //for punobibaho english verify
    public function punobibaho_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.punobibaho.english_verify', ['punobibaho' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('punobibaho_english_verify.pdf');

    }

    //for ekoinam application verify
    public function ekoinam_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->ekoinam_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['ekoinam' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.ekoinam.application_verify', $data);
            
        return $pdf->stream('ekoinam_application_verify.pdf');
        
    }



    //for ekoinam bangla verify
    public function ekoinam_bn($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->ekoinam_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;


        $pdf = PDF::loadView('verify.ekoinam.bangla_verify', ['ekoinam' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('ekoinam_bangla_verify.pdf');
        
        
    }

    //for ekoinam english verify
    public function ekoinam_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->ekoinam_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.ekoinam.english_verify', ['ekoinam' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('ekoinam_english_verify.pdf');

    }

    //for sonaton application verify
    public function sonaton_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;


        $data =['sonaton' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.sonaton.application_verify', $data);
            
        return $pdf->stream('sonaton_application_verify.pdf');
        
    }


    //for sonaton bangla verify
    public function sonaton_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.sonaton.bangla_verify', ['sonaton' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('sonaton_bangla_verify.pdf');
        
    }

    //for sonaton english verify
    public function sonaton_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;
        $pdf = PDF::loadView('verify.sonaton.english_verify', ['sonaton' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('sonaton_english_verify.pdf');

    }




    //for prottyon application verify
    public function prottyon_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);

        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['prottyon' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.prottyon.application_verify', $data);
            
        return $pdf->stream('prottyon_application_verify.pdf');
        
    }

    //for prottyon bangla verify
    public function prottyon_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.prottyon.bangla_verify', ['prottyon' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('prottyon_bangla_verify.pdf');
        
    }
    
    //for prottyon english verify
    public function prottyon_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.prottyon.english_verify', ['prottyon' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('prottyon_english_verify.pdf');

    }


    //for nodibanga application verify
    public function nodibanga_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['nodibanga' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.nodibanga.application_verify', $data);
            
        return $pdf->stream('nodibanga_application_verify.pdf');
        
    }


    //for nodibanga bangla verify
    public function nodibanga_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.nodibanga.bangla_verify', ['nodibanga' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('nodibanga_bangla_verify.pdf');
        
    }
    
    //for nodibanga english verify
    public function nodibanga_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.nodibanga.english_verify', ['nodibanga' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('nodibanga_english_verify.pdf');

    }

    //for character application verify
    public function character_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['character' => $response, 'union' => GlobalModel::union_profile($union_id) ];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.character.application_verify', $data);
            
        return $pdf->stream('character_application_verify.pdf');
        
    }

    //for character bangla verify
    public function character_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.character.bangla_verify', ['character' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('character_bangla_verify.pdf');
        
    }
    
    //for character english verify
    public function character_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.character.english_verify', ['character' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('character_english_verify.pdf');

    }

    //for vumihin application verify
    public function vumihin_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['vumihin' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.vumihin.application_verify', $data);
            
        return $pdf->stream('vumihin_application_verify.pdf');
        
    }

    //for vumihin bangla verify
    public function vumihin_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.vumihin.bangla_verify', ['vumihin' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('vumihin_bangla_verify.pdf');
        
    }
    
    //for vumihin english verify
    public function vumihin_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.vumihin.english_verify', ['vumihin' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('vumihin_english_verify.pdf');

    }


    //for yearlyincome application verify
    public function yearlyincome_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->yearlyincome_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['yearlyincome' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.yearlyincome.application_verify', $data);
            
        return $pdf->stream('yearlyincome_application_verify.pdf');
        
    }

    //for yearlyincome bangla verify
    public function yearlyincome_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->yearlyincome_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.yearlyincome.bangla_verify', ['yearlyincome' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('yearlyincome_bangla_verify.pdf');
        
    }
    
    //for yearlyincome english verify
    public function yearlyincome_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->yearlyincome_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.yearlyincome.english_verify', ['yearlyincome' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('yearlyincome_english_verify.pdf');

    }


    //for protibondi application verify
    public function protibondi_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['protibondi' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.protibondi.application_verify', $data);
            
        return $pdf->stream('protibondi_application_verify.pdf');
        
    }

    //for protibondi bangla verify
    public function protibondi_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.protibondi.bangla_verify', ['protibondi' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('protibondi_bangla_verify.pdf');
        
    }
    
    //for protibondi english verify
    public function protibondi_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.protibondi.english_verify', ['protibondi' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('protibondi_english_verify.pdf');

    }




    //for onumoti application verify
    public function onumoti_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->onumoti_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;

        $data = ['onumoti' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.onumoti.application_verify', $data);
            
        return $pdf->stream('onumoti_application_verify.pdf');
        
    }

    //for onumoti bangla verify
    public function onumoti_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->onumoti_certificate_verify_data($sonod_no, $union_id, $type);

        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.onumoti.bangla_verify', ['onumoti' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('onumoti_bangla_verify.pdf');
        
    }
    
    //for onumoti english verify
    public function onumoti_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->onumoti_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.onumoti.english_verify', ['onumoti' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('onumoti_english_verify.pdf');

    }


    //for voter application verify
    public function onapotti_application($tracking, $union_id , $type){

        // $response = $this->verify->voter_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;
        $data = ['onapotti' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        // dd($data);
        $pdf = PDF::loadView('verify.onapotti.application_verify', $data);
            
        return $pdf->stream('onapotti_application_verify.pdf');
        
    }


    //for voter application verify
    public function voter_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->voter_application_verify_data($tracking, $union_id, $type);
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;
        $data = ['voter' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;
        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;


        $pdf = PDF::loadView('verify.voter.application_verify', $data);
            
        return $pdf->stream('voter_application_verify.pdf');
        
    }

    //for voter bangla verify
    public function voter_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->voter_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.voter.bangla_verify', ['voter' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('voter_bangla_verify.pdf');
        
    }
    
    //for voter english verify
    public function voter_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->voter_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.voter.english_verify', ['voter' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('voter_english_verify.pdf');

    }



    //for bibahito application verify
    public function bibahito_application($tracking = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_application_verify_data($tracking, $union_id, $type);
        
        $res = $this->getPdfData($tracking, $union_id, $type,2);

        $response = $res->pdf_data;
        $data = ['bibahito' => $response, 'union' => GlobalModel::union_profile($union_id)];

        // $data['print_setting'] = \DB::table('print_settings')->where(['union_id' => $union_id, 'type' => $type, 'application_type' => 2])->get(['pad_print','chairman','sochib','member','obibabok'])[0];

        // $data['colspan'] = $data['print_setting']->chairman + $data['print_setting']->sochib + $data['print_setting']->member +  $data['print_setting']->obibabok ;

        $data['print_setting'] = $res->print_setting;
        $data['colspan'] = $res->colspan;

        $pdf = PDF::loadView('verify.bibahito.application_verify', $data);
            
        return $pdf->stream('bibahito_application_verify.pdf');
        
    }

    //for bibahito bangla verify
    public function bibahito_bn($sonod_no = null, $union_id = null, $type = null){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;


        $pdf = PDF::loadView('verify.bibahito.bangla_verify', ['bibahito' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('bibahito_bangla_verify.pdf');
        
    }
    
    //for bibahito english verify
    public function bibahito_en($sonod_no= NULL, $union_id = NULL, $type = NULL){

        // $response = $this->verify->nagorik_certificate_verify_data($sonod_no, $union_id, $type);
        $res = $this->getPdfData($sonod_no, $union_id, $type,1);

        $response = $res->pdf_data;

        $pdf = PDF::loadView('verify.bibahito.english_verify', ['bibahito' => $response, 'union' => GlobalModel::union_profile($union_id)]);
            
        return $pdf->stream('bibahito_english_verify.pdf');

    }



}