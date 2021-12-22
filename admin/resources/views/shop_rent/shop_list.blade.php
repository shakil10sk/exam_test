@extends('layouts.app')
@section('head')

    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
@endsection


@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>পৌরসভা মার্কেটের দোকানের তালিকা</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row justify-content-end mb-3">
                <div class="col-2">
                    <button type="submit" class="btn btn-primary " data-toggle="modal" data-target="#operation_modal"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button>
                </div>
            </div>

            <table id="shop_list_tbl" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>মার্কেটের নাম</th>
                        <th>দোকানের নং</th>
                        <th>সেলামী টাকা</th>
                        <th>দোকান ভাড়া</th>
                        <th>অ্যাকশান</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- model --}}
<div class="modal fade" id="operation_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('shop.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">নতুন দোকান যোগ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="">মার্কেটের নাম</label>
                        <select class="form-control" name="market_id" id="market_id" required>
                            <option value=''>Select</option>

                            @foreach($market_data as $item)
                                <option value='{{$item->id}}'>{{$item->name}}</option>
                            @endforeach

                        </select>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4 float-left">
                                <label>দোকান নং</label>
                                <input type="text" name="shop_no[]" class="form-control" id="shop_no">
                            </div>

                            <div class="col-md-4 float-left">
                                <label>সেলামী</label>
                                <input type="text" name="selami[]" class="form-control" id="selami">
                            </div>

                            <div class="col-md-3 float-left">
                                <label>ভাড়া</label>
                                <input type="text" name="rent[]" class="form-control" id="rent">
                            </div>

                            <div class="col-md-1 float-left">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-sm btn-primary" onclick="addNewShop()">+</button>
                            </div>
                        </div>

                        <div id="output">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
{{-- end --}}

{{-- edit model --}}
<div class="modal fade" id="operation_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('shop.update')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">দোকানের তথ্য আপডেট</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="">মার্কেটের নাম</label>
                        <select class="form-control" name="market_id" id="edit_market_id" required>
                            <option value=''>Select</option>

                            @foreach($market_data as $item)
                                <option value='{{$item->id}}'>{{$item->name}}</option>
                            @endforeach

                        </select>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4 float-left">
                                <label>দোকান নং</label>
                                <input type="text" name="shop_no" class="form-control" id="edit_shop_no">
                            </div>

                            <div class="col-md-4 float-left">
                                <label>সেলামী</label>
                                <input type="text" name="selami" class="form-control" id="edit_selami">
                            </div>

                            <div class="col-md-4 float-left">
                                <label>ভাড়া</label>
                                <input type="text" name="rent" class="form-control" id="edit_rent">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="pid" class="form-control" id="pid">

                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end --}}

@endsection


@section('script')
    <!-- add sweet alert js & css in footer -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>
    <script src="{{ asset('js/bazar_management.js') }}"></script>

    <script>
        $(document).ready(function(){
            shop_list()
        });
    </script>
@endsection
