
<style type="text/css">
    

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
</style>

    <section>
        <div class="container">
            <div class="card" style="margin:20px 0px; padding: 10px 0px 20px 0px">

                @if(!empty($trade['organization']))
                <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
                <tr>
                    <td style="width:1.5in; text-align:center;"></td>

                    <td style="text-align:center;">
                        <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>
                     
                        <br />

                        <font style="font-size:16px; font-weight:bold;">
                            {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
                            মোবাইলঃ{{ Converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                            ওয়েব সাইট : {{ $union->sub_domain }}</font>

                    </td>

                    <td style="width:1.2in; text-align:left;">

                        

                    </td>

                </tr>
            </table> 
            

            <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
                
                <tr>
                    <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                        <font style="">
                            <u>ট্রেড লাইসেন্স যাচাই</u>
                        </font>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>ইস্যু তারিখঃ {{ Converter::en2bn(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trade['organization']['generate_date'])->format('d-m-Y')) }}</td>
                                <td style="text-align: right;padding-right: 5px;">মেয়াদ উত্তীর্ণঃ {{Converter::en2bn( Carbon\Carbon::parse($trade['organization']['expire_date'])->format('d-m-Y')) }}</td>
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
                                    
                                    <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo Converter::en2bn($sonod[$i]); ?></td>

                                    @php
                                        endfor;
                                    @endphp
                            </tr>
                        </table>
                    </td>

                </tr>

            </table>

            <table style="width:95%; margin-left:48px;margin-top:10px;" cellpadding="0" cellspacing="0">
                
                <tr>
                            
                    <td  valign="top" style="text-align: center;" >


                        @foreach($trade['organization']['owner_list'] as $owner)

                            @if(!empty($owner['photo']))

                                <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'.$owner['photo'] }}" height="80px" width="80px" style="" />

                            @else

                                <img src="{{ asset('images/application/default.jpg') }}" height="80px" width="80px"/>


                            @endif

                        @endforeach

                    </td>

                </tr>

            </table>


            <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                <tr> 
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসার ধরণ</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type_bn'] }}</td>
                </tr> 

                <tr> 
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ Converter::en2bn($trade['organization']['mobile']) }}</td>
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">ই-মেইল</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
                </tr>       
            </table>

            <table width="88%" cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px" >

                    <tr style="text-align: center;font-weight:bolder;">
                        <th>নং</th>
                        <td style="font-weight: 700px; font-size: 17px;">প্রোপাইটরের নাম</td>
                        <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
                        <th style="font-weight: 700px; font-size: 17px;">পরিচয় পত্র/ জন্ম নিবন্ধন</th>
                        <th style="font-weight: 700px; font-size: 17px;">মোবাইল</th>
                    </tr>

                    @php
                        $i = 1;
                    @endphp 

                    @foreach($trade['organization']['owner_list'] as $owner)

                    
                    <tr height="20px" style="text-align: center;">
                        <td>{{ Converter::en2bn($i++) }}</td>
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
                              {{ Converter::en2bn($owner['nid']) }}
                        @else
                             {{ Converter::en2bn($owner['birth_id']) }} 
                        @endif
                            

                    </td>

                    <td>{{ Converter::en2bn($owner['mobile']) }}</td>

                    </tr>
                    <tr height='25px' >
                        <td colspan="4">
                        
                            <p style="font-size:15px;">ঠিকানা
                            : &nbsp;{{ $owner['permanent_village_bn'] }},&nbsp;&nbsp;&nbsp;, {{ $owner['permanent_village_bn'] }}
                          , &nbsp;, {{ $owner['permanent_postoffice_name_bn'] }},&nbsp;&nbsp;&nbsp; {{ Converter::en2bn($owner['permanent_ward_no']) }}
                            &nbsp;, {{ $owner['permanent_upazila_name_bn'] }} 
                           , &nbsp; {{ $owner['permanent_district_name_bn'] }} 
                            </p>

                        </td>
                    </tr>
                    @endforeach
                          
            </table>

     
                <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

                    <tr>
                        <td align='left'  style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
                        <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;"> : {{ $trade['organization']['trade_village_bn'] }}&nbsp;{{ Converter::en2bn($trade['organization']['trade_ward_no']) }},&nbsp;{{ $trade['organization']['trade_postoffice_name_bn'] }},&nbsp;{{ $trade['organization']['trade_upazila_name_bn'] }},&nbsp;{{ $trade['organization']['trade_district_name_bn'] }}
                        </td>
                    </tr>

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ট্রেড লাইসেন্স ফি(বার্ষিক)</td>
                         <td style="text-align:left;font-size:16px; ">:&nbsp;{{ Converter::en2bn(1000)}}&nbsp;টাকা</span></td>
                    </tr>
                   

                   
                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সাইনবোর্ড কর(বার্ষিক) </td>
                        <td style="text-align:left;font-size:16px; ">:&nbsp;{{ Converter::en2bn(1000)}}&nbsp;টাকা</span></td>
                    </tr>
                 

                 
                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">বকেয়া </td>
                        <td style="text-align:left;font-size:16px; ">:&nbsp;{{ Converter::en2bn(1000)}}&nbsp;টাকা</span></td>
                    </tr>
                   

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">১৫ % ভ্যাট বাবদ জমা</td>
                        <td style="text-align:left; font-size:16px;">:&nbsp;{{ Converter::en2bn(1000)}}&nbsp;টাকা</span></td>
                    </tr>

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পেশা  ও বাণিজ্যিক কর</td>
                        <td style="text-align:left; font-size:16px;">:&nbsp;{{ Converter::en2bn(1000)}}&nbsp;টাকা</span></td>
                    </tr>

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">সর্বমোট</td>
                        <td  style="text-align:left; font-size:16px; ">:&nbsp;{{ Converter::en2bn(1000)}}&nbsp;টাকা কথায়ঃ {{ Converter::bn_word(4562) }} টাকা মাত্র</span></td>
                    </tr>

                </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                    <tr>
                        <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp; উল্লেখিত প্রতিষ্ঠানের অনুকূলে প্রদত্ত লাইসেন্স ফি গ্রহন করিয়া {{ Converter::en2bn($trade['organization']['fiscal_year_name']) }} সালের জন্য আবশ্যকীয় বাণিজ্য চালাইয়া যাইবার অনুমতি দেওয়া হইল । <?php $exp_year = date('Y')+1; echo Converter::en2bn('30-06-'.$exp_year); ?> সন পর্যন্ত এই লাইসেন্স বৈধ বলিয়া বিবেচিত হইবে এবং প্রতি বছর নবায়ন করিতে হইবে ।</td>
                        
                    </tr>

                </table>

                @else
                    <h2 style="text-align: center;color: red;">দঃখিত ! সনদ নাম্বারটি সঠিক নয়</h2>
                @endif

             </div>
        </div>
    </section>

{{-- @endsection --}}

