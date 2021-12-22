@extends('layouts.master')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; border-radius: 4px;">
                    <h4 style="color: white;">@if($employee->designation_id == 1) মেয়র @elseif($employee->designation_id == 2) সচিব @elseif($employee->designation_id == 3) উদ্যোক্তা @elseif($employee->designation_id == 4) হিসাব সহকারী কাম কম্পিউটার অপারেটর @elseif($employee->designation_id == 5) কাউন্সিলর @elseif($employee->designation_id == 6) নির্বাহী প্রকৌশলী @endif</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center" style="margin-top: 50px;">
                    <img src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$employee->photo }}" style="border-radius: 4px; box-shadow: 3px 3px 5px gray;" alt="directors.jpg" width="200" height="200">
                    <h4><strong>{{ $employee->name }}</strong></h4>
                    <h4>@if($employee->designation_id == 1) মেয়র @elseif($employee->designation_id == 2) সচিব @elseif($employee->designation_id == 3) উদ্যোক্তা @elseif($employee->designation_id == 4) হিসাব সহকারী কাম কম্পিউটার অপারেটর @elseif($employee->designation_id == 5) কাউন্সিলর @elseif($employee->designation_id == 6) নির্বাহী প্রকৌশলী  @endif</h4>
                </div>
                <div class="col-md-8" style="margin-top: 50px;">

                    <table class="table table-bordered table-responsive">
                        <tbody>
                        <tr>
                            <th>নাম:</th>
                            <td>{{ $employee->name }}</td>
                            <th>পদবী:</th>
                            <td>{{ $employee->designation_name  }}</td>
                        </tr>
                        <tr>
                            <th>সর্বোচ্চ শিক্ষাগত যোগ্যতা:</th>
                            <td>{{ $employee->qualification }}</td>
                            <th>বৈবাহিক অবস্থা:</th>
                            <td>{{ ($employee->marital_status == 1)? 'অবিবাহিত' : 'বিবাহিত' }}</td>
                        </tr>
                        <tr>
                            <th>মোবাইল নাম্বার:</th>
                            <td>{{ $employee->mobile }}</td>
                            <th>ইমেইল ঠিকানা:</th>
                            <td>{{  $employee->email }}</td>
                        </tr>
                        <tr>
                            <th>নির্বাচনী এলাকার নাম:</th>
                            <td>{{ $employee->election_area }}</td>
                            <th>নিজ জেলা:</th>
                            <td>{{ $employee->district }}</td>
                        </tr>
                        </tbody>
                    </table>

                    @if($employee->designation_id < 6)
                    <div class="row">
                        <div class="col-12">
                            <h3>@if($employee->designation_id == 1) মেয়র @elseif($employee->designation_id == 2) সচিব @elseif($employee->designation_id == 3) উদ্যোক্তা @elseif($employee->designation_id == 4) হিসাব সহকারী কাম কম্পিউটার অপারেটর @elseif($employee->designation_id == 5) কাউন্সিলর @elseif($employee->designation_id == 6) নির্বাহী প্রকৌশলী @endif এর বার্তা:</h3>

                            <p style="font-size: 18px;">
                                {{ $employee->messages }}
                            </p>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
