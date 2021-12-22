<html>
<head>
    <meta charset="utf-8">
    <base href="">
    <title>বাংলা পারিবারিক সনদপত্র</title>


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
            <td style="text-align:center;font-size:25px;font-weight:bold;" height="38">
                <font style="">
                    <u>পারিবারিক সনদপত্র</u>
                </font>
            </td>
        </tr>
    </table>

    <table border='1' align="left"
           style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;"
           cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:100px; text-align:center;font-weight:700;font-size:17px; ">সনদ নং :</td>

            @php

                $sonod = str_split($data['family_data']->sonod_no);

                for($i=0; $i<strlen($data['family_data']->sonod_no); $i++):

            @endphp

            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

            @php
                endfor;
            @endphp

            <td style="border: none;">
                <font style="font-size: 18px">&nbsp;&nbsp;&nbsp;
                    তারিখঃ <?php echo BanglaConverter::bn_others(date('d-m-Y', strtotime($data['family_data']->generate_date))); ?></font>
            </td>

        </tr>
    </table>


    <table class="jolchap" align="center" border="0" width='99%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
        <tr height="55px" style="">
            <td colspan="2"
                style="font-size:18px; text-indent:50px;padding-left: 50px; padding-top: 15px; padding-bottom: 10px;">এই
                মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,
            </td>
        </tr>
    </table>


    <table border="0px" width="99%" align="center" style="border-collapse:collapse; margin:1px auto; line-height: 1.6;"
           cellspacing="0" cellpadding="0">
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">নাম
            </td>
            <td colspan="3" style=""><font
                    style="font-size:15px;font-weight:bold; ">: {{ $data['family_data']->name_bn }}</font></td>
        </tr>
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পিতা
            </td>

            <td style="width:260px;"><font
                    style="font-size:15px;font-weight:bold;  ">: {{ $data['family_data']->father_name_bn }} </font></td>

            <td style="font-size:15px; text-align:left; ">মাতা</td>

            <td style=""><font
                    style="font-size:15px;font-weight:bold;  ">: {{ $data['family_data']->mother_name_bn }} </font></td>
        </tr>
        <tr>
            @if($data['family_data']->gender == 1 && $data['family_data']->marital_status == 2)

                <td style="font-size:15px; text-align:center;">
                    স্ত্রী
                </td>

                <td><font style="font-size:15px;font-weight:bold;  ">: {{ $data['family_data']->wife_name_bn }} </font>
                </td>

            @endif

            @if($data['family_data']->gender == 2 && $data['family_data']->marital_status == 2)

                <td style="font-size:15px; text-align:cneter;">
                    স্বামী
                </td>

                <td><font
                        style="font-size:15px;font-weight:bold;  ">: {{ $data['family_data']->husband_name_bn }} </font>
                </td>

            @endif
        </tr>
        <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ন্যাশনাল
                আইডি
            </td>
            <td style="font-size:15px;font-weight:bold; ">
                : {{ BanglaConverter::bn_others($data['family_data']->nid) }}</td>
            <td valign="top" style="font-size:16px;">জন্ম নিবন্ধন নং</td>
            <td colspan="2" style="font-size:15px;font-weight:bold; ">
                : {{ BanglaConverter::bn_others($data['family_data']->birth_id) }}</font></td>
        </tr>

        @if($data['family_data']->passport_no != null)

            <tr>
                <td align="left"
                    style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট
                    নং
                </td>
                <td colspan="5" style=""><font
                        style="font-size:15px;font-weight:bold; ">: {{ BanglaConverter::bn_others($data['family_data']->passport_no) }}</font>
                </td>
            </tr>
        @endif

        {{-- <tr>
            <td align="left"
                style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পিন
            </td>

            <td style="font-size:15px;font-weight:bold; ">
                : {{ BanglaConverter::bn_others($data['family_data']->pin) }}</td>

            <td valign="top" style="font-size:16px;">ট্র্যাকিং</td>

            <td colspan="2" style="font-size:15px;font-weight:bold; ">
                : {{ BanglaConverter::bn_others($data['family_data']->tracking) }}</font></td>
        </tr> --}}
        <tr>
            <td align="left"
            style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্থায়ী ঠিকানা
        </td>
        <td colspan="3" style=""><font
                style="font-size:15px;font-weight:bold; ">:
                গ্রাম/মহল্লা:&nbsp;{{ $data['family_data']->permanent_village_bn }}&nbsp;
                রোড/ব্লক/সেক্টর:&nbsp;{{ $data['family_data']->permanent_rbs_bn }}&nbsp;
                ওয়ার্ড নং:&nbsp;{{ BanglaConverter::bn_number($data['family_data']->permanent_ward_no) }}&nbsp;
                পোষ্ট অফিস:&nbsp;{{ $data['family_data']->permanent_postoffice_name_bn }}&nbsp;
            </font></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3" style=""><font
                style="font-size:15px;font-weight:bold; ">&nbsp;

                উপজেলা:&nbsp;{{ $data['family_data']->permanent_upazila_name_bn }}&nbsp;
                জেলা:&nbsp;{{ $data['family_data']->permanent_district_name_bn }}&nbsp;
            </font></td>
        </tr>

    </table>
    <br>

    {{-- <table width="85%" border="0" style="border-collapse:collapse; margin:1px auto; margin-top:15px" cellspacing="0"
           cellpadding="0">
        <tr>
            <td colspan="2" style="font-size: 16px; padding-left:60px; padding-bottom: 10px;">
                <div style="border-bottom: 1px solid black;">
                    স্থায়ী ঠিকানা
                </div>
            </td>

            <td colspan="2" style="font-size: 16px; padding-left:60px;">
                <div style="border-bottom: 1px solid black;">
                    বর্তমান ঠিকানা
                </div>
            </td>
        </tr>
        <tr>
            <td width="15%">গ্রাম/মহল্লা</td>
            <td width="35%">: {{ $data['family_data']->permanent_village_bn }}</td>
            <td width="15%">গ্রাম/মহল্লা</td>
            <td>: {{ $data['family_data']->present_village_bn }}</td>
        </tr>
        <tr>
            <td>রোড/ব্লক/সেক্টর</td>
            <td>: {{ $data['family_data']->permanent_rbs_bn }}</td>
            <td>রোড/ব্লক/সেক্টর</td>
            <td>: {{ $data['family_data']->present_rbs_en }}</td>
        </tr>
        <tr>
            <td>ওয়ার্ড নং</td>
            <td>: {{ BanglaConverter::bn_number($data['family_data']->permanent_ward_no) }}</td>
            <td>ওয়ার্ড নং</td>
            <td>: {{ BanglaConverter::bn_number($data['family_data']->present_ward_no) }}</td>
        </tr>
        <tr>
            <td>পোষ্ট অফিস</td>
            <td>: {{ $data['family_data']->permanent_postoffice_name_bn }}</td>
            <td>পোষ্ট অফিস</td>
            <td>: {{ $data['family_data']->present_postoffice_name_bn }}</td>
        </tr>
        <tr>
            <td>উপজেলা</td>
            <td>: {{ $data['family_data']->permanent_upazila_name_bn }}</td>
            <td>উপজেলা</td>
            <td>: {{ $data['family_data']->present_upazila_name_bn }}</td>
        </tr>
        <tr>
            <td>জেলা</td>
            <td>: {{ $data['family_data']->permanent_district_name_bn }}</td>
            <td>জেলা</td>
            <td>: {{ $data['family_data']->present_district_name_bn }}</td>
        </tr>

    </table> --}}

    <table border="0px" width="99%" align="center" style="border-collapse:collapse;margin:4px auto; " cellspacing="0"
           cellpadding="0">
        <tr>
            <td style="padding-left: 50px; height: 25px;">
                <font style="font-size:16px; padding-left:30px;">অত্র
                    পৌরসভার {{ ($data['family_data']->resident == 1) ? "অস্থায়ী" : "স্থায়ী" }} বাসিন্দা । নিম্নে তালিকা
                    ভুক্ত সদস্যগণ তাহার পরিবারের সদস্যঃ-</font>
            </td>
        </tr>
    </table>


    <table border="1" align="center" width="93%" height="300px" style="border-collapse:collapse; line-height: 1.3;"
           cellspacing="0" cellpadding="0">
        <tr height="20px">
            <th style="width:2%;font-size:14px;">ক্রঃ নং</th>
            <th style="width:30%;font-size:14px;">নাম</th>
            <th style="width:10%;font-size:14px;">সম্পর্ক</th>
            <th style="width:8%;font-size:14px;">পরিচয়পত্র নং</th>

            @if(count($data['family_list']) >10)

                <th style="width:2%;font-size:14px;">ক্রঃ নং</th>
                <th style="width:30%;font-size:14px;">নাম</th>
                <th style="width:10%;font-size:14px;">সম্পর্ক</th>
                <th style="width:8%;font-size:14px;">পরিচয়পত্র নং</th>
            @endif
        </tr>

        <?php for($i = 0; $i < 10; $i++):?>

        <tr height=''>
            <td style="text-align:center;font-size:13px;">{{ BanglaConverter::bn_number($i+1) }}</td>

            <td style="text-align:left;padding-left:15px;font-size:14px;">
                @php
                    echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->name_bn : "";
                @endphp
            </td>
            <td style="text-align:center;text-indent:15px;font-size:14px;">
                @php
                    echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->relation_bn : "";
                @endphp

            </td>

            <td style="text-align:center;text-indent:15px;font-size:14px;">
                @php
                    echo isset ($data["family_list"][$i]) ? BanglaConverter::bn_number($data["family_list"][$i]->nid) : "";
                @endphp
            </td>

            @if(count($data['family_list']) >10)

                <td style="text-align:center;font-size:13px;">{{ BanglaConverter::bn_number($i+11) }}</td>

                <td style="text-align:left;padding-left:15px;font-size:14px;">

                    @php
                        echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->name_bn : "";
                    @endphp
                </td>
                <td style="text-align:center;text-indent:15px;font-size:14px;">
                    @php
                        echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->relation_bn : "";
                    @endphp

                </td>

                <td style="text-align:center;text-indent:15px;font-size:14px;">

                    @php
                        echo isset ($data["family_list"][$i+10]) ? BanglaConverter::bn_number($data["family_list"][$i+10]->nid) : "";
                    @endphp
                </td>
            @endif
        </tr>

        <?php endfor;?>

        <tr>

            <td colspan="{{(count($data['family_list']) >10)? "8":"4" }}"
                style="text-align:right;font-size:12px; padding-right:60px;">পরিবারের সদস্য সংখ্যা
                <span>&nbsp;&nbsp;</span> {{ BanglaConverter::bn_number(count($data['family_list'])) }} &nbsp;&nbsp;জন
            </td>

        </tr>
    </table>


    <table style="width:95%;">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="center" style="padding-left: 40px; width:50px;  ">
                {{-- সুপারিশঃ --}}
            </td>
            <td >
                {{$union->bn_name}}<b class="font-weight: bold;">{{ $data['family_data']->investigator_name_bn }}
                    {{-- @php
                        $employee = DB::table('warish_family_applicant_info')->select('name')->where('designation_id','=',1)->first();
                        echo $employee->name;
                    @endphp --}}
                    </b>  এর সুপারিশ ও প্রদত্ত তথ্যের ভিত্তিতে এই সনদ প্রদান করা হলো। এখানে উল্লেখ্য যে, আবেদনপত্রে আবেদনকারী কর্তৃক ওয়ারিশান সংক্রান্ত কোন তথ্য
                ভুল প্রদান করা হলে ওয়ারিশ সনদটি বাতিল বলে গণ্য হবে।
            </td>

        </tr>
    </table>

