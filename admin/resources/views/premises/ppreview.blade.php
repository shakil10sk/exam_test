<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <base href='' />
    <meta charset="UTF-8">
    <title> প্রিমিসেস লাইসেন্স আবেদন </title>

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
                        <span style="border-bottom: 1px solid; ">প্রিমিসেস লাইসেন্স আবেদন</span>
                    </h2>
                </td>
            </tr>

            <br>

            <tr>
                <td style="text-align: center;">
                    <h5>
                        <p>ফরম গ, বিধি ১১ (১) (২) দ্রষ্টব্য</p><br>
                        <p>স্বাস্থ্য বিভাগ</p><br>
                        <p>(স্বাস্থ্য শাখা)</p><br>
                        <p style="border-bottom: 1px solid black">প্রিমিসেস  রেজিস্ট্রেশন (খাদ্য ) লাইসেন্স  প্রপ্তি বা উহা নবায়ন  আবেদন পত্র </p>
                        <p>[বাংলাদেশ বিশুদ্ধ খাদ্য (সংশোধীত ) আইন ২০০৫ এর ২১(১)(২) ধারা মতে] </p>
                    </h5>
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
                                style="" />
                        @endif

                    @endforeach

                </td>

            </tr>

        </table>

        <!-----------description area start--------------->

        <table width="95%" cellpadding="0" cellspacing="0" border="0"
            style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">

            <tr>
                <td style="width:140px;text-indent: 20px;text-align:left; font-size:16px;">ট্র্যাকিং নং</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['tracking'] }}</td>
                <td style="width:140px;">আবেদনের তারিখ</td>
                <td style="">
                    :&nbsp;{{ BanglaConverter::bn_number(date('d-m-Y', strtotime($trade['organization']['created_time']))) }}
                </td>
            </tr>

            <tr>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                <td style="font-size:16px; text-align:left;">
                    :&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসার ধরণ</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type'] }}</td>
            </tr>

            <tr>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
                <td style="font-size:16px; text-align:left;">
                    :&nbsp;{{ BanglaConverter::bn_number($trade['organization']['mobile']) }}</td>
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
                <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
                <th style="font-weight: 700px; font-size: 17px;">পরিচয় পত্র/ জন্ম নিবন্ধন</th>
                {{-- <th style="font-weight: 700px; font-size: 17px;">মোবাইল</th> --}}
            </tr>

            @php
                $i = 1;
            @endphp

            @foreach ($trade['organization']['owner_list'] as $owner)


                <tr height="20px" style="text-align: center;">
                    <td>{{ BanglaConverter::bn_number($i++) }}</td>
                    <td>{{ $owner['name_bn'] }}</td>

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

                    <td>{{ BanglaConverter::bn_number($owner['mobile']) }}</td>

                </tr>

                <tr height='25px'>
                    <td colspan="4">

                        <p style="font-size:15px;">ঠিকানা
                            : গ্রাম/মহল্লা:&nbsp;{{ $owner['permanent_village_bn'] }}&nbsp;
                            হোল্ডিং নং:&nbsp;{{$owner['permanent_holding_no']}}
                            রোড/ব্লক/সেক্টর :&nbsp;{{ $owner['permanent_rbs_bn'] }}&nbsp;
                            ওয়ার্ড নং:&nbsp;{{ BanglaConverter::bn_number($owner['permanent_ward_no']) }}
                            &nbsp; {{ $owner['permanent_postoffice_name'] }}&nbsp;
                            &nbsp;{{ $owner['permanent_upazila_name'] }}
                            &nbsp; {{ $owner['permanent_district_name'] }}
                        </p>

                    </td>
                </tr>

            @endforeach

        </table>

        <!-----------owner area end--------------->

        <!-----------address start--------------->

        <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0'
            style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

            <tr>
                <td align='left'
                    style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ব্যবসা
                    প্রতিষ্ঠানের ঠিকানা</td>
                <td valign='top' style="font-weight:bold; font-size:16px; text-align:left;"> :
                    গ্রাম/মহল্লা:&nbsp;{{ $trade['organization']['trade_village_bn'] }}&nbsp;
                    হোল্ডিং নং:&nbsp;{{BanglaConverter::bn_number($trade['organization']['trade_holding_no'])}}
                    ওয়ার্ড নং:&nbsp;{{ BanglaConverter::bn_number($trade['organization']['trade_ward_no']) }}
                    &nbsp;{{ $trade['organization']['trade_postoffice_name'] }}
                    &nbsp;{{ $trade['organization']['trade_upazila_name'] }}
                    &nbsp;{{ $trade['organization']['trade_district_name'] }}
                </td>
            </tr>

        </table>

        {{-- address end --}}



        {{-- verification area start --}}
        <table width="95%" cellpadding="0" cellspacing="0" border="0"
               style="border-collapse:collapse;margin-left: 50px; margin-top: 60px; ">
            <tr>

                <td style="text-align: right;">
                                <span style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আবেদনকারী স্বাক্ষর
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                </td>
            </tr>
        </table>

        <hr/>
        <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px;">

            <tr>
                <td style="text-align: center; font-size: 20px;font-weight: bold;">
                    <span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
                </td>
            </tr>

        </table>
        <br>

        <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                <tr>
                    <td  style="text-align: center;">
                        <tr>
                            <td><span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                            </td>
                            <td><span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;সংরক্ষিত  কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                            </td>
                        </tr>
                    </td>


                    @if ($print_setting->member)
                    <td style="text-align: center;">
                        <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span>
                        <br/>
                    </td>
                    @endif

                    @if ($print_setting->chairman)
                    <td style="text-align: center;">
                        <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মেয়র &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </span>
                             <br/>
                    </td>
                    @endif
                </tr>

                <tr style="padding-top:50px;">
                    <td valign="bottom" style="text-align: left; border-bottom: 1px dotted;font-size:13px;height:50px;">
                        <h2>নির্দেশনাবলী / Instruction</h2>
                    </td>
                </tr>

                <tr>
                    <td colspan="{{$colspan+1}}" style="border-bottom:1px solid black;font-size:13px">
                        <ul style="padding-left:50px;list-style:none;">
                                <li>১) &nbsp;আবেদনপত্রটি সংশ্লিষ্ট ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনের কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন। </li>
                                <li>২) &nbsp;সদ্য তোলা পাসপোর্ট সাইজের ২ কপি ছবি জমা দিন।</li>
                                <li>৩)&nbsp; পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।</li>
                                <li>৩)&nbsp; জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন।</li>
                                <li>৫)&nbsp; আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে।</li>
                        </ul>
                    </td>
                    <td rowspan="2" style="border-left:1px solid black; border-top:1px solid black;position:relative;top:-17px;"><?php $url = $url . '/verify/trade_application/' . $trade['organization']['tracking']
                        . '/' . $trade['organization']['union_id'] . '/' . $trade['organization']['type']; ?>
                    <img src="data:image/png;base64, {!! base64_encode(
                        QrCode::format('png')->size(200)->generate($url)
                    ) !!} " height="130" width="170">
                </td>
                </tr>


        </table>



        {{-- verification area end --}}


        <!------------------ footer area start-------------------->

        <table width="95%" cellpadding="0" cellspacing="0" border="0"
            style="border-collapse:collapse;margin-left: 50px; margin-top: 20px;">
            <tr>
                <td>
                    <p>{{ $union->sub_domain . request()->getHost() }}<br />
                        E-mail&nbsp;:&nbsp;{{ $union->email }}
                    </p>
                </td>
                <td style="text-align: right;">
                    <p> Developed by: Innovation IT <br />
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
