<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>ইমারত সনদ অনুমোদন পত্র</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn')

</head>

<body>

<div class="page-border">
    @if(! $print_setting->pad_print )
        @include('layouts.pdf_sub_layouts.certificate_header_bn')
    @else

        <table>
            <tr>
                <td style="height: 130px"></td>
            </tr>
        </table>

    @endif


    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
           cellpadding="0" cellspacing="0">

        <tr>
            <td colspan="2" style="text-align:center;font-size:13px;font-weight:bold;padding-bottom: 5px">
                <font style="">
                    <u>ইমারত নির্মাণ অনুমোদন পত্র</u>
                </font>
            </td>
        </tr>

        <tr>

            <td>

                <table border="1" style="width: 95%;border-color:lightgray;border-collapse:collapse;" cellpadding="0"
                       cellspacing="0">
                    <tr>
                        <td style="width:100px; text-align:center;font-weight:700;font-size:11px;">
                            অনুমতি নং :
                        </td>
                        @php

                            $sonod = str_split($emarot->sonod_no);

                            for($i=0; $i<strlen($emarot->sonod_no); $i++):

                        @endphp

                        <td style="text-align:center; font-weight:bold; font-size:13px"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                        @php
                            endfor;
                        @endphp
                    </tr>
                </table>
            </td>


            <td rowspan="2" valign="top" style="text-align: left;">
                @if($emarot->photo != '' )
                    <img src="{{ asset('images/application/'.$emarot->photo) }}" height="80px" width="80px" style=""
                         alt="profile"/>
                @endif
            </td>

        </tr>

    </table>
    <table style="margin:5px auto;">
        <tbody>
        <tr>
            <td>ইমারত নির্মাণ/সীমানা দেয়াল/বিবিধ নির্মাণ/পূণঃ নির্মাণ এবং পুকুর খনন/ভরাট/পাহাড় কর্তণ এর অনুমোদন পত্র ।
            </td>
        </tr>
        </tbody>
    </table>

    <table style="border-collapse:collapse;margin:0px auto;margin-top:8px; margin-bottom: 8px " width="93%"
           height="20px;"
           cellspacing="0"
           cellpadding="0" border="1">
        <tbody>
        <tr>
            <td style="width:160px;font-size:100%; text-align:center; font-weight:normal;">স্মারক নং :</td>

            <td style="text-align:center; font-weight:bold; font-size:11px;">সাপৌস/প্রকৌঃ/{{ BanglaConverter::bn_others
            ($emarot->fiscal_year_name)  }} / {{ BanglaConverter::bn_others
            ($emarot->sonod_no)  }}</td>

        </tr>
        </tbody>
    </table>

    <table style=" margin-top: 8px; border-collapse:collapse;margin:0px auto;table-layout:fixed; " width="93%"
           height="40px"
           cellspacing="0" cellpadding="0" border="1">
        <tbody>
        <tr>
            <td style="width:150px; text-align:left;text-indent: 20px;font-size:11px;">আবেদনকারীর নাম</td>
            <td style="width:75%;font-weight:bold; font-size:11px; text-align:left;">:&nbsp; {{ $emarot->name_bn  }}
            </td>

        </tr>
        <tr>
            <td style="width:150px;text-align:left;text-indent: 20px;font-size:11px;">পিতা/ স্বামীর নাম</td>
            <td style="width:75%;font-weight:bold; font-size:11px; text-align:left;">
                :&nbsp; {{ $emarot->father_name_bn  }}
            </td>
        </tr>

        <tr>
            <td style="width:150px;text-align:left;text-indent: 20px; font-size:11px;">বর্তমান ঠিকানা</td>
            <td style="width:75%; font-size:11px; text-align:left;">:&nbsp;{{ $emarot->present_village_bn }},{{
            $emarot->present_upazila_name_bn }}, {{
            $emarot->present_district_name_bn }}
            </td>
        </tr>
        <tr>
            <td style="width:150px;text-align:left;text-indent: 20px; font-size:11px;">স্থায়ী ঠিকানা</td>
            <td style="width:75%;font-size:11px; text-align:left;">:&nbsp;{{ $emarot->permanent_district_name_bn }},{{
            $emarot->permanent_upazila_name_bn }}, {{
            $emarot->present_district_name_bn }}
            </td>

        </tr>
        <!--	<tr>
                <td style="text-align:left;text-indent: 20px; font-size:17px;">ফি (১৫% ভ্যাট সহ)</td>
                <td  style="font-size:13px; text-align:left;" colspan="3">:&nbsp;১৮৭৬৮.০০ টাকা।</td>

            </tr>-->


        </tbody>
    </table>


    <table style="table-layout:fixed; border-collapse:collapse;margin:8px auto;" width="97%" height="50px"
           cellspacing="0" cellpadding="0" border="0px">

        <tbody>
        <tr>
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;text-align: justify;">আপনার
                {{ BanglaConverter::bn_others(date('d-m-Y',strtotime($emarot->created_time)))  }} খ্রিঃ তারিখের
                স্মারকের/আবেদনের পরিপ্রেক্ষিতে আপনার/আপনাদের মালিকানা ভূক্ত/দখলাধীন সাভার পৌরসভার ওয়ার্ড নং -<span
                    style="font-weight:bold;"> {{ BanglaConverter::bn_number($emarot->emarot_word_no) }} , </span> মৌজা -<span
                    style="font-weight:bold;"> {{ $emarot->mojar_name }},
                </span>
                খতিয়ান
                নং-সি.এস- <span style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->khotian_no_cs) }}, </span> এস.এ-
                <span style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->khotian_no_sa) }}, </span>
                আর.এস- <span style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->khotian_no_rs) }}</span>। দাগ
                নং-সি.এস- <span
                    style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->dag_no_cs) }}, </span> এস.এ- <span
                    style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->dag_no_sa) }}, </span> আর. এস-
                <span style="font-weight:bold;">{{ BanglaConverter::bn_number($emarot->dag_no_rs) }}, </span> মোট জমির পরিমাণ
                <span
                    style="font-weight:bold;">{{ BanglaConverter::bn_number($emarot->land_amount) }}</span> শতাংশ, মহল্লা- <span
                    style="font-weight:bold;">{{ $emarot->area_name }}। </span> ভিত্তিমূল <span
                    style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->fast_floor) }} </span>
                বর্গমিটার (মোট <span style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->total_floor) }}</span> তলা =
                <span style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->other_floor) }}</span>
                বর্গমিটার) পরিমিত পাকা <span
                    style="font-weight:bold;">{{ BanglaConverter::bn_others($emarot->total_floor) }}</span> তলা <span
                    style="font-weight:bold;"> @if($emarot->build_type == 1 ) "আবাসিক" @elseif($emarot->build_type ==
                     2) বাণিজ্যিক @elseif($emarot->build_type == 3) আবাসিক কাম-বাণিজ্যিক @elseif($emarot->build_type
                     == 4) শিল্প কারখানা @elseif($emarot->build_type == 5)  মসজিদ  @endif  </span> ভবন নির্মাণের
                জন্য দাখিলকৃত
                প্ল্যান স্থানীয় সরকার
                (পৌরসভা)
                আইন ২০০৯ এর ধারা ৫০ (গ) এবং ২য় তফসীলের ৩৫, ৩৬, ৩৭ উপধারা মোতাবেক নিন্মোক্ত পরিবর্তন/সংশোধন ও শর্ত মতে
                প্রস্তাবিত <span style="font-weight:bold;">{{ $emarot->emarot_construction_destroy_purpose }} </span>
                কার্যের জন্য অনুমোদন প্রদান করা হলো।
            </td>
        </tr>


        </tbody>
    </table>

    <table style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;text-align: justify;" width="97%"
           height="auto" cellspacing="0" cellpadding="0" border="0px">
        <tbody>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span style="font-weight:bold;
