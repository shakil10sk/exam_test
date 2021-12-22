@extends('layouts.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                <h4 style="color: white;">সকল আবেদন ও সনদ যাচাই</h4>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        <h3>সনদের আবেদন অথবা সনদ যাচাই করতে সঠিক তথ্য দিন।</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">ধরন</label>
                            <div class="col-md-9">
                                <select class="form-control" id="appType">

                                    <option value="">নির্বাচন করুন</option>
                                    <option value='1'>আবেদন যাচাই</option>
                                    <option value='2'>সনদ যাচাই</option>

                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">আবেদন/সনদের ধরন</label>
                            <div class="col-md-9">
                                <select class="form-control" id="app-type">

                                    <option value="">নির্বাচন করুন</option>
                                    <option value='1'>নাগরিক</option>
                                    <option value='2'>মৃত্যু</option>
                                    <option value='3'>অবিবাহিত </option>
                                    <option value='4'>পূনঃবিবাহ না হওয়া</option>
                                    <option value='5'>একই নামের প্রত্যয়ন</option>
                                    <option value='6'>সনাতন ধর্ম অবলম্বি</option>
                                    <option value='7'>প্রত্যয়ন পত্র</option>
                                    <option value='8'>নদী ভাঙনের</option>
                                    <option value='9'>চারিত্রিক</option>
                                    <option value='10'>ভূমিহীন</option>
                                    <option value='11'>বার্ষিক আয়ের প্রত্যয়ন</option>
                                    <option value='12'>প্রতিবন্ধি</option>
                                    <option value='13'>অনুমতি পত্র</option>
                                    <option value='14'>ভোটার আইডি স্থানান্তর</option>
                                    <option value='17'>ওয়ারিশ</option>
                                    <option value='18'>পারিবারিক</option>
                                    <option value='19'>ট্রেড লাইসেন্স</option>
                                    <option value='20'>বিবাহিত</option>
                                    <option value='90'>প্রিমিসেস</option>

                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">সার্চ বক্স</label>
                            <div class="col-md-9">
                                <input type="text" id="search-data" class="form-control" placeholder="এখানে সার্চ দিন...">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>নোট: </strong>আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন অথবা কোনো সনদের আবেদন করে থাকেন, সার্চ বক্সে আপনার ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা পিন নং অথবা ট্র্যাকিং নং অথবা সনদ নং দিয়ে সার্চ করুন।</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="union-id" value="{{ $unionProfile->union_id }}">
                                <button class="btn btn-success btn-lg btn-block" type="button" id="search" >সার্চ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('js/verify.js') }}"></script>
@endsection
