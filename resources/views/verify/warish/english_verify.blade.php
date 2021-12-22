
<style type="text/css">


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
            margin: 20px 0px;
            padding: 0px;

        }
</style>

    <section>
        <div class="container">
            <div class="card" style="margin:20px 0px; padding: 10px 0px 20px 0px">

                @if(!empty($data['warish_data']))
                <table border="0px" width="110%" align="center" style="border-collapse:collapse; margin:2px auto; padding-top: 50px">
                        <tr>
                            <td style="width:1.5in; text-align:center;"></td>

                            <td style="text-align:center;">
                                <font style="font-size:25px; font-weight:bold; color:blue;">{{ $union->bn_name }}</font>

                                <br />

                                <font style="font-size:16px; font-weight:bold;">
                                    {{ $union->village_bn }}, {{ $union->union_upazila_name_bn }}, {{ $union->union_district_name_bn }}-{{ Converter::en2bn($union->postal_code) }}<br>
                                    মোবাইলঃ{{ Converter::en2bn($union->mobile) }}, ই-মেইলঃ {{ $union->email }} <br>
                                    ওয়েব সাইট : {{ $url }}</font>

                            </td>

                            <td style="width:1.2in; text-align:left;">



                            </td>

                        </tr>
                    </table>


                    <table border="0px" width="98%"  style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align:center;font-size:25px;font-weight:bold;" height="38">
                            <font style="">
                                <u>Successor Certificate Verify</u>
                            </font>
                        </td>

                    </tr>
                </table>

                <table border='1' align="left" style="width:100%; margin-left:48px;border-color:lightgray;border-collapse:collapse;margin-top:10px;float: left;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width:150px; text-align:center;font-weight:700;font-size:17px; ">Certificate No :</td>

                        @php

                            $sonod = str_split($data['warish_data']->sonod_no);

                            for($i=0; $i<strlen($data['warish_data']->sonod_no); $i++):

                        @endphp

                        <td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $sonod[$i]; ?></td>

                        @php
                            endfor;
                        @endphp

                         <td style="border: none;">
                            <font style="font-size: 18px">&nbsp;&nbsp;&nbsp; Date:  <?php echo date('d-m-Y', strtotime($data['warish_data']->generate_date)); ?></font>
                        </td>

                    </tr>
                </table>


                <table class="jolchap" align="center" border="0"  width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0 auto;table-layout:fixed;">
                    <tr height="55px" style="">
                        <td colspan="2"  style="font-size:18px; text-indent:50px;padding-left: 50px; padding-top: 15px; padding-bottom: 10px;">Certification to the effect that going to be,</td>

                    </tr>
                </table>


                <table border="0px" width="99%"   align="center" style="border-collapse:collapse; margin:1px auto;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Name   </td>
                        <td colspan="3" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->name_en }}</font></td>
                    </tr>
                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Father's Name </td>

                        <td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  {{ $data['warish_data']->father_name_en }} </font></td>

                        <td  style="font-size:15px; text-align:left; ">Mother's Name  </td>

                        <td style=""><font style="font-size:15px;font-weight:bold;  ">:   {{ $data['warish_data']->mother_name_en }} </font></td>

                        @if($data['warish_data']->gender == 1 && $data['warish_data']->marital_status == 2)

                        <td  style="font-size:15px; text-align:left;">
                            Wife Name
                        </td>

                        <td><font style="font-size:15px;font-weight:bold;  ">:{{ $data['warish_data']->wife_name_en }} </font></td>

                        @endif

                        @if($data['warish_data']->gender == 2 && $data['warish_data']->marital_status == 2)

                        <td  style="font-size:15px; text-align:left;">
                            Husband Name
                        </td>

                        <td><font style="font-size:15px;font-weight:bold;  ">:{{ $data['warish_data']->husband_name_en }} </font></td>

                        @endif
                    </tr>

                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">NID  </td>
                        <td style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->nid }}</td>
                        <td valign="top" style="font-size:16px;">Deaths ID </td>
                        <td colspan="2" style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->birth_id }}</font></td>
                    </tr>

                    @if($data['warish_data']->passport_no != null)
                    <tr>
                        <td align="left" style="font-size:16px;text-indent:55px; font-color:black; width: 150px; padding-left: 50px">Passport No   </td>
                        <td colspan="5" style=""><font style="font-size:15px;font-weight:bold; ">: {{ $data['warish_data']->passport_no }}</font></td>
                    </tr>
                    @endif

                    <br>
                    <br>


                    <tr>
                        <td valign="top" style="font-size: 16px; padding-left: 50px;">Permanent Address</td>
                        <td colspan="5">
                            <p style="font-size:16px;">
                                : Village : &nbsp;{{ $data['warish_data']->permanent_village_en }},&nbsp;&nbsp;&nbsp;Road/Block  : {{ $data['warish_data']->permanent_rbs_en }}
                                Postoffice : &nbsp;{{ $data['warish_data']->permanent_postoffice_name_en }},&nbsp;&nbsp;&nbsp;Ward no : {{ $data['warish_data']->permanent_ward_no }}
                                 Upazila : &nbsp;{{ $data['warish_data']->permanent_upazila_name_en }}
                                 District :  &nbsp;{{ $data['warish_data']->permanent_district_name_en }}
                            </p>
                        </td>
                    </tr><br>

                    <tr>
                        <td valign="top" style="font-size: 16px; padding-left: 50px;">Permanent Address</td>
                        <td colspan="5">
                            <p style="font-size:16px;">
                                : Village : &nbsp;{{ $data['warish_data']->present_village_en }},&nbsp;&nbsp;&nbsp;Road/Block : {{ $data['warish_data']->present_rbs_en }}
                                Post office : &nbsp;{{ $data['warish_data']->present_postoffice_name_en }},&nbsp;&nbsp;&nbsp;Ward No : {{ $data['warish_data']->present_ward_no }}
                                 Upazila : &nbsp;{{ $data['warish_data']->present_upazila_name_en }}
                                 District :  &nbsp;{{ $data['warish_data']->present_district_name_en }}
                            </p>
                        </td>
                    </tr>

                </table>



                <table border="0px" width="99%"  align="center" style="border-collapse:collapse;margin:4px auto; " cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding-left: 50px; height: 25px;">
                            <font style="font-size:16px; padding-left:30px;"> {{ ($data['warish_data']->gender == 1) ? "He" : "She" }} was a <span>{{ ($data['warish_data']->resident == 1) ? "Temporary" : "Permanent" }} </span> resident in this union.
                                        Below list of successors During {{ ($data['warish_data']->gender == 1) ? "his" : "her" }}death time.</font>
                        </td>
                    </tr>
                </table>



                <table border="1" align="center" width="93%" height="300px" align="center" style="border-collapse:collapse; " cellspacing="0" cellpadding="0" >
                    <tr height="20px">
                        <tr height="20px">
                            <th style="width:5%;font-size:14px;">No</th>
                            <th style="width:20%;font-size:14px;">Name</th>
                            <th style="width:10%;font-size:14px;">Relation</th>
                            <th style="width:8%;font-size:14px;">NID</th>
                            <th style="width:5%;font-size:14px;">No</th>
                            <th style="width:20%;font-size:14px;">Name</th>
                            <th style="width:10%;font-size:14px;">Relation</th>
                            <th style="width:8%;font-size:14px;">NID</th>
                        </tr>
                    </tr>
                    <?php for($i=0; $i<10; $i++):?>

                    <tr height=''>
                        <td style="text-align:center;font-size:13px;">{{ $i+1 }}</td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php
                                echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->name_en : "";
                            @endphp
                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php
                                echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->relation_en : "";
                            @endphp

                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php
                                echo isset ($data["warish_list"][$i]) ? $data["warish_list"][$i]->nid : "";
                            @endphp
                        </td>

                        <td style="text-align:center;font-size:13px;">{{ $i+11 }}</td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">

                            @php
                                echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->name_en : "";
                            @endphp
                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">
                            @php
                                echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->relation_en : "";
                            @endphp

                        </td>
                        <td style="text-align:center;text-indent:15px;font-size:14px;">

                            @php
                                echo isset ($data["warish_list"][$i+10]) ? $data["warish_list"][$i+10]->nid : "";
                            @endphp
                        </td>
                    </tr>

                    <?php endfor;?>

                    <tr>

                        <td colspan="8" style="text-align:right;font-size:12px; padding-right:60px;">Number of Successors <span>&nbsp;&nbsp;</span> {{ count($data['warish_list']) }} &nbsp;&nbsp;people</td>

                    </tr>
                </table>



                <table width="98%" border="0" style="padding-top:5px;border-collapse:collapse;margin:0px auto;">
                    <tr>
                        <td style="font-size:16px; padding-left: 50px"> I am praying for dead person eternal peace and good wish to {{ ($data['warish_data']->gender == 1) ? "his" : "her" }} successors.  </td>
                    </tr>
                </table>


                <table border='0' width="98%">
                    <tr>
                        <td style="padding-left:50px; font-size:15px;"><b>Investigator: </b></td>
                        <td style="font-size:15px;">{{ $data['warish_data']->investigator_name_en }}</td>
                        <td style="font-size:15px;"><b>Applicant Name : </b></td>
                        <td style="font-size:15px;">{{ $data['warish_data']->applicant_name_en }}</td>
                        <td style="font-size:15px;"><b>Father :</b></td>
                        <td style="font-size:15px;">{{ $data['warish_data']->applicant_father_name_en }}</td>
                    </tr>

                </table>

                @else
                    <h2 style="text-align: center;color: red;">Sorry ! This certificate number is invalid</h2>
                @endif

             </div>
        </div>
    </section>

{{-- @endsection --}}

