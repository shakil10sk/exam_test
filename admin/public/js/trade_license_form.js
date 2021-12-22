$(document).ready(function() {
    let loc = $('meta[name=path]').attr("content");
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

    //check exting data
    $('#search-btn').click(function(){
        let searchData      = $('#search-data').val();
        let unionId         = $('#union-id').val();
        let applicationType = $('#app-type').val();
        if(searchData == ''){
            swal({
                type    : 'error',
                title   : 'ওহো...',
                text    : 'আপনার কোনো তথ্য পাওয়া যায়নি!',
                confirmButtonText: 'ঠিক আছে'
              });
    }else{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:loc+'/api/check/exiting/application',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },
            data:{searchData:searchData, applicationType: applicationType, unionId:unionId},
            success: function (res) {
                let info = '';
                if(res.sonodno){
                    info = res.message+'<b>'+res.pin+'</b> এবং সনদ নং <b>'+res.sonodno+'</b> <br/><br/><a href="'+loc+'/'+res.application+'/print_bn/'+res.sonodno+'" type="button" class="btn btn-info" target="_blank">সনদটি বাংলায় প্রিভিউ দেখুন</a> <br/><br/> <a href="'+loc+'/'+res.application+'print_en/'+res.sonodno+'" type="button" class="btn btn-info" target="_blank">সনদটি ইংরেজিতে প্রিভিউ দেখুন</a>';
                    sweetAlert(res.status, info);
                }else if(res.tracking){
                    info = res.message+'<b>'+res.pin+'</b> এবং ট্র্যাকিং নং <b>'+res.tracking+'</b> <br/><br/><a href="'+loc+'/'+res.application+'/preview/'+res.tracking+'" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিভিউ দেখুন</a>';
                    sweetAlert(res.status, info);
                }else if(res.status404){
                    swal({
                        type    : 'error',
                        title   : 'ওহো...',
                        text    : res.status404,
                        confirmButtonText: 'ঠিক আছে'
                      });
                }else{
                    if(res[1]['gender'] == 2 && res[1]['marital_status'] == 2){
                        $('#genderError_'+x).removeAttr('style');
                        $('#genderErrorField_'+x).html('');
                        $('#showhidden-husband-name-0').show();
                        $('#husband_name_bn_0').attr('required', 'required');
                    }
                    $.each(res[0], function(name, val) {
                        $('#'+name+'_0').val(val);
                        $('#'+name+'_0').prop('disabled', true);
                    });
                    
                    let appType     = $('#app-type').val();
                    $('#nagorik-pin').val(res[0]['pin']);

                    $('#form-data').attr('action', loc+'/trade');

                    $("#image-0").attr('src', loc+'/assets/images/application/'+res[1]['photo']);

                    $("#gender_"+res[1]['gender']).attr('checked', true);
                    $(".gender").attr('disabled', true);
                    $(".wrap").css('opacity', '.2');

                    $('#marital_status_0').val(res[1]['marital_status']);

                    $('#husband_name_en_0').val(res[1]['husband_name_en']);
                    $('#husband_name_bn_0').val(res[1]['husband_name_bn']);
                    

                    $('#present_village_en_0').val(res[1]['present_village_en']);
                    $('#present_village_bn_0').val(res[1]['present_village_bn']);


                    $('#present_rbs_en_0').val(res[1]['present_rbs_en']);
                    $('#present_rbs_bn_0').val(res[1]['present_rbs_bn']);

                    $('#present_holding_no_0').val(res[1]['present_holding_no']);
                    $('#present_ward_no_0').val(res[1]['present_ward_no']);

                    $('#present_district_id_0').append('<option value="'+res[1]['present_district_id']+'" selected="selected">'+res[1]['present_district_name_en']+'</option>');
                    $('#present_district_0').val(res[1]['present_district_name_bn']);

                    $('#present_upazila_id_0').html('<option value="'+res[1]['present_upazila_id']+'" selected="selected">'+res[1]['present_upazila_name_en']+'</option>');
                    $('#present_upazila_0').val(res[1]['present_upazila_name_bn']);

                    $('#present_postoffice_id_0').html('<option value="'+res[1]['present_postoffice_id']+'" selected="selected">'+res[1]['present_postoffice_name_en']+'</option>');
                    $('#present_postoffice_0').val(res[1]['present_postoffice_name_bn']);

                    $('#addressCheck-0').remove();

                    $('#permanent_district_id_0').append('<option value="'+res[1]['permanent_district_id']+'" selected="selected">'+res[1]['permanent_district_name_en']+'</option>');
                    $('#permanent_district_id_0').prop('disabled', true);
                    $('#permanent_district_0').val(res[1]['permanent_district_name_bn']);

                    $('#permanent_upazila_id_0').html('<option value="'+res[1]['permanent_upazila_id']+'" selected="selected">'+res[1]['permanent_upazila_name_en']+'</option>');
                    $('#permanent_upazila_id_0').prop('disabled', true);
                    $('#permanent_upazila_0').val(res[1]['permanent_upazila_name_bn']);

                    $('#permanent_postoffice_id_0').html('<option value="'+res[1]['permanent_postoffice_id']+'" selected="selected">'+res[1]['permanent_postoffice_name_en']+'</option>');
                    $('#permanent_postoffice_id_0').prop('disabled', true);
                    $('#permanent_postoffice_0').val(res[1]['permanent_postoffice_name_bn']);
                }
                
            }
        });
    }

        function sweetAlert(status, info){
            swal({
                title   : '<strong>'+status+'</strong>',
	            type    : "warning",
                html    : info,
                showConfirmButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText:
                  '<i class="fa fa-print-up"></i> ঠিক আছে!',
                confirmButtonAriaLabel: 'ঠিক আছে!'
              }).then(function () {
                location.reload(true);
            });
        }
        
    });

    $('#type_of_organization').change(function () {
        let typeOfOrg = $(this).val();

        if ( typeOfOrg >= 2 ){
            $('.owner-item-link').remove();
            $('#add-btn').before('<li class="nav-item owner-item-link"><a class="nav-link" id="owner-tab-link-0" data-toggle="tab" href="#owner-tab-0" role="tab" aria-controls="owner-tab-0">মালিক ১</a><li>');
            $('#owner-plus-btn').show();
            $('#search').hide();
            $('#role').hide();
            $('#owner-tab-0').addClass('show active');
            $('#owner-tab-link-0').addClass('active');
        }else {
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
    });

    $('#owner-plus-btn').click(function () {
        let x = $(this).val();
        let y = en2bn(Number(x)+1);

        if ($('#name_bn_'+x).val() == '' || $('#religion_'+x).val() == '' || $('#resident_'+x).val() == '' || $("input[name='gender["+x+"]']:checked").val() == 'undefined' || $('marital_status_'+x).val() == '' || $('#father_name_bn_'+x).val() == '' || $('#mother_name_bn_'+x).val() == '' || $('#permanent_village_bn_'+x).val() == '' || $('#permanent_rbs_bn_'+x).val() == '' || $('#permanent_holding_no_'+x).val() == '' || $('#permanent_ward_no_'+x).val() == '' || $('#permanent_district_id_'+x).val() == '' || $('#permanent_upazila_id_'+x).val() == '' || $('#permanent_postoffice_id'+x).val() == ''){
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
                                    '    <div class="col-md-12">\n' +
                                    '        <div class="row">\n' +
                                    '            <div class="col-md-9">\n' +
                                    '                <div class="row form-group">\n' +
                                    '                    <label for="name_en_'+x+'" class="col-sm-3 control-label">মালিকের নাম(ইংরেজিতে)</label>\n' +
                                    '                    <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                        <input type="text" name="name_en[]" id="name_en_'+x+'" class="form-control" placeholder="Full Name" autofocus data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
                                    '                        <span class="bt-flabels__error-desc">মালিকের নাম দিন ইংরেজিতে....</span>\n' +
                                    '                    </div>\n' +
                                    '                    <label for="name_bn_'+x+'" class="col-sm-3 control-label">মালিকের নাম(বাংলায়) <span>*</span></label>\n' +
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
                                    '                    <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>\n' +
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
                                    '                    <label class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>\n' +
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
                                    '                        <img src="'+loc+'/assets/images/default/default.jpg" class="image-previewer image" data-cropzee="cropzee-input_'+x+'" />\n' +
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
                                    '            <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <label class="radio-inline"><input type="radio" name="gender['+x+']" onclick="genderStatus('+x+')" value="1" >পুরুষ </label>\n' +
                                    '                <label class="radio-inline"><input type="radio" name="gender['+x+']" onclick="genderStatus('+x+')" value="2" >মহিলা</label>\n' +
                                    '               <p class="has-danger" id="genderErrorField_'+x+'" role="alert"></p>'+
                                    '            </div>\n' +
                                    '            <label for="marital_status_'+x+'" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span>*</span></label>\n' +
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
                                    '            <label for="father_name_bn_'+x+'" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span>*</span></label>\n' +
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
                                    '            <label for="mother_name_bn_'+x+'" class="col-sm-3 control-label">মাতার নাম (বাংলায়) <span>*</span></label>\n' +
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
                                    '            <label for="present_village_bn_'+x+'" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span>*</span></label>\n' +
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
                                    '            <label for="present_rbs_bn_'+x+'" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_rbs_bn[]" id="present_rbs_bn_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required />\n' +
                                    '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_holding_no_'+x+'" class="col-sm-3 control-label">হোল্ডিং নং <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_holding_no[]" id="present_holding_no_'+x+'" class="form-control" autofocus data-parsley-type="number" data-parsley-trigger="keyup" />\n' +
                                    '                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '            <label for="present_ward_no_'+x+'" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="present_ward_no[]" id="present_ward_no_'+x+'" class="form-control" autofocus  data-parsley-type="number" data-parsley-trigger="keyup"/>\n' +
                                    '                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="present_district_id_'+x+'" class="col-sm-3 control-label">জেলা <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select onchange="getLocation($(this).val(), \'present_district_'+x+'\', \'present_upazila_append_'+x+'\', \'present_upazila_id_'+x+'\', \'present_upazila_'+x+'\', 3 )" name="present_district_id[]" id="present_district_id_'+x+'" class="form-control custom-select2" style="width: 100%; height: 38px;" data-parsley-required >\n' +
                                    '                    <option value="" class="district_append" id="present_district_append_'+x+'">-আপনার জেলা নির্বাচন করুন-</option>\n' +
                                    '                </select>\n' +
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
                                    '            <label for="present_upazila_id_'+x+'" class="col-sm-3 control-label">উপজেলা/থানা <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select onchange="getLocation($(this).val(), \'present_upazila_'+x+'\', \'present_post_office_append_'+x+'\', \'present_postoffice_id_'+x+'\', \'present_postoffice_'+x+'\', 6 )" name="present_upazila_id[]" id="present_upazila_id_'+x+'" class="form-control" data-parsley-required >\n' +
                                    '                    <option value="" id="present_upazila_append_'+x+'">চিহ্নিত করুন</option>\n' +
                                    '                </select>\n' +
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
                                    '            <label for="present_postoffice_id_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select onchange="getLocation($(this).val(), \'present_postoffice_'+x+'\')" name="present_postoffice_id[]" id="present_postoffice_id_'+x+'" class="form-control" data-parsley-required >\n' +
                                    '                    <option value="" id="present_post_office_append_'+x+'">চিহ্নিত করুন</option>\n' +
                                    '                </select>\n' +
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
                                    '            <label for="permanent_village_bn_'+x+'" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span>*</span></label>\n' +
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
                                    '            <label for="permanent_rbs_bn_'+x+'" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <input type="text" name="permanent_rbs_bn[]" id="permanent_rbs_bn_'+x+'" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" data-parsley-required />\n' +
                                    '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
                                    '\n' +
                                    '    <div class="col-sm-12">\n' +
                                    '        <div class="row form-group">\n' +
                                    '            <label for="permanent_holding_no_'+x+'" class="col-sm-3 control-label">হোল্ডিং নং <span>*</span></label>\n' +
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
                                    '            <label for="permanent_district_id_'+x+'" class="col-sm-3 control-label">জেলা <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select onchange="getLocation($(this).val(), \'permanent_district_'+x+'\', \'permanent_upazila_append_'+x+'\', \'permanent_upazila_id_'+x+'\', \'permanent_upazila_'+x+'\', 3 )" name="permanent_district_id[]" id="permanent_district_id_'+x+'" class="form-control custom-select2" style="width: 100%; height: 38px;" data-parsley-required >\n' +
                                    '                    <option value="" class="district_append" id="permanent_district_append_'+x+'">-আপনার জেলা নির্বাচন করুন-</option>\n' +
                                    '                </select>\n' +
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
                                    '            <label for="permanent_upazila_id_'+x+'" class="col-sm-3 control-label">উপজেলা/থানা <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select onchange="getLocation($(this).val(), \'permanent_upazila_'+x+'\', \'permanent_post_office_append_'+x+'\', \'permanent_postoffice_id_'+x+'\', \'permanent_postoffice_'+x+'\', 6 )" name="permanent_upazila_id[]" id="permanent_upazila_id_'+x+'" class="form-control" data-parsley-required >\n' +
                                    '                    <option value="" id="permanent_upazila_append_'+x+'">চিহ্নিত করুন</option>\n' +
                                    '                </select>\n' +
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
                                    '            <label for="permanent_postoffice_id_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস <span>*</span></label>\n' +
                                    '            <div class="col-sm-3 bt-flabels__wrapper">\n' +
                                    '                <select onchange="getLocation($(this).val(), \'permanent_postoffice_'+x+'\')" name="permanent_postoffice_id[]" id="permanent_postoffice_id_'+x+'" class="form-control" data-parsley-required >\n' +
                                    '                    <option value="" id="permanent_post_office_append_'+x+'">চিহ্নিত করুন</option>\n' +
                                    '                </select>\n' +
                                    '                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>\n' +
                                    '            </div>\n' +
                                    '\n' +
                                    '            <label for="permanent_postoffice_'+x+'" class="col-sm-3 control-label">পোষ্ট অফিস</label>\n' +
                                    '            <div class="col-sm-3">\n' +
                                    '                <input type="text" disabled id="permanent_postoffice_'+x+'" value="পোষ্ট অফিস" class="form-control" placeholder=""/>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>\n' +
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
            return true;
        }
        
    });
    

});

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