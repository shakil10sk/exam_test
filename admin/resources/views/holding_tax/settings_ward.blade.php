@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4> ওয়ার্ড সেটিংস </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

                <div class="row justify-content-end mb-3">
                    <div class="col-2">
                        <button type="button" onclick="addNewWard()" class="btn btn-primary">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                        </button>
                    </div>
                </div>

                <table id="data_tbl" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ওয়ার্ড নং</th>
                            <th>নাম</th>
                            <th>অ্যাকশান</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

{{--  model --}}
<div class="modal fade" id="data_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="javascript:void(0);">
                
                <div class="modal-header">
                    <h5 class="modal-title">নতুন ওয়ার্ড</h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                      <label for="ward_no">ওয়ার্ড নং</label>
                      <input type="text" name="ward_no" id="ward_no" class="form-control" />

                      <span class="error" id="ward_no_error"></span>
                    </div>

                    <div class="form-group">
                      <label for="ward_name">নাম</label>
                      <input type="text" name="ward_name" id="ward_name" class="form-control" />

                      <span class="error" id="ward_name_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="pid" id="pid" />

                    <button type="button" onclick="saveWard()" class="btn btn-primary" id="action_btn">Save</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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

    <script src="{{ asset('js/holding_tax.js') }}"></script>

    <script>
        $(document).ready(function(){
            ward_list();
        });
    </script>
@endsection