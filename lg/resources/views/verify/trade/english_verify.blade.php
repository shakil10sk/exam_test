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
                        <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->en_name }}</font>

                        <br />

                        <font style="font-size:16px; font-weight:bold;">
                            {{ $union->village_en }}, {{ $union->union_upazila_name_en }}, {{ $union->union_district_name_en }}-{{ $union->postal_code }}<br>
                            Mobile: {{ $union->mobile }}, Email: {{ $union->email }} <br>
                            Website: {{ $union->sub_domain }}</font>

                    </td>

                    <td style="width:1.2in; text-align:left;">

                       

                    </td>

                </tr>
            </table> 
            
         

            <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
                
                <tr>
                    <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                        <font style="">
                            <u>Trade Licesnse verify</u>
                        </font>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td>Issue Date: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $trade['organization']['generate_date'])->format('d-m-Y') }}</td>
                                <td style="text-align: right;padding-right: 5px;">Expire Date: {{ Carbon\Carbon::parse($trade['organization']['expire_date'])->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>

                    <td >
                        
                        <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width:150px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                                @php

                                    $sonod = str_split($trade['organization']['sonod_no']);

                                    for($i=0; $i<strlen($trade['organization']['sonod_no']); $i++):

                                    @endphp
                                    
                                    <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

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
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Name</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['organization_name_en'] }}</td>
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Type</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type_en'] }}</td>
                </tr> 

                <tr> 
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">Mobile</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['mobile'] }}</td>
                    <td style="text-indent: 20px;text-align:left; font-size:16px;">Email</td>
                    <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
                </tr>       
            </table>

            <table width="88%" cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px" >

                    <tr style="text-align: center;font-weight:bolder;">
                        <th>নং</th>
                        <td style="font-weight: 700px; font-size: 17px;">Propitor Name</td>
                        <th style="font-weight: 700px; font-size: 17px;">Father/Husband</th>
                        <th style="font-weight: 700px; font-size: 17px;">NID/ Birth ID</th>
                        <th style="font-weight: 700px; font-size: 17px;">Mobile</th>
                    </tr>

                    @php
                        $i = 1;
                    @endphp 

                    @foreach($trade['organization']['owner_list'] as $owner)

                    
                    <tr height="20px" style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>{{  $owner['name_en'] }}</td>

                        <td>
                        
                        @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
                            {{ $owner['husband_name_en'] }}
                        @else
                            {{ $owner['father_name_en'] }}
                        @endif
                            
                        
                    </td>
                    <td>
                        
                        @if ($owner['nid'] > 0)
                              {{ $owner['nid'] }}
                        @else
                             {{ $owner['birth_id'] }} 
                        @endif
                            

                    </td>

                    <td>{{ $owner['mobile'] }}</td>

                    </tr>
                    <tr height='25px' >
                        <td colspan="4">
                        
                            <p style="font-size:15px;">Address
                            : &nbsp;{{ $owner['permanent_village_en'] }},&nbsp;&nbsp;&nbsp;, {{ $owner['permanent_village_en'] }}
                          , &nbsp;, {{ $owner['permanent_postoffice_name_en'] }},&nbsp;&nbsp;&nbsp; {{ $owner['permanent_ward_no'] }}
                            &nbsp;, {{ $owner['permanent_upazila_name_en'] }} 
                           , &nbsp; {{ $owner['permanent_district_name_en'] }} 
                            </p>

                        </td>
                    </tr>
                    @endforeach
                          
            </table>

     
                <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

                    <tr>
                        <td align='left'  style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">Organization Address</td>
                        <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;"> : {{ $trade['organization']['trade_village_en'] }}&nbsp;{{ $trade['organization']['trade_ward_no'] }},&nbsp;{{ $trade['organization']['trade_postoffice_name_en'] }},&nbsp;{{ $trade['organization']['trade_upazila_name_en'] }},&nbsp;{{ $trade['organization']['trade_district_name_en'] }}
                        </td>
                    </tr>

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">Trade license Fee (Annual)</td>
                         <td style="text-align:left;font-size:16px; ">:&nbsp;1000&nbsp;Taka</span></td>
                    </tr>
                   

                   
                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Signboard Fee(Annual) </td>
                        <td style="text-align:left;font-size:16px; ">:&nbsp;100&nbsp;Taka</span></td>
                    </tr>
                 

                 
                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Due </td>
                        <td style="text-align:left;font-size:16px; ">:&nbsp;200&nbsp;Taka</span></td>
                    </tr>
                   

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">15% Vat</td>
                        <td style="text-align:left; font-size:16px;">:&nbsp;400&nbsp;Taka</span></td>
                    </tr>

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Business Tax</td>
                        <td style="text-align:left; font-size:16px;">:&nbsp;200&nbsp;Taka</span></td>
                    </tr>

                    <tr>
                        <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Total</td>
                        <td  style="text-align:left; font-size:16px; ">:&nbsp;1695&nbsp;Taka. Inword: {{ converter::en_word(1695) }} taka only</span></td>
                    </tr>

                </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                    <tr>
                        <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp;  You are permitted to continue your business for {{ $trade['organization']['fiscal_year_name'] }} after receiving the license fee on behalf of the mentioned company. This license will be valid till <?php $exp_year = date('Y')+1; echo '30-06-'.$exp_year; ?> and will have to renew every year.
                        </td>
                        
                    </tr>

                </table>

                @else
                    <h2 class="text-danger text-center">Sorry ! This is invalid certificate no</h2>
                @endif

             </div>
        </div>
    </section>



