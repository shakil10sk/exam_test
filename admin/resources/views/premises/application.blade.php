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
                        <h4 class="text-center application_head">প্রিমিসেস লাইসেন্স আবেদন</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('premises_store') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
                <div class="row">
                    <div class="offset-2 col-md-8 mt-3">
                        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4><hr/>
                        <ul>
                            <li><i class="icon-copy ion-disc"></i> বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন ।</li>
                            <li><i class="icon-copy ion-disc"></i> ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন ।</li>
                            <li id="role" {{ (old('type_of_organization') >= 2)? 'style=display:none' : 'style=' }}><i class="icon-copy ion-disc"></i> আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে আপনার
                                মোবাইল অথবা ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা
                                পিন নং দিয়ে সার্চ করুন!</li>
                        </ul>

                        <div class="input-group mt-5" id="search" {{ (old('type_of_organization') >= 2)? 'style=display:none' : 'style=' }}>
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

                <div class="row mt-3">

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="name_Of_organization_en" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_Of_organization_en" id="name_Of_organization_en" value="{{ old('name_Of_organization_en') }}" class="form-control @error('name_Of_organization_en')is-invaliid @enderror" autocomplete="name_Of_organization_en" autofocus  data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম দিন ইংরেজিতে....</span>

                                @error('name_Of_organization_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="name_Of_organization_bn" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (বাংলায়) <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_Of_organization_bn" id="name_Of_organization_bn" value="{{ old('name_Of_organization_bn') }}" class="form-control @error('name_Of_organization_bn')is-invalid @enderror" autocomplete="name_Of_organization_bn" autofocus data-parsley-trigger="keyup" data-parsley-required />
                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম দিন বাংলায়....</span>

                                @error('name_Of_organization_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="type_of_organization" class="col-sm-3 control-label">প্রতিষ্ঠানের মালিকানার ধরণ <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="type_of_organization" id="type_of_organization" class="form-control @error('type_of_organization')is-invalid @enderror" selected="selected" data-parsley-required>
                                    <option value="" {{ (old('type_of_organization') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value="1" {{ (old('type_of_organization') == 1) ? 'selected="selected"' : '' }}>ব্যক্তি মালিকানাধীন</option>
                                    <option value="2" {{ (old('type_of_organization') == 2) ? 'selected="selected"' : '' }}>যৌথ মালিকানা</option>
                                    <option value="3" {{ (old('type_of_organization') == 3) ? 'selected="selected"' : '' }}>কোম্পানী</option>
                                </select>
                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের মালিকানার ধরণ চিহ্নিত করুন....</span>

                                @error('type_of_organization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 text-center" id="national-id-error">

                    </div>

                    {{--Nav tab section--}}

                    <ul class="nav nav-tabs" id="tab-append" role="tablist">

                        @php $owner = null; $count = null @endphp
                        @foreach(old('name_bn')? old('name_bn') : [0 => 'Default'] as $key => $value)
                        @if(old())
                        @php
                            $count = count(old('name_bn')??[]);
                        @endphp
                        @endif
                        <li class="nav-item owner-item-link">
                            <a class="nav-link {{ ($key == 0)? 'active' : '' }}" id="owner-tab-link-{{ $key }}" data-toggle="tab" href="#owner-tab-{{ $key }}" role="tab" aria-controls="owner-{{ $key }}">{{ ($value == 'Default' || $count < 2)? 'মালিকের তথ্য' : 'মালিক '.BanglaConverter::bn_number($key+1) }}:</a>
                            @php $owner = $key @endphp
                        </li>
                        @endforeach

                        <li class="nav-item" id="add-btn">
                        <button type="button" value="{{ $owner }}" id="owner-plus-btn" class="btn btn-primary" {{ (old('type_of_organization') == 2 || old('type_of_organization') == 3) ? 'style=display:block;' : 'style=display:none;' }}><i class="icon-copy ion-plus-circled"></i></button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach(old('name_bn')? old('name_bn') : [0 => 'Default'] as $key => $value)
                            <div class="tab-pane {{ ($key == 0)? 'show active' : 'show-hidden-tab' }} fade" role="tabpanel" id="owner-tab-{{ $key }}" >
                                <div class="card card-info">
                                    <div class="card-heading p-2">
                                        @if($key != 0)
                                        <button type="button" id="cancel-btn-{{ $key }}" onclick="removeTab({{ $key }})" class="btn btn-danger" style="float: right;">X</button>
                                        @endif
                                        <h4 class="card-title text-center" id="error-{{ $key }}">মালিকের তথ্য:</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row form-group">
                                                        <label for="name_en_{{ $key }}" class="col-sm-3 control-label">মালিকের নাম(ইংরেজিতে)</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <input type="text" name="name_en[]" id="name_en_{{ $key }}" value="{{ old('name_en.'.$key) }}" class="form-control @error('name_en.'.$key)is-invalid @enderror" placeholder="Full Name" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                                            <span class="bt-flabels__error-desc">মালিকের নাম দিন ইংরেজিতে....</span>

                                                            @error('name_en.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <label for="name_bn_{{ $key }}" class="col-sm-3 control-label">মালিকের নাম(বাংলায়) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <input type="text" name="name_bn[]" id="name_bn_{{ $key }}" value="{{ old('name_bn.'.$key) }}" class="form-control @error('name_bn.'.$key)is-invalid @enderror" placeholder="পূর্ণ নাম" autofocus data-parsley-trigger="keyup" data-parsley-required />
                                                            <span class="bt-flabels__error-desc">মালিকের নাম দিন বাংলায়....</span>

                                                            @error('name_bn.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label for="nid_{{ $key }}" class="col-sm-3 control-label">জাতীয় পরিচয়পত্র নং(ইংরেজিতে)</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper" id="nid_id_div_1">
                                                            <input type="text" name="nid[]" id="nid_{{ $key }}" value="{{ old('nid.'.$key) }}" class="form-control @error('nid.'.$key)is-invalid @enderror" data-parsley-maxlength="17" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                                            <span class="bt-flabels__error-desc">জাতীয় পরিচয়পত্র নং দিন ইংরেজিতে....</span>

                                                            @error('nid.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <label for="birth_id_{{ $key }}" class="col-sm-3 control-label">জন্ম নিবন্ধন নং(ইংরেজিতে)</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper @error('birth_id.0')is-invalid @enderror" id="birth_id_div_1">
                                                            <input type="text" name="birth_id[]" id="birth_id_{{ $key }}" value="{{ old('birth_id.'.$key) }}" class="form-control @error('birth_id.'.$key)is-invalid @enderror" data-parsley-maxlength="17" autofocus data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
                                                            <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>

                                                            @error('birth_id.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label for="educational_qualification_{{ $key }}" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <input type="text" name="educational_qualification[]" id="educational_qualification_{{ $key }}" value="{{ old('educational_qualification.'.$key) }}" class="form-control @error('educational_qualification.'.$key)is-invalid @enderror" autofocus data-parsley-maxlength="150" data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন" />
                                                            <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>

                                                            @error('educational_qualification.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>

                                                        <label class="col-sm-3 control-label">ধর্ম <span class="text-danger">*</span></label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <select name="religion[]" id="religion_{{ $key }}" selected="selected" class="form-control @error('religion.'.$key)is-invalid @enderror" data-parsley-required >
                                                                <option value='' {{ (old('resident.'.$key) == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                                                <option value='1' {{ (old('resident.'.$key) == 1) ? 'selected="selected"' : '' }}>ইসলাম</option>
                                                                <option value='2' {{ (old('resident.'.$key) == 2) ? 'selected="selected"' : '' }}>হিন্দু</option>
                                                                <option value='3' {{ (old('resident.'.$key) == 3) ? 'selected="selected"' : '' }}>বৌদ্ধ ধর্ম</option>
                                                                <option value='4' {{ (old('resident.'.$key) == 4) ? 'selected="selected"' : '' }}>খ্রিস্ট ধর্ম</option>
                                                                <option value='5' {{ (old('resident.'.$key) == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
                                                            </select>
                                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                                            @error('religion.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label for="occupation_{{ $key }}" class="col-sm-3 control-label">পেশা</label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <input type="text" name="occupation[]" id="occupation_{{ $key }}" value="{{ old('occupation.'.$key) }}" class="form-control @error('occupation.'.$key) is-invalid @enderror" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                                                            <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                                            @error('occupation.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>

                                                        <label class="col-sm-3 control-label">বাসিন্দা <span class="text-danger">*</span></label>
                                                        <div class="col-sm-3 bt-flabels__wrapper">
                                                            <select name="resident[]" id='resident_{{ $key }}' selected="selected" class="form-control @error('resident.'.$key)is-invalid @enderror" data-parsley-required >
                                                                <option value='' {{ (old('resident.'.$key) == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                                                <option value='1' {{ (old('resident.'.$key) == 1) ? 'selected="selected"' : '' }}>অস্থায়ী</option>
                                                                <option value='2' {{ (old('resident.'.$key) == 2) ? 'selected="selected"' : '' }}>স্থায়ী</option>
                                                            </select>
                                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                                            @error('resident.'.$key)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="cropzee-input_{{ $key }}" onclick="cropTest({{ $key }});">
                                                        <div class="image-overlay">
                                                            <img src="{{ asset('images/application/default.jpg') }}" class="image-previewer image" id="image-0" data-cropzee="cropzee-input_{{ $key }}" />
                                                            <button for="cropzee-input_{{ $key }}" class="btn btn-primary form-control"><i class="ion-ios-upload-outline"></i> Upload</button>
                                                            <div class="overlay">
                                                                <div class="text">ক্লিক করুন</div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input id="cropzee-input_{{ $key }}" style="display: none;" name="photo[]" type="file" accept="image/*">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12" id="genderError_{{ $key }}">
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label wrap">লিঙ্গ <span class="text-danger">*</span></label>
                                                <div class="col-sm-3 wrap">
                                                    <label class="radio-inline"><input type="radio" id="gender_1" class="@error('gender.'.$key)is-invalid @enderror" name="gender[{{ $key }}]" {{ (old('gender.'.$key) == 1) ? 'checked' : '' }} onclick="genderStatus({{ $key }})" value="1" >পুরুষ </label>
                                                    <label class="radio-inline"><input type="radio" id="gender_2" class="@error('gender.'.$key)is-invalid @enderror" name="gender[{{ $key }}]" {{ (old('gender.'.$key) == 2) ? 'checked' : '' }} onclick="genderStatus({{ $key }})" value="2" >মহিলা</label>

                                                    <p class="has-danger" id="genderErrorField_{{ $key }}" role="alert"></p>
                                                    @error('gender.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <label for="marital_status_{{ $key }}" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span class="text-danger">*</span></label>
                                                <div class="col-sm-3 bt-flabels__wrapper">
                                                    <select name="marital_status[]" id="marital_status_{{ $key }}" onchange="genderStatus({{ $key }})" selected="selected" class="form-control @error('marital_status.'.$key)is-invalid @enderror" data-parsley-required >
                                                        <option {{ (old('marital_status.'.$key) == '') ? 'selected="selected"' : '' }} value="">চিহ্নিত করুন</option>
                                                        <option {{ (old('marital_status.'.$key) == 1) ? 'selected="selected"' : '' }} value='1'>অবিবাহিত</option>
                                                        <option {{ (old('marital_status.'.$key) == 2) ? 'selected="selected"' : '' }} value='2'>বিবাহিত</option>
                                                    </select>
                                                    <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                                    @error('marital_status.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="showhidden-husband-name-{{ $key }}" style="display:{{ (old('gender.'.$key) == 2 && old('marital_status.'.$key) == 2)? 'block;' : 'none' }}">
                                            <div class="row form-group bt-flabels__wrapper">
                                                <label for="husband_name_en_{{ $key }}" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="husband_name_en[]" id="husband_name_en_{{ $key }}" class="form-control @error('husband_name_en.'.$key)is-invalid @enderror" placeholder="" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"/>
                                                    <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                                    @error('husband_name_en.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <label for="husband_name_bn_{{ $key }}" class="col-sm-3 control-label">স্বামীর নাম (বাংলায়)</label>
                                                <div class="col-sm-3 bt-flabels__wrapper">
                                                    <input type="text" name="husband_name_bn[]" id="husband_name_bn_{{ $key }}" class="form-control @error('husband_name_bn.'.$key)is-invalid @enderror" placeholder="" />
                                                    <span class="bt-flabels__error-desc">স্বামীর নাম দিন বাংলায়....</span>

                                                    @error('husband_name_bn.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <label for="father_name_en_{{ $key }}" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>
                                                <div class="col-sm-3 bt-flabels__wrapper">
                                                    <input type="text" name="father_name_en[]" id="father_name_en_{{ $key }}" value="{{ old('father_name_en.'.$key) }}" class="form-control @error('father_name_en.'.$key) is-invalid @enderror" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="Father's Name" />
                                                    <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                                    @error('father_name_en.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <label for="father_name_bn_{{ $key }}" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span class="text-danger">*</span></label>
                                                <div class="col-sm-3 bt-flabels__wrapper">
                                                    <input type="text" name="father_name_bn[]" id="father_name_bn_{{ $key }}" value="{{ old('father_name_bn.'.$key) }}" class="form-control @error('father_name_bn.'.$key) is-invalid @enderror" autofocus placeholder="পিতার নাম" data-parsley-required />
                                                    <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                                    @error('father_name_bn.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <label for="mother_name_en_{{ $key }}" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>
                                                <div class="col-sm-3 bt-flabels__wrapper">
                                                    <input type="text" name="mother_name_en[]" id="mother_name_en_{{ $key }}" value="{{ old('mother_name_en.'.$key) }}" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" autofocus class="form-control @error('mother_name_en.'.$key)is-invalid @enderror" placeholder="Mother's Name" />
                                                    <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                                    @error('mother_name_en.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <label for="mother_name_bn_{{ $key }}" class="col-sm-3 control-label">মাতার নাম (বাংলায়) <span class="text-danger">*</span></label>
                                                <div class="col-sm-3 bt-flabels__wrapper">
                                                    <input type="text" name="mother_name_bn[]" id="mother_name_bn_{{ $key }}" value="{{ old('mother_name_bn.'.$key) }}" class="form-control @error('mother_name_bn.'.$key)is-invalid @enderror" autofocus placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />
                                                    <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                                                    @error('mother_name_bn.'.$key)
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
                                                    <label for="present_village_en_{{ $key }}" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_village_en[]" id="present_village_en_{{ $key }}" value="{{ old('present_village_en.'.$key) }}" class="form-control @error('present_village_en.'.$key)is-invalid @enderror" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                                        @error('present_village_en.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_village_bn_{{ $key }}" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span> </label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_village_bn[]" id="present_village_bn_{{ $key }}" value="{{ old('present_village_bn.'.$key) }}" class="form-control @error('present_village_bn.'.$key)is-invalid @enderror" placeholder="" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                                        @error('present_village_bn.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_rbs_en_{{ $key }}" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_rbs_en[]" id="present_rbs_en_{{ $key }}" value="{{ old('present_rbs_en.'.$key) }}" class="form-control @error('present_rbs_en.'.$key)is-invalid @enderror" placeholder="" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                                        @error('present_rbs_en.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_rbs_bn_{{ $key }}" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_rbs_bn[]" id="present_rbs_bn_{{ $key }}" value="{{ old('present_rbs_bn.'.$key) }}" class="form-control @error('present_rbs_bn.'.$key)is-invalid @enderror" placeholder="" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                                        @error('present_rbs_bn.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                <label for="present_holding_no_{{ $key }}" class="col-sm-3 control-label">হোল্ডিং নং</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_holding_no[]" id="present_holding_no_{{ $key }}" value="{{ old('present_holding_no.'.$key) }}" class="form-control @error('present_holding_no.'.$key)is-invalid @enderror" autofocus  data-parsley-trigger="keyup"  />
                                                        <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                                        @error('present_holding_no.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_ward_no_{{ $key }}" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="present_ward_no[]" id="present_ward_no_{{ $key }}" value="{{ old('present_ward_no.'.$key) }}" class="form-control @error('present_ward_no.'.$key)is-invalid @enderror" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                        @error('present_ward_no.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_district_id_{{ $key }}" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select onchange="getLocation($(this).val(), 'present_district_{{ $key }}', 'present_upazila_append_{{ $key }}', 'present_upazila_id_{{ $key }}', 'present_upazila_{{ $key }}', 3 )" class="custom-select2 form-control @error('present_district_id.'.$key)is-invalid @enderror" id="present_district_id_{{ $key }}" name="present_district_id[]" style="width: 100%; height: 38px;" data-parsley-required>
                                                            <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                                        </select>
                                                        <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                        @error('present_district_id.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="present_district_{{ $key }}" class="col-sm-3 control-label">জেলা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="present_district_{{ $key }}" value="জেলা" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_upazila_id_{{ $key }}" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select onchange="getLocation($(this).val(), 'present_upazila_{{ $key }}', 'present_post_office_append_{{ $key }}', 'present_postoffice_id_{{ $key }}', 'present_postoffice_{{ $key }}', 6 )" name="present_upazila_id[]" id="present_upazila_id_{{ $key }}" class="custom-select2 form-control @error('present_upazila_id.'.$key)is-invalid @enderror" data-parsley-required >
                                                            <option value="" id="present_upazila_append_{{ $key }}">চিহ্নিত করুন</option>
                                                        </select>
                                                        <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                                        @error('present_upazila_id.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="present_upazila_{{ $key }}" class="col-sm-3 control-label">উপজেলা/থানা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="present_upazila_{{ $key }}" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="present_postoffice_id_{{ $key }}" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select onchange="getLocation($(this).val(), 'present_postoffice_{{ $key }}')" name="present_postoffice_id[]" id="present_postoffice_id_{{ $key }}" class="custom-select2 form-control @error('present_postoffice_id.'.$key)is-invalid @enderror" data-parsley-required >
                                                            <option value="" id="present_post_office_append_{{ $key }}">চিহ্নিত করুন</option>
                                                        </select>
                                                        <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                        @error('present_postoffice_id.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="present_postoffice_{{ $key }}" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="present_postoffice_{{ $key }}" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 50px;">
                                            <div class="col-sm-12 text-center">
                                                <h4 class="app-heading">
                                                    স্থায়ী  ঠিকানা
                                                </h4>
                                                <p style="font-size:15px; font-weight:normal;padding-top:10px;" id="addressCheck-0"> <input type="checkbox" id="permanentBtn_{{ $key }}" name="permanemtBtn[]" {{ old('permanentBtn.'.$key) ? 'checked' : '' }} onclick="insertAddress({{ $key }});">ঠিকানা একই হলে টিক দিন</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_village_en_{{ $key }}" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_village_en[]" id="permanent_village_en_{{ $key }}" value="{{ old('permanent_village_en.'.$key) }}" class="form-control @error('permanent_village_en.'.$key)is-invalid @enderror" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                                        @error('permanent_village_en.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_village_bn_{{ $key }}" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_village_bn[]" id="permanent_village_bn_{{ $key }}" value="{{ old('permanent_village_bn.'.$key) }}" class="form-control @error('permanent_village_bn.'.$key)is-invalid @enderror" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                                        @error('permanent_village_bn.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_rbs_en_{{ $key }}" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_rbs_en[]" id="permanent_rbs_en_{{ $key }}" value="{{ old('permanent_rbs_en.'.$key) }}" class="form-control @error('permanent_rbs_en.'.$key)is-invalid @enderror" placeholder="" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                                        @error('permanent_rbs_en.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_rbs_bn_{{ $key }}" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_rbs_bn[]" id="permanent_rbs_bn_{{ $key }}" value="{{ old('permanent_rbs_bn.'.$key) }}" class="form-control @error('permanent_rbs_bn.'.$key)is-invalid @enderror" placeholder="" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                                        <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                                        @error('permanent_rbs_bn.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_holding_no_{{ $key }}" class="col-sm-3 control-label">হোল্ডিং নং</label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_holding_no[]" id="permanent_holding_no_{{ $key }}" value="{{ old('permanent_holding_no.'.$key) }}" class="form-control @error('permanent_holding_no.'.$key)is-invalid @enderror" autofocus  data-parsley-trigger="keyup"  />
                                                        <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                                        @error('permanent_holding_no.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_ward_no_{{ $key }}" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <input type="text" name="permanent_ward_no[]" id="permanent_ward_no_{{ $key }}" value="{{ old('permanent_ward_no.'.$key) }}" class="form-control @error('permanent_ward_no.'.$key)is-invalid @enderror" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                                        <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                        @error('permanent_ward_no.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_district_id_{{ $key }}" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select onchange="getLocation($(this).val(), 'permanent_district_{{ $key }}', 'permanent_upazila_append_{{ $key }}', 'permanent_upazila_id_{{ $key }}', 'permanent_upazila_{{ $key }}', 3 )" name="permanent_district_id[]" id="permanent_district_id_{{ $key }}" class="custom-select2 form-control @error('permanent_district_id.'.$key)is-invalid @enderror" style="width: 100%; height: 38px;" data-parsley-required >
                                                            <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                                        </select>
                                                        <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                        @error('permanent_district_id.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <label for="permanent_district_{{ $key }}" class="col-sm-3 control-label">জেলা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="permanent_district_{{ $key }}" value="জেলা" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_upazila_id_{{ $key }}" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select onchange="getLocation($(this).val(), 'permanent_upazila_{{ $key }}', 'permanent_post_office_append_{{ $key }}', 'permanent_postoffice_id_{{ $key }}', 'permanent_postoffice_{{ $key }}', 6 )" name="permanent_upazila_id[]" id="permanent_upazila_id_{{ $key }}" class="custom-select2 form-control @error('permanent_upazila_id.'.$key)is-invalid @enderror" data-parsley-required >
                                                            <option value="" id="permanent_upazila_append_{{ $key }}">চিহ্নিত করুন</option>
                                                        </select>
                                                        <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                                        @error('permanent_upazila_id.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="permanent_upazila_{{ $key }}" class="col-sm-3 control-label">উপজেলা/থানা</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="permanent_upazila_{{ $key }}" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row form-group">
                                                    <label for="permanent_postoffice_id_{{ $key }}" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                                    <div class="col-sm-3 bt-flabels__wrapper">
                                                        <select onchange="getLocation($(this).val(), 'permanent_postoffice_{{ $key }}')" name="permanent_postoffice_id[]" id="permanent_postoffice_id_{{ $key }}" class="custom-select2 form-control @error('permanent_postoffice_id.'.$key)is-invalid @enderror" data-parsley-required >
                                                            <option value="" id="permanent_post_office_append_{{ $key }}">চিহ্নিত করুন</option>
                                                        </select>
                                                        <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                        @error('permanent_postoffice_id.'.$key)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <label for="permanent_postoffice_{{ $key }}" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" disabled id="permanent_postoffice_{{ $key }}" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
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
                            <label for="Vat-id" class="col-sm-3 control-label">ভ্যাট আইডি (যদি থাকে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="vat_id" id="vat_id" value="{{ old('vat_id') }}" class="form-control @error('vat_id')is-invalid @enderror" placeholder="ইংরেজিতে" autocomplete="vat_id" autofocus data-parsley-type="number" data-parsley-maxlength="17" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">ভ্যাট আইডি নং দিন ইংরেজিতে....</span>

                                @error('vat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Tax-id" class="col-sm-3 control-label">ট্যাক্স আইডি (যদি থাকে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="tax_id" id="tax_id" value="{{ old('tax_id') }}" class="form-control @error('tax_id')is-invalid @enderror" placeholder="ইংরেজিতে" autocomplete="tax_id" autofocus data-parsley-type="number" data-parsley-maxlength="17" data-parsley-trigger="keyup" />
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
                                <input type="text" name="signboard_length" id="signboard_length" value="{{ old('signboard_length') }}"
                                       class="form-control @error('signboard_length')is-invalid @enderror"
                                       placeholder="দৈর্ঘ্য ইংরেজিতে" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">সাইন বোর্ড দৈর্ঘ্য দিন ইংরেজিতে....</span>

                                @error('vat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="signboard_width" class="col-sm-3 control-label">সাইন বোর্ড প্রস্থ</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="signboard_width" id="signboard_width" value="{{ old('signboard_width') }}"
                                       class="form-control @error('signboard_width')is-invalid @enderror"
                                       placeholder="প্রস্থ ইংরেজিতে" data-parsley-trigger="keyup" />
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
                            <label for="normal_signboard" class="col-sm-3 control-label">সাধারন সাইনবোর্ড
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="normal_signboard" id="normal_signboard" value="{{ old('normal_signboard') }}"
                                       class="form-control @error('normal_signboard')is-invalid @enderror" placeholder="সরকারি জমি/ভবন বেসরকারি জমি/ভবন"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">সাধারন সাইনবোর্ড দিন ....</span>

                                @error('normal_signboard')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="lighted_signboard" class="col-sm-3 control-label">আলোক সজ্জিত সাইনবোর্ড
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="lighted_signboard" id="lighted_signboard" value="{{ old('lighted_signboard') }}"
                                       class="form-control @error('lighted_signboard')is-invalid @enderror" placeholder="সরকারি জমি/ভবন বেসরকারি জমি/ভবন"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">আলোক সজ্জিত সাইনবোর্ড দিন....</span>

                                @error('lighted_signboard')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="agent_name_en" class="col-sm-3 control-label">জয়েন্ট স্টক কোম্পানীর ক্ষেত্রে
                                ডাইরেক্টর/ম্যানেজিং এজেন্টের নাম (ইংরেজিতে)
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="agent_name_en" id="agent_name_en" value="{{ old('agent_name_en') }}"
                                       class="form-control @error('agent_name_en')is-invalid @enderror" placeholder="ম্যানেজিং এজেন্টের নাম"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">ম্যানেজিং এজেন্টের নাম দিন ইংরেজিতে....</span>

                                @error('agent_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="agent_name_bn" class="col-sm-3 control-label">জয়েন্ট স্টক কোম্পানীর ক্ষেত্রে
                                ডাইরেক্টর/ম্যানেজিং এজেন্টের নাম (বাংলায়)
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="agent_name_bn" id="agent_name_bn" value="{{ old('agent_name_en') }}"
                                       class="form-control @error('agent_name_bn')is-invalid @enderror" placeholder="ম্যানেজিং এজেন্টের নাম"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">ম্যানেজিং এজেন্টের নাম দিন বাংলায়....</span>

                                @error('agent_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="business_start_date" class="col-sm-3 control-label">ব্যবসা আরম্ভের তারিখ
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="business_start_date" id="business_start_date" value="{{ old
                                ('business_start_date') }}"
                                       class="form-control @error('business_start_date')is-invalid @enderror"
                                       placeholder="yyyy-mm-dd" autocomplete="business_start_date"
                                        data-parsley-type="date"
                                       data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">ব্যবসা আরম্ভের তারিখ দিন ....</span>

                                @error('business_start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="previous_license_data" class="col-sm-3 control-label">পূর্বে লাইসেন্স নবায়নের
                                তারিখ
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="previous_license_data" id="previous_license_data" value="{{ old('previous_license_data') }}"
                                       class="form-control @error('previous_license_data')is-invalid @enderror"
                                       placeholder="yyyy-mm-dd" autocomplete="previous_license_data"
                                       data-parsley-type="date"  data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">পূর্বে লাইসেন্স নবায়নের
                                তারিখ দিন....</span>

                                @error('previous_license_data')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Paid-up-capital" class="col-sm-3 control-label" style="color:red;">পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে) <span> *</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="capital" id="capital" value="{{ old('capital') }}" class="form-control @error('capital')is-invalid @enderror" autocomplete="capital" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে) দিন ইংরেজিতে....</span>

                                @error('capital')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="building_size" class="col-sm-3 control-label">ভবন/গৃহের আয়তন
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper ">

                                <input type="text"  class="form-control @error('building_size')is-invalid @enderror" name="building_size" id="building_size"  />
                                <span class="bt-flabels__error-desc">ভবন/গৃহের আয়তন দিন....</span>

                                @error('building_size')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="business_type" class="col-sm-3 control-label">ব্যবসার ধরন (বাংলায়) <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper ">

                                <input type="text"  class="form-control @error('business_type')is-invalid @enderror" name="business_type" id="business_type" data-parsley-required />

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
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            <u>ব্যবসার  ঠিকানা</u>
                        </h4>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="trade_village_en" id="trade_village_en" value="{{ old('trade_village_en') }}" class="form-control @error('trade_village_en')is-invalid @enderror" autocomplete="trade_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('trade_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span> </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="trade_village_bn" id="trade_village_bn" value="{{ old('trade_village_bn') }}" class="form-control @error('trade_village_bn')is-invalid @enderror" autocomplete="trade_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                @error('trade_village_bn')
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
                                <input type="text" name="trade_rbs_en" id="trade_rbs_en" value="{{ old('trade_rbs_en') }}" class="form-control @error('trade_rbs_en')is-invalid @enderror" placeholder="" autocomplete="trade_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('trade_rbs_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="trade_rbs_bn" id="trade_rbs_bn" value="{{ old('trade_rbs_bn') }}" class="form-control @error('trade_rbs_bn')is-invalid @enderror" placeholder="" autocomplete="trade_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  />
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                @error('trade_rbs_bn')
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
                                <input type="text" name="trade_holding_no" id="trade_holding_no" value="{{ old('trade_holding_no') }}" class="form-control @error('trade_holding_no')is-invalid @enderror" autocomplete="trade_holding_no" autofocus  data-parsley-trigger="keyup"  />
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('trade_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="trade_ward_no" id="trade_ward_no" value="{{ old('trade_ward_no') }}" class="form-control @error('trade_ward_no')is-invalid @enderror" autocomplete="trade_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                @error('trade_ward_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="trade_district_id" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'trade_district', 'trade_upazila_append', 'trade_upazila_id', 'trade_upazila', 3 )" name="trade_district_id" id="trade_district_id" class="custom-select2 form-control @error('trade_district_id')is-invalid @enderror" style="width: 100%; height: 38px;" data-parsley-required >
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('trade_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="trade_district" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="trade_district" value="জেলা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="trade_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'trade_upazila', 'trade_post_office_append', 'trade_postoffice_id', 'trade_postoffice', 6 )" name="trade_upazila_id" id="trade_upazila_id" class="custom-select2 form-control @error('trade_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="trade_upazila_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('trade_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="trade_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="trade_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="trade_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'trade_postoffice')" name="trade_postoffice_id" id="trade_postoffice_id" class="custom-select2 form-control @error('trade_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="trade_post_office_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('trade_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="trade_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="trade_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
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
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span class="text-danger">*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Email" class="col-sm-3 control-label">ইমেল </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email')is-invalid @enderror" placeholder="example@gmail.com" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
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
                                <input type="text" name="tel" id="tel" value="{{ old('tel') }}" class="form-control @error('tel')is-invalid @enderror" placeholder="" autocomplete="tel" autofocus data-parsley-type="digits" data-parsley-trigger="keyup"/>
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
                        <input type="hidden" name="union_id" value="{{ Auth::user()->union_id }}" id="union-id">
                        <input type="hidden" value="90" id="app-type">

                        <input type="hidden" value="" name="pin" id="pin">
                        <button type="submit" class="btn btn-primary">দাখিল করুন</button>
                    </div>
                </div>

            </form>
        </div>

    </section>


@endsection

@section('script')

    <script src="{{ asset('js/premises_license_form.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('js/custom_address.js') }}"></script>
    @php
        $b_type = [];

        foreach ($business_type as $item){

            $b_type[$item->id] = $item->name_bn;

        }

        function js_str($s)
        {
            return '"' . addcslashes($s, "\0..\37\"\\") . '"';
        }

        function js_array($array)
        {
            $temp = array_map('js_str', $array);
            return '[' . implode(',', $temp) . '];';
        }

    @endphp

    <script>
        @php
            echo 'var type_list = ', js_array($b_type);
        @endphp

        $( function() {
            $( "#business_type" ).autocomplete({
                autoFocus: true,
                minLength: 0,
                source: type_list
            });
        } );
    </script>


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
                $('#owner-tab-'+x).addClass('active show');
                $('#owner-plus-btn').val(x);
            }
        }

        function genderStatus(x) {

            var genderInfo  = $("input[name='gender["+x+"]']:checked").val();
            var mstatus     = $('#marital_status_'+x+'').val();

            if (typeof (genderInfo) === 'undefined'){
                genderInfo = 0;
                $('#genderError_'+x).css('border', '1px solid red');
                $('#genderError_'+x).css('border-radius', '4px');
                $('#genderError_'+x).css('padding', '10px');
                $('#genderErrorField_'+x).html('<span>অনুগ্রহ করে লিঙ্গ নির্বাচন করুন!</span>');
            }else{
                if (genderInfo == 2 && mstatus == 2) {
                $('#genderError_'+x).removeAttr('style');
                $('#genderErrorField_'+x).html('');
                $('#showhidden-husband-name-'+x).show();
                $('#husband_name_bn_'+x).attr('required', 'required');
            }else {
                $('#genderError_'+x).removeAttr('style');
                $('#genderErrorField_'+x).html('');

                $('#showhidden-husband-name-'+x).hide();
                $('#husband_name_en_'+x).val('');
                $('#husband_name_bn_'+x).val('');
                $('#husband_name_bn_'+x).removeAttr('required');
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
