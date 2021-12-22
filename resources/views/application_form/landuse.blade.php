@extends('layouts.master')
@section('head')
    <!-- cropzee.js -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                    <h4 style="color: white;">ভূমি ব্যবহার ছাড়পত্রের আবেদন</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
        <form id="form-data" data-route="{{ $path.'/api/application/landuse' }}" method="post"
              enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-8" style="padding-top: 50px">
                        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4><hr/>
                        <ul>
                            <li>বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন ।</li>
                            <li>ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন ।</li>
                            <li>আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে আপনার
                                মোবাইল অথবা ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা
                                পিন নং দিয়ে সার্চ করুন!</li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <label for="cropzee-input">
                            <div class="image-overlay">
                                <img src="{{ asset('images/default.jpg') }}" class="image-previewer image" data-cropzee="cropzee-input" />
                                <button for="cropzee-input" class="btn btn-primary form-control"><i class="ion-ios-upload-outline"></i> Upload</button>
                                <div class="overlay">
                                    <div class="text">ক্লিক করুন</div>
                                </div>
                            </div>
                        </label>
                        <input id="cropzee-input" style="display: none;" name="photo" type="file" accept="image/*">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-offset-2">
                        <div class="input-group">
                            <input type="search" id="search-data" class="form-control" placeholder="ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা পিন নং দিন ইংরেজিতে">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-btn">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    <span class="ion-ios-search" aria-hidden="true"></span> Search
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

