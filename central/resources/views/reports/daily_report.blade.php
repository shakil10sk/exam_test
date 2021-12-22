<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0073)http://www.centralup.narsingdilg.gov.bd/index.php/Admin/dailySummery_ddlg -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--<base href="http://www.centralup.narsingdilg.gov.bd/">-->
    <base href=".">

    <title>Daily Report</title>
    <meta name="robots" content="index, nofollow">
    <link rel="shortcut icon" href="http://www.centralup.narsingdilg.gov.bd/img/yellow.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reports.css') }}">
    {{--
    <link rel="stylesheet" media="screen,projection" type="text/css" href=" {{ asset('css/jquery-ui.css') }}">
    --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery-ui.js') }}"></script>
    --}}
    {{-- <script type="text/javascript" src="{{ asset('js/ajax_req.js') }}"></script>
    --}}



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
    {{-- {{ dd($_GET) }} --}}
    <div id="bar" style="background-color:#31A5E7">
        <div class="barcon">
            <form action="{{ route('report.daily') }}" method="get">

                <span><a href="{{ route('dashboard') }}">Home </a>|</span>
                <span>হতে:</span>
                <input type="date" class="date" id="fromdate" name="from" value="{{ $_GET['from'] ?? date('Y-m-d') }}"
                    data-format="yyyy-mm-dd" style="height:20px;">
                <span>&nbsp; পর্যন্ত:</span>
                <input type="date" class="date" id="todate" name="to" value="{{ $_GET['to'] ?? date('Y-m-d') }}"
                    data-format="yyyy-mm-dd" style="height:20px;">
                <select name="upazila" id="upazila_select" style="width:180px;height:20px;">
                    @if (auth()->user()->type <=3)
                    <option value="">সকল উপজেলা</option>
                    @endif
                    @foreach ((object) json_decode($upazila) as $item)
                        <option value="{{ $item->id }}" {{ ($item->id == ($_GET['upazila'] ?? null)) ? 'selected' : '' }}>
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
    <div id="container" style="width:fit-content;">
        <h2></h2>
        <h3>ইউনিয়ন পরিষদের তথ্য সমুহ</h3>
        <h4><b>উপজেলাঃ {{$upazila_name ?? ""}}</b></h4>
        <h4>হতে {{ $_GET['from'] ?? date('Y-m-d') }} পর্যন্ত {{ $_GET['to'] ?? date('Y-m-d') }}</h4>

        <table cellspacing="0" style="margin-top:10px;">
            <thead>
                <tr>
                    <td style="text-align:center;height:30px;background-color:gray;">
                    </td>
                    <td style="text-align:center;background-color:gray;color:white;"></td>
                    <td style="text-align:center;background-color:gray;color:white;"></td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        ট্রেড লাইসেন্স <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        নাগরিক <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        ওয়ারিশ <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        পারিবারিক <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        অনাপত্তি <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        বার্ষিক আয়ের <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        ভূমিহীন <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        মৃত্যু <br> সনদ</td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        একই নামের <br> প্রত্যয়ন </td>
                    <td style="text-align:center;background-color:gray;color:white;">
                        ভোটার আইডি <br> স্থানান্তর</td>
                    <td style="text-align:center;background-color:gray;color:white;">টাকা</td>
                </tr>

            </thead>
            <tbody>

                @foreach ($union_info ?? [] as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->bn_name }}</td>
                        <td>
                            আবেদন
                            <hr>
                            সনদ
                        </td>
                        <td style="text-align:center;">
                            {{ $item->trade->app }}
                            <hr>
                            {{ $item->trade->certificate }}
                        </td>

                        <td style="text-align:center;">
                            {{ $item->nagoric->app }}
                            <hr>
                            {{ $item->nagoric->certificate }}
                        </td>

                        <td style="text-align:center;">
                            {{ $item->waris->app }}
                            <hr>
                            {{ $item->waris->certificate }}
                        </td>
                        
                        <td style="text-align:center;">
                            {{ $item->family->app }}
                            <hr>
                            {{ $item->family->certificate }}
                        </td>

                        <td style="text-align:center;">
                            {{ $item->onapoitti->app }}
                            <hr>
                            {{ $item->onapoitti->certificate }}
                        </td>
                        <td style="text-align:center;">{{ $item->yearly_income }}</td>
                        <td style="text-align:center;">{{ $item->vumihin }}</td>
                        <td style="text-align:center;">{{ $item->death }}</td>
                        <td style="text-align:center;">{{ $item->same_name }}</td>
                        <td style="text-align:center;">{{ $item->voter }}</td>
                        <td style="text-align:center;">{{ $item->total }} ৳</td>
                    </tr>
                @endforeach

            </tbody>
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
