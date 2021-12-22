<!doctype html>
<html lang="bn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Auth::User()->relationBetweenUnion->bn_name }} সদস্যদের তথ্য</title>
    <style>
        body {
            font-family: 'bangla', sans-serif !important;
        }
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 200px;
        }
        .text-center{
            text-align: center;
        }
        table {
            border-collapse: collapse;
        }
        .thead-dark{
            background-color: #0D202D;
            color: #ffffff;
        }
        ul{
            list-style: none;
        }
        ul li{
            float: left;
        }
    </style>
</head>
<body>
<htmlpageheader name="page-header">
    <table align="center">
        <tr>
            <th><img src="{{ asset('images/logo/union_logo.png') }}" width="50" style="float: left;"></th>
            <th><h3 style="">{{ Auth::User()->relationBetweenUnion->bn_name }}</h3></th>
        </tr>
        <tr>
            <th colspan="2">
                <strong>{{ $unionAddress->village_bn }}, {{ $unionAddress->union_post_office }}, {{ $unionAddress->union_district }}-{{ $unionAddress->postal_code }}</strong><br/>
                <strong>মোবাইল: {{ $unionAddress->mobile }}, ই-মেইল: {{ $unionAddress->email }}</strong><br/>
                <strong>ওয়েবসাইট: {{ $unionAddress->sub_domain }}</strong><br/>
                <strong>সদস্যদের তথ্য</strong>
            </th>
        </tr>
    </table>
</htmlpageheader>
    @foreach($employees as $employee)
                <table class="table" border="1" style="margin-top: 30px;">
                    <tr style="background-color: grey; color: white;">
                        <th colspan="2">নাম: {{ $employee->name }}</th>
                    </tr>
                    <tbody>
                    <tr>
                        <td width="150" class="text-center">
                            @if($employee->photo != null)
                                <img src="{{ asset('images/employee_pic/'.$employee->photo) }}" alt="" class="image-previewer image" width="150" height="150">
                            @else
                                @if($employee->gender == 1)
                                    <img src="{{ asset('images/default/default_male.jpg') }}" alt="" class="image-previewer image" width="150" height="150">
                                @else
                                    <img src="{{ asset('images/default/default_female.jpg') }}" alt="" class="image-previewer image" width="150" height="150">
                                @endif
                            @endif
                            <strong>{{ $employee->name }}</strong><br/>
                            <strong>@if($employee->designation_id == 1)  মেয়র @elseif($employee->designation_id == 2)
                                    সচিব @elseif($employee->designation_id == 3) নির্বাহী কর্মকর্তা @elseif
                                    ($employee->designation_id == 4) হিনির্বাহী প্রকৌশলী @elseif
                                    ($employee->designation_id == 5) কাউন্সিলর @elseif($employee->designation_id ==
                                    6) মেডিকেল কর্মকর্তা @elseif($employee->designation_id ==
                                    7)  অন্যান্য @endif</strong>
                        </td>
                        <td>
                            <table border="1" class="table">
                                <tr>
                                    <td><strong>#ডিভাইস আই.ডি. নং:</strong> {{ $employee->device_id }}</td>

                                    <td><strong>জন্মতারিখ:</strong> {{ $employee->date_of_birth }}</td>

                                    <td><strong>ন্যাশনাল আইডি নং:</strong> {{ $employee->nid }}</td>

                                    <td><strong>শিক্ষাগত যোগ্যতা:</strong> {{ $employee->qualification }}</td>
                                </tr>

                                <tr>
                                    <td><strong>লিঙ্গ:</strong> {{ $employee->gender == 1? 'পুরুষ' : 'মহিলা' }}</td>

                                    <td><strong>বৈবাহিক সম্পর্ক:</strong> {{ ($employee->marital_status == 1)? 'অবিবাহিত' : 'বিবাহিত' }}</td>

                                    <td><strong>নাগরিকত্ব:</strong> বাংলাদেশী</td>

                                    <td><strong>জেলা:</strong> {{ $employee->district }}, <strong>উপজেলা/থানা:</strong> {{ $employee->upazila }}, <strong>পোস্ট অফিস:</strong> {{ $employee->post_office }}</td>
                                </tr>

                                <tr>
                                    <td><strong>এলাকা:</strong> {{ $employee->election_area }}</td>

                                    <td><strong>চাকরি যোগদান তারিখ:</strong> {{ $employee->join_date }}</td>

                                    <td colspan="2"><strong>ঠিকানা:</strong> {{ $employee->address }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
    @endforeach

<htmlpagefooter name="page-footer">
    <p class="text">পাতা {PAGENO}</p>
</htmlpagefooter>
</body>
</html>
