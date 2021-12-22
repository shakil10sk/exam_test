var union_id         = $('#union-id').val();
var application_type = $('#app-type').val();

$(document).ready(function() {
    let loc = $('meta[name=path]').attr("content");
    let asset_url = loc+'/public/assets';
    let devanagariDigits = {'0': '০','1': '১','2': '২','3': '৩','4': '৪','5': '৫','6': '৬','7': '৭','8': '৮','9': '৯'};
    function en2bn(x){
        let y = x.toString().replace(/[0123456789]/g, function(s) {
            return devanagariDigits[s];
        });
        return y;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'GET',
        url:loc+'/geo/code',
        beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
        complete: function() { $('.pre-loader').fadeOut(); },
        success: function (data) {
            $(".district_append").after(data);
        }
    });

    $('#type_of_organization').change(function () {
        let typeOfOrg = $(this).val();

        if ( typeOfOrg >= 2 && typeOfOrg <=3){
            $('.owner-item-link').remove();

            $('#add-btn').before('<li class="nav-item owner-item-link"><a class="nav-link" id="owner-tab-link-0" data-toggle="tab" href="#owner-tab-0" role="tab" aria-controls="owner-tab-0">মালিক ১</a><li>');

            $('#owner-plus-btn').show();
            $('#search').hide();
            $('#searchForMutilpleOwner').show();

            $('#search input').removeAttr('id');
            $('#searchForMutilpleOwner input').attr('id','search-data-0')

            $('#role').hide();
            $('#owner-tab-0').addClass('show active');
            $('#owner-tab-link-0').addClass('active');


            $("#nid_section").html("জাতীয় পরিচয়পত্র নং(ইংরেজিতে)")
            $("#nid_id_div_1 span .bt-flabels__error-desc").html("জাতীয় পরিচয়পত্র নং দিন ইংরেজিতে....")

            // show all section for multiple owner business type //
            $(".financialBusinessSection").each(function (){
                $(this).show();
            })

            $("#nagorik-pin-0").attr('name','pin[]');

            // add requied for Multiple Owner Business type //
            $(".financialBusinessInput").each(function (){
                $(this).attr('data-parsley-required',true)
            })

            // reset all
            $("*").each(function(){
                if(this.id && this.id != "type_of_organization"){

                    if(this.id == 'gender' || this.id == 'gender_0' || this.id == 'gender_1' || this.id == 'gender_2'){
                        console.log("gender issue: " + this.id);
                    } else {
                        $("#"+this.id).val('');
                        $('#'+this.id).prop('disabled', false);
                        $('#'+this.id).removeAttr('readonly');
                    }
                }
            });

        }else if(typeOfOrg == 4){

            $("#nid_section").html("আইডি/কোড নং (ইংরেজিতে)")
            $("#nid_id_div_1 span .bt-flabels__error-desc").html("আইডি/কোড নং দিন ইংরেজিতে....")
            // hide section for financial Business type //
           $(".financialBusinessSection").each(function (){
               $(this).hide();
           })
            // remove requied for financial Business type //
            $(".financialBusinessInput").each(function (){
                $(this).removeAttr('data-parsley-required');
            })



            $('#owner-plus-btn').hide();
            $('#owner-plus-btn').val(0);
            $('.show-hidden-tab').remove();
            $('.show-hidden-tab-link').remove();
            $('.owner-item-link').remove();

            $('#searchForMutilpleOwner input').removeAttr('id');
            $('#search input').attr('id','search-data-0')

            $('#add-btn').before('<li class="nav-item owner-item-link"><a class="nav-link" id="owner-tab-link-0" data-toggle="tab" href="#owner-tab-0" role="tab" aria-controls="owner-tab-0">মালিকের তথ্য:</a><li>');

            $("#nagorik-pin-0").attr('name','pin');

            $('#owner-tab-0').addClass('show active');
            $('#owner-tab-link-0').addClass('active');
            $('#search').show();
            $('#role').show();


        } else {
            $('#owner-plus-btn').hide();
            $('#owner-plus-btn').val(0);
            $('.show-hidden-tab').remove();
            $('.show-hidden-tab-link').remove();
            $('.owner-item-link').remove();

            $('#searchForMutilpleOwner input').removeAttr('id');
            $('#search input').attr('id','search-data-0')

            $("#nid_section").html("জাতীয় পরিচয়পত্র নং(ইংরেজিতে)")
            $("#nid_id_div_1 span .bt-flabels__error-desc").html("জাতীয় পরিচয়পত্র নং দিন ইংরেজিতে....")
            // show section for single owner Business type //
            $(".financialBusinessSection").each(function (){
                $(this).show();
            })

            // add requied for Single Owner Business type //
            $(".financialBusinessInput").each(function (){
                $(this).attr('data-parsley-required',true)
            })

            $("#nagorik-pin-0").attr('name','pin');

            $('#add-btn').before('<li class="nav-item owner-item-link"><a class="nav-link" id="owner-tab-link-0" data-toggle="tab" href="#owner-tab-0" role="tab" aria-controls="owner-tab-0">মালিকের তথ্য:</a><li>');

            $('#owner-tab-0').addClass('show active');
            $('#owner-tab-link-0').addClass('active');
            $('#search').show();
            $('#searchForMutilpleOwner').hide();
            $('#role').show();
        }
    });

    $('#owner-plus-btn').click(function () {
        let x = $(this).val();
        let y = en2bn(Number(x)+1);

        if ($('#name_bn_'+x).val() == '' || $('#religion_'+x).val() == '' || $('#resident_'+x).val() == '' || $("input[name='gender["+x+"]']:checked").val() == 'undefined' || $('marital_status_'+x).val() == '' || $('#father_name_bn_'+x).val() == '' || $('#mother_name_bn_'+x).val() == '' || $('#permanent_village_bn_'+x).val() == '' || $('#permanent_ward_no_'+x).val() == '' || $('#permanent_district_id_'+x).val() == '' || $('#permanent_upazila_id_'+x).val() == '' || $('#permanent_postoffice_id'+x).val() == ''){
            $('#error-'+x).before('<p class="text-danger text-center error">দুঃখিত! আপনার অপারেশন গ্রহণযোগ্য নয়। '+'মালিক '+y+' এর_ স্টার চিহ্নিত সকল ফিল্ড পূরণ করুন।</p>');

            $('.error').delay(3000).slideUp(300);
        }else {
            $('#owner-tab-link-'+x).removeClass('active');
            $('#owner-tab-'+x).removeClass('active show');

            x++;

            addNewOwnerTab(x);
        }
    });


    function addNewOwnerTab(x) {
        let y = en2bn(Number(x)+1);

        $('#owner-plus-btn').val(x);
        
        $('#add-btn').before('<li class="nav-item show-hidden-tab-link">\n' +
            '                   <a class="nav-link" id="owner-tab-link-'+x+'" data-toggle="tab" href="#owner-tab-'+x+'" role="tab" aria-controls="owner-tab-'+x+'">মালিক '+y+'</a>\n' +
            '                 </li>');

        $('#add-tab').before('<div class="tab-pane show-hidden-tab fade" role="tabpanel" id="owner-tab-'+x+'" >\n' +
        '                            <div class="card card-info">\n' +
        '                               <div class="card-heading p-2">\n' +
        '                                    <button type="button" id="cancel-btn-'+x+'" onclick="removeTab('+x+')" class="btn btn-danger" style="float: right;">X</button>\n' +
        '                                    <h4 class="panel-title text-center" id="error-'+x+'">মালিকের তথ্য:</h4>\n' +
        '                                </div>\n'+
        '                                <div class="card-body">\n' +
                                    ' <div class="row justify-content-center mb-3"\n' +
            '                                             id="search" >\n' +
            '                                            <input type="search"  style="width: 40%" class="form-control"\n' +
            '                                                   id="search-data-'+x+'" \n' +
            '                                                   placeholder="মোবাইল/এন.আই.ডি.নং/জন্ম নিবন্ধন নং/পাসপোর্ট নং/পিন নং দিন ইংরেজিতে">\n' +
            '                                            <span class="input-group-btn ml-2">\n' +
            '                                                    <button class="btn btn-primary" type="button"' +
            '                                                                               id="search-btn"' +
            ' onclick="getCitizenInformation('+x+')" data-id="'+x+'" >\n' +
            '                                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>\n' +
            '                                                        <span class="ion-ios-search" aria-hidden="true"></span> Search\n' +
            '                                                    </button>\n' +
            '                                              </span>\n' +
            '                                        </div>'+
                                    '    <div class="col-md-12">\n' +
                                    '        <div class="row">\n' +
                                    '            <div class="col-md-9">\n' +
                                    '                <div class="row form-group">\n' +
                                    '                    <label for="name_en_'+x+'" class="col-sm-3 control-label">মালিকের নাম(ইংরেজিতে)</label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <input type="text" name="name_en[]" id="name_en_'+x+'" class="form-control" placeholder="Full Name" autofocus data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
                                    '                        <span class="bt-flabels__error-desc">মালিকের নাম দিন ইংরেজিতে....</span>\n' +
                                    '                    </div>\n' +
                                    '                    <label for="name_bn_'+x+'" class="col-sm-3 control-label">মালিকের নাম(বাংলায়) <span class="text-danger">*</span></label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <input type="text" name="name_bn[]" id="name_bn_'+x+'" class="form-control" placeholder="পূর্ণ নাম" autofocus data-parsley-trigger="keyup" data-parsley-required />\n' +
                                    '                        <span class="bt-flabels__error-desc">মালিকের নাম দিন বাংলায়....</span>\n' +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '                <div class="row form-group">\n' +
                                    '                    <label for="nid_'+x+'" class="col-sm-3 control-label">জাতীয় পরিচয়পত্র নং(ইংরেজিতে)</label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper" id="nid_id_div_'+x+'">\n' +
                                    '                        <input type="text" name="nid[]" id="nid_'+x+'" class="form-control" data-parsley-maxlength="17" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />\n' +
                                    '                        <span class="bt-flabels__error-desc">জাতীয় পরিচয়পত্র নং দিন ইংরেজিতে....</span>\n' +
                                    '                    </div>\n' +
                                    '                    <label for="birth_id_'+x+'" class="col-sm-3 control-label">জন্ম নিবন্ধন নং(ইংরেজিতে)</label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper" id="birth_id_div_'+x+'">\n' +
                                    '                        <input type="text" name="birth_id[]" id="birth_id_'+x+'" class="form-control" data-parsley-maxlength="17" autofocus data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />\n' +
                                    '                        <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>\n' +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '                <div class="row form-group">\n' +
                                    '                    <label for="educational_qualification_'+x+'" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <input type="text" name="educational_qualification[]" id="educational_qualification_'+x+'" class="form-control" autofocus data-parsley-maxlength="150" data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন" />\n' +
                                    '                        <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>\n' +
                                    '                    </div>\n' +
                                    '\n' +
                                    '                    <label class="col-sm-3 control-label">ধর্ম <span class="text-danger">*</span></label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <select name="religion[]" id="religion_'+x+'" selected="selected" class="form-control" data-parsley-required >\n' +
                                    '                            <option value="">চিহ্নিত করুন</option>\n' +
                                    '                            <option value="1">ইসলাম</option>\n' +
                                    '                            <option value="2">হিন্দু</option>\n' +
                                    '                            <option value="3">বৌদ্ধ ধর্ম</option>\n' +
                                    '                            <option value="4">খ্রিস্ট ধর্ম</option>\n' +
                                    '                            <option value="5">অন্যান্য</option>\n' +
                                    '                        </select>\n' +
                                    '                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>\n' +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '                <div class="row form-group">\n' +
                                    '                    <label for="occupation_'+x+'" class="col-sm-3 control-label">পেশা</label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <input type="text" name="occupation[]" id="occupation_'+x+'" class="form-control" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>\n' +
                                    '                        <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>\n' +
                                    '                    </div>\n' +
                                    '\n' +
                                    '                    <label class="col-sm-3 control-label">বাসিন্দা <span class="text-danger">*</span></label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <select name="resident[]" id="resident_'+x+'" selected="selected" class="form-control" data-parsley-required >\n' +
                                    '                            <option value="">চিহ্নিত করুন</option>\n' +
                                    '                            <option value="1">অস্থায়ী</option>\n' +
                                    '                            <option value="2">স্থায়ী</option>\n' +
                                    '                        </select>\n' +
                                    '                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>\n' +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '            </div>\n' +
                                    '\n' +
                                    '            <div class="col-md-3">\n' +
                                    '                <label for="cropzee-input_'+x+'" onclick="cropTest('+x+');">\n' +
                                    '                    <div class="image-overlay">\n' +
                                    '                        <img src="'+loc+'/public/assets/images/application/default.jpg" class="image-previewer image" data-cropzee="cropzee-input_'+x+'" />\n' +
                                    '                        <button for="cropzee-input_'+x+'" class="btn btn-primary form-control"><i class="ion-ios-upload-outline"></i> Upload</button>\n' +
                                    '                        <div class="overlay">\n' +
                                    '                            <div class="text">ক্লিক করুন</div>\n' +
                                    '                        </div>\n' +
                                    '                    </div>\n' +
                                    '                </label>\n' +
                                    '                <input id="cropzee-input_'+x+'" style="display: none;" name="photo[]" type="file" accept="image/*">\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12" id="genderError_'+x+'">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label class="col-sm-3 control-label">লিঙ্গ <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <label class="radio-inline"><input type="radio" name="gender['+x+']" onclick="genderStatus('+x+')" value="1" >পুরুষ </label>\n' +
                                    '                <label class="radio-inline"><input type="radio" name="gender['+x+']" onclick="genderStatus('+x+')" value="2" >মহিলা</label>\n' +
                                    '               <p class="has-danger" id="genderErrorField_'+x+'" role="alert"></p>'+
                                    '            </div>\n' +
                                    '            <label for="marital_status_'+x+'" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select name="marital_status[]" id="marital_status_'+x+'" onchange="genderStatus('+x+')" class="form-control" data-parsley-required >\n' +
                                    '                    <option value="">চিহ্নিত করুন</option>\n' +
                                    '                    <option value="1">অবিবাহিত</option>\n' +
                                    '                    <option value="2">বিবাহিত</option>\n' +
                                    '                </select>\n' +
                                    '                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-md-12" id="showhidden-husband-name-'+x+'" style="display: none;">\n' +
                                    '       <div class="row form-group">\n' +
                                    '           <label for="husband_name_bn_'+x+'" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>\n' +
                                    '           <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '               <input type="text" name="husband_name_en[]" id="husband_name_en_'+x+'" class="form-control" placeholder="" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup"/>\n' +
                                    '               <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>\n'+
                                    '           </div>\n' +
                                    '           <label for="husband_name_bn_'+x+'" class="col-sm-3 control-label">স্বামীর নাম (বাংলায়)</label>\n' +
                                    '           <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '               <input type="text" name="husband_name_bn[]" id="husband_name_bn_'+x+'" class="form-control" placeholder="" >\n' +
                                    '               <span class="bt-flabels__error-desc">স্বামীর নাম দিন বাংলায়....</span>\n'+
                                    '           </div>\n' +
                                    '       </div>\n'+
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-md-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="father_name_en_'+x+'" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="father_name_en[]" id="father_name_en_'+x+'" class="form-control" autofocus data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" placeholder="Father\'s Name" />\n' +
                                    '                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="father_name_bn_'+x+'" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="father_name_bn[]" id="father_name_bn_'+x+'" class="form-control" autofocus placeholder="পিতার নাম" data-parsley-required />\n' +
                                    '                <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '\n' +
                                    '    <div class="col-md-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="mother_name_en_'+x+'" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="mother_name_en[]" id="mother_name_en_'+x+'" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" autofocus class="form-control" placeholder="Mother\'s Name" />\n' +
                                    '                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="mother_name_bn_'+x+'" class="col-sm-3 control-label">মাতার নাম (বাংলায়) <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="mother_name_bn[]" id="mother_name_bn_'+x+'" class="form-control" autofocus placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />\n' +
                                    '                <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12 text-center" style="margin-top: 50px;">\n' +
                                    '        <h4 class="app-heading">\n' +
                                    '            বর্তমান ঠিকানা\n' +
                                    '        </h4>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_village_en_'+x+'" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_village_en[]" id="present_village_en_'+x+'" autofocus class="form-control" placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
                                    '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="present_village_bn_'+x+'" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_village_bn[]" id="present_village_bn_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />\n' +
                                    '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_rbs_en_'+x+'" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_rbs_en[]" id="present_rbs_en_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>\n' +
                                    '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="present_rbs_bn_'+x+'" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) </label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_rbs_bn[]" id="present_rbs_bn_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
                                    '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_holding_no_'+x+'" class="col-sm-3 control-label">হোল্ডিং নং </label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_holding_no[]" id="present_holding_no_'+x+'" class="form-control" autofocus data-parsley-type="number" data-parsley-trigger="keyup" />\n' +
                                    '                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="present_ward_no_'+x+'" class="col-sm-3 control-label">ওয়ার্ড নং <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_ward_no[]" id="present_ward_no_'+x+'" class="form-control" autofocus  data-parsley-type="number" data-parsley-trigger="keyup"/>\n' +
                                    '                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_district_id_'+x+'" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '<input class="form-control" id="present_district_txt_' + x +'" name="present_district_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy(\'present_district_txt_'+x+'\', \'present_district_'+x+'\')" />' +
                                    '<input type="hidden" id="present_district_id_'+x+'" name="present_district_id[]" />\n' +
                                    '                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '\n' +
                                    '            <label for="present_district_'+x+'" class="col-sm-3 control-label">জেলা</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="present_district_'+x+'" value="জেলা" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_upazila_id_'+x+'" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '<input class="form-control" id="present_upazila_txt_'+x+'" name="present_upazila_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy(\'present_upazila_txt_'+x+'\', \'present_upazila_'+x+'\')" />' +
                            
                                    '<input type="hidden" id="present_upazila_id_'+x+'" name="present_upazila_id[]" />\n' +
                                    '                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '\n' +
                                    '            <label for="present_upazila_'+x+'" class="col-sm-3 control-label">উপজেলা/থানা</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="present_upazila_'+x+'" value="উপজেলা/থানা" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_postoffice_id_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '<input class="form-control" id="present_postoffice_txt_'+x+'" name="present_postoffice_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy(\'present_postoffice_txt_'+x+'\', \'present_postoffice_'+x+'\')" />'+
                            
                                    '<input type="hidden" id="present_postoffice_id_'+x+'" name="present_postoffice_id[]" />\n' +
                                    '                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="present_postoffice_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="present_postoffice_'+x+'" value="পোষ্ট অফিস" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12 text-center" style="margin-top: 50px;">\n' +
                                    '        <h4 class="app-heading">\n' +
                                    '            স্থায়ী  ঠিকানা\n' +
                                    '        </h4>\n' +
                                    '        <p style="font-size:15px; font-weight:normal;padding-top:10px;"> <input type="checkbox" name="permanentBtn[]" id="permanentBtn_'+x+'" onclick="insertAddress('+x+');" value="'+x+'">ঠিকানা একই হলে টিক দিন</p>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_village_en_'+x+'" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_village_en[]" id="permanent_village_en_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
                                    '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="permanent_village_bn_'+x+'" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_village_bn[]" id="permanent_village_bn_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />\n' +
                                    '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_rbs_en_'+x+'" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_rbs_en[]" id="permanent_rbs_en_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>\n' +
                                    '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="permanent_rbs_bn_'+x+'" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) </label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_rbs_bn[]" id="permanent_rbs_bn_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  />\n' +
                                    '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_holding_no_'+x+'" class="col-sm-3 control-label">হোল্ডিং নং </label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_holding_no[]" id="permanent_holding_no_'+x+'" autofocus class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" />\n' +
                                    '                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="permanent_ward_no_'+x+'" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_ward_no[]" id="permanent_ward_no_'+x+'" class="form-control" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>\n' +
                                    '                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_district_id_'+x+'" class="col-sm-3 control-label">জেলা <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '<input class="form-control" id="permanent_district_txt_'+x+'" name="permanent_district_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy(\'permanent_district_txt_'+x+'\', \'permanent_district_'+x+'\')"/>'+
                            
                                    '<input type="hidden" id="permanent_district_id_'+x+'" name="permanent_district_id[]" />\n' +
                                    '                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="permanent_district_'+x+'" class="col-sm-3 control-label">জেলা</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="permanent_district_'+x+'" value="জেলা" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_upazila_id_'+x+'" class="col-sm-3 control-label">উপজেলা/থানা <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '<input class="form-control" id="permanent_upazila_txt_'+x+'" name="permanent_upazila_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy(\'permanent_upazila_txt_'+x+'\', \'permanent_upazila_'+x+'\')"/>'+
                            
                                    '<input type="hidden" id="permanent_upazila_id_'+x+'" name="permanent_upazila_id[]" />\n' +
                                    '                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '\n' +
                                    '            <label for="permanent_upazila_'+x+'" class="col-sm-3 control-label">উপজেলা/থানা</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="permanent_upazila_'+x+'" value="উপজেলা/থানা" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_postoffice_id_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস <span class="text-danger">*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '<input class="form-control" id="permanent_postoffice_txt_'+x+'" name="permanent_postoffice_txt[]" style="width: 100%; height: 38px;" data-parsley-required onchange="locationCopy(\'permanent_postoffice_txt_'+x+'\', \'permanent_postoffice_'+x+'\')"/>'+
                            
                                    '<input type="hidden" id="permanent_postoffice_id_'+x+'" name="permanent_postoffice_id[]" />\n' +
                                    '                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '\n' +
                                    '            <label for="permanent_postoffice_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="permanent_postoffice_'+x+'" value="পোষ্ট অফিস" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '<input type="hidden" value="" name="pin[]" id="nagorik-pin-'+x+'">\n'+
                                    '</div>');

        $('#owner-tab-link-'+x).addClass('active');
        $('#owner-tab-'+x).addClass('show active');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'GET',
            url:loc+'/geo/code',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },
            success: function (data) {
                $("#present_district_append_"+x).after(data);
                $("#permanent_district_append_"+x).after(data);
            }
        });

        // add new owner
        // generate address hand write
        newOwner(x);

    }

    $("form").submit(function(){
        let x = $('#owner-plus-btn').val();
        let errorFields = '';
        for(var i=0; i<= x;){
            let nid = $('#nid_'+i).val();
            let birth = $('#birth_id_'+i).val();

            if (nid === '' && birth === ''){
                $('#birth_id_'+i).addClass('is-invalid');
                $('#nid_'+i).addClass('is-invalid');
                errorFields += en2bn(Number(i)+1)+', ';
            }
            i++;
        }

        if(errorFields != ''){
            $('#national-id-error').html('<span class="text-danger"><i class="icon-copy ion-android-star"></i> অনুগ্রহ করে মালিক '+errorFields+' এর ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>');
            return false;
        }else{
            $('button[type="submit"]').attr('disabled', 'disabled');
            $('<img src="' + asset_url + '/images/loding.gif" alt="loding.gif" style="position: relative;height: 60px;top: -10px;"></img>').insertAfter('button[type="submit"]');
            return true;
        }

    });

});

