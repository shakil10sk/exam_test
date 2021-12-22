@extends('layouts.app')

@section('head')

    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>

    {{-- form custom style --}}
    <link rel="stylesheet" href="{{ asset('css/form_validate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-2">
                <div class="title">
                    <h4><i class="icon-copy fa fa-user-o" aria-hidden="true"></i> কর্মকর্তা প্রোফাইল</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow">
                <div class="profile-photo">
                    @if($employee->employee_id == Auth::user()->employee_id)
                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                    @endif

                    @if($employee->photo != null)
                        <img src="{{ asset('images/employee/'.$employee->photo) }}" alt="" class="avatar-photo">
                    @else
                        @if($employee->gender == 1)
                            <img src="{{ asset('images/default/default_male.jpg') }}" alt="" class="avatar-photo">
                        @else
                            <img src="{{ asset('images/default/default_female.jpg') }}" alt="" class="avatar-photo">
                        @endif
                    @endif

                    @if($employee->employee_id == Auth::user()->employee_id)
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('update_pic') }}" method="post" enctype="multipart/form-data">
                                <div class="modal-body pd-5 text-center">
                                    <label for="cropzee-input">
                                        <div class="img-container">
                                        <div class="image-overlay">
                                            @if($employee->photo != null)
                                                <img src="{{ asset('images/employee_pic/'.$employee->photo) }}" alt="" class="image-previewer image" data-cropzee="cropzee-input">
                                            @else
                                                @if($employee->gender == 1)
                                                    <img src="{{ asset('images/default/default_male.jpg') }}" alt="" class="image-previewer image" data-cropzee="cropzee-input">
                                                @else
                                                    <img src="{{ asset('images/default/default_female.jpg') }}" alt="" class="image-previewer image" data-cropzee="cropzee-input">
                                                @endif
                                            @endif
                                                <button for="cropzee-input" class="btn btn-primary form-control"><i class="icon-copy fa fa-picture-o" aria-hidden="true"></i> আপলোড</button>
                                                <div class="overlay">
                                                    <div class="text">ক্লিক করুন</div>
                                                </div>
                                        </div>
                                        </div>
                                    </label>
                                    <input id="cropzee-input" style="display: none;" name="photo" type="file" accept="image/*">

                                </div>
                                <div class="modal-footer">
                                    @csrf
                                    <input type="hidden" value="{{ $employee->employee_id }}" name="id">
                                    <button type="submit" class="btn btn-primary">জমা দিন</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">বাতিল</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <h5 class="text-center">{{ $employee->name }}</h5>
                <p class="text-center text-muted">@if($employee->designation_id == 1)  মেয়র @elseif($employee->designation_id == 2) সচিব @elseif($employee->designation_id == 3) নির্বাহী কর্মকর্তা @elseif($employee->designation_id == 4) নির্বাহী প্রকৌশলী কর্মকর্তা @elseif($employee->designation_id == 5)
                        কাউন্সিলর @elseif($employee->designation_id == 6) মেডিকেল অফিসার @endif</p>
                <div class="profile-info">
                    <h5 class="mb-20 weight-500">যোগাযোগের তথ্য</h5>
                    <ul>
                        <li>
                            <span>ইমেল ঠিকানা:</span>
                            {{ $employee->email }}
                        </li>
                        <li>
                            <span>ফোন নম্বর:</span>
                            {{ $employee->mobile }}
                        </li>
                        <li>
                            <span>নাগরিকত্ব:</span>
                            বাংলাদেশী
                        </li>
                        <li>
                            <span>ঠিকানা:</span>
                            <address>
                                {{ $employee->address }}
                            </address>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="bg-white border-radius-4 box-shadow height-100-p">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ ($errors->all() != null)? '' : 'active' }}" data-toggle="tab" href="#profile" role="tab"><i class="icon-copy fa fa-user" aria-hidden="true"></i> প্রোফাইল</a>
                            </li>
                            @if($employee->employee_id == Auth::user()->employee_id)
                            <li class="nav-item">
                                <a class="nav-link {{ ($errors->all() != null)? 'active' : '' }}" data-toggle="tab" href="#advanceSetting" role="tab"><i class="icon-copy fa fa-cog" aria-hidden="true"></i> সেটিং</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <!-- Timeline Tab start -->
                            <div class="tab-pane fade {{ ($errors->all() != null)? '' : 'show active' }}" id="profile" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table table-borderless table-responsive">
                                        <tbody>
                                        <tr>
                                            <th>নাম:</th>
                                            <td>{{ $employee->name }}</td>

                                            <th>#আই.ডি. নং:</th>
                                            <td>{{ $employee->device_id }}</td>
                                        </tr>

                                        <tr>
                                            <th>জন্মতারিখ:</th>
                                            <td>{{ $employee->date_of_birth }}</td>

                                            <th>ন্যাশনাল আইডি নং:</th>
                                            <td>{{ $employee->nid }}</td>
                                        </tr>
                                        <tr>
                                            <th>লিঙ্গ:</th>
                                            <td>{{ ($employee->gender == 1)? 'পুরুষ' : 'মহিলা' }}</td>

                                            <th>বৈবাহিক সম্পর্ক:</th>
                                            <td>{{ ($employee->marital_status == 1)? 'অবিবাহিত' : 'বিবাহিত' }}</td>
                                        </tr>

                                        <tr>
                                            <th>শিক্ষাগত যোগ্যতা:</th>
                                            <td colspan="3">{{ $employee->qualification }}</td>
                                        </tr>

                                        <tr>
                                            <th>নাগরিকত্ব:</th>
                                            <td>বাংলাদেশী</td>

                                            <th>ঠিকানা: </th>
                                            <td>জেলা: {{ $employee->district }}, উপজেলা/থানা: {{ $employee->upazila }}, পোস্ট অফিস: {{ $employee->post_office }}</td>
                                        </tr>
                                        <tr>
                                            <th>চাকরি যোগদান তারিখ:</th>
                                            <td>{{ $employee->join_date }}</td>

                                            <th>নির্বাচনী এলাকা:</th>
                                            <td>{{ $employee->election_area }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">মেসেজ:</th>
                                            <td colspan="3">{{ $employee->messages }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">এভেইলেবল:</th>
                                            <td colspan="3">{{ ($employee->status == 1)? 'এভেইলেবল আছে' : 'এভেইলেবল নেই' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Timeline Tab End -->
                        @if($employee->employee_id == Auth::user()->employee_id)
                            <!-- Advance Setting Tab Start-->
                            <div class="tab-pane fade {{ ($errors->all() != null)? 'show active' : '' }}" id="advanceSetting" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                        <div class="container pd-0">
                                            <!-- user setting start -->
                                            <div class="task-title row align-items-center">
                                                <div class="col-md-8 col-sm-12">
                                                    <h5 class="text-blue">ইউজার সেটিং:</h5>
                                                </div>
                                            </div>
                                            <div class="profile-task-list pb-30">
                                                <form action="{{ route('change_user_info') }}" method="post" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                                                    @csrf
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group bt-flabels__wrapper @error('name') has-danger @enderror">
                                                            <label class="form-control-label">পূর্ণ নাম <span>*</span></label>
                                                            <input type="text" name="name" value="{{ old('name')? old('name') : $employee->name }}" placeholder="পূর্ণ নাম প্রদান করূন" class="form-control form-control-lg @error('name') form-control-danger @enderror" autocomplete="name" autofocus data-parsley-trigger="keyup" data-parsley-required>

                                                            <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>
                                                            @error('name')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group bt-flabels__wrapper @error('username') has-danger @enderror">
                                                            <label class="form-control-label">ইউজারনেম</label>
                                                            <input type="text" value="{{ $employee->username }}" placeholder="ইউজারনেম প্রদান করূন" class="form-control form-control-lg @error('username') form-control-danger @enderror" autocomplete="username" disabled>

                                                            <span class="bt-flabels__error-desc">ইউজারনেম দিন....</span>
                                                            @error('username')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </li>
                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group bt-flabels__wrapper @error('nid') has-danger @enderror">
                                                            <label class="form-control-label">ন্যাশনাল আইডি <span>*</span></label>
                                                            <input type="text" name="nid" value="{{ old('nid')? old('nid') : $employee->nid }}" placeholder="12626200872213243" class="form-control @error('nid') form-control-danger @enderror" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup" >

                                                            <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>
                                                            @error('nid')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group bt-flabels__wrapper @error('email') has-danger @enderror">
                                                            <label class="form-control-label">ইমেল </label>
                                                            <input type="email" name="email" value="{{ old('email')? old('email') : $employee->email }}" placeholder="example@gmail.com" class="form-control @error('email') form-control-danger @enderror" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup" >

                                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>
                                                            @error('email')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </li>
                                                    <input type="hidden" name="id" value="{{ $employee->employee_id }}">
                                                    <button type="submit" class="btn btn-info ml-auto mr-auto">সেভ ইউজার সেটিং</button>
                                                </ul>
                                                </form>
                                            </div>
                                            <!-- user setting End -->
                                            <!-- password setting start -->
                                            <div class="task-title row align-items-center">
                                                <div class="col-md-12 col-sm-12">
                                                    <h5 class="text-blue">পাসওয়ার্ড সেটিং:</h5>
                                                </div>
                                            </div>
                                            <div class="profile-task-list pb-30">
                                                <form action="{{ route('change_pass') }}" method="post" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                                                    @csrf
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group bt-flabels__wrapper @error('current_pass') has-danger @enderror">
                                                            <label class="form-control-label">কারেন্ট পাসওয়ার্ড <span>*</span></label>
                                                            <input type="password" name="current_pass" value="{{ old('current_pass') }}" placeholder="********" class="form-control @error('current_pass') form-control-danger @enderror" autocomplete="current_pass" autofocus data-parsley-required>

                                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে কারেন্ট পাসওয়ার্ড দিন....</span>
                                                            @error('current_pass')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group bt-flabels__wrapper @error('new_pass') has-danger @enderror">
                                                            <label class="form-control-label">নিউ পাসওয়ার্ড <span>*</span></label>
                                                            <input type="password" name="new_pass" value="{{ old('new_pass') }}" placeholder="********" class="form-control @error('new_pass') form-control-danger @enderror" autocomplete="new_pass" autofocus data-parsley-required>

                                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে নিউ পাসওয়ার্ড দিন....</span>
                                                            @error('new_pass')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group bt-flabels__wrapper @error('confirm_pass') has-danger @enderror">
                                                            <label class="form-control-label">কনফার্ম পাসওয়ার্ড <span>*</span></label>
                                                            <input type="password" name="confirm_pass" value="{{ old('confirm_pass') }}" placeholder="********" class="form-control @error('confirm_pass') form-control-danger @enderror" autocomplete="confirm_pass" autofocus data-parsley-required>

                                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে কনফার্ম পাসওয়ার্ড দিন....</span>
                                                            @error('confirm_pass')
                                                            <div class="form-control-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </li>
                                                    <li class="weight-500 col-md-6"></li>
                                                    <input type="hidden" name="id" value="{{ $employee->employee_id }}">
                                                    <button type="submit" class="btn btn-info ml-5">সেভ পাসওয়ার্ড সেটিং</button>
                                                </ul>
                                                </form>
                                            </div>
                                            <!-- password setting End -->
                                        </div>
                                    </div>
                            </div>
                            <!-- Advance Setting Tab End-->
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>
    <script src="{{ asset('js/task.min.js') }}"></script>

    <!-- add sweet alert js & css in footer -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.date').datepicker({
                language: 'en',
                autoClose: true,
                dateFormat: 'yy-mm-dd',
            });

            $("#cropzee-input").cropzee({
                startSize: [100, 100, '%'],
                allowedInputs: ['png','jpg','jpeg'],
                imageExtension: 'image/jpg',
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });
        });
    </script>
@endsection
