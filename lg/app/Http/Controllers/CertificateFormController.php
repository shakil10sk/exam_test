<?php
namespace App\Http\Controllers;

use App\GlobalModel;
use App\Models\Geocode\BdLocation;

class CertificateFormController extends Controller
{
    public $subDomain;
    public $unionProfile;
    public $unionId;
    public $path;

    
    public function __construct()
    {

        $this->unionProfile = GlobalModel::lg_profile(env("WEB_SUB_DOMAIN"));

        $this->unionId = $this->unionProfile->union_id;

        if (env("APP_ENV") == 'local') {
            //This is for local run project
            //Note: create thid path for run admin first time than run web
            $this->path = env('ADMIN_URL');
        } elseif (env("APP_ENV") == 'development') {
            //This is for local-server run project
            // $this->path = str_replace('web', 'admin/public', URL('/'));
            $this->path = env("ADMIN_URL");
        } else {
            //This is for production run project
            $this->path = env("ADMIN_URL");
        }
    }

    public function showApplicationForm($id)
    {

        $id = decrypt($id);

        $district = BdLocation::where('type',2)->get();

        $data = ['unionProfile' => $this->unionProfile, 'path' => $this->path,'district' => $district];

        if ($id == 1) {
            $data['id'] = $id;
            return view('application_form.nagorikotto', $data);
        } elseif ($id == 2) {
            $data['id'] = $id;
            return view('application_form.mrritu', $data);
        } elseif ($id == 3) {
            $data['id'] = $id;
            return view('application_form.obibahit', $data);
        } elseif ($id == 4) {
            $data['id'] = $id;
            return view('application_form.punobibaho', $data);
        } elseif ($id == 5) {
            $data['id'] = $id;
            return view('application_form.ekoinamer_prtoyon', $data);
        } elseif ($id == 6) {
            $data['id'] = $id;
            return view('application_form.sonaton_dorma', $data);
        } elseif ($id == 7) {
            $data['id'] = $id;
            return view('application_form.prottoyon', $data);
        } elseif ($id == 8) {
            $data['id'] = $id;
            return view('application_form.nodivonger', $data);
        } elseif ($id == 9) {
            $data['id'] = $id;
            return view('application_form.charitrik', $data);
        } elseif ($id == 10) {
            $data['id'] = $id;
            return view('application_form.vumihin', $data);
        } elseif ($id == 11) {
            $data['id'] = $id;
            return view('application_form.barsikay', $data);
        } elseif ($id == 12) {
            $data['id'] = $id;
            return view('application_form.protibondi', $data);
        } elseif ($id == 13) {
            $data['id'] = $id;
            return view('application_form.onumoti', $data);
        } elseif ($id == 14) {
            $data['id'] = $id;
            return view('application_form.votarid', $data);
        } elseif ($id == 15) {
            $data['id'] = $id;
            return view('application_form.onapotti', $data);
        } elseif ($id == 16) {
            $data['id'] = $id;
            return view('application_form.rashta_khonon', $data);
        } elseif ($id == 17) {
            $data['id'] = $id;
            return view('application_form.oyarish', $data);
        } elseif ($id == 18) {
            $data['id'] = $id;
            return view('application_form.paribarik', $data);
        } elseif ($id == 19) {
            $data['id'] = $id;
            
            $data['business_type_data'] = \Illuminate\Support\Facades\DB::table('business_type')
                ->where('union_id', $this->unionId)
                ->get();

            return view('application_form.trade_license', $data);

        } elseif ($id == 20) {
            $data['id'] = $id;
            return view('application_form.bibahito', $data);
        }
    }
}
