
<html>
<head>
    <base href='' />
    <meta charset="utf-8">
    <title>Character English Certificate</title>
    
    <style type="text/css" media="all">

        body {
            font-family: 'bangla', sans-serif !important;
            font-size: 14px;
            width: 595px;
            height: 842px;
            margin: auto;
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
    


   @if(!empty($character))
        <table border="0px" width="110%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
            <tr>
                <td style="width:1.5in; text-align:center;">{{-- <img src="{{ asset('public/assets/images/union_profile/'.$union->main_logo) }}" height="100px" width="100px" /> --}}</td>

                <td style="text-align:center;">
                    <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->en_name }}</font>

                    <br />

                    <font style="font-size:16px; font-weight:bold;">
                        {{ $union->village_en }}, {{ $union->union_upazila_name_en }}, {{ $union->union_district_name_en }}-{{ $union->postal_code }}<br>
                        Mobile:{{ $union->mobile }}, Email: {{ $union->email }} <br>
                        Website: {{ $url }}</font>

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
                        <u>Character Certificate</u>
                    </font>
                </td>
            </tr>

            <tr>

                <td>
                    
                    <table border="1" style="width: 600px;border-color:lightgray;border-collapse:collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width:120px; text-align:center;font-weight:700;font-size:17px;">Certificate No :</td>
                            @php

                            $sonod = str_split($character->sonod_no);

                            for($i=0; $i<strlen($character->sonod_no); $i++):

                            @endphp

                            <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                            @php
                            endfor;
                            @endphp
                        </tr>
                    </table>
                </td>

                
                <td rowspan="3" valign="top" style="text-align: left;" >
                    @if($character->photo != '' )
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/application/'.$character->photo }}" height="100px" width="100px" style="" alt="profile" />

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
                <font style="font-size:16px;">:  {{ $character->name_en }}</font>
            </td>
        </tr>

        @if ($character->marital_status == 2 && $character->gender == 2 )
            
        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Husband Name</td>
            <td>
                <font style="font-size:16px; ">: {{ $character->husband_name_en }}</font>
            </td>
        </tr>

        @endif

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px ">Father's Name </td>
            <td>
                <font style="font-size:16px; ">: {{ $character->father_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Mother's Name</td>
            <td>
                <font style="font-size:16px;  ">: {{ $character->mother_name_en }} </font>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px;vertical-align:top; ">Present Address </td>

            <td style=" vertical-align:top;">
                <p style="line-height:25px;font-size:16px; ">

                    : Village : {{ $character->present_village_en }}
                    <br> &nbsp; Post Office: {{ $character->present_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $character->present_upazila_name_en }}
                    <br> &nbsp; District: {{ $character->present_district_name_en}}</p>
            </td>
        </tr>

        <tr>
            <td nowrap align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px; vertical-align:top; ">Permanent Address </td>

            <td style=" vertical-align:top;">

                <p style="line-height:25px;font-size:16px;  ">
                    : Village: {{ $character->permanent_village_en }}
                    <br> &nbsp; Post Office: {{ $character->permanent_postoffice_name_en }}
                    <br> &nbsp; Upazila/Thana: {{ $character->permanent_upazila_name_en }}
                    <br> &nbsp; District: {{ $character->permanent_district_name_en }} 
                </p>
            </td>
        </tr>

        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Ward No </td>
            <td>
                <font style="font-size:16px;  ">:  {{ $character->permanent_ward_no }}</font>
            </td>
        </tr>

        @if($character->nid  > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 200px; padding-left: 50px">        National ID 
            </td>
            <td>
                <font style="font-size:16px;">: {{ $character->nid }}</font>
            </td>
        </tr>
        @endif


        @if($character->birth_id > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Birth ID </td>
            <td>
                <font style="font-size:16px;">:  {{ $character->birth_id }}</font>
            </td>
        </tr>
        @endif


        @if($character->passport_no > 0)
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport No </td>
            <td>
                <font style="font-size:16px;">:  {{ $character->passport_no }}</font>
            </td>
        </tr>
        @endif
        
        <tr>
            <td align="left" nowrap style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Date </td>
            <td>
                 <font style="font-size:16px;">:  <?php echo date('d-m-Y', strtotime($character->generate_date)); ?></font>
            </td>
        </tr>

    </table>

    <table border='0' width='98%' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0 auto;padding-top:10px;">

        <tr>
            <td style="font-size:17px;  padding-left:50px;" height="80">&nbsp; &nbsp; &nbsp; &nbsp; {{ ($character->gender == 1) ? 'He' : 'She' }} is personally known to me and bears a good moral character. He is an honest, polite, gentle, dedicated, active man. To the best of my knowledge {{ ($character->gender == 1) ? 'He' : 'She' }} never takes part in any activities subversive to the state or of discipline. </td>
            
        </tr>

        <tr>
            <td style="padding-left:72px; font-size:17px; height: 20px">I wish {{ ($character->gender == 1) ? 'him' : 'her' }} all the best and prosperity.</td>
        </tr>

    </table>

    <table border="0" width='99%' style="border-collapse:collapse; margin:5px auto; height: 100px" cellspacing="0" cellpadding="0">

        <tr>

            <td valign="middle" style="font-size:16px; text-indent:70px; width:150px; font-weight:bold; padding-left: 55px; padding-top: 10px; height: 50px;">
                <span style="">Comment:</span>
            </td>

            <td valign="middle" style="font-size:16px;">&nbsp;{{ $character->comment_en }} 
            </td>
        </tr>

        
    </table>


            
@else
    <h1 style="text-align:center;color:red;">Sorry ! This certificate could not find.</h1>
@endif
</body>

</html>

