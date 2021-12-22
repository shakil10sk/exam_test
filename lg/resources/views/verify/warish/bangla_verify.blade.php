
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

                @if(!empty($data['warish_data']))
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
                    

                    <table border="0px" width="98%"  style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align:center;font-size:25px;font-weight:bold;" height="38">
                            <font style="">
                                <u>ওয়ারিশ সনদপত্র যাচাই</u>
                            </font>
                        </td>
                        
                    </tr>
                </table>

                <table border='1' align="left" style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width:100px; text-align:center;font-weight:700;font-size:17px; ">সনদ নং :</td>

                        @php

                            $sonod = str_split($data['warish_data']->sonod_no);

                            for($i=0; $i<strlen($data['warish_data']->sonod_no); $i++):

                        @endphp
                        
                        <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo converter::en2bn($sonod[$i]); ?></td>

                        @php
                            endfor;
                        @endphp

                         <td style="border: none;">
                            <font style="font-size: 18px">&nbsp;&nbsp;&nbsp; তারিখঃ  <?php echo converter::en2bn(date('d-m-Y', strtotime($data['warish_data']->generate_date))); ?></font>
                        </td> 
                         
                    </tr>
                </table>


                <table class="jolchap" align="center" border="0"  width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
                    <tr height="55px" style="">
                        <td colspan="2"  style="font-size:18px; text-indent:50px;padding-left: 50px; padding-top: 15px; padding-bottom: 10px;">এই মর্মে প্রত্যয়ন পত্র প্রদান করা যাইতেছে যে,</td>

                    </tr>
                </table>    
                            
                            
                <table border="0px" width="99%"   align="center" style="border-collapse:collapse; margin:1px auto;" cellspacing="0" cellpadding="0">            
                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">নাম   </td>
                        <td colspan="3" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->name_bn }}</font></td>
                    </tr>
                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পিতা </td>

                        <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['warish_data']->father_name_bn }} </font></td>

                        <td  style="font-size:15px; text-align:left; ">মাতা  </td>

                        <td style=""><font style="font-size:15px;font-weight:bold;  ">:   {{ $data['warish_data']->mother_name_bn }} </font></td>

                        @if($data['warish_data']->gender == 1 && $data['warish_data']->marital_status == 2)

                        <td  style="font-size:15px; text-align:left;">
                            স্ত্রী 
                        </td>

                        <td><font style="font-size:15px;font-weight:bold;  ">:{{ $data['warish_data']->wife_name_bn }} </font></td>

                        @endif

                        @if($data['warish_data']->gender == 2 && $data['warish_data']->marital_status == 2)

                        <td  style="font-size:15px; text-align:left;">
                            স্বামী
                        </td>

                        <td><font style="font-size:15px;font-weight:bold;  ">:{{ $data['warish_data']->husband_name_bn }} </font></td>

                        @endif
                    </tr>

                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">ন্যাশনাল আইডি   </td>
                        <td style="font-size:15px;font-weight:bold; ">: {{ converter::en2bn($data['warish_data']->nid) }}</td>
                        <td valign="top" style="font-size:16px;">মৃত্যু নিবন্ধন নং </td>
                        <td colspan="2" style="font-size:15px;font-weight:bold; ">: {{ converter::en2bn($data['warish_data']->birth_id) }}</font></td>
                    </tr>

                    @if($data['warish_data']->passport_no != null)

                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">পাসপোর্ট নং   </td>
                        <td colspan="5" style=""><font style="font-size:15px;font-weight:bold; ">: {{ converter::en2bn($data['warish_data']->passport_no) }}</font></td>
                    </tr>
                    @endif

                    <br>
                    <br>


                    <tr>
                        <td valign="top" style="font-size: 16px; padding-left: 50px;">স্থায়ী ঠিকানা</td>
                        <td colspan="5">
                            <p style="font-size:16px;">
                                : গ্রাম/মহল্লা : &nbsp;{{ $data['warish_data']->permanent_village_bn }},&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : {{ $data['warish_data']->permanent_rbs_bn }}
                                পোষ্ট অফিস : &nbsp;{{ $data['warish_data']->permanent_postoffice_name_bn }},&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : {{ converter::en2bn($data['warish_data']->permanent_ward_no) }}
                                 উপজেলা : &nbsp;{{ $data['warish_data']->permanent_upazila_name_bn }} 
                                 জেলা :  &nbsp;{{ $data['warish_data']->permanent_district_name_bn }} 
                            </p>
                        </td>
                    </tr><br>

                    <tr>
                        <td valign="top" style="font-size: 16px; padding-left: 50px;">বর্তমান ঠিকানা</td>
                        <td colspan="5">
                            <p style="font-size:16px;">
                                : গ্রাম/মহল্লা : &nbsp;{{ $data['warish_data']->present_village_bn }},&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : {{ $data['warish_data']->present_rbs_en }}
                                পোষ্ট অফিস : &nbsp;{{ $data['warish_data']->present_postoffice_name_bn }},&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : {{ converter::en2bn($data['warish_data']->present_ward_no) }}
                                 উপজেলা : &nbsp;{{ $data['warish_data']->present_upazila_name_bn }} 
                                 জেলা :  &nbsp;{{ $data['warish_data']->present_district_name_bn }} 
                            </p>
                        </td>
                    </tr>

                </table>



                <table border="0px" width="99%"  align="center" style="border-collapse:collapse;margin:4px auto; " cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding-left: 50px; height: 25px;"> 
                            <font style="font-size:16px; padding-left:30px;"> অত্র ইউনিয়নের {{ ($data['warish_data']->resident == 1) ? "অস্থায়ী" : "স্থায়ী" }} অধিবাসী ছিলেন। মৃত্যুকালে তিনি নিম্নলিখিত ওয়ারিশগনকে রাখিয়া মৃত্যু বরণ করেন।</font>
                        </td>
                    </tr>
                </table>



                <table border="1" align="center" width="93%" height="300px" align="center" style="border-collapse:collapse; " cellspacing="0" cellpadding="0" >
                    <tr height="20px"> 
                        <th style="width:5%;font-size:14px;">ক্রঃ নং</th>
                        <th style="width:20%;font-size:14px;">নাম</th>
                        <th style="width:10%;font-size:14px;">সম্পর্ক</th>
                        <th style="width:8%;font-size:14px;">বয়স</th>
                        <th style="width:5%;font-size:14px;">ক্রঃ নং</th>
                        <th style="width:20%;font-size:14px;">নাম</th>
                        <th style="width:10%;font-size:14px;">সম্পর্ক</th>
                        <th style="width:8%;font-size:14px;">বয়স</th>
                    </tr>
                    <?php for($i=0; $i<10; $i++):?>
                    
                    <tr height=''>
                        <td style="text-align:center;font-size:13px;">{{ converter::en2bn($i+1) }}</td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php 
                                echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->name_bn : "";
                            @endphp
                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php 
                                echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->relation_bn : "";
                            @endphp

                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php 
                                echo isset($data["warish_list"][$i]) ? converter::en2bn($data["warish_list"][$i]->age) : "";
                            @endphp
                        </td>
                        
                        <td style="text-align:center;font-size:13px;">{{ converter::en2bn($i+11) }}</td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">

                            @php 
                                echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->name_bn : "";
                            @endphp
                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php 
                                echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->relation_bn : "";
                            @endphp

                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">

                            @php 
                                echo isset ($data["warish_list"][$i+10]) ? converter::en2bn($data["warish_list"][$i+10]->age) : "";
                            @endphp
                        </td>
                    </tr>
                    
                    <?php endfor;?>
                    
                    <tr> 
                        
                        <td colspan="8" style="text-align:right;font-size:12px; padding-right:60px;">উত্তরাধিকারীর সংখ্যা <span>&nbsp;&nbsp;</span> {{ converter::en2bn(count($data['warish_list'])) }} &nbsp;&nbsp;জন</td>

                    </tr>
                </table>



                <table width="98%" border="0" style="padding-top:5px;border-collapse:collapse;margin:0px auto;">
                    <tr>
                        <td style="font-size:16px; padding-left: 50px"> আমি মৃতের {{ ($data['warish_data']->religion == 1) ? "বিদ্বেহী আত্নার মাগফেরাত" : "আত্নার শান্তি" }} এবং উওরাধিকারীগণের মঙ্গল কামনা করি। </td>
                    </tr>
                </table>


                <table border='0' width="98%"> 
                    <tr>
                        <td style="padding-left:50px; font-size:15px;"><b>তদন্তকারীঃ </b></td> 
                        <td style="font-size:15px;">{{ $data['warish_data']->investigator_name_bn }}</td>
                        <td style="font-size:15px;"><b>আবেদনকারী : </b></td>
                        <td style="font-size:15px;">{{ $data['warish_data']->applicant_name_bn }}</td>
                        <td style="font-size:15px;"><b>পিতা :</b></td>
                        <td style="font-size:15px;">{{ $data['warish_data']->applicant_father_name_bn }}</td>
                    </tr>
                    
                </table>

                @else
                    <h2 style="text-align: center;color: red;">দঃখিত ! সনদ নাম্বারটি সঠিক নয়</h2>
                @endif

             </div>
        </div>
    </section>

{{-- @endsection --}}

