<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>No objection English Certificate</title>

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


        @if(! $print_setting->pad_print )
        @include('layouts.pdf_sub_layouts.certificate_header_en')

        @else

            <table>
                <tr>
                    <td style="height: 150px"></td>
                </tr>
            </table>

        @endif

        <!----header div close here---->

        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>No-objection Certificate</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:130px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                            @php

                            $sonod = str_split($onapotti->sonod_no);

                            for($i=0; $i<strlen($onapotti->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >

                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">This is to certify that,</td>
            </tr>
        </table>





    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 180px; padding-left: 50px">Name </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $onapotti->name_en }}</font>
            </td>
        </tr>



        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">Father's Name </td>
            <td>
                <font style="font-size:16px; ">: {{ $onapotti->father_name_en }} </font>
            </td>
        </tr>


        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">Present Address </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : Village : {{ $onapotti->present_village_en }}
                    <br> &nbsp; Post Office: {{ $onapotti->present_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $onapotti->present_upazila_name_en }}
                    <br> &nbsp; District: {{ $onapotti->present_district_name_en}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">Permanent Address </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : Village: {{ $onapotti->permanent_village_en }}
                    <br> &nbsp; Post Office: {{ $onapotti->permanent_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $onapotti->permanent_upazila_name_en }}
                    <br> &nbsp; District: {{ $onapotti->permanent_district_name_en }}
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Ward No </td>
            <td>
                <font style="font-size:16px;  ">:  {{ $onapotti->permanent_ward_no }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Organization Name</td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->organization_name_en) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Factory destination</td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->organization_location_en) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Business type</td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->organization_type_en) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Trade license no</td>
            <td>
                <font style="font-size:16px;  ">:  {{ $onapotti->trade_license_no }}</font>
            </td>
        </tr>


        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Date </td>
            <td>
                 <font style="font-size:16px;">:  <?php echo date('d-m-Y', strtotime($onapotti->generate_date)); ?></font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Land Description </td>
            <td>
                <table border='1' cellpadding='0' cellspacing='0' width='98%'>
                    <tr>
                        <td>Moja</td>
                        <td>Thana</td>
                        <td>District</td>
                        <td>Khatian no</td>
                        <td>Dag no</td>
                        <td>Land type</td>
                        <td>Land amount</td>
                    </tr>
                    <tr>
                        <td>{{ $onapotti->moja }}</td>
                        <td>{{ $onapotti->thana }}</td>
                        <td>{{ $onapotti->district }}</td>
                        <td>{{ $onapotti->khotian_no }}</td>
                        <td>{{ $onapotti->dag_no }}</td>
                        <td>{{ $onapotti->land_type }}</td>
                        <td>{{ $onapotti->land_amount }}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp; Letter of No Objection was issued for conducting the activities of the said organization in accordance with the above information and the following conditions. </td>

        </tr>

        <tr>
        	<td style="padding-left:72px; font-size:17px; height: 20px">I wish him all the best and prosperity.</td>
        </tr>

    </table>

    <table border="0px" height="20px" width='99%' style="border-collapse:collapse; margin:5px auto;" cellspacing="0" cellpadding="0" >

        <tr height="20px" valign="top">

            <td  style="font-size:12px; text-align:center;">[Note: If this certificate is accepted by concealing / irregularity of information, it will be considered void and the responsibility will be shifted on the recipient of the certificate.]</td>

        </tr>
    </table>


    <div style="position: fixed; bottom: 5px;">
    <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
        <tr>
            @if ($print_setting->sochib)
            <td style="padding-left:50px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Secretary Signature</font>
            </td>
            @endif

            @if ($print_setting->member)
            <td style="padding-left:50;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Councilor Signature</font>
            </td>
            @endif

            @if ($print_setting->chairman)
            <td style="padding-left:{{$colspan>2? 100 : 250}}px;font-size:15px; height: 100px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;width: 270px'>Mayor Signature</font>
            </td>
            @endif

        </tr>

        <tr>
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:15px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b >Instructions:</b>
                <br />


                1) No illegal activities should pollute the environment in any way <br /> 2) All wastes should be collected and removed in a planned manner. <br/> 3) Employed workers should ensure a healthy environment and safety measures. <br/> 4) Production activities cannot be conducted without obtaining environmental clearance. <br/> 5) If there is government space next to / in front of the factory, it cannot be used in an approved manner. <br/> 6) There should be proper fire extinguishing system. <br/> 6) If there is any allegation of pollution, the no-objection letter will be considered void.
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                <?php

                    $url = $url.'/verify/onapotti_en/'.$onapotti->sonod_no.'/'.$onapotti->union_id;

                ?>

               <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="150" width="170">

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
</body>

</html>
