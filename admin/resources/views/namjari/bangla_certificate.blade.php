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


    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
           cellpadding="0" cellspacing="0">

        <tr>
            <td colspan="2" style="text-align:center;font-size:20px;font-weight:bold;padding-bottom: 5px">
                <font style="">
                    <u>হোল্ডিং নামজারীর অনুমোদন পত্র</u>
                </font>
            </td>
        </tr>

        <tr>

            <td>

                <table border="1" style="width: 95%;border-color:lightgray;border-collapse:collapse;" cellpadding="0"
                       cellspacing="0">
                    <tr>
                        <td style="width:100px; text-align:center;font-weight:700;font-size:14px;">
                            অনুমোদন পত্র নং :
                        </td>
                        @php

                            $sonod = str_split($namjari->sonod_no);

                            for($i=0; $i<strlen($namjari->sonod_no); $i++):

                        @endphp

                        <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                        @php
                            endfor;
                        @endphp
                    </tr>
                </table>
            </td>


            <td rowspan="3" valign="top" style="text-align: left;">
                @if($namjari->photo != '' )
                    <img src="{{ asset('images/application/'.$namjari->photo) }}" height="100px" width="100px" style=""
                         alt="profile"/>
                @endif
            </td>

        </tr>

    </table>
    <table style="margin:5px auto;">
        <tbody>
        <tr>
            <td style="width:100px; text-align:left;text-indent: 20px;font-size:16px;">বিষয়ঃ-</td>
            <td style="width: 100%;font-size:16px; text-align:left;"><span style="border-bottom:1px dashed;
