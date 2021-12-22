@extends('layouts.app')
@section('head')
    <!-- jquery -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>

    {{-- form custom style --}}
    <link rel="stylesheet" href="{{ asset('css/form_validate.min.css') }}">

@endsection
@section('content')
    {{--Breadcrumb Section--}}
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-id-card-o" aria-hidden="true"></i> ভাতার তালিকা যোগ করুন</h4><hr/>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <form action="{{ route('store-allowance') }}" method="POST" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf
            <div class="row form-group">
                    <label for="type" class="col-sm-2 control-label"> ভাতার টাইপ *</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <select id="type" name="type" selected="selected" class="form-control" data-parsley-required>
                            <option {{ (old('type') == '')? 'selected="selected"' : '' }} value=""> ভাতার টাইপ নির্বাচন করুন</option>
                            <option {{ (old('type') == 1)? 'selected="selected"' : '' }} value="1">মুক্তিযোদ্ধা ভাতা</option>
                            <option {{ (old('type') == 2)? 'selected="selected"' : '' }} value="2">দুস্থ ও দরিদ্র ভাতা</option>
                            <option {{ (old('type') == 3)? 'selected="selected"' : '' }} value="3">বয়স্ক ভাতা</option>
                            <option {{ (old('type') == 4)? 'selected="selected"' : '' }} value="4">মাতৃত্যকালিন ভাতা</option>
                            <option {{ (old('type') == 5)? 'selected="selected"' : '' }} value="5">বিধবা ভাতা</option>
                            <option {{ (old('type') == 6)? 'selected="selected"' : '' }} value="6">প্রতিবন্ধী ভাতা</option>
                            <option {{ (old('type') == 7)? 'selected="selected"' : '' }} value="7">ভি জি ডি ভাতা</option>
                        </select>
                        <span class="bt-flabels__error-desc"> ভাতার টাইপ নির্বাচন করুন....</span>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label for="name" class="col-sm-2 control-label"> নাম (বাংলায়)*</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus placeholder="পূর্ণ নাম বাংলায়..." data-parsley-required/>
                        <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="nid" class="col-sm-2 control-label">ন্যাশনাল আইডি (ইংরেজিতে)</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="number" name="nid" id="nid" value="{{ old('nid') }}" class="form-control @error('nid') is-invalid @enderror" data-parsley-maxlength="17" autocomplete="nid" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" required/>
                        <span class="bt-flabels__error-desc">ন্যাশনাল আইডি নং দিন ইংরেজিতে....</span>

                        @error('nid')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label for="educational_qualification" class="col-sm-2 control-label">শিক্ষাগত যোগ্যতা</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="educational_qualification" id="educational_qualification" value="{{ old('educational_qualification') }}" class="form-control @error('educational_qualification') is-invalid @enderror" autocomplete="educational_qualification" placeholder="শিক্ষাগত যোগ্যতা দিন...." />
                        <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন....</span>

                        @error('educational_qualification')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    
                </div>

                <div class="row form-group">
                    <label for="father_name" class="col-sm-2 control-label">পিতার নাম (বাংলায়)</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="father_name" id="father_name" value="{{ old('father_name') }}" class="form-control @error('father_name') is-invalid @enderror" autocomplete="father_name" autofocus placeholder="পিতার নাম দিন বাংলায়..." data-parsley-required/>
                        <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>

                        @error('father_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="date_of_birth" class="col-sm-2 control-label">জম্ম  তারিখ <span>*</span></label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control date @error('date_of_birth') is-invalid @enderror" autocomplete="date_of_birth" autofocus data-parsley-type="date" data-parsley-trigger="keyup" data-parsley-required  placeholder="0000-00-00" />
                        <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>

                        @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <label for="mobile" class="col-sm-2 control-label">মোবাইল </label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile')is-invalid @enderror" autocomplete="mobile" autofocus data-parsley-type="digits" data-parsley-minlength="11" data-parsley-maxlength="11" data-parsley-trigger="keyup" placeholder="মোবাইল নম্বর ইংরেজিতে প্রদান করুন" />
                        <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>

                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <label for="village" class="col-sm-2 control-label">গ্রাম/মহল্লা (বাংলায়) *</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="village" id="village" value="{{ old('village') }}" class="form-control @error('village')is-invalid @enderror" autocomplete="village" autofocus data-parsley-required placeholder="গ্রাম/মহল্লা দিন বাংলায়...." />
                        <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>

                        @error('village')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <label for="ward_no" class="col-sm-2 control-label">ওয়ার্ড নং *</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="text" name="ward_no" id="ward_no" value="{{ old('ward_no') }}" class="form-control @error('ward_no') is-invalid @enderror" autocomplete="ward_no" autofocus placeholder="ওয়ার্ড নং দিন..."  data-parsley-required/>
                        <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন....</span>

                        @error('ward_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="amount_of_allowance" class="col-sm-2 control-label">ভাতার পরিমান *</label>
                    <div class="col-sm-4 bt-flabels__wrapper">
                        <input type="number" name="amount_of_allowance" id="amount_of_allowance" value="{{ old('amount_of_allowance') }}" class="form-control @error('amount_of_allowance') is-invalid @enderror" autocomplete="amount_of_allowance" autofocus placeholder="ভাতার পরিমান" data-parsley-required/>
                        <span class="bt-flabels__error-desc">ভাতার পরিমান প্রদান করুন....</span>

                        @error('amount_of_allowance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div id="sector" class="col-md-6">

                    </div>

                    <div id="health" class="col-md-6">
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 form-group text-center">
                        <textarea id="textarea_editor" name="bio" class="@error('bio') is-invalid @enderror form-control border-radius-0 btn-white" placeholder="জীবনবৃত্তান্ত দিন....">{{ old('bio') }}</textarea>

                        @error('bio')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="cropzee-input">
                            <div class="image-overlay">
                                <img src="{{ asset('images/default/default2.jpg') }}" class="image-previewer image" data-cropzee="cropzee-input" />
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
                    <div class="col-md-2 text-center ml-auto mr-auto">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#type').change(function(){
                if($(this).val() == 1){
                    $('#sector').html('<div class="row form-group"><label for="sector_no" class="col-sm-4 control-label">সেক্টর নং</label><div class="col-sm-8 bt-flabels__wrapper"><select id="sector_no" name="sector_no" selected="selected" class="form-control" required ><option value="">সেক্টর নং নির্বাচন করুন</option><option value="1">সেক্টর নং ১</option><option value="2">সেক্টর নং ২</option><option value="3">সেক্টর নং ৩</option><option value="4">সেক্টর নং ৪</option><option value="5">সেক্টর নং ৫</option><option value="6">সেক্টর নং ৬</option><option value="7">সেক্টর নং ৭</option><option value="8">সেক্টর নং ৮</option><option value="9">সেক্টর নং ৯</option><option value="10">সেক্টর নং ১০</option><option value="11">সেক্টর নং ১১</option></select><span class="bt-flabels__error-desc">সেক্টর নং দিন....</span></div></div>');
                }else if($(this).val() == 4){
                    $('#sector').html('<div class="row form-group"><label for="health_condition" class="col-sm-4 control-label">স্বাস্থ্যগত অবস্থা</label><div class="col-sm-8 bt-flabels__wrapper"><select name="health_condition" id="health_condition" selected="selected" class="form-control" required><option value="প্রথম গর্ভধারন কাল">প্রথম গর্ভধারন কাল</option><option value="বয়স ২০ বছর তার উর্ধে">বয়স ২০ বছর  তার উর্ধে </option></select><span class="bt-flabels__error-desc">স্বাস্থ্যগত অবস্থা দিন....</span></div></div>');
                    $('#health').html('<div class="row form-group"><label for="economical_condition" class="col-sm-4 control-label">আর্থ সামাজিক অবস্থা</label><div class="col-sm-8 bt-flabels__wrapper"><select name="economical_condition" selected="selected" class="form-control" required><option value="দরিদ্র পরিবারে প্রথম রোজগারি মহিলা">দরিদ্র পরিবারে প্রথম রোজগারি মহিলা</option><option value="মাসিক ১৫০০/-টাকার নিচে">মাসিক ১৫০০/-টাকার নিচে</option>	<option value="কেবল বসত বাড়ী বা অন্যর বাড়ী রয়েছে">কেবল বসত বাড়ী বা অন্যর বাড়ী রয়েছে </option><option value="নিজের বা পরিবারের কোন কৃষি বা মৎস জমি নাই">নিজের বা পরিবারের কোন কৃষি বা মৎস জমি নাই</option></select><span class="bt-flabels__error-desc">আর্থ সামাজিক অবস্থা দিন....</span></div></div>');
                }else{
                    $('#sector').html('');
                    $('#health').html('');
                }
            });

            $("#cropzee-input").cropzee({
                startSize: [100, 100, '%'],
                allowedInputs: ['png','jpg','jpeg'],
                imageExtension: 'image/jpg',
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });

            $('#textarea_editor').wysihtml5({
            "stylesheets": [""], // CSS stylesheets to load
            "color": true, // enable text color selection
            "size": 'small', // buttons size
            "html": true, // enable button to edit HTML
            "format-code" : true // enable syntax highlighting
        });
        });
    </script>
@endsection