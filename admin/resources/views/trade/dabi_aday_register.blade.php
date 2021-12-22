<html>
<head>
    <base href=''/>
    <meta charset="utf-8">
    <title>ট্রেড দাবী আদায় রেজিষ্টার</title>

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <style type="text/css" media="all">


        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 10px;
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
            margin-top: 50px;
        }


        @media print {
            body {
                font-size: 10px !important;
                font-family: 'bangla', sans-serif !important;
            }

        }

    </style>

</head>

<body>
<htmlpageheader name="collectionHeader">
    <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 20px">
        <tr>
            <td style="width:1.5in; text-align:center;">
                <img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px"/>
            </td>

            <td style="text-align:center;">
                <font style="font-size:23px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                <br/>

                <font style="font-size:15px; font-weight:bold;">
                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}
                    -{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                    {{-- মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, --}}
                     ই-মেইল : {{ $union->email }} <br>
                    {{-- ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}</font> --}}
                    ওয়েব সাইট : {{ request()->getHost() }}</font>

            </td>

            <td style="width:1.2in; text-align:left;">
                @if($union->brand_logo != '')
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px"style="position:relative;right:10px;"/>
                @endif
            </td>
        </tr>
    </table>

    <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:center;font-size:20px;font-weight:bold;">
                <font style="">
                    <u>ট্রেড দাবী আদায় রেজিষ্টার</u>
                </font>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;text-align:center;font-size:20px;font-weight:bold;">
                <p>অর্থবছর {{ BanglaConverter::bn_number($fiscal_year_info->name) }}</p>
            </td>
        </tr>

        <tr>
            @if(isset($union->from_date) && isset($union->to_date) )
                <td style="text-align:center;font-size:18px;font-weight:bold;padding-bottom: 5px">
                    {{ BanglaConverter::bn_number($fiscal_year_info->name) }} অর্থবছর q
                </td>
            @endif
        </tr>
    </table>

    @if(isset($fiscal_year) && !empty($fiscal_year))
        <div style="margin-left: 20px;margin-bottom: 10px" >অর্থবছর q: {{ BanglaConverter::bn_number($fiscal_year) }}</div>
    @endif

</htmlpageheader>

