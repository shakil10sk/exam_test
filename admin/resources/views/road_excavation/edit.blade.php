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
                        <h4 class="text-center application_head">রাস্তা খননের অনুমতির তথ্য আপডেট</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="{{ route('road_update') }}" method="post" enctype="multipart/form-data"
                  class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row form-group" style="margin-top: 50px;">
                                    <label for="Name-english" class="col-sm-3 control-label"> মালিকের নাম
                                        (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_en" id="name_en"
                                               value="{{ old('name_en')? old('name_en') : $data->name_en }}"
                                               class="form-control @error('name_en') is-invalid @enderror"
                                               placeholder="Full Name" data-parsley-pattern='^[a-zA-Z. ]+$'
                                               data-parsley-trigger="keyup"/>
                                        <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                    <label for="Name-bangla" class="col-sm-3 control-label"> মালিকের নাম (বাংলায়) <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_bn" id="name_bn"
                                               value="{{ old('name_bn')? old('name_bn') : $data->name_bn }}"
                                               class="form-control @error('name_bn') is-invalid @enderror"
                                               placeholder="পূর্ণ নাম" data-parsley-trigger="keyup"
                                               data-parsley-required/>
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
                                    <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি
                                        (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="nid" id="nid"
                                               value="{{ old('nid')? old('nid') : $data->nid }}"
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

                                    <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং
                                        (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="birth_id"
                                               value="{{ old('birth_id')? old('birth_id') : $data->birth_id }}"
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
                                    <label for="Passport-no" class="col-sm-3 control-label">পাসপোর্ট নং
                                        (ইংরেজিতে)</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="passport_no"
                                               value="{{ old('passport_no')? old('passport_no') : $data->passport_no }}"
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

                                    <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="birth_date"
                                               value="{{ old('birth_date')? old('birth_date') : $data->birth_date }}"
                                               id="birth_date"
                                               class="form-control date @error('birth_date') is-invalid @enderror"
                                               autocomplete="birth_date" autofocus data-parsley-type="date"
                                               data-parsley-trigger="keyup" data-parsley-required
                                               placeholder="yyyy-mm-dd"/>

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
                                    <img src="{{ asset('images/application/'.$data->photo) }}"
                                         class="image-previewer image" data-cropzee="cropzee-input"/>
                                @else
                                    <img src="{{ asset('images/default_animal.png') }}" class="image-previewer image"
                                         data-cropzee="cropzee-input"/>
                                @endif

                                <button for="cropzee-input" class="btn btn-primary form-control"><i
                                        class="ion-ios-upload-outline"></i> Upload
                                </button>
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
                                <input type="text" name="father_name_en" id="father_name_en"
                                       value="{{ old('father_name_en')? old('father_name_en') : $data->father_name_en }}"
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
                                <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_bn" id="father_name_bn"
                                       value="{{ old('father_name_bn')? old('father_name_bn') : $data->father_name_bn }}"
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
                                       value="{{ old('mother_name_en')? old('mother_name_en') : $data->mother_name_en }}"
                                       class="form-control @error('mother_name_en') is-invalid @enderror"
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                       class="form-control" placeholder="Mother's Name"/>
                                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                @error('mother_name_en')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)
                                <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name_bn" id="mother_name_bn"
                                       value="{{ old('mother_name_bn')? old('mother_name_bn') : $data->mother_name_bn }}"
                                       class="form-control @error('mother_name_bn') is-invalid @enderror"
                                       placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required/>
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
                                <label class="radio-inline gender"><input type="radio"
                                                                          {{ ((old('gender')? old('gender') : $data->gender) == 1) ? 'checked' : '' }} name="gender"
                                                                          value="1"/>পুরুষ</label>

                                <label class="radio-inline gender"><input type="radio"
                                                                          {{ ((old('gender')? old('gender') : $data->gender) == 2) ? 'checked' : '' }} name="gender"
                                                                          value="2"/>মহিলা</label>

                                <label class="radio-inline gender"><input type="radio"
                                                                          {{ ((old('gender')? old('gender') : $data->gender) == 3) ? 'checked' : '' }} name="gender"
                                                                          value="3"/>অন্যান্য</label>

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

                                    <option
                                        value="" {{ (old('marital_status')? old('marital_status') : $data->marital_status == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>

                                    <option
                                        value='1' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 1) ? 'selected="selected"' : '' }}>
                                        অবিবাহিত
                                    </option>

                                    <option
                                        value='2' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 2) ? 'selected="selected"' : '' }}>
                                        বিবাহিত
                                    </option>

                                    <option
                                        value='3' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 3) ? 'selected="selected"' : '' }}>
                                        তালাক প্রাপ্ত
                                    </option>

                                    <option
                                        value='4' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 4) ? 'selected="selected"' : '' }}>
                                        বিধবা
                                    </option>

                                    <option
                                        value='5' {{ (old('marital_status')? old('marital_status') : $data->marital_status == 5) ? 'selected="selected"' : '' }}>
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

                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            যে হোল্ডিং এ গ্যাস/পানির লাইন সংযোগ দেওয়া হবে
                        </h4>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="row form-group">

                            <label for="road_holding_no" class="col-sm-3 control-label">হোল্ডিং নং
                                <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_holding_no" id="road_holding_no"
                                       value="{{ old('road_holding_no') ? old('road_holding_no') : $data->holding_no }}"
                                       data-parsley-trigger="keyup"
                                       class="form-control @error('road_holding_no') is-invalid @enderror"
                                       autocomplete="road_holding_no" autofocus placeholder="Holding No"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে</span>

                                @error('road_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_cutting_amount" class="col-sm-3 control-label"> রাস্তা কাটা/বোরিং এর পরিমাণ
                                <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_cutting_amount" id="road_cutting_amount"
                                       value="{{ old('road_cutting_amount') ? old('road_cutting_amount') : $data->cutting_amount }}"
                                       class="form-control @error('road_cutting_amount') is-invalid @enderror"
                                       autocomplete="road_cutting_amount" autofocus
                                       placeholder="রাস্তা কাটা/বোরিং এর পরিমাণ" data-parsley-trigger="keyup"
                                       data-parsley-required/>
                                <span class="bt-flabels__error-desc">রাস্তা কাটা/বোরিং এর পরিমাণ দিন বাংলায়</span>

                                @error('road_cutting_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">

                            <label for="road_moholla_en" class="col-sm-3 control-label">মহল্লা (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_moholla_en" id="road_moholla_en"
                                       value="{{ old('road_moholla_en') ? old('road_moholla_en') : $data->moholla_en }}"
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                       class="form-control @error('road_moholla_en') is-invalid @enderror"
                                       autocomplete="road_moholla_en" autofocus placeholder="Moholla"/>
                                <span class="bt-flabels__error-desc">মহল্লা দিন ইংরেজিতে</span>

                                @error('road_moholla_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_moholla_bn" class="col-sm-3 control-label">মহল্লা (বাংলায়)
                                <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_moholla_bn" id="road_moholla_bn"
                                       value="{{ old('road_moholla_bn') ? old('road_moholla_bn') : $data->moholla_bn }}"
                                       class="form-control @error('road_moholla_bn') is-invalid @enderror"
                                       autocomplete="road_moholla_bn" autofocus placeholder="মহল্লা"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">মহল্লা দিন বাংলায়</span>

                                @error('road_moholla_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="road_name_en" class="col-sm-3 control-label">রাস্তার নাম (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_name_en" id="road_name_en"
                                       value="{{ old('road_name_en') ? old('road_name_en') : $data->road_name_en }}"
                                       data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                       class="form-control @error('road_name_en') is-invalid @enderror"
                                       autocomplete="road_name_en" autofocus placeholder="Road Name"/>
                                <span class="bt-flabels__error-desc">রাস্তার নাম দিন ইংরেজিতে</span>

                                @error('road_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_name_bn" class="col-sm-3 control-label">রাস্তার নাম (বাংলায়) <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_name_bn" id="road_name_bn"
                                       value="{{ old('road_name_bn') ? old('road_name_bn') : $data->road_name_bn }}"
                                       class="form-control @error('road_name_bn') is-invalid @enderror"
                                       autocomplete="road_name_bn" autofocus placeholder="রাস্তার নাম"
                                       data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">রাস্তার নাম দিন বাংলায়</span>

                                @error('road_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="road_type" class="col-sm-3 control-label">রাস্তার ধরণ <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="road_type" id="road_type" selected="selected"
                                        class="form-control @error('road_type')is-invalid @enderror"
                                        data-parsley-required>
                                    <option
                                        value="" {{ ((old('road_type') ? old('road_type') : $data->road_type) == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>

                                    <option
                                        value='1' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 1) ? 'selected="selected"' : '' }}>
                                        কাঁচা
                                    </option>

                                    <option
                                        value='2' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 2) ? 'selected="selected"' : '' }}>
                                        পাকা
                                    </option>

                                    <option
                                        value='3' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 3) ? 'selected="selected"' : '' }}>
                                        অর্ধ পাকা
                                    </option>

                                    <option
                                        value='4' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 4) ? 'selected="selected"' : '' }}>
                                        কার্পেটিং
                                    </option>

                                    <option
                                        value='5' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 5) ? 'selected="selected"' : '' }}>
                                        ডব্লিউ.বি.এম
                                    </option>

                                    <option
                                        value='6' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 5) ? 'selected="selected"' : '' }}>
                                        এইচ.বি.বি
                                    </option>

                                    <option
                                        value='7' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 5) ? 'selected="selected"' : '' }}>
                                        সোলিং
                                    </option>

                                    <option
                                        value='8' {{ ((old('road_type') ? old('road_type') : $data->road_type) == 5) ? 'selected="selected"' : '' }}>
                                        আর.সি.সি
                                    </option>

                                </select>

                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('road_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_cutting_cause" class="col-sm-3 control-label">রাস্তা কাটার কারন
                                <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="road_cutting_cause" id="road_cutting_cause" selected="selected"
                                        class="form-control @error('road_cutting_cause')is-invalid @enderror"
                                        data-parsley-required>
                                    <option
                                        value="" {{ ((old('road_cutting_cause') ? old('road_cutting_cause') : $data->cutting_cause) == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>

                                    <option
                                        value='1' {{ ((old('road_cutting_cause') ? old('road_cutting_cause') : $data->cutting_cause) == 1) ? 'selected="selected"' : '' }}>
                                        গ্যাস লাইন সংযোগ
                                    </option>

                                    <option
                                        value='2' {{ ((old('road_cutting_cause') ? old('road_cutting_cause') : $data->cutting_cause) == 2) ? 'selected="selected"' : '' }}>
                                        পানির লাইন সংযোগ
                                    </option>

                                    <option
                                        value='3' {{ ((old('road_cutting_cause') ? old('road_cutting_cause') : $data->cutting_cause) == 3) ? 'selected="selected"' : '' }}>
                                        বিদ্যুৎ লাইন সংযোগ
                                    </option>

                                </select>

                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('road_cutting_cause')
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
                                       value="{{ old('present_village_en')? old('present_village_en') : $data->present_village_en }}"
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
                                       value="{{ old('present_village_bn')? old('present_village_bn') : $data->present_village_bn }}"
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
                            <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_rbs_en" id="present_rbs_en"
                                       value="{{ old('present_rbs_en')? old('present_rbs_en') : $data->present_rbs_en }}"
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

                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (বাংলায়)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_rbs_bn" id="present_rbs_bn"
                                       value="{{ old('present_rbs_bn')? old('present_rbs_bn') : $data->present_rbs_bn }}"
                                       class="form-control @error('present_rbs_bn')is-invalid @enderror" placeholder=""
                                       autocomplete="present_rbs_bn" autofocus data-parsley-maxlength="100"
                                       data-parsley-trigger="keyup"/>

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
                                <input type="text" name="present_holding_no" id="present_holding_no"
                                       value="{{ old('present_holding_no')? old('present_holding_no') : $data->present_holding_no }}"
                                       class="form-control @error('present_holding_no')is-invalid @enderror"
                                       autocomplete="present_holding_no" autofocus data-parsley-type="number"
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
                                       value="{{ old('present_ward_no')? old('present_ward_no') : $data->present_ward_no }}"
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
                                <select
                                    onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )"
                                    class="custom-select2 form-control @error('present_district_id')is-invalid @enderror"
                                    id="present_district_id" name="present_district_id"
                                    style="width: 100%; height: 38px;" data-parsley-required>

                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>

                                    <option value="{{ $data->present_district_id }}"
                                            selected="selected">{{ $data->present_district_name_en }}</option>

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
                                       value="{{ $data->present_district_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    onchange="getLocation($(this).val(), 'present_upazila', 'present_postoffice_append', 'present_postoffice_id', 'present_postoffice', 6 )"
                                    name="present_upazila_id" id="present_upazila_id"
                                    class="custom-select2 form-control @error('present_upazila_id')is-invalid @enderror"
                                    data-parsley-required>

                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>

                                    <option value="{{ $data->present_upazila_id }}"
                                            selected="selected">{{ $data->present_upazila_name_en }}</option>

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
                                       value="{{ $data->present_upazila_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')"
                                        name="present_postoffice_id" id="present_postoffice_id"
                                        class="custom-select2 form-control @error('present_postoffice_id')is-invalid @enderror"
                                        data-parsley-required>
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $data->present_postoffice_id }}"
                                            selected="selected">{{ $data->present_postoffice_name_en }}</option>
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
                                       value="{{ $data->present_postoffice_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            পূর্বের ঠিকানা
                        </h4>
                        <p style="font-size:15px; font-weight:normal;padding-top:10px;"><input type="checkbox"
                                                                                               name="permanentBtn"
                                                                                               id="permanentBtn" {{ old('permanentBtn') ? 'checked' : '' }} />ঠিকানা
                            একই হলে টিক দিন</p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">

                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_en" id="permanent_village_en"
                                       value="{{ old('permanent_village_en')? old('permanent_village_en') : $data->permanent_village_en }}"
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
                                       value="{{ old('permanent_village_bn')? old('permanent_village_bn') : $data->permanent_village_bn }}"
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
                            <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_rbs_en" id="permanent_rbs_en"
                                       value="{{ old('permanent_rbs_en')? old('permanent_rbs_en') : $data->permanent_rbs_en }}"
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

                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (বাংলায়)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_rbs_bn" id="permanent_rbs_bn"
                                       value="{{ old('permanent_rbs_bn')? old('permanent_rbs_bn') : $data->permanent_rbs_bn}}"
                                       class="form-control @error('permanent_rbs_bn')is-invalid @enderror"
                                       placeholder="" autocomplete="permanent_rbs_bn" autofocus
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no"
                                       value="{{ old('permanent_holding_no')? old('permanent_holding_no') : $data->permanent_holding_no }}"
                                       class="form-control @error('permanent_holding_no')is-invalid @enderror"
                                       autocomplete="permanent_holding_no" autofocus data-parsley-type="number"
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
                                       value="{{ old('permanent_ward_no')? old('permanent_ward_no') : $data->permanent_ward_no }}"
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
                                <select
                                    onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )"
                                    name="permanent_district_id" id="permanent_district_id"
                                    class="custom-select2 form-control @error('permanent_district_id')is-invalid @enderror"
                                    style="width: 100%; height: 38px;" data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    <option value="{{ $data->permanent_district_id }}"
                                            selected="selected">{{ $data->permanent_district_name_en }}</option>
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
                                <input type="text" disabled id="permanent_district"
                                       value="{{ $data->permanent_district_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )"
                                    name="permanent_upazila_id" id="permanent_upazila_id"
                                    class="custom-select2 form-control @error('permanent_upazila_id')is-invalid @enderror"
                                    data-parsley-required>
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $data->permanent_upazila_id }}"
                                            selected="selected">{{ $data->permanent_upazila_name_en }}</option>
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
                                <input type="text" disabled id="permanent_upazila"
                                       value="{{ $data->permanent_upazila_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')"
                                        name="permanent_postoffice_id" id="permanent_postoffice_id"
                                        class="custom-select2 form-control @error('permanent_postoffice_id')is-invalid @enderror"
                                        data-parsley-required>
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $data->permanent_postoffice_id }}"
                                            selected="selected">{{ $data->permanent_postoffice_name_en }}</option>
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
                                <input type="text" disabled id="permanent_postoffice"
                                       value="{{ $data->permanent_postoffice_name_bn }}" class="form-control"
                                       placeholder=""/>
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
                                <input type="text" name="mobile" id="mobile"
                                       value="{{ old('mobile')? old('mobile') : $data->mobile }}"
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
                                <input type="text" name="email" id="email"
                                       value="{{ old('email')? old('email') : $data->email }}"
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
                        <input type="hidden" name="application_type" id="application_type" value="9">

                        <input type="hidden" value="{{ $data->application_id }}" name="application_id"/>

                        <input type="hidden" value="{{ $data->citizen_id }}" name="citizen_id"/>

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
        $(document).ready(function () {
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





