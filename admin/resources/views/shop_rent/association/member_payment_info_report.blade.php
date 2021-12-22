<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <base href=""/>
    <meta charset="utf-8"/>
    <title> পেমেন্টের হিসাব </title>

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
<div style="width:95%; margin-bottom: 10px " >
    <table border="0" width="95%" align="center" style="border-collapse:collapse; margin:5px auto;">
        <tr>
            <td  style=" text-indent: 40px; text-align: right; padding-left: 50px;width: 150px;"><b> নাম </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $member_info->name }}</font>
            </td>

            <td align='right'><b>পিতার নাম </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ $member_info->father_name }}</font>
            </td>
        </tr>
        <tr>
            <td  style=" text-align: right; padding-left: 50px;width: 150px;"><b> মোবাইল নং </b></td>
            <td>
                <font>&nbsp;:&nbsp;{{ $member_info->mobile }}</font>
            </td>

            <td align='right'><b> ঠিকানা </b> </td>
            <td>
                <font>&nbsp;:&nbsp;{{ $member_info->permanent_village_en }}</font>
            </td>
        </tr>


    </table>
</div>

<table
    style="width: 100%;border:1px solid black;border-collapse: collapse;margin-left: 20px;margin-right: 20px;text-align: center;">
    <thead>
    <tr style="border: 1px solid black;">
        <th style="border: 1px solid black;">অর্থবছর</th>
        <th style="border: 1px solid black;">মাস</th>
        <th style="border: 1px solid black;">প্রদানের তারিখ</th>
        <th style="border: 1px solid black;">টাকা</th>

    </tr>
    </thead>

    <tbody>

    @php $total_amount = 0 @endphp

    @foreach($data as $item)

        @php $total_amount += $item->amount  @endphp

        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;">{{ BanglaConverter::bn_number($item->year_id)  }}</td>
            <td style="border: 1px solid black;">{{ $item->month_name }}</td>
            <td style="border: 1px solid black;">{{  BanglaConverter::bn_number(date('d-m-Y',strtotime( $item->created_at)))   }}</td>
            <td style="border: 1px solid black;">{{ BanglaConverter::bn_number($item->amount) }}</td>
        </tr>>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">সর্বমোট</td>
        <td>{{ BanglaConverter::bn_number($total_amount) }} টাকা</td>
    </tr>
    </tfoot>
</table>
</body>
</html>
