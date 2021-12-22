@extends('layouts.app')

@section('content')
<style type="text/css">
.quick-manage {
    text-align: center;
    padding-bottom: 5px;
}

.icon_title {
    padding-bottom: 8px;
}

a:hover {
    color: #00b181;
}

.btn-success {
    color: #fff;
    background-color: #00AF80;
    border-color: #00AF80;
}
</style>

@role('super-admin')
<div class="row clearfix progress-box">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-blue text-white">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
                <div class="project-info-right">
                    <span class="no text-blue weight-500 font-24">{{ $union_count }}</span>
                    <p class="weight-400 font-18">মোট পৌরসভা</p>
                </div>
            </div>
            <div class="project-info-progress">
                <div class="row clearfix">
                    <div class="col-sm-6 text-muted weight-500">&nbsp;</div>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-light-green text-white">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                </div>
                <div class="project-info-right">
                    <span class="no text-light-green weight-500 font-24"> {{ $emp_count->total }} </span>
                    <p class="weight-400 font-18">মোট কর্মকর্তা</p>
                </div>
            </div>
            <div class="project-info-progress">
                <div class="row clearfix">
                    <div class="col-sm-6 text-muted weight-500">&nbsp;</div>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-light-green progress-bar-striped progress-bar-animated"
                        role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-light-orange text-white">
                        <i class="fa fa-list-alt"></i>
                    </div>
                </div>
                <div class="project-info-right">
                    <span class="no text-light-orange weight-500 font-24"> {{ $emp_count->sachib }} </span>
                    <p class="weight-400 font-18">মোট সচিব</p>
                </div>
            </div>
            <div class="project-info-progress">
                <div class="row clearfix">
                    <div class="col-sm-6 text-muted weight-500">&nbsp;</div>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-light-orange progress-bar-striped progress-bar-animated"
                        role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-light-purple text-white">
                        <i class="fa fa-podcast"></i>
                    </div>
                </div>
                <div class="project-info-right">
                    <span class="no text-light-purple weight-500 font-24">{{ $emp_count->udc }}</span>
                    <p class="weight-400 font-18">মোট উদ্যোক্তা</p>
                </div>
            </div>
            <div class="project-info-progress">
                <div class="row clearfix">
                    <div class="col-sm-6 text-muted weight-500">&nbsp;</div>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-light-purple progress-bar-striped progress-bar-animated"
                        role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@else