<table class="jolchap"  align="center" border="1" width='98%' cellspacing="0" cellspacing='0'
       style="border-collapse:collapse;margin:0 auto;table-layout:fixed; font-size:12px; text-align: justify;text-align:center;">

    <tr>
        <td style="text-align: center; " rowspan="3" width="3%">নং</td>
        <td style="text-align: center; " rowspan="3" width="13%">লাইসেন্স নং</td>
        <td style="text-align: center; " rowspan="3" width="7%">ব্যবসা প্রতিষ্ঠানের নাম</td>
        <td style="text-align: center; " colspan="12" width="27%">দাবী</td>
        <td style="text-align: center; " colspan="12"  width="27%">আদায়</td>
        <td style="text-align: center; " colspan="12" width="23%">আদায়যোগ্য</td>
    </tr>
    <tr>
        {{-- <td align="center" style=""> বকেয়া </td> --}}
        <td align="center" style="" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="" colspan="2"> সাইনবোর্ড</td>
        <td align="center" style="" colspan="2"> উৎসে কর </td>
        <td align="center" style="" colspan="2">সারচার্জ</td>
        <td align="center" style="" rowspan="2"> বিবিধ </td>
        <td align="center" style="" rowspan="2"> মোট </td>


        <td align="center" style="" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="" colspan="2"> সাইনবোর্ড</td>
        <td align="center" style="" colspan="2"> উৎসে কর </td>
        <td align="center" style="" colspan="2">সারচার্জ</td>
        <td align="center" style="" rowspan="2"> বিবিধ </td>
        <td align="center" style="" rowspan="2"> মোট </td>


        <td align="center" style="" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="" colspan="2"> সাইনবোর্ড</td>
        <td align="center" style="" colspan="2"> উৎসে কর </td>
        <td align="center" style="" colspan="2">সারচার্জ</td>
        <td align="center" style="" rowspan="2"> বিবিধ </td>
        <td align="center" style="" rowspan="2"> মোট </td>

    </tr>

    <tr>
        {{-- charge --}}
        <td align="center" style="height:50px;transform: rotate(-55deg)">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

       <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>


        {{-- Collection --}}

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

       <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>


        {{-- Dueable --}}

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

       <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>

        <td align="center" style="transform: rotate(-55deg);">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);">হাল</td>
    </tr>

    <?php

        $sr = 1;

        // dabi
        $total_dabi_fee = 0;
        $total_dabi_fee_due = 0;

        $total_dabi_vat = 0;
        $total_dabi_vat_due = 0;

        $total_dabi_sign = 0;
        $total_dabi_sign_due = 0;

        $total_dabi_source = 0;
        $total_dabi_source_due = 0;

        $total_dabi_sarcharge = 0;
        $total_dabi_sarcharge_due = 0;

        $total_dabi_bibidh = 0;
        $total_dabi = 0;

        // collection
        $total_collect_fee = 0;
        $total_collect_fee_due = 0;

        $total_collect_vat = 0;
        $total_collect_vat_due = 0;

        $total_collect_sign = 0;
        $total_collect_sign_due = 0;

        $total_collect_source = 0;
        $total_collect_source_due = 0;

        $total_collect_sarcharge = 0;
        $total_collect_sarcharge_due = 0;

        $total_collect_bibidh = 0;
        $total_collect = 0;

        // collection
        $total_dueable_fee = 0;
        $total_dueable_fee_due = 0;

        $total_dueable_vat = 0;
        $total_dueable_vat_due = 0;

        $total_dueable_sign = 0;
        $total_dueable_sign_due = 0;

        $total_dueable_source = 0;
        $total_dueable_source_due = 0;

        $total_dueable_sarcharge = 0;
        $total_dueable_sarcharge_due = 0;

        $total_dueable_bibidh = 0;
        $total_dueable = 0;

        foreach ($data as  $row) :

            // dabi
            $total_dabi_fee += $row['fee'];
            $total_dabi_fee_due += $row['trade_due'];

            $total_dabi_vat += $row['vat'];
            $total_dabi_vat_due += $row['vat_due'];

            $total_dabi_sign += $row['signbord_vat'];
            $total_dabi_sign_due += $row['signbord_vat_due'];

            $total_dabi_source += $row['source_vat'];
            $total_dabi_source_due += $row['source_vat_due'];

            $total_dabi_sarcharge += $row['sarcharge'];
            $total_dabi_sarcharge_due += $row['sarcharge_due'];

            $total_dabi_bibidh += $row['bibidh'];

            $total_dabi += ($row['fee'] + $row['trade_due'] + $row['vat'] +
                             $row['vat_due'] + $row['signbord_vat'] +
                             $row['signbord_vat_due'] + $row['source_vat'] +
                             $row['source_vat_due'] + $row['sarcharge'] +
                             $row['sarcharge_due'] + $row['bibidh']);

    ?>

    <tr>
        <td style="text-align: center;">
            <?php echo BanglaConverter::bn_number($sr++) ?>
        </td>

        <td style="text-align: center;" style="font-size:7px;">
            <?php echo BanglaConverter::bn_number($row['sonod_no']) ?>
        </td>

        <td height="50px"><?php echo $row['organization_name']?></td>




        {{-- charge --}}

        <td align="center" style=" transform: rotate(-55deg);">
            <?php
                echo BanglaConverter::bn_number( (int) $row['trade_due']);
            ?>
        </td>

        <td align="center" style=" transform: rotate(-55deg);" style=" transform: rotate(-55deg);">
            <?php
                echo BanglaConverter::bn_number( (int) $row['fee']);
            ?>
        </td>


        <td align="center" style=" transform: rotate(-55deg);"><?php echo BanglaConverter::bn_number( (int) $row['vat_due']);
            ?></td>

        <td align="center" style=" transform: rotate(-55deg);"><?php echo BanglaConverter::bn_number( (int) $row['vat']);
        ?></td>


        <td align="center" style=" transform: rotate(-55deg);"><?php
            echo BanglaConverter::bn_number( (int) $row['signbord_vat_due']);
            ?></td>

        <td align="center" style=" transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['signbord_vat']);
        ?></td>

        <td align="center" style=" transform: rotate(-55deg);"><?php
            echo BanglaConverter::bn_number( (int) $row['source_vat_due']);
            ?></td>

        <td align="center" style=" transform: rotate(-55deg);"><?php
         echo BanglaConverter::bn_number( (int) $row['source_vat']);
          ?></td>


        <td align="center" style=" transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['sarcharge_due']);
        ?></td>

        <td align="center" style=" transform: rotate(-55deg);"><?php
            echo BanglaConverter::bn_number( (int) $row['sarcharge']);
            ?></td>


        <td align="center" style=" transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['bibidh']);
                ?></td>

        <td align="center" style=" transform: rotate(-55deg);">
            <?php
                echo BanglaConverter::bn_number( (int) $row['total']);
            ?>
        </td>

        {{-- charge end --}}


        {{-- collection --}}

        @if($row['is_paid'] == 1)

            @php
                // collection
                $total_collect_fee += $row['fee'];
                $total_collect_fee_due += $row['trade_due'];

                $total_collect_vat += $row['vat'];
                $total_collect_vat_due += $row['vat_due'];

                $total_collect_sign += $row['signbord_vat'];
                $total_collect_sign_due += $row['signbord_vat_due'];

                $total_collect_source += $row['source_vat'];
                $total_collect_source_due += $row['source_vat_due'];

                $total_collect_sarcharge += $row['sarcharge'];
                $total_collect_sarcharge_due += $row['sarcharge_due'];

                $total_collect_bibidh += $row['bibidh'];

                $total_collect += ($row['fee'] + $row['trade_due'] + $row['vat'] +
                                $row['vat_due'] + $row['signbord_vat'] +
                                $row['signbord_vat_due'] + $row['source_vat'] +
                                $row['source_vat_due'] + $row['sarcharge'] +
                                $row['sarcharge_due'] + $row['bibidh']);
            @endphp

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['trade_due']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['fee']);
                ?>
            </td>


            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['vat_due']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                     echo BanglaConverter::bn_number( (int) $row['vat']);
                ?>
            </td>


            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['signbord_vat_due']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['signbord_vat']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['source_vat_due']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['source_vat']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['sarcharge_due']);
                ?>
            </td>

            <td align="center" style="transform: rotate(-55deg);">
                <?php
                echo BanglaConverter::bn_number( (int) $row['sarcharge']);
                ?>
            </td>


            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['bibidh']);
                    ?>
            </td>


            <td align="center" style="transform: rotate(-55deg);">
                <?php
                    echo BanglaConverter::bn_number( (int) $row['total']);
                ?>
            </td>



        @else
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
        @endif

        {{-- collection end --}}

        {{-- rest of --}}
        @if($row['is_paid'] == 0)

        <td align="center" style="transform: rotate(-55deg);">
            <?php
                echo BanglaConverter::bn_number( (int) $row['trade_due']);
            ?>
        </td>
        <td align="center" style="transform: rotate(-55deg);">
            <?php
                echo BanglaConverter::bn_number( (int) $row['fee']);
            ?>
        </td>


        <td align="center" style="transform: rotate(-55deg);"><?php echo BanglaConverter::bn_number( (int) $row['vat_due']);
            ?></td>

        <td align="center" style="transform: rotate(-55deg);"><?php echo BanglaConverter::bn_number( (int) $row['vat']);
        ?></td>


        <td align="center" style="transform: rotate(-55deg);"><?php
            echo BanglaConverter::bn_number( (int) $row['signbord_vat_due']);
            ?></td>

        <td align="center" style="transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['signbord_vat']);
        ?></td>

        <td align="center" style="transform: rotate(-55deg);"><?php
            echo BanglaConverter::bn_number( (int) $row['source_vat_due']);
            ?></td>

        <td align="center" style="transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['source_vat']);
        ?></td>


        <td align="center" style="transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['sarcharge_due']);
        ?></td>

        <td align="center" style="transform: rotate(-55deg);"><?php
            echo BanglaConverter::bn_number( (int) $row['sarcharge']);
            ?></td>


        <td align="center" style="transform: rotate(-55deg);"><?php
        echo BanglaConverter::bn_number( (int) $row['bibidh']);
                ?></td>

        <td align="center" style="transform: rotate(-55deg);">
            <?php
                echo BanglaConverter::bn_number( (int) $row['total']);
            ?>
        </td>

        @else
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
            <td align="center">০</td>
        @endif

    </tr>

    <?php endforeach; ?>

