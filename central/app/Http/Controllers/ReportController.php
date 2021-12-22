<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AssetRegister;
use App\Models\Attendance;
use App\Models\BdLocation;
use App\Models\Employee;
use App\Models\Letter;
use App\Models\PublicService;
use App\Models\UnionInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dailyReport(Request $r)
    {
        // dd($r->all());
        $data = [];

        $GLOBALS['upazila'] = null;
        $GLOBALS['union'] = null;
        
        if(auth()->user()->type <= 3)
        {
            // upazila
            BdLocation::where('parent_id', auth()->user()->district)->each(function ($item) {
                $GLOBALS['union'] = null;
                // union
                UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {

                    $GLOBALS['union'][] = $el;
                });

                $item->union = $GLOBALS['union'];
                // dd($item->union);

                $GLOBALS['upazila'][] = $item;
            });

        }
        else
        {
            // dd(auth()->user()->upazila);
            BdLocation::where('id', auth()->user()->upazila)->each(function ($item) {
                $GLOBALS['union'] = null;
                // union
                UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {

                    $GLOBALS['union'][] = $el;
                });

                $item->union = $GLOBALS['union'];
                // dd($item->union);

                $GLOBALS['upazila'][] = $item;
            });
        }
        
        // dd($GLOBALS['upazila']);
        $data['upazila'] = json_encode($GLOBALS['upazila']);

        $GLOBALS['union_info'] = null;

        $search_data['is_active'] = 1;
        $search_data['district_id'] = auth()->user()->district;

        if ($r->upazila) {
            
            $search_data['upazila_id'] = $r->upazila;
            
            if(auth()->user()->type > 3)
            {
                $search_data['upazila_id'] = auth()->user()->upazila;
            }

            $data['upazila_name'] = BdLocation::find($search_data['upazila_id'])->bn_name;
        }

        if ($r->union) {
            $search_data['union_code'] = $r->union;
        }

        // dd($search_data);

        $from = ($r->from) ?  $r->from . " 00:00:00" : date('Y-m-d') . " 00:00:00";
        $to = ($r->to) ?  $r->to . " 23:59:59" : date('Y-m-d') . " 23:59:59";
        // dd($from,$to);

        UnionInformation::where($search_data)->each(function ($item) use ($from, $to) {

            $item->trade = (object) [
                'app' => PublicService::select(DB::raw('SUM(trade_app) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0,
                'certificate' => PublicService::select(DB::raw('SUM(trade_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0
            ];

            $item->waris = (object) [
                'app' => PublicService::select(DB::raw('SUM(warish_app) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0,
                'certificate' => PublicService::select(DB::raw('SUM(warish_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0
            ];

            $item->nagoric = (object) [
                'app' => PublicService::select(DB::raw('SUM(nagorik_app) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0,
                'certificate' => PublicService::select(DB::raw('SUM(nagorik_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0
            ];

            $item->family = (object) [
                'app' => PublicService::select(DB::raw('SUM(family_app) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0,
                'certificate' => PublicService::select(DB::raw('SUM(family_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0
            ];

            $item->onapoitti = (object) [
                'app' => PublicService::select(DB::raw('SUM(onapotti_app) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0,
                'certificate' => PublicService::select(DB::raw('SUM(onapotti_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0
            ];

            $item->yearly_income = PublicService::select(DB::raw('SUM(yearly_income_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0;

            $item->vumihin = PublicService::select(DB::raw('SUM(vumihin_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0;

            $item->death = PublicService::select(DB::raw('SUM(death_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0;

            $item->same_name = PublicService::select(DB::raw('SUM(same_name_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0;

            $item->voter = PublicService::select(DB::raw('SUM(voter_transper_certi) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0;

            $item->total = PublicService::select(DB::raw('SUM(total_amount) as total'))->where('union_id', $item->union_code)->whereBetween('created_at', [$from, $to])->first()->total ?? 0;

            $GLOBALS['union_info'][] = $item;
        });

        $data['union_info'] = $GLOBALS['union_info'];

        // dd($data['union_info']);

        return view('reports.daily_report', $data);
    }

    public function allowanceReport(Request $r)
    {
        // dd($r->all());
        $data = [];

        $GLOBALS['upazila'] = null;
        $GLOBALS['union'] = null;
        // dd(auth()->user()->district);

        if(auth()->user()->type <= 3)
        {
            // upazila
            BdLocation::where('parent_id', auth()->user()->district)->each(function ($item) {
                $GLOBALS['union'] = null;
                $GLOBALS['allowance'] = null;
                // union
                UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {

                    $GLOBALS['union'][] = $el;
                });

                $item->union = $GLOBALS['union'];
                // dd($item->union);

                $GLOBALS['upazila'][] = $item;
            });
        }
        else
        {
            // upazila
            BdLocation::where('id', auth()->user()->upazila)->each(function ($item) {
                $GLOBALS['union'] = null;

                // union
                UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {

                    $GLOBALS['union'][] = $el;
                });

                $item->union = $GLOBALS['union'];
                // dd($item->union);

                $GLOBALS['upazila'][] = $item;
            });
        }
        
        // dd($GLOBALS['upazila']);

        $data['upazila'] = json_encode($GLOBALS['upazila']);

        if(auth()->user()->type <= 3)
        {
            $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        
            if($r->upazila)
            {
                $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
                $data['upazila_name'] = BdLocation::find($r->upazila)->bn_name;
            }
        }
        else
        {
            $union_ids = UnionInformation::where('upazila_id', auth()->user()->upazila)->pluck('union_code')->toArray();
            $data['upazila_name'] = BdLocation::find(auth()->user()->upazila)->bn_name;
        }
        
        if($r->union)
        {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }

        // dd($search_data);
        $data['allowance'] = (object) [
            'freedom' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 1])->first(),

            'poor' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 2])->first(),

            'old' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 3])->first(),

            'motherhood' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 4])->first(),

            'bidoba' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 5])->first(),

            'protibondi' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 6])->first(),

            'vgd' => Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->whereIn('union_id',$union_ids)->where(['type' => 7])->first(),

        ];

        return view('reports.allowance', $data);
    }

    public function attendanceReport(Request $r)
    {
        $data = [];

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

        
        $record_ids = Employee::whereIn('union_id', $union_ids)->pluck('device_id');
        if ($r->designation_id) {
            $record_ids = Employee::whereIn('union_id', $union_ids)->where('designation_id', $r->designation_id)->pluck('device_id');
        }
        if ($r->employee_id) {
            $record_ids = Employee::where('employee_id', $r->employee_id)->pluck('device_id');
        }
        

        
        // dd($record_ids);

        // dd($r->all(['from', 'to']));

        $data['attendance'] = Attendance::whereIn('record_id', $record_ids)->whereBetween('attendance_date', [$r->from ?? date('Y-m-d'), $r->to ?? date('Y-m-d')])->get();

        // if ($r->all() != []) {
        //     if ($r->upazila_id) {
        //         $search_data['upazila_id'] = $r->upazila_id;
        //     }
        //     if ($r->union_code) {
        //         $search_data['union_id'] = $r->union_code;
        //     }
            
            

        //     // dd($data['attendance']);
        // }

        return view('reports.attendance', $data);
    }

    public function getEmployeeList(Request $r)
    {
        // dd($r->all());
        $data['employee'] =  Employee::where($r->all())->get();
        return response()->json($data);
    }

    public function letterSend(Request $r)
    {
        $data = [];

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

        $data['type'] = 1;
        $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        if ($r->upazila) {
            $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
        }
        if ($r->union) {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }

        // dd($union_ids);
        $data['letters'] = Letter::whereIn('union_id', $union_ids)->whereType(1)->whereIsActive(1)->get();
        return view('register.letter_send', $data);
    }

    public function letterReceive(Request $r)
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

        $data['type'] = 2;
        $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        if ($r->upazila) {
            $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
        }
        if ($r->union) {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }

        // dd($union_ids);
        $data['letters'] = Letter::whereIn('union_id', $union_ids)->whereType(2)->whereIsActive(1)->get();

        return view('register.letter_receive', $data);
    }

    public function assetRegister(Request $r)
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

        // $search_data['upazila_id'] = $r->upazila_id ?? auth()->user()->upazila;

        // if ($r->union_code) {
        //     $search_data['union_id'] = $r->union_code;
        // }

        $union_ids = UnionInformation::where('district_id', auth()->user()->district)->pluck('union_code')->toArray();
        if ($r->upazila) {
            $union_ids = UnionInformation::where('upazila_id', $r->upazila)->pluck('union_code')->toArray();
        }
        if ($r->union) {
            $union_ids = UnionInformation::where('union_code', $r->union)->pluck('union_code')->toArray();
        }

        $data['asset_register'] = AssetRegister::whereIn('union_id', $union_ids)->whereType(2)->whereIsActive(1)->get();

        return view('register.asset_register', $data);
    }
}
