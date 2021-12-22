<html>
<head>
    <base href="" />
    <title>ট্রেড লাইসেন্স মানি রসিদ</title>
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

    {{-- first part --}}

    {{-- paid stamp --}}
    {{-- <img src="{{asset('icon/paid_stamp.png')}}" style="position: relative; width: 100px;top:150px;left:200px;" /> --}}

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

            <td style="text-align:center;">
                <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br />

                <font style="font-size:10px; font-weight:bold;">
                     {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}<br>
                    ই-মেইলঃ {{ $union->email }} <br>
                    ওয়েব সাইট : {{ request()->getHost() }}<br>
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
            <td style="padding-left: 50px;width: 150px;"><b></b></td>
            <td>
                <font>&nbsp;</font>
            </td>

            <td align='right'><b>তারিখ</b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{BanglaConverter::bn_others($data['organization']->payment_date)}}</font>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data['organization']->organization_name_bn }}</font>
            </td>

            <td align='right'><b>ব্যাংকের নাম ও শাখা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{$bank->bank_name}} , {{$bank->bank_branch}}  </font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;
                {{$data['organization']->trade_ward_no > 0 ? BanglaConverter::bn_number($data['organization']->trade_ward_no) . ' নং ওয়ার্ড, ' : ''}}

                {{ $data['organization']->trade_village_bn }},

                {{ $data['organization']->postoffice_name }}

                </font>
            </td>

            <td align='right'><b> একাউন্ট নং </b> </td>

            <td>
                <font>&nbsp;:&nbsp;{{BanglaConverter::bn_number($bank->account_num)}}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['organization']->voucher_no) }}</font>
            </td>

            <td align="right"><b>সনদ নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['organization']->sonod_no) }}</font>
            </td>
        </tr>
    </table>

    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
            <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
        </tr>

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

                @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endif
                {{ BanglaConverter::bn_number($sr++) }}<br>

            </td>

            <td style="text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                {{-- TL fee --}}
                @if(isset($data['fee_data']['19']))
                {{ $data['fee_data']['19']['account_name'] }}
                @endif

                {{-- signboard fee --}}
                @if(isset($data['fee_data']['21']))
                <br>{{ $data['fee_data']['21']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['120']))
                <br> {{ $data['fee_data']['120']['account_name'] }}
                @endif

                {{-- vat --}}
                @if(isset($data['fee_data']['25']))
                <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif

                {{-- source tax --}}
                @if(isset($data['fee_data']['97']))
                <br>{{ $data['fee_data']['97']['account_name'] }}
                @endif

                {{-- sar charge --}}
                @if(isset($data['fee_data']['22']))
                <br> {{ $data['fee_data']['22']['account_name'] }}
                @endif

                {{-- discount --}}
                @if(isset($data['fee_data']['24']))
                <br> {{ $data['fee_data']['24']['account_name'] }}
                @endif

                {{-- due --}}
                @if(isset($data['fee_data']['23']))
                <br> {{ $data['fee_data']['23']['account_name'] }}
                @endif

                {{-- previous fiscal year due --}}
                @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                    <br> {{ BanglaConverter::bn_others($data['due_fiscal_year']) }} অর্থ বছরের বকেয়া ( {{ implode("+",
                $data['due_list']) }}  )
                @endif

            </td>

            <td valign='top' style="text-align:right;">

                <?php
                    $fee = 0; $due = 0; $bibidh = 0; $discount = 0; $vat = 0; $signboard = 0; $pesha = 0; $sarcharge = 0; $source_vat = 0;
                ?>

                {{-- TL fee --}}
                @if(isset($data['fee_data'][19]))

                <?php $fee = $data['fee_data'][19]['amount']; echo BanglaConverter::bn_others(number_format($fee)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- Signboard fee --}}
                @if(isset($data['fee_data'][21]))

                <br><?php $signboard = $data['fee_data'][21]['amount']; echo BanglaConverter::bn_others(number_format($signboard)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif

                {{-- bibidh --}}
                @if(isset($data['fee_data'][120]))
                    <br><?php $bibidh = round($data['fee_data'][120]['amount']); echo BanglaConverter::bn_others(number_format($bibidh)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif


                {{-- VAT --}}
                @if(isset($data['fee_data'][25]))
                    <br><?php $vat = round($data['fee_data'][25]['amount']); echo BanglaConverter::bn_others(number_format($vat)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif

                {{-- Source vat --}}
                @if(isset($data['fee_data'][97]))

                <br><?php $source_vat = $data['fee_data'][97]['amount']; echo BanglaConverter::bn_others(number_format($source_vat)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- sar charge --}}
                @if(isset($data['fee_data'][22]))

                <br><?php $sarcharge = $data['fee_data'][22]['amount']; echo BanglaConverter::bn_others(number_format($sarcharge)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- discount --}}
                @if(isset($data['fee_data'][24]))

                <br><?php $discount = $data['fee_data'][24]['amount']; echo '(-)' . BanglaConverter::bn_others(number_format($discount)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- DUE --}}
                @if(isset($data['fee_data'][23]))

                <br><?php $due = $data['fee_data'][23]['amount']; echo BanglaConverter::bn_others(number_format($due)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                    {{-- previous fiscal year due --}}
                    @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                        @php $due = $data['total_due_amount']; @endphp
                        <br> {{ BanglaConverter::bn_others(number_format($data['total_due_amount'])) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif

            </td>
        </tr>

        <tr>
            @php
                $total = $fee + $signboard + $vat + $bibidh + $source_vat + $sarcharge - $discount + $due;
                //echo $total;exit;
            @endphp

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
    60px;">

        <tr>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">আদায়কারী</span>
            </td>
            <td  style="text-align:left; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">
                    সীল
                    &nbsp;
                </span>
            </td>
            <td  style="text-align:left; font-weight:normal; font-size:10px; color:black;">
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
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top:
        40px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

            <td style="text-align:center;">
                <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br />

                <font style="font-size:10px; font-weight:bold;">
                   {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}<br>
                    , ই-মেইলঃ {{ $union->email }} <br>
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

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b></b></td>
            <td>
                <font>&nbsp;</font>
            </td>

            <td align='right'><b>তারিখ</b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['organization']->payment_date)  }}</font>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data['organization']->organization_name_bn }}</font>
            </td>

            <td align='right'><b>ব্যাংকের নাম ও শাখা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{$bank->bank_name}} , {{$bank->bank_branch}}  </font>
            </td>

        </tr>

        <tr>
            <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;
                {{$data['organization']->trade_ward_no > 0 ? BanglaConverter::bn_number($data['organization']->trade_ward_no) . ' নং ওয়ার্ড, ' : ''}}

                {{ $data['organization']->trade_village_bn }},

                {{ $data['organization']->postoffice_name }}

                </font>
            </td>

            <td align='right'><b> একাউন্ট নং </b> </td>

            <td>
                <font>&nbsp;:&nbsp;{{BanglaConverter::bn_number($bank->account_num)}}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['organization']->voucher_no) }}</font>
            </td>

            <td align="right"><b>সনদ নং</b></td>
            <td>
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['organization']->sonod_no) }}</font>
            </td>
        </tr>
    </table>

    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
            <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
        </tr>

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

                @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endif
                {{ BanglaConverter::bn_number($sr++) }}<br>

            </td>

            <td style="text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                {{-- TL fee --}}
                @if(isset($data['fee_data']['19']))
                {{ $data['fee_data']['19']['account_name'] }}
                @endif

                {{-- signboard fee --}}
                @if(isset($data['fee_data']['21']))
                <br>{{ $data['fee_data']['21']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['120']))
                <br> {{ $data['fee_data']['120']['account_name'] }}
                @endif

                {{-- vat --}}
                @if(isset($data['fee_data']['25']))
                <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif

                {{-- source tax --}}
                @if(isset($data['fee_data']['97']))
                <br>{{ $data['fee_data']['97']['account_name'] }}
                @endif

                {{-- sar charge --}}
                @if(isset($data['fee_data']['22']))
                <br> {{ $data['fee_data']['22']['account_name'] }}
                @endif

                {{-- discount --}}
                @if(isset($data['fee_data']['24']))
                <br> {{ $data['fee_data']['24']['account_name'] }}
                @endif

                {{-- due --}}
                @if(isset($data['fee_data']['23']))
                <br> {{ $data['fee_data']['23']['account_name'] }}
                @endif

                {{-- previous fiscal year due --}}
                @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                    <br> {{ BanglaConverter::bn_others($data['due_fiscal_year']) }} অর্থ বছরের বকেয়া ( {{ implode("+",
                $data['due_list']) }}  )
                @endif

            </td>

            <td valign='top' style="text-align:right;">

                <?php
                    $fee = 0; $due = 0; $bibidh = 0; $discount = 0; $vat = 0; $signboard = 0; $pesha = 0; $sarcharge = 0; $source_vat = 0;
                ?>

                {{-- TL fee --}}
                @if(isset($data['fee_data'][19]))

                <?php $fee = $data['fee_data'][19]['amount']; echo BanglaConverter::bn_others(number_format($fee)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- Signboard fee --}}
                @if(isset($data['fee_data'][21]))

                <br><?php $signboard = $data['fee_data'][21]['amount']; echo BanglaConverter::bn_others(number_format($signboard)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif

                {{-- bibidh --}}
                @if(isset($data['fee_data'][120]))
                    <br><?php $bibidh = round($data['fee_data'][120]['amount']); echo BanglaConverter::bn_others(number_format($bibidh)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif


                {{-- VAT --}}
                @if(isset($data['fee_data'][25]))
                    <br><?php $vat = round($data['fee_data'][25]['amount']); echo BanglaConverter::bn_others(number_format($vat)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif

                {{-- Source vat --}}
                @if(isset($data['fee_data'][97]))

                <br><?php $source_vat = $data['fee_data'][97]['amount']; echo BanglaConverter::bn_others(number_format($source_vat)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- sar charge --}}
                @if(isset($data['fee_data'][22]))

                <br><?php $sarcharge = $data['fee_data'][22]['amount']; echo BanglaConverter::bn_others(number_format($sarcharge)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- discount --}}
                @if(isset($data['fee_data'][24]))

                <br><?php $discount = $data['fee_data'][24]['amount']; echo '(-)' . BanglaConverter::bn_others(number_format($discount)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- DUE --}}
                @if(isset($data['fee_data'][23]))

                <br><?php $due = $data['fee_data'][23]['amount']; echo BanglaConverter::bn_others(number_format($due)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                    {{-- previous fiscal year due --}}
                    @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                        @php $due = $data['total_due_amount']; @endphp
                        <br> {{ BanglaConverter::bn_others(number_format($data['total_due_amount'])) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif

            </td>
        </tr>

        <tr>
            @php
                $total = $fee + $signboard + $vat + $bibidh + $source_vat + $sarcharge - $discount + $due;
                //echo $total;exit;
            @endphp

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
    60px">

        <tr>
            <td  style="text-align:center; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">আদায়কারী</span>
            </td>
            <td  style="text-align:left; font-weight:normal; font-size:10px; color:black;">
                <span style="border-top: 1px dotted;">
                    সীল
                    &nbsp;
                </span>
            </td>
            <td  style="text-align:left; font-weight:normal; font-size:10px; color:black;">
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

    <!---------------- third part----------------->
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto; padding-top: 40px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

            <td style="text-align:center;">
                <font style="font-size:16px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br />

                <font style="font-size:10px; font-weight:bold;">
                    {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}<br>
                    ই-মেইলঃ {{ $union->email }} <br>
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
            <td style="padding-left: 50px;width: 150px;"><b></b></td>
            <td>
                <font>&nbsp;</font>
            </td>

            <td align='right'><b>তারিখ</b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['organization']->payment_date) }}</font>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data['organization']->organization_name_bn }}</font>
            </td>

            <td align='right'><b>ব্যাংকের নাম ও শাখা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{$bank->bank_name}} , {{$bank->bank_branch}}  </font>
            </td>

        </tr>

        <tr>
            <td style="padding-left: 50px"><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;
                {{$data['organization']->trade_ward_no > 0 ? BanglaConverter::bn_number($data['organization']->trade_ward_no) . ' নং ওয়ার্ড, ' : ''}}

                {{ $data['organization']->trade_village_bn }},

                {{ $data['organization']->postoffice_name }}

                </font>
            </td>

            <td align='right'><b> একাউন্ট নং </b> </td>

            <td>
                <font>&nbsp;:&nbsp;{{BanglaConverter::bn_number($bank->account_num)}}</font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['organization']->voucher_no) }}</font>
            </td>

            <td align="right"><b>সনদ নং</b></td>
            <td >
                <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_others($data['organization']->sonod_no) }}</font>
            </td>

        </tr>
    </table>

    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td height='22' style="text-align:center;font-size:10px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:75%;text-align:center;font-size:10px;"><font>  বর্ণনা </font></td>
            <td height='22' style="text-align:center;font-size:10px;"> পরিমান (টাকা) </td>
        </tr>

        <tr>
            <td valign='top' style='font-size:10px;text-align:center;'>
                @php $sr = 1; @endphp

                @foreach($data['fee_data'] as $key => $value)
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endforeach

                @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                    {{ BanglaConverter::bn_number($sr++) }}<br>
                @endif
                {{ BanglaConverter::bn_number($sr++) }}<br>

            </td>

            <td style="text-align:left;;font-size:10px;padding-top:5px;" valign='top'>

                {{-- TL fee --}}
                @if(isset($data['fee_data']['19']))
                {{ $data['fee_data']['19']['account_name'] }}
                @endif

                {{-- signboard fee --}}
                @if(isset($data['fee_data']['21']))
                <br>{{ $data['fee_data']['21']['account_name'] }}
                @endif

                @if(isset($data['fee_data']['120']))
                <br> {{ $data['fee_data']['120']['account_name'] }}
                @endif

                {{-- vat --}}
                @if(isset($data['fee_data']['25']))
                <br> {{ $data['fee_data']['25']['account_name'] }}
                @endif

                {{-- source tax --}}
                @if(isset($data['fee_data']['97']))
                <br>{{ $data['fee_data']['97']['account_name'] }}
                @endif

                {{-- sar charge --}}
                @if(isset($data['fee_data']['22']))
                <br> {{ $data['fee_data']['22']['account_name'] }}
                @endif

                {{-- discount --}}
                @if(isset($data['fee_data']['24']))
                <br> {{ $data['fee_data']['24']['account_name'] }}
                @endif

                {{-- due --}}
                @if(isset($data['fee_data']['23']))
                <br> {{ $data['fee_data']['23']['account_name'] }}
                @endif

                {{-- previous fiscal year due --}}
                @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                    <br> {{ BanglaConverter::bn_others($data['due_fiscal_year']) }} অর্থ বছরের বকেয়া ( {{ implode("+",
                $data['due_list']) }}  )
                @endif

            </td>

            <td valign='top' style="text-align:right;">

                <?php
                    $fee = 0; $due = 0; $bibidh = 0; $discount = 0; $vat = 0; $signboard = 0; $pesha = 0; $sarcharge = 0; $source_vat = 0;
                ?>

                {{-- TL fee --}}
                @if(isset($data['fee_data'][19]))

                <?php $fee = $data['fee_data'][19]['amount']; echo BanglaConverter::bn_others(number_format($fee)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- Signboard fee --}}
                @if(isset($data['fee_data'][21]))

                <br><?php $signboard = $data['fee_data'][21]['amount']; echo BanglaConverter::bn_others(number_format($signboard)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif

                {{-- bibidh --}}
                @if(isset($data['fee_data'][120]))
                    <br><?php $bibidh = round($data['fee_data'][120]['amount']); echo BanglaConverter::bn_others(number_format($bibidh)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif


                {{-- VAT --}}
                @if(isset($data['fee_data'][25]))
                    <br><?php $vat = round($data['fee_data'][25]['amount']); echo BanglaConverter::bn_others(number_format($vat)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endif

                {{-- Source vat --}}
                @if(isset($data['fee_data'][97]))

                <br><?php $source_vat = $data['fee_data'][97]['amount']; echo BanglaConverter::bn_others(number_format($source_vat)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- sar charge --}}
                @if(isset($data['fee_data'][22]))

                <br><?php $sarcharge = $data['fee_data'][22]['amount']; echo BanglaConverter::bn_others(number_format($sarcharge)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- discount --}}
                @if(isset($data['fee_data'][24]))

                <br><?php $discount = $data['fee_data'][24]['amount']; echo '(-)' . BanglaConverter::bn_others(number_format($discount)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                {{-- DUE --}}
                @if(isset($data['fee_data'][23]))

                <br><?php $due = $data['fee_data'][23]['amount']; echo BanglaConverter::bn_others(number_format($due)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                @endif

                    {{-- previous fiscal year due --}}
                    @if(!isset($data['fee_data']['23']) && !empty($data['due_invoice_id']))
                        @php $due = $data['total_due_amount']; @endphp
                        <br> {{ BanglaConverter::bn_others(number_format($data['total_due_amount'])) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif

            </td>
        </tr>

        <tr>
            @php
                $total = $fee + $signboard + $vat + $bibidh + $source_vat + $sarcharge - $discount + $due;
                //echo $total;exit;
            @endphp

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
    60px">

        <tr>
            <td  style="text-align:center; font-weight:normal; font-size:12px; color:black;">
                <span style="border-top: 1px dotted;">আদায়কারী</span>
            </td>
            <td  style="text-align:left; font-weight:normal; font-size:12px; color:black;">
                <span style="border-top: 1px dotted;">
                    সীল
                    &nbsp;
                </span>
            </td>
            <td  style="text-align:left; font-weight:normal; font-size:12px; color:black;">
                <span style="border-top: 1px dotted;">মেয়র</span>
            </td>
        </tr>

    </table>

</body>
