<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা প্রত্যয়ন পত্র</title>

    <style type="text/css" media="all">

        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
            width: 595px;
            height: 842px;
            margin: auto;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            header: page-header;
            footer: page-footer;
            margin:20px 0px;
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


        @if (!empty($prottyon))
        <table border="0px" width="110%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;">{{-- <img src="{{ asset('public/assets/images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" /> --}}</td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ converter::en2bn($union->postal_code) }}<br>
                        মোবাইলঃ{{ converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ $url }}</font>

                </td>

                <td style="width:1.2in; text-align:left;">

                    {{-- <img src="{{ asset('public/assets/images/union_profile/'.$union->brand_logo) }}" height="100px" width="100px" style="position:relative;right:10px;" /> --}}

                </td>

            </tr>
        </table>



        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">

            <tr>
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>প্রত্যয়ন পত্র</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>

                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($prottyon->sonod_no);

                            for($i=0; $i<strlen($prottyon->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo converter::en2bn($sonod[$i]); ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>


                <td rowspan="3" valign="top" style="text-align: left;" >
                     @if($prottyon->photo != '' )
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'.$prottyon->photo }}" height="100px" width="100px" style="" alt="profile" />
                    @endif
                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>
            </tr>
        </table>



    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">নাম </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $prottyon->name_bn }}</font>
            </td>
        </tr>

        @if ($prottyon->marital_status == 2 && $prottyon->gender == 2 )

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">স্বামীর নাম</td>
            <td>
                <font style="font-size:16px; ">: {{ $prottyon->husband_name_bn }}</font>
            </td>
        </tr>

        @endif

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">পিতার নাম </td>
            <td>
                <font style="font-size:16px; ">: {{ $prottyon->father_name_bn }} </font>
            </td>
        </tr>

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">মাতার নাম</td>
            <td>
                <font style="font-size:16px;  ">: {{ $prottyon->mother_name_bn }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : গ্রামঃ {{ $prottyon->present_village_bn }}
                    <br> &nbsp; ডাকঘরঃ {{ $prottyon->present_postoffice_name_bn }}
                    <br> &nbsp; উপজেলাঃ {{ $prottyon->present_upazila_name_bn }}
                    <br> &nbsp; জেলাঃ {{ $prottyon->present_district_name_bn}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">স্থায়ী ঠিকানা </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : গ্রামঃ {{ $prottyon->permanent_village_bn }}
                    <br> &nbsp; ডাকঘরঃ {{ $prottyon->permanent_postoffice_name_bn }}
                    <br> &nbsp; উপজেলাঃ {{ $prottyon->permanent_upazila_name_bn }}
                    <br> &nbsp; জেলাঃ {{ $prottyon->permanent_district_name_bn }}
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ওয়ার্ড নং </td>
            <td>
                <font style="font-size:16px;  ">:  {{ converter::en2bn($prottyon->permanent_ward_no) }}</font>
            </td>
        </tr>

        @if($prottyon->nid > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ন্যাশনাল আইডি নং
            </td>
            <td>
                <font style="font-size:16px;">: {{ converter::en2bn($prottyon->nid) }}</font>
            </td>
        </tr>
        @endif

        @if($prottyon->birth_id > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">জন্ম নিবন্ধন নং </td>
            <td>
                <font style="font-size:16px;">:  {{ converter::en2bn($prottyon->birth_id) }}</font>
            </td>
        </tr>
        @endif

        @if($prottyon->passport_no > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট নং </td>
            <td>
                <font style="font-size:16px;">:  {{ converter::en2bn($prottyon->passport_no) }}</font>
            </td>
        </tr>
        @endif

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">তারিখ </td>
            <td>
                <font style="font-size:16px;">: <?php echo converter::en2bn(date('d-m-Y', strtotime($prottyon->generate_date))); ?></font>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp;  অত্র পৌরসভার একজন <font style="font-size:17px;">{{ ($prottyon->resident == 1) ? "অস্থায়ী" : "স্থায়ী" }}
                </font> বাসিন্দা। সে আমার নিকট পরিচিত। তাহার নৈতিক চরিত্র ভাল।
            </td>

        </tr>

        <tr>
            <td style="padding-left:72px; font-size:17px; height: 20px">আমি তাহার সর্বাঙ্গীণ মঙ্গল ও উন্নতি কামনা করি।</td>
        </tr>

    </table>


@else
   <h1 style="text-align:center;color:red;">দুঃখিত ! সনদটি পাওয়া যায়নি</h1>
@endif
</body>

</html>
