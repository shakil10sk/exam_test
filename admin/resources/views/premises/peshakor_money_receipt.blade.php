<html>
<head>
    <base href="" />
    <title>পেশা কর মানি রসিদ</title>
    <style>
         body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
        }
        

        @page {
            header: page-header;
            footer: page-footer;
            margin: 20px 0px;
            padding: 0px;

        }

        @media print {
            body {
                font-family: 'bangla', sans-serif !important;
            }
            * {
                -webkit-print-color-adjust: exact;
            }
            
        }
      
      
    </style>
</head>

<body>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                        মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}<br>
                            (অফিস কপি)
                    </font>

                </td>

                <td style="width:1.2in; text-align:left;">

                   @if($union->brand_logo != '')
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                    @endif

                </td>

            </tr>
        </table> 

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">
            
  
            <tr>
                <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->organization_name_bn }}</font>
                </td>

               <td align='right'><b>অর্থ বছর </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->fiscal_year_name) }}</font>
                </td>

            </tr>
            <tr>
                <td style="padding-left: 50px"><b>গ্রাম </b> </td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $data->trade_village_bn }}</font>
                </td>
                <td align='right'><b>ওয়ার্ড নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->trade_ward_no) }}</font>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data->voucher) }}</font>
                </td>
            </tr>
        </table>


        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">

 
            <tr>
                <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td valign='top' style='font-size:14px;text-align:center;'>১</td>
                <td style="height:100px;text-align:left;;font-size:14px;padding-top:5px;" valign='top'>পেশা কর</td>

                <td valign='top' style="text-align:center;">{{ BanglaConverter::bn_number($data->amount) }}</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:14px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:center; font-size:14px;"><?php  echo BanglaConverter::bn_number($data->amount) ; ?></td> 
           </tr>
        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:60px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />যাচাইকারী
                </td>
            </tr>  
            
        </table>

      
        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;">
            <tr>
                <td style="border-bottom: 2px dotted;">
                    
                </td>
            </tr>
        </table>
        <br/>

        <!----------------second part----------------->


         <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                        মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}
                        <br>
                        (গ্রাহক কপি)
                    </font>

                </td>

                <td style="width:1.2in; text-align:left;">
                    @if($union->brand_logo != '')
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                    @endif
                </td>

            </tr>
        </table> 

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">
            
  
            <tr>
                <td style="padding-left: 50px;width: 150px;"><b>প্রতিষ্ঠানের নাম </b></td>
                <td>
                    <font>&nbsp;:&nbsp;{{ $data->organization_name_bn }}</font>
                </td>

               <td align='right'><b>অর্থ বছর </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->fiscal_year_name) }}</font>
                </td>

            </tr>
            <tr>
                <td style="padding-left: 50px"><b>গ্রাম </b> </td>
                <td>
                    <font>&nbsp;:&nbsp; {{ $data->trade_village_bn }}</font>
                </td>
                <td align='right'><b>ওয়ার্ড নং </b> </td>
                <td>
                    <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->trade_ward_no) }}</font>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 50px"><b>ভাউচার নং</b></td>
                <td >
                    <font>&nbsp;:&nbsp; {{ BanglaConverter::bn_number($data->voucher) }}</font>
                </td>
            </tr>
        </table>


        <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">

 
            <tr>
                <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
                <td height='22' style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
                <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
            </tr>

            <tr>
                <td valign='top' style='font-size:14px;text-align:center;'>১</td>
                <td style="height:100px;text-align:left;;font-size:14px;padding-top:5px;" valign='top'>পেশা কর</td>

                <td valign='top' style="text-align:center;">{{ BanglaConverter::bn_number($data->amount) }}</td>
            </tr>

            <tr>
                <td colspan='2' height='23' style="text-align:right; font-size:14px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
                <td height='23' style="text-align:center; font-size:14px;"><?php  echo BanglaConverter::bn_number($data->amount) ; ?></td> 
           </tr>
        </table>

        <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:60px 0px auto;">

            <tr>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />আদায়কারী
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">সীল</span>
                </td>
                <td  style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                    <span style="border-top: 1px dotted;">স্বাক্ষর</span><br />যাচাইকারী
                </td>
            </tr>  
            
        </table>

</body>