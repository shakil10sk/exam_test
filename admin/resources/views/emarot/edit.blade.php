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
                        <h4 class="text-center application_head">ইমারত তথ্য সংশোধন</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="{{ route('emarot_update') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="Name-english" class="col-sm-3 control-label"> নাম (ইংরেজিতে)</label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en')? old('name_en') : $emarot->name_en }}" class="form-control @error('name_en') is-invalid @enderror" placeholder="Full Name" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                        <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়)  <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn')? old('name_bn') : $emarot->name_bn }}" class="form-control @error('name_bn') is-invalid @enderror" placeholder="পূর্ণ নাম" data-parsley-trigger="keyup" data-parsley-required />
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
                                    <label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="mother_name_en" id="mother_name_en" value="{{ old('mother_name_en')? old('mother_name_en') : $emarot->mother_name_en }}" class="form-control @error('mother_name_en') is-invalid @enderror" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" class="form-control" placeholder="Mother's Name" />
                                        <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                        @error('mother_name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ old('mother_name_bn')? old('mother_name_bn') : $emarot->mother_name_bn }}" class="form-control @error('mother_name_bn') is-invalid @enderror" placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />
                                        <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                                        @error('mother_name_bn')
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
                                        <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en')? old('father_name_en') : $emarot->father_name_en }}" class="form-control @error('father_name_en') is-invalid @enderror" autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="Father's Name" />
                                        <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                        @error('father_name_en')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn')? old('father_name_bn') : $emarot->father_name_bn }}" class="form-control @error('father_name_bn') is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" data-parsley-required />
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
                                    <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <select name="religion" id="religion" selected="selected"
                                                class="form-control @error('religion')is-invalid @enderror"
                                                data-parsley-required>
                                            <option
                                                value='' {{ (old('religion')? old('religion') : $emarot->religion == '') ? 'selected="selected"' : '' }}>
                                                চিহ্নিত করুন
                                            </option>
                                            <option
                                                value='1' {{ (old('religion')? old('religion') : $emarot->religion == 1) ? 'selected="selected"' : '' }}>
                                                ইসলাম
                                            </option>
                                            <option
                                                value='2' {{ (old('religion')? old('religion') : $emarot->religion == 2) ? 'selected="selected"' : '' }}>
                                                হিন্দু
                                            </option>
                                            <option
                                                value='3' {{ (old('religion')? old('religion') : $emarot->religion == 3) ? 'selected="selected"' : '' }}>
                                                বৌদ্ধ ধর্ম
                                            </option>
                                            <option
                                                value='4' {{ (old('religion')? old('religion') : $emarot->religion == 4) ? 'selected="selected"' : '' }}>
                                                খ্রিস্ট ধর্ম
                                            </option>
                                            <option
                                                value='5' {{ (old('religion')? old('religion') : $emarot->religion == 5) ? 'selected="selected"' : '' }}>
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
                                                value='' {{ (old('resident')? old('resident') : $emarot->resident == '') ? 'selected="selected"' : '' }}>
                                                চিহ্নিত করুন
                                            </option>
                                            <option
                                                value='1' {{ (old('resident')? old('resident') : $emarot->resident == 1) ? 'selected="selected"' : '' }}>
                                                অস্থায়ী
                                            </option>
                                            <option
                                                value='2' {{ (old('resident')? old('resident') : $emarot->resident == 2) ? 'selected="selected"' : '' }}>
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

                            <div class="col-md-12">
                                <div class="col-md-12" id="genderErr">

                                    <div class="row form-group">
                                        <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                                        <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                            <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $emarot->gender) == 1) ? 'checked' : '' }} name="gender" value="1" />পুরুষ</label>
                                            <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $emarot->gender) == 2) ? 'checked' : '' }} name="gender" value="2" />মহিলা</label>
                                            <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $emarot->gender) == 3) ? 'checked' : '' }} name="gender" value="3" />অন্যান্য</label>

                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                        <label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক
                                            <span>*</span></label>
                                        <div class="col-sm-3 bt-flabels__wrapper">
                                            <select name="marital_status" id="marital_status" selected="selected"
                                                    class="form-control @error('marital_status')is-invalid @enderror"
                                                    data-parsley-required>
                                                <option value="" {{ (old('marital_status')? old('marital_status') : $emarot->marital_status == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                                <option value='1' {{ (old('marital_status')? old('marital_status') : $emarot->marital_status == 1) ? 'selected="selected"' : '' }}>অবিবাহিত</option>
                                                <option value='2' {{ (old('marital_status')? old('marital_status') : $emarot->marital_status == 2) ? 'selected="selected"' : '' }}>বিবাহিত</option>
                                                <option value='3' {{ (old('marital_status')? old('marital_status') : $emarot->marital_status == 3) ? 'selected="selected"' : '' }}>তালাক প্রাপ্ত</option>
                                                <option value='4' {{ (old('marital_status')? old('marital_status') : $emarot->marital_status == 4) ? 'selected="selected"' : '' }}>বিধবা</option>
                                                <option value='5' {{ (old('marital_status')? old('marital_status') : $emarot->marital_status == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
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
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cropzee-input">
                            <div class="image-overlay">
                                @if ($emarot->photo != NULL)
                                    <img src="{{ asset('images/application/'.$emarot->photo) }}" class="image-previewer image" data-cropzee="cropzee-input" />
                                @else
                                    <img src="{{ asset('images/application/default.jpg') }}" class="image-previewer image" data-cropzee="cropzee-input" />
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
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="nid" id="nid" value="{{ old('nid')? old('nid') : $emarot->nid }}" class="form-control @error('nid') is-invalid @enderror" data-parsley-maxlength="17" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_id" value="{{ old('birth_id')? old('birth_id') : $emarot->birth_id }}" id="birth_id" class="form-control @error('birth_id') is-invalid @enderror" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
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
                                <input type="text" name="passport_no" value="{{ old('passport_no')? old('passport_no') : $emarot->passport_no }}" id="passport_no" class="form-control @error('passport_no') is-invalid @enderror" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম  তারিখ <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date" value="{{ old('birth_date')? old('birth_date') : $emarot->birth_date }}" id="birth_date" class="form-control date @error('birth_date') is-invalid @enderror" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-trigger="keyup" data-parsley-required  placeholder="yyyy-mm-dd" />
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

                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-12" id="wife" {{ ($emarot->marital_status == 2 && $emarot->gender == 1)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="wife_name_en" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_en" id="wife_name_en" value="{{ old('wife_name_en')? old('wife_name_en') : $emarot->wife_name_en }}" class="form-control @error('wife_name_en')is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Wife" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                @error('wife_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_bn" id="wife_name_bn" value="{{ old('wife_name_bn')? old('wife_name_bn') : $emarot->wife_name_bn }}" class="form-control @error('wife_name_bn')is-invalid @enderror" placeholder="স্ত্রীর নাম" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                                @error('wife_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="husband" {{ ($emarot->marital_status == 2 && $emarot->gender == 2)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_en" id="husband_name_en" value="{{ old('husband_name_en')? old('husband_name_en') : $emarot->husband_name_en }}" class="form-control @error('husband_name_en')is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Husband" />
                                <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                @error('husband_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_bn" id="husband_name_bn" value="{{ old('husband_name_bn')? old('husband_name_bn') : $emarot->husband_name_bn }}" class="form-control @error('husband_name_bn')is-invalid @enderror" placeholder="স্বামী নাম" />
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
                                <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en')? old('present_village_en') : $emarot->present_village_en }}" class="form-control @error('present_village_en')is-invalid @enderror" autocomplete="present_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('present_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn')? old('present_village_bn') : $emarot->present_village_bn }}" class="form-control @error('present_village_bn')is-invalid @enderror" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                                <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no')? old('present_holding_no') : $emarot->present_holding_no }}" class="form-control @error('present_holding_no')is-invalid @enderror" autocomplete="present_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no')? old('present_ward_no') : $emarot->present_ward_no }}" class="form-control @error('present_ward_no')is-invalid @enderror" autocomplete="present_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                    <option value="{{ $emarot->present_district_id }}" selected="selected">{{ $emarot->present_district_name_en }}</option>
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
                                <input type="text" disabled id="present_district" value="{{ $emarot->present_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_upazila', 'present_postoffice_append', 'present_postoffice_id', 'present_postoffice', 6 )" name="present_upazila_id" id="present_upazila_id" class="custom-select2 form-control @error('present_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $emarot->present_upazila_id }}" selected="selected">{{ $emarot->present_upazila_name_en }}</option>
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
                                <input type="text" disabled id="present_upazila" value="{{ $emarot->present_upazila_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')" name="present_postoffice_id" id="present_postoffice_id" class="custom-select2 form-control @error('present_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $emarot->present_postoffice_id }}" selected="selected">{{ $emarot->present_postoffice_name_en }}</option>
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
                                <input type="text" disabled id="present_postoffice" value="{{ $emarot->present_postoffice_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            স্থায়ী  ঠিকানা
                        </h4>
                        <p style="font-size:15px; font-weight:normal;padding-top:10px;"> <input type="checkbox" name="permanentBtn" id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা একই হলে টিক দিন</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_en" id="permanent_village_en" value="{{ old('permanent_village_en')? old('permanent_village_en') : $emarot->permanent_village_en }}" class="form-control @error('permanent_village_en')is-invalid @enderror" autocomplete="permanent_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('permanent_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn')? old('permanent_village_bn') : $emarot->permanent_village_bn }}" class="form-control @error('permanent_village_bn')is-invalid @enderror" autocomplete="permanent_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no')? old('permanent_holding_no') : $emarot->permanent_holding_no }}" class="form-control @error('permanent_holding_no')is-invalid @enderror" autocomplete="permanent_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no')? old('permanent_ward_no') : $emarot->permanent_ward_no }}" class="form-control @error('permanent_ward_no')is-invalid @enderror" autocomplete="permanent_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                    <option value="{{ $emarot->permanent_district_id }}" selected="selected">{{ $emarot->permanent_district_name_en }}</option>
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
                                <input type="text" disabled id="permanent_district" value="{{ $emarot->permanent_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )" name="permanent_upazila_id" id="permanent_upazila_id" class="custom-select2 form-control @error('permanent_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $emarot->permanent_upazila_id }}" selected="selected">{{ $emarot->permanent_upazila_name_en }}</option>
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
                                <input type="text" disabled id="permanent_upazila" value="{{ $emarot->permanent_upazila_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')" name="permanent_postoffice_id" id="permanent_postoffice_id" class="custom-select2 form-control @error('permanent_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $emarot->permanent_postoffice_id }}" selected="selected">{{ $emarot->permanent_postoffice_name_en }}</option>
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
                                <input type="text" disabled id="permanent_postoffice" value="{{ $emarot->permanent_postoffice_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                </div>
{{--            emarot    --}}
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
                                ('area_name') ? old
                                ('area_name') : $emarot->area_name  }}" class="form-control @error('area_name')is-invalid
