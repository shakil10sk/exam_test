<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা প্রিমিসেস লাইসেন্স সনদপত্র</title>

    @include('layouts.pdf_sub_layouts.certificate_style_header_bn')

</head>

<body>

    <div class="page-border">
        {{-- <img src="{{ public_path('assets/images/border3.png') }}"> --}}


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
                    <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                        <font style="">
                            <u>প্রিমিসেস লাইসেন্স</u>
                        </font>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>ইস্যু তারিখঃ {{ BanglaConverter::bn_number(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trade['organization']['generate_date'])->format('d-m-Y')) }}</td>
                                <td style="text-align: right;padding-right: 5px;">মেয়াদ উত্তীর্ণঃ {{BanglaConverter::bn_number( Carbon\Carbon::parse($trade['organization']['expire_date'])->format('d-m-Y')) }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>

                    <td >

                        <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                                @php

                                    $sonod = str_split($trade['organization']['sonod_no']);

                                    for($i=0; $i<strlen($trade['organization']['sonod_no']); $i++):

                                    @endphp

                                    <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo BanglaConverter::bn_number($sonod[$i]); ?></td>

                                    @php
                                        endfor;
                                    @endphp
                            </tr>
                        </table>
                    </td>

                </tr>

            </table>


        <div style="width:95%;" >
            <div style=" float: left; width: 80%"  >
                <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                    <tr>
                        <td style="width:150px; text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                    </tr>
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসার ধরণ</td>
                        <td style="font-size:16px;text-align:left;">:&nbsp;{{ $trade['organization']['business_type_bn'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ BanglaConverter::bn_number($trade['organization']['mobile']) }}</td>
                    </tr>
                    {{-- <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">ই-মেইল</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
                    </tr> --}}
                </table>
            </div>
            <div style="float: right; width: 50%; margin-right: -40%; margin-top: 10px ; "  >
                @foreach($trade['organization']['owner_list'] as $owner)

                    @if(!empty($owner['photo']))
                        <img src="{{ asset('images/application/'. $owner['photo']) }}" height="200px"
                             width="200px" />
                    @endif

                @endforeach
            </div>
        </div>

            <table width="88%" cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px" >

                    <tr style="text-align: center;font-weight:bolder;">
                        <th>নং</th>
                        <td style="font-weight: 700px; font-size: 17px;">মালিকের  নাম</td>
                        <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
                        <th style="font-weight: 700px; font-size: 17px;">পরিচয় পত্র/ জন্ম নিবন্ধন</th>
                        @if ((count($trade['organization']['owner_list']) ?? []) < 2)
                        {{-- <th style="font-weight: 700px; font-size: 17px;">মোবাইল</th> --}}
                        @endif
                    </tr>

                    @php
                        $i = 1;
                    @endphp

                    @foreach($trade['organization']['owner_list'] as $owner)


                    <tr height="20px" style="text-align: center;">
                        <td>{{ BanglaConverter::bn_number($i++) }}</td>
                        <td>{{  $owner['name_bn'] }}</td>

                        <td>

                        @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                            {{ $owner['husband_name_bn'] }}
                        @else
                            {{ $owner['father_name_bn'] }}
                        @endif


                    </td>
                    <td>

                        @if ($owner['nid'] > 0)
                              {{ BanglaConverter::bn_number($owner['nid']) }}
                        @else
                             {{ BanglaConverter::bn_number($owner['birth_id']) }}
                        @endif


                    </td>

                    @if ((count($trade['organization']['owner_list']) ?? []) < 2)
                        <td>{{ BanglaConverter::bn_number($owner['mobile']) }}</td>
                    @endif

                    </tr>
                    <tr height='25px' >
                        <td colspan="4">

                            <p style="font-size:15px;">ঠিকানা
                            :&nbsp;গ্রাম/মহল্লা-{{ $owner['permanent_village_bn'] }}
                            রোড/ব্লক/সেক্টর-{{ $owner['permanent_rbs_bn'] }}&nbsp;
                            ওয়ার্ড নং-{{ BanglaConverter::bn_number($owner['permanent_ward_no']) }}
                            &nbsp; {{ $owner['permanent_postoffice_name_bn'] }}
                            &nbsp;{{ $owner['permanent_upazila_name_bn'] }}
                           &nbsp; {{ $owner['permanent_district_name_bn'] }}
                            </p>

                        </td>
                    </tr>
                    @endforeach

            </table>


                <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

                    <tr>
                        <td align='left'  style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
                        <td valign='top' style="font-weight:bold; font-size:16px; text-align:left;"> :&nbsp;
                            গ্রাম/মহল্লা-{{ $trade['organization']['trade_village_bn'] }}
                            রোড/ব্লক/সেক্টর-{{ $owner['permanent_rbs_bn'] }}&nbsp;
                            ওয়ার্ড নং-{{ BanglaConverter::bn_number($trade['organization']['trade_ward_no']) }}
                            &nbsp;{{ $trade['organization']['trade_postoffice_name_bn'] }}
                            &nbsp;{{ $trade['organization']['trade_upazila_name_bn'] }}
                            &nbsp;{{ $trade['organization']['trade_district_name_bn'] }}
                        </td>
                    </tr>

                </table>

        <table class="jolchap" align="center" border="1" height="415px" width='40%' cellspacing="0" cellspacing='0'
               style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">
            <tr>
                <td align="center" ><b>আদায়ের বিবরণ</b></td>
                <td align="center"> <b>টাকা</b> </td>
            </tr>

            {{ $due = 0, $discount = 0, $signbord_vat = 0, $source_vat = 0,  $sarcharge = 0 }}
            <tr>
                <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">লাইসেন্স ফি(বার্ষিক)</td>
                <td style="text-align:center;font-size:16px;width: 200px;">&nbsp;

                    <?php echo (isset($trade['fee_data'][90])) ? BanglaConverter::bn_number
                    ($trade['fee_data'][90]['amount']) : ''; $fee = $trade['fee_data'][90]['amount']  ?>
                    &nbsp;টাকা
                </td>

            </tr>

            @if((isset($trade['fee_data'][23])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">বকেয়া </td>
                    <td style="text-align:left;font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][23])) ? BanglaConverter::bn_number($trade['fee_data'][23]['amount']) : ''; $due = $trade['fee_data'][23]['amount']  ?>&nbsp;টাকা

                    </td>

                </tr>

            @endif

            @if((isset($trade['fee_data'][24])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ছাড় </td>
                    <td style="text-align:center;font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][24])) ? BanglaConverter::bn_number($trade['fee_data'][24]['amount']) : ''; $discount = $trade['fee_data'][24]['amount']  ?>&nbsp;টাকা

                    </td>

                </tr>

            @endif


            <tr>
                <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">১৫ % ভ্যাট বাবদ জমা</td>
                <td style="text-align:center; font-size:16px;">&nbsp;

                    <?php echo (isset($trade['fee_data'][25])) ? BanglaConverter::bn_number($trade['fee_data'][25]['amount']) : ''; $vat = $trade['fee_data'][25]['amount']  ?>&nbsp;টাকা

                </td>
            </tr>


            @if((isset($trade['fee_data'][21])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সাইনবোর্ড কর(বার্ষিক) </td>

                    <td style="text-align:center;font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][21])) ? BanglaConverter::bn_number($trade['fee_data'][21]['amount']) : ''; $signbord_vat = $trade['fee_data'][21]['amount']  ?>&nbsp;টাকা

                    </td>

                </tr>

            @endif




            @if((isset($trade['fee_data'][97])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">উৎসে কর</td>
                    <td style="text-align:center; font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][97])) ? BanglaConverter::bn_number($trade['fee_data'][97]['amount']) : ''; $source_vat = $trade['fee_data'][97]['amount']  ?>&nbsp;টাকা

                    </td>

                </tr>

            @endif


            @if((isset($trade['fee_data'][22])))

                <tr>
                    <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সার চার্জ</td>
                    <td style="text-align:center; font-size:16px;">&nbsp;

                        <?php echo (isset($trade['fee_data'][22])) ? BanglaConverter::bn_number($trade['fee_data'][22]['amount']) : ''; $sarcharge = $trade['fee_data'][22]['amount']  ?>&nbsp;টাকা

                    </td>

                </tr>

            @endif

            <tr>
                <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সর্বমোট</td>
                <td  style="text-align:center; font-size:16px;">&nbsp;

                    <?php  $total = (int)(($fee+$due+$vat+$signbord_vat+$source_vat+$sarcharge)
                        -$discount); echo  BanglaConverter::bn_number(number_format($total,2)); ?>&nbsp;টাকা{{-- টাকা
                                কথায়ঃ {{Converter::bn_word(99) }} টাকা মাত্র--}}
                </td>

            </tr>


        </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                    <tr>


                        <td style="font-size:17px;  padding-left:50px;" height="80">নিরাপদ খাদ্য আইন, ২০১৩ ও পৌরসভা আদর্শ কর তফসিল, ২০১৪ এর অনুচ্ছেদ ১৮ অনুযায়ী উৎপাদন/পাইকারী ও খুচরা ব্যবসা পরিচালনার জন্য অথবা হোটেল-রেষ্টুরেন্ট/সুইট মিট/বেকারী/ফুডগ্রেন/মুদি ও অন্যান্য খাদ্য প্রতিষ্ঠান পরিচালনার উদ্দেশ্য দোকান/ভবন/গুদাম ব্যবহার করার লাইসেন্স দেওয়া হলো।</td>

                    </tr>

                </table>


                <div style="position: fixed; bottom: 0px; padding-top: 100px; ">
                    <table width="95%" cellpadding="0" cellspacing="0" border="0"
                           style="border-collapse:collapse;margin-left: 50px; margin-top:30px;">
                        <tr>
                            <td style="padding-left:10px;font-size:16px;">
                                <div style="float:left;">
                                    {{-- <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>সীল
                                    </font> --}}
                                </div>
                            </td>
                            <td style="padding-left:200px;font-size:16px;">
                                <div style="float:center;">
                                    <font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>প্রস্তুতকারী/ যাচাইকারী
                                    </font>
                                </div>
                            </td>
                            <td>
                                <div style="display:inline;float:left">
                                    <font style='float:left;right:20px;position:relative;border-top: 1px solid black;'>
                                        &nbsp;&nbsp; &nbsp;&nbsp; মেয়র &nbsp;&nbsp;&nbsp;&nbsp;</font>
                                </div>
                            </td>
                        </tr>


                    </table>
                </div>

            <div style="position: fixed; bottom: 5px; margin-top:50px;" >

                <br>
                <table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin-top:60px; ">

                    <tr>
                        <td colspan="{{$colspan}}" style="padding-left:20px;font-size:16px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; vertical-align: bottom;">
                            <b style="border-bottom:1px solid black">নির্দেশানাবলীঃ </b>
                            <br/>


                            ১) সার্টিফিকেট টি ১৭ ডিজিটের সনদ নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন অথবা আপনার Android Mobile থেকে QR code টি Scan করুন।
                            <br />২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
                            <br />৩) নবায়নের সময় পুরাতন লাইসেন্সটি সঙ্গে নিয়ে আসুন।
                            <br />৪) প্রয়োজনীয় তথ্য জানার জন্য {{ $union->bn_name  }}   যোগাযোগ করূন ।
                        </td>
                        <td rowspan="1" style="border-left:1px solid black; border-top:1px solid black;">

                        <?php

                        $url = $url.'/verify/premises_bn/'.$trade['organization']['sonod_no'].'/'.$trade['organization']['union_id'].'/'.$trade['organization']['fiscal_year_id'];

                        ?>

                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">

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

    </div>

    {{-- secound page --}}

    <div class="page-border">
        {{-- <img src="{{ public_path('assets/images/border3.png') }}"> --}}

        <table id="certificate_header" border="0px" width="88%" align="center" style="border-collapse:collapse;">
                <tr>
                    <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" />
                    <br>

                    <h4>ক্রমিক নং-</h4>
                    </td>

                    <td style="text-align:center;">
                        <font style="font-size:18px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                        <br />

                        <font style="font-size:14px; font-weight:bold;">
                            {{-- {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}<br> --}}

                           <h4> ফরম-ডি [রোল ১১(৩) দ্রষ্টব্য]</h4>
                            <h4>লাইসেন্স/ লাইসেন্সের নবায়ন ফরম</h4>
                            <h4>(নিবন্ধী করণের জন্য)</h4>
                            <h4>(এই লাইসেন্স হস্তান্তর যোগ্য নয়)</h4>
                            <h4>(ফিস ফেরৎ যোগ্য নয়)</h4>
                            {{-- {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br> --}}
                            {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br> --}}
                            {{-- ই-মেইলঃ dhamraimunicipality@gmail.com <br>

                            @if (env('APP_TYPE') == 'single')
                                ওয়েব সাইট : dhamraimunicipality.gov.bd
                            @else
                                ওয়েব সাইট : {{ $url }}
                            @endif --}}

                        </font>

                    </td>

                    <td style="width:1.2in; text-align:left;">

                        {{-- <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="100px" width="100px" style="position:relative;right:10px;" /> --}}
                        <br>
                        <h3>প্রিমিসেস লাইসেন্স</h3>
                        <br>
                        <h4> লাইসেন্স নং ..........</h4>
                        <br>
                        <h4> তারিখ:- ...............</h4>

                    </td>

                </tr>
            </table>


            <table width="85%" align="center" style="border-collapse:collapse;font-size:13px;">
                <tr>
                    <td style="text-align:left; ">
                        <p>উৎপাদন পাইকারি ও খুচরা ব্যবসা পরিচালনার জন্য ...................................................................................................... অথবা</p>
                        <br>

                        <p>হোটেল/রেস্টুরেন্ট/অন্যান্য খাদ্য প্রতিষ্ঠান পরিচালনার উদ্দেশ্যে দোকান/ভবন/ গুদাম ব্যবহার করার লাইসেন্স,লাদেশ বিশুদ্ধ খাদ্য অধ্যাদেশ ১৯৫৯
                            ও বাংলাদেশ বিশুদ্ধ খাদ্য (সংশোধিত) আইন ২০০৫ এর ২১ ধারার অনুযায়ী<br>
                            <br>
                            জনাব..........................................................................................
                            পিতাঃ....................................................................
                            <br> ঠিকানা.....................................................................................................................
                            ................................................কে ১লা জুলাই ২০২১ তারিখ হইতে ৩০ জুন ২০২২ তারিখ পর্যন্ত ১০০০ বর্গফুট ০১ নং প্রিমিসেস এর অংশ বিশেষ
                            বিধিমালায় উল্লেখিত বিধি-বিধান এবং নিম্নলিখিত শর্ত সাপেক্ষে এতদ্বারা লাইসেন্স প্রদান করা হইল অতএব লাইসেন্স নবায়ন করা হইল।</p>
                            <br>

                            <p>(১) কেবল উপরে উল্লেখিত ভবন স্থানের জন্য এই লাইসেন্স কার্যকর হইবে অর্থাৎ উল্লেখিত সংখ্যক কামরা গুদাম অথবা জায়গার জন্যে যা হয় লাইসেন্স নবায়ন
                                করা হয়েছে দাড়ি যদি কোন ব্যক্তি উল্লেখিত কারণে লাইসেন্স মেয়াদকালে মধ্যে যেকোনো সময় অতিরিক্ত কামরা গুদাম স্থান ব্যবহার করতে ইচ্ছে করেন
                                তবে তাকে সে জন্য স্থানীয় কর্তৃপক্ষের অনুমতি গ্রহণ করিতে হইবে।</p><br>

                           <p> (২) লাইসেন্স প্রাপ্তি ব্যক্তি যদি লাইসেন্স এর মেয়াদকাল এর মধ্যে গুদাম স্থান দখল ছাড়িয়ে দেন তবে তাহাকে লিখিতভাবে সঙ্গে সঙ্গেই লাইসেন্স প্রদানকারী
                            কর্তৃপক্ষকে তাহার ইচ্ছার কথা জানাতে হইবে।</p><br>

                            <p>(৩) টিন লাইসেন্স ধারী ব্যক্তি এমন কোন ব্যাক্তিকে নিয়োগ করিবেন না কিংবা এমন কোন ব্যাক্তিকে নিরাপদে অনুমতি দিবেন না যে কোন রোগ ছোঁয়াচে ও সংক্রমণ
                                রোগের ভুগিতেছে অথবা কোন যন্ত্রণাদায়ক ব্যথায় আক্রান্ত অথবা এমন কোন ব্যক্তি যে অতি সম্প্রতি এমন ধরণের রোগির পরিচর্যা করিয়েছে লাইসেন্সধারী এমন
                                ধরনের কোনো ব্যক্তিকে লাইসেন্সপ্রাপ্ত স্থানের প্রবেশ করিতে অথবা অবস্থান করে দিবেন না।</p><br>

                            <p>(৪) লাইসেন্সধারী সমস্ত পাত্র অপসারণ পাত্র তৈরি পত্র এবং অন্যান্য জিনিসপত্র পরিষ্কার-পরিচ্ছন্ন অবস্থায় রাখবেন এবং সমস্ত ব্যবহার্য জিনিসপত্র ধুলাবালি ও মাছের
                                হাত হইতে রক্ষা করবেন।</p><br>

                            <p>(৫) লাইসেন্সধারী ব্যক্তিদের মেজে লাইসেন্সপ্রাপ্ত স্থানের নর্দমা এবং প্রতিটি বাস কাউন্টার টেবিল তার অন্যান্য স্থান যেখানে মালামাল উৎপাদন অথবা প্রস্তুত কাজের
                                সঙ্গে জড়িত তা সম্পূর্ণরূপে ও পরিচ্ছন্ন রাখবেন</p><br>

                            <p>(৬) লাইসেন্সধারী ব্যক্তি লাইসেন্সপ্রাপ্ত স্থানের দেয়াল অন্তত বছরে দুইবার চুনকাম করাইবেন এবং পরিদর্শন কর্তৃপক্ষের নির্দেশে ও প্রয়োজনবোধে আরো ঘন ঘন চুনকাম করাইবেন।</p><br>

                            <p>(৭) লাইসেন্স প্রাপ্ত স্থানের স্বাস্থ্যসম্মত হেফাজতের বিডি সংক্রান্ত পরিদর্শন কর্তৃপক্ষের নির্দেশনাবলী লাইসেন্সধারী মানিয়া চলবেন।</p><br>

                            <p>(৮) খাদ্য উৎপাদন অথবা খাদ্য ব্যবসার জন্য বিশেষভাবে নির্ধারিত ঘরের কোন কামরায় অথবা ওই ঘরের কোন অংশকে লাইসেন্সধারী ব্যক্তি কোন ব্যক্তির বাসগৃহ অথবা স্বয়ং কক্ষ হিসেবে
                                ব্যবহার করে দিবেন না এরূপ কোন ঘর অথবা ইহার অংশ হিসেবে প্রাপ্ত লাইসেন্সকৃত ব্যক্তি কোন ব্যক্তিকে বিছানাপত্র মাটি-মাখা কাপড়চোপড় অথবা অন্য কোন রূপ আপত্তিজনক
                                অস্বাস্থ্যকর জিনিসপত্র রাখিতে দিবেন না।</p><br>

                            <p>(৯) লাইসেন্স প্রাপ্ত ব্যক্তি পরিদর্শন কর্তৃপক্ষ কর্তৃক অনুমোদিত পানি ছাড়া অন্য কোন খাদ্য উৎপাদন অথবা খাদ্য প্রস্তুতিতে ব্যবহার করবে না অথবা করে দিবেন না।</p><br>

                            <p>(১০) লাইসেন্স প্রাপ্ত ব্যক্তির ব্যবসা প্রাঙ্গন বাই স্থাপনার নির্মিত অংশের ব্যাপারে নিম্নলিখিত শর্ত পূরণ করবে- <br>
                                (ক) কংক্রিট অথবা অন্য কোন বোনাস উৎপাদনে তৈরীর মেশিন ও পানি নিষ্কাশন ব্যবস্থা সম্পন্ন হতে হবে এবং ড্রেনে নর্দমাতে সিপি ব্যবস্থা থাকবে পরিচ্ছন্ন ও উত্তম মেরামতের ব্যবস্থা সম্বলিত হইবে<br>
                                (খ) ঘরের দেওয়াল ও ছাদের উপরিভাগ মত যোগ্য হালকা রঙের পরিচ্ছন্ন ও উত্তমরূপে মেরামত করা হইবে<br>
                                (গ) দরজা ও জানালা এমন ব্যবস্থা করিতে হইবে যাতে কোন প্রকার মাসি প্রবেশ না করে এবং বাতাস প্রবলভাবে প্রবেশ না করে<br>
                                (ঘ) কাজের জায়গা গুলোতে প্রচুর আলোর ব্যবস্থা থাকিতে হইবে<br>
                                (উ) অবকাঠামো ও যন্ত্রপাতির উপর সঞ্চিত ধোয়া এবং আপত্তিকর গন্ধ না হয় সে জন্য প্রচুর বায়ু চলাচলের ব্যবস্থা থাকিতে হইবে<br>
                                (চ)  কীটপতঙ্গ ও ইঁদুর ইত্যাদি দ্বারা খাদ্যবস্তু দূষিত না হয় সে জন্য কার্যকর ব্যবস্থা গ্রহণ করিতে হইবে<br>
                                (ছ) টয়লেট শৌচাগার যেখানে হোক না কেন তা চিহ্নিত করতে হবে এবং দরজা স্বতন্ত্র হইতে হবে এবং খাদ্য সামগ্রী গুদামজাত নড়াচড়া করা হয় এমন কামড়াব শহীদ ইহার গণসংযোগ থাকবে না<br>
                                (জ) পানি সরবরাহ ব্যবস্থা আওতাধীন প্রচুর নিরাপদ ও স্বাস্থ্যসম্মত হইবে<br>
                                (ঝ) পানি সাবান ও পরিচ্ছন্ন তোয়ালে দ্বারা হাত ধোয়ার সুবিধা থাকতে হবে<br>
                                (ট) খাদ্য উৎপাদনের জন্য ভিতর আগুন জ্বালালে যাহাতে ধোয়া সহজে ঘর হোটেল-রেস্টুরেন্ট মিষ্টির দোকানে বাহিরে চলিয়া যায় সে জন্য উপযুক্ত ধোঁয়া বহির্গমন পথ থাকিতে হইবে</p><br>

                            <p>(১১) লাইসেন্স প্রাপ্ত ব্যক্তি তাহার ব্যবসায় কেন্দ্রে কালি পড়ে থাকার জায়গা এবং বিভাগের চতুর্থ স্থান সবসময় পরিষ্কার পরিচ্ছন্ন ও স্বাস্থ্যসম্মত অবস্থায় রাখবেন এবং পড়ে থাকা জায়গায় কোন ঘরবাড়ি
                                উঠিয়ে দিবেন এবং কোনরুপ পায়খানা গোয়ালঘর আস্তাবল অথবা অন্যকোন অস্বাস্থ্যকর বস্তু রাখতে বা অস্বাস্থ্যকর পরিবেশ সৃষ্টি করে দিবেন না যাহা পরিদর্শন কর্তৃপক্ষ অনভিপ্রেত বলিয়া মনে করেন</p>
                                {{-- <br> --}}
                    </td>
                </tr>

                <br>
                {{-- <br> --}}

                <tr>
                    <td style="text-align:right;">

                            <h4 style="">মেয়র
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </h4>
                            <p>{{ $union->bn_name }}, ঢাকা</p>

                    </td>
                </tr>
            </table>









    </div>

    </body>
</html>

