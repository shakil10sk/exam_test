$(document).ready(function() {
    let x = 0;
    let loc = $('meta[name=path]').attr("content");
    let TypeApplication  = ['nagorik', 'death', 'obibahito', 'punobibaho', 'ekoinam', 'sonaton', 'prottyon', 'nodibanga', 'character', 'vumihin', 'yearlyincome', 'protibondi', 'onumoti', 'voter', 'onapotti', 'rastakhonon', 'warish', 'family', 'trade', 'bibahito'];

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

    $('#mapBtn').click(function(){
        let googleMap = $('#googleMap').val();
        if(googleMap == ''){
            $('#warning-modal').modal('show');
        }else{
            $.ajax({
                type:'POST',
                url:loc+'/union/setup/google/map',
                beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
                complete: function() { $('.pre-loader').fadeOut(); },
                data:{key : googleMap},
                success: function (data) {
                    $('#map').html(data);
                }
            });
        }
    });


    $('#marital_status').change(function () {
        var mstatus = $(this).val();
        var gender = $("input[name='gender']:checked").val();
        if (typeof (gender) === 'undefined'){
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
        if($(this).is(":checked")){
            insertAddress();
        }
        else if($(this).is(":not(:checked)")){
            emptyAddress();
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
        $.ajax({
            type:'POST',
            url:loc+'/api/check/exiting/application',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },
            data:{searchData:searchData, applicationType: applicationType, unionId:unionId},
            success: function (res) {

                console.log(res);

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
                    if(res[1]['gender'] == 1 && res[1]['marital_status'] == 2){
                        $('#wife').show();
                        $('#wife_name_bn').attr('required', 'required');
                        $('#husband').hide();
                        $('#husband_name_bn').removeAttr('required');
                        $('#husband_name_en').val('');
                        $('#husband_name_bn').val('');
                    }else if(res[1]['gender'] == 2 && res[1]['marital_status'] == 2){
                        $('#husband').show();
                        $('#husband_name_bn').attr('required', 'required');
                        $('#wife').hide();
                        $('#wife_name_bn').removeAttr('required');
                        $('#wife_name_en').val('');
                        $('#wife_name_bn').val('');
                    }
                    $.each(res[0], function(name, val) {
                        $('#'+name).val(val);
                        $('#'+name).prop('disabled', true);
                    });

                    let appType     = $('#app-type').val();
                    $('#nagorik-pin').val(res[0]['pin']);

                    $('#father-name-en').val(res[0]['father_name_en']);
                    $('#father-name-bn').val(res[0]['father_name_bn']);
                    $('#mother-name-en').val(res[0]['mother_name_en']);
                    $('#mother-name-bn').val(res[0]['mother_name_bn']);

                    $('#form-data').attr('action', loc+'/'+TypeApplication[Number(appType)-1]);

                    $(".image").attr('src', loc+'/assets/images/application/'+res[1]['photo']);

                    $("#gender_"+res[1]['gender']).attr('checked', true);
                    $(".gender").attr('disabled', true);
                    $(".wrap").css('opacity', '.2');

                    $('#marital_status').val(res[1]['marital_status']);
                    $('#sonaton').val(res[0]['religion']);

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


                    // $('#present_district_id').append('<option value="'+res[1]['present_district_id']+'" selected="selected">'+res[1]['present_district_name_en']+'</option>');

                    // $('#present_district_id').val(res.data.present_district_id);
                    // $('#present_district_txt').val(res.data.present_district_name_en);

                    $('#present_district_txt').val(res[1]['present_district_name_en']);
                    $('#present_district_id').val(res[1]['present_district_id']);

                    $('#present_district').val(res[1]['present_district_name_bn']);


                    $('#present_upazila_id').html('<option value="'+res[1]['present_upazila_id']+'" selected="selected">'+res[1]['present_upazila_name_en']+'</option>');
                    $('#present_upazila').val(res[1]['present_upazila_name_bn']);

                    $('#present_postoffice_id').html('<option value="'+res[1]['present_postoffice_id']+'" selected="selected">'+res[1]['present_postoffice_name_en']+'</option>');
                    $('#present_postoffice').val(res[1]['present_postoffice_name_bn']);

                    $('#addressCheck').remove();

                    $('#permanent_district_id').append('<option value="'+res[1]['permanent_district_id']+'" selected="selected">'+res[1]['permanent_district_name_en']+'</option>');
                    $('#permanent_district_id').prop('disabled', true);
                    $('#permanent_district').val(res[1]['permanent_district_name_bn']);

                    $('#permanent_upazila_id').html('<option value="'+res[1]['permanent_upazila_id']+'" selected="selected">'+res[1]['permanent_upazila_name_en']+'</option>');
                    $('#permanent_upazila_id').prop('disabled', true);
                    $('#permanent_upazila').val(res[1]['permanent_upazila_name_bn']);

                    $('#permanent_postoffice_id').html('<option value="'+res[1]['permanent_postoffice_id']+'" selected="selected">'+res[1]['permanent_postoffice_name_en']+'</option>');
                    $('#permanent_postoffice_id').prop('disabled', true);
                    $('#permanent_postoffice').val(res[1]['permanent_postoffice_name_bn']);
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

    $("form").submit(function(){
        var nid = $('#nid').val();
        var birth = $('#birth_id').val();
        var passport = $('#passport_no').val();

        // console.log(nid);
        // console.log(birth);
        // console.log(passport);
        // return false;

        if (nid === '' && birth === '' && passport === ''){
            $('#passport_no').addClass('is-invalid');
            $('#birth_id').addClass('is-invalid');
            $('#nid').addClass('is-invalid');
            $('#national_id_error').html('<span class="text-danger"><i class="ion-ios-star"></i> অনুগ্রহ করে ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং দিন ইংরেজিতে....</span>');
            return false;
        }else {
            return true;
        }
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

    $('#woyarish').click(function () {

        if ($.trim($('#warish_name_bn').val()) == '' || $.trim($('#relation_bn').val()) == ''){
            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! ওয়ারিশের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        }else {
            x++;
            var warish_name_bn   = $('#warish_name_bn').val();
            var warish_name_en   = $('#warish_name_en').val();
            var relation_bn      = $('#relation_bn').val();
            var relation_en      = $('#relation_en').val();
            var member_nid     = $('#member_nid').val();

            $('#emptyError').html('');
            addRow(x, warish_name_bn, warish_name_en, relation_bn, relation_en, member_nid);
        }
    });

    $('#warish_name_bn').keyup(function () {
        if ($.trim($('#relation_bn').val()) == '') {
            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! ওয়ারিশের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        }else {
            $('#emptyError').html('');
        }
    });

    $('#relation_bn').keyup(function () {
        if ($.trim($('#warish_name_bn').val()) == '') {
            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! ওয়ারিশের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        }else {
            $('#emptyError').html('');
        }
    });

    //this is for family member append

    $('#family').click(function () {

        console.log("hello"); return;

        if ($.trim($('#warish_name_bn').val()) == '' || $.trim($('#relation_bn').val()) == ''){

            $('#emptyError').html('<span class="text-center text-danger">দু:খিত! সদস্যদের অবশ্যই বাংলায় নাম এবং সম্পর্ক দিতে হবে ।</span>');
        }else {

            x++;
            var warish_name_bn   = $('#warish_name_bn').val();
            var warish_name_en   = $('#warish_name_en').val();
            var relation_bn      = $('#relation_bn').val();
            var relation_en      = $('#relation_en').val();
            var member_nid     = $('#member_nid').val();

            console.log(warish_name_bn);
            console.log(warish_name_en);
            console.log(relation_bn);
            console.log(relation_en);
            console.log(member_nid);

            $('#emptyError').html('');

            addRow(x, warish_name_bn, warish_name_en, relation_bn, relation_en, member_nid);
        }
    });

    /*up members designation*/
    $('#designation').change(function () {
        var des = $(this).val();
        if (des == 1){
            $('#sequence').hide();
        }else {
            $('#sequence').show();
            $('#sequence').attr('data-parsley-required');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:loc+'/management/getEmployeeSequence',
                beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
                complete: function() { $('.pre-loader').fadeOut(); },
                data: {des: des},
                success: function (data) {
                    $( "#sequence_id" ).html(data);
                }
            });
        }
    });

    /*slider data*/
    $('.edit').click(function () {
        let id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:loc+'/management/slider/get/slide',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },
            data: {id: id},
            success: function (data) {
                $('#slide-id').val(data.id);
                $('#title').val(data.title);
                $('#photo').attr('src', loc+'/assets/images/slider/'+data.photo);
                $('#caption').val(data.caption);
            }
        });
    });

    /*Check gender info*/
    function checkStatus(mstatus, gender){
        if (gender == ''){
            $('#genderErr').css({"border": '1px solid red', "border-radius": '4px', "padding-top": '10px'});
            $('#genderErrMess').append('<label class="text-danger errMess">অনুগ্রহ করে লিঙ্গ নির্বাচন করুন</label>');
        }
        else if (mstatus == 2 && gender == 1){
            $('#wife').show();
            $('#wife_name_bn').attr('required', 'required');
            $('#husband_name_bn').removeAttr('required');
            $('#husband_name_en').val('');
            $('#husband_name_bn').val('');
            $('#husband').hide();
            $('#genderErr').removeAttr("style");
            $('.errMess').hide();
        }
        else if (mstatus == 2 && gender == 2) {
            $('#wife_name_bn').removeAttr('required');
            $('#wife_name_en').val('');
            $('#wife_name_bn').val('');
            $('#wife').hide();
            $('#husband').show();
            $('#husband_name_bn').attr('required', 'required');
            $('#genderErr').removeAttr("style");
            $('.errMess').hide();
        }
        else {
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

        $('#permanent_district_id').html('<option value="'+$('#present_district_id').val()+'" selected="selected">'+$('#present_district_id option:selected').text()+'</option>');
        $('#permanent_district').val($('#present_district').val());

        $('#permanent_upazila_id').html('<option value="'+$('#present_upazila_id').val()+'" selected="selected">'+$('#present_upazila_id option:selected').text()+'</option>');
        $('#permanent_upazila').val($('#present_upazila').val());

        $('#permanent_postoffice_id').html('<option value="'+$('#present_postoffice_id').val()+'" selected="selected">'+$('#present_postoffice_id option:selected').text()+'</option>');
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
        if (id == 'father'){
            if (live == 0){
                fage = $('#father_age').val();
                $('#father_age').hide();
                $('#father_age').val('');
                $('#father_age').removeAttr('required');
            }else {
                $('#father_age').show();
                $('#father_age').val(fage);
                $('#father_age').attr('required', 'required');
            }
        }else {
            if (live == 0){
                mage = $('#mother_age').val();
                $('#mother_age').hide();
                $('#mother_age').val('');
                $('#mother_age').removeAttr('required');
            }else {
                $('#mother_age').show();
                $('#mother_age').val(mage);
                $('#mother_age').attr('required', 'required');
            }
        }

    }

    /*add woyarisher taliika*/
    function addRow(x, warish_name_bn, warish_name_en, relation_bn, relation_en, member_nid) {
        $('#warish_name_bn').val('');
        $('#warish_name_en').val('');
        $('#relation_bn').val('');
        $('#relation_en').val('');
        $('#member_nid').val('');

        $('#addWoyarish').append('<div class="col-sm-12" id="dataRow_'+x+'">\n' +
            '    <div class="row form-group">\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper">\n' +
            '            <input type="text" name="warish_name_bn[]" value="'+warish_name_bn+'" class="form-control" placeholder="নাম বাংলায়" data-parsley-required  />\n' +
            '            <span class="bt-flabels__error-desc">নাম দিন বাংলায়....</span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper">\n' +
            '            <input type="text" name="warish_name_en[]" value="'+warish_name_en+'" class="form-control" placeholder="নাম ইংরেজিতে" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
            '            <span class="bt-flabels__error-desc">নাম দিন ইংরেজিতে....</span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper">\n' +
            '            <input type="text" name="relation_bn[]" value="'+relation_bn+'" class="form-control"  placeholder="সম্পর্ক বাংলায়" data-parsley-required/>\n' +
            '            <span class="bt-flabels__error-desc">সম্পর্ক দিন বাংলায়....</span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper">\n' +
            '            <input type="text" name="relation_en[]" value="'+relation_en+'" class="form-control" placeholder="সম্পর্ক ইংরেজিতে" data-parsley-pattern=\'^[a-zA-Z. ]+$\' data-parsley-trigger="keyup" />\n' +
            '            <span class="bt-flabels__error-desc">সম্পর্ক দিন ইংরেজিতে....</span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2 bt-flabels__wrapper">\n' +
            '            <input type="text" name="member_nid[]" value="' + member_nid + '" class="form-control"/>\n' +
            '            <span class="bt-flabels__error-desc">পরিচয়পত্র নং দিন ইংরেজিতে....</span>\n' +
            '        </div>\n' +
            '        <div class="col-sm-2">\n' +
            '            <button type="button" class="btn btn-warning" onclick="removeRow('+x+')">মুছে ফেলুন</button>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>');
    }

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
