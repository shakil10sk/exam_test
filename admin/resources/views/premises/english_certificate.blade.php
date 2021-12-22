
<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>English Premises License</title>

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
    </style>

</head>

<body>


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



            <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">

                <tr>
                    <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                        <font style="">
                            <u>Premises Licesnse</u>
                        </font>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>Issue Date: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trade['organization']['generate_date'])->format('d-m-Y') }}</td>
                                <td style="text-align: right;padding-right: 5px;">Expire Date: {{ Carbon\Carbon::parse($trade['organization']['expire_date'])->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>

                    <td >

                        <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
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


        <div style="width:95%;" >
            <div style=" float: left; width: 50%"  >
                <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Name</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['organization_name_en'] }}</td>
                    </tr>
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Type</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type_en'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Mobile</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Email</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
                    </tr>
                </table>
            </div>
            <div style="float: right; width: 50%; margin-right: -40%; margin-top: 10px ; "  >
                @foreach($trade['organization']['owner_list'] as $owner)

                    @if(!empty($owner['photo']))
                        <img src="{{ asset('images/application/'. $owner['photo']) }}" height="200px"
                             width="200px" />
                    @endif

                @endforeach
            </div>
        </div>

            <table width="88%" cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px" >

                    <tr style="text-align: center;font-weight:bolder;">
                        <th>নং</th>
                        <td style="font-weight: 700px; font-size: 17px;">Proprietor Name</td>
                        <th style="font-weight: 700px; font-size: 17px;">Father/Husband</th>
                        <th style="font-weight: 700px; font-size: 17px;">NID/ Birth ID</th>
                        <th style="font-weight: 700px; font-size: 17px;">Mobile</th>
                    </tr>

                    @php
                        $i = 1;
                    @endphp

                    @foreach($trade['organization']['owner_list'] as $owner)


                    <tr height="20px" style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>{{  $owner['name_en'] }}</td>

                        <td>

                        @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                            {{ $owner['husband_name_en'] }}
                        @else
                            {{ $owner['father_name_en'] }}
                        @endif


                    </td>
                    <td>

                        @if ($owner['nid'] > 0)
                              {{ $owner['nid'] }}
                        @else
                             {{ $owner['birth_id'] }}
                        @endif


                    </td>

                    <td>{{ $owner['mobile'] }}</td>

                    </tr>
                    <tr height='25px' >
                        <td colspan="4">

                            <p style="font-size:15px;">Address
                            : &nbsp;{{ $owner['permanent_village_en'] }},&nbsp;&nbsp;&nbsp;, {{ $owner['permanent_village_en'] }}
                          , &nbsp;, {{ $owner['permanent_postoffice_name_en'] }},&nbsp;&nbsp;&nbsp; {{ $owner['permanent_ward_no'] }}
                            &nbsp;, {{ $owner['permanent_upazila_name_en'] }}
                           , &nbsp; {{ $owner['permanent_district_name_en'] }}
                            </p>

                        </td>
                    </tr>
                    @endforeach

            </table>


                <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

                    <tr>
                        <td align='left'  style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">Organization Address</td>
                        <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;"> : {{ $trade['organization']['trade_village_en'] }}&nbsp;{{ $trade['organization']['trade_ward_no'] }},&nbsp;{{ $trade['organization']['trade_postoffice_name_en'] }},&nbsp;{{ $trade['organization']['trade_upazila_name_en'] }},&nbsp;{{ $trade['organization']['trade_district_name_en'] }}
                        </td>
                    </tr>



                </table>


        <table class="jolchap" align="center" border="1" height="415px" width='40%' cellspacing="0" cellspacing='0'
               style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

            {{ $due = 0, $discount = 0, $signbord_vat = 0, $pesha_vat = 0, $source_vat = 0, $sarcharge = 0 }}
            <tr>
                <td align="center" ><b>Recovery Details</b></td>
                <td align="center" > <b>Taka</b> </td>
            </tr>
            <tr>
                <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">License Fee</td>
                <td style="text-align:left;font-size:16px; ">&nbsp;

                    <?php echo (isset($trade['fee_data'][90])) ? $trade['fee_data'][90]['amount'] : ''; $fee =
                        $trade['fee_data'][90]['amount']  ?>  &nbsp;Taka
                </td>

            </tr>

            @if((isset($trade['fee_data'][23])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Due </td>
                    <td style="text-align:left;font-size:16px; ">&nbsp;

                        <?php echo (isset($trade['fee_data'][23])) ? $trade['fee_data'][23]['amount'] : ''; $due = $trade['fee_data'][23]['amount']  ?>&nbsp;Taka

                    </td>

                </tr>

            @endif

            @if((isset($trade['fee_data'][24])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Discount </td>
                    <td style="text-align:left;font-size:16px; ">&nbsp;

                        <?php echo (isset($trade['fee_data'][24])) ? $trade['fee_data'][24]['amount'] : ''; $discount = $trade['fee_data'][24]['amount']  ?>&nbsp;Taka

                    </td>

                </tr>

            @endif


            <tr>
                <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Vat(15%)</td>
                <td style="text-align:left; font-size:16px;">&nbsp;

                    <?php echo (isset($trade['fee_data'][25])) ? $trade['fee_data'][25]['amount'] : ''; $vat = $trade['fee_data'][25]['amount']  ?>&nbsp;Taka

                </td>
            </tr>


            @if((isset($trade['fee_data'][21])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Signboard tax </td>

                    <td style="text-align:left;font-size:16px; ">&nbsp;

                        <?php echo (isset($trade['fee_data'][21])) ? $trade['fee_data'][21]['amount'] : ''; $signbord_vat = $trade['fee_data'][21]['amount']  ?>&nbsp;Taka

                    </td>

                </tr>

            @endif


            @if((isset($trade['fee_data'][28])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Business Tax</td>

                    <td style="text-align:left; font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][28])) ? $trade['fee_data'][28]['amount'] : ''; $pesha_vat = $trade['fee_data'][28]['amount']  ?>&nbsp;Taka

                    </td>

                </tr>

            @endif

            @if((isset($trade['fee_data'][97])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width:
                            150px; padding-left: 50px">Source Vat</td>
                    <td style="text-align:left; font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][97])) ? $trade['fee_data'][97]['amount'] : '';
                        $source_vat = $trade['fee_data'][97]['amount']  ?>&nbsp;Taka

                    </td>

                </tr>

            @endif

            @if((isset($trade['fee_data'][22])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Sarcharge</td>
                    <td style="text-align:left; font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][22])) ? $trade['fee_data'][22]['amount'] : ''; $sarcharge = $trade['fee_data'][22]['amount']  ?>&nbsp;Taka

                    </td>

                </tr>

            @endif

            <tr>
                <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Total</td>
                <td  style="text-align:left; font-size:16px; ">&nbsp;

                    <?php  $total = (int)(($fee+$due+$vat+$signbord_vat+$pesha_vat+$source_vat+$sarcharge)
                        -$discount); echo $total; ?>&nbsp;Taka
                </td>

            </tr>


        </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                    <tr>
                        <td style="font-size:17px;  padding-left:50px;" height="80">The purpose of maintaining production / wholesale and retail business as per the safe food law, 2013 and municipality standard tax schedule, 2014 and the use of hotel-restaurant / sweet meet / bakery / foodgrain / grocery and other food establishments is to use the store / building / warehouse License
                        </td>

                    </tr>

                </table>


        <table width="95%" cellpadding="0" cellspacing="0" border="0"
               style="border-collapse:collapse;margin-left: 50px; margin-top: 60px;">

            <tr>
                <td style="padding-left:10px;font-size:16px;">
                    <div style="float:left;">
                        <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>Sanitary inspector Signature</font>
                    </div>
                </td>
                <td><div style="display:inline;float:left">
                        <font style='float:left;right:10px;position:relative;border-top: 1px solid black;
'>Mayor Signature</font>
                    </div></td>
            </tr>

        </table>


                <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">


                    <tr>
                        <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                         <b >Instructions:</b>
                            <br />
                             1)To verify the certificate, go to the website and enter the 17 digit certificate number or Scan the QR code from your android mobile. <br />2) For any information please call or email to.
                            <br />3)  Come up with the old license at renewal time.
                            <br />4) For any information please call or email to.
                        </td>
                        <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                        <?php

                        $url = $url.'/verify/trade_en/'.$trade['organization']['sonod_no'].'/'.$trade['organization']['union_id'].'/'.$trade['organization']['type'];

                        ?>

                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">
                        </td>

                    </tr>

                </table>

                <table border='0' width="99%" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">

                    <tr>
                        <td style="width: 75%;text-align:center;padding-left: 20px">
                            <font style="font-size:11px">{{ $union->sub_domain }}</font>
                            <span>-</span>
                            <font style="font-size:11px;"> Email:{{ $union->email }}</font>
                        </td>
                        <td style="width: 25%;text-align:center;padding-left: 40px">

                            <font style="font-size:10px;opacity:0.7;">Developed by Innovation IT. </font>

                            <br>

                            <font style="font-size:10px;opacity:0.7;">www.innovationit.com.bd   </font></td>

                    </tr>
                </table>

</body>
</html>

