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
                    <h4 style="color: white;">হোল্ডিং নামজারির আবেদন</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
        <form id="form-data" data-route="{{ $path.'/api/application/holdingnamjari' }}" method="post"
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
                <div class="col-sm-12 text-center">
                    <h4 class="app-heading">
                        <span style="border-bottom: 3px solid black">যে হোল্ডিং এর মালিকানা রেকর্ড সংশোধন করিতে হইবে তাহার </span>
                    </h4>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="former_owner_en" class="col-sm-3 control-label">সাবেক মালিকের নাম (ইংরেজিতে)
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="former_owner_en" id="former_owner_en"
                                   value="{{ old('former_owner_en') }}"
                                   class="form-control @error('former_owner_en') is-invalid @enderror"
                                   autocomplete="former_owner_en" autofocus placeholder="সাবেক মালিকের নাম দিন"
                                   data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">সাবেক মালিকের নাম দিন ইংরেজিতে....</span>

                            @error('former_owner_en')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="former_owner_bn" class="col-sm-3 control-label"> সাবেক মালিকের নাম (বাংলায়)
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="former_owner_bn" id="former_owner_bn" value="{{ old
                                ('former_owner_bn') }}"
                                   class="form-control @error('former_owner_bn') is-invalid @enderror"
                                   autocomplete="former_owner_bn" autofocus placeholder="সাবেক মালিকের নাম দিন"
                                   data-parsley-trigger="keyup" data-parsley-required/>
                            <span class="bt-flabels__error-desc">সাবেক মালিকের নাম দিন বাংলায়....</span>

                            @error('former_owner_bn')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="former_owner_father_name_en" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="former_owner_father_name_en" id="former_owner_father_name_en"
                                   value="{{ old('former_owner_father_name_en') }}"
                                   class="form-control @error('former_owner_father_name_en') is-invalid @enderror"
                                   autocomplete="former_owner_father_name_en" data-parsley-pattern='^[a-zA-Z. ]+$'
                                   data-parsley-trigger="keyup" placeholder="Father's Name"/>
                            <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                            @error('former_owner_father_name_en')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="former_owner_father_name_bn" class="col-sm-3 control-label">পিতার নাম (বাংলায়)
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="former_owner_father_name_bn"
                                   id="former_owner_father_name_bn" value="{{ old('former_owner_father_name_bn')
                                       }}" class="form-control @error('former_owner_father_name_bn') is-invalid
