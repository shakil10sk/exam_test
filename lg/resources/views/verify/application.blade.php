@extends('layouts.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;padding:5px;">
              <span style="font-size:20px;">সকল আবেদন ও সনদ যাচাই</span>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        <h4>সনদের আবেদন অথবা সনদ যাচাই করতে সঠিক তথ্য দিন।</h4>
                    </div>

                    <div class="panel-body">

                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">জেলা</label>
                            <div class="col-md-9">
                                <select onchange="form_location($(this).val(), 'app_upazila_id', 3 )" name="app_district_id"
                                    id="app_district_id" class="form-control" data-parsley-required disabled>
                                    <option value="" class="app_district_append">জেলা নির্বাচন করুন-</option>

                                    @foreach ($district as $item)
                                        <option value="{{$item->id}}"  <?php echo ($item->id == $unionProfile->district_id) ? 'selected' : '' ;?> >{{$item->bn_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">উপজেলা</label>
                            <div class="col-md-9">
                                <select onchange="app_union($(this).val(), 'app_union_id' )" name="app_upazila_id"
                                id="app_upazila_id" class="form-control" data-parsley-required>

                                    <option value="" id="app_upazila_append">চিহ্নিত করুন</option>
                                </select>
                                

                                <span id="app_upazila_id_feedback" class="help-block"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">ইউনিয়ন</label>
                            <div class="col-md-9">
                                <select name="union_id" id="union-id" class="form-control" data-parsley-required>
                                    <option value="" id="app_union_append">চিহ্নিত করুন</option>
                                </select>
                                
                                <span id="app_union_id_feedback" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">ধরন</label>
                            <div class="col-md-9">
                                <select class="form-control" id="appType">

                                    <option value="">নির্বাচন করুন</option>
                                    <option value='1'>আবেদন যাচাই</option>
                                    <option value='2'>সনদ যাচাই</option>
                                
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">আবেদন/সনদের ধরন</label>
                            <div class="col-md-9">
                                <select class="form-control" id="app-type">

                                    <option value="">নির্বাচন করুন</option>
                                    <option value='1'>নাগরিক</option>
                                    <option value='2'>মৃত্যু</option>
                                    <option value='3'>অবিবাহিত </option>
                                    <option value='4'>পূনঃবিবাহ না হওয়া</option>
                                    <option value='5'>একই নামের প্রত্যয়ন</option>
                                    <option value='6'>সনাতন ধর্ম অবলম্বি</option>
                                    <option value='7'>প্রত্যয়ন পত্র</option>
                                    <option value='8'>নদী ভাঙনের</option>
                                    <option value='9'>চারিত্রিক</option>
                                    <option value='10'>ভূমিহীন</option>
                                    <option value='11'>বার্ষিক আয়ের প্রত্যয়ন</option>
                                    <option value='12'>প্রতিবন্ধি</option>
                                    <option value='13'>অনুমতি পত্র</option>
                                    <option value='14'>ভোটার আইডি স্থানান্তর</option>
                                    <option value='17'>ওয়ারিশ</option>
                                    <option value='18'>পারিবারিক</option>
                                    <option value='19'>ট্রেড লাইসেন্স</option>
                                    <option value='20'>বিবাহিত</option>
                                
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 form-control-label">সার্চ বক্স</label>
                            <div class="col-md-9">
                                <input type="text" id="search-data" class="form-control" placeholder="এখানে সার্চ দিন...">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>নোট: </strong>আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন অথবা কোনো সনদের আবেদন করে থাকেন, সার্চ বক্সে আপনার ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা পিন নং অথবা ট্র্যাকিং নং অথবা সনদ নং দিয়ে সার্চ করুন।</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{-- <input type="hidden" id="union-id" value="{{ $unionProfile->union_id }}"> --}}
                                <button class="btn btn-success btn-lg btn-block" type="button" id="search" >সার্চ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('js/verify.min.js') }}"></script>
    
    <script>
    function form_location(parent_id, target_id = null, type = null){

        let web_loc = $('meta[name=url]').attr("content");
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'get',
            url: web_loc + '/geo/code/get',
            data: { 'id': parent_id, 'type': type },
            success: function (data) {
                var option = "<option value=''>সিলেক্ট করুন</option>";
    
                data.upzilla.forEach(el => {
                    option += "<option value='" + el.id + "'>" + el.bn_name + "</option>";
                });
    
                $('#app_upazila_id').html(option);
            },
    
            error: function (e) {
                alert('error occur');
                console.log(e);
    
            }
        });
    }
    
    
    function app_union(upazila_id, target_id = null){
    
        let web_loc = $('meta[name=url]').attr("content");
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'get',
            url: web_loc + '/geo/code/get_union',
            data: { 'id': upazila_id },
            success: function (data) {
    
                var option = "<option value=''>সিলেক্ট করুন</option>";
    
                data.union.forEach(item => {
    
                    option += "<option value='" + item.union_code + "'>" + item.bn_name + "</option>";
                });
    
                $('#union-id').html(option);
            },
    
            
        });
    }


    //get upazila_id by distrcit id
$(document).ready(function() {
    let web_loc = $('meta[name=url]').attr("content");

    let district_id = $('meta[name=district_id]').attr("content");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'get',
        url: web_loc + '/geo/code/get',
        data: { 'id': district_id, 'type': 3 },//gor get upazila by district_id
        success: function (data) {
            var option = "<option value=''>সিলেক্ট করুন</option>";
            console.log(data);
            data.upzilla.forEach(el => {
                option += "<option value='" + el.id + "'>" + el.bn_name + "</option>";
            });

            $('#app_upazila_id').html(option);
        },

        error: function (e) {
            alert('error occur');
            console.log(e);

        }
    });

});
</script>
@endsection