@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4> ব্যাংক রিপোর্ট </h4>
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
                        <label for="from_date">হতে</label>

                        <input type="text" name="from_date" id="from_date" class="form-control" />
                        
                        <label for="to_date">পর্যন্ত</label>

                        <input type="text" name="to_date" id="to_date" class="form-control" /> <br/>

                        {{-- 2 for bank payment --}}
                        <input type="hidden" name="payment_type" id="payment_type" value="2" />

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
            $("#from_date,#to_date").datepicker({
                dateFormat: 'yy-mm-dd'
            }).datepicker("setDate", "now");
        });
    </script>
@endsection