">আবেদন ট্রাকিং নং {{ BanglaConverter::bn_number($namjari->tracking)  }} এর হোল্ডিং নামজারীর অনুমোদন/ আদেশ পত্র</span></td>
        </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-12" style="text-align:center; font-size:14px;">
            যে হোল্ডিং এর মালিকানা রেকর্ড সংশোধন করা হইল
        </div>
    </div>
    <table class="table1" style="border: 1px solid black; border-collapse:collapse;margin:15px auto;
            font-size:13px;"
           height="60px" border="1" width="85%">
        <tbody>
        <tr>
            <td style="border-right:none;">&nbsp;সাবেক মালিকের নাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ $namjari->former_owner_bn }}</td>
            <td style="border-right:none;">&nbsp;হোল্ডিং নাম্বার</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ $namjari->holding_no }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;পিতা/স্বামীর নাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->former_owner_father_name_bn }}</td>

            <td style="border-right:none;">&nbsp;ত্রৈমাসিক পৌরকর</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->trimasik_tax }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;বাৎসরিক মূল্যমান</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->yearly_rate }}</td>

            <td style="border-right:none;">&nbsp;সর্বশেষ এসেসমেন্ট সন</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ BanglaConverter::bn_number($namjari->last_assesment_date) }}</td>
        </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-12" style="text-align:center; font-size:14px;">
            সংশোধনক্রমে যে মালিকের নাম রেকর্ডে অন্তর্ভুক্ত হইল
        </div>
    </div>

    <table class="table1" style="border: 1px solid black; border-collapse:collapse;margin:15px auto;
            font-size:13px;"
           height="60px" border="1" width="85%">
        <tbody>
        <tr>
            <td style="border-right:none;">&nbsp;নাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->name_bn }}</td>
            <td style="border-right:none;">&nbsp;গ্রাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ $namjari->permanent_village_bn }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;পিতা/স্বামীর নাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->father_name_bn }}</td>
            <td style="border-right:none;">&nbsp;থানা</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->permanent_upazila_name_bn }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;ওয়ার্ড নং</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ $namjari->permanent_ward_no }}</td>
            <td style="border-right:none;">&nbsp;জেলা</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->permanent_district_name_bn }}</td>
        </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-12" style="text-align:center; font-size:15px;">
            মালিকানা প্রাপ্তির পূর্ণ বিবরণী
        </div>
    </div>
    <table class="table1" style=" border-collapse:collapse;margin:5px auto;font-size:13px;" width="85%"
           height="60px" border="1">
        <tbody>
        <tr>
            <td style="border-right:none;">&nbsp;প্রস্তাবিত ভূমির মৌজার নাম ও নম্বর</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->bhumi_moja_no }}</td>
            <td style="border-right:none;">&nbsp;খতিয়ান নম্বর</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->khotian_no }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;দাগ নম্বর</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->dag_no }}</td>

            <td style="border-right:none;">&nbsp;জমির পরিমাণ</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->land_amount }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;দলিল দাতার নাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->dolil_datar_name }}</td>

            <td style="border-right:none;">&nbsp;রেজিঃকৃত দলিলের নম্বর</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->dolil_no }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;রেজিঃ অফিসের নাম</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->reg_office_name }}</td>

            <td style="border-right:none;">&nbsp;রেজিঃ তারিখ</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->reg_date }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;দলিলের যে হোল্ডিং নম্বর ও মহল্লা উল্লেখ আছে</td>
            <td style="border-left:none;" colspan="3">&nbsp;:&nbsp;{{ $namjari->dolil_hold_no }}</td>
        </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-12" style="text-align:center; font-size:15px;">
            নামজারীকৃত হোল্ডিং এর পূর্ণ বিবরণী
        </div>
    </div>
    <table class="table1" style=" border-collapse:collapse;margin:5px auto;font-size:13px;" width="85%"
           height="60px" border="0">
        <tbody>
        <tr>
            <td style="border-right:none;">&nbsp;পূর্বোক্ত হোল্ডিং নং</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ $namjari->holding_no }}</td>
            <td style="border-right:none;">&nbsp;প্রাপ্ত মালিকানা</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->malikana }}</td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;পূর্বোক্ত হোল্ডিং এর পৌরকর</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ isset($fee_data[98]['amount']) ? BanglaConverter::bn_number
            ($fee_data[98]['amount']) : 0.00 }} </td> <!--
            98 = 'পূর্বোক্ত
            হোল্ডিং কর' !-->

            <td style="border-right:none;">&nbsp;অর্থ বছর</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ BanglaConverter::bn_number($namjari->fiscal_year_name) }} </td>
        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;বর্তমান নামজারীকৃত হোল্ডিং নং</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->current_holding_no }}</td>


        </tr>
        <tr>
            <td style="border-right:none;">&nbsp;হোল্ডিং এর বার্ষিক ধার্যকৃত চূড়ান্ত পৌরকর</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ isset($fee_data[99]['amount']) ?  BanglaConverter::bn_number
            ($fee_data[99]['amount']) : 0.00 }} </td> <!--
            98= 'হোল্ডিং কর' !-->
        </tr>
        </tbody>
    </table>


    <div class="row">
        <div class="col-sm-12" style="text-align:center;">
            <div class="app-heading">
                হোল্ডিং এর বিবরণী
            </div>
        </div>
    </div>
    <table class="table1" style=" border-collapse:collapse;margin:5px auto;font-size:15px;" width="85%"
           height="60px" border="1">
        <tbody>
        <tr>
            <td style="border-right:none;">&nbsp;বহুতলা দালান ও কোঠার সংখ্যা ও আয়তন</td>
            <td style="border-left:none;border-bottom:none;">&nbsp;:&nbsp;{{ $namjari->bohuthola_dalan  }}</td>
            <td style="border-right:none;">&nbsp;একতলা দালান ও কোঠার সংখ্যা ও আয়তন</td>
            <td style="border-left:none;">&nbsp;:&nbsp; {{ $namjari->ekthola_dalan  }}</td>
        </tr>

        <tr>
            <td style="border-right:none;">&nbsp;আধা পাকা ঘর ও কোঠার সংখ্যা ও আয়তন</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->ada_faka_ghor  }}</td>

            <td style="border-right:none;">&nbsp;কাঁচা ঘরের সংখ্যা ও আয়তন</td>
            <td style="border-left:none;">&nbsp;:&nbsp;{{ $namjari->kaca_ghor  }}</td>
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
        </tbody>
    </table>


    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                @if ($print_setting->sochib)
                    <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>সহকারী করনির্ধারক/করনির্ধারক</font>
                    </td>
                @endif

                @if ($print_setting->member)
                    <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>কাউন্সিলর স্বাক্ষর</font>
                    </td>
                @endif

                @if ($print_setting->chairman)
                    <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 100px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>অনুমোদনকারী</font>
                    </td>
                @endif
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

                    $url = $url . '/verify/holdingnamjari/' . $namjari->sonod_no . '/' . $namjari->union_id . '/' . $namjari->type;

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
