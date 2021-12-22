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
                    <h4><i class="icon-copy fi-torsos"></i> কর্মকর্তার তথ্য আপডেট করুন</h4>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
    <section>
        <form action="{{ route('update_info') }}" method="post" enctype="multipart/form-data"
              class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
            @csrf
            <input type="hidden" value="{{ $employee->id }}" name="id">
            <input type="hidden" value="{{ $employee->employee_id }}" name="employee_id">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group bt-flabels__wrapper @error('name') has-danger @enderror">
                                <label class="form-control-label">পূর্ণ নাম <span>*</span></label>
                                <input type="text" name="name" value="{{ old('name')? old('name') : $employee->name }}"
                                       placeholder="পূর্ণ নাম প্রদান করূন"
                                       class="form-control form-control-lg @error('name') form-control-danger @enderror"
                                       autocomplete="name" autofocus data-parsley-trigger="keyup" data-parsley-required>

                                <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>
                                @error('name')
                                <div class="form-control-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group bt-flabels__wrapper @error('designation_id') has-danger @enderror">
                                <label class="form-control-label">পদবী <span>*</span></label>
                                <select id="designation"
                                        class="form-control @error('designation_id') form-control-danger @enderror"
                                        name="designation_id" data-style="btn-outline-primary" data-parsley-required>
                                    <option value="" {{ ($employee->designation_id == '')? "selected='selected'" : ''}}>
                                        পদবী সিলেক্ট করুন
                                    </option>
                                    @foreach($designation_list as $item)
                                    <option value="{{ $item->id }}" {{ ($employee->designation_id == $item->id)?
                                    "selected='selected'" :
                                    ''}}> {{ $item->name }}
                                    </option>
                                    @endforeach

                                </select>

                                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                                @error('designation_id')
                                <div class="form-control-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group bt-flabels__wrapper @error('device_id') has-danger @enderror">
                                <label class="form-control-label">ডিভাইচ আই. ডি. নং <span>*</span></label>
                                <input type="text" name="device_id"
                                       value="{{ old('device_id')? old('device_id') : $employee->device_id }}"
                                       placeholder="1010101010"
                                       class="form-control form-control-lg @error('device_id') form-control-danger @enderror"
                                       autocomplete="device_id" autofocus data-parsley-type="number"
                                       data-parsley-trigger="keyup">

                                <span class="bt-flabels__error-desc">অনুগ্রহ করে আই. ডি. নং দিন....</span>
                                @error('device_id')
                                <div class="form-control-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 pt-5">
                            <div class="row form-group bt-flabels__wrapper @error('gender') has-danger @enderror">
                                <label class="col-6 form-control-label text-center">লিঙ্গ <span>*</span></label>

                                <div class="col-6">
                                    <label class="radio-inline"><input type="radio"
                                                                       {{ ($employee->gender == 1)? 'checked' : '' }} name="gender"
                                                                       value="1" checked/>পুরুষ</label>
                                    <label class="radio-inline"><input type="radio"
                                                                       {{ ($employee->gender == 2)? 'checked' : '' }} name="gender"
                                                                       value="2"/>মহিলা</label>

                                    @error('gender')
                                    <div class="form-control-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <label for="cropzee-input">
                        <div class="image-overlay">
                            @if($employee->photo != null)
                                <img src="{{ asset('images/employee/'.$employee->photo) }}" alt=""
                                     class="image-previewer image" data-cropzee="cropzee-input">
                            @else
                                @if($employee->gender == 1)
                                    <img src="{{ asset('images/default/default_male.jpg') }}" alt=""
                                         class="image-previewer image" data-cropzee="cropzee-input">
                                @else
                                    <img src="{{ asset('images/default/default_female.jpg') }}" alt=""
                                         class="image-previewer image" data-cropzee="cropzee-input">
                                @endif
                            @endif
                            <button for="cropzee-input" class="btn btn-primary form-control"><i
                                    class="ion-ios-upload-outline"></i> Upload
                            </button>
                            <div class="overlay">
                                <div class="text">ক্লিক করুন</div>
                            </div>
                        </div>
                    </label>
                    <input id="cropzee-input" style="display: none;" name="photo" type="file" accept="image/*">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group bt-flabels__wrapper @error('date_of_birth') has-danger @enderror">
                        <label class="form-control-label">জম্ম তারিখ </label>
                        <input type="text" name="date_of_birth"
                               value="{{ old('date_of_birth')? old('date_of_birth') : $employee->date_of_birth }}"
                               placeholder="2020-02-18"
                               class="form-control date @error('date_of_birth') form-control-danger @enderror"
                               autocomplete="date_of_birth" autofocus data-parsley-type="date"
                               data-parsley-trigger="keyup">

                        <span class="bt-flabels__error-desc">জম্ম তারিখ দিন....</span>
                        @error('date_of_birth')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group bt-flabels__wrapper @error('qualification') has-danger @enderror">
                        <label class="form-control-label">শিক্ষাগত যোগ্যতা</label>
                        <input type="text" name="qualification"
                               value="{{ old('qualification')? old('qualification') : $employee->qualification }}"
                               placeholder="শিক্ষাগত যোগ্যতা প্রদান করুন"
                               class="form-control @error('qualification') form-control-danger @enderror"
                               autocomplete="email" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup">

                        <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>
                        @error('qualification')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group bt-flabels__wrapper @error('join_date') has-danger @enderror">
                        <label class="form-control-label">চাকুরীতে যোগদানের তারিখ <span>*</span></label>
                        <input type="text" name="join_date"
                               value="{{ old('join_date')? old('join_date') : $employee->join_date }}"
                               placeholder="2017-02-18"
                               class="form-control date @error('join_date') form-control-danger @enderror"
                               autocomplete="join_date" autofocus data-parsley-type="date" data-parsley-trigger="keyup">

                        <span class="bt-flabels__error-desc">চাকুরীতে যোগদানের তারিখ দিন....</span>
                        @error('join_date')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group bt-flabels__wrapper @error('marital_status') has-danger @enderror">
                        <label class="form-control-label">বৈবাহিক সম্পর্ক</label>
                        <select class="form-control @error('marital_status') form-control-danger @enderror"
                                name="marital_status" selected="selected" data-style="btn-outline-primary"
                                data-parsley-required>
                            <option value="" {{ ($employee->marital_status == '') ? 'selected="selected"' : '' }}>
                                চিহ্নিত করুন
                            </option>
                            <option value="1" {{ ($employee->marital_status == 1) ? 'selected="selected"' : '' }}>
                                অবিবাহিত
                            </option>
                            <option value="2" {{ ($employee->marital_status == 2) ? 'selected="selected"' : '' }}>
                                বিবাহিত
                            </option>
                        </select>

                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>

                        @error('marital_status')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group bt-flabels__wrapper @error('election_area') has-danger @enderror">
                        <label class="form-control-label">নির্বাচনী এলাকার নাম</label>
                        <input type="text" name="election_area"
                               value="{{ old('election_area')? old('election_area') : $employee->election_area }}"
                               placeholder="নির্বাচনী এলাকার নাম  প্রদান করূন"
                               class="form-control @error('election_area') form-control-danger @enderror"
                               autocomplete="election_area" autofocus data-parsley-maxlength="100"
                               data-parsley-trigger="keyup">

                        <span class="bt-flabels__error-desc">নির্বাচনী এলাকার নাম দিন ইংরেজিতে/বাংলায়....</span>
                        @error('election_area')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group bt-flabels__wrapper @error('mobile') has-danger @enderror">
                        <label class="form-control-label">মোবাইল <span>*</span></label>
                        <input type="text" name="mobile" value="{{ old('mobile')? old('mobile') : $employee->mobile }}"
                               maxlength="11" placeholder="মোবাইল নম্বর  প্রদান করূন"
                               class="form-control @error('mobile') form-control-danger @enderror" autocomplete="mobile"
                               autofocus data-parsley-maxlength="11" data-parsley-type="number"
                               data-parsley-trigger="keyup" maxlength="11" data-parsley-required>

                        <span class="bt-flabels__error-desc">১১ ডিজিটের মোবাইল নম্বর দিন....</span>
                        @error('mobile')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>

            @impersonate
            @if( (int) $employee->designation_id <3)
                <div class="row mt-3">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group bt-flabels__wrapper @error('username') has-danger @enderror">
                            <label class="form-control-label">ইউজার নাম <span>*</span></label>
                            <input type="text" name="username" value="{{ $employee->username }}" placeholder="নির্বাচনী এলাকার নাম
                        প্রদান করূন" class="form-control @error('username') form-control-danger @enderror"
                                   autocomplete="username" autofocus data-parsley-maxlength="100"
                                   data-parsley-trigger="keyup" disabled>

                            <span class="bt-flabels__error-desc">ইউজার নাম দিন</span>
                            @error('username')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group bt-flabels__wrapper @error('password') has-danger @enderror">
                            <label class="form-control-label">পাসওয়ার্ড </label>
                            <input type="password" name="password" value="{{ old('password')? old('password') : '' }}"
                                   placeholder="**********"
                                   class="form-control @error('password') form-control-danger @enderror"
                                   autocomplete="password" autofocus data-parsley-maxlength="11"
                                   data-parsley-type="number" data-parsley-trigger="keyup" minlength="8">

                            <span class="bt-flabels__error-desc">৮ ডিজিটের পাসওয়ার্ড দিন....</span>
                            @error('password')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>
            @endif
            @endimpersonate

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div
                                        class="form-group bt-flabels__wrapper @error('district_id') has-danger @enderror">
                                        <label for="district_id" class="form-control-label">জেলা <span>*</span></label>
                                        <select
                                            onchange="getLocation($(this).val(), null, 'upazila_append', 'upazila_id', null, 3 )"
                                            name="district_id" id="district_id"
                                            class="custom-select2 form-control @error('district_id')form-control-danger @enderror"
                                            style="width: 100%; height: 38px;" data-parsley-required>
                                            <option value="" class="district_append">চিহ্নিত করুন</option>
                                            <option value="{{ $employee->district_id }}"
                                                    selected="selected">{{ $employee->district }}</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                                        @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div
                                        class="form-group bt-flabels__wrapper @error('upazila_id') has-danger @enderror">
                                        <label for="upazila_id" class="form-control-label">উপজেলা/থানা
                                            <span>*</span></label>
                                        <select
                                            onchange="getLocation($(this).val(), null, 'postal_append', 'postal_id', null, 6)"
                                            name="upazila_id" id="upazila_id"
                                            class="custom-select2 form-control @error('upazila_id')form-control-danger @enderror"
                                            data-parsley-required>
                                            <option value="" id="upazila_append">চিহ্নিত করুন</option>
                                            <option value="{{ $employee->upazila_id }}"
                                                    selected="selected">{{ $employee->upazila }}</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>

                                        @error('upazila_id')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div
                                        class="form-group bt-flabels__wrapper @error('postal_id') has-danger @enderror">
                                        <label for="postal_id" class="form-control-label">পোস্ট অফিস
                                            <span>*</span></label>
                                        <select name="postal_id" id="postal_id"
                                                class="custom-select2 form-control @error('postal_id')form-control-danger @enderror"
                                                data-parsley-required>
                                            <option value="" id="postal_append">চিহ্নিত করুন</option>
                                            <option value="{{ $employee->postal_id }}"
                                                    selected="selected">{{ $employee->post_office }}</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">পোস্ট অফিস নির্বাচন করুন....</span>

                                        @error('postal_id')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group bt-flabels__wrapper @error('address') has-danger @enderror">
                                <label class="form-control-label">ঠিকানা <span>*</span></label>
                                <textarea name="address"
                                          class="form-control @error('address') form-control-danger @enderror"
                                          autocomplete="address" autofocus data-parsley-maxlength="500"
                                          data-parsley-trigger="keyup">{{ old('address')? old('address') : $employee->address }}</textarea>

                                <span class="bt-flabels__error-desc">আপনার ঠিকানা দিন....</span>
                                @error('address')
                                <div class="form-control-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group bt-flabels__wrapper @error('messages') has-danger @enderror">
                        <label class="form-control-label">মেসেজেস <span>*</span></label>
                        <textarea name="messages" class="form-control @error('messages') form-control-danger @enderror"
                                  autocomplete="messages" autofocus data-parsley-maxlength="500"
                                  data-parsley-trigger="keyup">{{ old('messages')? old('messages') : $employee->messages }}</textarea>

                        <span class="bt-flabels__error-desc">মেসেজেস ৫০০ অক্ষরের নিচে লিখুন বাংলায়....</span>
                        @error('messages')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mb-5 buttons-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('all_members') }}" class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $("#cropzee-input").cropzee({
                startSize: [100, 100, '%'],
                allowedInputs: ['png', 'jpg', 'jpeg'],
                imageExtension: 'image/jpg',
                maxSize: [100, 100, '%'],
                aspectRatio: 1.1,
            });
        });
    </script>
@endsection
