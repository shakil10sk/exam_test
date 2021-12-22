
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
				<td style="padding-left: 50px;">আবেদনের তারিখ</td>
				<td style="">:&nbsp;{{ converter::en2bn(date('d-m-Y', strtotime($trade['organization']['created_time']))) }}</td>
			</tr>

            <tr>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['organization_name_bn'] }}</td>
                <td style="text-indent: 20px;text-align:left; font-size:16px; padding-left: 50px;">ব্যবসার ধরণ</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ $trade['organization']['business_type'] }}</td>
            </tr>

            <tr>
                <td style="text-indent: 20px;text-align:left; font-size:16px;">মোবাইল</td>
                <td style="font-size:16px; text-align:left;">:&nbsp;{{ Converter::en2bn($trade['organization']['mobile']) }}</td>
                <td style="padding-left: 50px;text-indent: 20px;text-align:left; font-size:16px;">ই-মেইল</td>
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
                    <!--<th style="font-weight: 700px; font-size: 17px;">মোবাইল</th>-->
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

                        <p style="font-size:15px;">স্থায়ী ঠিকানা
                        : &nbsp;গ্রাম/মহল্লা:&nbsp;{{ $owner['permanent_village_bn'] }}&nbsp;
                         রোড/ব্লক/সেক্টর: {{ $owner['permanent_rbs_bn'] }}&nbsp;
                          হোল্ডিং নং: &nbsp;{{ Converter::en2bn($owner['permanent_holding_no']) }}&nbsp;
                          ওয়ার্ড নং: &nbsp; {{ Converter::en2bn($owner['permanent_ward_no']) }}
                       &nbsp; {{ $owner['permanent_postoffice_name'] }}
                        &nbsp; {{ $owner['permanent_upazila_name'] }}
                        &nbsp; {{ $owner['permanent_district_name'] }}
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
                    <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;"> :&nbsp;গ্রাম/মহল্লা:&nbsp;{{ $trade['organization']['trade_village_bn'] }}
                        &nbsp;রোড/ব্লক/সেক্টর:&nbsp;{{ Converter::en2bn($trade['organization']['trade_rbs_bn']) }}&nbsp;
                        হোল্ডিং নং: &nbsp;{{ Converter::en2bn($trade['organization']['trade_holding_no']) }}&nbsp;
                        ওয়ার্ড নং: &nbsp;{{ Converter::en2bn($trade['organization']['trade_ward_no']) }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td valign='top' style="font-weight:bold; font-size:18px; text-align:left;">
                        &nbsp;
                        {{ $trade['organization']['trade_postoffice_name'] }}&nbsp;{{ $trade['organization']['trade_upazila_name'] }}&nbsp;{{ $trade['organization']['trade_district_name'] }}
                    </td>
                </tr>

            </table>

            {{-- address end	 --}}


            {{-- instrunction start --}}

      <!--      <table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">-->

      <!--      	<tr>-->
      <!--      		<td style="text-align: center; border-bottom: 1px dotted;">-->
      <!--      			<h2>নির্দেশনাবলী / Instruction</h2>-->
      <!--      		</td>-->
      <!--      	</tr>-->

      <!--      	<tr>-->
      <!--      		<td style="padding-top: 20px;">-->
      <!--      			<ul style="padding-left:50px;list-style:none;">-->
						<!--	<li>১) &nbsp; আবেদন পত্রটি  সংশ্লিষ্ট সাধারণ ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনে কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নিজশাখায় জমা দিন। </li>-->

      <!--                       <li>২) &nbsp;সদ্য তোলা পাসপোর্ট সাইজের ২ কপি ছবি জমা দিন।  </li>-->

      <!--                       <li>৩)&nbsp; পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।</li>-->

      <!--                      <li>৪)&nbsp; জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন। </li>-->

      <!--                      <li>৫)&nbsp; আপনার প্রতিষ্ঠানটি লিমিটেড হলে মেমোরেন্ডাম অব আর্টিক্যালস ও ব্যালেন্স শীট আবেদন পত্রের সাথে দাখিল করতে হবে। </li>-->

      <!--                      <li>৬)&nbsp; কারখানা/সিএনজি স্টেশন/ দাহ্য পদার্থের ব্যবসায়ের ক্ষেত্রে এক্সক্লুসিভ বা বিস্ফোরক অধিদপ্তর/ ফায়ার সার্ভিস ও পরিবেশ অধিদপ্তরের ছাড়পত্র/ অনুমতিপত্র দরখাস্তের সাথে দাখিল করতে হবে। </li>-->

      <!--                      <li>৭) &nbsp; আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে </li>-->
						<!--</ul>-->
      <!--      		</td>-->
      <!--      	</tr>-->

      <!--      </table>-->

            {{-- instruction area end --}}


            {{-- verification area start --}}

            <table width="95%" cellpadding="0" cellspacing="0" border="0"
            style="border-collapse:collapse;margin-left: 50px; margin-top: 80px; ">
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
            style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
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
                <td style="text-align: right;">
                    <div style="border-top: 1px solid;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; সচিব  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>

                </td>
                @endif

                @if ($print_setting->chairman)
                <td style="text-align: right;">
                    <div style="border-top: 1px solid">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মেয়র  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>

                </td>
                @endif
            </tr>
        </table>

        {{-- <br> --}}
			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px; ">
                <tr>
                    <td style="text-align: left; border-bottom: 1px dotted; font-size: 10px;">
            			<h2>নির্দেশনাবলী / Instruction</h2>
            		</td>
            		<td></td>
                </tr>

                <br/>

                <tr>
					<td  style="border-bottom:1px solid black;">
					    <ul style="padding-left:50px;list-style:none; font-size:12px;">
							<li>১) &nbsp; আবেদনপত্রটি সংশ্লিষ্ট ওয়ার্ড কাউন্সিলর এবং সংরক্ষিত আসনের কাউন্সিলর কর্তৃক স্বাক্ষর নিয়ে নির্ধারিত শাখায় জমা দিন। </li>

                             <li>২) &nbsp;সদ্য তোলা পাসপোর্ট সাইজের ২ কপি ছবি জমা দিন।  </li>

                             <li>৩)&nbsp; পৌর কর পরিশোধ এর ভাউচার সাথে জমা দিন।</li>

                            <li>৪)&nbsp; জন্ম নিবন্ধন / জাতীয় পরিচয় পত্রের ফটোকপি সাথে জমা দিন। </li>

                            <li>৫)&nbsp; আপনার প্রতিষ্ঠানটি লিমিটেড হলে মেমোরেন্ডাম অব আর্টিক্যালস ও ব্যালেন্স শীট আবেদন পত্রের সাথে দাখিল করতে হবে। </li>

                            <li>৬)&nbsp; কারখানা/সিএনজি স্টেশন/ দাহ্য পদার্থের ব্যবসায়ের ক্ষেত্রে এক্সক্লুসিভ বা বিস্ফোরক অধিদপ্তর/ ফায়ার সার্ভিস ও পরিবেশ অধিদপ্তরের ছাড়পত্র/ অনুমতিপত্র দরখাস্তের সাথে দাখিল করতে হবে। </li>

                            <li>৭) &nbsp; আবেদন কপি টি প্রিন্ট করে ১৫দিনের মধ্যে সংশ্লিষ্ট শাখায় জমা দিন। অন্যথায় আবেদন টি বাতিল বলে গণ্য হবে </li>
						</ul>
					</td>
					<td rowspan="4" style="height:10px;width:160px; border-top:1px solid black; border-left:1px solid black;">

                      <?php

                        $url = request()->root().'/verify/trade_application/'.$trade['organization']['tracking'].'/'.$trade['organization']['union_id'].$type;
                      ?>

                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " height="130" width="170">

					</td>
				</tr>

			</table>


			{{-- verification area end --}}


			<!------------------ footer area start-------------------->

			<table width="95%"  cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 20px;">
				<tr>
					<td>
						<p>web:&nbsp;{{ request()->getHost() }},
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
