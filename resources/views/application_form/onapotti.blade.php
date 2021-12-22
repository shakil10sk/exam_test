@extends('layouts.master')
@section('head')
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                    <h4 style="color: white;">অনাপত্তি পত্র আবেদন</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" data-route="{{ $path.'/api/application/onapotti' }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
                <div class="row">
                    <div class="col-md-12 text-center" style="padding-top: 50px">
                        <p><strong class="text-danger">নিয়মাবলিঃ</strong></p>
                        <ul>
                            <li><sup class="text-danger">***</sup>বাংলায় ঘর গুলো পূরন করুন।</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-offset-2">
                        <div class="input-group">
                            {{-- <input type="search" class="form-control" placeholder="ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা পিন নং দিন ইংরেজিতে">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-btn">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    <span class="ion-ios-search" aria-hidden="true"></span> Search
                                </button>
                            </span> --}}
                        </div>
                    </div>
                </div>

                    <div class="row" style="margin-top: 50px;">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Name-english" class="col-sm-3 control-label">ব্যাক্তির নাম (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('name_en')has-error has-feedback @enderror">
                                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="form-control" placeholder="পূর্ণ নাম" autocomplete="name_en" autofocus data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                    @error('name_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="Name-english" class="col-sm-3 control-label">ব্যাক্তির নাম (বাংলায়)<span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('name_bn')has-error has-feedback @enderror">
                                    <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}" class="form-control" placeholder="পূর্ণ নাম" autocomplete="name_bn" autofocus data-parsley-trigger="keyup" data-parsley-required />
                                    <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                    @error('name_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('father_name_en')has-error has-feedback @enderror">
                                    <input type="text" name="father_name_en" id="father_name_en" value="{{ old('father_name_en') }}" class="form-control" placeholder="পিতার নাম" autocomplete="father_name_en" autofocus />
                                    <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                    @error('father_name_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('father_name_bn')has-error has-feedback @enderror">
                                    <input type="text" name="father_name_bn" id="father_name_bn" value="{{ old('father_name_bn') }}" class="form-control" placeholder="পিতার নাম" autocomplete="father_name_bn" autofocus data-parsley-required />
                                    <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                    @error('father_name_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('organization_name_en')has-error has-feedback @enderror">
                                    <input type="text" name="organization_name_en" id="organization_name_en" value="{{ old('organization_name_en') }}" class="form-control" placeholder="" autocomplete="organization_name_en" autofocus />
                                    <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম দিন বাংলায়....</span>

                                    @error('organization_name_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="Name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('organization_name_bn')has-error has-feedback @enderror">
                                    <input type="text" name="organization_name_bn" id="organization_name_bn" value="{{ old('organization_name_bn') }}" class="form-control" placeholder="" autocomplete="organization_name_bn" autofocus data-parsley-required />
                                    <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের নাম দিন বাংলায়....</span>

                                    @error('organization_name_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Father-name-bangla" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('organization_location_en')has-error has-feedback @enderror">
                                    <input type="text" name="organization_location_en" id="organization_location_en" value="{{ old('organization_location_en') }}" class="form-control" placeholder="" autocomplete="organization_location_en" autofocus />
                                    <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান দিন....</span>

                                    @error('organization_location_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Father-name-bangla" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('organization_location_bn')has-error has-feedback @enderror">
                                    <input type="text" name="organization_location_bn" id="organization_location_bn" value="{{ old('organization_location_bn') }}" class="form-control" placeholder="" autocomplete="organization_location_bn" autofocus data-parsley-required />
                                    <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান দিন....</span>

                                    @error('organization_location_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের ধরণ  (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('organization_type_en')has-error has-feedback @enderror">
                                    <input type="text" name="organization_type_en" id="organization_type_en" value="{{ old('organization_type_en') }}" class="form-control" placeholder="" autocomplete="organization_type_en" autofocus />
                                    <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান দিন....</span>

                                    @error('organization_type_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Name-english" class="col-sm-3 control-label">ব্যবসা/প্রতিষ্ঠান/ভবনের ধরণ (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('organization_type_bn')has-error has-feedback @enderror">
                                    <input type="text" name="organization_type_bn" id="organization_type_bn" value="{{ old('organization_type_bn') }}" class="form-control" placeholder="" autocomplete="organization_type_bn" autofocus data-parsley-required />
                                    <span class="bt-flabels__error-desc">ব্যবসা/প্রতিষ্ঠান/ভবনের অবস্থান দিন....</span>

                                    @error('organization_type_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Father-name-bangla" class="col-sm-3 control-label">ট্রেড লাইসেন্স নং</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('trade_license_no')has-error has-feedback @enderror">
                                    <input type="text" name="trade_license_no" id="trade_license_no" value="{{ old('trade_license_no') }}" class="form-control" placeholder="" autocomplete="trade_license_no" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">ট্রেড লাইসেন্স নং দিন....</span>

                                    @error('trade_license_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Gender" class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('gender')has-error has-feedback @enderror">
                                    <label class="radio-inline"><input type="radio" name="gender" value="1" required {{ (old('gender') == 1)? 'checked' : '' }}/>পুরুষ</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="2" {{ (old('gender') == 2)? 'checked' : '' }}/>মহিলা</label>

                                    @error('gender')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Resident" class="col-sm-3 control-label">ব্যাক্তির ঠিকানা <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('resident')has-error has-feedback @enderror">
                                    <select name="resident" id='resident' class="form-control" selected="selected" data-parsley-required >
                                        <option value='' {{ (old('resident') == '')? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                        <option value='1' {{ (old('resident') == 1)? 'selected="selected"' : '' }}>অস্থায়ী</option>
                                        <option value='2' {{ (old('resident') == 2)? 'selected="selected"' : '' }}>স্থায়ী</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                    @error('resident')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 50px;">
                        <div class="col-sm-12">
                            <h4 class="app-heading text-center">
                                বর্তমান ঠিকানা
                            </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_village_en')has-error has-feedback @enderror">
                                    <input type="text" name="present_village_en" id="present_village_en" value="{{ old('present_village_en') }}" class="form-control" placeholder="" autocomplete="present_village_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                    @error('present_village_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_village_bn')has-error has-feedback @enderror">
                                    <input type="text" name="present_village_bn" id="present_village_bn" value="{{ old('present_village_bn') }}" class="form-control" placeholder="" autocomplete="present_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                    <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                    @error('present_village_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_rbs_en')has-error has-feedback @enderror">
                                    <input type="text" name="present_rbs_en" id="present_rbs_en" value="{{ old('present_rbs_en') }}" class="form-control" placeholder="" autocomplete="present_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                    @error('present_rbs_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_rbs_bn')has-error has-feedback @enderror">
                                    <input type="text" name="present_rbs_bn" id="present_rbs_bn" value="{{ old('present_rbs_bn') }}" class="form-control" placeholder="" autocomplete="present_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                    @error('present_rbs_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_holding_no')has-error has-feedback @enderror">
                                    <input type="text" name="present_holding_no" id="present_holding_no" value="{{ old('present_holding_no') }}" class="form-control" autocomplete="present_holding_no" autofocus  data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                    @error('present_holding_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_ward_no')has-error has-feedback @enderror">
                                    <input type="text" name="present_ward_no" id="present_ward_no" value="{{ old('present_ward_no') }}" class="form-control" autocomplete="present_ward_no" autofocus  data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required  />
                                    <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                    @error('present_ward_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_district_id')has-error has-feedback @enderror">
                                    <select name="present_district_id" id="present_district_id" class="form-control" onchange="getLocation($(this).val(), 'present_district', 'present_upazila_append', 'present_upazila_id', 'present_upazila', 3 )" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                        @foreach ($district as $item)
                                        <option value="{{$item->id}}">{{$item->en_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                    @error('present_district_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="District-english" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="present_district" value="জেলা" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_upazila_id')has-error has-feedback @enderror">
                                    <select name="present_upazila_id" id="present_upazila_id" class="form-control" onchange="getLocation($(this).val(), 'present_upazila', 'present_post_office_append', 'present_postoffice_id', 'present_postoffice', 6 )" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                    @error('present_upazila_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="present_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('present_postoffice_id')has-error has-feedback @enderror">
                                    <select name="present_postoffice_id" id="present_postoffice_id" class="form-control" data-parsley-required onchange="getLocation($(this).val(), 'present_postoffice')" >
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                    @error('present_postoffice_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="present_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-top: 50px">
                        <div class="col-sm-12" style="text-align:center;">
                            <h4 class="app-heading text-center">
                                স্থায়ী  ঠিকানা
                            </h4>
                            <p style="font-size:15px;text-align:center; font-weight:normal;padding-top:10px;"> <input type="checkbox" id="permanentBtn" name="permanentBtn" {{ (old('permanentBtn'))? 'checked' : '' }} >ঠিকানা  একই হলে পাশে টিক দিন</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_village_en')has-error has-feedback @enderror">
                                    <input type="text" name="permanent_village_en" id="permanent_village_en" value="{{ old('permanent_village_en') }}" class="form-control" placeholder="" autocomplete="permanent_village_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                    @error('permanent_village_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_village_bn')has-error has-feedback @enderror">
                                    <input type="text" name="permanent_village_bn" id="permanent_village_bn" value="{{ old('permanent_village_bn') }}" class="form-control" placeholder="" autocomplete="permanent_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                    <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                    @error('permanent_village_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_rbs_en')has-error has-feedback @enderror">
                                    <input type="text" name="permanent_rbs_en" id="permanent_rbs_en" value="{{ old('permanent_rbs_en') }}" class="form-control" placeholder="" autocomplete="permanent_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                    @error('permanent_rbs_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_rbs_bn')has-error has-feedback @enderror">
                                    <input type="text" name="permanent_rbs_bn" id="permanent_rbs_bn" value="{{ old('permanent_rbs_bn') }}" class="form-control" placeholder="" autocomplete="permanent_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                    @error('permanent_rbs_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_holding_no')has-error has-feedback @enderror">
                                    <input type="text" name="permanent_holding_no" id="permanent_holding_no" value="{{ old('permanent_holding_no') }}" class="form-control" autocomplete="permanent_holding_no" autofocus  data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                    @error('permanent_holding_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_ward_no')has-error has-feedback @enderror">
                                    <input type="text" name="permanent_ward_no" id="permanent_ward_no" value="{{ old('permanent_ward_no') }}" class="form-control"  data-parsley-type="number" autocomplete="permanent_ward_no" autofocus data-parsley-trigger="keyup" data-parsley-required/>
                                    <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                    @error('permanent_ward_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_district_id')has-error has-feedback @enderror">
                                    <select name="permanent_district_id" id="permanent_district_id" class="form-control" onchange="getLocation($(this).val(), 'permanent_district', 'permanent_upazila_append', 'permanent_upazila_id', 'permanent_upazila', 3 )" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                        @foreach ($district as $item)
                                        <option value="{{$item->id}}">{{$item->en_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                    @error('permanent_district_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="District-english" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="permanent_district" value="জেলা" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_upazila_id')has-error has-feedback @enderror">
                                    <select name="permanent_upazila_id" id="permanent_upazila_id" class="form-control" onchange="getLocation($(this).val(), 'permanent_upazila', 'permanent_post_office_append', 'permanent_postoffice_id', 'permanent_postoffice', 6 )" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                    @error('permanent_upazila_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="permanent_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('permanent_postoffice_id')has-error has-feedback @enderror">
                                    <select name="permanent_postoffice_id" id="permanent_postoffice_id" class="form-control" onchange="getLocation($(this).val(), 'permanent_postoffice')" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                    @error('permanent_postoffice_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="permanent_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12" style="text-align:center; margin-top: 50px;">
                            <h4 class="app-heading text-center">
                                অফিসের ঠিকানা
                            </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Village-english" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_village_en')has-error has-feedback @enderror">
                                    <input type="text" name="office_village_en" id="office_village_en" value="{{ old('office_village_en') }}" class="form-control" placeholder="" autocomplete="office_village_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>

                                    @error('office_village_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Village-bangla" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_village_bn')has-error has-feedback @enderror">
                                    <input type="text" name="office_village_bn" id="office_village_bn" value="{{ old('office_village_bn') }}" class="form-control" placeholder="" autocomplete="office_village_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />
                                    <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                                    @error('office_village_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Road-block-sector-english" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_rbs_en')has-error has-feedback @enderror">
                                    <input type="text" name="office_rbs_en" id="office_rbs_en" value="{{ old('office_rbs_en') }}" class="form-control" placeholder="" autocomplete="office_rbs_en" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>

                                    @error('office_rbs_en')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Road-block-sector-bangla" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_rbs_bn')has-error has-feedback @enderror">
                                    <input type="text" name="office_rbs_bn" id="office_rbs_bn" value="{{ old('office_rbs_bn') }}" class="form-control" placeholder="" autocomplete="office_rbs_bn" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>
                                    <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>

                                    @error('office_rbs_bn')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_holding_no')has-error has-feedback @enderror">
                                    <input type="text" name="office_holding_no" id="office_holding_no" value="{{ old('office_holding_no') }}" class="form-control" autocomplete="office_holding_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" />
                                    <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                    @error('office_holding_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_ward_no')has-error has-feedback @enderror">
                                    <input type="text" name="office_ward_no" id="office_ward_no" value="{{ old('office_ward_no') }}" class="form-control"  data-parsley-type="number" autocomplete="office_ward_no" autofocus data-parsley-trigger="keyup" data-parsley-required/>
                                    <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                    @error('office_ward_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">জেলা <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_ward_no')has-error has-feedback @enderror">
                                    <select name="office_district_id" id="office_district_id" class="form-control" onchange="getLocation($(this).val(), 'office_district', 'office_upazila_append', 'office_upazila_id', 'office_upazila', 3 )" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                        @foreach ($district as $item)
                                        <option value="{{$item->id}}">{{$item->en_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                    @error('office_district_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="District-english" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="office_district" value="জেলা" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_upazila_id')has-error has-feedback @enderror">
                                    <select name="office_upazila_id" id="office_upazila_id" class="form-control" onchange="getLocation($(this).val(), 'office_upazila', 'office_post_office_append', 'office_postoffice_id', 'office_postoffice', 6 )" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                    @error('office_upazila_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="office_upazila" value="উপজেলা/থানা" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span>*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('office_postoffice_id')has-error has-feedback @enderror">
                                    <select name="office_postoffice_id" id="office_postoffice_id" class="form-control" onchange="getLocation($(this).val(), 'office_postoffice')" data-parsley-required >
                                        <option value="">চিহ্নিত করুন</option>
                                    </select>
                                    <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                    @error('office_postoffice_id')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" disabled id="office_postoffice" value="পোষ্ট অফিস" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12" style="text-align:center; margin-top: 50px;">
                            <h4 class="app-heading text-center">
                                ব্যবসা/প্রতিষ্ঠান/ভবনের ব্যবহ্রত জমির বিবরণ
                            </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Village-bangla" class="col-sm-3 control-label">মৌজা</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('moja')has-error has-feedback @enderror">
                                    <input type="text" name="moja" id="moja" value="{{ old('moja') }}" class="form-control" placeholder="" autocomplete="moja" autofocus />
                                    <span class="bt-flabels__error-desc">মৌজা দিন....</span>

                                    @error('moja')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="khotian_no" class="col-sm-3 control-label">খতিয়ান নং</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('khotian_no')has-error has-feedback @enderror">
                                    <input type="text" name="khotian_no" id="khotian_no" class="form-control" placeholder="" autocomplete="khotian_no" autofocus />
                                    <span class="bt-flabels__error-desc">খতিয়ান নং দিন ইংরেজিতে....</span>

                                    @error('khotian_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Road-block-sector-bangla" class="col-sm-3 control-label">থানা</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('thana')has-error has-feedback @enderror">
                                    <input type="text" name="thana" id="thana" value="{{ old('thana') }}" class="form-control" placeholder="" autocomplete="thana" autofocus />
                                    <span class="bt-flabels__error-desc">থানা দিন বাংলায়....</span>

                                    @error('thana')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="Thana-bangla" class="col-sm-3 control-label">দাগ নং</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('dag_no')has-error has-feedback @enderror">
                                    <input type="text" name="dag_no" id="dag_no" value="{{ old('dag_no') }}" class="form-control" placeholder="" autocomplete="dag_no" autofocus />
                                    <span class="bt-flabels__error-desc">দাগ নং দিন ইংরেজিতে....</span>

                                    @error('dag_no')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Word-no-bangla" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('district')has-error has-feedback @enderror">
                                    <input type="text" name="district" id="district" value="{{ old('district') }}" class="form-control" placeholder="" autocomplete="district" autofocus />
                                    <span class="bt-flabels__error-desc">জেলা দিন বাংলায়....</span>

                                    @error('district')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="Post-office-bangla" class="col-sm-3 control-label">জমির ধরণ</label>
                                <div class="col-sm-3 bt-flabels__wrapper @error('land_type')has-error has-feedback @enderror">
                                    <input type="text" name="land_type" id="land_type" value="{{ old('land_type') }}" class="form-control" placeholder="" autocomplete="land_type" autofocus />
                                    <span class="bt-flabels__error-desc">জমির ধরণ দিন বাংলায়....</span>

                                    @error('land_type')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="Post-office-bangla" class="col-md-3 control-label">জমির পরিমাণ</label>
                                <div class="col-md-9 bt-flabels__wrapper @error('land_amount')has-error has-feedback @enderror">
                                    <input type="text" name="land_amount" id="land_amount" value="{{ old('land_amount') }}" class="form-control" placeholder="" autocomplete="land_amount" autofocus />
                                    <span class="bt-flabels__error-desc">জমির পরিমাণ দিন ইংরেজিতে....</span>

                                    @error('land_amount')
                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

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

    <script src="{{ asset('js/parsley.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.js') }}"></script>

    <script>
        $("#form-data").submit(function(e){
            e.preventDefault();

            let path = $('meta[name=url]').attr("content");
            let route       = $('#form-data').data('route');
            let formData    = new FormData($("#form-data")[0]);

            $.ajax({
                type        :   'POST',
                url         :   route,
                data        :  formData,
                processData :   false,
                contentType :   false,
                cache       :   false,
                beforeSend  : function(){
                    $('#submitBtn').attr('disabled','disabled');
                },
                success:function (res) {
                    console.log(res);
                    if(res.success){
                        Swal.fire({
                            title   : '<strong>'+res.success+'</strong>',
                            icon    : 'success',
                            html    : 'আপনার পিন নং <b>'+res.pin+'</b>, এবং ট্র্যাকিং নং <b>'+res.tracking+
                                '</b> <a href="'+path+'/verify/'+res.application+'/'+res.tracking+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a> ',
                            showConfirmButton: true,
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonText:
                                '<i class="fa fa-print-up"></i> ঠিক আছে!',
                            confirmButtonAriaLabel: 'ঠিক আছে!'
                            }).then(function () {
                            location.reload(true);
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: res.error,
                            confirmButtonText: 'ঠিক আছে'
                            });
                    }
                },
                error:function (e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত...',
                        text: 'আবেদন সম্পূর্ণ হয়নি!',
                        confirmButtonText: 'ঠিক আছে'
                        });

                    $('#submitBtn').removeAttr('disabled');

                    console.log(e);

                }

            });

        });


        //get geo location
        function getLocation(parentId, selectId = null, targetId = null, thanId = null, thanViewId = null, type = null){

            let web_loc = $('meta[name=url]').attr("content");
            let nam = '';
            if (type == 3){
                nam = 'উপজেলা/থানা';
            }else {
                nam = 'পোস্ট অফিস';
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'get',
                url: web_loc + '/geo/code/get',
                data: { 'id': parentId, 'type': type },
                success: function (data) {

                    $("#" + thanViewId).val(nam);
                    $("#" + selectId).val(data.name);
                    $("#" + thanId).html('<option value="" id="' + targetId + '">চিহ্নিত করুন</option>');

                    data.upzilla.forEach(el => {
                        $("#" + targetId).after("<option value='" + el.id + "'>" + el.en_name + "</option>");
                    });
                },
                error: function (e) {
                    alert('error occur');
                    console.log(e);

                }
            });
        }


    </script>

@endsection
