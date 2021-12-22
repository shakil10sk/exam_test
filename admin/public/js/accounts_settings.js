//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


var account_table;


//===account list===//
function account_list() {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	 account_table =	$('#account_table').DataTable({
			scrollCollapse: true,
			autoWidth: false,
			responsive: true,
			serverSide: true,
			processing: true,
			ajax: {
            dataType: "JSON",
            type: "post",
            url : url + '/accounts/account_list_data',
            data: {
                
            },

        },
        columns:[
        	{
                data: null,
                render: function(){
                    return account_table.page.info().start + account_table.column(0).nodes().length;
                }
            },

         	
            { data: "account_name" },
            { data: "account_code" },
            { data: "account_code" },
            { data: "account_code" },
           
            {
            	data: null,
            	render: function(data, type, row, meta){
                    let editAc = '';
                    let deleteAc = '';
                    if($('#edit-accounts').val()){
                        editAc = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-warning' onclick='account_edit("+meta.row+")'>এডিট</p></a>";
                    }
                    if($('#delete-accounts').val()){
                        deleteAc = " <a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='account_delete("+meta.row+")' >ডিলিট</p></a>";
                    }
            		return editAc+deleteAc;
            	}
            },


        ],
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search"
		},
		dom: 'Bfrtip',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
		});
}


//add account modal
function add_account(){

    //account reset
    $("#account_name").val('');
    $("#account_code").val('');
    $("#opening_balance").val('');
    $("#acc_type").val('');

    // error reset
    $("#account_name_error").html('');
    $("#account_code_error").html('');
    $("#acc_type_error").html('');


    $("#save_button").show();
    $("#update_button").hide();

    $("#account_save_modal").modal('show');

}

	//====account save===//
	function account_save()
	{

    var account_name = $("#account_name").val();
    var account_code = $("#account_code").val();
    var acc_type = $("#acc_type").val();
    var opening_balance = $("#opening_balance").val();

   var error_status = false;

    if (account_name == '') {
        $("#account_name_error").html('একাউন্ট নাম দিতে হবে।');
        error_status = true;
    }else{
        $("#account_name_error").html('');
        
    }

    if(account_code == ''){
        $("#account_code_error").html("একাউন্ট কোড দিতে হবে।");
        error_status = true;
    }else{
        $("#account_code_error").html('');
        
    }

    if (acc_type == '') {
        $("#acc_type_error").html("একাউন্ট ধরন দিতে হবে।");
        error_status = true;
    }else{
        $("#acc_type_error").html('')
       
    }

    if (error_status == true) {

        return false;

    }else{
    
        swal({
	         title: "অনুমোদন",
	         text: "আপনি কি একাউন্ট টি যোগ করতে চান ?",
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
                  url: url + '/accounts/account_save',
                  type: "POST",
                  dataType: "JSON",
                  data: {
                  	 account_name : account_name,
                     account_code : account_code,
                     opening_balance : opening_balance,
                     acc_type : acc_type,
                  	
                  },

                 success: function(data) {

                    //if laravel validation error
                    if(data.errors) {

                        if(data.errors.account_name){
                            $( '#account_name_error' ).html( data.errors.account_name[0] );
                        }

                        if(data.errors.account_code){
                            $( '#account_code_error' ).html( data.errors.account_code[0] );
                        }

                        if(data.errors.acc_type){
                            $( '#acc_type_error' ).html( data.errors.acc_type[0] );
                        }

                    }

                    //if data exist or success
                   if(data.status == 'error' || data.status == 'success') {

                        $("#account_save_modal").modal('hide');

                        swal({
                            title: "ধন্যবাদ",
                            text: data.message,
                            type: data.status,
                            showCancelButton: true,
                            cancelButtonText:"বাতিল",
                            showConfirmButton: true,
                            closeOnConfirm: true,
                            allowEscapeKey: false
                         })

                        account_table.ajax.reload();
                        
                    }
                }


             	});
			 }
        }).then(function(){

        });
    }

	}


//====account edit====//
function account_edit(row_index){

    $("#opening_balance").html('');
    // error reset
    $("#account_name_error").html('');
    $("#account_code_error").html('');
    $("#acc_type_error").html('');

    var row_data = account_table.row(row_index).data();

    $("#account_name").val(row_data.account_name);
    $("#account_code").val(row_data.account_code);
    $("#opening_balance").val(row_data.opening_balance);
    $("#acc_type").val(row_data.acc_type);

    $("#row_id").val(row_data.id);

    $("#update_button").show();
    $("#save_button").hide();

    $("#account_save_modal").modal('show');
}

//====account update===//

function account_update(){

    var account_name = $("#account_name").val();
    var account_code = $("#account_code").val();
    var opening_balance = $("#opening_balance").val();
    var acc_type = $("#acc_type").val();
    var row_id = $("#row_id").val();

    var error_status = false;

    if (account_name == '') {
        $("#account_name_error").html('একাউন্ট নাম দিতে হবে।');
        error_status = true;
    }else{
        $("#account_name_error").html('');
       
    }

    if(account_code == ''){
        $("#account_code_error").html("একাউন্ট কোড দিতে হবে।");
        error_status = true;
    }else{
        $("#account_code_error").html('');
        
    }

    if (acc_type == '') {
        $("#acc_type_error").html("একাউন্ট ধরন দিতে হবে।");
        error_status = true;
    }else{
        $("#acc_type_error").html('')
        
    }

    if (error_status == true) {

        return false;

    }else{


        swal({
             title: "অনুমোদন",
             text: "আপনি কি একাউন্ট টি আপডেট করতে চান ?",
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
                  url: url + '/accounts/account_update',
                  type: "POST",
                  dataType: "JSON",
                  data: {
                     account_name : account_name,
                     account_code : account_code,
                     opening_balance : opening_balance,
                     acc_type : acc_type,
                     row_id : row_id,
                    
                  },

                success: function(data) {

                    //if laravel validation error
                    if(data.errors) {

                        if(data.errors.account_name){
                            $( '#account_name_error' ).html( data.errors.account_name[0] );
                        }

                        if(data.errors.account_code){
                            $( '#account_code_error' ).html( data.errors.account_code[0] );
                        }

                        if(data.errors.acc_type){
                            $( '#acc_type_error' ).html( data.errors.acc_type[0] );
                        }

                    }

                    //if data exist or success
                   if(data.status == 'error' || data.status == 'success') {

                        $("#account_save_modal").modal('hide');

                        swal({
                            title: "ধন্যবাদ",
                            text: data.message,
                            type: data.status,
                            showCancelButton: true,
                            cancelButtonText:"বাতিল",
                            showConfirmButton: true,
                            closeOnConfirm: true,
                            allowEscapeKey: false
                         })

                        account_table.ajax.reload();
                        
                    }

                }


                });
             }
        }).then(function(){

        });
    }   

}


//===account delete===//
	function account_delete(row_index) {

		var delete_data = account_table.row(row_index).data();

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
                url: url + '/accounts/account_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : delete_data.id,
                   
                },
                success: function(response) {
                    swal({
                        title: "ধন্যবাদ",
                        text: response.status,
                        type: 'success',
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
        account_table.ajax.reload();
    });
}

 
