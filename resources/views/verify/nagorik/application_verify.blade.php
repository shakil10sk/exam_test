<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="">
            <meta charset="utf-8">
                <title>
                    নাগরিক আবেদন পত্র
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

        @if(!empty($nagorik))

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
        <table border="0" style="border-collapse:collapse;margin-left: 50px;" width="95%">
            <tr>
                <td style="text-align: center; {{($nagorik->photo)?"padding-left:100px;":""}} padding-bottom:50px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                            নাগরিকত্ব সনদের আবেদন
                        </span>
                    </h2>
                </td>
                <td  valign="top" style="text-align: center;" >

                    @if($nagorik->photo)
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'. $nagorik->photo }}" height="80px" width="80px" style=""/>
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
                <td colspan="2">
                    <span>
                        : {{ converter::en2bn(date('d-m-Y', strtotime($nagorik->created_time))) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px">
                    পিন নং
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::en2bn($nagorik->pin) }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;height: 20px">
                    ট্রাকিং
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($nagorik->tracking) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px;">
                    নাম (বাংলা)
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $nagorik->name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    নাম (ইংরেজী)
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $nagorik->name_en }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    পিতার নাম
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $nagorik->father_name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    মাতার নাম
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $nagorik->mother_name_bn }}
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
						@if($nagorik->gender == 1)
						 	পুরুষ
						@elseif($nagorik->gender == 2)
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

						@if($nagorik->marital_status == 1)
						 	অবিবাহিত
						@elseif($nagorik->marital_status == 2)
							বিবাহিত
						@elseif($nagorik->marital_status == 3)
							তালাকপ্রাপ্ত
						@elseif($nagorik->marital_status == 4)
							বিধবা
						@else
							অন্যান্য
						@endif
                    </span>
                </td>
                @if ($nagorik->marital_status == 2 && $nagorik->gender == 2 && !empty($nagorik->husband_name_bn))
                <td colspan="">
                    স্বামীর নাম
                </td>
                <td colspan="" style="border-left:none;">
                    <span>
                        :  {{ $nagorik->husband_name_bn }}
                    </span>
                </td>
                @endif
                @if ($nagorik->marital_status == 2 && $nagorik->gender == 1 && !empty($nagorik->wife_name_bn))
                <td colspan="" style="border-left: none">
                    স্ত্রীর নাম
                </td>
                <td colspan="" style="border-left:none;">
                    <span>
                        :  {{ $nagorik->wife_name_bn }}
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
					@if($nagorik->religion == 1)
					 	ইসলাম
					@elseif($nagorik->religion == 2)
						হিন্দু
					@elseif($nagorik->religion == 3)
						বৌদ্ধ ধর্ম
					@elseif($nagorik->religion == 4)
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
                        : {{ converter::en2bn($nagorik->birth_id) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    হোল্ডিং নং
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($nagorik->permanent_holding_no) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    পেশা
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ $nagorik->occupation }}
                    </span>
                </td>
                <td style="border-left:none;">
                    শিক্ষাগত যোগ্যতা
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ $nagorik->educational_qualification }}
                    </span>
                </td>
                <td style="border-left:none ">
                    জন্ম তারিখ
                </td>
                <td style="border-left:none;">
                    <span>
                        :
                        <?php echo converter::en2bn(date('d-m-Y', strtotime($nagorik->
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
                        : {{ converter::en2bn($nagorik->mobile) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    ই-মেইল
                </td>
                <td colspan="3" style="border-left:none;">
                    <span>
                        : {{ $nagorik->email }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="">
                    ন্যাশনাল আইডি
                </td>
                <td colspan="" style="border-left:none;">
                    <span>
                        : {{ converter::en2bn($nagorik->nid) }}
                    </span>
                </td>
                <td style="border-left:none;border-bottom:none;">
                    পাসপোর্ট নং
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ converter::en2bn($nagorik->passport_no) }}
                    </span>
                </td>
            </tr>
            <tr style="height:100px;">
                <td  style="height: 80px;">
                    বর্তমান ঠিকানা
                </td>
                <td colspan="5" style="border-left:none;height: 80px;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $nagorik->present_village_bn }},   রোড/ব্লক/সেক্টর : {{ $nagorik->present_rbs_bn }},     পোষ্ট অফিস :{{ $nagorik->present_postoffice_name }},   ওয়ার্ড নং : {{ converter::en2bn($nagorik->present_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $nagorik->present_upazila_name }},     জেলা :{{ $nagorik->present_district_name }}
                    </p>
                </td>
            </tr>
            <tr style="height:100px;">
                <td style="border-bottom:none;" valign="top">
                    স্থায়ী ঠিকানা
                </td>
                <td colspan="5" style="border-left:none; border-bottom:none;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $nagorik->permanent_village_bn }},   রোড/ব্লক/সেক্টর : {{ $nagorik->permanent_rbs_bn }},     পোষ্ট অফিস :{{ $nagorik->permanent_postoffice_name }},   ওয়ার্ড নং : {{ converter::en2bn($nagorik->permanent_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $nagorik->permanent_upazila_name }},     জেলা :{{ $nagorik->permanent_district_name }}
                    </p>
                </td>
            </tr>
        </table>
        <!-----------application area end--------------->

         {{-- verification area start --}}

         <table width="95%" cellpadding="0" cellspacing="0" border="0"
         style="border-collapse:collapse;margin-left: 50px; margin-top: 55px; ">
         <tr>

             <td style="text-align: right;">
                         <span style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আবেদনকারী স্বাক্ষর
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         </span>
             </td>
         </tr>
     </table>
     
            <br/>
            <hr/>
            <table width="95%"  cellpadding="0" cellspaci ng="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 10px; ">

                <tr>
                    <td style="text-align: center; font-size: 20px;font-weight: bold;">
                        <span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
                    </td>
                </tr>

            </table>
    <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 120px; ">
        <tr>
            <td style="text-align: center;">
                <div style="border-top: 1px solid;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; কাউন্সিলর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </td>

            @if ($print_setting->member)
            <td style="text-align: center;">
                <div style="border-top: 1px solid;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; সচিব  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </td>
            @endif

            @if ($print_setting->chairman)
            <td style="text-align: center;">
                <div style="border-top: 1px solid">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মেয়র  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </td>
            @endif
        </tr>
        <br/>
        <tr>
            <td style="text-align: left; border-bottom: 1px dotted; font-size: 10px;">
                <h2>নির্দেশনাবলী / Instruction</h2>
            </td>
            <td></td>
        </tr>

        <br/>

        <tr>
            <td  style="border-bottom:1px solid black;">
                <ul style="padding-left:50px;list-style:none; font-size:13px;">
                <li>
                    ১)   আবেদন পত্রটি  সংশ্লিষ্ট সাধারণ ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনে কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন।
                </li>
                <li>
                    ২)  পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।
                </li>
                <li>
                    ৩)  জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন।
                </li>
                    <li>
                    ৪). সদ্য তোলা পাসপোর্ট সাইজের ছবি ১ কপি ।
                </li>
                    <li>
                    ৫). আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে ।
                </li>

                </ul>
            </td>
            <td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
                    <?php

                        $url = request()->root().'/verify/nagorik_application/'.$nagorik->tracking.'/'.$nagorik->union_id.'/'.$nagorik->type;

                    ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">
                    </img>
                </td>
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
