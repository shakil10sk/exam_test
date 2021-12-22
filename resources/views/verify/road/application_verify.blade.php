<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="" />
        <meta charset="utf-8" />
        <title> রাস্তা খননের অনুমতির আবেদন </title>

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

        @if(!empty($road))
        @if(! $print_setting->pad_print )
		<table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">


            <tr>
                <td style="width:1.5in; text-align:center;">
                    <img src="{{ env('ADMIN_ASSET_URL').'/images/union_profile/'.$union->main_logo }}" height="100px" width="100px" />
                </td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
                        {{-- মোবাইলঃ{{ Converter::en2bn($union->mobile) }}, --}}
                         ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ $union->sub_domain }}</font>

                </td>

                <td style="width:1.2in; text-align:left;">

                	@if(!empty($union->brand_logo))

                    <img src="{{ env('ADMIN_ASSET_URL').'/images/union_profile/'.$union->brand_logo }}" height="100px" width="100px" style="position:relative;right:10px;" />

                    @endif

                </td>

            </tr>
        </table>
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
                <td style="text-align: center; {{($road->photo)?"padding-left:150px;":""}} padding-bottom:50px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                            রাস্তা খননের অনুমতির আবেদন
                        </span>
                    </h2>
                </td>
                <td  valign="top" style="text-align: center;" >

                    @if($road->photo)
                        <img src="{{ asset('images/application/'. $road->photo) }}" height="80px" width="80px"/>
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
                        : {{ converter::bn2en(date('d-m-Y', strtotime($road->created_time))) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px">
                    পিন নং
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::bn2en($road->pin) }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;height: 20px">
                    ট্রাকিং
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ converter::bn2en($road->tracking) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px;">
                    আবেদনকারীর নাম (বাংলা)
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $road->name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    আবেদনকারীর নাম (ইংরেজী)
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $road->name_en }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    পিতার নাম
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $road->father_name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    মাতার নাম
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $road->mother_name_bn }}
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
						@if($road->gender == 1)
						 	পুরুষ
						@elseif($road->gender == 2)
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

						@if($road->marital_status == 1)
						 	অবিবাহিত
						@elseif($road->marital_status == 2)
							বিবাহিত
						@elseif($road->marital_status == 3)
							তালাকপ্রাপ্ত
						@elseif($road->marital_status == 4)
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
                        <?php echo converter::bn2en(date('d-m-Y', strtotime($road->
                        birth_date)));?>
                    </span>
                </td>

                <td style="border-left:none;">
                    জন্মসনদ নং
                </td>

                <td style="border-left:none;">
                    <span>
                        : {{ converter::bn2en($road->birth_id) }}
                    </span>
                </td>

                <td style="border-left:none;">
                    হোল্ডিং নং
                </td>

                <td style="border-left:none;">
                    <span>
                        : {{ converter::bn2en($road->permanent_holding_no) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    মোবাইল
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ converter::bn2en($road->mobile) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    ই-মেইল
                </td>
                <td colspan="3" style="border-left:none;">
                    <span>
                        : {{ $road->email }}
                    </span>
                </td>
            </tr>

            <tr>
                <td style="">
                    ন্যাশনাল আইডি
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ converter::bn2en($road->nid) }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    পাসপোর্ট নং
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::bn2en($road->passport_no) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="height: 20px;"></td>
            </tr>

            <tr>
                <td>
                    হোল্ডিং নং
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ converter::bn2en($road->holding_no) }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    রাস্তা কাটা/বোরিং এর পরিমাণ
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::bn2en($road->cutting_amount) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td style="">
                    মহল্লা
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $road->moholla_bn }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    রাস্তার নাম
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $road->road_name_bn }}
                    </span>
                </td>
            </tr>

    @php
        $road_type = '';

        if($road->road_type == 1){
            $road_type = 'কাঁচা';
        } else if($road->road_type == 2){
            $road_type = 'পাকা';
        } else if($road->road_type == 3){
            $road_type = 'অর্ধ পাকা';
        } else if($road->road_type == 4){
            $road_type = 'কার্পেটিং';
        } else if($road->road_type == 5){
            $road_type = 'ডব্লিউ.বি.এম';
        } else if($road->road_type == 6){
            $road_type = 'এইচ.বি.বি';
        } else if($road->road_type == 7){
            $road_type = 'সোলিং';
        } else if($road->road_type == 8){
            $road_type = 'আর.সি.সি';
        }

        $road_cutting_cause = '';

        if($road->cutting_cause == 1){
            $road_cutting_cause = 'গ্যাস লাইন সংযোগ';
        } else if($road->cutting_cause == 2){
            $road_cutting_cause = 'পানির লাইন সংযোগ';
        } else if($road->cutting_cause == 3){
            $road_cutting_cause = 'বিদ্যুৎ লাইন সংযোগ';
        }

    @endphp

            <tr>
                <td style="">
                    রাস্তার ধরণ
                </td>

                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ $road_type }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    রাস্তা কাটার কারন
                </td>

                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $road_cutting_cause }}
                    </span>
                </td>
            </tr>


            <tr style="height:100px;">
                <td  style="height: 80px;">
                    বর্তমান ঠিকানা
                </td>
                <td colspan="5" style="border-left:none;height: 80px;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $road->present_village_bn }},   রোড/ব্লক/সেক্টর : {{ $road->present_rbs_bn }},     পোষ্ট অফিস :{{ $road->present_postoffice_name }},   ওয়ার্ড নং : {{ converter::bn2en($road->present_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $road->present_upazila_name }},     জেলা :{{ $road->present_district_name }}
                    </p>
                </td>
            </tr>

            <tr style="height:100px;">
                <td style="border-bottom:none;" valign="top">
                    স্থায়ী ঠিকানা
                </td>
                <td colspan="5" style="border-left:none; border-bottom:none;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $road->permanent_village_bn }},   রোড/ব্লক/সেক্টর : {{ $road->permanent_rbs_bn }},     পোষ্ট অফিস :{{ $road->permanent_postoffice_name }},   ওয়ার্ড নং : {{ converter::bn2en($road->permanent_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $road->permanent_upazila_name }},     জেলা :{{ $road->permanent_district_name }}
                    </p>
                </td>
            </tr>

            <tr style="height:100px;">
                <td colspan="6" style="border-left:none; border-bottom:none;height:80px;">
                    <p></p>
                </td>
            </tr>


        </table>
        <!-----------application area end--------------->


         {{-- verification area start --}}

        <table width="95%" cellpadding="0" cellspacing="0" border="0"
            style="border-collapse:collapse;margin-left: 50px; margin-top: 15px;">
            <tr>
                <td style="text-align: right;">
                    <span style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আবেদনকারী স্বাক্ষর
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </td>
            </tr>
        </table>

        <hr/>
                    <table width="95%" cellpadding="0" cellspacing="0" border="0"
                        style="border-collapse:collapse;margin-left: 50px; margin-top: 10px; ">
                        <tr>
                            <td style="text-align: center; font-size: 20px;font-weight: bold;">
                                <span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
                            </td>
                        </tr>
                    </table>

                    <table width="95%" cellpadding="0" cellspacing="0" border="0"
                        style="border-collapse:collapse;margin-left: 50px; margin-top: 100px; ">
                        <tr>
                            <td style="text-align: center;">
                                <span
                                    style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                <br />
                            </td>
                            @if($print_setting->member)
                                <td style="text-align: center;">
                                    <span
                                        style="border-top: 1px solid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                    <br />
                                </td>
                            @endif
                            @if($print_setting->chairman)
                                <td style="text-align: center;">
                                    <span style="border-top: 1px solid">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মেয়র
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                    <br />
                                </td>
                            @endif
                        </tr>
                        {{-- <tr style="padding-top:50px;">
                            <td valign="bottom"
                                style="text-align: left; border-bottom: 1px dotted;font-size:13px;height:50px;">
                                <h2>নির্দেশনাবলী / Instruction</h2>
                            </td>
                            <td></td>
                        </tr> --}}
                        <tr>
                            <td colspan="{{ $colspan+1 }}" style="border-bottom:1px solid black;font-size:13px">
                                <h2 style="text-align: left; border-bottom: 1px solid;font-size:15px;height:50px;">নির্দেশনাবলী / Instruction</h2><br>
                                <ul style="padding-left:50px;list-style:none;">
                                    <li>
                                        ১)   এলাকার গন্যমান্য ১ জন ব্যাক্তি এবং ওয়ার্ড মেম্বার কর্তৃক সত্যায়িত করে
                                        পৌরসভা পরিষদে জমা দিন।
                                    </li>
                                    <li>
                                        ২)  ১ কপি পাসপোর্ট সাইজ ছবি,(সত্যায়িত)
                                    </li>
                                    <li>
                                        ৩)  আবেদন পত্রের অবস্থা জানার জন্য ট্র্যাকিং নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই
                                        করুন ।
                                    </li>
                                    <li>
                                        ৪). সদ্য তোলা পাসপোর্ট সাইজের ছবি ১ কপি ।
                                    </li>
                                </ul>
                            </td>
                            <td rowspan="4"
                                style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
                                <?php

                                $url = $url.'/verify/road_application/'.$road->tracking.'/'.$road->union_id.'/'.$road->type;

                            ?>
                                <img height="130"
                                    src="road:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                                    width="170">
                            </td>
                        </tr>
                    </table>

                    {{-- end of file --}}


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
                        Developed by: Innovation IT
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
