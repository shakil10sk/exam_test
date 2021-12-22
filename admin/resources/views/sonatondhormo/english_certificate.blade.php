<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>Traditional religion English Certificate</title>

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
            margin:20px 0px;
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
                        <u>Traditional Religion Certificate</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                            @php

                            $sonod = str_split($sonaton->sonod_no);

                            for($i=0; $i<strlen($sonaton->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                    @if($sonaton->photo != '' )
                        <img src="{{ asset('images/application/'.$sonaton->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">This is to certify that,</td>
            </tr>
        </table>





    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Name </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $sonaton->name_en }}</font>
            </td>
        </tr>

        @if ($sonaton->marital_status == 2 && $sonaton->gender == 2 )

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Husband Name</td>
            <td>
                <font style="font-size:16px; ">: {{ $sonaton->husband_name_en }}</font>
            </td>
        </tr>

        @endif

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">Father's Name </td>
            <td>
                <font style="font-size:16px; ">: {{ $sonaton->father_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Mother's Name</td>
            <td>
                <font style="font-size:16px;  ">: {{ $sonaton->mother_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">Present Address </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : Village : {{ $sonaton->present_village_en }}
                    <br> &nbsp; Post Office: {{ $sonaton->present_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $sonaton->present_upazila_name_en }}
                    <br> &nbsp; District: {{ $sonaton->present_district_name_en}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">Permanent Address </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : Village: {{ $sonaton->permanent_village_en }}
                    <br> &nbsp; Post Office: {{ $sonaton->permanent_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $sonaton->permanent_upazila_name_en }}
                    <br> &nbsp; District: {{ $sonaton->permanent_district_name_en }}
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Ward No </td>
            <td>
                <font style="font-size:16px;  ">:  {{ $sonaton->permanent_ward_no }}</font>
            </td>
        </tr>

         @if($sonaton->nid  > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">        National ID
            </td>
            <td>
                <font style="font-size:16px;">: {{ $sonaton->nid }}</font>
            </td>
        </tr>
        @endif


        @if($sonaton->birth_id > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Birth ID </td>
            <td>
                <font style="font-size:16px;">:  {{ $sonaton->birth_id }}</font>
            </td>
        </tr>
        @endif


        @if($sonaton->passport_no > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport No </td>
            <td>
                <font style="font-size:16px;">:  {{ $sonaton->passport_no }}</font>
            </td>
        </tr>
        @endif

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Date </td>
            <td>
                 <font style="font-size:16px;">:  <?php echo date('d-m-Y', strtotime($sonaton->generate_date)); ?></font>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp;  To my knowledge, {{ ($sonaton->gender == 1) ? 'he' : 'she' }} is a permanent resident of Ward {{ $sonaton->permanent_ward_no}} in the union. {{ ($sonaton->gender == 1) ? 'He' : 'She' }} practiced traditional religion. </td>

        </tr>

        <tr>
            <td style="padding-left:72px; font-size:17px; height: 20px">I wish {{ ($sonaton->gender == 1) ? 'him' : 'her' }} all the best and prosperity.</td>
        </tr>

    </table>

    <table border="0" width='99%' style="border-collapse:collapse; margin:5px auto; height: 100px" cellspacing="0" cellpadding="0">

        <tr>

            <td style="font-size:16px; text-indent:70px; width:150px; font-weight:bold; padding-left: 55px; padding-top: 10px; height: 50px;">
                <span style="">Comment:</span>
            </td>

            <td  style="font-size:16px;">&nbsp;{{ $sonaton->comment_en }}
            </td>
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
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b >Instructions:</b>
                <br />


                1)To verify the certificate from the Web site with the T1 digit certificate number or scan the QR code from your Android Mobile. <br />2) For any information please call or email to.
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                <?php

                $url = $url.'/verify/sonaton_en/'.$sonaton->sonod_no.'/'.$sonaton->union_id.'/'.$sonaton->type;

                ?>
                <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">
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
