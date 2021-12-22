@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4> অন্যান্য রিপোর্ট </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

                <form action="{{route('holding.tax.report.action')}}" method="get" target="_blank">
                
                    <div class="row mb-3">
                @csrf    

                    <div class="col-4"></div>

                    <div class="col-4">
                        <label for="fiscal_year_id"> অর্থবছর </label>
                        
                        <select name="fiscal_year_id" id="fiscal_year_id" class="form-control" onchange="onFiscalChange()">

                            <option value="">Select</option>

                            @foreach($fiscal_year_list as $item)
                                <option value="{{$item->id}}" @if($item->is_current) selected @endif >{{$item->name}}</option>
                            @endforeach

                        </select>
                        
                        <label for="ward_no">ওয়ার্ড নাম </label>
                        
                        <select name="ward_no" id="ward_no" class="form-control">

                            <option value="">Select</option>

                            @foreach($ward_list as $item)
                                <option value="{{$item->id}}">{{$item->ward_no}}-{{$item->name}}</option>
                            @endforeach

                        </select>

                        <label for="property_type">ভবনের ধরন <span>*</span></label>

                        <select name="property_type" id="property_type" class="form-control">
                            <option value="">Select</option>
                            
                            @foreach($property_list as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            
                        </select>

                        <label for="owner_type">মালিকানার ধরন <span>*</span></label>
                        
                        <select name="owner_type" id="owner_type" class="form-control">
                            <option value="">Select</option>
                            <option value="1">ভাড়া</option>
                            <option value="2">ব্যক্তি মালিকানা</option>
                        </select>

                        <label for="from_date">হতে</label>

                        <input type="text" name="from_date" id="from_date" class="form-control" />
                        
                        <label for="to_date">পর্যন্ত</label>

                        <input type="text" name="to_date" id="to_date" class="form-control" /> <br/>

                        <button class="btn btn-sm btn-primary" type="submit">Get Report</button>
                    </div>
                        
                </div>
            </form>

            </div>
        </div>
    </div>

@endsection

@section("script")
    <script type="text/javascript">
        $(document).ready(function(){
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

            $("#from_date").datepicker({
                dateFormat: "yy-mm-dd",
                defaultDate: from_date,
                minDate: from_date,
                maxDate: to_date
            });
            
            $("#to_date").datepicker({
                dateFormat: "yy-mm-dd",
                defaultDate: from_date,
                minDate: from_date,
                maxDate: to_date
            });

            if(today.getTime() >= from_date.getTime() && today.getTime() <= to_date.getTime()){
                var display_date = today.getFullYear() + '-' + ((today.getMonth() + 1) < 10 ? '0'+(today.getMonth() + 1) : (today.getMonth() + 1)) + '-' + today.getDate();

                $("#from_date").val(display_date);
			    $("#to_date").val(display_date);
            } else {
                $("#from_date").val(from_date_raw);
			    $("#to_date").val(from_date_raw);
            }
            
        });

        // filter from and to date modify
        function onFiscalChange(){
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

            $("#from_date").datepicker("option", "minDate", from_date);
            $("#from_date").datepicker("option", "maxDate", to_date);
            $("#from_date").datepicker("option", "defaultDate", from_date);

            $("#to_date").datepicker("option", "minDate", from_date);
            $("#to_date").datepicker("option", "maxDate", to_date);
            $("#to_date").datepicker("option", "defaultDate", from_date);

            if(today.getTime() >= from_date.getTime() && today.getTime() <= to_date.getTime()){
                var display_date = today.getFullYear() + '-' + ((today.getMonth() + 1) < 10 ? '0'+(today.getMonth() + 1) : (today.getMonth() + 1)) + '-' + today.getDate();

                $("#from_date").val(display_date);
			    $("#to_date").val(display_date);
            } else {
                $("#from_date").val(from_date_raw);
			    $("#to_date").val(from_date_raw);
            }
        }
    </script>
@endsection