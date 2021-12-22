@extends('layouts.app') @section('content')

<style>
    .inv{
        float:right;
        background-color: #d4edda;
        border-color:#c3e6cb;
        color:#155724;
        padding:.25rem .25rem;
        font-size: 18px;
    }

    .inv-tbl{
        width: 50%;
        margin-left: 50px;
    }

    .fiscal-year{
        text-decoration: underline;
    }
</style>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>

                    <li class="breadcrumb-item active" aria-current="page">হোল্ডিং ট্যাক্স ব্যবস্থাপনা</li>

                    <li class="breadcrumb-item active" aria-current="page">ট্যাক্স কালেকশন</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

    <div class="clearfix mb-20">
        <div class="row">

            <div class="col-md-3"></div>

            <div class="col-md-5">
                <input type="text" name="search_id" id="search_id" class="form-control" placeholder="Invoice/Vouher/Holding no" value="{{$invoice_id}}" />
            </div>

            <div class="col-md-1" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary" onclick="tax_bill_search()">সার্চ করুন</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8">
                <span class="text-danger" id="error_msg"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>

            <div class="col-md-12">

                <div class="col-md-8" style="float: left;margin-top: 20px;">
                    <div id="bill_list">
                    </div>

                    <div class="col-md-12" id="due_option" style="display: none;">
                        <h4 style="text-decoration: underline;">বকেয়া</h4>

                        <div class="form-group col-md-4 float-left">
                            <label for="due_fiscal_year">অর্থবছর</label>
                            <input type="text" name="due_fiscal_year" id="due_fiscal_year" class="form-control" />
                            <span class="error" id="due_fiscal_year_error"></span>
                        </div>
                        
                        <div class="form-group col-md-4 float-left">
                            <label for="due_months">মাস সমূহ</label>
                            <input type="text" name="due_months" id="due_months" class="form-control" />
                            <span class="error" id="due_months_error"></span>
                        </div>
                        
                        <div class="form-group col-md-4 float-left">
                            <label for="due_amount">টাকা</label>
                            <input type="text" name="due_amount" id="due_amount" class="form-control" onkeyup="calculate_due(this.value)" />
                            <span class="error" id="due_amount_error"></span>
                        </div>
                    </div>

                    <div class="col-md-4" style="float: right;">
                        <input type="hidden" name="invoice_id" id="invoice_id" />
                        <input type="hidden" name="voucher_no" id="voucher_no" />

                        সর্বমোটঃ <input name="intotal" id="intotal" readonly class="form-control" /><br/>

                        পেমেন্ট তারিখঃ <input name="payment_date" id="payment_date" readonly class="form-control" /><br/>

                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="1">Cash</option>
                            <option value="2">Bank</option>
                        </select> <br/>

                        <button class="btn btn-sm btn-danger" type="button" onclick="taxBillCollectionReset()">Cancel</button>

                        <button class="btn btn-sm btn-primary" type="button" onclick="taxBillCollection()">Pay</button>
                    </div>

                </div>

                <div class="col-md-2" style="float: left;"></div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
    <script>
        var url  = $('meta[name = path]').attr("content");
        var csrf = '@php echo csrf_token() @endphp';

        $(document).ready(function(){
            $("#payment_date").datepicker({
                dateFormat: "yy-mm-dd"
            });

            $("#payment_date").datepicker("setDate", new Date());

            @if(!empty($invoice_id))
                tax_bill_search();
            @endif

        });

    </script>

    <script src="{{ asset('js/holding_tax.js') }}"></script>
@endsection