@enderror"
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
                                    <option value="" {{ (old('build_type')? old('build_type') : $emarot->build_type == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ (old('build_type')? old('build_type') : $emarot->build_type == 1) ? 'selected="selected"' : '' }}>আবাসিক</option>
                                    <option value='2' {{ (old('build_type')? old('build_type') : $emarot->build_type == 2) ? 'selected="selected"' : '' }}>বাণিজ্যিক</option>
                                    <option value='3' {{ (old('build_type')? old('build_type') : $emarot->build_type == 3) ? 'selected="selected"' : '' }}>আবাসিক কাম-বাণিজ্যিক</option>
                                    <option value='4' {{ (old('build_type')? old('build_type') : $emarot->build_type == 4) ? 'selected="selected"' : '' }}>শিল্প কারখানা</option>
                                    <option value='5' {{ (old('build_type')? old('build_type') : $emarot->build_type == 5) ? 'selected="selected"' : '' }}>মসজিদ</option>
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
                                <input type="text" name="dag_no_cs" id="dag_no_cs" value="{{ old('dag_no_cs') ?  old
                                ('dag_no_cs') : $emarot->dag_no_cs }}"
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
                                ('khotian_no_cs') ?  old
                                ('khotian_no_cs') : $emarot->khotian_no_cs
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
                                       value="{{ old('dag_no_sa') ? old('dag_no_sa') : $emarot->dag_no_sa  }}"
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
                                       value="{{ old('khotian_no_sa') ? old('khotian_no_sa') : $emarot->khotian_no_sa }}"
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
                                       value="{{ old('dag_no_rs') ? old('dag_no_rs') : $emarot->dag_no_rs }}"
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
                                       value="{{ old('khotian_no_rs') ? old('khotian_no_rs') : $emarot->khotian_no_rs }}"
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
                                       value="{{ old('sit_no')? old('sit_no') : $emarot->sit_no }}"
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
                                       value="{{ old('mojar_name')? old('mojar_name') : $emarot->mojar_name }}"
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
                                       value="{{ old('land_amount')? old('land_amount') : $emarot->land_amount }}"
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
                                       value="{{ old('emarot_word_no')? old('emarot_word_no') : $emarot->emarot_word_no }}"
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
                                       value="{{ old('land_earn_description') ? old('land_earn_description') : $emarot->land_earn_description }}" data-parsley-maxlength="50"
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
                                       value="{{ old('road_name') ? old('road_name') : $emarot->road_name }}"
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
                                ('north')  ? old('north') : $emarot->north  }}"
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
                                ('south')  ? old('south') : $emarot->south }}" class="form-control @error('south')is-invalid @enderror"
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
                                ('east') ? old('east') : $emarot->east }}" class="form-control @error('east')is-invalid
