<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PublicService;
use App\Models\Allowance;
use App\Models\BdLocation;
use App\Models\Employee;
use App\Models\UnionInformation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        if (auth()->user()->type == 1 ) {
            return $this->district();
        } else if (auth()->user()->type ==2 || auth()->user()->type == 3) {
            return $this->district(auth()->user()->district);
        } else if (auth()->user()->type == 4) //uno
        {
            return $this->upazila(auth()->user()->upazila);
        }
    }

    public function district($district = null)
    {
        $data = [];

        $district_id = $district ?? auth()->user()->district;

        $union_ids = UnionInformation::where('district_id', $district_id)->pluck('union_code')->toArray();
        $public_service = PublicService::whereIn('union_id', $union_ids)->get();

        $data += [
            'nagoric' => (object)[
                'app' => 0,
                'certificate' => 0
            ],
            'trade' => (object)[
                'app' => 0,
                'certificate' => 0
            ],
            'warish' => (object)[
                'app' => 0,
                'certificate' => 0
            ],

        ];

        foreach ((object)$public_service as $item) {
            $data['nagoric']->app += ($item->nagorik_app + $item->unmarried_app + $item->married_app + $item->punobibaho_app + $item->same_name_appsonaton_app + $item->prottyon_app + $item->nodibanga_app + $item->yearly_income_app + $item->vumihin_app + $item->protibondi_app + $item->onumoti_app + $item->voter_transper_app + $item->onapotti_app + $item->road_cutting_app);

            $data['nagoric']->certificate += ($item->nagorik_certi + $item->unmarried_certi + $item->married_certi + $item->punobibaho_certi + $item->same_name_certisonaton_certi + $item->prottyon_certi + $item->nodibanga_certi + $item->yearly_income_certi + $item->vumihin_certi + $item->protibondi_certi + $item->onumoti_certi + $item->voter_transper_certi + $item->onapotti_certi + $item->road_cutting_certi);

            $data['trade']->app += $item->trade_certi;
            $data['trade']->certificate += $item->trade_certi;

            $data['warish']->app += $item->warish_certi;
            $data['warish']->certificate += $item->warish_certi;
        }

        $data += [
            'freedom_fighter' => Allowance::whereIn('union_id', $union_ids)->where('type', 1)->count(),
            'poor' => Allowance::whereIn('union_id', $union_ids)->where('type', 2)->count(),
            'old' => Allowance::whereIn('union_id', $union_ids)->where('type', 3)->count(),
            'motherhood' => Allowance::whereIn('union_id', $union_ids)->where('type', 4)->count(),
            'bidoba' => Allowance::whereIn('union_id', $union_ids)->where('type', 5)->count(),
            'protibondi' => Allowance::whereIn('union_id', $union_ids)->where('type', 6)->count(),
            'vgd' => Allowance::whereIn('union_id', $union_ids)->where('type', 7)->count(),
        ];

        $data += [
            'chairman' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 1)->count(),
            'sochib' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 2)->count(),
            'udc' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 3)->count(),
            'computer_operator' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 4)->count(),
            'member' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 5)->count(),
            'gram_police' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 6)->count()
        ];

        // ----------- upozila informations -----------
        $_GET['upazila'] = null;
        $_GET['union'] = null;

        // upazila
        BdLocation::where('parent_id', auth()->user()->district)->each(function ($item) {
            $_GET['union'] = null;
            // union
            UnionInformation::where(['upazila_id' => $item->id, 'is_active' => 1])->each(function ($el) {
                // DB::enableQueryLog();
                $el->total = PublicService::select(DB::raw('(SUM(trade_certi) +SUM(warish_certi)+SUM(family_certi )+SUM( nagorik_certi)+SUM( unmarried_certi)+SUM( married_certi)+SUM(punobibaho_certi )+SUM( same_name_certi)+SUM(sonaton_certi )+SUM(prottyon_certi )+SUM(nodibanga_certi )+SUM(yearly_income_certi )+SUM(vumihin_certi )+SUM(protibondi_certi )+SUM(onumoti_certi )+SUM(voter_transper_certi )+SUM(onapotti_certi )+SUM( road_cutting_certi)) as total'))->where('union_id', $el->union_code)->first()->total?? 0;
                // dd(DB::getQueryLog());
                // dd($el->total);

                $_GET['union'][] = $el;
            });

            $item->union = $_GET['union'];
            // dd($item->union);

            $_GET['upazila'][] = $item;
        });

        // dd($_GET['upazila']);
        $data['upazila'] = json_encode($_GET['upazila']);

        // dd(json_decode($data['upazila']));

        // dd($data);
        return view('dashboard.district', $data);
    }

    public function upazila($upazila)
    {

        if (auth()->user()->type > 3) {
            $upazila = auth()->user()->upazila;
        }

        $data = [];

        $union_ids = UnionInformation::where('upazila_id',$upazila)->pluck('union_code')->toArray();
        $public_service = PublicService::whereIn('union_id', $union_ids)->get();
        // dd($public_service);
        $data += [
            'nagoric' => (object)[
                'app' => 0,
                'certificate' => 0
            ],
            'trade' => (object)[
                'app' => 0,
                'certificate' => 0
            ],
            'warish' => (object)[
                'app' => 0,
                'certificate' => 0
            ],
        ];

        foreach ((object)$public_service as $item) {
            $data['nagoric']->app += ($item->nagorik_app + $item->unmarried_app + $item->married_app + $item->punobibaho_app + $item->same_name_appsonaton_app + $item->prottyon_app + $item->nodibanga_app + $item->yearly_income_app + $item->vumihin_app + $item->protibondi_app + $item->onumoti_app + $item->voter_transper_app + $item->onapotti_app + $item->road_cutting_app );

            $data['nagoric']->certificate += ($item->nagorik_certi + $item->unmarried_certi + $item->married_certi + $item->punobibaho_certi + $item->same_name_certisonaton_certi + $item->prottyon_certi + $item->nodibanga_certi + $item->yearly_income_certi + $item->vumihin_certi + $item->protibondi_certi + $item->onumoti_certi + $item->voter_transper_certi + $item->onapotti_certi + $item->road_cutting_certi);

            $data['trade']->app += $item->trade_certi;
            $data['trade']->certificate += $item->trade_certi;

            $data['warish']->app += $item->warish_certi;
            $data['warish']->certificate += $item->warish_certi;

        }

        $data += [
            'freedom_fighter' => Allowance::whereIn('union_id', $union_ids)->where('type', 1)->count(),
            'poor' => Allowance::whereIn('union_id', $union_ids)->where('type', 2)->count(),
            'old' => Allowance::whereIn('union_id', $union_ids)->where('type', 3)->count(),
            'motherhood' => Allowance::whereIn('union_id', $union_ids)->where('type', 4)->count(),
            'bidoba' => Allowance::whereIn('union_id', $union_ids)->where('type', 5)->count(),
            'protibondi' => Allowance::whereIn('union_id', $union_ids)->where('type', 6)->count(),
            'vgd' => Allowance::whereIn('union_id', $union_ids)->where('type', 7)->count(),
        ];

        $data += [
            'chairman' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 1)->count(),
            'sochib' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 2)->count(),
            'udc' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 3)->count(),
            'computer_operator' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 4)->count(),
            'member' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 5)->count(),
            'gram_police' => Employee::whereIn('union_id', $union_ids)->where('designation_id', 6)->count()
        ];


        $union = UnionInformation::where(['upazila_id' => $upazila, 'is_active' => 1])->get();

        // DB::enableQueryLog();

        foreach ($union as $item) {
            $item->trade = (object)[
                'app' => PublicService::select(DB::raw('SUM(trade_app) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,
                'certificate_today' => PublicService::select(DB::raw('SUM(trade_certi) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,
                'certificate' => PublicService::select(DB::raw('SUM(trade_certi) as total'))->where('union_id', $item->union_code)->first()->total
            ];

            $item->nagorik = (object)[
                'app' => PublicService::select(DB::raw('(SUM(nagorik_app)+SUM( unmarried_app)+SUM( married_app)+SUM(punobibaho_app )+SUM( same_name_app)+SUM(sonaton_app )+SUM(prottyon_app )+SUM(nodibanga_app )+SUM(yearly_income_app )+SUM(vumihin_app )+SUM(protibondi_app )+SUM(onumoti_app )+SUM(voter_transper_app )+SUM(onapotti_app )+SUM( road_cutting_app)) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,

                'certificate_today' => PublicService::select(DB::raw('(SUM( nagorik_certi)+SUM( unmarried_certi)+SUM( married_certi)+SUM(punobibaho_certi )+SUM( same_name_certi)+SUM(sonaton_certi )+SUM(prottyon_certi )+SUM(nodibanga_certi )+SUM(yearly_income_certi )+SUM(vumihin_certi )+SUM(protibondi_certi )+SUM(onumoti_certi )+SUM(voter_transper_certi )+SUM(onapotti_certi )+SUM( road_cutting_certi)) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,

                'certificate' => PublicService::select(DB::raw('(SUM( nagorik_certi)+SUM( unmarried_certi)+SUM( married_certi)+SUM(punobibaho_certi )+SUM( same_name_certi)+SUM(sonaton_certi )+SUM(prottyon_certi )+SUM(nodibanga_certi )+SUM(yearly_income_certi )+SUM(vumihin_certi )+SUM(protibondi_certi )+SUM(onumoti_certi )+SUM(voter_transper_certi )+SUM(onapotti_certi )+SUM( road_cutting_certi)) as total'))->where('union_id', $item->union_code)->first()->total
            ];
            // dd($item->nagorik);
            // dd(DB::getQueryLog());

            $item->warish = (object)[
                'app' => PublicService::select(DB::raw('SUM(warish_app) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,
                'certificate_today' => PublicService::select(DB::raw('SUM(warish_certi) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,
                'certificate' => PublicService::select(DB::raw('SUM(warish_certi) as total'))->where('union_id', $item->union_code)->first()->total
            ];

            $item->family = (object)[
                'app' => PublicService::select(DB::raw('SUM(family_app) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,
                'certificate_today' => PublicService::select(DB::raw('SUM(family_certi) as total'))->where('union_id', $item->union_code)->where('created_at', 'like', date('Y-m-d') . ' %')->first()->total,
                'certificate' => PublicService::select(DB::raw('SUM(family_certi) as total'))->where('union_id', $item->union_code)->first()->total
            ];

            $item->today_total = PublicService::select(DB::raw('SUM(total_amount) as total'))->where('union_id', $item->union_code)->where('created_at','like', date('Y-m-d').'%')->first()->total;
            $item->total = PublicService::select(DB::raw('SUM(total_amount) as total'))->where('union_id', $item->union_code)->first()->total;
        }
        $data['union'] = $union;

        // dd($data);

        return view('dashboard.upazila', $data);
    }

    public function allowance($upazila)
    {
        if (auth()->user()->type > 3) {
            $upazila = auth()->user()->upazila;
        }
        
        $data['union'] = UnionInformation::where(['upazila_id' => $upazila, 'is_active' => 1])->get();
        
        foreach ($data['union'] as $item) {

            $serch_data = ['union_id' => $item->union_code];

            $item->freedom =Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 1])->first();
            $item->poor = Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 2])->first();
            $item->old = Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 3])->first();
            $item->motherhood = Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 4])->first();
            $item->bidoba = Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 5])->first();
            $item->protibondi = Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 6])->first();
            $item->vgd = Allowance::select(DB::raw('count(*) as total,sum(amount_of_allowance) as amount'))->where($serch_data)->where(['type' => 7])->first();

        }

        // dd($data);

        return view('dashboard.allowance', $data);
    }
}
