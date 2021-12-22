<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>English Trade License</title>

    <style type="text/css" media="all">

        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            header: page-header;
            footer: page-footer;
            margin: 20px 0px;
            padding: 0px;

        }


        @media print {
            body {
                font-size: 14px !important;
                font-family: 'bangla', sans-serif !important;
            }


        }
        .page-border
        {
            padding-top: 15px;
            padding-right: 10px;
            margin-right: 10px;

            @if(! $print_setting->pad_print )
            background-image: url("{{asset('images/boder_pdf.png')}}");
            background-repeat: no-repeat;
            background-size: 100%;
            height: 1400px;
        @endif

    }
    </style>

</head>

<body>


    <div>

        {{-- <img src="{{ public_path('assets/images/border3.png') }}"> --}}


            @if(! $print_setting->pad_print )
                @include('layouts.pdf_sub_layouts.certificate_header_en')
            @else

                <table>
                    <tr>
                        <td style="height: 150px"></td>
                    </tr>
                </table>

            @endif

        <div id="body">

            <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
                cellpadding="0" cellspacing="0">

                <tr>
                    <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                        <font style="color: #17a2b8;">
                            <u>Trade Licesnse</u>
                        </font>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>Issue
                                    Date: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trade['organization']['generate_date'])->format('d-m-Y') }}</td>
                                <td style="text-align: right;padding-right: 5px;">Expire
                                    Date: {{ Carbon\Carbon::parse($trade['organization']['expire_date'])->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>

                    <td>

                        <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;" cellpadding="0"
                            cellspacing="0">
                            <tr>
                                <td style="width:150px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                                @php

                                    $sonod = str_split($trade['organization']['sonod_no']);

                                    for($i=0; $i<strlen($trade['organization']['sonod_no']); $i++):

                                @endphp

                                <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                                @php
                                    endfor;
                                @endphp
                            </tr>
                        </table>
                    </td>

                </tr>

            </table>

            {{--            <table style="width:95%; margin-left:48px;margin-top:10px;" cellpadding="0" cellspacing="0">--}}

            {{--                <tr>--}}

            {{--                    <td  valign="top" style="text-align: center;" >--}}

            {{--                        @foreach($trade['organization']['owner_list'] as $owner)--}}

            {{--                            @if(!empty($owner['photo']))--}}

            {{--                                <img src="{{ asset('images/application/'. $owner['photo']) }}" height="80px" width="80px" style="" />--}}

            {{--                            @endif--}}

            {{--                        @endforeach--}}

            {{--                    </td>--}}

            {{--                </tr>--}}

            {{--            </table>--}}
            <div style="width:95%;">
                <div style=" float: left; width: 90%">
                    <table width="95%" cellpadding="0" cellspacing="0" border="0"
                        style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                        <tr>
                            <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Name</td>
                            <td style="font-size:16px; text-align:left;">
                                :&nbsp;{{ $trade['organization']['organization_name_en'] }}</td>
                        </tr>
                        <tr>
                            <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Type</td>
                            <td style="font-size:16px; text-align:left;">
                                :&nbsp;{{ $trade['organization']['business_type_en'] }}</td>
                        </tr>

                        <tr>
                            <td style="text-indent: 20px;text-align:left; font-size:16px;">Mobile</td>
                            <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['mobile'] }}</td>
                        </tr>
                        <tr>
                            <td style="text-indent: 20px;text-align:left; font-size:16px;">Organization Address</td>
                            <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['trade_village_en'] }}&nbsp;{{ $trade['organization']['trade_ward_no'] }}
                                ,&nbsp;{{ $trade['organization']['trade_postoffice_name_en'] }}
                                ,&nbsp;{{ $trade['organization']['trade_upazila_name_en'] }}
                                ,&nbsp;{{ $trade['organization']['trade_district_name_en'] }}</td>
                        </tr>
                    </table>


                </div>
            {{--    {{  dd($trade['owner_list'])  }}--}}
                <div style="float: right; width: 50%; margin-right: -40%; margin-top: 10px ; ">
                    @foreach($trade['owner_list'] as $owner)

                        @if(!empty($owner['photo']))
                            <img src="{{ asset('images/application/'. $owner['photo']) }}" height="200px"
                                width="200px"/>
                        @endif

                    @endforeach
                </div>
            </div>

            <table width="88%" cellpadding="0" cellspacing="0" border="1"
                style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px">

                <tr style="text-align: center;font-weight:bolder;">
                    <th>No</th>
                    <td style="font-weight: 700px; font-size: 17px;">Proprietor Name</td>
                    @if( (int) $trade['organization']['owner_type'] != 4 )
                        <th style="font-weight: 700px; font-size: 17px;">Father/Husband</th>
                    @endif
                    <th style="font-weight: 700px; font-size: 17px;"> {{ ((int) $trade['organization']['owner_type'] != 4)?"NID/
                    Birth ID":"Organization ID / Code No"  }}
                        </th>
                </tr>

                @php
                    $i = 1;
                @endphp

                @foreach($trade['owner_list'] as $owner)
                    <tr height="20px" style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>{{  $owner['name_en'] }}</td>
                        @if( (int) $trade['organization']['owner_type'] != 4 )
                            <td>

                                @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                                    {{ $owner['husband_name_en'] }}
                                @else
                                    {{ $owner['father_name_en'] }}
                                @endif


                            </td>
                        @endif
                        <td>

                            @if ($owner['nid'] > 0)
                                {{ $owner['nid'] }}
                            @else
                                {{ $owner['birth_id'] }}
                            @endif

                        </td>


                    </tr>
                    @if( (int) $trade['organization']['owner_type'] != 4 )
                        <tr height='25px'>
                            <td colspan="4">

                                <p style="font-size:12px;">Present Address
                                    : village:&nbsp;{{ $owner['present_village_en'] }},
                                    {{-- &nbsp;&nbsp;&nbsp; {{ $owner['present_village_en'] }}, --}}
                                    &nbsp;post office:&nbsp;{{ $owner['present_postoffice_name_en'] }}
                                    ,&nbsp;word:&nbsp;{{ $owner['present_ward_no'] }},
                                    &nbsp;upazila:&nbsp;{{ $owner['present_upazila_name_en'] }}
                                    ,&nbsp;district:&nbsp;{{ $owner['present_district_name_en'] }}
                                </p>

                            </td>
                        </tr>
                        <tr height='25px'>
                            <td colspan="4">

                                <p style="font-size:12px;">Permanent Address
                                    : village:&nbsp;{{ $owner['permanent_village_en'] }}
                                    {{-- ,&nbsp;&nbsp;&nbsp;{{ $owner['permanent_village_en'] }} --}}
                                    ,&nbsp;post office:&nbsp;{{ $owner['permanent_postoffice_name_en'] }}
                                    ,&nbsp;ward:&nbsp;{{ $owner['permanent_ward_no'] }},
                                    &nbsp;upazila:&nbsp;{{ $owner['permanent_upazila_name_en'] }}
                                    ,&nbsp;district:{{ $owner['permanent_district_name_en'] }}
                                </p>

                            </td>
                        </tr>

                    @endif
                @endforeach

            </table>



            <table class="jolchap" align="center" border="1" height="415px" width='60%' cellspacing="0" cellspacing='0'
                style="border-collapse:collapse;margin:0 auto; table-layout:fixed; margin-top: 10px">

                {{ $due = 0, $discount = 0, $due_sarcharge =0, $sarcharge = 0, $due_signbord_vat = 0, $signbord_vat = 0, $bibidh = 0, $due_bibidh = 0, $signbord_vat = 0, $pesha_vat = 0, $source_vat = 0,  $sarcharge = 0 }}

                <tr>
                    <td align="center" rowspan="2"><b style="font-size: 14px" >Collection Details</b></td>
                    <td align="center" colspan="2"><b style="font-size: 14px" >Amount</b></td>
                    <td align="center" rowspan="2"><b style="font-size: 14px" >Total Collection</b></td>
                </tr>

                <tr>
                    <td align="center"><b style="font-size: 12px"  >Due Collection/fiscal_year</b>
                        <p style="font-size:11px;">{{ isset( $trade['due_year_name']) ? ($trade['due_year_name']) :'' }}</p>
                    </td>
                    <td align="center"><b style="font-size: 14px" >Running Collection</b></td>
                </tr>

                {{-- TL main fee --}}
                <tr>
                    <td align="left" nowrap
                        style="font-size:13px;text-indent:55px; font-color:black; width: 200px; padding-left: 20px">Trade
                        License Fee (Annual)
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">
                        <?php echo (isset($trade['due_data'][19])) ? $trade['due_data'][19]['amount'] : ''; $due_fee = isset($trade['due_data'][19]) ? $trade['due_data'][19]['amount'] : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">
                        <?php echo (isset($trade['fee_data'][19])) ? $trade['fee_data'][19]['amount'] : ''; $fee = $trade['fee_data'][19]['amount']  ?>
                        &nbsp;
                    </td>

                    <td align="right">
                        <?php echo $due_fee + $fee; ?> &nbsp;
                    </td>

                </tr>

                {{-- Signboard fee --}}
                @if(!empty($trade['due_data'][21]) || !empty($trade['fee_data'][21])  )
                    <tr>
                        <td align="left" nowrap
                            style="font-size:13px;text-indent:55px; font-color:black; width: 150px; padding-left: 20px">Signboard
                            Tax (Annual)
                        </td>

                        <td align="right" style="text-align:right;font-size:14px; ">
                            <?php echo (isset($trade['due_data'][21])) ? $trade['due_data'][21]['amount'] : ''; $due_signbord_vat = isset($trade['due_data'][21]) ? $trade['due_data'][21]['amount'] : 0; ?>
                            &nbsp;
                        </td>

                        <td align="right" style="text-align:right;font-size:14px; ">&nbsp;
                            <?php echo (isset($trade['fee_data'][21])) ? $trade['fee_data'][21]['amount'] : ''; $signbord_vat = isset($trade['fee_data'][21]) ? $trade['fee_data'][21]['amount'] : 0; ?>
                            &nbsp;
                        </td>

                        <td align="right">
                            <?php echo $due_signbord_vat + $signbord_vat; ?> &nbsp;
                        </td>

                    </tr>
                @endif


                {{-- Bibidh --}}
                @if(!empty($trade['due_data'][120]) || !empty($trade['fee_data'][120])  )
                    <tr>
                        <td align="left" nowrap
                            style="font-size:13px;text-indent:55px; font-color:black; width: 150px; padding-left: 20px">Abedon Fee
                        </td>

                        <td align="right" style="text-align:right;font-size:14px; ">
                            <?php
                            echo (isset($trade['due_data'][120])) ? round($trade['due_data'][120]['amount']) : ''; $due_bibidh = isset($trade['due_data'][120]) ? round($trade['due_data'][120]['amount']) : 0;
                            ?>
                            &nbsp;
                        </td>

                        <td align="right" style="text-align:right;font-size:14px; ">&nbsp;
                            <?php echo (isset($trade['fee_data'][120])) ? round($trade['fee_data'][120]['amount']) : ''; $bibidh = isset($trade['fee_data'][120]) ? round($trade['fee_data'][120]['amount']) : 0; ?>
                            &nbsp;
                        </td>

                        <td align="right">
                            <?php echo $due_bibidh + $bibidh; ?> &nbsp;
                        </td>
                    </tr>
                @endif

                {{-- VAT --}}
                <tr>
                    <td align="left" nowrap
                        style="font-size:13px;text-indent:55px; font-color:black; width: 150px; padding-left: 20px">Vat Fee
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">
                        <?php echo (isset($trade['due_data'][25])) ? round($trade['due_data'][25]['amount'] ) : ''; $due_vat = isset($trade['due_data'][25]) ? round($trade['due_data'][25]['amount'] ) : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">&nbsp;
                        <?php echo (isset($trade['fee_data'][25])) ? round($trade['fee_data'][25]['amount']) : ''; $vat = isset($trade['fee_data'][25]) ? round($trade['fee_data'][25]['amount']) : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right">
                        <?php echo $due_vat + $vat; ?> &nbsp;
                    </td>
                </tr>

                {{-- Source Vat (97) --}}
                <tr>
                    <td align="left" nowrap
                        style="font-size:13px;text-indent:55px; font-color:black; width: 150px; padding-left: 20px"> Source Tax
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">
                        <?php echo (isset($trade['due_data'][97])) ? $trade['due_data'][97]['amount'] : ''; $due_source_vat = isset($trade['due_data'][97]) ? $trade['due_data'][97]['amount'] : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">&nbsp;
                        <?php echo (isset($trade['fee_data'][97])) ? $trade['fee_data'][97]['amount'] : ''; $source_vat = isset($trade['fee_data'][97]) ? $trade['fee_data'][97]['amount'] : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right">
                        <?php echo $due_source_vat + $source_vat; ?> &nbsp;
                    </td>

                </tr>

                {{-- sar-charge (22) --}}
                @if(!empty($trade['due_data'][22]) || !empty($trade['fee_data'][22])  )
                <tr>
                    <td align="left" nowrap
                        style="font-size:13px;text-indent:55px; font-color:black; width: 150px; padding-left: 20px">Surcharge
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">
                        <?php echo (isset($trade['due_data'][22])) ? $trade['due_data'][22]['amount'] : ''; $due_sarcharge = isset($trade['due_data'][22]) ? $trade['due_data'][22]['amount'] : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">&nbsp;
                        <?php echo (isset($trade['fee_data'][22])) ? $trade['fee_data'][22]['amount'] : ''; $sarcharge = isset
                        ($trade['fee_data'][22]) ? $trade['fee_data'][22]['amount'] : 0; ?>
                        &nbsp;
                    </td>

                    <td align="right">
                        <?php echo $due_sarcharge + $sarcharge; ?> &nbsp;
                    </td>

                </tr>
                @endif


                {{-- Due
                @if((isset($trade['fee_data'][23])))

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">বকেয়া </td>

                        <td></td>

                        <td align="right" style="text-align:left;font-size:16px; ">&nbsp;
                            <?php //echo (isset($trade['fee_data'][23])) ? BanglaConverter::bn_number($trade['fee_data'][23]['amount']) : ''; $due = $trade['fee_data'][23]['amount']  ?>&nbsp;
                        </td>

                        <td></td>

                    </tr>

                @endif --}}

                <tr>
                    <td align="right" nowrap style="font-size:14px;text-indent:55px; font-color:black; width: 150px;
                            padding-left: 50px">Total:
                    </td>

                    <td align="right" style="text-align:right;font-size:14px; ">&nbsp;
                        <?php  $due_total = (int)(($due_fee + $due_vat + $due_signbord_vat + $due_bibidh + $due_source_vat + $due_sarcharge) ); echo number_format($due_total, 2); ?>
                        &nbsp;
                    </td>

                    <td align="right" style="text-align:left; font-size:16px; ">&nbsp;
                        <?php  $total = (int)(($fee + $due + $vat + $bibidh + $signbord_vat + $pesha_vat + $source_vat + $sarcharge)
                            ); echo number_format($total, 2); ?>&nbsp;
                    </td>

                    <td align="right" style="text-align:left; font-size:16px; ">&nbsp;
                        {{number_format($total + $due_total, 2)}}
                    </td>

                </tr>


            </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0'
                style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                <tr>
                    <td style="font-size:16px;  padding-left:50px;" height="80">This is the Business Tax Municipality Act 2009
                        (Act No. 58 of 2009) Municipality in the context of 100 According to Article 6 (1) and 6(2) Annual tax of the Ideal Tax Schedule 2014 Business / business endorsement letter is provided to the person / organization mentioned below.For the period 2021-2022 ({{ $fiscal_year_name }} Fiscal_year) Until 30.06.2022
                    </td>

                </tr>

                </table>
        </div>

        <div id="footer">
            <table width="95%" cellpadding="0" cellspacing="0" border="0"
                style="border-collapse:collapse;margin-left: 25px; margin-top: 100px;">

                <tr>
                    <td style="padding-left:10px;font-size:16px;">
                        <div style="float:left;">
                            <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>License
                                Inspector</font>
                        </div>
                    </td>
                    <td style="padding-right:70px;font-size:16px; ">
                        <div style="float: left">
                            <font style='position:relative;float:left;left:50px;border-top: 1px solid black;'>seal</font>
                        </div>
                    </td>
                    <td>
                        <div style="display:inline;float:left">
                            <font style='float:left;right:10px;position:relative;border-top: 1px solid black;
                                '>Mayor </font>
                        </div>
                    </td>
                </tr>
            </table>


            <table border='0' width="99%" cellspacing="0" cellpadding="0"
                style="border-collapse:collapse;table-layout:fixed;margin:30px auto 0px auto;">
                <tr>
                    <td colspan="{{$colspan}}"
                        style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                        <b>Instructions:</b>
                        <br/>
                        1)To verify the certificate, go to the website and enter the 17 digit certificate number or Scan the QR code
                        from your android mobile. <br/>2) For any information please call or email to.
                        <br/>3) Come up with the old license at renewal time.
                        <br/>4) For any information please call or email to.
                    </td>
                    <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                        <?php

                        $url = $url . '/verify/trade_en/' . $trade['organization']['sonod_no'] . '/' . $trade['organization']['union_id'] . '/' . $trade['organization']['type'];

                        ?>

                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                            height="130" width="170">
                    </td>

                </tr>

            </table>

            <table border='0' width="99%" cellpadding='0' cellspacing='0'
                style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">

                <tr>
                    <td style="width: 75%;text-align:center;padding-left: 20px">
                        <font style="font-size:11px">{{ $union->sub_domain }}</font>
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