@enderror" data-parsley-maxlength="50" data-parsley-trigger="keyup"/>

                                @error('east')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="west" class="col-sm-3 control-label">পশ্চিম</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="west" id="west" value="{{ old('west') ? old('west') :
                                $emarot->west
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
                                ('fast_floor') ? old('fast_floor') : $emarot->fast_floor }}" class="form-control @error('fast_floor')is-invalid @enderror"
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
                                ('other_floor') ? old('other_floor') : $emarot->other_floor }}" class="form-control @error('other_floor')is-invalid @enderror"
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
                                ('total_floor') ? old('total_floor') : $emarot->total_floor }}" class="form-control @error('total_floor')is-invalid
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
                                ('site_name') ? old('site_name') : $emarot->site_name }}" class="form-control @error('site_name')is-invalid @enderror"
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
                                ('distance') ? old('distance') : $emarot->distance }}" data-parsley-maxlength="50" class="form-control @error('distance')
                                    is-invalid @enderror"
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
                                ('position') ? old('position') : $emarot->position }}" class="form-control @error('position')is-invalid
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
                                ('spread') ? old('spread') : $emarot->spread }}" class="form-control @error('spread')is-invalid
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
                                ('near_way') ? old('near_way') : $emarot->near_way }}" class="form-control @error('near_way')is-invalid
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
                                ('to_north') ? old('to_north') : $emarot->to_north   }}" class="form-control @error('to_north')is-invalid @enderror"
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
                                ('to_east')  ? old('to_east') : $emarot->to_east }}" class="form-control @error('to_east')is-invalid @enderror"
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
                                ('to_south')  ? old('to_south') : $emarot->to_south }}" class="form-control @error('to_south')is-invalid
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
                                ('to_west') ? old('to_west') : $emarot->to_west }}" class="form-control @error('to_west')is-invalid
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
                                       value="{{ old('road_present_condition') ? old('road_present_condition') : $emarot->road_present_condition }}"
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
                                       value="{{ old('road_consider') ? old('road_consider') : $emarot->road_consider }}" class="form-control @error('road_consider')is-invalid
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
                                ('emarot_land') ? old('emarot_land') : $emarot->emarot_land }}" placeholder="বেষ্টিত স্থানের পরিমান"
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
                                ('previous_emarot_land') ? old('previous_emarot_land') : $emarot->previous_emarot_land }}" placeholder="বেষ্টিত স্থানের পরিমান"
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
                                    <input style=" width: 15px " {{ ((old('electricity_line')? old('electricity_line') :
                                           $emarot->electricity_line ) == 'হ্যাঁ' ) ? 'checked' : '' }} type="radio" name="electricity_line"
                                           id="electricity_line"
                                           value="হ্যাঁ"  class="form-check-input  @error('electricity_line')
                                        is-invalid @enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " {{ ((old('electricity_line')? old('electricity_line') :
                                           $emarot->electricity_line ) == 'না' ) ? 'checked' : '' }} type="radio" name="electricity_line"
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
                                           id="gass_line" {{ ((old('gass_line')? old('gass_line') :
                                           $emarot->gass_line ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('gass_line')is-invalid @enderror"
                                    /><label class="form-check-label" for="inlineRadio1"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="gass_line" id="gass_line"
                                           value="না" {{ ((old('gass_line')? old('gass_line') :
                                           $emarot->gass_line ) == 'না' ) ? 'checked' : '' }} class="form-check-input   @error('gass_line')is-invalid
@enderror"
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
                                           id="water_line" {{ ((old('water_line')? old('water_line') :
                                           $emarot->water_line ) == 'হ্যাঁ' ) ? 'checked' : '' }}
                                           value="হ্যাঁ" class="form-check-input  @error('water_line')is-invalid @enderror"
                                    /><label class="form-check-label" for="water_line"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="water_line"
                                           id="water_line" {{ ((old('water_line')? old('water_line') :
                                           $emarot->water_line ) == 'না' ) ? 'checked' : '' }}
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
                                           value="হ্যাঁ" {{ ((old('drain_line')? old('drain_line') :
                                           $emarot->drain_line ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('drain_line')is-invalid
@enderror"
                                    /><label class="form-check-label" for="drain_line"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" {{ ((old('drain_line')? old('drain_line') :
                                           $emarot->drain_line ) == 'না' ) ? 'checked' : '' }}  name="drain_line" id="drain_line"
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
                                           value="হ্যাঁ"  {{ ((old('ceptic_tank')? old('ceptic_tank') :
                                           $emarot->ceptic_tank ) == 'হ্যাঁ' ) ? 'checked' : '' }} class="form-check-input  @error('ceptic_tank')is-invalid
@enderror"
                                    /><label class="form-check-label" for="ceptic_tank"> হ্যাঁ </label>
                                    <input style=" width: 15px " type="radio" name="ceptic_tank"
                                           id="ceptic_tank"
                                           value="না" {{ ((old('ceptic_tank')? old('ceptic_tank') :
                                           $emarot->ceptic_tank ) == 'না' ) ? 'checked' : '' }} class="form-check-input  @error('ceptic_tank')is-invalid
@enderror"
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
                                <input type="text" name="emarot_construction_start" id="emarot_construction_start"
                                       value="{{ old('emarot_construction_start') ? old('emarot_construction_start') : $emarot->emarot_construction_start }}" class="form-control @error('emarot_construction_start')is-invalid @enderror"
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
                                <input type="text" name="emarot_construction_destroy_purpose"
                                       id="emarot_construction_destroy_purpose" value="{{ old('emarot_construction_destroy_purpose') ? old('emarot_construction_destroy_purpose') : $emarot->emarot_construction_destroy_purpose }}" class="form-control @error('emarot_construction_destroy_purpose')is-invalid @enderror"
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
                                <input type="text" name="emarot_construction_notice_jari"
                                       id="emarot_construction_notice_jari" value="{{ old('emarot_construction_notice_jari') ? old('emarot_construction_notice_jari') : $emarot->emarot_construction_notice_jari }}" class="form-control @error('emarot_construction_notice_jari')is-invalid @enderror"
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
                                ('road_distance') ? old('road_distance'): $emarot->road_distance }}" class="form-control @error('road_distance')
                                    is-invalid
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
                                ('drain_distance') ? old('drain_distance'): $emarot->drain_distance }}" class="form-control @error('drain_distance')is-invalid
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
                                       value="{{ old('emarot_distance') ?  old('emarot_distance') : $emarot->emarot_distance  }}"
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
                                       value="{{ old('electricity_distance') ? old('electricity_distance') :
                                       $emarot->electricity_distance
                                       }}" class="form-control @error('electricity_distance')is-invalid
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
                                       value="{{ old('gass_distance') ? old('gass_distance') : $emarot->gass_distance  }}"
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
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile')? old('mobile') : $emarot->mobile }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Email" class="col-sm-3 control-label">ইমেল </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="email" id="email" value="{{ old('email')? old('email') : $emarot->email }}" class="form-control @error('email')is-invalid @enderror" placeholder="example@gmail.com" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
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
                        <input type="hidden" name="application_type" id="application_type" value="93">

                        <input type="hidden" value="{{ $emarot->application_id }}" name="application_id"/>

                        <input type="hidden" value="{{ $emarot->citizen_id }}" name="citizen_id"/>
                        <input type="hidden" value="{{ $emarot->emarot_id }}" name="emarot_id"/>

                        <input type="hidden" value="{{ $emarot->pin }}" name="pin"/>

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





