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
                    <h4>সমিতির সদস্য তালিকা</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

                <div class="row justify-content-end mb-3">
                    <div class="col-2">
                        <a href="{{ route('association_member_add')  }}" class="btn btn-primary " ><i class="fa
                        fa-plus-circle" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                </div>

                <table id="association_list_table" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>নাম</th>
                        <th>পিতার নাম</th>
                        <th>মোবাইল নং</th>
                        <th>রেফারেন্স</th>
                        <th>অ্যাকশান</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ asset('js/association.js') }}"></script>

    <script>
        $(document).ready(function () {
            member_list();
            //
            // //for date picker
            // $('#starting_date').datepicker({
            //     language: 'en',
            //     autoClose: true,
            //     dateFormat: 'yy-mm-dd',
            // });
        });
    </script>
@endsection



