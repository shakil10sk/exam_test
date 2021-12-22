@extends('layouts.app') @section('content')
<style type="text/css">::placeholder {color: grey !important;opacity: .1;}.error{color:red;width: 100%;padding-left: 165px;}</style>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <div class="title">
                <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> পেশা কর আদায়</h4>
            </div>

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
                    <li class="breadcrumb-item active" aria-current="page">পেশা কর আদায়</li>

                </ol>
            </nav>
        </div>
    </div>
</div>

@can('add-income-tax')
<div class="row">
    <div class="col-md-12">
        <a href="javascript:void(0)" class="pull-right btn btn-success" onclick="collect_pesha_kor()"><i class="fa fa-plus"></i> কর আদায় করুন</a>
    </div>
</div>
@endcan

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

    <div class="row text-center">
        @if(Session::has('message'))
        <p style="margin:0 auto;" class="alert alert-success ">{{ Session::get('message') }}</p>
        @endif
    </div>
   
    <div class="clearfix mb-20">
        <div class="row">
            <div class="col-md-1"></div>

            <div class="col-md-1 text-right">হতে:</div>
            <div class="col-md-3">
                <input type="text" name="from_date" value="<?php echo date('Y-m-d')?>" id="from_date" class="form-control"> </div>

            <div class="col-md-1 text-right">পর্যন্ত:</div>
            <div class="col-md-3">
                <input type="text" name="to_date" id="to_date" value="<?php echo date('Y-m-d')?>" class="form-control">
            </div>

            <div class="col-md-1" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary" onclick="pesha_kor_list_search()">সার্চ করুন</button>
            </div>

        </div>
        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='pesha_kor_list_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>প্রতিষ্ঠানের নাম</th>
                        <th>ট্রাকিং</th>
                        <th>ভাউচার নং</th>
                        <th>সনদ নং</th>
                        <th>কর</th>
                        <th>আদায়ের তারিখ</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
 </div>
    <!-- Export Datatable End -->

    @can('add-income-tax')
        <div class="modal fade" id="pesha_kor_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title" id="myLargeModalLabel">পেশা কর আদায়</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    <form action="javascript:void(0)" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <label  class="col-md-4 text-right"></label>

                                <span id="error_show" style="color:red;font-size: 16px;"></span>

                            </div><br>

                            <div class="row">
                                <label  class="col-md-4 text-right">সনদ নং</label>

                                <input class="form-control col-md-6" type="text" name="sonod_no" id="sonod_no" onchange="peshakor_data_search()" />

                                <span class="error" id="sonod_no_error"></span>
                            </div><br>

                            <div class="row">
                                <label  class="col-md-4 text-right">ট্র্যাকিং</label>

                                <input class="form-control col-md-6" type="text" name="tracking" id="tracking" readonly="readonly" />
                            </div><br>


                            <div class="row">
                                <label  class="col-md-4 text-right">প্রতিষ্ঠানের নাম</label>

                                <input class="form-control col-md-6" type="text" name="organization_name" id="organization_name" readonly="readonly" />
                            </div><br>


                            <div class="row">
                                <label  class="col-md-4 text-right">একাউন্ট</label>

                                <select name="account" id="account" class="form-control col-md-6" readonly >
                                    <option value="28">ক্যাশ</option>
                                    
                                </select>

                            </div><br>

                            <div class="row">
                                <label  class="col-md-4 text-right">ফি</label>

                                <input class="form-control col-md-6" type="text" name="pesha_kor" id="pesha_kor" value="0.00" />

                                <span class="error" id="pesha_kor_error"></span>

                            </div><br>

                            <div class="row">
                                <label  class="col-md-4 text-right">তারিখ</label>

                                <input class="form-control col-md-6" type="text" name="payment_date" id="payment_date" value="{{ date('Y-m-d') }}" />
                            </div><br>

                            <input type="hidden" name="voucher" id="voucher" />

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="pesha_kor_save()">জেনারেট</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    @endcan

    @can('income-tax-invoice')
        <input type="hidden" id="income-tax-invoice" value="invoice">
    @endcan

@endsection

 @section('script')
    <script> 
        $('document').ready(function() {
            pesha_kor_list();
        });
    </script>

    <script src="{{ asset('js/trade.min.js') }}"></script>
@endsection