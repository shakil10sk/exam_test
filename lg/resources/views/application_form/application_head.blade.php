<div class="row">
    <div class="col-md-9">
        <h4 class="text-center"><strong class="text-danger">নিয়মাবলিঃ</strong></h4>
        <hr />
        <ul>
            <li class='text-warning'>বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন ।</li>
            <li class='text-warning'>ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন ।</li>
            <li class='text-warning'>আপনি যদি পূর্বে কোনো সনদ নিয়ে থাকেন, নিচের সার্চ বক্সে আপনার
                ন্যাশনাল আইডি/জন্ম নিবন্ধন/পাসপোর্ট/পিন নং দিয়ে সার্চ করুন!</li>
        </ul>

        <div class="col-md-12">
            <div class="row form-group">

                <label for="app_district_id" class="col-sm-1 control-label">জেলা<span
                        class="text-danger">*</span></label>
                <div class="col-sm-3 bt-flabels__wrapper" id="app_district_id">
                    <select onchange="form_location($(this).val(), 'app_upazila_id', 3 )" name="app_district_id"
                        id="app_district_id" class="form-control" data-parsley-required disabled  >
                        <option value="" class="app_district_append">জেলা নির্বাচন করুন-</option>
                        @foreach ($district as $item)
                        <option value="{{$item->id}}"  <?php echo ($item->id == $unionProfile->district_id) ? 'selected' : ''; ?> >{{$item->bn_name}}</option>
                        @endforeach
                    </select>
                    <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>

                    <span id="app_district_id_feedback" class="help-block"></span>
                </div>



                <label for="app_upazila_id" class="col-sm-1 control-label">উপজেলা<span
                        class="text-danger">*</span></label>
                <div class="col-sm-3 bt-flabels__wrapper" id="app_upazila_id_status">
                    <select onchange="app_union($(this).val(), 'app_union_id' )" name="app_upazila_id"
                        id="app_upazila_id" class="form-control" data-parsley-required>
                        <option value="" id="app_upazila_append">চিহ্নিত করুন</option>
                    </select>
                    <span class="bt-flabels__error-desc">উপজেলা নির্বাচন করুন....</span>

                    <span id="app_upazila_id_feedback" class="help-block"></span>
                </div>

                <label for="app_union_id" class="col-sm-1 control-label">ইউনিয়ন<span
                        class="text-danger">*</span></label>
                <div class="col-sm-3 bt-flabels__wrapper" id="app_union_id_status">
                    <select name="union_id" id="union-id" class="form-control" data-parsley-required>
                        <option value="" id="app_union_append">চিহ্নিত করুন</option>
                    </select>
                    <span class="bt-flabels__error-desc">ইউনিয়ন নির্বাচন করুন....</span>

                    <span id="app_union_id_feedback" class="text-danger"></span>
                </div>

            </div>
        </div>

        <div class="input-group">
            <input type="search" id="search-data" class="form-control"
                placeholder="ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং অথবা পিন নং দিন ইংরেজিতে">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="search-btn">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    <span class="ion-ios-search" aria-hidden="true"></span> Search
                </button>
            </span>
        </div>


    </div>

    <div class="col-md-2 text-center">
        <label for="cropzee-input">
            <div class="image-overlay">
                <img src="{{ asset('images/default.jpg') }}" class="image-previewer image"
                    data-cropzee="cropzee-input" />
                <button for="cropzee-input" class="btn btn-primary form-control"><i class="ion-ios-upload-outline"></i>
                    Upload</button>
                <div class="overlay">
                    <div class="text">ক্লিক করুন</div>
                </div>
            </div>
        </label>
        <input id="cropzee-input" style="display: none;" name="photo" type="file" accept="image/*">
    </div>
</div>