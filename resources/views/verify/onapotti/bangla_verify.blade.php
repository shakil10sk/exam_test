
<style type="text/css">
    

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
            margin: 20px 0px;
            padding: 0px;

        }
</style>
{{-- {{ dd($onapotti) }} --}}
    <section>
        <div class="container">
            <div class="card" style="margin:20px 0px; padding: 10px 0px 20px 0px">

                @if(!empty($onapotti))
                <table border="0px" width="110%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
                        <tr>
                            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" /></td>

                            <td style="text-align:center;">
                                <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>
                             
                                <br />

                                <font style="font-size:16px; font-weight:bold;">
                                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
                                    মোবাইলঃ{{ Converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                                    ওয়েব সাইট : {{ $url }}</font>

                            </td>

                            <td style="width:1.2in; text-align:left;">
            
                                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="100px" width="100px" style="position:relative;right:10px;" />
            
                            </td>

                        </tr>
                    </table> 
                    

               
        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
            
            <tr>
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>অনাপত্তি পত্র যাচাই</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>
                    
                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং :</td>
                            @php

                            $sonod = str_split($onapotti->sonod_no);

                            for($i=0; $i<strlen($onapotti->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;">
                            {{ converter::en2bn($sonod[$i]) }}</td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>

                
                <td rowspan="3" valign="top" style="text-align: left;" >
                 

                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>
            </tr>
        </table>

     
    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; line-height: 1.5;">
      
        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">নাম </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $onapotti->name_bn }}</font>
            </td>
        </tr>

      

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">পিতার নাম </td>
            <td>
                <font style="font-size:16px; ">: {{ $onapotti->father_name_bn }} </font>
            </td>
        </tr>

       

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">বর্তমান ঠিকানা </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : গ্রামঃ {{ $onapotti->present_village_bn }}
                    &nbsp; ডাকঘরঃ {{ $onapotti->present_postoffice_name_bn }}
                    &nbsp; উপজেলাঃ {{ $onapotti->present_upazila_name_bn }}
                    &nbsp; জেলাঃ {{ $onapotti->present_district_name_bn}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">স্থায়ী ঠিকানা </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : গ্রামঃ {{ $onapotti->permanent_village_bn }}
                    &nbsp; ডাকঘরঃ {{ $onapotti->permanent_postoffice_name_bn }}
                    &nbsp; উপজেলাঃ {{ $onapotti->permanent_upazila_name_bn }}
                    &nbsp; জেলাঃ {{ $onapotti->permanent_district_name_bn }} 
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ওয়ার্ড নং </td>
            <td>
                <font style="font-size:16px;  ">:  {{ converter::en2bn($onapotti->permanent_ward_no) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ব্যবসা প্রতিষ্ঠানের নাম </td>
            <td>
                <font style="font-size:16px;  ">:  {{ converter::en2bn($onapotti->organization_name_bn) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">কারখানার অবস্থান</td>
            <td>
                <font style="font-size:16px;  ">:  {{ converter::en2bn($onapotti->organization_location_bn) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ব্যবসার ধরণ</td>
            <td>
                <font style="font-size:16px;  ">:  {{ converter::en2bn($onapotti->organization_type_bn) }}</font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ট্রেড লাইসেন্স নং</td>
            <td>
                <font style="font-size:16px;  ">:  {{ converter::en2bn($onapotti->trade_license_no) }}</font>
            </td>
        </tr>
        
       

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">তারিখ </td>
            <td>
                <font style="font-size:16px;">: <?php echo Converter::en2bn(date('d-m-Y', strtotime($onapotti->generate_date))); ?></font>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ব্যবহত জমির বিবরণ </td>
            <td>
                <table border='1' cellpadding='0' cellspacing='0' width='98%'>
                    <tr>
                        <td>মৌজা</td>
                        <td>থানা</td>
                        <td>জেলা</td>
                        <td>খতিয়ান নং</td>
                        <td>দাগ নং</td>
                        <td>জমির ধরণ</td>
                        <td>জমির পরিমাণ</td>
                    </tr>
                    <tr>
                        <td>{{ $onapotti->moja }}</td>
                        <td>{{ $onapotti->thana }}</td>
                        <td>{{ $onapotti->district }}</td>
                        <td>{{ $onapotti->khotian_no }}</td>
                        <td>{{ $onapotti->dag_no }}</td>
                        <td>{{ $onapotti->land_type }}</td>
                        <td>{{ $onapotti->land_amount }}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp;  উপরোক্ত তথ্য ও নিম্নোক্ত শর্তাবলী অনুসারে উক্ত প্রতিষ্ঠানের কার্যক্রম পরিচালনার জন্য অনাপত্তি পত্র প্রদান করা হল।</td>
    		
        </tr>

        <tr>
        	<td style="padding-left:72px; font-size:17px; height: 20px">আমি তাহার সর্বাঙ্গীণ মঙ্গল ও উন্নতি কামনা করি।</td>
        </tr>

    </table>
    <table border="0px" height="20px" width='99%' style="border-collapse:collapse; margin:5px auto;" cellspacing="0" cellpadding="0" >
						
        <tr height="20px" valign="top">
            
            <td  style="font-size:12px; text-align:center;">[বিঃ দ্রঃ- তথ্য গোপন / অনিয়ম করিয়া এই সনদ গ্রহণ করিলে তাহা বাতিল বলিয়া গণ্য হইবে এবং এর দায় দায়িত্ব সনদ গ্রহণকারীর উপর বর্তাইবে।]</td>
            
        </tr>
    </table>


                @else
                    <h2 style="text-align: center;color: red;">দঃখিত ! সনদ নাম্বারটি সঠিক নয়</h2>
                @endif

             </div>
        </div>
    </section>

{{-- @endsection --}}

