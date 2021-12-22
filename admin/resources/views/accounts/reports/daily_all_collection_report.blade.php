<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>দৈনিক কালেকশন হিসাব</title>
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
            margin: 20px 0px;
            padding: 0px;

        }

        @page{
            header: collectionHeader;
            margin-top: 200px;
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

<htmlpageheader name="collectionHeader">
    <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
        <tr>
            <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}"
                                                             height="80px" width="80px"/></td>

            <td style="text-align:center;">
                <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br/>

                <font style="font-size:16px; font-weight:bold;">
                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                    -{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                    {{-- মোবাইলঃ{{ BanglaConverter::bn_others($union->mobile) }}, --}}
                     ই-মেইলঃ {{ $union->email }} <br>
                    ওয়েব সাইট : {{ request()->getHost() }}</font>

            </td>

            <td style="width:1.2in; text-align:left;">
                @if($union->brand_logo != '')
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px"
                         style="position:relative;right:10px;"/>
                @endif
            </td>

        </tr>
    </table>


    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
           cellpadding="0" cellspacing="0">

        <tr>
            <td style="text-align:center;font-size:20px;font-weight:bold;padding-bottom: 10px">
                <font style="">
                    <u>দৈনিক কালেকশন হিসাব</u>
                </font>
            </td>
        </tr>

        <tr>
            <td style="text-align:center;font-size:14px;font-weight:bold;padding-bottom: 5px">
                {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($union->from_date))) }}
                হতে {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($union->to_date))) }} পর্যন্ত
            </td>
        </tr>


    </table>
</htmlpageheader>




<table class="jolchap" align="center" border="1" width='95%' cellspacing="0" cellspacing='0'
       style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 60px; margin-left: 60px "  >

    <tr>
        <td style="text-align: center;">নং</td>

        <td style="text-align: center;">তারিখ</td>

        <td style="text-align: center;">ভাউচার</td>

        <td style="text-align: center;">বর্ণনা</td>

        <td style="text-align: center;">টাকা</td>


    </tr>


    <?php



    $sr = 1;

    $total = 0;

    $pageWiseTotalAmount = 0;

    foreach ($data as $key => $row) : ?>


    <tr>
        <td><?php  echo BanglaConverter::bn_number($sr++) ?></td>

        <td><?php echo BanglaConverter::bn_others(date('d-m-Y', strtotime($row->payment_date))) ?></td>

        <td><?php echo BanglaConverter::bn_others($row->voucher) ?></td>

        <td><?php echo $row->account_name . ' #SN- ' . BanglaConverter::bn_others( $row->sonod_no) ?></td>

        <td align="right" ><?php echo BanglaConverter::bn_number(number_format($row->amount,2)); $total += $row->amount; ?></td>



    </tr>

    @php $pageWiseTotalAmount += $row->amount;  @endphp

    @if(($key+1) % 41 == 0 || count($data) == $key +1  )
        <tr>
            <td colspan='4' style="text-align: right;">মোট &nbsp;</td>

            <td align="right" >{{ BanglaConverter::bn_number( number_format($pageWiseTotalAmount,2) ) }}</td>

        </tr>
        @php  $pageWiseTotalAmount = 0; @endphp
    @endif


    @if(($key+1) % 41 == 0 && count($data) > $key  )


        <tr>
            <td style="text-align: center;">নং</td>

            <td style="text-align: center;">তারিখ</td>

            <td style="text-align: center;">ভাউচার</td>

            <td style="text-align: center;">বর্ণনা</td>

            <td style="text-align: center;">টাকা</td>


        </tr>


    @endif




    <?php endforeach;?>

    <tr>
        <td colspan='4' align="right" style="text-align: right;"> সর্বমোট &nbsp;</td>

        <td  align="right" >{{ BanglaConverter::bn_number(number_format($total,2)) }}</td>
    </tr>


</table>

</body>

</html>
