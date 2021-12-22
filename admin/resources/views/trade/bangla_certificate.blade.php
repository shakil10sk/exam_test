<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>বাংলা ট্রেড লাইসেন্স সনদপত্র</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn',['type' => 19 ])

</head>

<body>

<div class="page-border">
    {{-- <img src="{{ public_path('assets/images/border3.png') }}"> --}}


    @if(! $print_setting->pad_print )
        @include('layouts.pdf_sub_layouts.certificate_header_bn')
    @else
        <table>
            <tr>
                <td style="height: 150px"></td>
            </tr>
        </table>
    @endif

    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
           cellpadding="0" cellspacing="0">

        <tr>
            <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                <font style="color: #FF0000;">
                    <u>ট্রেড লাইসেন্স</u>
                </font>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width: 100%">
                    <tr>
                        <td>ইস্যু
                            তারিখঃ {{ BanglaConverter::bn_others(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trade['organization']['generate_date'])->format('d-m-Y')) }}</td>

                        <td style="text-align: right;padding-right: 5px;">অর্থবছরঃ {{BanglaConverter::bn_others($fiscal_year_name)}}
                        </td>

                        <td style="text-align: right;padding-right: 5px;">মেয়াদ
                            উত্তীর্ণঃ {{BanglaConverter::bn_others( Carbon\Carbon::parse($trade['organization']['expire_date'])->format('d-m-Y')) }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>

            <td>

                <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;" cellpadding="0"
                       cellspacing="0">
                    <tr>
                        <td style="width:100px; text-align:center;font-weight:700;font-size:15px;">সনদ নং :</td>
                        @php

                            $sonod = str_split($trade['organization']['sonod_no']);

                            for($i=0; $i<strlen($trade['organization']['sonod_no']); $i++):

                        @endphp

                        <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                        @php
                            endfor;
                        @endphp
                    </tr>
                </table>
            </td>

        </tr>

    </table>

    <?php
        // echo "<pre>";
        // print_r($trade['owner_list']);
        // exit;
    ?>

    @if(count($trade['owner_list']) > 1)
    <table style="width:95%; margin-left:48px;margin-top:6px;" cellpadding="0" cellspacing="0">
        <tr>
            @foreach($trade['owner_list'] as $owner)

                @if(!empty($owner['photo']))
                    <td valign="top" style="text-align: right;">
                        <img src="{{ asset('images/application/'. $owner['photo']) }}" height="80px" width="80px"/>
                    </td>
                @elseif(strlen($owner['photo']) != 1)
                    <td valign="top" style="text-align: center;">
                            <img src="{{ asset('images/application/'. $owner['photo']) }}" height="80px" width="80px"/>
                        </td>
                @endif

            @endforeach

        </tr>

    </table>

    <div style="width:95%;">
        <div style=" float: left; width: 90%">
            <table width="95%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;
                margin-left: 40px; margin-top: {{ (count($trade['owner_list']) > 2 ) ? '4px':'20px' }}; ">
                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                    <td style="font-size:15px; text-align:left;">
                        :&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                </tr>
                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">ব্যবসার ধরণ</td>
                    <td style="font-size:15px; text-align:left;">
                        :&nbsp;{{ $trade['organization']['business_type_bn'] }}</td>
                </tr>

                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">মোবাইল</td>
                    <td style="font-size:15px; text-align:left;">
                        :&nbsp;{{ BanglaConverter::bn_others($trade['organization']['mobile']) }}</td>
                </tr>
                @if(isset($trade['organization']['email']) && !empty($trade['organization']['email']) )
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:15px;">ই-মেইল</td>
                        <td style="font-size:15px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
                    </tr>
                @endif
                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
                   <td style="font-size:15px; text-align:left;">:&nbsp;গ্রাম/মহল্লা :&nbsp;{{
                $trade['organization']['trade_village_bn'] }}&nbsp;
                        রোড/ব্লক/সেক্টর :&nbsp;{{ BanglaConverter::bn_number($trade['organization']['trade_rbs_bn']) }}&nbsp;
                        হোল্ডিং নং :&nbsp;{{ $trade['organization']['trade_holding_no'] }}&nbsp;
                        ওয়ার্ড নং :&nbsp;{{ $trade['organization']['trade_ward_no'] }}&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="font-size:15px; text-align:left;">&nbsp;
                        &nbsp;{{ $trade['organization']['trade_postoffice_name_bn'] }}&nbsp;
                        &nbsp;{{ $trade['organization']['trade_upazila_name_bn'] }}&nbsp;
                        &nbsp;{{ $trade['organization']['trade_district_name_bn'] }}
                    </td>
                </tr>
            </table>
        </div>

    </div>

    @else
    <div style="width:95%;">
        <div style=" float: left; width: 100%">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;
                margin-left: 40px; margin-top: {{ (count($trade['owner_list']) > 2 ) ? '4px':'20px' }};">
                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                    <td style="font-size:15px; text-align:left;">
                        :&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>

                    <td rowspan="3" style="text-align: right;" border="0">
                        <img src="{{ asset('images/application/'. $trade['owner_list'][0]['photo']) }}" height="80px" width="80px" style="float:right;"/>
                    </td>
                </tr>

                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">ব্যবসার ধরণ</td>
                    <td style="font-size:15px; text-align:left;">
                        :&nbsp;{{ $trade['organization']['business_type_bn'] }}</td>
                </tr>

                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">মোবাইল</td>
                    <td style="font-size:15px; text-align:left;">
                        :&nbsp;{{ BanglaConverter::bn_others($trade['organization']['mobile']) }}</td>
                </tr>

                @if(isset($trade['organization']['email']) && !empty($trade['organization']['email']) )
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:15px;">ই-মেইল</td>
                        <td style="font-size:15px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
                    </tr>
                @endif

                <tr>
                    <td style="text-indent: 20px;text-align:left; font-size:15px;">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
                   <td colspan="2" style="font-size:15px; text-align:left;">:
                   &nbsp;গ্রাম/মহল্লা :&nbsp;{{$trade['organization']['trade_village_bn'] }}&nbsp;
                        রোড/ব্লক/সেক্টর :&nbsp;{{ BanglaConverter::bn_number($trade['organization']['trade_rbs_bn']) }}&nbsp;
                        হোল্ডিং নং :&nbsp;{{ $trade['organization']['trade_holding_no'] }}&nbsp;
                        ওয়ার্ড নং :&nbsp;{{ $trade['organization']['trade_ward_no'] }}&nbsp;
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="2">
                        &nbsp;{{ $trade['organization']['trade_postoffice_name_bn'] }}&nbsp;
                        &nbsp;{{ $trade['organization']['trade_upazila_name_bn'] }}&nbsp;
                        &nbsp;{{ $trade['organization']['trade_district_name_bn'] }}
                    </td>
                </tr>

            </table>
        </div>

    </div>
    @endif



{{--    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0'--}}
{{--           style="border-collapse:collapse;margin:0 auto;  table-layout:fixed; margin-top: 2px">--}}

{{--        <tr>--}}
{{--            <td align='left' style="font-size:15px; text-indent: 20px;text-align:left;font-color:black; width:--}}
{{--                230px;--}}
{{--                padding-left: 40px">ব্যবসা প্রতিষ্ঠানের ঠিকানা--}}
{{--            </td>--}}
{{--            <td valign='top' style="font-weight:bold;  font-size:15px; text-align:left;"> &nbsp; &nbsp; : {{--}}
{{--                $trade['organization']['trade_village_bn'] }}--}}
{{--                ,&nbsp;{{ BanglaConverter::bn_number($trade['organization']['trade_ward_no']) }}--}}
{{--                ,&nbsp;{{ $trade['organization']['trade_postoffice_name_bn'] }}--}}
{{--                ,&nbsp;{{ $trade['organization']['trade_upazila_name_bn'] }}--}}
{{--                ,&nbsp;{{ $trade['organization']['trade_district_name_bn'] }}--}}
{{--            </td>--}}
{{--        </tr>--}}


{{--    </table>--}}

    <table width="88%" cellpadding="0" cellspacing="0" border="1"
           style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto;
           margin-top: {{ (count($trade['owner_list']) > 2 )? '5px' : '20px'  }}">

        <tr style="text-align: center;font-weight:bolder;">
            <th>নং</th>
            <td style="font-weight: 700px; font-size: 17px;">প্রোপাইটরের নাম</td>

            @if( (int) $trade['organization']['owner_type'] != 4 )
                {{-- @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                    <th style="font-weight: 700px; font-size: 17px;">স্বামীর নাম</th>
                @else
                    <th style="font-weight: 700px; font-size: 17px;">পিতার নাম</th>
                @endif --}}

                <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
                <th style="font-weight: 700px; font-size: 17px;">মাতার নাম</th>
            @endif


            <th style="font-weight: 700px; font-size: 17px;"> {{ ((int) $trade['organization']['owner_type'] != 4)?
            "পরিচয় পত্র/ জন্ম নিবন্ধন": "প্রতিষ্ঠানের আইডি/কোড নং " }} </th>
        </tr>

        @php
            $i = 1;
        @endphp

        @foreach($trade['owner_list'] as $owner)


            <tr height="20px" style="text-align: center;">
                <td>{{ BanglaConverter::bn_number($i++) }}</td>
                <td>{{  $owner['name_bn'] }}</td>
                @if( (int) $trade['organization']['owner_type'] != 4 )
                    <td>

                        @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                            {{ $owner['husband_name_bn'] }}
                        @else
                            {{ $owner['father_name_bn'] }}
                        @endif


                    </td>
                    <td>
                        {{ $owner['mother_name_bn'] }}
                    </td>
                @endif
                <td>

                    @if ($owner['nid'] > 0)
                        {{ BanglaConverter::bn_others($owner['nid']) }}
                    @else
                        {{ BanglaConverter::bn_others($owner['birth_id']) }}
                    @endif

                </td>

            </tr>
            @if( (int) $trade['organization']['owner_type'] != 4 )
               <tr height='25px'>
                    <td colspan="5">

                        <p style="font-size:14px;">বর্তমান ঠিকানা
                            : &nbsp;গ্রাম/মহল্লা:&nbsp;{{ $owner['present_village_bn'] }}
                            &nbsp; রোড/ব্লক/সেক্টর:&nbsp; {{ $owner['present_rbs_bn'] }}
                            &nbsp; ওয়ার্ড নং :&nbsp; {{ BanglaConverter::bn_number($owner['present_ward_no']) }}
                            &nbsp; হোল্ডিং নং :&nbsp; {{ BanglaConverter::bn_number($owner['present_holding_no']) }}
                            &nbsp; {{ $owner['present_postoffice_name_bn'] }}
                            &nbsp; {{ $owner['present_upazila_name_bn'] }}
                            &nbsp; {{ $owner['present_district_name_bn'] }}
                        </p>

                    </td>
                </tr>
                <tr height='25px'>
                    <td colspan="5">

                        <p style="font-size:14px;">স্থায়ী ঠিকানা
                            : &nbsp;গ্রাম/মহল্লা:&nbsp;{{ $owner['permanent_village_bn'] }}
                            &nbsp; রোড/ব্লক/সেক্টর:&nbsp; {{ $owner['permanent_rbs_bn'] }}
                            &nbsp; ওয়ার্ড নং :&nbsp; {{ BanglaConverter::bn_number($owner['permanent_ward_no']) }}
                            &nbsp; হোল্ডিং নং :&nbsp; {{ BanglaConverter::bn_number($owner['permanent_holding_no']) }}
                            &nbsp; {{ $owner['permanent_postoffice_name_bn'] }}
                            &nbsp; {{ $owner['permanent_upazila_name_bn'] }}
                            &nbsp; {{ $owner['permanent_district_name_bn'] }}
                        </p>

                    </td>
                </tr>
            @endif
        @endforeach

    </table>



    <table class="jolchap" align="center" border="1" height="400px" width='60%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto; table-layout:fixed; margin-top: 8px">

        {{ $due = 0, $discount = 0, $due_bibidh = 0, $signbord_vat = 0, $pesha_vat = 0, $source_vat = 0,  $sarcharge
        = 0 }}

        {{ $vat = 0, $due_fee = 0, $due_vat  = 0, $bibidh = 0, $due_signbord_vat  = 0, $due_source_vat = 0,
        $due_sarcharge  = 0 , $due_discount  = 0 }}

        <tr>
            <td align="center" rowspan="2"><b>আদায়ের বিবরণ</b></td>
            <td align="center" colspan="2"><b>পরিমাণ</b></td>
            <td align="center" rowspan="2"><b>মোট আদায়</b></td>
        </tr>

        <tr>
            <td align="center" style="font-size: {{ isset( $trade['due_year_name']) ? '14px' : '10px' }};"><b>বকেয়া আদায় /অর্থবছর</b>
            <p style="font-size:11px;">{{ isset( $trade['due_year_name']) ? (BanglaConverter::bn_number($trade['due_year_name'])) :'' }}</p>
            </td>
            <td align="center"><b>হাল আদায়</b></td>
        </tr>

        @php  @endphp

        {{-- TL main fee --}}
        <tr>
            <td align="left" nowrap
                style="font-size:15px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ট্রেড
                লাইসেন্স ফি(বার্ষিক)
            </td>

            <td align="right">
                <?php echo (isset($trade['due_data'][19])) ? BanglaConverter::bn_number($trade['due_data'][19]['amount']) : ''; $due_fee = isset($trade['due_data'][19]) ? $trade['due_data'][19]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left;font-size:15px; ">
                <?php echo (isset($trade['fee_data'][19])) ? BanglaConverter::bn_number($trade['fee_data'][19]['amount']) : ''; $fee = $trade['fee_data'][19]['amount']  ?>
                &nbsp;
            </td>

            <td align="right">
                <?php echo BanglaConverter::bn_number($due_fee + $fee); ?> &nbsp;
            </td>

        </tr>

        @if(!empty($trade['due_data'][21]) || !empty($trade['fee_data'][21])  )
        {{-- Signboard fee --}}
        <tr>
            <td align="left" nowrap
                style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সাইনবোর্ড
                কর(বার্ষিক)
            </td>

            <td align="right">
                <?php echo (isset($trade['due_data'][21])) ? BanglaConverter::bn_number($trade['due_data'][21]['amount']) : ''; $due_signbord_vat = isset($trade['due_data'][21]) ? $trade['due_data'][21]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left;font-size:15px; ">&nbsp;
                <?php echo (isset($trade['fee_data'][21])) ? BanglaConverter::bn_number($trade['fee_data'][21]['amount']) : ''; $signbord_vat = isset($trade['fee_data'][21]) ? $trade['fee_data'][21]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right">
                <?php echo BanglaConverter::bn_number($due_signbord_vat + $signbord_vat); ?> &nbsp;
            </td>

        </tr>
        @endif



       @if(!empty($trade['due_data'][39]) || !empty($trade['fee_data'][39])  )
        {{-- bibidh_fee fee --}}
        <tr>
            <td align="left" nowrap
                style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">আবেদন ফি
            </td>

            <td align="right">
                <?php echo (isset($trade['due_data'][120])) ? BanglaConverter::bn_number($trade['due_data'][39]['amount']) : ''; $due_bibidh = isset($trade['due_data'][39]) ? $trade['due_data'][120]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left;font-size:15px; ">&nbsp;
                <?php echo (isset($trade['fee_data'][39])) ? BanglaConverter::bn_number($trade['fee_data'][39]['amount']) : ''; $bibidh = isset($trade['fee_data'][39]) ? $trade['fee_data'][39]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right">
                <?php echo BanglaConverter::bn_number($due_bibidh + $bibidh); ?> &nbsp;
            </td>

        </tr>
        @endif

        @if(!empty($trade['due_data'][25]) || !empty($trade['fee_data'][25])  )
        {{-- VAT --}}
        <tr>
            <td align="left" nowrap
                style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px"> ভ্যাট
                বাবদ জমা
            </td>

            <td align="right">
                <?php echo (isset($trade['due_data'][25])) ? BanglaConverter::bn_number($trade['due_data'][25]['amount']) : ''; $due_vat = isset($trade['due_data'][25]) ? $trade['due_data'][25]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left; font-size:15px;">&nbsp;
                <?php echo (isset($trade['fee_data'][25])) ? BanglaConverter::bn_number(round($trade['fee_data'][25]['amount']))  : ''; $vat = round(isset($trade['fee_data'][25]) ? $trade['fee_data'][25]['amount'] : 0); ?>
                &nbsp;
            </td>

            <td align="right">
                <?php echo BanglaConverter::bn_number($due_vat + $vat  ); ?> &nbsp;
            </td>
        </tr>
        @endif

        @if(!empty($trade['due_data'][97]) || !empty($trade['fee_data'][97]) )  )
        {{-- Source Vat (97) --}}
        <tr>
            <td align="left" nowrap
                style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">উৎসে কর
            </td>

            <td align="right">
                <?php echo (isset($trade['due_data'][97])) ? BanglaConverter::bn_number($trade['due_data'][97]['amount']) : ''; $due_source_vat = isset($trade['due_data'][97]) ? $trade['due_data'][97]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left; font-size:15px;">&nbsp;
                <?php echo (isset($trade['fee_data'][97])) ? BanglaConverter::bn_number($trade['fee_data'][97]['amount']) : ''; $source_vat = isset($trade['fee_data'][97]) ? $trade['fee_data'][97]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right">
                <?php echo BanglaConverter::bn_number($due_source_vat + $source_vat); ?> &nbsp;
            </td>

        </tr>
        @endif



        {{-- sar-charge (22) --}}
        @if ($union->union_code == 292700)

            {{-- @if(!empty($trade['due_data'][22]) || !empty($trade['fee_data'][22])  ) --}}
            <tr>
                <td align="left" nowrap
                    style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সারচার্জ
                </td>

                <td align="right">
                    <?php echo BanglaConverter::bn_number(isset($trade['due_data'][22]) ? $trade['due_data'][22]['amount'] : 0); $due_sarcharge = isset($trade['due_data'][22]) ? $trade['due_data'][22]['amount'] : 0; ?>
                    &nbsp;
                </td>

                <td align="right" style="text-align:left; font-size:15px;">&nbsp;
                    <?php echo BanglaConverter::bn_number(isset($trade['fee_data'][22]) ? BanglaConverter::bn_number($trade['fee_data'][22]['amount']) : 0); $sarcharge = isset($trade['fee_data'][22]) ? $trade['fee_data'][22]['amount'] : 0; ?>
                    &nbsp;
                </td>

                <td align="right">
                    <?php echo BanglaConverter::bn_number($due_sarcharge + $sarcharge); ?> &nbsp;
                </td>

            </tr>
            {{-- @endif --}}
        @else
            @if(!empty($trade['due_data'][22]) || !empty($trade['fee_data'][22])  )
            <tr>
                <td align="left" nowrap
                    style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সারচার্জ
                </td>

                <td align="right">
                    <?php echo BanglaConverter::bn_number(isset($trade['due_data'][22]) ? $trade['due_data'][22]['amount'] : 0); $due_sarcharge = isset($trade['due_data'][22]) ? $trade['due_data'][22]['amount'] : 0; ?>
                    &nbsp;
                </td>

                <td align="right" style="text-align:left; font-size:15px;">&nbsp;
                    <?php echo BanglaConverter::bn_number(isset($trade['fee_data'][22]) ? BanglaConverter::bn_number($trade['fee_data'][22]['amount']) : 0); $sarcharge = isset($trade['fee_data'][22]) ? $trade['fee_data'][22]['amount'] : 0; ?>
                    &nbsp;
                </td>

                <td align="right">
                    <?php echo BanglaConverter::bn_number($due_sarcharge + $sarcharge); ?> &nbsp;
                </td>

            </tr>
            @endif
        @endif

        @if(!empty($trade['due_data'][24]) || !empty($trade['fee_data'][24])  )
        {{-- Discount (24) --}}
        <tr>
            <td align="left" nowrap
                style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ছাড়
            </td>

            <td align="right">
                <?php echo (isset($trade['due_data'][24])) ? BanglaConverter::bn_number($trade['due_data'][24]['amount']) : ''; $due_discount = isset($trade['due_data'][24]) ? $trade['due_data'][24]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left;font-size:15px; ">&nbsp;
                <?php echo (isset($trade['fee_data'][24])) ? BanglaConverter::bn_number($trade['fee_data'][24]['amount']) : ''; $discount = isset($trade['fee_data'][24]) ? $trade['fee_data'][24]['amount'] : 0; ?>
                &nbsp;
            </td>

            <td align="right">
                <?php echo BanglaConverter::bn_number($due_discount + $discount); ?> &nbsp;
            </td>

        </tr>
        @endif

        {{-- Due
        @if((isset($trade['fee_data'][23])))

            <tr>
                <td align="left" nowrap style="font-size:15px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">বকেয়া </td>

                <td></td>

                <td align="right" style="text-align:left;font-size:15px; ">&nbsp;
                    <?php //echo (isset($trade['fee_data'][23])) ? BanglaConverter::bn_number($trade['fee_data'][23]['amount']) : ''; $due = $trade['fee_data'][23]['amount']  ?>&nbsp;
                </td>

                <td></td>

            </tr>

        @endif --}}

        <tr>
            <td align="right" nowrap style="font-size:15px;text-indent:55px; font-color:black; width: 150px;
                padding-left: 50px">সর্বমোট:
            </td>

            <td align="right" style="text-align:left; font-size:15px; ">&nbsp;
                <?php  $due_total = (int)(($due_fee + $due_vat + $due_signbord_vat + $due_bibidh + $due_source_vat + $due_sarcharge) - $due_discount); echo BanglaConverter::bn_others(number_format($due_total, 2)); ?>
                &nbsp;
            </td>

            <td align="right" style="text-align:left; font-size:15px; ">&nbsp;
                <?php  $total = (int)(($fee + $due + $vat + $signbord_vat  + $pesha_vat + $source_vat + $sarcharge + $bibidh)
                    - $discount); echo BanglaConverter::bn_others(number_format($total, 2)); ?>&nbsp;
            </td>

            <td align="right" style="text-align:left; font-size:15px; ">&nbsp;
                {{BanglaConverter::bn_others(number_format($total + $due_total, 2))}}
            </td>

        </tr>
        <tr>
            <td align="right" colspan="1" nowrap style="font-size:15px;text-indent:55px; font-color:black; width: 150px;
                padding-left: 50px">কথায় :
            </td>
            <td align="left" colspan="3" nowrap style="font-size:15px;text-indent:55px; font-color:black; width: 150px;
                padding-left: 50px">{{BanglaConverter::bn_word($total + $due_total)}} টাকা মাত্র
            </td>



        </tr>


    </table>
<br>
    <table border='0' width='98%' cellpadding='0' cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;padding-top:0px;">

        <tr>
            @php $owner_photo_count = count(array_filter(array_column($trade['owner_list'],'photo')))  @endphp
            <td style="font-size:13px;  padding-left:80px;" height="{{ ($owner_photo_count > 0  ) ? '50':'50'
            }}">এই ব্যবসায়ীক কর পৌরসভা আইন ২০০৯ ( ২০০৯ সনের ৫৮নং আইন ) এর ধারা ১০০ এর প্রেক্ষিতে পৌরসভা আদর্শ কর
                <br>তফসিল ২০১৪ এর ধারা ৬(১) ও ৬(২) বার্ষিক কর মোতাবেক ব্যবসা/পেশার অনুমোদন পত্র বর্ণিত
                ব্যক্তি/প্রতিষ্ঠানের অনুকূলে <br> দেওয়া হইল।যাহার মেয়াদ ৩০-০৬ ({{ BanglaConverter::bn_number($fiscal_year_name) }} অর্থবছর ) পর্যন্ত বলবৎ থাকিবে।
            </td>

        </tr>

    </table>


    <div style="position: fixed; bottom: 5px; margin-top: {{ ($owner_photo_count > 0  ) ? '100px':'50px'
            }}">

        <table width="95%" cellpadding="0" cellspacing="0" border="0"
               style="border-collapse:collapse;margin-left: 50px; margin-top:{{ (count($trade['owner_list']) >= 2 )?
               '15px':'20px' }};">

            <tr>
                <td style="padding-left:10px;font-size:15px;">
                    <div style="float:left;">
                        <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>
                            লাইসেন্স পরিদর্শক </font>
                    </div>
                </td>
                @if (Auth::user()->union_id == 292700 ) //madhukhali

                <td style="padding-right: 50px;font-size:15px;">
                    <div style="float:left;">
                        <font style='position:relative;border-top: 1px solid black;'>
                            সিল </font>
                    </div>
                </td>

                @endif
                <td style="padding-right:50px;font-size:15px; ">
                    <div style="float: left">
                        <font style='position:relative;float:left;left:50px;border-top: 1px solid black;'>মেয়র</font>
                    </div>
                </td>
                {{-- <td>
                    <div style="display:inline;float:left">
                        <font style='float:left;right:20px;position:relative;border-top: 1px solid black;'>
                            &nbsp;&nbsp; &nbsp;&nbsp; মেয়র &nbsp;&nbsp;&nbsp;&nbsp;</font>
                    </div>
                </td> --}}
            </tr>




        </table>


        <table border='0' width="99%"  cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                <td colspan="{{$colspan}}"
                    style="padding-left:20px;padding-top:5px;padding-bottom:5px;font-size:15px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b>নির্দেশাবলীঃ </b>
                    <br/>

                    ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile
                    থেকে QR code টি Scan করুন।
                    <br/>২) প্রয়োজনীয় তথ্য জানার জন্য {{ $union->bn_name }} কার্যালয়ে যোগাযোগ করুন।
                    <br/>৩) নবায়নের সময় পুরাতন লাইসেন্সটি সঙ্গে নিয়ে আসুন।
                    <!-- <br/>৪) প্রয়োজনীয় তথ্য জানার জন্য {{ $union->bn_name  }} যোগাযোগ করূন । -->

                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url . '/verify/trade_bn/' . $trade['organization']['sonod_no'] . '/' . $trade['organization']['union_id'] . '/' . $trade['organization']['fiscal_year_id'];

                    ?>

                    <img
                        src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                        height="130" width="170">

                </td>

            </tr>

        </table>

        <table border='0' width="99%" cellpadding='0' cellspacing='0'
               style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">

            <tr>
                <td style="width: 75%;text-align:center;padding-left: 20px">
                    <font style="font-size:11px">web:{{ $union->sub_domain }}</font>
                    <span>-</span>
                    <font style="font-size:11px;"> Email:{{ $union->email }}</font>
                </td>
                <td style="width: 25%;text-align:center;padding-left: 40px">

                    <font style="font-size:10px;opacity:0.7;">Developed by Innovation IT. </font>

                    <br>

                    <font style="font-size:10px;opacity:0.7;">www.innovationit.com.bd </font></td>

            </tr>
        </table>
    </div>
</div>
</body>
</html>

