<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>Nagorik English Certificate</title>

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
            margin: 0px 0px;
            /*margin-buttom: 25px;*/
            /*padding: 20px;*/

        }


        @media print {
            body {
                font-size: 14px !important;
                font-family: 'bangla', sans-serif !important;
            }

        }

        .page-border {
            padding-top: 50px;
            /*margin-top: 0px;*/
            padding-right: 40px;
            padding-left: 15px;
            margin-right: 5px;
            /*padding-bottom: 40px;*/

            @if(! $print_setting->pad_print && empty($type) )
        background-image: url("{{asset('images/nagorik_border_pdf.png')}}");
            background-repeat: no-repeat;
            background-size: 100%;
            height: 1500px;
        @endif


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

<!----header div close here---->

    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
           cellpadding="0" cellspacing="0">

        <tr>
            <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                <font style="">
                    <u>Citizen Certificate</u>
                </font>
            </td>
        </tr>

        <tr>

            <td>

                <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0"
                       cellspacing="0">
                    <tr>
                        <td style="width:130px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                        @php

                            $sonod = str_split($nagorik->sonod_no);

                            for($i=0; $i<strlen($nagorik->sonod_no); $i++):

                        @endphp

                        <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                        @php
                            endfor;
                        @endphp
                    </tr>
                </table>
            </td>


            <td rowspan="3" valign="top" style="text-align: left;">
                @if($nagorik->photo != '' )
                    <img src="{{ asset('images/application/'.$nagorik->photo) }}" height="100px" width="100px" style=""
                         alt="profile"/>
                @endif
            </td>

        </tr>
    </table>
        <table style=" margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
               cellpadding="0" cellspacing="0">

            <tr>

                <td>

                    <table border="1" style="width: 580px;border-color:lightgray;border-collapse:collapse;"
                           cellpadding="0" cellspacing="0">
                        @if(!empty($nagorik->birth_id))
                            <tr>
                                <td style="width:100px; text-align:center;font-weight:700;font-size:14px;">Birth Reg. No.  :
                                </td>
                                @php
                                    $birth_id = str_split($nagorik->birth_id);

                                @endphp

                                @for($i=0; $i<strlen($nagorik->birth_id); $i++)

                                    <td style="text-align: center;font-size:14px;">
                                        {{ $birth_id[$i] }}</td>

                                @endfor;
                            </tr>
                        @elseif(!empty($nagorik->nid))
                            <tr>
                                <td style="width:100px; text-align:center;font-weight:700;font-size:14px;">
                                    National id No :
                                </td>
                                @php
                                    $nid = str_split($nagorik->nid);
                                @endphp

                                @for($i=0; $i<strlen($nagorik->nid); $i++)
                                    <td style="text-align: center;font-size:14px;">
                                        {{ $nid[$i] }}</td>
                                @endfor
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:2px;"
               cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">This is to
                    certify that,
                </td>
            </tr>
        </table>


    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Name </font>
            </td>
            <td>
                <font style="font-size:16px;">: {{ $nagorik->name_en }}</font>
            </td>
        </tr>

        @if ($nagorik->marital_status == 2 && $nagorik->gender == 2 )

            <tr>
                <td align="left"
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Husband
                    Name
                </td>
                <td>
                    <font style="font-size:16px; ">: {{ $nagorik->husband_name_en }}</font>
                </td>
            </tr>

        @endif

        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">Father's
                Name
            </td>
            <td>
                <font style="font-size:16px; ">: {{ $nagorik->father_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Mother's
                Name
            </td>
            <td>
                <font style="font-size:16px;  ">: {{ $nagorik->mother_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">
                Present Address
            </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : Village : {{ $nagorik->present_village_en }}
                    <br>
                    {{ !empty($nagorik->present_rbs_en)? "
                Road/ Block/Sector: "
                .$nagorik->present_rbs_en."," : ""  }} Word no: {{
                    $nagorik->present_ward_no
                    }},
                    <br> &nbsp; Post Office: {{ $nagorik->present_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $nagorik->present_upazila_name_en }}
                    <br> &nbsp; District: {{ $nagorik->present_district_name_en}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">
                Permanent Address
            </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : Village: {{ $nagorik->permanent_village_en }}
                    <br>
                    {{ !empty($nagorik->permanent_rbs_en)? "
                Road/ Block/Sector: "
                .$nagorik->permanent_rbs_en."," : ""  }} Word no: {{
                    $nagorik->permanent_ward_no
                    }},
                    <br> &nbsp; Post Office: {{ $nagorik->permanent_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $nagorik->permanent_upazila_name_en }}
                    <br> &nbsp; District: {{ $nagorik->permanent_district_name_en }}
                </p>
            </td>
        </tr>

        @if($nagorik->passport_no > 0)
            <tr>
                <td align="left" nowrap
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport
                    No
                </td>
                <td>
                    <font style="font-size:16px;">: {{ $nagorik->passport_no }}</font>
                </td>
            </tr>
        @endif

        <tr>
            <td align="left" nowrap
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Date
            </td>
            <td>
                <font style="font-size:16px;">: <?php echo date('d-m-Y', strtotime($nagorik->generate_date)); ?></font>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp;
                &nbsp; <?php if ($nagorik->gender == 1) {
                    echo "He";
                } else {
                    echo "She";
                }?> is a permanent citizen of Bangladesh by birth. To the best of my
                knowledge <?php if ($nagorik->gender == 1) {
                    echo "he";
                } else {
                    echo "she";
                }?> never takes part in any activities subversive to the state or of discipline.
            </td>

        </tr>

        <tr>
            <td style="padding-left:72px; font-size:17px; height: 20px">I wish <?php if ($nagorik->gender == 1) {
                    echo "him";
                } else {
                    echo "her";
                }?> all the best and prosperity.
            </td>
        </tr>

    </table>


    <table border='0' width="95%" cellspacing="0" cellpadding="0"
           style="border-collapse:collapse;table-layout:fixed;margin:50px 50px;">
        <tr>
            <td style="padding-left:10px;font-size:16px;">
                <div style="float:left;">
                    <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>Prepared</font>
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
               style="border-collapse:collapse;table-layout:fixed;">

        <tr>
            <td colspan="{{$colspan}}"
                style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b>Instructions:</b>
                <br/>


                1)To verify the certificate, go to the website and enter the 17 digit certificate number or Scan the QR
                code from your android mobile. <br/>2) Attached municipal tax receipt.
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                <?php

                $url = $url . '/verify/nagorik_bn/' . $nagorik->sonod_no . '/' . $nagorik->union_id . '/' . $nagorik->type;

                ?>

                <img
                    src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                    height="150" width="170">

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
</body>

</html>
