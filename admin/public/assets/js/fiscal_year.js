var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


var fiscal_year_table;

//add fiscal year modal
function add_fiscal_year(){

    //fiscal year reset
    $("#name").val('');
    $("#expire_date").val('');
    $( "#is_current" ).prop( "checked", false );
    $("#row_id").val('');

    // error reset
    $("#name_error").html('');
    $("#expire_date_error").html('');

    $("#save_button").show();
    $("#update_button").hide();

    $("#fiscal_year_modal").modal('show');

}

//====fiscal year edit====//
function fiscal_year_edit(row_index){

    $("#name_error").html('');
    $("#expire_date_error").html('');
    // error reset
   
    var row_data = $('#fiscal_year_table').DataTable().row(row_index).data();

    
    $("#name").val(row_data.name);
    $("#expire_date").val(row_data.expire_date);

    if(row_data.is_current > 0){
        $( "#is_current" ).prop( "checked", true );
    }else{
        $( "#is_current" ).prop( "checked", false );
    }
  
    $("#row_id").val(row_data.id);
 
    $("#update_button").show();
    $("#save_button").hide();

    $("#fiscal_year_modal").modal('show');
}

//fiscal year submit
$(document).on("submit", "#fiscalYearFormSubmit", function (e) {

    e.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: url + '/super_admin/fiscal_year_save',
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function(response) {
            swal({
                title: "Response",
                text: response.message,
                type: response.status,
            });
            $('#fiscal_year_table').DataTable().draw(true);
            $("#fiscal_year_modal").modal('hide');
        }
    });
    
});
  
//===fiscal year delete===//
function fiscal_year_delete(row_index) {

    var delete_data = $('#fiscal_year_table').DataTable().row(row_index).data();


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
                url: url + '/super_admin/fiscal_year_delete',
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
        $('#fiscal_year_table').DataTable().draw(true);
    });
}

