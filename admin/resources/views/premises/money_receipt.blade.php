<html>
<head>
    <base href=""/>
    <title>প্রিমিসেস লাইসেন্স মানি রসিদ</title>
    <style>
        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 10px;
        }


        @page {
            header: page-header;
            footer: page-footer;
            margin: 20px 0px;
            padding: 0px;

        }

        @media print {
            body {
                font-family: 'bangla', sans-serif !important;
            }

            * {
                -webkit-print-color-adjust: exact;
            }

        }


    </style>
</head>

<body>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 10px">
    <tr>
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}"
                                                         height="80px" width="80px"/></td>

        <td style="text-align:center;">
            <font style="font-size:12px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

            <br/>

            <font style="font-size:10px; font-weight:bold;">
                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                -{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, --}}
                 ই-মেইলঃ {{ $union->email }} <br>
                {{-- ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }} --}}
                ওয়েব সাইট : {{ request()->getHost() }}
                <br>
                (অফিস কপি)
            </font>

        </td>

        <td style="width:1.2in; text-align:left;">

            @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px"
                     style="position:relative;right:10px;"/>
            @endif

        </td>

    </tr>
</table>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">


    <tr>
        <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
        <td>
            <font>&nbsp;:&nbsp;{{ $data['organization']->organization_name_bn }}</font>
        </td>

        <td align='right'><b> ব্যাংকের নাম ও শাখা </b></td>
        <td>
            <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
        </td>

    </tr>
    <tr>
        {{-- <td style="padding-left: 50px"><b>ঠিকানা </b></td> --}}
        <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
        <td>
            <font>&nbsp;:&nbsp;
            {{$data['organization']->premises_ward_no > 0 ? BanglaConverter::bn_number($data['organization']->premises_ward_no) . ' নং ওয়ার্ড, ' : ''}}

            {{ $data['organization']->premises_village_bn }},

            {{-- {{ $data['organization']->premises_ward_no }} --}}

            </font>
        </td>
        <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
    </tr>
    <tr>
        <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
        <td>
            <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data['organization']->voucher) }}</font>
        </td>
        <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['organization']->sonod_no) }}</font>
                </td>
    </tr>
</table>


<table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">


    <tr>
        <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
        <td height='22' style="width:75%;text-align:center;font-size:10px;"><font> বর্ণনা </font></td>
        <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা)</td>
    </tr>

    @if(isset($data['fee_data']['90']))

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

            </td>
            <td style="height:80px;text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                @if(isset($data['fee_data']['90']))
                    {{ $data['fee_data']['90']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['23']))
                    <br>{{ $data['fee_data']['23']['account_name'] }}
                @endif


                @if(isset($data['fee_data']['24']))
                    <br> {{ $data['fee_data']['24']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['25']))
                    <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['21']))
                    <br>{{ $data['fee_data']['21']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['28']))
                    <br>{{ $data['fee_data']['28']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['22']))
                    <br>{{ $data['fee_data']['22']['account_name'] }}
                @endif
                @if(isset($data['fee_data']['97']))
                    <br>{{ $data['fee_data']['97']['account_name'] }}
                @endif

            </td>

            <td valign='top' style="text-align:right;">

                <?php $fee = 0; $due = 0; $discount = 0; $vat = 0; $signbord = 0; $source_vat = 0; $sarcharge = 0;?>

                @if(isset($data['fee_data']['90']))

                    <?php $fee = $data['fee_data']['90']['amount']; echo BanglaConverter::bn_number(number_format
                    ($data['fee_data']['90']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['23']))

                    <br><?php $due = $data['fee_data']['23']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['23']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif



                @if(isset($data['fee_data']['24']))

                    <br><?php $discount = $data['fee_data']['24']['amount']; echo "(-) " . BanglaConverter::bn_number(number_format($data['fee_data']['24']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['25']))

                    <br><?php $vat = $data['fee_data']['25']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['25']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['21']))

                    <br><?php $signbord = $data['fee_data']['21']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['21']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif


                @if(isset($data['fee_data']['22']))

                    <br><?php $sarcharge = $data['fee_data']['22']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['22']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif
                @if(isset($data['fee_data']['97']))

                    <br><?php $source_vat = $data['fee_data']['97']['amount']; echo BanglaConverter::bn_number
                    (number_format($data['fee_data']['97']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

            </td>
        </tr>

    @endif


    <tr>

        <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
        <td height='23'
            style="text-align:right; font-size:10px;"><?php $total = (($fee + $due + $vat + $signbord + $source_vat + $sarcharge) - $discount); echo BanglaConverter::bn_number($total); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
</table>
<h4 style="margin-left:20px;" >কথায় লিখুন : {{BanglaConverter::bn_word($total)}}</h4>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px 0px auto;">

    <tr>
        <td style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>আদায়কারী
        </td>
        <td style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">সীল</span>
        </td>
        <td style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>যাচাইকারী
        </td>
    </tr>

</table>


<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;">
    <tr>
        <td style="border-bottom: 2px dotted;">

        </td>
    </tr>
</table>
<br/>

<!----------------second part----------------->


<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 10px">
    <tr>
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}"
                                                         height="80px" width="80px"/></td>

        <td style="text-align:center;">
            <font style="font-size:12px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

            <br/>

            <font style="font-size:10px; font-weight:bold;">
                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                -{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, --}}
                 ই-মেইলঃ {{ $union->email }} <br>
                {{-- ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }} --}}
                ওয়েব সাইট : {{ request()->getHost() }}
                <br>
                (গ্রাহক কপি)
            </font>

        </td>

        <td style="width:1.2in; text-align:left;">
            @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px"
                     style="position:relative;right:10px;"/>
            @endif
        </td>

    </tr>
