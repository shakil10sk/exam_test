

<!DOCTYPE HTML>
<html lang="en-US">
<head>
<base href=''/>
	<meta charset="UTF-8">
	<title> পারিবারিক সনদের আবেদন </title>

	<style type="text/css" media="all">

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

<body>

			@if(!empty($data['family_data']))
			{{-- top area start --}}
			@if(! $print_setting->pad_print )
				@include('layouts.pdf_sub_layouts.application_header')
			@else
				<table>
					<tr>
						<td style="height: 150px"></td>
					</tr>
				</table>
			@endif
				{{-- top area end	 --}}

				<!-----------heading start--------------->

				<table  width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 15px; ">
					<tr>
						<td style="text-align: center; {{($data['family_data']->photo)?"padding-left:150px;":""}} padding-bottom:50px;">
							<h2>
								<span style="border-bottom: 1px solid; ">পারিবারিক সনদের আবেদন</span>
							</h2>
						</td>
						<td  valign="top" style="text-align: center;" >

							@if($data['family_data']->photo)
								<img src="{{ asset('images/application/'. $data['family_data']->photo) }}" height="80px" width="80px"/>
							@endif

						</td>
					</tr>
				</table>

				<!-----------heading end--------------->

				<!-----------application area start--------------->

					<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; ">
						<tr>
							<td colspan="2" style="font-weight:bold; text-align: center; font-size: 18px; padding-bottom:8px;">বাংলা</td>

							<td colspan="2" style="font-weight:bold;text-align: center;font-size: 18px;padding-bottom:8px;">ইংরেজী</td>

						</tr>
						<tr>
							<td >আবেদনকারী</td>
							<td colspan=""><p>: {{ $data['family_data']->applicant_name_bn }}</p></td>
							<td>আবেদনকারী</td>
							<td colspan=""><p>: {{ $data['family_data']->applicant_name_en }}</p></td>
						</tr>

						<tr>

							<td >আবেদনকারীর পিতা</td>
							<td colspan=""><p>: {{ $data['family_data']->applicant_father_name_bn }}</p></td>
							<td>আবেদনকারীর পিতা</td>
							<td colspan=""><p>: {{ $data['family_data']->applicant_father_name_en }}</p></td>
						</tr>
						<tr>
							<td >মোবাইল</td>
							<td colspan=""><p>: {{ BanglaConverter::bn_others($data['family_data']->applicant_mobile) }}</p></td>
							<td>ই-মেইল</td>
							<td colspan="" ><p>: {{ $data['family_data']->applicant_email }}</p></td>
						</tr>

						<tr>
							<td>মৃত ব্যক্তির নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->name_bn }}</p></td>
							<td>মৃত ব্যক্তির নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->name_en }}</p></td>
						</tr>


						@if(!empty($data['family_data']->husband_name_bn))
						<tr>
							<td>স্বামীর নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->husband_name_bn }} </p></td>
							<td>স্বামীর নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->husband_name_en }}</p></td>
						</tr>

						@endif
						@if(!empty($data['family_data']->wife_name_bn))

						<tr>
							<td>স্ত্রীর নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->wife_name_bn }}</p></td>
							<td>স্ত্রীর নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->wife_name_en }}</p></td>
						</tr>
						@endif

						<tr>
							<td>পিতার নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->father_name_bn }}</p></td>
							<td>পিতার নাম</td>
							<td colspan="" ><p>: {{ $data['family_data']->father_name_en }}</p></td>
						</tr>
						<tr>
							<td>মাতার নাম</td>
							<td colspan=""><p>: {{ $data['family_data']->mother_name_bn }}</p></td>
							<td>মাতার নাম</td>
							<td colspan=""><p>: {{ $data['family_data']->mother_name_en }}</p></td>
						</tr>
						<tr>
							<td style="border-left:none;">হোল্ডিং  নং </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ BanglaConverter::bn_number($data['family_data']->permanent_holding_no) }}</span></td>
							<td style="border-left:none;">পেশা</td>
							<td  colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data['family_data']->occupation }}</span></td>
						</tr>
						<tr>

							<td style="border-left:none;">বৈবাহিক সম্পর্ক </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;
									@if ($data['family_data']->marital_status == 1)
										{{ "অবিবাহিত" }}
									@elseif($data['family_data']->marital_status == 2)
										{{ "বিবাহিত" }}
									@elseif($data['family_data']->marital_status ==3)
										{{ "বিধবা" }}
									@elseif($data['family_data']->marital_status ==3)
										{{ "তালাক প্রাপ্ত" }}
									@else
										{{ "অন্যান্য" }}
									@endif

							 </span></td>
							<td style="border-left:none;">লিঙ্গ</td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;
									@if ($data['family_data']->gender == 1)
										{{ "পুরুষ" }}
									@elseif($data['family_data']->gender == 2)
										{{ "মহিলা" }}

									@else
										{{ "অন্যান্য" }}
									@endif
							</span></td>
						</tr>

						<tr>
							<td style="border-left:none;">ন্যাশনাল আইডি নং </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['family_data']->nid) }}</span></td>
							<td style="border-left:none;">মৃত্যু নিবন্ধন নং</td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['family_data']->birth_id) }}</span></td>
						</tr>
						<tr>
							<td style="border-left:none;">ট্র্যাকিং </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['family_data']->tracking) }}</span></td>
							<td style="border-left:none;">পিন</td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ BanglaConverter::bn_others($data['family_data']->pin) }}</span></td>
						</tr>

						<tr style="height:50px;">
							<td colspan=""valign="top">স্থায়ী ঠিকানা</td>
							<td colspan="3">
								<p style="font-size:13px;">
									: গ্রাম/মহল্লা : &nbsp;{{ $data['family_data']->permanent_village_bn }},&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : {{ $data['family_data']->permanent_rbs_bn }}
									পোষ্ট অফিস : &nbsp;{{ $data['family_data']->permanent_postoffice_name }},&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : {{ BanglaConverter::bn_number($data['family_data']->permanent_ward_no) }}
									 উপজেলা : &nbsp;{{ $data['family_data']->permanent_upazila_name }}
									 জেলা :  &nbsp;{{ $data['family_data']->permanent_district_name }}
								</p>
							</td>
						</tr>

