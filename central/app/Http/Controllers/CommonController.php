<?php

namespace App\Http\Controllers;

use App\Models\BdLocation;
use App\Models\Employee;
use App\Models\UnionInformation;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function memberList(Request $r)
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

        $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        if ($r->upazila) {
            $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
        }
        if ($r->union) {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }

        
        $data['members'] = Employee::whereIn('union_id', $union_ids)->whereIsActive(1)->get();

        return view('committee', $data);
    }

}
