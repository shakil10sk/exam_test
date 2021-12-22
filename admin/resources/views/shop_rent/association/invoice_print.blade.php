<html>
<head>
    <base href=""/>
    <title>ইনভয়েস</title>
    <style>
        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
        }

        @if($data->is_paid == 1)
        .jolchap {
            background: url({{asset('images/paid.png')}}) no-repeat center;
            background-size: 808px;
            width: 100%;
            height: 22%;
        }

        @endif


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
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}"
                                                         height="80px" width="80px"/></td>

        <td style="text-align:center;">
            <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

            <br/>

            <font style="font-size:16px; font-weight:bold;">
                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                -{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }},
                 ই-মেইলঃ {{ $union->email }} <br>
                ওয়েব সাইট : {{ request()->getHost() }}<br>
                (অফিস কপি)
            </font>

        </td>

        <td style="width:1.2in; text-align:left;">

            @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px"
                     style="position:relative;right:10px;"/>
            @endif

        </td>

    </tr>
</table>


<div class="jolchap fast_part">
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">


        <tr>
            <td style="padding-left: 50px;width: 150px;"><b>সদস্য নং </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data->member_id }}</font>
            </td>

            <td align='right'><b> সদস্য নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data->name  }} </font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ঠিকানা</b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data->permanent_village_en }} </font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ইনভয়েস নং</b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->invoice_id) }}</font>
            </td>
            <td align='right'><b>অর্থ বছর</b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->year_id) }}</font>
            </td>
        </tr>
    </table>


    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">

        <tr>
            <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:60%;text-align:center;font-size:12px;"><font> বিস্তারিত </font></td>
            <td height='22' style="text-align:center;font-size:12px;"><font>  </font></td>
            <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা)</td>
        </tr>

        <tr style="height: 100px">
            <td align="center">১</td>

            <td height="100" style="border: 1px solid black;padding-left:10px;">সমিতির টাকা কালেকশান বাবদ ফি<br>{{  $data->month_name  }}
            </td>

            <td align="center"> {{ BanglaConverter::bn_number($data->chanda_amount)  }} x  @php $month_ids_array = explode(",",
            $data->month_ids); @endphp {{ BanglaConverter::bn_number(count($month_ids_array)) }}
            </td>

            <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{ BanglaConverter::bn_number($data->total_amount) }}</td>
        </tr>


        <tr>
            <td colspan='3' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
            <td height='23'
                style="text-align:right;padding-right:20px; font-size:12px;">{{ BanglaConverter::bn_number($data->total_amount) }} টাকা।
            </td>
        </tr>

    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:60px 0px auto;">

        <tr>
            <td style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>আদায়কারী
            </td>
            <td style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                <span style="border-top: 1px dotted;">সীল</span>
            </td>
            <td style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>যাচাইকারী
            </td>
        </tr>

    </table>


    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;">
        <tr>
            <td style="border-bottom: 2px dotted;">

            </td>
        </tr>
    </table>
</div>
<br/>
<br/>

<!----------------second part----------------->

<table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
    <tr>
        <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}"
                                                         height="80px" width="80px"/></td>

        <td style="text-align:center;">
            <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

            <br/>

            <font style="font-size:16px; font-weight:bold;">
                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                -{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                /* মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, */
                 ই-মেইলঃ {{ $union->email }} <br>
                ওয়েব সাইট : {{ request()->getHost() }}<br>
                ( গ্রাহক কপি)
            </font>

        </td>

        <td style="width:1.2in; text-align:left;">

            @if($union->brand_logo != '')
                <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px"
                     style="position:relative;right:10px;"/>
            @endif

        </td>

    </tr>
</table>

<div class="jolchap second_part">

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:10px auto;">


        <tr>
            <td style="padding-left: 50px;width: 150px;"><b>সদস্য নং </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data->member_id }}</font>
            </td>

            <td align='right'><b> সদস্য নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data->name  }} </font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ঠিকানা</b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $data->permanent_village_en }} </font>
            </td>
        </tr>

        <tr>
            <td style="padding-left: 50px"><b>ইনভয়েস নং</b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->invoice_id) }}</font>
            </td>
            <td align='right'><b>অর্থ বছর</b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data->year_id) }}</font>
            </td>
        </tr>
    </table>


    <table border="1" width="95%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">

        <tr>
            <td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
            <td height='22' style="width:60%;text-align:center;font-size:12px;"><font> বিস্তারিত </font></td>
            <td height='22' style="text-align:center;font-size:12px;"><font>  </font></td>
            <td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা)</td>
        </tr>

        <tr style="height: 100px">
            <td align="center">১</td>

            <td height="100" style="border: 1px solid black;padding-left:10px;">সমিতির টাকা কালেকশান বাবদ ফি<br>{{  $data->month_name  }}
            </td>

            <td align="center"> {{ BanglaConverter::bn_number($data->chanda_amount)  }} x  @php $month_ids_array = explode(",",
            $data->month_ids); @endphp {{ BanglaConverter::bn_number(count($month_ids_array)) }}
            </td>

            <td style="border: 1px solid black;text-align:right;padding-right:10px;">{{ BanglaConverter::bn_number($data->total_amount) }}</td>
        </tr>


        <tr>
            <td colspan='3' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান &nbsp;&nbsp;</td>
            <td height='23'
                style="text-align:right;padding-right:20px; font-size:12px;"> {{ BanglaConverter::bn_number($data->total_amount) }} টাকা।
            </td>
        </tr>

    </table>

    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:60px 0px auto;">

        <tr>
            <td style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>আদায়কারী
            </td>
            <td style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                <span style="border-top: 1px dotted;">সীল</span>
            </td>
            <td style="text-align:center; font-weight:normal; font-size:14px; color:black;">
                <span style="border-top: 1px dotted;">স্বাক্ষর</span><br/>যাচাইকারী
            </td>
        </tr>

    </table>


    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:2px auto;">
        <tr>
            <td style="border-bottom: 2px dotted;">

            </td>
        </tr>
    </table>


</div>
</body>
