@extends('layouts.app')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>

                    <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স ব্যবস্থাপনা</li>

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
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='trade_bill_list_tbl'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>ইনভয়েস নং</th>
                        <th>ভাউচার নং</th>
                        <th>ট্রানজেকশন নং</th>
                        <th>সনদ নং</th>
                        <th>অর্থ বছর</th>
                        <th>টাকা</th>
                        <th>বিলের তারিখ</th>
                        <th>স্ট্যাটাস</th>
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
            trade_bill_list();
        });
    </script>

    <script src="{{ asset('js/trade.js') }}"></script>

@endsection
