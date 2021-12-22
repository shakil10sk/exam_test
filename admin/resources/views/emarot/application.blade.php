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
                        <h4 class="text-center application_head">ইমারত নির্মাণ/সীমানা দেয়াল/বিবিধ নির্মাণ/পূণঃ নির্মাণ
                            এবং পুকুর খনন/ভরাট/পাহাড় কর্তণ আবেদন পত্র</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('emarot_store') }}" method="post"
                  enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate
                  data-parsley-errors-messages-disabled>
                @csrf
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-8">
                        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4>
                        <hr/>
                        <ul>
                            <li><i class="fa fa-circle-o"></i> বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন
                                করুন ।
                            </li>
                            <li><i class="fa fa-circle-o"></i> ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন
                                করুন ।
                            </li>
                            <li><i class="fa fa-circle-o"></i> আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে
                                আপনার
                                মোবাইল অথবা ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা
                                পিন নং দিয়ে সার্চ করুন!
                            </li>
                        </ul>

                        <div class="input-group mt-5">
                            <input type="search" class="form-control" id="search-data"
                                   placeholder="মোবাইল/এন.আই.ডি.নং/জন্ম নিবন্ধন নং/পাসপোর্ট নং/পিন নং দিন ইংরেজিতে">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-btn">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    <span class="ion-ios-search" aria-hidden="true"></span> Search
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="cropzee-input">
                            <div class="image-overlay">
                                <img src="{{ asset('images/default.jpg') }}" class="image-previewer image"
                                     data-cropzee="cropzee-input"/>
                                <button for="cropzee-input" class="btn btn-primary form-control"><i
                                        class="ion-ios-upload-outline"></i> Upload
                                </button>
                                <div class="overlay">
                                    <div class="text">ক্লিক করুন</div>
                                </div>
                            </div>
                        </label>
                        <input id="cropzee-input" style="display: none;" name="photo" type="file" accept="image/*">
                    </div>
                </div>


                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Name-english" class="col-sm-3 control-label"> নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                                       class="form-control @error('name_en') is-invalid @enderror"
                                       autocomplete="name_en" autofocus placeholder=" Full Name"
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                @error('name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়)<span class="text-danger" >*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}"
                                       class="form-control @error('name_bn') is-invalid @enderror"
                                       autocomplete="name_bn" autofocus placeholder="পূর্ণ নাম"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                @error('name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center" id="national_id_error">

                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="nid" id="nid" value="{{ old('nid') }}"
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
                                <input type="text" name="birth_id" value="{{ old('birth_id') }}" id="birth_id"
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
                                <input type="text" name="passport_no" value="{{ old('passport_no') }}" id="passport_no"
                                       class="form-control @error('passport_no') is-invalid @enderror"
                                       autocomplete="passport_no" autofocus data-parsley-maxlength="17"
                                       data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ<span class="text-danger" >*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date" value="{{ old('birth_date') }}" id="birth_date"
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
                            <label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_en" id="father_name_en"
                                       value="{{ old('father_name_en') }}"
                                       class="form-control @error('father_name_en') is-invalid @enderror"
                                       autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$'
                                       data-parsley-trigger="keyup" placeholder="Father's Name"/>
                                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                @error('father_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)
                               <span class="text-danger" >*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_bn" id="father_name_bn"
                                       value="{{ old('father_name_bn') }}"
                                       class="form-control @error('father_name_bn') is-invalid @enderror"
                                       autocomplete="father_name_bn" autofocus placeholder="পিতার নাম"
                                       data-parsley-required/>
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
                                <input type="text" name="mother_name_en" id="mother_name_en"
                                       value="{{ old('mother_name_en') }}" data-parsley-pattern='^[a-zA-Z. ]+$'
                                       data-parsley-trigger="keyup"
                                       class="form-control @error('mother_name_en') is-invalid @enderror"
                                       autocomplete="mother_name_en" autofocus placeholder="Mother's Name"/>
                                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                @error('mother_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)
                               <span class="text-danger" >*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name_bn" id="mother_name_bn"
                                       value="{{ old('mother_name_bn') }}"
                                       class="form-control @error('mother_name_bn') is-invalid @enderror"
                                       autocomplete="mother_name_bn" autofocus placeholder="মাতার নাম"
                                       data-parsley-trigger="keyup" data-parsley-required/>
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

                <div class="row" style="margin-top: 10px;">

                    <div class="col-md-12" id="genderErr">

                        <div class="row form-group">
                            <label class="col-sm-3 control-label">লিঙ্গ<span class="text-danger" >*</span></label>
                            <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                <label class="radio-inline gender"><input type="radio" id="gender_1"
                                                                          {{ (old('gender') == 1) ? 'checked' : '' }} name="gender"
                                                                          value="1"/>পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_2"
                                                                          {{ (old('gender') == 2) ? 'checked' : '' }} name="gender"
                                                                          value="2"/>মহিলা</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_3"
                                                                          {{ (old('gender') == 3) ? 'checked' : '' }} name="gender"
                                                                          value="3"/>অন্যান্য</label>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক
                               <span class="text-danger" >*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="marital_status" id="marital_status" selected="selected"
                                        class="form-control @error('marital_status')is-invalid @enderror"
                                        data-parsley-required>
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

                                @error('marital_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-3 control-label">ধর্ম <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="religion" id="religion" selected="selected" class="form-control @error('religion')is-invalid @enderror" data-parsley-required >
                                    <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>ইসলাম</option>
                                    <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>হিন্দু</option>
                                    <option value='3' {{ (old('resident') == 3) ? 'selected="selected"' : '' }}>বৌদ্ধ ধর্ম</option>
                                    <option value='4' {{ (old('resident') == 4) ? 'selected="selected"' : '' }}>খ্রিস্ট ধর্ম</option>
                                    <option value='5' {{ (old('resident') == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('religion')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <label class="col-sm-3 control-label">বাসিন্দা <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="resident" id='resident' selected="selected" class="form-control @error('resident')is-invalid @enderror" data-parsley-required >
                                    <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>অস্থায়ী</option>
                                    <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>স্থায়ী</option>
                                </select>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('resident')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12"
                         id="wife" {{ (old('wife_name_en') != null || old('wife_name_bn') != null)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="wife_name_en" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_en" id="wife_name_en"
                                       class="form-control @error('wife_name_en')is-invalid @enderror"
                                       data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"
                                       placeholder="Name of Wife"/>
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                @error('wife_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_bn" id="wife_name_bn"
                                       class="form-control @error('wife_name_bn')is-invalid @enderror"
                                       placeholder="স্ত্রীর নাম"/>
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                                @error('wife_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12"
                         id="husband" {{ (old('husband_name_en') != null || old('husband_name_bn') != null)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_en" id="husband_name_en"
                                       class="form-control @error('husband_name_en')is-invalid @enderror"
                                       data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"
                                       placeholder="Name of Husband"/>
                                <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                @error('husband_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_bn" id="husband_name_bn"
                                       class="form-control @error('husband_name_bn')is-invalid @enderror"
                                       placeholder="স্বামী নাম"/>
                                <span class="bt-flabels__error-desc">স্বামী নাম দিন বাংলায়....</span>

                                @error('husband_name_bn')
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
                                <input type="text" name="present_village_en" id="present_village_en"
                                       value="{{ old('present_village_en') }}"
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
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_bn" id="present_village_bn"
                                       value="{{ old('present_village_bn') }}"
                                       class="form-control @error('present_village_bn')is-invalid @enderror"
                                       placeholder="" autocomplete="present_village_bn" autofocus
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required/>
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
                                <input type="text" name="present_holding_no" id="present_holding_no"
                                       value="{{ old('present_holding_no') }}"
                                       class="form-control @error('present_holding_no')is-invalid @enderror"
                                       autocomplete="present_holding_no" autofocus
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no"
                                       value="{{ old('present_ward_no') }}"
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
                            <label for="present_district_id" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <input class="form-control @error('present_district_id') is-invalid @enderror"
                                    id="present_district_txt" name="present_district_txt"
                                    style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('present_district_txt', 'present_district')" value="{{ old('present_district_txt') }}" />

                                <input type="hidden" id="present_district_id" name="present_district_id" value="{{ old('present_district_id') }}" />

                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('present_district_id')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <label for="present_district" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="present_district" value="জেলা" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <input class="form-control @error('present_upazila_id') is-invalid @enderror"
                                    id="present_upazila_txt" name="present_upazila_txt"
                                    style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('present_upazila_txt', 'present_upazila')" />

                                <input type="hidden" id="present_upazila_id" name="present_upazila_id" />


                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('present_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="present_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="present_upazila" value="উপজেলা/থানা"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <input class="form-control @error('present_postoffice_id') is-invalid @enderror"
                                    id="present_postoffice_txt" name="present_postoffice_txt"
                                    style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('present_postoffice_txt', 'present_postoffice')" />

                                <input type="hidden" id="present_postoffice_id" name="present_postoffice_id" />

                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('present_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                @enderror
                            </div>
                            <label for="present_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>
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
                        <p style="font-size:15px; font-weight:normal;padding-top:10px;" id="addressCheck"><input
                                type="checkbox" name="permanentBtn"
                                id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_en" id="permanent_village_en"
                                       value="{{ old('permanent_village_en') }}"
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
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn"
                                       value="{{ old('permanent_village_bn') }}"
                                       class="form-control @error('permanent_village_bn')is-invalid @enderror"
                                       autocomplete="permanent_village_bn" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required/>
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no"
                                       value="{{ old('permanent_holding_no') }}"
                                       class="form-control @error('permanent_holding_no')is-invalid @enderror"
                                       autocomplete="permanent_holding_no" autofocus
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no"
                                       value="{{ old('permanent_ward_no') }}"
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
                            <label for="permanent_district_id" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <input class="form-control @error('permanent_district_id') is-invalid @enderror"
                                    id="permanent_district_txt" name="permanent_district_txt"
                                    style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('permanent_district_txt', 'permanent_district')" />

                                <input type="hidden" id="permanent_district_id" name="permanent_district_id" />

                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('permanent_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="permanent_district" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_district" value="জেলা" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <input class="form-control @error('permanent_upazila_id') is-invalid @enderror"
                                id="permanent_upazila_txt" name="permanent_upazila_txt"
                                style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('permanent_upazila_txt', 'permanent_upazila')" />

                            <input type="hidden" id="permanent_upazila_id" name="permanent_upazila_id" />


                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('permanent_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="permanent_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_upazila" value="উপজেলা/থানা"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">

                                <input class="form-control @error('permanent_postoffice_id') is-invalid @enderror"
                                    id="permanent_postoffice_txt" name="permanent_postoffice_txt"
                                    style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('permanent_postoffice_txt', 'permanent_postoffice')" />

                                <input type="hidden" id="permanent_postoffice_id" name="permanent_postoffice_id" />


                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('permanent_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="permanent_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="permanent_postoffice" value="পোষ্ট অফিস"
                                       class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                </div>

{{--     emarot           --}}

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">যে দাগের জমিতে ইমারত নির্মাণ/পুকুর খনন /পাহাড় কর্তণ/বা ধ্বংস করা হইবে উহার বিবরণঃ</span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="area_name" class="col-sm-3 control-label">এলাকার নাম<span
                                    class="text-danger"> *</span> </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="area_name" id="area_name" value="{{ old
                                ('area_name') }}" class="form-control @error('area_name')is-invalid @enderror"
                                       placeholder="এলাকার নাম দিন" data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"
                                       data-parsley-required=""/>
                                <span class="bt-flabels__error-desc">এলাকার নাম দিন ....</span>

                                @error('area_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="build_type" class="col-sm-3 control-label">ভবনের ধরণ <span
                                    class="text-danger"
                                > *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="build_type" id="build_type"  class="form-control "
                                        data-parsley-required="">
                                    <option value="" selected="&quot;selected&quot;">
                                        চিহ্নিত করুন
                                    </option>
                                    <option value="1">
                                        আবাসিক
                                    </option>
                                    <option value="2">
                                        বাণিজ্যিক
                                    </option>
                                    <option value="3">
                                        আবাসিক কাম-বাণিজ্যিক
                                    </option>
                                    <option value="4">
                                        শিল্প কারখানা
                                    </option>
                                    <option value="5">
                                        মসজিদ
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">ভবনের ধরণ দিন....</span>

                                @error('build_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

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
                            <label for="sit_no" class="col-sm-3 control-label">
                                সিট নং <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="sit_no" id="sit_no"
                                       value="{{ old('sit_no') }}"
                                       class="form-control @error('sit_no')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> সিট নং
                                    ....</span>

                                @error('sit_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="mojar_name" class="col-sm-3 control-label">
                                মৌজার নাম <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mojar_name" id="mojar_name"
                                       value="{{ old('mojar_name') }}"
                                       class="form-control @error('mojar_name')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> মৌজার নাম দিন
                                    ....</span>

                                @error('mojar_name')
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
                                আবেদনকারীর জমির পরিমাণ <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="land_amount" id="land_amount"
                                       value="{{ old('land_amount') }}"
                                       class="form-control @error('land_amount')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> আবেদনকারীর জমির পরিমাণ দিন
                                    ....</span>

                                @error('land_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="emarot_word_no" class="col-sm-3 control-label">
                                ওয়ার্ড নং <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="emarot_word_no" id="emarot_word_no"
                                       value="{{ old('emarot_word_no') }}"
                                       class="form-control @error('emarot_word_no')is-invalid @enderror" data-parsley-type="number" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="20" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন
                                    ....</span>

                                @error('emarot_word_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="land_earn_description" class="col-sm-3 control-label">
                                আবেদনকারী কি সূত্রে জমি অর্জন করেছেন তার বিবরণ <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="land_earn_description" id="land_earn_description"
                                       value="{{ old('land_earn_description') }}" data-parsley-maxlength="50"
                                       class="form-control @error('land_earn_description')is-invalid @enderror"
                                       placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">জমি অর্জন করেছেন তার বিবরণ দিন
                                    ....</span>

                                @error('land_earn_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_name" class="col-sm-3 control-label">
                                রাস্তার নাম <span class="text-danger"> *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_name" id="road_name"
                                       value="{{ old('road_name') }}"
                                       class="form-control @error('road_name')is-invalid @enderror" placeholder=""
                                       data-parsley-trigger="keyup" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">রাস্তার নাম দিন
                                    ....</span>

                                @error('road_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">সাইটের বিবরণ/সাইটের চৌহদ্দি</span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="north" class="col-sm-3 control-label">উত্তর</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="north" id="north" value="{{ old
                                ('north') }}"
                                       class="form-control @error('north')is-invalid @enderror"
                                       data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>

                                @error('north')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="south" class="col-sm-3 control-label">দক্ষিন</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="south" id="south" value="{{ old
                                ('south') }}" class="form-control @error('south')is-invalid @enderror"
                                       data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>

                                @error('south')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="east" class="col-sm-3 control-label">পূর্ব</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="east" id="east" value="{{ old
                                ('east') }}" class="form-control @error('east')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"/>

                                @error('east')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="west" class="col-sm-3 control-label">পশ্চিম</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="west" id="west" value="{{ old('west')
                                }}" class="form-control @error('west')is-invalid @enderror" data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>


                                @error('west')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">ইমারত দ্বারা সাইটে যে পরিমাণ স্থান আচ্ছাদিত হইবে তাহার বিশদ বিবরণ </span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="fast_floor" class="col-sm-3 control-label">১ ম তলা <span class="text-danger">
                                    *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="fast_floor" id="fast_floor" value="{{ old
                                ('fast_floor') }}" class="form-control @error('fast_floor')is-invalid @enderror"
                                       data-parsley-maxlength="50" placeholder="উত্তর"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">১ ম তলা বিবরণ দিন...</span>

                                @error('fast_floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="other_floor" class="col-sm-3 control-label">অন্যান্য তলা <span
                                    class="text-danger">
                                    *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="other_floor" id="other_floor" value="{{ old
                                ('other_floor') }}" class="form-control @error('other_floor')is-invalid @enderror"
                                       data-parsley-trigger="keyup" placeholder="পশ্চিম" data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc">অন্যান্য তলা বিবরণ দিন....</span>

                                @error('other_floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="total_floor" class="col-sm-3 control-label">মোট তলা <span
                                    class="text-danger">
                                    *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="total_floor" id="total_floor" value="{{ old
                                ('total_floor') }}" class="form-control @error('total_floor')is-invalid
@enderror"  data-parsley-maxlength="50" placeholder="মোট তলা" data-parsley-trigger="keyup"
                                       data-parsley-required/>
                                <span class="bt-flabels__error-desc">মোট তলা দিন....</span>

                                @error('total_floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">সাইটের নিকটস্থ রাস্তার বিবরণ </span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="site_name" class="col-sm-3 control-label">নাম </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="site_name" id="site_name" value="{{ old
                                ('site_name') }}" class="form-control @error('site_name')is-invalid @enderror"
                                       data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">সাইটের নাম দিন...</span>

                                @error('site_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="distance" class="col-sm-3 control-label">দূরত্ব </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="distance" id="distance" value="{{ old
                                ('distance') }}" data-parsley-maxlength="50" class="form-control @error('distance')is-invalid @enderror"
                                       data-parsley-trigger="keyup"/>


                                @error('distance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="position" class="col-sm-3 control-label">অবস্থান</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="position" id="position" value="{{ old
                                ('position') }}" class="form-control @error('position')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="spread" class="col-sm-3 control-label">বিস্তার</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="spread" id="spread" value="{{ old
                                ('spread') }}" class="form-control @error('spread')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('spread')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="near_way" class="col-sm-3 control-label">নিকটস্থ রাস্তা হতে সাইটে যাতায়তের
                                উপায়</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="near_way" id="near_way" value="{{ old
                                ('near_way') }}" class="form-control @error('near_way')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('near_way')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">সাইটের বিভিন্ন দিক থেকে যে পরিমাণ স্থান উন্মক্ত রাখা হইবে</span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="to_north" class="col-sm-3 control-label">উত্তর সীমানা হইতে <span
                                    class="text-danger"
                                > *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="to_north" id="to_north" value="{{ old
                                ('to_north') }}" class="form-control @error('to_north')is-invalid @enderror"
                                       data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">উত্তর সীমানা দিন...</span>

                                @error('to_north')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="to_east" class="col-sm-3 control-label">পূর্ব সীমানা হইতে <span
                                    class="text-danger"
                                > *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="to_east" id="to_east" value="{{ old
                                ('to_east') }}" class="form-control @error('to_east')is-invalid @enderror"
                                       data-parsley-trigger="keyup"  data-parsley-maxlength="50" data-parsley-required/>
                                <span class="bt-flabels__error-desc"> ভিতর পূর্ব সীমানা  দিন...</span>

                                @error('to_east')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="to_south" class="col-sm-3 control-label">দক্ষিন সীমানা হইতে <span
                                    class="text-danger"
                                > *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="to_south" id="to_south" value="{{ old
                                ('to_south') }}" class="form-control @error('to_south')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup" data-parsley-required
                                />
                                <span class="bt-flabels__error-desc"> দক্ষিন সীমানা  দিন...</span>
                                @error('to_south')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="to_west" class="col-sm-3 control-label">পশ্চিম সীমানা হইতে <span
                                    class="text-danger"
                                > *</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="to_west" id="to_west" value="{{ old
                                ('to_west') }}" class="form-control @error('to_west')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup" data-parsley-required
                                />
                                <span class="bt-flabels__error-desc">পশ্চিম সীমানা  দিন...</span>
                                @error('to_west')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="road_present_condition" class="col-sm-3 control-label">রাস্তার বর্তমান
                                অবস্থা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_present_condition" id="road_present_condition"
                                       value="{{ old('road_present_condition') }}"
                                       class="form-control @error('road_present_condition')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('road_present_condition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_consider" class="col-sm-3 control-label">ছাড় দিতে হবে</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_consider" id="road_consider"
                                       value="{{ old('road_consider') }}" class="form-control @error('road_consider')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('road_consider')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span
                                style="border-bottom: 3px solid black">সাইটের পূর্ব নির্মিত কাঁচা পাকা ইমারতের বিবরণ</span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="emarot_land" class="col-sm-3 control-label">পূর্ব নির্মিত ইমারতের সংখ্যা ও তৎ
                                দ্বারা বেষ্টিত স্থানের পরিমান
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="emarot_land" id="emarot_land" value="{{ old
                                ('emarot_land') }}" placeholder="বেষ্টিত স্থানের পরিমান"
                                       class="form-control  @error('to_north')is-invalid @enderror"
                                       data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>
                                @error('emarot_land')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="previous_emarot_land" class="col-sm-3 control-label">প্রস্তাবিত ইমারত নির্মাণ
                                অনুমোদন হইলে পূর্ব নির্মিত ইমারতের কোন অংশ ভাঙ্গিতে হবে কিনা এবং হলে তৎ দ্বারা বেষ্টিত
                                স্থানের পরিমান </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="previous_emarot_land" id="previous_emarot_land" value="{{ old
                                ('previous_emarot_land') }}" placeholder="বেষ্টিত স্থানের পরিমান"
                                       class="form-control @error('previous_emarot_land')
                                           is-invalid @enderror"  data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>


                                @error('previous_emarot_land')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">এলাকার বিভিন্ন সেবা সুযোগের বিবরণ</span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="electricity_line" class="col-sm-3 control-label">বিদ্যুৎ সরবরাহের লাইন আছে কিনা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="electricity_line"
                                           id="electricity_line"
                                           value="হ্যাঁ" class="form-check-input  @error('electricity_line')is-invalid @enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="electricity_line"
                                           id="electricity_line"
                                           value="না" class="form-check-input  @error('electricity_line')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>

                                @error('electricity_line')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="gass_line" class="col-sm-3 control-label">
                                গ্যাস সরবরাহের লাইন আছে কিনা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="gass_line"
                                           id="gass_line"
                                           value="হ্যাঁ" class="form-check-input  @error('gass_line')is-invalid @enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="gass_line" id="gass_line"
                                           value="না" class="form-check-input  @error('gass_line')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="water_line" class="col-sm-3 control-label">পানি সরবরাহের লাইন আছে কিনা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="water_line"
                                           id="water_line"
                                           value="হ্যাঁ" class="form-check-input  @error('water_line')is-invalid @enderror"
                                    /><label class="form-check-label" for="water_line"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="water_line"
                                           id="water_line"
                                           value="না" class="form-check-input  @error('water_line')is-invalid @enderror"
                                    />  <label class="form-check-label" for="inlineRadio1"> না </label>
                                </div>

                                @error('water_line')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <label for="drain_line" class="col-sm-3 control-label">
                                পয়ঃনিস্কাশন সরবরাহের লাইন আছে কিনা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="drain_line"
                                           id="drain_line"
                                           value="হ্যাঁ" class="form-check-input  @error('drain_line')is-invalid @enderror"
                                    /><label class="form-check-label" for="drain_line"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="drain_line" id="drain_line"
                                           value="না" class="form-check-input  @error('drain_line')is-invalid @enderror"
                                    />  <label class="form-check-label" for="drain_line"> না </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="ceptic_tank" class="col-sm-3 control-label">প্রস্তাবিত ইমারতের ক্ষেত্রে সেপ্টিক ট্যাঙ্কের ব্যবস্থা আছে কিনা
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <div class="form-check form-check-inline">
                                    <input style=" width: 15px " type="radio" name="ceptic_tank"
                                           id="ceptic_tank"
                                           value="হ্যাঁ" class="form-check-input  @error('ceptic_tank')is-invalid @enderror"
                                    /><label class="form-check-label" for="ceptic_tank"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="ceptic_tank"
                                           id="ceptic_tank"
                                           value="না" class="form-check-input  @error('ceptic_tank')is-invalid @enderror"
                                    />  <label class="form-check-label" for="ceptic_tank"> না </label>
                                </div>

                                @error('ceptic_tank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="emarot_construction_start" class="col-sm-6 control-label">প্রস্তাবিত ইমারত নির্মান /পুকুর খনন /পাহাড় কর্তন বা ধ্বংস সাধনের কাজ কখন শুরু হবে
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="emarot_construction_start" id="emarot_construction_start" value="{{ old('emarot_construction_start') }}" class="form-control @error('emarot_construction_start')is-invalid @enderror"
                                       data-parsley-maxlength="100" placeholder="কখন শুরু হবে"
                                       data-parsley-trigger="keyup"/>

                                @error('emarot_construction_start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="emarot_construction_destroy_purpose" class="col-sm-6 control-label">প্রস্তাবিত
                                ইমারত
                                নির্মান /পুকুর খনন /পাহাড় কর্তন বা ধ্বংস সাধনের উদ্দেশ্য
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="emarot_construction_destroy_purpose" id="emarot_construction_destroy_purpose" value="{{ old('emarot_construction_destroy_purpose') }}" class="form-control @error('emarot_construction_destroy_purpose')is-invalid @enderror"
                                       data-parsley-maxlength="100" placeholder="ধ্বংস সাধনের উদ্দেশ্য"
                                       data-parsley-trigger="keyup"/>

                                @error('emarot_construction_destroy_purpose')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="emarot_construction_notice_jari" class="col-sm-6 control-label">অথরাইজড
                                অফিসারের অনুমোদন ব্যতিত আবেদনকারী পূর্বে কোন ইমারত ইমারত নির্মান /পুকুর খনন /পাহাড় কর্তন বা ধ্বংস সাধন করিয়া থাকলে তজ্জন্য তাহার বিরুদ্বে Building Construction Act 1952 (E.B.Act II of 1953) এর Section 12 এর অধিনে কোন নোটিশজারি করা হইয়াছে কিনা
                            </label>
                            <div class="col-sm-6 bt-flabels__wrapper">
                                <input type="text" name="emarot_construction_notice_jari" id="emarot_construction_notice_jari" value="{{ old('emarot_construction_notice_jari') }}" class="form-control @error('emarot_construction_notice_jari')is-invalid @enderror"
                                       data-parsley-maxlength="100" placeholder="কোন নোটিশজারি করা হইয়াছে কিনা"
                                       data-parsley-trigger="keyup"/>

                                @error('emarot_construction_notice_jari')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <span style="border-bottom: 3px solid black">প্রস্তাবিত ইমারত নির্মান /পুকুর খনন /পাহাড় কর্তন বা ধ্বংস সাধনের স্থান হইতে নিকটবর্তী</span>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="road_distance" class="col-sm-3 control-label">রাস্তার দূরত্ব
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_distance" id="road_distance" value="{{ old
                                ('road_distance') }}" class="form-control @error('road_distance')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('road_distance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="drain_distance" class="col-sm-3 control-label">পয়ঃনালার দুরত্ব
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="drain_distance" id="drain_distance" value="{{ old
                                ('drain_distance') }}" class="form-control @error('drain_distance')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('drain_distance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="emarot_distance" class="col-sm-3 control-label">
                                ইমারতের দূরত্ব
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="emarot_distance" id="emarot_distance"
                                       value="{{ old('emarot_distance') }}"
                                       class="form-control @error('emarot_distance')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('emarot_distance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="electricity_distance" class="col-sm-3 control-label">বিদ্যুৎ লাইনের
                                দুরত্ব</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="electricity_distance" id="electricity_distance"
                                       value="{{ old('electricity_distance') }}" class="form-control @error('electricity_distance')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('electricity_distance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="gass_distance" class="col-sm-3 control-label">
                                গ্যাস সরবরাহ লাইনের দূরত্ব
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="gass_distance" id="gass_distance"
                                       value="{{ old('gass_distance') }}"
                                       class="form-control @error('gass_distance')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                />
                                @error('gass_distance')
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
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল<span class="text-danger" >*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
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
                                <input type="text" name="email" id="email" value="{{ old('email') }}"
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
                </div>


                <div class="row" style="margin-bottom: 100px;">
                    <div class="offset-6 col-sm-6 button-style">
                        <input type="hidden" name="union_id" value="{{ Auth::user()->union_id }}" id="union-id">
                        <input type="hidden" value="95" id="app-type">

                        <input type="hidden" value="" name="pin" id="pin">
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


    <script src="{{ asset('js/custom_address.js') }}"></script>
    {{-- preselect addredd blade include --}}
    {{-- @include('layouts.preselect_address') --}}


    <script>

        //===datepicker===//
        $('#rant_last_date, #reg_date').datepicker({
            language: 'en',
            autoClose: true,
            dateFormat: 'yy-mm-dd',
        });

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



