
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<base href=''/>
	<meta charset="UTF-8">
	<title> ট্রেড লাইসেন্স আবেদন </title>

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
</head>

<body>

        @if(!empty($trade['organization']))

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

		<table  width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
			<tr>
				<td style="text-align: center;">
					<h2>
						<span style="border-bottom: 1px solid; ">ট্রেড লাইসেন্স আবেদন</span>
					</h2>
				</td>
			</tr>
		</table>

		<!-----------heading end--------------->


		<table style="width:95%; margin-left:48px;margin-top:10px;" cellpadding="0" cellspacing="0">

            <tr>

                <td  valign="top" style="text-align: center;" >

                    @foreach($trade['organization']['owner_list'] as $owner)

                        @if(!empty($owner['photo']))

                            <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'. $owner['photo'] }}" height="80px" width="80px" style="" />

                        @endif

                    @endforeach

                </td>

            </tr>

        </table>

		<!-----------description area start--------------->

		<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">

			<tr>
				<td style="text-indent: 20px;text-align:left; font-size:16px;">ট্র্যাকিং নং</td>
				<td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['tracking'] }}</td>
				<td style="">আবেদনের তারিখ</td>
				<td style="">:&nbsp;{{ converter::en2bn(date('d-m-Y', strtotime($trade['organization']['created_time']))) }}</td>
			</tr>

            <tr>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসার ধরণ</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type'] }}</td>
            </tr>

            <tr>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ Converter::en2bn($trade['organization']['mobile']) }}</td>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">ই-মেইল</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['email'] }}</td>
            </tr>
        </table>

        <!-----------description area end--------------->

        <!-----------owner area start--------------->

        <table width="88%" cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;border:1px dashed lightgray; text-align: center; margin:0 auto; margin-top: 20px" >

                <tr style="text-align: center;font-weight:bolder;">
                    <th>নং</th>
                    <td style="font-weight: 700px; font-size: 17px;">মালিকের নাম</td>
                    <th style="font-weight: 700px; font-size: 17px;">পিতা/স্বামীর নাম</th>
                    <th style="font-weight: 700px; font-size: 17px;">পরিচয় পত্র/ জন্ম নিবন্ধন</th>
                    <th style="font-weight: 700px; font-size: 17px;">মোবাইল</th>
                </tr>

                @php
                    $i = 1;
                @endphp

                @foreach($trade['organization']['owner_list'] as $owner)


                <tr height="20px" style="text-align: center;">
                    <td>{{ Converter::en2bn($i++) }}</td>
                    <td>{{  $owner['name_bn'] }}</td>

                    <td>

	                    @if ($owner['gender'] == 2 && $owner['marital_status'] == 2)
	                        {{ $owner['husband_name_bn'] }}
	                    @else
	                        {{ $owner['father_name_bn'] }}
	                    @endif

                	</td>

               		 <td>

	                    @if ($owner['nid'] > 0)
	                          {{ Converter::en2bn($owner['nid']) }}
	                    @else
	                         {{ Converter::en2bn($owner['birth_id']) }}
	                    @endif

                	</td>

                	<td>{{ Converter::en2bn($owner['mobile']) }}</td>

                </tr>

                <tr height='25px' >
                    <td colspan="4">

                        <p style="font-size:15px;">ঠিকানা
                        : &nbsp;{{ $owner['permanent_village_bn'] }},&nbsp;&nbsp;&nbsp;, {{ $owner['permanent_rbs_bn'] }}
                      , &nbsp;, {{ $owner['permanent_postoffice_name'] }},&nbsp;&nbsp;&nbsp; {{ Converter::en2bn($owner['permanent_ward_no']) }}
                        &nbsp;, {{ $owner['permanent_upazila_name'] }}
                       , &nbsp; {{ $owner['permanent_district_name'] }}
                        </p>

                    </td>
                </tr>

                @endforeach

            </table>

			<!-----------owner area end--------------->

			<!-----------address start--------------->

			<table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed; margin-top: 10px">

                <tr>
                    <td align='left'  style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
                    <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;"> : {{ $trade['organization']['trade_village_bn'] }}&nbsp;{{ Converter::en2bn($trade['organization']['trade_ward_no']) }},&nbsp;{{ $trade['organization']['trade_postoffice_name'] }},&nbsp;{{ $trade['organization']['trade_upazila_name'] }},&nbsp;{{ $trade['organization']['trade_district_name'] }}
                    </td>
                </tr>

            </table>

            {{-- address end	 --}}


            {{-- instrunction start --}}

            <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">

            	<tr>
            		<td style="text-align: center; border-bottom: 1px dotted;">
            			<h2>নির্দেশনাবলী / Instruction</h2>
            		</td>
            	</tr>

            	<tr>
            		<td style="padding-top: 20px;">
            			<ul style="padding-left:50px;list-style:none;">
							<li> ১) &nbsp; এলাকার গন্যমান্য ২ জন ব্যাক্তি এবং ওয়ার্ড কাউন্সিলর কর্তৃক  সত্যায়িত করে ইউনিয়ন পরিষদে জমা দিন।</li>
							<li> ২) &nbsp;১ কপি পাসপোর্ট সাইজ ছবি,(সত্যায়িত)</li>
							<li>৩)&nbsp; আবেদন পত্রের অবস্থা জানার জন্য  ট্র্যাকিং নাম্বার দিয়ে ওয়েব সাইট থেকে যাচাই করুন ।</li>
						</ul>
            		</td>
            	</tr>

            </table>

            {{-- instruction area end --}}


            {{-- verification area start --}}


			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">

            	<tr>
            		<td style="text-align: center; font-size: 20px;font-weight: bold;">
            			<span style="border-bottom: 1px solid">সত্যায়ন / Verification</span>
            		</td>
            	</tr>

            </table>



			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">

				<tr>
					<td colspan="{{$colspan+1}}"></td>
					<td rowspan="4" style="height:140px;width:160px; border-top:1px solid black; border-left:1px solid black;">

                      <?php

                        $url = request()->root().'/verify/trade_application/'.$trade['organization']['tracking'].'/'.$trade['organization']['union_id'].$type;
                      ?>

                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">

					</td>
				</tr>

				<tr>
					<td  style="border-bottom:1px solid black;text-align: center;">

						<span style="border-top: 1px solid" >স্বাক্ষর<br>
						গন্যমান্য ব্যাক্তি</span>
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

			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px;">
				<tr>
					<td>
						<p>{{ request()->getHost() }},
							E-mail&nbsp;:&nbsp;{{ $union->email }}
						</p>
					</td>
					<td style="text-align: right;">
						<p> Developed by: Innovation IT <br />
							www.innovationit.com.bd
						</p>
					</td>
				</tr>
			</table>

			<!------------------ footer area end-------------------->
            @else
                <h2 style="text-align: center;color: red;">দঃখিত ! ট্র্যাকিং নাম্বারটি সঠিক নয়</h2>
            @endif


</body>
</html>
