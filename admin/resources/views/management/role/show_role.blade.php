@extends('layouts.app')
@section('head')
    <style>
        .sitemap-border-0, .sitemap-border-0  ul li::after{
            border: none;
        }
    </style>
@endsection
@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
            <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> Role Name: <span class="badge badge-info">{{ str_replace("_".auth()->user()->union_id, "", $role->name) }}</span></h4>
            </div>
            <a href="{{ route('role') }}" class="btn btn-info float-right"><i class="icon-copy fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
    </div>
</div>

<div class="mb-30 mt-30">
    <div class="pb-20">

        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 offset-2 p-3 border border-primary">
                <h5 class="weight-500 text-center pb-3">Application Basic Permissions</h5>
                <div class="row border-top border-primary">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <h5 class="weight-500">সনদ সমূহের</h5>
                            <ul>
                                @if(isset($permissions['application']))
                                <li><a href="javascript:void(0)">আবেদন লিস্ট</a></li>
                                @endif
                                @if(isset($permissions['certificate']))
                                <li><a href="javascript:void(0)">সার্টিফিকেট লিস্ট</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <h5 class="weight-500">সনদ সমূহ</h5>
                            <ul>
                                @if(isset($permissions['edit']))
                                <li><a href="javascript:void(0)">এডিট</a></li>
                                @endif
                                @if(isset($permissions['delete']))
                                <li><a href="javascript:void(0)">ডিলিট</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <h5 class="weight-500">সনদ সমূহ</h5>
                            <ul>
                                @if(isset($permissions['generate']))
                                <li><a href="javascript:void(0)">জেনারেট</a></li>
                                @endif
                                @if(isset($permissions['regenerate']))
                                <li><a href="javascript:void(0)">রিজেনারেট</a></li>
                                @endif
                                @if(isset($permissions['invoice']))
                                <li><a href="javascript:void(0)">রশিদ প্রদান</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-1 border border-primary mt-5">
                <h5 class="weight-500 text-center p-3">Application Permissions</h5>
                <div class="row border-top border-primary">
                    @if(isset($permissions['nagorik']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <ul>
                            <li class="mt-2"><a href="{{ route('nagorik_application') }}">নাগরিক ব্যবস্থাপনা</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['trade-license']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <ul>
                            <li class="mt-2"><a href="{{ route('trade_application') }}">ট্রেড লাইসেন্স ব্যবস্থাপনা</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['warish']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <ul>
                            <li class="mt-2"><a href="{{ route('warish_application') }}">ওয়ারিশ ব্যবস্থাপনা</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['paribarik']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <ul>
                            <li class="mt-2"><a href="{{ route('family_application') }}">পারিবারিক ব্যবস্থাপনা</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['premises']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap sitemap-border-0">
                            <ul>
                            <li class="mt-2"><a href="{{ route('premises_application') }}">প্রিমিসেস ব্যবস্থাপনা</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>

                @if(isset($permissions['others-application']))
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="weight-500 text-center text-blue">Others Application</h5>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="sitemap sitemap-border-0">
                                    <ul>
                                        @if(isset($permissions['charittik']))
                                        <li class="mt-2"><a href="{{ route('character_application') }}">চারিত্রিক সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['mirttu']))
                                        <li class="mt-2"><a href="{{ route('death_application') }}">মৃত্যু সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['obibahito']))
                                        <li class="mt-2"><a href="{{ route('obibahito_application') }}">অবিবাহিত সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['bibahito']))
                                        <li class="mt-2"><a href="{{ route('bibahito_application') }}">বিবাহিত সনদ</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="sitemap sitemap-border-0">
                                    <ul>
                                        @if(isset($permissions['punobibaho']))
                                        <li class="mt-2"><a href="{{ route('punobibaho_application') }}">পুনঃবিবাহ না হওয়া সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['sonaton']))
                                        <li class="mt-2"><a href="{{ route('sonatondhormo_application') }}">সনাতন ধর্ম সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['prottan']))
                                        <li class="mt-2"><a href="{{ route('prottyon_application') }}">প্রত্যয়ন পত্র</a></li>
                                        @endif
                                        @if(isset($permissions['vumihin']))
                                        <li class="mt-2"><a href="{{ route('vumihin_application') }}">ভূমিহিন সনদ</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="sitemap sitemap-border-0">
                                    <ul>
                                        @if(isset($permissions['protibondi']))
                                        <li class="mt-2"><a href="{{ route('protibondi_application') }}">প্রতিবন্ধি সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['ekoinam']))
                                        <li class="mt-2"><a href="{{ route('ekoinam_application') }}">একইনাম সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['barshikay']))
                                        <li class="mt-2"><a href="{{ route('yearlyincome_application') }}">বার্ষিক আয়ের প্রত্যয়ন</a></li>
                                        @endif
                                        @if(isset($permissions['onumoti']))
                                        <li class="mt-2"><a href="{{ route('onumoti_application') }}">অনুমতি পত্র</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="sitemap sitemap-border-0">
                                    <ul>
                                        @if(isset($permissions['nodibanga']))
                                        <li class="mt-2"><a href="{{ route('nodibanga_application') }}">নদীভাঙ্গনের সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['voterid']))
                                        <li class="mt-2"><a href="{{ route('voter_application') }}">ভোটার আইডি স্থানান্তর সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['onapotti']))
                                        <li class="mt-2"><a href="javascript:void(0)">রাস্তা খনন সনদ</a></li>
                                        @endif
                                        @if(isset($permissions['rashta-khanon']))
                                        <li class="mt-2"><a href="javascript:void(0)">অনাপত্তি সনদ</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(isset($permissions['website-management']))
        <div class="row">
            <div class="col-md-10 offset-1 border border-primary mt-5">
                <h5 class="weight-500 text-center p-3">Website Management Permissions</h5>
                <div class="row p-3 border-top border-primary">
                    @if(isset($permissions['employee-list']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap">
                        <h5 class="weight-500"><a href="{{ route('all_members') }}"> কর্মকর্তা-কর্মচারী</a></h5>
                            <ul>
                                @if(isset($permissions['add-employee']))
                                <li><a href="javascript:void(0)">নতুন যোগ করা</a></li>
                                @endif
                                @if(isset($permissions['view-employee']))
                                <li><a href="javascript:void(0)">ভিউ প্রোফাইল</a></li>
                                @endif
                                @if(isset($permissions['edit-employee']))
                                <li><a href="javascript:void(0)">এডিট</a></li>
                                @endif
                                @if(isset($permissions['delete-employee']))
                                <li><a href="javascript:void(0)">ডিলিট</a></li>
                                @endif
                                @if(isset($permissions['employee-status']))
                                <li><a href="javascript:void(0)">স্টেটাস পরিবর্তন করা</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['notice-list']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap">
                        <h5 class="weight-500"><a href="{{ route('all_up_notice') }}"> নোটিশ</a></h5>
                            <ul>
                                @if(isset($permissions['add-notice']))
                                <li><a href="javascript:void(0)">নতুন যোগ করা</a></li>
                                @endif
                                @if(isset($permissions['edit-notice']))
                                <li><a href="javascript:void(0)">এডিট</a></li>
                                @endif
                                @if(isset($permissions['delete-notice']))
                                <li><a href="javascript:void(0)">ডিলিট</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['slider-list']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap">
                        <h5 class="weight-500"><a href="{{ route('slider') }}"> স্লাইডার</a></h5>
                            <ul>
                                @if(isset($permissions['add-slide']))
                                <li><a href="javascript:void(0)">নতুন যোগ করা</a></li>
                                @endif
                                @if(isset($permissions['edit-slide']))
                                <li><a href="javascript:void(0)">এডিট</a></li>
                                @endif
                                @if(isset($permissions['delete-slide']))
                                <li><a href="javascript:void(0)">ডিলিট</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($permissions['vata-list']))
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="sitemap">
                        <h5 class="weight-500"><a href="javascript:void(0)"> ভাতার তালিকা</a></h5>
                            <ul>
                                @if(isset($permissions['add-vata']))
                                <li><a href="{{ route('add-allowance') }}">ভাতার তালিকা যোগ করা</a></li>
                                @endif
                                @if(isset($permissions['edit-vata']))
                                <li><a href="javascript:void(0)">এডিট</a></li>
                                @endif
                                @if(isset($permissions['vata-payment']))
                                <li><a href="javascript:void(0)">ভাতা প্রদান করা</a></li>
                                @endif
                                @if(isset($permissions['vata-profile']))
                                <li><a href="javascript:void(0)">ভাতা গ্রহীতার প্রোফাইল</a></li>
                                @endif
                                @if(isset($permissions['vata-card-print']))
                                <li><a href="javascript:void(0)">আইডি প্রিন্ট</a></li>
                                @endif
                                @if(isset($permissions['delete-vata']))
                                <li><a href="javascript:void(0)">ডিলিট</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if(isset($permissions['accounts']))
        <div class="row">
            <div class="col-md-10 offset-1 border border-primary mt-5">
                <h5 class="weight-500 text-center p-3">Accounts Permissions</h5>
                <div class="row p-3 border-top border-primary">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="sitemap">
                            @if(isset($permissions['registers']))
                            <h5 class="weight-500"><a href="{{ route('registers') }}">রেজিষ্টার সমূহ</a></h5>
                            @endif
                            @if(isset($permissions['tax']))
                            <h5 class="weight-500"><a href="javascript:void(0)">কর আদায়</a></h5>
                            <ul>
                                <li class="child">
                                    @if(isset($permissions['income-tax']))
                                    <h5 class="weight-500"><a href="{{ route('collect_pesha_kor') }}">পেশা কর</a></h5>
                                    <ul>
                                        @if(isset($permissions['add-income-tax']))
                                        <li><a href="javascript:void(0)">কর আদায়</a></li>
                                        @endif
                                        @if(isset($permissions['income-tax-invoice']))
                                        <li><a href="javascript:void(0)">রশিদ প্রদান</a></li>
                                        @endif
                                    </ul>
                                    @endif

                                    @if(isset($permissions['home-tax']))
                                    <h5 class="weight-500"><a href="{{ route('assesment_list') }}">বসত ভিটা</a></h5>
                                    <ul>
                                        @if(isset($permissions['add-home']))
                                        <li><a href="javascript:void(0)">বসতভিটা যোগ করা</a></li>
                                        @endif
                                        @if(isset($permissions['add-home-tax']))
                                        <li><a href="javascript:void(0)">কর আদায়</a></li>
                                        @endif
                                        @if(isset($permissions['edit-home']))
                                        <li><a href="javascript:void(0)">এডিট</a></li>
                                        @endif
                                        @if(isset($permissions['delete-home']))
                                        <li><a href="javascript:void(0)">ডিলিট</a></li>
                                        @endif
                                        @if(isset($permissions['home-tax-invoice']))
                                        <li><a href="javascript:void(0)">রশিদ প্রদান</a></li>
                                        @endif
                                    </ul>
                                    @endif
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="sitemap">
                            @if(isset($permissions['everyday-reports']))
                            <h5 class="weight-500"><a href="{{ route('daily_reports') }}">দৈনিক রিপোর্ট সমূহ</a></h5>
                            @endif

                            @if(isset($permissions['accounts-setting']))
                            <h5 class="weight-500"><a href="javascript:void(0)">সেটিংস</a></h5>
                            <ul>
                                <li class="child">
                                    @if(isset($permissions['add-accounts']))
                                    <h5 class="weight-500"><a href="{{ route('account_list') }}">একাউন্ট যোগ করা</a></h5>
                                    <ul>
                                        @if(isset($permissions['add-accounts']))
                                        <li><a href="javascript:void(0)">নতুন যোগ করা</a></li>
                                        @endif
                                        @if(isset($permissions['edit-accounts']))
                                        <li><a href="javascript:void(0)">এডিট</a></li>
                                        @endif
                                        @if(isset($permissions['delete-accounts']))
                                        <li><a href="javascript:void(0)">ডিলিট</a></li>
                                        @endif
                                    </ul>
                                    @endif
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($permissions['setting']))
        <div class="row">
            <div class="col-md-10 offset-1 border border-primary mt-5">
                <h5 class="weight-500 text-center p-3">Setting Permissions</h5>
                <div class="row p-3 border-top border-primary">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        @if(isset($permissions['union-setup']))
                        <div class="sitemap">
                            <h5 class="weight-500"><a href="{{ route('union_setup') }}">পৌরসভা সেটআপ</a></h5>
                            <ul>
                                @if(isset($permissions['union-profile']))
                                <li><a href="javascript:void(0)">প্রোফাইল</a></li>
                                @endif
                                @if(isset($permissions['edit-union']))
                                <li><a href="javascript:void(0)">এডিট</a></li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        @if(isset($permissions['role-setup']))
                        <div class="sitemap">
                            <h5 class="weight-500"><a href="{{ route('role') }}">রোল সেটআপ</a></h5>
                            <ul>
                                @if(isset($permissions['create-role']))
                                <li><a href="javascript:void(0)">রোল বানানো</a></li>
                                @endif
                                @if(isset($permissions['show-role']))
                                <li><a href="javascript:void(0)">রোল দেখা</a></li>
                                @endif
                                @if(isset($permissions['delete-role']))
                                <li><a href="javascript:void(0)">ডিলিট</a></li>
                                @endif
                                @if(isset($permissions['assign-role']))
                                <li><a href="javascript:void(0)">এসাইন রোল</a></li>
                                @endif
                                @if(isset($permissions['reset-all-role']))
                                <li><a href="javascript:void(0)">সকল রোল রিসেট করা</a></li>
                                @endif
                                @if(isset($permissions['assigned-role']))
                                <li><a href="javascript:void(0)">নির্ধারিত রোল</a></li>
                                @endif
                                @if(isset($permissions['reset-role']))
                                <li><a href="javascript:void(0)">কর্মকর্তার রোল রিসেট করা</a></li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
