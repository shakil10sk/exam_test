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
                    <h4 style="color: white;">রাস্তা খননের আবেদন</h4>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-top: 50px;">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <form action="" method="post" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 text-center" style="padding-top: 50px">
                                        <p><strong class="text-danger">নিয়মাবলিঃ</strong></p>
                                        <ul>
                                            <li><sup class="text-danger">***</sup>বাংলায় ঘর গুলো পূরন করুন।</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 50px;">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">নাম <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('name_bn')has-error has-feedback @enderror">
                                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}" class="form-control" placeholder="নাম" autocomplete="name_bn" autofocus data-parsley-required/>
                                                <span class="bt-flabels__error-desc">আবেদনকারীর নাম দিন বাংলায়....</span>

                                                @error('name_bn')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label  class="col-sm-3 control-label">পিতা/স্বামী নাম <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('father_husband_name_bn')has-error has-feedback @enderror">
                                                <input type="text" name="father_husband_name_bn" value="{{ old('father_husband_name_bn') }}" id="father_husband_name" class="form-control" placeholder="পিতা/স্বামী নাম" autocomplete="father_husband_name" autofocus data-parsley-required/>

                                                <span class="bt-flabels__error-desc">আবেদনকারীর পিতা/স্বামী নাম দিন বাংলায়....</span>

                                                @error('father_husband_name_bn')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label  class="col-sm-3 control-label">মাতার নাম <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('mother_name_bn')has-error has-feedback @enderror">
                                                <input type="text" name="mother_name_bn" id="mother_name" value="{{ old('mother_name_bn') }}" class="form-control" placeholder="মাতা" autocomplete="mother_name" autofocus data-parsley-required/>
                                                <span class="bt-flabels__error-desc">আবেদনকারীর মাতার নাম দিন বাংলায়....</span>

                                                @error('mother_name_bn')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label class="col-sm-3 control-label">রাস্তার নাম <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('road_name')has-error has-feedback @enderror">
                                                <input type="text" name="road_name" id="road_name" value="{{ old('road_name') }}" class="form-control" placeholder="রাস্তার নাম" autocomplete="road_name" autofocus data-parsley-required/>
                                                <span class="bt-flabels__error-desc">রাস্তার নাম দিন বাংলায়....</span>

                                                @error('road_name')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label  class="col-sm-3 control-label">রাস্তার ধরণ <span> *</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('road_type')has-error has-feedback @enderror">
                                                <select name="road_type" id="road_type" class="form-control" selected="selected"  data-parsley-required >
                                                    <option value='' {{ (old('road_type') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                                    <option value='1' {{ (old('road_type') == 1) ? 'selected="selected"' : '' }}>কাঁচা</option>
                                                    <option value='2' {{ (old('road_type') == 2) ? 'selected="selected"' : '' }}>পাকা</option>
                                                    <option value='3' {{ (old('road_type') == 3) ? 'selected="selected"' : '' }}>অর্ধ পাকা</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">রাস্তার ধরণ চিহ্নিত করুন....</span>

                                                @error('road_type')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label class="col-sm-3 control-label">প্রতিষ্ঠানের নাম <span> *</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('organization_name')has-error has-feedback @enderror">
                                                <select name="organization_name" class="form-control" selected="selected"  data-parsley-required >
                                                    <option value='' {{ (old('organization') == '') ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                                    <option value='1' {{ (old('organization') == 1) ? 'selected="selected"' : '' }}>ওয়াসা</option>
                                                    <option value='2' {{ (old('organization') == 2) ? 'selected="selected"' : '' }}>সুয়ারেজ</option>
                                                    <option value='3' {{ (old('organization') == 3) ? 'selected="selected"' : '' }}>তিতাস</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">প্রতিষ্ঠানের নাম চিহ্নিত করুন....</span>

                                                @error('organization_name')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label  class="col-sm-3 control-label">রাস্তার দৈর্ঘ্য <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('length')has-error has-feedback @enderror">
                                                <input type="text" name="length" id="length" value="{{ old('length') }}" class="form-control" placeholder="দৈর্ঘ্য" autocomplete="length" autofocus data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                                <span class="bt-flabels__error-desc">রাস্তার দৈর্ঘ্য দিন....</span>

                                                @error('length')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label class="col-sm-3 control-label">প্রস্থ <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('width')has-error has-feedback @enderror">
                                                <input type="text" name="width" id="width" value="{{ old('width') }}" class="form-control" placeholder="প্রস্থ" autocomplete="width" autofocus data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>
                                                <span class="bt-flabels__error-desc">রাস্তার প্রস্থ দিন....</span>

                                                @error('width')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">দাগের ধরণ <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('dager_type')has-error has-feedback @enderror">
                                                <select name="dager_type" class="form-control" selected="selected"  data-parsley-required >
                                                    <option value='' {{ (old('dager_type') == '')? 'selected="selected"' : '' }}>দাগের ধরণ চিহ্নিত করুন</option>
                                                    <option value='1' {{ (old('dager_type') == 1)? 'selected="selected"' : '' }}>সি এস</option>
                                                    <option value='2' {{ (old('dager_type') == 2)? 'selected="selected"' : '' }}>এস এ</option>
                                                    <option value='3' {{ (old('dager_type') == 3)? 'selected="selected"' : '' }}>আর এস</option>
                                                </select>

                                                <span class="bt-flabels__error-desc">দাগের ধরণ চিহ্নিত করুন....</span>

                                                @error('dager_type')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">দাগ নং <span> *</span> </label>
                                                <div class="col-sm-3 bt-flabels__wrapper @error('dag_no')has-error has-feedback @enderror">
                                                    <input type="text" name="dag_no" value="{{ old('dag_no') }}" id="dag_no" class="form-control" placeholder="দাগ নং" autocomplete="dag_no" autofocus data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required/>

                                                    <span class="bt-flabels__error-desc">দাগ নং দিন....</span>

                                                    @error('dag_no')
                                                    <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="margin-top: 50px;">
                                    <div class="col-sm-12" style="text-align:center;">
                                        <h4 class="app-heading">
                                            যোগাযোগ
                                        </h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="District-english" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('district_id')has-error has-feedback @enderror">
                                                <select name="district_id" id="district_id" class="form-control" data-parsley-required >
                                                    <option value="">চিহ্নিত করুন</option>
                                                    <option value="1">Dhaka</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                                @error('district_id')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="District-english" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('upazila_id')has-error has-feedback @enderror">
                                                <select name="upazila_id" id="upazila_id" class="form-control" data-parsley-required >
                                                    <option value="">চিহ্নিত করুন</option>
                                                    <option value="1">Nowbabgonj</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                                @error('upazila_id')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="District-english" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('postoffice_id')has-error has-feedback @enderror">
                                                <select name="postoffice_id" id="postoffice_id" class="form-control" data-parsley-required >
                                                    <option value="">চিহ্নিত করুন</option>
                                                </select>
                                                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>

                                                @error('postoffice_id')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('ward_no')has-error has-feedback @enderror">
                                                <input type="text" name="ward_no" id="ward_no" value="{{ old('ward_no') }}" class="form-control"  data-parsley-type="number" autocomplete="ward_no" autofocus data-parsley-trigger="keyup" data-parsley-required/>
                                                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>

                                                @error('ward_no')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>
                                            <div class="col-sm-3 bt-flabels__wrapper @error('mobile')has-error has-feedback @enderror">
                                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                                @error('mobile')
                                                <span id="phoneStatus" class="help-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 50px;">
                                    <div class="col-sm-offset-6 col-sm-6 button-style">
                                        <input type="hidden" name="application_type" value="{{ md5(23) }}">
                                        <button type="submit" class="btn btn-primary">দাখিল করুন</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.js') }}"></script>
@endsection