">পরিবর্তণ/সংশোধনঃ-</span>
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span style="font-weight:bold;">..
                    .......................................................................................................................................................................................</span>
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span style="font-weight:bold;">..
                    .......................................................................................................................................................................................</span>
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span style="font-weight:bold;">..
                    ...........................খ্রি:তারিখের বি.সি কমিটির সিদ্ধান্তের আলোকে নিম্ন লিখিত শর্ত মোতাবেক নকশাটি অনুমোদন দেয়া হলো।</span>
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১। </span> প্লিন্থ পর্যন্ত কাজ সমাপ্ত হওয়ার পর সুপার ভিশন ইঞ্জিনিয়ার ও
                মালিকের যৌথ স্বাক্ষরে পৌরসভায় প্রতিবেদন দাখিল করতে হবে। অতপর প্রতিটি ফ্লোর ঢালাই সমাপ্ত হওয়ার পর যথারীতি
                পৌরসভায় প্রতিবেদন দাখিল করতে হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">২। </span> নির্মাণ/খননের জন্য প্রদত্ত অত্র অনুমোদন পত্র কোন ক্রমেই অনুমোদন
                প্রাপ্ত ব্যক্তিকে/ব্যক্তিবর্গকে/ প্রতিষ্ঠানকে যে জমিতে নির্মাণ খনন এর জন্য অনুমতি চাওয়া হয়েছে সেই জমিতে
                কোন আইনগত অধিকার, দখল বা মালিকানা দান করে না। আরো প্রকাশ থাকে যে, এই অনুমতি পত্র দিয়ে কাঠামো সম্পর্কীয়
                অথবা নির্মাণ প্রকৌশলী সংক্রান্ত বিশদ বিবরণের কোন মঞ্জরী বুঝায় না।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৩।  </span>যদি নকশায় বর্ণিত জমির দখলীয় স্বত্ব নিয়ে কোন বিবাদীকে অথবা অত্র
                পত্রে উল্লেখিত শর্ত সমূহ ভঙ্গ করা হয় অথবা দরখাস্তকারী/দরখাস্তকারিনীর/দরখাস্তকারীদের প্রদত্ত বিবরণ সমূহ
                অসত্য হয় অথবা কোন প্রয়োজনীয় তথ্যাদি গোপন রাখা হয়, অথবা যে উদ্দেশ্যে নকশায় অনুমতি দেয়া হয়েছে সেই
                উদ্দেশ্যে ভিন্ন অন্য উদ্দেশ্যে ব্যবহার করা হয়, তবে ১৯৫২ সালের ইমারত নির্মাণ আইনের ৯ নং ধারা মতে প্রদত্ত
                অনুমোদন বাতিল বলে গণ্য হবে।
            </td>
        </tr>

        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৪।  </span>বর্তমান অনুমোদন লাভের তারিখ হতে ২ (দুই) বৎসর পর্যন্ত বলবৎ
                থাকবে। ইতিমধ্যে নির্মাণ/খনন কার্য সম্পূর্ণ না হলে এই সময়কাল অতিক্রান্ত হওয়ার পর যথোপযুক্ত ফিস আদায়
                পূর্বক নতুন দরখাস্ত পেশ করে পূনঃ অনুমোদন গ্রহণ করতে হবে। তবে ইমারত নির্মাণের ক্ষেত্রে যদি অনুমোদিত নকশার
                কোনরূপ পরিবর্তণ না ঘটিয়ে ভিত্তিমূলক সমতার উপর আরো ৪ ফুট/১.২২ মিটার পর্যন্ত ইমারত নির্মাণ কার্য সম্পন্ন
                হয়ে থাকে, তা হলে অনুমতি পত্রের প্রয়োজন হবে না।
            </td>
        </tr>

        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৫।  </span>আরো প্রকাশ থাকে যে, এই অনুমোদন সরকারী, আধাসরকারী ও বেসরকারী কোন
                প্রতিষ্ঠান কর্তৃক হুকুম দখলের বেলায় প্রযোজ্য নহে। সরকার যে সময় এই সম্পত্তি হুকুম দখল করে নিয়ে যেতে পারেন
                এতে প্রচলিত আইন অনুযায়ী কোন বাঁধা থাকবে না।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৬।  </span>এলাকা নকশায় রাস্তাঘাট পয়ঃপ্রণালী ইত্যাদীর জন্য চিহ্নিত স্থান
                উন্মুক্ত রাখতে হবে এবং ইহা জনস্বার্থে বিনা ক্ষতিপূরণে পৌরসভা বরাবরে ছেড়ে দিতে হবে। নির্মাণ কাজের ভিত্তি
                পৌরসভার রাস্তা অথবা জনসাধারণের চলাচলের রাস্তা হতে কমপক্ষে ১.৫০ মিটার অথবা নূন্যতম ৫'-০'' ফুট দূরে করতে
                হবে। এলাকা উন্নয়নের জন্য অন্যান্য সরকারী সংস্থার আইন মোতাবেক ভূমি অথবা এলাকা উন্নয়ন কর দিতে হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৭।  </span>প্রতিবেশী চলাচলের পথ বন্ধ করা যাবে না, পৌরসভার রাস্তায় আসবার
                জন্য প্রয়োজনীয় স্থান রাখতে হবে, প্রতিবেশীর আলো বাতাস চলাচলের প্রতিবন্ধকতা সৃষ্টি অথবা পরিবেশ দূষিত করা
                চলবে না। বিশেষ করে নির্মাণ সামগ্রী দিয়ে রাস্তায় চলাচলে বাধার সৃষ্টি করা যাবে না। নির্মাণ কাজে সকল প্রকার
                নিরাপত্তাজনিত বিধি অনুযায়ী করতে হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৮।  </span>পৌর নাগরিকদের সুবিধার্থে, রাস্তাঘাট পয়ঃ প্রণালী ইত্যাদির কাজে
                বিনা ক্ষতিপূরণে ন্যায় ভিত্তিক প্রয়োজনীয় ভূমি পৌরসভাকে প্রদানে বাধ্য থাকবেন। পরিকল্পিত/সরকারী আবাসিক
                এলাকার জন্য এই আইন প্রযোজ্য হবে না।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">৯।  </span>ইমারত নির্মাণ সমাপনের ত্রিশ দিনের মধ্যে সংশ্লিষ্ট বিধিমতে
                মালিককে সমাপনের প্রতিবেদন পৌরসভায় দাখিল করে ব্যবহার সনদপত্র গ্রহণ করতে হবে।
            </td>
        </tr>

        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১০।  </span>ভবন নির্মাণে ইমারত নির্মাণ আইন ১৯৫২,Bangladesh National
                Building Code-1993 ইমারত নির্মাণ বিধিমালা ১৯৯৬ ও স্থানীয় সরকার আইন (পৌরসভা) ২০০৯ সহ অন্যান্য প্রচলিত
                বিধিমালা যথাযথভাবে অনুসরণ করতে হবে।
            </td>
        </tr>

        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১১।  </span>ভবনের উত্তর পার্শ্বস্ত সীমানা হইতে <span
                    style="font-weight:bold;">{{ $emarot->to_north  }}</span> মি:, দক্ষিণ পার্শ্বস্থ সীমানা হতে <span
                    style="font-weight:bold;">{{ $emarot->to_south  }}</span> মি:, পূর্ব পার্শ্বস্থ সীমানা হতে <span
                    style="font-weight:bold;">{{ $emarot->to_east  }}</span> মি: এবং পশ্চিম পার্শ্বস্থ সীমানা হতে <span
                    style="font-weight:bold;">{{ $emarot->to_west  }}</span> মি: জায়গা খালি রেখে
                @if(!empty($emrot->road_present_condition) || !empty($emrot->road_consider)  )
                    এবং প্রস্তাবিত নকশাটি  ভূমি ব্যবহার ছাড়পত্র অনুযায়ী রাস্তা প্রশস্ত করণের লক্ষ্যে <span
                        style="font-weight:bold;">{{ BanglaConverter::bn_others( $emarot->road_present_condition)  }}</span>  প্রস্থ রাস্তার সীমানা হতে <span
                        style="font-weight:bold;
                        ">{{ BanglaConverter::bn_others($emrot->road_consider) }}</span> জায়গা রাস্তার জন্য ছাড় রেখে
                @endif
                ইমারত নির্মাণ করতে হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১২।  </span>শুধুমাত্র Lay out Plan এর অনুমোদন দেওয়া হলো। কাঠামোগত সকল
                ত্রূটি বিচ্যুতি ভবন মালিকের উপর বর্তাবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১৩।  </span>সেপটিক ট্যাংক/সোক্ওয়েল হতে ড্রেণে কোন রকম সংযোগ দেওয়া যাবে না।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১৪।  </span>পৌর প্রকৌশলী অথবা তাঁর প্রতিনিধির উপস্থিতিতে ভবনের লে-আউট
                গ্রহণ করতে হবে। অন্যথা ভবিষ্যৎ সেটব্যাক সংক্রান্ত অভিযোগের জন্য ভবন কর্তৃপক্ষকে দায়ী করা হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১৫।  </span>দাখিলকৃত Soil Test Report মোতাবেক Existing Ground Level (EGL)
                হতে .............থেকে .............নিচে Foundation স্থাপন করতে হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১৬।  </span>প্রতি ৫ বৎসর অন্তর পৌরসভা হতে Occupancy Certificate/ বসবাস
                সনদপত্র গ্রহণ করতে হবে।
            </td>
        </tr>
        <tr valign="bottom">
            <td style="padding-left:20px;font-size:11px;font-family:solaimanLipi;"><span
                    style="font-weight:bold;">১৭।  </span>বাড়ীর আঙ্গিনায় বা সেটব্যাক এরিয়ায় বৃক্ষরোপন করতে হবে।
                এক্ষেত্রে আকর্ষণীয় বাগান তৈরী করা হলে পৌরসভার পক্ষ থেকে হোল্ডিং ট্যাক্স 10% মওকুফসহ অন্যান্য প্রণোদনা
                প্রদান করা হবে।
            </td>
        </tr>

        <!--<tr valign='bottom'> -->
        <!--	<td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"><span style="font-weight:bold;">১৮।  </span>-->
        <!--                          সড়ক ও জনপথ বিভাগ রাস্তা সম্প্রসারণ বা অন্য কোন সরকারী কাজের প্রয়োজনে অধিকতর জায়গার প্রয়োজনীয়তা মনে করলে ২য় পক্ষ সরকারী বিধিমতে স্থাপনা অপসারণ করে দিতে বাধ্য থাকবেন।-->

        <!--	</td>-->
        <!--</tr>-->

        </tbody>
    </table>


    <div style="position: fixed; bottom: 5px;">
        <table border='0' width="99%" cellspacing="0" cellpadding="0"
               style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
            <tr>
                @if ($print_setting->sochib)
                    <td style="padding-left:100px;font-size:11px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>সহকারী করনির্ধারক/করনির্ধারক</font>
                    </td>
                @endif

                @if ($print_setting->member)
                    <td style="padding-left:100px;font-size:11px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>মেম্বার স্বাক্ষর</font>
                    </td>
                @endif

                @if ($print_setting->chairman)
                    <td style="padding-left:{{$colspan>2? 100 : 250}}px; font-size:11px; height: 50px; vertical-align: bottom;">
                        <font style='border-top: 1px solid black;'>মেয়র</font>
                    </td>
                @endif
            </tr>

            <tr>
                <td style="padding-left:20px;font-size:11px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                    <b>নির্দেশাবলীঃ </b>
                    <br/>


                    ১) প্রধান নির্বাহী কর্মকর্তা,{{ $union->bn_name }}, {{
                    $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}
                    <br/>২)  কাউন্সিলর,..........নং ওয়ার্ড  {{ $union->bn_name }}, {{
                    $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others
                    ($union->postal_code) }}
                    <br/>
                    ৩) কর সংগ্রাহক/কোষাধ্যক্ষ/করনির্ধারক,{{ $union->bn_name }}, {{
                    $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others
                    ($union->postal_code) }}
                    <br/>
                    ৪) নির্মাণ ফাইল।
                </td>
                <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                    <?php

                    $url = $url . '/verify/prottyon_bn/' . $emarot->sonod_no . '/' . $emarot->union_id . '/' . $emarot->type;

                    ?>
                    <img height="100"
                         src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                         width="120">
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
