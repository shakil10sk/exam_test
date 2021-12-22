<html>
<head>
    <base href="" />
    <title>রাস্তা খননের অনুমতির মানি রসিদ</title>
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
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
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
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                    @endif

                </td>

            </tr>
        </table>
        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
            <tr>
                <td style="padding-left: 50px;width: 150px;"><b>আবেদনকারীর নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->name_bn }}</font>
                </td>

                <td align="right"><b> ব্যাংকের নাম ও শাখা </b></td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ঠিকানা</b> </td>
                <td colspan="3">
                    <font>&nbsp;:&nbsp; @php echo $data->present_village_bn . ',' . $data->present_postoffice_name_bn . ',' . $data->present_upazila_name_bn . ',' . $data->present_district_name_bn @endphp</font>
                </td>
                <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data->voucher) }}</font>
                </td>
                <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->sonod_no) }}</font>
                </td>
            </tr>
        </table>

        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">

            <tr>
                <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td>১</td>

                <td style="border: 1px solid black;padding-left:10px;">রাস্তা খননের ফি</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{BanglaConverter::bn_number($data->amount)}}</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:right;padding-right:20px; font-size:12px;"> {{ BanglaConverter::bn_number($data->amount) }}&nbsp; টাকা। </td>
           </tr>

        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:30px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">আদায়কারী</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">মেয়র</span>
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
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
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
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                    @endif
                </td>

            </tr>
        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
            <tr>
                <td style="padding-left: 50px;width: 150px;"><b>আবেদনকারীর নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->name_bn }}</font>
                </td>

                <td align="right"><b> ব্যাংকের নাম ও শাখা </b></td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ঠিকানা</b> </td>
                <td colspan="3">
                    <font>&nbsp;:&nbsp; @php echo $data->present_village_bn . ',' . $data->present_postoffice_name_bn . ',' . $data->present_upazila_name_bn . ',' . $data->present_district_name_bn @endphp</font>
                </td>
                <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data->voucher) }}</font>
                </td>
                <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->sonod_no) }}</font>
                </td>
            </tr>
        </table>

        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">

            <tr>
                <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td>১</td>

                <td style="border: 1px solid black;padding-left:10px;">রাস্তা খননের ফি</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{BanglaConverter::bn_number($data->amount)}}</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:right;padding-right:20px; font-size:12px;"> {{ BanglaConverter::bn_number($data->amount) }}&nbsp; টাকা। </td>
           </tr>

        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:30px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">আদায়কারী</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">মেয়র</span>
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
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                        {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, --}}
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

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
            <tr>
                <td style="padding-left: 50px;width: 150px;"><b>আবেদনকারীর নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->name_bn }}</font>
                </td>

                <td align="right"><b> ব্যাংকের নাম ও শাখা </b></td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ঠিকানা</b> </td>
                <td colspan="3">
                    <font>&nbsp;:&nbsp; @php echo $data->present_village_bn . ',' . $data->present_postoffice_name_bn . ',' . $data->present_upazila_name_bn . ',' . $data->present_district_name_bn @endphp</font>
                </td>
                <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
            </tr>

            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data->voucher) }}</font>
                </td>
                <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->sonod_no) }}</font>
                </td>
            </tr>
        </table>

        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">

            <tr>
                <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td>১</td>

                <td style="border: 1px solid black;padding-left:10px;">রাস্তা খননের ফি</td>

                <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{BanglaConverter::bn_number($data->amount)}}</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:right;padding-right:20px; font-size:12px;"> {{ BanglaConverter::bn_number($data->amount) }}&nbsp; টাকা। </td>
           </tr>

        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:30px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">আদায়কারী</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">মেয়র</span>
                </td>
            </tr>

        </table>

</body>
