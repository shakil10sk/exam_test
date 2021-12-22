<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>হোল্ডিং {{ $union->payment_type == 1 ? 'ক্যাশ' : ($union->payment_type == 2 ? 'ব্যাংক' : 'অন্যান্য') }} রিপোর্ট</title>
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
            <td style="width:1.5in; text-align:center;">
                <img src="{{ asset('images/union_profile/'.$union->main_logo) }}" height="80px" width="80px" />
            </td>

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
                    <u>হোল্ডিং ট্যাক্স {{ $union->payment_type == 1 ? 'ক্যাশ' : ($union->payment_type == 2 ? 'ব্যাংক' : 'অন্যান্য') }} রিপোর্ট</u>
                </font>
            </td>
        </tr>

        @if($union->ward_no || $union->property_type || $union->owner_type)
            <tr>
                <td style="text-align:center;font-size:20px;font-weight:bold;padding-bottom: 10px">
                    <font style="">
                        <u>
                        {{$union->ward_no > 0 ? 'ওয়ার্ডঃ '.$union->ward_name : ''}}
                        
                        {{$union->property_type > 0 ? 'ভবনের ধরনঃ '.$union->property_name : ''}}

                        {{$union->owner_type > 0 ? 'মালিকানার ধরনঃ '.$union->owner_name : ''}}
                        </u>
                    </font>
                </td>
            </tr>
        @endif

        <tr>
            <td style="text-align:center;font-size:18px;font-weight:bold;padding-bottom: 5px">
                {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($union->from_date))) }} হতে {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($union->to_date))) }} পর্যন্ত
            </td>
        </tr>
    </table>

    <table class="jolchap" align="center" border="1"  width='95%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
      
      <tr>
          <td style="text-align: center;width: 5%;">নং</td>
          <td style="text-align: center;width: 10%;">তারিখ</td>
          <td style="text-align: center;width: 25%;">নাম</td>
          <td style="text-align: center;width: 10%;">হোল্ডিং</td>
          <td style="text-align: center;width: 30%;">ঠিকানা</td>
          <td style="text-align: center;width: 10%;">মোবাইল</td>
          <td style="text-align: center;width: 10%;">টাকা</td>
      </tr>

      @php $i = 1;  $total = 0;@endphp
      @foreach($data as $item)
      <tr>
          <td>{{ BanglaConverter::bn_number($i++) }}</td>
          <td>{{ BanglaConverter::bn_number(date('d-m-Y', strtotime($item->payment_date))) }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->holding_no }}</td>
          <td>ওয়ার্ডঃ {{ $item->ward_no}}, {{$item->ward_name }}, গ্রাম/মহল্লাঃ {{$item->moholla_name}}</td>
          <td>{{ $item->mobile_no }}</td>
          <td style="text-align: right;padding-right:5px;">
            <?php
                $total += $item->amount;  echo BanglaConverter::bn_number(number_format($item->amount));
            ?>
          </td>
      </tr>
      @endforeach
      
      <tr>
          <td colspan='5' style="text-align: right;">মোট &nbsp;</td>
          <td colspan='2' style="text-align: right; padding-right: 5px;">
            {{ BanglaConverter::bn_number(number_format($total)) }}
          </td>
      </tr>
        
    </table>

</body>

</html>
