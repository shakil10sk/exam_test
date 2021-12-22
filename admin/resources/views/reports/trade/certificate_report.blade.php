<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>ট্রেড লাইসেন্স রিপোর্ট - {{ $union->title }}</title>
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

        table,tr,td{padding: 2px;}

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
            <td style="text-align:center;font-size:18px;font-weight:bold;padding-bottom: 10px">
                <font>
                    <u>টেড লাইসেন্স রিপোর্ট</u><br/>
                    <u>{{ BanglaConverter::bn_number($union->title) }}</u>
                </font>
            </td>
        </tr>
    </table>

    <table class="jolchap" align="center" border="1"  width='95%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
      
      <tr>
          <td style="text-align: center;width: 4%;">নং</td>
          {{-- <td style="text-align: center;width: 17%;">সনদ নং</td> --}}
          <td style="text-align: center;width: 18%;">প্রতিষ্ঠানের নাম</td>
          <td style="text-align: center;width: 27%;">ঠিকানা</td>
          <td style="text-align: center;width: 18%;">ব্যবসায়ের ধরণ</td>
          <td style="text-align: center;width: 9%;">মোবাইল</td>
          <td style="text-align: center;width: 8%;">ইস্যু তারিখ</td>
          <td style="text-align: center;width: 9%;">ফি</td>
      </tr>

      @php $i = 1;  $total = 0;@endphp

      @foreach($data as $pitem)

        <tr>
            <td colspan="7" style="text-align: center;background-color: #d0d0d0;">
                {{$pitem['name']}} &nbsp;
            </td>
        </tr>

        @foreach($pitem['details'] as $item)
      <tr>
          <td style="text-align: center;">
            {{ BanglaConverter::bn_number($i++) }}
          </td>
          {{-- <td>{{ $item->sonod_no }}</td> --}}
          <td>{{ $item->organization_name_bn }}</td>
          
          <td>
            {{ $item->trade_village_bn }},{{ $item->post_office_name }},{{ $item->upazila_name }},{{ $item->district_name }}
          </td>
          
          <td>{{ $item->business_name }}</td>
          
          <td style="text-align: center;">
            {{ $item->mobile }}
          </td>

          <td style="text-align: center;">
            {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($item->generate_date))) }}
          </td>

          <td style="text-align: right; padding-right: 5px;">
            {{ BanglaConverter::bn_number(number_format($item->amount, 2, '.', ',')) }}
          </td>
      </tr>

        @php $total += $item->amount; @endphp

        @endforeach
      @endforeach

      <tr>
        <td colspan="6" style="text-align: right; padding-right: 20px;">মোটঃ</td>
        <td style="text-align: right; padding-right: 5px;">
            {{ BanglaConverter::bn_number(number_format($total, 2, '.', ',')) }}
        </td>
      </tr>
      
    </table>

</body>

</html>
