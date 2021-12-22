@extends('layouts.app')
@section('head')
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')

    <section>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title text-center">
                        <h4 class="text-center application_head">ওয়ারিশ সনদের আবেদন</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('warish_store') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-8 offset-2">
                        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4><hr/>
                        <ul>
                            <li><i class="icon-copy ion-disc"></i> বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন ।</li>
                            <li><i class="icon-copy ion-disc"></i> ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন ।</li>
                            <li><i class="icon-copy ion-disc"></i> আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে আপনার
                                মোবাইল অথবা ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা
                                পিন নং দিয়ে সার্চ করুন!</li>
                        </ul>

                        <div class="input-group mt-5">
                            <input type="search" class="form-control" id="search-data" placeholder="মোবাইল/এন.আই.ডি.নং/জন্ম নিবন্ধন নং/পাসপোর্ট নং/পিন নং দিন ইংরেজিতে">
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
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="form-control @error('name_en')is-invalid @enderror" placeholder="Full Name" autocomplete="name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                @error('name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}" class="form-control @error('name_bn')is-invalid @enderror" placeholder="পূর্ণ নাম" autocomplete="name_bn" autofocus data-parsley-trigger="keyup" data-parsley-required />
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
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)  </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="nid_id_div">
                                <input type="text" name="nid" id="nid" value="{{ old('nid') }}" class="form-control @error('nid')is-invalid @enderror" autocomplete="nid" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-no" class="col-sm-3 control-label">মৃত্যু নিবন্ধন নং (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper" id="birth_id_div">
                                <input type="text" name="birth_id" value="{{ old('birth_id') }}" id="birth_id" class="form-control @error('birth_id')is-invalid @enderror" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
                                <span class="bt-flabels__error-desc">মৃত্যু নিবন্ধন নং দিন ইংরেজিতে....</span>

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
                            <div class="col-sm-3 bt-flabels__wrapper" id="passport_no_div">
                                <input type="text" name="passport_no" value="{{ old('passport_no') }}" id="passport_no" class="form-control @error('passport_no')is-invalid @enderror" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date" value="{{ old('birth_date') }}" id="birth_date" placeholder="yyyy-mm-dd" class="form-control date @error('birth_date')is-invalid @enderror" autocomplete="birth_date"  autofocus data-parsley-type="date"  />

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
                        <div class="row form-group justify-content-end">
                            <label for="death_date" class="col-sm-3 control-label">মৃত্যু তারিখ <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="death_date" value="{{ old('death_date') }}" id="death_date" placeholder="yyyy-mm-dd" class="form-control date @error('death_date')is-invalid @enderror" autocomplete="death_date"  autofocus data-parsley-type="date" />

                                <span class="bt-flabels__error-desc">মৃত্যু তারিখ দিন....</span>

                                @error('death_date')
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
                                <input type="hidden" name="father_name_en" id="father-name-en" value="" />
                                <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en') }}" class="form-control @error('father_name_en')is-invalid @enderror" autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="Father's Name" />
                                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                @error('father_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="father_name_bn" class="col-sm-3 control-label">পিতার নাম (বাংলায়) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="hidden" name="father_name_bn" id="father-name-bn" value="" />
                                <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn') }}" class="form-control @error('father_name_bn')is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" />
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
                            <label for="mother_name_en" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="hidden" name="mother_name_en" id="mother-name-en" value="" />
                                <input type="text" name="mother_name_en" id="mother_name_en" value="{{ old('mother_name_en') }}" autocomplete="mother_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" class="form-control @error('mother_name_en')is-invalid @enderror" placeholder="Mother's Name" />
                                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                @error('mother_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="hidden" name="mother_name_bn" id="mother-name-bn" value="" />
                                <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ old('mother_name_bn') }}" class="form-control @error('mother_name_bn')is-invalid @enderror" autocomplete="mother_name_bn" autofocus placeholder="মাতার নাম" data-parsley-trigger="keyup"  />
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

                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="profession" class="col-sm-3 control-label">পেশা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="occupation" id="occupation" value="{{ old('occupation') }}" class="form-control @error('occupation')is-invaliid @enderror" autocomplete="occupation" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                                <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Resident" class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="resident" id='resident' class="form-control @error('resident')is-invalid @enderror" selected="selected" data-parsley-required >
                                    <option value='' {{ (old('resident') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('resident') == 1) ? 'selected="selected"' : '' }}>অস্থায়ী</option>
                                    <option value='2' {{ (old('resident') == 2) ? 'selected="selected"' : '' }}>স্থায়ী</option>
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

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Education-qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="educational_qualification" id="educational_qualification" value="{{ old('educational_qualification') }}" class="form-control @error('educational_qualification')is-invalid @enderror" autocomplete="educational_qualification" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন" />
                                <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('educational_qualification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Religion" class="col-sm-3 control-label">ধর্ম <span>*</span></label>
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
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="father-alive" class="col-sm-3 control-label">পিতা জীবিত কিনা</label>
                            <div class="col-sm-3 bt-flabels__wrapper @error('is_father_alive')is-invalid @enderror @error('father_age')is-invalid @enderror" id="fatheragenull">
                                <label class="radio-inline flive"><input type="radio" name="is_father_alive" value="1" {{ (old('is_father_alive') == 1) ? 'checked' : '' }}>হ্যাঁ </label>
                                <label class="radio-inline flive"><input type="radio" name="is_father_alive" value="0" {{ (old('is_father_alive') == 0) ? 'checked' : '' }}>না</label>
                                <input type="text" name="father_age" id="father_age" class="form-control" value="{{ old('father_age') }}" {{ (old('is_father_alive') == 1)? 'style=display:block;' : 'style=display:none;' }} placeholder="পিতার বয়স" data-parsley-type="number" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে পিতার বয়স দিন....</span>

                                @error('father_age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @error('is_father_alive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="mother-alive" class="col-sm-3 control-label">মাতা জীবিত কিনা</label>
                            <div class="col-sm-3 bt-flabels__wrapper @error('is_mother_alive')is-invalid @enderror @error('mother_age')is-invalid @enderror" id="motheragenull">
                                <label class="radio-inline mlive"><input type="radio" name="is_mother_alive" value="1" {{ (old('is_mother_alive') == 1) ? 'checked' : '' }}>হ্যাঁ </label>
                                <label class="radio-inline mlive"><input type="radio" name="is_mother_alive" value="0" {{ (old('is_mother_alive') == 0) ? 'checked' : '' }}>না</label>
                                <input type="text" name="mother_age" id="mother_age" class="form-control" placeholder="মাতার বয়স" value="{{ old('mother_age') }}" {{ (old('is_mother_alive') == 1)? 'style=display:block;' : 'style=display:none;' }} data-parsley-type="number" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে মাতার বয়স দিন....</span>

                                @error('is_mother_alive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @error('mother_age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="genderErr">

                        <div class="row form-group">
                            <label for="Gender" class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                            <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                <label class="radio-inline gender"><input type="radio" id="gender_1" name="gender" value="1" {{ (old('gender') == 1) ? 'checked' : '' }} />পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_2" name="gender" value="2" {{ (old('gender') == 2) ? 'checked' : '' }} />মহিলা</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_3" name="gender" value="3" {{ (old('gender') == 3) ? 'checked' : '' }} />অন্যান্য</label>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="marital_status" id="marital_status" class="form-control @error('marital_status')is-invald @enderror" selected="selected" data-parsley-required >
                                    <option value="" {{ (old('marital_status') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('marital_status') == 1) ? 'selected="selected"' : '' }}>অবিবাহিত</option>
                                    <option value='2' {{ (old('marital_status') == 2) ? 'selected="selected"' : '' }}>বিবাহিত</option>
                                    <option value='3' {{ (old('marital_status') == 3) ? 'selected="selected"' : '' }}>তালাক প্রাপ্ত</option>
                                    <option value='4' {{ (old('marital_status') == 4) ? 'selected="selected"' : '' }}>বিধবা</option>
                                    <option value='5' {{ (old('marital_status') == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
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

                    <div class="col-md-12" id="wife" {{ (old('wife_name_en') != null || old('wife_name_bn') != null)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="wife_name_en" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_en" id="wife_name_en" class="form-control @error('wife_name_en')is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Wife" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                @error('wife_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_bn" id="wife_name_bn" class="form-control @error('wife_name_bn')is-invalid @enderror" placeholder="স্ত্রীর নাম" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                                @error('wife_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="husband" {{ (old('husband_name_en') != null || old('husband_name_bn') != null)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_en" id="husband_name_en" class="form-control @error('husband_name_en')is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Husband" />
                                <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                @error('husband_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_bn" id="husband_name_bn" class="form-control @error('husband_name_bn')is-invalid @enderror" placeholder="স্বামী নাম" />
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

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            বর্তমান ঠিকানা<hr>
                        </h4>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en') }}" class="form-control @error('present_village_en')is-invalid @enderror" autocomplete="present_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('present_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn') }}" class="form-control @error('present_village_bn')is-invalid @enderror" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                            <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_rbs_en" id="present_rbs_en" value="{{ old('present_rbs_en') }}" class="form-control @error('present_rbs_en')is-invalid @enderror" placeholder="" autocomplete="present_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('present_rbs_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_rbs_bn" id="present_rbs_bn" value="{{ old('present_rbs_bn') }}" class="form-control @error('present_rbs_bn')is-invalid @enderror" placeholder="" autocomplete="present_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                @error('present_rbs_bn')
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
                                <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no') }}" class="form-control @error('present_holding_no')is-invalid @enderror" autocomplete="present_holding_no" autofocus  data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no') }}" class="form-control @error('present_ward_no')is-invalid @enderror" autocomplete="present_ward_no" autofocus  data-parsley-trigger="keyup" data-parsley-required/>
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
                            <label for="present_district_id" class="col-sm-3 control-label">জেলা  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )" class="custom-select2 form-control @error('present_district_id')is-invalid @enderror" id="present_district_id" name="present_district_id" style="width: 100%; height: 38px;" data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                </select> --}}

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
                                <input type="text" disabled id="present_district" value="জেলা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'present_upazila', 'present_post_office_append', 'present_postoffice_id', 'present_postoffice', 6 )" name="present_upazila_id" id="present_upazila_id" class="custom-select2 form-control @error('present_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                                </select> --}}

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
                                <input type="text" disabled id="present_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'present_postoffice')" name="present_postoffice_id" id="present_postoffice_id" class="custom-select2 form-control @error('present_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                </select> --}}

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
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_en" id="permanent_village_en" value="{{ old('permanent_village_en') }}" class="form-control @error('permanent_village_en')is-invalid @enderror" autocomplete="permanent_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('permanent_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn') }}" class="form-control @error('permanent_village_bn')is-invalid @enderror" autocomplete="permanent_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                            <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_rbs_en" id="permanent_rbs_en" value="{{ old('permanent_rbs_en') }}" class="form-control @error('permanent_rbs_en')is-invalid @enderror" placeholder="" autocomplete="permanent_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('permanent_rbs_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_rbs_bn" id="permanent_rbs_bn" value="{{ old('permanent_rbs_bn') }}" class="form-control @error('permanent_rbs_bn')is-invalid @enderror" placeholder="" autocomplete="permanent_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                @error('permanent_rbs_bn')
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no') }}" class="form-control @error('permanent_holding_no')is-invalid @enderror" autocomplete="permanent_holding_no" autofocus  data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no') }}" class="form-control @error('permanent_ward_no')is-invalid @enderror" autocomplete="permanent_ward_no" autofocus data-parsley-trigger="keyup" data-parsley-required/>
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
                            <label for="permanent_district_id" class="col-sm-3 control-label">জেলা  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )" name="permanent_district_id" id="permanent_district_id" class="custom-select2 form-control @error('permanent_district_id')is-invalid @enderror" style="width: 100%; height: 38px;" data-parsley-required >
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                </select> --}}

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
                                <input type="text" disabled id="permanent_district" value="জেলা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_post_office_id', 'permanent_postoffice', 6 )" name="permanent_upazila_id" id="permanent_upazila_id" class="custom-select2 form-control @error('permanent_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                </select> --}}

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
                                <input type="text" disabled id="permanent_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস  <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'permanent_postoffice')" name="permanent_postoffice_id" id="permanent_postoffice_id" class="custom-select2 form-control @error('permanent_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                </select> --}}

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
                            <label for="applicant_mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="applicant_mobile" id="applicant_mobile" value="{{ old('applicant_mobile') }}" class="form-control @error('applicant_mobile')is-invalid @enderror" autocomplete="applicant_mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('applicant_mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="applicant_email" class="col-sm-3 control-label">ইমেল </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="email" name="applicant_email" id="applicant_email" value="{{ old('applicant_email') }}" class="form-control @error('applicant_email')is-invalid @enderror" autocomplete="applicant_email" autofocus placeholder="example@gmail.com" data-parsley-type="email" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                @error('applicant_email')
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
                            <label for="applicant_name_en" class="col-sm-3 control-label small-font">আবেদনকারীর নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="applicant_name_en" id="applicant_name_en" value="{{ old('applicant_name_en') }}" class="form-control @error('applicant_name_en')is-invalid @enderror" autocomplete="applicant_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">আবেদনকারীর নাম দিন ইংরেজিতে....</span>

                                @error('applicant_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="applicant_name_bn" class="col-sm-3 control-label small-font">আবেদনকারীর নাম (বাংলায়) <sup>*</sup></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="applicant_name_bn" id="applicant_name_bn" value="{{ old('applicant_name_bn') }}" class="form-control @error('applicant_name_bn')is-invalid @enderror" autocomplete="applicant_name_bn" autofocus data-parsley-required />
                                <span class="bt-flabels__error-desc">আবেদনকারীর নাম দিন বাংলায়....</span>

                                @error('applicant_name_bn')
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
                            <label for="applicant_father_name_en" class="col-sm-3 control-label small-font"> আবেদনকারীর পিতা/স্বামীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="applicant_father_name_en" id="applicant_father_name_en" value="{{ old('applicant_father_name_en') }}" class="form-control @error('applicant_father_name_en')is-invalid @enderror" autocomplete="applicant_father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">আবেদনকারীর পিতা/স্বামীর নাম দিন ইংরেজিতে....</span>

                                @error('applicant_father_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="applicant_father_name_bn" class="col-sm-3 control-label small-font">আবেদনকারীর পিতা/স্বামীর নাম (বাংলায়)<sup>*</sup></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="applicant_father_name_bn" id="applicant_father_name_bn" value="{{ old('applicant_father_name_bn') }}" class="form-control @error('applicant_father_name_bn')is-invalid @enderror" autocomplete="applicant_father_name_bn" autofocus data-parsley-required />
                                <span class="bt-flabels__error-desc">আবেদনকারীর পিতা/স্বামীর নাম দিন বাংলায়....</span>

                                @error('applicant_father_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Designation" class="col-sm-3 control-label">মন্তব্য দিন(ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <textarea name="comment_en"
                                          class="form-control @error('comment_en')is-invalid @enderror" rows="5"
                                          id="comment_en"
                                          placeholder="Examples: Freedom fighter children, widows, tribals ..... etc."
                                          data-parsley-maxlength="500"
                                          data-parsley-trigger="keyup">{{ old('comment_en') }}</textarea>
                                <span class="bt-flabels__error-desc">মন্তব্য ৫০০ অক্ষরের নিচে লিখুন ইংরেজিতে....</span>

                                @error('comment_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Designation" class="col-sm-3 control-label">মন্তব্য দিন (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <textarea name="comment_bn"
                                          class="form-control @error('comment_bn')is-invalid @enderror" rows="5"
                                          id="comment_bn"
                                          placeholder=" উদাহরন: মুক্তিযোদ্ধা সন্তান, বিধবা, উপজাতি .....ইত্যাদি "
                                          data-parsley-maxlength="500"
                                          data-parsley-trigger="keyup">{{ old('comment_bn') }}</textarea>
                                <span class="bt-flabels__error-desc">মন্তব্য ৫০০ অক্ষরের নিচে লিখুন বাংলায়....</span>

                                @error('comment_bn')
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
                            ওয়ারিশগনের তালিকা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <div class="col-sm-1">
                                <label> নং</label>
                            </div>
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
                            <div class="col-sm-3">
                                <label>পরিচয় পত্র নং</label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <div class="col-sm-1 bt-flabels__wrapper">

                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="warish_name_bn[]" id="warish_name_bn" class="form-control @error('warish_name_bn.0')is-invalid @enderror" placeholder="নাম বাংলায়"   />
                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                @error('warish_name_bn.0')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="warish_name_en[]" id="warish_name_en" class="form-control @error('warish_name_en.0')is-invalid @enderror" placeholder="নাম ইংরেজিতে"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                @error('warish_name_en.0')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="relation_bn[]" id="relation_bn" class="form-control @error('relation_bn.0')is-invalid @enderror"  placeholder="সম্পর্ক বাংলায়" />
                                <span class="bt-flabels__error-desc">সম্পর্ক দিন বাংলায়....</span>

                                @error('relation_bn.0')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="relation_en[]" id="relation_en" class="form-control @error('relation_en.0')is-invalid @enderror" placeholder="সম্পর্ক ইংরেজিতে"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">সম্পর্ক দিন ইংরেজিতে....</span>

                                @error('relation_en.0')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="member_nid[]" id="member_nid" placeholder="পরিচয় পত্র নং দিন ইংরেজিতে" class="form-control @error('member_nid.0')is-invalid @enderror"  data-parsley-trigger="keyup"  />
                                <span class="bt-flabels__error-desc">পরিচয় পত্র নং দিন ইংরেজিতে....</span>

                                @error('member_nid.0')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-1 bt-flabels__wrapper">
                                <button type="button" id="woyarish" class="btn btn-info">নতুন ওয়ারিশ</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="emptyError"></div>
                </div>

                <div class="row" id="addWoyarish">

                </div>

                <div class="row" style="margin-bottom: 100px;">
                    <div class="offset-4 col-sm-3 button-style">
                        <input type="hidden" name="union_id" value="{{ Auth::user()->union_id }}" id="union-id">
                        <input type="hidden" value="17" id="app-type">

                        <input type="hidden" value="" name="pin" id="pin">
                        <button type="submit" id="submit_button" class="btn btn-primary">দাখিল করুন</button>
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

    <script>
        function removeRow(y) {
            $('#dataRow_'+y).remove();
        }
    </script>

    {{-- preselect addredd blade include --}}
    {{-- @include('layouts.preselect_address') --}}


@endsection
