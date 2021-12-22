<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>ট্রেড লাইসেন্স রেজিষ্টার</title>
    <style type="text/css" media="all">

        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 11px;
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
            <td style="width:1.5in; text-align:center;">
                <img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px"/>
            </td>

            <td style="text-align:center;">
                <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br/>

                <font style="font-size:16px; font-weight:bold;">
                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                    -{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                    {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, --}}
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
                    <u>ট্রেড লাইসেন্স রেজিষ্টার</u>
                </font>
            </td>
        </tr>

        <tr>
            @if(isset($union->from_date) && isset($union->to_date) )
                <td style="text-align:center;font-size:18px;font-weight:bold;padding-bottom: 5px">
                    {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($union->from_date))) }}
                    হতে {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($union->to_date))) }} পর্যন্ত
                </td>
            @endif
        </tr>


    </table>
    @if(isset($fiscal_year) && !empty($fiscal_year))
        <div style="margin-left: 20px;margin-bottom: 10px" >অর্থবছর : {{ BanglaConverter::bn_number($fiscal_year) }}</div>
    @endif
</htmlpageheader>






<table class="jolchap" align="center" border="1" width='95%' cellspacing="0" cellspacing='0'
       style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">

    <tr>
        <td style="text-align: center;" rowspan="2" width="5%"  >নং</td>
        <td style="text-align: center;" rowspan="2" width="8%"  >তারিখ</td>
        <td style="text-align: center;" rowspan="2" width="17%"  >প্রতিষ্ঠানের নাম</td>
        <td style="text-align: center;" colspan="2" width="10%"  >লাইসেন্স ফি</td>
        <td style="text-align: center;" rowspan="2" width="5%"  >ছাড়</td>
        <td style="text-align: center;" colspan="2"  width="10%"   >ভ্যাট(১৫%)</td>
        <td style="text-align: center;" colspan="2"  width="10%"  >সাইনবোর্ড কর</td>
        <td style="text-align: center;" colspan="2" width="10%"  >উৎসের কর</td>
        <td style="text-align: center;" colspan="2 " width="10%"  >সার চার্জ</td>
        <td style="text-align: center;" rowspan="2"  width="10%"  >মোট টাকা</td>
    </tr>
    <tr>
        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
    </tr>
    <?php

    $sr = 1;
    $key = 0;

    $fees = 0; $dues = 0; $discounts = 0; $vats = 0; $signbords = 0; $source_vat = 0; $sarcharges = 0;$totals = 0;
    $feesDue = 0;   $vatsDue = 0; $signbordsDue = 0; $source_vatDue = 0; $sarchargesDue = 0;$totals = 0;



    $pageWiseFees = 0;$pageWiseFeesDue = 0; $pageWiseDues = 0; $pageWiseDiscounts = 0; $pageWiseVats = 0;
    $pageWiseVatsDue = 0; $pageWiseSingbordsDue = 0; $pageWiseSourceVatDue = 0; $pageWiseSarchargesDue = 0;
    $pageWiseSingbords = 0;
    $pageWiseSourceVat = 0; $pageWiseSarcharges = 0;$pageWiseTotalAmounts = 0;


    foreach ($data as  $row) :

    ++$key;


    $pageWiseFees += $row['fee'];
    $pageWiseFeesDue += $row['trade_due'];
    $pageWiseDiscounts += $row['discount'];
    $pageWiseVatsDue += $row['vat_due'];
    $pageWiseVats += $row['vat'];
    $pageWiseSingbordsDue += $row['signbord_vat_due'];
    $pageWiseSingbords += $row['signbord_vat'];
    $pageWiseSourceVatDue += $row['source_vat_due'];
    $pageWiseSourceVat += $row['source_vat'];
    $pageWiseSarchargesDue += $row['sarcharge_due'];
    $pageWiseSarcharges += $row['sarcharge'];
