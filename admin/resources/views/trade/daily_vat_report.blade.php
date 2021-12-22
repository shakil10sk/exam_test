<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>দৈনিক ভ্যাট কালেকশন হিসাব</title>
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
            margin: 20px 0px;
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

        <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;"><img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" /></td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_number($union->postal_code) }}<br>
                        মোবাইলঃ{{ BanglaConverter::bn_number($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}</font>

                </td>

                <td style="width:1.2in; text-align:left;">
                  @if($union->brand_logo != '')
                    <img src="{{ asset('images/union_profile/'.$union->brand_logo) }}" height="80px" width="80px" style="position:relative;right:10px;" />
                  @endif
                </td>

            </tr>
        </table>




        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">

            <tr>
                <td style="text-align:center;font-size:20px;font-weight:bold;padding-bottom: 10px">
                    <font style="">
                        <u>দৈনিক ভ্যাট কালেকশন হিসাব</u>
                    </font>
                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px;font-weight:bold;padding-bottom: 5px">
                   {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($union->from_date))) }} হতে {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($union->to_date))) }} পর্যন্ত
                </td>
            </tr>

        </table>


    <table class="jolchap" align="center" border="1"  width='95%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">

      <tr>
          <td style="text-align: center;">নং</td>

          <td style="text-align: center;">প্রদানের তারিখ</td>

          <td style="text-align: center;">ভাউচার</td>

          <td style="text-align: center;">প্রতিষ্ঠানের নাম</td>

          <td style="text-align: center;">লাইসেন্স ফি</td>

          <td style="text-align: center;">ভ্যাট</td>

      </tr>


    <?php

        $sr = 1;

        $fees = 0;  $discounts = 0; $vats = 0;

       foreach ($data as $row) :
    ?>

      <tr>
          <td><?php  echo BanglaConverter::bn_number($sr++) ?></td>

          <td><?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($row['payment_date']))) ?></td>

          <td><?php echo $row['voucher']?></td>

          <td><?php echo $row['organization_name']?></td>

          <td><?php echo BanglaConverter::bn_number($row['fee']); $fees += $row['fee']; ?></td>


          <td><?php echo BanglaConverter::bn_number($row['vat']); $vats += $row['vat']; ?></td>


      </tr>

    <?php endforeach;?>

      <tr>
          <td colspan='4' style="text-align: right;">মোট &nbsp;</td>
          <td><?php echo BanglaConverter::bn_number($fees);?></td>
          <td><?php echo BanglaConverter::bn_number($vats);?></td>

      </tr>


    </table>

</body>

</html>
