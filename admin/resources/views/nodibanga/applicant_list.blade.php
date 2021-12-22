@extends('layouts.app') @section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">অন্যান্য সনদ</li>
                    <li class="breadcrumb-item active" aria-current="page">নদীভাঙ্গনের সনদ</li>
                    <li class="breadcrumb-item active" aria-current="page">আবেদনকারিগন</li>

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
                <button type="submit" class="btn btn-primary" onclick="applicant_list_search()">সার্চ করুন</button>
            </div>
        </div>

        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='nodibanga_applicant_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>ছবি</th>
                        <th>নাম</th>
                        <th>পিতা</th>
                        <th>ট্রাকিং</th>
                        <th>পিন</th>
                        <th>মোবাইল</th>
                        <th>আবেদনের তারিখ</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
<!-- Export Datatable End -->

@can('generate')
<div class="modal fade" id="nodibanga_generate_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="myLargeModalLabel">চারিত্রিক সনদ জেনারেট</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <form action="javascript:void(0)" method="post">

                    @csrf

                    <div class="row">
                        <label class="col-md-4 text-right">ট্র্যাকিং</label>

                        <input class="form-control col-md-6" type="text" name="tracking" id="tracking" readonly="readonly" />
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-4 text-right">পিন</label>

                        <input class="form-control col-md-6" type="text" name="pin" id="pin" readonly="readonly" />
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-4 text-right">নাম</label>

                        <input class="form-control col-md-6" type="text" name="name" id="name" readonly="readonly" />
                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-4 text-right">একাউন্ট</label>

                        <select name="account" id="account" class="form-control col-md-6">
                            <option value="">Select</option>
                            
                        </select>

                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-4 text-right">ফি</label>

                        <input class="form-control col-md-6" type="number" name="fee" id="fee" value="0.00" />

                    </div>
                    <br>

                    <div class="row">
                        <label class="col-md-4 text-right">তারিখ</label>

                        <input class="form-control col-md-6" type="text" name="nodibanga_generate_date" id="nodibanga_generate_date" value="{{ date('Y-m-d') }}" />
                    </div>
                    <br>

                    <input type="hidden" name="application_id" id="application_id" />

                    <input type="hidden" name="union_id" id="union_id" />

                    <input type="hidden" name="upazila_id" id="upazila_id" />

                    <input type="hidden" name="district_id" id="district_id" />

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="generate_save()">জেনারেট</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endcan

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

    //url for print nodibanga sonod
    var nodibanga_bangla_sonod_url = '@php echo  url("nodibanga/print_bn") @endphp';

    var nodibanga_applicant_data_url = '@php echo  url("nodibanga/applicant_data") @endphp';

    var nodibanga_generate_url = '@php echo  url("nodibanga/generate") @endphp';

    var nodibanga_delete_url = '@php echo  url("nodibanga/delete") @endphp';

    //for applicant csrf
    var nodibanga_applicant_csrf = '@php echo csrf_token() @endphp';

    var nodibanga_generate_csrf = '@php echo csrf_token() @endphp';

    var nodibanga_delete_csrf = '@php echo csrf_token() @endphp';

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

        nodibanga_applicant_list();

    });
</script>

<script src="{{ asset('js/nodibanga.js') }}"></script>

@endsection