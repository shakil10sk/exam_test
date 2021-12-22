<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>বসতভিটা কর রেজিষ্টার</title>
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
        				{{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ BanglaConverter::bn_others($union->postal_code) }}<br>
                        {{-- মোবাইলঃ{{ BanglaConverter::bn_others($union->mobile) }}, --}}
                         ই-মেইলঃ {{ $union->email }} <br>
        				{{-- ওয়েব সাইট : {{ $union->sub_domain.request()->getHost() }}</font> --}}
        				ওয়েব সাইট : {{ request()->getHost() }}</font>

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
                        <u>বসতভিটা কর রেজিষ্টার</u>
                    </font>
                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:18px;font-weight:bold;padding-bottom: 5px">
                   {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($union->from_date))) }} হতে {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($union->to_date))) }} পর্যন্ত
                </td>
            </tr>


        </table>


    <table class="jolchap" align="center" border="1"  width='95%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">

      <tr>
          <td style="text-align: center;width: 5%;">নং</td>
          <td style="">তারিখ</td>
          <td style="">নাম</td>
          {{-- <td style="">পিতা</td> --}}
          <td style="">গ্রাম</td>
          <td style="">ওয়ার্ড</td>
          <td style="">হোল্ডিং</td>
          <td style="">কর</td>
          <td style="">বকেয়া</td>
          <td style="">ছাড়</td>
          <td style="">মোট</td>
      </tr>

      @php
       $i = 1;
       $kor = 0;
       $due = 0;
       $discount = 0;
       $total = 0;
      @endphp

      @foreach($data as $item)

      <tr>
          <td>{{ BanglaConverter::bn_number($i++) }}</td>

          <td>{{ BanglaConverter::bn_others(date('d-m-Y', strtotime($item["created_time"]))) }}</td>

          <td>{{ $item["name_bn"] }}</td>
          {{-- <td>{{ $item["father_name_bn"] }}</td> --}}
          <td>{{ $item["permanent_village_bn"] }}</td>

          <td>{{ BanglaConverter::bn_number($item["permanent_ward_no"]) }}</td>

          <td>{{ BanglaConverter::bn_number($item["permanent_holding_no"]) }}</td>

          <td><?php $kor += $item["kor"];  echo BanglaConverter::bn_number(number_format($item["kor"])); ?></td>

          <td><?php $due += $item["due"];  echo BanglaConverter::bn_number(number_format($item["due"])); ?></td>

          <td><?php $discount += $item["discount"];  echo BanglaConverter::bn_number(number_format($item["discount"])); ?></td>

          <td><?php $total += ($item['kor']+$item['due'])-$item['discount'];  echo BanglaConverter::bn_number(number_format($item['kor']+$item['due']-$item['discount'])); ?></td>
      </tr>
      @endforeach
      <tr>
          <td colspan='6' style="text-align: right;">মোট &nbsp;</td>
          <td>{{ BanglaConverter::bn_number($kor) }}</td>
          <td>{{ BanglaConverter::bn_number($due) }}</td>
          <td>{{ BanglaConverter::bn_number($discount) }}</td>
          <td>{{ BanglaConverter::bn_number($total) }}</td>
      </tr>


    </table>



</body>

</html>
