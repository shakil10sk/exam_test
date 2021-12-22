@extends('layouts.app')
@section('head')
    <!-- cropzee.js -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>

@endsection
@section('content')

    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>দোকানের মালিকানা পরিবর্তন</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                <form id="owner_form" onsubmit="shop_ownership_change()" action="{{route('shop.owner.change.confirm')}}"
                      method="post" class="uk-form
                bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">মার্কেটের নাম
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <select name="market_id" id="market_id" selected="selected"
                                                class="form-control" onchange="getShopByMarketId(this.value)"
                                                data-parsley-required >
                                            <option value="" >নির্বাচন করুন</option>
                                            @foreach($market_list as $item)
                                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                            @endforeach
                                        </select>

                                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>
                                    </div>

                                    <label for="shop_id" class="col-sm-3 control-label">দোকানের নং
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <select name="shop_id" id="shop_id" onchange="getSelamiRent(this.value)" selected="selected"
                                                class="form-control " data-parsley-required >
                                            <option value="" >নির্বাচন করুন</option>
                                        </select>
                                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="name" class="col-sm-3 control-label">মালিকের নাম
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="name" class="form-control" id="name"
                                                data-parsley-trigger="keyup"  placeholder="মালিকের নাম
                                        প্রদান করুন"
                                               data-parsley-required >

                                        <span class="bt-flabels__error-desc">মালিকের নাম প্রদান করুন....</span>
                                        <span class="name_feedback text-danger"   ></span>
                                    </div>

                                    <label for="father_name" class="col-sm-3 control-label">পিতার নাম
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="father_name"  class="form-control" id="father_name"
                                               placeholder="পিতার নাম প্রদান করুন" data-parsley-trigger="keyup"
                                               data-parsley-required >
                                        <span class="bt-flabels__error-desc">পিতার নাম প্রদান করুন....</span>
                                        <span class="father_name_feedback text-danger"   ></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="mother_name" class="col-sm-3 control-label">মাতার নাম
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="mother_name" class="form-control" id="mother_name"
                                               placeholder="মাতার নাম প্রদান করুন"  data-parsley-trigger="keyup"
                                               data-parsley-required >

                                        <span class="bt-flabels__error-desc">মাতার নাম প্রদান করুন....</span>
                                        <span class="mother_name_feedback text-danger"   ></span>
                                    </div>

                                    <label for="address" class="col-sm-3 control-label">ঠিকানা
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="address" class="form-control" id="address" placeholder="ঠিকানা প্রদান
                                        করুন"  data-parsley-trigger="keyup"
                                               data-parsley-required >
                                        <span class="bt-flabels__error-desc">ঠিকানা প্রদান করুন....</span>
                                        <span class="address_feedback text-danger"   ></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="nid" class="col-sm-3 control-label">ন্যাশনাল আইডি
                                       </label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="nid" class="form-control" id="nid" placeholder="ন্যাশনাল আইডি প্রদান
                                         করুন" data-parsley-maxlength="17" data-parsley-trigger="keyup"
                                        >

                                        <span class="bt-flabels__error-desc">ন্যাশনাল আইডি প্রদান করুন ১৭ ডিজিটের মধ্যে
                                            </span>
                                        <span class="nid_feedback text-danger"   ></span>
                                    </div>

                                    <label for="mobile_no" class="col-sm-3 control-label">মোবাইল নং
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="mobile_no" class="form-control" id="mobile_no"
                                               placeholder="মোবাইল নং প্রদান
                                        করুন"  data-parsley-type="digits" data-parsley-minlength="11"
                                               data-parsley-maxlength="11"
                                               data-parsley-trigger="keyup" data-parsley-required
                                                >
                                        <span class="bt-flabels__error-desc">সঠিক মোবাইল নং প্রদান করুন....</span>
                                        <span class="mobile_no_feedback text-danger"   ></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-sm-6 bt-flabels__wrapper">

                                    </div>

                                    <label for="selami_amount" class="col-sm-3 control-label">সেলামী<span> *</span>
                                    </label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="selami_amount" class="form-control" id="selami_amount"
                                               placeholder="0.00" data-parsley-maxlength="10"
                                               data-parsley-type="integer"
                                               data-parsley-trigger="keyup"
                                               data-parsley-required  >

                                        <span class="bt-flabels__error-desc">সেলামীর টাকা প্রদান করুন
                                            </span>
                                        <span class="selami_amount_feedback text-danger"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-sm-6 bt-flabels__wrapper">

                                    </div>

                                    <label for="rent_amount" class="col-sm-3 control-label">ভাড়া
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="rent_amount" class="form-control" id="rent_amount"
                                               placeholder="0.00"  data-parsley-maxlength="10" data-parsley-type="integer"
                                               data-parsley-trigger="keyup"
                                               data-parsley-required
                                        >
                                        <span class="bt-flabels__error-desc">ভাড়ার টাকা প্রদান করুন....</span>
                                        <span class="rent_amount_feedback text-danger"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-sm-6 bt-flabels__wrapper">

                                    </div>

                                    <label for="fee_amount" class="col-sm-3 control-label">ফি
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="fee_amount" class="form-control" id="fee_amount"
                                               placeholder="0.00"  data-parsley-maxlength="10" data-parsley-type="integer"
                                               data-parsley-trigger="keyup"
                                               data-parsley-required
                                        >
                                        <span class="bt-flabels__error-desc">ফি টাকা প্রদান করুন....</span>
                                        <span class="fee_amount_feedback text-danger"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-sm-6 bt-flabels__wrapper">

                                    </div>

                                    <label for="total_amount" class="col-sm-3 control-label">মোট</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="total_amount" class="form-control" id="total_amount" readonly
                                               placeholder="0.00"  data-parsley-maxlength="10" data-parsley-type="integer"
                                               data-parsley-trigger="keyup"
                                               data-parsley-required
                                        >

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="row_id" id="row_id" value=""  >
                        <button type="submit" class="btn btn-primary">Save</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>
    <script src="{{ asset('js/bazar_management.js') }}"></script>
@endsection



