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

                        <div class="row">
                            <div class="col-md-12 text-center bg-info border-radius-4 p-2">
                                <h4 class="text-white">পৌরসভা তথ্য</h4>
                            </div>
                        </div>

                        <form action="{{ route('union_updates') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
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
                                            <option value="{{ $data->district_id }}" selected="selected">{{ $data->union_district_name_en }}</option>
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
                                            <option value="{{ $data->upazila_id }}" selected="selected">{{ $data->union_upazila_name_en }}</option>
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
                                        <select name="postal_id" id="postal_id" class="form-control @error('postal_id')form-control-danger @enderror"  data-parsley-required>
                                            <option value="" id="postal_append">চিহ্নিত করুন</option>
                                            <option value="{{ $data->postal_id }}" selected="selected">{{ $data->union_postoffice_name_en }}</option>
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
                                            @if ($data->main_logo)
                                            <img src="{{ asset('images/union_profile/'.$data->main_logo) }}" width="50" alt="main_logo.jpg">
                                            @endif
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
                                            @if ($data->brand_logo)
                                            <img src="{{ asset('images/union_profile/'.$data->brand_logo) }}" width="50" alt="brand_logo.jpg">
                                            @endif
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
                                            @if ($data->jolchap)
                                            <img src="{{ asset('images/union_profile/'.$data->jolchap) }}" width="50" alt="jolchap.jpg">
                                            @endif
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

                                     <div class="form-group bt-flabels__wrapper @error('union_code') has-danger @enderror">
                                        <label class="form-control-label">পৌরসভা কোড <span>*</span></label>
                                        <input type="text" name="union_code" value="{{ old('union_code')? old('union_code') : $data->union_code }}" placeholder="পৌরসভা কোড প্রদান করূন" class="form-control @error('union_code') form-control-danger @enderror" autocomplete="union_code" autofocus data-parsley-minlength="6" minlength="6" data-parsley-maxlength="7" maxlength="7" data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required>

                                        <span class="bt-flabels__error-desc">পৌরসভা ৭ ডিজিটের কোড দিন....</span>
                                        @error('union_code')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('sub_domain') has-danger @enderror">
                                        <label class="form-control-label">সাব-ডোমেইন <span>*</span></label>
                                        <input type="text" name="sub_domain" value="{{ old('sub_domain')? old('sub_domain') : $data->sub_domain }}" placeholder="সাব-ডোমেইন প্রদান করুন" class="form-control form-control-lg @error('sub_domain') form-control-danger @enderror" autocomplete="sub_domain" autofocus data-parsley-pattern='^[a-zA-Z. (),:;_]+$' data-parsley-trigger="keyup" data-parsley-required>

                                        <span class="bt-flabels__error-desc">সাব-ডোমেইন দিন ইংরেজিতে....</span>
                                        @error('sub_domain')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group bt-flabels__wrapper @error('village_bn') has-danger @enderror">
                                        <label class="form-control-label">গ্রাম/মহল্লা (বাংলায়) </label>
                                        <input type="text" name="village_bn" value="{{ old('village_bn')? old('village_bn') : $data->village_bn }}" placeholder="গ্রাম/মহল্লা নাম দিন" class="form-control form-control-lg @error('village_bn') form-control-danger @enderror" autocomplete="village_bn" autofocus data-parsley-trigger="keyup" >

                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা নাম দিন বাংলায়....</span>
                                        @error('village_bn')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>



                                    <div class="form-group bt-flabels__wrapper @error('mobile') has-danger @enderror">
                                        <label class="form-control-label">মোবাইল </label>
                                        <input type="text" name="mobile" value="{{ old('mobile')? old('mobile') : $data->mobile }}" placeholder="মোবাইল নম্বর  প্রদান করূন" class="form-control @error('mobile') form-control-danger @enderror" autocomplete="mobile" autofocus data-parsley-maxlength="11" data-parsley-type="number" data-parsley-trigger="keyup">

                                        <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>
                                        @error('mobile')
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

                                        <input type="checkbox" {{ ($data->pre_select??0)? 'checked' : '' }}  name="pre_select" class="switch-btn" data-size="large" data-color="green" data-secondary-color="#e46969">
                                    </div>

                                    <div class="form-group">
                                        <p><strong>নোটঃ</strong> পৌরসভা মেইন লোগো, ব্র্যান্ড লোগো এবং জলছাপ (PNG)* ফরমেট দিতে হবে। লোগো নির্বাচনের সময় লোগোটি ট্রান্সপারেন্ট হলে ভালো হয়।</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="col-md-12">
                                <textarea class="form-control border-radius-0" name="about" placeholder="পৌরসভা সম্পর্কে লিখুন....">{{ old('about')? old('about') : $data->about }}</textarea>
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

                            <input type="hidden" name="row_id" value="{{ $data->id }}">

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">দাখিল করুন</button>
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
