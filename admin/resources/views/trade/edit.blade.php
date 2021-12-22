@extends('layouts.app')
@section('head')
    <!-- cropzee.js -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')

    <section>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title text-center">
                        <h4 class="text-center application_head">ট্রেড লাইসেন্স তথ্য সংশোধন </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="{{ route('trade_update') }}" method="post" enctype="multipart/form-data"
                  class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="organization_name_en" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_name_en" id="organization_name_en"
                                       value="{{ old('organization_name_en')? old('organization_name_en') : $organization->organization_name_en }}"
                                       class="form-control @error('organization_name_en')is-invaliid @enderror"
                                       autocomplete="organization_name_en" autofocus data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম দিন ইংরেজিতে....</span>

                                @error('organization_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="organization_name_bn" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (বাংলায়)
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_name_bn" id="organization_name_bn"
                                       value="{{ old('organization_name_bn')? old('organization_name_bn') : $organization->organization_name_bn }}"
                                       class="form-control @error('organization_name_bn')is-invalid @enderror"
                                       autocomplete="organization_name_bn" autofocus data-parsley-trigger="keyup"
                                       data-parsley-required/>
                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম দিন বাংলায়....</span>

                                @error('organization_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="owner_type" class="col-sm-3 control-label">প্রতিষ্ঠানের মালিকানার ধরণ
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="owner_type" id="ownerType"
                                        class="form-control @error('owner_type')is-invalid @enderror"
                                        selected="selected" data-parsley-required readonly>
                                    <option
                                        value="" {{ (old('owner_type')? old('owner_type') : $organization->owner_type  == '') ? 'selected="selected"' : '' }}>
                                        চিহ্নিত করুন
                                    </option>
                                    <option
                                        value="1" {{ (old('owner_type')? old('owner_type') : $organization->owner_type == 1) ? 'selected="selected"' : '' }}>
                                        ব্যক্তি মালিকানাধীন
                                    </option>
                                    <option
                                        value="2" {{ (old('owner_type')? old('owner_type') : $organization->owner_type == 2) ? 'selected="selected"' : '' }}>
                                        যৌথ মালিকানা
                                    </option>
                                    <option
                                        value="3" {{ (old('owner_type')? old('owner_type') : $organization->owner_type == 3) ? 'selected="selected"' : '' }}>
                                        কোম্পানী
                                    </option>
                                    <option value="4" {{ (old('owner_type')? old('owner_type') :
                                    $organization->owner_type == 4) ? 'selected="selected"' : '' }}>ব্যাংক অথবা আর্থিক
                                        প্রতিষ্ঠান
                                    </option>
                                </select>
                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের মালিকানার ধরণ চিহ্নিত করুন....</span>

                                @error('owner_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 text-center" id="national_id_error">

                    </div>

                    {{--Nav tab section--}}

                    <ul class="nav nav-tabs" id="tab-append" role="tablist">

                        @php $owner = null; $count = count((array) $owners); @endphp
                        @foreach($owners as $key => $value)
                            @if(old())
                                @php
                                    $count = count(old('name_bn'));
                                @endphp
                            @endif
                            <li class="nav-item owner-item-link">
                                <a class="nav-link {{ ($key == 0)? 'active' : '' }}" id="owner-tab-link-{{ $key }}"
                                   data-toggle="tab" href="#owner-tab-{{ $key }}" role="tab"
                                   aria-controls="owner-{{ $key }}">{{ ($value == 'Default' || $count < 2)? 'মালিকের তথ্য' : 'মালিক '.BanglaConverter::bn_number($key+1) }}
                                    :</a>
                                @php $owner = $key @endphp
                            </li>
                        @endforeach

                        <li class="nav-item" id="add-btn">
                            <button type="button" value="{{ $owner }}" id="owner-plus-btn"
                                    class="btn btn-primary" {{ ((old('owner_type')? old('owner_type') : $organization->owner_type) == 2 || (old('owner_type')? old('owner_type') : $organization->owner_type) == 3) ? 'style=display:block;' : 'style=display:none;' }}>
                                <i class="icon-copy ion-plus-circled"></i></button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($owners as $key => $value)
                            <div class="tab-pane {{ ($key == 0)? 'show active' : 'show-hidden-tab' }} fade"
                                 role="tabpanel" id="owner-tab-{{ $key }}">
                                <div class="card card-info">
                                    <div class="card-heading p-2">
                                        @if($key != 0)
                                            <button type="button" id="cancel-btn-{{ $key }}"
                                                    onclick="removeTab({{ $key }})" class="btn btn-danger"
                                                    style="float: right;">X
                                            </button>
                                        @endif
                                        <h4 class="card-title text-center" id="error-{{ $key }}">মালিকের তথ্য:</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row form-group">
                                                        <label for="name_en_{{ $key }}" class="col-sm-3 control-label">মালিকের
                                                            নাম(ইংরেজিতে)</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <input type="text" name="name_en[]" id="name_en_{{ $key }}"
                                                                   value="{{ old('name_en.'.$key)? old('name_en.'.$key) : $value['name_en'] }}"
                                                                   class="form-control @error('name_en.'.$key)is-invalid @enderror"
                                                                   placeholder="Full Name" autofocus
                                                                   data-parsley-trigger="keyup"/>
                                                            <span class="bt-flabels__error-desc">মালিকের নাম দিন ইংরেজিতে....</span>

                                                            @error('name_en.'.$key)
                                                            <span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <label for="name_bn_{{ $key }}" class="col-sm-3 control-label">মালিকের
                                                            নাম(বাংলায়) <span>*</span></label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <input type="text" name="name_bn[]" id="name_bn_{{ $key }}"
                                                                   value="{{ old('name_bn.'.$key)? old('name_bn.'.$key) : $value['name_bn'] }}"
                                                                   class="form-control @error('name_bn.'.$key)is-invalid @enderror"
                                                                   placeholder="পূর্ণ নাম" autofocus
                                                                   data-parsley-trigger="keyup" data-parsley-required/>
                                                            <span class="bt-flabels__error-desc">মালিকের নাম দিন বাংলায়....</span>

                                                            @error('name_bn.'.$key)
                                                            <span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label for="nid_{{ $key }}" class="col-sm-3 control-label" id="nid_section"
                                                        >জাতীয়
                                                            পরিচয়পত্র নং(ইংরেজিতে)</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper" id="nid_id_div_1">
                                                            <input type="text" name="nid[]" id="nid_{{ $key }}"
                                                                   value="{{ old('nid.'.$key)? old('nid.'.$key) : $value['nid'] }}"
                                                                   class="form-control @error('nid.'.$key)is-invalid @enderror"
                                                                   data-parsley-maxlength="17" autofocus
                                                                   data-parsley-type="number"
                                                                   data-parsley-trigger="keyup"
                                                                   placeholder="1616623458679011"/>
                                                            <span class="bt-flabels__error-desc">জাতীয় পরিচয়পত্র নং দিন ইংরেজিতে....</span>

                                                            @error('nid.'.$key)
                                                            <span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <label for="birth_id_{{ $key }}" class="col-sm-3
                                                        control-label financialBusinessSection">জন্ম নিবন্ধন
                                                            নং(ইংরেজিতে)</label>
                                                        <div
                                                            class="col-sm-3 bt-flabels__wrapper financialBusinessSection @error('birth_id
                                                        .0')is-invalid @enderror" id="birth_id_div_1">
                                                            <input type="text" name="birth_id[]"
                                                                   id="birth_id_{{ $key }}"
                                                                   value="{{ old('birth_id.'.$key)? old('birth_id.'.$key) : $value['birth_id'] }}"
                                                                   class="form-control @error('birth_id.'.$key)is-invalid @enderror"
                                                                   data-parsley-maxlength="17" autofocus
                                                                   data-parsley-type="number"
                                                                   data-parsley-trigger="keyup"
                                                                   placeholder="1919623458679011"/>
                                                            <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>

                                                            @error('birth_id.'.$key)
                                                            <span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="financialBusinessSection">
                                                        <div class="row form-group">
                                                            <label for="educational_qualification_{{ $key }}"
                                                                   class="col-sm-3 control-label">শিক্ষাগত
                                                                যোগ্যতা</label>
                                                            <div class="col-sm-3 bt-flabels__wrapper">
                                                                <input type="text" name="educational_qualification[]"
                                                                       id="educational_qualification_{{ $key }}"
                                                                       value="{{ old('educational_qualification.'.$key)? old('educational_qualification.'.$key) : $value['educational_qualification'] }}"
                                                                       class="form-control @error('educational_qualification.'.$key)is-invalid @enderror"
                                                                       autofocus data-parsley-maxlength="150"
                                                                       data-parsley-trigger="keyup"
                                                                       placeholder="শিক্ষাগত যোগ্যতা দিন"/>
                                                                <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                                                                @error('educational_qualification.'.$key)
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>

                                                            <label class="col-sm-3 control-label">ধর্ম
                                                                <span>*</span></label>
                                                            <div class="col-sm-3 bt-flabels__wrapper">
                                                                <select name="religion[]" id="religion_{{ $key }}"
                                                                        selected="selected"
                                                                        class="form-control financialBusinessInput @error('religion.'.$key)
                                                                            is-invalid @enderror"
                                                                        data-parsley-required>
                                                                    <option
                                                                        value='' {{ (old('religion.'.$key)? old('religion.'.$key) : $value['religion'] == '') ? 'selected="selected"' : '' }}>
                                                                        চিহ্নিত করুন
                                                                    </option>
                                                                    <option
                                                                        value='1' {{ (old('religion.'.$key)? old('religion.'.$key) : $value['religion'] == 1) ? 'selected="selected"' : '' }}>
                                                                        ইসলাম
                                                                    </option>
                                                                    <option
                                                                        value='2' {{ (old('religion.'.$key)? old('religion.'.$key) : $value['religion'] == 2) ? 'selected="selected"' : '' }}>
                                                                        হিন্দু
                                                                    </option>
                                                                    <option
                                                                        value='3' {{ (old('religion.'.$key)? old('religion.'.$key) : $value['religion'] == 3) ? 'selected="selected"' : '' }}>
                                                                        বৌদ্ধ ধর্ম
                                                                    </option>
                                                                    <option
                                                                        value='4' {{ (old('religion.'.$key)? old('religion.'.$key) : $value['religion'] == 4) ? 'selected="selected"' : '' }}>
                                                                        খ্রিস্ট ধর্ম
                                                                    </option>
                                                                    <option
                                                                        value='5' {{ (old('religion.'.$key)? old('religion.'.$key) : $value['religion'] == 5) ? 'selected="selected"' : '' }}>
                                                                        অন্যান্য
                                                                    </option>
                                                                </select>
                                                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                                                @error('religion.'.$key)
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="occupation_{{ $key }}"
                                                                   class="col-sm-3 control-label">পেশা</label>
                                                            <div class="col-sm-3 bt-flabels__wrapper">
                                                                <input type="text" name="occupation[]"
                                                                       id="occupation_{{ $key }}"
                                                                       value="{{ old('occupation.'.$key)? old('occupation.'.$key) : $value['occupation'] }}"
                                                                       class="form-control @error('occupation.'.$key) is-invalid @enderror"
                                                                       autofocus data-parsley-maxlength="120"
                                                                       data-parsley-trigger="keyup"
                                                                       placeholder="পেশা দিন"/>
                                                                <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                                                @error('occupation.'.$key)
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>

                                                            <label class="col-sm-3 control-label">বাসিন্দা
                                                                <span>*</span></label>
                                                            <div class="col-sm-3 bt-flabels__wrapper">
                                                                <select name="resident[]" id='resident_{{ $key }}'
                                                                        selected="selected"
                                                                        class="form-control financialBusinessInput @error('resident.'.$key)
                                                                            is-invalid @enderror"
                                                                        data-parsley-required>
                                                                    <option
                                                                        value='' {{ (old('resident.'.$key)? old('resident.'.$key) : $value['resident'] == '') ? 'selected="selected"' : '' }}>
                                                                        চিহ্নিত করুন
                                                                    </option>
                                                                    <option
                                                                        value='1' {{ (old('resident.'.$key)? old('resident.'.$key) : $value['resident'] == 1) ? 'selected="selected"' : '' }}>
                                                                        অস্থায়ী
                                                                    </option>
                                                                    <option
                                                                        value='2' {{ (old('resident.'.$key)? old('resident.'.$key) : $value['resident'] == 2) ? 'selected="selected"' : '' }}>
                                                                        স্থায়ী
                                                                    </option>
                                                                </select>
                                                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                                                @error('resident.'.$key)
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="cropzee-input_{{ $key }}"
                                                           onclick="cropTest({{ $key }});">
                                                        <div class="image-overlay">
                                                            <img
                                                                src="{{ asset('images/application/'.($value['photo']?? "default.jpg")) }}"
                                                                class="image-previewer image" id="image-0"
                                                                data-cropzee="cropzee-input_{{ $key }}"/>
                                                            <button for="cropzee-input_{{ $key }}"
                                                                    class="btn btn-primary form-control"><i
                                                                    class="ion-ios-upload-outline"></i> Upload
                                                            </button>
                                                            <div class="overlay">
                                                                <div class="text">ক্লিক করুন</div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input id="cropzee-input_{{ $key }}" style="display: none;"
                                                           name="photo{{ $key }}[]" type="file" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="financialBusinessSection">
                                            <div class="col-sm-12" id="genderError_{{ $key }}">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label wrap">লিঙ্গ
                                                        <span>*</span></label>
                                                    <div class="col-sm-3 wrap">
                                                        <label class="radio-inline">
                                                        <input type="radio" id="gender_1" class="@error('gender.'.$key)is-invalid @enderror" name="gender[{{ $key }}]" {{ (old('gender.'.$key)? old('gender.'.$key) : $value['gender'] == 1) ? 'checked' : '' }} onclick="genderStatus({{ $key }})" value="1">পুরুষ </label>

                                                        <label class="radio-inline">
                                                        <input type="radio" id="gender_2" class="@error('gender.'.$key)is-invalid @enderror" name="gender[{{ $key }}]" {{ (old('gender.'.$key)? old('gender.'.$key) : $value['gender'] == 2) ? 'checked' : '' }} onclick="genderStatus({{ $key }})" value="2">মহিলা</label>

                                                        <p class="has-danger" id="genderErrorField_{{ $key }}" role="alert"></p>
                                                        @error('gender.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="marital_status_{{ $key }}"
                                                           class="col-sm-3 control-label">বৈবাহিক
                                                        সম্পর্ক <span>*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select name="marital_status[]" id="marital_status_{{ $key }}"
                                                                onchange="genderStatus({{ $key }})" selected="selected"
                                                                class="form-control financialBusinessInput @error('marital_status.'.$key)
                                                                    is-invalid @enderror"
                                                                data-parsley-required>
                                                            <option
                                                                {{ (old('marital_status.'.$key)? old('marital_status.'.$key) : $value['marital_status'] == '') ? 'selected="selected"' : '' }} value="">
                                                                চিহ্নিত করুন
                                                            </option>
                                                            <option
                                                                {{ (old('marital_status.'.$key)? old('marital_status.'.$key) : $value['marital_status'] == 1) ? 'selected="selected"' : '' }} value='1'>
                                                                অবিবাহিত
                                                            </option>
                                                            <option
                                                                {{ (old('marital_status.'.$key)? old('marital_status.'.$key) : $value['marital_status'] == 2) ? 'selected="selected"' : '' }} value='2'>
                                                                বিবাহিত
                                                            </option>
                                                        </select>
                                                        <span
                                                            class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                                        @error('marital_status.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="showhidden-husband-name-{{ $key }}"
                                                 style="display:{{ ((old('gender.'.$key)? old('gender.'.$key) : $value['gender']) == 2 && (old('marital_status.'.$key)? old('marital_status.'.$key) : $value['marital_status']) == 2)? 'block;' : 'none' }}">
                                                <div class="row form-group bt-flabels__wrapper">
                                                    <label for="husband_name_en_{{ $key }}"
                                                           class="col-sm-3 control-label">স্বামীর
                                                        নাম (ইংরেজিতে)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="husband_name_en[]"
                                                               id="husband_name_en_{{ $key }}"
                                                               value="{{ old('husband_name_en.'.$key)? old('husband_name_en.'.$key) : $value['husband_name_en'] }}"
                                                               class="form-control @error('husband_name_en.'.$key)is-invalid @enderror"
                                                               placeholder="" data-parsley-pattern='^[a-zA-Z. ]+$'
                                                               data-parsley-trigger="keyup"/>
                                                        <span
                                                            class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                                        @error('husband_name_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="husband_name_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">স্বামীর
                                                        নাম (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="husband_name_bn[]"
                                                               id="husband_name_bn_{{ $key }}"
                                                               value="{{ old('husband_name_bn.'.$key)? old('husband_name_bn.'.$key) : $value['husband_name_bn'] }}"
                                                               class="form-control @error('husband_name_bn.'.$key)is-invalid @enderror"
                                                               placeholder=""/>
                                                        <span
                                                            class="bt-flabels__error-desc">স্বামীর নাম দিন বাংলায়....</span>

                                                        @error('husband_name_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="father_name_en_{{ $key }}"
                                                           class="col-sm-3 control-label">পিতার
                                                        নাম (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="father_name_en[]"
                                                               id="father_name_en_{{ $key }}"
                                                               value="{{ old('father_name_en.'.$key)? old('father_name_en.'.$key) : $value['father_name_en'] }}"
                                                               class="form-control @error('father_name_en.'.$key) is-invalid @enderror"
                                                               autofocus data-parsley-pattern='^[a-zA-Z. ]+$'
                                                               data-parsley-trigger="keyup"
                                                               placeholder="Father's Name"/>
                                                        <span
                                                            class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                                        @error('father_name_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="father_name_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">পিতার
                                                        নাম (বাংলায়) <span>*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="father_name_bn[]"
                                                               id="father_name_bn_{{ $key }}"
                                                               value="{{ old('father_name_bn.'.$key)? old('father_name_bn.'.$key) : $value['father_name_bn'] }}"
                                                               class="form-control financialBusinessInput @error('father_name_bn.'.$key)
                                                                   is-invalid @enderror"
                                                               autofocus placeholder="পিতার নাম" data-parsley-required/>
                                                        <span
                                                            class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                                        @error('father_name_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="mother_name_en_{{ $key }}"
                                                           class="col-sm-3 control-label">মাতার
                                                        নাম (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="mother_name_en[]"
                                                               id="mother_name_en_{{ $key }}"
                                                               value="{{ old('mother_name_en.'.$key)? old('mother_name_en.'.$key) : $value['mother_name_en'] }}"
                                                               data-parsley-pattern='^[a-zA-Z. ]+$'
                                                               data-parsley-trigger="keyup" autofocus
                                                               class="form-control @error('mother_name_en.'.$key)is-invalid @enderror"
                                                               placeholder="Mother's Name"/>
                                                        <span
                                                            class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                                        @error('mother_name_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="mother_name_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">মাতার
                                                        নাম (বাংলায়) <span>*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="mother_name_bn[]"
                                                               id="mother_name_bn_{{ $key }}"
                                                               value="{{ old('mother_name_bn.'.$key)? old('mother_name_bn.'.$key) : $value['mother_name_bn'] }}"
                                                               class="form-control financialBusinessInput @error('mother_name_bn.'.$key)
                                                                   is-invalid @enderror"
                                                               autofocus placeholder="মাতার নাম"
                                                               data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span
                                                            class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                                                        @error('mother_name_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row financialBusinessSection" style="margin-top: 50px;">
                                            <div class="col-sm-12 text-center">
                                                <h4 class="app-heading">
                                                    বর্তমান ঠিকানা
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="row financialBusinessSection">
                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_village_en_{{ $key }}"
                                                           class="col-sm-3 control-label">গ্রাম/মহল্লা
                                                        (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_village_en[]"
                                                               id="present_village_en_{{ $key }}"
                                                               value="{{ old('present_village_en.'.$key)? old('present_village_en.'.$key) : $value['present_village_en'] }}"
                                                               class="form-control @error('present_village_en.'.$key)is-invalid @enderror"
                                                               autofocus placeholder="" data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                                        @error('present_village_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_village_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_village_bn[]"
                                                               id="present_village_bn_{{ $key }}"
                                                               value="{{ old('present_village_bn.'.$key)? old('present_village_bn.'.$key) : $value['present_village_bn'] }}"
                                                               class="form-control financialBusinessInput @error('present_village_bn.'
                                                               .$key)is-invalid @enderror"
                                                               placeholder="" autofocus data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span
                                                            class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                                        @error('present_village_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_rbs_en_{{ $key }}"
                                                           class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                                        (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_rbs_en[]"
                                                               id="present_rbs_en_{{ $key }}"
                                                               value="{{ old('present_rbs_en.'.$key)? old('present_rbs_en.'.$key) : $value['present_rbs_en'] }}"
                                                               class="form-control @error('present_rbs_en.'.$key)is-invalid @enderror"
                                                               placeholder="" autofocus data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                                        @error('present_rbs_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_rbs_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                                        (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_rbs_bn[]"
                                                               id="present_rbs_bn_{{ $key }}"
                                                               value="{{ old('present_rbs_bn.'.$key)? old('present_rbs_bn.'.$key) : $value['present_rbs_bn'] }}"
                                                               class="form-control @error('present_rbs_bn.'.$key)is-invalid @enderror"
                                                               placeholder="" autofocus data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                                        @error('present_rbs_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_holding_no_{{ $key }}"
                                                           class="col-sm-3 control-label">হোল্ডিং
                                                        নং</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_holding_no[]"
                                                               id="present_holding_no_{{ $key }}"
                                                               value="{{ old('present_holding_no.'.$key)? old('present_holding_no.'.$key) : $value['present_holding_no'] }}"
                                                               class="form-control @error('present_holding_no.'.$key)is-invalid @enderror"
                                                               autofocus
                                                               data-parsley-trigger="keyup"/>
                                                        <span
                                                            class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                                        @error('present_holding_no.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_ward_no_{{ $key }}"
                                                           class="col-sm-3 control-label">ওয়ার্ড নং</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_ward_no[]"
                                                               id="present_ward_no_{{ $key }}"
                                                               value="{{ old('present_ward_no.'.$key)? old('present_ward_no.'.$key) : $value['present_ward_no'] }}"
                                                               class="form-control financialBusinessInput @error('present_ward_no.'.$key)
                                                                   is-invalid @enderror"
                                                               autofocus data-parsley-type="number"
                                                               data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span
                                                            class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                        @error('present_ward_no.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_district_id_{{ $key }}"
                                                           class="col-sm-3 control-label">জেলা</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        {{-- <select onchange="getLocation($(this).val(), 'present_district_{{ $key }}', 'present_upazila_append_{{ $key }}', 'present_upazila_id_{{ $key }}', 'present_upazila_{{ $key }}', 3 )" class="custom-select2 form-control financialBusinessInput @error('present_district_id.'.$key)is-invalid @enderror" id="present_district_id_{{ $key }}" name="present_district_id[]" style="width: 100%; height: 38px;" data-parsley-required>
                                                            <option value="" class="district_append">-আপনার জেলা
                                                                নির্বাচন করুন-
                                                            </option>
                                                            <option value="{{ $value['present_district_id'] }}"
                                                                    selected="selected">{{ $value['present_district_name_en'] }}</option>
                                                        </select> --}}

                                                <input class="form-control @error('present_district_id.'.$key) is-invalid @enderror" id="present_district_txt_{{$key}}" name="present_district_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('present_district_txt_{{$key}}', 'present_district_{{$key}}')" value="{{ $value['present_district_name_en'] }}" />
                            
                                                <input type="hidden" id="present_district_id_{{$key}}" name="present_district_id[]" value="{{$value['present_district_id']}}" />

                                                        <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                        @error('present_district_id.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="present_district_{{ $key }}"
                                                           class="col-sm-3 control-label">জেলা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="present_district_{{ $key }}" value="{{ $value['present_district_name_bn'] }}" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_upazila_id_{{ $key }}"
                                                           class="col-sm-3 control-label">উপজেলা/থানা</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        {{-- <select onchange="getLocation($(this).val(), 'present_upazila_{{ $key }}', 'present_post_office_append_{{ $key }}', 'present_postoffice_id_{{ $key }}', 'present_postoffice_{{ $key }}', 6 )" name="present_upazila_id[]" id="present_upazila_id_{{ $key }}" class="custom-select2 form-control financialBusinessInput @error('present_upazila_id.'.$key) is-invalid @enderror" data-parsley-required>
                                                            <option value="" id="present_upazila_append_{{ $key }}">
                                                                চিহ্নিত করুন
                                                            </option>
                                                            <option value="{{ $value['present_upazila_id'] }}"
                                                                    selected="selected">{{ $value['present_upazila_name_en'] }}</option>
                                                        </select> --}}

                                                    <input class="form-control @error('present_upazila_id.'.$key) is-invalid @enderror" id="present_upazila_txt_{{$key}}" name="present_upazila_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('present_upazila_txt_{{$key}}', 'present_upazila_{{$key}}')" value="{{ $value['present_upazila_name_bn'] }}" />
                            
                                                    <input type="hidden" id="present_upazila_id_{{$key}}" name="present_upazila_id[]" value="{{$value['present_upazila_id']}}" />

                                                        <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                                        @error('present_upazila_id.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="present_upazila_{{ $key }}"
                                                           class="col-sm-3 control-label">উপজেলা/থানা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="present_upazila_{{ $key }}" value="{{ $value['present_upazila_name_bn'] }}" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_postoffice_id_{{ $key }}"
                                                           class="col-sm-3 control-label">পোষ্ট অফিস</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        {{-- <select onchange="getLocation($(this).val(), 'present_postoffice_{{ $key }}')" name="present_postoffice_id[]" id="present_postoffice_id_{{ $key }}" class="custom-select2 form-control financialBusinessInput @error('present_postoffice_id.'
                                                            .$key)is-invalid @enderror" data-parsley-required>
                                                            <option value="" id="present_post_office_append_{{ $key }}">
                                                                চিহ্নিত করুন
                                                            </option>
                                                            <option value="{{ $value['present_postoffice_id'] }}"
                                                                    selected="selected">{{ $value['present_postoffice_name_en'] }}</option>
                                                        </select> --}}

                                                    <input class="form-control @error('present_postoffice_id.'.$key) is-invalid @enderror" id="present_postoffice_txt_{{$key}}" name="present_postoffice_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('present_postoffice_txt_{{$key}}', 'present_postoffice_{{$key}}')" value="{{ $value['permanent_postoffice_name_bn'] }}" />
                            
                                                    <input type="hidden" id="present_postoffice_id_{{$key}}" name="present_postoffice_id[]" value="{{$value['present_postoffice_id']}}" />

                                                        <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                        @error('present_postoffice_id.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_postoffice_{{ $key }}"
                                                           class="col-sm-3 control-label">পোষ্ট অফিস</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="present_postoffice_{{ $key }}"
                                                               value="{{ $value['present_postoffice_name_bn'] }}"
                                                               class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row financialBusinessSection" style="margin-top: 50px;">
                                            <div class="col-sm-12 text-center">
                                                <h4 class="app-heading"> স্থায়ী ঠিকানা </h4>
                                                <p style="font-size:15px; font-weight:normal;padding-top:10px;" id="addressCheck-0">
                                                <input type="checkbox" id="permanentBtn_{{ $key }}" name="permanemtBtn[]" {{ old('permanentBtn.'.$key) ? 'checked' : '' }} onclick="insertAddress({{ $key }});">ঠিকানা একই হলে টিক দিন</p>
                                            </div>
                                        </div>

                                        <div class="row financialBusinessSection">
                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_village_en_{{ $key }}"
                                                           class="col-sm-3 control-label">গ্রাম/মহল্লা
                                                        (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_village_en[]"
                                                               id="permanent_village_en_{{ $key }}"
                                                               value="{{ old('permanent_village_en.'.$key)? old('permanent_village_en.'.$key) : $value['permanent_village_en'] }}"
                                                               class="form-control @error('permanent_village_en.'.$key)is-invalid @enderror"
                                                               autofocus placeholder="" data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                                        @error('permanent_village_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_village_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_village_bn[]"
                                                               id="permanent_village_bn_{{ $key }}"
                                                               value="{{ old('permanent_village_bn.'.$key)? old('permanent_village_bn.'.$key) : $value['permanent_village_bn'] }}"
                                                               class="form-control financialBusinessInput @error('permanent_village_bn.'
                                                               .$key)is-invalid @enderror"
                                                               autofocus placeholder="" data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span
                                                            class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                                        @error('permanent_village_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_rbs_en_{{ $key }}"
                                                           class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                                        (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_rbs_en[]"
                                                               id="permanent_rbs_en_{{ $key }}"
                                                               value="{{ old('permanent_rbs_en.'.$key)? old('permanent_rbs_en.'.$key) : $value['permanent_rbs_en'] }}"
                                                               class="form-control @error('permanent_rbs_en.'.$key)is-invalid @enderror"
                                                               placeholder="" autofocus data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                                        @error('permanent_rbs_en.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_rbs_bn_{{ $key }}"
                                                           class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                                        (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_rbs_bn[]"
                                                               id="permanent_rbs_bn_{{ $key }}"
                                                               value="{{ old('permanent_rbs_bn.'.$key)? old('permanent_rbs_bn.'.$key) : $value['permanent_rbs_bn'] }}"
                                                               class="form-control @error('permanent_rbs_bn.'.$key)is-invalid @enderror"
                                                               placeholder="" autofocus data-parsley-maxlength="100"
                                                               data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                                        @error('permanent_rbs_bn.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_holding_no_{{ $key }}"
                                                           class="col-sm-3 control-label">হোল্ডিং নং</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_holding_no[]"
                                                               id="permanent_holding_no_{{ $key }}"
                                                               value="{{ old('permanent_holding_no.'.$key)? old('permanent_holding_no.'.$key) : $value['permanent_holding_no'] }}"
                                                               class="form-control @error('permanent_holding_no.'.$key)is-invalid @enderror"
                                                               autofocus data-parsley-trigger="keyup"/>
                                                        <span
                                                            class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                                        @error('permanent_holding_no.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_ward_no_{{ $key }}"
                                                           class="col-sm-3 control-label">ওয়ার্ড নং</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_ward_no[]"
                                                               id="permanent_ward_no_{{ $key }}"
                                                               value="{{ old('permanent_ward_no.'.$key)? old('permanent_ward_no.'.$key) : $value['permanent_ward_no'] }}"
                                                               class="form-control financialBusinessInput @error('permanent_ward_no.'.$key)
                                                                   is-invalid @enderror"
                                                               autofocus data-parsley-type="number"
                                                               data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span
                                                            class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                        @error('permanent_ward_no.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_district_id_{{ $key }}"
                                                           class="col-sm-3 control-label">জেলা</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        {{-- <select onchange="getLocation($(this).val(), 'permanent_district_{{ $key }}', 'permanent_upazila_append_{{ $key }}', 'permanent_upazila_id_{{ $key }}', 'permanent_upazila_{{ $key }}', 3 )" name="permanent_district_id[]" id="permanent_district_id_{{ $key }}" class="custom-select2 form-control financialBusinessInput @error('permanent_district_id.'.$key)is-invalid @enderror" style="width: 100%; height: 38px;" data-parsley-required>
                                                            <option value="" class="district_append">-আপনার জেলা
                                                                নির্বাচন করুন-
                                                            </option>
                                                            <option value="{{ $value['permanent_district_id'] }}"
                                                                    selected="selected">{{ $value['permanent_district_name_en'] }}</option>
                                                        </select> --}}

                                                <input class="form-control @error('permanent_district_id.'.$key) is-invalid @enderror" id="permanent_district_txt_{{$key}}" name="permanent_district_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('permanent_district_txt_{{$key}}', 'permanent_district_{{$key}}')" value="{{ $value['permanent_district_name_en'] }}" />
                            
                                                <input type="hidden" id="permanent_district_id_{{$key}}" name="permanent_district_id[]" value="{{$value['permanent_district_id']}}" />

                                                        <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                        @error('permanent_district_id.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_district_{{ $key }}"
                                                           class="col-sm-3 control-label">জেলা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="permanent_district_{{ $key }}"
                                                               value="{{ $value['permanent_district_name_bn'] }}"
                                                               class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_upazila_id_{{ $key }}"
                                                           class="col-sm-3 control-label">উপজেলা/থানা</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        {{-- <select onchange="getLocation($(this).val(), 'permanent_upazila_{{ $key }}', 'permanent_post_office_append_{{ $key }}', 'permanent_postoffice_id_{{ $key }}', 'permanent_postoffice_{{ $key }}', 6 )" name="permanent_upazila_id[]" id="permanent_upazila_id_{{ $key }}" class="custom-select2 form-control financialBusinessInput @error('permanent_upazila_id.'.$key) is-invalid @enderror" data-parsley-required>
                                                            <option value="" id="permanent_upazila_append_{{ $key }}">
                                                                চিহ্নিত করুন
                                                            </option>
                                                            <option value="{{ $value['permanent_upazila_id'] }}"
                                                                    selected="selected">{{ $value['permanent_upazila_name_en'] }}</option>
                                                        </select> --}}

                                                    <input class="form-control @error('permanent_upazila_id.'.$key) is-invalid @enderror" id="permanent_upazila_txt_{{$key}}" name="permanent_upazila_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('permanent_upazila_txt_{{$key}}', 'permanent_upazila_{{$key}}')" value="{{ $value['permanent_upazila_name_bn'] }}" />
                            
                                                    <input type="hidden" id="permanent_upazila_id_{{$key}}" name="permanent_upazila_id[]" value="{{$value['permanent_upazila_id']}}" />

                                                        <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                                        @error('permanent_upazila_id.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="permanent_upazila_{{ $key }}"
                                                           class="col-sm-3 control-label">উপজেলা/থানা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="permanent_upazila_{{ $key }}"
                                                               value="{{ $value['permanent_upazila_name_bn'] }}"
                                                               class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_postoffice_id_{{ $key }}"
                                                           class="col-sm-3 control-label">পোষ্ট অফিস</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        {{-- <select onchange="getLocation($(this).val(), 'permanent_postoffice_{{ $key }}')" name="permanent_postoffice_id[]" id="permanent_postoffice_id_{{ $key }}" class="custom-select2 form-control financialBusinessInput @error('permanent_postoffice_id.'.$key)is-invalid @enderror" data-parsley-required>
                                                            <option value=""
                                                                    id="permanent_post_office_append_{{ $key }}">চিহ্নিত
                                                                করুন
                                                            </option>
                                                            <option value="{{ $value['permanent_postoffice_id'] }}"
                                                                    selected="selected">{{ $value['permanent_postoffice_name_en'] }}</option>
                                                        </select> --}}

                                                    <input class="form-control @error('permanent_postoffice_id.'.$key) is-invalid @enderror" id="permanent_postoffice_txt_{{$key}}" name="permanent_postoffice_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('permanent_postoffice_txt_{{$key}}', 'permanent_postoffice_{{$key}}')" value="{{ $value['permanent_postoffice_name_bn'] }}" />
                            
                                                    <input type="hidden" id="permanent_postoffice_id_{{$key}}" name="permanent_postoffice_id[]" value="{{$value['permanent_postoffice_id']}}" />

                                                        <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                        @error('permanent_postoffice_id.'.$key)
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="permanent_postoffice_{{ $key }}"
                                                           class="col-sm-3 control-label">পোষ্ট অফিস</label>
                                                    <div class="col-sm-3">
                                                        <input type="hidden" name="citizen_id[]"
                                                               value="{{ $value['citizen_id'] }}">
                                                        <input type="hidden" name="owner_id[]"
                                                               value="{{ $value['owner_id'] }}">
                                                        <input type="hidden" name="pin[]" value="{{ $value['pin'] }}">
                                                        <input type="text" disabled id="permanent_postoffice_{{ $key }}"
                                                               value="{{ $value['permanent_postoffice_name_bn'] }}"
                                                               class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <span id="add-tab"></span>
                    </div>
                </div>


                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="vat_id" class="col-sm-3 control-label">ভ্যাট আইডি (যদি থাকে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="vat_id" id="vat_id"
                                       value="{{ old('vat_id')? old('vat_id') : $organization->vat_id }}"
                                       class="form-control @error('vat_id')is-invalid @enderror" placeholder="ইংরেজিতে"
                                       autocomplete="vat_id" autofocus data-parsley-type="number"
                                       data-parsley-maxlength="17" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">ভ্যাট আইডি নং দিন ইংরেজিতে....</span>

                                @error('vat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="tax_id" class="col-sm-3 control-label">ট্যাক্স আইডি (যদি থাকে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="tax_id" id="tax_id"
                                       value="{{ old('tax_id')? old('tax_id') : $organization->tax_id }}"
                                       class="form-control @error('tax_id')is-invalid @enderror" placeholder="ইংরেজিতে"
                                       autocomplete="tax_id" autofocus data-parsley-type="number"
                                       data-parsley-maxlength="17" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">ট্যাক্স আইডি নং দিন ইংরেজিতে....</span>

                                @error('vat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="signboard_length" class="col-sm-3 control-label">সাইন বোর্ড দৈর্ঘ্য</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="signboard_length" id="signboard_length" value="{{ old
                                ('signboard_length') ? old
                                ('signboard_length') : $organization->signboard_length    }}"
                                       class="form-control @error('signboard_length')is-invalid @enderror"
                                       placeholder="দৈর্ঘ্য ইংরেজিতে" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">ভ্যাট আইডি নং দিন ইংরেজিতে....</span>

                                @error('vat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="signboard_width" class="col-sm-3 control-label">সাইন বোর্ড প্রস্থ</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="signboard_width" id="signboard_width" value="{{ old
                                ('signboard_width') ? old
                                ('signboard_width') : $organization->signboard_width }}"
                                       class="form-control @error('signboard_width')is-invalid @enderror"
                                       placeholder="প্রস্থ ইংরেজিতে" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">সাইন বোর্ড প্রস্থ দিন ইংরেজিতে....</span>

                                @error('signboard_width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="normal_signboard" class="col-sm-3 control-label">সাইনবোর্ড ধরন
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="signboard_type" id="signboard_type"
                                        class="form-control @error('signboard_type')is-invalid @enderror"
                                        data-parsley-trigger="keyup">
                                    <option value="">সিলেক্ট করুন</option>
                                    <option value="nion" {{  ($organization->signboard_type == "nion")? "selected":""
                                    }}
                                    >নিয়ন
                                    </option>
                                    <option value="lighting" {{  ($organization->signboard_type == "lighting")? "selected":""
                                    }} >আলোকসজ্জা
                                    </option>
                                    <option value="general" {{  ($organization->signboard_type == "general")? "selected":""
                                    }} >সাধারণ
                                    </option>
                                </select>

                                <span class="bt-flabels__error-desc">সাধারন সাইনবোর্ড দিন ....</span>

                                @error('signboard_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Paid-up-capital" class="col-sm-3 control-label" style="color:red;">পরিশোধিত
                                মূলধন (লিঃ কোম্পানির ক্ষেত্রে) <span> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="capital" id="capital"
                                       value="{{ old('capital')? old('capital') : $organization->capital }}"
                                       class="form-control @error('capital')is-invalid @enderror" autocomplete="capital"
                                       autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে) দিন ইংরেজিতে....</span>

                                @error('capital')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="business_type" class="col-sm-3 control-label">ব্যবসার ধরন (বাংলায়)
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" class="form-control @error('business_type')is-invalid @enderror"
                                       name="business_type" value="{{ $organization->business_type }}"
                                       id="business_type" data-parsley-required/>

                                <span class="bt-flabels__error-desc">ব্যবসার ধরন দিন....</span>

                                @error('business_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12">
                        <h4 class="app-heading text-center">
                            ব্যবসার ঠিকানা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="office_village_en" class="col-sm-3 control-label">গ্রাম/মহল্লা
                                (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_village_en" id="office_village_en"
                                       value="{{ old('office_village_en')? old('office_village_en') : $organization->office_village_en }}"
                                       class="form-control @error('office_village_en')is-invalid @enderror"
                                       autocomplete="office_village_en" autofocus placeholder=""
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('office_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)
                                <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_village_bn" id="office_village_bn"
                                       value="{{ old('office_village_bn')? old('office_village_bn') : $organization->office_village_bn }}"
                                       class="form-control @error('office_village_bn')is-invalid @enderror"
                                       placeholder="" autocomplete="office_village_bn" autofocus
                                       data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                @error('office_village_bn')
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
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>
                                <select onchange="getStreetNameBn(this.value)"
                                        class="custom-select2 form-control @error('trade_rbs_en') is-invalid @enderror"
                                        id="trade_rbs_en" name="trade_rbs_en" style="width: 100%; height: 38px;"
                                        >
                                    <option value="" class="">রোড নির্বাচন করুন-</option>
                                    @foreach($street_list as $item )
                                        <option value="{{$item->id}}" {{  ($item->id ==
                                        $organization->office_rbs_en ) ? "selected":""   }} >{{ $item->name_en
                                        }}</option>
                                    @endforeach
                                </select>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('trade_rbs_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                                (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" disabled id="trade_rbs_bn" value="{{ $organization->office_rbs_bn
                                }}" class="form-control"
                                       placeholder="রোড/ব্লক/সেক্টর"/>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_holding_no" id="office_holding_no"
                                       value="{{ old('office_holding_no')? old('office_holding_no') : $organization->office_holding_no }}"
                                       class="form-control @error('office_holding_no')is-invalid @enderror"
                                       autocomplete="office_holding_no" autofocus data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('office_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select
                                    class="custom-select2 form-control @error('office_ward_no') is-invalid @enderror"
                                    id="office_ward_no" name="office_ward_no" style="width: 100%; height: 38px;"
                                    data-parsley-required>
                                    <option value="" class="">ওয়ার্ড নির্বাচন করুন-</option>
                                    @for($i = 1; $i<= (int)$total_ward; $i++)
                                        <option
                                            value="{{ $i  }}" {{ ($i == $organization->office_ward_no)?"selected":"" }}>{{$i}}</option>
                                    @endfor
                                </select>


                                {{--                                <input type="text" name="office_ward_no" id="office_ward_no" value="{{ old('office_ward_no')? old('office_ward_no') : $organization->office_ward_no }}" class="form-control @error('office_ward_no')is-invalid @enderror" autocomplete="office_ward_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>--}}
                                {{--                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>--}}

                                @error('office_ward_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="trade_district_id" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'trade_district', 'trade_upazila_append', 'trade_upazila_id', 'trade_upazila', 3 )" name="trade_district_id" id="trade_district_id" class="custom-select2 form-control @error('trade_district_id')is-invalid @enderror"
                                    style="width: 100%; height: 38px;" data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                    <option value="{{ $organization->trade_district_id }}"
                                            selected="selected">{{ $organization->trade_district_name_en }}</option>
                                </select> --}}

                            <input class="form-control @error('trade_district_id') is-invalid @enderror" id="trade_district_txt" name="trade_district_txt" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('trade_district_txt', 'trade_district')" value="{{$organization->trade_district_name_bn}}"/>
                                    
                            <input type="hidden" id="trade_district_id" name="trade_district_id" value="{{$organization->trade_district_id}}" />

                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('trade_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="trade_district" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="trade_district" value="{{ $organization->trade_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="trade_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'trade_upazila', 'trade_post_office_append', 'trade_postoffice_id', 'trade_postoffice', 6 )" name="trade_upazila_id" id="trade_upazila_id" class="custom-select2 form-control @error('trade_upazila_id')is-invalid @enderror" data-parsley-required>
                                    <option value="" id="trade_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $organization->trade_upazila_id }}"
                                            selected="selected">{{ $organization->trade_upazila_name_en }}</option>
                                </select> --}}

                                <input class="form-control @error('trade_upazila_id') is-invalid @enderror" id="trade_upazila_txt" name="trade_upazila_txt" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('trade_upazila_txt', 'trade_upazila')" value="{{$organization->trade_upazila_name_bn}}" />
                                    
                                <input type="hidden" id="trade_upazila_id" name="trade_upazila_id" value="{{$organization->trade_upazila_id}}" />

                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('trade_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="trade_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="trade_upazila"
                                       value="{{ $organization->trade_upazila_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="trade_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                {{-- <select onchange="getLocation($(this).val(), 'trade_postoffice')"
                                        name="trade_postoffice_id" id="trade_postoffice_id"
                                        class="custom-select2 form-control @error('trade_postoffice_id')is-invalid @enderror"
                                        data-parsley-required>
                                    <option value="" id="trade_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $organization->trade_postoffice_id }}"
                                            selected="selected">{{ $organization->trade_postoffice_name_en }}</option>
                                </select> --}}

                                <input class="form-control @error('trade_postoffice_id') is-invalid @enderror" id="trade_postoffice_txt" name="trade_postoffice_txt" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy('trade_postoffice_txt', 'trade_postoffice')" value="{{$organization->trade_postoffice_name_bn}}" />
                                    
                                <input type="hidden" id="trade_postoffice_id" name="trade_postoffice_id" value="{{$organization->trade_postoffice_id}}" />

                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('trade_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="trade_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="trade_postoffice"
                                       value="{{ $organization->trade_postoffice_name_bn }}" class="form-control"
                                       placeholder=""/>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading text-center">
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
                                       value="{{ old('mobile')? old('mobile') : $organization->mobile }}"
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
                                       value="{{ old('email')? old('email') : $organization->email }}"
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

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Email" class="col-sm-3 control-label">ফোন (যদি থাকে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="tel" id="tel"
                                       value="{{ old('tel')? old('tel') : $organization->phone }}"
                                       class="form-control @error('tel')is-invalid @enderror" placeholder=""
                                       autocomplete="tel" autofocus data-parsley-type="digits"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ফোন নম্বর দিন....</span>

                                @error('tel')
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
                        <input type="hidden" name="tracking" value="{{ $organization->tracking }}">
                        <input type="hidden" name="trade_optional_id" value="{{ $organization->trade_optional_id }}">
                        <input type="hidden" name="application_id" value="{{ $organization->application_id }}">
                        <button type="submit" class="btn btn-primary">দাখিল করুন</button>
                    </div>
                </div>

            </form>
        </div>
    </section>

@endsection

@section('script')
    <script src="{{ asset('js/trade_license_form.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('js/custom_address.js') }}"></script>

    <script>
        financialBusinessOwnerType();

        $(function(){
            trade_address({{$key}});
        });

        function removeTab(x) {
            if ($('#owner-plus-btn').val() > x) {
                $('#error-' + x).before('<p class="text-danger text-center error">দুঃখিত! আপনার অপারেশন গ্রহণযোগ্য নয়। শেষ থেকে মুছে আসুন।</p>');
                $('.error').delay(3000).slideUp(300);
            } else {
                $('#owner-tab-link-' + x).remove();
                $('#owner-tab-' + x).remove();
                x--;
                $('#owner-tab-link-' + x).addClass('active');
                $('#owner-tab-' + x).addClass('active show');
                $('#owner-plus-btn').val(x);
            }
        }

        function genderStatus(x) {

            var genderInfo = $("input[name='gender[" + x + "]']:checked").val();
            var mstatus = $('#marital_status_' + x + '').val();

            if (typeof (genderInfo) === 'undefined') {
                genderInfo = 0;
                $('#genderError_' + x).css('border', '1px solid red');
                $('#genderError_' + x).css('border-radius', '4px');
                $('#genderError_' + x).css('padding', '10px');
                $('#genderErrorField_' + x).html('<span>অনুগ্রহ করে লিঙ্গ নির্বাচন করুন!</span>');
            } else {
                if (genderInfo == 2 && mstatus == 2) {
                    $('#genderError_' + x).removeAttr('style');
                    $('#genderErrorField_' + x).html('');
                    $('#showhidden-husband-name-' + x).show();
                  //  $('#husband_name_bn_' + x).attr('required', 'required');
                } else {
                    $('#genderError_' + x).removeAttr('style');
                    $('#genderErrorField_' + x).html('');

                    $('#showhidden-husband-name-' + x).hide();
                    $('#husband_name_en_' + x).val('');
                    $('#husband_name_bn_' + x).val('');
                    $('#husband_name_bn_' + x).removeAttr('required');
                }
            }
        }

        var district = '';

        function insertAddress(x) {
            if ($('#permanentBtn_' + x).is(":checked")) {
                district = $('#permanent_district_id_' + x).html();
                $('#permanent_village_bn_' + x).val($('#present_village_bn_' + x).val());
                $('#permanent_rbs_bn_' + x).val($('#present_rbs_bn_' + x).val());


                $('#permanent_village_en_' + x).val($('#present_village_en_' + x).val());
                $('#permanent_rbs_en_' + x).val($('#present_rbs_en_' + x).val());
                $('#permanent_holding_no_' + x).val($('#present_holding_no_' + x).val());
                $('#permanent_ward_no_' + x).val($('#present_ward_no_' + x).val());

                $('#permanent_district_id_' + x).html('<option value="' + $('#present_district_id_' + x).val() + '" selected="selected">' + $('#present_district_id_' + x + ' option:selected').text() + '</option>');
                $('#permanent_district_' + x).val($('#present_district_' + x).val());

                $('#permanent_upazila_id_' + x).html('<option value="' + $('#present_upazila_id_' + x).val() + '" selected="selected">' + $('#present_upazila_id_' + x + ' option:selected').text() + '</option>');
                $('#permanent_upazila_' + x).val($('#present_upazila_' + x).val());

                $('#permanent_postoffice_id_' + x).html('<option value="' + $('#present_postoffice_id_' + x).val() + '" selected="selected">' + $('#present_postoffice_id_' + x + ' option:selected').text() + '</option>');
                $('#permanent_postoffice_' + x).val($('#present_postoffice_' + x).val());
            } else if ($('#permanentBtn_' + x).is(":not(:checked)")) {
                $('#permanent_village_bn_' + x).val('');
                $('#permanent_rbs_bn_' + x).val('');
                $('#permanent_village_en_' + x).val('');
                $('#permanent_rbs_en_' + x).val('');
                $('#permanent_holding_no_' + x).val('');
                $('#permanent_ward_no_' + x).val('');

                $('#permanent_district_id_' + x).html(district);
                $('#permanent_district_' + x).val('জেলা');

                $('#permanent_upazila_id_' + x).html('<option value="" id="permanent_upazila_append_' + x + '">চিহ্নিত করুন</option>');
                $('#permanent_upazila_' + x).val('উপজেলা/থানা');

                $('#permanent_postoffice_id_' + x).html('<option value="" id="permanent_post_office_append_' + x + '">চিহ্নিত করুন</option>');
                $('#permanent_postoffice_' + x).val('পোস্ট অফিস');
            }
        }

        function cropTest(x) {
            $("#cropzee-input_" + x).cropzee({
                startSize: [100, 100, '%'],
                allowedInputs: ['png', 'jpg', 'jpeg'],
                imageExtension: 'image/jpg',
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });
        }

        // ============= business type auto complete ============== //

        let type_list = [];
        JSON.parse('{!!$business_type!!}').forEach(el => {

            if (el.id == "{{$organization->business_type}}")
                $("#business_type").val(el.name_bn);

            type_list.push(el.name_bn);
        });

        // console.log(type_list);
        $("#business_type").autocomplete({
            source: type_list,
            minLength: 0,
            autoFocus: true
        });

    </script>
@endsection
