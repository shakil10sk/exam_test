<?php

namespace App\Http\Controllers\Management\Allowance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GlobalModel;
use App\Models\Allowance;

class AllowanceController extends Controller
{
    public $subDomain;
    public $unionProfile;
    public $unionId;
    public $path;

    public function __construct(){

        if (env("APP_ENV") == 'development') {

            $this->subDomain = env('WEB_SUB_DOMAIN');

        }elseif (env("APP_ENV") == 'local') {

            $this->subDomain = env('WEB_SUB_DOMAIN');

        }else{

            $this->subDomain = explode('.', $_SERVER['HTTP_HOST'])[0];

        }

        $this->unionProfile = GlobalModel::union_profile($this->subDomain);

        $this->unionId = $this->unionProfile->union_id;

        if(env("APP_ENV") == 'local'){
            //This is for local run project
            //Note: create thid path for run admin first time than run web
            $this->path = env('ADMIN_URL');
        }elseif(env("APP_ENV") == 'development'){
            //This is for local-server run project
            // $this->path = str_replace('web', '/admin/public', URL('/'));

            $this->path = env("ADMIN_URL");
        }else {
            //This is for production run project
            $this->path = env("ADMIN_URL");
        }

    }

    //get allowance by type
    public function viewAllowance($type)
    {
        $type = decrypt($type);
        $data = Allowance::getAllowanceByType($type, $this->unionId);
        return view('view_allowance', ['unionProfile' => $this->unionProfile, 'path' => $this->path, 'data' => $data, 'type' => $type]);
    }
}
