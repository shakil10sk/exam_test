$(document).ready(function () {
    let x = 0;
    let loc = $('meta[name=path]').attr("content");
    let path = $('meta[name=url]').attr("content");
    let TypeApplication = ['nagorik', 'death', 'obibahito', 'punobibaho', 'ekoinam', 'sonaton', 'prottyon', 'nodibanga', 'character', 'vumihin', 'yearlyincome', 'protibondi', 'onumoti', 'voter', 'onapotti', 'rastakhonon', 'warish', 'family', 'trade', 'bibahito'];
    let nagorikPin = '';
    let nagorikPhoto = '';
    let motherNameEn = '';
    let motherNameBn = '';
    let fatherNameEn = '';
    let fatherNameBn = '';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $.ajax({
    //     type:'GET',
    //     url:loc+'/api/geo/code',
    //     beforeSend: function() { $('#overlay').show(); },
    //     complete: function() { $('#overlay').fadeOut(); },
    //     success: function (data) {
    //         $(".district_append").after(data);
    //     }
    // });

    $('#marital_status').change(function () {
        var mstatus = $(this).val();
        var gender = $("input[name='gender']:checked").val();
        if (typeof (gender) === 'undefined') {
            gender = '';
        }
        checkStatus(mstatus, gender);
    });


    $("input[name='gender']").click(function () {
        var gender = $("input[name='gender']:checked").val();
        var mstatus = $("#marital_status").val();
        checkStatus(mstatus, gender);
    });

    $('#permanentBtn').click(function () {
        if ($(this).is(":checked")) {
            insertAddress();
        } else if ($(this).is(":not(:checked)")) {
            emptyAddress();
        }
    });

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
                data: {searchData: searchData, applicationType: applicationType, unionId: unionId},
                success: function (res) {
                    // console.log(res);
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
                        if (res[1]['gender'] == 1 && res[1]['marital_status'] == 2) {
                            $('#wife').show();
                            $('#wife_name_bn').attr('required', 'required');
                            $('#husband').hide();
                            $('#husband_name_bn').removeAttr('required');
                            $('#husband_name_en').val('');
                            $('#husband_name_bn').val('');
                        } else if (res[1]['gender'] == 2 && res[1]['marital_status'] == 2) {
                            $('#husband').show();
                            $('#husband_name_bn').attr('required', 'required');
                            $('#wife').hide();
                            $('#wife_name_bn').removeAttr('required');
                            $('#wife_name_en').val('');
                            $('#wife_name_bn').val('');
                        }
                        $.each(res[0], function (name, val) {
                            $('#' + name).val(val);
                            $('#' + name).prop('disabled', true);
                        });

                        nagorikPin = res[0]['pin'];
                        motherNameEn = res[0]['mother_name_en'];
                        motherNameBn = res[0]['mother_name_bn'];
                        fatherNameEn = res[0]['father_name_en'];
                        fatherNameBn = res[0]['father_name_bn'];
                        nagorikPhoto = res[1]['photo'];
                        let appType = $('#web').val();


                        $('#form-data').attr('data-route', loc + '/api/' + TypeApplication[Number(appType) - 1]);

                        $("#gender_" + res[1]['gender']).attr('checked', true);
                        $(".gender").attr('disabled', true);
                        $(".wrap").css('opacity', '.2');

                        $('#marital_status').val(res[1]['marital_status']);

                        $('#wife_name_en').val(res[1]['wife_name_en']);
                        $('#wife_name_bn').val(res[1]['wife_name_bn']);

                        $('#husband_name_en').val(res[1]['husband_name_en']);
                        $('#husband_name_bn').val(res[1]['husband_name_bn']);


                        $('#present_village_en').val(res[1]['present_village_en']);
                        $('#present_village_bn').val(res[1]['present_village_bn']);


                        $('#present_rbs_en').val(res[1]['present_rbs_en']);
                        $('#present_rbs_bn').val(res[1]['present_rbs_bn']);

                        $('#present_holding_no').val(res[1]['present_holding_no']);
                        $('#present_ward_no').val(res[1]['present_ward_no']);

                        $('#present_district_id').val(res[1]['present_district_id']);
                        $('#present_district').val(res[1]['present_district_name_bn']);

                        $('#present_upazila_id').html('<option value="' + res[1]['present_upazila_id'] + '" selected="selected">' + res[1]['present_upazila_name_en'] + '</option>');
                        $('#present_upazila').val(res[1]['present_upazila_name_bn']);

                        $('#present_postoffice_id').html('<option value="' + res[1]['present_postoffice_id'] + '" selected="selected">' + res[1]['present_postoffice_name_en'] + '</option>');
                        $('#present_postoffice').val(res[1]['present_postoffice_name_bn']);

                        $('#addressCheck').remove();

                        $('#permanent_district_id').val(res[1]['permanent_district_id']);
                        $('#permanent_district_id').prop('disabled', true);
                        $('#permanent_district').val(res[1]['permanent_district_name_bn']);

                        $('#permanent_upazila_id').html('<option value="' + res[1]['permanent_upazila_id'] + '" selected="selected">' + res[1]['permanent_upazila_name_en'] + '</option>');
                        $('#permanent_upazila_id').prop('disabled', true);
                        $('#permanent_upazila').val(res[1]['permanent_upazila_name_bn']);

                        $('#permanent_postoffice_id').html('<option value="' + res[1]['permanent_postoffice_id'] + '" selected="selected">' + res[1]['permanent_postoffice_name_en'] + '</option>');
                        $('#permanent_postoffice_id').prop('disabled', true);
                        $('#permanent_postoffice').val(res[1]['permanent_postoffice_name_bn']);
                    }

                },
                error: (e) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত...',
                        text: 'দুঃখিত! সার্ভার উপলব্ধ নয়।',
                        confirmButtonText: 'ঠিক আছে'
                    });
                }
            });
        }

        function sweetAlert(status, info) {
            Swal.fire({
                title: '<strong>' + status + '</strong>',
                icon: 'warning',
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


    $(":input").change(function (e) {
        let field = $(this).attr('id');
        $('#' + field + '_status').removeClass('has-error has-feedback');
        $('#' + field + '_feedback').text('');

        motherNameEn = $('#mother_name_en').val();
        motherNameBn = $('#mother_name_bn').val();
        fatherNameEn = $('#father_name_en').val();
        fatherNameBn = $('#father_name_bn').val();
        e.preventDefault();
    });

    $("#form-data").submit(function (e) {


        // console.log("i am bug");
        // return false;

        let nid = $('#nid').val();
        let birth = $('#birth_id').val();
        let passport = $('#passport_no').val();

        // if (nid == '' && birth == '' && passport == '') {
        //     $('#passport_no_status').addClass('has-error has-feedback');
        //     $('#birth_id_status').addClass('has-error has-feedback');
        //     $('#nid_status').addClass('has-error has-feedback');
        //     $('#national_id_error').html('<span class="text-danger"><i class="ion-ios-star"></i> অনুগ্রহ করে ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং দিন ইংরেজিতে....</span>');
        //     return false;
        // } else {
            let route = $('#form-data').data('route');
            let formData = new FormData($("#form-data")[0]);

            formData.append('is_photo', nagorikPhoto);
            formData.append('pin', nagorikPin);
            formData.append('mother_name_en', motherNameEn);
            formData.append('mother_name_bn', motherNameBn);
            formData.append('father_name_en', fatherNameEn);
            formData.append('father_name_bn', fatherNameBn);

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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "APP_KEY": "base64:alhMdEOy2QKNdP2oI0o3ModIcR1QGJXvD0oGk18Yw5g="
                }
            });

            // console.log(formData);
            // return false;

            $.ajax({
                type: 'POST',
                url: route,
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 60000,
                beforeSend: function () {
                    $('[type="submit"]').attr('disabled', 'disabled');
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
                            html: 'আপনার পিন নং <b>' + res.pin + '</b>, এবং ট্র্যাকিং নং <b>' + res.tracking +
                                '</b> <a href="' + path + '/verify/' + res.application + '/' + res.tracking + '/' + res.unionid + '/' + res.type + '" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a> ',
                            showConfirmButton: true,
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonText:
                                '<i class="fa fa-print-up"></i> ঠিক আছে!',
                            confirmButtonAriaLabel: 'ঠিক আছে!'
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
                    $('[type="submit"]').removeAttr('disabled');
                    $('#loading_gif').remove();

                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত...',
                        text: 'আবেদন সম্পূর্ণ হয়নি!',
                        confirmButtonText: 'ঠিক আছে'
                    });

                    $('[type="submit"]').removeAttr('disabled');

                    if (xhr.responseText) {
                        let jsonResponseText = JSON.parse(xhr.responseText);
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
        // }
    });

    $("input[name='is_father_alive']").click(function () {
        var live = $("input[name='is_father_alive']:checked").val();
        var id = 'father';
        showHidden(live, id);
    });
    $("input[name='is_mother_alive']").click(function () {
        var live = $("input[name='is_mother_alive']:checked").val();
        var id = 'mother';
        showHidden(live, id);
    });

    $('#warish').click(function () {
        if ($.trim($('#warish_name_bn_0').val()) == '' || $.trim($('#relation_bn_0').val()) == '') {
            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! ওয়ারিশের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        } else {
            x++;
            var woyarish_name_bn = $('#warish_name_bn_0').val();
            var woyarish_name_en = $('#warish_name_en_0').val();
            var relation_bn = $('#relation_bn_0').val();
            var relation_en = $('#relation_en_0').val();
            var relation_age = $('#relation_age_0').val();
            var member_nid = $('#member_nid_0').val();
            var member_father_name_bn = $('#member_father_name_bn_0').val();
            var member_father_name_en = $('#member_father_name_en_0').val();
            var member_mother_name_bn = $('#member_mother_name_bn_0').val();
            var member_mother_name_en = $('#member_mother_name_en_0').val();
            var present_address_bn = $('#present_address_bn_0').val();
            var present_address_en = $('#present_address_en_0').val();
            var permanent_address_bn = $('#permanent_address_bn_0').val();
            var permanent_address_en = $('#permanent_address_en_0').val();

            $('#emptyError').html('');
            addRow(x, woyarish_name_bn, woyarish_name_en, relation_bn, relation_en, relation_age, member_nid, member_father_name_bn,member_father_name_en, member_mother_name_bn, member_mother_name_en, present_address_bn, present_address_en, permanent_address_bn, permanent_address_en);
        }
    });

    $('#warish_name_bn_0').keyup(function () {
        if ($.trim($('#relation_bn_0').val()) == '') {
            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! ওয়ারিশের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        } else {
            $('#emptyError').html('');
        }
    });

    $('#relation_bn.0').keyup(function () {
        if ($.trim($('#warish_name_bn_0').val()) == '') {
            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! ওয়ারিশের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        } else {
            $('#emptyError').html('');
        }
    });

    /*Check gender info*/
    function checkStatus(mstatus, gender) {
        if (gender == '') {
            $('#genderErr').css({"border": '1px solid red', "border-radius": '4px', "padding-top": '10px'});
            $('#gender_status').append('<label class="text-danger errMess">\n' +
                '        অনুগ্রহ করে লিঙ্গ নির্বাচন করুন\n' +
                '      </label>');
        } else if (mstatus == 2 && gender == 1) {
            $('#wife').show();
            $('#wife_name_bn').attr('required', 'required');
            $('#husband').hide();
            $('#husband_name_bn').removeAttr('required');
            $('#husband_name_en').val('');
            $('#husband_name_bn').val('');
            $('#genderErr').removeAttr("style");
            $('.errMess').hide();
        } else if (mstatus == 2 && gender == 2) {
            $('#wife').hide();
            $('#wife_name_bn').removeAttr('required');
            $('#wife_name_en').val('');
            $('#wife_name_bn').val('');
            $('#husband').show();
            $('#husband_name_bn').attr('required', 'required');
            $('#genderErr').removeAttr("style");
            $('.errMess').hide();
        } else {
            $('#wife_name_en').val('');
            $('#wife_name_bn').val('');
            $('#wife_name_bn').removeAttr('required');
            $('#husband_name_en').val('');
            $('#husband_name_bn').val('');
            $('#husband_name_bn').removeAttr('required');
            $('#wife').hide();
            $('#husband').hide();
            $('#genderErr').removeAttr("style");
            $('.errMess').hide();
        }
    };

    /*Present address and permanent address sync*/
    let district = '';

    function insertAddress() {
        district = $('#permanent_district_id').html();

        $('#permanent_village_bn').val($('#present_village_bn').val());
        $('#permanent_rbs_bn').val($('#present_rbs_bn').val());


        $('#permanent_village_en').val($('#present_village_en').val());
        $('#permanent_rbs_en').val($('#present_rbs_en').val());
        $('#permanent_holding_no').val($('#present_holding_no').val());
        $('#permanent_ward_no').val($('#present_ward_no').val());

        $('#permanent_district_id').html('<option value="' + $('#present_district_id').val() + '" selected="selected">' + $('#present_district_id option:selected').text() + '</option>');
        $('#permanent_district').val($('#present_district').val());

        $('#permanent_upazila_id').html('<option value="' + $('#present_upazila_id').val() + '" selected="selected">' + $('#present_upazila_id option:selected').text() + '</option>');
        $('#permanent_upazila').val($('#present_upazila').val());

        $('#permanent_postoffice_id').html('<option value="' + $('#present_postoffice_id').val() + '" selected="selected">' + $('#present_postoffice_id option:selected').text() + '</option>');
        $('#permanent_postoffice').val($('#present_postoffice').val());
    }

    function emptyAddress() {
        $('#permanent_village_bn').val('');
        $('#permanent_rbs_bn').val('');
        $('#permanent_village_en').val('');
        $('#permanent_rbs_en').val('');
        $('#permanent_holding_no').val('');
        $('#permanent_ward_no').val('');

        $('#permanent_district_id').html(district);
        $('#permanent_district').val('জেলা');

        $('#permanent_upazila_id').html('<option value="" id="permanent_upazila_append">চিহ্নিত করুন</option>');
        $('#permanent_upazila').val('উপজেলা/থানা');

        $('#permanent_postoffice_id').html('<option value="" id="permanent_post_office_append">চিহ্নিত করুন</option>');
        $('#permanent_postoffice').val('পোস্ট অফিস');
    }

    /*Father and mother years row show or hidden*/
    var fage = '';
    var mage = '';

    function showHidden(live, id) {
        if (id == 'father') {
            if (live == 0) {
                fage = $('#father_age').val();
                $('#father_age').hide();
                $('#father_age').val('');
                $('#father_age').removeAttr('required');
            } else {
                $('#father_age').show();
                $('#father_age').val(fage);
                $('#father_age').attr('required', 'required');
            }
        } else {
            if (live == 0) {
                mage = $('#mother_age').val();
                $('#mother_age').hide();
                $('#mother_age').val('');
                $('#mother_age').removeAttr('required');
            } else {
                $('#mother_age').show();
                $('#mother_age').val(mage);
                $('#mother_age').attr('required', 'required');
            }
        }

    }

    /*add woyarisher taliika*/
    function addRow(x, woyarish_name_bn, woyarish_name_en, relation_bn, relation_en, relation_age, member_nid, member_father_name_bn,member_father_name_en, member_mother_name_bn, member_mother_name_en, present_address_bn, present_address_en, permanent_address_bn, permanent_address_en) {
        $('#warish_name_bn_0').val('');
        $('#warish_name_en_0').val('');
        $('#relation_bn_0').val('');
        $('#relation_en_0').val('');
        $('#relation_age_0').val('');
        $('#member_nid_0').val('');
        // $('#member_father_name_bn_0').val('');
        // $('#member_father_name_en_0').val('');
        // $('#member_mother_name_bn_0').val('');
        // $('#member_mother_name_en_0').val('');
        // $('#present_address_bn_0').val('');
        // $('#present_address_en_0').val('');
        // $('#permanent_address_bn_0').val('');
        // $('#permanent_address_en_0').val('');

        $('#addWoyarish').append('<div class="col-sm-12" id="dataRow_' + x + '">\n' +
            '    <div class="row form-group">\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper" id="warish_name_bn_' + x + '_status">\n' +
            '            <input type="text" name="warish_name_bn[]" value="' + woyarish_name_bn + '" id="warish_name_bn_' + x + '" class="form-control" placeholder="নাম বাংলায়"/>\n' +
            '            <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>\n' +
            '            <span id="warish_name_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper" id="warish_name_en_' + x + '_status">\n' +
            '            <input type="text" name="warish_name_en[]" value="' + woyarish_name_en + '" id="warish_name_en_' + x + '" class="form-control" placeholder="নাম ইংরেজিতে" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
            '            <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>\n' +
            '            <span id="warish_name_en_' + x + '_feedback" class="help-block"></span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper" id="relation_bn_' + x + '_status">\n' +
            '            <input type="text" name="relation_bn[]" value="' + relation_bn + '" id="relation_bn_' + x + '" class="form-control"  placeholder="সম্পর্ক বাংলায়"/>\n' +
            '            <span class="bt-flabels__error-desc">সম্পর্ক দিন বাংলায়....</span>\n' +
            '            <span id="relation_bn_' + x + '_feedback" class="help-block"></span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper" id="relation_en_' + x + '_status">\n' +
            '            <input type="text" name="relation_en[]" value="' + relation_en + '" id="relation_en_' + x + '" class="form-control" placeholder="সম্পর্ক ইংরেজিতে" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
            '            <span class="bt-flabels__error-desc">সম্পর্ক দিন ইংরেজিতে....</span>\n' +
            '            <span id="relation_en_' + x + '_feedback" class="help-block"></span>\n' +
            '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="relation_age_' + x + '_status">\n' +
            // '            <input type="text" name="relation_age[]" value="' + relation_age + '" id="ralation_age_' + x + '" class="form-control" data-parsley-type="number" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">বয়স দিন ইংরেজিতে....</span>\n' +
            // '            <span id="relation_age_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper" id="member_nid' + x + '_status">\n' +
            '            <input type="text" name="member_nid[]" value="' + member_nid+ '" id="member_nid' + x + '" class="form-control"/>\n' +
            '            <span class="bt-flabels__error-desc">জন্ম তারিখ দিন.....</span>\n' +
            '            <span id="member_nid' + x + '_feedback" class="help-block"></span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper" id="member_father_name_bn_' + x + '_status">\n' +
            // '            <lable>পিতার নাম (বাংলায়)</lable>\n'+
            // '            <input type="text" name="member_father_name_bn[]" value="' + member_father_name_bn + '" id="member_father_name_bn_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">পিতার নাম বাংলায়....</span>\n' +
            // '            <span id="member_father_name_bn_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="member_father_name_en_' + x + '_status">\n' +
            // '            <lable>পিতার নাম (ইংরেজীতে)</lable>\n'+
            // '            <input type="text" name="member_father_name_en[]" value="' + member_father_name_en + '" id="member_father_name_en_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">পিতার নাম ইংরেজীতে....</span>\n' +
            // '            <span id="member_father_name_en_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="member_mother_name_bn_' + x + '_status">\n' +
            // '            <lable>মাতার নাম (বাংলায়)</lable>\n'+
            // '            <input type="text" name="member_mother_name_bn[]" value="' + member_mother_name_bn + '" id="member_mother_name_bn_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">মাতার নাম বাংলায়....</span>\n' +
            // '            <span id="member_mother_name_bn_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="member_mother_name_en_' + x + '_status">\n' +
            // '            <lable>মাতার নাম (ইংরেজীতে)</lable>\n'+
            // '            <input type="text" name="member_mother_name_en[]" value="' + member_mother_name_en + '" id="member_mother_name_en_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">মাতার নাম ইংরেজীতে....</span>\n' +
            // '            <span id="member_mother_name_en_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="present_address_bn_' + x + '_status">\n' +
            // '            <lable>বর্তমান ঠিকানা (বাংলায়)</lable>\n'+
            // '            <input type="text" name="present_address_bn[]" value="' + present_address_bn + '" id="present_address_bn_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">বর্তমান ঠিকানা বাংলায়....</span>\n' +
            // '            <span id="present_address_bn_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="present_address_en_' + x + '_status">\n' +
            // '            <lable>বর্তমান ঠিকানা (ইংরেজীতে)</lable>\n'+
            // '            <input type="text" name="present_address_en[]" value="' + present_address_en + '" id="present_address_en_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">বর্তমান ঠিকানা ইংরেজীতে....</span>\n' +
            // '            <span id="present_address_en_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="permanent_address_bn_' + x + '_status">\n' +
            // '            <lable>স্থায়ী ঠিকানা (বাংলায়)</lable>\n'+
            // '            <input type="text" name="permanent_address_bn[]" value="' + permanent_address_bn + '" id="permanent_address_bn_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">স্থায়ী ঠিকানা বাংলায়....</span>\n' +
            // '            <span id="permanent_address_bn_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            // '        <div class="col-sm-2 bt-flabels__wrapper" id="permanent_address_en_' + x + '_status">\n' +
            // '            <lable>স্থায়ী ঠিকানা (ইংরেজীতে)</lable>\n'+
            // '            <input type="text" name="permanent_address_en[]" value="' + permanent_address_en + '" id="permanent_address_en_' + x + '" class="form-control" data-parsley-trigger="keyup"/>\n' +
            // '            <span class="bt-flabels__error-desc">স্থায়ী ঠিকানা ইংরেজীতে....</span>\n' +
            // '            <span id="permanent_address_en_' + x + '_feedback" class="help-block"></span>\n' +
            // '        </div>\n' +
            '        <div class="col-sm-2" style="margin-top: 22px">\n' +
            '            <button type="button" class="btn btn-warning" onclick="removeRow(' + x + ')">মুছে ফেলুন</button>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>');
    }

});

//get geo location
function getLocation(parentId, selectId = null, targetId = null, thanId = null, thanViewId = null, type = null) {

    let web_loc = $('meta[name=url]').attr("content");
    let nam = '';
    if (type == 3) {
        nam = 'উপজেলা/থানা';
    } else {
        nam = 'পোস্ট অফিস';
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'get',
        url: web_loc + '/geo/code/get',
        data: {'id': parentId, 'type': type},
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
