@extends('layouts.app')
@section('head')

    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')

    <section>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title text-center">
                        <h4 class="text-center application_head">অনাপত্তি সনদের আবেদন</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('onapotti.store') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-11">
                        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4><hr/>
                        <ul>
                            <li><i class="fa fa-circle-o"></i> বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন ।</li>
                            <li><i class="fa fa-circle-o"></i> ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন ।</li>
                            <li><i class="fa fa-circle-o"></i> আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে আপনার
                                মোবাইল অথবা ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা
                                পিন নং দিয়ে সার্চ করুন!</li>
                        </ul>

                        <div class="input-group mt-5">
                            <input type="search" class="form-control" id="search-data" placeholder="মোবাইল/এন.আই.ডি.নং/জন্ম নিবন্ধন নং/পাসপোর্ট নং/পিন নং দিন ইংরেজিতে">&nbsp;&nbsp;
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
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="form-control @error('name_en') is-invalid @enderror" autocomplete="name_en" autofocus placeholder="" data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>

                                @error('name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}" class="form-control @error('name_bn') is-invalid @enderror" autocomplete="name_bn" autofocus placeholder="" data-parsley-trigger="keyup" data-parsley-required />
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
                            <label for="Father-name-english" class="col-sm-3 control-label"> পিতার নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en') }}" class="form-control @error('father_name_en') is-invalid @enderror" autocomplete="father_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="" />
                                <span class="bt-flabels__error-desc"> দিন ইংরেজিতে....</span>

                                @error('father_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Father-name-bangla" class="col-sm-3 control-label"> পিতার নাম (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn') }}" class="form-control @error('father_name_bn') is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="" data-parsley-required />
                                <span class="bt-flabels__error-desc"> দিন বাংলায়....</span>

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
                            <label for="Father-name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_name_en" id="organization_name_en" value="{{ old('organization_name_en') }}" class="form-control @error('organization_name_en') is-invalid @enderror" autocomplete="organization_name_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="" />
                                <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম ইংরেজিতে....</span>

                                @error('organization_name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Father-name-bangla" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_name_bn" id="organization_name_bn" value="{{ old('organization_name_bn') }}" class="form-control @error('organization_name_bn') is-invalid @enderror" autocomplete="organization_name_bn" autofocus placeholder="" data-parsley-required />
                                <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম বাংলায়....</span>

                                @error('organization_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Father-name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_location_en" id="organization_location_en" value="{{ old('organization_location_en') }}" class="form-control @error('organization_location_en') is-invalid @enderror" autocomplete="organization_location_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="" />
                                <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম ইংরেজিতে....</span>

                                @error('organization_location_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Father-name-bangla" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_location_bn" id="organization_location_bn" value="{{ old('organization_location_bn') }}" class="form-control @error('organization_location_bn') is-invalid @enderror" autocomplete="organization_location_bn" autofocus placeholder="" data-parsley-required />
                                <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম বাংলায়....</span>

                                @error('organization_location_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Father-name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের ধরণ (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_type_en" id="organization_type_en" value="{{ old('organization_type_en') }}" class="form-control @error('organization_type_en') is-invalid @enderror" autocomplete="organization_type_en" autofocus data-parsley-pattern='^[a-zA-Z. ]+$' data-parsley-trigger="keyup" placeholder="" />
                                <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের ধরণ ইংরেজিতে....</span>

                                @error('organization_type_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Father-name-bangla" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের ধরণ (বাংলায়) <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="organization_type_bn" id="organization_type_bn" value="{{ old('organization_type_bn') }}" class="form-control @error('organization_type_bn') is-invalid @enderror" autocomplete="organization_type_bn" autofocus placeholder="" data-parsley-required />
                                <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের ধরণ বাংলায়....</span>

                                @error('organization_type_bn')
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
                            <label for="profession" class="col-sm-3 control-label">ট্রেড লাইসেন্স নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="trade_license_no" id="trade_license_no" value="{{ old('trade_license_no') }}" class="form-control @error('trade_license_no') is-invalid @enderror" autocomplete="trade_license_no" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                                <span class="bt-flabels__error-desc">ট্রেড লাইসেন্স নং দিন </span>

                                @error('trade_license_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="resident" id='resident' selected="selected" class="form-control @error('resident')is-invalid @enderror" data-parsley-required >
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

                    <div class="col-md-12" id="genderErr">

                        <div class="row form-group">
                            <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                            <div class="col-sm-3 @error('gender')is-invalid @enderror" id="genderErrMess">
                                <label class="radio-inline gender"><input type="radio" id="gender_1" {{ (old('gender') == 1) ? 'checked' : '' }} name="gender" value="1" />পুরুষ</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_2" {{ (old('gender') == 2) ? 'checked' : '' }} name="gender" value="2" />মহিলা</label>
                                <label class="radio-inline gender"><input type="radio" id="gender_3" {{ (old('gender') == 3) ? 'checked' : '' }} name="gender" value="3" />অন্যান্য</label>

                                @error('gender')
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
                                <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en') }}" class="form-control @error('present_village_en')is-invalid @enderror" autocomplete="present_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('present_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
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
                                <input type="text" disabled id="present_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
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
                                <input type="text" disabled id="present_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            স্থায়ী ঠিকানা
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
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
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
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no') }}" class="form-control @error('permanent_ward_no')is-invalid @enderror" autocomplete="permanent_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
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
                                <input type="text" disabled id="permanent_district" value="জেলা" class="form-control" placeholder=""/>
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
                                <input type="text" disabled id="permanent_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
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
                                <input type="text" disabled id="permanent_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12 text-center">
                        <h4 class="app-heading">
                            অফিসের ঠিকানা
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_village_en" id="office_village_en" value="{{ old('office_village_en') }}" class="form-control @error('office_village_en')is-invalid @enderror" autocomplete="office_village_en" autofocus placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                @error('office_village_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_village_bn" id="office_village_bn" value="{{ old('office_village_bn') }}" class="form-control @error('office_village_bn')is-invalid @enderror" placeholder="" autocomplete="office_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
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
                            <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_rbs_en" id="office_rbs_en" value="{{ old('office_rbs_en') }}" class="form-control @error('office_rbs_en')is-invalid @enderror" placeholder="" autocomplete="office_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                @error('office_rbs_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_rbs_bn" id="office_rbs_bn" value="{{ old('office_rbs_bn') }}" class="form-control @error('office_rbs_bn')is-invalid @enderror" placeholder="" autocomplete="office_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                @error('office_rbs_bn')
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
                                <input type="text" name="office_holding_no" id="office_holding_no" value="{{ old('office_holding_no') }}" class="form-control @error('office_holding_no')is-invalid @enderror" autocomplete="office_holding_no" autofocus  data-parsley-trigger="keyup"/>
                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('office_holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="office_ward_no" id="office_ward_no" value="{{ old('office_ward_no') }}" class="form-control @error('office_ward_no')is-invalid @enderror" autocomplete="office_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

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
                            <label for="office_district_id" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'office_district', 'office_upazila_append', 'office_upazila_id', 'office_upazila', 3 )" class="custom-select2 form-control @error('office_district_id')is-invalid @enderror" id="office_district_id" name="office_district_id" style="width: 100%; height: 38px;" data-parsley-required>
                                    <option value="" class="district_append">-আপনার জেলা নির্বাচন করুন-</option>
                                </select>
                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                @error('office_district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="office_district" class="col-sm-3 control-label">জেলা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="office_district" value="জেলা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="office_upazila_id" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'office_upazila', 'office_post_office_append', 'office_postoffice_id', 'office_postoffice', 6 )" name="office_upazila_id" id="office_upazila_id" class="form-control @error('office_upazila_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="office_upazila_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                @error('office_upazila_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="office_upazila" class="col-sm-3 control-label">উপজেলা/থানা</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="office_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="office_postoffice_id" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select onchange="getLocation($(this).val(), 'office_postoffice')" name="office_postoffice_id" id="office_postoffice_id" class="form-control @error('office_postoffice_id')is-invalid @enderror" data-parsley-required >
                                    <option value="" id="office_post_office_append">চিহ্নিত করুন</option>
                                </select>
                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                @error('office_postoffice_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="office_postoffice" class="col-sm-3 control-label">পোষ্ট অফিস</label>
                            <div class="col-sm-3">
                                <input type="text" disabled id="office_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-12" style="text-align:center;">
                        <h4 class="app-heading">
                            ব্যবসা/প্রতিষ্ঠান/ভবনের ব্যবহ্রত জমির বিবরণ
                        </h4>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="moja" class="col-sm-3 control-label">মৌজা  </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="moja" id="moja" value="{{ old('moja') }}" class="form-control @error('moja')is-invalid @enderror" autocomplete="moja" autofocus placeholder="" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('moja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="khotian_no" class="col-sm-3 control-label">খতিয়ান নং </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="khotian_no" id="khotian_no" value="{{ old('khotian_no') }}" class="form-control @error('khotian_no')is-invalid @enderror" placeholder="" autocomplete="khotian_no" autofocus data-parsley-type="alphanum" />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                @error('khotian_no')
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
                            <label for="thana" class="col-sm-3 control-label">থানা  </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="thana" id="thana" value="{{ old('thana') }}" class="form-control @error('thana')is-invalid @enderror" autocomplete="thana" autofocus placeholder="" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('thana')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="dag_no" class="col-sm-3 control-label">দাগ নং </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="dag_no" id="dag_no" value="{{ old('dag_no') }}" class="form-control @error('dag_no')is-invalid @enderror" placeholder="" autocomplete="dag_no" autofocus />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                @error('dag_no')
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
                            <label for="district" class="col-sm-3 control-label">জেলা  </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="district" id="district" value="{{ old('district') }}" class="form-control @error('district')is-invalid @enderror" autocomplete="district" autofocus placeholder="" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="land_type" class="col-sm-3 control-label">জমির ধরণ </label>
                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="land_type" id="land_type" value="{{ old('land_type') }}" class="form-control @error('land_type')is-invalid @enderror" placeholder="" autocomplete="land_type" autofocus  />
                                <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>

                                @error('land_type')
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
                            <label for="land_amount" class="col-sm-3 control-label">জমির পরিমাণ </label>
                            <div class="col-sm-9 bt-flabels__wrapper">
                                <input type="text" name="land_amount" id="land_amount" value="{{ old('land_amount') }}" class="form-control @error('land_amount')is-invalid @enderror" autocomplete="land_amount" autofocus data-parsley-trigger="keyup" placeholder="" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('land_amount')
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
                        <input type="hidden" value="14" id="app-type">

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
    <script src="{{ asset('js/custom_address.js') }}"></script>



@endsection



