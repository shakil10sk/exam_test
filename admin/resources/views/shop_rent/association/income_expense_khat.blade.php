@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> খাত সমূহের তালিকা</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">সমিতি ব্যবস্থাপনা</li>
                        <li class="breadcrumb-item active" aria-current="page">আয় ও ব্যয়</li>
                        <li class="breadcrumb-item active" aria-current="page"> খাত</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->
    @can('add-accounts')
        <div class="row text-right">
            <div class="col-md-12" style="margin-bottom: 10px">
                <button type="submit" class="btn btn-primary" onclick="add_khat()"><i class="fa fa-plus"></i> নতুন যোগ
                    করুন
                </button>
            </div>
        </div>
    @endcan

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">
                <table class="stripe hover multiple-select-row data-table-export nowrap" id='khat_table'>

                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>খাতের নাম</th>
                        <th>টাইপ</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <!-- Export Datatable End -->

    <div class="modal fade" id="khat_save_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title" id="myLargeModalLabel">খাত যোগ করুন</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="javascript:void(0)" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <label class="col-md-4 text-right">খাতের নাম</label>

                            <input class="form-control col-md-6" type="text" name="name" id="name"/>

                            <span class="text-danger col-md-12" style="text-align: center;" id="name_error"></span>

                        </div>
                        <br>

                        <div class="row">
                            <label class="col-md-4 text-right">টাইপ</label>
                            <select name="type" id="type" class="form-control col-md-6">
                                <option value="">সিলেক্ট করুন</option>
                                <option value="106">আয়</option>
                                <option value="107">ব্যয়</option>
                            </select>
                            <span class="text-danger col-md-12" style="text-align: center;"
                                  id="type_error"></span>

                        </div>
                        <br>
                        <input type="hidden" name="row_id" id="row_id"/>
                    </div>
                    <div class="modal-footer">


                        <button type="button" id="save_button" class="btn btn-primary" onclick="khat_save()">সাবমিট
                        </button>

                        <button type="submit" id="update_button" class="btn btn-warning" onclick="account_update()">
                            আপডেট
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @can('edit-accounts')
                <input type="hidden" id="edit-accounts" value="edit">
            @endcan

            @can('delete-accounts')
                <input type="hidden" id="delete-accounts" value="delete">
            @endcan
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/association.js') }}"></script>
    <script>

        khat_list();

        $('document').ready(function () {


        });

    </script>



@endsection


