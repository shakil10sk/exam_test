<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>পোষা প্রানীর সনদ</title>

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
                        <u>পোষা প্রানীর সনদ</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($animal->sonod_no);

                            for($i=0; $i<strlen($animal->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($animal->photo != '' )
                        <img src="{{ asset('images/application/'.$animal->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>
        </table>

        <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">মালিকের নাম </font>
                </td>

                <td colspan="3">
                    <font style="font-size:16px;">:  {{ $animal->name_bn }}</font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">পিতার নাম </td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->father_name_bn }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">মাতার নাম</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->mother_name_bn }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">জাতীয় পরিচয় পত্র</td>

                <td>
                    <font style="font-size:16px; ">: {{ BanglaConverter::bn_others($animal->nid) }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">জন্ম নিবন্ধন নং</td>

                <td>
                    <font style="font-size:16px;  ">: {{ BanglaConverter::bn_others($animal->birth_id) }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">মোবাইল</td>

                <td>
                    <font style="font-size:16px; ">: {{ BanglaConverter::bn_others($animal->mobile) }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">ইমেইল</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->email }} </font>
                </td>
            </tr>

            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

                <td style=" vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : গ্রামঃ {{ $animal->present_village_bn }}
                        <br> &nbsp; ডাকঘরঃ {{ $animal->present_postoffice_name_bn }}
                        <br> &nbsp; উপজেলাঃ {{ $animal->present_upazila_name_bn }}
                        <br> &nbsp; জেলাঃ {{ $animal->present_district_name_bn}}</p>
                </td>

                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">স্থায়ী ঠিকানা</td>

                <td style="vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : গ্রামঃ {{ $animal->permanent_village_bn }}
                        <br> &nbsp; ডাকঘরঃ {{ $animal->permanent_postoffice_name_bn }}
                        <br> &nbsp; উপজেলাঃ {{ $animal->permanent_upazila_name_bn }}
                        <br> &nbsp; জেলাঃ {{ $animal->permanent_district_name_bn}}</p>
                </td>
            </tr>

            @php
                $animal_type = '';

                if($animal->animal_type == 1){
                    $animal_type = 'কুকুর';
                } else if($animal->animal_type == 2){
                    $animal_type = 'বিড়াল';
                } else if($animal->animal_type == 3){
                    $animal_type = 'হাতি';
                } else if($animal->animal_type == 4){
                    $animal_type = 'ঘোড়া';
                } else if($animal->animal_type == 5){
                    $animal_type = 'হরিণ';
                } else if($animal->animal_type == 6){
                    $animal_type = 'খরগোস';
                } else if($animal->animal_type == 7){
                    $animal_type = 'বাঘ';
                } else if($animal->animal_type == 8){
                    $animal_type = 'সিংহ';
                }

            @endphp

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">প্রাণীর নাম</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->animal_name_bn }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">পোষা প্রাণীর ধরণ</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal_type }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">প্রাণীর বয়স</td>

                <td>
                    <font style="font-size:16px; ">: {{ BanglaConverter::bn_number($animal->animal_age) }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">প্রাণীর জাত</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $animal->animal_type_bn }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">প্রাণীর গায়ের রঙ</td>

                <td>
                    <font style="font-size:16px; ">: {{ $animal->animal_color_bn }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">প্রাণী পালনের তারিখ</td>

                <td>
                    <font style="font-size:16px;  ">: {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($animal->animal_keeping_date))) }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">জলাতংকের টিকা দানের তারিখ</td>

                <td colspan="3">
                    <font style="font-size:16px; ">: {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($animal->jolatongko_date))) }} </font>
                </td>
            </tr>

            <tr>
                <td></td>
                <td colspan="3">

                @php
                    $total = 0;
                @endphp

                    <table style="width: 70%; border: 1px solid black;border-collapse: collapse;">
                        <tr>
                            <th style="border: 1px solid black;padding-left:10px;">আদায়ের বিবরণ</th>

                            <th style="border: 1px solid black;">টাকা</th>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">পোষা প্রাণীর লাইসেন্স/নবায়ন ফি</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $mfee = isset($animal->fee_list[91]) ? $animal->fee_list[91]['amount'] : 0; $total += $mfee; echo BanglaConverter::bn_number($mfee); @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">ভ্যাট(১৫%)</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $vfee = isset($animal->fee_list[25]) ? floor($animal->fee_list[25]['amount']) : 0; $total += $vfee; echo BanglaConverter::bn_number($vfee); @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">উৎসেকর</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srcfee = isset($animal->fee_list[97]) ? $animal->fee_list[97]['amount'] : 0; $total += $srcfee; echo BanglaConverter::bn_number($srcfee); @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">বকেয়া</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $dfee = isset($animal->fee_list[23]) ? $animal->fee_list[23]['amount'] : 0; $total += $dfee; echo BanglaConverter::bn_number($dfee); @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">সারচার্জ</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $srfee = isset($animal->fee_list[22]) ? $animal->fee_list[22]['amount'] : 0; $total += $srfee; echo BanglaConverter::bn_number($srfee); @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;padding-left:10px;">ছাড়</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">@php $disfee = isset($animal->fee_list[24]) ? $animal->fee_list[24]['amount'] : 0; $total -= $disfee; echo '(-)'.BanglaConverter::bn_number($disfee); @endphp</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black;text-align:center;">মোট</td>

                            <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{ BanglaConverter::bn_number($total) }}</td>
                        </tr>

                    </table>
                </td>
            </tr>

            <br/>

            <tr height="50px">
                <td  colspan="4" style="font-size:16px; vertical-align:top;padding-left:55px; ">
                    <p>
                        স্থানীয় সরকার (পৌরসভা) আইন, ২০০৯ এর ৯৮-১০৫ ধারা ৩য় তফসিল এর ৮, ১০, ১৯ ও ২২ আইটেম অনুসারে (ট্রড, প্রফেশন, কলিং ও বিজ্ঞাপন) ব্যবসা/পেশার অনুমোদন পত্র বর্ণিত ব্যক্তি/প্রতিষ্ঠানের অনুকূলে দেওয়া হইল। যাহার  মেয়াদ &nbsp;&nbsp; {{BanglaConverter::bn_others(date('d-m-Y', strtotime($animal->expire_date)))}} পর্যন্ত বলবৎ থাকিবে।
                    </p>
                </td>
            </tr>

            <tr>

        </table>

    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                @if ($print_setting->sochib)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;</font> <br> &nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                @endif

                @if ($print_setting->member)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;</font> <br> &nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                @endif

                @if ($print_setting->chairman)
                <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 100px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;</font> <br> &nbsp;&nbsp;&nbsp;&nbsp;মেয়র&nbsp;&nbsp;&nbsp;&nbsp;
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

                    $url = $url.'/verify/animal_bn/'.$animal->sonod_no.'/'.$animal->union_id.'/'.$animal->type;

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
