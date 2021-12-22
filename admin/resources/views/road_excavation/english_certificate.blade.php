<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>English Road Excavation Consent Certificate</title>

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
                        <u>Road Excavation Consent Certificate</u>
                    </font>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                            @php

                            $sonod = str_split($data->sonod_no);

                            for($i=0; $i<strlen($data->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($data->photo != '' )
                        <img src="{{ asset('images/application/'.$data->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>
        </table>

        <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Applicant Name </font>
                </td>

                <td colspan="3">
                    <font style="font-size:16px;">:  {{ $data->name_en }}</font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Father's Name </td>

                <td>
                    <font style="font-size:16px; ">: {{ $data->father_name_en }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Mother's Name</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $data->mother_name_en }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">National ID</td>

                <td>
                    <font style="font-size:16px; ">: {{ $data->nid }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Birth ID</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $data->birth_id }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">Mobile</td>

                <td>
                    <font style="font-size:16px; ">: {{ $data->mobile }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">Email</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $data->email }} </font>
                </td>
            </tr>

            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">Present Address </td>

                <td style=" vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : Village: {{ $data->present_village_en }}
                        <br> &nbsp; Post Office: {{ $data->present_postoffice_name_en }}
                        <br> &nbsp; Upazila {{ $data->present_upazila_name_en }}
                        <br> &nbsp; District: {{ $data->present_district_name_en}}</p>
                </td>

                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">Permanent Address</td>

                <td style="vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : Village: {{ $data->permanent_village_en }}
                        <br> &nbsp; Post Office: {{ $data->permanent_postoffice_name_en }}
                        <br> &nbsp; Upazila: {{ $data->permanent_upazila_name_en }}
                        <br> &nbsp; District: {{ $data->permanent_district_name_en}}</p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">
                    Holding No
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $data->holding_no }}
                    </span>
                </td>

                <td  align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">
                    The amount of road cut/boring
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->cutting_amount }}
                    </span>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">
                    Moholla
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $data->moholla_en }}
                    </span>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">
                    Name of Road
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->road_name_en }}
                    </span>
                </td>
            </tr>

            @php
                $road_type = '';

                if($data->road_type == 1){
                    $road_type = 'Raw';
                } else if($data->road_type == 2){
                    $road_type = 'Paved';
                } else if($data->road_type == 3){
                    $road_type = 'Half Paved';
                } else if($data->road_type == 4){
                    $road_type = 'Carpeting';
                } else if($data->road_type == 5){
                    $road_type = 'W.B.M';
                } else if($data->road_type == 6){
                    $road_type = 'H.B.B';
                } else if($data->road_type == 7){
                    $road_type = 'Soling';
                } else if($data->road_type == 8){
                    $road_type = 'R.C.C';
                }

                $road_cutting_cause = '';

                if($data->cutting_cause == 1){
                    $road_cutting_cause = 'Gas Line Connection';
                } else if($data->cutting_cause == 2){
                    $road_cutting_cause = 'Water Line Connection';
                } else if($data->cutting_cause == 3){
                    $road_cutting_cause = 'Electric Line Connection';
                }

            @endphp

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">
                    Type of Road
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $road_type }}
                    </span>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">
                    Reason for cutting road
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $road_cutting_cause }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr height="50px">
                <td  colspan="4" style="font-size:16px; vertical-align:top;padding-left:55px; ">
                    <p>
                        Due to your application for cutting <span style="font-weight: bold;text-decoration: underline;">{{$data->cutting_amount}}</span> Square Foot of <span style="font-weight: bold;text-decoration: underline;">{{$road_type}}</span> road of <span style="font-weight: bold;text-decoration: underline;">{{$data->road_name_en}}</span> road for <span style="font-weight: bold;text-decoration: underline;">{{$road_cutting_cause}}</span> to you house/organization permission given according to below condition.
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr>
                <td  colspan="4" style="font-size:16px; vertical-align:top;padding-left:55px; ">
                    <p>Conditions:</p></br>
                    <p>
                        1. Telephone lines, power lines and drains cannot be damaged while cutting the road. Will be obliged to pay appropriate compensation for any kind of damage. 2. If the road is cut more than the permitted measure, he will be obliged to pay the bill along with the loss. 3. After cutting the road, you will be forced to restore it. 4. If it is necessary to cut more roads than the approved size, the road can be cut by informing the authorities and paying additional road cutting fee. No road can be cut voluntarily. 5. Permitted roads cannot be built outside of nature. . This permit will be valid for 02 (two) months only. If the prescribed time has elapsed, the permit will have to be re-accepted. . After cutting the road, the construction material lifted from the road should be kept at one's own risk. If the construction material is damaged or lost, he will be obliged to pay compensation. . The road cannot be cut for the second time by this permit. 9. You have to place the riser in your place. 10. The engineering department has to be informed before cutting the road.
                    </p>
                </td>
            </tr>

        </table>

    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                @if ($print_setting->sochib)
            <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Secretery Signature</font>
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

                    $url = $url.'/verify/roadexcavation_en/'.$data->sonod_no.'/'.$data->union_id.'/'.$data->type;

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
