<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\GlobalModel;
use App\Models\Employee;
use Illuminate\Support\Str;
use DB;

class FrontendController extends Controller
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

        // dd($this->path);

    }

    public function index()
    {
        $employees  = Employee::getEmployees($this->unionId);
        $slider     = Slide::getSlider($this->unionId);
        $notices    = Notice::getNotices($this->unionId);

        return view('index', ['employees' => $employees, 'slider' => $slider, 'notices' => $notices, 'unionProfile' => $this->unionProfile, 'path' => $this->path]);
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
