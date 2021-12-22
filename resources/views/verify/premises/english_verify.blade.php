
<style type="text/css">


    body {
        font-family: 'bangla', sans-serif !important;
        font-size: 14px;
        width: 670px;
        height: 842px;
        margin: auto;

        @if(strtotime(date('Y-m-d')) > strtotime($premises['expire_date']))
 color: rgba(10, 10, 10, 0.493);
        background-image: url('{{env("ADMIN_ASSET_URL")}}/images/expire.png');
        background-repeat: no-repeat;
        background-size: 300px 200px;
        background-position: 50% 50vh;
    @endif

    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }
    }

    /*
            @page {
                header: page-header;
                footer: page-footer;
                margin: 20px 0px;
                padding: 0px;

            } */
</style>
<section>
    <div class="container">
        <div class="card" style="margin:20px 0px; padding: 10px 0px 20px 0px">

            @if(!empty($premises))
                <table border="0px" width="110%" align="center"
                       style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
                    <tr>

                        <td style="text-align:center;">
                            <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                            <br/>

                            <font style="font-size:16px; font-weight:bold;">
                                {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}
                                , {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
                                Mobile : {{ Converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                                Website : {{ $url }}</font>

                        </td>

                    </tr>
                </table>


                <table
                    style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
                    cellpadding="0" cellspacing="0">

                    <tr>
                        <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                            <font style="">
                                <u>Premises Licesnse verify</u>
                            </font>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td>Issue Date: {{ Converter::en2bn(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $premises['generate_date'])->format('d-m-Y')) }}</td>
                                    <td style="text-align: right;padding-right: 5px;">Expire Date:  {{Converter::en2bn( Carbon\Carbon::parse($premises['expire_date'])->format('d-m-Y')) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>

                        <td>

                            <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;"
                                   cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">Certificate No :
                                        :
                                    </td>
                                    @php

                                        $sonod = str_split($premises['sonod_no']);

                                        for($i=0; $i<strlen($premises['sonod_no']); $i++):

                                    @endphp

                                    <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo Converter::en2bn($sonod[$i]); ?></td>

                                    @php
                                        endfor;
                                    @endphp
                                </tr>
                            </table>
                        </td>

                    </tr>

                </table>

                <table style="width:95%; margin-left:48px;margin-top:10px;" cellpadding="0" cellspacing="0">

                    <tr>

                        <td valign="top" style="text-align: center;">


                            @foreach($premises['owner_list'] as $owner)

                                @if(!empty($owner->photo))

                                    <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'.$owner->photo }}"
                                         height="80px" width="80px" style=""/>

                                @else

                                    <img src="{{ asset('images/application/default.jpg') }}" height="80px"
                                         width="80px"/>


                                @endif

                            @endforeach

                        </td>

                    </tr>

                </table>


                <table width="95%" cellpadding="0" cellspacing="0" border="0"
                       style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Name</td>
                        <td style="font-size:16px; text-align:left;">
                            :&nbsp;{{ $premises['organization_name_bn'] }}</td>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Business Type</td>
                        <td style="font-size:16px; text-align:left;">
                            :&nbsp;{{ $premises['business_type_bn'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Mobile</td>
                        <td style="font-size:16px; text-align:left;">
                            :&nbsp;{{ Converter::en2bn($premises['mobile']) }}</td>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">Email</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $premises['email'] }}</td>
                    </tr>
                </table>

                <table width="88%" cellpadding="0" cellspacing="0" border="1"
                       style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px">

                    <tr style="text-align: center;font-weight:bolder;">
                        <th>নং</th>
                        <td style="font-weight: 700px; font-size: 17px;">Proprietor Name</td>
                        <th style="font-weight: 700px; font-size: 17px;">Father/Husband</th>
                        <th style="font-weight: 700px; font-size: 17px;">NID/ Birth ID</th>
                        <th style="font-weight: 700px; font-size: 17px;">Mobile</th>
                    </tr>

                    @php
                        $i = 1;
                    @endphp

                    @foreach($premises['owner_list'] as $owner)


                        <tr height="20px" style="text-align: center;">
                            <td>{{ Converter::en2bn($i++) }}</td>
                            <td>{{  $owner->name_en }}</td>

                            <td>

                                @if ($owner->gender == 2 && $owner->marital_status == 2)
                                    {{ $owner->husband_name_en }}
                                @else
                                    {{ $owner->father_name_en }}
                                @endif


                            </td>
                            <td>

                                @if ($owner->nid > 0)
                                    {{ $owner->nid }}
                                @else
                                    {{ $owner->birth_id }}
                                @endif


                            </td>

                            <td>{{ Converter::en2bn($owner->mobile) }}</td>

                        </tr>
                        <tr height='25px'>
                            <td colspan="4">

                                <p style="font-size:15px;">Address
                                    : &nbsp;{{ $owner->permanent_village_en }}
                                    ,&nbsp;&nbsp;&nbsp;, {{ $owner->permanent_village_en }}
                                    , &nbsp;, {{ $owner->permanent_postoffice_name_en }}
                                    ,&nbsp;&nbsp;&nbsp; {{ $owner->permanent_ward_no }}
                                    &nbsp;, {{ $owner->permanent_upazila_name_en }}
                                    , &nbsp; {{ $owner->permanent_district_name_en }}
                                </p>

                            </td>
                        </tr>
                    @endforeach

                </table>


                <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0"
                       cellspacing='0'
                       style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

                    <tr>
                        <td valign='top'
                            style="font-size:16px;text-indent:55px; font-color:black; width: 210px; padding-left: 50px">
                            Organization Address
                        </td>
                        <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;">
                            : {{ $premises['trade_village_en'] }}
                            &nbsp;{{ $premises['trade_ward_no'] }}
                            ,&nbsp;{{ $premises['trade_postoffice_name_en'] }}
                            ,&nbsp;{{ $premises['trade_upazila_name_en'] }}
                            ,&nbsp;{{ $premises['trade_district_name_en'] }}
                        </td>
                    </tr>

                    @php
                        $total = 0;
                    @endphp

                    @foreach ($fee_data ?? [] as $item)
                        <tr>
                            <td align="left" nowrap
                                style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left:
                                 50px">{{$item->account_name}}</td>
                            <td style="text-align:left;font-size:16px; ">
                                :&nbsp;{{ $item->amount ?? 0  }}&nbsp;Taka</span></td>
                        </tr>

                        @php
                            $total += $item->amount ?? 0;
                        @endphp
                    @endforeach

                    <tr>
                        <td align="left" nowrap
                            style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">
                            Total
                        </td>
                        <td style="text-align:left; font-size:16px; ">: <span> &nbsp;{{ $total ??0
                        }} Taka
                            Only </span></td>
                    </tr>

                </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0'
                       style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                    <tr>
                        <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp;  You are permitted to continue your business for {{ Converter::en2bn($premises['fiscal_year_name']) }} after receiving the license fee on behalf of the mentioned company. This license will be valid till
                            । <?php $exp_year = date('Y') + 1; echo '30-06-' . $exp_year; ?> and will have to renew
                            every year.
                        </td>

                    </tr>

                </table>

            @else
                <h2 style="text-align: center;color: red;">Sorry ! This is invalid certificate no</h2>
            @endif

        </div>
    </div>
</section>

{{-- @endsection --}}

