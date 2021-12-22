<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="" />
        <meta charset="utf-8" />
        <title> মাসিক বিল কালেকশন রিপোর্ট </title>

        <style media="all" type="text/css">
            body {
                font-family: 'bangla', sans-serif !important;
                font-size: 14px;
            }

            #list_tbl{
                width: 100%;
                border: 1px solid black;
                border-collapse: collapse;
                margin-left: 20px;
                margin-right: 20px;
                text-align: center;
            }

            #list_tbl tr,
            #list_tbl td,
            #list_tbl th{
                padding: 5px;
                border: 1px solid black;
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
        @include('layouts.pdf_sub_layouts.certificate_header_bn')

        <h3 style="text-align: center;text-decoration:underline;margin-bottom:none;">মাসিক বিল কালেকশন রিপোর্ট</h3>
        <h3 style="text-align: center;text-decoration:underline;margin-bottom:none;margin-top:none;">{{$month_en[$month_id] . ',' . $year_id}}</h3>

        <table id="list_tbl">
            <thead>
                <tr>
                    <th>নং</th>
                    <th>মার্কেটের নাম</th>
                    <th>দোকান নং</th>
                    <th>মালিকের নাম</th>
                    <th>মোবাইল</th>
                    <th>ইনভয়েস নং</th>
                    <th>টাকা</th>
                    <th>পরিশোধের তারিখ</th>
                </tr>
            </thead>

            <tbody>
                @php $total = 0; @endphp
                @foreach($data as $key => $item)
                    @php $total += $item->amount; @endphp
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->market_name}}</td>
                    <td>{{$item->shop_name}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->mobile_no}}</td>
                    <td>{{$item->invoice_id}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->payment_date}}</td>
                </tr>

                @endforeach

                <tr>
                    <td colspan="6" style="text-align: right;">মোটঃ</td>
                    <td>{{$total}}</td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </body>
</html>