// check exiting data //
function getCitizenInformation(index){
    let url = $('meta[name=path]').attr("content");
    let asset_url = url+'/public/assets';
    let searchData      = $('#search-data-'+index).val();
    let ownerType = $("#type_of_organization").val();

    if(searchData == ''){
        swal({
            type    : 'error',
            title   : 'দুঃখিত...',
            text    : 'আপনার কোনো তথ্য পাওয়া যায়নি!',
            confirmButtonText: 'ঠিক আছে'
        });
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:url+'/api/check/exiting/application',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },

            data:{searchData:searchData, applicationType: application_type, unionId:union_id,owerType:ownerType},

            success: function (res) {
                if(res == ''){
                    swal({
                        type    : 'error',
                        title   : 'দুঃখিত...',
                        text    : 'আপনার কোনো তথ্য পাওয়া যায়নি!',
                        confirmButtonText: 'ঠিক আছে'
                    });

                    return;
                }

                let info = '';

                if(res.gender == 2 && res.marital_status == 2){
                    $('#genderError_'+index).removeAttr('style');
                    $('#genderErrorField_'+index).html('');
                    $('#showhidden-husband-name-'+index).show();
                    $('#husband_name_bn_'+index).attr('required', 'required');
                }

                // dropdown value assign
                var dropdown_item = ["resident", "religion", "marital_status", "present_district_id", "present_upazila_id", "present_postoffice_id", "permanent_district_id", "permanent_upazila_id", "permanent_postoffice_id"];

                $.each(res, function(name, val) {
                    if(val != null){
                        $('#'+name+'_'+index).val(val);
                        $('#'+name+'_'+index).prop('readonly', true);

                        // dropdown value set hidden value
                        if(dropdown_item.includes(name)){
                            $('#'+name+'_'+index).prop('disabled', true);

                            $("#nagorik-pin-"+index).append('<input type="hidden" name="' + name + '[]" value="' + val + '" />');
                        }

                    }
                });

                let appType = $('#app-type').val();

                $('#nagorik-pin-'+index).val(res.pin);

                // $('#form-data').attr('action', loc+'/trade');

                $("#image-"+index).attr('src', asset_url+'/images/application/'+res.photo);

                $("#gender_"+res.gender).attr('checked', true);
                $(".gender").attr('disabled', true);
                // $(".wrap").css('opacity', '.2');

                $('#marital_status_'+index).val(res.marital_status);

                $('#husband_name_en_'+index).val(res.husband_name_en);
                $('#husband_name_bn_'+index).val(res.husband_name_bn);


                $('#present_village_en_'+index).val(res.present_village_en);
                $('#present_village_bn_'+index).val(res.present_village_bn);


                $('#present_rbs_en_'+index).val(res.present_rbs_en);
                $('#present_rbs_bn_'+index).val(res.present_rbs_bn);

                $('#present_holding_no_'+index).val(res.present_holding_no);
                $('#present_ward_no_'+index).val(res.present_ward_no);

                // present district
                $('#present_district_id_'+index).append('<option value="'+res.present_district_id+'" selected="selected">'+res.present_district_name_en+'</option>');

                $('#present_district_'+index).val(res.present_district_name_bn);

                // present upazila
                $('#present_upazila_id_'+index).html('<option value="'+res.present_upazila_id+'" selected="selected">'+res.present_upazila_name_en+'</option>');

                $('#present_upazila_'+index).val(res.present_upazila_name_bn);

                // present postoffice
                $('#present_postoffice_id_'+index).html('<option value="'+res.present_postoffice_id+'" selected="selected">'+res.present_postoffice_name_en+'</option>');

                $('#present_postoffice_'+index).val(res.present_postoffice_name_bn);

                $('#addressCheck-'+index).remove();

                // permanent district
                $('#permanent_district_id_'+index).append('<option value="'+res.permanent_district_id+'" selected="selected">'+res.permanent_district_name_en+'</option>');

                $('#permanent_district_id_'+index).prop('disabled', true);
                $('#permanent_district_'+index).val(res.permanent_district_name_bn);

                // permanent upazila
                $('#permanent_upazila_id_'+index).html('<option value="'+res.permanent_upazila_id+'" selected="selected">'+res.permanent_upazila_name_en+'</option>');

                $('#permanent_upazila_id_'+index).prop('disabled', true);
                $('#permanent_upazila_'+index).val(res.permanent_upazila_name_bn);

                // permanent postoffice
                $('#permanent_postoffice_id_'+index).html('<option value="'+res.permanent_postoffice_id+'" selected="selected">'+res.permanent_postoffice_name_en+'</option>');

                $('#permanent_postoffice_id_'+index).prop('disabled', true);

                $('#permanent_postoffice_'+index).val(res.permanent_postoffice_name_bn);
            }
        });
    }
}

