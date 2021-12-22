@extends('layouts.app')
@section('head')
    <!-- cropzee.js -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')

    <section>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title text-center">
                        <h4 class="text-center application_head"> সদস্য যোগ করুন</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('association_member_update') }}" method="post"
                  enctype="multipart/form-data"
                  class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 control-label"> নাম <span class="text-danger">
                                    *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name" id="name" value="{{ old('name') ?  old('name') :
                                $member->name }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       autocomplete="name" autofocus placeholder=" Full Name" data-parsley-required
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="father_name" class="col-sm-3 control-label">পিতার নাম <span
                                    class="text-danger"> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name" id="father_name"
                                       value="{{ old('father_name') ?  old('father_name') : $member->father_name  }}"
                                       class="form-control @error('father_name') is-invalid @enderror"
                                       autocomplete="father_name" autofocus
                                       data-parsley-trigger="keyup" data-parsley-required placeholder="Father's Name"/>
                                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="nid" id="nid"
                                       value="{{ old('nid') ?  old('nid') : $member->nid }}"
                                       class="form-control @error('nid') is-invalid @enderror"
                                       data-parsley-maxlength="17" autocomplete="nid" autofocus
                                       data-parsley-type="number" data-parsley-trigger="keyup"
                                       placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_id"
                                       value="{{ old('birth_id') ?  old('birth_id') : $member->birth_id }}"
                                       id="birth_id"
                                       class="form-control @error('birth_id') is-invalid @enderror"
                                       autocomplete="birth_id" autofocus data-parsley-maxlength="17"
                                       data-parsley-type="number" data-parsley-trigger="keyup"
                                       placeholder="1919623458679011"/>
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
                                <input type="text" name="passport_no"
                                       value="{{ old('passport_no')  ?  old('passport_no') : $member->passport_no }}"
                                       id="passport_no"
                                       class="form-control @error('passport_no') is-invalid @enderror"
                                       autocomplete="passport_no" autofocus data-parsley-type="text"
                                       data-parsley-maxlength="17" data-parsley-trigger="keyup"
                                       placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date"
                                       value="{{ old('birth_date') ?  old('birth_date') : $member->birth_date }}"
                                       id="birth_date"
                                       class="form-control date @error('birth_date') is-invalid @enderror"
                                       autocomplete="birth_date" autofocus data-parsley-type="date"
                                       data-parsley-trigger="keyup" data-parsley-required placeholder="yyyy-mm-dd"/>

                                <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>

                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="mother_name" class="col-sm-3 control-label">মাতার নাম <span
                                    class="text-danger"> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name" id="mother_name"
                                       value="{{ old('mother_name') ?  old('mother_name') : $member->mother_name }}"
                                       data-parsley-trigger="keyup"
                                       class="form-control @error('mother_name') is-invalid @enderror"
                                       autocomplete="mother_name_en" autofocus placeholder="Mother's Name"
                                       data-parsley-required/>
                                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                @error('mother_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="profession" class="col-sm-3 control-label">পেশা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="occupation" id="occupation"
                                       value="{{ old('occupation') ?  old('occupation') : $member->occupation }}"
                                       class="form-control @error('occupation') is-invalid @enderror"
                                       autocomplete="occupation" autofocus data-parsley-maxlength="120"
                                       data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                                <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 5px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Education-qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="educational_qualification" id="educational_qualification"
                                       value="{{ old('educational_qualification') ?  old('educational_qualification') : $member->educational_qualification }}"
                                       class="form-control @error('educational_qualification')is-invalid @enderror"
                                       autofocus autocomplete="educational_qualification" data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন"/>
                                <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('educational_qualification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label class="col-sm-3 control-label">ধর্ম <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="religion" id="religion" selected="selected"
                                        class="form-control @error('religion')is-invalid @enderror"
                                        data-parsley-required>
                                    <option value='' {{ (old('religion')  ?  old('religion') : $member->religion == '') ? 'selected="selected"' : ''
                                    }}>চিহ্নিত
                                        করুন
                                    </option>
                                    <option
                                        value='1' {{ (old('religion') ?  old('religion') : $member->religion == 1) ? 'selected="selected"' : '' }}>
                                        ইসলাম
                                    </option>
                                    <option
                                        value='2' {{ (old('religion') ?  old('religion') : $member->religion == 2) ? 'selected="selected"' : '' }}>
                                        হিন্দু
                                    </option>
                                    <option
                                        value='3' {{ (old('religion') ?  old('religion') : $member->religion == 3) ? 'selected="selected"' : '' }}>
                                        বৌদ্ধ
                                        ধর্ম
                                    </option>
                                    <option
                                        value='4' {{ (old('religion') ?  old('religion') : $member->religion == 4) ? 'selected="selected"' : '' }}>
                                        খ্রিস্ট
                                        ধর্ম
                                    </option>
                                    <option
                                        value='5' {{ (old('religion') ?  old('religion') : $member->religion == 5) ? 'selected="selected"' : '' }}>
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
                        </div>
                    </div>

                    <div class="col-md-12" id="genderErr">

                        <div class="row form-group">
                            <label class="col-sm-3 control-label">লিঙ্গ <span class="text-danger">*</span></label>
                            <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                <label class="radio-inline gender"><input type="radio" id="gender_1"
                                                                          {{ (old('gender') ?  old('gender') : $member->gender == 1) ? 'checked' : ''
                                                                          }} name="gender"
                                                                          value="1"/>পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_2"
                                                                          {{ (old('gender') ?  old('gender') : $member->gender == 2) ? 'checked' : ''
                                                                          }} name="gender"
                                                                          value="2"/>মহিলা</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_3"
                                                                          {{ (old('gender') ?  old('gender') : $member->gender == 3) ? 'checked' : ''
                                                                          }} name="gender"
                                                                          value="3"/>অন্যান্য</label>

                                @error('gender')
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
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_en" id="present_village_en"
                                       value="{{ old('present_village_en') ?  old('present_village_en') : $member->present_village_en }}"
                                       class="form-control @error('present_village_en')is-invalid @enderror"
                                       autocomplete="present_village_en" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('present_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-english"
                                   class="col-sm-3 control-label">রোড/ব্লক/সেক্টর</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_rbs_en" id="present_rbs_en"
                                       value="{{ old('present_rbs_en')  ?  old('present_rbs_en') : $member->present_rbs_en }}"
                                       class="form-control @error('present_rbs_en')is-invalid @enderror" placeholder=""
                                       autocomplete="present_rbs_en" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('present_rbs_en')
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
                                <input type="text" name="present_holding_no" id="present_holding_no"
                                       value="{{ old('present_holding_no') ?  old('present_holding_no') : $member->present_holding_no }}"
                                       class="form-control"
                                       autocomplete="present_holding_no"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no"
                                       value="{{ old('present_ward_no') ?  old('present_ward_no') : $member->present_ward_no }}"
                                       class="form-control @error('present_ward_no')is-invalid @enderror"
                                       autocomplete="present_ward_no" autofocus data-parsley-type="number"
                                       data-parsley-trigger="keyup" data-parsley-required/>
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
                            <label for="present_district_id" class="col-sm-3 control-label">জেলা <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )"
                                    class="custom-select2 form-control @error('present_district_id')is-invalid @enderror"
                                    id="present_district_id" name="present_district_id"
                                    style="width: 100%; height: 38px;" data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    <option value="{{ $member->present_district_id }}"
                                            selected="selected">{{ $member->present_district_name }}</option>
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
                                <input type="text" disabled id="present_district"
                                       value="{{ $member->present_district_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    onchange="getLocation($(this).val(), 'present_upazila', 'present_post_office_append', 'present_postoffice_id', 'present_postoffice', 6 )"
                                    name="present_upazila_id" id="present_upazila_id"
                                    class="form-control @error('present_upazila_id')is-invalid @enderror"
                                    data-parsley-required>
                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $member->present_upazila_id }}"
                                            selected="selected">{{ $member->present_upozila_name }}</option>
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
                                <input type="text" disabled id="present_upazila"
                                       value="{{ $member->present_upozila_name_bn }}"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')"
                                        name="present_postoffice_id" id="present_postoffice_id"
                                        class="form-control @error('present_postoffice_id')is-invalid @enderror"
                                        data-parsley-required>
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $member->present_postoffice_id }}"
                                            selected="selected">{{ $member->persent_postoffice_name }}</option>
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
                                <input type="text" disabled id="present_postoffice"
                                       value="{{ $member->persent_postoffice_name_bn }}"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            স্থায়ী ঠিকানা
                        </h4>
                        <p style="font-size:15px; font-weight:normal;padding-top:10px;" id="addressCheck"><input
                                type="checkbox" name="permanentBtn"
                                id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_en" id="permanent_village_en"
                                       value="{{ old('permanent_village_en') ?  old('permanent_village_en') : $member->permanent_village_en }}"
                                       class="form-control @error('permanent_village_en')is-invalid @enderror"
                                       autocomplete="permanent_village_en" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('permanent_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-english"
                                   class="col-sm-3 control-label">রোড/ব্লক/সেক্টর</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_rbs_en" id="permanent_rbs_en"
                                       value="{{ old('permanent_rbs_en')  ?  old('permanent_rbs_en') : $member->permanent_rbs_en }}"
                                       class="form-control @error('permanent_rbs_en')is-invalid @enderror"
                                       placeholder="" autocomplete="permanent_rbs_en" autofocus
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('permanent_rbs_en')
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no"
                                       value="{{ old('permanent_holding_no') ?  trim(old('permanent_holding_no')) : trim($member->permanent_holding_no)
                                        }}"
                                       class="form-control" data-parsley-type="number"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no"
                                       value="{{ old('permanent_ward_no')  ?  old('permanent_ward_no') : $member->permanent_ward_no }}"
                                       class="form-control @error('permanent_ward_no')is-invalid @enderror"
                                       autocomplete="permanent_ward_no" autofocus data-parsley-type="number"
                                       data-parsley-trigger="keyup" data-parsley-required/>
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
                            <label for="permanent_district_id" class="col-sm-3 control-label">জেলা <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )"
                                    name="permanent_district_id" id="permanent_district_id"
                                    class="custom-select2 form-control @error('permanent_district_id')is-invalid @enderror"
                                    style="width: 100%; height: 38px;" data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    <option value="{{ $member->permanent_district_id }}"
                                            selected="selected">{{ $member->permanent_district_name }}</option>
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
                                <input type="text" disabled id="permanent_district" value="{{
                                $member->permanent_district_name }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )"
                                    name="permanent_upazila_id" id="permanent_upazila_id"
                                    class="form-control @error('permanent_upazila_id')is-invalid @enderror"
                                    data-parsley-required>
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $member->permanent_upazila_id }}"
                                            selected="selected">{{ $member->permanent_upozila_name }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('permanent_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="permanent_upazila" class="col-sm-3 control-label">উপজেলা/থানা </label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_upazila"
                                       value="{{ $member->permanent_upozila_name_bn }}"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                    class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')"
                                        name="permanent_postoffice_id" id="permanent_postoffice_id"
                                        class="form-control @error('permanent_postoffice_id')is-invalid @enderror"
                                        data-parsley-required>
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $member->permanent_postoffice_id }}"
                                            selected="selected">{{ $member->permanent_postoffice_name }}</option>
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
                                <input type="text" disabled id="permanent_postoffice" value="{{
                                $member->permanent_postoffice_name_bn }}"
                                       class="form-control" placeholder=""/>
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
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span class="text-danger">*<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') ? old('mobile')
                                : $member->mobile
                                  }}"
                                       class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile"
                                       autofocus data-parsley-type="digits" data-parsley-minlength="11"
                                       data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required
                                       placeholder="ইংরেজিতে প্রদান করুন"/>
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Email" class="col-sm-3 control-label">ইমেল </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="email" id="email" value="{{ old('email')  ? old('email')
                                : $member->email}}"
                                       class="form-control @error('email')is-invalid @enderror"
                                       placeholder="example@gmail.com" autocomplete="email" autofocus
                                       data-parsley-type="email" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="chanda_amount" class="col-sm-3 control-label">মাসিক চাঁদা<span
                                    class="text-danger"> *<span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="chanda_amount" id="chanda_amount" value="{{ old
                                ('chanda_amount') ? old('chanda_amount')
                                : $member->chanda_amount }}" class="form-control @error('chanda_amount')is-invalid
