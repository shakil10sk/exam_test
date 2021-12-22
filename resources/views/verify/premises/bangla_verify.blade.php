
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
                                মোবাইলঃ{{ Converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                                ওয়েব সাইট : {{ $url }}</font>

                        </td>

                    </tr>
                </table>


                <table
                    style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;"
                    cellpadding="0" cellspacing="0">

                    <tr>
                        <td style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                            <font style="">
                                <u>প্রিমিসেস লাইসেন্স যাচাই</u>
                            </font>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td>ইস্যু
                                        তারিখঃ {{ Converter::en2bn(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $premises['generate_date'])->format('d-m-Y')) }}</td>
                                    <td style="text-align: right;padding-right: 5px;">মেয়াদ
                                        উত্তীর্ণঃ {{Converter::en2bn( Carbon\Carbon::parse($premises['expire_date'])->format('d-m-Y')) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>

                        <td>

                            <table border="1" style="width:700px;border-color:lightgray;border-collapse:collapse;"
                                   cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:100px; text-align:center;font-weight:700;font-size:17px;">সনদ নং
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
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                        <td style="font-size:16px; text-align:left;">
                            :&nbsp;{{ $premises['organization_name_bn'] }}</td>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসার ধরণ</td>
                        <td style="font-size:16px; text-align:left;">
                            :&nbsp;{{ $premises['business_type_bn'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
                        <td style="font-size:16px; text-align:left;">
                            :&nbsp;{{ Converter::en2bn($premises['mobile']) }}</td>
                        <td style="text-indent: 20px;text-align:left; font-size:16px;">ই-মেইল</td>
                        <td style="font-size:16px; text-align:left;">:&nbsp;{{ $premises['email'] }}</td>
                    </tr>
                </table>

                <table width="88%" cellpadding="0" cellspacing="0" border="1"
                       style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px">

                    <tr style="text-align: center;font-weight:bolder;">
                        <th>নং</th>
                        <td style="font-weight: 700px; font-size: 17px;">প্রোপাইটরের নাম</td>
                        <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
                        <th style="font-weight: 700px; font-size: 17px;">পরিচয় পত্র/ জন্ম নিবন্ধন</th>
                        <th style="font-weight: 700px; font-size: 17px;">মোবাইল</th>
                    </tr>

                    @php
                        $i = 1;
                    @endphp

                    @foreach($premises['owner_list'] as $owner)


                        <tr height="20px" style="text-align: center;">
                            <td>{{ Converter::en2bn($i++) }}</td>
                            <td>{{  $owner->name_bn }}</td>

                            <td>

                                @if ($owner->gender == 2 && $owner->marital_status == 2)
                                    {{ $owner->husband_name_bn }}
                                @else
                                    {{ $owner->father_name_bn }}
                                @endif


                            </td>
                            <td>

                                @if ($owner->nid > 0)
                                    {{ Converter::en2bn($owner->nid) }}
                                @else
                                    {{ Converter::en2bn($owner->birth_id) }}
                                @endif


                            </td>

                            <td>{{ Converter::en2bn($owner->mobile) }}</td>

                        </tr>
                        <tr height='25px'>
                            <td colspan="4">

                                <p style="font-size:15px;">ঠিকানা
                                    : &nbsp;{{ $owner->permanent_village_bn }}
                                    ,&nbsp;&nbsp;&nbsp;, {{ $owner->permanent_village_bn }}
                                    , &nbsp;, {{ $owner->permanent_postoffice_name_bn }}
                                    ,&nbsp;&nbsp;&nbsp; {{ Converter::en2bn($owner->permanent_ward_no) }}
                                    &nbsp;, {{ $owner->permanent_upazila_name_bn }}
                                    , &nbsp; {{ $owner->permanent_district_name_bn }}
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
                            ব্যবসা প্রতিষ্ঠানের ঠিকানা
                        </td>
                        <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;">
                            : {{ $premises['trade_village_bn'] }}
                            &nbsp;{{ Converter::en2bn($premises['trade_ward_no']) }}
                            ,&nbsp;{{ $premises['trade_postoffice_name_bn'] }}
                            ,&nbsp;{{ $premises['trade_upazila_name_bn'] }}
                            ,&nbsp;{{ $premises['trade_district_name_bn'] }}
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
                                :&nbsp;{{ Converter::en2bn($item->amount ?? 0 )}}&nbsp;টাকা</span></td>
                        </tr>

                        @php
                            $total += $item->amount ?? 0;
                        @endphp
                    @endforeach

                    <tr>
                        <td align="left" nowrap
                            style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">
                            সর্বমোট
                        </td>
                        <td style="text-align:left; font-size:16px; ">: <span> &nbsp;{{ Converter::en2bn($total??0)
                        }} টাকা
                            মাত্র। </span></td>
                    </tr>

                </table>

                <table border='0' width='98%' cellpadding='0' cellspacing='0'
                       style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

                    <tr>
                        <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp; উল্লেখিত
                            প্রতিষ্ঠানের অনুকূলে প্রদত্ত লাইসেন্স ফি গ্রহন
                            করিয়া {{ Converter::en2bn($premises['fiscal_year_name']) }} সালের জন্য আবশ্যকীয়
                            বাণিজ্য চালাইয়া যাইবার অনুমতি দেওয়া হইল
                            । <?php $exp_year = date('Y') + 1; echo Converter::en2bn('30-06-' . $exp_year); ?> সন
                            পর্যন্ত এই লাইসেন্স বৈধ বলিয়া বিবেচিত হইবে এবং প্রতি বছর নবায়ন করিতে হইবে ।
                        </td>

                    </tr>

                </table>

            @else
                <h2 style="text-align: center;color: red;">দঃখিত ! সনদ নাম্বারটি সঠিক নয়</h2>
            @endif

        </div>
    </div>
</section>

{{-- @endsection --}}

