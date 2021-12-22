<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="" />
        <meta charset="utf-8" />
        <title> পোষা প্রাণীর লাইসেন্সের আবেদন </title>

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

        @if(!empty($animal))
            @if(! $print_setting->pad_print )
            @include('layouts.pdf_sub_layouts.application_header')

            @else
				<table>
					<tr>
						<td style="height: 150px"></td>
					</tr>
				</table>
			@endif
        <!-----------top area end--------------->
        <!-----------heading start--------------->
        <table border="0" cellpadding="5" cellspacing="5" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; " width="95%">
            <tr>
                <td style="text-align: center; {{($animal->photo)?"padding-left:150px;":""}} padding-bottom:50px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                            পোষা প্রাণীর লাইসেন্সের আবেদন
                        </span>
                    </h2>
                </td>
                <td  valign="top" style="text-align: center;" >

                    @if($animal->photo)
                        <img src="{{ asset('images/application/'. $animal->photo) }}" height="80px" width="80px"/>
                    @endif

                </td>
            </tr>
        </table>
        <!-----------heading end--------------->
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px;" width="95%">
            <tr>
                <td colspan="1">
                    আবেদনের তারিখ
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_others(date('d-m-Y', strtotime($animal->created_time))) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px">
                    পিন নং
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->pin) }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;height: 20px">
                    ট্রাকিং
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->tracking) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px;">
                    মালিকের নাম (বাংলা)
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $animal->name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    মালিকের নাম (ইংরেজী)
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $animal->name_en }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    পিতার নাম
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $animal->father_name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    মাতার নাম
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $animal->mother_name_bn }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="">
                    লিঙ্গ
                </td>
                <td style="border-left:none;">
                    <span>
                        : 
						@if($animal->gender == 1)
						 	পুরুষ
						@elseif($animal->gender == 2)
							মহিলা
						@else
							অন্যান্য
						@endif
                    </span>
                </td>

                <td style="border-left: none">
                    বৈবাহিক অবস্থা
                </td>

                <td style="border-left:none;">
                    <span>
                        : 

						@if($animal->marital_status == 1)
						 	অবিবাহিত
						@elseif($animal->marital_status == 2)
							বিবাহিত
						@elseif($animal->marital_status == 3)
							তালাকপ্রাপ্ত
						@elseif($animal->marital_status == 4)
							বিধবা
						@else
							অন্যান্য
						@endif
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border-left:none ">
                    জন্ম তারিখ
                </td>

                <td style="border-left:none;">
                    <span>
                        :
                        <?php echo BanglaConverter::bn_others(date('d-m-Y', strtotime($animal->
                        birth_date)));?>
                    </span>
                </td>

                <td style="border-left:none;">
                    জন্মসনদ নং
                </td>

                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->birth_id) }}
                    </span>
                </td>

                <td style="border-left:none;">
                    হোল্ডিং নং
                </td>

                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->permanent_holding_no) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    মোবাইল
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->mobile) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    ই-মেইল
                </td>
                <td colspan="3" style="border-left:none;">
                    <span>
                        : {{ $animal->email }}
                    </span>
                </td>
            </tr>

            <tr>
                <td style="">
                    ন্যাশনাল আইডি
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->nid) }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    পাসপোর্ট নং
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->passport_no) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td style="">
                    প্রাণীর নাম
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $animal->animal_name_bn }}
                    </span>
                </td>

                <td style="">
                    প্রাণীর গায়ের রঙ
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $animal->animal_color_bn }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    প্রাণীর জাত
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $animal->animal_type_bn }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    জলাতংকের টিকা দানের তারিখ
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->jolatongko_date) }}
                    </span>
                </td>

                <td colspan="2">
                    জলাতংকের টিকা দানের পরবর্তী তারিখ
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->jolatongko_next_date) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    প্রাণী পালনের তারিখ
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_others($animal->animal_keeping_date) }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    প্রাণীর বয়স
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($animal->animal_age) }}
                    </span>
                </td>
            </tr>

            <tr style="height:100px;">
                <td  style="height: 80px;">
                    বর্তমান ঠিকানা
                </td>
                <td colspan="5" style="border-left:none;height: 80px;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $animal->present_village_bn }},   রোড/ব্লক/সেক্টর : {{ $animal->present_rbs_bn }},     পোষ্ট অফিস :{{ $animal->present_postoffice_name }},   ওয়ার্ড নং : {{ BanglaConverter::bn_number($animal->present_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $animal->present_upazila_name }},     জেলা :{{ $animal->present_district_name }}
                    </p>
                </td>
            </tr>

            <tr style="height:100px;">
                <td style="border-bottom:none;" valign="top">
                    পূর্বের ঠিকানা
                </td>
                <td colspan="5" style="border-left:none; border-bottom:none;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $animal->permanent_village_bn }},   রোড/ব্লক/সেক্টর : {{ $animal->permanent_rbs_bn }},     পোষ্ট অফিস :{{ $animal->permanent_postoffice_name }},   ওয়ার্ড নং : {{ BanglaConverter::bn_number($animal->permanent_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $animal->permanent_upazila_name }},     জেলা :{{ $animal->permanent_district_name }}
                    </p>
                </td>
            </tr>

    @php
        $animal_type = '';

        if($animal->animal_type == 1){
            $animal_type = 'কুকুর';
        } else if($animal->animal_type == 2){
            $animal_type = 'বিড়াল';
        } else if($animal->animal_type == 3){
            $animal_type = 'হাতি';
        } else if($animal->animal_type == 4){
            $animal_type = 'ঘোড়া';
        } else if($animal->animal_type == 5){
            $animal_type = 'হরিণ';
        } else if($animal->animal_type == 6){
            $animal_type = 'খরগোস';
        } else if($animal->animal_type == 7){
            $animal_type = 'বাঘ';
        } else if($animal->animal_type == 8){
            $animal_type = 'সিংহ';
        }

    @endphp

            <tr style="height:100px;">
                <td colspan="6" style="border-left:none; border-bottom:none;height:80px;">
                    <p>
                    আমি অঙ্গীকার করিতেছি যে,আমি গত <b>{{BanglaConverter::bn_others(date('d-m-Y', strtotime($animal->animal_keeping_date)))}}</b> তারিখ /সাল হইতে উল্লেখিত <b>{{$animal_type}}</b> পালন করি। জলাতংক টিকাদানের পরবর্তী তারিখের মধ্যে পোষা প্রাণীকে টিকা প্রদান করিব এবং পৌরসভার বিধি বিধান মানিয়া চলিব।
                    </p>
                </td>
            </tr>


        </table>
        <!-----------application area end--------------->


        {{-- instrunction start --}}
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; " width="95%">
            <tr>
                <td style="text-align: center;">
                    <h2>
                        <span style="border-bottom: 1px dotted;">
                            নির্দেশনাবলী / Instruction
                        </span>
                    </h2>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 20px;">
                    <ul style="padding-left:50px;list-style:none;">
                        <li>
                            ১)   এলাকার গন্যমান্য ১ জন ব্যাক্তি এবং কাউন্সিলর  কর্তৃক সত্যায়িত করে পৌরসভা পরিষদে জমা দিন।
                        </li>
                        <li>
                            ২)  ১ কপি পাসপোর্ট সাইজ ছবি,(সত্যায়িত)
                        </li>
                        <li>
                            ৩)  আবেদন পত্রের অবস্থা জানার জন্য ট্র্যাকিং নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন ।
                        </li>
                    </ul>
                </td>
            </tr>
        </table>

        {{-- instruction area end --}} {{-- verification area start --}}
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; " width="95%">
            <tr>
                <td style="text-align: center; font-size: 20px;font-weight: bold;">
                    <span style="border-bottom: 1px solid">
                        সত্যায়ন / Verification
                    </span>
                </td>
            </tr>
        </table>

        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; " width="95%">
            <tr>
                <td colspan="{{$colspan+1}}">
                </td>
                <td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
                    <?php

                    $url = $url.'/verify/animal_application/'.$animal->tracking.'/'.$animal->union_id.'/'.$animal->type;

                    ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">

                </td>
            </tr>
            <tr>
                <td  style="border-bottom:1px solid black;text-align: center;">

                    <span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    </span>
                    গন্যমান্য ব্যাক্তি
                </td>

                @if ($print_setting->member)
                <td style="border-bottom:1px solid black;text-align: center;">
                    <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                    </span>
                    ওয়ার্ড সদস্য
                </td>
                @endif

                @if ($print_setting->chairman)
                <td style="border-bottom:1px solid black;text-align: center;">
                    <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                        </span>
                        চেয়ারম্যান
                </td>
                @endif
            </tr>
        </table>
        {{-- verification area end --}}

        <!------------------ footer area start-------------------->
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px;" width="95%">
            <tr>
                <td>
                    <p>

                        E-mail : {{ $union->email }}
                    </p>
                </td>
                <td style="text-align: right;">
                    <p>
                        Develop By: Innovation IT
                        <br/>
                        www.innovationit.com.bd
                    </p>
                </td>
            </tr>
        </table>
        <!------------------ footer area end-------------------->

        @else
        	<h2 style="text-align: center;color:red;">দুঃখিত ! আবেদনটি পাওয়া যায়নি</h2>
        @endif
    </body>
</html>
