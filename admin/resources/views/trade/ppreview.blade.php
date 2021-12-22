<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <base href=''/>
    <meta charset="UTF-8">
    <title> ট্রেড লাইসেন্স আবেদন </title>

    <style type="text/css" media="all">
        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            header: page-header;
            footer: page-footer;
            margin: 20px 0px;
            padding: 0px;

        }


        @media print {
            body {
                font-size: 14px !important;
                font-family: 'bangla', sans-serif !important;
            }
        }

    </style>
</head>

<body>
@if (!empty($trade['organization']))

    @if (!$print_setting->pad_print)

        @include('layouts.pdf_sub_layouts.application_header')
    @else
        <table>
            <tr>
                <td style="height: 150px"></td>
            </tr>
        </table>
    @endif
    <!-----------top area end--------------->


    <!-----------heading start--------------->

    <table width="95%" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
        <tr>
            <td style="text-align: center;">
                <h2>
                    <span style="border-bottom: 1px solid; ">ট্রেড লাইসেন্স আবেদন</span>
                </h2>
            </td>
        </tr>
    </table>

    <!-----------heading end--------------->


    <table style="width:95%; margin-left:48px;margin-top:10px;" cellpadding="0" cellspacing="0">

        <tr>

            <td valign="top" style="text-align: center;">

                @foreach ($trade['organization']['owner_list'] as $owner)

                    @if (!empty($owner['photo']))

                        <img src="{{ asset('images/application/' . $owner['photo']) }}" height="80px" width="80px"
                             style=""/>
                    @endif

                @endforeach

            </td>

        </tr>

    </table>

    <!-----------description area start--------------->

    <table width="95%" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">

        <tr>
            <td style="text-indent: 20px;text-align:left; font-size:16px;">ট্র্যাকিং নং</td>
            <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['tracking'] }}</td>
            <td style="">আবেদনের তারিখ</td>
            <td style="">
                :&nbsp;{{ BanglaConverter::bn_number(date('d-m-Y', strtotime($trade['organization']['created_time']))) }}
            </td>
        </tr>

        <tr>
            <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
            <td style="font-size:16px; text-align:left;">
                :&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
            <td style="font-size:16px; text-align:left;">
                :&nbsp;{{ BanglaConverter::bn_number($trade['organization']['mobile']) }}</td>


        </tr>

        <tr>
            <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসার ধরণ</td>
            <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type'] }}</td>
            <td style="text-indent: 20px;text-align:left; font-size:16px;">ই-মেইল</td>
            <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
        </tr>
    </table>

    <!-----------description area end--------------->

    <!-----------owner area start--------------->

    <table width="88%" cellpadding="0" cellspacing="0" border="1"
           style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px">

        <tr style="text-align: center;font-weight:bolder;">
            <th>নং</th>
            <td style="font-weight: 700px; font-size: 17px;">মালিকের নাম</td>
            @if((int) $trade['organization']['owner_type'] != 4)
            <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
            @endif
            <th style="font-weight: 700px; font-size: 17px;"> {{( (int) $trade['organization']['owner_type'] != 4) ? "পরিচয়
                পত্র/ জন্ম নিবন্ধন" : "প্রতিষ্ঠানের আইডি/কোড নং"
            }}
                </th>
            <!--<th style="font-weight: 700px; font-size: 17px;">মোবাইল</th>-->
        </tr>

        @php
            $i = 1;
        @endphp

        @foreach ($trade['organization']['owner_list'] as $owner)


            <tr height="20px" style="text-align: center;">
                <td>{{ BanglaConverter::bn_number($i++) }}</td>
                <td>{{ $owner['name_bn'] }}</td>
                @if((int) $trade['organization']['owner_type'] != 4)
                <td>

                    @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                        {{ (isset($owner['husband_name_bn']))?$owner['husband_name_bn'] : $owner['father_name_bn'] }}
                    @else
                        {{ $owner['father_name_bn'] }}
                    @endif

                </td>
                @endif
                <td>

                    @if ($owner['nid'] > 0)
                        {{ BanglaConverter::bn_number($owner['nid']) }}
                    @else
                        {{ BanglaConverter::bn_number($owner['birth_id']) }}
                    @endif

                </td>

                <td>{{ BanglaConverter::bn_number($owner['mobile']) }}</td>

            </tr>
            @if((int) $trade['organization']['owner_type'] != 4)
            <tr height='25px'>
                <td colspan="4">
                    <p style="font-size:14px;">স্থায়ী ঠিকানা
                        : গ্রাম/মহল্লা : &nbsp;{{ $owner['permanent_village_bn'] }},&nbsp;
                        রোড/ব্লক/সেক্টর : &nbsp;{{ $owner['permanent_rbs_bn'] }}&nbsp;
                        হোল্ডিং নং : {{ BanglaConverter::bn_number($owner['permanent_holding_no']) }}&nbsp;
                        ওয়ার্ড নং : {{ BanglaConverter::bn_number($owner['permanent_ward_no']) }}&nbsp;
                        &nbsp; {{ $owner['permanent_postoffice_name'] }}
                        &nbsp; {{ $owner['permanent_upazila_name'] }}
                         &nbsp; {{ $owner['permanent_district_name'] }}
                    </p>
                </td>
            </tr>
            {{-- <tr height='25px'>
                <td colspan="4">
                    <p style="font-size:14px;">বর্তমান ঠিকানা
                        : গ্রাম/মহল্লা : &nbsp;{{ $owner['permanent_village_bn'] }},&nbsp;&nbsp;
                        রোড/ব্লক/সেক্টর : &nbsp;{{ $owner['permanent_rbs_bn'] }}&nbsp;&nbsp;
                        হোল্ডিং নং : {{ BanglaConverter::bn_number($owner['permanent_holding_no']) }}&nbsp;&nbsp;
                        ওয়ার্ড নং : {{ BanglaConverter::bn_number($owner['permanent_ward_no']) }}&nbsp;
                        &nbsp; {{ $owner['permanent_postoffice_name'] }}
                        &nbsp; {{ $owner['permanent_upazila_name'] }}
                         &nbsp; {{ $owner['permanent_district_name'] }}
                    </p>
                </td>
            </tr> --}}
            @endif

        @endforeach

    </table>

    <!-----------owner area end--------------->

    <!-----------address start--------------->

    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0'
           style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

        <tr>
            <td align='left'
                style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ব্যবসা
                প্রতিষ্ঠানের ঠিকানা
            </td>
            <td valign='top' style="font-weight:bold; font-size:16px; text-align:left;"> :
                গ্রাম/মহল্লা:  {{ $trade['organization']['trade_village_bn'] }}
                ,&nbsp;
                হোল্ডিং নং:{{ BanglaConverter::bn_number($trade['organization']['trade_holding_no']) }}
                ,&nbsp;
                ওয়ার্ড নং: {{ BanglaConverter::bn_number($trade['organization']['trade_ward_no']) }}
                ,&nbsp;{{ $trade['organization']['trade_postoffice_name'] }}
                <!--,&nbsp;{{ $trade['organization']['trade_upazila_name'] }}-->
                <!--,&nbsp;{{ $trade['organization']['trade_district_name'] }}-->
            </td>
        </tr>
         <tr>
            <td align='left'
                style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">
            </td>
            <td valign='top' style="font-weight:bold; font-size:16px; text-align:left;">
                &nbsp;&nbsp;{{ $trade['organization']['trade_upazila_name'] }}
                ,&nbsp;{{ $trade['organization']['trade_district_name'] }}
            </td>
        </tr>


    </table>



    {{-- address end --}}

    <table width="95%" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin-left: 50px; margin-top: 80px; ">
        <tr>

            <td style="text-align: right;">
                        <span style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আবেদনকারী স্বাক্ষর
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span>
            </td>
        </tr>
    </table>
    <hr/>
    <table width="95%" cellpadding="0" cellspacing="0" border="0"
        style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
            <tr>
                <td style="text-align: center; font-size: 20px;font-weight: bold;">
                    <span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
                </td>
            </tr>
    </table>





    {{-- instrunction start --}}



    {{-- instruction area end --}}


    {{-- verification area start --}}




    <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 120px; ">
        <tr>
            @if ($union->union_code != 292700)

                <td style="text-align: center;">
                    <div style="border-top: 1px solid;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; কাউন্সিলর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </td>
            @endif

            @if ($print_setting->member)
            <td style="text-align: right;">
                <div style="border-top: 1px solid;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; সচিব  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </td>
            @endif

            @if ($print_setting->chairman)
            <td style="text-align: right;">
                <div style="border-top: 1px solid">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মেয়র  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </td>
            @endif
        </tr>
    </table>

    <table width="97%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin:0px auto;table-layout: fixed; ">
        <tr>
            <td style="padding-left:20px;font-size:10px;">
                 <h2 style="float:center;text-decoration:underline;">নির্দেশনাবলী / Instruction</h2>
                </td>
            <td  style="width: 22%"></td>
        </tr>
        <br>

        <tr>
            <!--<td height="199px" class="instruction" rowspan="2"  style="padding-left:20px;font-size:20px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black; position:relative;top: -17px; height: 200px important;">-->

              <td  style="padding-left:20px;font-size:13px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;">

                @if ($union->union_code == 292700)

                    ১) &nbsp;সদ্য তোলা পাসপোর্ট সাইজের ২ কপি ছবি জমা দিন।  <br/>

                    ২)&nbsp; পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।
                        <br/>
                    ৩)&nbsp; জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন। <br/>

                    ৪) আপনার প্রতিষ্ঠানটি লিমিটেড হলে মেমোরেন্ডাম অব আর্টিক্যালস আবেদন পত্রের সাথে দাখিল করতে হবে। <br/>


                    ৫) কারখানা/সিএনজি স্টেশন/ দাহ্য পদার্থের ব্যবসায়ের ক্ষেত্রে এক্সক্লুসিভ বা বিস্ফোরক অধিদপ্তর/ ফায়ার সার্ভিস ও পরিবেশ অধিদপ্তরের ছাড়পত্র/ অনুমতিপত্র দরখাস্তের সাথে দাখিল করতে হবে। <br/>
                    ৬) &nbsp; আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে।

                @else

                     ১) &nbsp; আবেদন পত্রটি  সংশ্লিষ্ট সাধারণ ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনে কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন। <br/>

                    ২) &nbsp;সদ্য তোলা পাসপোর্ট সাইজের ২ কপি ছবি জমা দিন।  <br/>

                    ৩)&nbsp; পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।
                        <br/>
                    ৪)&nbsp; জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন। <br/>

                    ৫) আপনার প্রতিষ্ঠানটি লিমিটেড হলে মেমোরেন্ডাম  অব আর্টিক্যালস ও ব্যালেন্স শীট আবেদন পত্রের সাথে দাখিল করতে হবে। <br/>

                    ৬) কারখানা/সিএনজি স্টেশন/ দাহ্য পদার্থের ব্যবসায়ের ক্ষেত্রে এক্সক্লুসিভ বা বিস্ফোরক অধিদপ্তর/ ফায়ার সার্ভিস ও পরিবেশ অধিদপ্তরের ছাড়পত্র/ অনুমতিপত্র দরখাস্তের সাথে দাখিল করতে হবে। <br/>

                    ৭) &nbsp; আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে।

                @endif




            </td>

            <td rowspan="2" style="border-left:1px solid black; border-top:1px solid black;position:relative;top:-17px;">
            <?php
                $url = $url . '/verify/trade_application/' . $trade['organization']['tracking']
                    . '/' . $trade['organization']['union_id'] . '/' . $trade['organization']['type'];
            ?>

                <img src="data:image/png;base64, {!! base64_encode(
    QrCode::format('png')->size(200)->generate($url)
) !!} " height="130" width="170"></td>

        </tr>
    </table>


    {{-- verification area end --}}


    <!------------------ footer area start-------------------->

    <table width="95%" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin-left: 50px; margin-top: 5px;">
        <tr>
            <td>
                <p>web:{{ $union->sub_domain }}<br/>
                    E-mail&nbsp;:&nbsp;{{ $union->email }}
                </p>
            </td>
            <td style="text-align: right;">
                <p> Developed by: Innovation IT <br/>
                    www.innovationit.com.bd
                </p>
            </td>
        </tr>
    </table>

    <!------------------ footer area end-------------------->
@else
    <h2 style="text-align: center;color:red">দুঃখিত ! আবেদনটি পাওয়া যায়নি</h2>
@endif

</body>

</html>
