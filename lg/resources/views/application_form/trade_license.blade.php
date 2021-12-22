@extends('layouts.master')
@section('head')
<!-- cropzee.js -->
<script src="{{ asset('js/cropzee.min.js') }}" defer></script>
<!--  -->
<link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center bg-primary"
                style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                <h4 style="color: white;">ট্রেড লাইসেন্স আবেদন</h4>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <form id="form-data" data-route="{{ $path.'/api/application/tradelicense' }}" method="post"
            enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate
            data-parsley-errors-messages-disabled>
            @csrf
            {{-- inlcude form header --}}
            @include('application_form/trade_warish_family_head');

            <div class="row" style="margin-top: 50px;">

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="name_Of_organization_en" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম
                            (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('name_Of_organization_en') has-error has-feedback @enderror"
                            id="name_Of_organization_en_status">
                            <input type="text" name="name_Of_organization_en" id="name_Of_organization_en"
                                value="{{ old('name_Of_organization_en') }}" class="form-control"
                                autocomplete="name_Of_organization_en" autofocus
                                data-parsley-pattern='^[a-zA-Z.)(,:; ]+$' data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম দিন ইংরেজিতে....</span>
                            @error('name_Of_organization_en')
                            <span id="name_Of_organization_en_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="name_Of_organization_bn" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (বাংলায়)
                            <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('name_Of_organization_bn') has-error has-feedback @enderror"
                            id="name_Of_organization_bn_status">
                            <input type="text" name="name_Of_organization_bn" id="name_Of_organization_bn"
                                value="{{ old('name_Of_organization_bn') }}" class="form-control"
                                autocomplete="name_Of_organization_bn" autofocus data-parsley-trigger="keyup"
                                data-parsley-required />
                            <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম দিন বাংলায়....</span>

                            @error('name_Of_organization_bn')
                            <span id="name_Of_organization_bn_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="type_of_organization" class="col-sm-3 control-label">প্রতিষ্ঠানের মালিকানার ধরণ
                            <span>*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('type_of_organization') has-error has-feedback @enderror"
                            id="type_of_organization_status">
                            <select name="type_of_organization" id="type_of_organization" class="form-control"
                                selected="selected" data-parsley-required>
                                <option value="" {{ (old('type_of_organization') == '') ? 'selected="selected"' : '' }}>
                                    চিহ্নিত করুন</option>
                                <option value="1" {{ (old('type_of_organization') == 1) ? 'selected="selected"' : '' }}>
                                    ব্যক্তি মালিকানাধীন</option>
                                <option value="2" {{ (old('type_of_organization') == 2) ? 'selected="selected"' : '' }}>
                                    যৌথ মালিকানা</option>
                                <option value="3" {{ (old('type_of_organization') == 3) ? 'selected="selected"' : '' }}>
                                    কোম্পানী</option>
                            </select>
                            <span class="bt-flabels__error-desc">প্রতিষ্ঠানের মালিকানার ধরণ চিহ্নিত করুন....</span>

                            @error('type_of_organization')
                            <span id="type_of_organization_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="col-md-12 text-center" id="national-id-error">

                </div>

                {{--Nav tab section--}}

                <ul class="nav nav-tabs" id="tab-append">
                    @php $owner = null; $count = null @endphp
                    @foreach(old()? old('name_bn') : [0 => 'Default'] as $key => $value)
                    @if(old())
                    @php
                    $count = count(old('name_bn'));
                    @endphp
                    @endif
                    <li class="{{ ($key == 0)? 'active' : 'show-hidden-tab-link' }}" id="owner-tab-link-{{ $key }}">
                        <a href="#owner-tab-{{ $key }}"
                            data-toggle="tab">{{ ($value == 'Default' || $count < 2)? 'মালিকের তথ্য' : 'মালিক '.Converter::en2bn($key+1) }}:</a>
                    </li>
                    @php $owner = $key @endphp
                    @endforeach

                    <li id="add-btn"><button type="button" value="{{ $owner }}" id="owner-plus-btn"
                            class="btn btn-primary"
                            {{ (old('type_of_organization') == 2 || old('type_of_organization') == 3) ? 'style=display:block;' : 'style=display:none;' }}><i
                                class="ion-ios-plus-outline"></i></button></li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    @foreach(old()? old('name_bn') : [0 => 'Default'] as $key => $value)
                    <div class="tab-pane fade {{ ($key == 0)? 'in active' : 'show-hidden-tab' }}"
                        id="owner-tab-{{ $key }}">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                @if($key != 0)
                                <button type="button" id="cancel-btn-{{ $key }}" onclick="removeTab({{ $key }})"
                                    class="btn btn-danger" style="float: right;">X</button>
                                @endif
                                <h4 class="panel-title text-center" id="error-{{ $key }}">মালিকের তথ্য:</h4>
                            </div>
                            <div class="panel-body" style="width: 100%;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="row form-group">
                                                <label for="name_en_{{ $key }}" class="col-sm-3 control-label">মালিকের
                                                    নাম(ইংরেজিতে)</label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('name_en.'.$key)has-error has-feedback @enderror"
                                                    id="name_en_{{ $key }}_status">
                                                    <input type="text" name="name_en[]" id="name_en_{{ $key }}"
                                                        value="{{ old('name_en.'.$key) }}" class="form-control"
                                                        placeholder="Full Name" autocomplete="name_en.{{ $key }}"
                                                        autofocus data-parsley-pattern='^[a-zA-Z. ]+$'
                                                        data-parsley-trigger="keyup" />
                                                    <span class="bt-flabels__error-desc">মালিকের নাম দিন
                                                        ইংরেজিতে....</span>

                                                    @error('name_en.'.$key)
                                                    <span id="name_en_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label for="name_bn_1" class="col-sm-3 control-label">মালিকের
                                                    নাম(বাংলায়) <span>*</span></label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('name_bn.'.$key)has-error has-feedback @enderror"
                                                    id="name_bn_{{ $key }}_status">
                                                    <input type="text" name="name_bn[]" id="name_bn_{{ $key }}"
                                                        value="{{ old('name_bn.'.$key) }}" class="form-control"
                                                        placeholder="পূর্ণ নাম" autocomplete="name_bn.{{ $key }}"
                                                        autofocus data-parsley-trigger="keyup" data-parsley-required />
                                                    <span class="bt-flabels__error-desc">মালিকের নাম দিন
                                                        বাংলায়....</span>

                                                    @error('name_bn.'.$key)
                                                    <span id="name_bn_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="nid_1" class="col-sm-3 control-label">জাতীয় পরিচয়পত্র
                                                    নং(ইংরেজিতে)</label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('nid.'.$key)has-error has-feedback @enderror"
                                                    id="nid_{{ $key }}_status">
                                                    <input type="text" name="nid[]" id="nid_{{ $key }}"
                                                        value="{{ old('nid.'.$key) }}" class="form-control"
                                                        data-parsley-maxlength="17" autocomplete="nid.{{ $key }}"
                                                        autofocus data-parsley-type="number"
                                                        data-parsley-trigger="keyup" placeholder="1616623458679011" />
                                                    <span class="bt-flabels__error-desc">জাতীয় পরিচয়পত্র নং দিন
                                                        ইংরেজিতে....</span>

                                                    @error('nid.'.$key)
                                                    <span id="nid_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label for="birth_id_{{ $key }}" class="col-sm-3 control-label">জন্ম
                                                    নিবন্ধন নং(ইংরেজিতে)</label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('birth_id.'.$key)has-error has-feedback @enderror"
                                                    id="birth_id_{{ $key }}_status">
                                                    <input type="text" name="birth_id[]" id="birth_id_{{ $key }}"
                                                        value="{{ old('birth_id.'.$key) }}" class="form-control"
                                                        data-parsley-maxlength="17" autocomplete="birth_id.{{ $key }}"
                                                        autofocus data-parsley-type="number"
                                                        data-parsley-trigger="keyup" placeholder="1919623458679011" />
                                                    <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন
                                                        ইংরেজিতে....</span>

                                                    @error('birth_id.'.$key)
                                                    <span id="birth_id_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="educational_qualification_{{ $key }}"
                                                    class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('educational_qualification.'.$key)has-error has-feedback @enderror"
                                                    id="educational_qualification_{{ $key }}_status">
                                                    <input type="text" name="educational_qualification[]"
                                                        id="educational_qualification_{{ $key }}"
                                                        value="{{ old('educational_qualification.'.$key) }}"
                                                        class="form-control" autofocus
                                                        autocomplete="educational_qualification.{{ $key }}"
                                                        data-parsley-maxlength="150" data-parsley-trigger="keyup"
                                                        placeholder="শিক্ষাগত যোগ্যতা দিন" />
                                                    <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন
                                                        ইংরেজিতে/বাংলায়....</span>

                                                    @error('educational_qualification.'.$key)
                                                    <span id="educational_qualification_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('religion.'.$key)has-error has-feedback @enderror"
                                                    id="religion_{{ $key }}_status">
                                                    <select name="religion[]" id="religion_{{ $key }}"
                                                        selected="selected" class="form-control" data-parsley-required>
                                                        <option value=''
                                                            {{ (old('religion.'.$key) == '') ? 'selected="selected"' : '' }}>
                                                            চিহ্নিত করুন</option>
                                                        <option value='1'
                                                            {{ (old('religion.'.$key) == 1) ? 'selected="selected"' : '' }}>
                                                            ইসলাম</option>
                                                        <option value='2'
                                                            {{ (old('religion.'.$key) == 2) ? 'selected="selected"' : '' }}>
                                                            হিন্দু</option>
                                                        <option value='3'
                                                            {{ (old('religion.'.$key) == 3) ? 'selected="selected"' : '' }}>
                                                            বৌদ্ধ ধর্ম</option>
                                                        <option value='4'
                                                            {{ (old('religion.'.$key) == 4) ? 'selected="selected"' : '' }}>
                                                            খ্রিস্ট ধর্ম</option>
                                                        <option value='5'
                                                            {{ (old('religion.'.$key) == 5) ? 'selected="selected"' : '' }}>
                                                            অন্যান্য</option>
                                                    </select>
                                                    <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন
                                                        করুন....</span>

                                                    @error('religion.'.$key)
                                                    <span id="religion_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="occupation_{{ $key }}"
                                                    class="col-sm-3 control-label">পেশা</label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('occupation.'.$key)has-error has-feedback @enderror"
                                                    id="occupation_{{ $key }}_status">
                                                    <input type="text" name="occupation[]" id="occupation_{{ $key }}"
                                                        value="{{ old('occupation.'.$key) }}"
                                                        class="form-control @error('occupation.'.$key) is-invalid @enderror"
                                                        autocomplete="occupation.0" autofocus
                                                        data-parsley-maxlength="120" data-parsley-trigger="keyup"
                                                        placeholder="পেশা দিন" />
                                                    <span class="bt-flabels__error-desc">পেশা দিন
                                                        ইংরেজিতে/বাংলায়....</span>

                                                    @error('occupation.'.$key)
                                                    <span id="occupation_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <label for="resident_{{ $key }}" class="col-sm-3 control-label">বাসিন্দা
                                                    <span>*</span></label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('resident.'.$key)has-error has-feedback @enderror"
                                                    id="resident_{{ $key }}_status">
                                                    <select name="resident[]" id='resident_{{ $key }}'
                                                        selected="selected" class="form-control" data-parsley-required>
                                                        <option value=''
                                                            {{ (old('resident.'.$key) == '') ? 'selected="selected"' : '' }}>
                                                            চিহ্নিত করুন</option>
                                                        <option value='1'
                                                            {{ (old('resident.'.$key) == 1) ? 'selected="selected"' : '' }}>
                                                            অস্থায়ী</option>
                                                        <option value='2'
                                                            {{ (old('resident.'.$key) == 2) ? 'selected="selected"' : '' }}>
                                                            স্থায়ী</option>
                                                    </select>
                                                    <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন
                                                        করুন....</span>

                                                    @error('occupation.'.$key)
                                                    <span id="resident_{{ $key }}_feedback"
                                                        class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cropzee-input_{{ $key }}" onclick="cropTest({{ $key }});">
                                                <div class="image-overlay">
                                                    <img src="{{ asset('images/default.jpg') }}"
                                                        class="image-previewer image" id="image-0"
                                                        data-cropzee="cropzee-input_{{ $key }}" />
                                                    <button for="cropzee-input_{{ $key }}"
                                                        class="btn btn-primary form-control"><i
                                                            class="ion-ios-upload-outline"></i> Upload</button>
                                                    <div class="overlay">
                                                        <div class="text">ক্লিক করুন</div>
                                                    </div>
                                                </div>
                                            </label>
                                            <input id="cropzee-input_{{ $key }}" style="display: none;" name="photo[]"
                                                type="file" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12" id="genderError_{{ $key }}">
                                    <div class="row form-group">
                                        <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                                        <div class="col-sm-3" id="gender_{{ $key }}_status">
                                            <label class="radio-inline"><input type="radio" id="gender_1"
                                                    name="gender[0]" {{ (old('gender.'.$key) == 1) ? 'checked' : '' }}
                                                    onclick="genderStatus({{ $key }})" value="1">পুরুষ</label>
                                            <label class="radio-inline"><input type="radio" id="gender_2"
                                                    name="gender[0]" {{ (old('gender.'.$key) == 2) ? 'checked' : '' }}
                                                    onclick="genderStatus({{ $key }})" value="2">মহিলা</label>
                                            <p class="text-danger" id="genderErrorField_{{ $key }}" role="alert"></p>

                                            @error('gender.'.$key)
                                            <span id="gender_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="marital_status_{{ $key }}" class="col-sm-3 control-label">বৈবাহিক
                                            সম্পর্ক <span>*</span></label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('marital_status.'.$key)has-error has-feedback @enderror"
                                            id="marital_status_{{ $key }}_status">
                                            <select name="marital_status[]" id="marital_status_{{ $key }}"
                                                selected="selected" onchange="genderStatus({{ $key }})"
                                                class="form-control" data-parsley-required>
                                                <option
                                                    {{ (old('marital_status.'.$key) == '') ? 'selected="selected"' : '' }}
                                                    value="">চিহ্নিত করুন</option>
                                                <option
                                                    {{ (old('marital_status.'.$key) == 1) ? 'selected="selected"' : '' }}
                                                    value='1'>অবিবাহিত</option>
                                                <option
                                                    {{ (old('marital_status.'.$key) == 2) ? 'selected="selected"' : '' }}
                                                    value='2'>বিবাহিত</option>
                                            </select>
                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                            @error('marital_status.'.$key)
                                            <span id="marital_status_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="showhidden-husband-name-{{ $key }}"
                                    style="display:{{ (old('gender.'.$key) == 2 && old('marital_status.'.$key) == 2)? 'block;' : 'none' }}">
                                    <div class="row form-group">
                                        <label for="husband_name_en_{{ $key }}" class="col-sm-3 control-label">স্বামীর
                                            নাম (ইংরেজিতে)</label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('husband_name_en.'.$key)has-error has-feedback @enderror"
                                            id="husband_name_en_{{ $key }}_status">
                                            <input type="text" name="husband_name_en[]"
                                                value="{{ old('husband_name_en.'.$key) }}"
                                                id="husband_name_en_{{ $key }}" class="form-control"
                                                placeholder="Name of husband" data-parsley-pattern="^[a-zA-Z. ]+$"
                                                data-parsley-trigger="keyup" />
                                            <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>
                                            <span id="husband_name_en_{{ $key }}_feedback" class="help-block"></span>

                                            @error('husband_name_en.'.$key)
                                            <span id="husband_name_en_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="husband_name_bn_{{ $key }}" class="col-sm-3 control-label">স্বামীর
                                            নাম (বাংলায়)</label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('husband_name_bn.'.$key)has-error has-feedback @enderror"
                                            id="husband_name_bn_{{ $key }}_status">
                                            <input type="text" name="husband_name_bn[]"
                                                value="{{ old('husband_name_bn.'.$key) }}"
                                                id="husband_name_bn_{{ $key }}" class="form-control"
                                                placeholder="স্বামীর নাম" />
                                            <span class="bt-flabels__error-desc">স্বামীর নাম দিন বাংলায়....</span>

                                            @error('husband_name_bn.'.$key)
                                            <span id="husband_name_bn_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <label for="father_name_en_{{ $key }}" class="col-sm-3 control-label">পিতার নাম
                                            (ইংরেজিতে)</label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('father_name_en.'.$key)has-error has-feedback @enderror"
                                            id="father_name_en_1_status">
                                            <input type="text" name="father_name_en[]" id="father_name_en_{{ $key }}"
                                                value="{{ old('father_name_en.'.$key) }}" class="form-control"
                                                autocomplete="father_name_en.{{ $key }}" autofocus
                                                data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                                placeholder="Father's Name" />
                                            <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                            @error('father_name_en.'.$key)
                                            <span id="father_name_en_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="father_name_bn_{{ $key }}" class="col-sm-3 control-label">পিতার নাম
                                            (বাংলায়) <span>*</span></label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('father_name_bn.'.$key)has-error has-feedback @enderror"
                                            id="father_name_bn_{{ $key }}_status">
                                            <input type="text" name="father_name_bn[]" id="father_name_bn_{{ $key }}"
                                                value="{{ old('father_name_bn.'.$key) }}" class="form-control"
                                                autocomplete="father_name_bn.{{ $key }}" autofocus
                                                placeholder="পিতার নাম" data-parsley-required />
                                            <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                            @error('father_name_bn.'.$key)
                                            <span id="father_name_bn_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <label for="mother_name_en_{{ $key }}" class="col-sm-3 control-label">মাতার নাম
                                            (ইংরেজিতে)</label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('mother_name_en.'.$key)has-error has-feedback @enderror"
                                            id="mother_name_en_{{ $key }}_status">
                                            <input type="text" name="mother_name_en[]" id="mother_name_en_{{ $key }}"
                                                value="{{ old('mother_name_en.'.$key) }}"
                                                data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                                autocomplete="mother_name_en.{{ $key }}" autofocus class="form-control"
                                                placeholder="Mother's Name" />
                                            <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                            @error('mother_name_en.'.$key)
                                            <span id="mother_name_en_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="mother_name_bn_{{ $key }}" class="col-sm-3 control-label">মাতার নাম
                                            (বাংলায়) <span>*</span></label>
                                        <div class="col-sm-3 bt-flabels__wrapper @error('mother_name_bn.'.$key)has-error has-feedback @enderror"
                                            id="mother_name_bn_{{ $key }}_status">
                                            <input type="text" name="mother_name_bn[]" id="mother_name_bn_{{ $key }}"
                                                value="{{ old('mother_name_bn.'.$key) }}" class="form-control"
                                                autocomplete="mother_name_bn.{{ $key }}" autofocus
                                                placeholder="মাতার নাম" data-parsley-trigger="keyup"
                                                data-parsley-required />
                                            <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                                            @error('mother_name_bn.'.$key)
                                            <span id="mother_name_bn_{{ $key }}_feedback"
                                                class="help-block">{{ $message }}</span>
                                            @enderror
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
                                            <label for="present_village_en_{{ $key }}"
                                                class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_village_en.'.$key)has-error has-feedback @enderror"
                                                id="present_village_en_{{ $key }}_status">
                                                <input type="text" name="present_village_en[]"
                                                    id="present_village_en_{{ $key }}"
                                                    value="{{ old('present_village_en.'.$key) }}" class="form-control"
                                                    autocomplete="present_village_en.{{ $key }}" autofocus
                                                    placeholder="" data-parsley-maxlength="100"
                                                    data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন
                                                    ইংরেজিতে....</span>

                                                @error('present_village_en.'.$key)
                                                <span id="present_village_en_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="present_village_bn_{{ $key }}"
                                                class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_village_bn.'.$key)has-error has-feedback @enderror"
                                                id="present_village_bn_{{ $key }}_status">
                                                <input type="text" name="present_village_bn[]"
                                                    id="present_village_bn_{{ $key }}"
                                                    value="{{ old('present_village_bn.'.$key) }}" class="form-control"
                                                    placeholder="" autocomplete="present_village_bn.{{ $key }}"
                                                    autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"
                                                    data-parsley-required />
                                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                                @error('present_village_bn.'.$key)
                                                <span id="present_village_bn_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="present_rbs_en_{{ $key }}"
                                                class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_rbs_en.'.$key)has-error has-feedback @enderror"
                                                id="present_rbs_en_{{ $key }}_status">
                                                <input type="text" name="present_rbs_en[]"
                                                    id="present_rbs_en_{{ $key }}"
                                                    value="{{ old('present_rbs_en.'.$key) }}" class="form-control"
                                                    placeholder="" autocomplete="present_rbs_en.{{ $key }}" autofocus
                                                    data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন
                                                    ইংরেজিতে....</span>

                                                @error('present_rbs_en.'.$key)
                                                <span id="present_rbs_en_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="present_rbs_bn_{{ $key }}"
                                                class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_rbs_bn.'.$key)has-error has-feedback @enderror"
                                                id="present_rbs_bn_{{ $key }}_status">
                                                <input type="text" name="present_rbs_bn[]"
                                                    id="present_rbs_bn_{{ $key }}"
                                                    value="{{ old('present_rbs_bn.'.$key) }}" class="form-control"
                                                    placeholder="" autocomplete="present_rbs_bn.{{ $key }}" autofocus
                                                    data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন
                                                    বাংলায়....</span>

                                                @error('present_rbs_bn.'.$key)
                                                <span id="present_rbs_bn_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="present_holding_no_{{ $key }}"
                                                class="col-sm-3 control-label">হোল্ডিং নং</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_holding_no.'.$key)has-error has-feedback @enderror"
                                                id="present_holding_no_{{ $key }}_status">
                                                <input type="text" name="present_holding_no[]"
                                                    id="present_holding_no_{{ $key }}"
                                                    value="{{ old('present_holding_no.'.$key) }}"
                                                    class="form-control @error('present_holding_no.'.$key)is-invalid @enderror"
                                                    autocomplete="present_holding_no.{{ $key }}" autofocus
                                                    data-parsley-type="number" data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                                @error('present_holding_no.'.$key)
                                                <span id="present_holding_no_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="present_ward_no_{{ $key }}"
                                                class="col-sm-3 control-label">ওয়ার্ড নং <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_ward_no.'.$key)has-error has-feedback @enderror"
                                                id="present_ward_no_{{ $key }}_status">
                                                <input type="text" name="present_ward_no[]"
                                                    id="present_ward_no_{{ $key }}"
                                                    value="{{ old('present_ward_no.'.$key) }}" class="form-control"
                                                    autocomplete="present_ward_no.{{ $key }}" autofocus
                                                    data-parsley-type="number" data-parsley-trigger="keyup"
                                                    data-parsley-required />
                                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                @error('present_ward_no.'.$key)
                                                <span id="present_ward_no_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="present_district_id_{{ $key }}"
                                                class="col-sm-3 control-label">জেলা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_district_id.'.$key)has-error has-feedback @enderror"
                                                id="present_district_id_{{ $key }}_status">
                                                <select
                                                    onchange="getLocation($(this).val(), 'present_district_{{ $key }}', 'present_upazila_append_{{ $key }}', 'present_upazila_id_{{ $key }}', 'present_upazila_{{ $key }}', 3 )"
                                                    class="custom-select2 form-control"
                                                    id="present_district_id_{{ $key }}" name="present_district_id[]"
                                                    style="width: 100%; height: 38px;" data-parsley-required>
                                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-
                                                    </option>

                                                    @foreach ($district as $item)
                                                    <option value="{{$item->id}}">{{$item->en_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                @error('present_district_id.'.$key)
                                                <span id="present_district_id_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="present_district_{{ $key }}" class="col-sm-3 control-label">জেলা
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" disabled id="present_district_{{ $key }}"
                                                    value="জেলা" class="form-control" placeholder="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="present_upazila_id_{{ $key }}"
                                                class="col-sm-3 control-label">উপজেলা/থানা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_upazila_id.'.$key)has-error has-feedback @enderror"
                                                id="present_upazila_id_{{ $key }}_status">
                                                <select
                                                    onchange="getLocation($(this).val(), 'present_upazila_{{ $key }}', 'present_post_office_append_{{ $key }}', 'present_postoffice_id_{{ $key }}', 'present_postoffice_{{ $key }}', 6 )"
                                                    name="present_upazila_id[]" id="present_upazila_id_{{ $key }}"
                                                    class="form-control" data-parsley-required>
                                                    <option value="" id="present_upazila_append_{{ $key }}">চিহ্নিত করুন
                                                    </option>
                                                </select>
                                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন
                                                    করুন....</span>

                                                @error('present_upazila_id.'.$key)
                                                <span id="present_upazila_id_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="present_upazila_{{ $key }}"
                                                class="col-sm-3 control-label">উপজেলা/থানা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" disabled id="present_upazila_{{ $key }}"
                                                    value="উপজেলা/থানা" class="form-control" placeholder="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="present_postoffice_id_{{ $key }}"
                                                class="col-sm-3 control-label">পোষ্ট অফিস <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('present_postoffice_id.'.$key)has-error has-feedback @enderror"
                                                id="present_postoffice_id_{{ $key }}_status">
                                                <select
                                                    onchange="getLocation($(this).val(), 'present_postoffice_{{ $key }}')"
                                                    name="present_postoffice_id[]" id="present_postoffice_id_{{ $key }}"
                                                    class="form-control" data-parsley-required>
                                                    <option value="" id="present_post_office_append_{{ $key }}">চিহ্নিত
                                                        করুন</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                @error('present_postoffice_id.'.$key)
                                                <span id="present_postoffice_id_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="present_postoffice_{{ $key }}"
                                                class="col-sm-3 control-label">পোষ্ট অফিস <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" disabled id="present_postoffice_{{ $key }}"
                                                    value="পোষ্ট অফিস" class="form-control" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 50px;">
                                    <div class="col-sm-12 text-center">
                                        <h4 class="app-heading">
                                            স্থায়ী ঠিকানা
                                        </h4>
                                        <p style="font-size:15px; font-weight:normal;padding-top:10px;"
                                            id="addressCheck-0"> <input type="checkbox" name="permanentBtn[]"
                                                id="permanentBtn_{{ $key }}"
                                                {{ old('permanentBtn.0') ? 'checked' : '' }}
                                                onclick="insertAddress({{ $key }});">ঠিকানা একই হলে টিক দিন</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="permanent_village_en_{{ $key }}"
                                                class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_village_en.'.$key)has-error has-feedback @enderror"
                                                id="permanent_village_en_{{ $key }}_status">
                                                <input type="text" name="permanent_village_en[]"
                                                    id="permanent_village_en_{{ $key }}"
                                                    value="{{ old('permanent_village_en.'.$key) }}" class="form-control"
                                                    autocomplete="permanent_village_en.{{ $key }}" autofocus
                                                    placeholder="" data-parsley-maxlength="100"
                                                    data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন
                                                    ইংরেজিতে....</span>

                                                @error('permanent_village_en.'.$key)
                                                <span id="permanent_village_en_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="permanent_village_bn_{{ $key }}"
                                                class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_village_bn.'.$key)has-error has-feedback @enderror"
                                                id="permanent_village_bn_1_status">
                                                <input type="text" name="permanent_village_bn[]"
                                                    id="permanent_village_bn_{{ $key }}"
                                                    value="{{ old('permanent_village_bn.'.$key) }}" class="form-control"
                                                    autocomplete="permanent_village_bn.{{ $key }}" autofocus
                                                    placeholder="" data-parsley-maxlength="100"
                                                    data-parsley-trigger="keyup" data-parsley-required />
                                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                                @error('permanent_village_bn.'.$key)
                                                <span id="permanent_village_bn_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="permanent_rbs_en_{{ $key }}"
                                                class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_rbs_en.'.$key)has-error has-feedback @enderror"
                                                id="permanent_rbs_en_{{ $key }}_status">
                                                <input type="text" name="permanent_rbs_en[]"
                                                    id="permanent_rbs_en_{{ $key }}"
                                                    value="{{ old('permanent_rbs_en.'.$key) }}" class="form-control"
                                                    placeholder="" autocomplete="permanent_rbs_en.{{ $key }}" autofocus
                                                    data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন
                                                    ইংরেজিতে....</span>

                                                @error('permanent_rbs_en.'.$key)
                                                <span id="permanent_rbs_en_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="permanent_rbs_bn_{{ $key }}"
                                                class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_rbs_bn.'.$key)has-error has-feedback @enderror"
                                                id="permanent_rbs_bn_{{ $key }}_status">
                                                <input type="text" name="permanent_rbs_bn[]"
                                                    id="permanent_rbs_bn_{{ $key }}"
                                                    value="{{ old('permanent_rbs_bn.'.$key) }}" class="form-control"
                                                    placeholder="" autocomplete="permanent_rbs_bn.{{ $key }}" autofocus
                                                    data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন
                                                    বাংলায়....</span>

                                                @error('permanent_rbs_bn.'.$key)
                                                <span id="permanent_rbs_bn_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="permanent_holding_no_{{ $key }}"
                                                class="col-sm-3 control-label">হোল্ডিং নং</label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_holding_no.'.$key)has-error has-feedback @enderror"
                                                id="permanent_holding_no_{{ $key }}_status">
                                                <input type="text" name="permanent_holding_no[]"
                                                    id="permanent_holding_no_{{ $key }}"
                                                    value="{{ old('permanent_holding_no.'.$key) }}"
                                                    class="form-control @error('permanent_holding_no.'.$key)is-invalid @enderror"
                                                    autocomplete="permanent_holding_no.{{ $key }}" autofocus
                                                    data-parsley-type="number" data-parsley-trigger="keyup" />
                                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                                @error('permanent_rbs_bn.'.$key)
                                                <span id="permanent_holding_no_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="permanent_ward_no_{{ $key }}"
                                                class="col-sm-3 control-label">ওয়ার্ড নং <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_ward_no.'.$key)has-error has-feedback @enderror"
                                                id="permanent_ward_no_{{ $key }}_status">
                                                <input type="text" name="permanent_ward_no[]"
                                                    id="permanent_ward_no_{{ $key }}"
                                                    value="{{ old('permanent_ward_no.'.$key) }}"
                                                    class="form-control @error('permanent_ward_no.'.$key)is-invalid @enderror"
                                                    autocomplete="permanent_ward_no.{{ $key }}" autofocus
                                                    data-parsley-type="number" data-parsley-trigger="keyup"
                                                    data-parsley-required />
                                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                @error('permanent_ward_no.'.$key)
                                                <span id="permanent_ward_no_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="permanent_district_id_{{ $key }}"
                                                class="col-sm-3 control-label">জেলা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_district_id.'.$key)has-error has-feedback @enderror"
                                                id="permanent_district_id_{{ $key }}_status">
                                                <select
                                                    onchange="getLocation($(this).val(), 'permanent_district_{{ $key }}', 'permanent_upazila_append_{{ $key }}', 'permanent_upazila_id_{{ $key }}', 'permanent_upazila_{{ $key }}', 3 )"
                                                    name="permanent_district_id[]" id="permanent_district_id_{{ $key }}"
                                                    class="custom-select2 form-control"
                                                    style="width: 100%; height: 38px;" data-parsley-required>
                                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-
                                                    </option>
                                                    @foreach ($district as $item)
                                                    <option value="{{$item->id}}">{{$item->en_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                @error('permanent_district_id.'.$key)
                                                <span id="permanent_district_id_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <label for="permanent_district_{{ $key }}"
                                                class="col-sm-3 control-label">জেলা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" disabled id="permanent_district_{{ $key }}"
                                                    value="জেলা" class="form-control" placeholder="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="permanent_upazila_id_{{ $key }}"
                                                class="col-sm-3 control-label">উপজেলা/থানা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_upazila_id.'.$key)has-error has-feedback @enderror"
                                                id="permanent_upazila_id_{{ $key }}_status">
                                                <select
                                                    onchange="getLocation($(this).val(), 'permanent_upazila_{{ $key }}', 'permanent_post_office_append_{{ $key }}', 'permanent_postoffice_id_{{ $key }}', 'permanent_postoffice_{{ $key }}', 6 )"
                                                    name="permanent_upazila_id[]" id="permanent_upazila_id_{{ $key }}"
                                                    class="form-control" data-parsley-required>
                                                    <option value="" id="permanent_upazila_append_{{ $key }}">চিহ্নিত
                                                        করুন</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন
                                                    করুন....</span>

                                                @error('permanent_upazila_id.'.$key)
                                                <span id="permanent_upazila_id_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="permanent_upazila_{{ $key }}"
                                                class="col-sm-3 control-label">উপজেলা/থানা <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" disabled id="permanent_upazila_{{ $key }}"
                                                    value="উপজেলা/থানা" class="form-control" placeholder="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="permanent_postoffice_id_{{ $key }}"
                                                class="col-sm-3 control-label">পোষ্ট অফিস <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('permanent_postoffice_id.'.$key)has-error has-feedback @enderror"
                                                id="permanent_postoffice_id_{{ $key }}_status">
                                                <select
                                                    onchange="getLocation($(this).val(), 'permanent_postoffice_{{ $key }}')"
                                                    name="permanent_postoffice_id[]"
                                                    id="permanent_postoffice_id_{{ $key }}" class="form-control"
                                                    data-parsley-required>
                                                    <option value="" id="permanent_post_office_append_{{ $key }}">
                                                        চিহ্নিত করুন</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                @error('permanent_postoffice_id.'.$key)
                                                <span id="permanent_postoffice_id_{{ $key }}_feedback"
                                                    class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="permanent_postoffice_{{ $key }}"
                                                class="col-sm-3 control-label">পোষ্ট অফিস <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" disabled id="permanent_postoffice_{{ $key }}"
                                                    value="পোষ্ট অফিস" class="form-control" placeholder="" />
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
                        <div class="col-sm-3 bt-flabels__wrapper @error('vat_id')has-error has-feedback @enderror"
                            id="vat_id_status">
                            <input type="text" name="vat_id" id="vat_id" value="{{ old('vat_id') }}"
                                class="form-control" placeholder="ইংরেজিতে" autocomplete="vat_id" autofocus
                                data-parsley-type="number" data-parsley-maxlength="17" data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">ভ্যাট আইডি নং দিন ইংরেজিতে....</span>

                            @error('vat_id')
                            <span id="vat_id_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="tax_id" class="col-sm-3 control-label">ট্যাক্স আইডি (যদি থাকে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('tax_id')has-error has-feedback @enderror"
                            id="tax_id_status">
                            <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id') }}"
                                class="form-control" placeholder="ইংরেজিতে" autocomplete="tax_id" autofocus
                                data-parsley-type="number" data-parsley-maxlength="17" data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">ট্যাক্স আইডি নং দিন ইংরেজিতে....</span>

                            @error('tax_id')
                            <span id="tax_id_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <div class="row form-group">
                            <label for="capital" class="col-sm-3 control-label" style="color:red;">পরিশোধিত মূলধন (লিঃ
                                কোম্পানির ক্ষেত্রে) <span> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper @error('capital')has-error has-feedback @enderror"
                                id="capital_status">
                                <input type="text" name="capital" id="capital" value="{{ old('capital') }}"
                                    class="form-control" autocomplete="capital" autofocus data-parsley-type="number"
                                    data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে) দিন
                                    ইংরেজিতে....</span>

                                @error('capital')
                                <span id="capital_feedback" class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <label for="business_type" class="col-sm-3 control-label">ব্যবসার ধরন <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper @error('business_type')has-error has-feedback @enderror"
                                id="type_of_business_bn_status">
                                <select class="form-control" name="business_type" selected="selected" id="business_type"
                                    data-parsley-required>
                                    <option value="">সিলেক্ট করুন</option>

                                    {{-- @foreach ((object)$business_type_data as $item)
                                    <option {{ (old('business_type') == $item->id) ? 'selected="selected"' : '' }}
                                        value="{{$item->id}}"> {{$item->name_bn}} </option>
                                    @endforeach --}}
                                </select>

                                <span class="bt-flabels__error-desc">ব্যবসার ধরন দিন বাংলায়....</span>

                                @error('business_type')
                                <span id="business_type_feedback" class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
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
                        <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_village_en')has-error has-feedback @enderror"
                            id="trade_village_en_status">
                            <input type="text" name="trade_village_en" id="trade_village_en"
                                value="{{ old('trade_village_en') }}" class="form-control"
                                autocomplete="trade_village_en" autofocus placeholder="" data-parsley-maxlength="100"
                                data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                            @error('trade_village_en')
                            <span id="trade_village_en_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_village_bn')has-error has-feedback @enderror"
                            id="trade_village_bn_status">
                            <input type="text" name="trade_village_bn" id="trade_village_bn"
                                value="{{ old('trade_village_bn') }}" class="form-control"
                                autocomplete="trade_village_bn" autofocus placeholder="" data-parsley-maxlength="100"
                                data-parsley-trigger="keyup" data-parsley-required />
                            <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                            @error('trade_village_bn')
                            <span id="trade_village_bn_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                            (ইংরেজিতে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_rbs_en')has-error has-feedback @enderror"
                            id="trade_rbs_en_status">
                            <input type="text" name="trade_rbs_en" id="trade_rbs_en" value="{{ old('trade_rbs_en') }}"
                                class="form-control @error('trade_rbs_en')is-invalid @enderror" placeholder=""
                                autocomplete="trade_rbs_en" autofocus data-parsley-maxlength="100"
                                data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                            @error('trade_rbs_en')
                            <span id="trade_rbs_en_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর
                            (বাংলায়)</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_rbs_bn')has-error has-feedback @enderror"
                            id="trade_rbs_bn_status">
                            <input type="text" name="trade_rbs_bn" id="trade_rbs_bn" value="{{ old('trade_rbs_bn') }}"
                                class="form-control" placeholder="" autocomplete="trade_rbs_bn" autofocus
                                data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                            @error('trade_rbs_bn')
                            <span id="trade_rbs_bn_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="trade_holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_holding_no')has-error has-feedback @enderror"
                            id="trade_holding_no_status">
                            <input type="text" name="trade_holding_no" id="trade_holding_no"
                                value="{{ old('trade_holding_no') }}"
                                class="form-control @error('trade_holding_no')is-invalid @enderror"
                                autocomplete="trade_holding_no" autofocus data-parsley-type="number"
                                data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                            @error('trade_holding_no')
                            <span id="trade_holding_no_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_ward_no')has-error has-feedback @enderror"
                            id="trade_ward_no_status">
                            <input type="text" name="trade_ward_no" id="trade_ward_no"
                                value="{{ old('trade_ward_no') }}" class="form-control" autocomplete="trade_ward_no"
                                autofocus data-parsley-type="number" data-parsley-trigger="keyup"
                                data-parsley-required />
                            <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                            @error('trade_ward_no')
                            <span id="trade_ward_no_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="trade_district_id" class="col-sm-3 control-label">জেলা <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_district_id')has-error has-feedback @enderror"
                            id="trade_district_id_status">
                            <select
                                onchange="getLocation($(this).val(), 'trade_district', 'trade_upazila_append', 'trade_upazila_id', 'trade_upazila', 3 )"
                                name="trade_district_id" id="trade_district_id" class="custom-select2 form-control"
                                style="width: 100%; height: 38px;" data-parsley-required>
                                <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                @foreach ($district as $item)
                                <option value="{{$item->id}}">{{$item->en_name}}</option>
                                @endforeach
                            </select>
                            <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                            @error('trade_district_id')
                            <span id="trade_district_id_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="trade_district" class="col-sm-3 control-label">জেলা <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="trade_district" value="জেলা" class="form-control"
                                placeholder="" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="trade_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_upazila_id')has-error has-feedback @enderror"
                            id="trade_upazila_id_status">
                            <select
                                onchange="getLocation($(this).val(), 'trade_upazila', 'trade_post_office_append', 'trade_post_office_id', 'trade_postoffice', 6 )"
                                name="trade_upazila_id" id="trade_upazila_id" class="form-control"
                                data-parsley-required>
                                <option value="" id="trade_upazila_append">চিহ্নিত করুন</option>
                            </select>
                            <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                            @error('trade_upazila_id')
                            <span id="trade_upazila_id_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="trade_upazila" class="col-sm-3 control-label">উপজেলা/থানা <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="trade_upazila" value="উপজেলা/থানা" class="form-control"
                                placeholder="" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="trade_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('trade_postoffice_id')has-error has-feedback @enderror"
                            id="trade_postoffice_id_status">
                            <select onchange="getLocation($(this).val(), 'trade_postoffice')" name="trade_postoffice_id"
                                id="trade_postoffice_id" class="form-control" data-parsley-required>
                                <option value="" id="trade_post_office_append">চিহ্নিত করুন</option>
                            </select>
                            <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                            @error('trade_postoffice_id')
                            <span id="trade_postoffice_id_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="trade_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" disabled id="trade_postoffice" value="পোষ্ট অফিস" class="form-control"
                                placeholder="" />
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
                        <div class="col-sm-3 bt-flabels__wrapper @error('mobile')has-error has-feedback @enderror"
                            id="mobile_status">
                            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                class="form-control" autocomplete="mobile" autofocus data-parsley-type="digits"
                                data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup"
                                data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                            <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                            @error('mobile')
                            <span id="mobile_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="Email" class="col-sm-3 control-label">ইমেল </label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('email')has-error has-feedback @enderror"
                            id="email_status">
                            <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control"
                                placeholder="example@gmail.com" autocomplete="email" autofocus data-parsley-type="email"
                                data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                            @error('email')
                            <span id="email_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="Email" class="col-sm-3 control-label">ফোন (যদি থাকে)</label>
                        <div class="col-sm-3 bt-flabels__wrapper @error('tel')has-error has-feedback @enderror"
                            id="tel_status">
                            <input type="text" name="tel" id="tel" value="{{ old('tel') }}" class="form-control"
                                placeholder="" autocomplete="tel" autofocus data-parsley-type="digits"
                                data-parsley-trigger="keyup" />
                            <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ফোন নম্বর দিন....</span>

                            @error('tel')
                            <span id="tel_feedback" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" style="margin-bottom: 100px;">
                <div class="col-sm-offset-6 col-sm-6 button-style">
                    <input type="hidden" value="{{ $id }}" name="web" id="web" />
                    {{-- <input type="hidden" value="{{ $unionProfile->union_id }}" name="union_id" id="union-id" /> --}}
                    <input type="hidden" value="{{ $unionProfile->fiscal_id }}" name="fiscal_id" />
                    <input type="hidden" value="" name="pin" id="nagorik-pin">
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

<script>
    function removeTab(x){
            if ($('#owner-plus-btn').val() > x){
                $('#error-'+x).before('<p class="text-danger text-center error">দুঃখিত! আপনার অপারেশন গ্রহণযোগ্য নয়। শেষ থেকে মুছে আসুন।</p>');
                $('.error').delay(3000).slideUp(300);
            }else {
                $('#owner-tab-link-'+x).remove();
                $('#owner-tab-'+x).remove();
                x--;
                $('#owner-tab-link-'+x).addClass('active');
                $('#owner-tab-'+x).addClass('in active');
                $('#owner-plus-btn').val(x);
            }
        }

        function genderStatus(x) {
            var genderInfo  = $("input[name='gender["+x+"]']:checked").val();
            var mstatus = $('#marital_status_'+x+'').val();

            if (typeof (genderInfo) === 'undefined'){
                genderInfo = 0;
                $('#genderError_'+x).css('border', '1px solid red');
                $('#genderError_'+x).css('border-radius', '4px');
                $('#genderError_'+x).css('padding', '10px');
                $('#genderErrorField_'+x).html('অনুগ্রহ করে লিঙ্গ নির্বাচন করুন!');
            }else{
                if (genderInfo == 2 && mstatus == 2) {
                $('#genderError_'+x).removeAttr('style');
                $('#genderErrorField_'+x).html('');


                $('#showhidden-husband-name-'+x).show();
            }else {
                $('#genderError_'+x).removeAttr('style');
                $('#genderErrorField_'+x).html('');

                $('#showhidden-husband-name-'+x).hide();
                $('#husband_name_en_'+x).val('');
                $('#husband_name_bn_'+x).val('');
            }
            }
        }

        var district = '';
        function insertAddress(x){
            if($('#permanentBtn_'+x).is(":checked")){
                district = $('#permanent_district_id_'+x).html();
                $('#permanent_village_bn_'+x).val($('#present_village_bn_'+x).val());
                $('#permanent_rbs_bn_'+x).val($('#present_rbs_bn_'+x).val());


                $('#permanent_village_en_'+x).val($('#present_village_en_'+x).val());
                $('#permanent_rbs_en_'+x).val($('#present_rbs_en_'+x).val());
                $('#permanent_holding_no_'+x).val($('#present_holding_no_'+x).val());
                $('#permanent_ward_no_'+x).val($('#present_ward_no_'+x).val());

                $('#permanent_district_id_'+x).html('<option value="'+$('#present_district_id_'+x).val()+'" selected="selected">'+$('#present_district_id_'+x+' option:selected').text()+'</option>');
                $('#permanent_district_'+x).val($('#present_district_'+x).val());

                $('#permanent_upazila_id_'+x).html('<option value="'+$('#present_upazila_id_'+x).val()+'" selected="selected">'+$('#present_upazila_id_'+x+' option:selected').text()+'</option>');
                $('#permanent_upazila_'+x).val($('#present_upazila_'+x).val());

                $('#permanent_postoffice_id_'+x).html('<option value="'+$('#present_postoffice_id_'+x).val()+'" selected="selected">'+$('#present_postoffice_id_'+x+' option:selected').text()+'</option>');
                $('#permanent_postoffice_'+x).val($('#present_postoffice_'+x).val());
            }
            else if($('#permanentBtn_'+x).is(":not(:checked)")){
                $('#permanent_village_bn_'+x).val('');
                $('#permanent_rbs_bn_'+x).val('');
                $('#permanent_village_en_'+x).val('');
                $('#permanent_rbs_en_'+x).val('');
                $('#permanent_holding_no_'+x).val('');
                $('#permanent_ward_no_'+x).val('');

                $('#permanent_district_id_'+x).html(district);
                $('#permanent_district_'+x).val('জেলা');

                $('#permanent_upazila_id_'+x).html('<option value="" id="permanent_upazila_append_'+x+'">চিহ্নিত করুন</option>');
                $('#permanent_upazila_'+x).val('উপজেলা/থানা');

                $('#permanent_postoffice_id_'+x).html('<option value="" id="permanent_post_office_append_'+x+'">চিহ্নিত করুন</option>');
                $('#permanent_postoffice_'+x).val('পোস্ট অফিস');
            }
        }

        function cropTest(x) {
            $("#cropzee-input_"+x).cropzee({
                startSize: [100, 100, '%'],
                allowedInputs: ['png','jpg','jpeg'],
                imageExtension: 'image/jpg',
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });
        }
</script>
@endsection