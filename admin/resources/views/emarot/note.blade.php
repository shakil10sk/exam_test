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

    <table style="border-collapse:collapse;margin:0px auto;margin-top:30px;table-layout:fixed; " width="93%"
           height="70px" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td style=" text-align:left;text-indent: 20px;font-size:17px;text-align: justify;">জনাব {{ $emarot->name_bn
            }} ,
                পিতা/স্বামী-
                {{ $emarot->father_name_bn  }}। {{ $emarot->present_village_bn }},{{
            $emarot->present_upazila_name_bn }}, {{
            $emarot->present_district_name_bn }}। তিনি ভূমি ব্যবহার
                ছাড়পত্র পাওয়ার পর নকশার অনুমোদন চাহিয়া আবেদন করেছেন, যা পত্র নথিতে সংযুক্ত করা হইল। নোট অনুচ্ছেদ ০১ সদয়
                দেখা যেতে পারে। অতঃপর প্লান অনুমোদনের ক্ষেত্রে চাহিত নথি যথাযথভাবে নিম্ন বর্ণনা মতে দাখিল করেছেন। যাহা
                নিম্নরূপঃ-
            </td>
        </tr>

        </tbody>
    </table>

    <table style="table-layout:fixed; border-collapse:collapse;margin:10px auto;" width="70%" height="80px"
           cellspacing="0" cellpadding="0" border="1">
        <tbody>
        <tr>
            <td style="width:75px;padding-left:20px;font-size:16px;font-family:solaimanLipi;">ক্রমিক নং</td>
            <td style="width:265px;padding-left:20px;font-size:16px;font-family:solaimanLipi;">বিবরণ</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">পৃষ্ঠা নং</td>

        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">১</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">নকশা</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">২</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">অঙ্গিকার নামা (নন জুডিসিয়াল
                স্ট্যাম্প)
            </td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">৩</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">সয়েল টেস্ট রিপোর্ট</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">৪</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">নকশার আবেদন ফরম</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">৫</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">নকশা আবেদন ফরম ফি রশিদ</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">৬</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">নকশা অনুমোদন ফি রশিদ</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">৭</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">প্রকৌশলী /স্থাপতির মেম্বারশীপ নম্বরের
                ফটোকপি
            </td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">৮</td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">প্রকৌশলী /স্থাপতির নমুনা স্বাক্ষরসহ
                মেম্বারশীপ নম্বরের ফটোকপি
            </td>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;"></td>
        </tr>


        </tbody>
    </table>

    <table style="border-collapse:collapse;margin:0px auto;margin-top:30px;table-layout:fixed; " width="93%"
           height="30px" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td style=" text-align:left;text-indent: 20px;font-size:17px;text-align: justify;">
                এমতাবস্থাায়, আবেদনকারী দাখিলকৃত নকশায় ভবনের উত্তর পার্শ্বস্ত সীমানা হইতে {{ $emarot->to_north  }} মি:, দক্ষিণ
                পার্শ্বস্থা
                সীমানা হতে {{ $emarot->to_south  }} মি:, পূর্ব পার্শ্বস্থা সীমানা হতে {{ $emarot->to_east  }} মি:
                এবং পশ্চিম পার্শ্বস্থা সীমানা হতে {{ $emarot->to_west  }} মি:
                জায়গা উন্মুক্ত ছাড় দেখানো হয়েছে এবং প্রস্তাবিত নকশাটি ভূমি ব্যবহার ছাড়পত্র অনুযায়ী রাস্তা প্রশস্ত করণের
                লক্ষ্যে {{ $emarot->road_present_condition  }} প্রস্থ রাস্তার সীমানা হতে {{ $emarot->road_consider  }} জায়গা রাস্তার জন্য ছাড় রেখে ইমারত নির্মাণ করতে হবে।। যাহা
                ইমারত নির্মাণ আইন মোতাবেক যথাযথ আছে। আবেদনকারী{{ BanglaConverter::bn_number($emarot->fast_floor)  }} বর্গমিটার (মোট {{ BanglaConverter::bn_number($emarot->total_floor)  }} তলা ={{ BanglaConverter::bn_number($emarot->other_floor)  }}
                বর্গমিটার)
                বিশিষ্ট {{ BanglaConverter::bn_number($emarot->total_floor)  }} তলা আবাসিক দালানের নকশা দাখিল করেছেন এবং
                নির্মাণ ফিস বাবদ {{ BanglaConverter::bn_number($fee_data[95]['amount'] + $fee_data[25]['amount'])  }} টাকা (১৫% ভ্যাটসহ) পৌর
                তহবিলে {{ BanglaConverter::bn_others($emarot->memo_no)  }}
                চালানের মাধ্যমে
                {{ BanglaConverter::bn_others(date('d-m-Y',strtotime($emarot->created_time)))  }}
                খ্রিঃ
                তারিখে বেসিক
                ব্যাংক লিমিটেড সাভার শাখায় জমা দিয়েছেন। গণপ্রজাতন্ত্রী বাংলাদেশ সরকার এর স্থাানীয় সরকার, পল্লী উন্নয়ন ও
                সমবায় মন্ত্রণালয়, স্থাানীয় সরকার বিভাগ, পৌর-১ শাখা কর্তৃক স্মারক নং-৪৬.০০.০০০০.০৬৩.০৯.০০১.১৪
                (অংশ-২)-৮৬১, তাং-২২.৬.২০১৭ খ্রিঃ জারীকৃত ইমারত স্থাাপনার নকশা অনুমোদন এবং ভবনের গুনগতমান নিশ্চিতকরণের
                লক্ষ্যে ১১ সদস্য বিশিষ্ট কমিটি গঠন করা হয়েছে। কমিটির .................... তারিখের সভায় নকশাটি যাচাই
                বাছাই ও অনুমোদনের মতামতের জন্য উপস্থাাপন করা হইল।
            </td>

        </tr>
        </tbody>
    </table>


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

                    $url = $url . '/verify/emarot/' . $emarot->sonod_no . '/' . $emarot->union_id . '/' . $emarot->type;

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
