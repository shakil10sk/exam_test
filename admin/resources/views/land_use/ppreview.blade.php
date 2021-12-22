<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="" />
        <meta charset="utf-8" />
        <title> ভূমি ব্যবহার ছাড়পত্রের আবেদন পত্র </title>

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

        @if(!empty($data))
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
        <table border="0" cellpadding="5" cellspacing="5" style="border-collapse:collapse;margin-left: 50px;
        margin-top: 10px; " width="95%">
            <tr>
                <td style="text-align: center; {{($data->photo)?"padding-left:150px;":""}} padding-bottom:10px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                           ভূমি ব্যবহার ছাড়পত্রের আবেদন পত্র
                        </span>
                    </h2>
                </td>
                <td  valign="top" style="text-align: center;" >

                    @if($data->photo)
                        <img src="{{ asset('images/application/'. $data->photo) }}" height="80px" width="80px"/>
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
                        : {{ BanglaConverter::bn_number(date('d-m-Y', strtotime($data->created_time))) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px">
                    পিন নং
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->pin) }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;height: 20px">
                    ট্রাকিং
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->tracking) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="height: 20px;">
                    আবেদনকারীর নাম (বাংলা)
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    আবেদনকারীর নাম (ইংরেজী)
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $data->name_en }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    পিতার নাম
                </td>
                <td colspan="2" style="border-left:none;">
                    <span>
                        : {{ $data->father_name_bn }}
                    </span>
                </td>
                <td colspan="1" style="border-left:none;border-bottom:none;">
                    মাতার নাম
                </td>
                <td colspan="2" style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->mother_name_bn }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    মোবাইল
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->mobile) }}
                    </span>
                </td>
                <td style="border-left:none;">
                    ই-মেইল
                </td>
                <td colspan="3" style="border-left:none;">
                    <span>
                        : {{ $data->email }}
                    </span>
                </td>
            </tr>



            <tr>
                <td colspan="4" style="height: 20px;"></td>
            </tr>





            <tr style="height:10px;">
                <td  style="height: 80px;">
                    বর্তমান ঠিকানা
                </td>
                <td colspan="5" style="border-left:none;height: 80px;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $data->present_village_bn }},   রোড/ব্লক/সেক্টর : {{ $data->present_rbs_bn }},     পোষ্ট অফিস :{{ $data->present_postoffice_name }},   ওয়ার্ড নং : {{ BanglaConverter::bn_number($data->present_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $data->present_upazila_name }},     জেলা :{{ $data->present_district_name }}
                    </p>
                </td>
            </tr>

            <tr style="height:10px;">
                <td style="border-bottom:none;" valign="top">
                    স্থায়ী ঠিকানা
                </td>
                <td colspan="5" style="border-left:none; border-bottom:none;">
                    <p>
                        :  গ্রাম/মহল্লা : {{ $data->permanent_village_bn }},   রোড/ব্লক/সেক্টর : {{ $data->permanent_rbs_bn }},     পোষ্ট অফিস :{{ $data->permanent_postoffice_name }},   ওয়ার্ড নং : {{ BanglaConverter::bn_number($data->permanent_ward_no) }}
                        <br/>
                        উপজেলা/থানা :{{ $data->permanent_upazila_name }},     জেলা :{{ $data->permanent_district_name }}
                    </p>
                </td>
            </tr>

            <tr style="height:10px;">
                <td colspan="6" style="border-left:none; border-bottom:none;height:80px;">
                    <p></p>
                </td>
            </tr>


        </table>

            <div class="row" id="app_section_right" style="margin-top: -79px;">
                <div class="col-sm-12" style="text-align:center;">
                    <div class="app-heading">
                        <span style="border-bottom: 2px solid black" >জমির  বিবরণঃ</span>
                    </div>
                </div>
            </div>
            <div id="app_section_right">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px;" width="95%"  >

                    <tbody><tr>
                        <td>&nbsp;মৌজার নাম</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp; {{ $data->mojar_name  }} </span></td>
                        <td style="border-left:none;border-bottom:none;">মৌজার নং</td>
                        <td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $data->mojar_no  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">জমির পরিমাণ</td>
                        <td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $data->land_amount  }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;দাগ নং-সি এস</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->dag_no_cs  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">দাগ নং- এস এ</td>
                        <td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $data->dag_no_sa  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">দাগ নং-আর এস</td>
                        <td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $data->dag_no_rs  }}</span></td>

                    </tr>

                    <tr>
                        <td>&nbsp;খতিয়ান নং-সি এস</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->khotian_no_cs  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">খতিয়ান নং- এস এ</td>
                        <td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $data->khotian_no_sa  }}</span></td>
                        <td style="border-left:none;border-bottom:none;">খতিয়ান নং-আর এস</td>
                        <td style="border-left:none;border-bottom:none;"><span>&nbsp;:&nbsp;{{ $data->khotian_no_rs  }}</span></td>

                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;প্লট /জমি এর প্রস্তাবিত ব্যবহার</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->plot_proposed_use  }}</span></td>
                        <td style="border-left:none;" colspan="2">প্লটের মালিকানার বিবরণ </td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->plot_owner_details  }}</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;মালিকানার সূত্র ও তারিখ(ক্রয়/উত্তরাধিকারি/হেবা/দান/লিজ/অন্যান্য) </td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->owner_cue  }}</span></td>
                        <td style="border-left:none;" colspan="2">রেজিস্টেশনের তারিখ ও দলিল নং </td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->registration_date  }}</span></td>
                    </tr>
                    </tbody></table>
            </div>

            <div class="row" id="app_section_right" style="margin-bottom: 5px">
                <div class="col-sm-12" style="text-align:center;">
                    <div class="app-heading">

                        <span style="border-bottom: 2px solid black" > ভূমির পারিপার্শ্বিক অবস্থার বর্ণনাঃ</span>
                    </div>
                </div>
            </div>
            <div id="app_section_right">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px;" width="95%" >
                    <tbody><tr>
                        <td>&nbsp;ভূমির বর্তমান ব্যবহার</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->current_land_use  }}</span></td>
                        <td style="border-left:none;">২৫০ মিটার ব্যসার্ধে অন্তর্ভুক্ত ভূমির বর্তমান ব্যবহার</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->radius_land_current_use  }}</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;প্লটের নিকটতম দুরত্বে অবস্থিত প্রধান সড়কের নাম ও প্রশস্ততা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->ploat_near_road  }}</span></td>
                        <td style="border-left:none;">প্লটের সংযোগ সড়কের নাম ও প্রশস্ততা</td>
                        <td style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data->join_ploat_road  }}</span></td>
                    </tr>

                    </tbody></table>
            </div>


        <!-----------application area end--------------->


        {{-- instrunction start --}}
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; " width="95%">
            <tr>
                <td >
                    <p>
                        <span style="border-bottom: 1px dotted;">
                           আমি প্রত্যয়ন করিতেছি যে, বর্ণিত তথ্য ও সংযুক্ত দলিলপত্রাদি সত্য এবং সঠিক।ইহা ছাড়া পৌরকর্তৃপক্ষ চাহিত অন্য যে কোন তথ্যাবলী বা দলিলাদি প্রদানে বাধ্য থাকিব।
                        </span>
                    </p>
                </td>
            </tr>
        </table>

        {{-- instruction area end --}} {{-- verification area start --}}
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px;
        margin-top: 4px; " width="95%">
            <tr style="width: 20px">
                <td style="text-align: center; font-size: 20px;font-weight: bold;">
                    <span style="border-bottom: 1px solid">
                        সত্যায়ন / Verification
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        <span style="border-bottom: 1px dotted;">
                          এই মর্মে প্রত্যয়ন করা যাইতেছে যে, উল্লেখিত জমির মালিকানা দখল সঠিক আছে/নাই। তফসিল বর্ণিত জমিতে সীমানা প্রাচীর/বাড়ী/দোকান/মার্কেট/ফ্যাক্টরি/পুকর এর প্ল্যান অনুমোদন করিলে প্রতিবেশী রাস্তা/ড্রেন /বিদ্যুৎ/গ্যাস ইত্যাদি কোন অসুবিধার সম্ভাবনা নাই/আছে।জমির মালিকানার দলিল পত্র পরীক্ষা করে ভূমি ব্যবহার ছাড়পত্র প্রদান করা যায়/যায় না।তাই পরবর্তী আদেশ ও প্রয়োজনীয় ব্যবস্থা গ্রহনের জন্য প্রতিবেদনে পেশ করা হইল।
                        </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 5px;">
                    <ul style="padding-left:50px;list-style:none;">
                        <li> ১) স্বাক্ষরঃ ........................................................</li>
                        <li> ২) নামঃ ..........................................................</li>
                        <li> কাউন্সিলর, {{ $union->bn_name }}</li>
                        <li>৩)ওয়ার্ড নং .........................................................</li>
                    </ul>
                </td>
            </tr>
        </table>

        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px;
        margin-top: 0px; " width="95%">
            <tr>
                <td colspan="{{$colspan+1}}">
                </td>
                <td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
                    <?php

                    $url = $url.'/verify/landuse/'.$data->tracking.'/'.$data->union_id.'/'.$data->type;

                    ?>
                    <img height="130" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " width="170">

                </td>
            </tr>
            <tr>
                <td  style="border-bottom:1px solid black;text-align: center;">

                    <span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    </span>
                    আবেদনকারীর

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
