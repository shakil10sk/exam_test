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
                    <h4 style="color: white;">ভূমিহিন সনদের আবেদন</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
        <form id="form-data" data-route="{{ $path.'/api/application/vumihin' }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
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
                                <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-required />

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
                                <label class="radio-inline gender"><input type="radio" name="gender" id="gender_1" value="1" {{ (old('gender') == 1) ? 'checked' : '' }} />পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" name="gender" id="gender_2" value="2" {{ (old('gender') == 2) ? 'checked' : '' }} />মহিলা</label>
                                <label class="radio-inline gender"><input type="radio" name="gender" id="gender_3" value="3" {{ (old('gender') == 3) ? 'checked' : '' }} />অন্যান্য</label>

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
                            <label for="Wife-name-english" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="wife_name_en_status">
                                <input type="text" name="wife_name_en" id="wife_name_en" class="form-control" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Wife" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                <span id="wife_name_en_feedback" class="help-block"></span>
                            </div>

                            <label for="Wife-name-bangla" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
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
                        <p style="font-size:15px; font-weight:normal;padding-top:10px;" id="addressCheck"> <input type="checkbox" name="permanentBtn" id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন</p>
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
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no') }}" class="form-control" autocomplete="permanent_ward_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required />
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

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="comment_en" class="col-sm-3 control-label">মন্তব্য দিন(ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="comment_en_status">
                                <textarea name="comment_en" class="form-control" rows="5" id="comment_en" autocomplete="comment_en" autofocus placeholder="Examples: Freedom fighter children, widows, tribals ..... etc." data-parsley-maxlength="500" data-parsley-trigger="keyup" >{{ old('comment_en') }}</textarea>
                                <span class="bt-flabels__error-desc">মন্তব্য ৫০০ অক্ষরের নিচে লিখুন ইংরেজিতে....</span>

                                <span id="comment_en_feedback" class="help-block"></span>
                            </div>
                            <label for="comment_bn" class="col-sm-3 control-label">মন্তব্য দিন (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="comment_bn_status">
                                <textarea name="comment_bn" class="form-control" rows="5" id="comment_bn" autocomplete="comment_bn" autofocus  placeholder=" উদাহরন: মুক্তিযোদ্ধা সন্তান, বিধবা, উপজাতি .....ইত্যাদি " data-parsley-maxlength="500" data-parsley-trigger="keyup">{{ old('comment_bn') }}</textarea>
                                <span class="bt-flabels__error-desc">মন্তব্য ৫০০ অক্ষরের নিচে লিখুন বাংলায়....</span>

                                <span id="comment_bn_feedback" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>

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
