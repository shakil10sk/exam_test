@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> বিল কালেকশন</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">বাজার ব্যবস্থাপনা</li>
                        <li class="breadcrumb-item active" aria-current="page">বিল কালেকশন</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">

                <label class="col-md-1"> বছর </label>
                <div class="col-md-2">
                    <select class="form-control" name="year_id" id="year_id">
                        <option value="">সিলেক্ট করুন</option>
                        @for($year = 2019; $year <= date('Y')+1; $year++ )
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    <span id="year_id_error" class="error"></span>
                </div>

                <label class="col-md-1">মাস</label>
                <div class="col-md-2">
                    <select class="form-control" name="month_id" id="month_id">
                        <option value="">সিলেক্ট করুন</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <span id="month_id_error" class="error"></span>
                </div>

                <label class="col-md-2">মার্কেটের নাম</label>
                <div class="col-md-2">
                    <select class="form-control" name="market_id" id="market_id">
                        <option value="">সিলেক্ট করুন</option>
                        @foreach($market_list as $item)
                            <option value="{{ $item->id  }}">{{ $item->name  }}</option>
                        @endforeach
                    </select>
                    <span id="market_id_error" class="error"></span>
                </div>

                &nbsp;&nbsp;

                <input type="button" name="" value="  সার্চ" class="col-md-1 btn btn-primary btn-xs"
                       onclick="bill_collection_searching()">

            </div>

            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12">
                    <table class="table table-bordered" id="bill_collection_tbl">

                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')

    <script src="{{ asset('js/bazar_management.js') }}"></script>

    <script>
        bill_collection_list();
    </script>

@endsection


