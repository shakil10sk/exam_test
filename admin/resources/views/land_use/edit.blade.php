@extends('layouts.app')

@section('head')
    {{-- form custom style --}}
    <link rel="stylesheet" href="{{ asset('css/form_validate.min.css') }}">

    <!-- jquery -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
@endsection

@section('content')
    <section>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title text-center">
                        <h4 class="text-center application_head">ভূমি ব্যবহার ছাড়পত্রের অনুমতির তথ্য সংশোধন</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="{{ route('land_use_update') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

                <div class="row" >
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row form-group" style="margin-top: 50px;">
                                    <label for="Name-english" class="col-sm-3 control-label"> নাম (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en')? old('name_en') : $data->name_en }}" class="form-control @error('name_en') is-invalid @enderror" placeholder="Full Name" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                        <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                    <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়)  <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn')? old('name_bn') : $data->name_bn }}" class="form-control @error('name_bn') is-invalid @enderror" placeholder="পূর্ণ নাম" data-parsley-trigger="keyup" data-parsley-required />
                                        <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                        @error('name_bn')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)</label>

                                <div class="col-sm-3 bt-flabels__wrapper">
                                    <input type="text" name="nid" id="nid" value="{{ old('nid')? old('nid') : $data->nid }}" class="form-control @error('nid') is-invalid @enderror" data-parsley-maxlength="17" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                    <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                    @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="birth_id" value="{{ old('birth_id')? old('birth_id') : $data->birth_id }}" id="birth_id" class="form-control @error('birth_id') is-invalid @enderror" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
                                        <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>

                                        @error('birth_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="Passport-no" class="col-sm-3 control-label">পাসপোর্ট নং (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="passport_no" value="{{ old('passport_no')? old('passport_no') : $data->passport_no }}" id="passport_no" class="form-control @error('passport_no') is-invalid @enderror" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                        <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                        @error('passport_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="birth_date" value="{{ old('birth_date')? old('birth_date') : $data->birth_date }}" id="birth_date" class="form-control date @error('birth_date') is-invalid @enderror" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-trigger="keyup" data-parsley-required  placeholder="yyyy-mm-dd" />
                                        <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>

                                        @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cropzee-input">
                            <div class="image-overlay">
                                @if ($data->photo != NULL)
                                    <img src="{{ asset('images/application/'.$data->photo) }}" class="image-previewer image" data-cropzee="cropzee-input" />
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" class="image-previewer image" data-cropzee="cropzee-input" />
                                @endif

                                <button for="cropzee-input" class="btn btn-primary form-control"><i class="ion-ios-upload-outline"></i> Upload</button>
                                <div class="overlay">
                                    <div class="text">ক্লিক করুন

                                    </div>
                                </div>
                            </div>
                        </label>
                        <input id="cropzee-input" style="display: none;" name="photo" type="file" accept="image/*">
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en')? old('father_name_en') : $data->father_name_en }}" class="form-control @error('father_name_en') is-invalid @enderror" autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="Father's Name" />
                                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                @error('father_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn')? old('father_name_bn') : $data->father_name_bn }}" class="form-control @error('father_name_bn') is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" data-parsley-required />
                                <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                @error('father_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name_en" id="mother_name_en" value="{{ old('mother_name_en')? old('mother_name_en') : $data->mother_name_en }}" class="form-control @error('mother_name_en') is-invalid @enderror" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" class="form-control" placeholder="Mother's Name" />
                                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                @error('mother_name_en')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ old('mother_name_bn')? old('mother_name_bn') : $data->mother_name_bn }}" class="form-control @error('mother_name_bn') is-invalid @enderror" placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />
                                <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                                @error('mother_name_bn')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="row form-group">
                            <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="religion" id="religion" selected="selected"
                                        class="form-control @error('religion')is-invalid @enderror"
                                        data-parsley-required>
                                    <option
                                        value='' {{ (old('religion')? old('religion') : $data->religion == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>
                                    <option
                                        value='1' {{ (old('religion')? old('religion') : $data->religion == 1) ? 'selected="selected"' : '' }}>
                                        ইসলাম
                                    </option>
                                    <option
                                        value='2' {{ (old('religion')? old('religion') : $data->religion == 2) ? 'selected="selected"' : '' }}>
                                        হিন্দু
                                    </option>
                                    <option
                                        value='3' {{ (old('religion')? old('religion') : $data->religion == 3) ? 'selected="selected"' : '' }}>
                                        বৌদ্ধ ধর্ম
                                    </option>
                                    <option
                                        value='4' {{ (old('religion')? old('religion') : $data->religion == 4) ? 'selected="selected"' : '' }}>
                                        খ্রিস্ট ধর্ম
                                    </option>
                                    <option
                                        value='5' {{ (old('religion')? old('religion') : $data->religion == 5) ? 'selected="selected"' : '' }}>
                                        অন্যান্য
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('religion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="resident" id='resident' selected="selected"
                                        class="form-control @error('resident')is-invalid @enderror"
                                        data-parsley-required>
                                    <option
                                        value='' {{ (old('resident')? old('resident') : $data->resident == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>
                                    <option
                                        value='1' {{ (old('resident')? old('resident') : $data->resident == 1) ? 'selected="selected"' : '' }}>
                                        অস্থায়ী
                                    </option>
                                    <option
                                        value='2' {{ (old('resident')? old('resident') : $data->resident == 2) ? 'selected="selected"' : '' }}>
                                        স্থায়ী
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('resident')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="genderErr">

                        <div class="row form-group">
                            <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>

                            <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $data->gender) == 1) ? 'checked' : '' }} name="gender" value="1" />পুরুষ</label>

                                <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $data->gender) == 2) ? 'checked' : '' }} name="gender" value="2" />মহিলা</label>

                                <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $data->gender) == 3) ? 'checked' : '' }} name="gender" value="3" />অন্যান্য</label>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="marital_status" id="marital_status" selected="selected" class="form-control @error('marital_status')is-invalid @enderror" data-parsley-required >

                                    <option value="" {{ (old('marital_status')? old('marital_status') : $data->marital_status == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>

                                    <option value='1' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 1) ? 'selected="selected"' : '' }}>অবিবাহিত</option>

                                    <option value='2' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 2) ? 'selected="selected"' : '' }}>বিবাহিত</option>

                                    <option value='3' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 3) ? 'selected="selected"' : '' }}>তালাক প্রাপ্ত</option>

                                    <option value='4' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 4) ? 'selected="selected"' : '' }}>বিধবা</option>

                                    <option value='5' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>

                                </select>

                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('marital_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>



                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            বর্তমান ঠিকানা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en')? old('present_village_en') : $data->present_village_en }}" class="form-control @error('present_village_en')is-invalid @enderror" autocomplete="present_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />

                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('present_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn')? old('present_village_bn') : $data->present_village_bn }}" class="form-control @error('present_village_bn')is-invalid @enderror" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />

                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                @error('present_village_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no')? old('present_holding_no') : $data->present_holding_no }}" class="form-control @error('present_holding_no')is-invalid @enderror" autocomplete="present_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>

                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no')? old('present_ward_no') : $data->present_ward_no }}" class="form-control @error('present_ward_no')is-invalid @enderror" autocomplete="present_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                @error('present_ward_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_district_id" class="col-sm-3 control-label">জেলা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )" class="custom-select2 form-control @error('present_district_id')is-invalid @enderror" id="present_district_id" name="present_district_id" style="width: 100%; height: 38px;" data-parsley-required>

                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>

                                    <option value="{{ $data->present_district_id }}" selected="selected">{{ $data->present_district_name_en }}</option>

                                </select>

                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('present_district_id')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <label for="present_district" class="col-sm-3 control-label">জেলা</label>

                            <div class="col-sm-3">
                                <input type="text" disabled id="present_district" value="{{ $data->present_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_upazila', 'present_postoffice_append', 'present_postoffice_id', 'present_postoffice', 6 )" name="present_upazila_id" id="present_upazila_id" class="custom-select2 form-control @error('present_upazila_id')is-invalid @enderror" data-parsley-required >

                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>

                                    <option value="{{ $data->present_upazila_id }}" selected="selected">{{ $data->present_upazila_name_en }}</option>

                                </select>

                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('present_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="present_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>

                            <div class="col-sm-3">
                                <input type="text" disabled id="present_upazila" value="{{ $data->present_upazila_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')" name="present_postoffice_id" id="present_postoffice_id" class="custom-select2 form-control @error('present_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $data->present_postoffice_id }}" selected="selected">{{ $data->present_postoffice_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('present_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                @enderror
                            </div>
                            <label for="present_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="present_postoffice" value="{{ $data->present_postoffice_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            পূর্বের  ঠিকানা
                        </h4>
                        <p style="font-size:15px; font-weight:normal;padding-top:10px;"> <input type="checkbox" name="permanentBtn" id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন</p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">

                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_en" id="permanent_village_en" value="{{ old('permanent_village_en')? old('permanent_village_en') : $data->permanent_village_en }}" class="form-control @error('permanent_village_en')is-invalid @enderror" autocomplete="permanent_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('permanent_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn')? old('permanent_village_bn') : $data->permanent_village_bn }}" class="form-control @error('permanent_village_bn')is-invalid @enderror" autocomplete="permanent_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                @error('permanent_village_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no')? old('permanent_holding_no') : $data->permanent_holding_no }}" class="form-control @error('permanent_holding_no')is-invalid @enderror" autocomplete="permanent_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no')? old('permanent_ward_no') : $data->permanent_ward_no }}" class="form-control @error('permanent_ward_no')is-invalid @enderror" autocomplete="permanent_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                @error('permanent_ward_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_district_id" class="col-sm-3 control-label">জেলা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )" name="permanent_district_id" id="permanent_district_id" class="custom-select2 form-control @error('permanent_district_id')is-invalid @enderror" style="width: 100%; height: 38px;" data-parsley-required >
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    <option value="{{ $data->permanent_district_id }}" selected="selected">{{ $data->permanent_district_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('permanent_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="permanent_district" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_district" value="{{ $data->permanent_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )" name="permanent_upazila_id" id="permanent_upazila_id" class="custom-select2 form-control @error('permanent_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $data->permanent_upazila_id }}" selected="selected">{{ $data->permanent_upazila_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('permanent_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="permanent_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>

                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_upazila" value="{{ $data->permanent_upazila_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')" name="permanent_postoffice_id" id="permanent_postoffice_id" class="custom-select2 form-control @error('permanent_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $data->permanent_postoffice_id }}" selected="selected">{{ $data->permanent_postoffice_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('permanent_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="permanent_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>

                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_postoffice" value="{{ $data->permanent_postoffice_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            জমির বিবরণ
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="dag_no_cs" class="col-sm-3 control-label">দাগ নং-সি এস <span class="text-danger"
                                > *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="dag_no_cs" id="dag_no_cs" value="{{ old('dag_no_cs') ? old
                                ('dag_no_cs') : $data->dag_no_cs }}"
                                       class="form-control @error('dag_no_cs')is-invalid @enderror"
                                       data-parsley-required  data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">দাগ নং-সি এস দিন....</span>

                                @error('dag_no_cs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="khotian_no_cs" class="col-sm-3 control-label">খতিয়ান নং-সি এস<span
                                    class="text-danger"
                                > *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="khotian_no_cs" id="khotian_no_cs" value="{{ old
                                ('khotian_no_cs') ? old
                                ('khotian_no_cs') : $data->khotian_no_cs
                                }}" class="form-control @error('khotian_no_cs')is-invalid @enderror"
                                       data-parsley-maxlength="50" data-parsley-required
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">খতিয়ান নং-সি এস দিন....</span>

                                @error('khotian_no_cs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="dag_no_sa" class="col-sm-3 control-label">দাগ নং- এস এ
                                <span class="text-danger"> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="dag_no_sa" id="dag_no_sa"
                                       value="{{ old('dag_no_sa') ? old
                                ('dag_no_sa') : $data->dag_no_sa }}"
                                       class="form-control @error('dag_no_sa')is-invalid @enderror"
                                       data-parsley-trigger="keyup"  data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">দাগ নং- এস এ দিন....</span>

                                @error('dag_no_sa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="khotian_no_sa" class="col-sm-3 control-label">খতিয়ান নং- এস এ
                                <span class="text-danger"> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="khotian_no_sa" id="khotian_no_sa"
                                       value="{{ old('khotian_no_sa') ? old
                                ('khotian_no_sa') : $data->khotian_no_sa }}"
                                       class="form-control @error('khotian_no_sa')is-invalid @enderror"
                                       data-parsley-maxlength="50" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">খতিয়ান নং- এস এ দিন....</span>

                                @error('khotian_no_sa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="dag_no_rs" class="col-sm-3 control-label">দাগ নং-আর এস
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="dag_no_rs" id="dag_no_rs"
                                       value="{{ old('dag_no_rs') ? old
                                ('dag_no_rs') : $data->dag_no_rs }}"
                                       class="form-control @error('dag_no_rs')is-invalid @enderror"
                                       data-parsley-trigger="keyup"  data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">দাগ নং-আর এস দিন....</span>

                                @error('dag_no_rs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="khotian_no_rs" class="col-sm-3 control-label">খতিয়ান নং-আর এস <span
                                    class="text-danger">
                                    *</span> </label>
                            <div class="col-sm-3">
                                <input type="text" name="khotian_no_rs" id="khotian_no_rs"
                                       value="{{ old('khotian_no_rs') ? old
                                ('khotian_no_rs') : $data->khotian_no_rs }}"
                                       class="form-control @error('khotian_no_rs')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">খতিয়ান নং-আর এস দিন....</span>

                                @error('khotian_no_rs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="mojar_name" class="col-sm-3 control-label">
                                মৌজার নাম <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mojar_name" id="mojar_name"
                                       value="{{ old('mojar_name') ? old
                                ('mojar_name') : $data->mojar_name }}"
                                       class="form-control @error('mojar_name')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">মৌজার নাম দিন
                                    ....</span>

                                @error('mojar_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="mojar_no" class="col-sm-3 control-label">
                                মৌজার নং<span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mojar_no" id="mojar_no"
                                       value="{{ old('mojar_no') ? old
                                ('mojar_no') : $data->mojar_no }}"
                                       class="form-control @error('mojar_no')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">  মৌজার নং দিন
                                    ....</span>

                                @error('mojar_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="land_amount" class="col-sm-3 control-label">
                                জমির পরিমাণ <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="land_amount" id="land_amount"
                                       value="{{ old('land_amount') ? old
                                ('land_amount') : $data->land_amount }}"
                                       class="form-control @error('land_amount')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">জমির পরিমাণ দিন
                                    ....</span>

                                @error('land_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="land_type" class="col-sm-3 control-label">
                                জমির ধরণ<span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="land_type" id="land_type"
                                       value="{{ old('land_type') ? old
                                ('land_type') : $data->land_type }}"
                                       class="form-control @error('land_type')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">  জমির ধরণ দিন
                                    ....</span>

                                @error('land_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="plot_proposed_use" class="col-sm-3 control-label">
                                প্লট /জমি এর প্রস্তাবিত ব্যবহার<span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="plot_proposed_use" id="plot_proposed_use"
                                       value="{{ old('plot_proposed_use') ? old
                                ('plot_proposed_use') : $data->plot_proposed_use }}"
                                       class="form-control @error('plot_proposed_use')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="70" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> প্লট /জমি এর প্রস্তাবিত ব্যবহার উল্লেখ করুন
                                    ....</span>

                                @error('plot_proposed_use')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="plot_owner_details" class="col-sm-3 control-label">
                                প্লটের মালিকানার বিবরণ<span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="plot_owner_details" id="plot_owner_details"
                                       value="{{ old('plot_owner_details') ? old
                                ('plot_owner_details') : $data->plot_owner_details }}"
                                       class="form-control @error('plot_owner_details')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="70" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> প্লটের মালিকানার বিবরণ দিন
                                    ....</span>

                                @error('plot_owner_details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="owner_cue" class="col-sm-3 control-label">
                                মালিকানার সূত্র ও তারিখ(ক্রয়/উত্তরাধিকারি/হেবা/দান/লিজ/অন্যান্য) <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="owner_cue" id="owner_cue"
                                       value="{{ old('owner_cue') ? old
                                ('owner_cue') : $data->owner_cue }}"
                                       class="form-control @error('owner_cue')is-invalid @enderror"
                                       placeholder="মালিকানার সূত্র ও তারিখ উল্লেখ করুন "
                                       data-parsley-trigger="keyup" data-parsley-maxlength="70" data-parsley-required/>
                                <span class="bt-flabels__error-desc">মালিকানার সূত্র ও তারিখ উল্লেখ করুন
                                    ....</span>

                                @error('owner_cue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="registration_date" class="col-sm-3 control-label">
                                রেজিস্টেশনের তারিখ ও দলিল নং<span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="registration_date" id="registration_date"
                                       value="{{ old('registration_date') ? old
                                ('registration_date') : $data->registration_date }}"
                                       class="form-control @error('registration_date')is-invalid @enderror"
                                       placeholder="মালিকানার সূত্র ও তারিখ উল্লেখ করুন "
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> রেজিস্টেশনের তারিখ ও দলিল নং দিন
                                    ....</span>

                                @error('registration_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            ভূমির পারিপার্শ্বিক অবস্থার বর্ণনা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="current_land_use" class="col-sm-3 control-label">
                                ভূমির বর্তমান ব্যবহার
                                <span class="text-danger"
                                > *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="current_land_use" id="current_land_use" value="{{ old
                                ('current_land_use') ? old
                                ('current_land_use') : $data->current_land_use }}"
                                       class="form-control @error('current_land_use')is-invalid @enderror"
                                       data-parsley-required placeholder="ভূমির বর্তমান ব্যবহার উল্লেখ করুন"
                                       data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">ভূমির বর্তমান ব্যবহার উল্লেখ করুন....</span>

                                @error('current_land_use')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="radius_land_current_use" class="col-sm-3 control-label">২৫০ মিটার ব্যসার্ধে
                                অন্তর্ভুক্ত
                                ভূমির
                                বর্তমান ব্যবহার <span
                                    class="text-danger"
                                > *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="radius_land_current_use" id="radius_land_current_use"
                                       value="{{ old('radius_land_current_use') ? old
                                ('radius_land_current_use') : $data->radius_land_current_use
                                }}" class="form-control @error('radius_land_current_use')is-invalid @enderror"
                                       data-parsley-maxlength="50" data-parsley-required
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">২৫০ মিটার ব্যসার্ধে অন্তর্ভুক্ত ভূমির বর্তমান
                                    ব্যবহার উল্লেখ করুন..</span>

                                @error('radius_land_current_use')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="ploat_near_road" class="col-sm-3 control-label">প্লটের নিকটতম দুরত্বে অবস্থিত প্রধান সড়কের নাম ও প্রশস্ততা
                                <span class="text-danger"> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="ploat_near_road" id="ploat_near_road"
                                       value="{{ old('ploat_near_road') ? old
                                ('ploat_near_road') : $data->ploat_near_road }}"
                                       class="form-control @error('ploat_near_road')is-invalid @enderror"
                                       data-parsley-trigger="keyup"  data-parsley-maxlength="50"
                                       data-parsley-required/>
                                <span class="bt-flabels__error-desc">প্লটের নিকটতম দুরত্বে অবস্থিত প্রধান সড়কের নাম ও প্রশস্ততা দিন....</span>

                                @error('ploat_near_road')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="join_ploat_road" class="col-sm-3 control-label">প্লটের সংযোগ সড়কের নাম ও
                                প্রশস্ততা
                                <span class="text-danger"> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="join_ploat_road" id="join_ploat_road"
                                       value="{{ old('join_ploat_road') ? old
                                ('join_ploat_road') : $data->join_ploat_road }}"
                                       class="form-control @error('join_ploat_road')is-invalid @enderror"
                                       data-parsley-maxlength="50" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">প্লটের সংযোগ সড়কের নাম ও
                                প্রশস্ততা উল্লেখ করুন....</span>

                                @error('join_ploat_road')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>


                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            প্লটের ২৫০ মিটার দূরত্বের মধ্যে অবস্থান
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="main_road" class="col-sm-3 control-label">প্রধান সড়ক
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="main_road"
                                           id="main_road"
                                           value="হ্যাঁ" {{ ((old('main_road')? old('main_road') :
                                           $data->main_road ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('main_road')is-invalid
@enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="main_road"
                                           id="main_road"
                                           value="না" {{ ((old('main_road')? old('main_road') :
                                           $data->main_road ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('main_road')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>

                                @error('main_road')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="river_port" class="col-sm-3 control-label">
                                নদী বন্দর
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="river_port"
                                           id="river_port"
                                           value="হ্যাঁ" {{ ((old('river_port')? old('river_port') :
                                           $data->river_port ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('river_port')is-invalid
@enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" {{ ((old('river_port')? old('river_port') :
                                           $data->river_port ) == 'না' ) ? 'checked' : '' }} name="river_port" id="river_port"
                                           value="না" class="form-check-input  @error('river_port')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="hat_bazaar" class="col-sm-3 control-label">হাট-বাজার
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="hat_bazaar"
                                           id="hat_bazaar" {{ ((old('hat_bazaar')? old('hat_bazaar') :
                                           $data->hat_bazaar ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('hat_bazaar')is-invalid @enderror"
                                    /><label class="form-check-label" for="hat_bazaar"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="hat_bazaar"
                                           id="hat_bazaar"
                                           value="না" {{ ((old('hat_bazaar')? old('hat_bazaar') :
                                           $data->hat_bazaar ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('hat_bazaar')is-invalid
@enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>

                                @error('hat_bazaar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="airport" class="col-sm-3 control-label">
                                বিমান বন্দর
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="airport"
                                           id="airport"
                                           value="হ্যাঁ" {{ ((old('airport')? old('airport') :
                                           $data->airport ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('airport')is-invalid
@enderror"
                                    /><label class="form-check-label" for="airport"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="airport" id="airport"
                                           value="না" {{ ((old('airport')? old('airport') :
                                           $data->airport ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('airport')is-invalid @enderror"
                                    />  <label class="form-check-label" for="airport"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="railway_station" class="col-sm-3 control-label">রেলওয়ে ষ্টেশন
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="railway_station"
                                           id="railway_station"
                                           value="হ্যাঁ" {{ ((old('railway_station')? old('railway_station') :
                                           $data->railway_station ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('railway_station')
                                        is-invalid @enderror"
                                    /><label class="form-check-label" for="railway_station"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="railway_station"
                                           id="railway_station"
                                           value="না" {{ ((old('railway_station')? old('railway_station') :
                                           $data->railway_station ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('railway_station')is-invalid
@enderror"
                                    />  <label class="form-check-label" for="railway_station"> না </label>
                                </div>

                                @error('railway_station')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            প্লটের ২৫০ মিটার দূরত্বের মধ্যে অবস্থান
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="pond" class="col-sm-3 control-label">পুকুর
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="pond"
                                           id="pond"
                                           value="হ্যাঁ" {{ ((old('pond')? old('pond') :
                                           $data->pond ) == 'হ্যাঁ' ) ? 'checked' : '' }}  class="form-check-input  @error('pond')is-invalid @enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="pond"
                                           id="pond"
                                           value="না" {{ ((old('pond')? old('pond') :
                                           $data->pond ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('pond')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>

                                @error('pond')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="flood_control_reservoirs" class="col-sm-3 control-label">
                                বন্যা নিয়ন্ত্রন জলাধার
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="flood_control_reservoirs"
                                           id="flood_control_reservoirs"
                                           value="হ্যাঁ" {{ ((old('flood_control_reservoirs')? old('flood_control_reservoirs') :
                                           $data->flood_control_reservoirs ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('flood_control_reservoirs')
                                        is-invalid @enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="flood_control_reservoirs" id="flood_control_reservoirs"
                                           value="না" {{ ((old('flood_control_reservoirs')? old('flood_control_reservoirs') :
                                           $data->flood_control_reservoirs ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('flood_control_reservoirs')
                                        is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="wetlands" class="col-sm-3 control-label">জলাভূমি
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="wetlands"
                                           id="wetlands" {{ ((old('wetlands')? old('wetlands') :
                                           $data->wetlands ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('wetlands')is-invalid @enderror"
                                    /><label class="form-check-label" for="wetlands"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="wetlands"
                                           id="wetlands"
                                           value="না" {{ ((old('wetlands')? old('wetlands') :
                                           $data->wetlands ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('wetlands')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>

                                @error('wetlands')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="forest" class="col-sm-3 control-label">
                                বনাঞ্চল
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="forest"
                                           id="forest" {{ ((old('forest')? old('forest') :
                                           $data->forest ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('forest')is-invalid @enderror"
                                    /><label class="form-check-label" for="forest"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="forest" id="forest"
                                           value="না" {{ ((old('forest')? old('forest') :
                                           $data->forest ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('forest')is-invalid @enderror"
                                    />  <label class="form-check-label" for="forest"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="natural_waterways" class="col-sm-3 control-label">প্রাকৃতিক জলপথ
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="natural_waterways"
                                           id="natural_waterways"
                                           value="হ্যাঁ" {{ ((old('natural_waterways')? old('natural_waterways') :
                                           $data->natural_waterways ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('natural_waterways')
                                        is-invalid @enderror"
                                    /><label class="form-check-label" for="natural_waterways"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="natural_waterways"
                                           id="natural_waterways"
                                           value="না" {{ ((old('natural_waterways')? old('natural_waterways') :
                                           $data->natural_waterways ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('natural_waterways')is-invalid
@enderror"
                                    />  <label class="form-check-label" for="natural_waterways"> না </label>
                                </div>

                                @error('natural_waterways')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="park" class="col-sm-3 control-label">পার্ক বা খেলার মাঠ
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="park"
                                           id="park"
                                           value="হ্যাঁ" {{ ((old('park')? old('park') :
                                           $data->park ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('park')is-invalid @enderror"
                                    /><label class="form-check-label" for="park"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="park"
                                           id="park"
                                           value="না" {{ ((old('park')? old('park') :
                                           $data->park ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('park')is-invalid @enderror"
                                    />  <label class="form-check-label" for="park"> না </label>
                                </div>

                                @error('park')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="hill" class="col-sm-3 control-label">পাহাড়
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="hill"
                                           id="hill"
                                           value="হ্যাঁ" {{ ((old('hill')? old('hill') :
                                           $data->hill ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('hill')is-invalid @enderror"
                                    /><label class="form-check-label" for="natural_waterways"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="hill"
                                           id="hill"
                                           value="না" {{ ((old('hill')? old('hill') :
                                           $data->hill ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('hill')is-invalid @enderror"
                                    />  <label class="form-check-label" for="hill"> না </label>
                                </div>

                                @error('hill')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="dal" class="col-sm-3 control-label">ঢাল
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="dal"
                                           id="dal"
                                           value="হ্যাঁ" {{ ((old('dal')? old('dal') :
                                           $data->dal ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('dal')is-invalid @enderror"
                                    /><label class="form-check-label" for="park"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="dal"
                                           id="dal"
                                           value="না" {{ ((old('dal')? old('dal') :
                                           $data->dal ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('dal')is-invalid @enderror"
                                    />  <label class="form-check-label" for="dal"> না </label>
                                </div>

                                @error('dal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            প্লটের ২৫০ মিটার দূরত্বের মধ্যে অবস্থান
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="historical_site" class="col-sm-3 control-label">ঐতিহাসিক গুরুত্বপূর্ন সাইট
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="historical_site"
                                           id="historical_site" {{ ((old('historical_site')? old('historical_site') :
                                           $data->historical_site ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('historical_site')is-invalid @enderror"
                                    /><label class="form-check-label" for="historical_site"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="historical_site"
                                           id="historical_site" {{ ((old('historical_site')? old('historical_site') :
                                           $data->historical_site ) == 'না' ) ? 'checked' : '' }}
                                           value="না" class="form-check-input  @error('historical_site')is-invalid @enderror"
                                    />  <label class="form-check-label" for="historical_site"> না </label>
                                </div>

                                @error('historical_site')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="key_point" class="col-sm-3 control-label">
                                Key Point Installation
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="key_point"
                                           id="key_point" {{ ((old('key_point')? old('key_point') :
                                           $data->historical_site ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('key_point')is-invalid @enderror"
                                    /><label class="form-check-label" for="key_point"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="key_point" id="key_point"
                                           value="না"  {{ ((old('key_point')? old('key_point') :
                                           $data->historical_site ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('key_point')is-invalid @enderror"
                                    />  <label class="form-check-label" for="key_point"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="samorik" class="col-sm-3 control-label">সামরিক স্থাপনা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="samorik"
                                           id="samorik" {{ ((old('samorik')? old('samorik') :
                                           $data->historical_site ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('samorik')is-invalid @enderror"
                                    /><label class="form-check-label" for="samorik"> হ্যাঁ </label>
                                    <input style=" width: 15px " {{ ((old('samorik')? old('samorik') :
                                           $data->historical_site ) == 'না' ) ? 'checked' : '' }} type="radio" name="samorik"
                                           id="samorik"
                                           value="না" class="form-check-input  @error('samorik')is-invalid @enderror"
                                    />  <label class="form-check-label" for="samorik"> না </label>
                                </div>

                                @error('samorik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="special_area" class="col-sm-3 control-label">
                                বিধিমালা অনুযায়ী সীমিত উন্নয়ন এলাকা,বিশেষ এলাকা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="special_area"
                                           id="special_area" {{ ((old('special_area')? old('special_area') :
                                           $data->special_area ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('special_area')is-invalid @enderror"
                                    /><label class="form-check-label" for="special_area"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="special_area" id="special_area"
                                           value="না" {{ ((old('special_area')? old('special_area') :
                                           $data->special_area ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('special_area')is-invalid
@enderror"
                                    />  <label class="form-check-label" for="special_area"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            প্লটের চতুঃপার্শ্বস্থ ভূমির ব্যবহার
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="north" class="col-sm-3 control-label">উত্তর</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="north" id="north" value="{{ old('north') ? old('north') :
                                $data->north
                                }}"
                                       class="form-control @error('north')is-invalid @enderror"  data-parsley-maxlength="50"  data-parsley-trigger="keyup"  />


                                @error('north')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="east" class="col-sm-3 control-label">পূর্ব</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="east" id="east" value="{{ old('east') ? old('east') :
                                $data->east }}"
                                       class="form-control @error('east')is-invalid @enderror" data-parsley-maxlength="50"  data-parsley-trigger="keyup" />

                                @error('east')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="south" class="col-sm-3 control-label">দক্ষিন</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="south" id="south" value="{{ old('south')  ? old('south') :
                                $data->south  }}"
                                       class="form-control @error('south') is-invalid @enderror"  data-parsley-maxlength="50"  data-parsley-trigger="keyup"  />


                                @error('south')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="west" class="col-sm-3 control-label">পশ্চিম</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="west" id="west" value="{{ old('west')  ? old('west') :
                                $data->west }}"
                                       class="form-control @error('west')is-invalid @enderror"
                                       data-parsley-maxlength="50"   data-parsley-trigger="keyup" />

                                @error('west')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>




                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            যোগাযোগের ঠিকানা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile')? old('mobile') : $data->mobile }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Email" class="col-sm-3 control-label">ইমেল </label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="email" id="email" value="{{ old('email')? old('email') : $data->email }}" class="form-control @error('email')is-invalid @enderror" placeholder="example@gmail.com" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 100px;">
                    <div class="offset-6 col-sm-6 button-style">
                        <input type="hidden" name="application_type" id="application_type" value="96">

                        <input type="hidden" value="{{ $data->application_id }}" name="application_id"/>

                        <input type="hidden" value="{{ $data->citizen_id }}" name="citizen_id"/>
                        <input type="hidden" value="{{ $data->land_id }}" name="land_id"/>

                        <input type="hidden" value="{{ $data->pin }}" name="pin"/>

                        <button type="submit" id="submit_button" class="btn btn-primary">আপডেট করুন</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#cropzee-input").cropzee({
                startSize: [200, 200, 'px'],
                allowedInputs: ['png', 'jpg', 'jpeg'],
                imageExtension: 'image/jpg',
                minSize: [200, 200, 'px'],
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });

        });
    </script>
@endsection





