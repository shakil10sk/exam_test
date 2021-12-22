<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--<base href="http://www.centralup.narsingdilg.gov.bd/">-->
    <base href=".">

    <title>Daily Report</title>
    <meta name="robots" content="index, nofollow">
    <link rel="shortcut icon" href="http://www.centralup.narsingdilg.gov.bd/img/yellow.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reports.css') }}">
    <link rel="stylesheet" media="screen,projection" type="text/css" href=" {{ asset('css/jquery-ui.css') }}">
    <script src="{{ asset('js/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax_req.js') }}"></script>

    <style type="text/css">
        * {
            padding: 0px;
            margin: 0px;
        }

        @media print {
            #bar {
                display: none;
            }

            #container th {
                border: 1px solid #f1f1f1;
            }
        }

    </style>
</head>

<body>
    <div id="bar" style="background-color:#31A5E7">
        <div class="barcon">
            <form action="{{ route('report.allowance') }}" method="get">

                <span style="padding-right: 5em"><a href="{{ route('dashboard') }}">Home </a>|</span>

                <select name="upazila" id="upazila_select" style="width:180px;height:20px;">
                    @if (auth()->user()->type <=3)
                    <option value="">সকল উপজেলা</option>
                    @endif
                    @foreach ((object) json_decode($upazila) as $item)
                        <option value="{{ $item->id }}" {{ ($item->id == ($_GET['upazila'] ?? '')) ? 'selected' : '' }}>
                            {{ $item->bn_name }}</option>
                    @endforeach
                </select>
                <select name="union" id="union_select" style="width:180px;height:20px;">
                    <option value="">ইউনিয়ন নাম</option>
                </select>
                <input type="submit" value="Submit" class="submit">
                <span><a href="javaScript:window.print();" title="Print"><img
                            src="{{ asset('images/print.png') }}"></a></span>

            </form>
        </div>
    </div>
    <div id="container" style="width:30cm;height:29.7cm">
        <h2></h2>
        <h3>ইউনিয়ন পরিষদের তথ্য সমুহ</h3>
        <h4><b>উপজেলাঃ {{ $upazila_name??"" }}</b>

        </h4>
        @if ($_GET['union']??0)
            <table style="border:1px solid #eee" rules="all">
                <tbody>
                    <tr>
                        <td style="width:150px;font-size:14px;font-weight:bold">ইউনিয়ন পরিষদের নাম:</td>
                        <td>{{ \App\Models\UnionInformation::where('union_code', $_GET['union'])->first()->bn_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif


        <table cellspacing="0" style="margin-top:10px;" width="100%">

            <thead>

                <tr>
                    <td
                        style="width:10px;text-align:center;padding:0px;margin:0px;height:30px;background-color:gray;color:white;">
                        ভাতার ধরন</td>
                    <td
                        style="width:10px;text-align:center;padding:0px;margin:0px;height:30px;background-color:gray;color:white;">
                        ভাতা প্রাপ্তদের সংখ্যা</td>
                    <td style="width:25px;text-align:center;padding:0px;margin:0px;background-color:gray;color:white;">
                        ভাতার পরিমাণ</td>
                    <td style="width:25px;text-align:center;padding:0px;margin:0px;background-color:gray;color:white;">
                        মন্তব্য</td>
                </tr>

            </thead>
            <tbody>

                <tr>
                    <td>মুক্তিযোদ্ধা</td>
                    <td style="text-align:center;">{{ $allowance->freedom->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->freedom->amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>বিধবা</td>
                    <td style="text-align:center;">{{ $allowance->bidoba->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->bidoba->amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>হত দরিদ্র</td>
                    <td style="text-align:center;">{{ $allowance->poor->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->poor->amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>বয়স্ক</td>
                    <td style="text-align:center;">{{ $allowance->old->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->old->amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>মাতৃত্যকালিন</td>
                    <td style="text-align:center;">{{ $allowance->motherhood->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->motherhood->amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>প্রতিবন্ধি</td>
                    <td style="text-align:center;">{{ $allowance->protibondi->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->protibondi->amount ?? 0 }}</td>
                </tr>
                <tr>
                    <td>বিজিডি</td>
                    <td style="text-align:center;">{{ $allowance->vgd->total }}</td>
                    <td colspan="2" style="text-align:center;">{{ $allowance->vgd->amount ?? 0 }}</td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:right">মোট</th>
                    <th style="text-align:center">{{ ($allowance->freedom->total +$allowance->bidoba->total +$allowance->poor->total +$allowance->old->total +$allowance->motherhood->total +$allowance->protibondi->total +$allowance->vgd->total)?? ০ }} জন</th>
                    <th colspan="2" style="text-align:center">{{($allowance->freedom->amount + $allowance->bidoba->amount +$allowance->poor->amount + $allowance->old->amount + $allowance->motherhood->amount +$allowance->protibondi->amount + $allowance->vgd->amount) ?? ০ }} টাকা</th>
                    <!-- <th></th> -->
                </tr>
            </tfoot>
        </table>
    </div>


    <input type="hidden" id='upazila' value="{{ $upazila }}">
    <script>
        union_select_update();

        $('#upazila_select').change(() => {
            union_select_update();
        });

        function union_select_update(params) {
            // console.log($('#upazila_select').val());
            let loop = false;
            let union = null;
            JSON.parse($('#upazila').val()).forEach(el => {
                if (loop) {
                    return;
                }

                union = `<option value="">ইউনিয়ন নাম</option>`;
                if (el.union)
                    el.union.forEach(item => {
                        if('{{$_GET["union"]??null}}' == item.union_code)
                        {
                            union += `<option value="` + item.union_code + `" selected="selected" >` + item.bn_name + `</option>`;
                        }
                        else
                        {
                            union += `<option value="` + item.union_code + `">` + item.bn_name + `</option>`;
                        }
                    });

                if ($('#upazila_select').val() == el.id) {
                    loop = true;
                }
            });

            $('#union_select').html(union);
        }

    </script>
</body>

</html>