//    $pageWiseTotalAmounts += ($pageWiseFees + $pageWiseFeesDue  + $pageWiseVatsDue +  $pageWiseVats +
//    $pageWiseSingbords  + $pageWiseSingbordsDue +  $pageWiseSourceVatDue +  $pageWiseSarchargesDue + $pageWiseSourceVat
//            + $pageWiseSarcharges) - $pageWiseDiscounts;



    ?>

    <tr>
        <td style="text-align: center;">
            <?php echo BanglaConverter::bn_number($sr++) ?>
        </td>

        <td style="text-align: center;">
            <?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($row['payment_date']))) ?>
        </td>

        <td height="50px" ><?php echo $row['organization_name']?></td>

        <td align="right"><?php echo BanglaConverter::bn_number((int) $row['trade_due']); $feesDue += $row['trade_due'];
        ?></td>
        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['fee']); $fees += $row['fee']; ?></td>


        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['discount']); $discounts += $row['discount'];
        ?></td>

        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['vat_due']); $vatsDue += $row['vat_due']; ?></td>
        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['vat']); $vats += $row['vat']; ?></td>


        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['signbord_vat_due']); $signbordsDue +=
                $row['signbord_vat_due']; ?></td>
        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['signbord_vat']); $signbords +=
                $row['signbord_vat']; ?></td>


        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['source_vat_due']); $source_vatDue +=
                $row['source_vat_due']; ?></td>
        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['source_vat']); $source_vat +=
                $row['source_vat']; ?></td>

        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['sarcharge_due']); $sarchargesDue +=
                $row['sarcharge_due']; ?></td>
        <td align="right"><?php echo BanglaConverter::bn_number( (int) $row['sarcharge']); $sarcharges +=
                $row['sarcharge']; ?></td>


        <td align="right"><?php $total = ($row['fee'] + $row['trade_due'] + $row['due'] + $row['vat'] +
                    $row['vat_due'] +
                    $row['signbord_vat']  + $row['signbord_vat_due'] +
                    $row['source_vat'] + $row['source_vat_due'] + $row['sarcharge'] + $row['sarcharge_due'] ) - $row['discount']; echo
            BanglaConverter::bn_number
            (number_format($total));
            $pageWiseTotalAmounts += $total;
                      ?></td>

    @if($key % 10 == 0 || count($data) == $key   )
        <tr>
            <td colspan='3' style="text-align: right;">মোট &nbsp;</td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseFeesDue));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseFees));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseDiscounts));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseVatsDue));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseVats));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseSingbordsDue));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseSingbords));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseSourceVatDue));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseSourceVat));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseSarchargesDue));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseSarcharges));?></td>
            <td align="right" ><?php echo BanglaConverter::bn_number(number_format($pageWiseTotalAmounts));?></td>

        </tr>
        @php  $pageWiseFees = 0;$pageWiseFeesDue = 0; $pageWiseDues = 0; $pageWiseDiscounts = 0; $pageWiseVats = 0;
    $pageWiseVatsDue = 0; $pageWiseSingbordsDue = 0; $pageWiseSourceVatDue = 0; $pageWiseSarchargesDue = 0;
    $pageWiseSingbords = 0;
    $pageWiseSourceVat = 0; $pageWiseSarcharges = 0;$pageWiseTotalAmounts = 0; @endphp
    @endif


    @if($key  % 10 == 0 && count($data) != $key+1  )
        <tr>
            <td style="text-align: center;" rowspan="2" width="5%"  >নং</td>
            <td style="text-align: center;" rowspan="2" width="8%"  >তারিখ</td>
            <td style="text-align: center;" rowspan="2" width="17%"  >প্রতিষ্ঠানের নাম</td>
            <td style="text-align: center;" colspan="2" width="10%"  >লাইসেন্স ফি</td>
            <td style="text-align: center;" rowspan="2" width="5%"  >ছাড়</td>
            <td style="text-align: center;" colspan="2"  width="10%"   >ভ্যাট(১৫%)</td>
            <td style="text-align: center;" colspan="2"  width="10%"  >সাইনবোর্ড কর</td>
            <td style="text-align: center;" colspan="2" width="10%"  >উৎসের কর</td>
            <td style="text-align: center;" colspan="2 " width="10%"  >সার চার্জ</td>
            <td style="text-align: center;" rowspan="2"  width="10%"  >মোট টাকা</td>
        </tr>
        <tr>
            <td align="center"> <b>বকেয়া </b> </td>
            <td align="center"> <b>হাল </b> </td>
            <td align="center"> <b>বকেয়া </b> </td>
            <td align="center"> <b>হাল </b> </td>
            <td align="center"> <b>বকেয়া </b> </td>
            <td align="center"> <b>হাল </b> </td>
            <td align="center"> <b>বকেয়া </b> </td>
            <td align="center"> <b>হাল </b> </td>
            <td align="center"> <b>বকেয়া </b> </td>
            <td align="center"> <b>হাল </b> </td>
        </tr>
        @endif

    </tr>






    <?php endforeach;?>


            <tr>
                <td colspan='3' style="text-align: right;">সর্ব মোট &nbsp;</td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($feesDue));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($fees));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($discounts));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($vatsDue));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($vats));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($signbordsDue));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($signbords));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($source_vatDue));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($source_vat));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($sarchargesDue));?></td>
                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($sarcharges));?></td>

                @php $totals =  ($feesDue +  $fees + $discounts + $vatsDue +  $vats +  $signbordsDue + $signbords +
                $source_vatDue + $source_vat + $sarchargesDue +  $sarcharges);
                @endphp


                <td align="right" ><?php echo BanglaConverter::bn_number(number_format($totals));?></td>

            </tr>








</table>

</body>

</html>
