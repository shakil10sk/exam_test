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
            { data: "amount" },
            // { data: "account_code" },
           
            {
            	data: null,
            	render: function(data, type, row, meta){
                    let editAc = '';
                    let deleteAc = '';
                    /* if($('#edit-accounts').val()){
                        editAc = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-warning' onclick='account_edit("+meta.row+")'>এডিট</p></a>";
                    } */
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
    $("#head_type").val('');

    // error reset
    $("#account_name_error").html('');
    $("#account_code_error").html('');


    $("#save_button").show();
    $("#update_button").hide();

    $("#account_save_modal").modal('show');

}

	//====account save===//
function account_save()
	{

    var account_name = $("#account_name").val();
    var account_code = $("#account_code").val();
    var head_type = $("#head_type").val();
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
                     head_type : head_type,
                  	
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
    // $("#head_type").html('');

    var row_data = account_table.row(row_index).data();

    $("#account_name").val(row_data.account_name);
    $("#account_code").val(row_data.account_code);
    $("#opening_balance").val(row_data.amount);
    setTimeout(function(){
        $('#head_type').val(row_data.parent_id);
    }, 1000)
    

    $("#row_id").val(row_data.id);
    $("#transection_id").val(row_data.transection_id);

    $("#update_button").show();
    $("#save_button").hide();

    $("#account_save_modal").modal('show');
}

//====account update===//

function account_update(){

    var account_name = $("#account_name").val();
    var account_code = $("#account_code").val();
    var opening_balance = $("#opening_balance").val();
    var head_type = $("#head_type").val();
    var row_id = $("#row_id").val();
    var transection_id = $("#transection_id").val();

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
                     head_type : head_type,
                     row_id : row_id,
                     transection_id : transection_id
                    
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

//get sub category
function get_subcategoy(id, target_id, sub_label, sub_select){

if(id > 0){
	 $.ajaxSetup({
		 headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		url: url + '/accounts/acc_subcategory',
		type: "POST",
		dataType: "JSON",
		data: {
		id : id,
		},
		success: function(response) {

		console.log(response);


			if(response.length > 0){

				// $('#fromSubcategory').show();
				$('#'+sub_label).css("display", "block");
				$('#'+sub_select).css("display", "block");

				var sub_ctg = "<option value='' >সিলেক্ট </option>";

				response.forEach(function(data){
					
					sub_ctg += "<option value='"+data.id+"'>"+data.account_name+"</option>";
				});

				$('#'+target_id).html(sub_ctg);
			}else{

				var sub_ctg = "<option value='' >সিলেক্ট </option>";
				$('#'+target_id).html('');

				$("#"+sub_label).css("display", "none");
				$("#"+sub_select).css("display", "none");

			}
		}
    });
    
    }else{

        $('#sub_head_error').html('');
        var sub_ctg = "<option value='' >সিলেক্ট </option>";
        $('#'+target_id).html('');

        $("#"+sub_label).css("display", "none");
        $("#"+sub_select).css("display", "none");
    }
}

//fund add
function add_fund(){

    //account reset
    $("#head").val('');
    $("#sub_head").val('');
    $("#amount").val('');

    $('#sub_label').css("display", "none");
	$('#sub_select').css("display", "none");


    // error reset
    $("#head_error").html('');
    $("#sub_head_error").html('');
    $("#amount_error").html('');
    $("#comment_error").html('');


    $("#save_button").show();
    $("#update_button").hide();

    $("#fund_modal").modal('show');

}

var fund_table;
//===fund list===//
function fund_list() {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	 fund_table =	$('#fund_table').DataTable({
			scrollCollapse: true,
			autoWidth: false,
			responsive: true,
			serverSide: true,
			processing: true,
			ajax: {
            dataType: "JSON",
            type: "post",
            url : url + '/accounts/fund_list_data',
            data: {
                
            },

        },
        columns:[
        	{
                data: null,
                render: function(){
                    return fund_table.page.info().start + fund_table.column(0).nodes().length;
                }
            },

         	
            { data: "account_name" },
            { data: "amount" },
            { data: "comment" },
            { data: "created_time" },
            // { data: "account_code" },
           
            {
            	data: null,
            	render: function(data, type, row, meta){
                    let editAc = '';
                    let deleteAc = '';
                    if($('#edit_fund').val()){
                        editAc = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-warning' onclick='fund_edit("+meta.row+")'>এডিট</p></a>";
                    }
                    if($('#delete_fund').val()){
                        // deleteAc = " <a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='fund_delete("+meta.row+")' >ডিলিট</p></a>";
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


//fund store
function fund_store(){

    var head = $('#head').val();
    var sub_head = $('.sub_head').val();
    var comment = $('#comment').val();
    var amount = $('#amount').val();

    var error_status = false;
 
    if(head == ''){
          $('#head_error').html(' প্রধান খাত  প্রদান করুন');
         error_status = true;
    }else{
 
         if(sub_head == ''){
             $('#sub_head_error').html('সাব খাত  প্রদান করুন');
             error_status = true;
         }else{
             $('#sub_head_error').html('');
         }
 
         $('#head_error').html('');
    }
 

    if(amount == ''){
         $('#amount_error').html('টাকার পরিমান');
     }else{
         $('#amount_error').html('');
     }
 
 
    if(comment == ''){
        $('#comment_error').html('বিস্তারিত লিখুন');
        error_status = true;
    }else{
        $('#comment_error').html('');
    }
 
   
 
    if(error_status == false){
 
         $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
         $.ajax({
             url: url + '/accounts/fund_store',
             type: "POST",
             dataType: "JSON",
             data: {
                 head : head,
                 sub_head : sub_head,
                 amount : amount,
                 comment : comment  
             },
             success: function(response) {
 
                 swal({
                     icon: response.status,
                     text: response.message,
                 })
                 $("#fund_modal").modal('hide');
                 fund_table.ajax.reload();
             
             }
         });
     }
 
 
 
 
}

//====fund edit====//
function fund_edit(row_index){

    $("#head_error").html('');
    // error reset
    $("#sub_head_error").html('');
    $("#amount_error").html('');
    $("#comment_error").html('');
    

    var row_data = fund_table.row(row_index).data();

    console.log(row_data);

    $("#amount").val(row_data.amount);
    $("#comment").val(row_data.comment);

    setTimeout(function(){

        if(row_data.parent_id > 0){
            //get sub fund
            get_subcategoy(row_data.parent_id, 'sub_select', 'sub_label', 'sub_select');

            $('#head').val(row_data.parent_id);

            setTimeout(function(){
                $('.sub_head').val(row_data.id);
            }, 1000);
            
        
        }else{
            $('#head').val(row_data.id);
            $('#sub_label').css("display", "none");
		    $('#sub_select').css("display", "none");
        }
    }, 1000)
    

    $("#row_id").val(row_data.id);
    $("#transection_id").val(row_data.transection_id);

    $("#update_button").show();
    $("#save_button").hide();

    $("#fund_modal").modal('show');
}

//fund update save
function fund_update_save(){

    var head = $('#head').val();
    var sub_head = $('.sub_head').val();
    var comment = $('#comment').val();
    var amount = $('#amount').val();
    var transection_id = $('#transection_id').val();

    var error_status = false;
 
    if(head == ''){
          $('#head_error').html(' প্রধান খাত  প্রদান করুন');
         error_status = true;
    }else{
 
         if(sub_head == ''){
             $('#sub_head_error').html('সাব খাত  প্রদান করুন');
             error_status = true;
         }else{
             $('#sub_head_error').html('');
         }
 
         $('#head_error').html('');
    }
 

    if(amount == ''){
         $('#amount_error').html('টাকার পরিমান');
     }else{
         $('#amount_error').html('');
     }
 
 
    if(comment == ''){
        $('#comment_error').html('বিস্তারিত লিখুন');
        error_status = true;
    }else{
        $('#comment_error').html('');
    }
 
   
 
    if(error_status == false){
 
         $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
         $.ajax({
             url: url + '/accounts/fund_update_save',  
             type: "POST",
             dataType: "JSON",
             data: {
                 head : head,
                 sub_head : sub_head,
                 amount : amount,
                 transection_id : transection_id,
                 comment : comment,  
             },
             success: function(response) {
 
                 swal({
                     icon: response.status,
                     text: response.message,
                 })
                 $("#fund_modal").modal('hide');
                 fund_table.ajax.reload();
             
             }
         });
     }
 

}


		

 
