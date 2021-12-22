<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>হোল্ডিং নামজারীর অনুমোদন পত্র</title>

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



    <table style="margin:5px auto;">
        <tbody>
        <tr>
            <td style="width:100px; text-align:left;text-indent: 20px;font-size:16px;">বিষয়ঃ-</td>
            <td style="width: 100%;font-size:16px; text-align:left;"><span style="border-bottom:1px dashed;
">আবেদন ট্রাকিং নং {{ BanglaConverter::bn_number($namjari->tracking)  }} এর হোল্ডিং নামজারীর হোল্ডিং নামজারীর অনুমোদন প্রসঙ্গে।</span></td>
        </tr>
        </tbody>
    </table>
        <br>
        <br>
        <table style="border-collapse:collapse;margin:0px auto;margin-top:px;table-layout:fixed; " width="90%"
               height="70px" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
                <td style=" text-align:left;text-indent: 30px;font-size:16px;text-align: justify;">উপযুক্ত বিষয়ে
                    সংযুক্ত আবেদনকারী {{ $namjari->name_bn  }} , পিতা/স্বামী : {{ $namjari->father_name_bn  }} , গ্রাম :
                    {{ $namjari->permanent_village_bn  }}, থানা : {{ $namjari->permanent_upazila_name_bn  }} , জেলা :
                    {{ $namjari->permanent_district_name_bn  }} ।  @if($namjari->malikana == "আংশিক") হতে
                    পৃথকীকরনের মাধ্যমে নতুন হোল্ডিং @endif
                    এর
                     নামজারী আবেদন করে।  উক্ত আবেদন খানা সদয় দেখা যেতে পারে।</td>
            </tr>
            </tbody></table>
        <br>
        <table style="border-collapse:collapse;margin:0px auto;margin-top:0px;table-layout:fixed; " width="90%"
               height="70px" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
                <td style=" text-align:left;text-indent: 30px;font-size:16px;text-align: justify;">প্রাপ্ত আবেদন অনুযায়ী অত্র পৌরসভার সহকারী কর নির্ধারক/কর নির্ধারক..............................................বিষয়টি সরজমিনে পরিদর্শন /তদন্ত করেন। পরিদর্শনকালে নিম্মোক্ত বিবরণ অনুযায়ী প্রস্তাবিত হোল্ডিংটির বর্তমান অবস্থা পাওয়া যায়।</td>
            </tr>

            </tbody></table>
        <br>
        <br>

        <div class="row">
            <div class="col-sm-12" style="text-align:center;">
                <div class="app-heading">
                    হোল্ডিং এর বিবরণী
                </div>
            </div>
        </div>
        <table class="table1" style=" border-collapse:collapse;margin:5px auto;font-size:15px;" width="90%"
               height="80px" border="1">
            <tbody><tr>
                <td style="border-right:none;">&nbsp;বহুতলা দালান ও কোঠার সংখ্যা ও আয়তন</td>
                <td style="border-left:none;border-bottom:none;">&nbsp;:&nbsp; {{ $namjari->bohuthola_dalan  }} </td>
                <td style="border-right:none;">&nbsp;একতলা দালান ও কোঠার সংখ্যা ও আয়তন</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->ekthola_dalan  }}</td>
            </tr>

            <tr>
                <td style="border-right:none;">&nbsp;আধা পাকা ঘর ও কোঠার সংখ্যা ও আয়তন</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->ada_faka_ghor  }}</td>

                <td style="border-right:none;">&nbsp;কাঁচা ঘরের সংখ্যা ও আয়তন</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->ada_faka_ghor  }}</td>
            </tr>

            <tr>
                <td style="border-right:none;">&nbsp;পায়খানার সংখ্যা</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->latrin_no  }}</td>

                <td style="border-right:none;">&nbsp;জলের টেপের সংখ্যা</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->jhol_tap_no  }}</td>
            </tr>

            <tr>
                <td style="border-right:none;">&nbsp;নলকূপের সংখ্যা</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->tubewel_no  }}</td>
                <td style="border-right:none;">&nbsp;দোকান ও কারখানার সংখ্যা ও আয়তন</td>
                <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->dokan_no  }}</td>
            </tr>
            </tbody></table>
        <br>

        <table style="border-collapse:collapse;margin:0px auto;margin-top:15px;table-layout:fixed; " width="90%"
               height="30px" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
                <td style=" text-align:left;text-indent: 30px;font-size:16px;text-align: justify;">
                    পূর্বোক্ত মালিকের নামে {{ BanglaConverter::bn_number($namjari->fiscal_year_name) }} অর্থবছর পর্যন্ত বার্ষিক
                    মূল্যমান {{ BanglaConverter::bn_number($namjari->yearly_rate)  }} টাকা  ১৩% হারে
                    ত্রৈমাসিক
                    হোল্ডিং
                    কর {{ BanglaConverter::bn_number($namjari->trimasik_tax)  }} টাকা  পরিশোধকৃত। নতুন সৃষ্টিকরন হোল্ডিংটির
                    নামজারী ফি বাবদ {{ isset($fee_data[93]['amount'])?  BanglaConverter::bn_number($fee_data[93]['amount']) :
                    BanglaConverter::bn_number(0.00)
                      }}  টাকা ও হালসনের ধার্যকৃত
                    পৌরকর
                    {{ isset($fee_data[99]['amount']) ? BanglaConverter::bn_number($fee_data[99]['amount']) : BanglaConverter::bn_number
                    (0.00)  }} টাকা
                    আদায় সাপেক্ষে নামজারী করে সকল প্রকার নথি/রেজিষ্টার/সংশোধন করা যেতে পারে।
                </td>

            </tr>
            </tbody></table>
        <br>
        <br>
        <table style="border-collapse:collapse;margin:0px auto;margin-top:15px;table-layout:fixed; " width="90%"
               height="30px" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
                <td style=" text-align:left;text-indent: 30px;font-size:16px;text-align: justify;">
                    উল্লেখিত প্রস্তাবনাটি সদয় অনুমোদনের জন্য নথি উপস্থাপন করা হল।
                </td>

            </tr>
            </tbody></table>


    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
{{--                    <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">--}}
{{--                        <font style='border-top: 1px solid black;'>নথি প্রস্তুতকারী</font>--}}
{{--                    </td>--}}


                @if ($print_setting->member)
                    <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>মেম্বার স্বাক্ষর</font>
                    </td>
                @endif

                    <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 100px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>করনির্ধারক</font>
                    </td>

            </tr>

            <tr>
                <td colspan="{{$colspan}}"
                    style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b>নির্দেশাবলীঃ </b>
                    <br/>


                    ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile
                    থেকে QR code টি Scan করুন।
                    <br/>২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url . '/verify/prottyon_bn/' . $namjari->sonod_no . '/' . $namjari->union_id . '/' . $namjari->type;

                    ?>
                    <img height="130"
                         src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                         width="170">
                    </img>

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
</div>
</body>

</html>
