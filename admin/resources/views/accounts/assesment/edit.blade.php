@extends('layouts.app')
@section('head')

    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title text-center">
                    <h4 class="text-center application_head"> এসেসমেন্ট আবেদন</h4>
                </div>
                
            </div>
        </div>
    </div>

   

    <section>
        <div class="container">
            <form action="{{ route('assesment_update') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>

                @csrf

                <div class="row" style="">
                    <div class="col-md-8">
                        <div class="input-group mt-5">
                            <input type="search" class="form-control" placeholder="মোবাইল/এন.আই.ডি.নং/জন্ম নিবন্ধন নং/পাসপোর্ট নং/পিন নং দিন ইংরেজিতে">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">
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
                            <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_bn" id="name_bn"  value="{{ old('name_bn')? old('name_bn') : $assesment->name_bn }}" class="form-control @error('name_bn') is-invalid @enderror" autocomplete="name_bn" autofocus placeholder="পূর্ণ নাম" data-parsley-trigger="keyup" data-parsley-required />
                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                @error('name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile')? old('mobile') : $assesment->mobile }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
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
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="nid" id="nid" value="{{ old('nid')? old('nid') : $assesment->nid }}" class="form-control @error('nid') is-invalid @enderror" data-parsley-maxlength="17" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_id" value="{{ old('birth_id')? old('birth_id') : $assesment->birth_id }}" id="birth_id" class="form-control @error('birth_id') is-invalid @enderror" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
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
                                <input type="text" name="passport_no" value="{{ old('passport_no')? old('passport_no') : $assesment->passport_no }}" id="passport_no" class="form-control @error('passport_no') is-invalid @enderror" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম  তারিখ <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date" value="{{ old('birth_date')? old('birth_date') : $assesment->birth_date }}" id="birth_date" class="form-control date @error('birth_date') is-invalid @enderror" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-trigger="keyup" data-parsley-required  placeholder="0000-00-00" />
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
                           
                            <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn')? old('father_name_bn') : $assesment->father_name_bn }}" class="form-control @error('father_name_bn') is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" data-parsley-required />
                                <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                @error('father_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                             <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ old('mother_name_bn')? old('mother_name_bn') : $assesment->mother_name_bn }}" class="form-control @error('mother_name_bn') is-invalid @enderror" autocomplete="mother_name_bn" autofocus placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />
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
                                <input type="text" name="occupation" id="occupation" value="{{ old('occupation')? old('occupation') : $assesment->occupation }}" class="form-control @error('occupation') is-invalid @enderror" autocomplete="occupation" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                                <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="resident" id='resident' selected="selected" class="form-control @error('resident')is-invalid @enderror" data-parsley-required >
                                    <option value='' {{ (old('resident')? old('resident') : $assesment->resident == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('resident')? old('resident') : $assesment->resident == 1) ? 'selected="selected"' : '' }}>অস্থায়ী</option>
                                    <option value='2' {{ (old('resident')? old('resident') : $assesment->resident == 2) ? 'selected="selected"' : '' }}>স্থায়ী</option>
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
                                <input type="text" name="educational_qualification" id="educational_qualification" value="{{ old('educational_qualification')? old('educational_qualification') : $assesment->educational_qualification }}" class="form-control @error('educational_qualification')is-invalid @enderror" autofocus autocomplete="educational_qualification" data-parsley-maxlength="100" data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন" />
                                <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('educational_qualification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="religion" id="religion" selected="selected" class="form-control @error('religion')is-invalid @enderror" data-parsley-required >
                                    <option value='' {{ (old('religion')? old('religion') : $assesment->religion == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('religion')? old('religion') : $assesment->religion == 1) ? 'selected="selected"' : '' }}>ইসলাম</option>
                                    <option value='2' {{ (old('religion')? old('religion') : $assesment->religion == 2) ? 'selected="selected"' : '' }}>হিন্দু</option>
                                    <option value='3' {{ (old('religion')? old('religion') : $assesment->religion == 3) ? 'selected="selected"' : '' }}>বৌদ্ধ ধর্ম</option>
                                    <option value='4' {{ (old('religion')? old('religion') : $assesment->religion == 4) ? 'selected="selected"' : '' }}>খ্রিস্ট ধর্ম</option>
                                    <option value='5' {{ (old('religion')? old('religion') : $assesment->religion == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
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
                            <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                            <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                 <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $assesment->gender) == 1) ? 'checked' : '' }} name="gender" value="1" />পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $assesment->gender) == 2) ? 'checked' : '' }} name="gender" value="2" />মহিলা</label>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="marital_status" id="marital_status" selected="selected" class="form-control @error('marital_status')is-invalid @enderror" data-parsley-required >
                                    <option value="" {{ (old('marital_status')? old('marital_status') : $assesment->marital_status == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('marital_status')? old('marital_status') : $assesment->marital_status == 1) ? 'selected="selected"' : '' }}>অবিবাহিত</option>
                                    <option value='2' {{ (old('marital_status')? old('marital_status') : $assesment->marital_status == 2) ? 'selected="selected"' : '' }}>বিবাহিত</option>
                                    <option value='3' {{ (old('marital_status')? old('marital_status') : $assesment->marital_status == 3) ? 'selected="selected"' : '' }}>তালাক প্রাপ্ত</option>
                                    <option value='4' {{ (old('marital_status')? old('marital_status') : $assesment->marital_status == 4) ? 'selected="selected"' : '' }}>বিধবা</option>
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

                    <div class="col-md-12" id="relation">
                        @if($assesment->marital_status == 2 && $assesment->gender == 2)
                            <div class="row form-group">
                                <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper">
                                    <input type="text" name="husband_name_en" id="husband_name_en" value="{{ old('husband_name_en')? old('husband_name_en') : $assesment->husband_name_en }}" class="form-control @error('husband_name_en') is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Husband" />
                                    <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                    @error('husband_name_en')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামীর নাম (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper">
                                    <input type="text" name="husband_name_bn" id="husband_name_bn" value="{{ old('husband_name_bn')? old('husband_name_bn') : $assesment->husband_name_bn }}" class="form-control @error('husband_name_bn') is-invalid @enderror" placeholder="স্বামীর নাম" data-parsley-required />
                                    <span class="bt-flabels__error-desc">স্বামীর নাম দিন বাংলায়....</span>

                                    @error('husband_name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @elseif($assesment->marital_status == 2 && $assesment->gender == 1)
                            <div class="row form-group">
                                <label for="wife_name_en" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                                <div class="col-sm-3 bt-flabels__wrapper">
                                    <input type="text" name="wife_name_en" value="{{ old('wife_name_en')? old('wife_name_en') : $assesment->wife_name_en }}" id="wife_name_en" class="form-control @error('wife_name_en') is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Wife" />
                                    <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                    @error('wife_name_en')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper">
                                    <input type="text" name="wife_name_bn" id="wife_name_bn" value="{{ old('wife_name_bn')? old('wife_name_bn') : $assesment->wife_name_bn }}" class="form-control @error('wife_name_bn') is-invalid @enderror" placeholder="স্ত্রীর নাম" data-parsley-required />
                                    <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                                    @error('wife_name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>

                </div>


                {{-- <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            বর্তমান ঠিকানা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn') }}" class="form-control @error('present_village_bn')is-invalid @enderror" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                @error('present_village_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_rbs_bn" id="present_rbs_bn" value="{{ old('present_rbs_bn') }}" class="form-control @error('present_rbs_bn')is-invalid @enderror" placeholder="" autocomplete="present_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required />
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
                                <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no') }}" class="form-control @error('present_holding_no')is-invalid @enderror" autocomplete="present_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required />
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no') }}" class="form-control @error('present_ward_no')is-invalid @enderror" autocomplete="present_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('present_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_upazila', 'present_post_office_append', 'present_postoffice_id', 'present_postoffice', 6 )" name="present_upazila_id" id="present_upazila_id" class="form-control @error('present_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('present_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')" name="present_postoffice_id" id="present_postoffice_id" class="form-control @error('present_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('present_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>


                </div> --}}

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            স্থায়ী  ঠিকানা
                        </h4>
                        {{-- <p style="font-size:15px; font-weight:normal;padding-top:10px;"> <input type="checkbox" name="permanentBtn" id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন</p> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                          
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn')? old('permanent_village_bn') : $assesment->permanent_village_bn }}" class="form-control @error('permanent_village_bn')is-invalid @enderror" autocomplete="permanent_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                @error('permanent_village_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                             <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_rbs_bn" id="permanent_rbs_bn"value="{{ old('permanent_rbs_bn')? old('permanent_rbs_bn') : $assesment->permanent_rbs_bn }}" class="form-control @error('permanent_rbs_bn')is-invalid @enderror" placeholder="" autocomplete="permanent_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no')? old('permanent_holding_no') : $assesment->permanent_holding_no }}" class="form-control @error('permanent_holding_no')is-invalid @enderror" autocomplete="permanent_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no')? old('permanent_ward_no') : $assesment->permanent_ward_no }}" class="form-control @error('permanent_ward_no')is-invalid @enderror" autocomplete="permanent_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                    <option value="{{ $assesment->permanent_district_id }}" selected="selected">{{ $assesment->permanent_district_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('permanent_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )" name="permanent_upazila_id" id="permanent_upazila_id" class="form-control @error('permanent_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $assesment->permanent_upazila_id }}" selected="selected">{{ $assesment->permanent_upazila_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('permanent_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')" name="permanent_postoffice_id" id="permanent_postoffice_id" class="form-control @error('permanent_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $assesment->permanent_postoffice_id }}" selected="selected">{{ $assesment->permanent_postoffice_name_en }}</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('permanent_postoffice_id')
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
                            এসেসমেন্ট তথ্য<hr>
                        </h4>

                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            
                            <label for="Male" class="col-sm-3 control-label">পুরুষ </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="male" id="male" value="{{ old('male')? old('male') : $assesment->total_male }}" class="form-control @error('male')is-invalid @enderror" placeholder="পুরষের সংখ্যা" autocomplete="male" autofocus data-parsley-type="male" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে পুরুষের সংখ্যা দিন....</span>

                                @error('male')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Female" class="col-sm-3 control-label">মহিলা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="female" id="female" value="{{ old('female')? old('female') : $assesment->total_female }}" class="form-control @error('female')is-invalid @enderror" placeholder="মহিলার সংখ্যা" autocomplete="female" autofocus data-parsley-type="female" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে মহিলার সংখ্যা দিন....</span>

                                @error('male')
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
                            
                            <label for="ripe_house" class="col-sm-3 control-label">পাকা বাড়ী </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="ripe_house" id="ripe_house" value="{{ old('ripe_house')? old('ripe_house') : $assesment->ripe_house }}" class="form-control" placeholder="পাকা বাড়ী সংখ্যা" autocomplete="ripe_house" autofocus data-parsley-type="ripe_house" data-parsley-trigger="keyup" />
                            </div>
                            <label for="semi_ripe_house" class="col-sm-3 control-label">আধাপাকা বাড়ী</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="semi_ripe_house" id="semi_ripe_house" value="{{ old('semi_ripe_house')? old('semi_ripe_house') : $assesment->semi_ripe_house }}" class="form-control" placeholder="আধাপাকা বাড়ী সংখ্যা" autocomplete="semi_ripe_house" autofocus data-parsley-type="semi_ripe_house" data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            
                            <label for="raw house" class="col-sm-3 control-label">কাচা বাড়ী </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="raw_house" id="raw_house" value="{{ old('raw_house')? old('raw_house') : $assesment->raw_house }}" class="form-control" placeholder="কাচা বাড়ী সংখ্যা" autocomplete="raw_house" autofocus data-parsley-type="raw_house" data-parsley-trigger="keyup" />
                            </div>

                            <label for="probable_rate" class="col-sm-3 control-label">আনুমানিক মূল্য (৭.৫%)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="probable_rate" id="probable_rate" value="{{ old('probable_rate')? old('probable_rate') : $assesment->probable_rate }}" class="form-control" placeholder="00" autocomplete="probable_rate" autofocus data-parsley-type="probable_rate" data-parsley-trigger="keyup" />
                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            
                            <label for="HalsonTax" class="col-sm-3 control-label">হালসনের কর </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="halson_tax" id="halson_tax" value="{{ old('halson_tax')? old('halson_tax') : $assesment->halson_tax }}" class="form-control @error('halson_tax')is-invalid @enderror" placeholder="00" autocomplete="halson_tax" autofocus data-parsley-type="halson_tax" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে হালসনের কর....</span>

                                @error('halson_tax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="pin" value="{{ $assesment->pin }}">


                <div class="row" style="margin-bottom: 100px;">
                    <div class="offset-6 col-sm-6 button-style">

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

    
@endsection



