@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.min.css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">

@endsection
@section('content')

    {{--Breadcrumb Section--}}
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-9 col-sm-9">
                <div class="title">
                    <h4><i class="icon-copy fi-torsos"></i> সকল কর্মকর্তা-কর্মচারীগণ</h4>
                </div>
            </div>

            @can('add-employee')
            <div class="col-md-3 col-sm-3">
                <a href="{{ route('add_member') }}" class="btn btn-info float-right">নতুন যোগ করুন</a>
            </div>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="row">
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th class="">ছবি</th>
                        <th class="">নাম</th>
                        <th class="">ইউজার নাম</th>
                        <th class="">পদবী</th>
                        <th class="">মোবাইল</th>
                        @can('employee-status')
                        <th class="">ওয়েবসাইটে অবস্থান</th>
                        <th class="">স্টেটাস</th>
                        @endcan
                        <th class="">অ্যাকশন</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employers as $key => $employee)
                    <tr>
                        <td class="table-plus">{{ $key + 1 }}</td>
                        <td class="">
                            @if($employee->photo != null)
                                <img src="{{ asset('images/employee/'.$employee->photo) }}" alt="" class="img-circle img-responsive" width="70">
                            @else
                                @if($employee->gender == 1)
                                    <img src="{{ asset('images/default/default_male.jpg') }}" alt="" class="img-circle img-responsive" width="70">
                                @else
                                    <img src="{{ asset('images/default/default_female.jpg') }}" alt="" class="img-circle img-responsive" width="70">
                                @endif
                            @endif
                        </td>
                        <td class="">{{ $employee->name }}</td>
                        <td class="">
                            @isset($employee->user->username)
                                {{ $employee->user->username }}
                            @endisset
                        </td>
                        <td>
                            {{ $employee->designation_name  }}
                        </td>
                        <td>{{ $employee->mobile }}</td>

                        @can('employee-status')
                        <td>@if($employee->designation_id == 1) স্লাইডার এর পাশে @elseif($employee->designation_id > 1 && $employee->designation_id < 5)  সচিব ,নির্বাহী কর্মকর্তা <br/>ও নির্বাহী প্রকৌশলী এই সেক্শনে<br/> <button type="button" class="btn btn-info changeBtn" value="{{ $employee->designation_id }}" data-toggle="modal" data-target="#login-modal">পরিবর্তন করুন</button> @elseif($employee->designation_id > 5)  মেডিকেল অফিসার<br/>ও অন্যান্য ব্যক্তিগণ এই সেক্শনে<br/><button type="button" class="btn btn-info changeBtn" value="{{ $employee->designation_id }}" data-toggle="modal" data-target="#login-modal">পরিবর্তন করুন</button> @else  কাউন্সিলর <br/>ও অন্যান্য ব্যক্তিগণ এই সেক্শনে<br/><button type="button" class="btn btn-info changeBtn" value="{{ $employee->designation_id }}" data-toggle="modal" data-target="#login-modal">পরিবর্তন করুন</button> @endif</td>
                        <td>{{ ($employee->status == 1)? 'একটিভ' : 'ডিজেবল' }}</td>
                        @endcan
                        <td class="btn-list">
                            @can('view-employee')
                            <a href="{{ route('view_profile', ['id' => $employee->id ]) }}" class="btn btn-outline-primary"><i
                                    class="icon-copy fa fa-address-book-o" aria-hidden="true"></i> ভিউ প্রোফাইল</a>
                            @endcan
                            @can('edit-employee')
                            <a href="{{ route('edit_info', ['id' => $employee->id ]) }}" class="btn
                            btn-outline-primary"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i> এডিট</a>
                            @endcan
                            @can('employee-status')
                            <a href="{{ route('change_status', ['id' => $employee->id ]) }}"
                               class="btn {{
                            ($employee->status == 1)? 'btn-outline-danger' : 'btn-outline-success' }}"><i class="icon-copy fa {{ ($employee->status == 1)? 'fa-circle' : 'fa-circle-o' }}" aria-hidden="true"></i> {{ ($employee->status == 1)? 'ডিজেবল' : 'একটিভ' }}</a>
                            @endcan
                            @can('delete-employee')
                            <button class="btn btn-outline-warning" onclick="warning($(this).val())" value="{{ $employee->employee_id }}"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i> ডিলিট</button>

                            <form id="delete-form_{{ $employee->employee_id }}" action="{{ route('delete_member') }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{  $employee->employee_id }}">
                                <input type="hidden" name="authId" id="authId_{{ $employee->employee_id }}" value="{{ Auth::user()->employee_id }}">
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="login-box bg-white box-shadow pd-ltr-20 border-radius-5">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5><i class="icon-copy fa fa-arrows-v" aria-hidden="true"></i> কর্মকর্তাদের অবস্থান নির্বাচন করুন</h5>
                        <div class="border box-shadow border-radius-5 drag-zone mt-3 mb-3 p-3">
                            <ul id="drag-zone">

                            </ul>
                        </div>
                        <a  href="{{ route('all_members') }}" class="btn btn-info btn-block mb-3" style="display: none;" id="reBtn">চেঞ্জেস সেভ</a>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <!-- add sweet alert js & css in footer -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>

    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src='{{ asset('js/members.min.js') }}'></script>
@endsection
