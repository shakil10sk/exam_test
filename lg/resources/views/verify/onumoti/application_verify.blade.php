<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="">
            <meta charset="utf-8">
                <title>
                    অনুমতি পত্রের আবেদন
                </title>
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
            </meta>
        </base>
    </head>
    <body>

        @if(!empty($onumoti))
        @if(! $print_setting->pad_print )
        <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">



            <tr>
                <td style="width:1.5in; text-align:center;">
                    {{-- <img src="{{ env('ADMIN_ASSET_URL').'/images/union_profile/'.$union->main_logo }}" height="100px" width="100px" /> --}}
                </td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
                        মোবাইলঃ{{ Converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                        ওয়েব সাইট : {{ $union->sub_domain }}</font>

                </td>

                <td style="width:1.2in; text-align:left;">

                    @if(!empty($union->brand_logo))

                    {{-- <img src="{{ env('ADMIN_ASSET_URL').'/images/union_profile/'.$union->brand_logo }}" height="100px" width="100px" style="position:relative;right:10px;" /> --}}

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
        <table border="0" cellpadding="5" cellspacing="5" style="border-collapse:collapse;margin-left: 50px;" width="95%">
            <tr>
                <td style="text-align: center; {{($onumoti->photo)?"padding-left:100px;":""}} padding-bottom:50px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                            অনুমতি পত্রের আবেদন
                        </span>
                    </h2>
                </td>
                <td  valign="top" style="text-align: center;" >

                    @if($onumoti->photo)
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'. $onumoti->photo }}" height="80px" width="80px" style=""/>
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
                        : {{ converter::en2bn(date('d-m-Y', strtotime($onumoti->created_time))) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px">
                    পিন নং
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->pin) }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;height: 20px">
                    ট্রাকিং
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->tracking) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px;">
                    নাম (বাংলা)
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $onumoti->name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    নাম (ইংরেজী)
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $onumoti->name_en }}
                    </span>
                </td>
            </tr>
            <tr>
				<td colspan="1">কর্মক্ষেত্রের নাম (বাংলা)</td>
				<td colspan="2" style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $onumoti->job_sector_bn }}</span></td>

				<td  colspan="1" style="border-left:none;border-bottom:none;">কর্মক্ষেত্রের নাম  (ইংরেজী)</td>
				<td colspan="2" style="border-left:none;"><span>&nbsp;:&nbsp;{{ $onumoti->job_sector_en }}</span></td>


			</tr>
            <tr>
                <td colspan="1">
                    পিতার নাম
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $onumoti->father_name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    মাতার নাম
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $onumoti->mother_name_bn }}
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
						@if($onumoti->gender == 1)
						 	পুরুষ
						@elseif($onumoti->gender == 2)
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

						@if($onumoti->marital_status == 1)
						 	অবিবাহিত
						@elseif($onumoti->marital_status == 2)
							বিবাহিত
						@elseif($onumoti->marital_status == 3)
							তালাকপ্রাপ্ত
						@elseif($onumoti->marital_status == 4)
							বিধবা
						@else
							অন্যান্য
						@endif
                    </span>
                </td>
                @if ($onumoti->marital_status == 2 && $onumoti->gender == 2 && !empty($onumoti->husband_name_bn))
                <td colspan="">
                    স্বামীর নাম
                </td>
                <td colspan="" style="border-left:none;">
                    <span>
                        :  {{ $onumoti->husband_name_bn }}
                    </span>
                </td>
                @endif @if ($onumoti->marital_status == 2 && $onumoti->gender == 1 && !empty($onumoti->wife_name_bn))
                <td colspan="" style="border-left: none">
                    স্ত্রীর নাম
                </td>
                <td colspan="" style="border-left:none;">
                    <span>
                        :  {{ $onumoti->wife_name_bn }}
                    </span>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    ধর্ম
                </td>
                <td style="border-left:none;">
                    <span>
                        : 
					@if($onumoti->religion == 1)
					 	ইসলাম
					@elseif($onumoti->religion == 2)
						হিন্দু
					@elseif($onumoti->religion == 3)
						বৌদ্ধ ধর্ম
					@elseif($onumoti->religion == 4)
						খ্রিস্ট ধর্ম
					@else
						অন্যান্য
					@endif
                    </span>
                </td>
                <td style="border-left:none;">
                    জন্মসনদ নং
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->birth_id) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    হোল্ডিং নং
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->permanent_holding_no) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    পেশা
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ $onumoti->occupation }}
                    </span>
                </td>
                <td style="border-left:none;">
                    শিক্ষাগত যোগ্যতা
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ $onumoti->educational_qualification }}
                    </span>
                </td>
                <td style="border-left:none ">
                    জন্ম তারিখ
                </td>
                <td style="border-left:none;">
                    <span>
                        :
                        <?php echo converter::en2bn(date('d-m-Y', strtotime($onumoti->
                        birth_date)));?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    মোবাইল
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->mobile) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    ই-মেইল
                </td>
                <td colspan="3" style="border-left:none;">
                    <span>
                        : {{ $onumoti->email }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="">
                    ন্যাশনাল আইডি
                </td>
                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->nid) }}
                    </span>
                </td>
                <td style="border-left:none;border-bottom:none;">
                    পাসপোর্ট নং
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::en2bn($onumoti->passport_no) }}
                    </span>
                </td>
            </tr>
            <tr style="height:100px;">
                <td  style="height: 80px;">
                    বর্তমান ঠিকানা
                </td>
                <td colspan="5" style="border-left:none;height: 80px;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $onumoti->present_village_bn }},   রোড/ব্লক/সেক্টর : {{ $onumoti->present_rbs_bn }},     পোষ্ট অফিস :{{ $onumoti->present_postoffice_name }},   ওয়ার্ড নং : {{ converter::en2bn($onumoti->present_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $onumoti->present_upazila_name }},     জেলা :{{ $onumoti->present_district_name }}
                    </p>
                </td>
            </tr>
            <tr style="height:100px;">
                <td style="border-bottom:none;" valign="top">
                    স্থায়ী ঠিকানা
                </td>
                <td colspan="5" style="border-left:none; border-bottom:none;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $onumoti->permanent_village_bn }},   রোড/ব্লক/সেক্টর : {{ $onumoti->permanent_rbs_bn }},     পোষ্ট অফিস :{{ $onumoti->permanent_postoffice_name }},   ওয়ার্ড নং : {{ converter::en2bn($onumoti->permanent_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $onumoti->permanent_upazila_name }},     জেলা :{{ $onumoti->permanent_district_name }}
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
                            ১)   এলাকার গন্যমান্য ২ জন ব্যাক্তি এবং ওয়ার্ড কাউন্সিলর কর্তৃক সত্যায়িত করে ইউনিয়ন পরিষদে জমা দিন।
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

                    $url = request()->root().'/verify/onumoti_application/'.$onumoti->tracking.'/'.$onumoti->union_id.'/'.$onumoti->type;

                    ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">
                    </img>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid black;text-align: center;">
                    <span style="border-top: 1px solid">
                        স্বাক্ষর
                        <br>
                            গন্যমান্য ব্যাক্তি
                        </br>
                    </span>
                </td>
                @if ($print_setting->member)
                <td style="border-bottom:1px solid black;text-align: center;">
                    <span style="border-top: 1px solid" >স্বাক্ষর<br>
                    ওয়ার্ড সদস্য</span>
                </td>
                @endif

                @if ($print_setting->chairman)
                <td style="border-bottom:1px solid black;text-align: center;">
                    <span style="border-top: 1px solid" >স্বাক্ষর<br>
                        চেয়ারম্যানের স্বাক্ষর</span>
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
