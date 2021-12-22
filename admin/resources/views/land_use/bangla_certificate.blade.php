<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>ভূমি ব্যবহার ছাড়পত্রের অনুমতি সনদ</title>

    {{-- @include('layouts.pdf_sub_layouts.certificate_style_header_bn') --}}
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


        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>ভূমি ব্যবহার ছাড়পত্রের অনুমতি সনদ</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">ছাড়পত্রের নং :</td>
                            @php

                            $sonod = str_split($certificate_data->sonod_no);

                            for($i=0; $i<strlen($certificate_data->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($certificate_data->photo != '' )
                        <img src="{{ asset('images/application/'.$certificate_data->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>
        </table>

            <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

                <tr>
                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">আবেদনকারীর নাম </font>
                    </td>

                    <td colspan="3">
                        <font style="font-size:16px;">:  {{ $certificate_data->name_bn }}</font>
                    </td>
                </tr>

                <tr>
                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">পিতার নাম </td>

                    <td>
                        <font style="font-size:16px; ">: {{ $certificate_data->father_name_bn }} </font>
                    </td>

                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">মাতার নাম</td>

                    <td>
                        <font style="font-size:16px;  ">: {{ $certificate_data->mother_name_bn }} </font>
                    </td>
                </tr>

                <tr>
                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;">জাতীয় পরিচয় পত্র</td>

                    <td>
                        <font style="font-size:16px; ">: {{ BanglaConverter::bn_number($certificate_data->nid) }} </font>
                    </td>

                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">জন্ম নিবন্ধন নং</td>

                    <td>
                        <font style="font-size:16px;  ">: {{ BanglaConverter::bn_number($certificate_data->birth_id) }} </font>
                    </td>
                </tr>

                <tr>
                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px ">মোবাইল</td>

                    <td>
                        <font style="font-size:16px; ">: {{ BanglaConverter::bn_number($certificate_data->mobile) }} </font>
                    </td>

                    <td align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px">ইমেইল</td>

                    <td>
                        <font style="font-size:16px;  ">: {{ $certificate_data->email }} </font>
                    </td>
                </tr>








                <tr>
                    <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

                    <td style=" vertical-align:top;">
                        <p style="line-height:25px;font-size:16px; ">

                            : গ্রামঃ {{ $certificate_data->present_village_bn }}
                            <br> &nbsp; ডাকঘরঃ {{ $certificate_data->present_postoffice_name_bn }}
                            <br> &nbsp; উপজেলাঃ {{ $certificate_data->present_upazila_name_bn }}
                            <br> &nbsp; জেলাঃ {{ $certificate_data->present_district_name_bn}}</p>
                    </td>

                    <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; padding-left: 50px;vertical-align:top; ">স্থায়ী ঠিকানা</td>

                    <td style="vertical-align:top;">
                        <p style="line-height:25px;font-size:16px; ">

                            : গ্রামঃ {{ $certificate_data->permanent_village_bn }}
                            <br> &nbsp; ডাকঘরঃ {{ $certificate_data->permanent_postoffice_name_bn }}
                            <br> &nbsp; উপজেলাঃ {{ $certificate_data->permanent_upazila_name_bn }}
                            <br> &nbsp; জেলাঃ {{ $certificate_data->permanent_district_name_bn}}</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="height: 15px;"></td>
                </tr>



                <tr>
                    <td colspan="4" style="height: 7px;"></td>
                </tr>



                <tr>

            </table>

            <table width="88%" height="100px"   cellpadding="0" cellspacing="0" border="1" style="
            border-collapse:collapse;margin:0px auto; font-size: 13px ">
                <tr>

                    <td style="text-align: center;  padding-left:10px;font-size:15px;font-family:solaimanLipi;">মৌজার
                        নাম</td>
                    <td style="text-align: center; padding-left:10px;font-size:15px;font-family:solaimanLipi;">খতিয়ান
                        নং</td>
                    <td style="text-align: center; padding-left:10px;font-size:15px;font-family:solaimanLipi;">দাগ
                        নং</td>
                    <td style="text-align: center; padding-left:10px;font-size:15px;font-family:solaimanLipi;">জমির
                        ধরণ</td>
                    <td style="text-align: center; padding-left:10px;font-size:15px;font-family:solaimanLipi;">জমির
                        পরিমাণ</td>
                </tr>
                <tr>
                    <td style="padding-left:10px;font-size:15px;font-family:solaimanLipi;">{{ $certificate_data->mojar_name  }}</td>
                    <td style="padding-left:20px;font-size:15px;font-family:solaimanLipi;text-align:justify">
                        সি.এস- {{ $certificate_data->khotian_no_cs  }}</br>
                        এস এ- {{ $certificate_data->khotian_no_sa }}</br>
                        আর এস- {{ $certificate_data->khotian_no_rs }}</br>
                    </td>
                    <td style="padding-left:20px;font-size:15px;font-family:solaimanLipi;">
                        সি.এস- {{ $certificate_data->dag_no_cs }} </br>
                        এস এ- {{ $certificate_data->dag_no_sa }}</br>
                        আর এস- {{ $certificate_data->dag_no_rs }}</br>
                    </td>
                    <td style="padding-left:10px;font-size:15px;font-family:solaimanLipi;"> {{
                        $certificate_data->land_type }}</td>
                    <td style="padding-left:10px;font-size:15px;font-family:solaimanLipi;">
                        {{  $certificate_data->land_amount }}</td>
                </tr>

            </table>

            <table width="88%" height="50px"  cellpadding="0" cellspacing="0" border="0px" style="table-layout:fixed;
            border-collapse:collapse;margin:0px auto;">
                <tr>
                    <td style="padding-left:20px;font-size:15px;font-family:solaimanLipi;text-indent:20px">উপরোক্ত
                        তথ্যাদির আলোকে নিম্ন বর্ণিত শর্তসাপেক্ষে আবেদনকারী/আবেদনকারীগণের আবেদনের বিবেচনায় নিম্ন
                        বর্ণিত শর্তাধিনে {{ $certificate_data->plot_proposed_use }} ভবনের জন্য ভূমি ব্যবহার ছাড়পত্রের
                        অনুমতি
                        প্রদান করা হলো।</td>
                </tr>


            </table>
            <table width="92%" height="10px" cellpadding="0" cellspacing="0" border="0px" style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;text-align:justify" >
                <tr valign='bottom'>
                    <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"><span
                            style="font-weight:bold;">শর্তসমূহঃ-</span>
                        <span style="font-weight:bold;">১। </span>এই ভূমি ব্যবহার ছাড়পত্র প্রদানের তারিখ হতে ২৪ (চব্বিশ) মাস সময়কাল পর্যন্ত কার্যকর থাকবে।
                        <span style="font-weight:bold;">২। </span>এই ভূমি ব্যবহার ছাড়পত্র উন্নয়ন বা নির্মাণ কাজের ক্ষেত্রে কোনরূপ বৈধ ক্ষমতা প্রদান করে না, এবং কোন নির্মাণ কার্যক্রম   শুরু করিবার জন্য কোনরূপ অধিকার প্রদান করে না।
                        <span style="font-weight:bold;">৩। </span>ভূমিতে স্থাপন ও পরিচালনার ক্ষেত্রে পরিবেশ সংরক্ষণ আইন ও বিধি যথাযথভাবে অনুসরণ করতে হবে।
                        <span style="font-weight:bold;">৪। </span> উপযুক্ত অগ্নি নির্বাপক ব্যবস্থা রাখতে হবে এবং অগ্নিকান্ড কিংবা অন্য কোন দুর্ঘটনার সময় জরুরি নির্গমন ব্যবস্থা থাকতে হবে।
                        <span style="font-weight:bold;">৫। </span> কর্তৃপক্ষ যে কোন সময় যথাযথ কারণ উল্লেখ্য পূর্বক এই ভূমি ব্যবহার ছাড়পত্র বাতিল বা এর কার্যকারিতা স্থগিত করিতে  পারিবে।
                        <span style="font-weight:bold;">৬। </span> কোন তথ্য গোপন করিলে বা ভুল তথ্য প্রদন করিলে প্রদানকৃত ছাড়পত্র বাতিল বলিয়া গণ্য হইবে।
                        <span style="font-weight:bold;">৭। </span>এই ভূমি ব্যবহার ছাড়পত্র জমির মালিকানা স্বত্ব নির্ধারণ করে না।
                        <span style="font-weight:bold;">৮। </span>ভূমি ব্যবহারে দেশের প্রচলিত সকল বিধি বিধান যথাযথভাবে অনুসরণ করতে হবে।
                        <span style="font-weight:bold;">৯। </span>ইমারত নির্মাণ বিধিমালা ১৯৯৬” অনুযায়ী নকশা দাখিল
                        করতে হবে।<span style="font-weight:bold;">@if($certificate_data->road_consider!='')১০।
                        </span> {{  $certificate_data->road_consider  }} @endif
                    </td>
                </tr>
            </table>

            <table width="92%" height="10px" cellpadding="0" cellspacing="0" border="0px" style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;">
                <tr valign='bottom'>
                    <td>

                    </td>
                </tr>
            </table>



    <div style="position: fixed; bottom: 5px; top: 10px;">
        <table border='0' width="92%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto; padding-top:40px;">
        <tr>
                @if ($print_setting->sochib)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;</font>
                    {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp; --}}
                </td>
                @endif

                @if ($print_setting->member)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;</font>
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
                    <b> স্মারক নং-সাপৌস/প্রকৌঃ/{{ BanglaConverter::bn_number($certificate_data->fiscal_year_name )  }}/{{
                    BanglaConverter::bn_number($certificate_data->sonod_no )  }} </b>
                    <br />
                    অনুলিপি জ্ঞাতার্থে ও কার্যার্থেঃ
                    <br />

                    ১)সহকারী কমিশনার (ভূমি), {{ $union->bn_name }}, {{ $union->union_upazila_name_bn }}, {{
                    $union->union_district_name_bn }} ।
                    <br />
                    ২) সংশ্লিষ্ট ওয়ার্ড কাউন্সিলর, {{ $union->bn_name }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }} ।
                    <br/>
                    ৩) অফিস কপি।
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url.'/verify/landuse_bn/'.$certificate_data->sonod_no.'/'.$certificate_data->union_id.'/'.$certificate_data->type;
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
