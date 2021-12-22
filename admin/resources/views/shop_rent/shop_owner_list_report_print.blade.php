<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <base href=""/>
    <meta charset="utf-8"/>
    <title> দোকান মালিকদের তালিকা </title>

    <style media="all" type="text/css">
        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
        }

        #list_tbl {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            margin-left: 20px;
            margin-right: 20px;
            text-align: center;
        }

        #list_tbl tr,
        #list_tbl td,
        #list_tbl th {
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

<h3 style="text-align: center;text-decoration:underline;">দোকান মালিকদের তালিকা</h3>
{{-- 0 = Market_id null --}}
@if($market_id > 0)
    <h3 style="text-align: center;text-decoration:underline;">মার্কেটের
        নামঃ {{$market_info->name . ',' . $market_info->address}}</h3>
@endif

<table id="list_tbl">
    <thead>
    <tr>
        <th>নং</th>
        @if($market_id == 0)
            <th>মার্কেটের নাম
            </th>
        @endif
        <th>দোকান নং</th>
        <th>পিতার নাম</th>
        <th>মাতার নাম</th>
        <th>সেলামী</th>
        <th>ভাড়া</th>
        <th>মোবাইল</th>
        <th>ঠিকানা</th>
    </tr>
    </thead>

    <tbody>
    @foreach($data as $key => $item)

        <tr>
            <td>{{$key+1}}</td>
            @if($market_id == 0)
                <td>{{$item->market_name}}</td>
            @endif
            <td>{{$item->shop_name}}</td>market_name
            <td>{{$item->father_name}}</td>

            <td>{{$item->mother_name}}</td>
            <td>{{$item->selami_amount}}</td>
            <td>{{$item->rent_amount}}</td>
            <td>{{$item->mobile_no}}</td>
            <td>{{$item->address}}</td>
        </tr>

    @endforeach

    </tbody>
</table>
</body>
</html>
