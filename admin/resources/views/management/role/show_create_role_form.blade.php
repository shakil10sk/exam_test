@extends('layouts.app')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.steps.min.css') }}">
@endsection
@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> রোল সেটআপ</h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix">
                <h4 class="text-blue">Create Custom Role:</h4>
            </div>
            <div class="wizard-content">
            <form id="role-form" action="{{ route('create_role') }}" method="POST" class="tab-wizard wizard-circle wizard">
                    <h5>Application Basic Permissions</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('roleName') has-danger @enderror" id="roleLabel">
                                    @csrf
                                    <label for="roleName">Role Name :</label>
                                    <input type="text" name="roleName" id="roleName" placeholder="রোল প্রদান করুন..." class="form-control @error('roleName') form-control-danger @enderror" required data-parsley-required>
                                </div>
                                <div class="form-control-feedback has-danger" id="roleError"></div>
                                @error('roleName')
                                <div class="form-control-feedback has-danger roleError">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 offset-2">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="application" name="application">
                                            <label class="custom-control-label" for="application">সনদসমূহের আবেদনের লিস্ট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="certificate" name="certificate">
                                            <label class="custom-control-label" for="certificate">সনদসমূহের সার্টিফিকেট লিস্ট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="generate" name="generate">
                                            <label class="custom-control-label" for="generate">সনদসমূহের জেনারেট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="all-reports" name="all-reports">
                                            <label class="custom-control-label" for="all-reports">সকল রিপোর্ট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="everyday-attendance-report" name="everyday-attendance-report">
                                            <label class="custom-control-label" for="everyday-attendance-report">দৈনিক হাজিরা রিপোর্ট</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="edit" name="edit">
                                            <label class="custom-control-label" for="edit">সনদসমূহের এডিট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="delete" name="delete">
                                            <label class="custom-control-label" for="delete">সনদসমূহের ডিলিট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="regenerate" name="regenerate">
                                            <label class="custom-control-label" for="regenerate">সনদসমূহের রিজেনারেট</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="invoice" name="invoice">
                                            <label class="custom-control-label" for="invoice">সনদসমূহের রশিদ প্রদান</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h5>Applications Permiission</h5>
                    <section style="overflow-y: auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="nagorik" name="nagorik">
                                    <label class="custom-control-label" for="nagorik">নাগরিক ব্যবস্থাপনা</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="trade-license" name="trade-license">
                                    <label class="custom-control-label" for="trade-license">ট্রেড লাইসেন্স ব্যবস্থাপনা</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="warish" name="warish">
                                    <label class="custom-control-label" for="warish">ওয়ারিশ ব্যবস্থাপনা</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="paribarik" name="paribarik">
                                    <label class="custom-control-label" for="paribarik">পারিবারিক ব্যবস্থাপনা</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="premises" name="premises">
                                    <label class="custom-control-label" for="premises">প্রিমিসেস ব্যবস্থাপনা</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 m-auto">
                                <div class="custom-control custom-checkbox mb-5" data-toggle="collapse" data-target="#others-application-collapse" aria-expanded="false" aria-controls="others-application">
                                    <input type="checkbox" class="custom-control-input" id="others-application" name="others-application">
                                    <label class="custom-control-label weight-600 text-blue" for="others-application">অন্যান্য সনদ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 m-auto collapse border rounded" id="others-application-collapse">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox mt-3 float-right">
                                            <input type="checkbox" class="custom-control-input" id="mark-app">
                                            <label class="custom-control-label" for="mark-app">Mark all</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="charittik" name="charittik">
                                            <label class="custom-control-label" for="charittik">চারিত্রিক সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="mirttu" name="mirttu">
                                            <label class="custom-control-label" for="mirttu">মৃত্যু সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="obibahito" name="obibahito">
                                            <label class="custom-control-label" for="obibahito">অবিবাহিত সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="bibahito" name="bibahito">
                                            <label class="custom-control-label" for="bibahito">বিবাহিত সনদ</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="punobibaho" name="punobibaho">
                                            <label class="custom-control-label" for="punobibaho">পুনঃবিবাহ না হওয়া সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="sonaton" name="sonaton">
                                            <label class="custom-control-label" for="sonaton">সনাতন ধর্ম সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="prottan" name="prottan">
                                            <label class="custom-control-label" for="prottan">প্রত্যয়ন পত্র</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="vumihin" name="vumihin">
                                            <label class="custom-control-label" for="vumihin">ভূমিহিন সনদ</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="protibondi" name="protibondi">
                                            <label class="custom-control-label" for="protibondi">প্রতিবন্ধি সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="ekoinam" name="ekoinam">
                                            <label class="custom-control-label" for="ekoinam">একইনাম সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="barshikay" name="barshikay">
                                            <label class="custom-control-label" for="barshikay">বার্ষিক আয়ের প্রত্যয়ন</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="onumoti" name="onumoti">
                                            <label class="custom-control-label" for="onumoti">অনুমতি পত্র</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="nodibanga" name="nodibanga">
                                            <label class="custom-control-label" for="nodibanga">নদীভাঙ্গনের সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="voterid" name="voterid">
                                            <label class="custom-control-label" for="voterid">ভোটার আইডি স্থানান্তর সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="rashta-khanon" name="rashta-khanon">
                                            <label class="custom-control-label" for="rashta-khanon">রাস্তা খনন সনদ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="onapotti" name="onapotti">
                                            <label class="custom-control-label" for="onapotti">অনাপত্তি সনদ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Website Management Permissions</h5>
                    <section style="overflow-y: auto">
                        <div class="row">
                            <div class="col-md-11 m-auto border rounded">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox mt-3 float-right">
                                            <input type="checkbox" class="custom-control-input" id="mark-web" data-toggle="collapse" href=".multi-collapse" aria-expanded="false">
                                            <label class="custom-control-label" for="mark-web">Mark all</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-2">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="website-management" name="website-management">
                                            <label class="custom-control-label weight-600" for="website-management">ওয়েবসাইট ম্যানেজমেন্ট</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="employee-list" name="employee-list" data-toggle="collapse" href="#employee-list-collapse" aria-expanded="false" aria-controls="employee-list-collapse">
                                            <label class="custom-control-label weight-600" for="employee-list"> কর্মকর্তা-কর্মচারী</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-2 collapse multi-collapse" id="employee-list-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="add-employee" name="add-employee">
                                                    <label class="custom-control-label" for="add-employee">নতুন যোগ করা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="view-employee" name="view-employee">
                                                    <label class="custom-control-label" for="view-employee">ভিউ প্রোফাইল</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="edit-employee" name="edit-employee">
                                                    <label class="custom-control-label" for="edit-employee">এডিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="delete-employee" name="delete-employee">
                                                    <label class="custom-control-label" for="delete-employee">ডিলিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="employee-status" name="employee-status">
                                                    <label class="custom-control-label" for="employee-status">স্টেটাস পরিবর্তন করা</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="notice-list" name="notice-list" data-toggle="collapse" href="#notice-list-collapse" aria-expanded="false" aria-controls="notice-list-collapse">
                                            <label class="custom-control-label weight-600" for="notice-list"> নোটিশ</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-2 collapse multi-collapse" id="notice-list-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="add-notice" name="add-notice">
                                                    <label class="custom-control-label" for="add-notice">নতুন যোগ করা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="edit-notice" name="edit-notice">
                                                    <label class="custom-control-label" for="edit-notice">এডিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="delete-notice" name="delete-notice">
                                                    <label class="custom-control-label" for="delete-notice">ডিলিট</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="slider-list" name="slider-list" data-toggle="collapse" href="#slider-list-collapse" aria-expanded="false" aria-controls="slider-list-collapse">
                                            <label class="custom-control-label weight-600" for="slider-list"> স্লাইডার</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-2 collapse multi-collapse" id="slider-list-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="add-slide" name="add-slide">
                                                    <label class="custom-control-label" for="add-slide">নতুন যোগ করা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="edit-slide" name="edit-slide">
                                                    <label class="custom-control-label" for="edit-slide">এডিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="delete-slide" name="delete-slide">
                                                    <label class="custom-control-label" for="delete-slide">ডিলিট</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="vata-list" name="vata-list" data-toggle="collapse" href="#vata-list-collapse" aria-expanded="false" aria-controls="vata-list-collapse">
                                            <label class="custom-control-label weight-600" for="vata-list"> ভাতার তালিকা</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-2 collapse multi-collapse" id="vata-list-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="add-vata" name="add-vata">
                                                    <label class="custom-control-label" for="add-vata">অ্যাড ভাতার তালিকা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="edit-vata" name="edit-vata">
                                                    <label class="custom-control-label" for="edit-vata">এডিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="vata-payment" name="vata-payment">
                                                    <label class="custom-control-label" for="vata-payment">ভাতা প্রদান করা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="vata-profile" name="vata-profile">
                                                    <label class="custom-control-label" for="vata-profile">ভাতা গ্রহীতার প্রোফাইল</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="vata-card-print" name="vata-card-print">
                                                    <label class="custom-control-label" for="vata-card-print">আইডি প্রিন্ট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="delete-vata" name="delete-vata">
                                                    <label class="custom-control-label" for="delete-vata">ডিলিট</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 4 -->
                    <h5>Accounts Permissions</h5>
                    <section style="overflow-y: auto">
                        <div class="row">
                            <div class="col-md-11 m-auto border rounded">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox mt-3 float-right">
                                            <input type="checkbox" class="custom-control-input" id="mark-accounts" data-toggle="collapse" href=".accounts-multi-collapse" aria-expanded="false">
                                            <label class="custom-control-label" for="mark-accounts">Mark all</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-2">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="accounts" name="accounts">
                                            <label class="custom-control-label weight-600" for="accounts">একাউন্টস</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="registers" name="registers">
                                            <label class="custom-control-label weight-600" for="registers">রেজিষ্টার সমূহ</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="tax" name="tax" data-toggle="collapse" href="#tax-collapse" aria-expanded="false" aria-controls="tax-collapse">
                                            <label class="custom-control-label weight-600" for="tax">কর আদায়</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-1 collapse accounts-multi-collapse" id="tax-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="income-tax" name="income-tax" data-toggle="collapse" href="#income-tax-collapse" aria-expanded="false" aria-controls="income-tax-collapse">
                                                    <label class="custom-control-label" for="income-tax">পেশা কর</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-10 offset-1 collapse accounts-multi-collapse" id="income-tax-collapse">
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="add-income-tax" name="add-income-tax">
                                                            <label class="custom-control-label" for="add-income-tax">কর আদায়</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="income-tax-invoice" name="income-tax-invoice">
                                                            <label class="custom-control-label" for="income-tax-invoice">রশিদ প্রদান</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="home-tax" name="home-tax" data-toggle="collapse" href="#home-tax-collapse" aria-expanded="false" aria-controls="home-tax-collapse">
                                                    <label class="custom-control-label" for="home-tax">বসত ভিটা</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-10 offset-1 collapse accounts-multi-collapse" id="home-tax-collapse">
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="add-home" name="add-home">
                                                            <label class="custom-control-label" for="add-home">বসতভিটা যোগ করা</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="add-home-tax" name="add-home-tax">
                                                            <label class="custom-control-label" for="add-home-tax">কর আদায়</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="edit-home" name="edit-home">
                                                            <label class="custom-control-label" for="edit-home">এডিট</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="home-tax-invoice" name="home-tax-invoice">
                                                            <label class="custom-control-label" for="home-tax-invoice">রশিদ প্রদান</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-5">
                                                            <input type="checkbox" class="custom-control-input" id="delete-home" name="delete-home">
                                                            <label class="custom-control-label" for="delete-home">ডিলিট</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="everyday-reports" name="everyday-reports">
                                            <label class="custom-control-label weight-600" for="everyday-reports">দৈনিক রিপোর্ট সমূহ</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="accounts-setting" name="accounts-setting" data-toggle="collapse" href="#accounts-setting-collapse" aria-expanded="false" aria-controls="accounts-setting-collapse">
                                            <label class="custom-control-label weight-600" for="accounts-setting">সেটিংস</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-2 collapse accounts-multi-collapse" id="accounts-setting-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="add-accounts" name="add-accounts">
                                                    <label class="custom-control-label" for="add-accounts">একাউন্ট যোগ করা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="edit-accounts" name="edit-accounts">
                                                    <label class="custom-control-label" for="edit-accounts">এডিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="delete-accounts" name="delete-accounts">
                                                    <label class="custom-control-label" for="delete-accounts">ডিলিট</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 5 -->
                    <h5>Setting Permissions</h5>
                    <section style="overflow-y: auto">
                        <div class="row">
                            <div class="col-md-11 m-auto border rounded">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox mt-3 float-right">
                                            <input type="checkbox" class="custom-control-input" id="mark-setting" data-toggle="collapse" href=".setting-multi-collapse" aria-expanded="false">
                                            <label class="custom-control-label" for="mark-setting">Mark all</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-2">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="setting" name="setting">
                                            <label class="custom-control-label weight-600" for="setting">সেটিং</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="union-setup" name="union-setup" data-toggle="collapse" href="#union-setup-collapse" aria-expanded="false" aria-controls="union-setup-collapse">
                                            <label class="custom-control-label weight-600" for="union-setup">পৌরসভা সেটআপ</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 offset-2 collapse setting-multi-collapse" id="union-setup-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="union-profile" name="union-profile">
                                                    <label class="custom-control-label" for="union-profile">প্রোফাইল</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="edit-union" name="edit-union">
                                                    <label class="custom-control-label" for="edit-union">এডিট</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-3">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="role-setup" name="role-setup" data-toggle="collapse" href="#role-list-collapse" aria-expanded="false" aria-controls="role-list-collapse">
                                            <label class="custom-control-label weight-600" for="role-setup">রোল সেটআপ</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-10 offset-2 collapse setting-multi-collapse" id="role-list-collapse">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="create-role" name="create-role">
                                                    <label class="custom-control-label" for="create-role">রোল বানানো</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="role-list" name="role-list">
                                                    <label class="custom-control-label" for="role-list">রোল লিস্ট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="show-role" name="show-role">
                                                    <label class="custom-control-label" for="show-role">রোল দেখা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="role-edit" name="role-edit">
                                                    <label class="custom-control-label" for="role-edit">এডিট রোল</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="delete-role" name="delete-role">
                                                    <label class="custom-control-label" for="delete-role">ডিলিট</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="assign-role" name="assign-role">
                                                    <label class="custom-control-label" for="assign-role">এসাইন রোল</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="reset-all-role" name="reset-all-role">
                                                    <label class="custom-control-label" for="reset-all-role">সকল রোল রিসেট করা</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="assigned-role" name="assigned-role">
                                                    <label class="custom-control-label" for="assigned-role">নির্ধারিত রোল</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="reset-role" name="reset-role">
                                                    <label class="custom-control-label" for="reset-role">কর্মকর্তার রোল রিসেট করা</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="street-setup"
                                                   name="street-setup" >
                                            <label class="custom-control-label weight-600" for="street-setup">রাস্তা
                                                সেটআপ</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="bazar"
                                                   name="bazar"  >
                                            <label class="custom-control-label weight-600" for="bazar">বাজার ব্যবস্থাপনা</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="association"
                                                   name="association"  >
                                            <label class="custom-control-label weight-600" for="association">সমিতি ব্যবস্থাপনা</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script src='{{ asset('js/roles.js') }}'></script>
<script>
    $(".tab-wizard").steps({
        headerTag: "h5",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        showFinishButtonAlways: true,
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            // $('.steps .current').prevAll().addClass('disabled');
        },
        onFinished: function (event, currentIndex) {
            if(! $('#roleName').val())
            {
                alert('Role name required');
            }
            else if($('#roleName').hasClass('form-control-danger'))
            {
                alert('Validation Failed!');
            }
            else
            {
                $('#role-form').submit();
            }

        }
    });
</script>
@endsection