@cannot('super-admin')
<div class="row clearfix">

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">

        <div class="card box-shadow">
            <div class="card-header">
                দ্রুত পরিচালনা করুন
            </div>
            <div class="card-body">

                <div class="row">
                    @can('nagorik')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('nagorik_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/nagorik.png') }}" alt="image">
                                <p>নাগরিক <br> আবেদনকারীগন</p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                    @can('trade-license')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('trade_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/gallery.png') }}" alt="image">
                                <p>ট্রেড লাইসেন্স আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                    @can('warish')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('warish_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/profile.png') }}" alt="image">
                                <p>ওয়ারিশ <br>আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan

                    @can('paribarik')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('family_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/family.png') }}" alt="image">
                                <p>পারিবারিক আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                    @can('others-application')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('premises_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/premises.png') }}" alt="image">
                                <p>প্রিমিসেস <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan

                    @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('road_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/roadexcavation.png') }}" alt="image">
                                    <p>রাস্তা খনন ব্যবস্থাপনা <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                    
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('emarat_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/bulding.png') }}" alt="image">
                                    <p>ইমারত নির্মাণ ব্যবস্থাপনা <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
            
                        
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('land_use_application_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/landuse.png') }}" alt="image">
                                    <p>ভূমি ব্যবহার ব্যবস্থাপনা <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                       
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('newholding_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/holding.png') }}" alt="image">
                                    <p>নতুন হোল্ডিং ব্যবস্থাপনা <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                      
                      
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('holdingnamjari_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/holding.png') }}" alt="image">
                                    <p>নামজারী হোল্ডিং<br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                       
                        
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('animal_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/pets.png') }}" alt="image">
                                    <p>পোষা প্রাণী <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                       

                    @can('charittik')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('character_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/cherecter.png') }}" alt="image">
                                <p>চারিত্রিক <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                </div>


                <div class="collapse" id="collapseExample">
                    <div class="row">

                         @can('mirttu')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('death_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/death.png') }}" alt="image">
                                <p>মৃত্যু <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan

                    @can('obibahito')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('obibahito_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/obibahito.png') }}" alt="image">
                                <p>অবিবাহিত <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan

                    @can('bibahito')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('bibahito_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/married.png') }}" alt="image">
                                <p>বিবাহিত <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                    @can('punobibaho')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('punobibaho_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/notoremarry.png') }}" alt="image">
                                <p>পুনঃ বিবাহ না হওয়া <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                    @can('sonaton')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('sonaton_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/sonaton.png') }}" alt="image">
                                <p>সনাতন ধর্ম অবলম্বি <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan
                    @can('prottan')
                    @can('application')
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('prottyon_applicant_list') }}">
                                <img class="icon_title" src="{{ asset('images/icon/pottoyon.png') }}" alt="image">
                                <p>প্রত্যয়ন <br> আবেদনকারীগন </p>
                            </a>
                        </div>
                    </div>
                    @endcan
                    @endcan

                        @can('vumihin')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('vumihin_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/landless.png') }}" alt="image">
                                    <p>ভূমিহীন <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        @can('protibondi')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('protibondi_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/speechandhearing.png') }}" alt="image">
                                    <p>বাকঁ ও শ্রবন
                                        প্রতিবন্ধী <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan

                        @can('ekoinam')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('ekoinam_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/samename.png') }}" alt="image">
                                    <p>একই নামের প্রত্যয়ন <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        @can('barshikay')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('yearlyincome_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/yearlyincome.png') }}" alt="image">
                                    <p>বার্ষিক আয়ের সনদ <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        @can('onumoti')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('onumoti_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/parmited.png') }}" alt="image">
                                    <p>অনুমতি পত্র <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        @can('onumoti')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('onapotti_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/notpermited.png') }}" alt="image">
                                    <p>অনাপত্তি পত্র <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        @can('nodibanga')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('nodibanga_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/rivererosion.png') }}" alt="image">
                                    <p>নদী ভাঙনের <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        @can('voterid')
                        @can('application')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('voter_applicant_list') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/votarid.png') }}" alt="image">
                                    <p>ভোটার আইডি স্থানান্তর <br> আবেদনকারীগন </p>
                                </a>
                            </div>
                        </div>
                        @endcan
                        @endcan
                        
                    </div>
                </div>
                <div class="float-right">
                    <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    আরো দেখুন..
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">

        <div class="card box-shadow">
            <div class="card-header">
                একাউন্ট সমূহ
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('daily_deposit') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/cashin_small.png') }}"
                                        alt="image">
                                    <p>দৈনিক জমা</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('daily_expense') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/accounting.png') }}" alt="image">
                                    <p>দৈনিক খরচ </p>
                                </a>
                            </div>
                        </div>
                        {{-- @can('registers') --}}
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('cashbooks') }}">
                                    <img class="icon_title" src="{{ asset('images/icon/yearlyincome.png') }}" alt="image">
                                    <p>ক্যাশবুক</p>
                                </a>
                            </div>
                        </div>
                        {{-- @endcan --}}
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <img class="icon_title" src="{{ asset('images/icon/house.png') }}" alt="image">
                                <p><a href="{{ route('assesment_list') }}">বসত ভিটা</a> ও <a
                                        href="{{ route('collect_pesha_kor') }}"> পেশা জীবি কর </a>আদায় </p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('daily_deposit') }}" target="_blank">
                                    <img class="icon_title" src="{{ asset('images/icon/dailybank.png') }}" alt="image">
                                    <p> ব্যাংকের টাকা বিনিময় </p>
                                </a>
                            </div>
                        </div>

                        @can('everyday-reports')
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('daily_reports') }}" target="_blank">
                                    <img class="icon_title" src="{{ asset('images/icon/dailycollection.png') }}"
                                        alt="image">
                                    <p>দৈনিক কালেকশন রিপোর্ট </p>
                                </a>
                            </div>
                        </div>
                        @endcan

                        <!-- <div class="col-md-2 col-sm-2 col-xs-6">
                            <div class="quick-manage">
                                <a href="{{ route('daily_reports', 2) }}" target="_blank">
                                    <img class="icon_title" src="{{ asset('images/icon/daily_vat_collection.png') }}"
                                        alt="image">
                                    <p>দৈনিক ভ্যাট কালেকশন রিপোর্ট</p>
                                </a>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
    @can('registers')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">

        <div class="card box-shadow">
            <div class="card-header">
                রেজিষ্টার সমূহ
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('registers', 1) }}">
                                <img class="icon_title" src="{{ asset('images/icon/nagorik_register.png') }}"
                                    alt="image">
                                <p>নাগরিক রেজিষ্টার</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('registers', 19) }}">
                                <img class="icon_title" src="{{ asset('images/icon/traderegister.png') }}" alt="image">
                                <p>ট্রেড লাইসেন্স রেজিষ্টার</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('registers', 17) }}">
                                <img class="icon_title" src="{{ asset('images/icon/owarishregister.png') }}"
                                    alt="image">
                                <p>ওয়ারিশ রেজিষ্টার</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('registers', 21) }}">
                                <img class="icon_title" src="{{ asset('images/icon/taxregister.png') }}" alt="image">
                                <p>টেক্স আদায় রেজিষ্টার </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('registers', 22) }}">
                                <img class="icon_title" src="{{ asset('images/icon/assesmentreister.png') }}"
                                    alt="image">
                                <p>এসেসমেন্ট রেজিষ্টার</p>
                            </a>
                        </div>
                    </div>
                     <div class="col-md-2 col-sm-2 col-xs-6">
                        <div class="quick-manage">
                            <a href="{{ route('registers') }}">
                                <img class="icon_title" src="{{ asset('images/icon/bibidoregister.png') }}" alt="image">
                                <p>বিবিধ রেজিষ্টার</p>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="quick-manage">
                             <a href="javascript:void(0)" target="_blank">
                                <img class="icon_title" src="{{ asset('images/icon/incomeregister.png') }}" alt="image"
                >
                <p>আয়ের রেজিষ্টার</p>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6">
            <div class="quick-manage">
                <a href="javascript:void(0)" target="_blank">
                    <img class="icon_title" src="{{ asset('images/icon/bayregister.png') }}" alt="image">
                    <p>ব্যয়ের রেজিষ্টার</p>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6">
            <div class="quick-manage">
                <a href="javascript:void(0)" target="_blank">
                    <img class="icon_title" src="{{ asset('images/icon/bankregister.png') }}" alt="image">
                    <p>ব্যাংক রেজিষ্টার</p>
                </a>
            </div>
        </div>
    </div> --}}
