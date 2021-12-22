

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
			@if(!empty($data['warish_data']))
			{{-- top area start --}}
			@if(! $print_setting->pad_print )
			<table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 5px">


				<tr>
					<td style="width:1.5in; text-align:center;">
						<img src="{{ env('ADMIN_ASSET_URL').'/images/union_profile/'.$union->main_logo }}" height="100px" width="100px" />
					</td>

					<td style="text-align:center;">
						<font style="font-size:20px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

						<br />

						<font style="font-size:15px; font-weight:bold;">
							{{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
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
						<td style="height: 120px"></td>
					</tr>
				</table>
			@endif

			{{-- top area end	 --}}

				<!-----------heading start--------------->

				<table border="0" style="border-collapse:collapse;margin-left: 50px;" width="95%">
					<tr>
						<td style="text-align: center; {{($data['warish_data']->photo)?"padding-left:100px;":""}} padding-bottom:20px;">
							<h2>
								<span style="border-bottom: 1px solid; ">পারিবারিক সনদের আবেদন</span>
							</h2>
						</td>
						<td  valign="top" style="text-align: center;" >

							@if($data['warish_data']->photo)
								<img src="{{ env('ADMIN_ASSET_URL').'/images/application/'. $data['warish_data']->photo }}" height="80px" width="80px" style=""/>
							@endif

						</td>
					</tr>
				</table>

				<!-----------heading end--------------->

				<!-----------application area start--------------->

					<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; ">
						<tr>
							<td colspan="2" style="font-weight:bold; text-align: center; font-size: 18px; padding-bottom:10px;">বাংলা</td>

							<td colspan="2" style="font-weight:bold;text-align: center;font-size: 18px;padding-bottom:10px;">ইংরেজী</td>

						</tr>
						<tr>
							<td >আবেদনকারী</td>
							<td colspan=""><p>: {{ $data['warish_data']->applicant_name_bn }}</p></td>
							<td>আবেদনকারী</td>
							<td colspan=""><p>: {{ $data['warish_data']->applicant_name_en }}</p></td>
						</tr>

						<tr>

							<td >আবেদনকারীর পিতা</td>
							<td colspan=""><p>: {{ $data['warish_data']->applicant_father_name_bn }}</p></td>
							<td>আবেদনকারীর পিতা</td>
							<td colspan=""><p>: {{ $data['warish_data']->applicant_father_name_en }}</p></td>
						</tr>
						<tr>
							<td >মোবাইল</td>
							<td colspan=""><p>: {{ Converter::en2bn($data['warish_data']->applicant_mobile) }}</p></td>
							<td>ই-মেইল</td>
							<td colspan="" ><p>: {{ $data['warish_data']->applicant_email }}</p></td>
						</tr>

						<tr>
							<td>মৃত ব্যক্তির নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->name_bn }}</p></td>
							<td>মৃত ব্যক্তির নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->name_en }}</p></td>
						</tr>


						@if(!empty($data['warish_data']->husband_name_bn))
						<tr>
							<td>স্বামীর নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->husband_name_bn }} </p></td>
							<td>স্বামীর নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->husband_name_en }}</p></td>
						</tr>

						@endif
						@if(!empty($data['warish_data']->wife_name_bn))

						<tr>
							<td>স্ত্রীর নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->wife_name_bn }}</p></td>
							<td>স্ত্রীর নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->wife_name_en }}</p></td>
						</tr>
						@endif

						<tr>
							<td>পিতার নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->father_name_bn }}</p></td>
							<td>পিতার নাম</td>
							<td colspan="" ><p>: {{ $data['warish_data']->father_name_en }}</p></td>
						</tr>
						<tr>
							<td>মাতার নাম</td>
							<td colspan=""><p>: {{ $data['warish_data']->mother_name_bn }}</p></td>
							<td>মাতার নাম</td>
							<td colspan=""><p>: {{ $data['warish_data']->mother_name_en }}</p></td>
						</tr>
						<tr>
							<td style="border-left:none;">হোল্ডিং  নং </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ Converter::en2bn($data['warish_data']->permanent_holding_no) }}</span></td>
							<td style="border-left:none;">পেশা</td>
							<td  colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ $data['warish_data']->occupation }}</span></td>
						</tr>
						<tr>

							<td style="border-left:none;">বৈবাহিক সম্পর্ক </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;
									@if ($data['warish_data']->marital_status == 1)
										{{ "অবিবাহিত" }}
									@elseif($data['warish_data']->marital_status == 2)
										{{ "বিবাহিত" }}
									@elseif($data['warish_data']->marital_status ==3)
										{{ "বিধবা" }}
									@elseif($data['warish_data']->marital_status ==3)
										{{ "তালাক প্রাপ্ত" }}
									@else
										{{ "অন্যান্য" }}
									@endif

							 </span></td>
							<td style="border-left:none;">লিঙ্গ</td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;
									@if ($data['warish_data']->gender == 1)
										{{ "পুরুষ" }}
									@elseif($data['warish_data']->gender == 2)
										{{ "মহিলা" }}

									@else
										{{ "অন্যান্য" }}
									@endif
							</span></td>
						</tr>

						<tr>
							<td style="border-left:none;">ন্যাশনাল আইডি নং </td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ Converter::en2bn($data['warish_data']->nid) }}</span></td>
							<td style="border-left:none;">মৃত্যু নিবন্ধন নং</td>
							<td colspan="" style="border-left:none;"><span>&nbsp;:&nbsp;{{ Converter::en2bn($data['warish_data']->birth_id) }}</span></td>
						</tr>

						<tr style="height:50px;">
							<td colspan=""valign="top">স্থায়ী ঠিকানা</td>
							<td colspan="3">
								<p style="font-size:14px;">
									: গ্রাম/মহল্লা : &nbsp;{{ $data['warish_data']->permanent_village_bn }},&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : {{ $data['warish_data']->permanent_rbs_bn }}
									পোষ্ট অফিস : &nbsp;{{ $data['warish_data']->permanent_postoffice_name }},&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : {{ Converter::en2bn($data['warish_data']->permanent_ward_no) }}
									 উপজেলা : &nbsp;{{ $data['warish_data']->permanent_upazila_name }}
									 জেলা :  &nbsp;{{ $data['warish_data']->permanent_district_name }}
								</p>
							</td>
						</tr>

