@extends('layouts.app')
@section('head')
    {{-- form custom style --}}
    <link rel="stylesheet" href="{{ asset('css/form_validate.min.css') }}">

    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@endsection
@section('content')
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> প্রিন্ট সেটিং <span id="save_alert"
                            class="text-danger" style="display:none;"> *সেভ করা হয়নি</span></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                <form action="{{ route('pdf_setup_post') }}" method="POST">
                    @csrf
                    <table id="setting_table" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>নাম</th>
                                <th></th>
                                <th>মেয়র</th>
                                <th>সচিব</th>
                                <th>কাউন্সিলর</th>
                                {{-- <th>অবিভাবক</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($type as $key => $item)

                                @php
                                $sonod = \DB::table('print_settings')->where([
                                'union_id'=> auth()->user()->union_id,
                                'type'=> $key,
                                'application_type'=> 1
                                ])->first();

                                $abedon = \DB::table('print_settings')->where([
                                'union_id'=> auth()->user()->union_id,
                                'type'=> $key,
                                'application_type'=> 2
                                ])->first();
                                @endphp

                                <tr data-type="{{ $key }}">
                                    <th>{{ $item }}
                                        <br>
                                        <br>
                                        <span style="font-weight: 100;"> প্যাড প্রিন্ট </span>
                                        <input type="hidden" name="{{ $key }}[pad_print]" value="0">
                                        &nbsp; <input type="checkbox" name="{{ $key }}[pad_print]"
                                            {{ $sonod->pad_print ?? 0 ? 'checked' : '' }} value="1">
                                    </th>
                                    <td>
                                        সনদ
                                        <hr>
                                        আবেদন
                                    </td>
                                    <td>
                                        <input type="checkbox"  {{ $sonod->chairman ?? 0 ? 'checked' : '' }} disabled >
                                        <hr>
                                        <input type="checkbox" name="{{ $key }}[abedon][chairman]" value="1"
                                            {{ $abedon->chairman ?? 0 ? 'checked' : '' }} data-app-type="2">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{ $key }}[sonod][sochib]" value="1"
                                            {{ $sonod->sochib ?? 0 ? 'checked' : '' }} value="1" data-app-type="1">
                                        <hr>
                                        <input type="checkbox"
                                            {{ $abedon->sochib ?? 0 ? 'checked' : '' }} data-app-type="2" disabled>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="{{ $key }}[sonod][member]" value="1"
                                            {{ $sonod->member ?? 0 ? 'checked' : '' }} data-app-type="1">
                                        <hr>
                                        <input type="checkbox" name="{{ $key }}[abedon][member]" value="1"
                                            {{ $abedon->member ?? 0 ? 'checked' : '' }} data-app-type="2">
                                    </td>

                                    {{-- <td>
                                        <input type="checkbox" name="{{ $key }}[sonod][obibabok]" value="1"
                                            {{ $sonod->obibabok ?? 0 ? 'checked' : '' }} data-app-type="1">
                                        <hr>
                                        <input type="checkbox" name="{{ $key }}[abedon][obibabok]" value="1"
                                            {{ $abedon->obibabok ?? 0 ? 'checked' : '' }} data-app-type="2">
                                    </td> --}}

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>

    <!-- add sweet alert js & css in footer -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>
    <!-- switchery js -->
    <script src="{{ asset('js/switchery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#setting_table tbody input[type="checkbox"]').click(function() {

                // console.log($(this).closest('tr').data('type'), $(this).data('app-type'));

                if ($(this).closest('tr').find('input[type="checkbox"][data-app-type="1"]:checked').length >
                    2) {

                    $(this).prop('checked', false);
                    swal({
                        type: 'error',
                        title: 'দুঃখিত...',
                        text: 'আপনি সনদ এর জন্য সর্বোচ্চ ২টি সিলেক্ট করতে পারবেন',
                        confirmButtonText: 'ঠিক আছে',
                        showCancelButton: true,
                        cancelButtonText: 'বাতিল',
                        allowOutsideClick: true,
                        allowEscapeKey: true
                    });

                } else if ($(this).closest('tr').find('input[type="checkbox"][data-app-type="2"]:checked')
                    .length > 2) {
                    $(this).prop('checked', false);

                    swal({
                        type: 'error',
                        title: 'দুঃখিত...',
                        text: 'আপনি আবেদন এর জন্য সর্বোচ্চ ২টি সিলেক্ট করতে পারবেন',
                        confirmButtonText: 'ঠিক আছে',
                        showCancelButton: true,
                        cancelButtonText: 'বাতিল',
                        allowOutsideClick: true,
                        allowEscapeKey: true
                    });
                }
                else
                {
                    $('#save_alert').show();
                }
            });
        });

    </script>
@endsection
