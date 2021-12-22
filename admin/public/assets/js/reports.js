var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


var project_table;

//add project modal
function add_project(){

    //project reset
    $("#title").val('');
    $("#pre_photo").val('');
    $("#final_photo").val('');
    $("#file").val('');
    $("#description").val('');
    $("#row_id").val('');

    // error reset
    $("#title_error").html('');
    $("#pre_photo_error").html('');
    $("#final_photo_error").html('');


    $("#save_button").show();
    $("#update_button").hide();

    $("#project_modal").modal('show');

}

//====project edit====//
function project_edit(row_index){

    $("#title_error").html('');
    // error reset
    $("#pre_photo_error").html('');
    $("#final_photo_error").html('');

    var row_data = $('#project_table').DataTable().row(row_index).data();

    $("#pre_photo").val('');
    $("#final_photo").val('');
    $("#file").val('');
    $("#title").val(row_data.title);
    $("#description").val(row_data.description);
  
    $("#row_id").val(row_data.id);
 
    $("#update_button").show();
    $("#save_button").hide();

    $("#project_modal").modal('show');
}

//project submit
$(document).on("submit", "#formsubmit", function (e) {

    e.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: url + '/reports/project_save',
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function(response) {
            swal({
                title: "Response",
                text: response.message,
                icon: response.status,
            });
            $('#project_table').DataTable().draw(true);
            $("#project_modal").modal('hide');
        }
    });
    
});
  
//===project delete===//
function project_delete(row_index) {

    var delete_data = $('#project_table').DataTable().row(row_index).data();


    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/reports/project_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : delete_data.id,
                   
                },
                success: function(response) {
                    swal({
                        title: response.status,
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                }
            });
        }
    }).then(function(){
        $('#project_table').DataTable().draw(true);
    });
}

var report_table;
//add report modal
function add_report(){

    //project reset
    $("#title").val('');
    $("#file").val('');
    $("#row_id").val('');

    // error reset
    $("#title_error").html('');

    $("#save_button").show();
    $("#update_button").hide();

    $("#report_modal").modal('show');

}

//====report edit====//
function report_edit(row_index){

    $("#title_error").html('');
    // error reset
   
    var row_data = $('#report_table').DataTable().row(row_index).data();

    $("#file").val('');
    $("#title").val(row_data.title);
  
    $("#row_id").val(row_data.id);
    $("#type").val(row_data.type);
 
    $("#update_button").show();
    $("#save_button").hide();

    $("#report_modal").modal('show');
}

//report submit
$(document).on("submit", "#reportFormSubmit", function (e) {

    e.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: url + '/reports/report_save',
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function(response) {
            swal({
                title: "Response",
                text: response.message,
                icon: response.status,
            });
            $('#report_table').DataTable().draw(true);
            $("#report_modal").modal('hide');
        }
    });
    
});
  
//===report delete===//
function report_delete(row_index) {

    var delete_data = $('#report_table').DataTable().row(row_index).data();


    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/reports/report_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : delete_data.id,
                   
                },
                success: function(response) {
                    swal({
                        title: response.status,
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                }
            });
        }
    }).then(function(){
        $('#report_table').DataTable().draw(true);
    });
}

var letter_table;
//add letter modal
function add_letter(){

    //letter reset
    $("#accept_send_date").val('');
    $("#acc_send_no_date").val('');
    $("#office").val('');
    $("#repley_no_date").val('');
    $("#description").val('');
    $("#file").val('');
    $("#comment").val('');
    $("#row_id").val('');


    $("#save_button").show();
    $("#update_button").hide();

    $("#letter_modal").modal('show');

}

//====letter edit====//
function letter_edit(row_index){


   
    var row_data = $('#letter_table').DataTable().row(row_index).data();

    $("#file").val('');
    $("#accept_send_date").val(row_data.accept_send_date);
    $("#acc_send_no_date").val(row_data.acc_send_no_date);
    $("#office").val(row_data.office);
    $("#repley_no_date").val(row_data.repley_no_date);
    $("#description").val(row_data.description);
    $("#comment").val(row_data.comment);
  
    $("#row_id").val(row_data.id);
    $("#type").val(row_data.type);
 
    $("#update_button").show();
    $("#save_button").hide();

    $("#letter_modal").modal('show');
}

//letter submit
$(document).on("submit", "#letterFormSubmit", function (e) {

    e.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: url + '/reports/letter_save',
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function(response) {
            swal({
                title: "Response",
                text: response.message,
                icon: response.status,
            });
            $('#letter_table').DataTable().draw(true);
            $("#letter_modal").modal('hide');
        }
    });
    
});
  
//===letter delete===//
function letter_delete(row_index) {

    var delete_data = $('#letter_table').DataTable().row(row_index).data();


    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/reports/letter_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : delete_data.id,
                   
                },
                success: function(response) {
                    swal({
                        title: response.status,
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                }
            });
        }
    }).then(function(){
        $('#letter_table').DataTable().draw(true);
    });
}


var asset_table;
//add asset modal
function add_asset(){

    //asset reset
    $("#asset_name_point").val('');
    $("#create_buy_date").val('');
    $("#rate").val('');
    $("#stock_source").val('');
    $("#last_care_date").val('');
    $("#expence_amount").val('');
    $("#care_expense_source").val('');
    $("#next_care_date").val('');
    $("#file").val('');
    $("#comment").val('');
    $("#row_id").val('');


    $("#save_button").show();
    $("#update_button").hide();

    $("#asset_modal").modal('show');

}

//====asset edit====//
function asset_edit(row_index){

    var row_data = $('#asset_table').DataTable().row(row_index).data();

    $("#file").val('');
    $("#asset_name_point").val(row_data.asset_name_point);
    $("#create_buy_date").val(row_data.create_buy_date);
    $("#rate").val(row_data.rate);
    $("#stock_source").val(row_data.stock_source);
    $("#last_care_date").val(row_data.last_care_date);
    $("#expence_amount").val(row_data.expence_amount);
    $("#care_expense_source").val(row_data.care_expense_source);
    $("#next_care_date").val(row_data.next_care_date);
    $("#comment").val(row_data.comment);
  
    $("#row_id").val(row_data.id);

 
    $("#update_button").show();
    $("#save_button").hide();

    $("#asset_modal").modal('show');
}

//asset submit
$(document).on("submit", "#assetFormSubmit", function (e) {

    e.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: url + '/reports/asset_register_save',
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function(response) {
            swal({
                title: "Response",
                text: response.message,
                icon: response.status,
            });
            $('#asset_table').DataTable().draw(true);
            $("#asset_modal").modal('hide');
        }
    });
    
});
  
//===asset delete===//
function asset_delete(row_index) {

    var delete_data = $('#asset_table').DataTable().row(row_index).data();


    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/reports/asset_register_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : delete_data.id,
                   
                },
                success: function(response) {
                    swal({
                        title: response.status,
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                }
            });
        }
    }).then(function(){
        $('#asset_table').DataTable().draw(true);
    });
}