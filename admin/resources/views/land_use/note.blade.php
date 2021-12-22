<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>ভূমি নোট</title>

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

    <table width="95%" height="50px" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin:0px auto;margin-top:10px;table-layout:fixed; ">
        <tr>
            <td style=" text-align:left;text-indent: 20px;font-size:13px;">সংযুক্ত {{
            $certificate_data->name_bn}}
                পিতা/স্বামী- {{ $certificate_data->father_name_bn }}, {{
                $certificate_data->permanent_village_bn  }}, {{
                $certificate_data->permanent_upazila_name_bn  }},{{ $certificate_data->permanent_district_name_bn  }}
                । তিনি নিম্নলিখিত তফসিলের উপর {{ $certificate_data->plot_proposed_use }} ভবন নির্মাণে ভূমি
                ব্যবহারের ছাড়পত্র চেয়ে
                আবেদন করেছেন, যা পত্র নথিতে সংযুক্তঃ-
            </td>
        </tr>

    </table>

    <table width="95%" height="50px" cellpadding="0" cellspacing="0" border="1" style="
        border-collapse:collapse;margin:5px auto;">
        <tr>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">জেলার নাম</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">থানার নাম</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">মৌজার নাম</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">খতিয়ান নং</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">দাগ নং</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">জমির ধরণ</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">জমির পরিমাণ</td>
        </tr>
        <tr>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">ফেনী</span></td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;"> ফেনী সদর</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;"> {{
            $certificate_data->mojar_name}}</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;text-align:justify">
                সি.এস- {{ $certificate_data->khotian_no_cs}}</br>
                এস এ- {{ $certificate_data->khotian_no_sa}}></br>
                আর এস-{{ $certificate_data->khotian_no_rs }}</br>
            </td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;text-align:justify">
                সি.এস- {{ $certificate_data->dag_no_cs}}</br>
                এস এ- {{ $certificate_data->dag_no_sa}}></br>
                আর এস-{{ $certificate_data->dag_no_rs }}</br>
            </td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;"> {{ $certificate_data->land_type
            }}</td>
            <td style="padding-left:10px;font-size:13px;font-family:solaimanLipi;">{{ $certificate_data->land_amount
            }}</td>
        </tr>

    </table>

    <table width="95%" height="50px" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin:0px auto;margin-top:5px;table-layout:fixed; ">
        <tr>
            <td style=" text-align:left;text-indent: 20px;font-size:13px;text-align: justify;">উক্ত তফসিলভূক্ত জমির উপর
                ভূমি ব্যবহারের ছাড়পত্রের ফি বাবদ আবেদনকারী {{ BanglaConverter::bn_number($fee_data[25]['amount'] +
                $fee_data[25]['amount']  ) }}
                টাকা (১৫% ভ্যাটসহ) চালানের মাধ্যমে বেসিক
                ব্যাংক লিমিটেড সাভার শাখায় জমা দিয়েছেন, যার চালান নং- {{ $certificate_data->memo_no }},
                তারিখ-{{  BanglaConverter::bn_number(date('d-m-Y', strtotime($certificate_data->generate_date))) }}
                খ্রিঃ। ভূমি পরিদর্শণকারী কর্মকর্তা/কর্মচারী এর তদন্ত রিপোর্ট সহ অন্যান্য কাগজ জমা দিয়েছেন। যা পত্র নথিতে
                সংযুক্ত। যার বিবরণ পর্যায়ক্রমে নিচে দেয়া হলোঃ-
            </td>

        </tr>
    </table>

    <table width="70%" height="50px" cellpadding="0" cellspacing="0" border="1px"
           style="table-layout:fixed; border-collapse:collapse;margin:10px auto;">
        <tr>
            <td style="width:75px;padding-left:20px;font-size:14px;font-family:solaimanLipi;">ক্রমিক নং</td>
            <td style="width:265px;padding-left:20px;font-size:14px;font-family:solaimanLipi;">বিবরণ</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">পৃষ্ঠা নং</td>

        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">১</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">পরিদর্শণকারীর মতামত</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">২</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">ভূমি ব্যবহার ফরম ফি এর রশিদ</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৩</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">ভূমি ব্যবহার অনুমোদন ফি এর রশিদ</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৪</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">আবেদন পত্র</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৫</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">দলিলের ফটোকপি</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৬</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">খাজনা রশিদ</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৭</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">ডি.সি.আর.</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৮</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">পর্চা</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">৯</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">নামজারী জমাভাগের প্রস্তাবপত্র</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">১০</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">লোকেশন ম্যাপ ও মৌজা ম্যাপ</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">১১</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">জাতীয় পরিচয় পত্র</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">১২</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;">হোল্ডিং ট্যাক্স রশিদ</td>
            <td style="padding-left:20px;font-size:14px;font-family:solaimanLipi;"></td>
        </tr>

    </table>


    <table style="table-layout:fixed; border-collapse:collapse;margin:10px auto;" width="70%" height="60px"
           cellspacing="0" cellpadding="0" border="1">
        <tbody>
        <tr>
            <td style="width:75px;padding-left:20px;font-size:13px;font-family:solaimanLipi;">ক্রমিক নং</td>
            <td style="width:265px;padding-left:20px;font-size:13px;font-family:solaimanLipi;">বিবরণ</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">পৃষ্ঠা নং</td>

        </tr>
        <tr>
            <td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">১</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">নকশা</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">২</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">অঙ্গিকার নামা (নন জুডিসিয়াল
                স্ট্যাম্প)
            </td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">৩</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">সয়েল টেস্ট রিপোর্ট</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">৪</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">নকশার আবেদন ফরম</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">৫</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">নকশা আবেদন ফরম ফি রশিদ</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">৬</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">নকশা অনুমোদন ফি রশিদ</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">৭</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">প্রকৌশলী /স্থাপতির মেম্বারশীপ নম্বরের
                ফটোকপি
            </td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>
        <tr>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">৮</td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;">প্রকৌশলী /স্থাপতির নমুনা স্বাক্ষরসহ
                মেম্বারশীপ নম্বরের ফটোকপি
            </td>
            <td style="padding-left:20px;font-size:13px;font-family:solaimanLipi;"></td>
        </tr>


        </tbody>
    </table>

    <table width="95%" height="10px" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin:0px auto;margin-top:5px; ">
        <tr>
            <td style=" text-indent: 20px;font-size:12px;text-align: justify;">এমতাবস্থায় আবেদনকারীর অনুকূলে উক্ত
                তফসিলের উপর ভূমি ব্যবহারের ছাড়পত্রের কপি প্রস্তুত করা হয়েছে। যা পত্র নথিতে সংযুক্ত।
            </td>

        </tr>
    </table>

    <table width="95%" height="40px" cellpadding="0" cellspacing="0" border="0"
           style="border-collapse:collapse;margin:0px auto;margin-top:5px;table-layout:fixed;  line-height: 1.3;
           font-size:14px;font-family:solaimanLipi;">
        <tr>
            <td style="width:40px;text-indent:20px;font-size:14px;">শর্তাবলীঃ-</td>
            <td style="text-align: justify;"></td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;">১।</td>
            <td style="text-align: justify;"> এই ভূমি ব্যবহার ছাড়পত্র প্রদানের তারিখ হতে ২৪ (চব্বিশ) মাস সময়কাল পর্যন্ত
                কার্যকর থাকবে।
            </td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;">২।</td>
            <td style="text-align: justify;"> এই ভূমি ব্যবহার ছাড়পত্র উন্নয়ন বা নির্মাণ কাজের ক্ষেত্রে কোনরূপ বৈধ ক্ষমতা
                প্রদান করে না,এবং কোন নির্মাণ কার্যক্রম শুরু করিবার জন্য কোনরূপ অধিকার প্রদান করে না।
            </td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;">৩।</td>
            <td style="text-align: justify;"> ভূমিতে স্থাপনা ও পরিচালনার ক্ষেত্রে পরিবেশ সংরক্ষণ আইন ও বিধি যথাযথভাবে
                অনুসরণ করতে হবে।
            </td>
        </tr>

        <tr>
            <td style="width:40px;text-indent:20px;">৪।</td>
            <td style="text-align: justify;">উপযুক্ত অগ্নি নির্বাপক ব্যবস্থা রাখতে হবে এবং অগ্নিকান্ড কিংবা অন্য কোন
                দুর্ঘটনার সময় জরুরি নির্গমন ব্যবস্থা থাকতে হবে।
            </td>
        </tr>

        <tr>
            <td style="width:40px;text-indent:20px;">৫।</td>
            <td style="text-align: justify;">কর্তৃপক্ষ যে কোন সময় যথাযথ কারণ উল্লেখ্য পূর্বক এই ভূমি ব্যবহার ছাড়পত্র
                বাতিল বা এর কার্যকারিতা স্থগিত করিতে পারিবে।
            </td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;">৬।</td>
            <td style="text-align: justify;"> কোন তথ্য গোপন করিলে বা ভুল তথ্য প্রদান করিলে প্রদানকৃত ছাড়পত্র বাতিল বলিয়া
                গণ্য হইবে।
            </td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;">৭।</td>
            <td style="text-align: justify;">এই ভূমি ব্যবহার ছাড়পত্র জমির মালিকানা স্বত্ব নির্ধারণ করে না।</td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;">৮।</td>
            <td style="text-align: justify;"> ভূমি ব্যবহারে দেশের প্রচলিত সকল বিধি বিধান যথাযথভাবে অনুসরণ করতে হবে।</td>
        </tr>
        <tr>
            <td style="width:40px;text-indent:20px;"> ৯।</td>
            <td style="text-align: justify;"> রাস্তার প্রশস্ততাঃ {{ $certificate_data->ploat_near_road }}।</td>
        </tr>
        @if($certificate_data->road_consider != '')
        <tr>
            <td style="width:40px;text-indent:20px;"> ১০।</td>
            <td style="text-align: justify;"><br> &nbsp; {{$certificate_data->road_consider }}</td>
        </tr>

        @endif



    </table>



        <div style="position: fixed; bottom: 5px;">
            <table width="95%" height="20px" cellpadding="0" cellspacing="0" border="0"
                   style="border-collapse:collapse;margin:0px auto;margin-top:10px;table-layout:fixed; ">
                <tr>
                    <td style=" text-align:left;text-indent: 20px;font-size:14px;text-align: justify;">সুতরাং পত্র নথিতে সংযুক্ত প্রস্তুতকৃত পত্রে সদয় স্বাক্ষরিত হলে উপরোক্ত শর্ত সাপেক্ষে আবেদনকারীকে উক্ত ভূমি ব্যবহারের ছাড়পত্র দেয়া যেতে পারে।</td>

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
