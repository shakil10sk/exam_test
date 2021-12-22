@extends('layouts.app') @section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">প্রিমিসেস লাইসেন্স ব্যবস্থাপনা</li>
                    <li class="breadcrumb-item active" aria-current="page">বিগত অর্থবছরের সনদসমূহ</li>

                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

    <div class="row text-center">
        @if(Session::has('message'))
        <p style="margin:0 auto;" class="alert alert-success ">{{ Session::get('message') }}</p>
        @endif
    </div>

    <div class="clearfix mb-20">
        <div class="row">
            {{-- <div class="col-md-1"></div> --}}
            <div class="col-md-2 text-right">বিগত অর্থবছর:</div>
            <div class="col-md-2">
                <select class="form-control" name="fiscal_year_id" id="fiscal_year_id" >
                    <option value="">সিলেক্ট করুন</option>

                    @foreach($fiscal_years as $year)
                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                    @endforeach

                </select>
             </div>

            <div class="col-md-1 text-right">হতে:</div>
            <div class="col-md-2">
                <input type="text" name="from_date" value="<?php echo date('Y-m-d')?>" id="from_date" class="form-control">
             </div>

            <div class="col-md-1 text-right">পর্যন্ত:</div>
            <div class="col-md-2">
                <input type="text" name="to_date" id="to_date" value="<?php echo date('Y-m-d')?>" class="form-control">
            </div>

            <div class="col-md-1" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary" onclick="previous_certificate_list_search()">সার্চ করুন</button>
            </div>

        </div>
        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='trade_certificate_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>প্রতিষ্ঠানের নাম</th>
                        <th>ট্রাকিং</th>
                        <th>সনদ নং</th>
                        <th>মালিকানার ধরন</th>
                        <th>ব্যবসার ধরন</th>
                        <th>মোবাইল</th>
                        <th>ই-মেইল</th>
                        <th>জেনারেট তারিখ</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
    <!-- Export Datatable End -->
    <div class="row">
        <div class="col-md-12">
            @can('generate')
                <input type="hidden" id="generate" value="generate">
            @endcan

            @can('edit')
                <input type="hidden" id="edit" value="edit">
            @endcan

            @can('delete')
                <input type="hidden" id="delete" value="delete">
            @endcan

            @can('regenerate')
                <input type="hidden" id="regenerate" value="regenerate">
            @endcan

            @can('invoice')
                <input type="hidden" id="invoice" value="invoice">
            @endcan
        </div>
    </div>
@endsection

@section('script')

    <script>
        // url for show image
        var img_path = '@php echo asset("images/application/")@endphp';

        var trade_certificate_data_url = '@php echo  url("trade/previous_certificate_list_data") @endphp';

        var trade_certificate_csrf = '@php echo  csrf_token() @endphp';

        // console.log(img_path);

        //url for print trade sonod
        var trade_bangla_sonod_url = '@php echo  url("trade/print_bn") @endphp';

        $('document').ready(function() {

            previous_trade_certificate_list();

        });
    </script>

    <script src="{{ asset('js/trade.js') }}"></script>

    @endsection