</div>
</div>

</div>
@endcan

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">
    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <h4 class="mb-20">পরিসংখ্যান </h4>
        <ul class="list-group">
            @can('nagorik')
            @can('application')
            <a href="{{ route('nagorik_applicant_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    নতুন নাগরিক আবেদনকারী
                    <span class="badge badge-danger badge-pill">{{ $nagorik_application_total }}</span>
                </li>
            </a>
            @endcan
            @endcan

            @can('nagorik')
            @can('certificate')
            <a href="{{ route('certificate_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    মোট নাগরিক সনদ প্রদান
                    <span class="badge badge-info badge-pill">{{ $nagorik_certificate_total }}</span>
                </li>
            </a>
            @endcan
            @endcan

            @can('trade-license')
            @can('application')
            <a href="{{ route('trade_applicant_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    নতুন ট্রেড লাইসেন্স আবেদনকারী
                    <span class="badge badge-danger badge-pill">{{ $trade_application_total }}</span>
                </li>
            </a>
            @endcan
            @endcan
            @can('trade-license')
            @can('certificate')
            <a href="{{ route('trade_certificate_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    মোট ট্রেড লাইসেন্স প্রদান
                    <span class="badge badge-primary badge-pill">{{ $trade_certificate_total }}</span>
                </li>
            </a>
            @endcan
            @endcan

            @can('trade-license')
            <a href="">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    মেয়াদ উত্তীর্ণ ট্রেড লাইসেন্স
                    <span class="badge badge-warning badge-pill">{{ $trade_expire_total }}</span>
                </li>
            </a>
            @endcan
            @can('trade-license')
            <a href="">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ট্রেড লাইসেন্স নবায়ন আবেদন
                    <span class="badge badge-success badge-pill">{{ $trade_renew_total }}</span>
                </li>
            </a>
            @endcan

            @can('warish')
            @can('application')
            <a href="{{ route('warish_applicant_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    নতুন ওয়ারিশ সনদের আবেদনকারী
                    <span class="badge badge-danger badge-pill">{{ $oaris_application_total }}</span>
                </li>
            </a>
            @endcan
            @endcan

            @can('warish')
            @can('certificate')
            <a href="{{ route('warish_certificate_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    মেয়াদ উত্তীর্ণ ওয়ারিশ সনদ
                    <span class="badge badge-primary badge-pill">{{ $oaris_expired_total }}</span>
                </li>
            </a>
            @endcan
            @endcan

            @can('warish')
            @can('certificate')
            <a href="{{ route('warish_certificate_list') }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    মোট ওয়ারিশ সনদ প্রদান
                    <span class="badge badge-primary badge-pill">{{ $oaris_certificate_total }}</span>
                </li>
            </a>
            @endcan
            @endcan

        </ul>
    </div>