<br>
    <table border='0' width="98%" style="line-height: 1.6;">
        <tr>
            <td style="padding-left:50px; font-size:15px;">
                {{-- <b>তদন্তকারীঃ </b>&nbsp; <span>{{ $data['family_data']->investigator_name_bn }}</span> --}}
            </td>
            {{-- <td style="font-size:15px;">{{ $data['family_data']->investigator_name_bn }}</td> --}}
            <td style="font-size:15px;"><b>আবেদনকারী : </b><span>{{ $data['family_data']->applicant_name_bn }}</span></td>
            {{-- <td style="font-size:15px;">{{ $data['family_data']->applicant_name_bn }}</td> --}}
            <td style="font-size:15px;"><b>পিতা :</b><span>{{ $data['family_data']->applicant_father_name_bn }}</span></td>
            {{-- <td style="font-size:15px;">{{ $data['family_data']->applicant_father_name_bn }}</td> --}}
        </tr>

    </table>


    <table border="0px" width='99%' cellspacing="0" cellpadding="0">

        <tr>
            <td height="10"></td>
        </tr>
    </table>

    <div style="position: fixed; bottom: 0px;">
        <table width="95%" cellpadding="0" cellspacing="0" border="0"
               style="border-collapse:collapse;margin-left: 50px; margin-top:66px;">
            <tr>
                {{-- <td style="padding-left:10px;font-size:16px;">
                    <div style="float:left;">
                        <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>প্রস্তুতকারী
                        </font>
                    </div>
                </td> --}}
                <td style="padding-right:40px;font-size:16px; ">
                    <div style="float: left">
                        {{-- <font style='position:relative;float:left;left:50px;border-top: 1px solid black;'>সীল </font> --}}
                    </div>
                </td>
                <td>
                    <div style="display:inline;float:left">
                        <font style='float:left;right:20px;position:relative;border-top: 1px solid black;'>
                            &nbsp;&nbsp; &nbsp;&nbsp; প্রস্তুতকারী/ যাচাইকারী &nbsp;&nbsp;&nbsp;&nbsp;</font>
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
        <br>
        <table border='0' width="99%" cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                <td colspan="{{$colspan}}"
                    style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b style="border-bottom:1px solid black">নির্দেশানাবলীঃ </b>
                    <br/>


                    ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile
                    থেকে QR code টি Scan করুন।
                    <br/>২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url . '/verify/family_bn/' . $data['family_data']->sonod_no . '/' . $data['family_data']->union_id . '/' . $data['family_data']->type;

                    ?>

                    <img
                        src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                        height="130" width="170">
                </td>

            </tr>

        </table>

        <table border='0' width="99%" height="34px" cellpadding='0' cellspacing='0'
               style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">
            <tr>
                <td style="width: 75%;text-align:center;font-family: Arial;" class="eweb"><font
                        style="font-size:11px !important;position:relative;top:-10px;"> Email:{{ $union->email }}</font><font
                        style="font-size:11px !important;position:relative;top:-10px;">&nbsp;&nbsp;Web:@if (env('APP_TYPE') == 'single')
                        {{ env('WEB_URL') }}
                    @else
                        {{ $url }}
                    @endif</font>
                </td>
                <td style="width: 25%;text-align:center;" class="dev"><font
                        style="font-size:10px !important;opacity:0.7;position:relative;top:-20px;"> Developed by
                        Innovation IT. </font> <br><font
                        style="font-size:10px !important;opacity:0.7;position:relative;top:-18px;">www.innovationit.com.bd </font>
                </td>

            </tr>
        </table>
    </div>
</div>
</body>
</html>
