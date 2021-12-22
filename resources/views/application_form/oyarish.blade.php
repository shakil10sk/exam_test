@extends('layouts.master')
@section('head')
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <section>
        <div style="padding:30px;" class="container">
            <div class="row">
                <div style="background-color: #00B181;border-radius: 5px;" class="bg-primary col-md-12 text-center"
                     style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                    <h4 style="color: white;">ওয়ারিশ সনদের আবেদন</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div style="margin-top: -60px;" class="container">
            <form id="form-data" data-route="{{ $path.'/api/application/warish' }}" method="post"
                  enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate
                  data-parsley-errors-messages-disabled>
                @csrf
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-8 col-md-offset-2">
                        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4>
                        <hr/>
                        <ul>
                            <li>বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন ।</li>
                            <li>ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন ।</li>
                            <li>আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে আপনার
                                মোবাইল অথবা ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা
                                পিন নং দিয়ে সার্চ করুন!
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-offset-2">
                        <div class="input-group">
                            <input type="search" id="search-data" class="form-control"
                                   placeholder="ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা পিন নং দিন ইংরেজিতে">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-btn">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    <span class="ion-ios-search" aria-hidden="true"></span> Search
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Name-english" class="col-sm-3 control-label"> নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="name_en_status">
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                                       class="form-control" placeholder="Full Name" autocomplete="name_en" autofocus
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                <span id="name_en_feedback" class="help-block"></span>
                            </div>
                            <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="name_bn_status">
                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}"
                                       class="form-control" placeholder="পূর্ণ নাম" autocomplete="name_bn" autofocus
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                <span id="name_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center" id="national_id_error">

                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি
                                (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="nid_status">
                                <input type="text" name="nid" id="nid" value="{{ old('nid') }}" class="form-control"
                                       autocomplete="nid" autofocus data-parsley-maxlength="17"
                                       data-parsley-type="number" data-parsley-trigger="keyup"
                                       placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                <span id="nid_feedback" class="help-block"></span>
                            </div>
                            <label for="Birth-no" class="col-sm-3 control-label">মৃত্যু নিবন্ধন নং (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="birth_id_status">
                                <input type="text" name="birth_id" id="birth_id" value="{{ old('birth_id') }}"
                                       class="form-control" autocomplete="birth_id" autofocus
                                       data-parsley-maxlength="17" data-parsley-type="number"
                                       data-parsley-trigger="keyup" placeholder="1919623458679011"/>
                                <span class="bt-flabels__error-desc">মৃত্যু নিবন্ধন নং দিন ইংরেজিতে....</span>

                                <span id="birth_id_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">

                            <label for="Passport-no" class="col-sm-3 control-label">পাসপোর্ট নং (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="passport_no_status">
                                <input type="text" name="passport_no" id="passport_no" value="{{ old('passport_no') }}"
                                       class="form-control" autocomplete="passport_no" autofocus
                                       data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup"
                                       placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                <span id="passport_no_feedback" class="help-block"></span>
                            </div>
                            <label for="birth_date" class="col-sm-3 control-label">জম্ম তারিখ</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="birth_date_status">
                                <input type="text" name="birth_date" value="{{ old('birth_date') }}" id="birth_date"
                                       class="form-control datepicker" data-date-format="yyyy-mm-dd" readonly
                                       placeholder="yyyy-mm-dd" autocomplete="birth_date" autofocus
                                       data-parsley-type="date"/>
                                <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>

                                <span id="birth_date_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Passport-no" class="col-sm-3 control-label"></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="passport_no_status">
                            </div>
                            <label for="death_date" class="col-sm-3 control-label">মৃত্যু তারিখ <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="birth_date_status">
                                <input type="text" name="death_date" value="{{ old('death_date') }}" id="death_date"
                                       class="form-control" data-date-format="yyyy-mm-dd" readonly
                                       placeholder="yyyy-mm-dd" autocomplete="death_date" autofocus
                                       data-parsley-type="date"/>
                                <span class="bt-flabels__error-desc">মৃত্যু তারিখ দিন....</span>

                                <span id="death_date_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="father_name_en_status">
                                <input type="text" name="father_name_en" id="father_name_en"
                                       value="{{ old('father_name_en') }}" class="form-control"
                                       autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$'
                                       data-parsley-trigger="keyup" placeholder="Father's Name"/>
                                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                <span id="father_name_en_feedback" class="help-block"></span>
                            </div>
                            <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="father_name_bn_status">
                                <input type="text" name="father_name_bn" id="father_name_bn"
                                       value="{{ old('father_name_bn') }}" class="form-control"
                                       autocomplete="father_name_bn" autofocus placeholder="পিতার নাম"
                                       data-parsley-required/>
                                <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                <span id="father_name_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="mother_name_en_status">
                                <input type="text" name="mother_name_en" id="mother_name_en"
                                       value="{{ old('mother_name_en') }}" autocomplete="mother_name_en" autofocus
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                       class="form-control" placeholder="Mother's Name"/>
                                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                <span id="mother_name_en_feedback" class="help-block"></span>
                            </div>
                            <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="mother_name_bn_status">
                                <input type="text" name="mother_name_bn" id="mother_name_bn"
                                       value="{{ old('mother_name_bn') }}" class="form-control"
                                       autocomplete="mother_name_bn" autofocus placeholder="মাতার নাম"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                                <span id="mother_name_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="profession" class="col-sm-3 control-label">পেশা</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="occupation_status">
                                <input type="text" name="occupation" id="occupation" value="{{ old('occupation') }}"
                                       class="form-control" autocomplete="occupation" autofocus
                                       data-parsley-maxlength="120" data-parsley-trigger="keyup"
                                       placeholder="পেশা দিন"/>
                                <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                <span id="occupation_feedback" class="help-block"></span>
                            </div>

                            <label for="Resident" class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="resident_status">
                                <select name="resident" id='resident' class="form-control" selected="selected"
                                        data-parsley-required>
                                    <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত
                                        করুন
                                    </option>
                                    <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>
                                        অস্থায়ী
                                    </option>
                                    <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>স্থায়ী
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                <span id="resident_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Education-qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="educational_qualification_status">
                                <input type="text" name="educational_qualification" id="educational_qualification"
                                       value="{{ old('educational_qualification') }}" class="form-control"
                                       autocomplete="educational_qualification" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন"/>
                                <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                                <span id="educational_qualification_feedback" class="help-block"></span>
                            </div>

                            <label for="Religion" class="col-sm-3 control-label">ধর্ম <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="religion_status">
                                <select name="religion" id="religion" selected="selected" class="form-control"
                                        data-parsley-required>
                                    <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত
                                        করুন
                                    </option>
                                    <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>ইসলাম
                                    </option>
                                    <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>হিন্দু
                                    </option>
                                    <option value='3' {{ (old('resident') == 3) ? 'selected="selected"' : '' }}>বৌদ্ধ
                                        ধর্ম
                                    </option>
                                    <option value='4' {{ (old('resident') == 4) ? 'selected="selected"' : '' }}>খ্রিস্ট
                                        ধর্ম
                                    </option>
                                    <option value='5' {{ (old('resident') == 5) ? 'selected="selected"' : '' }}>
                                        অন্যান্য
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                <span id="religion_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="father-alive" class="col-sm-3 control-label">পিতা জীবিত কিনা</label>
                            <div
                                class="col-sm-3 bt-flabels__wrapper @error('is_father_alive')has-error has-feedback @enderror @error('father_age')has-error has-feedback @enderror"
                                id="fatheragenull">
                                <label class="radio-inline flive"><input type="radio" name="is_father_alive"
                                                                         value="1" {{ (old('father_alive') == 1) ? 'checked' : '' }}>হ্যাঁ
                                </label>
                                <label class="radio-inline flive"><input type="radio" name="is_father_alive"
                                                                         value="0" {{ (old('father_alive') == 0) ? 'checked' : '' }}>না</label>
                                <input type="text" name="father_age" id="father_age" class="form-control"
                                       value="{{ old('father_age') }}"
                                       {{ (old('father_alive') == 1)? 'style=display:block;' : 'style=display:none;' }} placeholder="পিতার বয়স"
                                       data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে পিতার বয়স দিন....</span>

                                <span id="is_father_alive_feedback" class="help-block"></span>

                                <span id="father_age_feedback" class="help-block"></span>
                            </div>
                            <label for="mother-alive" class="col-sm-3 control-label">মাতা জীবিত কিনা</label>
                            <div
                                class="col-sm-3 bt-flabels__wrapper @error('mother_alive')has-error has-feedback @enderror @error('mother_age')has-error has-feedback @enderror"
                                id="motheragenull">
                                <label class="radio-inline mlive"><input type="radio" name="is_mother_alive"
                                                                         value="1" {{ (old('mother_alive') == 1) ? 'checked' : '' }}>হ্যাঁ
                                </label>
                                <label class="radio-inline mlive"><input type="radio" name="is_mother_alive"
                                                                         value="0" {{ (old('mother_alive') == 0) ? 'checked' : '' }}>না</label>
                                <input type="text" name="mother_age" id="mother_age" class="form-control"
                                       placeholder="মাতার বয়স" value="{{ old('mother_age') }}"
                                       {{ (old('mother_alive') == 1)? 'style=display:block;' : 'style=display:none;' }} data-parsley-type="number"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে মাতার বয়স দিন....</span>

                                <span id="is_mother_alive_feedback" class="help-block"></span>

                                <span id="mother_alive_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="genderErr">

                        <div class="row form-group">
                            <label for="Gender" class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                            <div class="col-sm-3" id="gender_status">
                                <label class="radio-inline gender"><input type="radio" id="gender_1" name="gender"
                                                                          value="1" {{ (old('gender') == 1) ? 'checked' : '' }} />পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_2" name="gender"
                                                                          value="2" {{ (old('gender') == 2) ? 'checked' : '' }} />মহিলা</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_3" name="gender"
                                                                          value="3" {{ (old('gender') == 3) ? 'checked' : '' }} />অন্যান্য</label>

                                <span id="gender_feedback" class="help-block"></span>
                            </div>
                            <label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="marital_status_status">
                                <select name="marital_status" id="marital_status" class="form-control"
                                        selected="selected" data-parsley-required>
                                    <option value="" {{ (old('marital_status') == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>
                                    <option value='1' {{ (old('marital_status') == 1) ? 'selected="selected"' : '' }}>
                                        অবিবাহিত
                                    </option>
                                    <option value='2' {{ (old('marital_status') == 2) ? 'selected="selected"' : '' }}>
                                        বিবাহিত
                                    </option>
                                    <option value='3' {{ (old('marital_status') == 3) ? 'selected="selected"' : '' }}>
                                        তালাক প্রাপ্ত
                                    </option>
                                    <option value='4' {{ (old('marital_status') == 4) ? 'selected="selected"' : '' }}>
                                        বিধবা
                                    </option>
                                    <option value='5' {{ (old('marital_status') == 5) ? 'selected="selected"' : '' }}>
                                        অন্যান্য
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                <span id="marital_status_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="wife" style="display: none;">
                        <div class="row form-group">
                            <label for="wife_name_en" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="wife_name_en_status">
                                <input type="text" name="wife_name_en" id="wife_name_en" class="form-control"
                                       data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"
                                       placeholder="Name of Wife"/>
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                <span id="wife_name_en_feedback" class="help-block"></span>
                            </div>

                            <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="wife_name_bn_status">
                                <input type="text" name="wife_name_bn" id="wife_name_bn" class="form-control"
                                       placeholder="স্ত্রীর নাম"/>
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                                <span id="wife_name_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="husband" style="display: none;">
                        <div class="row form-group">
                            <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="husband_name_en_status">
                                <input type="text" name="husband_name_en" id="husband_name_en" class="form-control"
                                       data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"
                                       placeholder="Name of Husband"/>
                                <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                <span id="husband_name_en_feedback" class="help-block"></span>
                            </div>

                            <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="husband_name_bn_status">
                                <input type="text" name="husband_name_bn" id="husband_name_bn" class="form-control"
                                       placeholder="স্বামী নাম"/>
                                <span class="bt-flabels__error-desc">স্বামী নাম দিন বাংলায়....</span>

                                <span id="husband_name_bn_feedback" class="help-block"></span>
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
                            <label for="present_village_en" class="col-sm-3 control-label">গ্রাম/মহল্লা
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_village_en_status">
                                <input type="text" name="present_village_en" id="present_village_en"
                                       value="{{ old('present_village_en') }}" class="form-control"
                                       autocomplete="present_village_en" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                <span id="present_village_en_feedback" class="help-block"></span>
                            </div>

                            <label for="present_village_bn" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_village_bn_status">
                                <input type="text" name="present_village_bn" id="present_village_bn"
                                       value="{{ old('present_village_bn') }}" class="form-control" placeholder=""
                                       autocomplete="present_village_bn" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                <span id="present_village_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_rbs_en" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_rbs_en_status">
                                <input type="text" name="present_rbs_en" id="present_rbs_en"
                                       value="{{ old('present_rbs_en') }}" class="form-control" placeholder=""
                                       autocomplete="present_rbs_en" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                <span id="present_rbs_en_feedback" class="help-block"></span>
                            </div>

                            <label for="present_rbs_bn" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_rbs_bn_status">
                                <input type="text" name="present_rbs_bn" id="present_rbs_bn"
                                       value="{{ old('present_rbs_bn') }}" class="form-control" placeholder=""
                                       autocomplete="present_rbs_bn" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                <span id="present_rbs_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_holding_no_status">
                                <input type="text" name="present_holding_no" id="present_holding_no"
                                       value="{{ old('present_holding_no') }}" class="form-control"
                                       autocomplete="present_holding_no" autofocus
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                <span id="present_holding_no_feedback" class="help-block"></span>
                            </div>

                            <label for="present_ward_no" class="col-sm-3 control-label">ওয়ার্ড নং <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_ward_no_status">
                                <input type="text" name="present_ward_no" id="present_ward_no"
                                       value="{{ old('present_ward_no') }}" class="form-control"
                                       autocomplete="present_ward_no" autofocus data-parsley-type="number"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                <span id="present_ward_no_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_district_id" class="col-sm-3 control-label">জেলা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_district_id_status">
                                <select
                                    onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )"
                                    name="present_district_id" id="present_district_id" class="form-control"
                                    data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    @foreach ($district as $item)
                                        <option value="{{$item->id}}">{{$item->en_name}}</option>
                                    @endforeach
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                <span id="present_district_id_feedback" class="help-block"></span>
                            </div>

                            <label for="present_district" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="present_district" value="জেলা" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_upazila_id_status">
                                <select
                                    onchange="getLocation($(this).val(), 'present_upazila', 'present_post_office_append', 'present_postoffice_id', 'present_postoffice', 6 )"
                                    name="present_upazila_id" id="present_upazila_id" class="form-control"
                                    data-parsley-required>
                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                <span id="present_upazila_id_feedback" class="help-block"></span>
                            </div>

                            <label for="present_upazila" class="col-sm-3 control-label">উপজেলা/থানা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="present_upazila" value="উপজেলা/থানা"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="present_postoffice_id_status">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')"
                                        name="present_postoffice_id" id="present_postoffice_id" class="form-control"
                                        data-parsley-required>
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                <span id="present_postoffice_id_feedback" class="help-block"></span>
                            </div>

                            <label for="present_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="present_postoffice" value="পোষ্ট অফিস"
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
                        <p style="font-size:15px; text-align:center; font-weight:normal;padding-top:10px;" id="addressCheck"><input
                                type="checkbox" name="permanentBtn"
                                id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_village_en" class="col-sm-3 control-label">গ্রাম/মহল্লা
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_village_en_status">
                                <input type="text" name="permanent_village_en" id="permanent_village_en"
                                       value="{{ old('permanent_village_en') }}" class="form-control"
                                       autocomplete="permanent_village_en" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                <span id="permanent_village_en_feedback" class="help-block"></span>
                            </div>

                            <label for="permanent_village_bn" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_village_bn_status">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn"
                                       value="{{ old('permanent_village_bn') }}" class="form-control"
                                       autocomplete="permanent_village_bn" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                <span id="permanent_village_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_rbs_en" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_rbs_en_status">
                                <input type="text" name="permanent_rbs_en" id="permanent_rbs_en"
                                       value="{{ old('permanent_rbs_en') }}" class="form-control" placeholder=""
                                       autocomplete="permanent_rbs_en" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                <span id="permanent_rbs_en_feedback" class="help-block"></span>
                            </div>

                            <label for="permanent_rbs_bn" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_rbs_bn_status">
                                <input type="text" name="permanent_rbs_bn" id="permanent_rbs_bn"
                                       value="{{ old('permanent_rbs_bn') }}" class="form-control" placeholder=""
                                       autocomplete="permanent_rbs_bn" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                <span id="permanent_rbs_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_holding_no_status">
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no"
                                       value="{{ old('permanent_holding_no') }}" class="form-control"
                                       autocomplete="permanent_holding_no" autofocus
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                <span id="permanent_holding_no_feedback" class="help-block"></span>
                            </div>
                            <label for="permanent_ward_no" class="col-sm-3 control-label">ওয়ার্ড নং <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_ward_no_status">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no"
                                       value="{{ old('permanent_ward_no') }}" class="form-control"
                                       autocomplete="permanent_ward_no" autofocus data-parsley-type="number"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                <span id="permanent_ward_no_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_district_id" class="col-sm-3 control-label">জেলা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_district_id_status">
                                <select
                                    onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )"
                                    name="permanent_district_id" id="permanent_district_id" class="form-control"
                                    data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    @foreach ($district as $item)
                                        <option value="{{$item->id}}">{{$item->en_name}}</option>
                                    @endforeach
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                <span id="permanent_district_id_feedback" class="help-block"></span>
                            </div>

                            <label for="permanent_district" class="col-sm-3 control-label">জেলা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_district" value="জেলা" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_upazila_id_status">
                                <select
                                    onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )"
                                    name="permanent_upazila_id" id="permanent_upazila_id" class="form-control"
                                    data-parsley-required>
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                <span id="permanent_upazila_id_feedback" class="help-block"></span>
                            </div>

                            <label for="permanent_upazila" class="col-sm-3 control-label">উপজেলা/থানা <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_upazila" value="উপজেলা/থানা"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_postoffice_id_status">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')"
                                        name="permanent_postoffice_id" id="permanent_postoffice_id" class="form-control"
                                        data-parsley-required>
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                <span id="permanent_postoffice_id_feedback" class="help-block"></span>
                            </div>

                            <label for="permanent_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_postoffice" value="পোষ্ট অফিস"
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
                            <label for="applicant_mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="applicant_mobile_status">
                                <input type="text" name="applicant_mobile" value="{{ old('applicant_mobile') }}"
                                       class="form-control" autocomplete="mobile" autofocus data-parsley-type="digits"
                                       data-parsley-minlength="11" data-parsley-maxlength="11"
                                       data-parsley-trigger="keyup" data-parsley-required
                                       placeholder="ইংরেজিতে প্রদান করুন"/>
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                <span id="applicant_mobile_feedback" class="help-block"></span>
                            </div>
                            <label for="applicant_email" class="col-sm-3 control-label">ইমেল </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="applicant_email_status">
                                <input type="text" name="applicant_email" value="{{ old('applicant_email') }}"
                                       class="form-control" autocomplete="email" autofocus
                                       placeholder="example@gmail.com" data-parsley-type="email"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                <span id="applicant_email_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="English Applicant Name" class="col-sm-3 control-label small-font">আবেদনকারীর নাম
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="applicant_name_en_status">
                                <input type="text" name="applicant_name_en" id="applicant_name_en"
                                       value="{{ old('applicant_name_en') }}" class="form-control"
                                       autocomplete="applicant_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$'
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">আবেদনকারীর নাম দিন ইংরেজিতে....</span>

                                <span id="applicant_name_en_feedback" class="help-block"></span>
                            </div>
                            <label for="Bangla Applicant Name" class="col-sm-3 control-label small-font">আবেদনকারীর নাম
                                (বাংলায়) <sup>*</sup></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="applicant_name_bn_status">
                                <input type="text" name="applicant_name_bn" id="applicant_name_bn"
                                       value="{{ old('applicant_name_bn') }}" class="form-control"
                                       autocomplete="applicant_name_bn" autofocus data-parsley-required/>
                                <span class="bt-flabels__error-desc">আবেদনকারীর নাম দিন বাংলায়....</span>

                                <span id="applicant_name_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="English Applicant Father Name" class="col-sm-3 control-label small-font">
                                আবেদনকারীর পিতা/স্বামীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="applicant_father_name_en_status">
                                <input type="text" name="applicant_father_name_en" id="applicant_father_name_en"
                                       value="{{ old('applicant_father_name_en') }}" class="form-control"
                                       autocomplete="applicant_father_name_en" autofocus
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">আবেদনকারীর পিতা/স্বামীর নাম দিন ইংরেজিতে....</span>

                                <span id="applicant_father_name_en_feedback" class="help-block"></span>
                            </div>
                            <label for="Bangla Applicant Father Name" class="col-sm-3 control-label small-font">আবেদনকারীর
                                পিতা/স্বামীর নাম (বাংলায়)<sup>*</sup></label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="applicant_father_name_bn_status">
                                <input type="text" name="applicant_father_name_bn" id="applicant_father_name_bn"
                                       value="{{ old('applicant_father_name_bn') }}" class="form-control"
                                       autocomplete="applicant_father_name_bn" autofocus data-parsley-required/>
                                <span class="bt-flabels__error-desc">আবেদনকারীর পিতা/স্বামীর নাম দিন বাংলায়....</span>

                                <span id="applicant_father_name_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            ওয়ারিশগনের তালিকা
                        </h4>
                    </div>
                </div>

                {{-- <div class="col-md-12">
                        <div class="row form-group">
                            <label for="dead_warish_after_dead_father" class="col-sm-3 control-label">পিতার মৃত্যুর আগের মৃত ওয়ারিশ</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="dead_warish_after_dead_father" id="dead_warish_after_dead_father" value="{{ old('dead_warish_after_dead_father') }}" class="form-control @error('dead_warish_after_dead_father')is-invalid @enderror" autocomplete="dead_warish_after_dead_father" autofocus data-parsley-trigger="keyup" placeholder="পিতার মৃত্যুর আগের মৃত ওয়ারিশ" />
                                <span class="bt-flabels__error-desc">পিতার মৃত্যুর আগের মৃত ওয়ারিশগনের নাম দিন....</span>

                                <span id="educational_qualification_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div> --}}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label> নাম (বাংলায়) <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-2">
                                <label> নাম (ইংরেজিতে) </label>
                            </div>
                            <div class="col-sm-2">
                                <label> সম্পর্ক (বাংলায়) <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-2">
                                <label> সম্পর্ক (ইংরেজিতে)</label>
                            </div>
                            {{-- <div class="col-sm-2">
                                <label> বয়স </label>
                            </div> --}}
                            <div class="col-sm-2">
                                <label> পরিচয় পত্র নং </label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <div class="col-sm-2 bt-flabels__wrapper" id="warish_name_bn_0_status">
                                <input type="text" name="warish_name_bn[]" id="warish_name_bn_0" class="form-control"
                                       placeholder="নাম বাংলায়"/>
                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                <span id="warish_name_bn_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="warish_name_en_0_status">
                                <input type="text" name="warish_name_en[]" id="warish_name_en_0" class="form-control"
                                       placeholder="নাম ইংরেজিতে" data-parsley-pattern='^[a-zA-Z. ]+$'
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                <span id="warish_name_en_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="relation_bn_0_status">
                                <input type="text" name="relation_bn[]" id="relation_bn_0" class="form-control"
                                       placeholder="সম্পর্ক বাংলায়" />
                                <span class="bt-flabels__error-desc">সম্পর্ক দিন বাংলায়....</span>

                                <span id="relation_bn_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="relation_en_0_status">
                                <input type="text" name="relation_en[]" id="relation_en_0" class="form-control"
                                       placeholder="সম্পর্ক ইংরেজিতে" data-parsley-pattern='^[a-zA-Z. ]+$'
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">সম্পর্ক দিন ইংরেজিতে....</span>

                                <span id="relation_en_0_feedback" class="help-block"></span>
                            </div>
                            {{-- <div class="col-sm-2 bt-flabels__wrapper" id="relation_age_0_status">
                                <input type="text" name="relation_age[]" id="relation_age_0" placeholder=""
                                       class="form-control" data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">বয়স দিন ইংরেজিতে....</span>

                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div> --}}
                            <div class="col-sm-2 bt-flabels__wrapper" id="member_nid_0_status">
                                <input type="text" name="member_nid[]" id="member_nid_0" placeholder="পরিচয় পত্র নং দিন" value=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc">পরিচয় পত্র নং দিন.....</span>

                                <span id="member_nid_0_feedback" class="help-block"></span>
                            </div>
                            {{-- <div class="col-sm-2 bt-flabels__wrapper" id="member_father_name_bn_0_status">
                                <lable>পিতার নাম (বাংলায়)</lable>
                                <input type="text" name="member_father_name_bn[]" id="member_father_name_bn_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc">পিতার নাম বাংলায়....</span>

                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="member_father_name_en_0_status">
                                <lable>পিতার নাম (ইংরেজিতে)</lable>
                                <input type="text" name="member_father_name_en[]" id="member_father_name_en_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc">পিতার নাম ইংরেজিতে....</span>

                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="member_mother_name_bn_0_status">
                                <lable>মাতার নাম (বাংলায়)</lable>
                                <input type="text" name="member_mother_name_bn[]" id="member_mother_name_bn_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc">মাতার নাম বাংলায়....</span>

                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="member_mother_name_en_0_status">
                                <lable>মাতার নাম (ইংরেজিতে)</lable>
                                <input type="text" name="member_mother_name_en[]" id="member_mother_name_en_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc">মাতার নাম ইংরেজিতে....</span>

                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="present_address_bn_0_status">
                                <lable> বর্তমান ঠিকানা (বাংলায়)</lable>
                                <input type="text" name="present_address_bn[]" id="present_address_bn_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc"> বর্তমান ঠিকানা বাংলায়....</span>
                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="present_address_en_0_status">
                                <lable> বর্তমান ঠিকানা (ইংরেজী)</lable>
                                <input type="text" name="present_address_en[]" id="present_address_en_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc"> বর্তমান ঠিকানা বাংলায়....</span>
                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="present_address_en_0_status">
                                <lable> স্থায়ী ঠিকানা (বাংলায়) </lable>
                                <input type="text" name="permanent_address_bn[]" id="permanent_address_bn_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc"> স্থায়ী ঠিকানা বাংলায়....</span>
                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper" id="permanent_address_en_0_status">
                                <lable> স্থায়ী ঠিকানা (ইংরেজী) </lable>
                                <input type="text" name="permanent_address_en[]" id="permanent_address_en_0" placeholder=""
                                       class="form-control"/>
                                <span class="bt-flabels__error-desc"> স্থায়ী ঠিকানা ইংরেজীতে....</span>
                                <span id="relation_age_0_feedback" class="help-block"></span>
                            </div> --}}
                            <div class="col-sm-2 bt-flabels__wrapper" style="margin-top: 22px">
                                <button type="button" id="warish" class="btn btn-info">নতুন ওয়ারিশ</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="emptyError"></div>
                </div>

                <div class="row" id="addWoyarish">

                </div>

                <div class="row" style="margin-bottom: 100px;">
                    <div class="col-sm-offset-6 col-sm-6 button-style">
                        <input type="hidden" value="{{ $id }}" name="web" id="web"/>
                        <input type="hidden" value="{{ $unionProfile->union_id }}" name="union_id" id="union-id"/>
                        <input type="hidden" value="{{ $unionProfile->fiscal_id }}" name="fiscal_id"/>

                        <input type="hidden" value="17" id="app-type">
                        <input type="hidden" value="" name="pin" id="pin">

                        <button type="submit" name="save" id="submit_button" class="btn btn-primary">দাখিল করুন</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
    <script src="{{ asset('js/custom_form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.js') }}"></script>
    <script>
        $('#member_birth_date_0').datepicker();

        $(document).ready(function(){

            var max_death_date = new Date(2006, 5, 30);

            console.log(max_death_date);

            $('#death_date').datepicker({
                autoclose : true,
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                maxDate: max_death_date
            });
        });

        function removeRow(y) {
            $('#dataRow_' + y).remove();
        }
    </script>
@endsection