@enderror" autocomplete="former_owner_father_name_bn" data-parsley-required="" autofocus placeholder="পিতার নাম"/>
                            <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                            @error('former_owner_father_name_bn')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="former_owner_mother_name_en" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="former_owner_mother_name_en"
                                   id="former_owner_mother_name_en" value="{{ old('former_owner_mother_name_en') }}"
                                   data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup"
                                   class="form-control @error('former_owner_mother_name_en') is-invalid @enderror"
                                   autocomplete="former_owner_mother_name_en" placeholder="মাতার নাম দিন"/>
                            <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                            @error('former_owner_mother_name_en')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="former_owner_mother_name_bn" class="col-sm-3 control-label">মাতার নাম (বাংলায়)
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="former_owner_mother_name_bn" id="former_owner_mother_name_bn"
                                   value="{{ old('former_owner_mother_name_bn') }}"
                                   class="form-control @error('former_owner_mother_name_bn') is-invalid @enderror"
                                   autocomplete="former_owner_mother_name_bn" autofocus placeholder="মাতার নাম"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>

                            @error('former_owner_mother_name_bn')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="trimasik_tax" class="col-sm-3 control-label">ত্রৈমাসিক পৌরকর<span
                                class="text-danger"
                            >*</span>
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="trimasik_tax" id="trimasik_tax" value="{{ old
                                ('trimasik_tax') }}" data-parsley-trigger="keyup" class="form-control @error('trimasik_tax') is-invalid @enderror" data-parsley-maxlength="50"
                                   autocomplete="trimasik_tax" autofocus placeholder="ত্রৈমাসিক পৌরকর"
                                   data-parsley-required/>
                            <span class="bt-flabels__error-desc">ত্রৈমাসিক পৌরকর দিন....</span>

                            @error('trimasik_tax')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="yearly_rate" class="col-sm-3 control-label">বাৎসরিক মূল্যমান
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="yearly_rate" id="yearly_rate" value="{{ old('yearly_rate')
                                }}" class="form-control  @error('yearly_rate') is-invalid @enderror"
                                   data-parsley-maxlength="50"
                                   autocomplete="yearly_rate" autofocus placeholder="বাৎসরিক মূল্যমান"
                                   data-parsley-trigger="keyup" data-parsley-required/>
                            <span class="bt-flabels__error-desc">বাৎসরিক মূল্যমান ...</span>

                            @error('yearly_rate')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="yealry_tax_amount" class="col-sm-3 control-label">বাৎসরিক করের পরিমান
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="yealry_tax_amount" id="yealry_tax_amount"
                                   value="{{ old('yealry_tax_amount') }}" data-parsley-trigger="keyup"
                                   class="form-control @error('yealry_tax_amount') is-invalid @enderror" autofocus
                                   placeholder="বাৎসরিক করের পরিমান"/>
                            <span class="bt-flabels__error-desc">বাৎসরিক করের পরিমান দিন....</span>

                            @error('yealry_tax_amount')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="last_assesment_date" class="col-sm-3 control-label">সর্বশেষ এসেসমেন্ট
                            সন <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="last_assesment_date" id="last_assesment_date" value="{{ old
                                ('last_assesment_date') }}" data-parsley-required
                                   class="form-control @error('last_assesment_date')
                                       is-invalid @enderror" placeholder="2021-22" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">সর্বশেষ এসেসমেন্ট সন দিন...</span>

                            @error('last_assesment_date')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row form-group">
                        <label for="holding_no" class="col-sm-3 control-label">
                            হোল্ডিং নাম্বার <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="holding_no" id="holding_no" value="{{ old('holding_no') }}"
                                   data-parsley-trigger="keyup"
                                   class="form-control @error('holding_no') is-invalid @enderror"
                                   data-parsley-required placeholder="হোল্ডিং নাম্বার"/>
                            <span class="bt-flabels__error-desc">হোল্ডিং নাম্বার দিন....</span>

                            @error('holding_no')
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
                           <span style="border-bottom: 3px solid black">সংশোধনক্রমে যে মালিকের নাম রেকর্ড করিতে হইবে
                               তাহার</span>
                    </h4>
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
                            <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="form-control datepicker" readonly placeholder="yyyy-mm-dd" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-required data-date-format="yyyy-mm-dd" />

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

            <div class="row" style="margin-top: 50px; margin-bottom: 30px">
                <div class="col-sm-12 text-center">
                    <h4 class="app-heading">
                        <span style="border-bottom: 3px solid black">মালিকানা প্রাপ্তির পূর্ণ বিবরণী</span>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="bhumi_moja_no" class="col-sm-3 control-label">প্রস্তাবিত ভূমির মৌজার নাম ও
                            নম্বর <span class="text-danger">*</span> </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="bhumi_moja_no" id="bhumi_moja_no" value="{{ old
                                ('bhumi_moja_no') }}" class="form-control @error('bhumi_moja_no')is-invalid
