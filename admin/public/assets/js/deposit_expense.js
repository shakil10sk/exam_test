var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

$('#transfer_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});

$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});


//get account balance
function account_balance(id, target_id, target_amount){

    $('#main_balance').html('');
    $('#sub_balance').html('');
    $('#main_amount').val('');
    $('#sub_amount').val('');
    
    if(id > 0){
        
         $.ajax({
            url: url + '/accounts/account_balance',
            type: "POST",
            dataType: "JSON",
            data: { id : id},
            success: function(response) {

                $('#'+target_id).html(response);
                $('#'+target_amount).val(response);

            }
        });
    }
}

//get accounts sub-category
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
                   
                    if(target_id == 'from_subcategory'){

                        $('#main_balance').html('');
                        $('#main_amount').val('');
                    }
                }else{

                    if(target_id == 'from_subcategory'){

                        account_balance(id, 'main_balance', 'main_amount');
                    }
                    var sub_ctg = "<option value='' >সিলেক্ট </option>";
                    $('#'+target_id).html('');

                    $("#"+sub_label).css("display", "none");
                    $("#"+sub_select).css("display", "none");

                }
            }
        });
    }
}

//daily store
function daily_deposit_store(){

   var from_category = $('#from_category').val();
   var from_subcategory = $('#from_subcategory').val();
   var comment = $('#comment').val();
   var to_category = $('#to_category').val();
   var to_subcategory = $('#to_subcategory').val();
   var amount = parseFloat($('#amount').val());
   var transfer_date = $('#transfer_date').val();
   var type = $('#type').val();

   var main_amount = parseFloat($('#main_amount').val());
   var sub_amount = parseFloat($('#sub_amount').val());

   var error_status = false;

   if(main_amount > 0){

        if(main_amount < amount){
            $('#fund_error').html('প্রধান খাতে পর্যাপ্ত পরিমান টাকা নেই');

            error_status = true;
        }else{
            $('#fund_error').html(' ');
            error_status = false;
        }

    }else if(sub_amount > 0){

        if(sub_amount < amount){
            $('#fund_error').html('সাব খাতে পর্যাপ্ত পরিমান টাকা নেই');
            error_status = true;
        }else{
            $('#fund_error').html(' ');
            error_status = false;
        }

    }else{
        $('#fund_error').html(' ');
        
    }
    
   

   if(from_category == ''){
         $('#from_category_error').html(' প্রধান খাত  প্রদান করুন');
        error_status = true;
   }else{

        if(from_subcategory == ''){
            $('#from_subcategory_error').html('সাব খাত  প্রদান করুন');
            error_status = true;
        }else{


            $('#from_subcategory_error').html('');
        }

        $('#from_category_error').html('');
   }

   

   if(to_category == ''){
        $('#to_category_error').html('প্রধান খাত  প্রদান করুন');
        error_status = true;
    }else{

        if(to_subcategory == ''){
            $('#to_subcategory_error').html('সাব খাত  প্রদান করুন');
            error_status = true;
        }else{
            $('#to_subcategory_error').html('');
        }

        $('#to_category_error').html('');
    }   

   if(!from_subcategory && !to_subcategory){

        if(from_category > 0 && to_category > 0){


            if(from_category == to_category){
                $('#category_error').html('একই খাতে জমা অথবা খরচ করা যাবে না');
                error_status = true;
            }else{
                $('#category_error').html('');
            }
        }

   }else{
        $('#category_error').html('');
        
    }
   
   if(from_subcategory > 0 && to_subcategory > 0){

        if(from_subcategory == to_subcategory){
            $('#subcategory_error').html('একই সাব খাতে জমা অথবা খরচ করা যাবে না');
            error_status = true;
        }else{
            $('#subcategory_error').html('');
        }

   }else{
       $('#subcategory_error').html('');
   }

     
//    return false;

   if(amount == '' || amount == 0){
        $('#amount_error').html('টাকার পরিমান');
        error_status = true;
    }else{
        $('#amount_error').html('');
    }


   if(comment == ''){
       $('#comment_error').html('বিস্তারিত লিখুন');
       error_status = true;
   }else{
       $('#comment_error').html('');
   }

   if(transfer_date == ''){
        $('#transfer_date_error').html('তারিখ প্রদান করুন');
    }else{
        $('#transfer_date_error').html('');
    }


   if(error_status == false){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
            url: url + '/accounts/daily_deposit_save',
            type: "POST",
            dataType: "JSON",
            data: {
                from_category : from_category,
                from_subcategory : from_subcategory,
                to_category : to_category,
                to_subcategory : to_subcategory,
                comment : comment,
                amount : amount,
                type : type,
                transfer_date : transfer_date
            },
            success: function(response) {

                $('#main_balance').html('');
                $('#sub_balance').html('');
                $('#from_category').val('');
                $('#from_subcategory').val('');
                $('#comment').val('');
                $('#to_category').val('');
                $('#to_subcategory').val('');
                $('#amount').val('');

                swal({
                    icon: response.status,
                    text: response.message,
                })
            
            }
        });
    }




}