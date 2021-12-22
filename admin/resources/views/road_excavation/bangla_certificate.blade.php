<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>রাস্তা খননের অনুমতির সনদ</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn',['type'=>1])

</head>

<body>
    <div class="page-border">

        @if(! $print_setting->pad_print )
        @include('layouts.pdf_sub_layouts.certificate_header_bn')
        @else

            <table>
                <tr>
                    <td style="height: 120px"></td>
                </tr>
            </table>

        @endif


        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:8px;" cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="2" style="text-align:center;font-size:23px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>রাস্তা খননের অনুমতির সনদ</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 580px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:16px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($data->sonod_no);

                            for($i=0; $i<strlen($data->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:18px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($data->photo != '' )
                        <img src="{{ asset('images/application/'.$data->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>
        </table>

        <table class="jolchap" align="center" border="0" height="200px" width='95%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0px auto;table-layout:fixed; line-height: 1.2;">
            <tr>
                <td align="left" style="font-size:16px;font-color:black; padding-left: 40px">আবেদনকারীর নাম </font>
                </td>

                <td colspan="3">
                    <font style="font-size:16px;">:  {{ $data->name_bn }}</font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px ">পিতার নাম </td>

                <td>
                    <font style="font-size:16px; ">: {{ $data->father_name_bn }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px">মাতার নাম</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $data->mother_name_bn }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">জাতীয় পরিচয় পত্র</td>

                <td>
                    <font style="font-size:16px; ">: {{ BanglaConverter::bn_number($data->nid) }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px">জন্ম নিবন্ধন নং</td>

                <td>
                    <font style="font-size:16px;  ">: {{ BanglaConverter::bn_number($data->birth_id) }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px ">মোবাইল</td>

                <td>
                    <font style="font-size:16px; ">: {{ BanglaConverter::bn_number($data->mobile) }} </font>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px">ইমেইল</td>

                <td>
                    <font style="font-size:16px;  ">: {{ $data->email }} </font>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">
                    হোল্ডিং নং
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->holding_no) }}
                    </span>
                </td>

                <td  align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">
                    রাস্তা কাটা/বোরিং এর পরিমাণ
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->cutting_amount) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">
                    মহল্লা
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $data->moholla_bn }}
                    </span>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">
                    রাস্তার নাম
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->road_name_bn }}
                    </span>
                </td>
            </tr>

            @php
                $road_type = '';

                if($data->road_type == 1){
                    $road_type = 'কাঁচা';
                } else if($data->road_type == 2){
                    $road_type = 'পাকা';
                } else if($data->road_type == 3){
                    $road_type = 'অর্ধ পাকা';
                } else if($data->road_type == 4){
                    $road_type = 'কার্পেটিং';
                } else if($data->road_type == 5){
                    $road_type = 'ডব্লিউ.বি.এম';
                } else if($data->road_type == 6){
                    $road_type = 'এইচ.বি.বি';
                } else if($data->road_type == 7){
                    $road_type = 'সোলিং';
                } else if($data->road_type == 8){
                    $road_type = 'আর.সি.সি';
                }

                $road_cutting_cause = '';

                if($data->cutting_cause == 1){
                    $road_cutting_cause = 'গ্যাস লাইন সংযোগ';
                } else if($data->cutting_cause == 2){
                    $road_cutting_cause = 'পানির লাইন সংযোগ';
                } else if($data->cutting_cause == 3){
                    $road_cutting_cause = 'বিদ্যুৎ লাইন সংযোগ';
                }

            @endphp

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">
                    রাস্তার ধরণ
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $road_type }}
                    </span>
                </td>

                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;">
                    রাস্তা কাটার কারন
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $road_cutting_cause }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;vertical-align:top; ">বর্তমান ঠিকানা </td>

                <td style=" vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : গ্রামঃ {{ $data->present_village_bn }}
                        <br> &nbsp; ডাকঘরঃ {{ $data->present_postoffice_name_bn }}
                        <br> &nbsp; উপজেলাঃ {{ $data->present_upazila_name_bn }}
                        <br> &nbsp; জেলাঃ {{ $data->present_district_name_bn}}</p>
                </td>

                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 40px;vertical-align:top; ">স্থায়ী ঠিকানা</td>

                <td style="vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : গ্রামঃ {{ $data->permanent_village_bn }}
                        <br> &nbsp; ডাকঘরঃ {{ $data->permanent_postoffice_name_bn }}
                        <br> &nbsp; উপজেলাঃ {{ $data->permanent_upazila_name_bn }}
                        <br> &nbsp; জেলাঃ {{ $data->permanent_district_name_bn}}</p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr>
                <td  colspan="4" style="font-size:16px; vertical-align:top;padding-left:30px; ">
                    <p>
                        আপনার ............................. খ্রিঃ তারিখের আবেদনের প্রেক্ষিতে আপনার বাড়ী/প্রতিষ্ঠানে <span style="font-weight: bold;text-decoration: underline;">{{$road_cutting_cause}}</span> প্রদানের জন্য <span style="font-weight: bold;text-decoration: underline;">{{$data->road_name_bn}}</span> রাস্তার <span style="font-weight: bold;text-decoration: underline;">{{$data->cutting_amount}}</span> বর্গফুট পরিমাপের <span style="font-weight: bold;text-decoration: underline;">{{$road_type}}</span> রাস্তা কর্তন করার জন্য নিম্ন লিখিত শর্ত সাপেক্ষে অনুমতি প্রদান করা হল।
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 15px;"></td>
            </tr>

            <tr>
                <td  colspan="4" style="font-size:16px; vertical-align:top;padding-left:30px; ">
                    <p>
                        শর্তসমূহঃ- ১। রাস্তা কাটার সময় টেলিফোন লাইন, বিদ্যুৎ লাইন এবং ড্রেণের ক্ষতি সাধন করা যাবে না। যে কোন ধরণের ক্ষতির জন্য উপযুক্ত ক্ষতিপূরণে বাধ্য থাকবেন। ২। অনুমোদিত পরিমাপের অধিক রাস্তা কাটা হলে ক্ষয়ক্ষতিসহ তার বিল পরিশোধ করতে বাধ্য থাকবেন। ৩। রাস্তা কাটার পর তা পূর্বের অবস্থায় আনতে বাধ্য থাকবেন। ৪। অনুমোদিত পরিমাপের অধিক রাস্তা কাটার প্রয়োজন হলে তাহা কর্তৃপক্ষকে অবহিত ও অতিরিক্ত রাস্তা কাটার ফিস প্রদানপূর্বক রাস্তা কাটা যাবে। কোনক্রমেই স্বেচ্ছায় রাস্তা কাটা যাবে না। ৫। অনুমোদিত রাস্তার প্রকৃতির বাইরে নির্মাণ করা যাবে না। ৬। এ অনুমতি পত্র কেবল মাত্র ০২ (দুই) মাসের জন্য কার্যকর হবে। নির্ধারিত সময় অতিবাহিত হলে পুনরায় অনুমতি পত্র গ্রহণ করতে হবে। ৭। রাস্তা কাটার পর রাস্তা হতে উত্তোলিত নির্মাণ সামগ্রী নিজের দায়িত্বে রাখতে হবে। নির্মাণ সামগ্রী নষ্ট কিংবা হারিয়ে গেলে তার ক্ষতিপূরণ দিতে বাধ্য থাকবে। ৮। এ অনুমতি পত্র দ্বারা দ্বিতীয়বার রাস্তা কাটা যাবে না। ৯। নিজ জায়গায় রাইজার স্থাপন করতে হবে। ১০। রাস্তা কাটার পূর্বে প্রকৌশল বিভাগকে অবহিত করতে হবে।
                    </p>
                </td>
            </tr>

            <tr>

        </table>

    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="92%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
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
                    <b> স্মারক নং-সাপৌস/প্রকৌঃ/ </b>
                    <br />
                    অনুলিপি সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য প্রেরিত হল।
                    <br />

                    ১) প্রধান নির্বাহী কর্মকর্তা, সাভার পৌরসভা, সাভার, ঢাকা।
                    <br />
                    ২) জনাব/জনাবা..........................................
কাউন্সিলর, ..............নং ওয়ার্ড, সাভার পৌরসভা, সাভার, ঢাকা।
                    <br/>
                    ৩) অফিস কপি।
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url.'/verify/roadexcavation_bn/'.$data->sonod_no.'/'.$data->union_id.'/'.$data->type;
// dd($url);
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
