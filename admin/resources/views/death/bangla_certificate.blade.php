<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা মৃত্যু সনদপত্র</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn')

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



        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>মৃত্যু সনদ</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 580px;border-color:lightgray;border-collapse:collapse;"
                           cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($death->sonod_no);

                            for($i=0; $i<strlen($death->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;">{{ BanglaConverter::bn_number($sonod[$i]) }}</td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                    @if ($death->photo)
                    <img src="{{ asset('images/application/'.$death->photo) }}" height="100px" width="100px" style="" />
                    @endif
                </td>
            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">তারিখ : <?php echo BanglaConverter::bn_others(date('d-m-Y', strtotime($death->generate_date))); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>
            </tr>



        </table>



    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">

        {{-- /*<tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">তারিখ </td>
            <td>
                <font style="font-size:16px;">: --}}
                    <?php
                         /*echo BanglaConverter::bn_others(date('d-m-Y', strtotime($death->generate_date)));*/
                         ?>
                {{-- </font>         --}}

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">নাম </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $death->name_bn }}</font>
            </td>
        </tr>

        @if ($death->marital_status == 2 && $death->gender == 2 )

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্বামীর নাম</td>
            <td>
                <font style="font-size:16px; ">: {{ $death->husband_name_bn }}</font>
            </td>
        </tr>

        @endif

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">পিতার নাম </td>
            <td>
                <font style="font-size:16px; ">: {{ $death->father_name_bn }} </font>
            </td>
        </tr>

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">মাতার নাম</td>
            <td>
                <font style="font-size:16px;  ">: {{ $death->mother_name_bn }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : গ্রাম/মহল্লাঃ {{ trim($death->present_village_bn)}}
                    <br> &nbsp; {{ !empty($death->present_rbs_bn)? "রোড/ব্লক/সেক্টরঃ "
                    .$death->present_rbs_bn."," : ""  }} ওয়ার্ড নং {{ BanglaConverter::bn_number($death->present_ward_no) }},
                    ডাকঘরঃ {{
                    $death->present_postoffice_name_bn }}
                    <br> &nbsp; উপজেলাঃ {{ $death->present_upazila_name_bn }}
                    <br> &nbsp; জেলাঃ {{ $death->present_district_name_bn}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">স্থায়ী ঠিকানা </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : গ্রাম/মহল্লাঃ {{ $death->permanent_village_bn }}
                    <br> &nbsp; {{ !empty($death->permanent_rbs_bn)? "
                    রোড/ব্লক/সেক্টরঃ "
                    .$death->permanent_rbs_bn."," : ""  }} ওয়ার্ড নং {{ BanglaConverter::bn_number($death->permanent_ward_no)
                    }}, ডাকঘরঃ {{
                    $death->permanent_postoffice_name_bn }}
                    <br> &nbsp; উপজেলাঃ {{ $death->permanent_upazila_name_bn }}
                    <br> &nbsp; জেলাঃ {{ $death->permanent_district_name_bn }}
                </p>
            </td>
        </tr>

{{--        <tr>--}}
{{--            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ওয়ার্ড নং </td>--}}
{{--            <td>--}}
{{--                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($death->permanent_ward_no) }}</font>--}}
{{--            </td>--}}
{{--        </tr>--}}

        @if($death->nid > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">        ন্যাশনাল আইডি নং
            </td>
            <td>
                <font style="font-size:16px;">: {{ BanglaConverter::bn_others($death->nid) }}</font>
            </td>
        </tr>
        @endif

        @if($death->birth_id > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">জন্ম নিবন্ধন নং </td>
            <td>
                <font style="font-size:16px;">:  {{ BanglaConverter::bn_others($death->birth_id) }}</font>
            </td>
        </tr>
        @endif

        @if($death->passport_no > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট নং </td>
            <td>
                <font style="font-size:16px;">:  {{ BanglaConverter::bn_others($death->passport_no) }}</font>
            </td>
        </tr>
        @endif


    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td >
                {{-- ধামরাই পৌরসভার --}}
                {{-- <b class="font-weight: bold;">{{ $data['family_data']->investigator_name_bn }} --}}
                    {{-- @php
                        $employee = DB::table('warish_family_applicant_info')->select('name')->where('designation_id','=',1)->first();
                        echo $employee->name;
                    @endphp --}}
                    {{-- </b>  এর সুপারিশ ও প্রদত্ত তথ্যের ভিত্তিতে এই সনদ প্রদান করা হলো। এখানে উল্লেখ্য যে, আবেদনপত্রে আবেদনকারী কর্তৃক ওয়ারিশান সংক্রান্ত কোন তথ্য
                ভুল প্রদান করা হলে ওয়ারিশ সনদটি বাতিল বলে গণ্য হবে। <br> --}}
                {{-- তিনি অত্র পৌরসভার {{ BanglaConverter::bn_number($death->permanent_ward_no) }} নং ওর্য়াডের স্থায়ী বাসিন্দা ছিলেন --}}
            </td>

        </tr>
<br>
        <tr>
            @if ($death->religion != 1)
                <td style="padding-left:68px; font-size:17px;">আমি তাহার আত্বার শান্তি কামনা করি।</td>
            @else
            <td style="padding-left:68px; font-size:17px;">আমি মরহুমের রুহের মাগফেরাত কামনা করি।</td>
            @endif

        </tr>

    </table>

{{--    <table border="0" width='99%' style="border-collapse:collapse; margin:5px auto; height: 100px" cellspacing="0" cellpadding="0">--}}

{{--        <tr>--}}

{{--            <td style="font-size:17px; text-indent:70px; width:150px; font-weight:bold; padding-left: 55px; padding-top: 10px; height: 50px; font-size: 18px">--}}
{{--                <span style="">সংযুক্তিঃ</span>--}}
{{--            </td>--}}

{{--            <td  style="font-size:18px;">&nbsp;{{ $death->comment_bn }}--}}
{{--            </td>--}}
{{--        </tr>--}}


{{--    </table>--}}


    <div style="position: fixed; bottom: 0px;">
    <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
    <tr>
                @if ($print_setting->sochib)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;</font>
                    {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp; --}}
                </td>
                @endif

                @if ($print_setting->member)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;প্রস্তুতকারী&nbsp;&nbsp;&nbsp;&nbsp;</font>
                     {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp; --}}
                </td>
                @endif

                @if ($print_setting->chairman)
                <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 100px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;মেয়র&nbsp;&nbsp;&nbsp;&nbsp;</font>
                    {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;মেয়র&nbsp;&nbsp;&nbsp;&nbsp; --}}
                </td>
                @endif
            </tr>

        <tr>
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b >নির্দেশাবলীঃ </b>
                <br />


                ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile থেকে QR code টি Scan করুন।
                <br />২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                <?php

                $url = $url.'/verify/death_bn/'.$death->sonod_no.'/'.$death->union_id.'/'.$death->type;

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
