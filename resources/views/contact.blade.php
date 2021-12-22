@extends('layouts.master')
@section('head')
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                <h4 style="color: white;">যোগাযোগ</h4>
            </div>
        </div>
    </div>
</section>

    <section>
        <div class="container">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bt-flabels__wrapper">
                                        <label for="name">
                                            নাম</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name" data-parsley-required />
                                        <span class="bt-flabels__error-desc">নাম দিন....</span>
                                    </div>
                                    <div class="form-group bt-flabels__wrapper">
                                        <label for="email">
                                            ই-মেইল</label>
                                        <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                            <input type="email" class="form-control" id="email" placeholder="Enter email" data-parsley-required data-parsley-type="email" data-parsley-trigger="keyup" />
                                            <span class="bt-flabels__error-desc">অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....</span>
                                        </div>
                                    </div>
                                    <div class="form-group bt-flabels__wrapper">
                                        <label for="subject">
                                            বিষয়</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter subject" data-parsley-required />
                                        <span class="bt-flabels__error-desc">অনুগ্রহ করে বিষয় লিখুন....</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bt-flabels__wrapper">
                                        <label for="name">
                                            মেসেজ</label>
                                        <textarea name="message" id="message" class="form-control" rows="9" cols="25" data-parsley-required data-parsley-maxlength="500" data-parsley-trigger="keyup"
                                                  placeholder="Message"></textarea>
                                        <span class="bt-flabels__error-desc">আপনার মেসেজটি গ্রহণযোগ্য নয়। ৫০০ অক্ষরের নিচে লিখুন....</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                        মেসেজ সেন্ট করুন</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>
@endsection