</table>
        <?php
            $total_dabi_due = $total_dabi_fee_due + $total_dabi_vat_due + $total_dabi_sign_due + $total_dabi_source_due + $total_dabi_sarcharge_due + $total_dabi_bibidh;

            $total_dabi_hal = $total_dabi_fee + $total_dabi_vat + $total_dabi_sign + $total_dabi_source + $total_dabi_sarcharge ;

            // $total_dabi = $total_dabi_due + $total_dabi_hal;


            $total_collect_due = $total_collect_fee_due + $total_collect_vat_due + $total_collect_sign_due + $total_collect_source_due + $total_collect_sarcharge_due ;

            $total_collect_hal = $total_collect_fee + $total_collect_vat + $total_collect_sign + $total_collect_source + $total_collect_sarcharge + $total_collect_bibidh ;

            // $total_collect = $total_collect_due + $total_collect_hal;
        ?>
            <br>
            <br>

    <h1 style="text-align:center;">একনজরে <span style="color:red;">({{ BanglaConverter::bn_number($fiscal_year_info->name) }})</span> ইং অর্থবছর দাবী, আদায় এবং আদায়ের হার:-
    </h1>

<table align="center"border="1" width='98%' style=" border-collapse:collapse;margin:0 auto;table-layout:fixed;font-size:10px;">

    <tr>
        <td style="text-align: center;font-size:15px;" rowspan="3" width="6%">অর্থবছর</td>
        <td style="text-align: center;font-size:15px;" rowspan="3" width="5%">মোট লাইসেন্স সংখ্যা</td>
        <td style="text-align: center;font-size:15px;" rowspan="3" width="5%">নবায়ন কৃত লাইসেন্স সংখ্যা</td>
        <td style="text-align: center;font-size:15px;" colspan="12" width="22%">মোট দাবী</td>
        {{-- <td style="text-align: center;" rowspan="2" width="5%">ছাড়</td> --}}
        {{-- <td style="text-align: center;" colspan="2"  width="10%"   >ভ্যাট(১৫%)</td> --}}
        <td style="text-align: center;font-size:15px;" colspan="12"  width="22%">মোট আদায়</td>
        <td style="text-align: center;font-size:15px;" colspan="12"  width="20%">আদায়ের হার(%)</td>
        <td style="text-align: center;font-size:15px;" colspan="12" width="21%">আদায়যোগ্য</td>
        {{-- <td style="text-align: center;" colspan="2 " width="10%"  >সার চার্জ</td>
        <td style="text-align: center;" rowspan="2"  width="10%"  >মোট টাকা</td> --}}
    </tr>
    <tr>
        {{-- <td align="center" style=""> বকেয়া </td> --}}
        <td align="center" style="font-size:13px;" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="font-size:13px;" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="font-size:13px;" colspan="2"> সাইন বোর্ড</td>
        <td align="center" style="font-size:13px;" colspan="2"> উৎসে কর </td>
        <td align="center" style="font-size:13px;" colspan="2">সার চার্জ</td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> বিবিধ </td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> মোট </td>


        <td align="center" style="font-size:13px;" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="font-size:13px;" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="font-size:13px;" colspan="2"> সাইন বোর্ড</td>
        <td align="center" style="font-size:13px;" colspan="2"> উৎসে কর </td>
        <td align="center" style="font-size:13px;" colspan="2">সার চার্জ</td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> বিবিধ </td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> মোট </td>


        <td align="center" style="font-size:13px;" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="font-size:13px;" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="font-size:13px;" colspan="2"> সাইন বোর্ড</td>
        <td align="center" style="font-size:13px;" colspan="2"> উৎসে কর </td>
        <td align="center" style="font-size:13px;" colspan="2">সার চার্জ</td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> বিবিধ </td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> মোট </td>

        {{-- parcentage --}}
        <td align="center" style="font-size:13px;" colspan="2"> লাইসেন্স ফি</td>
        <td align="center" style="font-size:13px;" colspan="2"> ভ্যাট ১৫% </td>
        <td align="center" style="font-size:13px;" colspan="2"> সাইন বোর্ড</td>
        <td align="center" style="font-size:13px;" colspan="2"> উৎসে কর </td>
        <td align="center" style="font-size:13px;" colspan="2">সার চার্জ</td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> বিবিধ </td>
        <td align="center" style="font-size:13px;transform: rotate(-65deg)" rowspan="2"> মোট </td>

    </tr>

    <tr>
        {{-- charge --}}
        <td align="center" style="height:50px;padding:5px;transform: rotate(-55deg)"font-size:12px;>বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

       <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>


        {{-- Collection --}}

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

       <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>


        {{-- parcentage --}}

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

       <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>


        {{-- Dueable --}}

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

       <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>

        <td align="center" style="transform: rotate(-55deg);font-size:12px;">বকেয়া</td>
        <td align="center" style="transform: rotate(-55deg);font-size:12px;">হাল</td>
    </tr>
    {{-- <tr>
        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>মোট </b> </td>

        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>মোট </b> </td>

        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>মোট </b> </td>

        <td align="center"> <b>বকেয়া </b> </td>
        <td align="center"> <b>হাল </b> </td>
        <td align="center"> <b>মোট</b> </td>
    </tr> --}}

    <tr>
        <td style="height:80px;" align="center"><b style="text-align:center; font-size:13px;">{{ BanglaConverter::bn_number($fiscal_year_info->name) }}</b></td>
        <td align="center" style="text-align:center; font-size:13px;">{{ BanglaConverter::bn_number(count($data))  }}</td>
        <td align="center" style="text-align:center; font-size:13px;">{{ BanglaConverter::bn_number($nobayon_license) }}</td>
        {{-- charge start --}}
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_fee_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_fee) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_vat_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_vat) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_sign_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_sign) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_source_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_source) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_sarcharge_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_sarcharge) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi_bibidh) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_dabi) }}
        </td>

        {{-- Charge end --}}


        {{-- Collecttion --}}

        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_fee_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_fee) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_vat_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_vat) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_sign_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_sign) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_source_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_source) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_sarcharge_due) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_sarcharge) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect_bibidh) }}
        </td>
        <td style="transform:rotate(-90deg);text-indent:-10px;">
            {{ BanglaConverter::bn_number($total_collect) }}
        </td>
        {{-- collection end --}}


        {{-- Collection Parcentage start --}}
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_fee_due > 0) ? round((($total_collect_fee_due / $total_dabi_fee_due)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_fee > 0) ? round((($total_collect_fee / $total_dabi_fee)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_vat_due > 0) ? round((($total_collect_vat_due / $total_dabi_vat_due)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_vat > 0) ? round((($total_collect_vat  / $total_dabi_vat)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_sign_due > 0) ? round((($total_collect_sign_due  / $total_dabi_sign_due)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_sign > 0) ? round((($total_collect_sign  / $total_dabi_sign)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_source_due > 0) ? round((($total_collect_source_due / $total_dabi_source_due)*100),2) : 0 )."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_source > 0) ? round((($total_collect_source / $total_dabi_source)*100),2) :0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_sarcharge_due > 0) ? round((($total_collect_sarcharge_due / $total_dabi_sarcharge_due)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_sarcharge > 0) ? round((($total_collect_sarcharge / $total_dabi_sarcharge)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi_bibidh > 0) ? round((($total_collect_bibidh / $total_dabi_bibidh)*100),2) : 0)."%";
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number(($total_dabi > 0) ? round((($total_collect  / $total_dabi)*100),2) : 0)."%";
            ?>
        </td>
        {{-- parcentage end --}}

        {{-- dueable start --}}

        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_fee_due-$total_collect_fee_due);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_fee-$total_collect_fee);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_vat_due-$total_collect_vat_due);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_vat-$total_collect_vat);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_sign_due - $total_collect_sign_due);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_sign - $total_collect_sign);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_source_due -$total_collect_source_due);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_source -$total_collect_source);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_sarcharge_due-$total_collect_sarcharge_due);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_sarcharge-$total_collect_sarcharge);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi_bibidh-$total_collect_bibidh);
            ?>
        </td>
        <td style="transform: rotate(-90deg);text-indent:-10px;">
            <?php
                echo BanglaConverter::bn_number($total_dabi -$total_collect);
            ?>
        </td>

        {{-- dueable end --}}
    </tr>

