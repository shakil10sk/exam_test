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
                        <h4 class="text-center application_head">হোল্ডিং নামজারির তথ্য সংশোধন</h4>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="{{ route('holdingnamjari_update') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

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
                                       value="{{ old('former_owner_en') ? old('former_owner_en') : $namjari->former_owner_en }}"
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
                                ('former_owner_bn') ? old
                                ('former_owner_bn') : $namjari->former_owner_bn }}"
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
                                       value="{{ old('former_owner_father_name_en') ? old
                                       ('former_owner_father_name_en') : $namjari->former_owner_father_name_en }}"
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
                                       ? old('former_owner_father_name_bn') : $namjari->former_owner_father_name_bn
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
                                       id="former_owner_mother_name_en" value="{{ old('former_owner_mother_name_en')
                                       ? old('former_owner_mother_name_en') : $namjari->former_owner_mother_name_en
                                        }}"
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
                                       value="{{ old('former_owner_mother_name_bn') ? old('former_owner_mother_name_bn') :
                                       $namjari->former_owner_mother_name_bn }}"
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
                                <input type="text" name="trimasik_tax" id="trimasik_tax" value="{{ old('trimasik_tax') ? old('trimasik_tax') : $namjari->trimasik_tax  }}" data-parsley-trigger="keyup"
                                       class="form-control
