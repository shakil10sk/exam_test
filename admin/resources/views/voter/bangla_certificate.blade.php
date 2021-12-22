<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা ভোটার আইডি স্থানান্তর সনদ</title>

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
                        <u>ভোটার আইডি স্থানান্তর সনদ</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($voter->sonod_no);

                            for($i=0; $i<strlen($voter->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($voter->photo != '' )
                        <img src="{{ asset('images/application/'.$voter->photo) }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>
            </tr>
        </table>



        <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">নাম </font>
                </td>
                <td>
                    <font style="font-size:16px;">:  {{ $voter->name_bn }}</font>
                </td>
            </tr>

            @if ($voter->marital_status == 2 && $voter->gender == 2 )

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্বামীর নাম</td>
                <td>
                    <font style="font-size:16px; ">: {{ $voter->husband_name_bn }}</font>
                </td>
            </tr>

            @endif

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">পিতার নাম </td>
                <td>
                    <font style="font-size:16px; ">: {{ $voter->father_name_bn }} </font>
                </td>
            </tr>

            <tr>
                <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">মাতার নাম</td>
                <td>
                    <font style="font-size:16px;  ">: {{ $voter->mother_name_bn }} </font>
                </td>
            </tr>

            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

                <td style=" vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : গ্রামঃ {{ $voter->present_village_bn }}
                        <br> &nbsp; ডাকঘরঃ {{ $voter->present_postoffice_name_bn }}
                        <br> &nbsp; উপজেলাঃ {{ $voter->present_upazila_name_bn }}
                        <br> &nbsp; জেলাঃ {{ $voter->present_district_name_bn}}</p>
                </td>
            </tr><br>

            <tr>
                <td  colspan="2" style="font-size:16px; vertical-align:top;padding-left:55px; "><p style="">তিনি পূর্বে {{ $voter->union_name_bn }} এর {{ $voter->permanent_village_bn }} গ্রামের বাসিন্দা ছিলেন।  তিনি বর্তমানে {{ $union->bn_name }} এর {{ BanglaConverter::bn_number($voter->permanent_ward_no) }} নং ওয়ার্ডে স্থায়ী   ভাবে বসবাস করে আসিতেছেন। তাহার জাতীয় পরিচয়পত্র নং-{{ BanglaConverter::bn_number($voter->nid) }} ।  তাহার জাতীয় পরিচয়পত্র পূর্বে নিম্ন ঠিকানায় ছিল </p></td>

            </tr>

            <tr>
                <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">পূর্বের ঠিকানা</td>

                <td style=" vertical-align:top;">
                    <p style="line-height:25px;font-size:16px; ">

                        : গ্রামঃ {{ $voter->permanent_village_bn }}
                        <br> &nbsp; ডাকঘরঃ {{ $voter->permanent_postoffice_name_bn }}
                        <br> &nbsp; উপজেলাঃ {{ $voter->permanent_upazila_name_bn }}
                        <br> &nbsp; জেলাঃ {{ $voter->permanent_district_name_bn}}</p>
                </td>
            </tr><br>

            <tr height="50px">
               <td  colspan="2" style="font-size:16px; vertical-align:top;padding-left:55px; "><p>যা এখন স্থানান্তর করা করা প্রয়োজন।  সে আইন-শৃঙ্খলা বা রাষ্ট্রবিরোধী কোন কাজ কর্মে জড়িত নহেন। আমার জানামতে তাহার স্বভাব চরিত্র ভাল। উক্ত সনদপত্রটি সংশ্লিষ্ট   {{ BanglaConverter::bn_number($voter->permanent_ward_no) }} নং ওয়ার্ড সদস্য  এর তদন্তের মাধ্যমে ও সুপারিশক্রমে প্রদান করা হলো।</p> </td>

                </tr>

            <tr>

        </table>

        <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

            <tr>
                <td style="padding-left:72px; font-size:17px; height: 20px">আমি তাহার সর্বাঙ্গীণ মঙ্গল ও উন্নতি কামনা করি।</td>
            </tr>

        </table>

        <table border="0" width='99%' style="border-collapse:collapse; margin:5px auto; height: 100px" cellspacing="0" cellpadding="0">

            <tr>

                <td style="font-size:16px; text-indent:70px; width:150px; font-weight:bold; padding-left: 55px; padding-top: 10px; height: 50px;">
                    <span style="">সংযুক্তিঃ</span>
                </td>

                <td  style="font-size:16px;">&nbsp;{{ $voter->comment_bn }}
                </td>
            </tr>


        </table>


    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
        <tr>
                @if ($print_setting->sochib)
                <td style="padding-left:100px;font-size:15px; vertical-align: bottom;">
                    <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
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


                    ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile থেকে QR code টি Scan করুন।
                    <br />২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url.'/verify/voter_bn/'.$voter->sonod_no.'/'.$voter->union_id.'/'.$voter->type;

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
