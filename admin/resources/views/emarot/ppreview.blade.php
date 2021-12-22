<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <base href="">
    <meta charset="utf-8">
    <title>
        ইমারত নির্মাণ আবেদন পত্র
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

@if(!empty($emarot))
    @if(! $print_setting->pad_print )
        @include('layouts.pdf_sub_layouts.application_header')

    @else
        <table>
            <tr>
                <td style="height: 50px"></td>
            </tr>
        </table>
    @endif
    <!-----------top area end--------------->
    <!-----------heading start--------------->
    <table border="0" cellpadding="5" cellspacing="5"
           style="border-collapse:collapse;margin-left: 20px; " width="95%">
        <tr>
            <td style="text-align: center; {{($emarot->photo)?"padding-left:150px;":""}}">
                <h2>
                        <span style="border-bottom: 1px solid; ">
                          ইমারত নির্মাণ আবেদন পত্র
                        </span>
                </h2>
            </td>
            <td style="text-align: center; padding-bottom:50px;">

                @if($emarot->photo)
                    <img src="{{ asset('images/application/'. $emarot->photo) }}" height="80px" width="80px"/>
                @endif

            </td>
        </tr>
    </table>

    <!-----------heading end--------------->
    <div class="app_area" style="width: 95%; margin-left: 30px">
        <div class="fix structure app_section">
            <div id="" style="margin: 5px">
                <form>
                    <p style="margin-right: 15px"> ট্র্যাকিং আইডি নং -<span>{{ BanglaConverter::bn_others($emarot->tracking)}}
                    </p>
                </form>
            </div>
            <div id="app_section_right">
                <table class="table1 tabale-borderd" width="93%" style="margin-bottom: 5px">
                    <tbody>
                    <tr>
                        <td>&nbsp;আবেদনকারীর পূর্ন নাম</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{ $emarot->name_bn  }}</span></td>
                        <td style="border-left:none;">পিতা/স্বামীর নাম</td>
                        <td style="border-left:none;" colspan="2">
                            <span>&nbsp;:&nbsp;{{ $emarot->father_name_bn  }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;স্থায়ী ঠিকানা</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{
            $emarot->permanent_upazila_name }}, {{
            $emarot->permanent_district_name }}</span></td>
                        <td style="border-left:none;"> বর্তমান ঠিকানা</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{
            $emarot->present_upazila_name }}, {{
            $emarot->present_district_name }}</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row" id="app_section_right">
                <div class="col-sm-12" style="text-align:center;">
                    <div class="app-heading">
                       <span style="border-bottom: 1px dotted black">যে দাগের জমিতে ইমারত নির্মাণ/পুকুর খনন /পাহাড়
                           কর্তণ/বা
                           ধ্বংস
                           করা হইবে উহার
                           বিবরণঃ</span>
                    </div>
                </div>
            </div>

            <div id="app_section_right">
                <table class="table1" width="95%">
                    <tbody>
                    <tr>
                        <td>&nbsp;এলাকার নাম</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{ $emarot->area_name  }}</span>
                        </td>
                        <td style="border-left:none;">মৌজার নাম</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{ $emarot->mojar_name  }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;রাস্তার নাম</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->road_name  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">ওয়ার্ড নং</td>
                        <td style="border-left:none;border-bottom:none;">
                            <span>&nbsp;:&nbsp;{{ $emarot->emarot_word_no  }}</span>
                        </td>
                        <td style="border-left:none;border-bottom:none;">সিট নং</td>
                        <td style="border-left:none;border-bottom:none;">
                            <span>&nbsp;:&nbsp;{{ $emarot->sit_no  }} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;দাগ নং-সি এস</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->dag_no_cs  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">দাগ নং- এস এ</td>
                        <td style="border-left:none;border-bottom:none;">
                            <span>&nbsp;:&nbsp;{{ $emarot->dag_no_sa  }}</span>
                        </td>
                        <td style="border-left:none;border-bottom:none;">দাগ নং-আর এস</td>
                        <td style="border-left:none;border-bottom:none;">
                            <span>&nbsp;:&nbsp;{{ $emarot->dag_no_rs  }}</span>
                        </td>

                    </tr>

                    <tr>
                        <td>&nbsp;খতিয়ান নং-সি এস</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->khotian_no_cs  }} </span></td>
                        <td style="border-left:none;border-bottom:none;">খতিয়ান নং- এস এ</td>
                        <td style="border-left:none;border-bottom:none;">
                            <span>&nbsp;:&nbsp;{{ $emarot->khotian_no_sa  }} </span>
                        </td>
                        <td style="border-left:none;border-bottom:none;">খতিয়ান নং-আর এস</td>
                        <td style="border-left:none;border-bottom:none;">
                            <span>&nbsp;:&nbsp;{{ $emarot->khotian_no_rs  }}</span>
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;আবেদকারীর/আবেদনকারীগনের জমির পরিমাণ</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->land_amount  }}</span></td>
                        <td style="border-left:none;" colspan="2">আবেদকারী কি সূত্রে জমি অর্জন করেছেন</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->land_earn_description  }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="row" id="app_section_right">
                <div class="col-sm-12" style="text-align:center;">
                    <div class="app-heading">
                        <span style="border-bottom: 1px dotted black">সাইটের বিবরণ/সাইটের চৌহদ্দিঃ</span>
                    </div>

                </div>
            </div>

            <div id="app_section_right">
                <table class="table1 tabale-borderd" width="93%">
                    <tbody>
                    <tr>
                        <td>&nbsp;উত্তর</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{ $emarot->north  }}</span></td>
                        <td style="border-left:none;">পূর্ব</td>
                        <td style="border-left:none;" colspan="2">
                            <span>&nbsp;:&nbsp;{{ $emarot->east  }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;দক্ষিন</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{
            $emarot->south }}</span></td>
                        <td style="border-left:none;"> পশ্চিম</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{
            $emarot->west }}</span></td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="row" id="app_section_right">
                <div class="col-sm-12" style="text-align:center;">
                    <div class="app-heading">
                        <span style="border-bottom: 1px dotted black">  সাইটের নিকটস্থ রাস্তার বিবরণঃ</span>
                    </div>
                </div>
            </div>

            <div id="app_section_right">
                <table class="table1">
                    <tbody>
                    <tr>
                        <td>&nbsp;নাম</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->site_name  }}</span></td>
                        <td style="border-left:none;">অবস্থান</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->position  }}</span></td>
                        <td style="border-left:none;">দূরত্ব</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->distance  }} </span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;নিকটস্থ রাস্তা হতে সাইটে যাতায়তের উপায়</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{ $emarot->near_way  }}</span>
                        </td>
                        <td style="border-left:none;">বিস্তার</td>
                        <td style="border-left:none;" colspan="2"><span>&nbsp;:&nbsp;{{ $emarot->spread  }}</span></td>
                    </tr>

                    </tbody>
                </table>
            </div>


            <div id="app_section_right">
                <table class="table1">
                    <tbody>
                    <tr>
                        <td>&nbsp;বিদ্যুৎ সরবরাহের লাইন আছে কিনা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->electricity_line  }} </span></td>
                        <td style="border-left:none;">পানি সরবরাহের লাইন আছে কিনা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->water_line  }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;গ্যাস সরবরাহের লাইন আছে কিনা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->gass_line  }} </span></td>
                        <td style="border-left:none;">পয়ঃনিস্কাশন সরবরাহের লাইন আছে কিনা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->drain_line  }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;প্রস্তাবিত ইমারতের ক্ষেত্রে সেপ্টিক ট্যাঙ্কের ব্যবস্থা আছে কিনা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $emarot->ceptic_tank  }}</span></td>

                    </tr>

                    </tbody>
                </table>
            </div>


            <div class="row" id="app_section_right">
                <div class="col-sm-12" style="text-align:center;">
                    <div class="app-heading">
                        <span style="border-bottom: 1px dotted black">  প্রস্তাবিত ইমারত নির্মান /পুকুর খনন /পাহাড় কর্তন বা ধ্বংস সাধনের স্থান হইতে নিকটবর্তীঃ</span>
                    </div>
                </div>
            </div>

            <div id="app_section_right">
                <table class="table1">
                    <tbody>

                    <tr>
                        <td colspan="4" style="border-left:none; valign:middle;">
                            আমি <span style="font-weight:bold;">{{ $emarot->name_bn  }},</span> ইমারত নির্মাণ/পুকুর
                            খনন/পাহাড়
                            কর্তণ বা ধ্বংস সাধন অনুমোদনের জন্য প্রয়োজনীয় নকশার ....... ফর্দ এবং ... টাকা ফি চালান নং
                            .... তারিখ ..... এর মাধ্যমে যথাযথ কর্তৃপক্ষের নিকট জমা দিয়া উক্ত ব্যাংক ড্রাফট/
                            পে-অর্ডার/ট্রেজারী চালান এর কপি এতদসঙ্গে সংযুক্ত করতঃ ঘোষনা করিতেছি যে, সংযুক্ত নকশা ইমারত
                            নির্মাণ বিধিমালা, ১৯৯৩ মোতাবেক প্রণীত এবং এই আবেদন পত্রে বর্ণিত তথ্য ও সংযুক্ত নকশার বিবরণ
                            সত্য।
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-----------application area end--------------->
    {{-- verification area start --}}

    <table width="95%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 35px;">
        <tr>
            <td style="text-align: right;">
                        <span style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আবেদনকারী স্বাক্ষর
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span>
            </td>
        </tr>
    </table>

    <hr/>

    <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 0px; ">
            	<tr>
            		<td style="text-align: center; font-size: 16px;font-weight: bold;">
            			<span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
            		</td>
            	</tr>
            </table>
			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 60px; ">
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

                $url = $url . '/verify/prottyon_application/' . $emarot->tracking . '/' . $emarot->union_id . '/' . $emarot->type;

                ?>
                <img height="130"
                     src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} "
                     width="170">
            </td>
                    </tr>
			</table>

    {{-- verification area end --}}
    <!------------------ footer area start-------------------->
    <table border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse;margin-left: 50px; margin-top: 20px;" width="95%">
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
