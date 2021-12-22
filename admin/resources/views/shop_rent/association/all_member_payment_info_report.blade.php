<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <base href=""/>
    <meta charset="utf-8"/>
    <title> কালেকশান হিসাব </title>

    <style media="all" type="text/css">
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
@include('layouts.pdf_sub_layouts.certificate_header_bn')

<h1 style="text-align: center" >সকল সদস্যর হিসাব</h1>
<table
    style="width: 80%;border:1px solid black;border-collapse: collapse;margin-left: 100px;margin-right: 0px;
    text-align: center;">
    <thead>
    <tr style="border: 1px solid black;">
        <th style="border: 1px solid black;">নাম</th>
        <th style="border: 1px solid black;">মোবাইল নং</th>
        <th align="right" style="border: 1px solid black;">টাকা</th>

    </tr>
    </thead>

    <tbody>

    @php $total_amount = 0 @endphp

    @foreach($data as $item)

        @php $total_amount += $item->total_amount  @endphp

        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;">{{ $item->name }}</td>
            <td style="border: 1px solid black;">{{  BanglaConverter::bn_number($item->mobile)   }}</td>
            <td align="right" style="border: 1px solid black;">{{ BanglaConverter::bn_number($item->total_amount)
            }}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">সর্বমোট কালেকশান</td>
        <td align="right" >{{ BanglaConverter::bn_number(number_format($total_amount,2)) }}</td>
    </tr>
    </tfoot>
</table>
</body>
</html>
