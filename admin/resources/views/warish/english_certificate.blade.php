<html>
    <head>
        <meta charset="utf-8">
        <base href="">

        <title>English warish certificate</title>
        <style type="text/css" media="all">

        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 12px;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            header: page-header;
            footer: page-footer;
            margin: 15px ;
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
                        <u>Successor Certificate</u>
                    </font>
                </td>

            </tr>
        </table>

        <table border='1' align="left" style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width:150px; text-align:center;font-weight:700;font-size:17px; ">Certificate No :</td>

                @php

                    $sonod = str_split($data['warish_data']->sonod_no);

                    for($i=0; $i<strlen($data['warish_data']->sonod_no); $i++):

                @endphp

                <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                @php
                    endfor;
                @endphp

                 <td style="border: none;">
                    <font style="font-size: 18px">&nbsp;&nbsp;&nbsp; Issue Date:  <?php echo date('d-m-Y', strtotime
                        ($data['warish_data']->generate_date)); ?></font>
                </td>

            </tr>
        </table>


        <table class="jolchap" align="center" border="0"  width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
            <tr height="55px" style="">
                <td colspan="2"  style="font-size:18px; text-indent:50px;padding-left: 50px; padding-top: 15px; padding-bottom: 10px;">Certification to the effect that going to be,</td>

            </tr>
        </table>


        <table border="0px" width="99%"   align="center" style="border-collapse:collapse; margin:1px auto; line-height:1.5" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left" style="font-size:14px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Name   </td>
                <td colspan="3" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->name_en }}</font></td>
            </tr>
            <tr>
                <td align="left" style="font-size:14px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Father's Name </td>

                <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['warish_data']->father_name_en }} </font></td>


            </tr>
            <tr>
                <td align="left" style="font-size:14px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Mother's Name </td>

                <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['warish_data']->mother_name_en }} </font></td>
            </tr>

            <tr>

                @if($data['warish_data']->gender == 1 && $data['warish_data']->marital_status == 2)

                <td align="left" style="font-size:14px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Wife Name  </td>

                <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['warish_data']->wife_name_en }} </font></td>

                @endif

                @if($data['warish_data']->gender == 2 && $data['warish_data']->marital_status == 2)

                <td align="left" style="font-size:14px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Husband Name </td>
                <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['warish_data']->husband_name_en }} </font></td>

                @endif
            </tr>
            @if(!empty($data['warish_data']->nid))
            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">NID  </td>
                <td style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->nid }}</td>

            </tr>
            @endif
            @if(!empty($data['warish_data']->birth_id))
            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Birth ID  </td>
                <td style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->birth_id }}</td>

            </tr>
            @endif

            @if($data['warish_data']->passport_no != null)
            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport No   </td>
                <td colspan="5" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->passport_no }}</font></td>
            </tr>
            @endif
            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">Permanent Address </td>

                <td style=" vertical-align:top;">

                    <p style="line-height:25px;font-size:16px;  ">
                        : Village: {{ $data['warish_data']->permanent_village_en }}
                        <br>
                        {{ !empty($data['warish_data']->permanent_rbs_en)? "
                    Road/ Block/Sector: "
                    .$data['warish_data']->permanent_rbs_en."," : ""  }} Word no: {{
                    $data['warish_data']->permanent_ward_no
                    }},
                        <br> &nbsp; Post Office: {{ $data['warish_data']->permanent_postoffice_name_en }}
                        <br> &nbsp; Upazila/Thana: {{ $data['warish_data']->permanent_upazila_name_en }}
                        <br> &nbsp; District: {{ $data['warish_data']->permanent_district_name_en }}
                    </p>
                </td>
            </tr>

        </table>
        <br>

{{--        <table width="85%" border="0"  style="border-collapse:collapse; margin:1px auto; margin-top:15px line-height: 1.5;" cellspacing="0" cellpadding="0">--}}

{{--            <tr>--}}
{{--                <td colspan="2" style="font-size: 16px; padding-left:60px; padding-bottom: 10px;" >--}}
{{--                    <div style="border-bottom: 1px solid black;">--}}
{{--                        Permanent Address--}}
{{--                    </div>--}}
{{--                </td>--}}

