<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use App\Models\BdLocation;
use App\Models\Project;
use App\Models\Report;
use App\Models\UnionInformation;
use Illuminate\Http\Request;

class ReportRegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function project(Request $r)
    {
        $GLOBALS['upazila'] = null;
        $GLOBALS['union'] = null;

        // upazila
        BdLocation::where('parent_id', auth()->user()->district)->each(function ($item) {
            $GLOBALS['union'] = null;
            // union
            UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {

                $GLOBALS['union'][] = $el;
            });

            $item->union = $GLOBALS['union'];

            $GLOBALS['upazila'][] = $item;
        });

        $data['upazila'] = json_encode($GLOBALS['upazila']);

        // dd($r->all());

        $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        if ($r->upazila) {
            $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
        }
        if ($r->union) {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }
        // dd($union_ids);

        $data['projects'] = Project::whereIn('union_id',$union_ids)->whereIsActive(1)->whereNull('deleted_at')->get();

        return view('report_register.project',$data);
    }

    public function reportResgister(Request $r, $type)
    {
        $GLOBALS['upazila'] = null;
        $GLOBALS['union'] = null;

        // upazila
        BdLocation::where('parent_id', auth()->user()->district)->each(function ($item) {
            $GLOBALS['union'] = null;
            // union
            UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {

                $GLOBALS['union'][] = $el;
            });

            $item->union = $GLOBALS['union'];

            $GLOBALS['upazila'][] = $item;
        });

        $data['upazila'] = json_encode($GLOBALS['upazila']);
        $data['type'] = $type;

        $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        
        if ($r->upazila) {
            $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
        }
        if ($r->union) {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }
        // dd($union_ids);
        $data['report_resgister'] = Report::whereIn('union_id', $union_ids)->whereType($type)->get();
        // dd($data['report_resgister']);
        switch($type)
        {
            case 1:
                $data['hearder'] = "কর ও রেট";
            break;
            case 2:
                $data['hearder'] = "গ্রাম আদালত (মাসিক)";
            break;
            case 3:
                $data['hearder'] = "জন্ম নিবধ্বন (মাসিক/ ত্রৈমাসিক)";
            break;
            case 4:
                $data['hearder'] = "ষান্মাসিক প্রতিবেদন";
            break;
            case 5:
                $data['hearder'] = "এসওই (ত্রৈমাসিক)";
            break;
            case 6:
                $data['hearder'] = "বার্ষিক আর্থিক বিবরণী";
            break;
            case 7:
                $data['hearder'] = "বার্ষিক বাজেট";
            break;
            case 8:
                $data['hearder'] = "বার্ষিক পরিকল্পনা";
            break;
            case 9:
                $data['hearder'] = "ত্রৈবার্ষিক পরিকল্পনা";
            break;
            case 10:
                $data['hearder'] = "পঞ্চবার্ষিক পরিকল্পনা";
            break;

        }

        return view('report_register.report_register', $data);
    }
}