@error('trimasik_tax') is-invalid @enderror" data-parsley-maxlength="50"
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
                                <input type="text" name="yearly_rate" id="yearly_rate" value="{{ old('yearly_rate') ?
                                 old('yearly_rate') : $namjari->yearly_rate
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
                                       value="{{ old('yealry_tax_amount') ? old('yealry_tax_amount') : $namjari->yealry_tax_amount }}"
                                       data-parsley-trigger="keyup"
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
                                সন <span class="text">*</span>
                            </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="last_assesment_date" id="last_assesment_date" value="{{ old
                                ('last_assesment_date') ? old('last_assesment_date') : $namjari->last_assesment_date }}" data-parsley-required
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
                                <input type="text" name="holding_no" id="holding_no" value="{{ old('holding_no') ?
                                old('holding_no') :
                                $namjari->holding_no
                                 }}"
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
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="Name-english" class="col-sm-3 control-label"> নাম (ইংরেজিতে)</label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en')? old('name_en') : $namjari->name_en }}" class="form-control @error('name_en') is-invalid @enderror" placeholder="Full Name" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                        <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়)  <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn')? old('name_bn') : $namjari->name_bn }}" class="form-control @error('name_bn') is-invalid @enderror" placeholder="পূর্ণ নাম" data-parsley-trigger="keyup" data-parsley-required />
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
                                        <input type="text" name="mother_name_en" id="mother_name_en" value="{{ old('mother_name_en')? old('mother_name_en') : $namjari->mother_name_en }}" class="form-control @error('mother_name_en') is-invalid @enderror" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" class="form-control" placeholder="Mother's Name" />
                                        <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>

                                        @error('mother_name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ old('mother_name_bn')? old('mother_name_bn') : $namjari->mother_name_bn }}" class="form-control @error('mother_name_bn') is-invalid @enderror" placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />
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
                                        <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en')? old('father_name_en') : $namjari->father_name_en }}" class="form-control @error('father_name_en') is-invalid @enderror" autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="Father's Name" />
                                        <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>

                                        @error('father_name_en')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span>*</span></label>
                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn')? old('father_name_bn') : $namjari->father_name_bn }}" class="form-control @error('father_name_bn') is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" data-parsley-required />
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
                                                value='' {{ (old('religion')? old('religion') : $namjari->religion == '') ? 'selected="selected"' : '' }}>
                                                চিহ্নিত করুন
                                            </option>
                                            <option
                                                value='1' {{ (old('religion')? old('religion') : $namjari->religion == 1) ? 'selected="selected"' : '' }}>
                                                ইসলাম
                                            </option>
                                            <option
                                                value='2' {{ (old('religion')? old('religion') : $namjari->religion == 2) ? 'selected="selected"' : '' }}>
                                                হিন্দু
                                            </option>
                                            <option
                                                value='3' {{ (old('religion')? old('religion') : $namjari->religion == 3) ? 'selected="selected"' : '' }}>
                                                বৌদ্ধ ধর্ম
                                            </option>
                                            <option
                                                value='4' {{ (old('religion')? old('religion') : $namjari->religion == 4) ? 'selected="selected"' : '' }}>
                                                খ্রিস্ট ধর্ম
                                            </option>
                                            <option
                                                value='5' {{ (old('religion')? old('religion') : $namjari->religion == 5) ? 'selected="selected"' : '' }}>
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
                                                value='' {{ (old('resident')? old('resident') : $namjari->resident == '') ? 'selected="selected"' : '' }}>
                                                চিহ্নিত করুন
                                            </option>
                                            <option
                                                value='1' {{ (old('resident')? old('resident') : $namjari->resident == 1) ? 'selected="selected"' : '' }}>
                                                অস্থায়ী
                                            </option>
                                            <option
                                                value='2' {{ (old('resident')? old('resident') : $namjari->resident == 2) ? 'selected="selected"' : '' }}>
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
                                            <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $namjari->gender) == 1) ? 'checked' : '' }} name="gender" value="1" />পুরুষ</label>
                                            <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $namjari->gender) == 2) ? 'checked' : '' }} name="gender" value="2" />মহিলা</label>
                                            <label class="radio-inline gender"><input type="radio" {{ ((old('gender')? old('gender') : $namjari->gender) == 3) ? 'checked' : '' }} name="gender" value="3" />অন্যান্য</label>

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
                                                <option value="" {{ (old('marital_status')? old('marital_status') : $namjari->marital_status == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                                <option value='1' {{ (old('marital_status')? old('marital_status') : $namjari->marital_status == 1) ? 'selected="selected"' : '' }}>অবিবাহিত</option>
                                                <option value='2' {{ (old('marital_status')? old('marital_status') : $namjari->marital_status == 2) ? 'selected="selected"' : '' }}>বিবাহিত</option>
                                                <option value='3' {{ (old('marital_status')? old('marital_status') : $namjari->marital_status == 3) ? 'selected="selected"' : '' }}>তালাক প্রাপ্ত</option>
                                                <option value='4' {{ (old('marital_status')? old('marital_status') : $namjari->marital_status == 4) ? 'selected="selected"' : '' }}>বিধবা</option>
                                                <option value='5' {{ (old('marital_status')? old('marital_status') : $namjari->marital_status == 5) ? 'selected="selected"' : '' }}>অন্যান্য</option>
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
                                @if ($namjari->photo != NULL)
                                    <img src="{{ asset('images/application/'.$namjari->photo) }}" class="image-previewer image" data-cropzee="cropzee-input" />
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
                                <input type="text" name="nid" id="nid" value="{{ old('nid')? old('nid') : $namjari->nid }}" class="form-control @error('nid') is-invalid @enderror" data-parsley-maxlength="17" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_id" value="{{ old('birth_id')? old('birth_id') : $namjari->birth_id }}" id="birth_id" class="form-control @error('birth_id') is-invalid @enderror" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
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
                                <input type="text" name="passport_no" value="{{ old('passport_no')? old('passport_no') : $namjari->passport_no }}" id="passport_no" class="form-control @error('passport_no') is-invalid @enderror" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date" value="{{ old('birth_date')? old('birth_date') : $namjari->birth_date }}" id="birth_date" class="form-control date @error('birth_date') is-invalid @enderror" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-trigger="keyup" data-parsley-required  placeholder="yyyy-mm-dd" />

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
                    <div class="col-md-12" id="wife" {{ ($namjari->marital_status == 2 && $namjari->gender == 1)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="wife_name_en" class="col-sm-3 control-label">স্ত্রীর নাম (ইংরেজিতে) </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_en" id="wife_name_en" value="{{ old('wife_name_en')? old('wife_name_en') : $namjari->wife_name_en }}" class="form-control @error('wife_name_en')is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Wife" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন ইংরেজিতে....</span>

                                @error('wife_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="wife_name_bn" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="wife_name_bn" id="wife_name_bn" value="{{ old('wife_name_bn')? old('wife_name_bn') : $namjari->wife_name_bn }}" class="form-control @error('wife_name_bn')is-invalid @enderror" placeholder="স্ত্রীর নাম" />
                                <span class="bt-flabels__error-desc">স্ত্রীর নাম দিন বাংলায়....</span>

                                @error('wife_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="husband" {{ ($namjari->marital_status == 2 && $namjari->gender == 2)? 'style=display:block' : 'style=display:none' }}>
                        <div class="row form-group">
                            <label for="husband_name_en" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_en" id="husband_name_en" value="{{ old('husband_name_en')? old('husband_name_en') : $namjari->husband_name_en }}" class="form-control @error('husband_name_en')is-invalid @enderror" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" placeholder="Name of Husband" />
                                <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>

                                @error('husband_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="husband_name_bn" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="husband_name_bn" id="husband_name_bn" value="{{ old('husband_name_bn')? old('husband_name_bn') : $namjari->husband_name_bn }}" class="form-control @error('husband_name_bn')is-invalid @enderror" placeholder="স্বামী নাম" />
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
                                <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en')? old('present_village_en') : $namjari->present_village_en }}" class="form-control @error('present_village_en')is-invalid @enderror" autocomplete="present_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('present_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn')? old('present_village_bn') : $namjari->present_village_bn }}" class="form-control @error('present_village_bn')is-invalid @enderror" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                                <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no')? old('present_holding_no') : $namjari->present_holding_no }}" class="form-control @error('present_holding_no')is-invalid @enderror" autocomplete="present_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('present_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no')? old('present_ward_no') : $namjari->present_ward_no }}" class="form-control @error('present_ward_no')is-invalid @enderror" autocomplete="present_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                    <option value="{{ $namjari->present_district_id }}" selected="selected">{{ $namjari->present_district_name_en }}</option>
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
                                <input type="text" disabled id="present_district" value="{{ $namjari->present_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_upazila', 'present_postoffice_append', 'present_postoffice_id', 'present_postoffice', 6 )" name="present_upazila_id" id="present_upazila_id" class="custom-select2 form-control @error('present_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $namjari->present_upazila_id }}" selected="selected">{{ $namjari->present_upazila_name_en }}</option>
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
                                <input type="text" disabled id="present_upazila" value="{{ $namjari->present_upazila_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="present_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'present_postoffice')" name="present_postoffice_id" id="present_postoffice_id" class="custom-select2 form-control @error('present_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="present_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $namjari->present_postoffice_id }}" selected="selected">{{ $namjari->present_postoffice_name_en }}</option>
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
                                <input type="text" disabled id="present_postoffice" value="{{ $namjari->present_postoffice_name_bn }}" class="form-control" placeholder=""/>
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
                                <input type="text" name="permanent_village_en" id="permanent_village_en" value="{{ old('permanent_village_en')? old('permanent_village_en') : $namjari->permanent_village_en }}" class="form-control @error('permanent_village_en')is-invalid @enderror" autocomplete="permanent_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('permanent_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn')? old('permanent_village_bn') : $namjari->permanent_village_bn }}" class="form-control @error('permanent_village_bn')is-invalid @enderror" autocomplete="permanent_village_bn" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                                <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no')? old('permanent_holding_no') : $namjari->permanent_holding_no }}" class="form-control @error('permanent_holding_no')is-invalid @enderror" autocomplete="permanent_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('permanent_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no')? old('permanent_ward_no') : $namjari->permanent_ward_no }}" class="form-control @error('permanent_ward_no')is-invalid @enderror" autocomplete="permanent_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                    <option value="{{ $namjari->permanent_district_id }}" selected="selected">{{ $namjari->permanent_district_name_en }}</option>
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
                                <input type="text" disabled id="permanent_district" value="{{ $namjari->permanent_district_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )" name="permanent_upazila_id" id="permanent_upazila_id" class="custom-select2 form-control @error('permanent_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>
                                    <option value="{{ $namjari->permanent_upazila_id }}" selected="selected">{{ $namjari->permanent_upazila_name_en }}</option>
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
                                <input type="text" disabled id="permanent_upazila" value="{{ $namjari->permanent_upazila_name_bn }}" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="permanent_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'permanent_postoffice')" name="permanent_postoffice_id" id="permanent_postoffice_id" class="custom-select2 form-control @error('permanent_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>
                                    <option value="{{ $namjari->permanent_postoffice_id }}" selected="selected">{{ $namjari->permanent_postoffice_name_en }}</option>
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
                                <input type="text" disabled id="permanent_postoffice" value="{{ $namjari->permanent_postoffice_name_bn }}" class="form-control" placeholder=""/>
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
                                ('bhumi_moja_no') ? old('bhumi_moja_no') : $namjari->bhumi_moja_no }}" class="form-control @error('bhumi_moja_no')
                                    is-invalid
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
                                ('khotian_no')? old('khotian_no') : $namjari->khotian_no }}" class="form-control @error('khotian_no')
                                    is-invalid
