@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-commenting-o" aria-hidden="true"></i> এসএমএস</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">বাজার ব্যবস্থাপনা</li>
                        <li class="breadcrumb-item active" aria-current="page">৩ মাস বকেয়া এসএমএস</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row justify-content-start  mt-2">

                <label class="col-md-2"> টাইটেল </label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="title" id="title" value="" >
                    <span id="title_error" class="error"></span>
                </div>

            </div>

            <div class="row justify-content-start  mt-2">

                <label class="col-md-2"> মেসেজ </label>
                <div class="col-md-2">
                   <textarea id="message"  name="message"  rows="9" cols="40" ></textarea>
                    <span id="message_error" class="error"></span>
                </div>

            </div>
            <div class="row justify-content-start  mt-2">
                <label class="col-md-2">পাঠানোর সময়</label>
                <div class="col-md-2">
                   <input type="text" class="form-control" name="sending_time" id="sending_time" value="{{  date("Y-m-d")  }}"
                          readonly
                   >
                    <span id="sending_time_error" class="error"></span>
                </div>
            </div>
            <div class="row justify-content-center mt-3" style="margin-right: 57%;">
                <input type="button" name="" value="Send" class="col-md-2
            btn btn-primary btn-xs" onclick="due_month_sms_send()">
            </div>


        </div>
    </div>




@endsection

@section('script')

    <script src="{{ asset('js/bazar_management.js') }}"></script>

    <script>

        $('document').ready(function () {

            //for date picker
            $('#sending_time').datepicker({
                language: 'en',
                autoClose: true,
                dateFormat: 'yy-mm-dd',
            });

        });


    </script>

@endsection


