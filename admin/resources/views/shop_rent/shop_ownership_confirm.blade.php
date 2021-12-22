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
                <div class="modal-body">
                    <form action="{{route('shop.owner.change.store')}}" method="post">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">মার্কেটের নামঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$market_info->name}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">দোকান নংঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$shop_info->name}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">পূর্বের মালিকঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{!empty($owner_info) ? $owner_info->name : ''}} <br/>

                                        {{!empty($owner_info) ? $owner_info->mobile_no : ''}} <br/>

                                        {{!empty($owner_info) ? $owner_info->address : ''}} <br/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">নতুন মালিকঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$data['name']}} <br/>
                                        {{$data['mobile_no']}} <br/>
                                        {{$data['address']}} <br/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">সেলামীঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$data['selami_amount']}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">ভাড়াঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$data['rent_amount']}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">ফিঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$data['fee_amount']}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="market_id" class="col-sm-3 control-label">মোটঃ</label>

                                    <div class="col-sm-3 bt-flabels__wrapper">
                                        {{$data['selami_amount'] + $data['fee_amount']}}
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="market_id" value="{{$data['market_id']}}" />
                            <input type="hidden" name="shop_id" value="{{$data['shop_id']}}" />
                            <input type="hidden" name="name" value="{{$data['name']}}" />
                            <input type="hidden" name="father_name" value="{{$data['father_name']}}" />
                            <input type="hidden" name="mother_name" value="{{$data['mother_name']}}" />
                            <input type="hidden" name="address" value="{{$data['address']}}" />
                            <input type="hidden" name="nid" value="{{$data['nid']}}" />
                            <input type="hidden" name="mobile_no" value="{{$data['mobile_no']}}" />
                            <input type="hidden" name="selami_amount" value="{{$data['selami_amount']}}" />
                            <input type="hidden" name="rent_amount" value="{{$data['rent_amount']}}" />
                            <input type="hidden" name="fee_amount" value="{{$data['fee_amount']}}" />

                            @csrf

                            <div class="col-md-12">
                                <div class="row form-group">
                                    <button class="btn btn-sm btn-success" type="submit">Confirm</button>
                                    &nbsp;&nbsp;
                                    <a href="{{route('shop.owner.change')}}">
                                        <button class="btn btn-sm btn-danger" type="button">Cancel</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection