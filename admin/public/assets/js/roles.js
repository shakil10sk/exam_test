$(document).ready(function() {
    let loc = $('meta[name=path]').attr("content");
    /*up members designation*/
$('#designation').change(function () {
    var des = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:loc+'/setting/setup/getEmployeeName',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },
            data: {des: des},
            success: function (data) {
                $( "#user_id" ).html(data);
            }
        });
    });
$('#role-assign-form').submit(function(){
    var des      = $('#designation').val();
    var userId   = $('#user_id').val();
    var roleId   = $('#role_id').val();

    if (des === '' || userId === '' || roleId === ''){
        if(des === ''){
            $('#designation').addClass('is-invalid');
            if($('#error_designation').text()){
                $('#error_designation').removeAttr('style');
            }else{
                $('#error').append('<li id="error_designation"><i class="icon-copy fa fa-hand-o-right" aria-hidden="true"></i> পদবী সিলেক্ট করুন</li>');
            }
        }if(userId === ''){
            $('#user_id').addClass('is-invalid');
            if($('#error_user_id').text()){
                $('#error_user_id').removeAttr('style');
            }else{
            $('#error').append('<li id="error_user_id"><i class="icon-copy fa fa-hand-o-right" aria-hidden="true"></i> কর্মকর্তার নাম সিলেক্ট করুন</li>');
            }
        }
        if(roleId === ''){
            $('#role_id').addClass('is-invalid');
            if($('#error_role_id').text()){
                $('#error_role_id').removeAttr('style');
            }else{
            $('#error').append('<li id="error_role_id"><i class="icon-copy fa fa-hand-o-right" aria-hidden="true"></i> রোল সিলেক্ট করুন</li>');
            }
        }
        return false;
    }else {
        return true;
    }
});

$(":input").change(function(e){
    let id = $(this).attr('id');
    $('#'+id).removeClass('is-invalid');
    $('#error_'+id).slideUp(300);
    e.preventDefault();
});

//Create Custom Role
$('#roleName').keyup(function(e){
    if($(this).val() != ''){
        $('.roleError').text('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:loc+'/setting/setup/check/role',
            data: {role: $(this).val()},
            success: function (data) {
                if(data.name){
                    $('#roleError').text('দুৎখিত, এই রোলনেম ইতিপূর্বে নেওয়া হয়েছে!');
                    $('#roleLabel').addClass('has-danger');
                    $('#roleName').addClass('form-control-danger');
                }else{
                    $('#roleError').text('');
                    $('#roleLabel').removeClass('has-danger');
                    $('#roleName').removeClass('form-control-danger');
                    $('#roleName').addClass('form-control-success');
                }
            }
        });
    }
    e.preventDefault();
});

$('#mark-app').click(function(){
    if($(this).is(":checked")){
        markApplication();
    }else{
        unmarkApplication();
    }
});

$('#mark-web').click(function(){
    if($(this).is(":checked")){
        markWeb();
    }else{
        unmarkWeb();
    }
});

$('#mark-accounts').click(function(){
    if($(this).is(":checked")){
        markAccounts();
    }else{
        unmarkAccounts();
    }
});

$('#mark-setting').click(function(){
    if($(this).is(":checked")){
        markSetting();
    }else{
        unmarkSetting();
    }
});

$('#others-application').click(function(){
    if(!$(this).is(":checked")){
        unmarkApplication(1);
    }
});

$('#website-management').click(function(){
    if(!$(this).is(":checked")){
        unmarkWeb(1);
    }
});

$('#accounts').click(function(){
    if(!$(this).is(":checked")){
        unmarkAccounts(1);
    }
});

$('#income-tax').click(function(){
    if(!$(this).is(":checked")){
        unmarkIncomeTax(1);
    }
});

$('#home-tax').click(function(){
    if(!$(this).is(":checked")){
        unmarkHomeTax(1);
    }
});

$('#setting').click(function(){
    if(!$(this).is(":checked")){
        unmarkSetting(1);
    }
});

