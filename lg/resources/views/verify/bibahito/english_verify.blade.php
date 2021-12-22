
<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>English Married Certificate</title>
   
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
            margin:20px 0px;
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
    

   
        @if (!empty($bibahito))
        <table border="0px" width="98%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;">{{-- <img src="{{ asset('public/assets/images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" /> --}}</td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->en_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_en }}, {{ $union->union_upazila_name_en }}, {{ $union->union_district_name_en }}-{{ $union->postal_code }}<br>
                        Mobile:{{ $union->mobile }}, Email: {{ $union->email }} <br>
                        Website: {{ $union->sub_domain }}</font>

                </td>

                <td style="width:1.2in; text-align:left;">

                   {{--  <img src="{{ asset('public/assets/images/union_profile/'.$union->brand_logo) }}" height="100px" width="100px" style="position:relative;right:10px;" /> --}}

                </td>

            </tr>
        </table>  

      

        <!----header div close here---->

        <table style="width:95%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
            
            <tr>
                <td colspan="2" style="text-align:center;font-size:25px;font-weight:bold;padding-bottom: 5px">
                    <font style="">
                        <u>Married Certificate</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>
                    
                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                            @php

                            $sonod = str_split($bibahito->sonod_no);

                            for($i=0; $i<strlen($bibahito->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>

                
                <td rowspan="3" valign="top" style="text-align: left;" >
                    @if($bibahito->photo != '' )
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'.$bibahito->photo }}" height="100px" width="100px" style="" alt="profile" />
                    @else

                        <img src="{{ asset('images/application/default.jpg') }}" height="100px" width="100px" style="" alt="default" />
                    @endif  
                </td>

            </tr>

            <tr>
                <td colspan="2" style="font-size:18px; text-indent:50px; padding-top: 5px; padding-bottom: 5px;">This is to certify that,</td>
            </tr>
        </table>

    



    <table class="jolchap" align="center" border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
        
        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Name </font>
            </td>
            <td>
                <font style="font-size:16px;">:  {{ $bibahito->name_en }}</font>
            </td>
        </tr>

        @if ($bibahito->marital_status == 2 && $bibahito->gender == 2 )
            
        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Husband Name</td>
            <td>
                <font style="font-size:16px; ">: {{ $bibahito->husband_name_en }}</font>
            </td>
        </tr>

        @endif

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">Father's Name </td>
            <td>
                <font style="font-size:16px; ">: {{ $bibahito->father_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Mother's Name</td>
            <td>
                <font style="font-size:16px;  ">: {{ $bibahito->mother_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">Present Address </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : Village : {{ $bibahito->present_village_en }}
                    <br> &nbsp; Post Office: {{ $bibahito->present_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $bibahito->present_upazila_name_en }}
                    <br> &nbsp; District: {{ $bibahito->present_district_name_en}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">Permanent Address </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : Village: {{ $bibahito->permanent_village_en }}
                    <br> &nbsp; Post Office: {{ $bibahito->permanent_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $bibahito->permanent_upazila_name_en }}
                    <br> &nbsp; District: {{ $bibahito->permanent_district_name_en }} 
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Ward No </td>
            <td>
                <font style="font-size:16px;  ">:  {{ $bibahito->permanent_ward_no }}</font>
            </td>
        </tr>

        @if($bibahito->nid > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">        National ID 
            </td>
            <td>
                <font style="font-size:16px;">: {{ $bibahito->nid }}</font>
            </td>
        </tr>
        @endif

        @if($bibahito->birth_id > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Birth ID </td>
            <td>
                <font style="font-size:16px;">:  {{ $bibahito->birth_id }}</font>
            </td>
        </tr>
        @endif


        @if($bibahito->passport_no)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport No </td>
            <td>
                <font style="font-size:16px;">:  {{ $bibahito->passport_no }}</font>
            </td>
        </tr>
        @endif

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp; Here is a {{ ($bibahito->resident == 1) ? 'temporary' : 'permanent' }} resident of the union. In my opinion, {{ ($bibahito->gender == 1) ? "He" : "She" }} is married and is not involved in state or anti-social activities. </td>
            
        </tr>

        <tr>
            <td style="padding-left:72px; font-size:17px; height: 20px">I wish {{ ($bibahito->gender == 1) ? 'him' : 'her' }} all the best and prosperity.</td>
        </tr>

    </table>

    <table border="0" width='99%' style="border-collapse:collapse; margin:5px auto; height: 100px" cellspacing="0" cellpadding="0">

        <tr>

            <td valign="middle" style="font-size:17px; text-indent:70px; width:150px; font-weight:bold; padding-left: 55px; padding-top: 10px; height: 50px; font-size: 16px">
                <span style="">Comment:</span>
            </td>

            <td valign="middle" style="font-size:18px;">&nbsp;{{ $bibahito->comment_en }} 
            </td>
        </tr>

        
    </table>



@else
<h1 style="text-align:center;color:red;">Sorry ! This certificate could not find.</h1>             
@endif
</body>

</html>

