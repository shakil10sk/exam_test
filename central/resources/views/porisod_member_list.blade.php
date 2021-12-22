@extends('layout.main',['title'=> 'Member List'])

@section('content')
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Admin</a>
            <span class="breadcrumb-item active">----</span>
        </nav>
    </div>


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h3 class="tx-gray-800 mg-b-5">পরিষদের সদস্যদের তালিকা </h3>
    </div>

    <div class="br-pagebody ">
        <div class="br-section-wrapper m-0 p-0">
            <div class="card ">
                <div class="card-header">
                    <div class="row text-dark">
                        <div class="form-group col-3">
                            <label for="">উপজেলা</label>
                            <select class="form-control" name="upazila">
                                <option></option>
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="">ইউনিয়ন</label>
                            <select class="form-control" name="upazila">
                                <option></option>
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="">পদবী</label>
                            <select class="form-control" name="upazila">
                                <option></option>
                                <option></option>
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <button class="btn btn-info mg-t-25">submit</button>
                        </div>

                    </div>
                </div>
                <div class="card-body text-dark">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>নং</th>
                                <th>আইডি</th>
                                <th>ইউনিয়ন</th>
                                <th>নাম</th>
                                <th>পদবী</th>
                                <th>মোবাইল নং</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> আলোকবালী ইউনিয়ন পরিষদ</td>
                                <td> আলোকবালী ইউনিয়ন পরিষদ</td>
                                <td> আলোকবালী ইউনিয়ন পরিষদ</td>
                                <td> আলোকবালী ইউনিয়ন পরিষদ</td>
                                <td> আলোকবালী ইউনিয়ন পরিষদ</td>
                                <td> আলোকবালী ইউনিয়ন পরিষদ</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
