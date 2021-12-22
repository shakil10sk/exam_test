@extends('layouts.app') 

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">দৈনিক হাজিরা রিপোর্ট</li>
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
            <div class="col-md-1 text-right">নাম</div>
            <div class="col-md-2">
                <select name="employee_id"  id="employee_id" class="form-control">
                    <option>সিলেক্ট করুন</option>
                    
                    <?php foreach($data as $item) :  ?>
                    
                    <option value='{{ $item->employee_id }}'>{{ $item->name }}</option>
                <?php endforeach; ?>
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
                <button type="submit" class="btn btn-primary" onclick="attendance_filter()">সার্চ করুন</button>
            </div>

        </div>

        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='attendance_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>আইডি</th>
                        <th>ডিভাইস আইডি</th>
                        <th>নাম</th>
                        <th>পদবী</th>
                        <th>তারিখ</th>
                        <th>লগইন</th>
                        <th>লগ-আউট</th>
                        <th>স্ট্যাটাস</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
<!-- Export Datatable End -->

@endsection
@section('script')

<script>
    var url  = $('meta[name = path]').attr("content");

$(function () {

    var attendance_table = $('#attendance_table').DataTable({

        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,

        ajax: {

        url: "{{ route('attendance_data') }}",

        data: function (e) {
                e.employee_id = $('#employee_id').val(),
                e.from_date = $('#from_date').val(),
                e.to_date = $('#to_date').val()
            }

        },

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},

            {data: 'employee_id', name: 'employee_id'},
            {data: 'device_id', name: 'device_id'},
            {data: 'name', name: 'name'},
            {data: 'designation_id', name: 'designation_id', render:function(data, type, row, meta){

                 if(row.designation_id == 2){
                    
                    return 'সচিব';
                 }else if(row.designation_id == 3){

                    return 'উদ্যোক্তা';

                 }else if(row.designation_id == 4){

                    return 'হিসাব সহকারী কাম কম্পিউটার অপারেটর';

                 }else if(row.designation_id == 5){

                    return 'মেম্বার';

                 }else if(row.designation_id == 6){

                    return 'গ্রামপুলিশ';

                 }else{
                     return '';
                 }

            }},
            {data: 'att_date', name: 'att_date'},
            {data: 'login_time', name: 'login_time', render:function(data, type, row, meta){

                return dateTimeFormatting(row.login_time);

            }},

            {data: 'logout_time', name: 'logout_time', render:function(data, type, row, meta){

                    return dateTimeFormatting(row.logout_time);

            }},
            {data: 'status', name: 'status', render:function(data, type, row, meta){
                
                return (row.login_time) ? "<span class='text-success'>উপস্থিত</span>" : "<span class='text-danger'>অনুপস্থিত</span>";

            }

            }
        ]

    });

});

/* this is for date time formating */
function dateTimeFormatting(date) {

    if(date != null){
        var date_part = date.split(" ")[0];

        date = new Date(date);

        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; /* the hour '0' should be '12' */
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;

        return strTime;

    } else {
        return '';
    }

}

/* //filtering attendance */
function attendance_filter(){

    $("#attendance_table").DataTable().draw(true);
}

</script>

<script src="{{ asset('js/bibahito.min.js') }}"></script>

@endsection