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
                    <h4>সমিতি কালেকশনের ইনভয়েস তালিকা</h4>
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

                <label class="col-md-1">সদস্য</label>
                <div class="col-md-2">
                    <select class="form-control" name="filter_member_id" id="filter_member_id">
                        <option value="">সিলেক্ট করুন</option>
                        @foreach($member_list as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span id="filter_member_id_error" class="error"></span>
                </div>

                &nbsp;&nbsp;<div class="col-md-1">
                    <input type="button" name="" value="সার্চ" class="btn btn-primary btn-sm"
                           onclick="invoice_search()" style="padding: 6px 42px;">
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
                        <th>ইনভেয়স আইডি</th>
                        <th>নাম</th>
                        <th>মোবাইল নং</th>
                        <th>মোট টাকা</th>
                        <th>প্রদানের তারিখ</th>
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
    <script src="{{ asset('js/association.js') }}"></script>

    <script>
        $(document).ready(function () {
            invoice_list();
        });
    </script>
@endsection