</table>


<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">


    <tr>
        <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
        <td>
            <font>&nbsp;:&nbsp;{{ $data['organization']->organization_name_bn }}</font>
        </td>

        <td align='right'><b> ব্যাংকের নাম ও শাখা </b></td>
        <td>
            <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
        </td>

    </tr>
    <tr>
        {{-- <td style="padding-left: 50px"><b>ঠিকানা </b></td> --}}
        <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
        <td>
            <font>&nbsp;:&nbsp;
            {{$data['organization']->premises_ward_no > 0 ? BanglaConverter::bn_number($data['organization']->premises_ward_no) . ' নং ওয়ার্ড, ' : ''}}

            {{ $data['organization']->premises_village_bn }},

            {{-- {{ $data['organization']->premises_ward_no }} --}}

            </font>
        </td>
        <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
    </tr>
    <tr>
        <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
        <td>
            <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data['organization']->voucher) }}</font>
        </td>
        <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['organization']->sonod_no) }}</font>
                </td>
    </tr>
</table>


<table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">


    <tr>
        <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
        <td height='22' style="width:75%;text-align:center;font-size:10px;"><font> বর্ণনা </font></td>
        <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা)</td>
    </tr>

    @if(isset($data['fee_data']['90']))

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

            </td>
            <td style="height:80px;text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                @if(isset($data['fee_data']['90']))
                    {{ $data['fee_data']['90']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['23']))
                    <br>{{ $data['fee_data']['23']['account_name'] }}
                @endif


                @if(isset($data['fee_data']['24']))
                    <br> {{ $data['fee_data']['24']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['25']))
                    <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['21']))
                    <br>{{ $data['fee_data']['21']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['28']))
                    <br>{{ $data['fee_data']['28']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['22']))
                    <br>{{ $data['fee_data']['22']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['97']))
                    <br>{{ $data['fee_data']['97']['account_name'] }}
                @endif


            </td>

            <td valign='top' style="text-align:right;">

                <?php $fee = 0; $due = 0; $discount = 0; $vat = 0; $signbord = 0; $source_vat = 0; $sarcharge = 0;?>

                @if(isset($data['fee_data']['90']))

                    <?php $fee = $data['fee_data']['90']['amount']; echo BanglaConverter::bn_number(number_format
                    ($data['fee_data']['90']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['23']))

                    <br><?php $due = $data['fee_data']['23']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['23']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif



                @if(isset($data['fee_data']['24']))

                    <br><?php $discount = $data['fee_data']['24']['amount']; echo "(-) " . BanglaConverter::bn_number(number_format($data['fee_data']['24']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['25']))

                    <br><?php $vat = $data['fee_data']['25']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['25']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['21']))

                    <br><?php $signbord = $data['fee_data']['21']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['21']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['28']))

                    <br><?php $pesha = $data['fee_data']['28']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['28']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['22']))

                    <br><?php $sarcharge = $data['fee_data']['22']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['22']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['97']))

                    <br><?php $source_vat = $data['fee_data']['97']['amount']; echo BanglaConverter::bn_number
                    (number_format($data['fee_data']['97']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif
            </td>
        </tr>

    @endif


    <tr>
        <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
        <td height='23'
            style="text-align:right; font-size:10px;"><?php $total = (($fee + $due + $vat + $signbord + $source_vat + $sarcharge) - $discount); echo BanglaConverter::bn_number($total); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
</table>
<h4 style="margin-left:20px;" >কথায় লিখুন : {{BanglaConverter::bn_number($total)}}</h4>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px 0px auto;">

    <tr>
        <td style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>আদায়কারী
        </td>
        <td style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">সীল</span>
        </td>
        <td style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>যাচাইকারী
        </td>
    </tr>

</table>
<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;">
    <tr>
        <td style="border-bottom: 2px dotted;">

        </td>
    </tr>
</table>
<br/>

{{-- third part --}}

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:8px auto; padding-top: 10px">
    <tr>
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

        <td style="text-align:center;">
            <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

            <br />

            <font style="font-size:10px; font-weight:bold;">
                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                ই-মেইলঃ {{ $union->email }} <br>
                {{-- ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }} --}}
                ওয়েব সাইট : {{ request()->getHost() }}
                <br>
                (ব্যাংক কপি)
            </font>

        </td>

        <td style="width:1.2in; text-align:left;">
            @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
            @endif
        </td>

    </tr>
