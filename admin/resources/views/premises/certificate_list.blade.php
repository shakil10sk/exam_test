@extends('layouts.app') @section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">প্রিমিসেস লাইসেন্স ব্যবস্থাপনা</li>
                    <li class="breadcrumb-item active" aria-current="page">সনদ গ্রহণকারীগণ</li>

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
            <div class="col-md-2 text-right">অর্থ বছর:</div>
            <div class="col-md-2">
                <select class="form-control" id="fiscal_year_id" name="fiscal_year_id" onchange="onFiscalChange()">
                    <option value="">Select</option>
                    
                    @foreach($fiscal_year_list as $item)
                        <option value="{{$item->id}}" @if($item->is_current) selected @endif >{{$item->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-1 text-right">হতে:</div>
            <div class="col-md-2">
                <input type="text" name="from_date" id="filter_from_date" class="form-control" readonly>
            </div>

            <div class="col-md-1 text-right">পর্যন্ত:</div>
            <div class="col-md-2">
                <input type="text" name="to_date" id="filter_to_date" class="form-control" readonly>
            </div>

            <div class="col-md-1" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary" onclick="certificate_list_search()">সার্চ করুন</button>
            </div>
        </div>

        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='premises_certificate_table'>
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

        var premises_certificate_data_url = '@php echo  url("premises/certificate_list_data") @endphp';

        var premises_certificate_csrf = '@php echo  csrf_token() @endphp';

        // console.log(img_path);

        //url for print trade sonod
        var premises_bangla_sonod_url = '@php echo  url("trade/print_bn") @endphp';

        $('document').ready(function() {

            var fiscal_year = $("#fiscal_year_id").find(':selected').text();

            var fiscal_year_split = fiscal_year.split('-');

            var from_date_raw = fiscal_year_split[0] + '-07-01';
            var to_date_raw = fiscal_year_split[1] + '-06-30';

            var from_date = new Date(from_date_raw);
            var to_date = new Date(to_date_raw);
            var today = new Date();

            // set auto time to zero
			from_date.setHours(0,0,0,0);
			to_date.setHours(0,0,0,0);
			today.setHours(0,0,0,0);

            $("#filter_from_date").datepicker({
                dateFormat: "yy-mm-dd",
                defaultDate: from_date,
                minDate: from_date,
                maxDate: to_date
            });
            
            $("#filter_to_date").datepicker({
                dateFormat: "yy-mm-dd",
                defaultDate: from_date,
                minDate: from_date,
                maxDate: to_date
            });

            if(today.getTime() >= from_date.getTime() && today.getTime() <= to_date.getTime()){
                var display_date = today.getFullYear() + '-' + ((today.getMonth() + 1) < 10 ? '0'+(today.getMonth() + 1) : (today.getMonth() + 1)) + '-' + today.getDate();

                $("#filter_from_date").val(display_date);
			    $("#filter_to_date").val(display_date);
            } else {
                $("#filter_from_date").val(from_date_raw);
			    $("#filter_to_date").val(from_date_raw);
            }

            premises_certificate_list();

        });
    </script>

    <script src="{{ asset('js/premises.js') }}"></script>

    @endsection
