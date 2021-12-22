<html>
<head>
    <base href="" />
    <title>ইমারত নির্মাণ অনুমতি সনদ মানি রসিদ</title>
    <style>
        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 12px;
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

            <font style="font-size:10px; font-weight:bold;">
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
            <td style="padding-left: 50px;width: 150px;">&nbsp;</td>
            <td>&nbsp;</td>
            <td align='right'><b>অর্থ বছর </b> </td>
            <td>
                <font>&nbsp;:{{ BanglaConverter::bn_number($data['organization']->fiscal_year_name) }} </font>
            </td>
        </tr>


    <tr>
        <td style="padding-left: 50px;width: 150px;"><b> নাম </b></td>
        <td>
            {{ $data['organization']->name_bn}}
        </td>

        <td align='right'><b> ব্যাংকের নাম ও শাখা </b></td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
                </td>

    </tr>
    <tr>
        <td style="padding-left: 50px"><b>গ্রাম </b> </td>
        <td>
            {{ $data['organization']->permanent_village_bn}}
        </td>
        <td align='right'><b>একাউন্ট নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                </td>
    </tr>
    <tr>
        <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
        <td >
            <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data['organization']->voucher_no) }}</font>
        </td>
        <td align='right'><b> সনদ নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['organization']->sonod_no) }}</font>
                </td>
    </tr>
</table>


<table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">


    <tr>
        <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
        <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
        <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
    </tr>

    @if(isset($data['fee_data']['96']))

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

            </td>
            <td style="height:100px;text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                @if(isset($data['fee_data']['96']))
                    {{ $data['fee_data']['96']['account_name'] }}
                @endif




                @if(isset($data['fee_data']['25']))
                    <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif



            </td>

            <td valign='top' style="text-align:right;">

                <?php $fee = 0; $tax = 0; ?>

                @if(isset($data['fee_data']['96']))

                    <?php $fee = $data['fee_data']['96']['amount']; echo BanglaConverter::bn_number(number_format
                    ($data['fee_data']['96']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['25']))

                    <br><?php $tax = $data['fee_data']['25']['amount']; echo BanglaConverter::bn_number
                    (number_format($data['fee_data']['25']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif


            </td>
        </tr>

    @endif



    <tr>
        <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
        <td height='23' style="text-align:right; font-size:10px;"><?php $total = ($fee + $tax ); echo BanglaConverter::bn_number($total) ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:20px 0px auto;">

    <tr>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">আদায়কারী</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">সীল</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
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

            <font style="font-size:10px; font-weight:bold;">
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
        <td style="padding-left: 50px;width: 150px;">&nbsp;</td>
        <td>&nbsp;</td>
        <td align='right'><b>অর্থ বছর </b> </td>
        <td>
            <font>&nbsp;:{{ BanglaConverter::bn_number($data['organization']->fiscal_year_name) }} </font>
        </td>
    </tr>


        <tr>
            <td style="padding-left: 50px;width: 150px;"><b> নাম </b></td>
            <td>
                {{ $data['organization']->name_bn}}
            </td>

            <td align='right'><b> ব্যাংকের নাম ও শাখা </b></td>
                    <td>
                        <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
                    </td>

        </tr>
        <tr>
            <td style="padding-left: 50px"><b>গ্রাম </b> </td>
            <td>
                {{ $data['organization']->permanent_village_bn}}
            </td>
            <td align='right'><b>একাউন্ট নং </b> </td>
                    <td>
                        <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                    </td>
        </tr>
        <tr>
            <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data['organization']->voucher_no) }}</font>
            </td>
            <td align='right'><b> সনদ নং </b> </td>
                    <td>
                        <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['organization']->sonod_no) }}</font>
                    </td>
        </tr>
</table>


