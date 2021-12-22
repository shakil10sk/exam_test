@extends('layouts.app')
@section('content')

<style type="text/css">
    ::placeholder {
        color: grey !important;
        opacity: .1;
    }

    .error{
        color:red;
        width: 100%;
        padding-left: 140px;
    }

</style>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>

                    <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স ব্যবস্থাপনা</li>

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
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='trade_applicant_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>প্রতিষ্ঠানের নাম</th>
                        <th>ট্রাকিং</th>
                        <th>মালিকানার ধরন</th>
                        <th>ব্যবসার ধরন</th>
                        <th>মোবাইল</th>
                        <th>ই-মেইল</th>
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
    <div class="modal fade bs-example-modal-lg" id="trade_generate_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 840px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">ট্রেড লাইসেন্স জেনারেট</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <form action="javascript:void(0)" method="post">

                        @csrf

                        <div class="row">

                            {{-- start modal left section --}}
                            <div class="col-md-6">

                                <div class="row">
                                    <label class="col-md-4 text-right">ট্র্যাকিং</label>

                                    <input class="form-control col-md-8" type="text" name="tracking" id="tracking" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">প্রতিষ্ঠানের নাম</label>

                                    <input class="form-control col-md-8" type="text" name="organization_name_bn" id="organization_name_bn" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ব্যবসার ধরণ</label>

                                    <input class="form-control col-md-8" type="text" name="business_type" id="business_type" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মালিকানার ধরণ</label>

                                    <input class="form-control col-md-8" type="text" name="owner_type" id="owner_type" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">সাইনবোর্ডের ধরণ</label>

                                    <input class="form-control col-md-8" type="text" name="signboard_type" id="signboard_type" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-2 text-right">দৈর্ঘ</label>

                                    <input class="form-control col-md-4" type="text" name="signboard_length" id="signboard_length" readonly="readonly" />

                                    <label class="col-md-2 text-right">প্রস্থ</label>

                                    <input class="form-control col-md-4" type="text" name="signboard_width" id="signboard_width" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মেয়াদকাল</label>

                                    <input class="form-control col-md-8" type="text" name="expire_date" id="expire_date" readonly="readonly" value="<?php  $year = date('Y')+1; echo $year."-06-30"; ?>" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ইস্যু তারিখ</label>

                                    <input class="form-control col-md-8" type="text" name="issue_date" id="issue_date" value="{{ date('Y-m-d') }}" />
                                </div>
                                </br>

                                {{-- <div class="row">
                                    <label class="col-md-4 text-right">Payment Type</label>

                                    <select name="account" id="account" class="form-control col-md-8">
                                        <option value="">Select</option>

                                    </select>
                                </div></br>

                                 <div class="row">
                                    <label class="col-md-4 text-right">Payment Date</label>

                                    <input class="form-control col-md-8" type="text" name="payment_date" id="payment_date" value="{{ date('Y-m-d') }}" />
                                </div> --}}

                            </div>

                            {{-- end modal left section --}} {{--start modal right section --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4 text-right">লাইসেন্স ফি</label>

                                    <input class="form-control col-md-7" type="text" name="fee" id="fee" readonly />

                                    <span class="error" id="license_fee_error"></span>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">সাইনবোর্ড ফি</label>

                                    <input class="form-control col-md-7" type="text" name="signbord_vat" id="signbord_vat" readonly/>

                                    <span class="error" id="signboard_fee_error"></span>
                                </div>
                                </br>

                                {{-- <div class="row">
                                    <label class="col-md-4 text-right">বকেয়া অর্থ বছর</label>

                                    <input class="form-control col-md-7" type="text" name="due_fiscal_year" id="due_fiscal_year" placeholder="2018-2019" />

                                    <span class="error" id="due_fiscal_year_error"></span>
                                </div>
                                </br> --}}





                                <div class="row">
                                    <label class="col-md-4 text-right">ভ্যাট</label>

                                    <input class="form-control col-md-7" type="text" name="vat" id="vat"
                                    {{-- readonly="readonly" --}}
                                    />

                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">আবেদন ফি</label>

                                    <input class="form-control col-md-7" onchange="calculation()" type="text" name="bibidh" id="bibidh"/>

                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">উৎসেকর</label>

                                    <input class="form-control col-md-7" type="text" name="source_tax" id="source_tax" onchange="calculation()"/>

                                    <span class="error" id="source_tax_error"></span>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">সারচার্জ</label>

                                    <input class="form-control col-md-7" type="text" name="sarcharge" id="sarcharge" onchange="calculation()"/>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ছাড়</label>

                                    <input class="form-control col-md-7" type="text" name="discount" id="discount" onchange="calculation()" placeholder="কোন ছাড় দিতে চাইলে" />
                                </div>
                                </br>

                                {{-- <div class="row">
                                    <label class="col-md-4 text-right">বকেয়া</label>

                                    <input class="form-control col-md-7" type="text" name="due" id="due" onchange="calculation()" />
                                </div>
                                </br> --}}

                                <div class="row">
                                    <label class="col-md-4 text-right">মোট</label>

                                    <input class="form-control col-md-7" type="text" name="total" id="total" readonly="readonly" />
                                </div>
                                </br>

                            </div>
                            {{-- end modal right section --}}
                        </div>

                        <input type="hidden" name="application_id" id="application_id" />

                        <input type="hidden" name="union_id" id="union_id" />

                        <input type="hidden" name="upazila_id" id="upazila_id" />

                        <input type="hidden" name="district_id" id="district_id" />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="generate_save()">জেনারেট</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                        </div>
                    </form>
                </div>

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

        //url for print trade sonod
        var trade_bangla_sonod_url = '@php echo  url("trade/print_bn") @endphp';

        var trade_applicant_data_url = '@php echo  url("trade/applicant_data") @endphp';

        var trade_money_receipt_data_url = '@php echo  url("trade/money_receipt") @endphp';

        var trade_generate_url = '@php echo  url("trade/generate") @endphp';

        var trade_delete_url = '@php echo  url("trade/delete") @endphp';

        //for applicant csrf
        var trade_applicant_csrf = '@php echo csrf_token() @endphp';

        var trade_generate_csrf = '@php echo csrf_token() @endphp';

        var trade_delete_csrf = '@php echo csrf_token() @endphp';

        var general_settings = [];
        var business_fee = [];

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

            trade_applicant_list();

            // generate parameter loading
            $.ajax({
                url: url + "/trade/fee_settings",
                type: "GET",
                dataType: "JSON",
                success: function(response){
                    var gs = response.data.general_settings;

                    general_settings['max_source_tax'] = gs.max_source_tax;
                    general_settings['vat'] = gs.vat;
                    general_settings['running_sarcharge'] = gs.running_sarcharge;
                    general_settings['sarcharge_on_due'] = gs.sarcharge_on_due;
                    general_settings['nion'] = gs.nion;
                    general_settings['lighting'] = gs.lighting;
                    general_settings['general'] = gs.general;

                    response.data.business_fee.forEach(function(item){
                        business_fee[item.business_type_id] = item.fees;
                    });
                }
            });

            //console.log(general_settings);
            //console.log(business_fee);

        });


    </script>

    <script src="{{ asset('js/trade.js') }}"></script>

    @endsection
