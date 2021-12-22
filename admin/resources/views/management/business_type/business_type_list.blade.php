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
                <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> বিজনেস টাইপ </h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row justify-content-end mb-3">
                <div class="col-2">
                    <button type="submit" class="btn btn-primary " data-toggle="modal" data-target="#add_busi_type_model"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button>
                </div>
            </div>

            <table id="setting_table" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>বাংলা</th>
                        <th>ইংলিশ</th>
                        <th>ফি</th>
                        <th>অ্যাকশান</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($busi_type as $key => $item)
                        <tr data-id="{{$item->id}}">
                            <td>{{++$key}}</td>
                            <td>{{$item->name_bn}}</td>
                            <td>{{$item->name_en}}</td>
                            <td>{{$item->fees}}</td>
                            <td style="display: none">{{$item->Business_fee_id}}</td>

                            {{-- <input type="hidden" id="business_fee_id" name="business_fee_id" value="{{ $item->Business_fee_id }}"> --}}

                            <td>
                                <button class="btn btn-warning btn-sm busi_edit">Edit</button>
                                <a href="{{route('business_type.delete',$item->id)}}" class="btn btn-danger btn-sm busi_delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- add business type model --}}

<div class="modal fade" id="add_busi_type_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('business_type.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">নতুন বিজনেস টাইপ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">বাংলা নাম</label>
                      <input type="text" name="name_bn" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="">ইংলিশ নাম</label>
                      <input type="text" name="name_en" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">ফি</label>
                        <input type="number" name="fee" class="form-control" placeholder="00.00">
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">জমা</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit business type model --}}

<div class="modal fade" id="edit_busi_type_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('business_type.update')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">নতুন বিজনেস টাইপ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">বাংলা নাম</label>
                      <input type="text" id="name_bn" name="name_bn" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="">ইংলিশ নাম</label>
                      <input type="text" id="name_en" name="name_en" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">ফি</label>
                        <input type="number" name="fee" class="form-control" placeholder="00.00">
                      </div>

                    <input type="hidden" name="business_fee_id" id="business_fee_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">জমা</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('script')
    <!-- add sweet alert js & css in footer -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.busi_edit').on('click', function () {
                // alert($(this).data('id'));

                let tr = $(this).closest('tr');

                $('#edit_busi_type_model').find('input[name="id"]').val(tr.data('id'));
                $('#edit_busi_type_model').find('input[name="name_bn"]').val($(tr.find('td')[1]).text());
                $('#edit_busi_type_model').find('input[name="name_en"]').val($(tr.find('td')[2]).text());
                $('#edit_busi_type_model').find('input[name="fee"]').val($(tr.find('td')[3]).text());
                $('#edit_busi_type_model').find('input[name="business_fee_id"]').val($(tr.find('td')[4]).text());

                $('#edit_busi_type_model').modal('show');
            });
        });
    </script>
@endsection
