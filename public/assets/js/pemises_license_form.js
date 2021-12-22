$(document).ready(function () {
    let loc = $('meta[name=path]').attr("content");
    let path = $('meta[name=url]').attr("content");

    let devanagariDigits = { '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯' };

    function en2bn(x) {
        let y = x.toString().replace(/[0123456789]/g, function (s) {
            return devanagariDigits[s];
        });
        return y;
    }

    // $('#business_start_date, #previous_license_data').datepicker({
    //     language: 'en',
    //     autoClose: true,
    //     dateFormat: 'yy-mm-dd',
    // });

    // $.ajax({
    //     type: 'GET',
    //     url: loc + '/api/geo/code',
    //     beforeSend: function () { $('#overlay').show(); },
    //     complete: function () { $('#overlay').fadeOut(); },
    //     success: function (data) {
    //         $(".district_append").after(data);
    //     }
    // });

    //check exting data
    $('#search-btn').click(function () {
        let searchData = $('#search-data').val();
        let unionId = $('#union-id').val();
        let applicationType = $('#web').val();
        if (searchData == '') {
            Swal.fire({
                icon: 'error',
                title: 'দুঃখিত...',
                text: 'আপনার কোনো তথ্য পাওয়া যায়নি!',
                confirmButtonText: 'ঠিক আছে'
            });
        } else {
            $.ajax({
                type: 'POST',
                url: loc + '/api/check/exiting/application',
                data: { searchData: searchData, applicationType: applicationType, unionId: unionId },
                success: function (res) {
                    let info = '';
                    if (res.sonodno) {
                        info = res.message + '<b>' + res.pin + '</b> এবং সনদ নং <b>' + res.sonodno + '</b> <br/><br/><a href="' + path + '/verify/' + res.application + '_bn/' + res.sonodno + '/' + res.unionid + '/' + res.type + '" type="button" class="btn btn-info" target="_blank">সনদটি বাংলায় প্রিন্ট করুন</a> <br/><br/> <a href="' + path + '/verify/' + res.application + '_en/' + res.sonodno + '/' + res.unionid + '/' + res.type + '" type="button" class="btn btn-info" target="_blank">সনদটি ইংরেজিতে প্রিন্ট করুন</a>';
                        sweetAlert(res.status, info);
                    } else if (res.tracking) {
                        info = res.message + '<b>' + res.pin + '</b> এবং ট্র্যাকিং নং <b>' + res.tracking + '</b> <br/><br/><a href="' + path + '/verify/' + res.application + '_application/' + res.tracking + '/' + res.unionid + '/' + res.type + '" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a>';
                        sweetAlert(res.status, info);
                    } else if (res.status404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: res.status404,
                            confirmButtonText: 'ঠিক আছে'
                        });
                    } else {
                        if (res[1]['gender'] == 2 && res[1]['marital_status'] == 2) {
                            $('#genderError_' + x).removeAttr('style');
                            $('#genderErrorField_' + x).html('');
                            $('#showhidden-husband-name-0').show();
                            $('#husband_name_bn_0').attr('required', 'required');
                        }
                        $.each(res[0], function (name, val) {
                            $('#' + name + '_0').val(val);
                            $('#' + name + '_0').prop('disabled', true);
                        });

                        let appType = $('#app-type').val();
                        $('#nagorik-pin').val(res[0]['pin']);

                        $('#form-data').attr('data-route', loc + '/api/trade');

                        $("#image-0").attr('src', loc + '/public/assets/images/application/' + res[1]['photo']);

                        $("#gender_" + res[1]['gender']).attr('checked', true);
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

                        $('#present_district_id_0').append('<option value="' + res[1]['present_district_id'] + '" selected="selected">' + res[1]['present_district_name_en'] + '</option>');
                        $('#present_district_0').val(res[1]['present_district_name_bn']);

                        $('#present_upazila_id_0').html('<option value="' + res[1]['present_upazila_id'] + '" selected="selected">' + res[1]['present_upazila_name_en'] + '</option>');
                        $('#present_upazila_0').val(res[1]['present_upazila_name_bn']);

                        $('#present_postoffice_id_0').html('<option value="' + res[1]['present_postoffice_id'] + '" selected="selected">' + res[1]['present_postoffice_name_en'] + '</option>');
                        $('#present_postoffice_0').val(res[1]['present_postoffice_name_bn']);

                        $('#addressCheck-0').remove();

                        $('#permanent_district_id_0').append('<option value="' + res[1]['permanent_district_id'] + '" selected="selected">' + res[1]['permanent_district_name_en'] + '</option>');
                        $('#permanent_district_id_0').prop('disabled', true);
                        $('#permanent_district_0').val(res[1]['permanent_district_name_bn']);

                        $('#permanent_upazila_id_0').html('<option value="' + res[1]['permanent_upazila_id'] + '" selected="selected">' + res[1]['permanent_upazila_name_en'] + '</option>');
                        $('#permanent_upazila_id_0').prop('disabled', true);
                        $('#permanent_upazila_0').val(res[1]['permanent_upazila_name_bn']);

                        $('#permanent_postoffice_id_0').html('<option value="' + res[1]['permanent_postoffice_id'] + '" selected="selected">' + res[1]['permanent_postoffice_name_en'] + '</option>');
                        $('#permanent_postoffice_id_0').prop('disabled', true);
                        $('#permanent_postoffice_0').val(res[1]['permanent_postoffice_name_bn']);
                    }

                }
            });
        }

        function sweetAlert(status, info) {
            Swal.fire({
                title: '<strong>' + status + '</strong>',
                icon: "warning",
                html: info,
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
        let i = $(this).val();
        if (i >= 2) {
            $('#owner-tab-link-0').html('<a href="#owner-tab-0" data-toggle="tab">মালিক ১</a>');
            $('#owner-plus-btn').show();
            $('#search').hide();
            $('#role').hide();
        } else {
            $('#owner-plus-btn').hide();
            $('.show-hidden-tab').remove();
            $('.show-hidden-tab-link').remove();
            $('#owner-tab-link-0').addClass('active');
            $('#owner-tab-link-0').html('<a href="#owner-tab-0" data-toggle="tab">মালিকের তথ্য:</a>');
            $('#owner-tab-0').addClass('active in');
            $('#search').show();
            $('#role').show();
        }
    });

    $(":input").change(function (e) {
        let field = $(this).attr('id');
        $('#' + field + '_status').removeClass('has-error has-feedback');
        $('#' + field + '_feedback').text('');
        e.preventDefault();
    });

    $('#owner-plus-btn').click(function () {
        let x = $(this).val();

        let y = en2bn(Number(x) + 1);

        if ($('#name_bn_' + x).val() == '' || $('#religion_' + x).val() == '' || $('#resident_' + x).val() == '' || $("input[name='gender[" + x + "]']:checked").val() == 'undefined' || $('marital_status_' + x).val() == '' || $('#father_name_bn_' + x).val() == '' || $('#mother_name_bn_' + x).val() == '' || $('#permanent_village_bn_' + x).val() == '' || $('#permanent_ward_no_' + x).val() == '' || $('#permanent_district_id_' + x).val() == '' || $('#permanent_upazila_id_' + x).val() == '' || $('#permanent_postoffice_id' + x).val() == '') {
            console.log(x);
            $('#error-' + x).before('<p class="text-danger text-center error">দুঃখিত! আপনার অপারেশন গ্রহণযোগ্য নয়। ' + 'মালিক ' + y + ' এর স্টার চিহ্নিত সকল ফিল্ড পূরণ করুন।</p>');
            $('.error').delay(3000).slideUp(300);
        } else {
            $('#owner-tab-link-' + x).removeClass('active');
            $('#owner-tab-' + x).removeClass('active in');
            x++;
            addNewOwner(x);
        }
    });

    let x;
    function addNewOwner(x) {
        let y = en2bn(Number(x) + 1);
        x = x;
        $('#owner-plus-btn').val(x);
        $('#add-btn').before('<li id="owner-tab-link-' + x + '" class="show-hidden-tab-link"><a href="#owner-tab-' + x + '" data-toggle="tab">মালিক ' + y + '</a></li>');
        $('#add-tab').before('<div class="tab-pane fade show-hidden-tab" id="owner-tab-' + x + '" >\n' +
            '                            <div class="panel panel-info">\n' +
            '                               <div class="panel-heading">\n' +
            '                                    <button type="button" id="cancel-btn-' + x + '" onclick="removeTab(' + x + ')" class="btn btn-danger" style="float: right;">X</button>\n' +
            '                                    <h4 class="panel-title text-center" id="error-' + x + '">মালিকের তথ্য:</h4>\n' +
            '                                </div>\n' +
            '                                <div class="panel-body" style="width: 100%;">\n' +
            '    <div class="col-md-12">\n' +
            '        <div class="row">\n' +
            '            <div class="col-md-9">\n' +
            '                <div class="row form-group">\n' +
            '                    <label for="name_en_' + x + '" class="col-sm-3 control-label">মালিকের নাম(ইংরেজিতে)</label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="name_en_' + x + '_status">\n' +
            '                        <input type="text" name="name_en[]" id="name_en_' + x + '" class="form-control" placeholder="Full Name" autofocus data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
            '                        <span class="bt-flabels__error-desc">মালিকের নাম দিন ইংরেজিতে....</span>\n' +
            '                        <span id="name_en_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '                    <label for="name_bn_' + x + '" class="col-sm-3 control-label">মালিকের নাম(বাংলায়) <span>*</span></label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="name_bn_' + x + '_status">\n' +
            '                        <input type="text" name="name_bn[]" id="name_bn_' + x + '" class="form-control" placeholder="পূর্ণ নাম" autofocus data-parsley-trigger="keyup" data-parsley-required />\n' +
            '                        <span class="bt-flabels__error-desc">মালিকের নাম দিন বাংলায়....</span>\n' +
            '                        <span id="name_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="row form-group">\n' +
            '                    <label for="nid_' + x + '" class="col-sm-3 control-label">জাতীয় পরিচয়পত্র নং(ইংরেজিতে)</label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="nid_' + x + '_status">\n' +
            '                        <input type="text" name="nid[]" id="nid_' + x + '" class="form-control" data-parsley-maxlength="17" autofocus data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="1616623458679011" />\n' +
            '                        <span class="bt-flabels__error-desc">জাতীয় পরিচয়পত্র নং দিন ইংরেজিতে....</span>\n' +
            '                        <span id="nid_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '                    <label for="birth_id_' + x + '" class="col-sm-3 control-label">জন্ম নিবন্ধন নং(ইংরেজিতে)</label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="birth_id_' + x + '_status">\n' +
            '                        <input type="text" name="birth_id[]" id="birth_id_' + x + '" class="form-control" data-parsley-maxlength="17" autofocus data-parsley-type="number" data-parsley-trigger="keyup" placeholder="1919623458679011" />\n' +
            '                        <span class="bt-flabels__error-desc">জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>\n' +
            '                        <span id="birth_id_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="row form-group">\n' +
            '                    <label for="educational_qualification_' + x + '" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="educational_qualification_' + x + '_status">\n' +
            '                        <input type="text" name="educational_qualification[]" id="educational_qualification_' + x + '" class="form-control" autofocus data-parsley-maxlength="150" data-parsley-trigger="keyup" placeholder="শিক্ষাগত যোগ্যতা দিন" />\n' +
            '                        <span class="bt-flabels__error-desc">শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....</span>\n' +
            '                        <span id="educational_qualification_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <label class="col-sm-3 control-label">ধর্ম <span>*</span></label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="religion_' + x + '_status">\n' +
            '                        <select name="religion[]" id="religion_' + x + '" selected="selected" class="form-control" data-parsley-required >\n' +
            '                            <option value="">চিহ্নিত করুন</option>\n' +
            '                            <option value="1">ইসলাম</option>\n' +
            '                            <option value="2">হিন্দু</option>\n' +
            '                            <option value="3">বৌদ্ধ ধর্ম</option>\n' +
            '                            <option value="4">খ্রিস্ট ধর্ম</option>\n' +
            '                            <option value="5">অন্যান্য</option>\n' +
            '                        </select>\n' +
            '                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>\n' +
            '                        <span id="religion_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="row form-group">\n' +
            '                    <label for="occupation_' + x + '" class="col-sm-3 control-label">পেশা</label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="occupation_' + x + '_status">\n' +
            '                        <input type="text" name="occupation[]" id="occupation_' + x + '" class="form-control" autofocus data-parsley-maxlength="120" data-parsley-trigger="keyup" placeholder="পেশা দিন"/>\n' +
            '                        <span class="bt-flabels__error-desc">পেশা দিন ইংরেজিতে/বাংলায়....</span>\n' +
            '                        <span id="occupation_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <label class="col-sm-3 control-label">বাসিন্দা <span>*</span></label>\n' +
            '                    <div class="col-sm-3 bt-flabels__wrapper" id="resident_' + x + '_status">\n' +
            '                        <select name="resident[]" id="resident_' + x + '" selected="selected" class="form-control" data-parsley-required >\n' +
            '                            <option value="">চিহ্নিত করুন</option>\n' +
            '                            <option value="1">অস্থায়ী</option>\n' +
            '                            <option value="2">স্থায়ী</option>\n' +
            '                        </select>\n' +
            '                        <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>\n' +
            '                        <span id="resident_' + x + '_feedback" class="help-block"></span>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '\n' +
            '            <div class="col-md-3">\n' +
            '                <label for="cropzee-input_' + x + '" onclick="cropTest(' + x + ');">\n' +
            '                    <div class="image-overlay">\n' +
            '                        <img src="' + path + '/public/assets/images/default.jpg" class="image-previewer image" data-cropzee="cropzee-input_' + x + '" />\n' +
            '                        <button for="cropzee-input_' + x + '" class="btn btn-primary form-control"><i class="ion-ios-upload-outline"></i> Upload</button>\n' +
            '                        <div class="overlay">\n' +
            '                            <div class="text">ক্লিক করুন</div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </label>\n' +
            '                <input id="cropzee-input_' + x + '" style="display: none;" name="photo[]" type="file" accept="image/*">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12" id="genderError_' + x + '">\n' +
            '        <div class="row form-group">\n' +
            '            <label class="col-sm-3 control-label">লিঙ্গ <span>*</span></label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <label class="radio-inline"><input type="radio" name="gender[' + x + ']" onclick="genderStatus(' + x + ')" value="1" >পুরুষ</label>\n' +
            '                <label class="radio-inline"><input type="radio" name="gender[' + x + ']" onclick="genderStatus(' + x + ')" value="2" >মহিলা</label>\n' +
            '               <p class="has-danger" id="genderErrorField_' + x + '" role="alert"></p>' +
            '               <span id="gender_' + x + '_feedback" class="help-block"></span>' +
            '            </div>\n' +
            '            <label for="marital_status_' + x + '" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="marital_status_' + x + '_status">\n' +
            '                <select name="marital_status[]" id="marital_status_' + x + '" onchange="genderStatus(' + x + ')" class="form-control" data-parsley-required >\n' +
            '                    <option value="">চিহ্নিত করুন</option>\n' +
            '                    <option value="1">অবিবাহিত</option>\n' +
            '                    <option value="2">বিবাহিত</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">অনুগ্রহ করে নির্বাচন করুন....</span>\n' +
            '                <span id="marital_status_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-md-12" id="showhidden-husband-name-' + x + '" style="display: none;">\n' +
            '   <div class="row form-group">\n' +
            '           <label for="husband_name_en_' + x + '" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>\n' +
            '           <div class="col-sm-3 bt-flabels__wrapper" id="husband_name_en_' + x + '_status">\n' +
            '               <input type="text" name="husband_name_en[]" id="husband_name_en_' + x + '" class="form-control" placeholder="Name of husband" data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup" />\n' +
            '               <span class="bt-flabels__error-desc">স্বামীর নাম দিন ইংরেজিতে....</span>\n' +
            '               <span id="husband_name_en_' + x + '_feedback" class="help-block"></span>\n' +
            '           </div>\n' +
            '           <label for="husband_name_bn_' + x + '" class="col-sm-3 control-label">স্বামীর নাম (বাংলায়)</label>\n' +
            '           <div class="col-sm-3 bt-flabels__wrapper" id="husband_name_bn_' + x + '_status">\n' +
            '               <input type="text" name="husband_name_bn[]" id="husband_name_bn_' + x + '" class="form-control" placeholder="স্বামীর নাম" />\n' +
            '               <span class="bt-flabels__error-desc">স্বামীর নাম দিন বাংলায়....</span>\n' +
            '               <span id="husband_name_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '           </div>\n' +
            '       </div>' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-md-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="father_name_en_' + x + '" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)</label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="father_name_en_' + x + '_status">\n' +
            '                <input type="text" name="father_name_en[]" id="father_name_en_' + x + '" class="form-control" autofocus data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" placeholder="Father\'s Name" />\n' +
            '                <span class="bt-flabels__error-desc">পিতার নাম দিন ইংরেজিতে....</span>\n' +
            '                <span id="father_name_en_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="father_name_bn_' + x + '" class="col-sm-3 control-label">পিতার নাম (বাংলায়) <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="father_name_bn_' + x + '_status">\n' +
            '                <input type="text" name="father_name_bn[]" id="father_name_bn_' + x + '" class="form-control" autofocus placeholder="পিতার নাম" data-parsley-required />\n' +
            '                <span class="bt-flabels__error-desc">পিতার নাম দিন বাংলায়....</span>\n' +
            '                <span id="father_name_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '\n' +
            '    <div class="col-md-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="mother_name_en_' + x + '" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)</label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="mother_name_en_' + x + '_status">\n' +
            '                <input type="text" name="mother_name_en[]" id="mother_name_en_' + x + '" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" autofocus class="form-control" placeholder="Mother\'s Name" />\n' +
            '                <span class="bt-flabels__error-desc">মাতার নাম দিন ইংরেজিতে....</span>\n' +
            '                <span id="mother_name_en_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="mother_name_bn_' + x + '" class="col-sm-3 control-label">মাতার নাম (বাংলায়) <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="mother_name_bn_' + x + '_status">\n' +
            '                <input type="text" name="mother_name_bn[]" id="mother_name_bn_' + x + '" class="form-control" autofocus placeholder="মাতার নাম" data-parsley-trigger="keyup" data-parsley-required />\n' +
            '                <span class="bt-flabels__error-desc">মাতার নাম দিন বাংলায়....</span>\n' +
            '                <span id="mother_name_bn_' + x + '_feedback" class="help-block"></span>\n' +
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
            '            <label for="present_village_en_' + x + '" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_village_en_' + x + '_status">\n' +
            '                <input type="text" name="present_village_en[]" id="present_village_en_' + x + '" autofocus class="form-control" placeholder="" data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
            '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>\n' +
            '                <span id="present_village_en_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="present_village_bn_' + x + '" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_village_bn_' + x + '_status">\n' +
            '                <input type="text" name="present_village_bn[]" id="present_village_bn_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />\n' +
            '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>\n' +
            '                <span id="present_village_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="present_rbs_en_' + x + '" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_rbs_en_' + x + '_status">\n' +
            '                <input type="text" name="present_rbs_en[]" id="present_rbs_en_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>\n' +
            '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>\n' +
            '                <span id="present_rbs_en_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="present_rbs_bn_' + x + '" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_rbs_bn_' + x + '_status">\n' +
            '                <input type="text" name="present_rbs_bn[]" id="present_rbs_bn_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
            '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>\n' +
            '                <span id="present_rbs_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="present_holding_no_' + x + '" class="col-sm-3 control-label">হোল্ডিং নং <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_holding_no_' + x + '_status">\n' +
            '                <input type="text" name="present_holding_no[]" id="present_holding_no_' + x + '" class="form-control" autofocus data-parsley-type="number" data-parsley-trigger="keyup" />\n' +
            '                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>\n' +
            '                <span id="present_holding_no_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="present_ward_no_' + x + '" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_ward_no_' + x + '_status">\n' +
            '                <input type="text" name="present_ward_no[]" id="present_ward_no_' + x + '" class="form-control" autofocus  data-parsley-type="number" data-parsley-trigger="keyup"/>\n' +
            '                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>\n' +
            '                <span id="present_ward_no_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="present_district_id_' + x + '" class="col-sm-3 control-label">জেলা <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_district_id_' + x + '_status">\n' +
            '                <select onchange="getLocation($(this).val(), \'present_district_' + x + '\', \'present_upazila_append_' + x + '\', \'present_upazila_id_' + x + '\', \'present_upazila_' + x + '\', 3 )" name="present_district_id[]" id="present_district_id_' + x + '" class="form-control" data-parsley-required >\n' +
            '                    <option value="" class="district_append" id="present_district_append_' + x + '">-আপনার জেলা নির্বাচন করুন-</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>\n' +
            '                <span id="present_district_id_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '\n' +
            '            <label for="present_district_' + x + '" class="col-sm-3 control-label">জেলা</label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <input type="text" disabled id="present_district_' + x + '" value="জেলা" class="form-control" placeholder=""/>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="present_upazila_id_' + x + '" class="col-sm-3 control-label">উপজেলা/থানা <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_upazila_id_' + x + '_status">\n' +
            '                <select onchange="getLocation($(this).val(), \'present_upazila_' + x + '\', \'present_post_office_append_' + x + '\', \'present_postoffice_id_' + x + '\', \'present_postoffice_' + x + '\', 6 )" name="present_upazila_id[]" id="present_upazila_id_' + x + '" class="form-control" data-parsley-required >\n' +
            '                    <option value="" id="present_upazila_append_' + x + '">চিহ্নিত করুন</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>\n' +
            '                <span id="present_upazila_id_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '\n' +
            '            <label for="present_upazila_' + x + '" class="col-sm-3 control-label">উপজেলা/থানা</label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <input type="text" disabled id="present_upazila_' + x + '" value="উপজেলা/থানা" class="form-control" placeholder=""/>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="present_postoffice_id_' + x + '" class="col-sm-3 control-label">পোষ্ট অফিস <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="present_postoffice_id_' + x + '_status">\n' +
            '                <select onchange="getLocation($(this).val(), \'present_postoffice_' + x + '\')" name="present_postoffice_id[]" id="present_postoffice_id_' + x + '" class="form-control" data-parsley-required >\n' +
            '                    <option value="" id="present_post_office_append_' + x + '">চিহ্নিত করুন</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>\n' +
            '                <span id="present_postoffice_id_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="present_postoffice_' + x + '" class="col-sm-3 control-label">পোষ্ট অফিস</label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <input type="text" disabled id="present_postoffice_' + x + '" value="পোষ্ট অফিস" class="form-control" placeholder=""/>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12 text-center" style="margin-top: 50px;">\n' +
            '        <h4 class="app-heading">\n' +
            '            স্থায়ী  ঠিকানা\n' +
            '        </h4>\n' +
            '        <p style="font-size:15px; font-weight:normal;padding-top:10px;"> <input type="checkbox" name="permanentBtn[]" id="permanentBtn_' + x + '" onclick="insertAddress(' + x + ');" value="' + x + '">ঠিকানা একই হলে টিক দিন</p>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="permanent_village_en_' + x + '" class="col-sm-3 control-label">গ্রাম/মহল্লা (ইংরেজিতে)</label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_village_en_' + x + '_status">\n' +
            '                <input type="text" name="permanent_village_en[]" id="permanent_village_en_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
            '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন ইংরেজিতে....</span>\n' +
            '                <span id="permanent_village_en_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="permanent_village_bn_' + x + '" class="col-sm-3 control-label">গ্রাম/মহল্লা (বাংলায়) <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_village_bn_' + x + '_status">\n' +
            '                <input type="text" name="permanent_village_bn[]" id="permanent_village_bn_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"  data-parsley-required />\n' +
            '                <span class="bt-flabels__error-desc">গ্রাম/মহল্লা দিন বাংলায়....</span>\n' +
            '                <span id="permanent_village_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="permanent_rbs_en_' + x + '" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (ইংরেজিতে)</label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_rbs_en_' + x + '_status">\n' +
            '                <input type="text" name="permanent_rbs_en[]" id="permanent_rbs_en_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup"/>\n' +
            '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন ইংরেজিতে....</span>\n' +
            '                <span id="permanent_rbs_en_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="permanent_rbs_bn_' + x + '" class="col-sm-3 control-label">রোড/ব্লক/সেক্টর (বাংলায়) <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_rbs_bn_' + x + '_status">\n' +
            '                <input type="text" name="permanent_rbs_bn[]" id="permanent_rbs_bn_' + x + '" class="form-control" autofocus data-parsley-maxlength="100" data-parsley-trigger="keyup" />\n' +
            '                <span class="bt-flabels__error-desc">রোড/ব্লক/সেক্টর দিন বাংলায়....</span>\n' +
            '                <span id="permanent_rbs_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="permanent_holding_no_' + x + '" class="col-sm-3 control-label">হোল্ডিং নং <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_holding_no_' + x + '_status">\n' +
            '                <input type="text" name="permanent_holding_no[]" id="permanent_holding_no_' + x + '" autofocus class="form-control" data-parsley-type="number" data-parsley-trigger="keyup" />\n' +
            '                <span class="bt-flabels__error-desc">হোল্ডিং নং দিন ইংরেজিতে....</span>\n' +
            '                <span id="permanent_holding_no_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="permanent_ward_no_' + x + '" class="col-sm-3 control-label">ওয়ার্ড নং <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_ward_no_' + x + '_status">\n' +
            '                <input type="text" name="permanent_ward_no[]" id="permanent_ward_no_' + x + '" class="form-control" autofocus data-parsley-type="number" data-parsley-trigger="keyup"/>\n' +
            '                <span class="bt-flabels__error-desc">ওয়ার্ড নং দিন ইংরেজিতে....</span>\n' +
            '                <span id="permanent_ward_no_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="permanent_district_id_' + x + '" class="col-sm-3 control-label">জেলা <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_district_id_' + x + '_status">\n' +
            '                <select onchange="getLocation($(this).val(), \'permanent_district_' + x + '\', \'permanent_upazila_append_' + x + '\', \'permanent_upazila_id_' + x + '\', \'permanent_upazila_' + x + '\', 3 )" name="permanent_district_id[]" id="permanent_district_id_' + x + '" class="form-control" data-parsley-required >\n' +
            '                    <option value="" class="district_append" id="permanent_district_append_' + x + '">-আপনার জেলা নির্বাচন করুন-</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">জেলা নির্বাচন করুন....</span>\n' +
            '                <span id="permanent_district_id_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '            <label for="permanent_district_' + x + '" class="col-sm-3 control-label">জেলা</label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <input type="text" disabled id="permanent_district_' + x + '" value="জেলা" class="form-control" placeholder=""/>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="permanent_upazila_id_' + x + '" class="col-sm-3 control-label">উপজেলা/থানা <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_upazila_id_' + x + '_status">\n' +
            '                <select onchange="getLocation($(this).val(), \'permanent_upazila_' + x + '\', \'permanent_post_office_append_' + x + '\', \'permanent_postoffice_id_' + x + '\', \'permanent_postoffice_' + x + '\', 6 )" name="permanent_upazila_id[]" id="permanent_upazila_id_' + x + '" class="form-control" data-parsley-required >\n' +
            '                    <option value="" id="permanent_upazila_append_' + x + '">চিহ্নিত করুন</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">উপজেলা/থানা নির্বাচন করুন....</span>\n' +
            '                <span id="permanent_upazila_id_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '\n' +
            '            <label for="permanent_upazila_' + x + '" class="col-sm-3 control-label">উপজেলা/থানা</label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <input type="text" disabled id="permanent_upazila_' + x + '" value="উপজেলা/থানা" class="form-control" placeholder=""/>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12">\n' +
            '        <div class="row form-group">\n' +
            '            <label for="permanent_postoffice_id_' + x + '" class="col-sm-3 control-label">পোষ্ট অফিস <span>*</span></label>\n' +
            '            <div class="col-sm-3 bt-flabels__wrapper" id="permanent_postoffice_id_' + x + '_status">\n' +
            '                <select onchange="getLocation($(this).val(), \'permanent_postoffice_' + x + '\')" name="permanent_postoffice_id[]" id="permanent_postoffice_id_' + x + '" class="form-control" data-parsley-required >\n' +
            '                    <option value="" id="permanent_post_office_append_' + x + '">চিহ্নিত করুন</option>\n' +
            '                </select>\n' +
            '                <span class="bt-flabels__error-desc">পোষ্ট অফিস নির্বাচন করুন....</span>\n' +
            '                <span id="permanent_postoffice_id_' + x + '_feedback" class="help-block"></span>\n' +
            '            </div>\n' +
            '\n' +
            '            <label for="permanent_postoffice_' + x + '" class="col-sm-3 control-label">পোষ্ট অফিস</label>\n' +
            '            <div class="col-sm-3">\n' +
            '                <input type="text" disabled id="permanent_postoffice_' + x + '" value="পোষ্ট অফিস" class="form-control" placeholder=""/>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>');

        $('#owner-tab-link-' + x).addClass('active');
        $('#owner-tab-' + x).addClass('active in');

        $.ajax({
            type: 'GET',
            url: loc + '/api/geo/code',
            beforeSend: function () { $('#overlay').show(); },
            complete: function () { $('#overlay').fadeOut(); },
            success: function (data) {
                $("#present_district_append_" + x).after(data);
                $("#permanent_district_append_" + x).after(data);
            }
        });
    }

    $("form").submit(function (e) {
        let x = $('#owner-plus-btn').val();
        let nidError = '';
        for (var i = 0; i <= x;) {
            let nid = $('#nid_' + i).val();
            let birth = $('#birth_id_' + i).val();

            if (nid === '' && birth === '') {
                var z = en2bn(Number(i) + 1);
                $('#nid_' + i + '_status').addClass('has-error has-feedback');
                $('#birth_id_' + i + '_status').addClass('has-error has-feedback');
                nidError += z + ', ';
            }
            i++;
        }

        if (nidError != '') {
            $('#national-id-error').html('<span class="text-danger"><i class="ion-ios-star"></i> অনুগ্রহ করে মালিক ' + nidError + ' এর ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং দিন ইংরেজিতে....</span>');
            return false;
        } else {
            let route = $('#form-data').data('route');



            let formData = new FormData($("#form-data")[0]);
            let owners = $('#owner-plus-btn').val();
            for (var i = 0; i <= owners;) {
                $.each($('#cropzee-input_' + i)[0].files, function (i, file) {
                    formData.append('file[' + i + '][]', file);
                });
                i++;
            }

            let a = 0;
            $.each($('#form-data').serializeArray(), function (i, field) {
                let name = field.name;
                let targetData = name.split('');
                let z = $.inArray("[", targetData);
                if (!($.inArray("[", targetData) < 0) && !($.inArray("]", targetData) < 0)) {
                    name = name.substr(0, z);
                    $('#' + name + '_' + a + '_status').removeClass('has-error has-feedback');
                    $('#' + name + '_' + a + '_feedback').text('');
                    a++;
                } else {
                    $('#' + name + '_status').removeClass('has-error has-feedback');
                    $('#' + name + '_feedback').text('');
                }
            });

            $.ajax({
                type: 'POST',
                url: route,
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 60000,
                beforeSend: function(){
                    $('[type="submit"]').attr('disabled','disabled');
                    $('<img id="loading_gif" src="' + path + '/public/assets/images/loding.gif" alt="loding.gif" style="position: relative;height: 50px;"></img>').insertAfter('[type="submit"]');
                },
                success: function (res) {

                    if (res.niderror) {
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: res.niderror,
                            confirmButtonText: 'ঠিক আছে'
                        });
                    } else if (res.success) {
                        Swal.fire({
                            title: '<strong>' + res.success + '</strong>',
                            icon: 'success',
                            html    : 'আপনার পিন নং <b>'+res.pin+'</b>, এবং ট্র্যাকিং নং <b>'+res.tracking+
                              '</b> <br/> <a href="'+path+'/verify/'+res.application+'/'+res.tracking+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a>',
                            showConfirmButton: true,
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonText:
                              '<i class="fa fa-print-up"></i> ঠিক আছে!',
                            confirmButtonAriaLabel: 'ঠিক আছে!'


                            // html: res.message + '</b>',
                            // showConfirmButton: true,
                            // showCancelButton: false,
                            // focusConfirm: false,
                            // confirmButtonText: '<a href="' + path + '/verify/' + res.application + '/' + res.tracking + '/' + res.unionid + '/' + res.type + '" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a>' + '<i class="fa fa-print-up"></i> ঠিক আছে!',
                            // confirmButtonAriaLabel: 'ঠিক আছে!'
                        }).then(function () {
                            location.reload(true);
                        });



                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: 'আবেদন সম্পূর্ণ হয়নি!',
                            confirmButtonText: 'ঠিক আছে'
                        });
                    }
                },
                error: function showErrorMessage(xhr, status, error) {
                    $('[type="submit"]').removeAttr('disbaled');
                    $('#loading_gif').remove();

                    if (!($.isEmptyObject(xhr.responseText))) {
                        let jsonResponseText = $.parseJSON(xhr.responseText);
                        let message = jsonResponseText.message;
                        let errors = jsonResponseText.errors;
                        let data = '';
                        $.each(errors, function (name, val) {
                            let targetData = name.split('');
                            let z = $.inArray(".", targetData);
                            if (!($.inArray(".", targetData) < 0) && !($.inArray(".", targetData) < 0)) {
                                name = name.substr(0, z);
                                $('#' + name + '_' + targetData[(z + 1)] + '_status').removeClass('has-error has-feedback');
                                $('#' + name + '_' + targetData[(z + 1)] + '_feedback').text(val);
                            } else {
                                $('#' + name + '_status').addClass('has-error has-feedback');
                                $('#' + name + '_feedback').text(val);
                            }

                        });
                    }
                }
            });

            e.preventDefault();

        }
    });

});

//get geo location
function getLocation(parentId, selectId = null, targetId = null, thanId = null, thanViewId = null, type = null) {

    let loc = $('meta[name=url]').attr("content");

    let nam = '';
    if (type == 3) {
        nam = 'উপজেলা/থানা';
    } else {
        nam = 'পোস্ট অফিস';
    }

    $.ajax({
        type: 'GET',
        url: loc + '/geo/code/get',
        data: { 'id': parentId, 'type': type },
        success: function (data) {

            $("#" + thanViewId).val(nam);
            $("#" + selectId).val(data.name);
            $("#" + thanId).html('<option value="" id="' + targetId + '">চিহ্নিত করুন</option>');

            data.upzilla.forEach(el => {
                $("#" + targetId).after("<option value='" + el.id + "'>" + el.en_name + "</option>");
            });
        },
        error: function (e) {
            alert('error occur');
            console.log(e);

        }
    });
}
