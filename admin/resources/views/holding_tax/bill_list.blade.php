@extends('layouts.app')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>

                    <li class="breadcrumb-item active" aria-current="page">হোল্ডিং এসেসমেন্ট ব্যবস্থাপনা</li>

                    <li class="breadcrumb-item active" aria-current="page">বিলের তালিকা</li>

                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

    <div class="clearfix mb-20">

        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='data_tbl'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>নাম</th>
                        <th>মোবাইল</th>
                        <th>হোল্ডিং নং</th>
                        <th>ওয়ার্ড নং</th>
                        <th>ইনভয়েস নং</th>
                        <th>ভাউচার নং</th>
                        <th>টাকা</th>
                        <th>স্ট্যাটাস</th>
                        <th>তারিখ</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
<!-- Export Datatable End -->

    @endsection

@section('script')

    <script>
        $('document').ready(function() {
            holding_bill_list();
        });
    </script>

    <script src="{{ asset('js/holding_tax.js') }}"></script>

@endsection