</table>


<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">


    <tr>
        <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
        <td>
            <font>&nbsp;:&nbsp;{{ $data['organization']->organization_name_bn }}</font>
        </td>

        <td align='right'><b> ব্যাংকের নাম ও শাখা </b></td>
        <td>
            <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
        </td>

    </tr>
    <tr>
        {{-- <td style="padding-left: 50px"><b>ঠিকানা </b></td> --}}
        <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
        <td>
            <font>&nbsp;:&nbsp;
            {{$data['organization']->premises_ward_no > 0 ? BanglaConverter::bn_number($data['organization']->premises_ward_no) . ' নং ওয়ার্ড, ' : ''}}

            {{ $data['organization']->premises_village_bn }},

            {{-- {{ $data['organization']->premises_ward_no }} --}}

            </font>
        </td>
        <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
    </tr>
    <tr>
        <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
        <td>
            <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data['organization']->voucher) }}</font>
        </td>
        <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['organization']->sonod_no) }}</font>
                </td>
    </tr>
</table>



<table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">


    <tr>
        <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
        <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
        <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
    </tr>

    @if(isset($data['fee_data']['90']))

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

            </td>
            <td style="height:80px;text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                @if(isset($data['fee_data']['90']))
                    {{ $data['fee_data']['90']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['23']))
                    <br>{{ $data['fee_data']['23']['account_name'] }}
                @endif


                @if(isset($data['fee_data']['24']))
                    <br> {{ $data['fee_data']['24']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['25']))
                    <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['21']))
                    <br>{{ $data['fee_data']['21']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['28']))
                    <br>{{ $data['fee_data']['28']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['22']))
                    <br>{{ $data['fee_data']['22']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['97']))
                    <br>{{ $data['fee_data']['97']['account_name'] }}
                @endif


            </td>

            <td valign='top' style="text-align:right;">

                <?php $fee = 0; $due = 0; $discount = 0; $vat = 0; $signbord = 0; $source_vat = 0; $sarcharge = 0;?>

                @if(isset($data['fee_data']['90']))

                    <?php $fee = $data['fee_data']['90']['amount']; echo BanglaConverter::bn_number(number_format
                    ($data['fee_data']['90']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['23']))

                    <br><?php $due = $data['fee_data']['23']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['23']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif



                @if(isset($data['fee_data']['24']))

                    <br><?php $discount = $data['fee_data']['24']['amount']; echo "(-) " . BanglaConverter::bn_number(number_format($data['fee_data']['24']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['25']))

                    <br><?php $vat = $data['fee_data']['25']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['25']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['21']))

                    <br><?php $signbord = $data['fee_data']['21']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['21']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['28']))

                    <br><?php $pesha = $data['fee_data']['28']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['28']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['22']))

                    <br><?php $sarcharge = $data['fee_data']['22']['amount']; echo BanglaConverter::bn_number(number_format($data['fee_data']['22']['amount'])); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['97']))

                    <br><?php $source_vat = $data['fee_data']['97']['amount']; echo BanglaConverter::bn_number
                    (number_format($data['fee_data']['97']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif
            </td>
        </tr>

    @endif



    <tr>
        <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
        <td height='23'
            style="text-align:right; font-size:10px;"><?php $total = (($fee + $due + $vat + $signbord + $source_vat + $sarcharge) - $discount); echo BanglaConverter::bn_number($total); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
</table>
<h4 style="margin-left:20px;" >কথায় লিখুন : {{BanglaConverter::bn_number($total)}}</h4>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px 0px auto;">

    <tr>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">সীল</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />যাচাইকারী
        </td>
    </tr>

</table>

</body>
