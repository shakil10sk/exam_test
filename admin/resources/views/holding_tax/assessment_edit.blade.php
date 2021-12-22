@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title text-center">
                    <h4 class="text-center application_head"> হোল্ডিং ট্যাক্স এসেসমেন্ট </h4>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container">
            <form action="{{ route('holding.assessment.update') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>

                @csrf

                {{-- <div class="row" style="">
                    <div class="col-md-8">
                        <div class="input-group mt-5">
                            <input type="search" name="search_data" class="form-control" id="search_data" placeholder="মোবাইল/এন.আই.ডি.নং/জন্ম নিবন্ধন নং/পাসপোর্ট নং/পিন নং দিন ইংরেজিতে">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="check_assesment_exist_data()">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    <span class="ion-ios-search" aria-hidden="true"></span> Search
                                </button>
                            </span>
                        </div>
                    </div> 
                </div> --}}

                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Name-bangla" class="col-sm-3 control-label"> নাম (বাংলায়) <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="name_bn" id="name_bn" value="{{ $data->name }}" class="form-control @error('name_bn') is-invalid @enderror" autocomplete="name_bn" autofocus placeholder="পূর্ণ নাম" data-parsley-trigger="keyup" data-parsley-required />
                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                                @error('name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Mobile" class="col-sm-3 control-label">মোবাইল <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mobile" id="mobile" value="{{ $data->mobile_no }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" data-parsley-required placeholder="ইংরেজিতে প্রদান করুন" />
                                <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center" id="national_id_error">

                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="nid" id="nid" value="{{ $data->nid }}" class="form-control @error('nid') is-invalid @enderror" data-parsley-maxlength="17" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />
                                <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং (ইংরেজিতে)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_id" value="{{ $data->birth_id }}" id="birth_id" class="form-control @error('birth_id') is-invalid @enderror" autocomplete="birth_id" autofocus data-parsley-maxlength="17" data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />
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
                                <input type="text" name="passport_no" value="{{ $data->passport_no }}" id="passport_no" class="form-control @error('passport_no') is-invalid @enderror" autocomplete="passport_no" autofocus data-parsley-type="text" data-parsley-maxlength="17" data-parsley-trigger="keyup" placeholder="1616623458679011"/>
                                <span class="bt-flabels__error-desc">পাসপোর্ট নং দিন ইংরেজিতে....</span>

                                @error('passport_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="birth_date" value="{{ $data->birth_date }}" id="birth_date" class="form-control date @error('birth_date') is-invalid @enderror" autocomplete="birth_date" autofocus data-parsley-type="date" data-parsley-trigger="keyup" data-parsley-required  placeholder="yyyy-mm-dd" />
                                <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>

                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="father_name_bn" id="father_name_bn" value="{{ $data->father_name }}" class="form-control @error('father_name_bn') is-invalid @enderror" autocomplete="father_name_bn" autofocus placeholder="পিতার নাম" data-parsley-required />
                                <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                                @error('father_name_bn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="mother_name_bn" id="mother_name_bn" value="{{ $data->mother_name }}" class="form-control @error('mother_name_bn') is-invalid @enderror" autocomplete="mother_name_bn" autofocus placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />
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
                            <label for="profession" class="col-sm-3 control-label">পেশা</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="occupation" id="occupation" value="{{ $data->occupation }}" class="form-control @error('occupation') is-invalid @enderror" autocomplete="occupation" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>
                                <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>

                                @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="religion" id="religion" selected="selected" class="form-control @error('religion')is-invalid @enderror" data-parsley-required >
                                    <option value='' {{ $data->religion == '' ? 'selected="selected"' : '' }}>চিহ্নিত করুন</option>
                                    <option value='1' {{ $data->religion == '1' ? 'selected="selected"' : '' }}>ইসলাম</option>
                                    <option value='2' {{ $data->religion == '2' ? 'selected="selected"' : '' }}>হিন্দু</option>
                                    <option value='3' {{ $data->religion == '3' ? 'selected="selected"' : '' }}>বৌদ্ধ ধর্ম</option>
                                    <option value='4' {{ $data->religion == '4' ? 'selected="selected"' : '' }}>খ্রিস্ট ধর্ম</option>
                                    <option value='5' {{ $data->religion == '5' ? 'selected="selected"' : '' }}>অন্যান্য</option>
                                </select>

                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('religion')
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
                            এসেসমেন্ট তথ্য<hr>
                        </h4>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="holding_no" class="col-sm-3 control-label">হোল্ডিং নং <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="holding_no" id="holding_no" value="{{ $data->holding_no }}" class="form-control @error('holding_no')is-invalid @enderror" autocomplete="holding_no" autofocus required />

                                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>

                                @error('holding_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="assessment_date" class="col-sm-3 control-label">এসেসমেন্ট তারিখ  <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="assessment_date" id="assessment_date" value="{{ $data->assessment_date }}" class="form-control @error('assessment_date')is-invalid @enderror" autocomplete="assessment_date" autofocus required placeholder="yyyy-mm-dd" />

                                <span class="bt-flabels__error-desc">এসেসমেন্ট তারিখ সিলেক্ট করুন</span>

                                @error('assessment_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="ward_no" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="ward_no" id="ward_no" class="form-control @error('ward_no')is-invalid @enderror" required onchange="set_ward_name(this.value)">

                                <option value="">Select</option>

                                @foreach($ward_list as $item)
                                    <option value="{{$item->id}}" @if($item->id == $data->ward_id) selected  @endif >{{$item->ward_no}}</option>
                                @endforeach

                                </select>

                                <span class="bt-flabels__error-desc">ওয়ার্ড নং নির্বাচন করুন</span>

                                @error('ward_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="Word-no-english" class="col-sm-3 control-label">ওয়ার্ড নাম </label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="ward_name" id="ward_name" class="form-control @error('ward_name')is-invalid @enderror" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                          
                            <label for="moholla_id" class="col-sm-3 control-label">গ্রাম/মহল্লা <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="moholla_id" id="moholla_id" class="form-control @error('moholla_id')is-invalid @enderror" data-parsley-required >

                                <option value="">Select</option>

                                @foreach($moholla_list as $item)
                                    <option value="{{$item->id}}" @if($item->id == $data->moholla_id) selected  @endif >{{$item->name}}</option>
                                @endforeach

                                </select>

                                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা নির্বাচন করুন</span>

                                @error('moholla_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                             <label for="block_id" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়)</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="block_id" id="block_id" class="form-control @error('block_id')is-invalid @enderror">

                                <option value="">Select</option>
                                
                                @foreach($block_list as $item)
                                    <option value="{{$item->id}}" @if($item->id == $data->block_id) selected  @endif >{{$item->name}}</option>
                                @endforeach

                                </select>

                                @error('block_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="construction_type" class="col-sm-3 control-label">ভবন নির্মানের ধরন <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="construction_type" id="construction_type" class="form-control @error('construction_type')is-invalid @enderror" required>
                                <option value="">Select</option>
                                <option value="1" @if($data->construction_type == 1) selected @endif >কাঁচা</option>
                                <option value="2" @if($data->construction_type == 2) selected @endif >আধা কাঁচা</option>
                                <option value="3" @if($data->construction_type == 3) selected @endif >পাকা</option>
                                <option value="4" @if($data->construction_type == 4) selected @endif >আধা পাকা</option>
                                </select>

                                <span class="bt-flabels__error-desc">ভবন নির্মানের ধরন নির্বাচন করুন</span>

                                @error('construction_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="property_type" class="col-sm-3 control-label">ভবনের ধরন <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="property_type" id="property_type" class="form-control @error('property_type')is-invalid @enderror" required onchange="holdingTaxCalculation(this.value)">
                                
                                <option value="">Select</option>
                                
                                @foreach($property_list as $item)
                                    <option value="{{$item->id}}" @if($data->property_id == $item->id) selected @endif >
                                        {{$item->name}}
                                    </option>
                                @endforeach
                                
                                </select>

                                <span class="bt-flabels__error-desc">ভবনের ধরন নির্বাচন করুন</span>

                                @error('property_type')
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
                            
                            <label for="owner_type" class="col-sm-3 control-label">মালিকানার ধরন <span>*</span></label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <select name="owner_type" id="owner_type" class="form-control @error('owner_type')is-invalid @enderror" autocomplete="owner_type" autofocus required>
                                <option value="">Select</option>
                                <option value="1" @if($data->owner_type == 1) selected @endif >ভাড়া</option>
                                <option value="2" @if($data->owner_type == 2) selected @endif >ব্যক্তি মালিকানা</option>
                                </select>

                                <span class="bt-flabels__error-desc">মালিকানার ধরন নির্বাচন করুন</span>

                                @error('owner_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="road_width" class="col-sm-3 control-label">রাস্তার প্রস্থ</label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="road_width" id="road_width" value="{{ $data->road_width }}" class="form-control @error('road_width')is-invalid @enderror" placeholder="রাস্তার প্রস্থ" autocomplete="road_width" autofocus />
                                
                                @error('road_width')
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
                            
                            <label for="rent_area" class="col-sm-2 control-label"> ভাড়া জায়গার পরিমান (বর্গফুট) </label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="rent_area" id="rent_area" value="{{ $data->rent_area }}" class="form-control" autocomplete="rent_area" onkeyup="calculateTotalArea(this.value, own_area.value)" />
                            </div>

                            <label for="own_area" class="col-sm-2 control-label"> নিজস্ব জায়গার পরিমান (বর্গফুট) <span>*</span></label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="own_area" id="own_area" value="{{ $data->owner_area }}" class="form-control" autocomplete="own_area" autofocus required onkeyup="calculateTotalArea(rent_area.value, this.value)" />

                                <span class="bt-flabels__error-desc">নিজস্ব জায়গার পরিমান দিন</span>
                            </div>
                            
                            <label for="total_area" class="col-sm-2 control-label"> মোট জায়গার পরিমান (বর্গফুট) </label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="total_area" id="total_area" class="form-control" autocomplete="total_area" autofocus readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            
                            <label for="depreciation" class="col-sm-2 control-label"> Depreciation </label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="depreciation" id="depreciation" value="{{ $data->depreciation }}" class="form-control" autocomplete="depreciation" onkeyup="calculateAppreciationDepreciation()" />
                            </div>

                            <label for="appreciation" class="col-sm-2 control-label">Apreciation </label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="appreciation" id="appreciation" value="{{ $data->appreciation }}" class="form-control" autocomplete="appreciation" onkeyup="calculateAppreciationDepreciation()" />
                            </div>
                            
                            <label for="tax_rate" class="col-sm-2 control-label">ট্যাক্স রেট</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="tax_rate" id="tax_rate" value="{{ old('tax_rate') }}" class="form-control" placeholder="00" autocomplete="tax_rate" autofocus readonly />
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            
                            <label for="annual_rental_value" class="col-sm-3 control-label"> Annual Rental Value (ARV) </label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="annual_rental_value" id="annual_rental_value" class="form-control" readonly value="{{ $data->arv }}" />
                            </div>

                            <label for="final_annual_rental_value" class="col-sm-3 control-label"> Final Annual Rental Value (ARV) </label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="final_annual_rental_value" id="final_annual_rental_value" class="form-control" readonly value="{{ $data->farv }}" />
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            
                            <label for="annual_tax" class="col-sm-3 control-label"> মোট বাৎসরিক ট্যাক্স </label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="annual_tax" id="annual_tax" class="form-control" readonly value="{{ $data->yearly_tax }}" />

                            </div>

                            <label for="monthly_tax" class="col-sm-3 control-label"> মাসিক ট্যাক্স </label>

                            <div class="col-sm-3 bt-flabels__wrapper">
                                <input type="text" name="monthly_tax" id="monthly_tax" class="form-control" readonly value="{{ $data->monthly_tax }}" />
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 100px;">
                    <div class="offset-6 col-sm-6 button-style">
                        <input type="hidden" name="pid" id="pid" value="{{$data->id}}">
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
    <script src="{{ asset('js/holding_tax.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#assessment_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            set_ward_name({{$data->ward_id}});
            holdingTaxCalculation({{$data->property_id}});
            calculateTotalArea({{$data->rent_area}},{{$data->owner_area}});
            calculateAppreciationDepreciation();

        });

        var ward_list = [];

        @foreach($ward_list as $item)
        ward_list[{{$item->id}}] = '{{$item->name}}';
        @endforeach
        
        var property_list = [];

        @foreach($property_list as $item)
        property_list[{{$item->id}}] = {{$item->fee}};
        @endforeach

    </script>
@endsection



