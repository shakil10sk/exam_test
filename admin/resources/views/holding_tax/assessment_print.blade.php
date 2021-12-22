<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <base href="" />
        <meta charset="utf-8">
        
        <title>
            হোল্ডিং এসেসমেন্ট
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
    </head>
    <body>

        @if(!empty($data))
            @include('layouts.pdf_sub_layouts.application_header')

        <!-----------heading start--------------->
        <table border="0" cellpadding="5" cellspacing="5" style="border-collapse:collapse;margin-left: 50px;" width="95%">
            <tr>
                <td style="text-align: center; padding-bottom:50px;">
                    <h2>
                        <span style="border-bottom: 1px solid; ">
                            হোল্ডিং এসেসমেন্ট
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
                <td style="height: 25px;">
                    নাম (বাংলা)
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->name }}
                    </span>
                </td>

                <td> মোবাইল </td>
                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->mobile_no) }}
                    </span>
                </td>
            </tr>

            <tr>
                <td style="height:25px"> ন্যাশনাল আইডি </td>
                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->nid) }}
                    </span>
                </td>
                
                <td style="border-left:none;"> জন্মসনদ নং </td>
                <td style="border-left:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->birth_id) }}
                    </span>
                </td>

            </tr>

            <tr>
                <td style="border-left:none;border-bottom:none;height:25px;">
                    পাসপোর্ট নং
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ BanglaConverter::bn_number($data->passport_no) }}
                    </span>
                </td>

                <td style="border-left:none "> জন্ম তারিখ </td>
                <td style="border-left:none;">
                    <span>
                        :
                        <?php echo BanglaConverter::bn_number(date('d-m-Y', strtotime($data->birth_date)));?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="height: 25px;">
                    পিতার নাম
                </td>
                <td style="border-left:none;">
                    <span>
                        : {{ $data->father_name }}
                    </span>
                </td>

                <td style="border-left:none;border-bottom:none;">
                    মাতার নাম
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{ $data->mother_name }}
                    </span>
                </td>
            </tr>

            <tr>
                <td style="height: 25px;"> পেশা </td>
                <td style="border-left:none;">
                    <span>
                        : {{ $data->occupation }}
                    </span>
                </td>

                <td> ধর্ম </td>
                <td style="border-left:none;">
                    <span>
                        : 
					@if($data->religion == 1)
					 	ইসলাম
					@elseif($data->religion == 2)
						হিন্দু
					@elseif($data->religion == 3)
						বৌদ্ধ ধর্ম
					@elseif($data->religion == 4)
						খ্রিস্ট ধর্ম
					@else
						অন্যান্য
					@endif
                    </span>
                </td>
            </tr>
        </table>

        <h3 style="text-align: center; text-decoration: underline;margin-top: 50px;">এসেসমেন্ট তথ্য</h3>

        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px;" width="95%">
            
            <tr>
                <td style="height: 25px;">
                    হোল্ডিং নং
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{BanglaConverter::bn_number($data->holding_no)}}
                    </span>
                </td>

                <td> এসেসমেন্ট তারিখ </td>
                <td style="border-left:none;">
                    <span>
                        : {{BanglaConverter::bn_number(date('d-m-Y', strtotime($data->assessment_date)))}}
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 25px;">
                    ওয়ার্ড নং
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{BanglaConverter::bn_number($data->ward_no)}}
                    </span>
                </td>

                <td> ওয়ার্ড নাম </td>
                <td style="border-left:none;">
                    <span>
                        : {{$data->ward_name}}
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 25px;">
                    গ্রাম/মহল্লা
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{$data->moholla_name}}
                    </span>
                </td>

                <td> রোড/ব্লক/সেক্টর (বাংলায়) </td>
                <td style="border-left:none;">
                    <span>
                        : {{$data->block_name}}
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 25px;">
                    ভবন নির্মানের ধরন
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{$data->construction_type == 1 ? 'কাঁচা' : ($data->construction_type == 2 ? 'আধা কাঁচা' : ($data->construction_type == 3 ? 'পাকা' : 'আধা পাকা'))}}
                    </span>
                </td>

                <td> ভবনের ধরন </td>
                <td style="border-left:none;">
                    <span>
                        : {{$data->property_name}}
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 25px;">
                    মালিকানার ধরন
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{$data->owner_type == 1 ? 'ভাড়া' : 'ব্যক্তি মালিকানা'}}
                    </span>
                </td>

                <td> রাস্তার প্রস্থ </td>
                <td style="border-left:none;">
                    <span>
                        : {{BanglaConverter::bn_number($data->road_width)}}
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 25px;">
                    ভাড়া জায়গার পরিমান
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{BanglaConverter::bn_number($data->rent_area)}} বর্গফুট
                    </span>
                </td>

                <td> নিজস্ব জায়গার পরিমান </td>
                <td style="border-left:none;">
                    <span>
                        : {{BanglaConverter::bn_number($data->owner_area)}} বর্গফুট
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 25px;">
                    Depreciation
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{BanglaConverter::bn_number(number_format($data->depreciation, 0, '.', ','))}} টাকা
                    </span>
                </td>

                <td> Apreciation </td>
                <td style="border-left:none;">
                    <span>
                        : {{BanglaConverter::bn_number(number_format($data->appreciation, 0, '.', ','))}} টাকা
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="height: 40px;">
                    Annual Rental <br/>Value (ARV)
                </td>
                <td style="border-left:none;border-bottom:none;">
                    <span>
                        : {{BanglaConverter::bn_number(number_format($data->arv, 0, '.', ','))}} টাকা
                    </span>
                </td>

                <td> Final Annual Rental <br/>Value (ARV) </td>
                <td style="border-left:none;">
                    <span>
                        : {{BanglaConverter::bn_number(number_format($data->farv, 0, '.', ','))}} টাকা
                    </span>
                </td>
            </tr>
            
            <tr>
                <td style="width:130px;height:30px;">
                    মোট বাৎসরিক ট্যাক্স
                </td>
                <td>
                    <span>
                        : {{BanglaConverter::bn_number(number_format($data->yearly_tax, 0, '.', ','))}} টাকা
                    </span>
                </td>

                <td style="width:135px;"> মাসিক ট্যাক্স </td>
                <td>
                    <span>
                        : {{BanglaConverter::bn_number(number_format($data->monthly_tax, 0, '.', ','))}} টাকা
                    </span>
                </td>
            </tr>

        </table>

        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 40px;" width="95%">
            <tr>
                <td  style="text-align: center;">
                    <span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; আবেদনকারীর স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    </span>
                </td>
            </tr>
        </table>

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
                            ১)   এলাকার গন্যমান্য ১ জন ব্যাক্তি এবং ওয়ার্ড কাউন্সিলর কর্তৃক সত্যায়িত করে পৌরসভা পরিষদে জমা দিন।
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
        {{-- instruction area end --}}

        {{-- verification area start --}}
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 30px; " width="95%">
            <tr>
                <td style="text-align: center; font-size: 20px;font-weight: bold;">
                    <span style="border-bottom: 1px solid">
                        সত্যায়ন / Verification
                    </span>
                </td>
            </tr>
        </table>

        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 70px;" width="95%">

            <tr>
                <td  style="text-align: center;">
                    <span style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    </span>
                    কাউন্সিলর
                </td>

                <td style="text-align: center;">
                    <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                    </span>
                    সচিব
                </td>

                <td style="text-align: center;">
                    <span style="border-top: 1px solid" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষর &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                        </span>
                        মেয়র
                </td>
                
            </tr>
        </table>
        {{-- verification area end --}}

        <!------------------ footer area start-------------------->
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-left: 50px; margin-top: 100px;" width="95%">
            <tr>
                <td><p> E-mail : {{ $union->email }} </p></td>
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
        	<h2 style="text-align: center;color:red;">দুঃখিত ! এসেসমেন্টটি পাওয়া যায়নি</h2>
        @endif
    </body>
</html>
