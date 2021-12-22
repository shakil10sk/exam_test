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
                    <h4>দোকান ভাড়ার তালিকা</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

                <div class="row justify-content-end mb-3">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary " onclick="shop_owner()" > <i class="fa
                        fa-plus-circle" aria-hidden="true"></i> Add New</button>
                    </div>
                </div>

                <table id="shopowner_list_tbl" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>মার্কেটের নাম</th>
                        <th>দোকানের নং</th>
                        <th>ভাড়াটিয়ার নাম</th>
                        <th>পিতার নাম</th>
                        <th>মোবাইল নং</th>
                        <th>সেলামী</th>
                        <th>ভাড়া</th>
                        <th>স্ট্যাটাস</th>
                        <th>অ্যাকশান</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="shop_owner_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 170%; position: relative; left: -24%">
                <form id="owner_form" onsubmit="shop_owner_save()" action="javascript:void(0)"
                      method="post" class="uk-form
                bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">মার্কেটের নাম</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

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

                                    <label for="shop_id" class="col-sm-3 control-label">দোকানের নাম
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <select name="shop_id" id="shop_id" selected="selected"
                                                class="form-control" onchange="getShopInfo(this.value)"
                                                data-parsley-required >
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

                                    <label for="address" class="col-sm-3 control-label">মো্বাইল নং
                                        <span>*</span></label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input name="mobile_no" class="form-control" id="mobile_no"
                                               placeholder="মো্বাইল নং প্রদান
                                        করুন"  data-parsley-type="digits" data-parsley-minlength="11"
                                               data-parsley-maxlength="11"
                                               data-parsley-trigger="keyup" data-parsley-required
                                                >
                                        <span class="bt-flabels__error-desc">সঠিক মো্বাইল নং প্রদান করুন....</span>
                                        <span class="mobile_no_feedback text-danger"   ></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="selami_amount" class="col-sm-3 control-label">সালামী<span> *</span>
                                    </label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="selami_amount" class="form-control" id="selami_amount"
                                               placeholder="0.00" data-parsley-maxlength="10"
                                               data-parsley-type="integer"
                                               data-parsley-trigger="keyup"
                                               data-parsley-required  >

                                        <span class="bt-flabels__error-desc">সালামীর টাকা প্রদান করুন
                                            </span>
                                        <span class="selami_amount_feedback text-danger"></span>
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
                                    <label for="selami_amount" class="col-sm-3 control-label">শুরুর তারিখ <span>
                                            *</span>
                                    </label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        <input type="text" name="starting_date" class="form-control" id="starting_date"
                                               placeholder="{{ date('Y-m-d')  }}" value="{{ date('Y-m-d')  }}"
                                               data-parsley-type="date"
                                               data-parsley-trigger="keyup"
                                               data-parsley-required  >

                                        <span class="bt-flabels__error-desc">শুরুর তারিখ প্রদান করুন
                                            </span>
                                        <span class="selami_amount_feedback text-danger"></span>
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

    <script>
        $(document).ready(function() {
            shop_owner_list();

            //for date picker
            $('#starting_date').datepicker({
                language: 'en',
                autoClose: true,
                dateFormat: 'yy-mm-dd',
            });
        });
    </script>
@endsection



