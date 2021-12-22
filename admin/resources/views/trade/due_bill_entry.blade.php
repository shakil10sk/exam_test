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
        width: 70%;
        margin-left: 50px;
    }

    .fiscal-year{
        /*text-decoration: underline;*/
    }
</style>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>

                    <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স ব্যবস্থাপনা</li>

                    <li class="breadcrumb-item active" aria-current="page">বকেয়া বিল</li>
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
                <input type="text" name="search_id" id="search_id" class="form-control" placeholder="Sonod No" value="{{isset($_GET['sno']) ? $_GET['sno'] : ''}}" />
            </div>

            <div class="col-md-1" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary" onclick="trade_sonod_search()">সার্চ করুন</button>
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
                <div class="col-md-2" style="float: left;"></div>

                <div class="col-md-8" style="float: left;margin-top: 20px;">
                    <div id="bill_list" style="display: none;">
                        
                        <table style="width: 100%">
                            <tr>
                                <td>ট্র্যাকিং নংঃ <span id="tracking"></span></td>
                                <td>মোবাইলঃ  <span id="mobile_no"></span></td>
                            </tr>
                            
                            <tr>
                                <td>ব্যবসা প্রতিষ্ঠানের নামঃ <span id="business_name"></span></td>
                                <td>ব্যবসার ধরণঃ <span id="business_type_name"></span></td>
                            </tr>
                        </table>

                        <br/>

                        <div class="col-md-6">অর্থ বছরঃ  
                            <input type="text" name="fiscal_year_id" id="fiscal_year_id" class="form-control col-md-6 float-right" />

                                {{-- @foreach($fiscal_year_list as $item)
                                    @if($item->id != $current_fiscal_year)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach --}}
                        </div>

                        <hr>

                        <table class="inv-tbl">
                            <tr>
                                <td>১. </td>
                                <td>লাইসেন্স ফি</td>
                                <td>
                                    <input name="license_fee" id="license_fee" class="form-control col-md-6 float-right" onkeyup="dueBillCalculate()" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>২. </td>
                                <td>সাইনবোর্ড ফি</td>
                                <td>
                                    <input name="signboard_fee" id="signboard_fee" class="form-control col-md-6 float-right" onkeyup="dueBillCalculate()" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>৩. </td>
                                <td>ভ্যাট</td>
                                <td>
                                    <input name="vat" id="vat" class="form-control col-md-6 float-right" onkeyup="dueBillCalculate()" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>৪. </td>
                                <td>উৎসে কর</td>
                                <td>
                                    <input name="source_vat" id="source_vat" class="form-control col-md-6 float-right" onkeyup="dueBillCalculate()" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>৫. </td>
                                <td>সারচার্জ</td>
                                <td>
                                    <input name="sar_charge" id="sar_charge" class="form-control col-md-6 float-right" onkeyup="dueBillCalculate()" />
                                </td>
                            </tr>
                            
                        </table>
                    </div>

                    <div class="col-md-4" style="float: right;">
                        <input type="hidden" name="sonod_no" id="sonod_no" />

                        সর্বমোটঃ <input name="intotal" id="intotal" readonly class="form-control" /><br/>
                        
                        <button class="btn btn-sm btn-danger" type="button" onclick="dueBillReset()">Cancel</button>
                        
                        <button class="btn btn-sm btn-primary" type="button" onclick="dueBillSave()">Save</button>
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
        var trade_certificate_csrf = '@php echo  csrf_token() @endphp';

        $(document).ready(function(){
            var sno = $("#search_id").val();
            
            if(sno != ''){
                trade_sonod_search();
            }
        });

    </script>
        
    <script src="{{ asset('js/trade.js') }}"></script>
@endsection