@enderror" placeholder="প্রস্তাবিত ভূমির মৌজার নাম ও নম্বর দিন" data-parsley-maxlength="50" data-parsley-trigger="keyup"
                                   data-parsley-required=""/>
                            <span class="bt-flabels__error-desc">প্রস্তাবিত ভূমির মৌজার নাম ও নম্বর দিন ....</span>

                            @error('bhumi_moja_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="khotian_no" class="col-sm-3 control-label">খতিয়ান নম্বর <span
                                class="text-danger"
                            >*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="khotian_no" id="khotian_no" value="{{ old
                                ('khotian_no') }}" class="form-control @error('khotian_no')is-invalid @enderror"
                                   placeholder="খতিয়ান নম্বর দিন" data-parsley-type="number"
                                   data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required/>
                            <span class="bt-flabels__error-desc">খতিয়ান নম্বর দিন....</span>

                            @error('khotian_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="dag_no" class="col-sm-3 control-label">দাগ নম্বর <span class="text-danger"
                            >*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="dag_no" id="dag_no" value="{{ old('dag_no') }}"
                                   class="form-control @error('dag_no')is-invalid @enderror"
                                   data-parsley-type="number" data-parsley-required
                                   placeholder="দাগ নম্বর দিন" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">দাগ নম্বর দিন ইংরেজিতে....</span>

                            @error('dag_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="land_amount" class="col-sm-3 control-label">জমির পরিমাণ<span class="text-danger"
                            >*</span></label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="land_amount" id="land_amount" value="{{ old('land_amount')
                                }}" class="form-control @error('land_amount')is-invalid @enderror"
                                   placeholder="জমির পরিমাণ দিন" data-parsley-maxlength="50" data-parsley-required
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">জমির পরিমাণ দিন....</span>

                            @error('land_amount')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="dolil_datar_name" class="col-sm-3 control-label">দলিল দাতার নাম
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="dolil_datar_name" id="dolil_datar_name"
                                   value="{{ old('dolil_datar_name') }}"
                                   class="form-control @error('dolil_datar_name')is-invalid @enderror"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">দলিল দাতার নাম দিন....</span>

                            @error('dolil_datar_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="dolil_no" class="col-sm-3 control-label">রেজিঃকৃত দলিলের নম্বর</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="dolil_no" id="dolil_no" value="{{ old('dolil_no') }}"
                                   class="form-control @error('dolil_no')is-invalid @enderror"
                                   data-parsley-maxlength="50" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">রেজিঃকৃত দলিলের নম্বর দিন....</span>

                            @error('dolil_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="reg_office_name" class="col-sm-3 control-label">রেজিঃ অফিসের নাম</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="reg_office_name" id="reg_office_name"
                                   value="{{ old('reg_office_name') }}"
                                   class="form-control @error('reg_office_name')is-invalid @enderror"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">রেজিঃ অফিসের নাম দিন....</span>

                            @error('reg_office_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="reg_date" class="col-sm-3 control-label">রেজিঃ তারিখ</label>

                        <div class="col-sm-3">
                            <input type="text" name="reg_date" id="reg_date" value="{{ old('reg_date') }}"
                                   class="form-control datepicker" placeholder="yyyy-mm-dd" data-parsley-type="date" data-date-format="yyyy-mm-dd"
                                   data-parsley-trigger="keyup" />

                            <span class="bt-flabels__error-desc">রেজিঃ তারিখ দিন....</span>

                            @error('reg_date')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="dolil_hold_no" class="col-sm-3 control-label">
                            দলিলের যে হোল্ডিং নম্বর ও মহল্লা উল্লেখ আছে
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="dolil_hold_no" id="dolil_hold_no"
                                   value="{{ old('dolil_hold_no') }}"
                                   class="form-control @error('dolil_hold_no')is-invalid @enderror" placeholder=""
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc"> দলিলের যে হোল্ডিং নম্বর ও মহল্লা উল্লেখ আছে দিন
                                    ....</span>

                            @error('dolil_hold_no')
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
                        <span style="border-bottom: 3px solid black">হোল্ডিং এর বিবরণী</span>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="bohuthola_dalan" class="col-sm-3 control-label">বহুতলা দালান ও কোঠার
                            সংখ্যা</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="bohuthola_dalan" id="bohuthola_dalan" value="{{ old
                                ('bohuthola_dalan') }}"
                                   class="form-control @error('bohuthola_dalan')is-invalid @enderror" placeholder="বহুতলা দালান ও কোঠার
                                সংখ্যা দিন" data-parsley-maxlength="50"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">বহুতলা দালান ও কোঠার
                                সংখ্যা দিন...</span>

                            @error('bohuthola_dalan')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="ekthola_dalan" class="col-sm-3 control-label">একতলা দালান ও কোঠার
                            সংখ্যা</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="ekthola_dalan" id="ekthola_dalan" value="{{ old
                                ('ekthola_dalan') }}" class="form-control @error('ekthola_dalan')is-invalid @enderror"
                                   placeholder="একতলা দালান ও কোঠার
                                সংখ্যা দিন" data-parsley-maxlength="50"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">একতলা দালান ও কোঠার
                                সংখ্যা....</span>

                            @error('ekthola_dalan')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="ada_faka_ghor" class="col-sm-3 control-label">আধা পাকা ঘর ও কোঠার সংখ্যা</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="ada_faka_ghor" id="ada_faka_ghor" value="{{ old
                                ('ada_faka_ghor') }}" class="form-control @error('ada_faka_ghor')is-invalid