{{--                <td colspan="2" style="font-size: 16px; padding-left:60px;">--}}
{{--                    <div style="border-bottom: 1px solid black;">--}}
{{--                        Present Address--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td width="15%">Village </td>--}}
{{--                <td width="35%">: {{ $data['warish_data']->permanent_village_en }}</td>--}}
{{--                <td width="15%">Village </td>--}}
{{--                <td>: {{ $data['warish_data']->present_village_en }}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Road/Block </td>--}}
{{--                <td>: {{ $data['warish_data']->permanent_rbs_en }}</td>--}}
{{--                <td>Road/Block </td>--}}
{{--                <td>: {{ $data['warish_data']->present_rbs_en }}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Ward No </td>--}}
{{--                <td>: {{ $data['warish_data']->permanent_ward_no }}</td>--}}
{{--                <td>Ward No </td>--}}
{{--                <td>: {{ $data['warish_data']->present_ward_no }}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td>Post Office </td>--}}
{{--                <td>: {{ $data['warish_data']->permanent_postoffice_name_en }}</td>--}}
{{--                <td>Post Office </td>--}}
{{--                <td>: {{ $data['warish_data']->present_postoffice_name_en }}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Upazila </td>--}}
{{--                <td>: {{ $data['warish_data']->permanent_upazila_name_en }}</td>--}}
{{--                <td>Upazila </td>--}}
{{--                <td>: {{ $data['warish_data']->present_upazila_name_en }}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>District </td>--}}
{{--                <td>: {{ $data['warish_data']->permanent_district_name_en }}</td>--}}
{{--                <td>District </td>--}}
{{--                <td>: {{ $data['warish_data']->present_district_name_en }}</td>--}}
{{--            </tr>--}}
{{--        </table>--}}

        <br>
        <table border="0px" width="99%"  align="center" style="border-collapse:collapse;margin:4px auto; " cellspacing="0" cellpadding="0">
            <tr>
                <td style="padding-left: 50px; height: 25px;">
                    <font style="font-size:16px; padding-left:30px;"> {{ ($data['warish_data']->gender == 1) ? "He" :
                     "She" }} was a <span>{{ ($data['warish_data']->resident == 1) ? "Temporary" : "Permanent" }}
                        </span> resident in this municipility.
                                Below list of successors During {{ ($data['warish_data']->gender == 1) ? "his" : "her" }}death time.</font>
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

                    @if(count($data['warish_list']) >10)

                    <th style="width:5%;font-size:14px;">No</th>
                    <th style="width:20%;font-size:14px;">Name</th>
                    <th style="width:10%;font-size:14px;">Relation</th>
                    <th style="width:8%;font-size:14px;">Age</th>
                    @endif
                </tr>
            </tr>

            @php $totalMembers = (count($data["warish_list"]) > 10 ) ? 10 : count($data["warish_list"])  @endphp

            <?php for($i=0; $i< $totalMembers; $i++):?>

            <tr height=''>
                <td style="text-align:center;font-size:13px;">{{ $i+1 }}</td>

                <td style="text-align:left;padding-left:15px;font-size:14px;">
                    @php
                        echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->name_en : "";
                    @endphp
                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->relation_en : "";
                    @endphp

                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->age : "";
                    @endphp
                </td>

                @if(count($data['warish_list']) >10)

                <td style="text-align:center;font-size:13px;">{{ $i+11 }}</td>

                <td style="text-align:left;padding-left:15px;font-size:14px;">

                    @php
                        echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->name_en : "";
                    @endphp
                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->relation_en : "";
                    @endphp

                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">

                    @php
                        echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->age : "";
                    @endphp
                </td>
                @endif
            </tr>

            <?php endfor;?>

            <tr>

                <td colspan="{{(count($data['warish_list']) >10)? "8":"4" }}" style="text-align:right;font-size:12px; padding-right:60px;">Number of Successors <span>&nbsp;&nbsp;</span> {{ count($data['warish_list']) }} &nbsp;&nbsp;people</td>

            </tr>
        </table>



        <table width="98%" border="0" style="padding-top:5px;border-collapse:collapse;margin:0px auto; margin-top:
        10px">
            <tr>
                <td style="font-size:16px; padding-left: 50px"> I am praying for dead person eternal peace and good wish to {{ ($data['warish_data']->gender == 1) ? "his" : "her" }} successors.  </td>
            </tr>
        </table>


        <table border='0' width="98% " style="margin-top: 10px">
            <tr>
                <td style="padding-left:50px; font-size:15px;"><b>Investigator: {{ $data['warish_data']->investigator_name_en }}</b></td>
                <td style="font-size:15px;"></td>
                <td style="font-size:15px;"><b>Applicant Name : {{ $data['warish_data']->applicant_name_en }}</b></td>
                <td style="font-size:15px;"></td>
                <td style="font-size:15px;"><b>Father : {{ $data['warish_data']->applicant_father_name_en }}</b></td>
                <td style="font-size:15px;"></td>
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
                <font style='border-top: 1px solid black;'>Secretary Signature</font>
            </td>
            @endif

                @if ($print_setting->member)
                    <td style="padding-left:40px;font-size:15px; padding-bottom:10px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>prepared Signature</font>
                    </td>
                @endif

            @if ($print_setting->chairman)
            <td style="padding-left:{{$colspan>2? 100 : 250}}px;font-size:15px; padding-bottom: 10px; height: 100px;
                vertical-align:
                bottom;" align="right" >
                <font style='border-top: 1px solid black;width: 270px'>Mayor Signature</font>
            </td>
            @endif
        </tr>

        <tr>
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b>Instruction:</b> <br /> 1)To verify the certificate, go to the link- <font style="color:blue;">{{ $union->sub_domain }}</font>  and enter the 17 digit certificate number or Scan the QR code from your android mobile. <br />
                            2) Attached municipal tax receipt.
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                        $url = $url.'/verify/warish_en/'.$data['warish_data']->sonod_no.'/'.$data['warish_data']->union_id.'/'.$data['warish_data']->type;

                    ?>

                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="150" width="170">
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