//get geo location
function getLocation(parentId, selectId = null, targetId = null, thanId = null, thanViewId = null, type = null){

    let loc = $('meta[name=path]').attr("content");
    let nam = '';
    if (type == 3){
        nam = 'উপজেলা/থানা';
    }else {
        nam = 'পোস্ট অফিস';
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'POST',
        url:loc+'/geo/code/get',
        beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
        complete: function() { $('.pre-loader').fadeOut(); },
        data: {'id': parentId, 'type': type},
        success: function (data) {
            $("#"+thanViewId).val(nam);
            $("#"+selectId).val(data.name);
            $("#"+thanId).html('<option value="" id="'+targetId+'">চিহ্নিত করুন</option>')
            $("#"+targetId).after(data.list);
        }
    });
}

// get Street Name //
function getStreetNameBn(id){

    let loc = $('meta[name=path]').attr("content");

    if ( !! id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'GET',
            url:loc+'/union/setup/street/getBnName',
            data: {'id': id},
            dataType:'JSON',
            success: function (data) {
                $("#trade_rbs_bn").val(data.name_bn);
            }
        });
    }else{
        $("#trade_rbs_bn").val("রোড/ব্লক/সেক্টর");
    }


}

// finacial-Business-type //
function financialBusinessOwnerType(){
    let typeOfOrg = parseInt($("#ownerType").val());

     if(typeOfOrg == 4){

        $("#nid_section").html("আইডি/কোড নং (ইংরেজিতে)")
        $("#nid_id_div_1 span .bt-flabels__error-desc").html("আইডি/কোড নং দিন ইংরেজিতে....")
        // hide section for financial Business type //
        $(".financialBusinessSection").each(function (){
            $(this).hide();
        })
        // remove requied for financial Business type //
        $(".financialBusinessInput").each(function (){
            $(this).removeAttr('data-parsley-required');
        })



        $('#owner-plus-btn').hide();
        $('#owner-plus-btn').val(0);
        $('.show-hidden-tab').remove();
        $('.show-hidden-tab-link').remove();
        $('.owner-item-link').remove();

        $('#add-btn').before('<li class="nav-item owner-item-link"><a class="nav-link" id="owner-tab-link-0" data-toggle="tab" href="#owner-tab-0" role="tab" aria-controls="owner-tab-0">মালিকের তথ্য:</a><li>');

        $('#owner-tab-0').addClass('show active');
        $('#owner-tab-link-0').addClass('active');
        $('#search').show();
        $('#role').show();


    }
}