{{--						<tr style="height:50px;">--}}
{{--							<td colspan="" valign="top">বর্তমান ঠিকানা</td>--}}
{{--							<td colspan="3">--}}
{{--								<p style="font-size:13px;">--}}
{{--									: গ্রাম/মহল্লা : &nbsp;{{ $data['family_data']->present_village_en }},&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : {{ $data['family_data']->present_rbs_en }}--}}
{{--									পোষ্ট অফিস : &nbsp;{{ $data['family_data']->present_postoffice_name }},&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : {{ BanglaConverter::bn_number($data['family_data']->present_ward_no) }}--}}
{{--									 উপজেলা : &nbsp;{{ $data['family_data']->present_upazila_name }}--}}
{{--									 জেলা :  &nbsp;{{ $data['family_data']->present_district_name }}--}}
{{--								</p>--}}
{{--							</td>--}}
{{--						</tr>--}}

						<tr>
							<td>জন্ম তারিখ</td>
							<td><p>: {{ $data['family_data']->birth_date ? BanglaConverter::bn_others(date('d-m-Y', strtotime($data['family_data']->birth_date))) : null }}</p></td>
						</tr>

					</table>

				<!-----------application area end--------------->

				<!-----------table area start--------------->

					<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 5px;">
						<tr>
							<td style="text-align: center">
								<h3>পরিবারের সদস্যগনের তালিকাঃ-</h3>
							</td>
						</tr>
					</table>

					<table width="95%"  cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;margin-left: 50px; margin-top: 8px;">
						<tr>
							<th style="width:5%;font-size:13px;">ক্রঃ নং</th>
							<th style="width:20%;font-size:13px;">নাম</th>
							<th style="width:10%;font-size:13px;">সম্পর্ক</th>
							<th style="width:8%;font-size:13px;">পরিচয় পত্র</th>
							<th style="width:5%;font-size:13px;">ক্রঃ নং</th>
							<th style="width:20%;font-size:13px;">নাম</th>
							<th style="width:10%;font-size:13px;">সম্পর্ক</th>
							<th style="width:8%;font-size:13px;">পরিচয় পত্র</th>

						</tr>

						<?php for($i = 0; $i < 10; $i++): ?>

						<tr height=''>
							<td style="text-align:center;font-size:13px;">
								<?php echo BanglaConverter::bn_number($i+1); ?>
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:13px;">
								@php
									echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->name_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:13px;">

								@php
									echo isset ($data["family_list"][$i]) ? $data["family_list"][$i]->relation_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:13px;">

								@php
									echo isset ($data["family_list"][$i]) ? BanglaConverter::bn_number($data["family_list"][$i]->nid) : "";
								@endphp
							</td>

							<td style="text-align:center;font-size:13px;">
								<?php echo BanglaConverter::bn_number($i+11); ?>
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:13px;">
								@php
									echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->name_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:13px;">

								@php
									echo isset ($data["family_list"][$i+10]) ? $data["family_list"][$i+10]->relation_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:13px;">

								@php
									echo isset ($data["family_list"][$i+10]) ? BanglaConverter::bn_number($data["family_list"][$i+10]->nid) : "";
								@endphp
							</td>

						</tr>

						<?php endfor; ?>

						<tr height="18px">

							<td colspan="8" style="text-align:right;font-size:12px; padding-right:60px;">উত্তরাধিকারীর সংখ্যা <span>&nbsp;&nbsp; @php echo BanglaConverter::bn_number(count($data["family_list"])) @endphp</span>&nbsp;&nbsp;জন</td>

						</tr>
					</table>

				<!-----------table area end--------------->



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

                <hr/>

                <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px;">
                    <tr>
                        <td style="text-align: center; font-size: 20px;font-weight: bold;">
                            <span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
                        </td>
                    </tr>
                </table>

			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 35px; ">
                    <tr>
						<td  style="text-align: center; margin-bottom:5px;">
							<tr>
								<td><span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</span>
								</td>
								<td><span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;সংরক্ষিত  কাউন্সিলর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</span>
								</td>
							</tr>
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
                    <tr>
                        <td valign="bottom" style="text-align: left; border-bottom: 1px dotted;font-size:13px;">
                            <h2>নির্দেশনাবলী / Instruction</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="{{$colspan+1}}" style="border-bottom:1px solid black;font-size:13px">
                                    <span>১) আবেদন পত্রটি  সংশ্লিষ্ট সাধারণ ওয়ার্ড কাউন্সিলর অথবা সংরক্ষিত কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন। </span>
									<br>
                                    <span>২) ওয়ারিশগণের জন্ম নিবন্ধন / জাতীয় পরিচয় পত্র অথবা একাডেমিক সার্টিফিকেট এর ফটোকপি সাথে জমা দিন।  </span>
									<br>
                                    <span>৩) পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।</span>
									<br>
                                    <span>৪) আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে।</span>

                        </td>
                       <td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
                            <?php

                            $url = $url.'/verify/family_application/'.$data['family_data']->tracking.'/'.$data['family_data']->union_id.'/'.$data['family_data']->type;

                            ?>

                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">
                        </td>
                    </tr>
			</table>


			{{-- verification area end --}}


			<!------------------ footer area start-------------------->

			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 10px;">
				<tr>
					<td>
						<p>
							E-mail&nbsp;:&nbsp;{{ $union->email }}
						</p>
					</td>
					<td style="text-align: right;">
						<p> Developed By: Innovation IT <br />
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
