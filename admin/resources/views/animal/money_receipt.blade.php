<html>
<head>
    <base href="" />
    <title>পোষা প্রানীর মানি রসিদ</title>
    <style>
         body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
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

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">
            <tr>
                <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

                <td style="text-align:center;">
                    <font style="font-size:18px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:13px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                        {{-- মোবাইলঃ{{ BanglaConverter::bn_others($union->mobile) }}, --}}
                         ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ request()->getHost() }}<br>
                        {{-- ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}<br> --}}
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
                <td style="padding-left: 50px;width: 150px;"><b>মালিকের নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->name_bn }}</font>
                </td>

                <td align='right'><b> প্রাণীর নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $data->animal_name_bn }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ঠিকানা</b> </td>
                <td>
                    <font>&nbsp;:&nbsp; @php echo $data->present_village_bn . ',' . $data->present_postoffice_name_bn . ',' . $data->present_upazila_name_bn . ',' . $data->present_district_name_bn @endphp</font>
                </td>
                <td align='right'><b>প্রাণীর ধরণ</b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->animal_type_bn }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data->voucher) }}</font>
                </td>
            </tr>
        </table>

    @php
        $total = 0;
    @endphp

        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">

            <tr>
                <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td>১</td>

                <td style="border: 1px solid black;padding-left:10px;">পোষা প্রাণীর লাইসেন্স/নবায়ন ফি</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $mfee = isset($data->fee_list[91]) ? $data->fee_list[91]['amount'] : 0; $total += $mfee; echo BanglaConverter::bn_number($mfee); @endphp</td>
            </tr>

            <tr>
                <td>২</td>

                <td style="border: 1px solid black;padding-left:10px;">ভ্যাট(১৫%)</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $vfee = isset($data->fee_list[25]) ? floor($data->fee_list[25]['amount']) : 0; $total += $vfee; echo BanglaConverter::bn_number($vfee); @endphp</td>
            </tr>

            <tr>
                <td>৩</td>

                <td style="border: 1px solid black;padding-left:10px;">উৎসেকর</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srcfee = isset($data->fee_list[97]) ? $data->fee_list[97]['amount'] : 0; $total += $srcfee; echo BanglaConverter::bn_number($srcfee); @endphp</td>
            </tr>

            <tr>
                <td>৪</td>

                <td style="border: 1px solid black;padding-left:10px;">বকেয়া</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $dfee = isset($data->fee_list[23]) ? $data->fee_list[23]['amount'] : 0; $total += $dfee; echo BanglaConverter::bn_number($dfee); @endphp</td>
            </tr>

            <tr>
                <td>৫</td>

                <td style="border: 1px solid black;padding-left:10px;">সারচার্জ</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srfee = isset($data->fee_list[22]) ? $data->fee_list[22]['amount'] : 0; $total += $srfee; echo BanglaConverter::bn_number($srfee); @endphp</td>
            </tr>

            <tr>
                <td>৬</td>

                <td style="border: 1px solid black;padding-left:10px;">ছাড়</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $disfee = isset($data->fee_list[24]) ? $data->fee_list[24]['amount'] : 0; $total -= $disfee; echo '(-)'.BanglaConverter::bn_number($disfee); @endphp</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:right;padding-right:20px; font-size:10px;"> {{ BanglaConverter::bn_number($total) }}&nbsp; টাকা। </td>
           </tr>

        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:30px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />যাচাইকারী
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


         <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">
            <tr>
                <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

                <td style="text-align:center;">
                    <font style="font-size:18px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:13px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                        {{-- মোবাইলঃ{{ BanglaConverter::bn_others($union->mobile) }}, --}}
                         ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ request()->getHost() }}
                        <br>
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
                <td style="padding-left: 50px;width: 150px;"><b>মালিকের নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->name_bn }}</font>
                </td>

                <td align='right'><b> প্রাণীর নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $data->animal_name_bn }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ঠিকানা</b> </td>
                <td>
                    <font>&nbsp;:&nbsp; @php echo $data->present_village_bn . ',' . $data->present_postoffice_name_bn . ',' . $data->present_upazila_name_bn . ',' . $data->present_district_name_bn @endphp</font>
                </td>
                <td align='right'><b>প্রাণীর ধরণ</b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->animal_type_bn }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data->voucher) }}</font>
                </td>
            </tr>
        </table>

        @php
            $total = 0;
        @endphp

        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">

            <tr>
                <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td>১</td>

                <td style="border: 1px solid black;padding-left:10px;">পোষা প্রাণীর লাইসেন্স/নবায়ন ফি</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $mfee = isset($data->fee_list[91]) ? $data->fee_list[91]['amount'] : 0; $total += $mfee; echo BanglaConverter::bn_number($mfee); @endphp</td>
            </tr>

            <tr>
                <td>২</td>

                <td style="border: 1px solid black;padding-left:10px;">ভ্যাট(১৫%)</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $vfee = isset($data->fee_list[25]) ? floor($data->fee_list[25]['amount']) : 0; $total += $vfee; echo BanglaConverter::bn_number($vfee); @endphp</td>
            </tr>

            <tr>
                <td>৩</td>

                <td style="border: 1px solid black;padding-left:10px;">উৎসেকর</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srcfee = isset($data->fee_list[97]) ? $data->fee_list[97]['amount'] : 0; $total += $srcfee; echo BanglaConverter::bn_number($srcfee); @endphp</td>
            </tr>

            <tr>
                <td>৪</td>

                <td style="border: 1px solid black;padding-left:10px;">বকেয়া</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $dfee = isset($data->fee_list[23]) ? $data->fee_list[23]['amount'] : 0; $total += $dfee; echo BanglaConverter::bn_number($dfee); @endphp</td>
            </tr>

            <tr>
                <td>৫</td>

                <td style="border: 1px solid black;padding-left:10px;">সারচার্জ</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srfee = isset($data->fee_list[22]) ? $data->fee_list[22]['amount'] : 0; $total += $srfee; echo BanglaConverter::bn_number($srfee); @endphp</td>
            </tr>

            <tr>
                <td>৬</td>

                <td style="border: 1px solid black;padding-left:10px;">ছাড়</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $disfee = isset($data->fee_list[24]) ? $data->fee_list[24]['amount'] : 0; $total -= $disfee; echo '(-)'.BanglaConverter::bn_number($disfee); @endphp</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:right;padding-right:20px; font-size:10px;"> {{ BanglaConverter::bn_number($total) }}&nbsp; টাকা। </td>
           </tr>

        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:30px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />যাচাইকারী
                </td>
            </tr>

        </table>

</body>
