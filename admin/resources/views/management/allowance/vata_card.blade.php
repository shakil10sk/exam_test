<!doctype html>
<html lang="bn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Auth::User()->relationBetweenUnion->bn_name }}</title>
    <style>
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
    <table style="margin: 0 auto; overflow: hidden; width: 550px; height: 350px; background:#f3f8ff; border: 2px solid; padding: 2px;">
        <tr>
            <td>
                <table style="margin:0 auto;">
            
                    <tr>
                        <td>
                        <img style="padding: 10px; text-align: left; width: 90px;" src="{{ asset('images/union_profile/'.$profile[0]->union_logo) }}">
                        </td>
                        <td style="text-align:center;">
                            <p style="font-weight: bold;line-height: 3px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
                            <p style="text-align: center;line-height: 3px;padding-top: 2px;">{{ $profile[0]->union_name_bn }}</p>
                            <p style="text-align: center;line-height: 3px;">{{ $profile[0]->union_upazila }} , {{ $profile[0]->union_district }}</p>
                        </td>
                        <td>
                            <img style="padding: 10px; text-align: left; width: 90px;" src="{{ asset('images/allowance/'.$profile[0]->photo) }}" >
                        </td>
                    </tr>

                </table><br>
            </td>
        </tr>

        <tr>
            <td>
                <h4 style="text-align: center; border: 1px solid; border-radius: 50px; width: 240px; margin: 0 auto;">@if($type == 1) মুক্তিযোদ্ধা @elseif($type == 2) দুস্থ ও হত দরিদ্রদ @elseif($type == 3) বয়স্ক ও প্রাপ্তবয়স্ক @elseif($type == 4) মাতৃত্যকালিন @elseif($type == 5) বিধবা @elseif($type == 6) পপ্রতিবন্ধী @elseif($type == 7) ভি জি ডি @endif ভাতা কার্ড</h4><br>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width: 100%;">
        
                    <tr>
                        <td class="pl-2">নাম</td>
                        <td>:</td>
                        <td style="border-right: 1px dotted;">{{ $profile[0]->name }}</td>
                        <td class="pl-2">ওয়ার্ড নং</td>
                        <td>:</td>
                        <td>{{ BanglaConverter::bn_number($profile[0]->ward_no) }}</td>
                    </tr>

                    <tr>
                        <td class="pl-2">আইডি নং</td>
                        <td>:</td>
                        <td style="border-right: 1px dotted;">{{ BanglaConverter::bn_number($profile[0]->allowance_id) }}</td>
                        <td class="pl-2">গ্রাম</td>
                        <td>:</td>
                        <td>{{ $profile[0]->village }}</td>
                    </tr>

                    <tr>
                        <td class="pl-2">এন আই ডি নং</td>
                        <td>:</td>
                        <td style="border-right: 1px dotted;">{{ BanglaConverter::bn_number($profile[0]->nid) }}</td>
                        <td class="pl-2">মোবাইল</td>
                        <td>:</td>
                        <td>{{ BanglaConverter::bn_number($profile[0]->mobile) }}</td>
                    </tr>

                    
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width: 100%;border-top: 1px dotted;">
                    <tr>
                        <td class="" style="font-size: 12px;">
                            
                                <p>১.ভাতার বিস্তারিত জানতে QR কোডটি স্ক্যান করুন।</br>
                                ২.কার্ডটি হস্তান্তরযোগ্য নয়।</br>
                                ৩।কর্তৃপক্ষ কার্ডটি বাতিলের সিদ্বান্ত গ্রহণ করতে পারে।</p>

                        </td>
                        <td class="">
                            <p style="text-align: center;font-size: 12px;padding-top: 40px;">
                                চেয়ারম্যান <br>
                                {{ $profile[0]->union_name_bn }}
                            </p>
                        </td>
                        <td style="padding-left:10px;">
                            @php $url = route('vata_card', ['type' => $type, 'id' => $profile[0]->id]); @endphp
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " style="width: 120px;height: 90px;padding-right: 14px;">
                        </td>  
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