{{--       emarot     --}}

            <div class="row" style="margin-top: 50px;">

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="name_en" class="col-sm-3 control-label"> নাম (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="name_en_status">
                            <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="form-control" autocomplete="name_en" autofocus placeholder="Full Name" data-parsley-pattern='^[a-zA-Z. ()]+$' data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                            <span id="name_en_feedback" class="help-block"></span>
                        </div>

                        <label for="name_bn" class="col-sm-3 control-label"> নাম (বাংলায়) <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="name_bn_status">
                            <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}" class="form-control" autocomplete="name_bn" autofocus placeholder="পূর্ণ নাম" data-parsley-trigger="keyup" data-parsley-required />
                            <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                            <span id="name_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center" id="national_id_error">

                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="nid" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="nid_status">
                            <input type="text" name="nid" id="nid" value="{{ old('nid') }}" class="form-control" autocomplete="nid" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                            <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                            <span id="nid_feedback" class="help-block"></span>
                        </div>

                        <label for="birth_id" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে) </label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="birth_id_status">
                            <input type="text" name="birth_id" id="birth_id" value="{{ old('birth_id') }}" class="form-control" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
                            <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>

                            <span id="birth_id_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">

                        <label for="passport_no" class="col-sm-3 control-label">পাসপোর্ট নং (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="passport_no_status">
                            <input type="text" name="passport_no" id="passport_no" value="{{ old('passport_no') }}" class="form-control" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                            <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                            <span id="passport_no_feedback" class="help-block"></span>
                        </div>

                        <label for="birth_date" class="col-sm-3 control-label">জম্ম তারিখ <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="birth_date_status">
                            <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="form-control datepicker" placeholder="yyyy-mm-dd" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-required data-date-format="yyyy-mm-dd" />
                            <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>

                            <span id="birth_date_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="father_name_en" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="father_name_en_status">
                            <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en') }}" class="form-control" autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="Father's Name" />
                            <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                            <span id="father_name_en_feedback" class="help-block"></span>
                        </div>

                        <label for="father_name_bn" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="father_name_bn_status">
                            <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn') }}" class="form-control" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" data-parsley-required />
                            <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                            <span id="father_name_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="mother_name_en" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="mother_name_en_status">
                            <input type="text" name="mother_name_en" id="mother_name_en" value="{{ old('mother_name_en') }}" autocomplete="mother_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" class="form-control" placeholder="Mother's Name" />
                            <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                            <span id="mother_name_en_feedback" class="help-block"></span>
                        </div>

                        <label for="mother_name_bn" class="col-sm-3 control-label">মাতার নাম (বাংলায়) <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="mother_name_bn_status">
                            <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ old('mother_name_bn') }}" class="form-control" placeholder="মাতার নাম" autocomplete="mother_name_bn" autofocus data-parsley-trigger="keyup" data-parsley-required />
                            <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                            <span id="mother_name_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 50px;">

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="occupation" class="col-sm-3 control-label">পেশা</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="occupation_status">
                            <input type="text" name="occupation" id="occupation" value="{{ old('occupation') }}" class="form-control" autocomplete="occupation" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                            <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                            <span id="occupation_feedback" class="help-block"></span>
                        </div>

                        <label for="resident" class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="resident_status">
                            <select name="resident" id='resident' class="form-control" selected="selected" data-parsley-required >
                                <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>অস্থায়ী</option>
                                <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>স্থায়ী</option>
                            </select>
                            <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                            <span id="resident_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="educational_qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="educational_qualification_status">
                            <input type="text" name="educational_qualification" id="educational_qualification" value="{{ old('educational_qualification') }}" class="form-control" autocomplete="educational_qualification" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন" />
                            <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                            <span id="educational_qualification_feedback" class="help-block"></span>
                        </div>

                        <label for="religion" class="col-sm-3 control-label">ধর্ম <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="religion_status">
                            <select name="religion" id="religion" selected="selected" class="form-control" data-parsley-required >
                                <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>ইসলাম</option>
                                <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>হিন্দু</option>
                                <option value='3' {{ (old('resident') == 3) ? 'selected="selected"' : '' }}>বৌদ্ধ ধর্ম</option>
                                <option value='4' {{ (old('resident') == 4) ? 'selected="selected"' : '' }}>খ্রিস্ট ধর্ম</option>
                                <option value='5' {{ (old('resident') == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
                            </select>
                            <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                            <span id="religion_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="genderErr">

                    <div class="row form-group">
                        <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                        <div class="col-sm-3" id="gender_status">
                            <label class="radio-inline gender"><input type="radio" id="gender_1" name="gender" value="1" {{ (old('gender') == 1) ? 'checked' : '' }} /><span class="wrap">পুরুষ</span></label>
                            <label class="radio-inline gender"><input type="radio" id="gender_2" name="gender" value="2" {{ (old('gender') == 2) ? 'checked' : '' }} /><span class="wrap">মহিলা</span></label>
                            <label class="radio-inline gender"><input type="radio" id="gender_3" name="gender" value="3" {{ (old('gender') == 3) ? 'checked' : '' }} /><span class="wrap">অন্যান্য</span></label>

                            <span id="gender_feedback" class="help-block"></span>
                        </div>
                        <label for="marital_status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="marital_status_status">
                            <select name="marital_status" id="marital_status" class="form-control" selected="selected" data-parsley-required >
                                <option value="" {{ (old('marital_status') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                <option value='1' {{ (old('marital_status') == 1) ? 'selected="selected"' : '' }}>অবিবাহিত</option>
                                <option value='2' {{ (old('marital_status') == 2) ? 'selected="selected"' : '' }}>বিবাহিত</option>
                                <option value='3' {{ (old('marital_status') == 3) ? 'selected="selected"' : '' }}>তালাক প্রাপ্ত</option>
                                <option value='4' {{ (old('marital_status') == 4) ? 'selected="selected"' : '' }}>বিধবা</option>
                                <option value='5' {{ (old('marital_status') == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
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
                            <input type="text" name="wife_name_en" id="wife_name_en" class="form-control" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Wife" />
                            <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                            <span id="wife_name_en_feedback" class="help-block"></span>
                        </div>

                        <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="wife_name_bn_status">
                            <input type="text" name="wife_name_bn" id="wife_name_bn" class="form-control" placeholder="স্ত্রীর নাম" />
                            <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                            <span id="wife_name_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="husband" style="display: none;">
                    <div class="row form-group">
                        <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="husband_name_en_status">
                            <input type="text" name="husband_name_en" id="husband_name_en" class="form-control" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Husband" />
                            <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                            <span id="husband_name_en_feedback" class="help-block"></span>
                        </div>

                        <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="husband_name_bn_status">
                            <input type="text" name="husband_name_bn" id="husband_name_bn" class="form-control" placeholder="স্বামী নাম" />
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
                        <label for="present_village_en" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_village_en_status">
                            <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en') }}" class="form-control" autocomplete="present_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                            <span id="present_village_en_feedback" class="help-block"></span>
                        </div>

                        <label for="present_village_bn" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_village_bn_status">
                            <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn') }}" class="form-control" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                            <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                            <span id="present_village_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="present_rbs_en" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_rbs_en_status">
                            <input type="text" name="present_rbs_en" id="present_rbs_en" value="{{ old('present_rbs_en') }}" class="form-control" placeholder="" autocomplete="present_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                            <span id="present_rbs_en_feedback" class="help-block"></span>
                        </div>

                        <label for="present_rbs_bn" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_rbs_bn_status">
                            <input type="text" name="present_rbs_bn" id="present_rbs_bn" value="{{ old('present_rbs_bn') }}" class="form-control" placeholder="" autocomplete="present_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                            <span id="present_rbs_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="present_holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_holding_no_status">
                            <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no') }}" class="form-control" autocomplete="present_holding_no" autofocus   data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                            <span id="present_holding_no_feedback" class="help-block"></span>
                        </div>

                        <label for="present_ward_no" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_ward_no_status">
                            <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no') }}" class="form-control" autocomplete="present_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required  />
                            <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                            <span id="present_ward_no_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="present_district_id" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_district_id_status">
                            <select onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )" name="present_district_id" id="present_district_id" class="form-control" data-parsley-required >
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
                            <input type="text" disabled id="present_district" value="জেলা" class="form-control" placeholder=""/>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_upazila_id_status">
                            <select onchange="getLocation($(this).val(), 'present_upazila', 'present_post_office_append', 'present_postoffice_id', 'present_postoffice', 6 )" name="present_upazila_id" id="present_upazila_id" class="form-control" data-parsley-required >
                                <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                            </select>
                            <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                            <span id="present_upazila_id_feedback" class="help-block"></span>
                        </div>

                        <label for="present_upazila" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="present_upazila" value="উপজেলা/থানা" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="present_postoffice_id_status">
                            <select onchange="getLocation($(this).val(), 'present_postoffice')" name="present_postoffice_id" id="present_postoffice_id" class="form-control" data-parsley-required >
                                <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                            </select>
                            <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                            <span id="present_postoffice_id_feedback" class="help-block"></span>
                        </div>

                        <label for="present_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="present_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 50px;">
                <div class="col-sm-12 text-center">
                    <h4 class="app-heading">
                        স্থায়ী  ঠিকানা
                    </h4>
                    <p id="addressCheck" style="font-size:15px; font-weight:normal;padding-top:10px;"> <input type="checkbox" name="permanentBtn" id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="permanent_village_en" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_village_en_status">
                            <input type="text" name="permanent_village_en" id="permanent_village_en" value="{{ old('permanent_village_en') }}" class="form-control" autocomplete="permanent_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                            <span id="permanent_village_en_feedback" class="help-block"></span>
                        </div>

                        <label for="permanent_village_bn" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_village_bn_status">
                            <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn') }}" class="form-control" autocomplete="permanent_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                            <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                            <span id="permanent_village_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="permanent_rbs_en" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_rbs_en_status">
                            <input type="text" name="permanent_rbs_en" id="permanent_rbs_en" value="{{ old('permanent_rbs_en') }}" class="form-control" placeholder="" autocomplete="permanent_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                            <span id="permanent_rbs_en_feedback" class="help-block"></span>
                        </div>

                        <label for="permanent_rbs_bn" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_rbs_bn_status">
                            <input type="text" name="permanent_rbs_bn" id="permanent_rbs_bn" value="{{ old('permanent_rbs_bn') }}" class="form-control" placeholder="" autocomplete="permanent_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                            <span id="permanent_rbs_bn_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="permanent_holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_holding_no_status">
                            <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no') }}" class="form-control" autocomplete="permanent_holding_no" autofocus  data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                            <span id="permanent_holding_no_feedback" class="help-block"></span>
                        </div>
                        <label for="permanent_ward_no" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_ward_no_status">
                            <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no') }}" class="form-control" autocomplete="permanent_ward_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                            <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                            <span id="permanent_ward_no_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="permanent_district_id" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_district_id_status">
                            <select onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )" name="permanent_district_id" id="permanent_district_id" class="form-control" data-parsley-required >
                                <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                @foreach ($district as $item)
                                    <option value="{{$item->id}}">{{$item->en_name}}</option>
                                @endforeach
                            </select>
                            <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                            <span id="permanent_district_id_feedback" class="help-block"></span>
                        </div>

                        <label for="permanent_district" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="permanent_district" value="জেলা" class="form-control" placeholder=""/>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_upazila_id_status">
                            <select onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )" name="permanent_upazila_id" id="permanent_upazila_id" class="form-control" data-parsley-required >
                                <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                            </select>
                            <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                            <span id="permanent_upazila_id_feedback" class="help-block"></span>
                        </div>

                        <label for="permanent_upazila" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="permanent_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="permanent_postoffice_id_status">
                            <select onchange="getLocation($(this).val(), 'permanent_postoffice')" name="permanent_postoffice_id" id="permanent_postoffice_id" class="form-control" data-parsley-required >
                                <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                            </select>
                            <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                            <span id="permanent_postoffice_id_feedback" class="help-block"></span>
                        </div>

                        <label for="permanent_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="permanent_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
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
                            <input type="text" name="dag_no_cs" id="dag_no_cs" value="{{ old('dag_no_cs') }}"
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
                            <input type="text" name="khotian_no_cs" id="khotian_no_cs" value="{{ old('khotian_no_cs')
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
                                   value="{{ old('dag_no_sa') }}"
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
                                   value="{{ old('khotian_no_sa') }}"
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
                                   value="{{ old('dag_no_rs') }}"
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
                                   value="{{ old('khotian_no_rs') }}"
                                   class="form-control @error('khotian_no_rs')is-invalid @enderror" placeholder=""
                                   data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                            <span class="bt-flabels__error-desc">দাগ নং-আর এস দিন....</span>

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
                                   value="{{ old('mojar_name') }}"
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
                                   value="{{ old('mojar_no') }}"
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
                                   value="{{ old('land_amount') }}"
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
                                   value="{{ old('land_type') }}"
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
                                   value="{{ old('plot_proposed_use') }}"
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
                                   value="{{ old('plot_owner_details') }}"
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
                                   value="{{ old('owner_cue') }}"
                                   class="form-control @error('owner_cue')is-invalid @enderror"
                                   placeholder="মালিকানার সূত্র ও তারিখ উল্লেখ করুন "
                                   data-parsley-trigger="keyup" data-parsley-maxlength="70" data-parsley-required />

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
                                   value="{{ old('registration_date') }}"
                                   class="form-control @error('registration_date')is-invalid @enderror"
                                   placeholder="মালিকানার সূত্র ও তারিখ উল্লেখ করুন "
                                   data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required />

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
                            <input type="text" name="current_land_use" id="current_land_use" value="{{ old('current_land_use') }}"
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
                            <input type="text" name="radius_land_current_use" id="radius_land_current_use" value="{{ old('radius_land_current_use')
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
                                   value="{{ old('ploat_near_road') }}"
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
                                   value="{{ old('join_ploat_road') }}"
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
                                       value="হ্যাঁ" class="form-check-input  @error('main_road')is-invalid @enderror"
                                /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="main_road"
                                       id="main_road"
                                       value="না" class="form-check-input  @error('main_road')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('river_port')is-invalid @enderror"
                                /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="river_port" id="river_port"
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
                                       id="hat_bazaar"
                                       value="হ্যাঁ" class="form-check-input  @error('hat_bazaar')is-invalid @enderror"
                                /><label class="form-check-label" for="hat_bazaar"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="hat_bazaar"
                                       id="hat_bazaar"
                                       value="না" class="form-check-input  @error('hat_bazaar')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('airport')is-invalid @enderror"
                                /><label class="form-check-label" for="airport"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="airport" id="airport"
                                       value="না" class="form-check-input  @error('airport')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('railway_station')is-invalid @enderror"
                                /><label class="form-check-label" for="railway_station"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="railway_station"
                                       id="railway_station"
                                       value="না" class="form-check-input  @error('railway_station')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('pond')is-invalid @enderror"
                                /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="pond"
                                       id="pond"
                                       value="না" class="form-check-input  @error('pond')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('flood_control_reservoirs')is-invalid @enderror"
                                /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="flood_control_reservoirs" id="flood_control_reservoirs"
                                       value="না" class="form-check-input  @error('flood_control_reservoirs')is-invalid @enderror"
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
                                       id="wetlands"
                                       value="হ্যাঁ" class="form-check-input  @error('wetlands')is-invalid @enderror"
                                /><label class="form-check-label" for="wetlands"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="wetlands"
                                       id="wetlands"
                                       value="না" class="form-check-input  @error('wetlands')is-invalid @enderror"
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
                                       id="forest"
                                       value="হ্যাঁ" class="form-check-input  @error('forest')is-invalid @enderror"
                                /><label class="form-check-label" for="forest"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="forest" id="forest"
                                       value="না" class="form-check-input  @error('forest')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('natural_waterways')is-invalid @enderror"
                                /><label class="form-check-label" for="natural_waterways"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="natural_waterways"
                                       id="natural_waterways"
                                       value="না" class="form-check-input  @error('natural_waterways')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('park')is-invalid @enderror"
                                /><label class="form-check-label" for="park"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="park"
                                       id="park"
                                       value="না" class="form-check-input  @error('park')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('hill')is-invalid @enderror"
                                /><label class="form-check-label" for="natural_waterways"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="hill"
                                       id="hill"
                                       value="না" class="form-check-input  @error('hill')is-invalid @enderror"
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
                                       value="হ্যাঁ" class="form-check-input  @error('dal')is-invalid @enderror"
                                /><label class="form-check-label" for="park"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="dal"
                                       id="dal"
                                       value="না" class="form-check-input  @error('dal')is-invalid @enderror"
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
                                       id="historical_site"
                                       value="হ্যাঁ" class="form-check-input  @error('historical_site')is-invalid @enderror"
                                /><label class="form-check-label" for="historical_site"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="historical_site"
                                       id="historical_site"
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
                                       id="key_point"
                                       value="হ্যাঁ" class="form-check-input  @error('key_point')is-invalid @enderror"
                                /><label class="form-check-label" for="key_point"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="key_point" id="key_point"
                                       value="না" class="form-check-input  @error('key_point')is-invalid @enderror"
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
                                       id="samorik"
                                       value="হ্যাঁ" class="form-check-input  @error('samorik')is-invalid @enderror"
                                /><label class="form-check-label" for="samorik"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="samorik"
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
                                       id="special_area"
                                       value="হ্যাঁ" class="form-check-input  @error('special_area')is-invalid @enderror"
                                /><label class="form-check-label" for="special_area"> হ্যাঁ </label>
                                <input style=" width: 15px " type="radio" name="special_area" id="special_area"
                                       value="না" class="form-check-input  @error('special_area')is-invalid @enderror"
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
                            <input type="text" name="north" id="north" value="{{ old('north') }}" class="form-control @error('north')is-invalid @enderror"  data-parsley-maxlength="50"  data-parsley-trigger="keyup"  />


                            @error('north')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="east" class="col-sm-3 control-label">পূর্ব</label>

                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="east" id="east" value="{{ old('east') }}"
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
                            <input type="text" name="south" id="south" value="{{ old('south') }}"
                                   class="form-control @error('south') is-invalid @enderror"  data-parsley-maxlength="50"  data-parsley-trigger="keyup"  />


                            @error('south')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="west" class="col-sm-3 control-label">পশ্চিম</label>

                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="west" id="west" value="{{ old('west') }}"
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
                        <label for="mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="mobile_status">
                            <input type="tel" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control" data-parsley-type="digits" autocomplete="mobile" autofocus data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                            <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                            <span id="mobile_feedback" class="help-block"></span>
                        </div>
                        <label for="email" class="col-sm-3 control-label">ইমেল </label>
                        <div class="col-sm-3 bt-flabels__wrapper" id="email_status">
                            <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="example@gmail.com" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                            <span id="email_feedback" class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>


{{--    emarot         --}}

                <div class="row" style="margin-bottom: 100px;">
                    <div class="col-sm-offset-6 col-sm-6 button-style">
                        <input type="hidden" value="{{ $id }}" name="web" id="web"/>
                        <input type="hidden" value="{{ $unionProfile->union_id }}" name="union_id" id="union-id"/>
                        <input type="hidden" value="{{ $unionProfile->fiscal_id }}" name="fiscal_id"/>
                        <button type="submit" id="submitBtn" class="btn btn-primary">দাখিল করুন</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.js') }}"></script>

    <script>
        $(document).ready(function() {
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
