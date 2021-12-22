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
                <h4>পদবীর তালিকা</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row justify-content-end mb-3">
                <div class="col-2">
                    <button type="submit" class="btn btn-primary " data-toggle="modal" data-target="#designation_add_modal"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button>
                </div>
            </div>

            <table id="designation_list_tbl" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>নাম</th>
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
<div class="modal fade" id="designation_add_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('designation.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">পদবী যোগ করুন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                      <label for="">নাম</label>
                      <input type="text"  name="name" class="form-control" placeholder="" required>
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

{{-- edit business type model --}}
<div class="modal fade" id="designation_update_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('designation.update')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title"> তথ্য আপডেট</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">নাম</label>
                      <input type="text" id="name" name="name" class="form-control" placeholder="" required>

                      <input type="hidden" id="row_id" name="row_id">
                    </div>
                </div>

                <div class="modal-footer">
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
    <script src="{{ asset('js/admin.js') }}"></script>

    <script>
        $(document).ready(function(){
            designationtList()
        });
    </script>
@endsection