</div>

@can('accounts')
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">
    <div class="card box-shadow">
        <div class="card-header">
            একাউন্ট সমুহ
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="table-success">
                            <th width="45%">একাউন্টের নাম</th>
                            <th>একাউন্ট নং</th>
                            <th>টাকার পরিমান</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        <tr class="table-active">
                            <td>CASH ACCOUNT</td>
                            <td>{{ $accounts->cash_account->account_code }}</td>
                            <td>{{ $accounts->cash_account->amount }}</td>
                        </tr>
                        <tr class="table-primary">
                            <td>জন্ম নিবন্ধন </td>
                            <td>{{ $accounts->jonmo->account_code }}</td>
                            <td>{{ $accounts->jonmo->amount }}</td>
                        </tr>
                        <tr class="table-danger">
                            <td>মৃত্যু নিবন্ধন</td>
                            <td>{{ $accounts->mittu->account_code }}</td>
                            <td>{{ $accounts->mittu->amount }}</td>
                        </tr>

                        <tr class="table-secondary">
                            <td>নিজস্ব তহবিল</td>
                            <td>{{ $accounts->tohobil->account_code }}</td>
                            <td>{{ $accounts->tohobil->amount }}</td>
                        </tr>
                        <tr class="table-success">
                            <td>উন্নয়ন তহবিলঃ অ.দ.ক.ক</td>
                            <td>{{ $accounts->unnoun_tohobil->account_code }}</td>
                            <td>{{ $accounts->unnoun_tohobil->amount }}</td>
                        </tr>

                        <tr class="table">
                            <td></td>
                            <td>মোট</td>
                            <td>{{ $accounts->cash_account->amount + $accounts->jonmo->amount + $accounts->mittu->amount + $accounts->tohobil->amount + $accounts->unnoun_tohobil->amount }}/-
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endcan

</div>
@endcannot
@endrole

@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function() {

  
$('[data-toggle="collapse"]').click(function() {
  $(this).toggleClass( "active" );
  if ($(this).hasClass("active")) {
    $(this).text("কম দেখুন...");
  } else {
    $(this).text("আরো দেখুন...");
  }
});
  
  
// document ready  
});

</script>

@endsection