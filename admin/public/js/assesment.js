//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");


//for date picker
$('#from_date, #to_date, #generate_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});


var assesment_table, fiscal_year_id, ward_no, holding_no;


//===account list===//
function assesment_list() {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     assesment_table =    $('#assesment_list_table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
            dataType: "JSON",
            type: "post",
            url : url + '/accounts/assesment_list_data',
            data: {
                fiscal_year_id:fiscal_year_id,
                ward_no:ward_no,
                holding_no:holding_no,
            },

        },
        columns:[
            {
                data: null,
                render: function(){
                    return assesment_table.page.info().start + assesment_table.column(0).nodes().length;
                }
            },

            
            { data: "name" },
            { data: "pin" },
            { data: "holding_no" },
            { data: "ward_no" },
            { data: "halson_tax" },
            { 
                data: null,
                render:function(data, type, row){

                    if(data.due_tax > 0){

                        return data.due_tax;
                    
                    }else{
                        return '0.00';
                    }
                }

            },
            { 
                data: null,
                render:function(data, type, row){

                    if(data.is_paid == 1){
                        return '<span class="badge badge-primary">Paid</span>';
                    
                    }else{
                        return '<span class="badge badge-danger">Unpaid</span>';
                    }
                }

            },
            {
                data: null,
                render: function(data, type, row, meta){
                    let addHomeText = '';
                    let editHome = '';
                    let taxInvoice = '';
                    let deleteHome = '';

                    if($('#add-home-tax').val()){
                        addHomeText = "<a  href='javascript:void(0)' onclick='home_tax_collect("+meta.row+")'><p class='btn btn-sm btn-info' >কর আদায়</p></a> ";
                    }
                    if($('#edit-home').val()){
                        editHome = "<a  href='"+url+"/accounts/assesment_edit/"+data.pin+"'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                    }
                    if($('#home-tax-invoice').val()){
                        taxInvoice = "<a  href='"+url+"/accounts/home_tax_money_receipt/"+data.pin+"' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a> ";
                    }
                    if($('#delete-home').val()){
                        deleteHome = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' >ডিলিট</p></a> ";
                    }
                    if (data.is_paid != 1) {
                        taxInvoice = '';
                    }
            		return addHomeText+editHome+taxInvoice+deleteHome;
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


//assesment list search
function assesment_list_search(){

    fiscal_year_id = $("#fiscal_year_id").val();
    ward_no = $("#ward_no").val();
    holding_no = $("#holding_no").val();

    $("#assesment_list_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#assesment_list_table").dataTable().fnSettings().ajax.data.ward_no = ward_no;
    $("#assesment_list_table").dataTable().fnSettings().ajax.data.holding_no = holding_no;

    assesment_table.ajax.reload();

}

//home tax collect
function home_tax_collect(row_index){

    $("#discount").val(0.00);
    
    var row_data = assesment_table.row(row_index).data();

    $("#pin").val(row_data.pin);
    $("#name").val(row_data.name);
    $("#halson_tax").val(row_data.halson_tax);

    var due_tax = 0;

    if (row_data.due_tax > 0) {
        
        due_tax = parseInt(row_data.due_tax);
    }

    $("#due_tax").val(due_tax);

    $("#kor").val(parseInt(due_tax) + parseInt(row_data.halson_tax));
    

    $("#house_tax_collection_modal").modal('show');    
}

//discount calculation
function discount_calculation(){

    var halson_tax = $("#halson_tax").val();
    var due_tax = $("#due_tax").val();
    var discount = $("#discount").val();

    if(discount == '') { discount = 0;}

    if (due_tax < 0) { due_tax = 0; }

    $("#kor").val((parseInt(due_tax) + parseInt(halson_tax)) - parseInt(discount));

}

//house tax save
function house_tax_save(){

    var pin = $("#pin").val();
    var halson_tax = $("#halson_tax").val();
    var due_tax = $("#due_tax").val();
    var discount = $("#discount").val();
    var kor = $("#kor").val();
    var generate_date = $("#generate_date").val();

    if(discount < 0) { discount = 0;}

    if (due_tax < 0) { due_tax = 0; }

        swal({
             title: "অনুমোদন",
             text: "আপনি কি "+kor+" টাকা কর আদায় করতে চান ?",
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
                  url: url+'/accounts/home_tax_save',
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    pin : pin,
                    halson_tax : halson_tax,
                    due_tax : due_tax,
                    discount : discount,
                    kor : kor,
                    generate_date : generate_date,
                  },
                 success: function(response) {

                    $("#house_tax_collection_modal").modal('hide');

                    console.log(response);

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText:"বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="home_tax_money_receipt/'+response.pin+'" target="_blank">রশিদ</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                     })

                    assesment_table.ajax.reload();
                }
                });
             }
        }).then(function(){

        });
}


//get assesment existing data

function check_assesment_exist_data(){

    var search_data = $('#search_data').val();

    $.ajax({
            type:'POST',
            dataType:'JSON',
            url:url+'/accounts/check_assesment',
            beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
            complete: function() { $('.pre-loader').fadeOut(); },
            data:{search_data:search_data},
            success: function (res) {

                let info = '';

                console.log(res);

               if(res.status == 'error'){

                    swal({
                        type    : 'error',
                        title   : 'দুঃখিত !',
                        text    : res.msg,
                        confirmButtonText: 'ঠিক আছে'
                      });

                }else if(res.status == 'success'){

                    swal({
                        type    : 'success',
                        title   : 'Success',
                        text    : res.msg,
                        confirmButtonText: 'ঠিক আছে'
                      });

                }else{

                    if(res.gender == 1 && res.marital_status == 2){
                        $('#wife').show();
                        $('#wife_name_bn').attr('required', 'required');
                        $('#husband').hide();
                        $('#husband_name_bn').removeAttr('required');
                        $('#husband_name_en').val('');
                        $('#husband_name_bn').val('');
                    }else if(res.gender == 2 && res.marital_status == 2){
                        $('#husband').show();
                        $('#husband_name_bn').attr('required', 'required');
                        $('#wife').hide();
                        $('#wife_name_bn').removeAttr('required');
                        $('#wife_name_en').val('');
                        $('#wife_name_bn').val('');
                    }
                    $.each(res, function(name, val) {
                        $('#'+name).val(val);
                        $('#'+name).prop('disabled', true);
                    });
                    
                    $('#name_bn').val(res.name_bn);
                    $('#nagorik-pin').val(res.pin);

                    $('#father-name-bn').val(res.father_name_bn);
                    $('#mother-name-bn').val(res.mother_name_bn);

                    $("#gender_"+res.gender).attr('checked', true);
                    $(".gender").attr('disabled', true);
                    $(".wrap").css('opacity', '.2');

                    $('#marital_status').val(res.marital_status);
                    $('#sonaton').val(res.religion);

                    $('#wife_name_bn').val(res.wife_name_bn);

                    $('#husband_name_bn').val(res.husband_name_bn);
                

                    $('#permanent_district_id').append('<option value="'+res.permanent_district_id+'" selected="selected">'+res.permanent_district_name_en+'</option>');
                    $('#permanent_district_id').prop('disabled', true);
                    $('#permanent_district').val(res.permanent_district_name_bn);

                    $('#permanent_upazila_id').html('<option value="'+res.permanent_upazila_id+'" selected="selected">'+res.permanent_upazila_name_en+'</option>');
                    $('#permanent_upazila_id').prop('disabled', true);
                    $('#permanent_upazila').val(res.permanent_upazila_name_bn);

                    $('#permanent_postoffice_id').html('<option value="'+res.permanent_postoffice_id+'" selected="selected">'+res.permanent_postoffice_name_en+'</option>');
                    $('#permanent_postoffice_id').prop('disabled', true);
                    $('#permanent_postoffice').val(res.permanent_postoffice_name_bn);
                }
                
            }
        });


}


 
