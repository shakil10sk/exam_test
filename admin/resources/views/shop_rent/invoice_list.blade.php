@extends('layouts.app')
@section('head')
    <!-- cropzee.js -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>

@endsection
@section('content')

    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>দোকান ভাড়ার ইনভয়েস তালিকা</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">
                <label class="col-md-1"> বছর </label>
                <div class="col-md-2">
                    <select class="form-control" name="filter_year_id" id="filter_year_id">
                        <option value="">সিলেক্ট করুন</option>
                        @for($year = 2019; $year <= date('Y')+1; $year++ )
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    <span id="year_id_error" class="error"></span>
                </div>

                <label class="col-md-1">মাস</label>
                <div class="col-md-2">
                    <select class="form-control" name="filter_month_id" id="filter_month_id">
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

                <label class="col-md-1">মার্কেটের নাম</label>
                <div class="col-md-2">
                    <select class="form-control" name="filter_market_id" id="filter_market_id">
                        <option value="">সিলেক্ট করুন</option>
                        @foreach($market_list as $item)
                            <option value="{{ $item->id  }}">{{ $item->name  }}</option>
                        @endforeach
                    </select>
                    <span id="market_id_error" class="error"></span>
                </div>
                &nbsp;&nbsp;<div class="col-md-1">
                    <input  type="button" name="" value="সার্চ" class="btn btn-primary btn-sm"
                            onclick="invoice_search()" style="padding: 6px 42px;" >
                </div>


            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                <table id="invoice_list_tble" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>অর্থ বছর</th>
                        <th>মাস</th>
                        <th>ইনভেয়স আইডি</th>
                        <th>দোকানের নং</th>
                        <th>ভাড়াটিয়ার নাম</th>
                        <th>মোবাইল নং</th>
                        <th>স্ট্যাটাস</th>
                        <th>অ্যাকশান</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </div>




@endsection
@section('script')
    <script src="{{ asset('js/bazar_management.js') }}"></script>

    <script>
        $(document).ready(function() {
            invoice_list();
        });
    </script>
@endsection



