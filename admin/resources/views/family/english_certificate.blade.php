<html>
    <head>
        <meta charset="utf-8">
        <base href="">
        <title>English family certificate</title>
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
            margin: 20px;
            padding: 0px;

        }

        @media print {
            body {
                font-size: 14px !important;
                font-family: 'bangla', sans-serif !important;
            }

        }
    </style>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn')

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

        <table border="0px" width="98%"  style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="text-align:center;font-size:25px;font-weight:bold;" height="38">
                    <font style="">
                        <u>Family Certificate</u>
                    </font>
                </td>

            </tr>
        </table>

        <table border='1' align="left" style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width:150px; text-align:center;font-weight:700;font-size:17px; ">Certificate No :</td>

                @php

                    $sonod = str_split($data['family_data']->sonod_no);

                    for($i=0; $i<strlen($data['family_data']->sonod_no); $i++):

                @endphp

                <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                @php
                    endfor;
                @endphp

                 <td style="border: none;">
                    <font style="font-size: 18px">&nbsp;&nbsp;&nbsp; Date:  <?php echo date('d-m-Y', strtotime($data['family_data']->generate_date)); ?></font>
                </td>

            </tr>
        </table>


        <table class="jolchap" align="center" border="0"  width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
            <tr height="55px" style="">
                <td colspan="2"  style="font-size:18px; text-indent:50px;padding-left: 50px; padding-top: 15px; padding-bottom: 10px;">Certification to the effect that going to be,</td>

            </tr>
        </table>


        <table border="0px" width="99%"   align="center" style="border-collapse:collapse; margin:1px auto;" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Name   </td>
                <td colspan="3" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->name_en }}</font></td>
            </tr>
            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Father's Name </td>

                <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['family_data']->father_name_en }} </font></td>

                <td  style="font-size:15px; text-align:left; ">Mother's Name  </td>

                <td style=""><font style="font-size:15px;font-weight:bold;  ">:   {{ $data['family_data']->mother_name_en }} </font></td>
            </tr>

            <tr>
                @if($data['family_data']->gender == 1 && $data['family_data']->marital_status == 2)

                <td  style="font-size:15px; text-align:left;">
                    Wife Name
                </td>

                <td><font style="font-size:15px;font-weight:bold;  ">:{{ $data['family_data']->wife_name_en }} </font></td>

                @endif

                @if($data['family_data']->gender == 2 && $data['family_data']->marital_status == 2)

                <td  style="font-size:15px; text-align:left;">
                    Husband Name
                </td>

                <td><font style="font-size:15px;font-weight:bold;  ">:{{ $data['family_data']->husband_name_en }} </font></td>

                @endif
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">NID  </td>
                <td style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->nid }}</td>
                <td valign="top" style="font-size:16px;">Birth ID </td>
                <td colspan="2" style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->birth_id }}</font></td>
            </tr>

            @if($data['family_data']->passport_no != null)
            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport No   </td>
                <td colspan="5" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->passport_no }}</font></td>
            </tr>
            @endif

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Pin   </td>
                <td style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->pin }}</td>
                <td valign="top" style="font-size:16px;">Tracking</td>
                <td colspan="2" style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->tracking }}</font></td>
            </tr>
            <br>
            <br>

        </table>

        <table width="85%" border="0"  style="border-collapse:collapse; margin:1px auto; margin-top:15px" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="2" style="font-size: 16px; padding-left:60px; padding-bottom: 10px;" >
                <div style="border-bottom: 1px solid black;">
                    Permanent Address
                </div>
            </td>

            <td colspan="2" style="font-size: 16px; padding-left:60px;">
                <div style="border-bottom: 1px solid black;">
                    Present Address
                </div>
            </td>
        </tr>
        <tr>
            <td width="15%">Village </td>
            <td width="35%">: {{ $data['family_data']->permanent_village_en }}</td>
            <td width="15%">Village </td>
            <td>: {{ $data['family_data']->present_village_en }}</td>
        </tr>
        <tr>
            <td>Road/Block </td>
            <td>: {{ $data['family_data']->permanent_rbs_en }}</td>
            <td>Road/Block </td>
            <td>: {{ $data['family_data']->present_rbs_en }}</td>
        </tr>
        <tr>
            <td>Ward No </td>
            <td>: {{ $data['family_data']->permanent_ward_no }}</td>
            <td>Ward No </td>
            <td>: {{ $data['family_data']->present_ward_no }}</td>
        </tr>
        <tr>
            <td>Post Office </td>
            <td>: {{ $data['family_data']->permanent_postoffice_name_en }}</td>
            <td>Post Office </td>
            <td>: {{ $data['family_data']->present_postoffice_name_en }}</td>
        </tr>
        <tr>
            <td>Upazila </td>
            <td>: {{ $data['family_data']->permanent_upazila_name_en }}</td>
            <td>Upazila </td>
            <td>: {{ $data['family_data']->present_upazila_name_en }}</td>
        </tr>
        <tr>
            <td>District </td>
            <td>: {{ $data['family_data']->permanent_district_name_en }}</td>
            <td>District </td>
            <td>: {{ $data['family_data']->present_district_name_en }}</td>
        </tr>

        </table>
        <br>


        <table border="0px" width="99%"  align="center" style="border-collapse:collapse;margin:4px auto; " cellspacing="0" cellpadding="0">
            <tr>
                <td style="padding-left: 50px; height: 25px;">
                    <font style="font-size:16px; padding-left:30px;">
                                {{ ($data['family_data']->gender == 1) ? "He" : "She" }} is a <span>{{ ($data['family_data']->resident == 1) ? "Temporary" : "Permanent" }} </span> resident in this Union. listed below people are member of his family. </font>
                </td>
            </tr>
        </table>



        <table border="1" align="center" width="93%" height="300px" align="center" style="border-collapse:collapse; line-height: 1.3;" cellspacing="0" cellpadding="0" >
            <tr height="20px">
                <tr height="20px">
                    <th style="width:5%;font-size:14px;">No</th>
                    <th style="width:20%;font-size:14px;">Name</th>
                    <th style="width:10%;font-size:14px;">Relation</th>
                    <th style="width:8%;font-size:14px;">Age</th>

                    @if(count($data['family_list']) >10)

                    <th style="width:5%;font-size:14px;">No</th>
                    <th style="width:20%;font-size:14px;">Name</th>
                    <th style="width:10%;font-size:14px;">Relation</th>
                    <th style="width:8%;font-size:14px;">Age</th>
                    @endif
                </tr>
            </tr>

            <?php for($i=0; $i<10; $i++):?>

            <tr height=''>
                <td style="text-align:center;font-size:13px;">{{ $i+1 }}</td>

                <td style="text-align:left;padding-left:15px;font-size:14px;">
                    @php
                        echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->name_en : "";
                    @endphp
                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->relation_en : "";
                    @endphp

                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->age : "";
                    @endphp
                </td>

                @if(count($data['family_list']) >10)

                <td style="text-align:center;font-size:13px;">{{ $i+11 }}</td>

                <td style="text-align:left;padding-left:15px;font-size:14px;">

                    @php
                        echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->name_en : "";
                    @endphp
                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->relation_en : "";
                    @endphp

                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">

                    @php
                        echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->age : "";
                    @endphp
                </td>
                @endif
            </tr>

            <?php endfor;?>

            <tr>

                <td colspan="{{(count($data['family_list']) >10)? "8":"4" }}" style="text-align:right;font-size:12px; padding-right:60px;">Number of Successors <span>&nbsp;&nbsp;</span> {{ count($data['family_list']) }} &nbsp;&nbsp;people</td>

            </tr>
        </table>



        <table width="98%" border="0" style="padding-top:5px;border-collapse:collapse;margin:0px auto;">
            <tr>
                <td style="font-size:16px; padding-left: 50px"> I wish all the good things of {{ ($data['family_data']->gender == 1) ? "his" : "her" }} family. </td>
            </tr>
        </table>


        <table border='0' width="98%">
            <tr>
                <td style="padding-left:50px; font-size:15px;"><b>Investigator: </b></td>
                <td style="font-size:15px;">{{ $data['family_data']->investigator_name_en }}</td>
                <td style="font-size:15px;"><b>Applicant Name : </b></td>
                <td style="font-size:15px;">{{ $data['family_data']->applicant_name_en }}</td>
                <td style="font-size:15px;"><b>Father :</b></td>
                <td style="font-size:15px;">{{ $data['family_data']->applicant_father_name_en }}</td>
            </tr>

        </table>


        <table border="0px" width='99%' cellspacing="0" cellpadding="0" >

            <tr>
                <td  height="10"></td>
            </tr>
        </table>

        <div style="position: fixed; bottom: 0px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
        <tr>
            @if ($print_setting->sochib)
            <td style="padding-left:50px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>prepared Signature</font>
            </td>
            @endif

            @if ($print_setting->member)
            <td style="padding-left:50;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>Member Signature</font>
            </td>
            @endif

            @if ($print_setting->chairman)
            <td style="padding-left:{{$colspan>2? 100 : 250}}px;font-size:15px; height: 100px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;width: 270px'>Mayor  Signature</font>
            </td>
            @endif
        </tr>

        <tr>
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b>Instruction:</b> <br /> 1)To verify the certificate, go to the link- <font style="color:blue;">{{ $union->sub_domain }}.digitalpoura.org</font>  and enter the 17 digit certificate number or Scan the QR code from your android mobile. <br />
                            2) For any information please call or email to.
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                <?php

                $url = $url.'/verify/family_en/'.$data['family_data']->sonod_no.'/'.$data['family_data']->union_id.'/'.$data['family_data']->type;

                ?>

                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">
            </td>

        </tr>

    </table>

        <table border='0' width="99%" height="34px" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">
            <tr>
                <td style="width: 75%;text-align:center;font-family: Arial;" class="eweb"> <font style="font-size:11px !important;position:relative;top:-10px;"> Email:digitalup@gmail.com</font><font style="font-size:11px !important;position:relative;top:-10px;">&nbsp;&nbsp;Web:www.digitalup.com</font></td>
                <td style="width: 25%;text-align:center;" class="dev"><font style="font-size:10px !important;opacity:0.7;position:relative;top:-20px;">   Developed by Innovation IT. </font> <br><font style="font-size:12px !important;opacity:0.7;position:relative;top:-18px;">www.innovationit.com.bd   </font></td>

            </tr>
        </table>
        </div>
        </div>
    </body>
</html>