@enderror" placeholder="আধা পাকা ঘর ও কোঠার সংখ্যা দিন" data-parsley-maxlength="50" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">আধা পাকা ঘর ও কোঠার সংখ্যা দিন....</span>

                            @error('ada_faka_ghor')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="kaca_ghor" class="col-sm-3 control-label">কাঁচা ঘরের সংখ্যা</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="kaca_ghor" id="kaca_ghor" value="{{ old('kaca_ghor')
                                }}" class="form-control @error('kaca_ghor')is-invalid @enderror" placeholder="কাঁচা
                                ঘরের সংখ্যা দিন" data-parsley-maxlength="50"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">কাঁচা ঘরের সংখ্যা দিন....</span>

                            @error('kaca_ghor')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="latrin_no" class="col-sm-3 control-label">পায়খানার সংখ্যা
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="latrin_no" id="latrin_no" value="{{ old('latrin_no') }}"
                                   class="form-control @error('latrin_no')is-invalid @enderror"
                                   placeholder="পায়খানার সংখ্যা দিন" data-parsley-type="number"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">পায়খানার সংখ্যা দিন....</span>

                            @error('latrin_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="jhol_tap_no" class="col-sm-3 control-label">জলের টেপের সংখ্যা
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="jhol_tap_no" id="jhol_tap_no" value="{{ old('jhol_tap_no')
                                }}" class="form-control @error('jhol_tap_no')is-invalid @enderror"
                                   data-parsley-maxlength="50" data-parsley-type="number"
                                   placeholder="জলের টেপের সংখ্যা দিন"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">জলের টেপের সংখ্যা দিন....</span>

                            @error('jhol_tap_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="tubewel_no" class="col-sm-3 control-label">নলকূপের সংখ্যা</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="tubewel_no" id="tubewel_no" value="{{ old('tubewel_no') }}"
                                   class="form-control @error('tubewel_no')is-invalid @enderror"
                                   placeholder="নলকূপের সংখ্যা দিন" data-parsley-maxlength="50"
                                   data-parsley-type="number" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">নলকূপের সংখ্যা দিন....</span>

                            @error('tubewel_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="dokan_no" class="col-sm-3 control-label">দোকান ও কারখানার সংখ্যা</label>
                        <div class="col-sm-3">
                            <input type="text" name="dokan_no" id="dokan_no" value="{{ old('dokan_no') }}"
                                   class="form-control @error('dokan_no')is-invalid @enderror"
                                   placeholder="দোকান ও কারখানার সংখ্যা দিন"
                                   data-parsley-type="number"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">দোকান ও কারখানার সংখ্যা দিন....</span>

                            @error('dokan_no')
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
                        <span style="border-bottom: 3px solid black">হোল্ডিং এ বসবাসকারী পরিবারের সংখ্যা </span>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="family_no" class="col-sm-3 control-label">কতটি পরিবার বাস করে</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="family_no" id="family_no" value="{{ old
                                ('family_no') }}" class="form-control @error('family_no')is-invalid @enderror"
                                   data-parsley-maxlength="50" data-parsley-type="number"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">কতটি পরিবার বাস করে তার
                                সংখ্যা দিন...</span>

                            @error('bohuthola_dalan')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="conditions" class="col-sm-3 control-label">কি শর্তে বাস করে</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="conditions" id="conditions" value="{{ old
                                ('conditions') }}" class="form-control @error('conditions')is-invalid @enderror"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">একি শর্তে বাস করে কারণ লিখুন....</span>

                            @error('conditions')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="monthly_rant_rate" class="col-sm-3 control-label">মোট মাসিক ভাড়া</label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="monthly_rant_rate" id="monthly_rant_rate" value="{{ old
                                ('monthly_rant_rate') }}" class="form-control @error('monthly_rant_rate')is-invalid
@enderror" data-parsley-type="number" data-parsley-maxlength="50" data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">মোট মাসিক ভাড়া দিন....</span>

                            @error('monthly_rant_rate')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="rant_last_date" class="col-sm-3 control-label">ভাড়া আদায়ের শেষ তারিখ</label>

                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="rant_last_date" id="rant_last_date" value="{{ old('rant_last_date')
                                }}" class="form-control datepicker" placeholder="yyyy-mm-dd"
                                   data-parsley-maxlength="50" data-parsley-type="date" data-date-format="yyyy-mm-dd"
                                   data-parsley-trigger="keyup" />

                            <span class="bt-flabels__error-desc">ভাড়া আদায়ের শেষ তারিখ দিন....</span>

                            @error('rant_last_date')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row form-group">
                        <label for="applicant_other_info" class="col-sm-3 control-label">আবেদনকারী উল্লেখিত হোল্ডিং
                            সম্পর্কে অন্যান্য বিষয়
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="applicant_other_info" id="applicant_other_info"
                                   value="{{ old('applicant_other_info') }}"
                                   class="form-control @error('applicant_other_info')is-invalid @enderror"
                                   data-parsley-maxlength="100"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">আবেদনকারী উল্লেখিত হোল্ডিং
                                সম্পর্কে অন্যান্য বিষয় দিন....</span>

                            @error('latrin_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="govt_rent_no" class="col-sm-3 control-label">সরকারী রাজস্ব বিভাগের খাজনা নতুন
                            মালিকের নামে দেওয়া হইয়াছে কিনা।দেওয়া হইলে দাখিলের নম্বর উল্লেখ করিতে হইবে
                        </label>
                        <div class="col-sm-3 bt-flabels__wrapper">
                            <input type="text" name="govt_rent_no" id="govt_rent_no" value="{{ old('govt_rent_no')
                                }}" class="form-control @error('govt_rent_no')is-invalid @enderror"
                                   data-parsley-maxlength="50" data-parsley-type="number"
                                   placeholder="জলের টেপের সংখ্যা দিন"
                                   data-parsley-trigger="keyup"/>
                            <span class="bt-flabels__error-desc">জলের টেপের সংখ্যা দিন....</span>

                            @error('govt_rent_no')
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