@enderror" autocomplete="mobile" autofocus data-parsley-type="integer"
                                       data-parsley-maxlength="10" data-parsley-trigger="keyup" data-parsley-required
                                       placeholder="0.00"/>
                                <span class="bt-flabels__error-desc">মাসিক চাঁদার সংখ্যা অংকে প্রদান করুন....</span>

                                @error('chanda_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="reference_id" class="col-sm-3 control-label">রেফারেন্স </label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <select name="reference_id" id="reference_id"
                                        class="form-control @error('reference_id')is-invalid @enderror">
                                    <option value="" id="permanent_upazila_append">সিলেক্ট করুন</option>
                                    @foreach($reference as  $item)
                                        <option value="{{ $item->id  }}" {{ ($item->id == $member->reference_id) ?
                                        'selected': ''  }}
                                        id="">{{
                                        $item->name  }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="photo" class="col-sm-3 control-label">ছবি </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="file" class="form-control" name="photo" id="photo">
                                @if($member->photo != null)
                                    <img src="{{ asset('images/association_member/'.$member->photo)  }}"

                                         class="image_preview mt-2" height="50" width="70"/>
                                    <input type="hidden" name="image_preview" id="image_preview"
                                           value="{{ $member->photo  }}">
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 100px;">
                    <div class="offset-6 col-sm-6 button-style">
                        <input type="hidden" name="row_id" value="{{ $member->id }}">
                        <input type="hidden" name="account_id" value="{{ $member->account_id }}">
                        <input type="hidden" name="union_id" value="{{ Auth::user()->union_id }}" id="union-id">
                        <button type="submit" class="btn btn-primary">দাখিল করুন</button>
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

    {{-- preselect addredd blade include --}}
    @include('layouts.preselect_address')


    <script>
        $(document).ready(function () {
            $("#cropzee-input").cropzee({
                startSize: [100, 100, '%'],
                allowedInputs: ['png', 'jpg', 'jpeg'],
                imageExtension: 'image/jpg',
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });
        });
    </script>
@endsection



