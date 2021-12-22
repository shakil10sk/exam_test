<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা অনাপত্তি পত্র</title>

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
                        <u>অনাপত্তি পত্র</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($onapotti->sonod_no);

                            for($i=0; $i<strlen($onapotti->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;">
                            {{ BanglaConverter::bn_number($sonod[$i]) }}</td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >


                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>
            </tr>
        </table>


    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">নাম </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $onapotti->name_bn }}</font>
            </td>
        </tr>



        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">পিতার নাম </td>
            <td>
                <font style="font-size:16px; ">: {{ $onapotti->father_name_bn }} </font>
            </td>
        </tr>



        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : গ্রামঃ {{ $onapotti->present_village_bn }}
                    &nbsp; ডাকঘরঃ {{ $onapotti->present_postoffice_name_bn }}
                    &nbsp; উপজেলাঃ {{ $onapotti->present_upazila_name_bn }}
                    &nbsp; জেলাঃ {{ $onapotti->present_district_name_bn}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">স্থায়ী ঠিকানা </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : গ্রামঃ {{ $onapotti->permanent_village_bn }}
                    &nbsp; ডাকঘরঃ {{ $onapotti->permanent_postoffice_name_bn }}
                    &nbsp; উপজেলাঃ {{ $onapotti->permanent_upazila_name_bn }}
                    &nbsp; জেলাঃ {{ $onapotti->permanent_district_name_bn }}
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ওয়ার্ড নং </td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->permanent_ward_no) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ব্যবসা প্রতিষ্ঠানের নাম </td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->organization_name_bn) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">কারখানার অবস্থান</td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->organization_location_bn) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ব্যবসার ধরণ</td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->organization_type_bn) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ট্রেড লাইসেন্স নং</td>
            <td>
                <font style="font-size:16px;  ">:  {{ BanglaConverter::bn_number($onapotti->trade_license_no) }}</font>
            </td>
        </tr>



        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">তারিখ </td>
            <td>
                <font style="font-size:16px;">: <?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($onapotti->generate_date))); ?></font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ব্যবহত জমির বিবরণ </td>
            <td>
                <table border='1' cellpadding='0' cellspacing='0' width='98%'>
                    <tr>
                        <td>মৌজা</td>
                        <td>থানা</td>
                        <td>জেলা</td>
                        <td>খতিয়ান নং</td>
                        <td>দাগ নং</td>
                        <td>জমির ধরণ</td>
                        <td>জমির পরিমাণ</td>
                    </tr>
                    <tr>
                        <td>{{ $onapotti->moja }}</td>
                        <td>{{ $onapotti->thana }}</td>
                        <td>{{ $onapotti->district }}</td>
                        <td>{{ $onapotti->khotian_no }}</td>
                        <td>{{ $onapotti->dag_no }}</td>
                        <td>{{ $onapotti->land_type }}</td>
                        <td>{{ $onapotti->land_amount }}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp;  উপরোক্ত তথ্য ও নিম্নোক্ত শর্তাবলী অনুসারে উক্ত প্রতিষ্ঠানের কার্যক্রম পরিচালনার জন্য অনাপত্তি পত্র প্রদান করা হল।</td>

        </tr>

        <tr>
        	<td style="padding-left:72px; font-size:17px; height: 20px">আমি তাহার সর্বাঙ্গীণ মঙ্গল ও উন্নতি কামনা করি।</td>
        </tr>

    </table>
    <table border="0px" height="20px" width='99%' style="border-collapse:collapse; margin:5px auto;" cellspacing="0" cellpadding="0" >

        <tr height="20px" valign="top">

            <td  style="font-size:12px; text-align:center;">[বিঃ দ্রঃ- তথ্য গোপন / অনিয়ম করিয়া এই সনদ গ্রহণ করিলে তাহা বাতিল বলিয়া গণ্য হইবে এবং এর দায় দায়িত্ব সনদ গ্রহণকারীর উপর বর্তাইবে।]</td>

        </tr>
    </table>




    <div style="position: fixed; bottom: 5px;">
    <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
    <tr>
                @if ($print_setting->sochib)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;</font>
                @endif

                @if ($print_setting->member)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;প্রস্তুতকারী&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
                @endif

                @if ($print_setting->chairman)
                <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:15px; height: 100px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;মেয়র&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
                @endif
            </tr>

        <tr>
            <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                <b >নির্দেশাবলীঃ </b>
                <br />


                ১)কোন অবৈধ কর্মকান্ড দ্বারা কোনভাবেই পরিবেশ দূষণ করা জাবেনা<br />২)সকল বর্জ্য পরিকল্পিত উপায়ে সংগ্রহ করে অপসারনের ব্যবস্থা করতে হবে।<br/>৩)নিয়োজিত কর্মরতদের সবাস্থসম্মত পরিবেশ এবং নিরাপত্তা মূলক ব্যবস্থা নিশ্চিত করতে হবে।<br/>৪)পরিবেশগত ছাড়পত্র গ্রহন ব্যতিরেখে উৎপাদন কার্যক্রম পরিচালনা করা যাবে না।<br/>৫)কারখানার পাশে/সামনে সরকারী জায়গা থাকলে অনুমোদিত ভাবে তা ব্যবহার করা যাবেনা।<br/>৬)যথাযত অগ্নি নির্বাপক ব্যবস্থা থাকতে হবে।<br/>৭)কোন প্রকার দূষনের অভিযোগ সৃষ্টি হলে অনাপত্তি পত্র বাতিল বলে গন্য হবে।<br/>
            </td>
            <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

               <?php

                $url = $url.'/verify/onapotti_bn/'.$onapotti->sonod_no.'/'.$onapotti->union_id.'/'.$onapotti->type;

                ?>

               <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="150" width="170">

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

