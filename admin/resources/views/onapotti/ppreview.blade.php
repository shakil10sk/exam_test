{{-- {{ dd($print_setting) }} --}}
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="">
            <meta charset="utf-8">
                <title>
                   অনাপত্তি আবেদন
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

        {{-- {{ dd($onapotti) }} --}}

        @if(!empty($onapotti))
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
                <td style="text-align: center; padding-bottom:50px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                            অনাপত্তি আবেদন
                        </span>
                    </h2>
                </td>
                <td  valign="top" style="text-align: center;" >


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
                        : {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($onapotti->created_at))) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px">
                    পিন নং
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($onapotti->pin) }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;height: 20px">
                    ট্রাকিং
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($onapotti->tracking) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px;">
                    নাম (বাংলা)
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $onapotti->name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    নাম (ইংরেজী)
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $onapotti->name_en }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    পিতার নাম
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $onapotti->father_name_bn }}
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
						@if($onapotti->gender == 1)
						 	পুরুষ
						@elseif($onapotti->gender == 2)
							মহিলা
						@else
							অন্যান্য
						@endif
                    </span>
                </td>

            </tr>


            <tr style="height:100px;">
                <td  style="height: 80px;">
                    বর্তমান ঠিকানা
                </td>
                <td colspan="5" style="border-left:none;height: 80px;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $onapotti->present_village_bn }},   রোড/ব্লক/সেক্টর : {{ $onapotti->present_rbs_bn }},     পোষ্ট অফিস :{{ $onapotti->present_postoffice_name }},   ওয়ার্ড নং : {{ BanglaConverter::bn_number($onapotti->present_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $onapotti->present_upazila_name }},     জেলা :{{ $onapotti->present_district_name }}
                    </p>
                </td>
            </tr>

            <tr style="height:100px;">
                <td style="border-bottom:none;" valign="top">
                    পূর্বের ঠিকানা
                </td>
                <td colspan="5" style="border-left:none; border-bottom:none;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $onapotti->permanent_village_bn }},   রোড/ব্লক/সেক্টর : {{ $onapotti->permanent_rbs_bn }},     পোষ্ট অফিস :{{ $onapotti->permanent_postoffice_name }},   ওয়ার্ড নং : {{ BanglaConverter::bn_number($onapotti->permanent_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $onapotti->permanent_upazila_name }},     জেলা :{{ $onapotti->permanent_district_name }}
                    </p>
                </td>
            </tr>


        </table>
        <!-----------application area end--------------->
       {{-- verification area start --}}
<br>
       <hr/>
			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 5px; margin-bottom: 50px;">
            	<tr>
            		<td style="text-align: center; font-size: 20px;font-weight: bold;">
            			<span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
            		</td>
            	</tr>
            </table>
<br>
			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                    <tr>
						<td  style="text-align: center;">
							<span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span>
							  <br/>
						</td>
                        @if ($print_setting->member)
                        <td style="text-align: center;">
                            <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;সচিব&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </span>
                            <br/>
                        </td>
                        @endif
                        @if ($print_setting->chairman)
                        <td style="text-align: center;">
                            <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মেয়র &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                 <br/>
                        </td>
                        @endif
				    </tr>
                    <tr style="padding-top:50px;">
                        <td valign="bottom" style="text-align: center; border-bottom: 1px dotted;font-size:13px;height:50px;">
                            <h2>নির্দেশনাবলী / Instruction</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan+1}}" style="border-bottom:1px solid black;font-size:13px">
                        <span>
                    ১) আবেদন পত্রটি  সংশ্লিষ্ট সাধারণ ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনে কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন।
                </span>
                <br>
                <span>
                    ২) পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।
                </span>
                <br>
                <span>
                    ৩) জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন।
                </span>
                <br>
                    <span>
                    ৪) সদ্য তোলা পাসপোর্ট সাইজের ছবি ১ কপি।
                </span>
                <br>
                    <span>
                    ৫) আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে।
                </span>
                        </td>

                <td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
                    <?php

                    $url = $url.'/verify/voter_application/'.$onapotti->tracking.'/'.$onapotti->union_id.'/'.$onapotti->type;

                    ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">
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