$('#employee-list').click(function(){
    if(!$('#website-management').is(":checked")){
        swal({
            text: "পূর্বে ওয়েবসাইট ম্যানেজমেন্ট সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#employee-list').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#employee-list-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkWebEmployee(1);
    }
});

$('#notice-list').click(function(){
    if(!$('#website-management').is(":checked")){
        swal({
            text: "পূর্বে ওয়েবসাইট ম্যানেজমেন্ট সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#notice-list').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#notice-list-collapse').removeClass('show');
        });

    }
    if(!$(this).is(":checked")){
        unmarkWebNotice(1);
    }
});

$('#slider-list').click(function(){
    if(!$('#website-management').is(":checked")){
        swal({
            text: "পূর্বে ওয়েবসাইট ম্যানেজমেন্ট সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#slider-list').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#slider-list-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkWebSlider(1);
    }
});
$('#vata-list').click(function(){
    if(!$('#website-management').is(":checked")){
        swal({
            text: "পূর্বে ওয়েবসাইট ম্যানেজমেন্ট সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#vata-list').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#vata-list-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkWebVata(1);
    }
});

$('#registers').click(function(){
    if(!$('#accounts').is(":checked")){
        swal({
            text: "পূর্বে একাউন্টস সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#registers').prop("checked", false);
        });
    }
});

$('#everyday-reports').click(function(){
    if(!$('#accounts').is(":checked")){
        swal({
            text: "পূর্বে একাউন্টস সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#everyday-reports').prop("checked", false);
        });
    }
});

$('#tax').click(function(){
    if(!$('#accounts').is(":checked")){
        swal({
            text: "পূর্বে একাউন্টস সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#tax').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#tax-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkAccTax(1);
    }
});

$('#accounts-setting').click(function(){
    if(!$('#accounts').is(":checked")){
        swal({
            text: "পূর্বে একাউন্টস সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#accounts-setting').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#accounts-setting-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkAccSett(1);
    }
});


$('#union-setup').click(function(){
    if(!$('#setting').is(":checked")){
        swal({
            text: "পূর্বে সেটিং সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#union-setup').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#union-setup-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkUnionSett(1);
    }
});

$('#role-setup').click(function(){
    if(!$('#setting').is(":checked")){
        swal({
            text: "পূর্বে সেটিং সিলেক্ট করুন!",
            type: 'warning',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'ok'
        }).then(function () {
            $('#role-setup').prop("checked", false);
            $(this).collapse({ 'toggle': false }).collapse('hide');
            $('#role-list-collapse').removeClass('show');
        });
    }
    if(!$(this).is(":checked")){
        unmarkRoleSett(1);
    }
});



function unmarkSetting(a = null){
    if(a == null){
        $('#setting').prop("checked", false);
    }else{
        $('#role-list-collapse').removeClass('show');
        $('#union-setup-collapse').removeClass('show');
    }
    $('#role-setup').prop("checked", false);
    $('#union-setup').prop("checked", false);
    unmarkUnionSett(a);
    unmarkRoleSett(a);
}

function unmarkUnionSett(a = null){
    if(a == 1){
        $('#mark-setting').prop("checked", false);
    }
    $('#union-profile').prop("checked", false);
    $('#edit-union').prop("checked", false);
}

function unmarkRoleSett(a = null){
    if(a == 1){
        $('#mark-setting').prop("checked", false);
    }
    $('#create-role').prop("checked", false);
    $('#role-list').prop("checked", false);
    $('#show-role').prop("checked", false);
    $('#delete-role').prop("checked", false);
    $('#assign-role').prop("checked", false);
    $('#reset-all-role').prop("checked", false);
    $('#reset-role').prop("checked", false);
    $('#assigned-role').prop("checked", false);
}

function unmarkAccounts(a = null){
    if(a == null){
        $('#accounts').prop("checked", false);
    }else{
        $('#tax-collapse').removeClass('show');
        $('#income-tax-collapse').removeClass('show');
        $('#home-tax-collapse').removeClass('show');
        $('#accounts-setting-collapse').removeClass('show');
    }
    $('#tax').prop("checked", false);
    $('#registers').prop("checked", false);
    $('#everyday-reports').prop("checked", false);
    $('#accounts-setting').prop("checked", false);
    unmarkAccTax(a);
    unmarkAccSett(a);
}

function unmarkAccTax(a = null){
    if(a == 1){
        $("#mark-accounts").prop("checked", false);
    }
    $('#income-tax').prop("checked", false);
    $('#add-income-tax').prop("checked", false);
    $('#income-tax-invoice').prop("checked", false);
    $('#home-tax').prop("checked", false);
    $('#add-home').prop("checked", false);
    $('#add-home-tax').prop("checked", false);
    $('#edit-home').prop("checked", false);
    $('#delete-home').prop("checked", false);
    $('#home-tax-invoice').prop("checked", false);
}

function unmarkIncomeTax(a = null){
    if(a == 1){
        $("#mark-accounts").prop("checked", false);
    }
    $('#add-income-tax').prop("checked", false);
    $('#income-tax-invoice').prop("checked", false);
}

function unmarkHomeTax(a = null){
    if(a == 1){
        $("#mark-accounts").prop("checked", false);
    }
    $('#add-home').prop("checked", false);
    $('#add-home-tax').prop("checked", false);
    $('#edit-home').prop("checked", false);
    $('#delete-home').prop("checked", false);
    $('#home-tax-invoice').prop("checked", false);
}

function unmarkAccSett(a = null){
    if(a == 1){
        $("#mark-accounts").prop("checked", false);
    }
    $('#add-accounts').prop("checked", false);
    $('#edit-accounts').prop("checked", false);
    $('#delete-accounts').prop("checked", false);
}

function unmarkWeb(a = null){
    if(a == null){
        $('#website-management').prop("checked", false);
    }else{
        $('#vata-list-collapse').removeClass('show');
        $('#slider-list-collapse').removeClass('show');
        $('#notice-list-collapse').removeClass('show');
        $('#employee-list-collapse').removeClass('show');
    }
    unmarkWebEmployee(a);
    unmarkWebNotice(a);
    unmarkWebSlider(a);
    unmarkWebVata(a);
}

function unmarkWebEmployee(a = null){
    if(a == 1){
        $("#mark-web").prop("checked", false);
    }
    $('#employee-list').prop("checked", false);
    $('#add-employee').prop("checked", false);
    $('#view-employee').prop("checked", false);
    $('#edit-employee').prop("checked", false);
    $('#delete-employee').prop("checked", false);
    $('#employee-status').prop("checked", false);
}

function unmarkWebNotice(a = null){
    if(a == 1){
        $("#mark-web").prop("checked", false);
    }
    $('#notice-list').prop("checked", false);
    $('#add-notice').prop("checked", false);
    $('#edit-notice').prop("checked", false);
    $('#delete-notice').prop("checked", false);
}

function unmarkWebSlider(a = null){
    if(a == 1){
        $("#mark-web").prop("checked", false);
    }
    $('#slider-list').prop("checked", false);
    $('#add-slide').prop("checked", false);
    $('#edit-slide').prop("checked", false);
    $('#delete-slide').prop("checked", false);
}

function unmarkWebVata(a = null){
    if(a == 1){
        $("#mark-web").prop("checked", false);
    }
    $('#vata-list').prop("checked", false);
    $('#add-vata').prop("checked", false);
    $('#edit-vata').prop("checked", false);
    $('#vata-payment').prop("checked", false);
    $('#vata-profile').prop("checked", false);
    $('#vata-card-print').prop("checked", false);
    $('#delete-vata').prop("checked", false);
}
function markSetting(){
    $('#setting').prop("checked", true);
    $('#union-setup').prop("checked", true);
    $('#union-profile').prop("checked", true);
    $('#edit-union').prop("checked", true);
    $('#role-setup').prop("checked", true);
    $('#role-list').prop("checked", true);
    $('#create-role').prop("checked", true);
    $('#show-role').prop("checked", true);
    $('#delete-role').prop("checked", true);
    $('#assign-role').prop("checked", true);
    $('#reset-all-role').prop("checked", true);
    $('#reset-role').prop("checked", true);
    $('#assigned-role').prop("checked", true);
}
function markAccounts(){
    $('#accounts').prop("checked", true);
    $('#registers').prop("checked", true);

    $('#tax').prop("checked", true);
    $('#income-tax').prop("checked", true);
    $('#add-income-tax').prop("checked", true);
    $('#income-tax-invoice').prop("checked", true);
    $('#home-tax').prop("checked", true);
    $('#add-home').prop("checked", true);
    $('#add-home-tax').prop("checked", true);
    $('#edit-home').prop("checked", true);
    $('#delete-home').prop("checked", true);
    $('#home-tax-invoice').prop("checked", true);

    $('#everyday-reports').prop("checked", true);

    $('#accounts-setting').prop("checked", true);
    $('#add-accounts').prop("checked", true);
    $('#edit-accounts').prop("checked", true);
    $('#delete-accounts').prop("checked", true);
}

function markWeb(){
    $('#website-management').prop("checked", true);

    $('#employee-list').prop("checked", true);
    $('#add-employee').prop("checked", true);
    $('#view-employee').prop("checked", true);
    $('#edit-employee').prop("checked", true);
    $('#delete-employee').prop("checked", true);
    $('#employee-status').prop("checked", true);

    $('#notice-list').prop("checked", true);
    $('#add-notice').prop("checked", true);
    $('#edit-notice').prop("checked", true);
    $('#delete-notice').prop("checked", true);

    $('#slider-list').prop("checked", true);
    $('#add-slide').prop("checked", true);
    $('#edit-slide').prop("checked", true);
    $('#delete-slide').prop("checked", true);

    $('#vata-list').prop("checked", true);
    $('#add-vata').prop("checked", true);
    $('#edit-vata').prop("checked", true);
    $('#vata-payment').prop("checked", true);
    $('#vata-profile').prop("checked", true);
    $('#vata-card-print').prop("checked", true);
    $('#delete-vata').prop("checked", true);
}

function markApplication(){
    $('#charittik').prop("checked", true);
    $('#mirttu').prop("checked", true);
    $('#obibahito').prop("checked", true);
    $('#bibahito').prop("checked", true);
    $('#punobibaho').prop("checked", true);
    $('#sonaton').prop("checked", true);
    $('#prottan').prop("checked", true);
    $('#vumihin').prop("checked", true);
    $('#protibondi').prop("checked", true);
    $('#ekoinam').prop("checked", true);
    $('#barshikay').prop("checked", true);
    $('#onumoti').prop("checked", true);
    $('#nodibanga').prop("checked", true);
    $('#voterid').prop("checked", true);
    $('#rashta-khanon').prop("checked", true);
    $('#onapotti').prop("checked", true);
}

function unmarkApplication(a = null){
    if(a == 1){
        $("#mark-app").prop("checked", false);
    }
    $('#charittik').prop("checked", false);
    $('#mirttu').prop("checked", false);
    $('#obibahito').prop("checked", false);
    $('#bibahito').prop("checked", false);
    $('#punobibaho').prop("checked", false);
    $('#sonaton').prop("checked", false);
    $('#prottan').prop("checked", false);
    $('#vumihin').prop("checked", false);
    $('#protibondi').prop("checked", false);
    $('#ekoinam').prop("checked", false);
    $('#barshikay').prop("checked", false);
    $('#onumoti').prop("checked", false);
    $('#nodibanga').prop("checked", false);
    $('#voterid').prop("checked", false);
    $('#rashta-khanon').prop("checked", false);
    $('#onapotti').prop("checked", false);
}

});

//This is for SweetAlert
function warning(id) {
    swal({
        title: 'ডিলিট!',
        text: "আপনি কি ডিলিট করতে চান?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'হ্যাঁ, ডিলিট!',
        cancelButtonText: 'বাতিল'
    }).then(function (result) {
        if (result.value){
            $('#delete-form_'+id).submit();
        }
    })

}

//This is for SweetAlert
function resetRole(id) {
    swal({
        title: 'রিসেট!',
        text: "আপনি কি রিসেট করতে চান?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'হ্যাঁ, রিসেট!',
        cancelButtonText: 'বাতিল'
    }).then(function (result) {
        if (result.value){
            $('#reset-form_'+id).submit();
        }
    })

}

//This is for SweetAlert
function resetAllRole() {
    swal({
        title: 'সকল রোল রিসেট!',
        text: "আপনি কি সকল কর্মকর্তার রোল রিসেট করতে চান?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'হ্যাঁ',
        cancelButtonText: 'বাতিল'
    }).then(function (result) {
        if (result.value){
            $('#reset-all-form').submit();
        }
    })

}
