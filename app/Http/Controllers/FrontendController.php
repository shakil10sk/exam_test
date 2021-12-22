<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\GlobalModel;
use App\Models\Employee;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public $subDomain;
    public $unionProfile;
    public $unionId;
    public $path;

    public function __construct()
    {

        if (env("APP_ENV") == 'development') {
            $this->subDomain = env('WEB_SUB_DOMAIN');
        } elseif (env("APP_ENV") == 'local') {
            $this->subDomain = env('WEB_SUB_DOMAIN');
        } else {
            $this->subDomain = explode('.', $_SERVER['HTTP_HOST'])[0];
        }

        // dd($this->subDomain);

        $this->unionProfile = GlobalModel::union_profile($this->subDomain);


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

        // dd($this->path);

    }

    public function index()
    {
        $employees  = Employee::getEmployees($this->unionId);
        $slider     = Slide::getSlider($this->unionId);
        $notices    = Notice::getNotices($this->unionId,1);

        $latest_notices =  Notice::getNotices($this->unionId,2);

        $chairman = [];
        $headOfDepartment = [];
        $otherEmployee = [];
        $councilors = [];
        $panelmayor = [];

        foreach ($employees as $key => $employee) {
            if ($employee->designation_id == 1) {
                $chairman[$key]['id']             = $employee->employee_id;
                $chairman[$key]['name']           = $employee->name;
                $chairman[$key]['designation_id'] = $employee->designation_id;
                $chairman[$key]['photo']          = $employee->photo;
            } elseif ( (int) $employee->designation_id === 2 || (int) $employee->designation_id === 6) {
                $headOfDepartment[$key]['id']             = $employee->employee_id;
                $headOfDepartment[$key]['name']           = $employee->name;
                $headOfDepartment[$key]['designation'] = $employee->designation_name;
                $headOfDepartment[$key]['photo']          = $employee->photo;
            } elseif ( in_array($employee->designation_id,[8,9,10]) ) {
                $panelmayor[$key]['id']             = $employee->employee_id;
                $panelmayor[$key]['name']           = $employee->name;
                $panelmayor[$key]['designation'] = $employee->designation_name;
                $panelmayor[$key]['photo']          = $employee->photo;
            } elseif ( (int) $employee->designation_id === 5 || (int) $employee->designation_id === 7 ) {
                $councilors[$key]['id']             = $employee->employee_id;
                $councilors[$key]['name']           = $employee->name;
                $councilors[$key]['designation'] = $employee->designation_name;
                $councilors[$key]['photo']          = $employee->photo;
            } else {
                $otherEmployee[$key]['id']             = $employee->employee_id;
                $otherEmployee[$key]['name']           = $employee->name;
                $otherEmployee[$key]['designation'] = $employee->designation_name;
                $otherEmployee[$key]['photo']          = $employee->photo;
            }
        }

        return view('index', ['chairman' => $chairman, 'headOfDepartment' => $headOfDepartment, 'othersEmployee' =>
            $otherEmployee,'panelmayor'=> $panelmayor,'councilors' => array_values($councilors), 'slider' => $slider, 'notices' => $notices, 'unionProfile' => $this->unionProfile, 'path' => $this->path, 'latest_notices' => $latest_notices]);
        }

    public function contact()
    {
        return view('contact', ['unionProfile' => $this->unionProfile, 'path' => $this->path]);
    }

    public function viewCheckApplicationForm($id)
    {
        return view('check_application', compact('id'));
    }

    public function viewCheckCertificateForm($id)
    {
        return view('check_certificate', compact('id'));
    }

    public function viewUnionInfo()
    {
        return view('union_info', ['unionProfile' => $this->unionProfile, 'path' => $this->path]);
    }

    public function trade_renew()
    {
        return view('trade_renew')->with(['unionProfile' => $this->unionProfile, 'path' => $this->path]);
    }
}
