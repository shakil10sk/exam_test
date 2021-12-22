<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>বাংলা নাগরিক সনদপত্র</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn',['type' => 1 ])

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


    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:20px;"
           cellpadding="0" cellspacing="0" >
        <tr>
            <td width="60%"  style=" text-align:right;font-size:25px;font-weight:bold;padding-bottom: 15px;
                margin-right: 40px">
                <font style="">
                    <u>নাগরিক সনদ</u>
                </font>
            </td>

            <td width="40%"  style="text-align:right;font-weight:bold;padding-bottom: 15px;padding-right: 6px">
                <font style="font-size: 15px">
                    ইসু
                    তারিখ: <?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($nagorik->generate_date))); ?>
                </font>
            </td>

        </tr>
        <tr >
            <td colspan="8" style=" height: 10px">
            </td>
        </tr>

    </table>


    <table style="width:85%; margin-left:48px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table border="1" style="width: {{ ($nagorik->photo != '')?'580px':'700px'  }};border-color:lightgray;
                    border-collapse:collapse;"
                       cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="20%" style="text-align:center;font-weight:700;font-size:17px;">সনদ নং</td>
                        @php

                            $sonod = str_split($nagorik->sonod_no);

                            for($i=0; $i<strlen($nagorik->sonod_no); $i++):

                        @endphp

                        <td style="text-align:center; font-weight:bold; font-size:20px;">
                            {{ BanglaConverter::bn_number($sonod[$i]) }}</td>

                        @php
                            endfor;
                        @endphp
                    </tr>
                </table>
            </td>

            @if($nagorik->photo != '')
            <td rowspan="2" valign="right" style="text-align: left; margin-left: 0px;">
                @if($nagorik->photo != '' )
                    <img src="{{ asset('images/application/'.$nagorik->photo) }}" height="100px" width="100px" style=""
                         alt="profile"/>
                @endif

            </td>
            @endif

        </tr>

        <tr>
            <td width="95%" >

                <table border="1" style="width: {{ ($nagorik->photo != '')?'580px':'692px'  }};border-color:lightgray; border-collapse:collapse; margin-top: 10px;"
                       cellpadding="0" cellspacing="0">
                    @if(!empty($nagorik->birth_id))
                        <tr>
                            <td width="20%" style=" text-align:center;font-weight:700;font-size:14px;">জন্ম
                                নিবন্ধন নং
                            </td>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:14px;">
                            </td>
                            @php
                                $birth_id = str_split($nagorik->birth_id);

                            @endphp

                            @for($i=0; $i<strlen($nagorik->birth_id); $i++)

                                <td style="text-align: center;font-size:17px;">
                                    {{ BanglaConverter::bn_number($birth_id[$i]) }}</td>

                            @endfor;
                        </tr>
                    @elseif(!empty($nagorik->nid))
                        <tr>
                            <td width="20%" style=" text-align:center;font-weight:700;font-size:14px;">
                                ন্যাশনাল আইডি নং :
                            </td>
                            @php
                                $nid = str_split($nagorik->nid);
                            @endphp

                            @for($i=0; $i<strlen($nagorik->nid); $i++)
                                <td style="text-align: center;font-size:12px;">
                                    {{ BanglaConverter::bn_number($nid[$i]) }}</td>
                            @endfor
                        </tr>
                    @endif
                </table>
            </td>
        </tr>

    </table>


    {{-- <table width="95%" height="415px" style="  margin-left:48px;border-color:lightgray;border-collapse:collapse;"
           cellpadding="0" cellspacing="0">

        <tr>

            <td width="95%" >

                <table border="1" style="width: {{ ($nagorik->photo != '')?'580px':'692px'  }};border-color:lightgray;
                    border-collapse:collapse;"
                       cellpadding="0" cellspacing="0">
                    @if(!empty($nagorik->birth_id))
                        <tr>
                            <td width="20%" style=" text-align:center;font-weight:700;font-size:14px;">জন্ম
                                নিবন্ধন নং
                            </td>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:14px;">
                            </td>
                            @php
                                $birth_id = str_split($nagorik->birth_id);

                            @endphp

                            @for($i=0; $i<strlen($nagorik->birth_id); $i++)

                                <td style="text-align: center;font-size:17px;">
                                    {{ BanglaConverter::bn_number($birth_id[$i]) }}</td>

                            @endfor;
                        </tr>
                    @elseif(!empty($nagorik->nid))
                        <tr>
                            <td width="20%" style=" text-align:center;font-weight:700;font-size:14px;">
                                ন্যাশনাল আইডি নং :
                            </td>
                            @php
                                $nid = str_split($nagorik->nid);
                            @endphp

                            @for($i=0; $i<strlen($nagorik->nid); $i++)
                                <td style="text-align: center;font-size:12px;">
                                    {{ BanglaConverter::bn_number($nid[$i]) }}</td>
                            @endfor
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table> --}}

    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;"
           cellpadding="0" cellspacing="0">

        <tr>
            <td style=" height: 20px">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;এই
                মর্মে প্রত্যয়ন করা যাচ্ছে যে,
            </td>

        </tr>
    </table>


    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

        <tr>
            <td align="left"
                style="font-size:16px;text-indent:15px; font-color:black; width: 150px; padding-left: 50px">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;নাম </font>
            </td>
            <td>
                <font style="font-size:16px;">: {{ $nagorik->name_bn }}</font>
            </td>
        </tr>

        @if ($nagorik->marital_status == 2 && $nagorik->gender == 2 )
            <tr >
                <td style=" height: 10px">
                </td>
            </tr>
            <tr>
                <td align="left"
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;স্বামীর
                    নাম
                </td>
                <td>
                    <font style="font-size:16px; ">: {{ $nagorik->husband_name_bn }}</font>
                </td>
            </tr>

        @endif
        <tr >
            <td style=" height: 10px">
            </td>
        </tr>
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:15px; font-color:black; width: 150px; padding-left: 50px ">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;পিতার নাম
            </td>
            <td>
                <font style="font-size:16px; ">: {{ $nagorik->father_name_bn }} </font>
            </td>
        </tr>
        <tr >
            <td style=" height: 10px">
            </td>
        </tr>
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;মাতার নাম
            </td>
            <td>
                <font style="font-size:16px;  ">: {{ $nagorik->mother_name_bn }} </font>
            </td>
        </tr>
        <tr >
            <td style=" height: 10px">
            </td>
        </tr>

        <tr>
            <td nowrap align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 180px; padding-left: 50px;
                vertical-align:top; ">
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;বর্তমান ঠিকানা
            </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : গ্রাম/মহল্লাঃ {{ trim($nagorik->present_village_bn)}}
                     &nbsp; {{ !empty($nagorik->present_rbs_bn)? "রোড/ব্লক/সেক্টরঃ "
                    .$nagorik->present_rbs_bn."," : ""  }} ওয়ার্ড
                    নং {{ BanglaConverter::bn_number($nagorik->present_ward_no) }}
                    <br>
                    &nbsp;&nbsp;ডাকঘরঃ {{$nagorik->present_postoffice_name_bn }}
                     &nbsp;উপজেলাঃ {{ $nagorik->present_upazila_name_bn }}
                     &nbsp;জেলাঃ {{ $nagorik->present_district_name_bn}}</p>
            </td>
        </tr>

        <tr >
            <td style=" height: 10px">
            </td>
        </tr>

        <tr>
            <td nowrap align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; স্থায়ী ঠিকানা
            </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : গ্রামঃ {{ $nagorik->permanent_village_bn }}
                     &nbsp; {{ !empty($nagorik->permanent_rbs_bn)? "
                    রোড/ব্লক/সেক্টরঃ "
                    .$nagorik->permanent_rbs_bn."," : ""  }} ওয়ার্ড নং {{ BanglaConverter::bn_number($nagorik->permanent_ward_no)
                    }}
                    <br>&nbsp;
                    ডাকঘরঃ {{$nagorik->permanent_postoffice_name_bn }}
                    &nbsp; উপজেলাঃ {{ $nagorik->permanent_upazila_name_bn }}
                    &nbsp; জেলাঃ {{ $nagorik->permanent_district_name_bn }}
                </p>
            </td>
        </tr>
        @if($nagorik->nid > 0)
            <tr>
                <td align="left" nowrap
                    style="font-size:16px;text-indent:66px; font-color:black; width: 250px; padding-left: 50px">
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ন্যাশনাল আইডি নং
                </td>
                <td>
                    <font style="font-size:16px;">: {{ BanglaConverter::bn_number($nagorik->nid) }}</font>
                </td>
            </tr>
        @endif


        @if($nagorik->passport_no > 0)
            <tr>
                <td align="left" nowrap
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট
                    নং
                </td>
                <td>
                    <font style="font-size:16px;">: {{ BanglaConverter::bn_number($nagorik->passport_no) }}</font>
                </td>
            </tr>
        @endif

        {{--        <tr>--}}
        {{--            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">তারিখ </td>--}}
        {{--            <td>--}}
        {{--                <font style="font-size:16px;">: <?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($nagorik->generate_date))); ?></font>--}}
        {{--            </td>--}}
        {{--        </tr>--}}

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp; তিনি
                অত্র পৌরসভার একজন
                <font style="font-size:17px;">স্থায়ী
                </font> বাসিন্দা। তিনি জন্মগতভাবে বাংলাদেশী এবং আমার পরিচিত ।<br>
            </td>

        </tr>

        <tr>
            <td style="padding-left:72px; font-size:17px; height: 20px">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;আমি তাহার সর্বাঙ্গীণ মঙ্গল ও উন্নতি কামনা করি।
            </td>
        </tr>

    </table>

    <?php $arr = [$nagorik->nid, $nagorik->passport_no, $nagorik->birth_id]; ?>


    <table>
        <tr>
            <td height=" {{ count(array_filter($arr)) > 2 ? "25":"60" }}px">
            </td>
        </tr>
    </table>


    <div style="position: fixed; bottom: 5px;">
        <table width="95%" cellpadding="0" cellspacing="0" border="0"
               style="border-collapse:collapse;margin-left: 100px; margin-top:30px;">

            <tr>
                <td style="padding-left:6px;font-size:16px;">
                    <div style="float:left;margin-left: 20px">
                        <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>প্রস্তুতকারী
                        </font>
                    </div>
                </td>
                <td style="padding-right:20px;font-size:16px; ">
                    <div style="float: left">
                        {{-- <font style='position:relative;float:left;left:50px;border-top: 1px solid black;'>সীল </font> --}}
                    </div>
                </td>
                <td>
                    <div style="display:inline;float:left">
                        <font style='float:left;right:20px;position:relative;border-top: 1px solid black;'>
                            &nbsp;&nbsp; &nbsp;&nbsp; মেয়র &nbsp;&nbsp;&nbsp;&nbsp;</font>
                    </div>
                </td>
            </tr>
        </table>

        <table border='0' width="90%" cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                <td style=" height: 5px">
                </td>
            </tr>

            <tr>
                <td colspan="{{$colspan}}"
                    style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b>নির্দেশাবলীঃ </b>
                    <br/>


                    ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android
                    Mobile থেকে QR code টি Scan করুন।
                    <br/>২) যে কোন ধরনের তথ্যের জন্য ফোন করুন অথবা ইমেইল করুন। ।
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

        <table border='0' width="90%" cellpadding='0' cellspacing='0'
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

