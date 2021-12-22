@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> সমিতির সদস্য এর বিল কালেকশন</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
                        <li class="breadcrumb-item active" aria-current="page">রেজিষ্টার</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">

                <label class="col-md-1"> বছর </label>
                <div class="col-md-2">
                    <select class="form-control" name="year_id" id="year_id">
                        <option value="">সিলেক্ট করুন</option>
                        @for($year = 2019; $year <= date('Y')+1; $year++ )
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    <span id="year_id_error" class="error"></span>
                </div>



                <label class="col-md-2">সদস্যর নাম</label>
                <div class="col-md-2">
                    <select class="form-control" name="member_id" id="member_id">
                        <option value="">সিলেক্ট করুন</option>
                        @foreach($member_list as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span id="member_id_error" class="error"></span>
                </div>

                &nbsp;&nbsp;

                <input type="button" name="" value="  সার্চ" class="col-md-1 btn btn-primary btn-xs"
                       onclick="bill_collection_searching()">

            </div>

            <div class="row mt-4" >
                <div class="col-md-12">
                    <div class="x_panel">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" style="text-align:center;">
                                    <span style="color:red;font-size:15px;" id="exist_check"></span>
                                </div>
                                <div class="form-group" style="text-align:center;">
                                    <span style="color:red;font-size:15px;" id="discount_check"></span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-4" style="font-size: 17px;">
                                        <b> নাম: <span id="member_name"></span></b>
                                    </div>
                                    <div class="col-md-4" style="font-size: 17px;">
                                        <b> মোবাইল নং: <span id="mobile_no"></span></b>
                                    </div>
                                </div>
                                <br>
                                <form name="accountsForm" class="form-horizontal form_middle" method="post">
                                    <input type="hidden" name="total_month_checked" id="total_month_checked">
                                    <input type="hidden" name="chanda_amount" id="chanda_amount" value="" >
                                    <table class="table table-bordered" id="FeesList">
                                        <thead>
                                        <tr>
                                            <th width="10">#</th>
                                            <th width="10" >মাসিক ফ্রি</th>
                                            <th width="10">টাকা</th>
                                        </tr>
                                        </thead>
                                        <tbody id="chandaBodyList">
                                        <tr>
                                            <td rowspan="2" colspan="1">

                                            </td>
                                            <td>
                                                <span class="pull-right">মোট টাকা:</span>
                                            </td>
                                            <td>
                                                <input type="text" id="total_amount" class="form-control input-sm" name="total_amount" disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <button class="btn btn-primary btn-sm pull-right"
                                                        onclick="acc_bill_collection_save()"
                                                        type="button">কালেকশান</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" name="total_fees" id="total_fees" value="0">

                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="month_select">Select Month</label>
                                    <br>
                                    {{--  disabled="true"  --}}
                                    @for($i = 1; $i<=count($month);$i++ )
                                    <label>
                                        <input type="checkbox" disabled="true" onclick="month_check({{ $i  }})"
                                               name="invoice_month"
                                               class="month_chk" data-month-id="{{ $i  }}"
                                               id="month_{{ $i  }}" value="{{ $month[$i] }}">

                                        {{ $month[$i] }}
                                        <span id="month_status_{{ $i  }}"
                                              class="month_status" style="font-weight:bold;"></span>


                                    </label>
                                    <br>
                                    @endfor

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('script')

    <script src="{{ asset('js/association.js') }}"></script>

@endsection