@enderror"
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
                                <input type="text" name="dag_no" id="dag_no" value="{{ old('dag_no') ? old('dag_no') :
                                $namjari->dag_no }}"
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
                                <input type="text" name="land_amount" id="land_amount" value="{{ old('land_amount') ?
                              old('land_amount') : $namjari->land_amount
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
                                       value="{{ old('dolil_datar_name') ? old('dolil_datar_name') : $namjari->dolil_datar_name }}"
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
                                <input type="text" name="dolil_no" id="dolil_no" value="{{ old('dolil_no') ? old('dolil_no') :
                                $namjari->dolil_no }}"
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
                                       value="{{ old('reg_office_name') ? old('reg_office_name') : $namjari->reg_office_name }}"
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
                                <input type="text" name="reg_date" id="reg_date" value="{{ old('reg_date') ? old('reg_date') :
                                $namjari->reg_date
                                 }}"
                                       class="form-control @error('reg_date')is-invalid @enderror" placeholder="yyyy-mm-dd" data-parsley-type="date"
                                       data-parsley-trigger="keyup"/>

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
                                       value="{{ old('dolil_hold_no') ?  old('dolil_hold_no') : $namjari->dolil_hold_no  }}"
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
                                ('bohuthola_dalan') ? old('bohuthola_dalan') : $namjari->bohuthola_dalan }}"
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
                                <input type="text" name="ekthola_dalan" id="ekthola_dalan" value="{{ old('ekthola_dalan') ? old('ekthola_dalan') : $namjari->ekthola_dalan }}"
                                       class="form-control @error('ekthola_dalan')is-invalid @enderror"
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
                                ('ada_faka_ghor') ? old('ada_faka_ghor') : $namjari->ada_faka_ghor }}"
                                       class="form-control @error('ada_faka_ghor')is-invalid @enderror"
                                       placeholder="আধা পাকা ঘর ও কোঠার সংখ্যা দিন" data-parsley-maxlength="50" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">আধা পাকা ঘর ও কোঠার সংখ্যা দিন....</span>

                                @error('ada_faka_ghor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="kaca_ghor" class="col-sm-3 control-label">কাঁচা ঘরের সংখ্যা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="kaca_ghor" id="kaca_ghor" value="{{ old('kaca_ghor') ? old('kaca_ghor') : $namjari->kaca_ghor
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
                                <input type="text" name="latrin_no" id="latrin_no" value="{{ old('latrin_no') ? old('latrin_no'):$namjari->latrin_no  }}"
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
                                ?old('jhol_tap_no'):$namjari->jhol_tap_no
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
                                <input type="text" name="tubewel_no" id="tubewel_no" value="{{ old('tubewel_no') ?old('tubewel_no') : $namjari->tubewel_no
                                 }}"
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
                                <input type="text" name="dokan_no" id="dokan_no" value="{{ old('dokan_no') ? old('dokan_no') : $namjari->dokan_no  }}"
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
                                <input type="text" name="family_no" id="family_no" value="{{ old('family_no') ? old('family_no') : $namjari->family_no }}" class="form-control @error('family_no')is-invalid @enderror"
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
                                ('conditions') ? old('conditions') : $namjari->conditions }}" class="form-control @error('conditions')is-invalid @enderror"
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
                                ('monthly_rant_rate') ? old('monthly_rant_rate') : $namjari->monthly_rant_rate }}"
                                       class="form-control @error('monthly_rant_rate')
                                    is-invalid @enderror" data-parsley-type="number" data-parsley-maxlength="50"
                                       data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">মোট মাসিক ভাড়া দিন....</span>

                                @error('monthly_rant_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="rant_last_date" class="col-sm-3 control-label">ভাড়া আদায়ের শেষ তারিখ</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="rant_last_date" id="rant_last_date" value="{{ old('rant_last_date') ? old('rant_last_date') : $namjari->rant_last_date
                                }}" class="form-control @error('rant_last_date')is-invalid @enderror" placeholder="yyyy-mm-dd" data-parsley-maxlength="50" data-parsley-type="date"
                                       data-parsley-trigger="keyup"/>

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
                                       value="{{ old('applicant_other_info') ? old('applicant_other_info') :
                                       $namjari->applicant_other_info
                                        }}"
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
                                <input type="text" name="govt_rent_no" id="govt_rent_no" value="{{ old
                                ('govt_rent_no')?old('govt_rent_no'):$namjari->govt_rent_no
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
                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile')? old('mobile') : $namjari->mobile }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Email" class="col-sm-3 control-label">ইমেল </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="email" id="email" value="{{ old('email')? old('email') : $namjari->email }}" class="form-control @error('email')is-invalid @enderror" placeholder="example@gmail.com" autocomplete="email" autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
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

                        <input type="hidden" value="{{ $namjari->application_id }}" name="application_id"/>

                        <input type="hidden" value="{{ $namjari->citizen_id }}" name="citizen_id"/>
                        <input type="hidden" value="{{ $namjari->namjari_id }}" name="namjari_id"/>

                        <input type="hidden" value="{{ $namjari->pin }}" name="pin"/>

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