<table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">


    <tr>
        <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
        <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
        <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
    </tr>

    @if(isset($data['fee_data']['96']))

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

            </td>
            <td style="height:100px;text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                @if(isset($data['fee_data']['96']))
                    {{ $data['fee_data']['96']['account_name'] }}
                @endif




                @if(isset($data['fee_data']['25']))
                    <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif



            </td>

            <td valign='top' style="text-align:right;">

                <?php $fee = 0; $tax = 0; ?>

                @if(isset($data['fee_data']['96']))

                    <?php $fee = $data['fee_data']['96']['amount']; echo BanglaConverter::bn_number(number_format
                    ($data['fee_data']['96']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['25']))

                    <br><?php $tax = $data['fee_data']['25']['amount']; echo BanglaConverter::bn_number
                    (number_format($data['fee_data']['25']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif


            </td>
        </tr>

    @endif



    <tr>
        <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
        <td height='23' style="text-align:right; font-size:10px;"><?php $total = ($fee  + $tax  );
            echo BanglaConverter::bn_number
            ($total) ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:20px 0px auto;">

    <tr>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">আদায়কারী</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">সীল</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">স্বাক্ষর</span><মেয়রr />
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

    <!----------------third part----------------->


<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">
    <tr>
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

        <td style="text-align:center;">
            <font style="font-size:18px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

            <br />

            <font style="font-size:10px; font-weight:bold;">
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
        <td style="padding-left: 50px;width: 150px;">&nbsp;</td>
        <td>&nbsp;</td>
        <td align='right'><b>অর্থ বছর </b> </td>
        <td>
            <font>&nbsp;:{{ BanglaConverter::bn_number($data['organization']->fiscal_year_name) }} </font>
        </td>
    </tr>


        <tr>
            <td style="padding-left: 50px;width: 150px;"><b> নাম </b></td>
            <td>
                {{ $data['organization']->name_bn}}
            </td>

            <td align='right'><b> ব্যাংকের নাম ও শাখা </b></td>
                    <td>
                        <font>&nbsp;:&nbsp; {{ $bank->bank_name }} (শাখাঃ {{ $bank->bank_branch}})</font>
                    </td>

        </tr>
        <tr>
            <td style="padding-left: 50px"><b>গ্রাম </b> </td>
            <td>
                {{ $data['organization']->permanent_village_bn}}
            </td>
            <td align='right'><b>একাউন্ট নং </b> </td>
                    <td>
                        <font>&nbsp;:&nbsp;{{ ($bank->account_num) }}</font>
                    </td>
        </tr>
        <tr>
            <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data['organization']->voucher_no) }}</font>
            </td>
            <td align='right'><b> সনদ নং </b> </td>
                    <td>
                        <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['organization']->sonod_no) }}</font>
                    </td>
        </tr>
</table>


<table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 30px">


    <tr>
        <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
        <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
        <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
    </tr>

    @if(isset($data['fee_data']['96']))

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

            </td>
            <td style="height:100px;text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                @if(isset($data['fee_data']['96']))
                    {{ $data['fee_data']['96']['account_name'] }}
                @endif




                @if(isset($data['fee_data']['25']))
                    <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif



            </td>

            <td valign='top' style="text-align:right;">

                <?php $fee = 0; $tax = 0; ?>

                @if(isset($data['fee_data']['96']))

                    <?php $fee = $data['fee_data']['96']['amount']; echo BanglaConverter::bn_number(number_format
                    ($data['fee_data']['96']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                @if(isset($data['fee_data']['25']))

                    <br><?php $tax = $data['fee_data']['25']['amount']; echo BanglaConverter::bn_number
                    (number_format($data['fee_data']['25']['amount'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif


            </td>
        </tr>

    @endif



    <tr>
        <td colspan='2' height='23' style="text-align:right; font-size:10px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
        <td height='23' style="text-align:right; font-size:10px;"><?php $total = ($fee  + $tax  );
            echo BanglaConverter::bn_number
            ($total) ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:20px 0px auto;">

    <tr>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">আদায়কারী</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">সীল</span>
        </td>
        <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
            <span style="border-top: 1px dotted;">মেয়র</span>
        </td>
    </tr>

</table>

</body>
