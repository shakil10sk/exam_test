
<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বাংলা ভোটার আইডি স্থানান্তর সনদ</title>
   
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


        @if (!empty($voter))
        <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;">{{-- <img src="{{ asset('public/assets/images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" /> --}}</td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ converter::en2bn($union->postal_code) }}<br>
                        মোবাইলঃ{{ converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ $union->sub_domain }}</font>

                </td>

                <td style="width:1.2in; text-align:left;">

                  {{--   <img src="{{ asset('public/assets/images/union_profile/'.$union->brand_logo) }}" height="100px" width="100px" style="position:relative;right:10px;" />
 --}}
                </td>

            </tr>
        </table> 
        

         

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

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo converter::en2bn($sonod[$i]); ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>

                
                <td rowspan="3" valign="top" style="text-align: left;" >
                   @if($voter->photo != '' )
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'.$voter->photo }}" height="100px" width="100px" style="" alt="profile" />

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
                <td  colspan="2" style="font-size:16px; vertical-align:top;padding-left:55px; "><p style="">তিনি পূর্বে {{ $voter->union_name_bn }} এর {{ $voter->permanent_village_bn }} গ্রামের বাসিন্দা ছিলেন।  তিনি বর্তমানে {{ $union->bn_name }} এর {{ converter::en2bn($voter->permanent_ward_no) }} নং ওয়ার্ডে স্থায়ী   ভাবে বসবাস করে আসিতেছেন। তাহার জাতীয় পরিচয়পত্র নং-{{ converter::en2bn($voter->nid) }} ।  তাহার জাতীয় পরিচয়পত্র পূর্বে নিম্ন ঠিকানায় ছিল </p></td>
                
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
               <td  colspan="2" style="font-size:16px; vertical-align:top;padding-left:55px; "><p>যা এখন স্থানান্তর করা করা প্রয়োজন।  সে আইন-শৃঙ্খলা বা রাষ্ট্রবিরোধী কোন কাজ কর্মে জড়িত নহেন। আমার জানামতে তাহার স্বভাব চরিত্র ভাল। উক্ত সনদপত্রটি সংশ্লিষ্ট   {{ converter::en2bn($voter->permanent_ward_no) }} নং ওয়ার্ড সদস্য  এর তদন্তের মাধ্যমে ও সুপারিশক্রমে প্রদান করা হলো।</p> </td>
                
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

@else
   <h1 style="text-align:center;color:red;">দুঃখিত ! সনদটি পাওয়া যায়নি</h1>
@endif
</body>

</html>
