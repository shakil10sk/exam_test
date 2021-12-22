<html>
<head>
    <base href="" />
    <title>Holding tax invoice</title>
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

@php
    $month_list = ['&nbsp', 'জানুয়ারি', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
@endphp

    {{-- first part --}}
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

            <td style="text-align:center;">
                <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br />

                <font style="font-size:10px; font-weight:bold;">
                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                    ই-মেইলঃ {{ $union->email }} <br>
                    ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}<br>
                        (গ্রাহক কপি)
                </font>

            </td>

            <td style="width:1.2in; text-align:left;">

                @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                @endif

            </td>

        </tr>
    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b> নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data['name'] }}</font>
            </td>

            <td align='right'><b>অর্থ বছর </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['fiscal_year_name']) }}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;
                {{ $data['ward_no'] }},

                {{ $data['ward_name'] }},
                
                {{ $data['moholla_name'] }}
                </font>
            </td>

            <td align='right'><b> ইনভয়েচ নং </b> </td>

            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['invoice_id']) }}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b></b></td>
            <td></td>

            <td align="right"><b>ভাউচার নং</b></td>
            <td>
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['voucher_no']) }}</font>
            </td>
        </tr>
    </table>

    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
            <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
        </tr>

        @php
            $sl = 1;
            $total = 0;
        @endphp

        @foreach($data['details'] as $month_id => $amount)
            @php $total += $amount @endphp
            <tr>
                <td style="text-align: center;">
                    {{ BanglaConverter::bn_number($sl) }}
                </td>

                <td style="padding-left: 10px;">
                    {{ $month_list[$month_id] }}
                </td>
                
                <td style="text-align: right; padding-right: 10px;">
                    {{ BanglaConverter::bn_number(number_format($amount, 0, '.', ',')) }}
                </td>
            </tr>
            
            @php $sl++; @endphp
        @endforeach

        @if(!empty($data['due']))
            @php $total += $data['due']['amount']; @endphp

            <tr>
                <td style="text-align: center;">
                    {{ BanglaConverter::bn_number($sl) }}
                </td>

                <td style="padding-left: 10px;">
                    বকেয়া আদায় অর্থবছরঃ {{ $data['due']['fiscal_name'] }} ( {{ $data['due']['fee_name'] }} )
                </td>
                
                <td style="text-align: right; padding-right: 10px;">
                    {{ BanglaConverter::bn_number(number_format($data['due']['amount'], 0, '.', ',')) }}
                </td>
            </tr>
        @endif

        <tr>
            <td colspan='2' height='23' style="font-size:10px;">
                <table width="100" style="border: 1px solid white;width:100%;">
                    <tr>
                        <td>কথায়ঃ {{BanglaConverter::bn_word($total)}} টাকা</td>

                        <td style="text-align: right">
                            মোট টাকা &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </td>

            <td height='23' style="text-align:right; font-size:10px;">
            <?php  echo BanglaConverter::bn_number(number_format($total)) ; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px 0px auto; margin-top:
    30px;">

        <tr>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
            </td>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">সীল</span>
            </td>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />মেয়র
            </td>
        </tr>

    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;margin-top: 20px">
        <tr>
            <td style="border-bottom: 2px dotted;">

            </td>
        </tr>
    </table>
    <br/>

    {{-- second part --}}
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

            <td style="text-align:center;">
                <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br />

                <font style="font-size:10px; font-weight:bold;">
                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                    ই-মেইলঃ {{ $union->email }} <br>
                    ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}<br>
                        (অফিস কপি)
                </font>

            </td>

            <td style="width:1.2in; text-align:left;">

                @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                @endif

            </td>

        </tr>
    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b> নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data['name'] }}</font>
            </td>

            <td align='right'><b>অর্থ বছর </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['fiscal_year_name']) }}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;
                {{ $data['ward_no'] }},

                {{ $data['ward_name'] }},
                
                {{ $data['moholla_name'] }}
                </font>
            </td>

            <td align='right'><b> ইনভয়েচ নং </b> </td>

            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['invoice_id']) }}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b></b></td>
            <td></td>

            <td align="right"><b>ভাউচার নং</b></td>
            <td>
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['voucher_no']) }}</font>
            </td>
        </tr>
    </table>

    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
            <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
        </tr>

        @php
            $sl = 1;
            $total = 0;
        @endphp

        @foreach($data['details'] as $month_id => $amount)
            @php $total += $amount @endphp
            <tr>
                <td style="text-align: center;">
                    {{ BanglaConverter::bn_number($sl) }}
                </td>

                <td style="padding-left: 10px;">
                    {{ $month_list[$month_id] }}
                </td>
                
                <td style="text-align: right; padding-right: 10px;">
                    {{ BanglaConverter::bn_number(number_format($amount, 0, '.', ',')) }}
                </td>
            </tr>
            
            @php $sl++; @endphp
        @endforeach

        @if(!empty($data['due']))
            @php $total += $data['due']['amount']; @endphp

            <tr>
                <td style="text-align: center;">
                    {{ BanglaConverter::bn_number($sl) }}
                </td>

                <td style="padding-left: 10px;">
                    বকেয়া আদায় অর্থবছরঃ {{ $data['due']['fiscal_name'] }} ( {{ $data['due']['fee_name'] }} )
                </td>
                
                <td style="text-align: right; padding-right: 10px;">
                    {{ BanglaConverter::bn_number(number_format($data['due']['amount'], 0, '.', ',')) }}
                </td>
            </tr>
        @endif

        <tr>
            <td colspan='2' height='23' style="font-size:10px;">
                <table width="100" style="border: 1px solid white;width:100%;">
                    <tr>
                        <td>কথায়ঃ {{BanglaConverter::bn_word($total)}} টাকা</td>

                        <td style="text-align: right">
                            মোট টাকা &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </td>

            <td height='23' style="text-align:right; font-size:10px;">
            <?php  echo BanglaConverter::bn_number(number_format($total)) ; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px 0px auto; margin-top:
    30px;">

        <tr>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
            </td>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">সীল</span>
            </td>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />মেয়র
            </td>
        </tr>

    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;margin-top: 20px">
        <tr>
            <td style="border-bottom: 2px dotted;">

            </td>
        </tr>
    </table>
    <br/>
    
    {{-- third part --}}
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

            <td style="text-align:center;">
                <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br />

                <font style="font-size:10px; font-weight:bold;">
                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                    ই-মেইলঃ {{ $union->email }} <br>
                    ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}<br>
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

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b> নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data['name'] }}</font>
            </td>

            <td align='right'><b>অর্থ বছর </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['fiscal_year_name']) }}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;
                {{ $data['ward_no'] }},

                {{ $data['ward_name'] }},
                
                {{ $data['moholla_name'] }}
                </font>
            </td>

            <td align='right'><b> ইনভয়েচ নং </b> </td>

            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['invoice_id']) }}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b></b></td>
            <td></td>

            <td align="right"><b>ভাউচার নং</b></td>
            <td>
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['voucher_no']) }}</font>
            </td>
        </tr>
    </table>

    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
            <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
        </tr>

        @php
            $sl = 1;
            $total = 0;
        @endphp

        @foreach($data['details'] as $month_id => $amount)
            @php $total += $amount @endphp
            <tr>
                <td style="text-align: center;">
                    {{ BanglaConverter::bn_number($sl) }}
                </td>

                <td style="padding-left: 10px;">
                    {{ $month_list[$month_id] }}
                </td>
                
                <td style="text-align: right; padding-right: 10px;">
                    {{ BanglaConverter::bn_number(number_format($amount, 0, '.', ',')) }}
                </td>
            </tr>
            
            @php $sl++; @endphp
        @endforeach

        @if(!empty($data['due']))
            @php $total += $data['due']['amount']; @endphp

            <tr>
                <td style="text-align: center;">
                    {{ BanglaConverter::bn_number($sl) }}
                </td>

                <td style="padding-left: 10px;">
                    বকেয়া আদায় অর্থবছরঃ {{ $data['due']['fiscal_name'] }} ( {{ $data['due']['fee_name'] }} )
                </td>
                
                <td style="text-align: right; padding-right: 10px;">
                    {{ BanglaConverter::bn_number(number_format($data['due']['amount'], 0, '.', ',')) }}
                </td>
            </tr>
        @endif

        <tr>
            <td colspan='2' height='23' style="font-size:10px;">
                <table width="100" style="border: 1px solid white;width:100%;">
                    <tr>
                        <td>কথায়ঃ {{BanglaConverter::bn_word($total)}} টাকা</td>

                        <td style="text-align: right">
                            মোট টাকা &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </td>

            <td height='23' style="text-align:right; font-size:10px;">
            <?php  echo BanglaConverter::bn_number(number_format($total)) ; ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px 0px auto; margin-top:
    30px;">

        <tr>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
            </td>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">সীল</span>
            </td>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />মেয়র
            </td>
        </tr>

    </table>

    <br/>

</body>
