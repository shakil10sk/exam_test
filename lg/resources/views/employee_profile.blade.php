@extends('layouts.master')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; border-radius: 4px;">
                    <h4 style="color: white;">@if($employee->designation_id == 1) জেলা প্রশাসক @elseif($employee->designation_id == 2) উপ-পরিচালক(স্থানীয় সরকার) @endif</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center" style="margin-top: 50px;">
                    <img src="{{ env('ASSET_URL').'/images/'.$employee->photo }}" style="border-radius: 4px; box-shadow: 3px 3px 5px gray;" alt="directors.jpg" width="200" height="200">
                    <h4><strong>{{ $employee->name }}</strong></h4>
                    <h4>@if($employee->designation_id == 1) জেলা প্রশাসক @elseif($employee->designation_id == 2) উপ-পরিচালক(স্থানীয় সরকার) @endif</h4>
                </div>
                <div class="col-md-8" style="margin-top: 50px;">

                    <table class="table table-bordered table-responsive">
                        <tbody>
                        <tr>
                            <th>নাম:</th>
                            <td>{{ $employee->name }}</td>
                            <th>পদবী:</th>
                            <td>@if($employee->designation_id == 1) জেলা প্রশাসক @elseif($employee->designation_id == 2) উপ-পরিচালক(স্থানীয় সরকার) @endif</td>
                        </tr>
                        <tr>
                            <th>ব্যাচঃ</th>
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
                      
                        </tbody>
                    </table>

                   

                </div>
            </div>
        </div>
    </section>
@endsection
