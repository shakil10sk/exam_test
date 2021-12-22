<?php

namespace App\Http\Controllers\Management\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GlobalModel;
use App\Models\Employee;
use Illuminate\Support\Str;
use DB;
class MemberController extends Controller
{
    public $subDomain;
    public $unionProfile;
    public $unionId;
    public $path;

    public function __construct(){

       
        $this->unionProfile = GlobalModel::lg_profile(env("WEB_SUB_DOMAIN"));

        $this->unionId = $this->unionProfile->union_id;


        if(env("APP_ENV") == 'local'){
            //This is for local run project
            //Note: create thid path for run admin first time than run web
            $this->path = env('ADMIN_URL');
        }elseif(env("APP_ENV") == 'development'){
            //This is for local-server run project
            // $this->path = str_replace('web', 'admin', URL('/'));

            $this->path = env("ADMIN_URL");

        }else {
            //This is for production run project
            $this->path = env("ADMIN_URL");
        }

        // dd($this->path);

    }

    //view employee
    public function viewEmployeeProfile($id, $unionId){
        $id = decrypt($id);
        $unionId = decrypt($unionId);
        $employee = Employee::getEmployee($id, $unionId);

        return view('employee_profile', ['unionProfile' => $this->unionProfile, 'path' => $this->path, 'employee' => $employee]);
    }
}
