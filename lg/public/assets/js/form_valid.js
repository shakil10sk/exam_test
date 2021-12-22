$(document).ready(function() {
    let x = 0;
    let loc = $('meta[name=path]').attr("content");
    let path = $('meta[name=url]').attr("content");
    let TypeApplication  = ['nagorik', 'death', 'obibahito', 'punobibaho', 'ekoinam', 'sonaton', 'prottyon', 'nodibanga', 'character', 'vumihin', 'yearlyincome', 'protibondi', 'onumoti', 'voter', 'onapotti', 'rastakhonon', 'warish', 'family', 'trade', 'bibahito']; 
    let nagorikPin   = '';
    let nagorikPhoto = '';

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
        let applicationType = $('#web').val();

        let app_union_id = $('#union-id').val();

        if(app_union_id == ''){
            $('#app_union_id_feedback').html('ইউনিয়ন সিলেক্ট করুন');return;
        }else{
            $('#app_union_id_feedback').html('');
        }

        if(searchData == ''){
            Swal.fire({
                icon    : 'error',
                title   : 'দুঃখিত !',
                text    : 'আপনি কোন তথ্য প্রদান করেন নি',
                confirmButtonText: 'OK'
              });
        }else{
            $.ajax({
                type:'POST',
                url:loc+'/api/check/exiting/application',
                data:{searchData:searchData, applicationType: applicationType, unionId:unionId},
                success: function (res) {
                    console.log(res);
                    let info = '';
                    if(res.sonodno){
                        info = res.message+'<b>'+res.pin+'</b> এবং সনদ নং <b>'+res.sonodno+'</b> <br/><br/><a href="'+path+'/verify/'+res.application+'_bn/'+res.sonodno+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">সনদটি বাংলায় প্রিন্ট করুন</a> <br/><br/> <a href="'+path+'/verify/'+res.application+'_en/'+res.sonodno+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">সনদটি ইংরেজিতে প্রিন্ট করুন</a>';
                        sweetAlert(res.status, info);
                    }else if(res.tracking){
                        info = res.message+'<b>'+res.pin+'</b> এবং ট্র্যাকিং নং <b>'+res.tracking+'</b> <br/><br/><a href="'+path+'/verify/'+res.application+'_application/'+res.tracking+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a>';
                        sweetAlert(res.status, info);
                    }else if(res.status404){
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: res.status404,
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
                        
                        nagorikPin      = res[0]['pin'];
                        nagorikPhoto    = res[1]['photo'];
                        let appType     = $('#web').val();
    
                        $('#form-data').attr('data-route', loc+'/api/'+TypeApplication[Number(appType)-1]);
    
                        $(".image").attr('src', loc+'/public/assets/images/application/'+res[1]['photo']);
    
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
    
                        $('#present_district_id').val(res[1]['present_district_id']);
                        $('#present_district').val(res[1]['present_district_name_bn']);
    
                        $('#present_upazila_id').html('<option value="'+res[1]['present_upazila_id']+'" selected="selected">'+res[1]['present_upazila_name_en']+'</option>');
                        $('#present_upazila').val(res[1]['present_upazila_name_bn']);
    
                        $('#present_postoffice_id').html('<option value="'+res[1]['present_postoffice_id']+'" selected="selected">'+res[1]['present_postoffice_name_en']+'</option>');
                        $('#present_postoffice').val(res[1]['present_postoffice_name_bn']);
    
                        $('#addressCheck').remove();
    
                        $('#permanent_district_id').val(res[1]['permanent_district_id']);
                        $('#permanent_district_id').prop('disabled', true);
                        $('#permanent_district').val(res[1]['permanent_district_name_bn']);
    
                        $('#permanent_upazila_id').html('<option value="'+res[1]['permanent_upazila_id']+'" selected="selected">'+res[1]['permanent_upazila_name_en']+'</option>');
                        $('#permanent_upazila_id').prop('disabled', true);
                        $('#permanent_upazila').val(res[1]['permanent_upazila_name_bn']);
    
                        $('#permanent_postoffice_id').html('<option value="'+res[1]['permanent_postoffice_id']+'" selected="selected">'+res[1]['permanent_postoffice_name_en']+'</option>');
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

        function sweetAlert(status, info){
            Swal.fire({
                title   : '<strong>'+status+'</strong>',
                icon    : 'warning',
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

    $(":input").change(function(e){
        let field = $(this).attr('name');
        $('#'+field+'_status').removeClass('has-error has-feedback');
        $('#'+field+'_feedback').text('');
        e.preventDefault();
    });

    $("#form-data").submit(function(e){

        let nid = $('#nid').val();
        let birth = $('#birth_id').val();
        let passport = $('#passport_no').val();

        let app_union_id = $('#union-id').val();

        if(app_union_id == ''){
            $('#app_union_id_feedback').html('ইউনিয়ন সিলেক্ট করুন');
            return false;
        }else{
            $('#app_union_id_feedback').html('');
        }

        if (nid == '' && birth == '' && passport == ''){
            $('#passport_no_status').addClass('has-error has-feedback');
            $('#birth_id_status').addClass('has-error has-feedback');
            $('#nid_status').addClass('has-error has-feedback');
            $('#national_id_error').html('<span class="text-danger"><i class="ion-ios-star"></i> অনুগ্রহ করে ন্যাশনাল আইডি নং অথবা জন্ম নিবন্ধন নং অথবা পাসপোর্ট নং দিন ইংরেজিতে....</span>');
            return false;
        }else {
            let route       = $('#form-data').data('route');
            let formData    = new FormData($("#form-data")[0]);

            $.each($('input[name=photo]')[0].files, function(i, file) {
                formData.append('file[]', file);
            });
            formData.append('is_photo', nagorikPhoto);
            formData.append('pin', nagorikPin);

            $.each($('#form-data').serializeArray(), function(i, field) {
                $('#'+field.name+'_status').removeClass('has-error has-feedback');
                $('#'+field.name+'_feedback').text('');
            });

            $.ajax({
                type        :   'POST',
                url         :   route,
                enctype     :   'multipart/form-data',
                data        :   formData,
                processData :   false,
                contentType :   false,
                cache       :   false,
                timeout     :   60000,
                beforeSend  : function(){
                    $('#submitBtn').attr('disabled','disabled');
                    $('<img id="loading_gif" src="' + path + '/public/assets/images/loding.gif" alt="loding.gif" style="position: relative;height: 50px;"></img>').insertAfter('#submitBtn');
                },
                success : function (res) {
                    if(res.niderror){
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: res.niderror,
                            confirmButtonText: 'ঠিক আছে'
                          });
                    }else if(res.success){
                        Swal.fire({
                            title   : '<strong>'+res.success+'</strong>',
                            icon    : 'success',
                            html    : 'আপনার পিন নং <b>'+res.pin+'</b>, এবং ট্র্যাকিং নং <b>'+res.tracking+
                              '</b> <a href="'+path+'/verify/'+res.application+'/'+res.tracking+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a> ',
                            showConfirmButton: true,
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonText:
                              '<i class="fa fa-print-up"></i> ঠিক আছে!',
                            confirmButtonAriaLabel: 'ঠিক আছে!'
                          }).then(function () {
                            location.reload(true);
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            text: res.error,
                            confirmButtonText: 'ঠিক আছে'
                          }); 
                    }
                },
                error:function(xhr, status, error) {
                    $('#submitBtn').removeAttr('disabled');
                    $('#loading_gif').remove();
                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত...',
                        text: 'আবেদন সম্পূর্ণ হয়নি!',
                        confirmButtonText: 'ঠিক আছে'
                      });
                    $('#submitBtn').removeAttr('disabled');
                    if (xhr.responseText) {
                        let jsonResponseText = JSON.parse(xhr.responseText);
                        let message             = jsonResponseText.message;
                        let errors              = jsonResponseText.errors;
                        $.each(errors, function(name, val) {
                            $('#'+name+'_status').addClass('has-error has-feedback');
                            $('#'+name+'_feedback').text(val);
                        });
                    }
                }
            });

            e.preventDefault();
        }
    });

    /*Check gender info*/
    function checkStatus(mstatus, gender){
        if (gender == ''){
            $('#genderErr').css({"border": '1px solid red', "border-radius": '4px', "padding-top": '10px'});
            $('#gender_status').append('<label class="text-danger errMess">\n' +
                '        অনুগ্রহ করে লিঙ্গ নির্বাচন করুন\n' +
                '      </label>');
        }
        else if (mstatus == 2 && gender == 1){
            $('#wife').show();
            $('#wife_name_bn').attr('required', 'required');
            $('#husband').hide();
            $('#husband_name_bn').removeAttr('required');
            $('#husband_name_en').val('');
            $('#husband_name_bn').val('');
            $('#genderErr').removeAttr("style");
            $('.errMess').hide();
        }
        else if (mstatus == 2 && gender == 2) {
            $('#wife').hide();
            $('#wife_name_bn').removeAttr('required');
            $('#wife_name_en').val('');
            $('#wife_name_bn').val('');
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
});

//get geo location
function getLocation(parentId, selectId = null, targetId = null, thanId = null, thanViewId = null, type = null){

    let web_loc = $('meta[name=url]').attr("content");
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
        type: 'get',
        url: web_loc + '/geo/code/get',
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

//from location get
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

//get union
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