{{--						<tr style="height:50px;">--}}
{{--							<td colspan="" valign="top">বর্তমান ঠিকানা</td>--}}
{{--							<td colspan="3">--}}
{{--								<p style="font-size:14px;">--}}
{{--									: গ্রাম/মহল্লা : &nbsp;{{ $data['warish_data']->present_village_en }},&nbsp;&nbsp;&nbsp;রোড/ব্লক/সেক্টর  : {{ $data['warish_data']->present_rbs_en }}--}}
{{--									পোষ্ট অফিস : &nbsp;{{ $data['warish_data']->present_postoffice_name }},&nbsp;&nbsp;&nbsp;ওয়ার্ড নং : {{ Converter::en2bn($data['warish_data']->present_ward_no) }}--}}
{{--									 উপজেলা : &nbsp;{{ $data['warish_data']->present_upazila_name }}--}}
{{--									 জেলা :  &nbsp;{{ $data['warish_data']->present_district_name }}--}}
{{--								</p>--}}
{{--							</td>--}}
{{--						</tr>--}}

						<tr>
							<td>জন্ম তারিখ</td>
							<td><p>: {{ $data['warish_data']->birth_date ? Converter::en2bn(date('d-m-Y', strtotime($data['warish_data']->birth_date))) : null }}</p></td>

                            <td>মৃত্যু তারিখ</td>
							<td><p>: {{ $data['warish_data']->death_date ? Converter::en2bn(date('d-m-Y', strtotime($data['warish_data']->death_date))) : null }}</p></td>
						</tr>

					</table>

				<!-----------application area end--------------->

				<!-----------table area start--------------->

					<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;
					margin-left: 50px; margin-top: 10px;">
						<tr>
							<td style="text-align: center" >
								<h3>পরিবারের সদস্যগনের তালিকাঃ-</h3>
							</td>
						</tr>
					</table>

					<table width="95%"  cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;
					margin-left: 50px; margin-top: 10px;">
						<tr>
							<th style="width:5%;font-size:14px;">ক্রঃ নং</th>
							<th style="width:20%;font-size:14px;">নাম</th>
							<th style="width:10%;font-size:14px;">সম্পর্ক</th>
							<th style="width:8%;font-size:14px;">পরিচয় পত্র নং</th>
							<th style="width:5%;font-size:14px;">ক্রঃ নং</th>
							<th style="width:20%;font-size:14px;">নাম</th>
							<th style="width:10%;font-size:14px;">সম্পর্ক</th>
							<th style="width:8%;font-size:14px;">পরিচয় পত্র নং</th>

						</tr>

						<?php for($i = 0; $i < 10; $i++): ?>

						<tr height=''>
							<td style="text-align:center;font-size:13px;">
								<?php echo Converter::en2bn($i+1); ?>
							</td>

							<td id='' style="text-align:center;text-indent:15px;font-size:14px;">
								@php
									echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->name_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:14px;">

								@php
									echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->relation_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:center;text-indent:15px;font-size:14px;">

								@php
									echo isset ($data["warish_list"][$i]) ? Converter::en2bn($data["warish_list"][$i]->nid) : "";
								@endphp
							</td>

							<td style="text-align:center;font-size:13px;">
								<?php echo Converter::en2bn($i+11); ?>
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:14px;">
								@php
									echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->name_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:left;text-indent:15px;font-size:14px;">

								@php
									echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->relation_bn : "";
								@endphp
							</td>

							<td id='' style="text-align:center;text-indent:15px;font-size:14px;">

								@php
									echo isset ($data["warish_list"][$i+10]) ? Converter::en2bn($data["warish_list"][$i+10]->nid) : "";
								@endphp
							</td>

						</tr>

						<?php endfor; ?>

						<tr height="17px">

							<td colspan="8" style="text-align:right;font-size:12px; padding-right:60px;">উত্তরাধিকারীর সংখ্যা <span>&nbsp;&nbsp; @php echo Converter::en2bn(count($data["warish_list"])) @endphp</span>&nbsp;&nbsp;জন</td>

						</tr>
					</table>

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

				<!-----------table area end--------------->
				<hr/>
            {{-- verification area start --}}


 <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px;
 margin-top: 5px; ">

            <tr>
                <td style="text-align: center; font-size: 20px;font-weight: bold;">
                    <span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
                </td>
            </tr>

    </table>

		<br>
    <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px;
     margin-top: 15px; ">
        <tr>
			<td style="text-align: left;">
                <div style="border-top: 1px solid;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; কাউন্সিলর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </td>
            <td style="text-align: right;">
                <div style="border-top: 1px solid;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;সংরক্ষিত কাউন্সিলর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        ১)   আবেদন পত্রটি  সংশ্লিষ্ট সাধারণ ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনের কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন।
                    </li>
                    <li>
                        ২)  পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।
                    </li>
                    <li>
                        ৩)  ওয়ারিশগণের জন্ম নিবন্ধন / জাতীয় পরিচয় পত্র অথবা একাডেমিক সার্টিফিকেট এর ফটোকপি সাথে জমা দিন।
                    </li>
                        <li>
                        ৪). আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে ।
                    </li>
                </ul>
            </td>
           <td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">
				<?php
					$url =  request()->root().'/verify/family_application/'.$data['warish_data']->tracking.'/'.$data['warish_data']->union_id.'/'.$data['warish_data']->type;
				?>
				<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">
			</td>
        </tr>

    </table>

			{{-- verification area end --}}


			<!------------------ footer area start-------------------->

			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 5px;">
				<tr>
					<td>
						<p><br/>
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
