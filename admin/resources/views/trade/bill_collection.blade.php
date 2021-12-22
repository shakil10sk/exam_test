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

                    <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স ব্যবস্থাপনা</li>

                    <li class="breadcrumb-item active" aria-current="page">বিল কালেকশন</li>
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
                <input type="text" name="search_id" id="search_id" class="form-control" placeholder="Invoice/Tracking/Sonod No" />
            </div>

            <div class="col-md-1" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary" onclick="trade_bill_search()">সার্চ করুন</button>
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
                <div class="col-md-4" style="float: left;margin-top: 20px;">
                    <table class="table table-bordered " >
                        <tr >
                            <td>প্রতিষ্ঠানের নাম</td>
                            <td>সনদ নং</td>
                        </tr>

                        @foreach($unPaidSonodLists as $item)
                        
                        <tr id="sonod_{{$item->sonod_no}}"  >
                            <td width="50%" >{{ $item->organization_name_bn   }}
                            </td>
                            
                            <td style="cursor: pointer">
                                <input class="form-control sonod_nos" style="font-size: 14px;" onclick="setSearchID(this.value)" value="{{ $item->sonod_no }}" readonly />
                            </td>
                        </tr>
                        
                        @endforeach

                    </table>
                </div>

                <div class="col-md-8" style="float: left;margin-top: 20px;">
                    <div id="bill_list">
                    </div>

                    <div class="col-md-4" style="float: right;">
                        <input type="hidden" name="sonod_no" id="sonod_no" />

                        সর্বমোটঃ <input name="intotal" id="intotal" readonly class="form-control" /><br/>

                        পেমেন্ট তারিখঃ <input name="payment_date" id="payment_date" readonly class="form-control" /><br/>

                        <button class="btn btn-sm btn-danger" type="button" onclick="tradeBillCollectionReset()">Cancel</button>
                        <button class="btn btn-sm btn-primary" type="button" onclick="tradeBillCollection()">Pay</button>
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
        var trade_certificate_csrf = '@php echo  csrf_token() @endphp';


        $(document).ready(function(){
            $("#payment_date").datepicker({
                dateFormat: "yy-mm-dd"
            });

            $("#payment_date").datepicker("setDate", new Date());

        });

        function setSearchID(value){
           $("#search_id").val(value);
        }


    </script>

    <script src="{{ asset('js/trade.js') }}"></script>
@endsection
