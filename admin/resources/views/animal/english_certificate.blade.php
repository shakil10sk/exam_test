<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>English Pet Certificate</title>

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
    <div class="page-border">

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
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>Pet Certificate</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                            @php

                            $sonod = str_split($animal->sonod_no);

                            for($i=0; $i<strlen($animal->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($animal->photo != '' )
                        <img src="{{ asset('images/application/'.$animal->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>
        </table>

        <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Owner Name </font>
                </td>

                <td colspan="3">
                    <font style="font-size:16px;">:  {{ $animal->name_en }}</font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Father's Name </td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->father_name_en }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Mother's Name</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->mother_name_en }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">National ID</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->nid }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Birth ID</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->birth_id }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Mobile</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->mobile }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Email</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->email }} </font>
                </td>
            </tr>

            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">Present Address </td>

                <td style=" vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : Village: {{ $animal->present_village_en }}
                        <br> &nbsp; Post Office: {{ $animal->present_postoffice_name_en }}
                        <br> &nbsp; Upazila {{ $animal->present_upazila_name_en }}
                        <br> &nbsp; District: {{ $animal->present_district_name_en}}</p>
                </td>

                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">Permanent Address</td>

                <td style="vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : Village: {{ $animal->permanent_village_en }}
                        <br> &nbsp; Post Office: {{ $animal->permanent_postoffice_name_en }}
                        <br> &nbsp; Upazila: {{ $animal->permanent_upazila_name_en }}
                        <br> &nbsp; District: {{ $animal->permanent_district_name_en}}</p>
                </td>
            </tr>

            @php
                $animal_type = '';

                if($animal->animal_type == 1){
                    $animal_type = 'Dog';
                } else if($animal->animal_type == 2){
                    $animal_type = 'Cat';
                } else if($animal->animal_type == 3){
                    $animal_type = 'Elephant';
                } else if($animal->animal_type == 4){
                    $animal_type = 'Horse';
                } else if($animal->animal_type == 5){
                    $animal_type = 'Deer';
                } else if($animal->animal_type == 6){
                    $animal_type = 'Rabbits';
                } else if($animal->animal_type == 7){
                    $animal_type = 'Tiger';
                } else if($animal->animal_type == 8){
                    $animal_type = 'Lion';
                }

            @endphp

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Pet Name</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->animal_name_en }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Pet Type</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal_type }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Pet Age</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->animal_age }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Animal Species</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->animal_type_en }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Pet Color</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->animal_color_en }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Pet Maintain Date</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->animal_keeping_date }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Hydrophobia Vaccine Date</td>

                <td colspan="3">
                    <font style="font-size:16px; ">: {{ $animal->jolatongko_date }} </font>
                </td>
            </tr>

            <tr>
                <td></td>
                <td colspan="3">

                @php
                    $total = 0;
                @endphp

                    <table style="width: 70%; border: 1px solid black;border-collapse: collapse;">
                        <tr>
                            <th style="border: 1px solid black;padding-left:10px;">Recovery Details</th>

                            <th style="border: 1px solid black;">Taka</th>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">Animal license Fee/Annual Fee</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $mfee = isset($animal->fee_list[91]) ? $animal->fee_list[91]['amount'] : 0; $total += $mfee; echo $mfee; @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">VAT(15%)</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $vfee = isset($animal->fee_list[25]) ? floor($animal->fee_list[25]['amount']) : 0; $total += $vfee; echo $vfee; @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">Source Income Tax</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srcfee = isset($animal->fee_list[97]) ? $animal->fee_list[97]['amount'] : 0; $total += $srcfee; echo $srcfee; @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">Due</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $dfee = isset($animal->fee_list[23]) ? $animal->fee_list[23]['amount'] : 0; $total += $dfee; echo $dfee; @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">Surcharges</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srfee = isset($animal->fee_list[22]) ? $animal->fee_list[22]['amount'] : 0; $total += $srfee; echo $srfee; @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">Discount</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $disfee = isset($animal->fee_list[24]) ? $animal->fee_list[24]['amount'] : 0; $total -= $disfee; echo '(-)'.$disfee; @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;text-align:center;">Total</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{ $total }}</td>
                        </tr>

                    </table>
                </td>
            </tr>

            <br/>

            <tr height="50px">
                <td  colspan="4" style="font-size:16px; vertical-align:top;padding-left:55px; ">
                    <p>
                        Approval of trade / profession of trade / profession by item 8, 10, 19 and 22 of section 102 to 108 of the Local Government (Pourashava) Act, 2009 and 102-108 is given in favor of the person / organization mentioned below until {{$animal->expire_date}}.
                    </p>
                </td>
            </tr>

            <tr>

        </table>

    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                @if ($print_setting->sochib)
            <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Secretary Signature</font>
            </td>
            @endif

            @if ($print_setting->member)
            <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Councilor Signature</font>
            </td>
            @endif

            @if ($print_setting->chairman)
            <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 100px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Mayor Signature</font>
            </td>
            @endif
            </tr>

            <tr>
                <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b >Instructions: </b>
                    <br />

                    1) To verify the certificate, go to the website and enter the 17 digit certificate numberor Scan the QR code from your android mobile.
                    <br />
                    2) For any information please call or email to.
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url.'/verify/animal_en/'.$animal->sonod_no.'/'.$animal->union_id.'/'.$animal->type;

                    ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">
                    </img>
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

    </div>
    </div>
</body>

</html>
