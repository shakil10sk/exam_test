@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> মেয়াদ উত্তীর্ন মালিকানা
                    </h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">বাজার ব্যবস্থাপনা</li>
                        <li class="breadcrumb-item active" aria-current="page">মেয়াদ উত্তীর্ন মালিকানার তালিকা</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->




    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                <table id="expire_owner_list" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>মার্কেটের নাম</th>
                        <th>দোকানের নাম</th>
                        <th>মালিকের নাম</th>
                        <th>পিতার নাম</th>
                        <th>মোবাইল নং</th>
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
    <div class="modal fade" id="ownership_renew_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">নবায়ন করুন</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="row form-group">

                                    <label for="rent_amount" class="col-sm-3 control-label">মালিকের নাম
                                    </label>

                                    <div class="col-sm-5 bt-flabels__wrapper">
                                        <input type="text" name="owner_name" class="form-control" id="owner_name"
                                               value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group">

                                    <label for="previous_rent_amount" class="col-sm-3 control-label">পূর্ববর্তী ভাড়া
                                        <span>*</span></label>

                                    <div class="col-sm-5">
                                        <input type="text" name="previous_rent" class="form-control" id="previous_rent"
                                               placeholder="0.00" readonly
                                        >
                                        <span class="rent_error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="previous_selami" class="col-sm-3 control-label">পূর্ববর্তী সালামী<span> *</span>
                                    </label>

                                    <div class="col-sm-5">
                                        <input type="text" name="previous_selami" class="form-control" id="previous_selami"
                                               placeholder="0.00" readonly >
                                        <span class="selami_error text-danger"></span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group">

                                    <label for="rent_amount" class="col-sm-3 control-label">নবায়ন ভাড়া
                                        <span>*</span></label>

                                    <div class="col-sm-5">
                                        <input type="text" name="rent" class="form-control" id="rent"
                                               placeholder="0.00"
                                        >
                                        <span class="rent_error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="selami" class="col-sm-3 control-label">নবায়ন সালামী<span> *</span>
                                    </label>

                                    <div class="col-sm-5">
                                        <input type="text" name="selami" class="form-control" id="selami"
                                               placeholder="0.00" >
                                        <span class="selami_error text-danger"></span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <label for="starting_date" class="col-sm-3 control-label">পুনরায় শুরুর তারিখ <span>
                                            *</span>
                                    </label>

                                    <div class="col-sm-5">
                                        <input type="text" name="starting_date" class="form-control" id="starting_date"
                                               placeholder="{{ date('Y-m-d')  }}" value="{{ date('Y-m-d')  }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="owner_id" id="owner_id" value="">
                        <button type="button" onclick="shop_ownership_renew_save()"  class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    {{-- end --}}




@endsection

@section('script')

    <script src="{{ asset('js/bazar_management.js') }}"></script>

    <script>

        $('document').ready(function () {

            expire_owner_list();

            //for date picker
            $('#starting_date').datepicker({
                language: 'en',
                autoClose: true,
                dateFormat: 'yy-mm-dd',
            });

        });


    </script>

@endsection