</table>


<table border='0' width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
    <tr>
            {{-- @if ($print_setting->sochib) --}}
            <td style="padding-left:150px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;লাইসেন্স পরিদর্শক&nbsp;&nbsp;&nbsp;&nbsp;</font>
                 {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp; --}}
            </td>
            {{-- @endif --}}

            {{-- @if ($print_setting->member) --}}
            <td style="padding-left:150px;font-size:15px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;</font>
                 {{-- <br> &nbsp;&nbsp;&nbsp;&nbsp;প্রস্তুতকারী&nbsp;&nbsp;&nbsp;&nbsp; --}}
            </td>
            {{-- @endif --}}

            {{-- @if ($print_setting->chairman) --}}
            <td style="padding-left:150px; font-size:15px; height: 100px; vertical-align: bottom;">
                <font style='border-top: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;মেয়র&nbsp;&nbsp;&nbsp;&nbsp;</font>
            </td>
            {{-- @endif --}}
        </tr>
</table>

<br><br><br>

<table border='0' width="99%" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;">

    <tr>
        <td style="width: 30%;text-align:center;">
            <font style="font-size:11px">Website </font>
            <span></span>
            <font style="font-size:11px;"> : www.sirajpouro.org</font>
        </td>

        <td style="width: 30%;text-align:center;padding-left: 40px">

        <font style="font-size:10px;opacity:0.7;">Developed by Innovation IT. </font>

        <br>

        <font style="font-size:10px;opacity:0.7;">www.innovationit.com.bd   </font></td>
    </tr>
</table>


</body>

</html>
