<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <base href=""/>
    <meta charset="utf-8"/>
    <title> দোকানের তালিকা </title>

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

<h3 style="text-align: center;text-decoration:underline;">দোকানের তালিকা</h3>
@if($market_id > 0)
    <h3 style="text-align: center;text-decoration:underline;">মার্কেটের
        নামঃ {{$market_info->name . ',' . $market_info->address}}</h3>
@endif

<table
    style="width: 100%;border:1px solid black;border-collapse: collapse;margin-left: 20px;margin-right: 20px;text-align: center;">
    <thead>
    <tr style="border: 1px solid black;">
        @if($market_id == 0)
            <th style="border: 1px solid black;">মার্কেটের নাম</th>
        @endif
        <th style="border: 1px solid black;">দোকান নং</th>
        <th style="border: 1px solid black;">সেলামী</th>
        <th style="border: 1px solid black;">ভাড়া</th>
        @if($market_id == 0)
            <th style="border: 1px solid black;">মার্কেটের নাম</th>
        @endif
        <th style="border: 1px solid black;">দোকান নং</th>
        <th style="border: 1px solid black;">সেলামী</th>
        <th style="border: 1px solid black;">ভাড়া</th>
    </tr>
    </thead>

    <tbody>
    @php $mid_point = (int)round((count($data)/2), 0, PHP_ROUND_HALF_UP); @endphp

    @for($i = 0; $i < $mid_point; $i++)

        <tr style="border: 1px solid black;">
            @if($market_id == 0)
                <td style="border: 1px solid black;">{{isset($data[$i]) ? $data[$i]->market_name : ''}}</td>
            @endif
            <td style="border: 1px solid black;">{{isset($data[$i]) ? $data[$i]->name : ''}}</td>
            <td style="border: 1px solid black;">{{isset($data[$i]) ? $data[$i]->selami : ''}}</td>
            <td style="border: 1px solid black;">{{isset($data[$i]) ? $data[$i]->rent : ''}}</td>

            @if($market_id == 0)
                <td style="border: 1px solid black;">{{isset($data[$mid_point+$i]) ?
                    $data[$mid_point+$i]->market_name : ''}}</td>
            @endif
            <td style="border: 1px solid black;">{{isset($data[$mid_point+$i]) ? $data[$mid_point+$i]->name : ''}}</td>
            <td style="border: 1px solid black;">{{isset($data[$mid_point+$i]) ? $data[$mid_point+$i]->selami : ''}}</td>
            <td style="border: 1px solid black;">{{isset($data[$mid_point+$i]) ? $data[$mid_point+$i]->rent : ''}}</td>
        </tr>

    @endfor

    </tbody>
</table>
</body>
</html>
