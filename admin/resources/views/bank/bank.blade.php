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
                <h4> ব্যাংক একাউন্ট এর তালিকা </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row justify-content-end mb-3">
                <div class="col-2">
                    <button type="submit" class="btn btn-primary " data-toggle="modal" data-target="#bank_add_modal"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button>
                </div>
            </div>

            <table id="bank_list_tbl" class="table table-bordered">
                <thead>
                    <tr>
                        <th>নং</th>
                        <th>সনদ এর নাম</th>
                        <th>ব্যাংক নাম</th>
                        <th>একাউন্ট নং</th>
                        <th>ব্যাংক শাখা নাম</th>
                        <th>ব্যাংক শাখার ঠিকানা</th>
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- model --}}
<div class="modal fade" id="bank_add_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('bank_store')}}"  method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">ব্যাংক যোগ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                      <label for="">সনদ নির্বাচন করুন  <span style="color:#ff0000;">*</span></label>
                      <select class="form-control" name="sonod_type" id="" required >
                          <option value="" >সনদ নির্বাচন করুন</option>
                          <option value="1" >নাগরিক</option>
                          <option value="2" >মৃত্যু</option>
                          <option value="3" >অবিবাহিত</option>
                          <option value="4" >পুনঃবিবাহ</option>
                          <option value="5" >একইনামি</option>
                          <option value="6" >সনাতন</option>
                          <option value="7" >প্রত্যয়ন</option>
                          <option value="8" >নদিভাঙ্গন</option>
                          <option value="9" >চারিত্রিক</option>
                          <option value="10" >ভূমিহীন</option>
                          <option value="11" >বার্ষিক আয়</option>
                          <option value="12" >প্রতিবন্ধী</option>
                          <option value="13" >অনুমুতি</option>
                          <option value="14" >ভোটার আইডি স্থানত্তর</option>
                          <option value="15" >অনাপত্তি</option>
                          <option value="17" >ওয়ারিশ</option>
                          <option value="18" >পারিবারিক</option>
                          <option value="19" >ট্রেড</option>
                          <option value="20" >বিবাহিত</option>
                          <option value="90" >প্রিমিসেস</option>

                      </select>
                      {{-- <input type="text"  name="sonod_name" class="form-control" placeholder="ব্যাংক নাম" required> --}}
                    </div>

                </div>

                <div class="modal-body">
                    <div class="form-group">
                      <label for="">ব্যাংক এর নাম <span style="color:#ff0000;">*</span></label>
                      <input type="text"  name="bank_name" class="form-control" placeholder="ব্যাংক নাম" required>
                    </div>

                </div>


                <div class="modal-body">
                    <div class="form-group">
                      <label for="">একাউন্ট নং <span style="color:#ff0000;">*</span></label>
                      <input type="text"  name="account_num" class="form-control" placeholder="একাউন্ট নং" required>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">ব্যাংক শাখা নাম <span style="color:#ff0000;">*</span></label>
                      <input type="text"  name="bank_branch" class="form-control" placeholder="ব্যাংক শাখা নাম" required>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">ব্যাংক শাখার ঠিকানা</label>
                      <textarea style="height: 125px;" name="bank_branch_address" class="form-control" placeholder="ব্যাংক শাখার ঠিকানা" >
                      </textarea>
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
<div class="modal fade" id="bank_update_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('bank_update')}}" method="post"  >
                @csrf
                <input type="hidden" name="id" id="pid" value="">

                <div class="modal-header">
                    <h5 class="modal-title"> তথ্য আপডেট</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                      <label for="">সনদ নির্বাচন করুন <span style="color:#ff0000;">*</span></label>
                      <select class="form-control" id="sonod_type" name="sonod_type" id="" required >
                          <option value="" >সনদ নির্বাচন করুন</option>
                          <option value="1" >নাগরিক</option>
                          <option value="2" >মৃত্যু</option>
                          <option value="3" >অবিবাহিত</option>
                          <option value="4" >পুনঃবিবাহ</option>
                          <option value="5" >একইনামি</option>
                          <option value="6" >সনাতন</option>
                          <option value="7" >প্রত্যয়ন</option>
                          <option value="8" >নদিভাঙ্গন</option>
                          <option value="9" >চারিত্রিক</option>
                          <option value="10" >ভূমিহীন</option>
                          <option value="11" >বার্ষিক আয়</option>
                          <option value="12" >প্রতিবন্ধী</option>
                          <option value="13" >অনুমুতি</option>
                          <option value="14" >ভোটার আইডি স্থানত্তর</option>
                          <option value="15" >অনাপত্তি</option>
                          <option value="17" >ওয়ারিশ</option>
                          <option value="18" >পারিবারিক</option>
                          <option value="19" >ট্রেড</option>
                          <option value="20" >বিবাহিত</option>
                          <option value="90" >প্রিমিসেস</option>

                      </select>
                      {{-- <input type="text"  name="sonod_name" class="form-control" placeholder="ব্যাংক নাম" required> --}}
                    </div>

                </div>

                <div class="modal-body">
                    <div class="form-group">
                      <label for="">ব্যাংক এর নাম <span style="color:#ff0000;">*</span></label>
                      <input type="text"  name="bank_name" id="bank_name" class="form-control" placeholder="ব্যাংক নাম" required>
                    </div>

                </div>


                <div class="modal-body">
                    <div class="form-group">
                      <label for="">একাউন্ট নং <span style="color:#ff0000;">*</span></label>
                      <input type="text"  name="account_num" id="account_num" class="form-control" placeholder="একাউন্ট নং" required>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">ব্যাংক শাখা নাম <span style="color:#ff0000;">*</span></label>
                      <input type="text"  name="bank_branch" id="bank_branch" class="form-control" placeholder="ব্যাংক শাখা নাম" required>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">ব্যাংক শাখার ঠিকানা</label>
                      <textarea style="height: 125px;" id="bank_branch_address" name="bank_branch_address" class="form-control" placeholder="ব্যাংক শাখার ঠিকানা" >
                      </textarea>
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
    <script src="{{ asset('js/bank.js') }}"></script>

    <script>
        $(document).ready(function(){
            bankList()
        });
    </script>
@endsection

