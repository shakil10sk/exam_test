@extends('layouts.app')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>

                    <li class="breadcrumb-item active" aria-current="page">হোল্ডিং এসেসমেন্ট ব্যবস্থাপনা</li>

                    <li class="breadcrumb-item active" aria-current="page">তালিকা</li>

                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

    <div class="clearfix mb-20">
        <div class="row">
            <div class="col-2">
                <select name="ward_no" id="ward_no" class="form-control">
                    <option value=''>ওয়ার্ড</option>
                    @foreach($ward_list as $item)
                        <option value="{{$item->id}}">{{$item->ward_no}} - {{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-2">
                <select name="property_type" id="property_type" class="form-control">
                    <option value=''>ভবনের ধরন</option>
                    @foreach($property_list as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-2">
                <select name="owner_type" id="owner_type" class="form-control">
                    <option value=''>মালিকানার ধরন</option>
                    <option value="1">ভাড়া</option>
                    <option value="2">ব্যক্তি মালিকানা</option>
                </select>
            </div>
            
            <div class="col-2">
                <button type="button" class="btn btn-info" onclick="searchAssessmentList()"><i class="fa fa-search"></i> Search</button>
            </div>

            <div class="col-2">
            </div>

            <div class="col-2">
                <a href="{{route('holding.tax.assessment.create')}}">
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> নতুন যোগ করুন
                    </button>
                </a>
            </div>
        </div><br/>

        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='data_tbl'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>নাম</th>
                        <th>মোবাইল</th>
                        <th>হোল্ডিং নং</th>
                        <th>ওয়ার্ড নং</th>
                        <th>ভবনের ধরন</th>
                        <th>মালিকানা</th>
                        <th>বাৎসরিক ট্যাক্স</th>
                        <th>মাসিক ট্যাক্স</th>
                        <th>এনআইডি</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
<!-- Export Datatable End -->

    @endsection

@section('script')

    <script>
        $('document').ready(function() {
            assessment_list();
        });
    </script>

    <script src="{{ asset('js/holding_tax.js') }}"></script>

@endsection
