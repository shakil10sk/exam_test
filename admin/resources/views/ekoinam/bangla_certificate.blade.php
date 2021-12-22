<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা একই নামের প্রত্যয়ন</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn',['type' => 7 ])

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
                   cellpadding="0" cellspacing="0"  >
                <tr>
                    <td width="60%"  style=" text-align:right;font-size:25px;font-weight:bold;padding-bottom: 15px;
                margin-right: 40px">
                        <font style="">
                            <u>একই নামের প্রত্যয়ন</u>
                        </font>
                    </td>

                    <td width="40%"  style="text-align:right;font-weight:bold;padding-bottom: 8px;padding-right: 20px">
                        <font style="font-size: 15px">
                            ইস্যু
                            তারিখ: <?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($ekoinam->generate_date))); ?>
                        </font>
                    </td>
                </tr>



                {{-- <tr >
                    <td colspan="8" style=" height: 5px">
                    </td>
                </tr> --}}

            </table>


            <table style="width:92%; margin-left:48px;border-color:lightgray;border-collapse:collapse;
            margin-top:10px;margin-bottom: 8px"
                   cellpadding="0" cellspacing="0" >

                <tr>
                    <td>
                        <table border="1" width="83%" style="width: {{ ($ekoinam->photo != '')?'580px':'700px'  }};
                            border-color:lightgray;
                            border-collapse:collapse; margin-left: 20px"
                               cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="15%" style="text-align:center;font-weight:700;font-size:17px;">সনদ নং</td>
                                @php

                                    $sonod = str_split($ekoinam->sonod_no);

                                    for($i=0; $i<strlen($ekoinam->sonod_no); $i++):

                                @endphp

                                <td style="text-align:center; font-weight:bold; font-size:20px;">
                                    {{ BanglaConverter::bn_number($sonod[$i]) }}</td>

                                @php
                                    endfor;
                                @endphp
                            </tr>
                        </table>
                    </td>
                    @if($ekoinam->photo != '')
                        <td rowspan="3" valign="right" style="text-align: left; margin-left: 7px ">
                            @if($ekoinam->photo != '' )
                                <img src="{{ asset('images/application/'.$ekoinam->photo) }}" height="100px" width="100px" style=""
                                     alt="profile"/>
                            @endif

                        </td>
                    @endif


                </tr>
                <tr>
                    <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px; padding-left:50px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>
                </tr>
            </table>


    <table class="jolchap"  align="center" border="0" height="300px" width='95%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5; margin-left: 50px">

        <tr>
            <td align="left" style="font-size:16px;text-indent:50px; font-color:black; width: 200px; padding-left:
            50px">নাম </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $ekoinam->name_bn }}</font>
            </td>
        </tr>
        <br>

        @if ($ekoinam->marital_status == 2 && $ekoinam->gender == 2 )

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্বামীর নাম</td>
            <td>
                <font style="font-size:16px; ">: {{ $ekoinam->husband_name_bn }}</font>
            </td>
        </tr>
            <br>

        @endif

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">পিতার নাম </td>
            <td>
                <font style="font-size:16px; ">: {{ $ekoinam->father_name_bn }} </font>
            </td>
        </tr>
        <br>

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">মাতার নাম</td>

            <td>
                <font style="font-size:16px;  ">: {{ $ekoinam->mother_name_bn }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:10px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

            <td style=" vertical-align:top;">
                <p style="line-height:10px;font-size:16px; ">

                    : গ্রামঃ {{ $ekoinam->present_village_bn }}
                    <br>
                     &nbsp;ডাকঘরঃ {{ $ekoinam->present_postoffice_name_bn }}
                    &nbsp; উপজেলাঃ {{ $ekoinam->present_upazila_name_bn }}
                     &nbsp; জেলাঃ {{ $ekoinam->present_district_name_bn}}
                    </p>
            </td>
        </tr>
        {{-- <br> --}}

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:10px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">স্থায়ী ঠিকানা </td>

            <td style=" vertical-align:top;">

                <p style="line-height:10px;font-size:16px;  ">
                    : গ্রামঃ {{ $ekoinam->permanent_village_bn }}
                    <br>
                     &nbsp;ডাকঘরঃ {{ $ekoinam->permanent_postoffice_name_bn }}
                    &nbsp;উপজেলাঃ {{ $ekoinam->permanent_upazila_name_bn }},
                     &nbsp;জেলাঃ {{ $ekoinam->permanent_district_name_bn }}
                </p>
            </td>
        </tr>


        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:10px; font-color:black; width: 150px; padding-left: 50px">ওয়ার্ড নং </td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($ekoinam->permanent_ward_no) }}</font>
            </td>
        </tr>
        <br>
        {{-- <br> --}}

        @if($ekoinam->nid > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ন্যাশনাল আইডি নং
            </td>
            <td>
                <font style="font-size:16px;">: {{ BanglaConverter::bn_number($ekoinam->nid) }}</font>
            </td>
        </tr>
            <br>
        @endif

        @if($ekoinam->birth_id > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">জন্ম নিবন্ধন নং </td>
            <td>
                <font style="font-size:16px;">:  {{ BanglaConverter::bn_number($ekoinam->birth_id) }}</font>
            </td>
        </tr>
            <br>
        @endif

        @if($ekoinam->passport_no > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট নং </td>
            <td>
                <font style="font-size:16px;">:  {{ BanglaConverter::bn_number($ekoinam->passport_no) }}</font>
            </td>
        </tr>
            <br>
        @endif

    </table>

    <table border='0' width='86%' cellpadding='0' cellspacing='0' style="padding-left:5px;border-collapse:collapse;margin:0 auto;padding-top:8px;">

        <tr>
            <td style="font-size:17px;text-align:center; " height="80">&nbsp; &nbsp; &nbsp;&nbsp;তিনি মধুখালি পৌরসভার সংশ্লিষ্ট ওয়ার্ডের
                {{-- {{ $union->bn_name }} --}}
                {{-- {{ BanglaConverter::bn_number($ekoinam->permanent_ward_no) }} নং ওয়ার্ডের --}}
                 {{ ($ekoinam->resident == 1) ? "অস্থায়ী" : "স্থায়ী" }} বাসিন্দা, আমার জানামতে
                 {{ $ekoinam->nickname_bn }}
                  প্রকাশে {{ $ekoinam->name_bn }}
                 একই ব্যাক্তি উভয় নামে পরিচিত।
            </td>

        </tr>

        <tr>
            <td style="padding-left:60px; font-size:17px; height: 20px">আমি তাহার সর্বাঙ্গীণ মঙ্গল ও উন্নতি কামনা করি।</td>
        </tr>

    </table>

    @if (isset($ekoinam->comment_bn))
        <table border="0" width='95%' style="border-collapse:collapse; margin:5px auto; height: 50px" cellspacing="0"
            cellpadding="0">
            <tr>
                <td style="font-size:16px; text-indent:40px; width:150px; font-weight:bold; padding-left: 55px;
                padding-top: 10px; height: 30px;">
                    <span style="">সংযুক্তিঃ</span>
                </td>
                <td style="font-size:16px;">
                    &nbsp;{{ $ekoinam->comment_bn }}
                </td>
            </tr>
        </table>
    @endif


    <div style="position: fixed; bottom: 5px;">
    <table border='0' width="87%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;padding-top:50px;">
        <tr>
            @if ($print_setting->sochib)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;</font>
                    {{-- &nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp; --}}
                </td>
            @endif

            @if ($print_setting->member)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;প্রস্তুতকারী&nbsp;&nbsp;&nbsp;&nbsp;</font>
                     {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                </td>
            @endif

            @if ($print_setting->chairman)
                <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 60px; vertical-align:
                    bottom;">
                    <font style='border-top: 1px solid black;'>মেয়র</font>&nbsp;
                </td>
            @endif
    <   /tr>

        <tr>
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:14px;box-sizing: border-box;
            -moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b >নির্দেশাবলীঃ </b>
                <br />


                ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile থেকে QR code টি Scan করুন।
                <br />২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                <?php

                $url = $url.'/verify/ekoinam_bn/'.$ekoinam->sonod_no.'/'.$ekoinam->union_id.'/'.$ekoinam->type;

                ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">
                    </img>

            </td>

        </tr>

    </table>

    <table border='0' width="87%" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 2px auto;
    table-layout:fixed;">

        <tr>
            <td style="width: 75%;text-align:center;padding-left: 20px">
                <font style="font-size:11px">Web: {{ $union->sub_domain }}.digitalpoura.org</font>
                <span>-</span>
                <font style="font-size:11px;"> Email: {{ $union->email }}</font>
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
