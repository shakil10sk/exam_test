@extends('layouts.app')
@section('head')
    {{-- form custom style --}}
    <link rel="stylesheet" href="{{ asset('css/form_validate.min.css') }}">

    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.min.css') }}">
@endsection
@section('content')
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> পৌরসভা সেটআপ</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">

                    @can('union-profile')
                    <a class="nav-link @if($errors->all() == null)active @endif" id="v-pills-profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><i class="icon-copy fa fa-user" aria-hidden="true"></i> প্রোফাইল</a>
                    @endcan

                    @can('edit-union')
                    <a class="nav-link @if($errors->all() != null)active @endif" id="v-pills-setting-tab" data-toggle="pill" href="#setting" role="tab" aria-controls="v-pills-setting" aria-selected="false"><i class="icon-copy fa fa-cog" aria-hidden="true"></i> এডিট</a>
                    @endcan

                </div>

                <div class="tab-content" id="v-pills-tabContent">
                    
                    @can('union-profile')
                    <div class="tab-pane fade @if($errors->all() == null)show active @endif" id="profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="row">
                            <div class="col-md-12 text-center bg-blue border-radius-4 p-2">
                                <h4 class="text-white">ডিজিটাল পৌরসভা পরিষদ প্রোফাইল</h4>
                            </div>
                        </div>
                        <table class="table table-borderless table-responsive">
                            <tbody>
                            <tr>
                                <th>পৌরসভা বাংলা নাম:</th>
                                <td>{{ $data->bn_name }}</td>

                                <th>পৌরসভা ইংরেজি নাম:</th>
                                <td>{{ $data->en_name }}</td>
                            </tr>

                            <tr>
                                <th>পোস্টাল কোড:</th>
                                <td>{{ $data->postal_code }}</td>

                                <th>পৌরসভা কোড:</th>
                                <td>{{ $data->union_code }}</td>
                            </tr>
                            <tr>
                                <th>ভিলেজ বাংলা:</th>
                                <td>{{ $data->village_bn }}</td>

                                <th>ভিলেজ ইংরেজি:</th>
                                <td>{{ $data->village_en }}</td>
                            </tr>

                            <tr>
                                <th>মোবাইল:</th>
                                <td>{{ $data->mobile }}</td>

                                <th>টেলিফোন:</th>
                                <td>{{ $data->telephone }}</td>
                            </tr>
                            <tr>
                                <th>ই-মেইল:</th>
                                <td>{{ $data->email }}</td>

                                <th>ওয়েবসাইট:</th>
                                <td>{{ $data->sub_domain }}</td>
                            </tr>

                            <tr>
                                <th>ঠিকানা: </th>
                                <td colspan="3">জেলা: {{ $data->district }}, উপজেলা/থানা: {{ $data->upazila }}, পোস্ট অফিস: {{ $data->post_office }}-{{ $data->postal_code }}</td>
                            </tr>
                            
                            <tr>
                                <th>মোট ওয়ার্ড সংখ্যা:</th>
                                <td colspan="3">{{$data->ward_no}}</td>
                            </tr>

                            <tr>
                                <th>পৌরসভা সচিব:</th>
                                <td>{{ $data->secretaryName }}</td>

                                <th>পৌরসভা স্ট্যাটাস:</th>
                                <td>@if($data->status == 1) <span class="badge badge-success">চালু আছে</span> @else <span class="badge badge-danger">বন্ধ আছে</span> @endif</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h4 class="text-blue">পৌরসভা মেইন লোগো</h4>
                                <img src="{{ asset('images/union_profile/'.$data->main_logo) }}" width="100">
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 class="text-blue">পৌরসভা ব্র্যান্ড লোগো</h4>
                                <img src="{{ asset('images/union_profile/'.$data->brand_logo) }}" width="100">
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 class="text-blue">পৌরসভা জলছাপ</h4>
                                <img src="{{ asset('images/union_profile/'.$data->jolchap) }}" width="100">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>পৌরসভা পরিষদ সম্পর্কে: </strong> @php echo $data->about; @endphp
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 border border-radius-4 p-0" id="map">
                                @php
                                    echo $data->google_map;
                                @endphp
                            </div>
                        </div>
                    </div>
                    @endcan

                    @can('edit-union')
                    <div class="tab-pane fade @if($errors->all() != null)show active @endif" id="setting" role="tabpanel" aria-labelledby="v-pills-setting-tab">
                        <div class="row">
                            <div class="col-md-12 text-center bg-blue border-radius-4 p-2">
                                <h4 class="text-white">ডিজিটাল পৌরসভা পরিষদ আপডেট প্রোফাইল সেটিং</h4>
                            </div>
                        </div>

                        <form action="{{ route('union_update') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                            @csrf
                            <ul class="profile-edit-list row mt-3">
                                <li class="weight-500 col-md-6">
                                    <div class="form-group bt-flabels__wrapper @error('en_name') has-danger @enderror">
                                        <label class="form-control-label">পৌরসভার নাম (ইংরেজিতে) <span>*</span></label>
                                        <input type="text" name="en_name" value="{{ old('en_name')? old('en_name') : $data->en_name }}" placeholder="পৌরসভার পূর্ণ নাম প্রদান করূন" class="form-control form-control-lg @error('en_name') form-control-danger @enderror" autocomplete="en_name" autofocus data-parsley-trigger="keyup" data-parsley-required>

                                        <span class="bt-flabels__error-desc">পৌরসভার নাম দিন ইংরেজিতে....</span>
                                        @error('en_name')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('district_id') has-danger @enderror">
                                        <label for="District-english" class="form-control-label">জেলা <span>*</span></label>
                                        <select onchange="getLocation($(this).val(), null, 'upazila_append', 'upazila_id', null, 3 )" name="district_id" id="district_id" class="custom-select2 form-control @error('district_id')form-control-danger @enderror" style="width: 100%; height: 38px;" data-parsley-required >
                                            <option value="" class="district_append">চিহ্নিত করুন</option>
                                            <option value="{{ $data->district_id }}" selected="selected">{{ $data->district }}</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                        @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('upazila_id') has-danger @enderror">
                                        <label for="District-english" class="form-control-label">উপজেলা/থানা <span>*</span></label>
                                        <select onchange="getLocation($(this).val(), null, 'postal_append', 'postal_id', null, 6)" name="upazila_id" id="upazila_id" class="form-control @error('upazila_id')form-control-danger @enderror" data-parsley-required >
                                            <option value="" id="upazila_append">চিহ্নিত করুন</option>
                                            <option value="{{ $data->upazila_id }}" selected="selected">{{ $data->upazila }}</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                        @error('upazila_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('postal_id') has-danger @enderror">
                                        <label for="District-english" class="form-control-label">পোস্ট অফিস <span>*</span></label>
                                        <select name="postal_id" id="postal_id" class="form-control @error('postal_id')form-control-danger @enderror" data-parsley-required >
                                            <option value="" id="postal_append">চিহ্নিত করুন</option>
                                            <option value="{{ $data->postal_id }}" selected="selected">{{ $data->post_office }}</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">পোস্ট অফিস নির্বাচন করুন....</span>

                                        @error('postal_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('postal_code') has-danger @enderror">
                                        <label class="form-control-label">পোস্টাল কোড </label>
                                        <input type="text" name="postal_code" value="{{ old('postal_code')? old('postal_code') : $data->postal_code }}" placeholder="1010101" class="form-control form-control-lg @error('postal_code') form-control-danger @enderror" autocomplete="postal_code" autofocus data-parsley-type="number" data-parsley-trigger="keyup" >

                                        <span class="bt-flabels__error-desc">অনুগ্রহ করে পোস্টাল কোড দিন....</span>
                                        @error('postal_code')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group bt-flabels__wrapper @error('ward_no') has-danger @enderror">
                                        <label class="form-control-label">মোট ওয়ার্ড সংখ্যা</label>

                                        <input type="text" name="ward_no" value="{{ old('ward_no') ? old('ward_no') : $data->ward_no }}" placeholder="1" class="form-control form-control-lg @error('ward_no') form-control-danger @enderror" autocomplete="ward_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" >

                                        <span class="bt-flabels__error-desc">অনুগ্রহ করে মোট ওয়ার্ড সংখ্যা দিন....</span>
                                        @error('ward_no')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-10">
                                            <div class="form-group @error('main_logo') has-danger @enderror">
                                                <div class="custom-file">
                                                    <input id="mainLogo" accept="image/png" name="main_logo" type="file" class="custom-file-input">
                                                    <label for="mainLogo" id="mainLogoLabel" class="custom-file-label" style="cursor: pointer;">মেইন লোগো সিলেক্ট করুন</label>
                                                </div>
                                                @error('main_logo')
                                                <div class="form-control-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="{{ asset('images/union_profile/'.$data->main_logo) }}" width="50" alt="main_logo.jpg">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-10">
                                            <div class="form-group @error('brand_logo') has-danger @enderror">
                                                <div class="custom-file" style="cursor: pointer;">
                                                    <input id="brandLogo" accept="image/png" name="brand_logo" type="file" class="custom-file-input">
                                                    <label for="brandLogo" id="brandLogoLabel" class="custom-file-label" style="cursor: pointer;">ব্র্যান্ড লোগো সিলেক্ট করুন</label>
                                                </div>
                                                @error('brand_logo')
                                                <div class="form-control-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="{{ asset('images/union_profile/'.$data->brand_logo) }}" width="50" alt="brand_logo.jpg">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-10">
                                            <div class="form-group @error('jolchap') has-danger @enderror">
                                                <div class="custom-file">
                                                    <input id="jolchap" accept="image/png" name="jolchap" type="file" class="custom-file-input">
                                                    <label for="jolchap" id="jolchapLabel" class="custom-file-label" style="cursor: pointer;">জলছাপ সিলেক্ট করুন</label>
                                                </div>
                                                @error('jolchap')
                                                <div class="form-control-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <img src="{{ asset('images/union_profile/'.$data->jolchap) }}" width="50" alt="jolchap.jpg">
                                        </div>

                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="weight-600">ট্রেড লাইসেন্স সনদ জেনারেট</label>

                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" id="direct_generate" name="trade_generate" class="custom-control-input" value="1" @if($settings->value == 1) checked @endif>
                
                                                    <label class="custom-control-label" for="direct_generate">সরাসরি সনদ তৈরী</label>
                                                </div>
                                                
                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" id="invoice_generate" name="trade_generate" class="custom-control-input" value="2" @if($settings->value == 2) checked @endif>
                
                                                    <label class="custom-control-label" for="invoice_generate">আগে ইনভয়েচ, পরে সনদ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>

                                <li class="weight-500 col-md-6">
                                    <div class="form-group bt-flabels__wrapper @error('bn_name') has-danger @enderror">
                                        <label class="form-control-label">পৌরসভার নাম (বাংলায়) <span>*</span></label>
                                        <input type="text" name="bn_name" value="{{ old('bn_name')? old('bn_name') : $data->bn_name }}" placeholder="পৌরসভার পূর্ণ নাম প্রদান করূন" class="form-control form-control-lg @error('bn_name') form-control-danger @enderror" autocomplete="bn_name" autofocus data-parsley-trigger="keyup" data-parsley-required>

                                        <span class="bt-flabels__error-desc">পৌরসভার নাম দিন বাংলায়....</span>
                                        @error('bn_name')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('village_bn') has-danger @enderror">
                                        <label class="form-control-label">গ্রাম/মহল্লা (বাংলায়) <span>*</span></label>
                                        <input type="text" name="village_bn" value="{{ old('village_bn')? old('village_bn') : $data->village_bn }}" placeholder="গ্রাম/মহল্লা নাম দিন" class="form-control form-control-lg @error('village_bn') form-control-danger @enderror" autocomplete="village_bn" autofocus data-parsley-trigger="keyup" data-parsley-required>

                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা নাম দিন বাংলায়....</span>
                                        @error('village_bn')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('village_en') has-danger @enderror">
                                        <label class="form-control-label">গ্রাম/মহল্লা (ইংরেজিতে) <span>*</span></label>
                                        <input type="text" name="village_en" value="{{ old('village_en')? old('village_en') : $data->village_en }}" placeholder="গ্রাম/মহল্লা নাম দিন" class="form-control form-control-lg @error('village_en') form-control-danger @enderror" autocomplete="village_en" autofocus data-parsley-pattern='^[a-zA-Z. (),:;_]+$' data-parsley-trigger="keyup" >

                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা নাম দিন ইংরেজিতে....</span>
                                        @error('village_en')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('mobile') has-danger @enderror">
                                        <label class="form-control-label">মোবাইল <span>*</span></label>
                                        <input type="text" name="mobile" value="{{ old('mobile')? old('mobile') : $data->mobile }}" placeholder="মোবাইল নম্বর  প্রদান করূন" class="form-control @error('mobile') form-control-danger @enderror" autocomplete="mobile" autofocus data-parsley-maxlength="11" data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required>

                                        <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>
                                        @error('mobile')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('telephone') has-danger @enderror">
                                        <label class="form-control-label">টেলিফোন নম্বর</label>
                                        <input type="text" name="telephone" value="{{ old('telephone')? old('telephone') : $data->telephone }}" placeholder="টেলিফোন নম্বর প্রদান করূন" class="form-control @error('telephone') form-control-danger @enderror" autocomplete="telephone" autofocus data-parsley-maxlength="15" data-parsley-type="number" data-parsley-trigger="keyup">

                                        <span class="bt-flabels__error-desc">টেলিফোন নম্বর দিন....</span>
                                        @error('telephone')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('email') has-danger @enderror">
                                        <label class="form-control-label">ইমেল</label>
                                        <input type="email" name="email" value="{{ old('email')? old('email') : $data->email }}" placeholder="example@gmail.com" class="form-control @error('email') form-control-danger @enderror" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup">

                                        <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>
                                        @error('email')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label"><i class="icon-copy fa fa-arrow-right" aria-hidden="true"></i> জেলা, উপজেলা, পোস্ট অফিস প্রি সিলেক্ট থাকবে</label>
                                        <input type="checkbox" {{ ($data->pre_select)? 'checked' : '' }} name="pre_select" class="switch-btn" data-size="large" data-color="green" data-secondary-color="#e46969">
                                    </div>

                                    <div class="form-group">
                                        <p><strong>নোটঃ</strong> পৌরসভা মেইন লোগো, ব্র্যান্ড লোগো এবং জলছাপ (PNG)* ফরমেট দিতে হবে। লোগো নির্বাচনের সময় লোগোটি ট্রান্সপারেন্ট হলে ভালো হয়।</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="col-md-12">
                                <textarea class="textarea_editor form-control border-radius-0" name="about" placeholder="ইউনিয়ন পরিষদ সম্পর্কে লিখুন....">{{ old('about')? old('about') : $data->about }}</textarea>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group bt-flabels__wrapper @error('google_map') has-danger @enderror">
                                    <textarea class="form-control @error('google_map') form-control-danger @enderror" placeholder="গুগল ম্যাপ কী ফ্রেম দিন...." name="google_map" id="googleMap"></textarea>

                                    @error('google_map')
                                    <div class="form-control-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 border border-radius-4 p-0" id="map">
                                @php
                                    echo $data->google_map;
                                @endphp
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">সংরক্ষণ করুন</button>
                            </div>
                        </form>
                    </div>
                    @endcan
                </div>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>
    <!-- switchery js -->
    <script src="{{ asset('js/switchery.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            /* Switchery */
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
            $('.switch-btn').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            $('#mainLogo').change(function () {
                let data = $(this)[0].files[0].name;
                $('#mainLogoLabel').text(data);
            });

            $('#brandLogo').change(function () {
                let data = $(this)[0].files[0].name;
                $('#brandLogoLabel').text(data);
            });

            $('#jolchap').change(function () {
                let data = $(this)[0].files[0].name;
                $('#jolchapLabel').text(data);
            });

            $('.sa-error').click(function () {
                swal(
                    {
                        type: 'error',
                        title: 'দুঃখিত...',
                        text: 'পৌরসভা রেজিস্ট্রেশন বাতিল করা হবে? অন্যান্য সেবা প্রদানে পৌরসভা সেটআপ সম্পন্ন করুন।',
                        confirmButtonText: 'ঠিক আছে',
                        showCancelButton: true,
                        cancelButtonText: 'বাতিল',
                        allowOutsideClick: true,
                        allowEscapeKey: true
                    }
                ).then(function (result) {
                    if (result.value){
                        $('#data-dismiss').attr('data-dismiss', 'false');
                    }else{
                        $('#unionRegisterModal').modal('hide').then(function () {
                            Swal.fire();
                        });
                    }
                })
            });
            var m = $('#modal-val').val();
            if(m == 1){
                $("#unionRegisterModal").modal();
            }
        });
    </script>
@endsection
