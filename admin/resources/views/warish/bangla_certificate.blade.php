<html>
<head>
    <meta charset="utf-8">
    <base href="">

    <title>বাংলা ওয়ারিশ সনদপত্র</title>
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

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn',['type' => 17 ])

</head>
<body>
<div class="page-border">
    @if(! $print_setting->pad_print )
        @include('layouts.pdf_sub_layouts.certificate_header_bn')

    @else
        <table>
            <tr>
                <td style="height: 150px"></td>
            </tr>
        </table>
    @endif

    <!----header div close here---->

    <table border="0px" width="98%" style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align:center;font-size:25px;font-weight:bold;
                margin-right: 40px" height="38">
                <font style="">
                    <u>ওয়ারিশ সনদপত্র</u>
                </font>
            </td>
        </tr>
    </table>

    <table border="0px" width="98%" style="border-collapse:collapse;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align:right;font-size:12px;font-weight:bold;">
                <font>&nbsp;&nbsp;&nbsp; ইস্যু তারিখঃ <?php echo BanglaConverter::bn_number(date
                    ('d-m-Y', strtotime($data['warish_data']->generate_date))); ?></font>
            </td>
        </tr>

    </table>

    <table border='1' align="left"
           style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;"
           cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:100px; text-align:center;font-weight:700;font-size:17px; ">সনদ নং :</td>

            @php

                $sonod = str_split($data['warish_data']->sonod_no);

                for($i=0; $i<strlen($data['warish_data']->sonod_no); $i++):

            @endphp

            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

            @php
                endfor;
            @endphp

        </tr>
    </table>
    <table border='1' align="left"
           style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;"
           cellpadding="0" cellspacing="0">

        <tr>
        @if(!empty($data['warish_data']->birth_id))
            <tr>
                <td style="width:100px; text-align:center;font-weight:700;font-size:16px;">জন্ম
                    নিবন্ধন নং:
                </td>
                @php
                    $birth_id = str_split($data['warish_data']->birth_id);

                @endphp

                @for($i=0; $i<strlen($data['warish_data']->birth_id); $i++)

                    <td style="text-align:center; font-weight:bold; font-size:20px;">
                        {{ BanglaConverter::bn_number($birth_id[$i]) }}</td>

                @endfor;
            </tr>
        @elseif(!empty($data['warish_data']->nid))
            <tr>
                <td style="width:100px; text-align:center;font-weight:700;font-size:15px;">
                    ন্যাশনাল আইডি নং :
                </td>
                @php
                    $nid = str_split($data['warish_data']->nid);
                @endphp

                @for($i=0; $i<strlen($data['warish_data']->nid); $i++)
                    <td style="text-align: center;font-size:14px;">
                        {{ BanglaConverter::bn_number($nid[$i]) }}</td>
                @endfor
            </tr>
            @endif
            </tr>
    </table>

    <table class="jolchap" align="center" border="0" width='99%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;table-layout:fixed; ">
        <tr height="55px" style="">
            <td colspan="2" style="font-size:18px; text-indent:50px;padding-left: 50px; padding-top: 15px;
                padding-bottom: 10px;">এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
            </td>

        </tr>
    </table>

    <table border="0px" width="99%" align="center" style="border-collapse:collapse; margin:1px auto; line-height: 1.4;"
           cellspacing="0" cellpadding="0">
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">নাম
            </td>
            <td colspan="3" style=""><font
                    style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->name_bn }}</font></td>
        </tr>
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পিতা
            </td>

            <td style="width:260px;"><font
                    style="font-size:15px;font-weight:bold;  ">: {{ $data['warish_data']->father_name_bn }} </font></td>

        </tr>
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">মাতা
            </td>
            <td colspan="3" style=""><font
                    style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->mother_name_bn }}</font></td>
        </tr>
        <tr>
            {{-- wife --}}
            @if($data['warish_data']->gender == 1 && $data['warish_data']->marital_status == 2)

                <td align="left"
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্ত্রী
                </td>
                <td colspan="3" style=""><font
                        style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->wife_name_bn }}</font></td>

            @endif

            {{-- husband --}}
            @if($data['warish_data']->gender == 2 && $data['warish_data']->marital_status == 2)

                <td align="left"
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্বামী
                </td>
                <td colspan="3" style=""><font
                        style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->husband_name_bn }}</font>
                </td>
            @endif
        </tr>

        <tr>
            <td align="left"
            style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্থায়ী ঠিকানা
        </td>
        <td colspan="3" style=""><font
                style="font-size:15px;font-weight:bold; ">:
                গ্রাম/মহল্লা:&nbsp;{{ $data['warish_data']->permanent_village_bn }},&nbsp;
                হোল্ডিং নং:&nbsp;{{ BanglaConverter::bn_number($data['warish_data']->permanent_holding_no) }},&nbsp;
                রোড/ব্লক/সেক্টর:&nbsp;{{ $data['warish_data']->permanent_village_bn }},&nbsp;
                ওয়ার্ড নং:&nbsp;{{ BanglaConverter::bn_number($data['warish_data']->permanent_ward_no) }},&nbsp;
            </font></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3" style=""><font
                style="font-size:15px;font-weight:bold; ">&nbsp;
                পোষ্ট অফিস:&nbsp;{{ $data['warish_data']->permanent_postoffice_name_bn }},&nbsp;
                উপজেলা:&nbsp;{{ $data['warish_data']->permanent_upazila_name_bn }},&nbsp;
                জেলা:&nbsp;{{ $data['warish_data']->permanent_district_name_bn }}।&nbsp;
            </font></td>
        </tr>

        {{--        @if(!empty($data['warish_data']->nid))--}}
        {{--            <tr>--}}
        {{--                <td align="left"--}}
        {{--                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ন্যাশনাল--}}
        {{--                    আইডি--}}
        {{--                </td>--}}
        {{--                <td style="font-size:15px;font-weight:bold; ">--}}
        {{--                    : {{ BanglaConverter::bn_number($data['warish_data']->nid) }}</td>--}}

        {{--            </tr>--}}
        {{--        @endif--}}
        {{--        <tr>--}}
        {{--            <td align="left"--}}
        {{--                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">জন্ম নিবন্ধন--}}
        {{--                নং--}}
        {{--            </td>--}}
        {{--            <td style="font-size:15px;font-weight:bold; ">--}}
        {{--                : {{ BanglaConverter::bn_number($data['warish_data']->birth_id) }}</font></td>--}}
        {{--        </tr>--}}

        {{--        @if($data['warish_data']->passport_no != null)--}}

        {{--            <tr>--}}
        {{--                <td align="left"--}}
        {{--                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট--}}
        {{--                    নং--}}
        {{--                </td>--}}
        {{--                <td colspan="5" style=""><font--}}
        {{--                        style="font-size:15px;font-weight:bold; ">: {{ BanglaConverter::bn_number($data['warish_data']->passport_no) }}</font>--}}
        {{--                </td>--}}
        {{--            </tr>--}}
        {{--        @endif--}}

        {{--        <tr>--}}
        {{--            <td nowrap align="left"--}}
        {{--                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">--}}
        {{--                স্থায়ী ঠিকানা--}}
        {{--            </td>--}}

        {{--            <td style=" vertical-align:top;">--}}

        {{--                <p style="line-height:25px;font-size:16px;  ">--}}
        {{--                    : গ্রামঃ {{ $data['warish_data']->permanent_village_bn }}--}}
        {{--                    <br> &nbsp; {{ !empty($data['warish_data']->permanent_rbs_bn)? "--}}
        {{--                    রোড/ব্লক/সেক্টরঃ "--}}
        {{--                    .$data['warish_data']->permanent_rbs_bn."," : ""  }} ওয়ার্ড নং {{ BanglaConverter::bn_number($data['warish_data']->permanent_ward_no)--}}
        {{--                    }}, ডাকঘরঃ {{--}}
        {{--                    $data['warish_data']->permanent_postoffice_name_bn }}--}}
        {{--                    <br> &nbsp; উপজেলাঃ {{ $data['warish_data']->permanent_upazila_name_bn }}--}}
        {{--                    <br> &nbsp; জেলাঃ {{ $data['warish_data']->permanent_district_name_bn }}--}}
        {{--                </p>--}}
        {{--            </td>--}}
        {{--        </tr>--}}


        {{--            <tr>--}}
        {{--                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px"> জন্ম তারিখ </td>--}}
        {{--                <td style="font-size:15px;font-weight:bold; ">: {{ BanglaConverter::bn_number($data['warish_data']->birth_date) }}</td>--}}
        {{--                <td valign="top" style="font-size:16px;">মৃত্যু তারিখ </td>--}}
        {{--                <td colspan="2" style="font-size:15px;font-weight:bold; ">: {{ BanglaConverter::bn_number($data['warish_data']->death_date) }}</font></td>--}}
        {{--            </tr>--}}

    </table>
    <br>

    <table border="0px" width="99%" align="center" style="border-collapse:collapse;margin:4px auto;" cellspacing="0"
           cellpadding="0">
        <tr>
            <td style="padding-left: 50px; height: 25px;">
                <font style="font-size:16px; padding-left:30px;"><?php $union_name = explode(" ", $union->bn_name);
                    echo $union_name[0];  ?> পৌরসভার {{
                    ($data['warish_data']->resident ==
                     1) ? "অস্থায়ী" : "স্থায়ী" }} অধিবাসী ছিলেন। মৃত্যুকালে তিনি নিম্নলিখিত ওয়ারিশগনকে রাখিয়া মৃত্যু বরণ
                    করেন।</font>
            </td>
        </tr>
    </table>
        <br>

    <table border="1" align="center" width="93%" height="250px" align="center"
           style="border-collapse:collapse; line-height: 1;" cellspacing="0" cellpadding="0">
        <tr height="20px">
            <th style="width:3%;font-size:14px;">ক্রঃ নং</th>
            <th style="width:26%;font-size:14px;">নাম</th>
            <th style="width:5%;font-size:14px;">সম্পর্ক</th>
            <th style="width:12%;font-size:14px;">পরিচয়পত্র নং</th>
            @if(count($data['warish_list']) >10)
                <th style="width:3%;font-size:14px;">ক্রঃ নং</th>
                <th style="width:26%;font-size:14px;">নাম</th>
                <th style="width:5%;font-size:14px;">সম্পর্ক</th>
                <th style="width:12%;font-size:14px;">পরিচয়পত্র নং</th>
            @endif
        </tr>
        @php $totalMembers = (count($data["warish_list"]) > 10 ) ? 10 : count($data["warish_list"])  @endphp

        <?php for($i = 0; $i < $totalMembers ; $i++):?>

        <tr height=''>
            <td style="text-align:center;font-size:13px;">{{ BanglaConverter::bn_number($i+1) }}</td>
            <td style="text-align:left;padding-left:15px;font-size:14px;">
                @php
                    echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->name_bn : "";
                @endphp
            </td>
            <td style="text-align:center;text-indent:15px;font-size:14px;">
                @php
                    echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->relation_bn : "";
                @endphp

            </td>
            <td style="text-align:center;text-indent:15px;font-size:14px;">
                @php
                    echo isset($data["warish_list"][$i]) ? BanglaConverter::bn_number($data["warish_list"][$i]->nid) : "";

                @endphp
                {{-- {{ BanglaConverter::bn_number($data['warish_data']->nid) }} --}}
            </td>

            @if(count($data['warish_list']) >10)

                <td style="text-align:center;font-size:13px;">{{ BanglaConverter::bn_number($i+11) }}</td>

                <td style="text-align:left;padding-left:15px;font-size:14px;">

                    @php
                        echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->name_bn : "";
                    @endphp
                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->relation_bn : "";
                    @endphp

                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">

                    @php
                        echo isset ($data["warish_list"][$i+10]) ? BanglaConverter::bn_number($data["warish_list"][$i+10]->nid) : "";
                    @endphp
                </td>
            @endif
        </tr>

        <?php endfor;?>

        <tr>

            <td colspan="{{(count($data['warish_list']) >10)? "8":"4" }}"
                style="text-align:right;font-size:12px; padding-right:60px;">উত্তরাধিকারীর সংখ্যা
                <span>&nbsp;&nbsp;</span> {{ count($data['warish_list']) <= 9 ? '০'.BanglaConverter::bn_number(count($data['warish_list'])) : BanglaConverter::bn_number(count($data['warish_list'])) }} &nbsp;&nbsp;জন
            </td>
        </tr>
    </table>

    {{-- <table width="98%" border="0" style="padding-top:5px;border-collapse:collapse;margin:0px auto; margin-top: 10px">
        <tr>
            <td style="font-size:16px; padding-left: 50px"> আমি মৃতের {{ ($data['warish_data']->religion == 1) ?
                "বিদেহী আত্নার মাগফেরাত" : "আত্নার শান্তি" }} এবং উওরাধিকারীগণের মঙ্গল কামনা করি।
            </td>
        </tr>
    </table> --}}



    <table style="width:95%;">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="center" style="padding-left: 40px; width:50px;  ">
                {{-- সুপারিশঃ --}}
            </td>
            <td >
                @if ($union->union_code == 26240 )
                    ধামরাই পৌরসভার
                @elseif($union->union_code == 292700)
                    মধুখালি পৌরসভার
                @else
                লোকাল পৌরসভার
                @endif <strong style="font-weight:bolder;font-size:15px;font-color:black" >{{ BanglaConverter::bn_number($data['warish_data']->investigator_name_bn) }}</strong>
                    {{-- @php
                        $employee = DB::table('warish_family_applicant_info')->select('name')->where('designation_id','=',1)->first();
                        echo $employee->name;
                    @endphp --}}
                    </strong>  এর সুপারিশ ও প্রদত্ত তথ্যের ভিত্তিতে এই সনদ প্রদান করা হলো। এখানে উল্লেখ্য যে, আবেদনপত্রে আবেদনকারী কর্তৃক ওয়ারিশান সংক্রান্ত কোন তথ্য
                ভুল প্রদান করা হলে ওয়ারিশ সনদটি বাতিল বলে গণ্য হবে।
            </td>

        </tr>

    </table>
    <table style="padding-left: 50px;">
        <tr>
            <td valign="center">
                মন্তব্য : &nbsp;
            </td>
            <td>
                {{ $data['warish_data']->comment_bn }}
           </td>

        </tr>
    </table>
    <table border='0' width="98%" style="line-height: 1.6; margin-top: 5px">
        <tr>
            <td style="padding-left:50px; font-size:15px;">
                {{-- <b>তদন্তকারীঃ {{ $data['warish_data']->investigator_name_bn }}</b></td> --}}
            <td style="font-size:15px;"></td>
            <td style="font-size:15px;"><b>আবেদনকারী : {{ $data['warish_data']->applicant_name_bn }}</b></td>
            <td style="font-size:15px;"></td>
            <td style="font-size:15px;"><b>পিতা/স্বামী : {{ $data['warish_data']->applicant_father_name_bn }}</b></td>
            <td style="font-size:15px;"></td>
        </tr>

    </table>
    <br>
    <br>
    <table border="0px" width='99%' cellspacing="0" cellpadding="0">

        <tr>
            <td height="5">
            </td>
        </tr>
    </table>

    <div style="position: fixed; bottom: 1px; ">
        <table width="95%" cellpadding="0" cellspacing="0" border="0"
               style="border-collapse:collapse;margin-left: 50px; margin-top:30px;"><!-- margin include -->

            <tr>
                <td style="padding-left:6px;font-size:16px;">
                    <div style="float:left;">
                        <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>প্রস্তুতকারী/ যাচাইকারী
                        </font>
                    </div>
                </td>
                <td style="padding-left:120px;font-size:16px;">
                    <div style="float:center;">
                        <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>মেয়র
                        </font>
                    </div>
                </td>
                {{-- <td>
                    <div style="display:inline;float:left">
                        <font style='float:left;right:20px;position:relative;border-top: 1px solid black;'>
                            &nbsp;&nbsp; &nbsp;&nbsp; মেয়র &nbsp;&nbsp;&nbsp;&nbsp;</font>
                    </div>
                </td> --}}
            </tr>
        </table>

        <table border='0' width="95%" cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                <td colspan="{{$colspan}}"
                    style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b style="border-bottom:1px solid black">নির্দেশানাবলীঃ </b>
                    <br/>


                    ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile
                    থেকে QR code টি Scan করুন।
                    {{-- <br/>২) সংযুক্ত পৌর করের রশিদ । --}}
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url . '/verify/warish_bn/' . $data['warish_data']->sonod_no . '/' . $data['warish_data']->union_id . '/' . $data['warish_data']->type;

                    ?>

                    <img
                        src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                        height="130" width="150">
                </td>

            </tr>

        </table>

        <table border='0' width="99%" height="25px" cellpadding='0' cellspacing='0'
               style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">
            <tr>
                <td style="width: 75%;text-align:center;font-family: Arial;" class="eweb"><font
                        style="font-size:11px !important;position:relative;top:-10px;">
                        Email: {{ $union->email }}</font><font
                        style="font-size:11px !important;position:relative;top:-10px;">&nbsp;&nbsp;Web:@if (env('APP_TYPE') == 'single')
                            {{ env('WEB_URL') }}
                        @else
                            {{ $url }}
                        @endif</font></td>
                <td style="width: 25%;text-align:center;" class="dev"><font
                        style="font-size:10px !important;opacity:0.7;position:relative;top:-20px;"> Developed by
                        Innovation IT. </font> <br><font
                        style="font-size:12px !important;opacity:0.7;position:relative;top:-18px;">www.innovationit.com.bd </font>
                </td>

            </tr>
        </table>
    </div>
</div>
</body>
</html>
