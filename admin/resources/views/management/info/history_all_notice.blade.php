@extends('layouts.app')
@section('content')
    {{--Breadcrumb Section--}}
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-9 col-sm-9">
                <div class="title">
                    <h4><i class="icon-copy fa fa-bookmark-o" aria-hidden="true"></i>সকল নোটিশ</h4>
                </div>
            </div>

            @can('add-notice')
                <div class="col-md-3 col-sm-3">
                    <a href="{{ route('add_up_notice') }}" class="btn btn-info float-right">নতুন যোগ করুন</a>
                </div>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-1 text-right">হতে:</div>
                    <div class="col-md-3"><input type="text" name="fromDate" id="fromDate" value="{{ date('Y-m-d') }}" class="form-control"> </div>

                    <div class="col-md-1 text-right">পর্যন্ত:</div>
                    <div class="col-md-3"> <input type="text" name="toDate" id="toDate" value="{{ date('Y-m-d') }}" class="form-control"></div>

                    <div class="col-md-1" style="margin-bottom: 20px">
                        <button type="submit" class="btn btn-primary" onclick="noticetListSearch()">সার্চ করুন</button>
                    </div>
                </div>

                <div class="row">
                    <table class="stripe hover data-table-export nowrap" id='noticeTable'>
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">নং</th>
                            <th class="">টাইটেল</th>
                            <th class="">ডিটেলস</th>
                            <th class="">পোস্ট বাই</th>
                            <th class="">আপডেট বাই</th>
                            <th class="">প্রকাশকাল</th>
                            <th class="">টাইপ</th>
                            <th class="">অ্যাকশন</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @can('edit-notice')
                <input type="hidden" id="edit-notice" value="edit">
            @endcan

            @can('delete-notice')
                <input type="hidden" id="delete-notice" value="delete">
            @endcan
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/notice.js') }}"></script>
@endsection
