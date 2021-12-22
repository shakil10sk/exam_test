@extends('layouts.app') @section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">অন্যান্য সনদ</li>
                    <li class="breadcrumb-item active" aria-current="page">পোষা প্রানীর সনদ</li>
                    <li class="breadcrumb-item active" aria-current="page">সনদ গ্রহনকারিগন</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
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
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='animal_certificate_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>ছবি</th>
                        <th>নাম</th>
                        {{--
                        <th>পিতা</th> --}}
                        <th>ট্রাকিং</th>
                        <th>পিন</th>
                        <th>সনদ নং</th>
                        <th>মোবাইল</th>
                        <th>জেনারেট তারিখ</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Export Datatable End -->

    @can('regenerate')
    <div class="modal fade" id="regenerate_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 840px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">পোষা প্রাণীর লাইসেন্স জেনারেট</h4>
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
                                    <label class="col-md-4 text-right">পোষাপ্রানীর নাম</label>

                                    <input class="form-control col-md-8" type="text" name="animal_name" id="animal_name" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">পোষাপ্রানীর ধরণ</label>

                                    <input class="form-control col-md-8" type="text" name="animal_type" id="animal_type" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মালিকের নাম</label>

                                    <input class="form-control col-md-8" type="text" name="name" id="name" readonly="readonly" />
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

                                <div class="row">
                                    <label class="col-md-4 text-right">Payment Type</label>

                                    <select name="account" id="account" class="form-control col-md-8">
                                        <option value="">Select</option>

                                    </select>
                                </div></br>

                                 <div class="row">
                                    <label class="col-md-4 text-right">Payment Date</label>

                                    <input class="form-control col-md-8" type="text" name="payment_date" id="payment_date" value="{{ date('Y-m-d') }}" />
                                </div>

                            </div>

                            {{-- end modal left section --}} {{--start modal right section --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4 text-right">পিন নং</label>

                                    <input class="form-control col-md-7" type="text" name="pin" id="pin" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">লাইসেন্স ফি</label>

                                    <input class="form-control col-md-7" type="text" name="fee" id="fee" onchange="calculation()" />

                                    <span class="error" id="fee_error"></span>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">বকেয়া</label>

                                    <input class="form-control col-md-7" type="text" name="due" id="due" onchange="calculation()" />
                                </div>
                                </br>

                                 <div class="row">
                                    <label class="col-md-4 text-right">ছাড়</label>

                                    <input class="form-control col-md-7" type="text" name="discount" id="discount" onchange="calculation()" placeholder="কোন ছাড় দিতে চাইলে" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ভ্যাট(১৫%)</label>

                                    <input class="form-control col-md-7" type="text" name="vat" id="vat" readonly="readonly" />

                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">উৎসেকর</label>

                                    <input class="form-control col-md-7" type="text" name="source_tax" id="source_tax" onchange="calculation()"/>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">সাব চার্জ</label>

                                    <input class="form-control col-md-7" type="text" name="sarcharge" id="sarcharge" onchange="calculation()"/>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মোট</label>

                                    <input class="form-control col-md-7" type="text" name="total" id="total" readonly="readonly" />
                                </div>
                                </br>

                            </div>
                            {{-- end modal right section --}}
                        </div>

                        <input type="hidden" name="sonod_no" id="sonod_no" />

                        <input type="hidden" name="union_id" id="union_id" />

                        <input type="hidden" name="upazila_id" id="upazila_id" />

                        <input type="hidden" name="district_id" id="district_id" />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="regenerate_save()">জেনারেট</button>

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

        var animal_certificate_data_url = '@php echo  url("animal/certificate_list_data") @endphp';

        var animal_certificate_csrf = '@php echo  csrf_token() @endphp';

        var animal_regenerate_url = '@php echo  url("animal/regenerate") @endphp';

        var animal_regenerate_csrf = '@php echo csrf_token() @endphp';

        // url for print animal sonod
        var animal_bangla_sonod_url = '@php echo  url("animal/print_bn") @endphp';

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

            animal_certificate_list();

        });
    </script>

    <script src="{{ asset('js/animal.js') }}"></script>

    @endsection